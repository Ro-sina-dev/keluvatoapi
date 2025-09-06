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
    /* Styles pour la modal de détails */
    .user-details-modal .modal-content {
      background: var(--card);
      border: 1px solid var(--stroke);
      color: var(--txt);
      border-radius: var(--radius);
    }
    
    .user-details-modal .modal-header {
      border-bottom: 1px solid var(--stroke);
    }
    
    .user-details-modal .modal-body {
      padding: 1.5rem;
    }
    
    .user-avatar-lg {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: var(--brand);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: bold;
      color: white;
      margin: 0 auto 1rem;
    }
    
    .user-detail-item {
      margin-bottom: 0.75rem;
      padding-bottom: 0.75rem;
      border-bottom: 1px solid var(--stroke);
    }
    
    .user-detail-label {
      font-weight: 500;
      color: var(--muted);
      margin-bottom: 0.25rem;
      font-size: 0.875rem;
    }
    
    .user-detail-value {
      font-size: 1rem;
    }
    
    .clickable-row {
      cursor: pointer;
      transition: background-color 0.2s;
    }
    
    .clickable-row:hover {
      background-color: rgba(255, 255, 255, 0.02);
    }
  </style>
</head>
<div class="section">
  <div class="app">
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
    
    <div class="cardx">
        <div class="hd">
            <h5>Liste des Utilisateurs</h5>
            
        </div>
        <div class="table-responsive">
            <table class="tablex">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscrit le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @if($user->role !== 'admin')
                    <tr class="clickable-row" onclick="showUserDetails({{ json_encode($user) }}); return false;">
                        <td>{{ $user->id }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar me-2">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-medium">{{ $user->name }}</div>
                                    @if($user->company_name)
                                        <small class="text-muted">{{ $user->company_name }}</small>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @php
                                $badgeClass = match($user->role) {
                                    'admin' => 'bg-danger',
                                    'pro' => 'bg-primary',
                                    default => 'bg-white text-dark'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-icon" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-eye me-2"></i> Voir
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-edit me-2"></i> Modifier
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        </div>
    </div>
  </div>
</div>

  <!-- Modal Détails Utilisateur -->
  <div class="modal fade user-details-modal" id="userDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Détails de l'utilisateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <div class="user-avatar-lg" id="userAvatar">U</div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="user-detail-item">
                <div class="user-detail-label">Nom complet</div>
                <div class="user-detail-value" id="userName">-</div>
              </div>
              
              <div class="user-detail-item">
                <div class="user-detail-label">Email</div>
                <div class="user-detail-value" id="userEmail">-</div>
              </div>
              
              <div class="user-detail-item">
                <div class="user-detail-label">Téléphone</div>
                <div class="user-detail-value" id="userPhone">-</div>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="user-detail-item">
                <div class="user-detail-label">Type de compte</div>
                <div class="user-detail-value">
                  <span class="badge" id="userRole">-</span>
                </div>
              </div>
              
              <div class="user-detail-item">
                <div class="user-detail-label">Entreprise</div>
                <div class="user-detail-value" id="userCompany">-</div>
              </div>
              
              <div class="user-detail-item">
                <div class="user-detail-label">Date d'inscription</div>
                <div class="user-detail-value" id="userCreatedAt">-</div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Attendre que le DOM soit chargé
    document.addEventListener('DOMContentLoaded', function() {
      // Fonction pour afficher les détails de l'utilisateur
      window.showUserDetails = function(user) {
        try {
          // Convertir la chaîne JSON en objet si nécessaire
          if (typeof user === 'string') {
            user = JSON.parse(user);
          }
          
          // Ne pas ouvrir la modal pour les administrateurs
          if (user.role === 'admin') return;
          
          console.log('Affichage des détails pour:', user);
          
          // Mettre à jour les informations dans la modal
          document.getElementById('userAvatar').textContent = user.name ? user.name.charAt(0).toUpperCase() : 'U';
          document.getElementById('userName').textContent = user.name || 'Non renseigné';
          document.getElementById('userEmail').textContent = user.email || 'Non renseigné';
          document.getElementById('userPhone').textContent = user.phone || 'Non renseigné';
          document.getElementById('userCompany').textContent = user.company_name || 'Non renseigné';
          
          // Formater la date d'inscription
          let createdAt = 'Non disponible';
          if (user.created_at) {
            const date = new Date(user.created_at);
            createdAt = date.toLocaleDateString('fr-FR');
          }
          document.getElementById('userCreatedAt').textContent = createdAt;
          
          // Mettre à jour le badge de rôle
          const roleBadge = document.getElementById('userRole');
          if (roleBadge) {
            roleBadge.textContent = user.role === 'pro' ? 'Professionnel' : 'Client';
            roleBadge.className = 'badge ' + (user.role === 'pro' ? 'bg-primary' : 'bg-white text-dark');
          }
          
          // Mettre à jour le lien d'édition
          const editBtn = document.getElementById('editUserBtn');
          if (editBtn) {
            editBtn.href = '#'; // Remplacer par la route d'édition si nécessaire
          }
          
          // Afficher la modal
          const modalElement = document.getElementById('userDetailsModal');
          if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
          } else {
            console.error('Élément modal non trouvé');
          }
        } catch (error) {
          console.error('Erreur lors de l\'affichage des détails:', error);
        }
      };
      
      // Empêcher la propagation du clic sur les actions pour ne pas ouvrir la modal
      document.querySelectorAll('.dropdown-menu a, .dropdown-menu button').forEach(element => {
        element.addEventListener('click', function(e) {
          e.stopPropagation();
        });
      });
      
      // Vérifier que Bootstrap est chargé
      if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap n\'est pas chargé correctement');
      }
    });
  </script>
</body>
</html>
