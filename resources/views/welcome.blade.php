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

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

    <!-- Styles locaux -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonts et icônes externes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>


<body>
    <!-- Header -->

    @include('partials.header')

    <!-- Hero Section -->
    <section class="hero">
        <!-- Conteneur YouTube optimisé -->
        <div class="youtube-container">
            <iframe
                src="https://www.youtube.com/embed/kOTx437PvOQ?autoplay=1&mute=1&loop=1&playlist=kOTx437PvOQ&controls=0&modestbranding=1&rel=0&enablejsapi=1"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen loading="lazy"
                title="Présentation Keluvato - Décoration & Meubles d'Exception"></iframe>
        </div>

        <!-- Overlay semi-transparent -->
        <div class="hero-overlay"></div>

        <!-- Contenu texte -->
        <div class="hero-content">
            <h1 data-i18n="hero_title">Décoration & Meubles d'Exception</h1>
            <p data-i18n="hero_description">
                Découvrez notre collection exclusive de meubles et accessoires pour
                votre intérieur et extérieur
            </p>
            <a href="decouvrir.html" class="btn btn-primary" data-i18n="hero_btn">
                Découvrir la collection
            </a>
        </div>
    </section>


    <div class="container">
        <h2 class="section-title"></h2>

        <!-- 1) Catégories = BOUTONS (pas d'images) -->
        <div id="categoriesContainer">
            <div id="categoriesGrid"
                style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
                <!-- rempli en JS -->
            </div>
        </div>

        <!-- 2) Résultats : SOUS-CATÉGORIES + PRODUITS (avec images) -->
        <div id="resultsView" style="display:none; margin-top:18px;">
            <div
                style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; flex-wrap:wrap; gap:10px;">
                <h2 class="section-title" id="resultsTitle" style="margin:0; flex-grow:1;"></h2>
                <button id="backBtn"
                    style="border:1px solid #ddd; background:#fff; border-radius:8px; padding:8px 12px; cursor:pointer; font-size:14px; color:#444;">
                    ← Retour aux catégories
                </button>
            </div>
            <div id="resultsWrapper" style="display:flex; flex-direction:column; gap:22px;">
                <!-- sections sous-catégories + produits -->
            </div>
        </div>

        <!-- 3) Page produit (détail) -->
        <div id="pageView" style="display:none; margin-top:18px;"></div>
    </div>




    <!-- Modern Coupon Section with Angled Cards -->
    <div class="container" style="position: relative; margin: 80px auto; padding: 40px 0">
        <div class="angled-feature-container"
            style="
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 30px;
          flex-wrap: wrap;
        ">
            <!-- Left Angled Card - Camera Feature -->
            <div class="angled-card left-tilt"
                style="
            width: 280px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: rotate(-5deg);
            transition: all 0.4s ease;
          ">
                <div class="icon-circle"
                    style="
              width: 70px;
              height: 70px;
              background: linear-gradient(135deg, #4a6bff, #6b8cff);
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              margin: 0 auto 20px;
            ">
                    <i class="fas fa-camera" style="font-size: 28px; color: white"></i>
                </div>
                <h3 style="text-align: center; margin-bottom: 15px; color: #292f36">
                    Mesure 3D Intelligente
                </h3>
                <p style="text-align: center; color: #666; line-height: 1.5">
                    Prenez la mesure de votre espace puis partager avec nous
                </p>
            </div>

            <!-- Central Coupon Card -->
            <div class="coupon-section"
                style="
            z-index: 2;
            width: 320px;
            background: linear-gradient(135deg, #4a6bff, #4ecdc4);
            color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(74, 107, 255, 0.3);
            text-align: center;
          ">
                <h2 style="margin-bottom: 15px; font-size: 1.8rem">
                    CODE PROMO EXCLUSIF
                </h2>
                <p style="margin-bottom: 10px; font-size: 1.1rem">
                    Profitez de 15% de réduction
                </p>
                <div class="coupon-code"
                    style="
              background: white;
              color: #4a6bff;
              padding: 12px;
              border-radius: 6px;
              font-weight: 700;
              font-size: 1.5rem;
              margin: 20px auto;
              display: inline-block;
              min-width: 180px;
            ">
                    KELU15
                </div>
                <p style="font-size: 0.9rem; opacity: 0.9">
                    Valable jusqu'au 30/12/2023
                </p>
            </div>

            <!-- Right Angled Card - Loyalty Points -->
            <div class="angled-card right-tilt"
                style="
            width: 280px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transform: rotate(5deg);
            transition: all 0.4s ease;
          ">
                <div class="icon-circle"
                    style="
              width: 70px;
              height: 70px;
              background: linear-gradient(135deg, #4ecdc4, #6ad9d1);
              border-radius: 50%;
              display: flex;
              align-items: center;
              justify-content: center;
              margin: 0 auto 20px;
            ">
                    <i class="fas fa-gift" style="font-size: 28px; color: white"></i>
                </div>
                <h3 style="text-align: center; margin-bottom: 15px; color: #292f36">
                    Points Fidélité
                </h3>
                <p style="text-align: center; color: #666; line-height: 1.5">
                    Cumulez des points à chaque achat et bénéficiez d'avantages
                    exclusifs et de réductions spéciales.
                </p>
            </div>
        </div>
    </div>




    <!-- Featured Products -->
    <div class="container">
        <h2 class="section-title">Nos Nouveautés</h2>

        <div class="products">
            <div class="product-card">
                <div class="product-img"
                    style="
              background-image: url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');
            ">
                    <button class="like-btn"><i class="far fa-heart"></i></button>
                    <span class="product-badge">Nouveau</span>
                </div>
                <div class="product-info">
                    <h3>Canapé en velours bleu</h3>

                    <div class="product-price">
                        <span class="price-now" data-price="245.00" data-currency="EUR"></span>
                        &nbsp;<span class="old-price" data-price="999.99" data-currency="EUR"></span>
                    </div>

                    <button class="btn-add-to-cart" data-id="1" data-name="Canapé en velours bleu"
                        data-price="799.99" data-currency="EUR">
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img"
                    style="
              background-image: url('https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');
            ">
                    <button class="like-btn"><i class="far fa-heart"></i></button>
                    <span class="product-badge">-30%</span>
                </div>
                <div class="product-info">
                    <h3>Table basse en chêne</h3>

                    <div class="product-price">
                        <span class="price-now" data-price="249.99" data-currency="EUR"></span>
                        &nbsp;<span class="old-price" data-price="349.99" data-currency="EUR"></span>
                    </div>

                    <button class="btn-add-to-cart" data-id="2" data-name="Table basse en chêne"
                        data-price="249.99" data-currency="EUR">
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <div class="product-card">
                <div class="product-img"
                    style="
              background-image: url('https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');
            ">
                    <button class="like-btn"><i class="far fa-heart"></i></button>
                </div>
                <div class="product-info">
                    <h3>Lampe design</h3>
                    <div class="product-price">
                        <span class="price-now" data-price="248.99" data-currency="EUR"></span>
                        &nbsp;<span class="old-price" data-price="349.99" data-currency="EUR"></span>
                    </div>
                    <button class="btn-add-to-cart" data-id="3" data-name="Lampe design" data-price="129.99"
                        data-currency="EUR">
                        Ajouter au panier
                    </button>
                </div>
            </div>

            <!--  <div class="product-card">
                <div class="product-img" style="background-image: url('https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80');">
                    <button class="like-btn"><i class="far fa-heart"></i></button>
                    <span class="product-badge">Bestseller</span>
                </div>
                <div class="product-info">
                    <h3>Perceuse sans fil</h3>
                    <div class="product-price">€89.99</div>
                    <button class="btn-add-to-cart" data-id="4" data-name="Perceuse sans fil" data-price="89.99">Ajouter au panier</button>
                </div>
            </div> -->
        </div>
    </div>
    <!-- Full-width Advertisement Section -->
    <section class="full-width-ad"
        style="
        margin: 60px 0;
        padding: 80px 20px;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
          url('https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        text-align: center;
        position: relative;
      ">
        <div class="container"
            style="
          position: relative;
          z-index: 2;
          max-width: 1200px;
          margin: 0 auto;
        ">
            <h2
                style="
            font-size: 2.2rem;
            margin-bottom: 15px;
            font-weight: 600;
            animation: fadeInUp 1s ease-out;
          ">
                INSTALLEZ-VOUS CONFORTABLEMENT
            </h2>

            <h3
                style="
            font-size: 1.8rem;
            margin-bottom: 20px;
            font-weight: 400;
            animation: fadeInUp 1s ease-out 0.2s;
          ">
                Canapé design
            </h3>

            <div
                style="
            height: 2px;
            width: 100px;
            background: var(--primary);
            margin: 20px auto;
            animation: zoomIn 1s ease-out 0.4s;
          ">
            </div>

            <p
                style="
            font-size: 1.2rem;
            margin-bottom: 30px;
            animation: fadeInUp 1s ease-out 0.6s;
          ">
                à partir de 149 000 FCFA
            </p>

            <a href="#" class="btn-ad"
                style="
            display: inline-block;
            padding: 12px 30px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            transition: all 0.3s;
            animation: fadeIn 1s ease-out 0.8s;
          ">
                J'EN PROFITE
                <i class="fas fa-arrow-right" style="margin-left: 8px"></i>
            </a>
        </div>
    </section>

    <section class="blog-section">
        <div class="container">
            <h2 class="section-title">Articles populaires</h2>

            <div class="blog-posts">
                <!-- Blog Card 1 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Fauteuil design</h3>
                        <div class="blog-price">49 000 FCFA</div>
                    </div>
                </div>
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Fauteuil design</h3>
                        <div class="blog-price">49 000 FCFA</div>
                    </div>
                </div>

                <!-- Blog Card 2 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1524758631624-e2822e304c36?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Lampe moderne</h3>
                        <div class="blog-price">12 500 FCFA</div>
                    </div>
                </div>

                <!-- Blog Card 3 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1519710164239-da123dc03ef4?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Table basse bois</h3>
                        <div class="blog-price">35 000 FCFA</div>
                    </div>
                </div>

                <!-- Blog Card 4 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1523413651479-597eb2da0ad6?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Plante décorative</h3>
                        <div class="blog-price">8 000 FCFA</div>
                    </div>
                </div>

                <!-- Blog Card 5 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Chaise scandinave</h3>
                        <div class="blog-price">18 000 FCFA</div>
                    </div>
                </div>

                <!-- Blog Card 6 -->
                <div class="blog-card">
                    <a href="product-details.html">
                        <div class="blog-img"
                            style="
                  background-image: url('https://images.unsplash.com/photo-1540518614846-7eded433c457?auto=format&fit=crop&w=600&q=80');
                ">
                        </div>
                    </a>
                    <div class="blog-content">
                        <h3>Horloge murale</h3>
                        <div class="blog-price">6 500 FCFA</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter"
        style="
        padding: 5rem 0;
        margin: 4rem 0;
        position: relative;
        overflow: hidden;
      ">
        <div class="container"
            style="
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 20px;
          position: relative;
          z-index: 2;
        ">
            <div
                style="
            background: rgba(255, 255, 255, 0.1);
            background: linear-gradient(135deg, #4a6bff 0%, #3a1c71 100%);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
          ">
                <h2
                    style="
              color: white;
              font-size: 2.5rem;
              margin-bottom: 1rem;
              font-weight: 700;
              text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
              font-family: 'Montserrat', sans-serif;
            ">
                    Ne manquez aucune offre exceptionnelle !
                </h2>
                <p
                    style="
              color: rgba(255, 255, 255, 0.9);
              font-size: 1.2rem;
              max-width: 600px;
              margin: 0 auto 2rem;
              font-family: 'Montserrat', sans-serif;
            ">
                    Rejoignez notre communauté et bénéficiez de
                    <span style="font-weight: bold; color: #fff">10% de réduction</span>
                    immédiate + des surprises exclusives chaque semaine !
                </p>

                <form class="newsletter-form" style="display: flex; max-width: 500px; margin: 0 auto; gap: 10px">
                    <input type="email" placeholder="Votre adresse email" required
                        style="
                flex: 1;
                padding: 15px 20px;
                border: none;
                border-radius: 50px;
                font-size: 1rem;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                font-family: 'Montserrat', sans-serif;
              " />
                    <button type="submit"
                        style="
                background: linear-gradient(to right, #4a6bff, #4ecdc4);
                color: white;
                border: none;
                padding: 0 30px;
                border-radius: 50px;
                font-weight: bold;
                cursor: pointer;
                transition: all 0.3s;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                font-size: 1rem;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-family: 'Montserrat', sans-serif;
              ">
                        Je profite des offres
                    </button>
                </form>

                <p
                    style="
              color: rgba(255, 255, 255, 0.7);
              font-size: 0.8rem;
              margin-top: 1.5rem;
              font-family: 'Montserrat', sans-serif;
            ">
                    * Nous détestons le spam autant que vous. Désabonnez-vous à tout
                    moment.
                </p>
            </div>
        </div>

        <!-- Éléments décoratifs modifiés -->
        <div
            style="
          position: absolute;
          top: -50px;
          right: -50px;
          width: 200px;
          height: 200px;
          background: rgba(74, 107, 255, 0.1);
          border-radius: 50%;
        ">
        </div>
        <div
            style="
          position: absolute;
          bottom: -80px;
          left: -80px;
          width: 250px;
          height: 250px;
          background: rgba(78, 205, 196, 0.08);
          border-radius: 50%;
        ">
        </div>
    </section>


    <!-- Floating Buttons -->
    <!-- Floating Buttons -->
    <div class="floating-buttons">
        <button id="arMeasureBtn" class="floating-btn"
            style="background: linear-gradient(to right, #4a6bff, #6b8cff)" title="Mesurer votre espace">
            <i class="fas fa-ruler-combined text-xl"></i>
        </button>

        <button class="floating-btn" style="background: linear-gradient(to right, #4ecdc4, #6ad9d1)"
            title="Cagnotte commune">
            <i class="fas fa-gift text-xl"></i>
        </button>
        <!-- Chat button -->
        <button id="chatBtn" class="floating-btn" style="background: linear-gradient(to right, #038a40, #037c1d)"
            title="Chat en direct">
            <i class="fas fa-comments text-xl"></i>
        </button>
    </div>

    <!-- Chat Modal -->
    <div id="chatModal" class="chat-modal">
        <div class="chat-header">
            Assistant Virtuel
            <span id="closeChat" class="close-btn">&times;</span>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="chat-message bot">
                Bonjour ! Comment puis-je vous aider ?
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Écrivez votre message..." />
            <button id="sendBtn">Envoyer</button>
        </div>
    </div>

    <!-- 2. AJOUTEZ CES DIVs DANS VOTRE <BODY> (après vos boutons flottants) -->
    <div id="arContainer" class="hidden">
        <video id="videoStream" autoplay muted playsinline></video>

        <div class="ar-overlay" id="arOverlay">
            <div class="crosshair"></div>
        </div>

        <div class="measurement-info">
            <h3 style="margin-bottom: 15px; color: #4a6bff">
                <i class="fas fa-ruler"></i> Mesures
            </h3>
            <div class="info-item">
                <span>Points placés:</span>
                <span id="pointCount">0</span>
            </div>
            <div class="info-item">
                <span>Dernière mesure:</span>
                <span id="lastMeasurement">-</span>
            </div>
            <div class="info-item">
                <span>Total mesures:</span>
                <span id="totalMeasurements">0</span>
            </div>
            <div id="instructionText"
                style="
            margin-top: 15px;
            padding: 10px;
            background: rgba(74, 107, 255, 0.1);
            border-radius: 8px;
            font-size: 12px;
            color: #4a6bff;
          ">
                📍 Cliquez sur le premier coin, puis sur le second pour mesurer la
                distance
            </div>
        </div>

        <div class="controls-panel">
            <button class="control-btn primary" id="addPointBtn">
                <i class="fas fa-plus"></i>
                Ajouter Point
            </button>
            <button class="control-btn secondary" id="clearBtn">
                <i class="fas fa-trash"></i>
                Effacer
            </button>
            <button class="control-btn" id="switchCameraBtn"
                style="background: linear-gradient(135deg, #ff9f43, #feca57)">
                <i class="fas fa-sync-alt"></i>
                Changer Caméra
            </button>
            <button class="control-btn success" id="sendMeasurementsBtn">
                <i class="fas fa-paper-plane"></i>
                Envoyer
            </button>
            <button class="control-btn" id="closeArBtn" style="background: #636e72">
                <i class="fas fa-times"></i>
                Fermer
            </button>
        </div>
    </div>

    <div id="statusIndicator" class="status-indicator hidden">
        <div class="loading-spinner"></div>
        <div id="statusText">Initialisation de la caméra...</div>
    </div>


    <script>
        // Menus User & Aide — version simple et robuste
        (function() {
            const userToggle = document.getElementById("userToggle");
            const dropdownUser = document.getElementById("dropdownUser");
            const helpToggle = document.getElementById("helpToggle");
            const dropdownHelp = document.getElementById("dropdownHelp");

            function toggle(el) {
                if (!el) return;
                el.style.display = el.style.display === "block" ? "none" : "block";
            }

            function hideAll() {
                [dropdownUser, dropdownHelp].forEach((d) => {
                    if (d) d.style.display = "none";
                });
            }

            if (userToggle && dropdownUser) {
                userToggle.addEventListener("click", (e) => {
                    e.stopPropagation();
                    hideAll();
                    toggle(dropdownUser);
                });
            }
            if (helpToggle && dropdownHelp) {
                helpToggle.addEventListener("click", (e) => {
                    e.stopPropagation();
                    hideAll();
                    toggle(dropdownHelp);
                });
            }

            document.addEventListener("click", hideAll);
        })();
    </script>



    <script>
        (function() {
            const input = document.getElementById('searchInput');
            const btn = document.getElementById('searchBtn');
            const dd = document.getElementById('searchDropdown');

            let cursor = -1; // index sélection clavier
            let items = []; // cache items affichés
            let lastQ = '';
            const DEBOUNCE_MS = 180;

            // util: debounce
            const debounce = (fn, ms) => {
                let t;
                return (...args) => {
                    clearTimeout(t);
                    t = setTimeout(() => fn(...args), ms);
                };
            };

            // util: première image
            const firstImage = (images) => {
                if (!images) return '';
                if (Array.isArray(images) && images[0]) return images[0];
                if (typeof images === 'string') {
                    try {
                        const arr = JSON.parse(images);
                        if (Array.isArray(arr) && arr[0]) return arr[0];
                    } catch (e) {}
                }
                return '';
            };

            // rendu dropdown
            function render(q, data) {
                items = data || [];
                cursor = -1;

                if (!q || !items.length) {
                    dd.innerHTML = q ? `
      <div class="search-empty">Aucun résultat pour “${escapeHtml(q)}”.</div>` : '';
                    dd.style.display = q ? 'block' : 'none';
                    if (q) dd.innerHTML += footer(q, 0);
                    return;
                }

                const html = [
                    ...items.map((p, i) => {
                        const img = firstImage(p.images) || 'https://via.placeholder.com/80x80?text=—';
                        const price = (p.price != null) ? `${Number(p.price).toFixed(2)} ${p.currency || ''}` :
                            '';
                        return `
          <div class="search-item" data-index="${i}" data-id="${p.id}">
            <img class="search-thumb" src="${img}" alt="">
            <div>
              <div class="search-title">${escapeHtml(p.name)}</div>
              <div class="search-price">${escapeHtml(price)}</div>
            </div>
          </div>
        `;
                    })
                ].join('');

                dd.innerHTML = html + footer(q, items.length);
                dd.style.display = 'block';

                // Bind click
                dd.querySelectorAll('.search-item').forEach(el => {
                    el.addEventListener('click', () => {
                        const id = el.getAttribute('data-id');
                        goToProduct(id);
                    });
                });

                // “Voir tous les résultats”
                const allLink = dd.querySelector('#searchSeeAll');
                if (allLink) allLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    goToResults(q);
                });
            }

            //function footer(q, count) {
            // return `
        //  <div class="search-footer">
        //   <span>${count} résultat${count>1?'s':''}</span>
        //  <a href="#" id="searchSeeAll">Voir tous les résultats pour “${escapeHtml(q)}”</a>
        // </div>
        //`;
            //}

            // sécurité HTML
            function escapeHtml(s) {
                return String(s).replace(/[&<>"']/g, m => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [m]));
            }

            // navigation
            function goToProduct(id) {
                if (!id) return;
                window.location.href = `product.html?id=${encodeURIComponent(id)}`;
            }

            function goToResults(q) {
                // page résultats de ton choix
                window.location.href = `recherche.html?q=${encodeURIComponent(q)}`;
            }

            // fetch suggestions
            const doSearch = debounce(async (q) => {
                q = q.trim();
                lastQ = q;
                if (!q) {
                    dd.style.display = 'none';
                    dd.innerHTML = '';
                    return;
                }

                try {
                    const res = await fetch(`${apiBase}/search?q=${encodeURIComponent(q)}`, {
                        headers: {
                            Accept: 'application/json'
                        }
                    });
                    const data = await res.json();
                    // si l’utilisateur a déjà tapé autre chose, on ignore
                    if (q !== lastQ) return;
                    render(q, Array.isArray(data) ? data : []);
                } catch (e) {
                    console.error(e);
                    render(q, []);
                }
            }, DEBOUNCE_MS);

            // events
            input.addEventListener('input', (e) => doSearch(e.target.value));
            input.addEventListener('focus', () => {
                if (input.value.trim()) doSearch(input.value);
            });

            // bouton loupe = page résultats complète
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const q = input.value.trim();
                if (!q) return;
                goToResults(q);
            });

            // clavier: Entrée / Échap / ↑ / ↓
            input.addEventListener('keydown', (e) => {
                if (dd.style.display !== 'block') return;
                const max = items.length - 1;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    cursor = (cursor < max) ? cursor + 1 : 0;
                    updateActive();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    cursor = (cursor > 0) ? cursor - 1 : max;
                    updateActive();
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (cursor >= 0 && items[cursor]) goToProduct(items[cursor].id);
                    else if (input.value.trim()) goToResults(input.value.trim());
                } else if (e.key === 'Escape') {
                    dd.style.display = 'none';
                }
            });

            function updateActive() {
                dd.querySelectorAll('.search-item').forEach((el, i) => {
                    if (i === cursor) {
                        el.classList.add('active');
                        el.scrollIntoView({
                            block: 'nearest'
                        });
                    } else {
                        el.classList.remove('active');
                    }
                });
            }

            // fermer si clic dehors
            document.addEventListener('click', (e) => {
                if (!dd.contains(e.target) && e.target !== input) {
                    dd.style.display = 'none';
                }
            });
        })();
    </script>



    <script>
        (function() {
            const CART_KEY = "cart";
            let cart = JSON.parse(localStorage.getItem(CART_KEY) || "[]");

            // DOM
            const cartLink = document.getElementById("cart-link");
            const cartCountEl = cartLink ?
                cartLink.querySelector(".cart-count") :
                null;
            const checkoutModal = document.getElementById("checkout-modal");
            const closeModal = checkoutModal ?
                checkoutModal.querySelector(".close-modal") :
                null;
            const cartItemsContainer = document.getElementById("cart-items");
            const subtotalElement = document.getElementById("subtotal");
            const totalElement = document.getElementById("total");

            // Utils
            const euro = (n) => `€${Number(n).toFixed(2)}`;
            const saveCart = () =>
                localStorage.setItem(CART_KEY, JSON.stringify(cart));

            function updateCartCount() {
                if (!cartCountEl) return;
                const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
                cartCountEl.textContent = totalItems;
            }

            function updateCartDisplay() {
                if (!cartItemsContainer || !subtotalElement || !totalElement) return;

                cartItemsContainer.innerHTML = "";
                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = "<p>Votre panier est vide.</p>";
                    subtotalElement.textContent = euro(0);
                    totalElement.textContent = euro(0);
                    return;
                }

                let subtotal = 0;
                cart.forEach((item) => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;

                    const row = document.createElement("div");
                    row.className = "summary-item";
                    row.innerHTML = `<span>${item.name} x${item.quantity
                        }</span><span>${euro(itemTotal)}</span>`;
                    cartItemsContainer.appendChild(row);
                });

                subtotalElement.textContent = euro(subtotal);
                totalElement.textContent = euro(subtotal);
            }

            // Ajouter au panier
            document.querySelectorAll(".btn-add-to-cart").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name");
                    const price = parseFloat(btn.getAttribute("data-price") || "0");

                    const existing = cart.find((i) => i.id === id);
                    if (existing) existing.quantity += 1;
                    else cart.push({
                        id,
                        name,
                        price,
                        quantity: 1
                    });

                    saveCart();
                    updateCartCount();
                    alert(`${name} a été ajouté à votre panier !`);
                });
            });

            // Clic sur l'icône Panier
            if (cartLink) {
                cartLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    const userToken = localStorage.getItem("userToken");

                    // Non connecté → login
                    if (!userToken) {
                        window.location.href = "{{ route('login') }}";
                        return;
                    }

                    // Connecté → modal si présent, sinon page panier
                    if (checkoutModal) {
                        updateCartDisplay();
                        checkoutModal.style.display = "block";
                    } else {
                        window.location.href = "checkout.html";
                    }
                });
            }

            // Fermeture du modal
            if (closeModal && checkoutModal) {
                closeModal.addEventListener(
                    "click",
                    () => (checkoutModal.style.display = "none")
                );
                window.addEventListener("click", (e) => {
                    if (e.target === checkoutModal)
                        checkoutModal.style.display = "none";
                });
            }

            // Init compteur
            updateCartCount();
        })();
    </script>

    <script src="js/app-auth.js" defer></script>

    <!-- À placer juste avant </body> pour optimiser le chargement -->
    <script src="js/main.js"></script>

    <script src="js/cart-core.js" defer></script>

    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement("script");
                    d.innerHTML =
                        "window.__CF$cv$params={r:'95b1de7461e0b7a5',t:'MTc1MTgzMzkyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName("head")[0].appendChild(d);
                }
            }
            if (document.body) {
                var a = document.createElement("iframe");
                a.height = 1;
                a.width = 1;
                a.style.position = "absolute";
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = "none";
                a.style.visibility = "hidden";
                document.body.appendChild(a);
                if ("loading" !== document.readyState) c();
                else if (window.addEventListener)
                    document.addEventListener("DOMContentLoaded", c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        "loading" !== document.readyState &&
                            ((document.onreadystatechange = e), c());
                    };
                }
            }
        })();








        // Script pour gérer l'affichage mobile
        document.addEventListener("DOMContentLoaded", function() {
            // Gestion du menu burger
            const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
            const mobileMenuModal = document.getElementById("mobileMenuModal");
            const closeMobileMenu = document.getElementById("closeMobileMenu");

            if (mobileMenuToggle && mobileMenuModal) {
                mobileMenuToggle.addEventListener("click", function() {
                    mobileMenuModal.style.display = "block";
                    document.body.style.overflow = "hidden";
                });
            }

            if (closeMobileMenu && mobileMenuModal) {
                closeMobileMenu.addEventListener("click", function() {
                    mobileMenuModal.style.display = "none";
                    document.body.style.overflow = "auto";
                });
            }

            // Fermer le modal si on clique en dehors
            mobileMenuModal.addEventListener("click", function(e) {
                if (e.target === mobileMenuModal) {
                    mobileMenuModal.style.display = "none";
                    document.body.style.overflow = "auto";
                }
            });

            // Gestion des menus déroulants desktop
            const toggleButtons = document.querySelectorAll('[id$="Toggle"]');
            toggleButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.stopPropagation();
                    const dropdownId = this.id.replace("Toggle", "");
                    const dropdown = document.getElementById(dropdownId);
                    const isVisible = dropdown.style.display === "block";

                    // Fermer tous les autres menus
                    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                        if (menu.id !== dropdownId) {
                            menu.style.display = "none";
                        }
                    });

                    // Basculer l'affichage du menu courant
                    dropdown.style.display = isVisible ? "none" : "block";
                });
            });

            // Fermer les menus déroulants quand on clique ailleurs
            document.addEventListener("click", function() {
                document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                    menu.style.display = "none";
                });
            });

            // Empêcher la fermeture quand on clique dans le menu
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.addEventListener("click", function(e) {
                    e.stopPropagation();
                });
            });

            // Fonction pour changer la langue
            window.changeLanguage = function(lang) {
                console.log("Changement de langue vers:", lang);
                // Ici vous ajouteriez la logique pour changer la langue
                document.querySelectorAll(".language-code").forEach((el) => {
                    el.textContent = lang.toUpperCase();
                });
                document.getElementById("mobileMenuModal").style.display = "none";
                document.body.style.overflow = "auto";
            };
        });












        let lastScrollTop = 0;
        const header = document.getElementById("mainHeader");

        window.addEventListener("scroll", function() {
            const scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // On descend → cacher le header
                header.style.top = "-150px"; // adapte cette valeur à la hauteur de ton header
            } else {
                // On remonte → afficher le header
                header.style.top = "0";
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // pour éviter valeurs négatives
        });


















        // Chargement différé pour améliorer les performances
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector(".youtube-container iframe");
            iframe.setAttribute("src", iframe.getAttribute("src"));
        });





        // Liste complète des pays (exemple partiel)
        const countrie = [{
                code: "FR",
                name: "France",
                currency: "EUR",
                symbol: "€",
                flag: "fr",
            },
            {
                code: "DE",
                name: "Allemagne",
                currency: "EUR",
                symbol: "€",
                flag: "de",
            },
            {
                code: "US",
                name: "États-Unis",
                currency: "USD",
                symbol: "$",
                flag: "us",
            },
            // ... autres pays ...
        ];

        // Dictionnaire de traduction
        const translations = {
            fr: {
                search_placeholder: "Rechercher des meubles, décoration...",
                select_country: "Sélectionnez votre pays",
                search_country: "Rechercher un pays...",
            },
            en: {
                search_placeholder: "Search for furniture, decor...",
                select_country: "Select your country",
                search_country: "Search for a country...",
            },
            es: {
                search_placeholder: "Buscar muebles, decoración...",
                select_country: "Selecciona tu país",
                search_country: "Buscar un país...",
            },
        };

        // Langue par défaut
        let currentLanguage = "fr";

        // Fonction pour changer la langue
        function changeLanguage(lang) {
            currentLanguage = lang;
            document.querySelector(".language-code").textContent =
                lang.toUpperCase();
            document.getElementById("dropdownLanguage").style.display = "none";

            // Mettre à jour les textes traduits
            document.querySelectorAll(".translate").forEach((el) => {
                const key = el.getAttribute("data-key");
                el.textContent = translations[lang][key] || translations["fr"][key];
            });

            // Mettre à jour le placeholder de recherche
            document.querySelector(".search-container input").placeholder =
                translations[lang]["search_placeholder"];
            document.getElementById("countrySearch").placeholder =
                translations[lang]["search_country"];

            // Sauvegarder la préférence
            localStorage.setItem("preferredLanguage", lang);
        }

        // Initialisation
        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer la langue sauvegardée ou détecter la langue du navigateur
            const savedLanguage = localStorage.getItem("preferredLanguage");
            const browserLanguage = navigator.language.slice(0, 2);

            if (savedLanguage) {
                changeLanguage(savedLanguage);
            } else if (translations[browserLanguage]) {
                changeLanguage(browserLanguage);
            }

            // Gestion des menus déroulants
            const languageToggle = document.getElementById("languageToggle");
            const dropdownLanguage = document.getElementById("dropdownLanguage");

            languageToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                dropdownLanguage.style.display =
                    dropdownLanguage.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest(".language-dropdown")) {
                    dropdownLanguage.style.display = "none";
                }
            });

            // ... (le reste de votre code existant pour les pays) ...
        });

        // ... (le reste de votre code JavaScript existant) ...











        // Gestion du menu mobile
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
            const mobileMenuModal = document.getElementById("mobileMenuModal");
            const closeMobileMenu = document.getElementById("closeMobileMenu");
            const mobileMenuBack = document.getElementById("mobileMenuBack");
            const mobileMainMenu = document.getElementById("mobileMainMenu");
            const helpMenu = document.getElementById("helpMenu");
            const regionMenu = document.getElementById("regionMenu");
            const menuSections = document.querySelectorAll(".mobile-menu-section");

            // Ouvrir/fermer le menu mobile
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener("click", function() {
                    mobileMenuModal.style.display = "block";
                    document.body.style.overflow = "hidden";
                });
            }

            closeMobileMenu.addEventListener("click", function() {
                mobileMenuModal.style.display = "none";
                document.body.style.overflow = "";
            });

            // Navigation dans les sous-menus
            menuSections.forEach((section) => {
                section.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    document.getElementById(target).style.display = "block";
                    mobileMainMenu.style.display = "none";
                    mobileMenuBack.style.display = "block";
                });
            });

            // Bouton retour
            mobileMenuBack.addEventListener("click", function() {
                mobileMainMenu.style.display = "block";
                helpMenu.style.display = "none";
                regionMenu.style.display = "none";
                this.style.display = "none";
            });

            // Annuler les paramètres régionaux
            document
                .querySelector(".cancel-region")
                ?.addEventListener("click", function() {
                    mobileMainMenu.style.display = "block";
                    regionMenu.style.display = "none";
                    mobileMenuBack.style.display = "none";
                });

            // Soumission des paramètres régionaux
            document
                .getElementById("mobileRegionForm")
                ?.addEventListener("submit", function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const currency = formData.get("currency");
                    const country = formData.get("country");
                    const language = formData.get("language");

                    // Sauvegarder les préférences
                    localStorage.setItem(
                        "userSettings",
                        JSON.stringify({
                            currency: currency,
                            country: country,
                            language: language,
                        })
                    );

                    // Mettre à jour l'interface
                    updateRegionalSettings(currency, country, language);

                    // Revenir au menu principal
                    mobileMainMenu.style.display = "block";
                    regionMenu.style.display = "none";
                    mobileMenuBack.style.display = "none";


                });
        });

        function updateRegionalSettings(currency, country, language) {
            // Mettre à jour les éléments de l'interface en fonction des nouveaux paramètres
            console.log("Paramètres mis à jour:", {
                currency,
                country,
                language
            });
            // Implémentez ici la logique pour mettre à jour votre interface
        }





        // Fonctions pour gérer le modal
        function openCountryModal() {
            document.getElementById("dropdownCountry").style.display =
                "block";
        }

        function closeCountryModal() {
            document.getElementById("dropdownCountry").style.display =
                "none";
        }

        // Fermer quand on clique sur ×
        document.querySelector(".close").onclick = closeCountryModal;

        // Fermer quand on clique sur Annuler
        document.querySelector(".cancel-btn").onclick = closeCountryModal;

        // Fermer quand on clique en dehors du modal
        window.onclick = function(event) {
            if (
                event.target == document.getElementById("dropdownCountry")
            ) {
                closeCountryModal();
            }
        };



        document.getElementById("chatBtn").addEventListener("click", () => {
            document.getElementById("chatModal").style.display = "flex";
        });

        document.getElementById("closeChat").addEventListener("click", () => {
            document.getElementById("chatModal").style.display = "none";
        });

        document.getElementById("sendBtn").addEventListener("click", () => {
            const input = document.getElementById("chatInput");
            const message = input.value.trim();
            if (message !== "") {
                const chatBody = document.getElementById("chatBody");

                // Message utilisateur
                const userMsg = document.createElement("div");
                userMsg.className = "chat-message user";
                userMsg.textContent = message;
                chatBody.appendChild(userMsg);

                // Réponse bot simulée
                const botMsg = document.createElement("div");
                botMsg.className = "chat-message bot";
                botMsg.textContent =
                    "Merci pour votre message, nous vous répondrons bientôt !";
                chatBody.appendChild(botMsg);

                input.value = "";
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });






        class ARMeasurementApp {
            constructor() {
                this.isActive = false;
                this.measurementPoints = [];
                this.measurements = [];
                this.pixelsPerMM = 2;
                this.videoStream = null;

                this.currentFacingMode = "environment"; // Commence par la caméra arrière
                this.availableCameras = [];

                this.initializeElements();
                this.bindEvents();
                this.detectAvailableCameras();
            }

            initializeElements() {
                this.elements = {
                    arBtn: document.getElementById("arMeasureBtn"),
                    arContainer: document.getElementById("arContainer"),
                    video: document.getElementById("videoStream"),
                    overlay: document.getElementById("arOverlay"),
                    statusIndicator: document.getElementById("statusIndicator"),
                    statusText: document.getElementById("statusText"),
                    pointCount: document.getElementById("pointCount"),
                    lastMeasurement: document.getElementById("lastMeasurement"),
                    addPointBtn: document.getElementById("addPointBtn"),
                    clearBtn: document.getElementById("clearBtn"),
                    sendBtn: document.getElementById("sendMeasurementsBtn"),
                    closeBtn: document.getElementById("closeArBtn"),
                    switchCameraBtn: document.getElementById("switchCameraBtn"),
                    // Nouveaux éléments pour le modal
                    permissionModal: document.getElementById("cameraPermissionModal"),
                    allowCameraBtn: document.getElementById("allowCameraBtn"),
                    denyCameraBtn: document.getElementById("denyCameraBtn"),
                    closePermissionModal: document.getElementById(
                        "closePermissionModal"
                    ),
                };
            }

            bindEvents() {
                if (this.elements.arBtn) {
                    this.elements.arBtn.addEventListener("click", () => this.startAR());
                }
                this.elements.closeBtn.addEventListener("click", () => this.stopAR());
                this.elements.addPointBtn.addEventListener("click", () =>
                    this.addMeasurementPoint()
                );
                this.elements.clearBtn.addEventListener("click", () =>
                    this.clearMeasurements()
                );
                this.elements.sendBtn.addEventListener("click", () =>
                    this.sendMeasurements()
                );

                this.elements.overlay.addEventListener("click", (e) => {
                    if (this.isActive) {
                        const rect = this.elements.overlay.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        this.addPointAtPosition(x, y);
                    }
                });
            }

            async startAR() {
                try {
                    this.showStatus("Demande d'autorisation caméra...");

                    if (
                        !navigator.mediaDevices ||
                        !navigator.mediaDevices.getUserMedia
                    ) {
                        throw new Error("getUserMedia non supporté par ce navigateur");
                    }

                    const stream = await navigator.mediaDevices
                        .getUserMedia({
                            video: {
                                facingMode: "environment",
                                width: {
                                    ideal: 1920,
                                    min: 640
                                },
                                height: {
                                    ideal: 1080,
                                    min: 480
                                },
                            },
                        })
                        .catch(async (error) => {
                            if (
                                error.name === "OverconstrainedError" ||
                                error.name === "NotFoundError"
                            ) {
                                return await navigator.mediaDevices.getUserMedia({
                                    video: {
                                        facingMode: "user",
                                        width: {
                                            ideal: 1280,
                                            min: 640
                                        },
                                        height: {
                                            ideal: 720,
                                            min: 480
                                        },
                                    },
                                });
                            }
                            throw error;
                        });

                    this.videoStream = stream;
                    this.elements.video.srcObject = stream;

                    await new Promise((resolve, reject) => {
                        this.elements.video.onloadedmetadata = resolve;
                        this.elements.video.onerror = reject;
                        setTimeout(() => reject(new Error("Timeout")), 10000);
                    });

                    this.elements.arContainer.classList.remove("hidden");
                    this.hideStatus();
                    this.isActive = true;
                    this.calibrateScale();
                } catch (error) {
                    console.error("Erreur caméra:", error);
                    this.handleCameraError(error);
                }
            }

            handleCameraError(error) {
                let message = "";
                switch (error.name) {
                    case "NotAllowedError":
                        message = "🚫 Accès caméra refusé";
                        break;
                    case "NotFoundError":
                        message = "📷 Aucune caméra trouvée";
                        break;
                    default:
                        message = "❌ Erreur caméra";
                }
                this.showCameraPermissionDialog(message);
            }

            showCameraPermissionDialog(message) {
                const modal = document.createElement("div");
                modal.style.cssText = `
                    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0,0,0,0.9); display: flex; align-items: center;
                    justify-content: center; z-index: 9999; padding: 20px;
                `;

                const isChrome = /Chrome/.test(navigator.userAgent);
                const isFirefox = /Firefox/.test(navigator.userAgent);
                const isMobile = /Mobi|Android/i.test(navigator.userAgent);

                let instructions = "";
                if (isChrome) {
                    instructions =
                        "Cliquez sur l'icône 📷 dans la barre d'adresse et autorisez la caméra";
                } else if (isFirefox) {
                    instructions = 'Cliquez sur "Autoriser" dans la popup de Firefox';
                } else {
                    instructions =
                        "Autorisez l'accès à la caméra dans votre navigateur";
                }

                modal.innerHTML = `
                    <div style="background: white; padding: 30px; border-radius: 20px; max-width: 400px; text-align: center; color: #333;">
                        <div style="font-size: 60px; margin-bottom: 20px;">📷</div>
                        <h2 style="color: #ff4757; margin-bottom: 15px;">${message}</h2>
                        <p style="margin-bottom: 20px;">${instructions}</p>
                        <div style="background: #fff9c4; padding: 15px; border-radius: 8px; margin: 20px 0;">
                            <strong>⚠️ Important :</strong><br>
                            Vos images ne sont jamais enregistrées ni envoyées.
                        </div>
                        <div style="display: flex; gap: 15px; justify-content: center;">
                            <button onclick="window.location.reload()" style="padding: 15px 25px; background: #4a6bff; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                🔄 Réessayer
                            </button>
                            <button onclick="this.parentElement.parentElement.remove()" style="padding: 15px 25px; background: #636e72; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                ❌ Annuler
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);
                this.hideStatus();
            }

            stopAR() {
                if (this.videoStream) {
                    this.videoStream.getTracks().forEach((track) => track.stop());
                    this.videoStream = null;
                }
                this.elements.arContainer.classList.add("hidden");
                this.isActive = false;
                this.clearMeasurements();
            }

            calibrateScale() {
                const screenWidth = window.screen.width;
                const videoWidth = this.elements.video.videoWidth;
                this.pixelsPerMM = (videoWidth / screenWidth) * 0.5;
            }

            addPointAtPosition(x, y) {
                const point = {
                    id: Date.now(),
                    x: x,
                    y: y,
                    timestamp: new Date()
                };
                this.measurementPoints.push(point);
                this.renderPoint(point);

                if (this.measurementPoints.length >= 2) {
                    this.calculateAndRenderMeasurement();
                }
                this.updateUI();
            }

            addMeasurementPoint() {
                const centerX = this.elements.overlay.offsetWidth / 2;
                const centerY = this.elements.overlay.offsetHeight / 2;
                this.addPointAtPosition(centerX, centerY);
            }

            renderPoint(point) {
                const pointElement = document.createElement("div");
                pointElement.className = "measurement-point";
                pointElement.style.left = `${point.x}px`;
                pointElement.style.top = `${point.y}px`;
                this.elements.overlay.appendChild(pointElement);
            }

            calculateAndRenderMeasurement() {
                const points = this.measurementPoints;
                if (points.length < 2) return;

                const [point1, point2] = points.slice(-2);
                const pixelDistance = Math.sqrt(
                    Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
                );
                const realDistance = pixelDistance / this.pixelsPerMM / 10;

                const measurement = {
                    id: Date.now(),
                    point1,
                    point2,
                    pixelDistance,
                    realDistance,
                    timestamp: new Date(),
                };

                this.measurements.push(measurement);
                this.renderMeasurementLine(measurement);
            }

            renderMeasurementLine(measurement) {
                const {
                    point1,
                    point2,
                    realDistance
                } = measurement;

                const line = document.createElement("div");
                line.className = "measurement-line";

                const length = Math.sqrt(
                    Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
                );
                const angle =
                    (Math.atan2(point2.y - point1.y, point2.x - point1.x) * 180) /
                    Math.PI;

                line.style.width = `${length}px`;
                line.style.left = `${point1.x}px`;
                line.style.top = `${point1.y}px`;
                line.style.transform = `rotate(${angle}deg)`;
                line.style.transformOrigin = "0 50%";

                const label = document.createElement("div");
                label.className = "measurement-label";

                let displayDistance =
                    realDistance >= 100 ?
                    `${(realDistance / 100).toFixed(2)} m` :
                    `${realDistance.toFixed(1)} cm`;

                label.textContent = displayDistance;
                label.style.left = `${(point1.x + point2.x) / 2}px`;
                label.style.top = `${(point1.y + point2.y) / 2 - 30}px`;

                this.elements.overlay.appendChild(line);
                this.elements.overlay.appendChild(label);
                this.elements.lastMeasurement.textContent = displayDistance;
            }

            clearMeasurements() {
                this.measurementPoints = [];
                this.measurements = [];

                const measurementElements = this.elements.overlay.querySelectorAll(
                    ".measurement-point, .measurement-line, .measurement-label"
                );
                measurementElements.forEach((el) => el.remove());
                this.updateUI();
            }

            updateUI() {
                this.elements.pointCount.textContent = this.measurementPoints.length;
                const totalMeasurementsEl =
                    document.getElementById("totalMeasurements");
                if (totalMeasurementsEl) {
                    totalMeasurementsEl.textContent = this.measurements.length;
                }

                const instructionEl = document.getElementById("instructionText");
                if (instructionEl) {
                    if (this.measurementPoints.length === 0) {
                        instructionEl.innerHTML =
                            "📍 Cliquez sur le <strong>premier coin</strong> à mesurer";
                        instructionEl.style.color = "#4a6bff";
                    } else if (this.measurementPoints.length === 1) {
                        instructionEl.innerHTML =
                            "📍 Maintenant cliquez sur le <strong>second coin</strong>";
                        instructionEl.style.color = "#ff4757";
                    } else {
                        instructionEl.innerHTML =
                            "✅ Mesure terminée ! Vous pouvez en ajouter d'autres";
                        instructionEl.style.color = "#2ed573";
                    }
                }
            }

            async sendMeasurements() {
                if (this.measurements.length === 0) {
                    alert("Aucune mesure à envoyer. Ajoutez au moins 2 points.");
                    return;
                }

                this.showStatus("📤 Envoi des mesures...");

                const data = {
                    timestamp: new Date().toISOString(),
                    measurements: this.measurements.map((m) => ({
                        realDistance: m.realDistance,
                        pixelDistance: m.pixelDistance,
                        timestamp: m.timestamp,
                    })),
                    summary: {
                        totalMeasurements: this.measurements.length,
                        averageDistance: this.measurements.reduce((sum, m) => sum + m.realDistance, 0) /
                            this.measurements.length,
                    },
                };

                try {
                    console.log("📊 Données de mesure:", data);

                    // REMPLACEZ PAR VOTRE API :
                    // const response = await fetch('/api/measurements', {
                    //     method: 'POST',
                    //     headers: { 'Content-Type': 'application/json' },
                    //     body: JSON.stringify(data)
                    // });

                    await new Promise((resolve) => setTimeout(resolve, 1500));

                    this.showStatus("✅ Mesures envoyées avec succès!");
                    setTimeout(() => this.hideStatus(), 2000);
                } catch (error) {
                    console.error("Erreur envoi:", error);
                    this.showStatus("❌ Erreur lors de l'envoi");
                    setTimeout(() => this.hideStatus(), 3000);
                }
            }

            showStatus(message) {
                this.elements.statusText.textContent = message;
                this.elements.statusIndicator.classList.remove("hidden");
            }

            hideStatus() {
                this.elements.statusIndicator.classList.add("hidden");
            }
        }

        // Initialisation quand le DOM est prêt
        document.addEventListener("DOMContentLoaded", () => {
            new ARMeasurementApp();
        });



        // Gestion des likes
        document.querySelectorAll(".like-btn").forEach((btn) => {
            btn.addEventListener("click", function() {
                this.classList.toggle("liked");
                const icon = this.querySelector("i");
                if (this.classList.contains("liked")) {
                    icon.classList.remove("far");
                    icon.classList.add("fas");
                } else {
                    icon.classList.remove("fas");
                    icon.classList.add("far");
                }
            });
        });


        // Appliquer un coupon
        document
            .getElementById("apply-coupon")
            .addEventListener("click", function() {
                const couponCode = document.getElementById("coupon").value;

                if (couponCode.toUpperCase() === "KELU15") {
                    const subtotalText = subtotalElement.textContent;
                    const subtotal = parseFloat(subtotalText.replace("€", ""));
                    const discount = subtotal * 0.15;
                    const total = subtotal - discount;

                    // Ajouter la réduction au résumé
                    const discountElement = document.createElement("div");
                    discountElement.className = "summary-item";
                    discountElement.innerHTML = `
                            <span>Réduction (15%)</span>
                            <span>-€${discount.toFixed(2)}</span>
                        `;

                    // Vérifier si la réduction est déjà affichée
                    if (!document.getElementById("discount-element")) {
                        discountElement.id = "discount-element";
                        cartItemsContainer.appendChild(discountElement);
                    } else {
                        document.getElementById("discount-element").innerHTML =
                            discountElement.innerHTML;
                    }

                    totalElement.textContent = `€${total.toFixed(2)}`;
                    alert("Code promo appliqué avec succès!");
                } else {
                    alert("Code promo invalide");
                }
            });

        // Passer à la livraison
        document
            .getElementById("proceed-to-checkout")
            .addEventListener("click", function() {
                alert("Fonctionnalité de paiement à implémenter");
                // Ici, vous pourriez ajouter la logique pour passer à l'étape suivante du checkout
            });

        // Gestion des boutons flottants
        document
            .querySelector(".floating-buttons button:nth-child(1)")
            .addEventListener("click", function() {
                alert(
                    "Fonctionnalité de partage sur les réseaux sociaux à implémenter"
                );
            });

        document
            .querySelector(".floating-buttons button:nth-child(2)")
            .addEventListener("click", function() {
                alert("Fonctionnalité de cagnotte commune à implémenter");
            });

        // Redirection vers la page de détails au clic sur l'image du produit
        document.querySelectorAll(".product-img").forEach((img, index) => {
            img.style.cursor = "pointer";
            img.addEventListener("click", function() {
                // Liste des IDs des produits dans le même ordre qu'ils apparaissent sur la page
                const productIds = ["1", "2", "3",
                    "4"
                ]; // Correspond aux data-id des boutons "Ajouter au panier"

                // Récupérer l'ID du produit correspondant
                const productId = productIds[index];

                // Rediriger vers la page de détails avec l'ID en paramètre
                window.location.href = `product-details.html?id=${productId}`;
            });
        });


        // Navigation entre les étapes
        document
            .getElementById("proceed-to-delivery")
            .addEventListener("click", function() {
                document.getElementById("checkout-modal").style.display = "none";
                document.getElementById("delivery-modal").style.display = "block";
            });

        document
            .getElementById("proceed-to-payment")
            .addEventListener("click", function() {
                document.getElementById("delivery-modal").style.display = "none";
                document.getElementById("payment-modal").style.display = "block";
            });

        document
            .getElementById("confirm-order")
            .addEventListener("click", function() {
                document.getElementById("payment-modal").style.display = "none";
                document.getElementById("confirmation-modal").style.display = "block";
            });

        // Boutons de retour
        document
            .getElementById("back-to-cart")
            .addEventListener("click", function() {
                document.getElementById("delivery-modal").style.display = "none";
                document.getElementById("checkout-modal").style.display = "block";
            });

        document
            .getElementById("back-to-delivery")
            .addEventListener("click", function() {
                document.getElementById("payment-modal").style.display = "none";
                document.getElementById("delivery-modal").style.display = "block";
            });

        document
            .getElementById("return-to-shop")
            .addEventListener("click", function() {
                document.getElementById("confirmation-modal").style.display = "none";
                // Redirection vers la page d'accueil
                window.location.href = "/";
            });

        // Fermeture des modals
        document.querySelectorAll(".close-modal").forEach(function(btn) {
            btn.addEventListener("click", function() {
                this.closest(".modal").style.display = "none";
            });
        });

        // Ouverture du modal panier (exemple)
        function openCartModal() {
            document.getElementById("checkout-modal").style.display = "block";
        }
    </script>

    @include('partials.footer')
</body>

</html>
