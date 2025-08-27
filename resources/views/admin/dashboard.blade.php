<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tableau de bord — Admin</title>
  <style>
    :root{--bg:#f8fafc;--card:#fff;--border:#e5e7eb;--text:#111827;--muted:#6b7280;--primary:#1f4e5f}
    *{box-sizing:border-box}
    body{margin:0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Helvetica Neue',Arial;background:var(--bg);color:var(--text)}
    header{background:var(--primary);color:#fff;padding:14px 18px}
    .container{max-width:960px;margin:24px auto;padding:0 16px}
    .card{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px}
    a{color:var(--primary);text-decoration:none}
    a:hover{text-decoration:underline}
    .links ul{margin:0;padding-left:18px;line-height:1.9}
    .muted{color:var(--muted)}
    .topbar{display:flex;align-items:center;justify-content:space-between;gap:12px}
    .btn{display:inline-block;padding:8px 12px;border-radius:8px;border:1px solid #ffffff55;color:#fff}
    .btn:hover{background:#ffffff22}
  </style>
</head>
<body>
  <header>
    <div class="topbar">
      <strong>Keluvato — Admin</strong>
      <span class="muted" style="color:#e8f1f5">
        Connecté : {{ auth()->user()->name ?? 'Admin' }}
      </span>
    </div>
  </header>

  <div class="container">
    <h1 style="margin:0 0 10px;">Tableau de bord — Admin</h1>
    <p class="muted" style="margin:0 0 18px;">
      Accès réservé aux administrateurs.
    </p>

    <div class="card links">
      <ul>
        <li><a href="{{ route('home') }}">Aller à l’accueil</a></li>
        @if (Route::has('profile'))
          <li><a href="{{ route('profile') }}">Mon profil</a></li>
        @endif
        {{-- Ajoute ici tes liens d’admin réels --}}
        {{-- <li><a href="{{ route('admin.users') }}">Utilisateurs</a></li> --}}
        {{-- <li><a href="{{ route('admin.orders') }}">Commandes</a></li> --}}
      </ul>
    </div>

    {{-- Optionnel : bouton de déconnexion si ta route existe --}}
    @if (Route::has('logout'))
      <form method="POST" action="{{ route('logout') }}" style="margin-top:16px;">
        @csrf
        <button type="submit" class="btn">Se déconnecter</button>
      </form>
    @endif
  </div>
</body>
</html>
