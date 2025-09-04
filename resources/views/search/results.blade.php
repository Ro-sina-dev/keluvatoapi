<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Résultats — {{ $term ? e($term) : 'Recherche' }} | Keluvato</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/decouvre.css') }}">
</head>
<body>

@include('partials.header')

<div class="container">
  <nav class="breadcrumb" style="margin:12px 0">
    <a href="{{ route('home') }}">Accueil</a> › <span>Résultats</span>
  </nav>

  <h1 style="margin-top:8px; color:var(--brand)">Résultats @if($term) pour « {{ e($term) }} » @endif</h1>

  {{-- Liens rapides catégories --}}
  @if($categoryMatches->isNotEmpty())
    <div style="margin:10px 0 16px; display:flex; gap:8px; flex-wrap:wrap">
      @foreach($categoryMatches as $cat)
        <a href="{{ route('products.discover', ['category_id' => $cat->id]) }}"
           class="badge"
           style="text-decoration:none">{{ $cat->name }}</a>
      @endforeach
    </div>
  @endif

  @if ($products->isEmpty())
    <div class="card pad" style="text-align:center">
      <p>Aucun produit trouvé.</p>
      <a class="btn primary" href="{{ route('products.discover') }}">Découvrir nos produits</a>
    </div>
  @else
    <div class="grid-rel">
      @foreach ($products as $p)
        @php
          $imgs = (array) ($p->images ?? []);
          $img  = count($imgs) ? $imgs[0] : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80&auto=format&fit=crop';
          $hasPromo = !is_null($p->discount_price ?? null);
          $display  = $hasPromo ? $p->discount_price : $p->price;
        @endphp

        <a class="card pad rel-card"
           href="{{ route('products.show', $p->id) }}"
           style="text-decoration:none;color:inherit">
          <img src="{{ $img }}" alt="{{ $p->name }}">
          <div class="rel-title" style="margin-top:8px">{{ $p->name }}</div>
          <div class="rel-price">
            {{ number_format($display, 2, ',', ' ') }} {{ $p->currency ?? 'EUR' }}
            @if($hasPromo)
              <span style="text-decoration:line-through; color:#6b7280; font-size:.9em; margin-left:6px">
                {{ number_format($p->price, 2, ',', ' ') }} {{ $p->currency ?? 'EUR' }}
              </span>
            @endif
          </div>
        </a>
      @endforeach
    </div>

    <div style="margin-top:16px">
      {{ $products->links() }}
    </div>
  @endif
</div>
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


<script src="{{ asset('js/google-translate.js') }}"></script>
</body>
</html>
