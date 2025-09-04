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
        <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="fa-solid fa-gauge-high"></i> Tableau de bord
        </a>
        <a class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
          <i class="fa-solid fa-box-open"></i> Produits
        </a>
        <a class="{{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">
          <i class="fa-solid fa-bag-shopping"></i> Commandes
        </a>
        <a class="{{ request()->routeIs('admin.users') ? 'active' : '' }}" href="{{ route('admin.users') }}">
          <i class="fa-solid fa-users"></i> Utilisateurs
        </a>
        <a class="{{ request()->routeIs('admin.analytics') ? 'active' : '' }}" href="{{ route('admin.analytics') }}">
          <i class="fa-solid fa-chart-line"></i> Analytics
        </a>
      </nav>

      <div class="side-bottom">
        <span class="chip">v1.0</span>
        <span class="chip">Keluvato</span>
        <span class="chip">Group</span>
      </div>
    </aside>
    <div class="grid kpi">
        <div class="cardx kpi">
            <div class="icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="val">1,248</div>
            <div class="lbl">Commandes</div>
        </div>
        
        <div class="cardx kpi">
            <div class="icon">
                <i class="fa-solid fa-money-bill-wave"></i>
            </div>
            <div class="val">$24,560</div>
            <div class="lbl">Chiffre d'affaires</div>
        </div>
        
        <div class="cardx kpi">
            <div class="icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="val">845</div>
            <div class="lbl">Utilisateurs</div>
        </div>
        
        <div class="cardx kpi">
            <div class="icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="val">156</div>
            <div class="lbl">Produits</div>
        </div>
    </div>
    
    <div class="grid" style="grid-template-columns: 2fr 1fr;">
        <div class="cardx">
            <div class="hd">
                <h5>Ventes par mois</h5>
                <select class="form-select" style="width: auto;">
                    <option>Cette année</option>
                    <option>L'année dernière</option>
                </select>
            </div>
            <canvas id="salesChart"></canvas>
        </div>
        
        <div class="cardx">
            <div class="hd">
                <h5>Produits populaires</h5>
            </div>
            <ul class="list-clean">
                <li>
                    <span>Canapé en cuir</span>
                    <span class="badge-soft">128 ventes</span>
                </li>
                <li>
                    <span>Table basse en bois</span>
                    <span class="badge-soft">97 ventes</span>
                </li>
                <li>
                    <span>Fauteuil design</span>
                    <span class="badge-soft">85 ventes</span>
                </li>
                <li>
                    <span>Étagère murale</span>
                    <span class="badge-soft">72 ventes</span>
                </li>
                <li>
                    <span>Lampe de bureau</span>
                    <span class="badge-soft">65 ventes</span>
                </li>
            </ul>
        </div>
    </div>
    
    <div class="cardx">
        <div class="hd">
            <h5>Dernières commandes</h5>
            <a href="#" class="btn-outline">Voir tout</a>
        </div>
        <div class="table-responsive">
            <table class="tablex">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#12345</td>
                        <td>Jean Dupont</td>
                        <td>02/09/2023</td>
                        <td>$249.99</td>
                        <td><span class="badge-soft">Expédié</span></td>
                        <td><a href="#" class="btn-outline btn-sm">Voir</a></td>
                    </tr>
                    <!-- D'autres lignes de commande ici -->
                </tbody>
            </table>
        </div>
    </div>
  
  </div>

</body>

@push('scripts')
<script>
// Script pour initialiser les graphiques avec Chart.js
const salesCtx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
        datasets: [{
            label: 'Ventes 2023',
            data: [1200, 1900, 1500, 2200, 2500, 3000, 3200, 2800, 3500, 3800, 4000, 4500],
            borderColor: '#6ea8fe',
            backgroundColor: 'rgba(110, 168, 254, 0.1)',
            tension: 0.3,
            fill: true
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(255, 255, 255, 0.05)'
                },
                ticks: {
                    color: 'var(--muted)'
                }
            },
            x: {
                grid: {
                    color: 'rgba(255, 255, 255, 0.05)'
                },
                ticks: {
                    color: 'var(--muted)'
                }
            }
        }
    }
});
</script>
</body>

</html>
