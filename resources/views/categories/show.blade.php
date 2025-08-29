<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $category->name }} - Keluvato</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('partials.header')

    <!-- Breadcrumb -->
    <div class="container" style="margin-top: 20px;">
        <nav style="font-size: 14px; color: #666;">
            <a href="{{ route('home') }}" style="color: #4a6bff; text-decoration: none;">Accueil</a>
            <span style="margin: 0 8px;">></span>
            <span>{{ $category->name }}</span>
        </nav>
    </div>

    <!-- Header de la catégorie -->
    <div class="container" style="margin: 30px auto;">
        <div style="text-align: center; margin-bottom: 40px;">
            <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: #292f36;">{{ $category->name }}</h1>
            <p style="color: #666; font-size: 1.1rem;">{{ $totalProducts }} produit(s) disponible(s)</p>
        </div>
    </div>

    <!-- Produits de la catégorie principale -->
    @if($category->products && $category->products->count() > 0)
    <div class="container" style="margin-bottom: 50px;">
        <h2 style="font-size: 1.5rem; margin-bottom: 20px; color: #292f36;">
            <i class="fas fa-tag" style="color: #4a6bff; margin-right: 8px;"></i>
            Produits {{ $category->name }}
        </h2>
        <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
            @foreach($category->products as $product)
                <div class="product-card" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
                    <div style="height: 200px; background: url('{{ $product->images && count($product->images) > 0 ? $product->images[0] : 'https://picsum.photos/600/400' }}') center/cover;"></div>
                    <div style="padding: 15px;">
                        <h3 style="font-size: 1.1rem; margin-bottom: 8px; color: #292f36;">{{ $product->name }}</h3>
                        <div style="font-size: 1.2rem; font-weight: 700; color: #4a6bff; margin-bottom: 8px;">
                            {{ number_format($product->price, 2) }} {{ $product->currency ?? 'EUR' }}
                        </div>
                        @if($product->stock !== null)
                            <div style="color: {{ $product->stock > 0 ? '#059669' : '#dc2626' }}; font-size: 0.9rem; margin-bottom: 8px;">
                                {{ $product->stock > 0 ? "En stock ({$product->stock})" : 'Rupture de stock' }}
                            </div>
                        @endif
                        @if($product->description)
                            <p style="color: #666; font-size: 0.9rem; line-height: 1.4; margin-bottom: 15px;">
                                {{ Str::limit($product->description, 100) }}
                            </p>
                        @endif
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('products.show', $product->id) }}" style="flex: 1; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; cursor: pointer; color: #333; text-decoration: none; text-align: center; display: block;">
                                Voir détails
                            </a>
                            <button class="add-to-cart" data-product="{{ json_encode(['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'currency' => $product->currency ?? 'EUR']) }}" 
                                {{ $product->stock === 0 ? 'disabled' : '' }}
                                style="flex: 1; background: #4a6bff; color: #fff; border: 0; border-radius: 8px; padding: 8px 12px; cursor: pointer; opacity: {{ $product->stock === 0 ? '0.5' : '1' }};">
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Sous-catégories -->
    @if($category->children && $category->children->count() > 0)
        @foreach($category->children as $child)
            @if($child->products && $child->products->count() > 0)
            <div class="container" style="margin-bottom: 50px;">
                <h2 style="font-size: 1.5rem; margin-bottom: 20px; color: #292f36;">
                    <i class="fas fa-folder-open" style="color: #4ecdc4; margin-right: 8px;"></i>
                    {{ $child->name }}
                    <span style="font-size: 0.9rem; color: #666; font-weight: normal;">({{ $child->products->count() }} produit(s))</span>
                </h2>
                <div class="products-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px;">
                    @foreach($child->products as $product)
                        <div class="product-card" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
                            <div style="height: 200px; background: url('{{ $product->images && count($product->images) > 0 ? $product->images[0] : 'https://picsum.photos/600/400' }}') center/cover;"></div>
                            <div style="padding: 15px;">
                                <h3 style="font-size: 1.1rem; margin-bottom: 8px; color: #292f36;">{{ $product->name }}</h3>
                                <div style="font-size: 1.2rem; font-weight: 700; color: #4a6bff; margin-bottom: 8px;">
                                    {{ number_format($product->price, 2) }} {{ $product->currency ?? 'EUR' }}
                                </div>
                                @if($product->stock !== null)
                                    <div style="color: {{ $product->stock > 0 ? '#059669' : '#dc2626' }}; font-size: 0.9rem; margin-bottom: 8px;">
                                        {{ $product->stock > 0 ? "En stock ({$product->stock})" : 'Rupture de stock' }}
                                    </div>
                                @endif
                                @if($product->description)
                                    <p style="color: #666; font-size: 0.9rem; line-height: 1.4; margin-bottom: 15px;">
                                        {{ Str::limit($product->description, 100) }}
                                    </p>
                                @endif
                                <div style="display: flex; gap: 10px;">
                                    <a href="{{ route('products.show', $product->id) }}" style="flex: 1; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; cursor: pointer; color: #333; text-decoration: none; text-align: center; display: block;">
                                        Voir détails
                                    </a>
                                    <button class="add-to-cart" data-product="{{ json_encode(['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'currency' => $product->currency ?? 'EUR']) }}" 
                                        {{ $product->stock === 0 ? 'disabled' : '' }}
                                        style="flex: 1; background: #4a6bff; color: #fff; border: 0; border-radius: 8px; padding: 8px 12px; cursor: pointer; opacity: {{ $product->stock === 0 ? '0.5' : '1' }};">
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach
    @endif

    <!-- Message si aucun produit -->
    @if($totalProducts === 0)
    <div class="container" style="text-align: center; padding: 60px 20px;">
        <i class="fas fa-box-open" style="font-size: 4rem; color: #ddd; margin-bottom: 20px;"></i>
        <h3 style="color: #666; margin-bottom: 10px;">Aucun produit disponible</h3>
        <p style="color: #999;">Cette catégorie ne contient pas encore de produits.</p>
        <a href="{{ route('home') }}" style="display: inline-block; margin-top: 20px; background: #4a6bff; color: #fff; padding: 12px 24px; border-radius: 8px; text-decoration: none;">
            Retour à l'accueil
        </a>
    </div>
    @endif

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/google-translate.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Effet hover sur les cartes produits
            document.querySelectorAll('.product-card').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-4px)';
                    card.style.boxShadow = '0 12px 30px rgba(0,0,0,.1)';
                });
                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0)';
                    card.style.boxShadow = '';
                });
            });

            // Gestion des boutons "Ajouter au panier"
            document.querySelectorAll('.add-to-cart').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (btn.disabled) return;
                    
                    const productData = JSON.parse(btn.getAttribute('data-product'));
                    
                    // Ajouter au panier (utilise le système existant)
                    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                    const existingIndex = cart.findIndex(item => item.id === productData.id);
                    
                    if (existingIndex >= 0) {
                        cart[existingIndex].qty = (cart[existingIndex].qty || 1) + 1;
                    } else {
                        cart.push({...productData, qty: 1});
                    }
                    
                    localStorage.setItem('cart', JSON.stringify(cart));
                    
                    // Afficher notification
                    showToast('Produit ajouté au panier');
                    
                    // Mettre à jour le compteur du panier si la fonction existe
                    if (typeof updateCartCount === 'function') {
                        updateCartCount();
                    }
                });
            });

            function showToast(message) {
                const toast = document.createElement('div');
                toast.textContent = message;
                toast.style.cssText = `
                    position: fixed; bottom: 20px; right: 20px; z-index: 9999;
                    background: #111; color: #fff; padding: 12px 16px; border-radius: 8px;
                    box-shadow: 0 8px 24px rgba(0,0,0,.2); font-size: 14px;
                `;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 2500);
            }
        });
    </script>
</body>
</html>
