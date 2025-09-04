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

    @php
    // Helpers protégés contre redéclaration
    if (!isset($imagesToArray) || !is_callable($imagesToArray)) {
        $imagesToArray = function ($images) {
            if (is_array($images)) return $images;
            if (is_string($images)) {
                $decoded = json_decode($images, true);
                if (is_array($decoded)) return $decoded;
                return strlen(trim($images)) ? [$images] : [];
            }
            return [];
        };
    }
    if (!isset($toUrl) || !is_callable($toUrl)) {
        $toUrl = function ($v) {
            if (!$v) return '';
            // enlève un host local éventuel
            $v = preg_replace('#^https?://(127\.0\.0\.1(:\d+)?|localhost(:\d+)?)#i', '', $v ?? '');
            // http(s) / data: => ok
            if (preg_match('#^(https?://|data:)#i', $v)) return $v;
            // déjà /storage/... => ok
            if (strpos($v, '/storage/') === 0) return $v;
            // chemin disque public -> /storage/...
            return \Illuminate\Support\Facades\Storage::url(ltrim($v, '/'));
        };
    }
@endphp


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
    @php
        $imgs = $imagesToArray($product->images ?? []);
        $img  = !empty($imgs[0]) ? $toUrl($imgs[0]) : 'https://picsum.photos/600/400';
        $inStockText = ($product->stock ?? 0) > 0 ? "En stock ({$product->stock})" : 'Rupture de stock';
    @endphp

    <div class="product-card" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
        <div style="height: 200px; background: url('{{ $img }}') center/cover;"></div>
        <div style="padding: 15px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 8px; color: #292f36;">{{ $product->name }}</h3>
            <div style="font-size: 1.2rem; font-weight: 700; color: #4a6bff; margin-bottom: 8px;">
                {{ number_format($product->price, 2) }} {{ $product->currency ?? 'EUR' }}
            </div>

            @if(!is_null($product->stock))
                <div style="color: {{ ($product->stock ?? 0) > 0 ? '#059669' : '#dc2626' }}; font-size: 0.9rem; margin-bottom: 8px;">
                    {{ $inStockText }}
                </div>
            @endif

            @if($product->description)
                <p style="color: #666; font-size: 0.9rem; line-height: 1.4; margin-bottom: 15px;">
                    {{ \Illuminate\Support\Str::limit($product->description, 100) }}
                </p>
            @endif

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('products.show', $product->id) }}" style="flex: 1; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; cursor: pointer; color: #333; text-decoration: none; text-align: center; display: block;">
                    Voir détails
                </a>
                <button
                    class="add-to-cart"
                    data-product="{{ json_encode(['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'currency' => $product->currency ?? 'EUR']) }}"
                    {{ ($product->stock ?? 0) === 0 ? 'disabled' : '' }}
                    style="flex: 1; background: #4a6bff; color: #fff; border: 0; border-radius: 8px; padding: 8px 12px; cursor: pointer; opacity: {{ ($product->stock ?? 0) === 0 ? '0.5' : '1' }};">
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
    @php
        $imgs = $imagesToArray($product->images ?? []);
        $img  = !empty($imgs[0]) ? $toUrl($imgs[0]) : 'https://picsum.photos/600/400';
        $inStockText = ($product->stock ?? 0) > 0 ? "En stock ({$product->stock})" : 'Rupture de stock';
    @endphp

    <div class="product-card" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; overflow: hidden; transition: transform 0.2s, box-shadow 0.2s;">
        <div style="height: 200px; background: url('{{ $img }}') center/cover;"></div>
        <div style="padding: 15px;">
            <h3 style="font-size: 1.1rem; margin-bottom: 8px; color: #292f36;">{{ $product->name }}</h3>
            <div style="font-size: 1.2rem; font-weight: 700; color: #4a6bff; margin-bottom: 8px;">
                {{ number_format($product->price, 2) }} {{ $product->currency ?? 'EUR' }}
            </div>

            @if(!is_null($product->stock))
                <div style="color: {{ ($product->stock ?? 0) > 0 ? '#059669' : '#dc2626' }}; font-size: 0.9rem; margin-bottom: 8px;">
                    {{ $inStockText }}
                </div>
            @endif

            @if($product->description)
                <p style="color: #666; font-size: 0.9rem; line-height: 1.4; margin-bottom: 15px;">
                    {{ \Illuminate\Support\Str::limit($product->description, 100) }}
                </p>
            @endif

            <div style="display: flex; gap: 10px;">
                <a href="{{ route('products.show', $product->id) }}" style="flex: 1; background: #fff; border: 1px solid #ddd; border-radius: 8px; padding: 8px 12px; cursor: pointer; color: #333; text-decoration: none; text-align: center; display: block;">
                    Voir détails
                </a>
                <button
                    class="add-to-cart"
                    data-product="{{ json_encode(['id' => $product->id, 'name' => $product->name, 'price' => $product->price, 'currency' => $product->currency ?? 'EUR']) }}"
                    {{ ($product->stock ?? 0) === 0 ? 'disabled' : '' }}
                    style="flex: 1; background: #4a6bff; color: #fff; border: 0; border-radius: 8px; padding: 8px 12px; cursor: pointer; opacity: {{ ($product->stock ?? 0) === 0 ? '0.5' : '1' }};">
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

    <!-- Footer -->
    <!-- Bande d'avantages e-commerce -->
    <section class="kv-usp">
        <div class="container kv-usp-wrap">
            <div class="usp"><i class="fas fa-shipping-fast"></i><span>Livraison rapide</span></div>
            <div class="usp"><i class="fas fa-undo-alt"></i><span>Retours faciles 30j</span></div>
            <div class="usp"><i class="fas fa-lock"></i><span>Paiement 100% sécurisé</span></div>
            <div class="usp"><i class="fas fa-headset"></i><span>Support 7j/7</span></div>
        </div>
    </section>

    <footer class="kv-footer">
        <!-- bulles d'arrière-plan -->
        <div class="kv-orbs" aria-hidden="true">
            <span class="orb"></span><span class="orb"></span><span class="orb"></span>
            <span class="orb"></span><span class="orb"></span><span class="orb"></span>
        </div>

        <div class="container">
            <!-- Newsletter -->
            <div class="kv-newsletter">
                <h3>Inscrivez-vous à notre newsletter</h3>
                <p>Des promos, des nouveautés et des conseils déco – directement dans votre boîte mail.</p>
                <form action="" method="POST" class="kv-news-form">
                    @csrf
                    <input type="email" name="email" placeholder="Votre e-mail" required>
                    <button type="submit" class="btn-news">S’abonner</button>
                </form>
                <small>En vous inscrivant, vous acceptez notre <a href="">Politique de
                        confidentialité</a>.</small>
            </div>

            <!-- Colonnes -->
            <div class="footer-container">
                <div class="footer-col">
                    <h3>Keluvato Group</h3>
                    <p>Votre boutique en ligne pour meubles, déco et bricolage. Sélection soignée, prix justes, service
                        aux petits soins.</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="X"><i class="fab fa-twitter"></i></a>
                        <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest"></i></a>
                    </div>

                    <!-- Confiance / Paiements -->
                    <div class="kv-trust">
                        <div class="badges">
                            <span class="badge"><i class="fas fa-shield-alt"></i> Acheteur protégé</span>
                            <span class="badge"><i class="fas fa-certificate"></i> Satisfait ou remboursé</span>
                        </div>
                        <div class="payments" title="Moyens de paiement">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-paypal"></i>
                            <i class="fas fa-mobile-alt" title="Mobile Money"></i>
                        </div>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Boutique</h3>
                    <ul>
                        <li><a href="">Meubles</a></li>
                        <li><a href="">Décoration</a></li>
                        <li><a href="">Bricolage</a></li>
                        <li><a href="">Construction</a></li>
                        <li><a href="">Promotions</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Aide & SAV</h3>
                    <ul>
                        <li><a href="">Contact</a></li>
                        <li><a href="">FAQ</a></li>
                        <li><a href="">Livraison</a></li>
                        <li><a href="">Retours & remboursements</a></li>
                        <li><a href="">Guide des tailles</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Informations</h3>
                    <ul>
                        <li><a href="">À propos</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">CGV</a></li>
                        <li><a href="">Confidentialité</a></li>
                        <li><a href="">Mentions légales</a></li>
                    </ul>

                    <!-- App & préférences -->
                    <div class="kv-apps">
                        <a href="#" class="store">App Store</a>
                        <a href="#" class="store">Google Play</a>
                    </div>
                    <div class="kv-prefs">
                        <select aria-label="Devise">
                            <option value="XOF">XOF – CFA</option>
                            <option value="EUR">EUR – €</option>
                        </select>
                        <select aria-label="Langue">
                            <option>Français</option>
                            <option>English</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; {{ date('Y') }} Keluvato Group — Tous droits réservés.</p>
            </div>
        </div>
    </footer>


    <style>
        /* ===== Bande USP (avantages e-commerce) ===== */
        .kv-usp {
            /* background:#0f2a33; */
            color: #e9fcff;
            border-radius: 5px;
            /*  border: 1px #1f4e5f solid;*/
        }

        .kv-usp .kv-usp-wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 10px 16px;
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 12px;
        }

        .kv-usp .usp {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #1f4e5f;
            border: 1px solid #1f4e5f;
            padding: 10px 12px;
            border-radius: 20px;


        }

        .kv-usp .usp i {
            font-size: 18px;
        }

        /* ===== Footer Keluvato avec bulles 3D ===== */
        .kv-footer {
            position: relative;
            overflow: hidden;
            color: #eef6f9;
            padding: 50px 0 20px;
            background: radial-gradient(1200px 600px at 100% 120%, #1f4e5f 0%, #1f4e5f 45%, #1f4e5f 80%, #1f4e5f 100%);
            isolation: isolate;
        }

        .kv-footer .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 16px;
        }

        /* Bulles décoratives */
        .kv-footer .kv-orbs {
            position: absolute;
            inset: -10% -10% -10% -10%;
            z-index: -1;
        }

        .kv-footer .kv-orbs .orb {
            position: absolute;
            width: clamp(18px, 2.2vw, 28px);
            height: clamp(18px, 2.2vw, 28px);
            border-radius: 50%;
            background:
                radial-gradient(circle at 30% 28%, rgba(255, 255, 255, .95) 0 26%, rgba(255, 255, 255, 0) 27%),
                radial-gradient(circle at 65% 70%, #4ecdc4 0 18%, #1f4e5f 70%);
            box-shadow: 0 8px 18px rgba(0, 0, 0, .25), inset -4px -6px 12px rgba(0, 0, 0, .25), inset 6px 8px 12px rgba(255, 255, 255, .15);
            opacity: .85;
            animation: kv-float var(--dur, 18s) ease-in-out infinite;
        }

        .kv-footer .kv-orbs .orb:nth-child(1) {
            top: 10%;
            left: 6%;
            --dur: 22s;
            animation-delay: -3s;
            scale: 1.1;
        }

        .kv-footer .kv-orbs .orb:nth-child(2) {
            top: 25%;
            right: 10%;
            --dur: 17s;
            animation-delay: -8s;
            scale: .9;
        }

        .kv-footer .kv-orbs .orb:nth-child(3) {
            top: 55%;
            left: 14%;
            --dur: 19s;
            animation-delay: -12s;
            scale: 1.25;
        }

        .kv-footer .kv-orbs .orb:nth-child(4) {
            top: 70%;
            right: 18%;
            --dur: 21s;
            animation-delay: -5s;
            scale: 1.05;
        }

        .kv-footer .kv-orbs .orb:nth-child(5) {
            top: 40%;
            left: 45%;
            --dur: 24s;
            animation-delay: -10s;
            scale: .95;
        }

        .kv-footer .kv-orbs .orb:nth-child(6) {
            top: 12%;
            right: 38%;
            --dur: 16s;
            animation-delay: -2s;
            scale: 1.2;
        }

        @keyframes kv-float {
            0% {
                transform: translateY(0) translateX(0) rotate(0deg)
            }

            25% {
                transform: translateY(-14px) translateX(8px) rotate(8deg)
            }

            50% {
                transform: translateY(6px) translateX(-6px) rotate(-6deg)
            }

            75% {
                transform: translateY(-10px) translateX(4px) rotate(5deg)
            }

            100% {
                transform: translateY(0) translateX(0) rotate(0deg)
            }
        }

        /* Grille colonnes */
        .kv-footer .footer-container {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 32px;
            margin-top: 26px;
        }

        .kv-footer .footer-col h3 {
            font-size: 1.05rem;
            letter-spacing: .3px;
            margin-bottom: 12px;
            color: #e9fcff;
        }

        .kv-footer .footer-col p {
            color: #d3e7eb;
            line-height: 1.7;
            font-size: .95rem;
        }

        .kv-footer .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .kv-footer .footer-col li {
            margin: .45rem 0;
        }

        .kv-footer a {
            color: #cfeef3;
            text-decoration: none;
            transition: color .2s ease, transform .2s ease;
        }

        .kv-footer a:hover {
            color: #ffffff;
            transform: translateX(2px);
        }

        /* Newsletter */
        .kv-footer .kv-newsletter {
            text-align: center;
            margin-bottom: 10px;
        }

        .kv-footer .kv-newsletter h3 {
            margin-bottom: 6px;
        }

        .kv-footer .kv-newsletter p {
            color: #d3e7eb;
            margin-bottom: 14px;
        }

        .kv-footer .kv-news-form {
            display: flex;
            justify-content: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .kv-footer .kv-news-form input {
            min-width: 260px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, .18);
            background: rgba(255, 255, 255, .06);
            color: #fff;
            outline: none;
        }

        .kv-footer .kv-news-form input::placeholder {
            color: #cfeef3;
            opacity: .8;
        }

        .kv-footer .kv-news-form .btn-news {
            padding: 12px 16px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, .25);
            background: #1f4e5f;
            color: #fff;
            cursor: pointer;
            transition: transform .2s ease, background .2s ease;
        }

        .kv-footer .kv-news-form .btn-news:hover {
            transform: translateY(-2px);
            background: #143743;
        }

        .kv-footer small a {
            text-decoration: underline;
        }

        /* Confiance & paiements */
        .kv-footer .kv-trust {
            margin-top: 16px;
        }

        .kv-footer .kv-trust .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 10px;
        }

        .kv-footer .kv-trust .badge {
            font-size: .82rem;
            padding: 6px 10px;
            border-radius: 999px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .14);
        }

        .kv-footer .kv-trust .payments {
            display: flex;
            gap: 12px;
            font-size: 26px;
            opacity: .95;
        }

        /* Apps & préférences */
        .kv-footer .kv-apps {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .kv-footer .kv-apps .store {
            padding: 8px 12px;
            border-radius: 10px;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .14);
            font-size: .9rem;
        }

        .kv-footer .kv-prefs {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .kv-footer .kv-prefs select {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .14);
            color: #e9fcff;
            padding: 8px 10px;
            border-radius: 10px;
        }

        /* Bas de page */
        .kv-footer .copyright {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            margin-top: 26px;
            padding-top: 16px;
            text-align: center;
            color: #b7d7dd;
            font-size: .9rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .kv-usp .kv-usp-wrap {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .kv-footer .footer-container {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 560px) {
            .kv-usp .kv-usp-wrap {
                grid-template-columns: 1fr;
            }

            .kv-footer {
                padding-top: 40px;
            }

            .kv-footer .footer-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
