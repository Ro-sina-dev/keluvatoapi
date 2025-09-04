<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} – Détail produit</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}"><!-- requis pour fetch POST -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon" />

    <!-- Styles locaux -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/decouvre.css') }}">
    <!-- Fonts et icônes externes -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>

    @include('partials.header')
    @php
        $imgs = (array) ($product->images ?? []);
        $img = count($imgs)
            ? $imgs[0]
            : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200&q=80&auto=format&fit=crop';
        $hasPromo = !is_null($product->discount_price ?? null);
        $display = $hasPromo ? $product->discount_price : $product->price;

        // NOTE & NOMBRE D'AVIS depuis la BDD (via $reviews passé par le contrôleur)
$reviewsCount = isset($reviews) ? $reviews->count() : 0;
$rating = $reviewsCount ? round($reviews->avg('stars'), 1) : null;

$specs = [
    'Référence' => 'SKU-' . str_pad($product->id, 5, '0', STR_PAD_LEFT),
    'Disponibilité' => ($product->stock ?? 0) > 0 ? 'En stock' : 'Rupture',
    'Catégorie(s)' => method_exists($product, 'categories')
        ? $product->categories->pluck('name')->join(', ')
        : '—',
    'Devise' => $product->currency ?? 'EUR',
        ];

        $pageUrl = url()->current();
    @endphp


    <div class="container">
        <nav class="breadcrumb">
            <a href="{{ route('home') }}">Accueil</a> › <a href="{{ route('products.discover') }}">Découvrir</a> ›
            <span>{{ $product->name }}</span>
        </nav>

        <!-- ===== TOP: Galerie + Buy ===== -->
        <div class="product-grid">
            <!-- Galerie -->
            <section class="card pad reveal">
                <div class="gallery">
                    @if (count($imgs) > 1)
                        <div class="thumbs" id="thumbs">
                            @foreach ($imgs as $k => $i)
                                <img src="{{ $i }}" data-index="{{ $k }}"
                                    class="{{ $k === 0 ? 'active' : '' }}" alt="miniature" loading="lazy">
                            @endforeach
                        </div>
                    @endif

                    @php
    // 1) Récupérer la première image (supporte array, JSON, string, null)
    $raw = $product->images ?? [];
    if (!is_array($raw)) {
        $decoded = json_decode($raw, true);
        $imgs = is_array($decoded) ? $decoded : (strlen(trim((string)$raw)) ? [$raw] : []);
    } else {
        $imgs = $raw;
    }

    // 2) Helper minimal pour obtenir une URL affichable en local & prod
    $toUrl = function ($v) {
        if (!$v) return '';
        // enlève un host local si présent (évite 127.0.0.1 en prod)
        $v = preg_replace('#^https?://(127\.0\.0\.1(:\d+)?|localhost(:\d+)?)#i', '', $v ?? '');
        // si c'est déjà http(s) ou data:, on garde
        if (preg_match('#^(https?://|data:)#i', $v)) return $v;
        // si ça commence par /storage/, on laisse relatif (ok local & prod)
        if (strpos($v, '/storage/') === 0) return $v;
        // sinon, fabriquer /storage/... depuis le disque public
        return \Illuminate\Support\Facades\Storage::url(ltrim($v, '/'));
    };

    // 3) $img final avec fallback
    $img = !empty($imgs[0])
        ? $toUrl($imgs[0])
        : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200&q=80&auto=format&fit=crop';
@endphp

                    <div class="main-wrap">
                        <div class="main-img tilt" id="mainWrap">

                            <img id="mainImg" class="float" src="{{ $img }}" alt="{{ $product->name }}">
                            <div class="lens" id="lens"></div>
                            <button class="lightbox-btn" id="openLightbox" aria-label="Voir en plein écran">⤢</button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Buy / Info -->
           <!-- Buy / Info -->
