@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Créer un nouveau produit</h2>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="name" class="form-label">Nom du produit</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="price" class="form-label">Prix (€)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="stock" class="form-label">Stock disponible</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Catégories</label>
            <div class="row">
                @foreach($categories as $category)
                <div class="col-md-4 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $category->id }}" 
                               id="category-{{ $category->id }}" name="categories[]">
                        <label class="form-check-label" for="category-{{ $category->id }}">
                            {{ $category->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="mb-3">
            <label for="images" class="form-label">Images du produit</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
            <div class="form-text">Vous pouvez sélectionner plusieurs images</div>
        </div>
        
        <div class="mb-4">
            <label class="form-label">Couleurs disponibles</label>
            <div class="row">
                @foreach($colors as $color)
                <div class="col-md-3 mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $color->id }}" id="color-{{ $color->id }}" name="colors[]">
                        <label class="form-check-label d-flex align-items-center" for="color-{{ $color->id }}">
                            <span class="color-preview me-2" style="display:inline-block; width:20px; height:20px; background-color:{{ $color->code }}; border:1px solid #ddd;"></span>
                            {{ $color->name }}
                        </label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" checked>
            <label class="form-check-label" for="is_active">
                Produit actif
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Créer le produit</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>

<style>
    .color-preview {
        border-radius: 3px;
    }
</style>
@endsection
