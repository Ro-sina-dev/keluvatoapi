<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Finaliser votre commande</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        :root {
            --primary: #1f4e5f;
            --primary-600: #0e3948;
            --muted: #6b7280;
            --border: #e5e7eb;
            --bg: #f8fafc;
            --card: #ffffff;
            --success: #10b981;
            --danger: #ef4444;
            --ring: rgba(31, 78, 95, .18);
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, 'Helvetica Neue', Arial;
            background: var(--bg);
            color: #111827
        }

        a {
            color: inherit
        }

        .container {
            max-width: 1100px;
            margin: 28px auto;
            padding: 0 18px
        }

        /* Header + stepper */
        .page-title {
            margin: 0 0 14px;
            font-size: 28px;
            letter-spacing: .2px
        }

        .muted {
            color: var(--muted)
        }

        .stepper {
            position: relative;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin: 10px 0 22px
        }

        .stepper::before {
            content: "";
            position: absolute;
            left: 10px;
            right: 10px;
            top: 19px;
            height: 2px;
            background: #eaecef;
            z-index: 0
        }

        .step {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            z-index: 1
        }

        .step-dot {
            width: 28px;
            height: 28px;
            border-radius: 999px;
            border: 2px solid var(--primary);
            display: grid;
            place-items: center;
            font: 700 13px/1 system-ui;
            color: var(--primary);
            background: #fff
        }

        .step.active .step-dot {
            background: var(--primary);
            color: #fff
        }

        .step.completed .step-dot {
            background: var(--primary);
            color: #fff;
            opacity: .9
        }

        .step-label {
            font-weight: 600;
            font-size: 13px;
            color: #374151
        }

        .step.completed .step-label {
            opacity: .9
        }

        .step:not(.active):not(.completed) {
            opacity: .6
        }

        /* Layout */
        .layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 22px
        }

        @media (max-width: 960px) {
            .layout {
                grid-template-columns: 1fr
            }
        }

        /* Cards */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(17, 24, 39, .04)
        }

        .card-pad {
            padding: 18px
        }

        .card+.card {
            margin-top: 14px
        }

        /* Cart items */
        .cart-item {
            display: grid;
            grid-template-columns: 66px 1fr auto;
            gap: 12px;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f2f2f2
        }

        .cart-item:last-child {
            border-bottom: none
        }

        .cart-item img {
            width: 66px;
            height: 66px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #eee
        }

        .item-title {
            margin: 0;
            font-size: 15px;
            font-weight: 600
        }

        .item-meta {
            margin-top: 4px;
            color: var(--muted);
            font-size: 12px
        }

        .item-price {
            font-weight: 700
        }

        .qty {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px
        }

        .btn-ghost {
            width: 30px;
            height: 30px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 9px;
            cursor: pointer
        }

        .btn-remove {
            margin-left: 8px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 9px;
            padding: 7px 10px;
            cursor: pointer
        }

        /* Forms */
        .form-group {
            margin: 12px 0
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px
        }

        @media (max-width:640px) {
            .form-row {
                grid-template-columns: 1fr
            }
        }

        .label {
            display: block;
            margin: 0 0 6px;
            font-size: 14px;
            color: #374151;
            font-weight: 600
        }

        .control,
        select,
        textarea {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: #fff;
            outline: none;
        }

        .control:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--ring)
        }

        /* Payment */
        .pay-method {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 12px;
            transition: .15s
        }

        .pay-method.active {
            outline: 2px solid var(--primary);
            outline-offset: 0;
            background: #f9fbfc
        }

        .pay-head {
            display: flex;
            align-items: center;
            gap: 10px
        }

        .pay-head img {
            height: 22px;
            margin-left: auto;
            opacity: .85
        }

        .pay-details {
            margin-top: 10px
        }

        /* Buttons */
        .btn {
            cursor: pointer;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 12px;
            padding: 11px 14px;
            font-weight: 600
        }

        .btn:focus {
            box-shadow: 0 0 0 4px var(--ring)
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff
        }

        .btn-primary:hover {
            background: var(--primary-600);
            border-color: var(--primary-600)
        }

        .btn-secondary {
            background: #f3f4f6
        }

        .btn-row {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 16px;
            flex-wrap: wrap
        }

        /* Summary (sticky) */
        aside.summary {
            position: sticky;
            top: 20px;
            align-self: start
        }

        .summary-title {
            margin: 0 0 10px;
            font-size: 18px
        }

        .summary-line {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0
        }

        .summary-total {
            font-size: 18px;
            font-weight: 800
        }

        /* Confirmation */
        .confirm {
            text-align: center;
            padding: 12px 10px
        }

        .confirm .ico {
            font-size: 66px;
            color: var(--success);
            line-height: 1;
            margin: 6px 0
        }

        .order-kv {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #eef0f3
        }

        .order-kv:last-child {
            border-bottom: none
        }
    </style>
