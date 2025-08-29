<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Category;

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

            $data = [
                'user' => auth()->user(),
                'categories' => $categories,
            ];

            return view('admin.dashboard', $data);
        } catch (\Exception $e) {
            Log::error('Dashboard error: ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors du chargement du tableau de bord.');
        }
    }
}
