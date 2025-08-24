<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminStatsController extends Controller
{
    public function index()
    {
        return response()->json([
            'kpis' => [
                'revenue'  => 24589,
                'orders'   => 156,
                'users'    => 89,
                'products' => 42,
                'admins'   => 1,
                'pros'     => 12,
            ],
            'sales_by_month' => [
                ['ym' => '2025-01', 'revenue' => 5000],
                ['ym' => '2025-02', 'revenue' => 8000],
                ['ym' => '2025-03', 'revenue' => 12000],
                ['ym' => '2025-04', 'revenue' => 15000],
                ['ym' => '2025-05', 'revenue' => 18000],
                ['ym' => '2025-06', 'revenue' => 20000],
                ['ym' => '2025-07', 'revenue' => 22000],
                ['ym' => '2025-08', 'revenue' => 25000],
                ['ym' => '2025-09', 'revenue' => 21000],
                ['ym' => '2025-10', 'revenue' => 19000],
                ['ym' => '2025-11', 'revenue' => 23000],
                ['ym' => '2025-12', 'revenue' => 28000],
            ],
            'top_products' => [
                ['name' => 'Canapé Oslo', 'qty' => 34],
                ['name' => 'Chaise Luna', 'qty' => 27],
                ['name' => 'Table Edge',  'qty' => 22],
            ],
            'low_stock' => [
                ['name' => 'Lampe noyer', 'stock' => 3],
                ['name' => 'Table basse', 'stock' => 2],
            ],
            'recent_orders' => [
                ['id' => 101, 'customer' => 'Jean Dupont',  'total_amount' => 349.90, 'status' => 'paid',    'created_at' => now()],
                ['id' => 102, 'customer' => 'Marie Curie',  'total_amount' => 129.00, 'status' => 'pending', 'created_at' => now()],
            ],
        ]);
    }
}