</head>

<body>

    @include('partials.header')

    <div class="container">
        <h1 class="page-title">Finaliser votre commande</h1>
        <p class="muted" style="margin:0 0 12px">Vérifiez votre panier, renseignez la livraison, puis payez en toute
            sécurité.</p>

        <!-- Stepper -->
        <div class="stepper">
            <div class="step active" id="stp1">
                <div class="step-dot">1</div>
                <div class="step-label">Panier</div>
            </div>
            <div class="step" id="stp2">
                <div class="step-dot">2</div>
                <div class="step-label">Livraison</div>
            </div>
            <div class="step" id="stp3">
                <div class="step-dot">3</div>
                <div class="step-label">Paiement</div>
            </div>
            <div class="step" id="stp4">
                <div class="step-dot">4</div>
                <div class="step-label">Confirmation</div>
            </div>
        </div>

        <div class="layout">
            <!-- LEFT: steps -->
            <main>
                <!-- Étape 1: Panier -->
                <section class="card card-pad" id="step-cart">
                    <h2 style="margin:0 0 14px">Votre panier</h2>
                    <p id="cart-empty" class="muted" style="display:none;margin:0 0 8px">
                        Votre panier est vide. <a href="{{ route('home') }}" class="link"
                            style="color:#2563eb;text-decoration:none">Retour à la boutique</a>
                    </p>
                    <div id="cart-items"></div>
                    <div class="btn-row">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Continuer mes achats</a>
                        <button id="go-delivery" class="btn btn-primary">Passer à la livraison</button>
                    </div>
                </section>

                <!-- Étape 2: Livraison -->
                <section class="card card-pad" id="step-delivery" style="display:none">
                    <h2 style="margin:0 0 14px">Informations de livraison</h2>

                    <div class="form-group">
                        <label class="label" for="full-name">Nom complet</label>
                        <input class="control" id="full-name" type="text" placeholder="Votre nom complet">
                    </div>

                    <div class="form-group">
                        <label class="label" for="delivery-address">Adresse</label>
                        <input class="control" id="delivery-address" type="text" placeholder="N° et rue">
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="label" for="delivery-city">Ville</label>
                            <input class="control" id="delivery-city" type="text" placeholder="Votre ville">
                        </div>
                        <div class="form-group">
                            <label class="label" for="delivery-zip">Code postal</label>
                            <input class="control" id="delivery-zip" type="text" placeholder="Code postal">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label class="label" for="delivery-country">Pays</label>
                            <select class="control" id="delivery-country">
                                <option value="FR" selected>France</option>
                                <option value="BE">Belgique</option>
                                <option value="CH">Suisse</option>
                                <option value="CA">Canada</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="label" for="delivery-phone">Téléphone</label>
                            <input class="control" id="delivery-phone" type="tel" placeholder="+33 6 12 34 56 78">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="label" for="delivery-instructions">Instructions (optionnel)</label>
                        <textarea class="control" id="delivery-instructions" rows="3" placeholder="Interphone, étage, heures, etc."></textarea>
                    </div>

                    <div class="btn-row">
                        <button id="back-cart" class="btn btn-secondary">Retour</button>
                        <button id="go-payment" class="btn btn-primary">Continuer</button>
                    </div>
                </section>

                <!-- Étape 3: Paiement -->
                <section class="card card-pad" id="step-payment" style="display:none">
                    <h2 style="margin:0 0 14px">Paiement</h2>

                    <div class="pay-method active" id="pm-card">
                        <div class="pay-head">
                            <input type="radio" name="pm" id="pmr-card" value="card" checked>
                            <label for="pmr-card"><strong>Carte bancaire</strong></label>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Credit_card_fonts_and_logos.png"
                                alt="Cartes">
                        </div>
                        <div class="pay-details" id="card-fields">
                            <div class="form-group">
                                <label class="label" for="card-number">Numéro de carte</label>
                                <input class="control" id="card-number" inputmode="numeric" autocomplete="cc-number"
                                    placeholder="1234 5678 9012 3456">
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label class="label" for="card-expiry">Expiration</label>
                                    <input class="control" id="card-expiry" inputmode="numeric"
                                        autocomplete="cc-exp" placeholder="MM/AA">
                                </div>
                                <div class="form-group">
                                    <label class="label" for="card-cvc">CVC</label>
                                    <input class="control" id="card-cvc" inputmode="numeric" autocomplete="cc-csc"
                                        placeholder="123">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="label" for="card-name">Nom sur la carte</label>
                                <input class="control" id="card-name" autocomplete="cc-name"
                                    placeholder="Votre nom">
                            </div>
                        </div>
                    </div>

                    <div class="pay-method" id="pm-paypal">
                        <div class="pay-head">
                            <input type="radio" name="pm" id="pmr-paypal" value="paypal">
                            <label for="pmr-paypal"><strong>PayPal</strong></label>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal">
                        </div>
                    </div>

                    <div class="pay-method" id="pm-cod">
                        <div class="pay-head">
                            <input type="radio" name="pm" id="pmr-cod" value="cod">
                            <label for="pmr-cod"><strong>Paiement à la livraison</strong></label>
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Money_cash.jpg"
                                alt="Cash">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top:16px">
                        <input type="checkbox" id="terms-agree">
                        <label for="terms-agree">J’accepte les <a href="#"
                                style="color:#2563eb;text-decoration:none">conditions générales de vente</a></label>
                    </div>

                    <div class="btn-row">
                        <button id="back-delivery" class="btn btn-secondary">Retour</button>
                        <button id="do-pay" class="btn btn-primary">Payer maintenant</button>
                    </div>
                </section>

                <!-- Étape 4: Confirmation -->
                <section class="card card-pad" id="step-confirm" style="display:none">
                    <div class="confirm">
                        <div class="ico">✔</div>
                        <h2 style="margin:6px 0 8px">Commande confirmée !</h2>
                        <p id="cf-text-1" class="muted" style="margin:0">Merci pour votre achat.</p>
                        <p id="cf-text-2" class="muted" style="margin:2px 0 14px">Votre commande a été enregistrée.
                        </p>
                    </div>
                    <div class="card" style="border:none">
                        <div class="card-pad">
                            <div class="order-kv"><span>Numéro</span><span id="ord-id">—</span></div>
                            <div class="order-kv"><span>Date</span><span id="ord-date">—</span></div>
                            <div class="order-kv"><span>Total</span><span id="ord-total">—</span></div>
                            <div class="order-kv"><span>Méthode</span><span id="ord-pay">—</span></div>
                            <div class="order-kv" style="align-items:flex-start">
                                <span>Livraison</span>
                                <span id="ord-addr" style="white-space:pre-line;text-align:right">—</span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-row" style="justify-content:center;margin-top:18px">
                        <a href="{{ route('home') }}" class="btn btn-primary">Retour à la boutique</a>
                    </div>
                </section>
            </main>

            <!-- RIGHT: summary sticky -->
            <aside class="summary">
                <div class="card card-pad">
                    <h3 class="summary-title">Résumé de la commande</h3>
                    <div class="summary-line"><span>Sous-total</span><span id="sum-subtotal">€0.00</span></div>
                    <div class="summary-line"><span>Livraison</span><span id="sum-ship">Gratuite</span></div>
                    <div class="summary-line"><span>Coupon</span><span id="sum-coupon" class="muted">—</span></div>
                    <div class="summary-line summary-total"><span>Total</span><span id="sum-total">€0.00</span></div>
                </div>

                <div class="card card-pad">
                    <div class="form-group" style="margin:0">
                        <label class="label" for="coupon">Code promo</label>
                        <div style="display:flex;gap:8px">
                            <input class="control" id="coupon" placeholder="Ex: KELU15" style="flex:1">
                            <button id="btn-coupon" class="btn btn-primary"
                                style="white-space:nowrap">Appliquer</button>
                        </div>
                        <div class="muted" style="margin-top:6px">Astuce : utilisez <strong>KELU15</strong> (−15%)
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        (() => {
            // ========= Config (sans API) =========
            const CURRENCY = 'EUR';
            const fmt = (n, c = CURRENCY) => new Intl.NumberFormat('fr-FR', {
                style: 'currency',
                currency: c
            }).format(+n || 0);

            // ========= Panier (localStorage) =========
            const Cart = {
                KEY: 'cart',
                get() {
                    try {
                        return JSON.parse(localStorage.getItem(this.KEY) || '[]');
                    } catch (e) {
                        return [];
                    }
                },
                set(items) {
                    localStorage.setItem(this.KEY, JSON.stringify(items));
                },
                subtotal(items = this.get()) {
                    return items.reduce((t, i) => t + (+i.price || 0) * (+i.qty || 0), 0);
                },
                updateQty(id, q) {
                    const arr = this.get();
                    const it = arr.find(x => String(x.id) === String(id));
                    if (!it) return;
                    it.qty = Math.max(0, +q || 0);
                    if (it.qty === 0) arr.splice(arr.indexOf(it), 1);
                    this.set(arr);
                    renderCart();
                    updateSummary();
                },
                remove(id) {
                    const arr = this.get().filter(x => String(x.id) !== String(id));
                    this.set(arr);
                    renderCart();
                    updateSummary();
                },
                clear() {
                    localStorage.setItem(this.KEY, '[]');
                }
            };

            // ========= Étapes & Stepper =========
            const steps = ['step-cart', 'step-delivery', 'step-payment', 'step-confirm'].map(id => document
                .getElementById(id));
            const dots = ['stp1', 'stp2', 'stp3', 'stp4'].map(id => document.getElementById(id));

            function goStep(n) {
                steps.forEach((el, i) => el.style.display = (i === n - 1) ? 'block' : 'none');
                dots.forEach((el, i) => {
                    el.classList.remove('active', 'completed');
                    if (i < n - 1) el.classList.add('completed');
                    if (i === n - 1) el.classList.add('active');
                });
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }

            // ========= Résumé (unique) =========
            let coupon = null; // {code, percent}
            const sumSub = document.getElementById('sum-subtotal');
            const sumCpn = document.getElementById('sum-coupon');
            const sumTot = document.getElementById('sum-total');

            function totals() {
                const sub = Cart.subtotal();
                const disc = coupon ? sub * (coupon.percent / 100) : 0;
                return {
                    sub,
                    disc,
                    total: Math.max(0, sub - disc)
                };
            }

            function updateSummary() {
                const {
                    sub,
                    disc,
                    total
                } = totals();
                sumSub.textContent = fmt(sub);
                sumCpn.textContent = coupon ? `-${fmt(disc)} (${coupon.code})` : '—';
                sumTot.textContent = fmt(total);
            }

            // ========= Rendu panier (étape 1) =========
            const cartList = document.getElementById('cart-items');
            const cartEmpty = document.getElementById('cart-empty');

            function renderCart() {
                const items = Cart.get();
                if (!items.length) {
                    cartEmpty.style.display = 'block';
                    cartList.innerHTML = '';
                    return;
                }
                cartEmpty.style.display = 'none';
                cartList.innerHTML = items.map(it => {
                    const line = (+it.price || 0) * (+it.qty || 0);
                    return `
        <div class="cart-item" data-id="${it.id}">
          <img src="${it.image || 'https://via.placeholder.com/66?text=IMG'}" alt="${(it.name||'').replace(/"/g,'&quot;')}">
          <div>
            <h3 class="item-title">${(it.name||'').replace(/</g,'&lt;')}</h3>
            <div class="item-meta">${fmt(it.price, it.currency||CURRENCY)}</div>
            <div class="qty">
              <button class="btn-ghost" data-act="dec">−</button>
              <span class="qv">${it.qty}</span>
              <button class="btn-ghost" data-act="inc">+</button>
              <button class="btn-remove" data-act="rm">Supprimer</button>
            </div>
          </div>
          <div class="item-price">${fmt(line, it.currency||CURRENCY)}</div>
        </div>`;
                }).join('');

                // Bind
                cartList.querySelectorAll('.cart-item').forEach(row => {
                    const id = row.getAttribute('data-id');
                    row.querySelector('[data-act="inc"]').addEventListener('click', () => {
                        const it = Cart.get().find(x => String(x.id) === String(id));
                        Cart.updateQty(id, (+it?.qty || 0) + 1);
                    });
                    row.querySelector('[data-act="dec"]').addEventListener('click', () => {
                        const it = Cart.get().find(x => String(x.id) === String(id));
                        Cart.updateQty(id, (+it?.qty || 0) - 1);
                    });
                    row.querySelector('[data-act="rm"]').addEventListener('click', () => Cart.remove(id));
                });
            }

            // ========= Coupon =========
            document.getElementById('btn-coupon').addEventListener('click', () => {
                const code = (document.getElementById('coupon').value || '').trim().toUpperCase();
                if (!code) {
                    coupon = null;
                    updateSummary();
                    alert('Aucun code saisi.');
                    return;
                }
                if (code === 'KELU15') {
                    coupon = {
                        code,
                        percent: 15
                    };
                    updateSummary();
                    alert('Réduction de 15% appliquée ✅');
                } else {
                    coupon = null;
                    updateSummary();
                    alert('Code invalide ❌');
                }
            });

            // ========= Navigation =========
            document.getElementById('go-delivery').addEventListener('click', () => {
                if (!Cart.get().length) {
                    alert('Votre panier est vide.');
                    return;
                }
                goStep(2);
            });
            document.getElementById('back-cart').addEventListener('click', () => goStep(1));

            // toggle méthodes de paiement
            const pmrCard = document.getElementById('pmr-card');
            const pmrPayPal = document.getElementById('pmr-paypal');
            const pmrCod = document.getElementById('pmr-cod');
            const pmCard = document.getElementById('pm-card');
            const pmPayPal = document.getElementById('pm-paypal');
            const pmCod = document.getElementById('pm-cod');
            const cardFields = document.getElementById('card-fields');;
            [pmrCard, pmrPayPal, pmrCod].forEach(r => {
                r.addEventListener('change', () => {
                    pmCard.classList.toggle('active', pmrCard.checked);
                    pmPayPal.classList.toggle('active', pmrPayPal.checked);
                    pmCod.classList.toggle('active', pmrCod.checked);
                    cardFields.style.display = pmrCard.checked ? 'block' : 'none';
                });
            });

            document.getElementById('go-payment').addEventListener('click', () => {
                const name = document.getElementById('full-name').value.trim();
                const addr = document.getElementById('delivery-address').value.trim();
                const city = document.getElementById('delivery-city').value.trim();
                const zip = document.getElementById('delivery-zip').value.trim();
                const phone = document.getElementById('delivery-phone').value.trim();
                if (!name || !addr || !city || !zip || !phone) {
                    alert('Merci de compléter tous les champs requis de livraison.');
                    return;
                }
                goStep(3);
            });
            document.getElementById('back-delivery').addEventListener('click', () => goStep(2));

            // ========= "Paiement" local & Confirmation (sans appel serveur) =========
            document.getElementById('do-pay').addEventListener('click', () => {
                if (!document.getElementById('terms-agree').checked) {
                    alert('Veuillez accepter les CGV.');
                    return;
                }
                const items = Cart.get();
                if (!items.length) {
                    alert('Votre panier est vide.');
                    return;
                }

                const shipping = {
                    name: document.getElementById('full-name').value.trim(),
                    address: document.getElementById('delivery-address').value.trim(),
                    city: document.getElementById('delivery-city').value.trim(),
                    zip: document.getElementById('delivery-zip').value.trim(),
                    country: document.getElementById('delivery-country').value,
                };
                const method = (document.querySelector('input[name="pm"]:checked') || {}).value || 'card';
                const {
                    total
                } = totals();

                // Génère un numéro de commande local lisible
                const orderId = 'CMD-' + new Date().toISOString().replace(/[-:.TZ]/g, '').slice(0, 14);

                // Remplit la confirmation
                document.getElementById('ord-id').textContent = orderId;
                document.getElementById('ord-date').textContent = new Date().toLocaleString('fr-FR');
                document.getElementById('ord-total').textContent = fmt(total);
                document.getElementById('ord-pay').textContent = method.toUpperCase();
                document.getElementById('ord-addr').textContent =
                    `${shipping.name}\n${shipping.address}\n${shipping.zip} ${shipping.city}\n${shipping.country}`;
                document.getElementById('cf-text-1').textContent = `Merci pour votre achat, ${shipping.name}.`;
                document.getElementById('cf-text-2').textContent =
                    `Votre commande ${orderId} a été passée avec succès.`;

                // Vide le panier
                Cart.clear();
                goStep(4);
            });

            // ========= Sync avec serveur =========
            async function syncCartWithServer() {
                const cartData = Cart.get();
                try {
                    await fetch('/checkout/sync', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ cart: cartData })
                    });
                } catch (error) {
                    console.error('Erreur sync panier:', error);
                }
            }

            // ========= Init =========
            function init() {
                renderCart();
                updateSummary();
                syncCartWithServer(); // Synchroniser le panier au chargement
                goStep(1);
            }
            
            init();
        })();
    </script>

<script src="{{ asset('js/google-translate.js') }}"></script>
</body>

</html>