<aside class="buy reveal">
  <div class="card pad">
    <h1 class="title reveal">{{ $product->name }}</h1>

    {{-- Note & nb d'avis --}}
    <div class="rating reveal">
      @if ($reviewsCount)
        <span>⭐ {{ number_format($rating, 1) }}</span>
        <span class="count">({{ $reviewsCount }} avis)</span>
      @else
        <span class="count">Aucun avis pour l’instant</span>
      @endif
    </div>

    {{-- Prix --}}
    <div class="price reveal">
      <span class="current">
        {{ number_format($display, 2, ',', ' ') }} {{ $product->currency ?? 'EUR' }}
      </span>
      @if ($hasPromo)
        <span class="old">
          {{ number_format($product->price, 2, ',', ' ') }} {{ $product->currency ?? 'EUR' }}
        </span>
        <span class="off">
          -{{ number_format((1 - $product->discount_price / $product->price) * 100, 0) }}%
        </span>
      @endif
    </div>

    {{-- Badges --}}
    <div class="badges reveal" style="display:flex; gap:8px; flex-wrap:wrap">
      @if ($hasPromo)
        <span class="badge promo">Promo</span>
      @endif
      @if ($product->is_featured ?? false)
        <span class="badge featured">Vedette</span>
      @endif
      <span class="badge">{{ ($product->stock ?? 0) > 0 ? 'En stock' : 'Indisponible' }}</span>
    </div>

    {{-- Actions (sur une ligne) --}}
    <div class="actions reveal" style="display:flex; gap:10px; flex-wrap:wrap; align-items:center; margin-top:12px">
      <button
        class="btn primary"
        data-id="{{ $product->id }}"
        data-name="{{ $product->name }}"
        data-price="{{ $display }}"
      >
        Ajouter au panier
      </button>

      {{-- Favoris --}}
      @auth
        <form action="{{ route('products.favorite', $product) }}" method="POST">
          @csrf
          <button
            class="btn {{ !empty($isFavorite) && $isFavorite ? 'light' : 'light' }}"
            title="{{ !empty($isFavorite) && $isFavorite ? 'Retirer des favoris' : 'Ajouter aux favoris' }}"
            style="display:inline-flex; align-items:center; gap:8px"
          >
            @if(!empty($isFavorite) && $isFavorite)
              <i class="fas fa-heart"></i> Retirer des favoris
            @else
              <i class="far fa-heart"></i> Ajouter aux favoris
            @endif
          </button>
        </form>
      @else
        <a class="btn light" href="{{ route('login') }}" style="display:inline-flex; align-items:center; gap:8px">
          <i class="far fa-heart"></i> Favori
        </a>
      @endauth

      <button class="btn light" onclick="history.back()">← Retour</button>
    </div>

    {{-- Partage --}}
    <div class="share reveal" style="margin-top:12px">
      <small>Partager :</small>
      <a id="shareWa" target="_blank" rel="noopener">WhatsApp</a>
      <a id="shareFb" target="_blank" rel="noopener">Facebook</a>
      <a id="shareX" target="_blank" rel="noopener">X</a>
      <button id="copyLink">Copier le lien</button>
    </div>
  </div>
</aside>

        </div>

        <!-- ===== BOTTOM: Onglets à gauche + Pub à droite ===== -->
        <div class="product-extra">
            <div class="extra-grid">
                <!-- Onglets -->
                <div class="card pad tabs reveal">
                    <div class="tab-head">
                        <button class="tab-btn active" data-tab="desc">Description</button>
                        <button class="tab-btn" data-tab="specs">Caractéristiques</button>
                        <button class="tab-btn" data-tab="reviews">Avis</button>
                    </div>

                    <div class="tab-panel active reveal" id="tab-desc">
                        <p style="line-height:1.7;color:#374151">
                            {{ $product->description ?? 'Aucune description disponible pour ce produit.' }}
                        </p>
                    </div>

                    <div class="tab-panel reveal" id="tab-specs">
                        <div class="specs">
                            @foreach ($specs as $k => $v)
                                <div><strong>{{ $k }}</strong></div>
                                <div>{{ $v }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-panel reveal" id="tab-reviews">
                        <div id="reviewsList">
                            @forelse($reviews as $r)
                                <div class="review">
                                    <div class="avatar"></div>
                                    <div>
                                        <div style="display:flex;align-items:center;gap:8px">
                                            <strong>{{ $r->name ?? 'Anonyme' }}</strong>
                                            <span
                                                class="stars">{{ str_repeat('★', $r->stars) }}{{ str_repeat('☆', 5 - $r->stars) }}</span>
                                        </div>
                                        <div style="color:#374151;margin-top:4px">{{ $r->content }}</div>
                                        <small style="color:#6b7280">{{ $r->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            @empty
                                <p>Aucun avis pour ce produit.</p>
                            @endforelse
                        </div>

                        <form action="{{ route('products.review', $product) }}" method="POST" class="review-form">
                            @csrf
                            <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
                                <input class="input" type="text" name="name"
                                    placeholder="Votre nom (optionnel)" />
                                <input class="input" type="number" name="stars" min="1" max="5"
                                    placeholder="Note (1-5)" required />
                            </div>
                            <textarea name="content" placeholder="Partagez votre avis..." required></textarea>
                            <button class="btn primary" type="submit">Publier l’avis</button>
                        </form>
                    </div>

                </div>

                <!-- Pub / Promo -->
                <aside class="card pad reveal"
                    style="text-align:center;display:flex;flex-direction:column;justify-content:center;align-items:center;gap:10px">
                    <h3 style="color:var(--brand);margin:0">Offre spéciale 🎉</h3>
                    <p style="color:var(--muted);margin:0 0 8px">Découvrez nos promos de la semaine</p>
                     <!-- <img src="https://images.unsplash.com/photo-1607082349566-1873425b6b07?w=600&q=80&auto=format&fit=crop"
                        alt="Publicité" style="width:100%;border-radius:12px;object-fit:cover;max-height:220px">
                 Pub / Promo -->
                        <button class="btn primary" style="margin-top:10px">Voir l’offre</button>
                </aside>
            </div>
        </div>

     @if (!empty($related) && count($related))
    @php
        // Helper image (protégé contre redéclaration)
        if (!isset($toUrl) || !is_callable($toUrl)) {
            $toUrl = function ($v) {
                if (!$v) return '';
                // enlève un host local s'il traîne en BDD
                $v = preg_replace('#^https?://(127\.0\.0\.1(:\d+)?|localhost(:\d+)?)#i', '', $v ?? '');
                // URL absolue http(s) ou data:
                if (preg_match('#^(https?://|data:)#i', $v)) return $v;
                // déjà /storage/...
                if (strpos($v, '/storage/') === 0) return $v;
                // chemin disque public -> /storage/...
                return \Illuminate\Support\Facades\Storage::url(ltrim($v, '/'));
            };
        }
    @endphp

    <section class="related reveal">
        <h2 style="margin:12px 4px 12px;color:var(--brand);font-size:1.3rem">Produits similaires</h2>
        <div class="grid-rel">
            @foreach ($related as $p)
                @php
                    // images : accepte array | JSON | string | null
                    $raw   = $p->images ?? [];
                    if (!is_array($raw)) {
                        $dec   = json_decode($raw, true);
                        $rimgs = is_array($dec) ? $dec : (strlen(trim((string)$raw)) ? [$raw] : []);
                    } else {
                        $rimgs = $raw;
                    }

                    // URL normalisée + fallback
                    $rimg      = !empty($rimgs[0]) ? $toUrl($rimgs[0])
                              : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80&auto=format&fit=crop';
                    $rHasPromo = !is_null($p->discount_price ?? null);
                    $rDisplay  = $rHasPromo ? $p->discount_price : $p->price;
                @endphp

                <a class="card pad rel-card" href="{{ route('products.show', $p->id) }}" style="text-decoration:none;color:inherit">
                    <img src="{{ $rimg }}" alt="{{ $p->name }}">
                    <div class="rel-title">{{ $p->name }}</div>
                    <div class="rel-price">{{ number_format($rDisplay, 2, ',', ' ') }} {{ $p->currency ?? 'EUR' }}</div>
                </a>
            @endforeach
        </div>
    </section>
@endif

    </div>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox" aria-hidden="true">
        <button class="close" id="lbClose" aria-label="Fermer">✕</button>
        <button class="prev" id="lbPrev" aria-label="Précédent">❮</button>
        <img id="lbImg" src="{{ $img }}" alt="Aperçu">
        <button class="next" id="lbNext" aria-label="Suivant">❯</button>
    </div>

    <script>
        // Révélation au scroll
        (() => {
            const obs = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.classList.add('in');
                        obs.unobserve(e.target);
                    }
                });
            }, {
                threshold: .12
            });
            document.querySelectorAll('.reveal').forEach(el => obs.observe(el));
        })();

        // Onglets
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
                document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
                btn.classList.add('active');
                document.querySelector('#tab-' + btn.dataset.tab).classList.add('active');
            });
        });

        // Galerie + loupe + tilt + lightbox
        (() => {
            const thumbs = Array.from(document.querySelectorAll('#thumbs img'));
            const mainImg = document.getElementById('mainImg');
            const mainWrap = document.getElementById('mainWrap');
            const lens = document.getElementById('lens');
            const openBtn = document.getElementById('openLightbox');
            const images = @json($imgs ?: [$img]);
            let currentIndex = 0;

            const setActive = (idx) => {
                currentIndex = idx;
                mainImg.src = images[idx] || images[0];
                thumbs.forEach(t => t.classList.remove('active'));
                const t = thumbs.find(x => +x.dataset.index === idx);
                t && t.classList.add('active');
                lens.style.backgroundImage = `url('${mainImg.src}')`;
            };
            thumbs.forEach(t => t.addEventListener('click', () => setActive(+t.dataset.index)));

            // Loupe
            const showLens = (e) => {
                if (window.matchMedia('(pointer: coarse)').matches) return;
                lens.style.display = 'block';
                lens.style.backgroundImage = `url('${mainImg.src}')`;
                const rect = mainImg.getBoundingClientRect();
                const x = e.clientX - rect.left,
                    y = e.clientY - rect.top;
                const lx = x - lens.offsetWidth / 2,
                    ly = y - lens.offsetHeight / 2;
                const maxX = rect.width - lens.offsetWidth,
                    maxY = rect.height - lens.offsetHeight;
                lens.style.left = Math.max(0, Math.min(lx, maxX)) + 'px';
                lens.style.top = Math.max(0, Math.min(ly, maxY)) + 'px';
                lens.style.backgroundSize = '220%';
                lens.style.backgroundPosition = `${(x/rect.width)*100}% ${(y/rect.height)*100}%`;
            };
            mainWrap.addEventListener('mousemove', showLens);
            mainWrap.addEventListener('mouseleave', () => lens.style.display = 'none');

            // Tilt 3D
            mainWrap.addEventListener('mousemove', (e) => {
                const r = mainWrap.getBoundingClientRect();
                const px = (e.clientX - r.left) / r.width - 0.5;
                const py = (e.clientY - r.top) / r.height - 0.5;
                mainWrap.style.setProperty('--ry', (px * 6) + 'deg');
                mainWrap.style.setProperty('--rx', (-py * 6) + 'deg');
            });
            mainWrap.addEventListener('mouseleave', () => {
                mainWrap.style.setProperty('--ry', '0deg');
                mainWrap.style.setProperty('--rx', '0deg');
            });

            // Lightbox
            const lb = document.getElementById('lightbox');
            const lbImg = document.getElementById('lbImg');
            const lbClose = document.getElementById('lbClose');
            const lbPrev = document.getElementById('lbPrev');
            const lbNext = document.getElementById('lbNext');

            const resetLBTransform = () => {
                lbImg.style.transform = 'translate(0,0) scale(1)';
            };
            const openLB = () => {
                lb.classList.add('open');
                lb.setAttribute('aria-hidden', 'false');
                lbImg.src = images[currentIndex] || mainImg.src;
                resetLBTransform();
            };
            const closeLB = () => {
                lb.classList.remove('open');
                lb.setAttribute('aria-hidden', 'true');
            };

            openBtn?.addEventListener('click', openLB);
            mainImg.addEventListener('click', openLB);
            lbClose.addEventListener('click', closeLB);
            lb.addEventListener('click', (e) => {
                if (e.target === lb) closeLB();
            });
            document.addEventListener('keydown', (e) => {
                if (!lb.classList.contains('open')) return;
                if (e.key === 'Escape') closeLB();
                if (e.key === 'ArrowLeft') lbPrev.click();
                if (e.key === 'ArrowRight') lbNext.click();
            });

            lbPrev.addEventListener('click', () => {
                if (!images.length) return;
                currentIndex = (currentIndex - 1 + images.length) % images.length;
                lbImg.src = images[currentIndex];
                resetLBTransform();
                setActive(currentIndex);
            });
            lbNext.addEventListener('click', () => {
                if (!images.length) return;
                currentIndex = (currentIndex + 1) % images.length;
                lbImg.src = images[currentIndex];
                resetLBTransform();
                setActive(currentIndex);
            });
        })();

        // Partage
        (() => {
            const url = encodeURIComponent(@json($pageUrl));

            const wa = document.getElementById('shareWa');
            const fb = document.getElementById('shareFb');
            const tw = document.getElementById('shareX');
            const cp = document.getElementById('copyLink');

            if (wa) wa.href = `https://wa.me/?text=${text}%20${url}`;
            if (fb) fb.href = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
            if (tw) tw.href = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;

            if (cp) cp.addEventListener('click', async () => {
                try {
                    await navigator.clipboard.writeText(@json($pageUrl));
                    alert('Lien copié ✅');
                } catch {
                    prompt('Copiez le lien :', @json($pageUrl));
                }
            });
        })();

        // Like & Views dynamiques
        (() => {
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            const likeBtn = document.getElementById('likeBtn');
            const likesCount = document.getElementById('likesCount');
            const viewsCount = document.getElementById('viewsCount');
            const productId = {{ $product->id }};

            // Compter une vue (anti-refresh côté serveur)
            fetch(@json(route('products.view', $product->id)), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrf,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json()).then(d => {
                    if (d?.views != null) viewsCount.textContent = d.views;
                }).catch(() => {});

            // Rétablir état "déjà liké" approximatif via sessionStorage (optionnel côté client)
            const likedKey = 'liked_product_' + productId;
            if (sessionStorage.getItem(likedKey) === '1') likeBtn.dataset.liked = 'true';

            likeBtn.addEventListener('click', () => {
                fetch(@json(route('products.like', $product->id)), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        }
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d?.ok) {
                            likesCount.textContent = d.likes ?? likesCount.textContent;
                            likeBtn.dataset.liked = d.liked ? 'true' : 'false';
                            sessionStorage.setItem(likedKey, d.liked ? '1' : '0');
                        }
                    }).catch(() => {});
            });
        })();

        // Avis dynamiques (front only pour l’instant)
        (() => {
            const form = document.getElementById('reviewForm');
            const list = document.getElementById('reviewsList');
            if (!form) return;
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const fd = new FormData(form);
                const name = (fd.get('name') || 'Anonyme').toString().trim();
                const stars = Math.max(1, Math.min(5, parseInt(fd.get('stars') || '5', 10)));
                const content = (fd.get('content') || '').toString().trim();
                if (!content) return;

                const item = document.createElement('div');
                item.className = 'review';
                item.innerHTML = `
        <div class="avatar"></div>
        <div>
          <div style="display:flex;align-items:center;gap:8px">
            <strong>${name.replace(/</g,'&lt;')}</strong>
            <span class="stars">${'★'.repeat(stars)}${'☆'.repeat(5-stars)}</span>
          </div>
          <div style="color:#374151;margin-top:4px">${content.replace(/</g,'&lt;')}</div>
        </div>
      `;
                list.prepend(item);
                form.reset();
                alert('Merci pour votre avis ! (enregistré côté navigateur pour l’instant)');
                // Quand tu auras un endpoint, fais un fetch POST ici.
            });
        })();
    </script>

 <script>
(() => {
  const url = encodeURIComponent(@json($pageUrl));
  const text = encodeURIComponent(@json($product->name . ' - ' . ($product->description ? \Illuminate\Support\Str::limit($product->description, 120) : '')));

  const wa = document.getElementById('shareWa');
  const fb = document.getElementById('shareFb');
  const tw = document.getElementById('shareX');
  const cp = document.getElementById('copyLink');

  if (wa) wa.href = `https://wa.me/?text=${text}%20${url}`;
  if (fb) fb.href = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
  if (tw) tw.href = `https://twitter.com/intent/tweet?text=${text}&url=${url}`;

  if (cp) cp.addEventListener('click', async () => {
    try { await navigator.clipboard.writeText(@json($pageUrl)); alert('Lien copié ✅'); }
    catch { prompt('Copiez le lien :', @json($pageUrl)); }
  });
})();
</script>

<script src="{{ asset('js/google-translate.js') }}"></script>
</body>
</html>
