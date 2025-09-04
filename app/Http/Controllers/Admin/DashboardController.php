<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Charger les catégories depuis la BD
            $categories = Category::with(['children:id,parent_id,name'])
                ->whereNull('parent_id')
                ->orderBy('name')
                ->get(['id','name']);

            // Statistiques principales
            $currentMonth = Carbon::now()->format('Y-m');
            
            // Chiffre d'affaires du mois
            $revenue = Order::where('status', 'completed')
                ->where('created_at', 'like', "$currentMonth%")
                ->sum('total');

            // Nombre total de commandes
            $totalOrders = Order::count();

            // Nombre total d'utilisateurs
            $totalUsers = User::count();

            // Nombre de produits actifs
            $activeProducts = Product::where('is_active', true)->count();

            // Dernières commandes des clients et pros uniquement (limitées à 5)
            $recentOrders = Order::with(['user', 'items'])
                ->whereHas('user', function($query) {
                    $query->whereIn('role', ['client', 'pro']);
                })
                ->withCount('items')
                ->orderBy('created_at', 'desc')
                ->paginate(5);

            // Produits en faible stock (moins de 10 unités)
            $lowStockProducts = Product::where('stock', '<', 10)
                ->orderBy('stock')
                ->take(5)
                ->get();

            // Données pour les graphiques
            $salesData = $this->getSalesData();
            $topProducts = $this->getTopProducts();
            $userRoles = $this->getUserRoles();

            $data = [
                'user' => auth()->user(),
                'categories' => $categories,
                'revenue' => $revenue,
                'totalOrders' => $totalOrders,
                'totalUsers' => $totalUsers,
                'activeProducts' => $activeProducts,
                'recentOrders' => $recentOrders,
                'lowStockProducts' => $lowStockProducts,
                'salesData' => $salesData,
                'topProducts' => $topProducts,
                'userRoles' => $userRoles,
            ];

            return view('admin.dashboard', $data);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors du chargement du tableau de bord.');
        }
    }

    /**
     * Récupère les données de vente pour les 12 derniers mois
     */
    private function getSalesData()
    {
        $salesData = [];
        $months = [];
        $ordersCount = [];
        $currentYear = Carbon::now()->year;
        
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthYear = $date->format('Y-m');
            $monthName = $date->format('M Y');
            
            $monthData = Order::select(
                    DB::raw('SUM(total) as total_sales'),
                    DB::raw('COUNT(*) as orders_count')
                )
                ->where('status', 'completed')
                ->where('created_at', 'like', "$monthYear%")
                ->first();
                
            $salesData[] = $monthData->total_sales ?? 0;
            $ordersCount[] = $monthData->orders_count ?? 0;
            $months[] = $monthName;
        }
        
        // Statistiques annuelles
        $yearlyStats = Order::select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('SUM(total) as total_sales'),
                DB::raw('COUNT(*) as orders_count')
            )
            ->where('status', 'completed')
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
        
        return [
            'labels' => $months,
            'data' => $salesData,
            'orders_count' => $ordersCount,
            'yearly_stats' => $yearlyStats
        ];
    }
    
    /**
     * Récupère les produits les plus vendus
     */
    private function getTopProducts()
    {
        try {
            $query = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->join('orders', 'order_items.order_id', '=', 'orders.id')
                ->select(
                    'products.id',
                    'products.name',
                    'products.price',
                    DB::raw('SUM(order_items.quantity) as total_quantity'),
                    DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'),
                    DB::raw('COUNT(DISTINCT orders.id) as order_count')
                )
                ->where('orders.status', 'completed')
                ->groupBy('products.id', 'products.name', 'products.price')
                ->orderBy('total_quantity', 'desc')
                ->take(5);

            return $query->get()->map(function($item) {
                $item->revenue_formatted = number_format($item->total_revenue, 2, ',', ' ') . ' €';
                $item->avg_order_value = $item->order_count > 0 
                    ? number_format($item->total_revenue / $item->order_count, 2, ',', ' ') . ' €'
                    : '0,00 €';
                return $item;
            });
        } catch (\Exception $e) {
            \Log::error('Erreur dans getTopProducts: ' . $e->getMessage());
            return collect([]);
        }
    }
    
    /**
     * Récupère la répartition des rôles utilisateurs
     */
    private function getUserRoles()
    {
        $roles = User::select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role')
            ->toArray();
            
        // Assurez-vous que tous les rôles ont une valeur, même à zéro
        $allRoles = ['admin' => 0, 'vendeur' => 0, 'client' => 0];
        
        foreach ($allRoles as $role => $count) {
            if (isset($roles[$role])) {
                $allRoles[$role] = $roles[$role];
            }
        }
        
        return $allRoles;
    }
}
