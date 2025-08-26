<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Finaliser votre commande</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
  :root{--primary:#1f4e5f;--muted:#6b7280;--border:#e5e7eb;--bg:#f8fafc}
  *{box-sizing:border-box}
  body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial;background:var(--bg);color:#111827}
  .container{max-width:960px;margin:24px auto;padding:0 16px}
  .checkout-container{background:#fff;border:1px solid var(--border);border-radius:14px;padding:24px}
  .checkout-title{margin:0 0 18px 0;font-size:28px}
  .progress-steps{display:flex;gap:12px;flex-wrap:wrap;margin:8px 0 20px}
  .step{display:flex;align-items:center;gap:8px;opacity:.5}
  .step .step-number{width:28px;height:28px;border-radius:999px;border:2px solid var(--primary);display:flex;align-items:center;justify-content:center;font-weight:700;color:var(--primary)}
  .step .step-label{font-weight:600}
  .step.active{opacity:1}
  .step.completed{opacity:.9}
  .step.completed .step-number{background:var(--primary);color:#fff}
  .checkout-content{margin-top:10px}
  .step-title{margin:6px 0 14px 0}
  .cart-item{display:grid;grid-template-columns:64px 1fr auto;gap:12px;align-items:center;padding:10px 0;border-bottom:1px solid #f2f2f2}
  .cart-item-img{width:64px;height:64px;object-fit:cover;border-radius:8px;border:1px solid #eee}
  .cart-item-title{margin:0;font-size:15px;font-weight:600}
  .cart-item-meta{margin:4px 0 0 0;color:var(--muted);font-size:12px}
  .cart-item-price{font-weight:600}
  .qty{display:flex;align-items:center;gap:8px;margin-top:6px}
  .qty button{width:28px;height:28px;border:1px solid #ddd;background:#fff;border-radius:8px;cursor:pointer}
  .remove-btn{margin-left:8px;border:1px solid #ddd;background:#fff;border-radius:8px;padding:6px 8px;cursor:pointer}
  .order-summary{border:1px solid var(--border);border-radius:12px;padding:12px;margin:16px 0;background:#fafafa}
  .summary-item{display:flex;justify-content:space-between;align-items:center;padding:6px 0}
  .summary-total{font-size:18px;font-weight:700}
  .form-group{margin:12px 0}
  .form-row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
  .form-label{display:block;margin:0 0 6px 0;font-size:14px;color:#374151}
  .form-control, select, textarea{width:100%;padding:10px;border:1px solid var(--border);border-radius:8px;background:#fff}
  .btn{cursor:pointer;border:1px solid var(--border);background:#fff;border-radius:10px;padding:11px 14px}
  .btn-primary{background:var(--primary);border-color:var(--primary);color:#fff}
  .btn-secondary{background:#f3f4f6}
  .btn-group{display:flex;gap:10px;justify-content:flex-end;margin-top:16px}
  .payment-methods{display:flex;flex-direction:column;gap:12px}
  .payment-method{border:1px solid var(--border);border-radius:12px;padding:12px}
  .payment-method.active{outline:2px solid var(--primary);outline-offset:0}
  .payment-method-header{display:flex;align-items:center;gap:10px}
  .payment-method-icon{height:22px;margin-left:auto;opacity:.8}
  .payment-details{margin-top:10px}
  .confirmation-message{text-align:center;margin:10px 0 20px}
  .confirmation-icon{font-size:64px;color:#10b981;margin:6px 0}
  .order-details{border:1px solid var(--border);border-radius:12px;padding:12px;background:#fafafa}
  .muted{color:var(--muted);font-size:14px}
  .link{color:#2563eb;text-decoration:none}
  @media (max-width:640px){.form-row{grid-template-columns:1fr}}
</style>
</head>
<body>

<div class="container">
  <div class="checkout-container">
    <h1 class="checkout-title">Finaliser votre commande</h1>

    <!-- Barre de progression -->
    <div class="progress-steps">
      <div class="step active" id="step1">
        <div class="step-number">1</div><div class="step-label">Panier</div>
      </div>
      <div class="step" id="step2">
        <div class="step-number">2</div><div class="step-label">Livraison</div>
      </div>
      <div class="step" id="step3">
        <div class="step-number">3</div><div class="step-label">Paiement</div>
      </div>
      <div class="step" id="step4">
        <div class="step-number">4</div><div class="step-label">Confirmation</div>
      </div>
    </div>

    <!-- Étape 1: Panier -->
    <div class="checkout-content" id="cart-step">
      <h2 class="step-title">Votre panier</h2>
      <div id="cart-empty" class="muted" style="display:none">Votre panier est vide. <a href="index.html" class="link">Retour à la boutique</a></div>
      <div id="cart-items"></div>

      <div class="order-summary">
        <div class="summary-item"><span>Sous-total</span><span id="subtotal">€0.00</span></div>
        <div class="summary-item"><span>Livraison</span><span id="shipping">Gratuite</span></div>
        <div class="summary-item"><span>Coupon</span><span id="couponLine" class="muted">—</span></div>
        <div class="summary-item summary-total"><span>Total</span><span id="total">€0.00</span></div>
      </div>

      <div class="form-group">
        <label for="coupon" class="form-label">Code promo</label>
        <div style="display:flex;gap:10px">
          <input type="text" id="coupon" class="form-control" placeholder="Ex: KELU15">
          <button id="apply-coupon" class="btn btn-primary" style="width:auto">Appliquer</button>
        </div>
        <div class="muted" style="margin-top:6px">Astuce : utilisez <strong>KELU15</strong> pour −15% (démo).</div>
      </div>

      <div class="btn-group">
        <a href="index.html" class="btn btn-secondary">Continuer mes achats</a>
        <button id="proceed-to-delivery" class="btn btn-primary">Passer à la livraison</button>
      </div>
    </div>

    <!-- Étape 2: Livraison -->
    <div class="checkout-content" id="delivery-step" style="display:none">
      <h2 class="step-title">Informations de livraison</h2>

      <div class="form-group">
        <label for="full-name" class="form-label">Nom complet</label>
        <input type="text" id="full-name" class="form-control" placeholder="Votre nom complet">
      </div>

      <div class="form-group">
        <label for="delivery-address" class="form-label">Adresse</label>
        <input type="text" id="delivery-address" class="form-control" placeholder="N° et rue">
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="delivery-city" class="form-label">Ville</label>
          <input type="text" id="delivery-city" class="form-control" placeholder="Votre ville">
        </div>
        <div class="form-group">
          <label for="delivery-zip" class="form-label">Code postal</label>
          <input type="text" id="delivery-zip" class="form-control" placeholder="Code postal">
        </div>
      </div>

      <div class="form-group">
        <label for="delivery-country" class="form-label">Pays</label>
        <select id="delivery-country" class="form-control">
          <option value="FR" selected>France</option>
          <option value="BE">Belgique</option>
          <option value="CH">Suisse</option>
          <option value="CA">Canada</option>
        </select>
      </div>

      <div class="form-group">
        <label for="delivery-phone" class="form-label">Téléphone</label>
        <input type="tel" id="delivery-phone" class="form-control" placeholder="+33 6 12 34 56 78">
      </div>

      <div class="form-group">
        <label for="delivery-instructions" class="form-label">Instructions de livraison (optionnel)</label>
        <textarea id="delivery-instructions" class="form-control" rows="3" placeholder="Interphone, étage, etc."></textarea>
      </div>

      <div class="order-summary">
        <div class="summary-item"><span>Sous-total</span><span id="subtotal-2">€0.00</span></div>
        <div class="summary-item"><span>Livraison</span><span>Gratuite</span></div>
        <div class="summary-item"><span>Coupon</span><span id="couponLine-2" class="muted">—</span></div>
        <div class="summary-item summary-total"><span>Total</span><span id="total-2">€0.00</span></div>
      </div>

      <div class="btn-group">
        <button id="back-to-cart" class="btn btn-secondary">Retour</button>
        <button id="proceed-to-payment" class="btn btn-primary">Continuer</button>
      </div>
    </div>

    <!-- Étape 3: Paiement -->
    <div class="checkout-content" id="payment-step" style="display:none">
      <h2 class="step-title">Méthode de paiement</h2>

      <div class="payment-methods">
        <div class="payment-method active" id="credit-card-method">
          <div class="payment-method-header">
            <input type="radio" name="payment-method" id="credit-card" class="payment-method-radio" value="card" checked>
            <label for="credit-card" class="payment-method-label">Carte de crédit</label>
            <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Credit_card_fonts_and_logos.png" alt="Cartes" class="payment-method-icon">
          </div>
          <div class="payment-details" id="card-fields">
            <div class="form-group">
              <label for="card-number" class="form-label">Numéro de carte</label>
              <input type="text" id="card-number" class="form-control" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="card-expiry" class="form-label">Expiration</label>
                <input type="text" id="card-expiry" class="form-control" placeholder="MM/AA">
              </div>
              <div class="form-group">
                <label for="card-cvc" class="form-label">CVC</label>
                <input type="text" id="card-cvc" class="form-control" placeholder="123">
              </div>
            </div>
            <div class="form-group">
              <label for="card-name" class="form-label">Nom sur la carte</label>
              <input type="text" id="card-name" class="form-control" placeholder="Votre nom">
            </div>
          </div>
        </div>

        <div class="payment-method" id="paypal-method">
          <div class="payment-method-header">
            <input type="radio" name="payment-method" id="paypal" class="payment-method-radio" value="paypal">
            <label for="paypal" class="payment-method-label">PayPal</label>
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" class="payment-method-icon">
          </div>
        </div>

        <div class="payment-method" id="cod-method">
          <div class="payment-method-header">
            <input type="radio" name="payment-method" id="cod" class="payment-method-radio" value="cod">
            <label for="cod" class="payment-method-label">Paiement à la livraison</label>
            <img src="https://upload.wikimedia.org/wikipedia/commons/3/3c/Money_cash.jpg" alt="Cash" class="payment-method-icon">
          </div>
        </div>
      </div>

      <div class="form-group" style="margin-top:18px">
        <input type="checkbox" id="terms-agree">
        <label for="terms-agree">J'accepte les <a href="#" class="link">conditions générales de vente</a></label>
      </div>

      <div class="order-summary">
        <div class="summary-item"><span>Sous-total</span><span id="subtotal-3">€0.00</span></div>
        <div class="summary-item"><span>Livraison</span><span>Gratuite</span></div>
        <div class="summary-item"><span>Coupon</span><span id="couponLine-3" class="muted">—</span></div>
        <div class="summary-item summary-total"><span>Total</span><span id="total-3">€0.00</span></div>
      </div>

      <div class="btn-group">
        <button id="back-to-delivery" class="btn btn-secondary">Retour</button>
        <button id="confirm-order" class="btn btn-primary">Payer maintenant</button>
      </div>
    </div>

    <!-- Étape 4: Confirmation -->
    <div class="checkout-content" id="confirmation-step" style="display:none">
      <div class="confirmation-message">
        <div class="confirmation-icon">✔</div>
        <h2 class="confirmation-title">Commande confirmée !</h2>
        <p class="confirmation-text" id="confirm-text-1">Merci pour votre achat.</p>
        <p class="confirmation-text" id="confirm-text-2">Votre commande a été enregistrée.</p>
      </div>

      <div class="order-details" id="order-details">
        <h3 class="order-details-title" style="margin-top:0">Détails de la commande</h3>
        <div class="summary-item"><span>Numéro</span><span id="ord-id">—</span></div>
        <div class="summary-item"><span>Date</span><span id="ord-date">—</span></div>
        <div class="summary-item"><span>Total</span><span id="ord-total">—</span></div>
        <div class="summary-item"><span>Méthode de paiement</span><span id="ord-pay">—</span></div>
        <div class="summary-item"><span>Adresse de livraison</span>
          <span id="ord-addr" style="white-space:pre-line">—</span>
        </div>
      </div>

      <button id="return-to-shop" class="btn btn-primary" style="margin-top:22px">Retour à la boutique</button>
    </div>
  </div>
</div>

<script>
(function(){
  // ---------- CONFIG
  const API_BASE = 'http://127.0.0.1:8000/api/v1';
  const TOKEN    = localStorage.getItem('userToken') || localStorage.getItem('token_admin');
  const CURRENCY = 'EUR';

  // ---------- CART STORE (localStorage)
  const Cart = {
    KEY:'cart',
    get(){ try{ return JSON.parse(localStorage.getItem(this.KEY)||'[]'); }catch{return []} },
    set(items){ localStorage.setItem(this.KEY, JSON.stringify(items)); },
    updateQty(id, qty){
      const arr=this.get(); const r=arr.find(i=>String(i.id)===String(id));
      if(!r) return; r.qty=+qty||0; if(r.qty<=0) arr.splice(arr.indexOf(r),1);
      this.set(arr); renderCart(); syncSummaries();
    },
    remove(id){ const arr=this.get().filter(i=>String(i.id)!==String(id)); this.set(arr); renderCart(); syncSummaries(); },
    subtotal(items=this.get()){ return items.reduce((t,i)=>t+(Number(i.price)||0)*(Number(i.qty)||0),0); },
    clear(){ localStorage.setItem(this.KEY,'[]'); }
  };

  // ---------- FORMATTERS
  const fmt = (n,c=CURRENCY,loc='fr-FR')=>{
    try{ return new Intl.NumberFormat(loc,{style:'currency',currency:c}).format(+n||0); }
    catch{ return `${(+n||0).toFixed(2)} ${c}`; }
  };

  // ---------- STEPS UI
  const stepEls = [ 'cart-step','delivery-step','payment-step','confirmation-step' ].map(id=>document.getElementById(id));
  const progEls = [ 'step1','step2','step3','step4' ].map(id=>document.getElementById(id));
  function setStep(n){ // 1..4
    stepEls.forEach((el,i)=> el.style.display = (i===n-1)?'block':'none');
    progEls.forEach((el,i)=>{
      el.classList.remove('active','completed');
      if (i < n-1) el.classList.add('completed');
      if (i === n-1) el.classList.add('active');
    });
    window.scrollTo({top:0,behavior:'smooth'});
  }

  // ---------- COUPON (démo)
  let coupon = null; // {code,percent}
  function applyCoupon(code){
    code = (code||'').trim().toUpperCase();
    if (!code) { coupon=null; paintTotals(); return {ok:false,msg:'Aucun code'}; }
    if (code === 'KELU15'){ coupon = {code, percent:15}; paintTotals(); return {ok:true,msg:'Réduction de 15% appliquée'}; }
    coupon=null; paintTotals(); return {ok:false,msg:'Code invalide'};
  }

  // ---------- RENDER PANIER (étape 1)
  const cartItemsEl = document.getElementById('cart-items');
  const cartEmptyEl = document.getElementById('cart-empty');
  const subtotalEl  = document.getElementById('subtotal');
  const totalEl     = document.getElementById('total');
  const couponLine  = document.getElementById('couponLine');

  function renderCart(){
    const items = Cart.get();
    if(!items.length){
      cartEmptyEl.style.display='block';
      cartItemsEl.innerHTML='';
      subtotalEl.textContent = fmt(0,CURRENCY);
      totalEl.textContent    = fmt(0,CURRENCY);
      couponLine.textContent = '—';
      return;
    }
    cartEmptyEl.style.display='none';

    cartItemsEl.innerHTML = items.map(it=>{
      const line = (Number(it.price)||0)*(Number(it.qty)||0);
      return `
        <div class="cart-item" data-id="${it.id}">
          <img src="${it.image||'https://via.placeholder.com/64?text=IMG'}" alt="" class="cart-item-img">
          <div>
            <h3 class="cart-item-title">${(it.name||'').replace(/</g,'&lt;')}</h3>
            <div class="muted">${fmt(it.price, it.currency||CURRENCY)}</div>
            <div class="qty">
              <button data-act="dec">−</button>
              <span class="qv">${it.qty}</span>
              <button data-act="inc">+</button>
              <button class="remove-btn" data-act="rm">Supprimer</button>
            </div>
          </div>
          <div class="cart-item-price">${fmt(line, it.currency||CURRENCY)}</div>
        </div>`;
    }).join('');

    // bind actions
    cartItemsEl.querySelectorAll('.cart-item').forEach(row=>{
      const id = row.getAttribute('data-id');
      row.querySelector('[data-act="inc"]').addEventListener('click', ()=>{
        const it = Cart.get().find(i=>String(i.id)===String(id)); Cart.updateQty(id, (Number(it?.qty)||0)+1);
      });
      row.querySelector('[data-act="dec"]').addEventListener('click', ()=>{
        const it = Cart.get().find(i=>String(i.id)===String(id)); Cart.updateQty(id, (Number(it?.qty)||0)-1);
      });
      row.querySelector('[data-act="rm"]').addEventListener('click', ()=> Cart.remove(id));
    });

    paintTotals();
  }

  function calcTotals(){
    const sub = Cart.subtotal();
    const disc = coupon ? sub * (coupon.percent/100) : 0;
    const total = Math.max(0, sub - disc);
    return {sub, disc, total};
  }

  function paintTotals(){
    const {sub, disc, total} = calcTotals();
    subtotalEl.textContent = fmt(sub, CURRENCY);
    totalEl.textContent    = fmt(total, CURRENCY);
    couponLine.textContent = coupon ? `-${fmt(disc,CURRENCY)} (${coupon.code})` : '—';
    // mirroirs sur étapes 2/3
    document.getElementById('subtotal-2').textContent = fmt(sub,CURRENCY);
    document.getElementById('total-2').textContent    = fmt(total,CURRENCY);
    document.getElementById('couponLine-2').textContent = coupon ? `-${fmt(disc,CURRENCY)} (${coupon.code})` : '—';
    document.getElementById('subtotal-3').textContent = fmt(sub,CURRENCY);
    document.getElementById('total-3').textContent    = fmt(total,CURRENCY);
    document.getElementById('couponLine-3').textContent = coupon ? `-${fmt(disc,CURRENCY)} (${coupon.code})` : '—';
  }

  function syncSummaries(){ paintTotals(); }

  // ---------- NAVIGATION BOUTONS
  document.getElementById('apply-coupon').addEventListener('click', ()=>{
    const code = document.getElementById('coupon').value;
    const res = applyCoupon(code);
    alert(res.msg);
  });

  document.getElementById('proceed-to-delivery').addEventListener('click', ()=>{
    if (!Cart.get().length){ alert('Votre panier est vide.'); return; }
    setStep(2);
  });

  document.getElementById('back-to-cart').addEventListener('click', ()=> setStep(1));

  // Paiement: selection méthode → highlight + champs
  const payRadios = document.querySelectorAll('input[name="payment-method"]');
  payRadios.forEach(r=>{
    r.addEventListener('change', ()=>{
      document.getElementById('credit-card-method').classList.toggle('active', document.getElementById('credit-card').checked);
      document.getElementById('paypal-method').classList.toggle('active', document.getElementById('paypal').checked);
      document.getElementById('cod-method').classList.toggle('active', document.getElementById('cod').checked);
      document.getElementById('card-fields').style.display = document.getElementById('credit-card').checked ? 'block' : 'none';
    });
  });

  document.getElementById('proceed-to-payment').addEventListener('click', ()=>{
    // mini validation livraison
    const name = document.getElementById('full-name').value.trim();
    const addr = document.getElementById('delivery-address').value.trim();
    const city = document.getElementById('delivery-city').value.trim();
    const zip  = document.getElementById('delivery-zip').value.trim();
    const phone= document.getElementById('delivery-phone').value.trim();
    if (!name || !addr || !city || !zip || !phone){
      alert('Merci de compléter tous les champs requis de livraison.');
      return;
    }
    setStep(3);
  });

  document.getElementById('back-to-delivery').addEventListener('click', ()=> setStep(2));

  // ---------- CONFIRMATION / POST ORDER
  document.getElementById('confirm-order').addEventListener('click', async ()=>{
    if (!document.getElementById('terms-agree').checked){
      alert("Veuillez accepter les conditions générales de vente.");
      return;
    }
    const items = Cart.get();
    if (!items.length){ alert('Votre panier est vide.'); return; }

    const shipping = {
      name: document.getElementById('full-name').value.trim(),
      address: document.getElementById('delivery-address').value.trim(),
      city: document.getElementById('delivery-city').value.trim(),
      zip: document.getElementById('delivery-zip').value.trim(),
      country: document.getElementById('delivery-country').value,
      phone: document.getElementById('delivery-phone').value.trim(),
      instructions: document.getElementById('delivery-instructions').value.trim()
    };
    const method = (document.querySelector('input[name="payment-method"]:checked')||{}).value || 'card';

    const payload = {
      items: items.map(i=>({ product_id: i.id, qty: Number(i.qty)||1 })),
      shipping,
      payment_method: method,
      coupon: coupon?.code || null
    };

    try{
      const res = await fetch(`${API_BASE}/orders`, {
        method:'POST',
        headers:{
          'Content-Type':'application/json',
          'Accept':'application/json',
          ...(TOKEN ? { 'Authorization': `Bearer ${TOKEN}` } : {})
        },
        body: JSON.stringify(payload)
      });
      const data = await res.json().catch(()=> ({}));
      if (!res.ok){
        console.error('Order error', data);
        alert(data?.message || `Erreur (${res.status}) lors de la commande`);
        return;
      }

      // succès → vider panier + afficher confirmation
      const { sub, disc, total } = calcTotals();
      Cart.clear();

      // Remplir la page confirmation
      document.getElementById('ord-id').textContent   = data.id || data.number || '—';
      document.getElementById('ord-date').textContent = new Date().toLocaleString('fr-FR');
      document.getElementById('ord-total').textContent= fmt(total, CURRENCY);
      document.getElementById('ord-pay').textContent  = method.toUpperCase();
      document.getElementById('ord-addr').textContent =
        `${shipping.name}\n${shipping.address}\n${shipping.zip} ${shipping.city}\n${shipping.country}`;

      document.getElementById('confirm-text-1').textContent = `Merci pour votre achat, ${shipping.name}.`;
      document.getElementById('confirm-text-2').textContent = `Votre commande #${data.id||'—'} a été passée avec succès.`;

      setStep(4);
    }catch(err){
      console.error(err);
      alert('Erreur réseau lors de la commande.');
    }
  });

  document.getElementById('return-to-shop').addEventListener('click', ()=> window.location.href='index.html');

  // ---------- INIT
  function initFromCartOrRedirect(){
    const items = Cart.get();
    if (!items.length){
      document.getElementById('cart-empty').style.display='block';
    }
    renderCart();
    setStep(1);
  }

  // go
  initFromCartOrRedirect();

})();
</script>
</body>
</html>
