<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Mes favoris — Keluvato</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

  <!-- Styles du projet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/decouvre.css') }}">
</head>
<body>

  @include('partials.header')

  <div class="container">
    <nav class="breadcrumb" style="margin:12px 0">
      <a href="{{ route('home') }}">Accueil</a> › <span>Mes favoris</span>
    </nav>

    @if (session('success'))
      <div class="card pad" style="background:#ECFDF5;color:#065F46;margin-bottom:12px;border-radius:12px">
        {{ session('success') }}
      </div>
    @endif

    <h1 style="margin:8px 0 16px; color:var(--brand)">Mes favoris</h1>

    @if ($favoriteProducts->isEmpty())
      <div class="card pad" style="text-align:center">
        <p>Vous n’avez encore aucun favori.</p>
        <a class="btn primary" href="{{ route('products.discover') }}">Découvrir les produits</a>
      </div>
    @else
      <div class="grid-rel">
        @foreach ($favoriteProducts as $p)
          @php
            $imgs = (array) ($p->images ?? []);
            $img  = count($imgs) ? $imgs[0] : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80&auto=format&fit=crop';
            $hasPromo = !is_null($p->discount_price ?? null);
            $display  = $hasPromo ? $p->discount_price : $p->price;
          @endphp

          <div class="card pad rel-card" style="position:relative">
            <a href="{{ route('products.show', $p->id) }}" style="text-decoration:none;color:inherit;display:block">
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

            {{-- Toggle retirer des favoris --}}
            <form action="{{ route('products.favorite', $p) }}" method="POST" style="margin-top:10px; display:flex; gap:8px">
              @csrf
              <button class="btn light" style="display:inline-flex; align-items:center; gap:8px">
                <i class="fas fa-heart"></i> Retirer des favoris
              </button>
              <a class="btn primary" href="{{ route('products.show', $p->id) }}">Voir</a>
            </form>
          </div>
        @endforeach
      </div>

      <div style="margin-top:16px">
        {{ $favoriteProducts->links() }} {{-- pagination --}}
      </div>
    @endif
  </div>

  @includeIf('partials.footer')

<script src="{{ asset('js/google-translate.js') }}"></script>
</body>
</html>
