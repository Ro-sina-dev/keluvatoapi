<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory; // ✅ active la factory

    protected $fillable = ['name','slug','parent_id'];

    // (Optionnel) casts si tu ajoutes un champ 'position' plus tard
    // protected $casts = ['position' => 'integer'];

    // 🔗 Parent
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // 🔗 Enfants
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // 🔗 Produits
    public function products()
    {
        return $this->belongsToMany(Product::class); // pivot category_product
    }

    // (Optionnel) Slug auto si manquant
    protected static function booted()
    {
        static::saving(function ($model) {
            if (empty($model->slug) && !empty($model->name)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // (Optionnel) Scopes utiles
    public function scopeRoots($q) { return $q->whereNull('parent_id'); }
    public function scopeOrdered($q) { return $q->orderBy('name'); }
}
