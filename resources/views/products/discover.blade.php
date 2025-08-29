<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keluvato à votre service</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/discover.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    @include('partials.header')

    <!-- HERO 3D -->
    <section class="discover-hero">
        <div class="container hero-wrap">
            <div class="hero-head">
                <h1>Découvrez notre collection exclusive</h1>
                <p>Trouvez l'inspiration parmi nos meubles, décorations et outils de bricolage pour créer l'intérieur de
                    vos rêves.</p>
                <div class="hero-cta">
                    <a href="#grid" class="btn btn-primary">Voir les articles</a>
                    <a href="#promos" class="btn btn-ghost">Promotions</a>
                </div>
            </div>
            <div class="hero-3d">
                <div class="hero-card" id="heroCard">
                    <div class="hero-media"></div>
                    <div class="hero-stats">
                        <span class="chip">Paiement facile</span>
                        <span class="chip">Achat sécurisé</span>
                        <span class="chip">Qualité premium</span>
                        <span class="chip">Livraison rapide</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- === PROMO STAGE (gauche/centre/droite) === -->
    <div class="container">
        <div class="promo-stage">
            <!-- Gauche -->
            <aside class="side-promo illustration">
                <img src="{{ asset('assets/armchair.jpg') }}" class="float-illus illus1" alt="Fauteuil">
                <i class="fa-solid fa-heart float-icon red"></i>
                <i class="fa-solid fa-face-laugh-beam float-icon yellow"></i>
                <i class="fa-solid fa-couch float-icon blue"></i>
                <i class="fa-solid fa-hammer float-icon gray"></i>
                <span class="label">E-shopping fun</span>
            </aside>

            <!-- Centre -->
            <div class="promo-slider" aria-label="promotions">
                <article class="promo a">
                    <div class="txt">
                        <h3>-20% sur les salons</h3>
                        <p>Cette semaine seulement. Confort & design.</p>
                    </div>
                    <img loading="lazy"
                        src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200&q=80&auto=format&fit=crop"
                        alt="Salon promo">
                </article>
                <article class="promo b">
                    <div class="txt">
                        <h3>Luminaires d'exception</h3>
                        <p>Éclairez vos soirées avec style.</p>
                    </div>
                    <img loading="lazy"
                        src="https://images.unsplash.com/photo-1540932239986-30128078f3c5?w=1200&q=80&auto=format&fit=crop"
                        alt="Luminaires">
                </article>
                <article class="promo c">
                    <div class="txt">
                        <h3>Extérieur & Jardin</h3>
                        <p>Profitez du plein air, version chic.</p>
                    </div>
                    <img loading="lazy"
                        src="https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80&auto=format&fit=crop"
                        alt="Jardin">
                </article>
            </div>

            <!-- Droite -->
            <aside class="promo-3d">
                <div class="orbit" aria-hidden="true">
                    <div class="cube">
                        <div class="front"></div>
                        <div class="back"></div>
                        <div class="right"></div>
                        <div class="left"></div>
                        <div class="top"></div>
                        <div class="bottom"></div>
                    </div>
                </div>
                <div class="bag"><i class="fa-solid fa-bag-shopping"></i> Ventes Flash</div>
                <div>
                    <h4>Jusqu'à -40%</h4>
                    <p>24h chrono — ne les manquez pas.</p>
                </div>
            </aside>
        </div>
    </div>

    {{-- === LISTING LAYOUT (SIDEBAR + GRID) === --}}
    @php
        $totalProducts = max(1, $products->total());
        $featPct = round(($featured->count() / $totalProducts) * 100);
        $promoPct = isset($promos) ? round(($promos->count() / $totalProducts) * 100) : 0;
    @endphp

    <div id="grid" class="container listing-layout">
        {{-- SIDEBAR FILTRES --}}
        <aside class="filters-sidebar" aria-label="Filtres catalogue">
            <div class="sidebar-head">
                <h3>Filtres</h3>
                <button type="button" class="sidebar-close" aria-label="Fermer les filtres">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            {{-- Résumé & Progress --}}
            <div class="sidebar-card k-glow">
                <div class="counts">
                    <span class="chip">Total : {{ $products->total() }}</span>
                    <span class="chip">Vedettes : {{ $featured->count() }}</span>
                    @isset($promos)
                        <span class="chip">Promos : {{ $promos->count() }}</span>
                    @endisset
                </div>

                <div class="k-progress">
                    <div class="k-progress-row">
                        <div class="k-progress-label"><i class="fa-solid fa-star"></i> Vedettes</div>
                        <div class="k-progress-bar">
                            <div class="k-progress-fill" style="width: {{ $featPct }}%"></div>
                        </div>
                        <div class="k-progress-val">{{ $featPct }}%</div>
                    </div>

                    @isset($promos)
                        <div class="k-progress-row">
                            <div class="k-progress-label"><i class="fa-solid fa-tags"></i> Promos</div>
                            <div class="k-progress-bar">
                                <div class="k-progress-fill alt" style="width: {{ $promoPct }}%"></div>
                            </div>
                            <div class="k-progress-val">{{ $promoPct }}%</div>
                        </div>
                    @endisset
                </div>
            </div>

            {{-- Formulaire de filtres --}}
            <form method="get" action="{{ route('products.discover') }}" class="sidebar-card k-glow">

                {{-- Tri --}}
                <div class="filter-group">
                    <button type="button" class="filter-title" data-accordion>
                        <i class="fa-solid fa-arrow-up-wide-short"></i>
                        Trier
                        <i class="fa-solid fa-chevron-down caret"></i>
                    </button>
                    <div class="filter-body">
                        <label for="sort" class="sr-only">Trier</label>
                        <select id="sort" name="sort" class="select" onchange="this.form.submit()">
                            <option value="popular" @selected($sort === 'popular')>Populaire</option>
                            <option value="newest" @selected($sort === 'newest')>Nouveautés</option>
                            <option value="price-asc" @selected($sort === 'price-asc')>Prix ↑</option>
                            <option value="price-desc" @selected($sort === 'price-desc')>Prix ↓</option>
                        </select>
                    </div>
                </div>

                {{-- Prix --}}
                <div class="filter-group">
                    <button type="button" class="filter-title" data-accordion>
                        <i class="fa-solid fa-euro-sign"></i>
                        Prix
                        <i class="fa-solid fa-chevron-down caret"></i>
                    </button>
                    <div class="filter-body row-2">
                        <div class="field">
                            <label>Min</label>
                            <input type="number" step="0.01" name="price_min"
                                value="{{ request('price_min') }}" placeholder="0.00">
                        </div>
                        <div class="field">
                            <label>Max</label>
                            <input type="number" step="0.01" name="price_max"
                                value="{{ request('price_max') }}" placeholder="9999.00">
                        </div>
                    </div>
                </div>

                {{-- Options --}}
                <div class="filter-group">
                    <button type="button" class="filter-title" data-accordion>
                        <i class="fa-solid fa-sliders"></i>
                        Options
                        <i class="fa-solid fa-chevron-down caret"></i>
                    </button>
                    <div class="filter-body chips">
                        <label class="chip-toggle">
                            <input type="checkbox" name="featured" value="1" @checked(request('featured'))>
                            <span><i class="fa-solid fa-star"></i> Vedette</span>
                        </label>
                        <label class="chip-toggle">
                            <input type="checkbox" name="in_stock" value="1" @checked(request('in_stock'))>
                            <span><i class="fa-solid fa-box"></i> En stock</span>
                        </label>
                        <label class="chip-toggle">
                            <input type="checkbox" name="fast_ship" value="1" @checked(request('fast_ship'))>
                            <span><i class="fa-solid fa-truck-fast"></i> Livraison rapide</span>
                        </label>
                    </div>
                </div>

                {{-- Note minimale --}}
                <div class="filter-group">
                    <button type="button" class="filter-title" data-accordion>
                        <i class="fa-solid fa-star-half-stroke"></i>
                        Note
                        <i class="fa-solid fa-chevron-down caret"></i>
                    </button>
                    <div class="filter-body stars">
                        @foreach ([4, 3, 2, 1] as $r)
                            <label>
                                <input type="radio" name="rating" value="{{ $r }}"
                                    @checked((int) request('rating') === $r)>
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star{{ $i <= $r ? '' : ' k-dim' }}"></i>
                                @endfor
                                &nbsp;{{ $r }}+
                            </label>
                        @endforeach
                        <label>
                            <input type="radio" name="rating" value="" @checked(!request('rating'))>
                            Toutes notes
                        </label>
                    </div>
                </div>

                {{-- Marques --}}
                @isset($brands)
                    <div class="filter-group">
                        <button type="button" class="filter-title" data-accordion>
                            <i class="fa-solid fa-briefcase"></i>
                            Marques
                            <i class="fa-solid fa-chevron-down caret"></i>
                        </button>
                        <div class="filter-body list">
                            @foreach ($brands as $b)
                                @php $checked = in_array($b->slug, (array)request('brand', [])); @endphp
                                <label class="row">
                                    <input type="checkbox" name="brand[]" value="{{ $b->slug }}"
                                        @checked($checked)>
                                    <span>{{ $b->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endisset

                {{-- Couleurs --}}
                <div class="filter-group">
                    <button type="button" class="filter-title" data-accordion>
                        <i class="fa-solid fa-palette"></i>
                        Couleurs
                        <i class="fa-solid fa-chevron-down caret"></i>
                    </button>
                    @php
                        $colors = ['#1f4e5f', '#4ECDC4', '#4a6bff', '#ff7a59', '#111111', '#eeeeee'];
                        $selColors = (array) request('color', []);
                    @endphp
                    <div class="filter-body colors">
                        @foreach ($colors as $c)
                            @php $isSel = in_array($c, $selColors); @endphp
                            <label class="swatch {{ $isSel ? 'active' : '' }}" style="--sw: {{ $c }}">
                                <input type="checkbox" name="color[]" value="{{ $c }}"
                                    @checked($isSel)>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="filter-actions">
                    <a href="{{ route('products.discover') }}" class="btn ghost">Réinitialiser</a>
                    <button class="btn primary" type="submit">
                        <i class="fa-solid fa-filter"></i> Appliquer
                    </button>
                </div>
            </form>
        </aside>

        {{-- MAIN --}}
        <main class="listing-main">
            <div class="products-header-inline">
                <h2>Nos articles</h2>
                <button type="button" class="btn outline show-filters">
                    <i class="fa-solid fa-filter"></i> Filtres
                </button>
            </div>

            <div class="grid">
                @forelse($products as $p)
                    @php
                        $imgs = (array) ($p->images ?? []);
                        $img = count($imgs)
                            ? $imgs[0]
                            : 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800&q=80&auto=format&fit=crop';
                        $hasPromo = !is_null($p->discount_price);
                        $display = $hasPromo ? $p->discount_price : $p->price;
                    @endphp
                    <a href="{{ route('products.show', $p->id) }}">
                    <article class="card" data-id="{{ $p->id }}">
                        <div class="media">
                            <img loading="lazy" src="{{ $img }}" alt="{{ $p->name }}">
                            @if ($hasPromo)
                                <span
                                    class="badge">-{{ number_format((1 - $p->discount_price / $p->price) * 100, 0) }}%</span>
                            @elseif($p->is_featured)
                                <span class="badge">Vedette</span>
                            @endif
                            <div class="like">
                                <button class="btn-like" aria-label="Aimer" data-liked="false">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <span class="count" data-like-count>{{ $p->likes_count }}</span>
                            </div>
                            <div class="views" style="top:auto;bottom:10px;right:10px">
                                <span class="count" data-view-count title="Vues">👁 {{ $p->views_count }}</span>
                            </div>
                        </div>
                        <div class="info">
                            <h3 class="title">{{ $p->name }}</h3>
                            <div class="price">
                                <span data-price>{{ number_format($display, 2, ',', ' ') }}
                                    {{ $p->currency ?? 'EUR' }}</span>
                                @if ($hasPromo)
                                    <span class="old">{{ number_format($p->price, 2, ',', ' ') }}
                                        {{ $p->currency ?? 'EUR' }}</span>
                                @endif
                            </div>
                            <div class="meta">
                                <span>❤ <span data-like-count-inline>{{ $p->likes_count }}</span></span>
                                <span>👁 <span data-view-count-inline>{{ $p->views_count }}</span></span>
                            </div>
                            <button class="btn-add-to-cart" type="button" data-id="{{ $p->id }}"
                                data-name="{{ $p->name }}" data-price="{{ $display }} "
                                 data-image="{{ $img /* ton URL d’image principale */ }}

                                ">Ajouter au
                                panier</button>
                        </div>
                    </article>
                    </a>
                @empty
                    <p>Aucun produit pour le moment.</p>
                @endforelse
            </div>

            <div style="display:flex;justify-content:center;margin:18px 0">
                {{ $products->links() }}
            </div>

            <!-- SECTION SLIDE : Vedettes -->
            <section class="section" aria-labelledby="vedettes">
                <div class="container">
                    <h2 id="vedettes">En vedette</h2>
                    <div class="slide-row">
                        @foreach ($featured as $f)
                            @php
                                $imgs = (array) ($f->images ?? []);
                                $img = count($imgs)
                                    ? $imgs[0]
                                    : 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&q=80&auto=format&fit=crop';
                            @endphp
                            <article class="slide">
                                <img loading="lazy" src="{{ $img }}" alt="{{ $f->name }}"
                                    style="width:100%;aspect-ratio:16/9;object-fit:cover">
                                <div style="padding:12px 14px">
                                    <strong>{{ $f->name }}</strong>
                                    <div style="color:var(--muted);font-size:14px">
                                        {{ number_format($f->price, 2, ',', ' ') }} {{ $f->currency ?? 'EUR' }}</div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- SECTION SLIDE : Promos -->
            @isset($promos)
                <section id="promos" class="section" aria-labelledby="promosTitle">
                    <div class="container">
                        <h2 id="promosTitle">Promotions</h2>
                        <div class="slide-row">
                            @foreach ($promos as $s)
                                @php
                                    $imgs = (array) ($s->images ?? []);
                                    $img = count($imgs)
                                        ? $imgs[0]
                                        : 'https://images.unsplash.com/photo-1540574163026-643ea20ade25?w=800&q=80&auto=format&fit=crop';
                                @endphp
                                <article class="slide">
                                    <img loading="lazy" src="{{ $img }}" alt="{{ $s->name }}"
                                        style="width:100%;aspect-ratio:16/9;object-fit:cover">
                                    <div style="padding:12px 14px">
                                        <strong>{{ $s->name }}</strong>
                                        <div>
                                            <span
                                                style="font-weight:700">{{ number_format($s->discount_price ?? $s->price, 2, ',', ' ') }}
                                                {{ $s->currency ?? 'EUR' }}</span>
                                            @if ($s->discount_price)
                                                <span class="old">{{ number_format($s->price, 2, ',', ' ') }}
                                                    {{ $s->currency ?? 'EUR' }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>

            </main>
        </div>



    @endisset

    {{-- ========= SCRIPTS ========= --}}
    <script>
        // Bases
        const CSRF = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
        const apiBase = "{{ url('/api') }}";

        // Effet 3D carte hero
        (function() {
            const card = document.getElementById('heroCard');
            if (!card) return;
            card.addEventListener('mousemove', (e) => {
                const r = card.getBoundingClientRect();
                const x = e.clientX - r.left;
                const y = e.clientY - r.top;
                const rotateY = (x / r.width - .5) * 10;
                const rotateX = (.5 - y / r.height) * 10;
                card.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
            });
            card.addEventListener('mouseleave', () => card.style.transform = 'rotateX(0) rotateY(0)');
        })();

        // Like (AJAX)
        (function() {
            document.querySelectorAll('.card').forEach(card => {
                const id = card.dataset.id;
                const likeBtn = card.querySelector('.btn-like');
                const likeCount = card.querySelector('[data-like-count]');
                const likeCountInline = card.querySelector('[data-like-count-inline]');
                if (!likeBtn) return;

                likeBtn.addEventListener('click', async () => {
                    likeBtn.disabled = true;
                    try {
                        const res = await fetch(`{{ url('/products') }}/${id}/like`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF,
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if (data?.ok) {
                            likeBtn.innerHTML = data.liked ?
                                '<i class="fa-solid fa-heart" style="color:#ff3b7a"></i>' :
                                '<i class="fa-regular fa-heart"></i>';
                            if (likeCount) likeCount.textContent = data.likes;
                            if (likeCountInline) likeCountInline.textContent = data.likes;
                        }
                    } catch (e) {
                        console.error(e);
                    } finally {
                        likeBtn.disabled = false;
                    }
                });
            });
        })();

        // Vues (IntersectionObserver)
        (function() {
            if (!('IntersectionObserver' in window)) return;
            const obs = new IntersectionObserver(entries => {
                entries.forEach(async (entry) => {
                    if (!entry.isIntersecting) return;
                    const card = entry.target;
                    const id = card.dataset.id;
                    obs.unobserve(card);
                    try {
                        const res = await fetch(`{{ url('/products') }}/${id}/view`, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': CSRF,
                                'Accept': 'application/json'
                            }
                        });
                        const data = await res.json();
                        if (data?.ok) {
                            const v1 = card.querySelector('[data-view-count]');
                            const v2 = card.querySelector('[data-view-count-inline]');
                            if (v1) v1.textContent = '👁 ' + data.views;
                            if (v2) v2.textContent = data.views;
                        }
                    } catch (e) {}
                });
            }, {
                threshold: .5
            });
            document.querySelectorAll('.card').forEach(c => obs.observe(c));
        })();

        // Menus User & Aide
        (function() {
            const userToggle = document.getElementById("userToggle");
            const dropdownUser = document.getElementById("dropdownUser");
            const helpToggle = document.getElementById("helpToggle");
            const dropdownHelp = document.getElementById("dropdownHelp");

            const toggle = (el) => {
                if (!el) return;
                el.style.display = el.style.display === "block" ? "none" : "block";
            }
            const hideAll = () => [dropdownUser, dropdownHelp].forEach(d => {
                if (d) d.style.display = "none";
            });

            if (userToggle && dropdownUser) {
                userToggle.addEventListener("click", (e) => {
                    e.stopPropagation();
                    hideAll();
                    toggle(dropdownUser);
                });
            }
            if (helpToggle && dropdownHelp) {
                helpToggle.addEventListener("click", (e) => {
                    e.stopPropagation();
                    hideAll();
                    toggle(dropdownHelp);
                });
            }
            document.addEventListener("click", hideAll);
        })();

        // Recherche (autosuggest) — sécurisé
        (function() {
            const input = document.getElementById('searchInput');
            const btn = document.getElementById('searchBtn');
            const dd = document.getElementById('searchDropdown');
            if (!input || !btn || !dd) return; // header sans recherche

            let cursor = -1;
            let items = [];
            let lastQ = '';
            const DEBOUNCE_MS = 180;

            const debounce = (fn, ms) => {
                let t;
                return (...args) => {
                    clearTimeout(t);
                    t = setTimeout(() => fn(...args), ms);
                };
            };
            const firstImage = (images) => {
                if (!images) return '';
                if (Array.isArray(images) && images[0]) return images[0];
                if (typeof images === 'string') {
                    try {
                        const arr = JSON.parse(images);
                        if (Array.isArray(arr) && arr[0]) return arr[0];
                    } catch (e) {}
                }
                return '';
            };
            const escapeHtml = (s) => String(s).replace(/[&<>"']/g, m => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [m]));

            function footer(q, count) {
                return `
                    <div class="search-footer">
                        <span>${count} résultat${count>1?'s':''}</span>
                        <a href="#" id="searchSeeAll">Voir tous les résultats pour “${escapeHtml(q)}”</a>
                    </div>`;
            }

            function render(q, data) {
                items = data || [];
                cursor = -1;

                if (!q || !items.length) {
                    dd.innerHTML = q ? `<div class="search-empty">Aucun résultat pour “${escapeHtml(q)}”.</div>` : '';
                    dd.style.display = q ? 'block' : 'none';
                    if (q) dd.innerHTML += footer(q, 0);
                    return;
                }

                const html = items.map((p, i) => {
                    const img = firstImage(p.images) || 'https://via.placeholder.com/80x80?text=—';
                    const price = (p.price != null) ? `${Number(p.price).toFixed(2)} ${p.currency || ''}` : '';
                    return `
                        <div class="search-item" data-index="${i}" data-id="${p.id}">
                            <img class="search-thumb" src="${img}" alt="">
                            <div>
                                <div class="search-title">${escapeHtml(p.name)}</div>
                                <div class="search-price">${escapeHtml(price)}</div>
                            </div>
                        </div>`;
                }).join('');

                dd.innerHTML = html + footer(q, items.length);
                dd.style.display = 'block';

                dd.querySelectorAll('.search-item').forEach(el => {
                    el.addEventListener('click', () => {
                        const id = el.getAttribute('data-id');
                        if (id) window.location.href = `product.html?id=${encodeURIComponent(id)}`;
                    });
                });
                const allLink = dd.querySelector('#searchSeeAll');
                if (allLink) allLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.location.href = `recherche.html?q=${encodeURIComponent(q)}`;
                });
            }

            const doSearch = debounce(async (q) => {
                q = q.trim();
                lastQ = q;
                if (!q) {
                    dd.style.display = 'none';
                    dd.innerHTML = '';
                    return;
                }
                try {
                    const res = await fetch(`${apiBase}/search?q=${encodeURIComponent(q)}`, {
                        headers: {
                            Accept: 'application/json'
                        }
                    });
                    const data = await res.json();
                    if (q !== lastQ) return;
                    render(q, Array.isArray(data) ? data : []);
                } catch (e) {
                    console.error(e);
                    render(q, []);
                }
            }, DEBOUNCE_MS);

            input.addEventListener('input', e => doSearch(e.target.value));
            input.addEventListener('focus', () => {
                if (input.value.trim()) doSearch(input.value);
            });
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const q = input.value.trim();
                if (!q) return;
                window.location.href = `recherche.html?q=${encodeURIComponent(q)}`;
            });

            input.addEventListener('keydown', (e) => {
                if (dd.style.display !== 'block') return;
                const max = items.length - 1;
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    cursor = (cursor < max) ? cursor + 1 : 0;
                    updateActive();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    cursor = (cursor > 0) ? cursor - 1 : max;
                    updateActive();
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (cursor >= 0 && items[cursor]) window.location.href =
                        `product.html?id=${encodeURIComponent(items[cursor].id)}`;
                    else if (input.value.trim()) window.location.href =
                        `recherche.html?q=${encodeURIComponent(input.value.trim())}`;
                } else if (e.key === 'Escape') {
                    dd.style.display = 'none';
                }
            });

            function updateActive() {
                dd.querySelectorAll('.search-item').forEach((el, i) => {
                    if (i === cursor) {
                        el.classList.add('active');
                        el.scrollIntoView({
                            block: 'nearest'
                        });
                    } else el.classList.remove('active');
                });
            }
            document.addEventListener('click', (e) => {
                if (!dd.contains(e.target) && e.target !== input) {
                    dd.style.display = 'none';
                }
            });
        })();

        // Panier (localStorage)
        (function() {
            const CART_KEY = "cart";
            let cart = JSON.parse(localStorage.getItem(CART_KEY) || "[]");

            const cartLink = document.getElementById("cart-link");
            const cartCountEl = cartLink ? cartLink.querySelector(".cart-count") : null;
            const checkoutModal = document.getElementById("checkout-modal");
            const closeModal = checkoutModal ? checkoutModal.querySelector(".close-modal") : null;
            const cartItemsContainer = document.getElementById("cart-items");
            const subtotalElement = document.getElementById("subtotal");
            const totalElement = document.getElementById("total");

            const euro = (n) => `€${Number(n).toFixed(2)}`;
            const saveCart = () => localStorage.setItem(CART_KEY, JSON.stringify(cart));

            function updateCartCount() {
                if (!cartCountEl) return;
                const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
                cartCountEl.textContent = totalItems;
            }

            function updateCartDisplay() {
                if (!cartItemsContainer || !subtotalElement || !totalElement) return;
                cartItemsContainer.innerHTML = "";
                if (cart.length === 0) {
                    cartItemsContainer.innerHTML = "<p>Votre panier est vide.</p>";
                    subtotalElement.textContent = euro(0);
                    totalElement.textContent = euro(0);
                    return;
                }
                let subtotal = 0;
                cart.forEach((item) => {
                    const itemTotal = item.price * item.quantity;
                    subtotal += itemTotal;
                    const row = document.createElement("div");
                    row.className = "summary-item";
                    row.innerHTML =
                    `<span>${item.name} x${item.quantity}</span><span>${euro(itemTotal)}</span>`;
                    cartItemsContainer.appendChild(row);
                });
                subtotalElement.textContent = euro(subtotal);
                totalElement.textContent = euro(subtotal);
            }

            // Ajouter au panier — boutons sur les cartes
            document.querySelectorAll(".btn-add-to-cart").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name");
                    const price = parseFloat(btn.getAttribute("data-price") || "0");
                    const existing = cart.find((i) => i.id == id);
                    if (existing) existing.quantity += 1;
                    else cart.push({
                        id,
                        name,
                        price,
                        quantity: 1
                    });
                    saveCart();
                    updateCartCount();
                    alert(`${name} a été ajouté à votre panier !`);
                });
            });

            if (cartLink) {
                cartLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    const userToken = localStorage.getItem("userToken");
                    if (!userToken) {
                        window.location.href = "{{ route('login') }}";
                        return;
                    }
                    if (checkoutModal) {
                        updateCartDisplay();
                        checkoutModal.style.display = "block";
                    } else {
                        window.location.href = "checkout.html";
                    }
                });
            }
            if (closeModal && checkoutModal) {
                closeModal.addEventListener("click", () => checkoutModal.style.display = "none");
                window.addEventListener("click", (e) => {
                    if (e.target === checkoutModal) checkoutModal.style.display = "none";
                });
            }
            updateCartCount();
        })();

        // Header sticky (apparition/disparition)
        (function() {
            let lastScrollTop = 0;
            const header = document.getElementById("mainHeader");
            if (!header) return;
            window.addEventListener("scroll", function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > lastScrollTop) {
                    header.style.top = "-150px";
                } else {
                    header.style.top = "0";
                }
                lastScrollTop = Math.max(0, scrollTop);
            });
        })();

        // Lazy YouTube (si présent)
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector(".youtube-container iframe");
            if (iframe && iframe.getAttribute("data-src")) {
                iframe.setAttribute("src", iframe.getAttribute("data-src"));
            }
        });

        // Langue / traductions (une seule fonction globale)
        (function() {
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
                }
            };
            window.changeLanguage = function(lang) {
                const codeEls = document.querySelectorAll(".language-code");
                codeEls.forEach((el) => el.textContent = (lang || 'fr').toUpperCase());
                document.getElementById("dropdownLanguage")?.style && (document.getElementById("dropdownLanguage")
                    .style.display = "none");

                document.querySelectorAll(".translate").forEach((el) => {
                    const key = el.getAttribute("data-key");
                    el.textContent = (translations[lang] && translations[lang][key]) || (translations['fr'][
                        key
                    ] || '');
                });
                const searchInput = document.querySelector(".search-container input");
                if (searchInput) searchInput.placeholder = translations[lang]?.search_placeholder || translations[
                    'fr'].search_placeholder;
                const countrySearch = document.getElementById("countrySearch");
                if (countrySearch) countrySearch.placeholder = translations[lang]?.search_country || translations[
                    'fr'].search_country;

                localStorage.setItem("preferredLanguage", lang);
            };

            document.addEventListener("DOMContentLoaded", function() {
                const savedLanguage = localStorage.getItem("preferredLanguage");
                const browserLanguage = (navigator.language || 'fr').slice(0, 2);
                const lang = savedLanguage || (translations[browserLanguage] ? browserLanguage : 'fr');
                window.changeLanguage(lang);

                const languageToggle = document.getElementById("languageToggle");
                const dropdownLanguage = document.getElementById("dropdownLanguage");
                languageToggle?.addEventListener("click", (e) => {
                    e.stopPropagation();
                    if (dropdownLanguage) dropdownLanguage.style.display = dropdownLanguage.style
                        .display === "block" ? "none" : "block";
                });
                document.addEventListener("click", (e) => {
                    if (!e.target.closest(".language-dropdown")) {
                        if (dropdownLanguage) dropdownLanguage.style.display = "none";
                    }
                });
            });
        })();

        // Menu mobile + sous-menus + région
        (function() {
            const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
            const mobileMenuModal = document.getElementById("mobileMenuModal");
            const closeMobileMenu = document.getElementById("closeMobileMenu");
            const mobileMenuBack = document.getElementById("mobileMenuBack");
            const mobileMainMenu = document.getElementById("mobileMainMenu");
            const helpMenu = document.getElementById("helpMenu");
            const regionMenu = document.getElementById("regionMenu");
            const menuSections = document.querySelectorAll(".mobile-menu-section");

            if (mobileMenuToggle && mobileMenuModal) {
                mobileMenuToggle.addEventListener("click", function() {
                    mobileMenuModal.style.display = "block";
                    document.body.style.overflow = "hidden";
                });
            }
            closeMobileMenu?.addEventListener("click", function() {
                mobileMenuModal.style.display = "none";
                document.body.style.overflow = "";
            });
            mobileMenuModal?.addEventListener("click", function(e) {
                if (e.target === mobileMenuModal) {
                    mobileMenuModal.style.display = "none";
                    document.body.style.overflow = "auto";
                }
            });

            menuSections.forEach((section) => {
                section.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    if (!target) return;
                    document.getElementById(target)?.style && (document.getElementById(target).style
                        .display = "block");
                    if (mobileMainMenu) mobileMainMenu.style.display = "none";
                    if (mobileMenuBack) mobileMenuBack.style.display = "block";
                });
            });

            mobileMenuBack?.addEventListener("click", function() {
                if (mobileMainMenu) mobileMainMenu.style.display = "block";
                if (helpMenu) helpMenu.style.display = "none";
                if (regionMenu) regionMenu.style.display = "none";
                this.style.display = "none";
            });

            document.querySelector(".cancel-region")?.addEventListener("click", function() {
                if (mobileMainMenu) mobileMainMenu.style.display = "block";
                if (regionMenu) regionMenu.style.display = "none";
                if (mobileMenuBack) mobileMenuBack.style.display = "none";
            });

            document.getElementById("mobileRegionForm")?.addEventListener("submit", function(e) {
                e.preventDefault();
                const fd = new FormData(this);
                const currency = fd.get("currency");
                const country = fd.get("country");
                const language = fd.get("language");
                localStorage.setItem("userSettings", JSON.stringify({
                    currency,
                    country,
                    language
                }));
                updateRegionalSettings(currency, country, language);
                if (mobileMainMenu) mobileMainMenu.style.display = "block";
                if (regionMenu) regionMenu.style.display = "none";
                if (mobileMenuBack) mobileMenuBack.style.display = "none";
            });

            window.updateRegionalSettings = function(currency, country, language) {
                console.log("Paramètres mis à jour:", {
                    currency,
                    country,
                    language
                });
            };
        })();

        // Chat (si présent)
        (function() {
            const chatBtn = document.getElementById("chatBtn");
            const chatModal = document.getElementById("chatModal");
            const closeChat = document.getElementById("closeChat");
            const sendBtn = document.getElementById("sendBtn");
            if (!chatBtn || !chatModal) return;

            chatBtn.addEventListener("click", () => {
                chatModal.style.display = "flex";
            });
            closeChat?.addEventListener("click", () => {
                chatModal.style.display = "none";
            });
            sendBtn?.addEventListener("click", () => {
                const input = document.getElementById("chatInput");
                const message = (input?.value || '').trim();
                if (!message) return;
                const chatBody = document.getElementById("chatBody");
                if (!chatBody) return;
                const userMsg = document.createElement("div");
                userMsg.className = "chat-message user";
                userMsg.textContent = message;
                chatBody.appendChild(userMsg);
                const botMsg = document.createElement("div");
                botMsg.className = "chat-message bot";
                botMsg.textContent = "Merci pour votre message, nous vous répondrons bientôt !";
                chatBody.appendChild(botMsg);
                input.value = "";
                chatBody.scrollTop = chatBody.scrollHeight;
            });
        })();

        // Coupons / étapes checkout (garde-fous)
        (function() {
            const subtotalElement = document.getElementById("subtotal");
            const totalElement = document.getElementById("total");
            const cartItemsContainer = document.getElementById("cart-items");
            const euro = (n) => `€${Number(n).toFixed(2)}`;

            document.getElementById("apply-coupon")?.addEventListener("click", function() {
                const couponCode = document.getElementById("coupon")?.value || "";
                if (!subtotalElement || !totalElement || !cartItemsContainer) return;

                if (couponCode.toUpperCase() === "KELU15") {
                    const subtotal = parseFloat((subtotalElement.textContent || '0').replace(/[€\s]/g, "")) ||
                    0;
                    const discount = subtotal * 0.15;
                    const total = subtotal - discount;

                    let discountElement = document.getElementById("discount-element");
                    if (!discountElement) {
                        discountElement = document.createElement("div");
                        discountElement.id = "discount-element";
                        discountElement.className = "summary-item";
                        cartItemsContainer.appendChild(discountElement);
                    }
                    discountElement.innerHTML =
                        `<span>Réduction (15%)</span><span>-€${discount.toFixed(2)}</span>`;
                    totalElement.textContent = euro(total);
                    alert("Code promo appliqué avec succès!");
                } else {
                    alert("Code promo invalide");
                }
            });

            document.getElementById("proceed-to-checkout")?.addEventListener("click", () => alert(
                "Fonctionnalité de paiement à implémenter"));

            document.querySelector(".floating-buttons button:nth-child(1)")?.addEventListener("click", () => alert(
                "Partage à implémenter"));
            document.querySelector(".floating-buttons button:nth-child(2)")?.addEventListener("click", () => alert(
                "Cagnotte à implémenter"));

            document.getElementById("proceed-to-delivery")?.addEventListener("click", function() {
                document.getElementById("checkout-modal")?.style && (document.getElementById("checkout-modal")
                    .style.display = "none");
                document.getElementById("delivery-modal")?.style && (document.getElementById("delivery-modal")
                    .style.display = "block");
            });
            document.getElementById("proceed-to-payment")?.addEventListener("click", function() {
                document.getElementById("delivery-modal")?.style && (document.getElementById("delivery-modal")
                    .style.display = "none");
                document.getElementById("payment-modal")?.style && (document.getElementById("payment-modal")
                    .style.display = "block");
            });
            document.getElementById("confirm-order")?.addEventListener("click", function() {
                document.getElementById("payment-modal")?.style && (document.getElementById("payment-modal")
                    .style.display = "none");
                document.getElementById("confirmation-modal")?.style && (document.getElementById(
                    "confirmation-modal").style.display = "block");
            });
            document.getElementById("back-to-cart")?.addEventListener("click", function() {
                document.getElementById("delivery-modal")?.style && (document.getElementById("delivery-modal")
                    .style.display = "none");
                document.getElementById("checkout-modal")?.style && (document.getElementById("checkout-modal")
                    .style.display = "block");
            });
            document.getElementById("back-to-delivery")?.addEventListener("click", function() {
                document.getElementById("payment-modal")?.style && (document.getElementById("payment-modal")
                    .style.display = "none");
                document.getElementById("delivery-modal")?.style && (document.getElementById("delivery-modal")
                    .style.display = "block");
            });
            document.getElementById("return-to-shop")?.addEventListener("click", function() {
                document.getElementById("confirmation-modal")?.style && (document.getElementById(
                    "confirmation-modal").style.display = "none");
                window.location.href = "/";
            });
            document.querySelectorAll(".close-modal").forEach((btn) => btn.addEventListener("click", function() {
                this.closest(".modal").style.display = "none";
            }));
        })();

        // Sidebar filtres (mobile + accordéons)
        (function() {
            const sidebar = document.querySelector('.filters-sidebar');
            const openBtn = document.querySelector('.show-filters');
            const closeBtn = document.querySelector('.sidebar-close');

            if (openBtn && sidebar) {
                openBtn.addEventListener('click', () => {
                    sidebar.classList.add('open');
                    document.body.style.overflow = 'hidden';
                });
            }
            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    document.body.style.overflow = '';
                });
            }
            document.addEventListener('click', (e) => {
                if (!sidebar) return;
                if (!sidebar.classList.contains('open')) return;
                const within = sidebar.contains(e.target) || (openBtn && openBtn.contains(e.target));
                if (!within) {
                    sidebar.classList.remove('open');
                    document.body.style.overflow = '';
                }
            });

            document.querySelectorAll('[data-accordion]').forEach(btn => {
                btn.addEventListener('click', () => {
                    btn.classList.toggle('active');
                    const body = btn.nextElementSibling;
                    if (!body) return;
                    const visible = getComputedStyle(body).display !== 'none';
                    body.style.display = visible ? 'none' : 'block';
                });
                const body = btn.nextElementSibling;
                if (body) body.style.display = 'block';
            });
        })();

        // AR Measurement (initialisation sûre)
        (function() {
            class ARMeasurementApp {
                constructor() {
                    this.isActive = false;
                    this.measurementPoints = [];
                    this.measurements = [];
                    this.pixelsPerMM = 2;
                    this.videoStream = null;
                    this.elements = {
                        arBtn: document.getElementById("arMeasureBtn"),
                        arContainer: document.getElementById("arContainer"),
                        video: document.getElementById("videoStream"),
                        overlay: document.getElementById("arOverlay"),
                        statusIndicator: document.getElementById("statusIndicator"),
                        statusText: document.getElementById("statusText"),
                        pointCount: document.getElementById("pointCount"),
                        lastMeasurement: document.getElementById("lastMeasurement"),
                        addPointBtn: document.getElementById("addPointBtn"),
                        clearBtn: document.getElementById("clearBtn"),
                        sendBtn: document.getElementById("sendMeasurementsBtn"),
                        closeBtn: document.getElementById("closeArBtn"),
                        switchCameraBtn: document.getElementById("switchCameraBtn"),
                    };
                    this.bindEvents();
                }
                bindEvents() {
                    const E = this.elements;
                    if (E.arBtn) E.arBtn.addEventListener("click", () => this.startAR());
                    if (E.closeBtn) E.closeBtn.addEventListener("click", () => this.stopAR());
                    if (E.addPointBtn) E.addPointBtn.addEventListener("click", () => this.addMeasurementPoint());
                    if (E.clearBtn) E.clearBtn.addEventListener("click", () => this.clearMeasurements());
                    if (E.sendBtn) E.sendBtn.addEventListener("click", () => this.sendMeasurements());
                    if (E.overlay) E.overlay.addEventListener("click", (e) => {
                        if (!this.isActive) return;
                        const rect = E.overlay.getBoundingClientRect();
                        this.addPointAtPosition(e.clientX - rect.left, e.clientY - rect.top);
                    });
                }
                async startAR() {
                    try {
                        this.showStatus("Demande d'autorisation caméra...");
                        if (!navigator.mediaDevices?.getUserMedia) throw new Error("getUserMedia non supporté");
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
                        } catch (error) {
                            if (error.name === "OverconstrainedError" || error.name === "NotFoundError") {
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
                            } else {
                                throw error;
                            }
                        }
                        this.videoStream = stream;
                        if (this.elements.video) {
                            this.elements.video.srcObject = stream;
                        }
                        await new Promise((resolve, reject) => {
                            if (!this.elements.video) return resolve();
                            this.elements.video.onloadedmetadata = resolve;
                            this.elements.video.onerror = reject;
                            setTimeout(() => reject(new Error("Timeout")), 10000);
                        });
                        this.elements.arContainer?.classList.remove("hidden");
                        this.hideStatus();
                        this.isActive = true;
                        this.calibrateScale();
                    } catch (error) {
                        console.error("Erreur caméra:", error);
                        this.showStatus("❌ Erreur caméra");
                        setTimeout(() => this.hideStatus(), 2500);
                    }
                }
                stopAR() {
                    if (this.videoStream) {
                        this.videoStream.getTracks().forEach(t => t.stop());
                        this.videoStream = null;
                    }
                    this.elements.arContainer?.classList.add("hidden");
                    this.isActive = false;
                    this.clearMeasurements();
                }
                calibrateScale() {
                    if (!this.elements.video) return;
                    const screenWidth = window.screen.width || this.elements.video.videoWidth || 1;
                    const videoWidth = this.elements.video.videoWidth || screenWidth;
                    this.pixelsPerMM = (videoWidth / screenWidth) * 0.5;
                }
                addPointAtPosition(x, y) {
                    if (!this.elements.overlay) return;
                    const point = {
                        id: Date.now(),
                        x,
                        y,
                        timestamp: new Date()
                    };
                    this.measurementPoints.push(point);
                    const dot = document.createElement("div");
                    dot.className = "measurement-point";
                    dot.style.left = `${x}px`;
                    dot.style.top = `${y}px`;
                    this.elements.overlay.appendChild(dot);
                    if (this.measurementPoints.length >= 2) this.calculateAndRenderMeasurement();
                    this.updateUI();
                }
                addMeasurementPoint() {
                    if (!this.elements.overlay) return;
                    const centerX = this.elements.overlay.offsetWidth / 2;
                    const centerY = this.elements.overlay.offsetHeight / 2;
                    this.addPointAtPosition(centerX, centerY);
                }
                calculateAndRenderMeasurement() {
                    if (this.measurementPoints.length < 2 || !this.elements.overlay) return;
                    const [p1, p2] = this.measurementPoints.slice(-2);
                    const pixelDistance = Math.hypot(p2.x - p1.x, p2.y - p1.y);
                    const realDistance = pixelDistance / this.pixelsPerMM / 10; // cm
                    const line = document.createElement("div");
                    line.className = "measurement-line";
                    const length = pixelDistance;
                    const angle = Math.atan2(p2.y - p1.y, p2.x - p1.x) * 180 / Math.PI;
                    line.style.width = `${length}px`;
                    line.style.left = `${p1.x}px`;
                    line.style.top = `${p1.y}px`;
                    line.style.transform = `rotate(${angle}deg)`;
                    line.style.transformOrigin = "0 50%";
                    const label = document.createElement("div");
                    label.className = "measurement-label";
                    const displayDistance = realDistance >= 100 ? `${(realDistance/100).toFixed(2)} m` :
                        `${realDistance.toFixed(1)} cm`;
                    label.textContent = displayDistance;
                    label.style.left = `${(p1.x + p2.x)/2}px`;
                    label.style.top = `${(p1.y + p2.y)/2 - 30}px`;
                    this.elements.overlay.appendChild(line);
                    this.elements.overlay.appendChild(label);
                    if (this.elements.lastMeasurement) this.elements.lastMeasurement.textContent = displayDistance;
                }
                clearMeasurements() {
                    this.measurementPoints = [];
                    this.measurements = [];
                    if (!this.elements.overlay) return;
                    this.elements.overlay.querySelectorAll(
                        ".measurement-point, .measurement-line, .measurement-label").forEach(el => el.remove());
                    this.updateUI();
                }
                updateUI() {
                    if (this.elements.pointCount) this.elements.pointCount.textContent = this.measurementPoints
                        .length;
                    const instructionEl = document.getElementById("instructionText");
                    if (!instructionEl) return;
                    if (this.measurementPoints.length === 0) {
                        instructionEl.innerHTML = "📍 Cliquez sur le <strong>premier coin</strong> à mesurer";
                        instructionEl.style.color = "#4a6bff";
                    } else if (this.measurementPoints.length === 1) {
                        instructionEl.innerHTML = "📍 Maintenant cliquez sur le <strong>second coin</strong>";
                        instructionEl.style.color = "#ff4757";
                    } else {
                        instructionEl.innerHTML = "✅ Mesure terminée ! Vous pouvez en ajouter d'autres";
                        instructionEl.style.color = "#2ed573";
                    }
                }
                showStatus(msg) {
                    if (this.elements.statusText) this.elements.statusText.textContent = msg;
                    this.elements.statusIndicator?.classList.remove("hidden");
                }
                hideStatus() {
                    this.elements.statusIndicator?.classList.add("hidden");
                }
            }
            // N'initialise l'app que si le bouton AR existe (page/section présente)
            document.addEventListener("DOMContentLoaded", () => {
                if (document.getElementById("arMeasureBtn")) new ARMeasurementApp();
            });
        })();
    </script>

    <!-- Place tes bundles compilés ici si besoin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/google-translate.js') }}"></script>
    <script src="{{ asset('js/cart-core.js') }}" defer></script>
    <script src="{{ asset('js/app-auth.js') }}" defer></script>

    @include('partials.footer')
</body>

</html>
