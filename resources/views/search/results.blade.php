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

@includeIf('partials.footer')

</body>
</html>
