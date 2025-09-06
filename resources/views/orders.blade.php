<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keluvato - Meubles, Décoration & Bricolage</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('css/order.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


</head>

<body>
    @include('partials.header')



    <section class="orders-section" style="padding: 40px 0; background-color: #f9f9f9; min-height: 70vh">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px">
            <h1
                style="
            color: #1f4e5f;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
          ">
                <i class="fas fa-box-open" style="margin-right: 15px"></i>Mes
                Commandes
            </h1>

            <div class="order-filters"
                style="
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
          ">
                <div class="filter-group" style="display: flex; gap: 10px">
                    <button class="filter-btn active" data-filter="all"
                        style="
                padding: 10px 20px;
                background: #1f4e5f;
                color: white;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Toutes
                    </button>
                    <button class="filter-btn" data-filter="pending"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        En cours
                    </button>
                    <button class="filter-btn" data-filter="delivered"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Livrées
                    </button>
                    <button class="filter-btn" data-filter="cancelled"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Annulées
                    </button>
                </div>

                <div class="search-orders" style="position: relative">
                    <input type="text" placeholder="Rechercher une commande..."
                        style="
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 25px;
                width: 250px;
              " />
                    <i class="fas fa-search"
                        style="
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #1f4e5f;
              "></i>
                </div>
            </div>

            <div class="orders-list">
                    @php
                    // 1) Déclare la table de correspondance UNE FOIS
                    $map = [
                        'pending'   => ['ui' => 'pending',   'label' => "En cours",   'color' => '#4a6bff'],
                        'paid'      => ['ui' => 'pending',   'label' => "Payée",      'color' => '#4a6bff'],
                        'shipped'   => ['ui' => 'pending',   'label' => "Expédiée",   'color' => '#4a6bff'],
                        'completed' => ['ui' => 'delivered', 'label' => "Livrée",     'color' => '#4caf50'],
                        'canceled'  => ['ui' => 'cancelled', 'label' => "Annulée",    'color' => '#f44336'],
                    ];
                    @endphp

                    @forelse ($orders as $order)
                        @php
                            // 2) Calcule le mapping POUR CETTE COMMANDE
                            $meta = $map[$order->status] ?? ['ui' => 'other', 'label' => ucfirst($order->status), 'color' => '#ccc'];
                        @endphp

                        <div class="order-card" data-status="{{ $meta['ui'] }}"
                            style="background:white;border-radius:15px;box-shadow:0 5px 15px rgba(0,0,0,0.05);margin-bottom:25px;">
                            <div class="order-header"
                                style="display:flex;justify-content:space-between;align-items:center;padding:20px;border-bottom:1px solid #f1f1f1;">
                                <div class="order-info">
                                    <h3 style="margin:0;color:#1f4e5f;">Commande #{{ $order->id }}</h3>
                                    <p style="color:#666;">Passée le {{ $order->created_at->format('d/m/Y') }}</p>
                                </div>

                                <!-- 3) Utilise le mapping pour couleur + libellé -->
                                <div class="order-status"
                                    style="background:{{ $meta['color'] }};color:white;padding:8px 15px;border-radius:20px;">
                                    {{ $meta['label'] }}
                                </div>
                            </div>

                            <div class="order-body" style="padding:20px;">
                                <div class="order-products" style="display:flex;flex-wrap:wrap;gap:20px;">
                                    @foreach (($order->items ?? []) as $item)
                                        <div class="product-item" style="display:flex;gap:15px;width:calc(50% - 10px);">
                                            <img src="{{ $item->image ?? 'https://via.placeholder.com/80' }}"
                                                style="width:80px;height:80px;object-fit:cover;border-radius:10px;">
                                            <div class="product-details">
                                                <h4 style="margin:0;">{{ $item->name }}</h4>
                                                <p style="color:#666;">Quantité : {{ $item->quantity }}</p>
                                                <p style="font-weight:600;color:#1f4e5f;">
                                                    {{ number_format($item->price, 2, ',', ' ') }} {{ $order->currency ?? '€' }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="order-summary"
                                    style="display:flex;justify-content:space-between;border-top:1px solid #f1f1f1;padding-top:20px;">
                                    <div class="delivery-info">
                                        <h4 style="margin:0 0 10px;"><i class="fas fa-truck" style="margin-right:10px;"></i>Livraison</h4>
                                        <p style="color:#666;">
                                            @if ($meta['ui'] === 'delivered')
                                                Livrée le {{ $order->updated_at->format('d/m/Y') }}
                                            @elseif ($meta['ui'] === 'cancelled')
                                                Annulée le {{ $order->updated_at->format('d/m/Y') }}
                                            @else
                                                En cours de traitement
                                            @endif
                                        </p>
                                    </div>

                                    <div class="order-total" style="text-align:right;">
                                        <p style="margin:0 0 5px;color:#666;">Total commande :</p>
                                        <h3 style="color:#1f4e5f;">
                                            {{ number_format($order->total, 2, ',', ' ') }} {{ $order->currency ?? '€' }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Aucune commande pour l'instant.</p>
                    @endforelse
            </div>


            <div class="pagination" style="display: flex; justify-content: center; margin-top: 40px">
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #1f4e5f;
              color: white;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    1
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    2
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    3
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>




    <div id="checkout-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Votre panier</h3>
                <div id="cart-items">
                    <!-- Les articles du panier seront ajoutés ici dynamiquement -->
                    <div class="cart-item">
                        <img src="produit1.jpg" alt="Produit" width="60" />
                        <div class="cart-item-details">
                            <h4>Nom du produit</h4>
                            <p>Quantité: 1</p>
                        </div>
                        <div class="cart-item-price">€19.99</div>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span id="subtotal">€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="total">€19.99</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="coupon">Code promo</label>
                    <input type="text" id="coupon" class="form-control"
                        placeholder="Entrez votre code promo" />
                    <button id="apply-coupon" class="btn btn-primary" style="margin-top: 0.5rem">
                        Appliquer
                    </button>
                </div>

                <button id="proceed-to-delivery" class="btn btn-primary" style="margin-top: 1.5rem">
                    Passer à la livraison
                </button>
            </div>
        </div>
    </div>

    <div id="delivery-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Informations de livraison</h3>

                <div class="form-group">
                    <label for="full-name">Nom complet</label>
                    <input type="text" id="full-name" class="form-control" placeholder="Votre nom complet" />
                </div>

                <div class="form-group">
                    <label for="delivery-address">Adresse</label>
                    <input type="text" id="delivery-address" class="form-control" placeholder="Votre adresse" />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="delivery-city">Ville</label>
                        <input type="text" id="delivery-city" class="form-control" placeholder="Votre ville" />
                    </div>
                    <div class="form-group">
                        <label for="delivery-zip">Code postal</label>
                        <input type="text" id="delivery-zip" class="form-control" placeholder="Code postal" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="delivery-country">Pays</label>
                    <select id="delivery-country" class="form-control">
                        <option value="">Sélectionnez un pays</option>
                        <option value="FR">France</option>
                        <option value="BE">Belgique</option>
                        <option value="CH">Suisse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="delivery-phone">Téléphone</label>
                    <input type="tel" id="delivery-phone" class="form-control"
                        placeholder="Votre numéro de téléphone" />
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                </div>

                <button id="proceed-to-payment" class="btn btn-primary">
                    Passer au paiement
                </button>
                <button id="back-to-cart" class="btn btn-secondary">
                    Retour au panier
                </button>
            </div>
        </div>
    </div>

    <div id="payment-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step completed">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step active">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Méthode de paiement</h3>

                <div class="payment-methods">
                    <div class="payment-method active">
                        <input type="radio" name="payment-method" id="credit-card" checked />
                        <label for="credit-card">Carte de crédit</label>
                        <div class="payment-details">
                            <div class="form-group">
                                <label for="card-number">Numéro de carte</label>
                                <input type="text" id="card-number" class="form-control"
                                    placeholder="1234 5678 9012 3456" />
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="card-expiry">Date d'expiration</label>
                                    <input type="text" id="card-expiry" class="form-control"
                                        placeholder="MM/AA" />
                                </div>
                                <div class="form-group">
                                    <label for="card-cvc">CVC</label>
                                    <input type="text" id="card-cvc" class="form-control" placeholder="123" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-name">Nom sur la carte</label>
                                <input type="text" id="card-name" class="form-control" placeholder="Votre nom" />
                            </div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <input type="radio" name="payment-method" id="paypal" />
                        <label for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="terms-agree" />
                    <label for="terms-agree">J'accepte les conditions générales de vente</label>
                </div>

                <button id="confirm-order" class="btn btn-primary">
                    Confirmer la commande
                </button>
                <button id="back-to-delivery" class="btn btn-secondary">
                    Retour à la livraison
                </button>
            </div>
        </div>
    </div>

    <div id="confirmation-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step completed">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step completed">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step active">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <div class="confirmation-message">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                        fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <h3>Commande confirmée !</h3>
                    <p>
                        Merci pour votre achat. Votre commande #12345 a été passée avec
                        succès.
                    </p>
                    <p>Un email de confirmation vous a été envoyé.</p>
                </div>

                <div class="order-summary">
                    <h4>Détails de la commande</h4>
                    <div class="summary-item">
                        <span>Date</span>
                        <span>21 juillet 2025</span>
                    </div>
                    <div class="summary-item">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Méthode de paiement</span>
                        <span>Carte de crédit</span>
                    </div>
                    <div class="summary-item">
                        <span>Adresse de livraison</span>
                        <span>123 Rue Example, Paris, France</span>
                    </div>
                </div>

                <button id="return-to-shop" class="btn btn-primary">
                    Retour à la boutique
                </button>
            </div>
        </div>
    </div>

    <div class="floating-buttons">
        <button id="arMeasureBtn" class="floating-btn"
            style="background: linear-gradient(to right, #4a6bff, #6b8cff)" title="Mesurer votre espace">
            <i class="fas fa-ruler-combined text-xl"></i>
        </button>

        <button class="floating-btn" style="background: linear-gradient(to right, #4ecdc4, #6ad9d1)"
            title="Cagnotte commune">
            <i class="fas fa-gift text-xl"></i>
        </button>

        <button id="chatBtn" class="floating-btn" style="background: linear-gradient(to right, #038a40, #037c1d)"
            title="Chat en direct">
            <i class="fas fa-comments text-xl"></i>
        </button>
    </div>

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


    <script>
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
    </script>



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


    <script src="js/app-auth.js" defer></script>

    <script src="js/main.js"></script>


    <script>
        (() => {
            'use strict';

            /* ========== Helpers ========== */
            const $ = (s, r = document) => r.querySelector(s);
            const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));

            /* ========== 0) Conversion devise utilitaire ========== */
            async function convertPrices(targetCurrency) {
                try {
                    const res = await fetch('https://api.exchangerate-api.com/v4/latest/EUR');
                    if (!res.ok) return;
                    const data = await res.json();
                    const rate = data?.rates?.[targetCurrency];
                    if (!rate) return;
                    $$('.price[data-original-price]').forEach(el => {
                        const base = parseFloat(el.getAttribute('data-original-price'));
                        if (isNaN(base)) return;
                        el.textContent = `${(base * rate).toFixed(2)} ${targetCurrency}`;
                    });
                } catch (e) {
                    console.warn('Conversion devise indisponible', e);
                }
            }

            /* ========== 1) AR Measure (caméra) ========== */
            class ARMeasurementApp {
                constructor() {
                    this.isActive = false;
                    this.measurementPoints = [];
                    this.measurements = [];
                    this.pixelsPerMM = 2;
                    this.videoStream = null;

                    this.initializeElements();
                    this.bindEvents();
                }

                initializeElements() {
                    this.elements = {
                        arBtn: $("#arMeasureBtn"),
                        arContainer: $("#arContainer"),
                        video: $("#videoStream"),
                        overlay: $("#arOverlay"),
                        statusIndicator: $("#statusIndicator"),
                        statusText: $("#statusText"),
                        pointCount: $("#pointCount"),
                        lastMeasurement: $("#lastMeasurement"),
                        addPointBtn: $("#addPointBtn"),
                        clearBtn: $("#clearBtn"),
                        sendBtn: $("#sendMeasurementsBtn"),
                        closeBtn: $("#closeArBtn"),
                    };
                }

                bindEvents() {
                    const E = this.elements;
                    E.arBtn?.addEventListener('click', () => this.startAR());
                    E.closeBtn?.addEventListener('click', () => this.stopAR());
                    E.addPointBtn?.addEventListener('click', () => this.addMeasurementPoint());
                    E.clearBtn?.addEventListener('click', () => this.clearMeasurements());
                    E.sendBtn?.addEventListener('click', () => this.sendMeasurements());
                    E.overlay?.addEventListener('click', (e) => {
                        if (!this.isActive || !E.overlay) return;
                        const rect = E.overlay.getBoundingClientRect();
                        this.addPointAtPosition(e.clientX - rect.left, e.clientY - rect.top);
                    });
                }

                async startAR() {
                    const E = this.elements;
                    if (!E.video || !E.arContainer) return;

                    try {
                        this.showStatus("Demande d'autorisation caméra...");
                        if (!navigator.mediaDevices?.getUserMedia) {
                            throw new Error("getUserMedia non supporté par ce navigateur");
                        }

                        const constraints = {
                            video: {
                                facingMode: "environment",
                                width: {
                                    ideal: 1920,
                                    min: 640
                                },
                                height: {
                                    ideal: 1080,
                                    min: 480
                                }
                            }
                        };

                        let stream;
                        try {
                            stream = await navigator.mediaDevices.getUserMedia(constraints);
                        } catch (e) {
                            // fallback caméra frontale
                            stream = await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: "user",
                                    width: {
                                        ideal: 1280,
                                        min: 640
                                    },
                                    height: {
                                        ideal: 720,
                                        min: 480
                                    }
                                }
                            });
                        }

                        this.videoStream = stream;
                        E.video.srcObject = stream;

                        await new Promise((resolve, reject) => {
                            E.video.onloadedmetadata = resolve;
                            E.video.onerror = reject;
                            setTimeout(() => reject(new Error("Timeout")), 10000);
                        });

                        E.arContainer.classList.remove('hidden');
                        this.hideStatus();
                        this.isActive = true;
                        this.calibrateScale();
                    } catch (error) {
                        console.error("Erreur caméra:", error);
                        this.handleCameraError(error);
                    }
                }

                handleCameraError(error) {
                    let message = "❌ Erreur caméra";
                    if (error.name === "NotAllowedError") message = "🚫 Accès caméra refusé";
                    if (error.name === "NotFoundError") message = "📷 Aucune caméra trouvée";

                    const modal = document.createElement("div");
                    modal.style.cssText = `
        position:fixed; inset:0; background:rgba(0,0,0,.9);
        display:flex; align-items:center; justify-content:center;
        z-index:9999; padding:20px;`;
                    modal.innerHTML = `
        <div style="background:#fff;padding:30px;border-radius:20px;max-width:420px;text-align:center;color:#333">
          <div style="font-size:60px;margin-bottom:12px">📷</div>
          <h2 style="color:#ff4757;margin:0 0 10px">${message}</h2>
          <p style="margin:0 0 15px">Autorisez l'accès à la caméra dans votre navigateur.</p>
          <div style="background:#fff9c4;padding:12px;border-radius:8px;margin:15px 0">
            <strong>⚠️ Important :</strong> Vos images ne sont pas enregistrées.
          </div>
          <div style="display:flex;gap:12px;justify-content:center">
            <button onclick="window.location.reload()" style="padding:12px 18px;background:#4a6bff;color:#fff;border:none;border-radius:10px;cursor:pointer;font-weight:600">🔄 Réessayer</button>
            <button onclick="this.parentElement.parentElement.parentElement.remove()" style="padding:12px 18px;background:#636e72;color:#fff;border:none;border-radius:10px;cursor:pointer;font-weight:600">❌ Annuler</button>
          </div>
        </div>`;
                    document.body.appendChild(modal);
                    this.hideStatus();
                }

                stopAR() {
                    if (this.videoStream) {
                        this.videoStream.getTracks().forEach(t => t.stop());
                        this.videoStream = null;
                    }
                    this.elements.arContainer?.classList.add('hidden');
                    this.isActive = false;
                    this.clearMeasurements();
                }

                calibrateScale() {
                    const videoW = this.elements.video?.videoWidth || window.innerWidth;
                    const screenW = window.screen.width || window.innerWidth;
                    // approx simple, à affiner par calibration réelle :
                    this.pixelsPerMM = (videoW / screenW) * 0.5;
                }

                addPointAtPosition(x, y) {
                    if (!this.elements.overlay) return;
                    const p = {
                        id: Date.now(),
                        x,
                        y,
                        timestamp: new Date()
                    };
                    this.measurementPoints.push(p);
                    this.renderPoint(p);
                    if (this.measurementPoints.length >= 2) {
                        this.calculateAndRenderMeasurement();
                    }
                    this.updateUI();
                }

                addMeasurementPoint() {
                    const o = this.elements.overlay;
                    if (!o) return;
                    this.addPointAtPosition(o.offsetWidth / 2, o.offsetHeight / 2);
                }

                renderPoint(point) {
                    const o = this.elements.overlay;
                    if (!o) return;
                    const dot = document.createElement('div');
                    dot.className = 'measurement-point';
                    dot.style.left = `${point.x}px`;
                    dot.style.top = `${point.y}px`;
                    o.appendChild(dot);
                }

                calculateAndRenderMeasurement() {
                    const pts = this.measurementPoints;
                    if (pts.length < 2 || !this.elements.overlay) return;

                    const [a, b] = pts.slice(-2);
                    const dx = b.x - a.x,
                        dy = b.y - a.y;
                    const pixelDistance = Math.hypot(dx, dy);
                    const realDistance = pixelDistance / this.pixelsPerMM / 10; // en cm

                    const measurement = {
                        id: Date.now(),
                        point1: a,
                        point2: b,
                        pixelDistance,
                        realDistance,
                        timestamp: new Date()
                    };
                    this.measurements.push(measurement);
                    this.renderMeasurementLine(measurement);
                }

                renderMeasurementLine({
                    point1,
                    point2,
                    realDistance
                }) {
                    const o = this.elements.overlay;
                    if (!o) return;

                    const dx = point2.x - point1.x;
                    const dy = point2.y - point1.y;
                    const length = Math.hypot(dx, dy);
                    const angle = Math.atan2(dy, dx) * 180 / Math.PI;

                    const line = document.createElement('div');
                    line.className = 'measurement-line';
                    line.style.width = `${length}px`;
                    line.style.left = `${point1.x}px`;
                    line.style.top = `${point1.y}px`;
                    line.style.transform = `rotate(${angle}deg)`;
                    line.style.transformOrigin = '0 50%';

                    const label = document.createElement('div');
                    label.className = 'measurement-label';
                    const display = realDistance >= 100 ? `${(realDistance/100).toFixed(2)} m` :
                        `${realDistance.toFixed(1)} cm`;
                    label.textContent = display;
                    label.style.left = `${(point1.x + point2.x)/2}px`;
                    label.style.top = `${(point1.y + point2.y)/2 - 30}px`;

                    o.appendChild(line);
                    o.appendChild(label);
                    this.elements.lastMeasurement && (this.elements.lastMeasurement.textContent = display);
                }

                clearMeasurements() {
                    this.measurementPoints = [];
                    this.measurements = [];
                    this.elements.overlay?.querySelectorAll(
                            '.measurement-point,.measurement-line,.measurement-label')
                        .forEach(el => el.remove());
                    this.updateUI();
                }

                updateUI() {
                    this.elements.pointCount && (this.elements.pointCount.textContent = this.measurementPoints
                        .length);
                    const totalEl = $('#totalMeasurements');
                    totalEl && (totalEl.textContent = this.measurements.length);

                    const instruction = $('#instructionText');
                    if (!instruction) return;
                    if (!this.measurementPoints.length) {
                        instruction.innerHTML = "📍 Cliquez sur le <strong>premier coin</strong> à mesurer";
                        instruction.style.color = "#4a6bff";
                    } else if (this.measurementPoints.length === 1) {
                        instruction.innerHTML = "📍 Maintenant cliquez sur le <strong>second coin</strong>";
                        instruction.style.color = "#ff4757";
                    } else {
                        instruction.innerHTML = "✅ Mesure terminée ! Vous pouvez en ajouter d'autres";
                        instruction.style.color = "#2ed573";
                    }
                }

                async sendMeasurements() {
                    if (!this.measurements.length) {
                        alert("Aucune mesure à envoyer. Ajoutez au moins 2 points.");
                        return;
                    }
                    this.showStatus("📤 Envoi des mesures...");

                    const payload = {
                        timestamp: new Date().toISOString(),
                        measurements: this.measurements.map(m => ({
                            realDistance: m.realDistance,
                            pixelDistance: m.pixelDistance,
                            timestamp: m.timestamp
                        })),
                        summary: {
                            totalMeasurements: this.measurements.length,
                            averageDistance: this.measurements.reduce((s, m) => s + m.realDistance, 0) / this
                                .measurements.length
                        }
                    };

                    try {
                        console.log("📊 Données de mesure:", payload);
                        // Exemple : await fetch('/api/measurements', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(payload) });
                        await new Promise(r => setTimeout(r, 1200));
                        this.showStatus("✅ Mesures envoyées avec succès!");
                        setTimeout(() => this.hideStatus(), 2000);
                    } catch (e) {
                        console.error(e);
                        this.showStatus("❌ Erreur lors de l'envoi");
                        setTimeout(() => this.hideStatus(), 3000);
                    }
                }

                showStatus(msg) {
                    this.elements.statusText && (this.elements.statusText.textContent = msg);
                    this.elements.statusIndicator?.classList.remove('hidden');
                }
                hideStatus() {
                    this.elements.statusIndicator?.classList.add('hidden');
                }
            }

            /* ========== 2) Animation & filtre commandes (une seule implémentation) ========== */
            function initOrderUI() {
                const cards = $$('.order-card');
                const buttons = $$('.filter-btn');
                if (cards.length) {
                    cards.forEach((card, i) => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        card.style.transition = `all .5s ease ${i*0.1}s`;
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 100);
                        card.addEventListener('click', (e) => {
                            const t = e.target;
                            if (t && (t.tagName === 'BUTTON' || t.tagName === 'A')) return;
                            const title = card.querySelector('h3')?.textContent?.trim() || '(commande)';
                            console.log('Voir détails :', title);
                        });
                    });
                }

                if (!buttons.length || !cards.length) return;

                let emptyMsg = $('#orders-empty-filter');
                if (!emptyMsg) {
                    emptyMsg = document.createElement('p');
                    emptyMsg.id = 'orders-empty-filter';
                    emptyMsg.textContent = 'Aucune commande pour ce filtre.';
                    emptyMsg.style.cssText = 'text-align:center;color:#666;display:none;margin-top:10px;';
                    $('.orders-list')?.appendChild(emptyMsg);
                }

                const applyFilter = (filter) => {
                    let visible = 0;
                    cards.forEach(c => {
                        const status = (c.getAttribute('data-status') || '').toLowerCase();
                        const show = (filter === 'all') || (status === filter);
                        c.style.display = show ? '' : 'none';
                        if (show) visible++;
                    });
                    emptyMsg.style.display = visible ? 'none' : '';
                };

                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        buttons.forEach(b => {
                            b.classList.remove('active');
                            b.style.background = '#f1f1f1';
                            b.style.color = '#000';
                        });
                        btn.classList.add('active');
                        btn.style.background = '#1f4e5f';
                        btn.style.color = '#fff';
                        applyFilter(btn.getAttribute('data-filter') || 'all');
                    });
                });

                const active = $('.filter-btn.active');
                applyFilter(active ? active.getAttribute('data-filter') : 'all');
            }

            /* ========== 3) Menus : mobile modal & dropdowns desktop (sans doublons) ========== */
            function initMenus() {
                // Mobile
                const toggle = $('.mobile-menu-toggle');
                const modal = $('#mobileMenuModal');
                const close = $('#closeMobileMenu');
                toggle?.addEventListener('click', () => {
                    if (!modal) return;
                    modal.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                });
                close?.addEventListener('click', () => {
                    if (!modal) return;
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                });
                modal?.addEventListener('click', (e) => {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });

                // Desktop dropdowns génériques
                const toggles = $$('[id$="Toggle"]');
                toggles.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        const dropdownId = btn.id.replace(/Toggle$/, '');
                        const dd = document.getElementById(dropdownId);
                        if (!dd) return;
                        $$('.dropdown-menu').forEach(m => {
                            if (m !== dd) m.style.display = 'none';
                        });
                        dd.style.display = (dd.style.display === 'block') ? 'none' : 'block';
                    });
                });
                document.addEventListener('click', () => $$('.dropdown-menu').forEach(m => m.style.display = 'none'));
                $$('.dropdown-menu').forEach(m => m.addEventListener('click', e => e.stopPropagation()));

                // Help dropdown (une seule fois)
                const helpBtn = document.querySelector('.help-dropdown button');
                const helpDD = document.querySelector('.help-dropdown .dropdown-content');
                if (helpBtn && helpDD) {
                    helpBtn.addEventListener('click', (e) => {
                        e.stopPropagation();
                        helpDD.style.display = (helpDD.style.display === 'block') ? 'none' : 'block';
                    });
                    document.addEventListener('click', () => helpDD.style.display = 'none');
                    helpDD.addEventListener('click', e => e.stopPropagation());
                }
            }

            /* ========== 4) Langue + Pays/Devise (une seule source) ========== */
            const countries = [{
                    code: 'FR',
                    name: 'France',
                    currency: 'EUR',
                    symbol: '€',
                    flag: 'fr'
                },
                {
                    code: 'DE',
                    name: 'Allemagne',
                    currency: 'EUR',
                    symbol: '€',
                    flag: 'de'
                },
                {
                    code: 'US',
                    name: 'États-Unis',
                    currency: 'USD',
                    symbol: '$',
                    flag: 'us'
                },
                {
                    code: 'GB',
                    name: 'Royaume-Uni',
                    currency: 'GBP',
                    symbol: '£',
                    flag: 'gb'
                },
                {
                    code: 'JP',
                    name: 'Japon',
                    currency: 'JPY',
                    symbol: '¥',
                    flag: 'jp'
                },
                {
                    code: 'CA',
                    name: 'Canada',
                    currency: 'CAD',
                    symbol: '$',
                    flag: 'ca'
                },
                {
                    code: 'AU',
                    name: 'Australie',
                    currency: 'AUD',
                    symbol: '$',
                    flag: 'au'
                },
                {
                    code: 'CN',
                    name: 'Chine',
                    currency: 'CNY',
                    symbol: '¥',
                    flag: 'cn'
                },
                {
                    code: 'BR',
                    name: 'Brésil',
                    currency: 'BRL',
                    symbol: 'R$',
                    flag: 'br'
                },
                {
                    code: 'IN',
                    name: 'Inde',
                    currency: 'INR',
                    symbol: '₹',
                    flag: 'in'
                },
            ];
            const translations = {
                fr: {
                    search_placeholder: "Rechercher des meubles, décoration...",
                    select_country: "Sélectionnez votre pays",
                    search_country: "Rechercher un pays..."
                },
                en: {
                    search_placeholder: "Search for furniture, decor...",
                    select_country: "Select your country",
                    search_country: "Search for a country..."
                },
                es: {
                    search_placeholder: "Buscar muebles, decoración...",
                    select_country: "Selecciona tu país",
                    search_country: "Buscar un país..."
                },
            };

            function initLangCountry() {
                // Langue
                const langBtn = $('#languageToggle');
                const langDD = $('#dropdownLanguage');
                const searchInput = $('.search-container input');
                const countrySearch = $('#countrySearch');

                function applyLanguage(lang) {
                    const dict = translations[lang] || translations.fr;
                    $$('.translate').forEach(el => {
                        const key = el.getAttribute('data-key');
                        if (key && dict[key]) el.textContent = dict[key];
                    });
                    if (searchInput && dict.search_placeholder) searchInput.placeholder = dict.search_placeholder;
                    if (countrySearch && dict.search_country) countrySearch.placeholder = dict.search_country;
                    const codeEl = $('.language-code');
                    if (codeEl) codeEl.textContent = (lang || 'fr').toUpperCase();
                    localStorage.setItem('preferredLanguage', lang);
                }
                // Exposer la fonction si des appels inline existent
                window.changeLanguage = (lang) => {
                    applyLanguage(lang);
                    langDD && (langDD.style.display = 'none');
                };

                langBtn?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (!langDD) return;
                    langDD.style.display = (langDD.style.display === 'block') ? 'none' : 'block';
                });
                document.addEventListener('click', () => langDD && (langDD.style.display = 'none'));
                langDD?.addEventListener('click', e => e.stopPropagation());

                const saved = localStorage.getItem('preferredLanguage');
                const browser = (navigator.language || 'fr').slice(0, 2);
                applyLanguage(saved || (translations[browser] ? browser : 'fr'));

                // Pays/Devise
                const countryToggle = $('#countryToggle');
                const dropdownCountry = $('#dropdownCountry');
                const countryList = $('#countryList');
                const closeCountryMenu = $('#closeCountryMenu');

                function generateCountryList(filter = '') {
                    if (!countryList) return;
                    countryList.innerHTML = '';
                    const set = filter ? countries.filter(c => c.name.toLowerCase().includes(filter.toLowerCase())) :
                        countries;
                    set.forEach(c => {
                        const el = document.createElement('div');
                        el.className = 'country-option';
                        el.style.cssText =
                            'display:flex;align-items:center;padding:10px 15px;cursor:pointer;border-bottom:1px solid #f5f5f5;';
                        el.innerHTML = `
          <span style="width:25px;height:18px;background-image:url('https://flagcdn.com/w20/${c.flag}.png');background-size:cover;margin-right:10px;"></span>
          <span style="flex:1;font-size:14px;">${c.name}</span>
          <span style="color:#666;font-size:13px;">${c.symbol} ${c.currency}</span>`;
                        el.addEventListener('click', () => selectCountry(c));
                        countryList.appendChild(el);
                    });
                }

                function selectCountry(c) {
                    const flagEl = $('.country-flag');
                    const codeEl = $('.country-code');
                    if (flagEl) flagEl.style.backgroundImage = `url('https://flagcdn.com/w20/${c.flag}.png')`;
                    if (codeEl) codeEl.textContent = c.code;
                    dropdownCountry && (dropdownCountry.style.display = 'none');
                    convertPrices(c.currency);
                    console.log(`Pays: ${c.name} / Devise: ${c.currency}`);
                }

                countryToggle?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    if (!dropdownCountry) return;
                    dropdownCountry.style.display = (dropdownCountry.style.display === 'block') ? 'none' :
                        'block';
                    if (dropdownCountry.style.display === 'block') {
                        generateCountryList();
                        countrySearch?.focus();
                    }
                });
                closeCountryMenu?.addEventListener('click', () => dropdownCountry && (dropdownCountry.style.display =
                    'none'));
                countrySearch?.addEventListener('input', (e) => generateCountryList(e.target.value));
                document.addEventListener('click', (e) => {
                    if (!e.target.closest('.country-dropdown') && dropdownCountry) dropdownCountry.style
                        .display = 'none';
                });
            }

            /* ========== 5) Header auto-hide ========== */
            function initHeaderAutoHide() {
                const header = $('#mainHeader');
                if (!header) return;
                let last = 0;
                window.addEventListener('scroll', () => {
                    const y = window.pageYOffset || document.documentElement.scrollTop;
                    header.style.top = (y > last) ? '-150px' : '0';
                    last = y <= 0 ? 0 : y;
                });
            }

            /* ========== 6) Lazy YouTube ========== */
            function initYouTubeLazy() {
                const iframe = $('.youtube-container iframe');
                if (!iframe) return;
                iframe.setAttribute('src', iframe.getAttribute('src') || '');
            }

            /* ========== 7) Likes (UI locale) ========== */
            function initLikes() {
                $$('.like-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        this.classList.toggle('liked');
                        const icon = this.querySelector('i');
                        if (!icon) return;
                        if (this.classList.contains('liked')) {
                            icon.classList.remove('far');
                            icon.classList.add('fas');
                        } else {
                            icon.classList.remove('fas');
                            icon.classList.add('far');
                        }
                    });
                });
            }

            /* ========== 8) Panier & Checkout (UI locale) ========== */
            function initCartAndCheckout() {
                const cartIcon = $('#cart-icon');
                const cartCount = cartIcon?.querySelector('.cart-count');
                const checkoutModal = $('#checkout-modal');
                const closeModal = $('.close-modal');
                const cartItemsContainer = $('#cart-items');
                const subtotalElement = $('#subtotal');
                const totalElement = $('#total');

                let cart = [];

                const updateCartCount = () => {
                    if (!cartCount) return;
                    const items = cart.reduce((t, it) => t + it.quantity, 0);
                    cartCount.textContent = items;
                };
                const updateCartDisplay = () => {
                    if (!cartItemsContainer || !subtotalElement || !totalElement) return;
                    cartItemsContainer.innerHTML = '';
                    if (!cart.length) {
                        cartItemsContainer.innerHTML = '<p>Votre panier est vide.</p>';
                        subtotalElement.textContent = '€0.00';
                        totalElement.textContent = '€0.00';
                        return;
                    }
                    let subtotal = 0;
                    cart.forEach(it => {
                        const itemTotal = it.price * it.quantity;
                        subtotal += itemTotal;
                        const row = document.createElement('div');
                        row.className = 'summary-item';
                        row.innerHTML =
                            `<span>${it.name} x${it.quantity}</span><span>€${itemTotal.toFixed(2)}</span>`;
                        cartItemsContainer.appendChild(row);
                    });
                    subtotalElement.textContent = `€${subtotal.toFixed(2)}`;
                    totalElement.textContent = `€${subtotal.toFixed(2)}`;
                };

                cartIcon?.addEventListener('click', (e) => {
                    e.preventDefault();
                    updateCartDisplay();
                    if (checkoutModal) checkoutModal.style.display = 'block';
                });
                closeModal?.addEventListener('click', () => {
                    if (checkoutModal) checkoutModal.style.display = 'none';
                });

                $$('.btn-add-to-cart').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        const name = this.getAttribute('data-name') || 'Article';
                        const price = parseFloat(this.getAttribute('data-price') || '0');
                        const found = cart.find(it => it.id === id);
                        if (found) found.quantity += 1;
                        else cart.push({
                            id,
                            name,
                            price,
                            quantity: 1
                        });
                        updateCartCount();
                        alert(`${name} a été ajouté à votre panier !`);
                    });
                });

                // Coupon
                $('#apply-coupon')?.addEventListener('click', () => {
                    const input = $('#coupon');
                    if (!input || !subtotalElement || !totalElement) return;
                    const code = (input.value || '').trim().toUpperCase();
                    if (code !== 'KELU15') {
                        alert('Code promo invalide');
                        return;
                    }

                    const subtotal = parseFloat((subtotalElement.textContent || '0').replace('€', '')) || 0;
                    const discount = subtotal * 0.15;
                    const total = subtotal - discount;

                    let discountEl = $('#discount-element');
                    if (!discountEl) {
                        discountEl = document.createElement('div');
                        discountEl.id = 'discount-element';
                        discountEl.className = 'summary-item';
                        $('#cart-items')?.appendChild(discountEl);
                    }
                    discountEl.innerHTML = `<span>Réduction (15%)</span><span>-€${discount.toFixed(2)}</span>`;
                    totalElement.textContent = `€${total.toFixed(2)}`;
                    alert('Code promo appliqué avec succès !');
                });

                // Étapes checkout
                $('#proceed-to-delivery')?.addEventListener('click', () => {
                    $('#checkout-modal') && ($('#checkout-modal').style.display = 'none');
                    $('#delivery-modal') && ($('#delivery-modal').style.display = 'block');
                });
                $('#proceed-to-payment')?.addEventListener('click', () => {
                    $('#delivery-modal') && ($('#delivery-modal').style.display = 'none');
                    $('#payment-modal') && ($('#payment-modal').style.display = 'block');
                });
                $('#confirm-order')?.addEventListener('click', () => {
                    $('#payment-modal') && ($('#payment-modal').style.display = 'none');
                    $('#confirmation-modal') && ($('#confirmation-modal').style.display = 'block');
                });
                $('#back-to-cart')?.addEventListener('click', () => {
                    $('#delivery-modal') && ($('#delivery-modal').style.display = 'none');
                    $('#checkout-modal') && ($('#checkout-modal').style.display = 'block');
                });
                $('#back-to-delivery')?.addEventListener('click', () => {
                    $('#payment-modal') && ($('#payment-modal').style.display = 'none');
                    $('#delivery-modal') && ($('#delivery-modal').style.display = 'block');
                });
                $('#return-to-shop')?.addEventListener('click', () => {
                    window.location.href = '/';
                });

                // Expose pour ouvrir le panier ailleurs
                window.openCartModal = () => {
                    $('#checkout-modal') && ($('#checkout-modal').style.display = 'block');
                };
            }

            /* ========== 9) Init global unique (un seul DOMContentLoaded) ========== */
            document.addEventListener('DOMContentLoaded', () => {
                // AR (instancié seulement si le bouton est présent)
                if (document.getElementById('arMeasureBtn')) new ARMeasurementApp();

                initOrderUI();
                initMenus();
                initLangCountry();
                initHeaderAutoHide();
                initYouTubeLazy();
                initLikes();
                initCartAndCheckout();
            });

        })();
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

<script src="{{ asset('js/google-translate.js') }}"></script>
</body>

</html>
