<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return response()->json($colors);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'code' => 'required|string|starts_with:#',
        ]);

        // S'assurer que le code est en majuscules et formaté correctement
        $validated['code'] = '#' . strtoupper(ltrim($validated['code'], '#'));
        
        // Vérifier si la couleur existe déjà
        $existingColor = Color::where('code', $validated['code'])->first();
        if ($existingColor) {
            return response()->json(['message' => 'Cette couleur existe déjà'], 422);
        }

        $color = Color::create($validated);
        return response()->json($color, 201);
    }

    public function destroy(Color $color)
    {
        try {
            // Vérifier si la couleur est utilisée par des produits
            if ($color->products()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Impossible de supprimer cette couleur car elle est utilisée par un ou plusieurs produits.'
                ], 422);
            }
            
            $color->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la suppression de la couleur.'
            ], 500);
        }
    }
}
