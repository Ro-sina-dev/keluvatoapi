<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keluvato • Admin</title>

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/4f6d5d3b2c.js" crossorigin="anonymous"></script>

  <!-- Bootstrap (utilisé pour la grille & utilitaires) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('js/google-translate.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

  <style>
    :root {
      --bg: #0b1020;
      --card: rgba(255, 255, 255, 0.06);
      --stroke: rgba(255, 255, 255, 0.12);
      --txt: #e8ecf2;
      --muted: #aab3c3;
      --brand: #6ea8fe;
      --brand-2: #22d3ee;
      --ok: #22c55e;
      --warn: #f59e0b;
      --danger: #ef4444;
      --shadow: 0 10px 35px rgba(0, 0, 0, 0.35);
      --glass: blur(14px) saturate(120%);
      --radius: 18px;
    }

    * {
      box-sizing: border-box;
    }

    html,
    body {
      height: 100%;
    }

    /* graphes lisibles et responsives */
    .cardx canvas {
      display: block;
      width: 100% !important;
      height: 300px !important;
      /* tu peux monter à 360/420 selon ton goût */
    }

    body {
      font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto,
        Helvetica, Arial;
      background: radial-gradient(1200px 800px at 5% -10%,
          #1a244a 0%,
          transparent 60%),
        radial-gradient(900px 700px at 120% 10%,
          #0d6efd20 0%,
          transparent 55%),
        radial-gradient(800px 600px at -20% 120%,
          #22d3ee15 0%,
          transparent 50%),
        var(--bg);
      color: var(--txt);
      overflow-x: hidden;
    }

    /* Glowing orbs in background */
    .orb {
      position: fixed;
      filter: blur(50px);
      opacity: 0.3;
      z-index: 0;
      pointer-events: none;
    }

    .orb.o1 {
      width: 420px;
      height: 420px;
      border-radius: 50%;
      background: #6ea8fe;
      top: -120px;
      left: -120px;
      animation: float1 14s ease-in-out infinite;
    }

    .orb.o2 {
      width: 380px;
      height: 380px;
      border-radius: 50%;
      background: #22d3ee;
      bottom: -140px;
      right: -100px;
      animation: float2 16s ease-in-out infinite;
    }

    @keyframes float1 {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(25px);
      }
    }

    @keyframes float2 {

      0%,
      100% {
        transform: translate(0, 0);
      }

      50% {
        transform: translate(-20px, 20px);
      }
    }

    /* Layout */
    .app {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: 260px 1fr;
      gap: 24px;
      min-height: 100vh;
      padding: 22px;
    }

    @media (max-width: 992px) {
      .app {
        grid-template-columns: 1fr;
        padding: 16px;
      }
    }

    /* Sidebar */
    .sidebar {
      position: sticky;
      top: 16px;
      height: calc(100vh - 32px);
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      backdrop-filter: var(--glass);
      box-shadow: var(--shadow);
      padding: 18px;
      display: flex;
      flex-direction: column;
      gap: 18px;
    }

    .brand {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 12px;
      border-radius: 12px;
      background: linear-gradient(180deg, #ffffff10, transparent);
    }

    .brand i {
      color: var(--brand);
    }

    .brand strong {
      font-weight: 800;
      letter-spacing: 0.4px;
    }

    .side-nav a {
      color: var(--txt);
      text-decoration: none;
      display: flex;
      gap: 12px;
      align-items: center;
      padding: 10px 12px;
      border-radius: 12px;
      transition: 0.18s all;
      border: 1px solid transparent;
    }

    .side-nav a:hover {
      background: #ffffff0d;
      border-color: #ffffff1f;
    }

    .side-nav a.active {
      background: linear-gradient(90deg, #6ea8fe25, #22d3ee25);
      border-color: #6ea8fe55;
      box-shadow: 0 0 0 1px #6ea8fe30 inset;
    }

    .side-bottom {
      margin-top: auto;
      border-top: 1px dashed var(--stroke);
      padding-top: 14px;
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }

    .chip {
      font-size: 12px;
      color: var(--muted);
      border: 1px solid var(--stroke);
      padding: 6px 10px;
      border-radius: 999px;
      background: #ffffff08;
    }

    .mobile-toggle {
      display: none;
      position: fixed;
      right: 16px;
      bottom: 16px;
      z-index: 9;
      border: none;
      padding: 12px 14px;
      border-radius: 14px;
      background: linear-gradient(90deg, #6ea8fe, #22d3ee);
      color: white;
      box-shadow: var(--shadow);
    }

    @media (max-width: 992px) {
      .sidebar {
        position: fixed;
        left: 16px;
        right: 16px;
        top: auto;
        bottom: 80px;
        height: auto;
        display: none;
      }

      .mobile-toggle {
        display: block;
      }

      .sidebar.open {
        display: block;
      }
    }

    /* Topbar */
    .topbar {
      display: flex;
      gap: 14px;
      align-items: center;
      justify-content: space-between;
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      padding: 12px 16px;
      backdrop-filter: var(--glass);
      box-shadow: var(--shadow);
    }

    .search {
      position: relative;
      flex: 1;
    }

    .search input {
      width: 100%;
      background: #ffffff0a;
      color: var(--txt);
      border: 1px solid var(--stroke);
      border-radius: 12px;
      padding: 10px 12px 10px 36px;
      outline: none;
    }

    .search i {
      position: absolute;
      left: 10px;
      top: 10px;
      color: #ffffff6e;
    }

    .user {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: #ffffff22;
      border: 1px solid var(--stroke);
    }

    .btn-ghost {
      border: 1px solid var(--stroke);
      background: #ffffff0a;
      color: var(--txt);
      padding: 8px 12px;
      border-radius: 12px;
    }

    /* Cards & sections */
    .section {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .grid {
      display: grid;
      gap: 16px;
    }

    .grid.kpi {
      grid-template-columns: repeat(4, minmax(0, 1fr));
    }

    @media (max-width: 1200px) {
      .grid.kpi {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .grid.kpi {
        grid-template-columns: 1fr;
      }
    }

    .cardx {
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: var(--radius);
      backdrop-filter: var(--glass);
      box-shadow: var(--shadow);
      padding: 16px;
    }

    .cardx .hd {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
      margin-bottom: 10px;
    }

    .kpi {
      position: relative;
      overflow: hidden;
      padding: 16px;
      background: linear-gradient(180deg, #ffffff10, transparent);
    }

    .kpi .icon {
      width: 40px;
      height: 40px;
      display: grid;
      place-items: center;
      border-radius: 12px;
      background: #ffffff12;
      border: 1px solid #ffffff22;
    }

    .kpi .val {
      font-size: 26px;
      font-weight: 800;
      letter-spacing: 0.4px;
    }

    .kpi .lbl {
      color: var(--muted);
      font-size: 13px;
    }

    .kpi::after {
      content: "";
      position: absolute;
      inset: auto -40px -40px auto;
      width: 160px;
      height: 160px;
      border-radius: 50%;
      background: radial-gradient(closest-side, #6ea8fe25, #22d3ee00);
      transform: rotate(25deg);
    }

    /* Lists & table */
    .list-clean {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .list-clean li {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px dashed var(--stroke);
    }

    .badge-soft {
      font-size: 12px;
      padding: 6px 10px;
      border-radius: 999px;
      background: #ffffff0f;
      border: 1px solid var(--stroke);
    }

    .tablex {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      border: 1px solid var(--stroke);
      border-radius: 14px;
      overflow: hidden;
    }

    .tablex th,
    .tablex td {
      padding: 12px 14px;
      border-bottom: 1px solid var(--stroke);
    }

    .tablex thead th {
      background: #ffffff0c;
      color: var(--muted);
      font-weight: 600;
    }

    .tablex tr:hover td {
      background: #ffffff06;
    }

    /* Buttons */
    .btn-brand {
      background: linear-gradient(90deg, #6ea8fe, #22d3ee);
      border: none;
      color: #06121d;
      font-weight: 700;
      padding: 10px 14px;
      border-radius: 12px;
    }

    .btn-outline {
      background: transparent;
      border: 1px solid var(--stroke);
      color: var(--txt);
      padding: 10px 14px;
      border-radius: 12px;
    }

    /* Skeleton */
    .skeleton {
      position: relative;
      overflow: hidden;
      background: #ffffff0a;
      border-radius: 10px;
      height: 12px;
    }

    .skeleton::after {
      content: "";
      position: absolute;
      inset: 0;
      animation: shimmer 1.2s infinite;
      background: linear-gradient(90deg, transparent, #ffffff1a, transparent);
    }

    @keyframes shimmer {
      0% {
        transform: translateX(-100%);
      }

      100% {
        transform: translateX(100%);
      }
    }

    /* Forms */
    .form-control,
    textarea {
      background: #ffffff08;
      border: 1px solid var(--stroke);
      color: var(--txt);
    }

    .form-control:focus,
    textarea:focus {
      background: #ffffff12;
      color: var(--txt);
      border-color: #6ea8fe;
    }

    .help {
      color: var(--muted);
      font-size: 12px;
    }

    /* ===== Améliorations mobile ===== */

    /* Hauteur des graphes : lisible mais compact */
    .cardx canvas {
      display: block;
      width: 100% !important;
      height: clamp(180px, 32vh, 300px) !important;
    }

    /* Layout plus fluide sur petit écran */
    @media (max-width: 992px) {
      .app {
        gap: 12px;
        padding: 12px;
      }

      .grid.kpi {
        grid-template-columns: 1fr 1fr;
        gap: 12px;
      }

      .topbar {
        padding: 10px;
      }

      .search input {
        padding-left: 36px;
      }

      .brand strong {
        font-size: 16px;
      }
    }

    @media (max-width: 576px) {
      .grid.kpi {
        grid-template-columns: 1fr;
      }

      .kpi .val {
        font-size: 22px;
      }

      .kpi .icon {
        width: 36px;
        height: 36px;
      }

      .section {
        gap: 12px;
      }
    }

    /* Sidebar en “drawer” bas sur mobile, avec animation et backdrop */
    @media (max-width: 992px) {
      .sidebar {
        position: fixed;
        left: 12px;
        right: 12px;
        bottom: 12px;
        top: auto;
        height: auto;
        max-height: 70vh;
        overflow: auto;
        display: block;
        /* toujours dans le flux */
        transform: translateY(110%);
        transition: transform 0.25s ease;
        z-index: 9;
      }

      .sidebar.open {
        transform: translateY(0);
      }

      .backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
        backdrop-filter: blur(2px);
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s ease;
        z-index: 8;
        display: block;
        /* présent mais inactif */
      }

      .backdrop.show {
        opacity: 1;
        pointer-events: auto;
      }

      body.noscroll {
        overflow: hidden;
      }
    }

    /* Tables : défilement horizontal garanti */
    .table-responsive {
      overflow-x: auto;
    }

    .tablex td,
    .tablex th {
      white-space: nowrap;
      font-size: 14px;
    }

    @media (max-width: 576px) {

      .tablex td,
      .tablex th {
        font-size: 13px;
      }
    }

    /* Orbs: allège l’anim sur mobile */
    @media (max-width: 576px) {
      .orb {
        filter: blur(36px);
        opacity: 0.22;
      }
    }

    /* Respecte les préférences d’accessibilité */
    @media (prefers-reduced-motion: reduce) {
      .orb {
        animation: none !important;
      }
    }
  </style>
</head>

<body>
  <!-- fancy bg blobs -->
  <div class="orb o1"></div>
  <div class="orb o2"></div>

  <button class="mobile-toggle" id="toggleSidebar">
    <i class="fa-solid fa-grid-2"></i> Menu

    
  </button>

  <div class="app">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="brand">
        <i class="fa-solid fa-cubes-stacked"></i>
        <div>
          <strong>Keluvato</strong>
          <div style="font-size: 12px; color: var(--muted)">Admin Suite</div>
        </div>
      </div>

      <nav class="side-nav d-grid gap-1">
        <a class="active" href="#dash"><i class="fa-solid fa-gauge-high"></i> Tableau de bord</a>
        <a href="#products"><i class="fa-solid fa-box-open"></i> Produits</a>
        <a href="#orders"><i class="fa-solid fa-bag-shopping"></i> Commandes</a>
        <a href="#users"><i class="fa-solid fa-users"></i> Utilisateurs</a>
        <a href="#analytics"><i class="fa-solid fa-chart-line"></i> Analytics</a>
      </nav>

      <div class="side-bottom">
        <span class="chip">v1.0</span>
        <span class="chip">Keluvato</span>
        <span class="chip">Group</span>
      </div>
    </aside>

    <!-- Main -->
    <main class="section">
      <!-- Topbar -->
      <div class="topbar">
        <div id="drawerBackdrop" class="backdrop"></div>
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input placeholder="Rechercher dans l’admin…" />
        </div>
        <div class="user">
          <button id="refreshBtn" class="btn-ghost">
            <i class="fa-solid fa-rotate"></i>
          </button>
          <button id="themeBtn" class="btn-ghost">
            <i class="fa-solid fa-sun"></i>
          </button>
          <div class="avatar"></div>
        </div>
      </div>

      <!-- KPIs -->
      <section id="dash" class="grid kpi">
        <div class="cardx kpi">
          <div class="d-flex align-items-center justify-content-between">
            <div class="icon"><i class="fa-solid fa-euro-sign"></i></div>
            <span class="badge-soft">Mois</span>
          </div>
          <div class="val" id="kpiRevenue">—</div>
          <div class="lbl">Chiffre d’affaires</div>
        </div>
        <div class="cardx kpi">
          <div class="d-flex align-items-center justify-content-between">
            <div class="icon"><i class="fa-solid fa-bag-shopping"></i></div>
            <span class="badge-soft">Total</span>
          </div>
          <div class="val" id="kpiOrders">—</div>
          <div class="lbl">Commandes</div>
        </div>
        <div class="cardx kpi">
          <div class="d-flex align-items-center justify-content-between">
            <div class="icon"><i class="fa-solid fa-user-group"></i></div>
            <span class="badge-soft">Clients</span>
          </div>
          <div class="val" id="kpiUsers">—</div>
          <div class="lbl">Utilisateurs</div>
        </div>
        <div class="cardx kpi">
          <div class="d-flex align-items-center justify-content-between">
            <div class="icon"><i class="fa-solid fa-boxes-stacked"></i></div>
            <span class="badge-soft">Actifs</span>
          </div>
          <div class="val" id="kpiProducts">—</div>
          <div class="lbl">Produits en catalogue</div>
        </div>
      </section>

      <!-- Charts -->
      <section class="grid" style="grid-template-columns: 1.5fr 1fr">
        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Ventes par mois</h5>
            <div class="d-flex gap-2">
              <button class="btn-outline btn-sm" id="btnLine">Courbe</button>
              <button class="btn-outline btn-sm" id="btnBar">Barres</button>
            </div>
          </div>
          <canvas id="chartSales" height="110"></canvas>
        </div>
        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Top produits (quantités)</h5>
          </div>
          <canvas id="chartTopProducts" height="110"></canvas>
        </div>
      </section>

      <section class="grid" style="grid-template-columns: 1fr 1fr">
        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Répartition des rôles</h5>
          </div>
          <canvas id="usersPie" height="120"></canvas>
        </div>
        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Stocks faibles</h5>
          </div>
          <ul class="list-clean" id="lowStock">
            <li>
              <span class="skeleton" style="width: 55%"></span><span class="skeleton" style="width: 60px"></span>
            </li>
            <li>
              <span class="skeleton" style="width: 40%"></span><span class="skeleton" style="width: 60px"></span>
            </li>
          </ul>
        </div>
      </section>

      <!-- Products Admin -->
      <section id="products" class="grid" style="grid-template-columns: 1.1fr 1fr">
        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Créer un produit</h5>
          </div>
          <form id="create-product" class="row g-3" enctype="multipart/form-data">
           
            <div class="col-md-6">
              <label class="form-label">Nom</label>
              <input class="form-control" name="name" placeholder="Ex: Canapé Oslo" required />
            </div>

            
            <div class="col-md-6">
                <label class="form-label">Catégorie</label>
                <select class="form-select" name="category_id" id="categorySelect" required>
                  <option value="">Sélectionner…</option>
                </select>
              </div>
            <div class="col-md-3">
              <label class="form-label">Prix (EUR)</label>
              <input class="form-control" name="price" type="number" step="0.01" required />
            </div>
            <div class="col-md-3">
              <label class="form-label">Stock</label>
              <input class="form-control" name="stock" type="number" min="0" value="0" />
            </div>

            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea class="form-control" name="description" rows="3" placeholder="Courte description…"></textarea>

            </div>
            <!-- A) URL d’images -->
            <!--  <div class="col-12">
              <label class="form-label">Images (URLs)</label>
              <div id="image-urls">
                <input class="form-control mb-2" name="images[]" placeholder="https://…/image1.jpg">
              </div>
              <button type="button" class="btn-outline" id="add-image-url">+ Ajouter une URL</button>
              <div id="preview-urls" class="d-flex gap-2 mt-2 flex-wrap"></div>
            </div>-->

            <!-- B) Upload fichiers -->
            <div class="col-12">
              <label class="form-label">Ajouter votre image</label>
              <input class="form-control" type="file" name="files[]" id="files" multiple accept="image/*">
              <div id="preview-files" class="d-flex gap-2 mt-2 flex-wrap"></div>
            </div>

            <div class="col-12 d-flex gap-2">
              <button type="submit" class="btn-brand">Créer</button>
              <button type="reset" class="btn-outline">Réinitialiser</button>
            </div>
          </form>
        </div>

        <div class="cardx">
          <div class="hd">
            <h5 class="m-0">Produits populaires</h5>
          </div>
          <ol id="topList" class="list-clean" style="counter-reset: rank; padding-left: 0">
            <!-- rempli dynamiquement -->
          </ol>
        </div>
      </section>

      <!-- Recent Orders -->
      <section id="orders" class="cardx">
        <div class="hd">
          <h5 class="m-0">Commandes récentes</h5>
        </div>
        <div class="table-responsive">
          <table class="tablex" id="ordersTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Client</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td colspan="5">
                  <div class="skeleton" style="height: 16px"></div>
                </td>
              </tr>
              <tr>
                <td colspan="5">
                  <div class="skeleton" style="height: 16px"></div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Users -->
      <section id="users" class="cardx">
        <div class="hd">
          <h5 class="m-0">Utilisateurs (aperçu)</h5>
        </div>
        <div class="d-flex gap-2 flex-wrap">
          <span class="chip">Admins: <b id="countAdmins">—</b></span>
          <span class="chip">Pros: <b id="countPros">—</b></span>
          <span class="chip">Clients: <b id="countUsers">—</b></span>
        </div>
      </section>
    </main>
  </div>

  <script>
    const apiBase = "http://127.0.0.1:8000/api/v1";
    const token = localStorage.getItem("userToken");

    // ==== Drawer mobile
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("toggleSidebar");
    const backdrop = document.getElementById("drawerBackdrop");
    function openDrawer(open) {
      if (!sidebar) return;
      if (open) {
        sidebar.classList.add("open");
        backdrop?.classList.add("show");
        document.body.classList.add("noscroll");
      } else {
        sidebar.classList.remove("open");
        backdrop?.classList.remove("show");
        document.body.classList.remove("noscroll");
      }
    }
    toggleBtn?.addEventListener("click", () =>
      openDrawer(!sidebar.classList.contains("open"))
    );
    backdrop?.addEventListener("click", () => openDrawer(false));
    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") openDrawer(false);
    });

    // ==== API helper
    async function api(path, opts = {}) {
      const headers = {
        Accept: "application/json",
        "Content-Type": "application/json",
        ...(opts.headers || {}),
      };
      if (token) headers.Authorization = `Bearer ${token}`;
      const res = await fetch(`${apiBase}${path}`, { ...opts, headers });
      const data = await res.json().catch(() => ({}));
      if (!res.ok) throw { status: res.status, data };
      return data;
    }

    // ==== Admin guard (désactivé - plus d'API)
    function requireAdmin() {
      // Plus de vérification API - l'admin reste sur la page
      return Promise.resolve({ role: 'admin', name: 'Admin' });
    }

    // ==== Formatters
    function nf(n) {
      return new Intl.NumberFormat("fr-FR").format(n || 0);
    }
    function money(n) {
      return new Intl.NumberFormat("fr-FR", {
        style: "currency",
        currency: "EUR",
      }).format(n || 0);
    }

    // ==== Charts
    let salesChart, topChart, usersPie;
    function buildSalesChart(type = "line", labels = [], values = []) {
      const ctx = document.getElementById("chartSales");
      if (salesChart) salesChart.destroy();
      salesChart = new Chart(ctx, {
        type,
        data: {
          labels,
          datasets: [
            {
              label: "Revenus",
              data: values,
              fill: type === "line",
              borderColor: "#6ea8fe",
              backgroundColor:
                type === "line" ? "rgba(110,168,254,.15)" : "#6ea8fe",
              tension: 0.35,
              pointRadius: 3,
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            y: {
              ticks: { callback: (v) => v + " €" },
              grid: { color: "#ffffff14" },
            },
            x: { grid: { color: "#ffffff0a" } },
          },
        },
      });
    }
    function buildTopProductsChart(labels = [], values = []) {
      const ctx = document.getElementById("chartTopProducts");
      if (topChart) topChart.destroy();
      topChart = new Chart(ctx, {
        type: "bar",
        data: {
          labels,
          datasets: [
            { label: "Quantités", data: values, backgroundColor: "#22d3ee" },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { display: false } },
          scales: {
            y: { beginAtZero: true, grid: { color: "#ffffff14" } },
            x: { grid: { color: "#ffffff0a" } },
          },
        },
      });
    }
    function buildUsersPie(admins = 1, pros = 3, users = 10) {
      const ctx = document.getElementById("usersPie");
      if (usersPie) usersPie.destroy();
      usersPie = new Chart(ctx, {
        type: "pie",
        data: {
          labels: ["Admins", "Pros", "Clients"],
          datasets: [
            {
              data: [admins, pros, users],
              backgroundColor: ["#6ea8fe", "#22d3ee", "#22c55e"],
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: "bottom" } },
        },
      });
    }
    // Resize charts on orientation/resize
    window.addEventListener("orientationchange", () => {
      salesChart?.resize();
      topChart?.resize();
      usersPie?.resize();
    });
    window.addEventListener("resize", () => {
      salesChart?.resize();
      topChart?.resize();
      usersPie?.resize();
    });

    // ==== Fillers
    function fillLowStock(list = []) {
      const ul = document.getElementById("lowStock");
      ul.innerHTML = "";
      if (!list.length) {
        ul.innerHTML =
          '<li><span>Aucun stock critique</span><span class="badge-soft">OK</span></li>';
        return;
      }
      list.forEach((p) => {
        const li = document.createElement("li");
        li.innerHTML = `<span>${p.name}</span><span class="badge-soft">${p.stock} restants</span>`;
        ul.appendChild(li);
      });
    }
    function fillTopList(top = []) {
      const ol = document.getElementById("topList");
      ol.innerHTML = "";
      if (!top.length) {
        ol.innerHTML =
          '<li><span>Aucune donnée</span><span class="badge-soft">—</span></li>';
        return;
      }
      top.forEach((t) => {
        const li = document.createElement("li");
        li.innerHTML = `<span>${t.name}</span><span class="badge-soft">${t.qty} ventes</span>`;
        ol.appendChild(li);
      });
    }
    function fillOrdersTable(items = []) {
      const tbody = document.querySelector("#ordersTable tbody");
      tbody.innerHTML = "";
      if (!items.length) {
        tbody.innerHTML =
          '<tr><td colspan="5" style="text-align:center;color:var(--muted)">Aucune commande</td></tr>';
        return;
      }
      const badgeMap = {
        paid: '<span class="badge-soft" style="border-color:#22c55e50;background:#22c55e1a;color:#22c55e">Payée</span>',
        pending:
          '<span class="badge-soft" style="border-color:#f59e0b50;background:#f59e0b1a;color:#f59e0b">En attente</span>',
        canceled:
          '<span class="badge-soft" style="border-color:#ef444450;background:#ef44441a;color:#ef4444">Annulée</span>',
      };
      items.forEach((o) => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>#${o.id}</td>
            <td>${o.customer || "-"}</td>
            <td>${money(o.total_amount || 0)}</td>
            <td>${badgeMap[o.status] || "-"}</td>
            <td>${new Date(o.created_at).toLocaleString("fr-FR")}</td>`;
        tbody.appendChild(tr);
      });
    }

    // ==== Stats loader (données d'exemple)
    function loadStats() {
      try {
        // Données d'exemple statiques
        const stats = {
          totalRevenue: 24589,
          totalOrders: 156,
          totalUsers: 89,
          totalProducts: 42,
          countAdmins: 1,
          countPros: 12,
          countUsers: 76
        };

        const lowStock = [
          { name: 'Canapé Oslo', stock: 2 },
          { name: 'Chaise Design', stock: 1 },
          { name: 'Table Basse', stock: 3 }
        ];

        const topProducts = [
          { name: 'Canapé', qty: 34 },
          { name: 'Chaise', qty: 27 },
          { name: 'Table', qty: 22 },
          { name: 'Lampe', qty: 18 },
          { name: 'Plaid', qty: 16 }
        ];

        const recentOrders = [
          { id: 1, customer: 'Marie Dupont', total_amount: 450.00, status: 'delivered', created_at: '2025-08-29T10:30:00Z' },
          { id: 2, customer: 'Jean Martin', total_amount: 280.50, status: 'processing', created_at: '2025-08-29T09:15:00Z' },
          { id: 3, customer: 'Sophie Bernard', total_amount: 125.00, status: 'pending', created_at: '2025-08-29T08:45:00Z' }
        ];

        // Update counters
        document.getElementById("totalRevenue").textContent = money(stats.totalRevenue);
        document.getElementById("totalOrders").textContent = nf(stats.totalOrders);
        document.getElementById("totalProducts").textContent = nf(stats.totalProducts);
        document.getElementById("totalUsers").textContent = nf(stats.totalUsers);
        document.getElementById("countAdmins").textContent = nf(stats.countAdmins);
        document.getElementById("countPros").textContent = nf(stats.countPros);
        document.getElementById("countUsers").textContent = nf(stats.countUsers);

        // Fill lists
        fillLowStock(lowStock);
        fillTopList(topProducts);
        fillOrdersTable(recentOrders);

        // Charts avec données d'exemple
        buildSalesChart("line", 
          ["Jan", "Fév", "Mar", "Avr", "Mai", "Jun", "Jul", "Aoû"],
          [5000, 8000, 12000, 15000, 18000, 20000, 22000, 25000]
        );
        buildTopProductsChart(
          ["Canapé", "Chaise", "Table", "Lampe", "Plaid"],
          [34, 27, 22, 18, 16]
        );
        buildUsersChart([76, 12, 1]); // [clients, pros, admins]
      } catch (e) {
        // Fallback démo si l'API n'est pas prête
        document.getElementById("kpiRevenue").textContent = money(24589);
        document.getElementById("kpiOrders").textContent = nf(156);
        document.getElementById("kpiUsers").textContent = nf(89);
        document.getElementById("kpiProducts").textContent = nf(42);
        document.getElementById("countAdmins").textContent = nf(1);
        document.getElementById("countPros").textContent = nf(12);
        document.getElementById("countUsers").textContent = nf(76);

        buildSalesChart(
          "line",
          [
            "01/25",
            "02/25",
            "03/25",
            "04/25",
            "05/25",
            "06/25",
            "07/25",
            "08/25",
            "09/25",
            "10/25",
            "11/25",
            "12/25",
          ],
          [
            5000, 8000, 12000, 15000, 18000, 20000, 22000, 25000, 21000,
            19000, 23000, 28000,
          ]
        );
        buildTopProductsChart(
          ["Canapé", "Chaise", "Table", "Lampe", "Plaid"],
          [34, 27, 22, 18, 16]
        );
        buildUsersPie(1, 12, 76);
        fillLowStock([
          { name: "Lampe noyer", stock: 3 },
          { name: "Table basse", stock: 2 },
        ]);
        fillTopList([
          { name: "Canapé Oslo", qty: 34 },
          { name: "Chaise Luna", qty: 27 },
          { name: "Table Edge", qty: 22 },
        ]);
        fillOrdersTable([
          {
            id: 101,
            customer: "Jean Dupont",
            total_amount: 349.9,
            status: "paid",
            created_at: new Date().toISOString(),
          },
          {
            id: 102,
            customer: "Marie Curie",
            total_amount: 129.0,
            status: "pending",
            created_at: new Date().toISOString(),
          },
        ]);
      }
    }

    // Switch chart type
    document.getElementById("btnLine").addEventListener("click", () => {
      if (!salesChart) return;
      buildSalesChart(
        "line",
        salesChart.data.labels,
        salesChart.data.datasets[0].data
      );
    });
    document.getElementById("btnBar").addEventListener("click", () => {
      if (!salesChart) return;
      buildSalesChart(
        "bar",
        salesChart.data.labels,
        salesChart.data.datasets[0].data
      );
    });

    // Create product
    
  
    // Manual refresh
    document
      .getElementById("refreshBtn")
      .addEventListener("click", loadStats);

    // Boot: charge les stats directement
    (function() {
      requireAdmin(); // plus de redirection
      loadStats();
    })();
  </script>




<script>
document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('create-product');
  const filesInput = document.getElementById('files');
  const preview = document.getElementById('preview-files');
  const categorySelect = document.getElementById('categorySelect');

  // 1) Charger les catégories depuis la BD (passées par le contrôleur)
  (function loadCategories(){
    @if(isset($categories))
      const categories = @json($categories);
      
      categories.forEach(root => {
        if (root.children && root.children.length) {
          const og = document.createElement('optgroup');
          og.label = root.name;
          root.children.forEach(child => {
            const opt = new Option(child.name, child.id);
            og.appendChild(opt);
          });
          categorySelect.appendChild(og);
        } else {
          categorySelect.appendChild(new Option(root.name, root.id));
        }
      });
    @endif
  })();

  // 2) Prévisualisation images
  let lastUrls = [];
  filesInput.addEventListener('change', (e) => {
    // nettoyer anciennes previews + libérer les URL objets
    preview.innerHTML = '';
    lastUrls.forEach(URL.revokeObjectURL);
    lastUrls = [];

    [...e.target.files].forEach(f => {
      const url = URL.createObjectURL(f);
      lastUrls.push(url);
      const img = document.createElement('img');
      img.src = url;
      img.style.width = '80px';
      img.style.height = '80px';
      img.style.objectFit = 'cover';
      img.loading = 'lazy';
      preview.appendChild(img);
    });
  });

  // 3) Soumission du formulaire (simulation)
  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    
    // Simulation de création de produit
    const productName = formData.get('name');
    const productPrice = formData.get('price');
    
    if (productName && productPrice) {
      alert(`Produit "${productName}" créé avec succès ! (Prix: ${productPrice}€)`);
      form.reset();
      preview.innerHTML = '';
      lastUrls.forEach(URL.revokeObjectURL);
      lastUrls = [];
    } else {
      alert('Veuillez remplir tous les champs obligatoires.');
    }
  });
});
</script>


</body>

</html>