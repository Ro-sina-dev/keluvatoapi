<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $tree = [
            'Meubles' => ['Salon', 'Chambre', 'Salle à manger', 'Bureau & Rangement'],
            'Décoration' => ['Luminaires', 'Textiles', 'Miroirs & Murales', 'Extérieur déco'],
            'Bricolage' => ['Électroportatif', 'Outils à main', 'Quincaillerie'],
            'Construction' => ['Bois & Panneaux', 'Maçonnerie', 'Peinture & Sols', 'Électricité', 'Plomberie'],
        ];

        foreach ($tree as $root => $children) {
            $parent = Category::firstOrCreate(
                ['name' => $root],
                ['slug' => Str::slug($root), 'parent_id' => null]
            );

            foreach ($children as $child) {
                Category::firstOrCreate(
                    ['name' => $child, 'parent_id' => $parent->id],
                    ['slug' => Str::slug($child)]
                );
            }
        }
    }
}
