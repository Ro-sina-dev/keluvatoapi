<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keluvato - Meubles, Décoration & Bricolage</title>

    <!-- Meta description pour le SEO -->
    <meta name="description"
        content="Keluvato – Découvrez nos meubles, décorations et solutions de bricolage pour embellir votre maison. Qualité, style et confort pour chaque intérieur." />
    <meta name="keywords"
        content="meubles, décoration, bricolage, maison, mobilier, accessoires déco, outils bricolage" />
    <meta name="author" content="Keluvato" />
    <meta name="robots" content="index, follow" />

    <link rel="stylesheet" href="">
    <!-- Open Graph -->
    <meta property="og:title" content="Keluvato – Meubles, Décoration & Bricolage" />
    <meta property="og:description"
        content="Découvrez nos meubles, décorations et solutions de bricolage pour embellir votre maison." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://keluvato.com/" />
    <meta property="og:image" content="{{ asset('assets/images/og-image.jpg') }}" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Keluvato – Meubles, Décoration & Bricolage" />
    <meta name="twitter:description"
        content="Découvrez nos meubles, décorations et solutions de bricolage pour embellir votre maison." />
    <meta name="twitter:image" content="{{ asset('assets/images/og-image.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Fonts et icônes externes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobilia - Boutique de Meubles</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #34495e;
            --accent: #e67e22;
            --light: #f8f9fa;
            --dark: #2c3e50;
            --success: #27ae60;
            --warning: #f39c12;
            --danger: #e74c3c;
            --text: #333;
            --text-light: #f9f9f9;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7f9;
            color: var(--text);
            min-height: 100vh;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 15px 5%;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--primary);
        }


        .logo i {
            margin-right: 10px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: var(--light);
            padding: 10px 15px;
            border-radius: 30px;
            width: 40%;
        }

        .search-box input {
            border: none;
            background: transparent;
            width: 100%;
            padding: 5px;
            outline: none;
        }

        .user-settings {
            display: flex;
            align-items: center;
        }

        .language-currency {
            display: flex;
            margin-right: 20px;
        }

        .select-box {
            margin-left: 10px;
            position: relative;
        }

        .select-box select {
            padding: 8px 30px 8px 15px;
            border: 1px solid #ddd;
            border-radius: 20px;
            appearance: none;
            background: white;
            font-size: 0.9rem;
        }

        .select-box i {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .cart-icon {
            position: relative;
            margin-right: 10px;
            font-size: 1.5rem;
            color: var(--primary);
            cursor: pointer;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        /* Navigation */
        .categories-nav {
            background: white;
            padding: 15px 5%;
            margin-bottom: 30px;
            box-shadow: var(--shadow);
            overflow-x: auto;
            white-space: nowrap;
        }

        .categories-nav ul {
            display: inline-flex;
            list-style: none;
        }

        .categories-nav li {
            margin-right: 25px;
        }

        .categories-nav a {
            text-decoration: none;
            color: var(--text);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 20px;
            transition: var(--transition);
        }

        .categories-nav a:hover,
        .categories-nav a.active {
            background: var(--accent);
            color: white;
        }

        /* Main Content */
        .main-content {
            padding: 0 5% 40px;
        }

        /* Hero Slider */
        .hero-slider {
            height: 400px;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 40px;
            position: relative;
            box-shadow: var(--shadow);
        }

        .slide {
            height: 100%;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            padding: 0 60px;
        }

        .slide-1 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1493663284031-b7e3aaa4c4b1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        }

        .slide-2 {
            background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?ixlib=rb-4.0.3&auto=format&fit=crop&w=1350&q=80');
        }

        .slide-content {
            color: white;
            max-width: 500px;
        }

        .slide-content h2 {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .slide-content p {
            margin-bottom: 25px;
            font-size: 1.1rem;
        }

        .slide-btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
        }

        .slide-btn:hover {
            background: #d35400;
            transform: translateY(-2px);
        }

        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
        }

        .dot {
            width: 12px;
            height: 12px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            margin: 0 5px;
            cursor: pointer;
        }

        .dot.active {
            background: white;
        }

        /* Section Title */
        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .section-title h2 {
            font-size: 1.8rem;
            color: var(--primary);
        }

        .view-all {
            color: var(--accent);
            text-decoration: none;
            font-weight: 500;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .product-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .product-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .product-info {
            padding: 20px;
        }

        .product-title {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .product-price {
            /* font-size: 1.3rem;*/
            font-weight: bold;
            color: var(--accent);
            margin-bottom: 15px;
        }

        .product-actions {
            display: flex;
            justify-content: space-between;
        }

        .add-to-cart {
            background: var(--accent);
            color: white;
            border: none;
            padding: 9px 10px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .add-to-cart:hover {
            background: #d35400;
        }

        .add-to-cart i {
            margin-right: 8px;
        }

        .view-details {
            background: var(--light);
            color: var(--text);
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 500;
        }

        .view-details:hover {
            background: #e5e8eb;
        }

        /* Promo Banner */
        .promo-banner {
            background: linear-gradient(to right, #2c3e50, #4a6491);
            border-radius: 12px;
            padding: 40px;
            margin-bottom: 50px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
        }

        .promo-content h2 {
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .promo-content p {
            margin-bottom: 20px;
            font-size: 1.1rem;
            max-width: 600px;
        }

        .promo-btn {
            background: white;
            color: var(--primary);
            border: none;
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
        }

        .promo-btn:hover {
            background: var(--light);
            transform: translateY(-2px);
        }

        /* Cart Modal */
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 380px;
            height: 100vh;
            background: white;
            box-shadow: -5px 0 25px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            padding: 25px;
            overflow-y: auto;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .close-cart {
            background: none;
            border: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: #777;
        }

        .cart-items {
            margin-bottom: 25px;
        }

        .cart-item {
            display: flex;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .cart-item-img {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .cart-item-info {
            flex: 1;
        }

        .cart-item-title {
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .cart-item-price {
            color: var(--accent);
            font-weight: bold;
            font-size: 1.1rem;
        }

        .cart-item-quantity {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            background: var(--light);
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .quantity-input {
            width: 45px;
            text-align: center;
            margin: 0 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 5px;
        }

        .remove-item {
            color: var(--danger);
            background: none;
            border: none;
            cursor: pointer;
            margin-left: 15px;
            font-size: 1.2rem;
        }

        .cart-summary {
            padding: 20px;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
        }

        .summary-total {
            font-weight: bold;
            font-size: 1.3rem;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            margin-top: 15px;
        }

        .checkout-btn {
            width: 100%;
            background: var(--success);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: var(--transition);
        }

        .checkout-btn:hover {
            background: #219653;
        }

        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .promo-banner {
                flex-direction: column;
                text-align: center;
            }

            .promo-content {
                margin-bottom: 25px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                padding: 15px;
            }

            .logo {
                margin-bottom: 15px;
            }

            .search-box {
                width: 100%;
                margin-bottom: 15px;
            }

            .user-settings {
                width: 100%;
                justify-content: center;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .slide {
                padding: 0 30px;
            }

            .slide-content h2 {
                font-size: 2rem;
            }

            .cart-modal {
                width: 100%;
            }
        }
    </style>
    <style>
        /* ===== Hero Slider (responsive) ===== */
        .hero-slider {
            position: relative;
            height: 60vh;
            /* desktop par défaut */
            min-height: 360px;
            /* garde une bonne hauteur même sur petits écrans */
            max-height: 720px;
            overflow: hidden;
            color: #fff;
            font-family: inherit;
        }

        /* slide = background-cover responsive */
        .hero-slider .slide {
            position: absolute;
            inset: 0;
            background-image: var(--bg);
            background-size: cover;
            /* couvre tout l’espace */
            background-position: center;
            /* centre le crop */
            background-repeat: no-repeat;
            opacity: 0;
            transform: scale(1.02);
            transition: opacity .6s ease, transform .6s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(12px, 3vw, 32px);
        }

        .hero-slider .slide.active {
            opacity: 1;
            transform: scale(1);
            z-index: 1;
        }

        /* overlay noir pour lisibilité */
        .hero-slider .slide::before {
            content: "";
            position: absolute;
            inset: 0;
            z-index: 0;
            background: rgba(0, 0, 0, .55);
        }

        /* conteneur texte */
        .slide-content {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: min(90vw, 860px);
            text-align: center;
        }

        .slide-content h2 {
            font-size: clamp(22px, 4vw, 44px);
            line-height: 1.15;
            margin: 0 0 10px;
        }

        .slide-content p {
            font-size: clamp(13px, 2.1vw, 18px);
            line-height: 1.6;
            margin: 0 0 16px;
            color: #f2f2f2;
            max-width: 65ch;
            margin-inline: auto;
        }

        .slide-btn {
            display: inline-block;
            background: #ff6600;
            color: #fff;
            text-decoration: none;
            padding: clamp(10px, 1.8vw, 14px) clamp(16px, 2.6vw, 22px);
            border-radius: 10px;
            font-weight: 700;
            font-size: clamp(13px, 1.8vw, 16px);
            white-space: nowrap;
            /* ✅ évite que le bouton casse en 2 lignes */
        }

        /* animation d'entrée du texte */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px)
            }

            to {
                opacity: 1;
                transform: translateY(0)
            }
        }

        .slide.active .slide-content>* {
            opacity: 0;
            animation: fadeUp .6s both ease-out;
        }

        .slide.active .slide-content h2 {
            animation-delay: .10s
        }

        .slide.active .slide-content p {
            animation-delay: .22s
        }

        .slide.active .slide-content .slide-btn {
            animation-delay: .34s
        }

        /* Dots */
        .slider-dots {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: clamp(10px, 2.4vw, 22px);
            display: flex;
            gap: 10px;
            z-index: 3;
        }

        .slider-dots .dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #fff;
            opacity: .45;
            cursor: pointer;
            transition: opacity .2s ease, transform .2s ease;
            touch-action: manipulation;
        }

        .slider-dots .dot.active {
            opacity: 1;
            transform: scale(1.08);
        }

        /* ===== Breakpoints ===== */

        /* Tablette */
        @media (max-width: 992px) {
            .hero-slider {
                height: 50vh;
                min-height: 320px;
            }

            .slide-content {
                max-width: min(92vw, 720px);
            }
        }

        /* Mobile */
        @media (max-width: 640px) {
            .hero-slider {
                height: 42vh;
                min-height: 260px;
            }

            /* ✅ réduit encore */
            .hero-slider .slide::before {
                background: rgba(0, 0, 0, .65);
            }

            .slide-content {
                padding-inline: 8px;
            }

            .slide-content h2 {
                font-size: 1.4rem;
            }

            /* ✅ réduit les titres */
            .slide-content p {
                font-size: 0.9rem;
            }

            /* ✅ réduit les textes */
            .slide-btn {
                font-size: 0.8rem;
                padding: 8px 14px;
            }

            .slider-dots .dot {
                width: 9px;
                height: 9px;
            }
        }

        /* Desktop large */
        @media (min-width: 1100px) {
            .hero-slider .slide {
                justify-content: flex-start;
            }

            .slide-content {
                text-align: left;
                margin-left: clamp(40px, 8vw, 120px);
            }

            .slide-content p {
                margin-inline: 0;
            }
        }

        /* Accessibilité */
        @media (prefers-reduced-motion: reduce) {

            .hero-slider .slide,
            .slide-content>* {
                transition: none !important;
                animation: none !important;
            }
        }
    </style>

</head>

<body>
    @include('partials.header')
    <!-- Header -->


    <!-- Navigation (catégories dynamiques) -->
    <div class="categories-nav">
        <ul id="catChips">
            <li>
                <a href="{{ route('home') }}" class="chip {{ request()->is('/') ? 'active' : '' }}" data-id="">
                    Tous
                </a>
            </li>

            @foreach ($categories ?? collect() as $c)
                @php
                    $count = $c->total_products_count ?? ($c->direct_products_count ?? 0);
                @endphp
                <li>
                    <a href="{{ url('/categorie/' . $c->id) }}"
                        class="chip {{ request()->is('categorie/' . $c->id) ? 'active' : '' }}"
                        data-id="{{ $c->id }}">
                        {{ $c->name }}
                        @if ($count > 0)
                            <span class="chip-count">{{ $count }}</span>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <style>

    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const chips = document.querySelectorAll('#catChips .chip');
            chips.forEach(chip => {
                chip.addEventListener('click', () => {
                    chips.forEach(c => c.classList.remove('active'));
                    chip.classList.add('active');
                    // on laisse le navigateur suivre le lien /categorie/{id}
                    // si tu préfères charger dynamiquement: empêche le défaut et appelle openCategory(...)
                });
            });
        });
    </script>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Hero Slider -->
        <!-- Hero Slider -->
        <div class="hero-slider" id="heroSlider">
            <!-- Slide 1 -->
            <div class="slide" style="--bg:url('{{ asset('assets/renaii.jpg') }}')">
                <div class="overlay"></div>
                <div class="slide-content">
                    <h2>Collection Printemps </h2>
                    <p>Découvrez nos nouvelles arrivées avec des designs uniques et des matériaux écologiques.</p>
                    <a href="{{ route('products.discover') }}" class="slide-btn">Voir la collection</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="slide" style="--bg:url('{{ asset('assets/renai.jpg') }}')">
                <div class="overlay"></div>
                <div class="slide-content">
                    <h2>Mobilier Haut de Gamme</h2>
                    <p>Un confort absolu pour sublimer votre intérieur.</p>
                    <a href="{{ route('products.discover') }}" class="slide-btn">Explorer</a>
                </div>
            </div>

            <!-- Dots -->
            <div class="slider-dots" id="sliderDots"></div>
        </div>


        <!-- Section Titre -->
        <div class="section-title">
            <h2>Meubles Populaires</h2>
            <a href="{{ route('products.discover') }}" class="view-all">Voir tout</a>
        </div>

        <!-- Grille de produits -->
        <div class="products-grid">
            @php
                $toUrl = function ($v) {
                    $v = is_string($v) ? trim($v) : '';
                    if ($v === '') {
                        return '';
                    }

                    // URL absolue (http/https/protocole-less) ou data URI -> on renvoie tel quel
                    if (preg_match('#^(https?://|//|data:)#i', $v)) {
                        return $v;
                    }

                    // Si une URL locale a été stockée, on enlève juste l’hôte 127.0.0.1/localhost
                    $v = preg_replace('#^https?://(127\.0\.0\.1(:\d+)?|localhost(:\d+)?)#i', '', $v);

                    // Normalise les slashes
                    $v = ltrim($v, '/');

                    // Déjà préfixé par "storage/" (public/storage symlink) -> renvoie "/storage/..."
                    if (str_starts_with($v, 'storage/')) {
                        return '/' . $v;
                    }

                    // Certains stockent "public/..." -> translate vers URL publique
                    if (str_starts_with($v, 'public/')) {
                        $v = substr($v, 7); // enlève "public/"
                    }

                    // Cas général: fichier sur le disque "public"
                    return \Illuminate\Support\Facades\Storage::disk('public')->url($v);
                };
            @endphp


            @forelse($products->take(10) as $p)
                @php
                    $imgs = is_array($p->images) ? $p->images : (json_decode($p->images ?? '[]', true) ?: []);
                    $img = !empty($imgs[0]) ? $toUrl($imgs[0]) : 'https://via.placeholder.com/400x300?text=Image';
                    $hasPromo = !is_null($p->discount_price);
                    $priceDisplay = $hasPromo ? $p->discount_price : $p->price;
                @endphp

                <div class="product-card">
                    <div class="product-img-wrapper" style="position: relative;">
                        <img src="{{ $img }}" alt="{{ $p->name }}" class="product-img" loading="lazy">

                        <!-- ❤️ Coeur de like -->
                        <button class="like-btn"
                            style="
                            position: absolute;
                            top: 10px;
                            right: 10px;
                            background: white;
                            border: none;
                            border-radius: 50%;
                            width: 36px;
                            height: 36px;
                            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                            cursor: pointer;
                        "
                            data-id="{{ $p->id }}">
                            <i class="fa{{ $p->liked_by_user ? 's' : 'r' }} fa-heart"></i>
                        </button>

                        <!-- Badge promo / vedette -->
                        @if ($hasPromo)
                            <span
                                class="product-badge">-{{ number_format((1 - $p->discount_price / $p->price) * 100, 0) }}%</span>
                        @elseif ($p->is_featured)
                            <span class="product-badge">Vedette</span>
                        @endif
                    </div>

                    <div class="product-info">
                        <div class="product-header"
                            style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                            <h3 class="product-title" style="margin:0;font-size:1rem;flex:1;">
                                {{ $p->name }}
                            </h3>
                            <div class="product-price" style="white-space:nowrap;">
                                <span class="price-now" style="color:#595959;font-weight:100;">
                                    {{ number_format($priceDisplay, 0, ',', ' ') }} {{ $p->currency ?? 'FCFA' }}
                                </span>
                                @if ($hasPromo)
                                    <span class="old-price"
                                        style="text-decoration:line-through;color:#888;margin-left:6px;">
                                        {{ number_format($p->price, 0, ',', ' ') }} {{ $p->currency ?? 'FCFA' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="product-actions" style="margin-top:0px;">
                            <button
                                class="btn-add-to-cart add-to-cart"
                                type="button"
                                data-id="{{ $p->id }}"
                                data-name="{{ $p->name }}"

                                data-image="{{ $img }}"
                                data-currency="{{ $p->currency ?? 'FCFA' }}"
                            >
                                <i class="fas fa-cart-plus"></i> Ajouter
                            </button>

                            <a href="{{ route('products.show', $p->id) }}" class="view-details">Détails</a>
                            </div>

                    </div>

                </div>
            @empty
                <p>Aucun produit populaire trouvé.</p>
            @endforelse
        </div>


        <!-- Promo Banner -->
        <div class="promo-banner">
            <div class="promo-content">
                <h2>Soldes d'Été - Jusqu'à 30% de réduction</h2>
                <p>Profitez de nos offres spéciales sur une sélection de meubles design. Livraison gratuite à partir de
                    499€ d'achat.</p>
                <button class="promo-btn">Voir les offres</button>
            </div>
            <div class="promo-image">
                <!-- This would typically be an image -->
            </div>
        </div>

        <!-- New Arrivals -->
        <div class="section-title">
            <h2>Nouveautés</h2>
            <a href="{{ route('products.discover') }}" class="view-all">Voir tout</a>
        </div>

        <!-- Grille de produits (Nouveautés depuis la BDD) -->
        <div class="products-grid">
            @php
                // Helper URL d'image (local/prod)
$toUrl = function ($v) {
    if (!$v) {
        return '';
    }
    $v = preg_replace('#^https?://(127\.0\.0\.1(:\d+)?|localhost(:\d+)?)#i', '', $v ?? '');
    if (preg_match('#^(https?://|data:)#i', $v)) {
        return $v;
    }
    if (strpos($v, '/storage/') === 0) {
        return $v;
    }
    return \Illuminate\Support\Facades\Storage::url(ltrim($v, '/'));
                };
            @endphp

            @forelse(($latest ?? collect())->take(5) as $p)
                @php
                    $imgs = is_array($p->images) ? $p->images : (json_decode($p->images ?? '[]', true) ?: []);
                    $img = !empty($imgs[0]) ? $toUrl($imgs[0]) : 'https://via.placeholder.com/400x300?text=Image';
                    $hasPromo = !is_null($p->discount_price ?? null);
                    $priceDisplay = $hasPromo ? $p->discount_price : $p->price;
                @endphp

                <div class="product-card card" data-id="{{ $p->id }}">
                    <div class="product-img-wrapper" style="position: relative;">
                        <img src="{{ $img }}" alt="{{ $p->name }}" class="product-img"
                            loading="lazy">

                        <!-- ❤️ Coeur de like -->
                        <button class="like-btn" aria-label="Ajouter {{ $p->name }} aux favoris"
                            style="
                            position:absolute;top:10px;right:10px;background:#fff;border:none;border-radius:50%;
                            width:36px;height:36px;box-shadow:0 2px 8px rgba(0,0,0,.1);cursor:pointer;">
                            <i class="far fa-heart"></i>
                        </button>

                        <!-- Badge promo / vedette -->
                        @if ($hasPromo)
                            <span class="product-badge">
                                -{{ number_format((1 - $p->discount_price / $p->price) * 100, 0) }}%
                            </span>
                        @elseif(!empty($p->is_featured))
                            <span class="product-badge">Vedette</span>
                        @endif
                    </div>

                    <div class="product-info">
                        <div class="product-header"
                            style="display:flex;justify-content:space-between;align-items:center;gap:10px;">
                            <h3 class="product-title" style="margin:0;font-size:1rem;flex:1;">
                                {{ $p->name }}
                            </h3>
                            <div class="product-price" style="white-space:nowrap;">
                                <span class="price-now" style="color:#595959;font-weight:100;">
                                    {{ number_format($priceDisplay, 0, ',', ' ') }} {{ $p->currency ?? 'FCFA' }}
                                </span>
                                @if ($hasPromo)
                                    <span class="old-price"
                                        style="text-decoration:line-through;color:#888;margin-left:6px;">
                                        {{ number_format($p->price, 0, ',', ' ') }} {{ $p->currency ?? 'FCFA' }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="product-actions" style="margin-top:0px;">
                            <button class="btn-add-to-cart add-to-cart" type="button" data-id="{{ $p->id }}"
                                data-name="{{ $p->name }}"

                                data-image="{{ $img }}"
                                data-currency="{{ $p->currency ?? 'FCFA' }}"
                                >
                                <i class="fas fa-cart-plus"></i> Ajouter
                            </button>

                            <a href="{{ route('products.show', $p->id) }}" class="view-details">Détails</a>
                        </div>

                    </div>

                </div>
            @empty
                <p>Aucune nouveauté pour le moment.</p>
            @endforelse
        </div>

    </div>
    <script>
        (function() {
            const CART_KEY = "cart";
            let cart = JSON.parse(localStorage.getItem(CART_KEY) || "[]");
            const euro = n => `€${Number(n).toFixed(2)}`;
            const money = (n, cur) => `${Number(n).toFixed(2)} ${cur || ''}`.trim();
            const saveCart = () => localStorage.setItem(CART_KEY, JSON.stringify(cart));

            const cartLink = document.getElementById("cart-link");
            const cartCountEl = cartLink ? cartLink.querySelector(".cart-count") : null;

            function updateCartCount() {
                if (!cartCountEl) return;
                cartCountEl.textContent = cart.reduce((t, i) => t + i.quantity, 0);
            }

            // ✅ Écoute .btn-add-to-cart ET .add-to-cart
            document.querySelectorAll(".btn-add-to-cart, .add-to-cart").forEach(btn => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name") || "Produit";
                    const img = btn.getAttribute("data-image") || "";
                    const cur = btn.getAttribute("data-currency") || "FCFA";

                    // data-price doit déjà être un nombre (on l’a mis en Blade)
                    let price = parseFloat(btn.getAttribute("data-price") || "0");
                    if (Number.isNaN(price)) price = 0;

                    const existing = cart.find(i => String(i.id) === String(id));
                    if (existing) {
                        existing.quantity += 1;
                    } else {
                        cart.push({
                            id,
                            name,
                            price,
                            currency: cur,
                            image: img,
                            quantity: 1
                        });
                    }
                    saveCart();
                    updateCartCount();

                    // petit feedback
                    if (window.showToast) {
                        showToast(`${name} ajouté au panier`);
                    } else {
                        alert(`${name} a été ajouté à votre panier !`);
                    }
                });
            });

            // (optionnel) si tu as déjà le code du modal/checkout, garde-le tel quel
            updateCartCount();
        })();
    </script>

    <!-- Cart Modal -->
    <div class="cart-modal" id="cart-modal">
        <div class="cart-header">
            <h2>Votre Panier</h2>
            <button class="close-cart" id="close-cart">&times;</button>
        </div>

        <div class="cart-items">
            <!-- Cart items will be added here dynamically -->
        </div>

        <div class="cart-summary">
            <div class="summary-row">
                <span>Sous-total</span>
                <span id="cart-subtotal">0 €</span>
            </div>
            <div class="summary-row">
                <span>Livraison</span>
                <span>49 €</span>
            </div>
            <div class="summary-row summary-total">
                <span>Total</span>
                <span id="cart-total">0 €</span>
            </div>
        </div>

        <button class="checkout-btn">Procéder au Paiement</button>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <script>
        // Cart functionality
        const cart = [];
        const cartIcon = document.getElementById('cart-icon');
        const cartModal = document.getElementById('cart-modal');
        const closeCart = document.getElementById('close-cart');
        const overlay = document.getElementById('overlay');
        const cartItems = document.querySelector('.cart-items');
        const cartSubtotal = document.getElementById('cart-subtotal');
        const cartTotal = document.getElementById('cart-total');
        const cartCount = document.querySelector('.cart-count');

        // Add to cart buttons
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const price = parseFloat(button.getAttribute('data-price'));
                const img = button.getAttribute('data-img');

                // Check if product already in cart
                const existingItem = cart.find(item => item.id === id);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        img,
                        quantity: 1
                    });
                }

                updateCart();
                alert('Produit ajouté au panier!');
            });
        });

        // Open cart
        cartIcon.addEventListener('click', () => {
            cartModal.style.display = 'block';
            overlay.style.display = 'block';
        });

        // Close cart
        closeCart.addEventListener('click', () => {
            cartModal.style.display = 'none';
            overlay.style.display = 'none';
        });

        // Close cart when clicking on overlay
        overlay.addEventListener('click', () => {
            cartModal.style.display = 'none';
            overlay.style.display = 'none';
        });

        // Update cart
        function updateCart() {
            // Clear cart items
            cartItems.innerHTML = '';

            let total = 0;
            let itemCount = 0;

            // Add items to cart
            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                total += itemTotal;
                itemCount += item.quantity;

                const cartItem = document.createElement('div');
                cartItem.className = 'cart-item';
                cartItem.innerHTML = `
                    <img src="${item.img}" alt="${item.name}" class="cart-item-img">
                    <div class="cart-item-info">
                        <div class="cart-item-title">${item.name}</div>
                        <div class="cart-item-price">${item.price} €</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn decrease" data-id="${item.id}">-</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-id="${item.id}">
                            <button class="quantity-btn increase" data-id="${item.id}">+</button>
                            <button class="remove-item" data-id="${item.id}"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `;

                cartItems.appendChild(cartItem);
            });

            // Update totals
            cartSubtotal.textContent = `${total} €`;
            cartTotal.textContent = `${total + 49} €`;
            cartCount.textContent = itemCount;

            // Add event listeners to quantity buttons
            const decreaseButtons = document.querySelectorAll('.decrease');
            const increaseButtons = document.querySelectorAll('.increase');
            const removeButtons =
    </script>

    <!-- Bande d'avantages e-commerce -->
    <script>
        document.querySelectorAll('.like-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                this.classList.toggle('liked');
                const icon = this.querySelector('i');

                if (this.classList.contains('liked')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas'); // cœur plein
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far'); // cœur vide
                }
            });
        });
    </script>




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
    <script>
        (function() {
            const root = document.getElementById('heroSlider');
            const slides = Array.from(root.querySelectorAll('.slide'));
            const dotsWrap = document.getElementById('sliderDots');

            if (!slides.length) return;

            // Create dots
            slides.forEach((_, i) => {
                const d = document.createElement('div');
                d.className = 'dot' + (i === 0 ? ' active' : '');
                d.dataset.index = i;
                d.addEventListener('click', () => go(i, true));
                dotsWrap.appendChild(d);
            });
            const dots = Array.from(dotsWrap.children);

            let i = 0;
            let timer = null;
            const DURATION = 2000; // 2s

            function setActive(idx) {
                slides.forEach((s, k) => s.classList.toggle('active', k === idx));
                dots.forEach((d, k) => d.classList.toggle('active', k === idx));
            }

            function next() {
                i = (i + 1) % slides.length;
                setActive(i);
            }

            function go(idx, reset = false) {
                i = idx % slides.length;
                setActive(i);
                if (reset) restart();
            }

            function start() {
                timer = setInterval(next, DURATION);
            }

            function stop() {
                clearInterval(timer);
                timer = null;
            }

            function restart() {
                stop();
                start();
            }

            // Pause on hover (optionnel mais sympa)
            root.addEventListener('mouseenter', stop);
            root.addEventListener('mouseleave', start);
            // Pause quand l’onglet est caché
            document.addEventListener('visibilitychange', () => {
                document.hidden ? stop() : start();
            });

            // Init
            setActive(0);
            start();
        })();
    </script>

</body>

</html>
