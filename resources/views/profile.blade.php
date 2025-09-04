<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>Keluvato — Mon profil</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        :root {
            --brand: #1f4e5f;
            --brand-2: #134150;
            --ink: #0f172a;
            --muted: #6b7280;
            --paper: #ffffff;
            --soft: #f6f9fb;
            --ring: rgba(31, 78, 95, 0.18);
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Montserrat, system-ui, -apple-system, Segoe UI, Roboto,
                "Helvetica Neue", Arial;
            background: #f1f5f9;
            color: var(--ink);
        }

        /* Header minimal (logo only) */
        .app-header {
            background: linear-gradient(180deg, var(--brand), var(--brand-2));
            color: #fff;
        }

        .logo-wrapper {
            background-image: url("assets/IMG.png");
            background-size: contain;
            background-repeat: no-repeat;
            width: 210px;
            height: 64px;
        }

        /* Hero avec halo sobre */
        .hero {
            background: linear-gradient(135deg,
                    rgba(31, 78, 95, 0.98),
                    rgba(19, 65, 80, 0.98));
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .hero:after {
            content: "";
            position: absolute;
            inset: -40% -10% auto -10%;
            background: radial-gradient(60% 40% at 10% 0%,
                    rgba(255, 255, 255, 0.14),
                    transparent 60%),
                radial-gradient(40% 30% at 100% 0%,
                    rgba(255, 255, 255, 0.1),
                    transparent 60%);
            pointer-events: none;
            filter: blur(30px);
        }

        /* Avatar + edit */
        .avatar-ring {
            width: 96px;
            height: 96px;
            border-radius: 50%;
            background: conic-gradient(from 220deg, #a0e9ff, #b9ffb4, #a0e9ff);
            padding: 2px;
            box-shadow: 0 10px 26px rgba(0, 0, 0, 0.25);
        }

        .avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            background: #fff;
            display: grid;
            place-items: center;
            position: relative;
            cursor: pointer;
        }

        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .avatar .initials {
            font-weight: 800;
            font-size: 28px;
            color: var(--brand);
        }

        .avatar .ovl {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.28);
            color: #fff;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            transition: 0.18s;
            backdrop-filter: blur(1px);
        }

        .avatar:hover .ovl {
            opacity: 1;
        }

        /* Cartes “glass” + bordure dégradée subtile */
        .card-neo {
            background: rgba(255, 255, 255, 0.96);
            border: 1px solid rgba(15, 23, 42, 0.06);
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            position: relative;
            overflow: hidden;
        }

        .card-neo:before {
            content: "";
            position: absolute;
            inset: -1px;
            border-radius: 16px;
            pointer-events: none;
            background: linear-gradient(135deg,
                    rgba(31, 78, 95, 0.35),
                    rgba(31, 78, 95, 0),
                    rgba(31, 78, 95, 0.2));
            -webkit-mask: linear-gradient(#000 0 0) content-box,
                linear-gradient(#000 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            padding: 1px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 0.7rem;
            border-radius: 999px;
            font-size: 0.78rem;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.35);
        }

        .chip.pro {
            background: rgba(59, 130, 246, 0.18);
        }

        .chip.user {
            background: rgba(34, 197, 94, 0.18);
        }

        .text-muted-600 {
            color: #64748b !important;
        }

        /* Table responsive */
        .table thead th {
            color: #475569;
            font-weight: 700;
            background: #fafafa;
        }

        /* Modal avatar (petit) */
        .modal-avatar .modal-dialog {
            max-width: 360px;
        }

        .crop-box {
            width: 220px;
            height: 220px;
            margin-inline: auto;
            border-radius: 12px;
            background: #0b1214;
            overflow: hidden;
            position: relative;
            box-shadow: 0 12px 30px rgba(2, 6, 23, 0.25);
        }

        .crop-img {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(1);
            transform-origin: center;
            user-select: none;
            pointer-events: none;
            max-width: none;
        }

        .crop-mask {
            position: absolute;
            inset: 0;
            pointer-events: none;
            box-shadow: inset 0 0 0 9999px rgba(0, 0, 0, 0.45);
            -webkit-mask: radial-gradient(circle at center,
                    transparent 50%,
                    black 51%);
            mask: radial-gradient(circle at center, transparent 50%, black 51%);
        }

        /* Brand buttons */
        .btn-brand {
            --bs-btn-bg: var(--brand);
            --bs-btn-border-color: var(--brand);
            --bs-btn-hover-bg: #173f4c;
            --bs-btn-hover-border-color: #173f4c;
            color: #fff;
        }

        .btn-outline-brand {
            --bs-btn-color: var(--brand);
            --bs-btn-border-color: var(--brand);
            --bs-btn-hover-bg: var(--brand);
            --bs-btn-hover-color: #fff;
        }

        /* Small helpers */
        .skeleton {
            position: relative;
            overflow: hidden;
            background: #f1f5f9;
            color: transparent;
        }

        .skeleton:after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.75),
                    transparent);
            transform: translateX(-100%);
            animation: shimmer 1s infinite;
        }

        @keyframes shimmer {
            to {
                transform: translateX(100%);
            }
        }

        .chipp {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            background-color: #e0f2f1;
            color: #00695c;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .chipp:hover {
            background-color: #b2dfdb;
        }
    </style>
</head>

<body>
    <!-- HERO -->
    <!-- SECTION HERO DU PROFIL -->
    <section class="hero py-4 py-md-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <!-- Colonne avatar -->
                <div class="col-auto">
                    <div class="avatar-ring">
                        <div class="avatar" id="avatarBtn" title="Changer la photo">
                            <img id="avatarImg" alt="Photo de profil" style="display: none;" />

                            <!-- Initiales au cas où il n'y a pas d'image -->
                            <div class="initials" id="avatarInitials">
                                {{ strtoupper(Auth::user()->name[0] ?? '?') }}
                            </div>

                            <div class="ovl">
                                <i class="fa-solid fa-camera me-1"></i>Changer
                            </div>
                        </div>
                    </div>

                    <!-- Input caché pour sélectionner une image -->
                    <input id="avatarInput" type="file" accept="image/*" hidden />
                </div>


                <!-- Colonne infos utilisateur -->
                <div class="col">
                    <h1 class="h4 mb-2" style="border-radius: 8px; min-width: 220px">
                        {{ Auth::user()->name }}
                    </h1>

                    <div class="d-flex flex-wrap gap-2">
                        <!-- Rôle -->
                        <span class="chip">
                            @php
                                $role = Auth::user()->role;
                                $label =
                                    $role === 'pro' ? 'Professionnel' : ($role === 'client' ? 'Client' : 'Utilisateur');
                            @endphp
                            <i class="fa-solid fa-user-tag me-1"></i>{{ $label }}
                        </span>

                        <!-- Email -->
                        <span class="chip">
                            <i class="fa-regular fa-envelope"></i>
                            <span class="ms-1">{{ Auth::user()->email ?? '—' }}</span>
                        </span>

                        <!-- Téléphone -->
                        <span class="chip">
                            <i class="fa-solid fa-phone"></i>
                            <span class="ms-1">{{ Auth::user()->phone ?? '—' }}</span>
                        </span>

                        <!-- Pays -->
                        <span class="chip">
                            <i class="fa-solid fa-flag"></i>
                            <span class="ms-1">{{ Auth::user()->country ?? '—' }}</span>
                        </span>

                        <!-- Lien vers l'accueil -->
                        <a href="{{ route('home') }}" class="chipp">
                            <i class="fa-solid fa-house me-1"></i>Accueil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CONTENT -->
    <main class="container my-4 my-md-5">
        <div class="row g-3 g-lg-4">
            <!-- Col principale -->
            <div class="col-lg-8 d-flex flex-column gap-3 gap-lg-4">
                <!-- Infos personnelles -->
                <div class="card-neo">
                    <div class="d-flex align-items-center justify-content-between px-3 px-lg-4 py-3 border-bottom">
                        <h3 class="h6 mb-0">Informations personnelles</h3>
                        <a href="#" id="btnEditProfile" class="btn btn-sm btn-outline-secondary">
                            <i class="fa-regular fa-pen-to-square me-1"></i>Modifier
                        </a>
                    </div>
                    <div class="p-3 p-lg-4">
                        <div class="row gy-2">
                            <div class="col-md-6">
                                <div class="text-muted-600 small">Nom complet</div>
                                <div id="vFullname" class="fw-semibold">{{ Auth::user()->name }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted-600 small">Email</div>
                                <div id="vEmail" class="fw-semibold">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted-600 small">Téléphone</div>
                                <div id="vPhone" class="fw-semibold">{{ Auth::user()->phone ?? '—' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="text-muted-600 small">Pays</div>
                                <div id="vCountry" class="fw-semibold">{{ Auth::user()->country ?? '—' }}</div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted-600 small">Rôle</div>
                                <div id="vRole" class="fw-semibold">
                                    @if (Auth::user()->role === 'pro')
                                        Professionnel
                                    @elseif(Auth::user()->role === 'client')
                                        Client
                                    @else
                                        Utilisateur
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bloc PRO (affiché seulement si role === 'pro') -->
                @if (Auth::user()->role === 'pro')
                    <div class="card-neo">
                        <div class="px-3 px-lg-4 py-3 border-bottom">
                            <h3 class="h6 mb-0">Informations professionnelles</h3>
                        </div>
                        <div class="p-3 p-lg-4">
                            <div class="row gy-2">
                                <div class="col-md-6">
                                    <div class="text-muted-600 small">Entreprise</div>
                                    <div id="vCompany" class="fw-semibold">{{ Auth::user()->company ?? '—' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted-600 small">Email pro</div>
                                    <div id="vCompanyEmail" class="fw-semibold">
                                        {{ Auth::user()->company_email ?? '—' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted-600 small">SIRET / ID</div>
                                    <div id="vSiret" class="fw-semibold">{{ Auth::user()->siret ?? '—' }}</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-muted-600 small">Site web</div>
                                    <div class="fw-semibold">
                                        @if (Auth::user()->website)
                                            <a id="vWebsiteLink" href="{{ Auth::user()->website }}" target="_blank"
                                                rel="noopener">Voir le site</a>
                                        @else
                                            <span id="vWebsiteText">—</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('home') }}" class="btn btn-brand">
                                    <i class="fa-solid fa-briefcase me-1"></i> Espace pro
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Adresses -->
                <div class="card-neo">
                    <div class="d-flex align-items-center justify-content-between px-3 px-lg-4 py-3 border-bottom">
                        <h3 class="h6 mb-0">Adresses</h3>
                        <a href="#" id="btnManageAddr" class="btn btn-sm btn-outline-secondary">
                            <i class="fa-regular fa-map me-1"></i>Gérer
                        </a>
                    </div>
                    <div class="p-3 p-lg-4">
                        <div id="addrList" class="d-grid gap-2">
                            <div class="p-3 border rounded-3">Aucune adresse enregistrée.</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Col latérale -->
            <div class="col-lg-4 d-flex flex-column gap-3 gap-lg-4">
                <!-- Cagnotte & Points -->
                <div class="card-neo">
                    <div class="px-3 px-lg-4 py-3 border-bottom">
                        <h3 class="h6 mb-0">Cagnotte & Points</h3>
                    </div>
                    <div class="p-3 p-lg-4">
                        <div class="row g-2">
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <div class="small text-muted-600">Cagnotte disponible</div>
                                    <div id="vWallet" class="fs-5 fw-bold">—</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="border rounded-3 p-3 bg-white">
                                    <div class="small text-muted-600">Points de fidélité</div>
                                    <div id="vPoints" class="fs-5 fw-bold">—</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-grid">
                            <a href="{{ route('orders') }}" class="btn btn-outline-brand">
                                <i class="fa-solid fa-cart-shopping me-1"></i> Utiliser sur une commande
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Activité récente -->
                <div class="card-neo">
                    <div class="d-flex align-items-center justify-content-between px-3 px-lg-4 py-3 border-bottom">
                        <h3 class="h6 mb-0">Activité récente</h3>
                        <a href="{{ route('orders') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fa-regular fa-clock me-1"></i>Tout voir
                        </a>
                    </div>
                    <div class="p-3 p-lg-4">
                        <div id="ordersEmpty" class="text-muted-600">
                            Aucune commande récente.
                        </div>
                        <div class="table-responsive d-none" id="ordersWrap">
                            <table class="table table-sm align-middle mb-0" id="ordersTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="mt-3 d-grid">
                            <a href="{{ route('orders') }}" class="btn btn-brand">
                                <i class="fa-solid fa-box-open me-1"></i> Mes commandes
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Sécurité du compte -->
                <div class="card-neo">
                    <div class="px-3 px-lg-4 py-3 border-bottom">
                        <h3 class="h6 mb-0">Sécurité du compte</h3>
                    </div>
                    <div class="p-3 p-lg-4">
                        <div class="row gy-2">
                            <div class="col-12">
                                <div class="text-muted-600 small">Dernière connexion</div>
                                <div id="vLastLogin" class="fw-semibold">{{ Auth::user()->last_login_at ?? '—' }}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="text-muted-600 small">2FA</div>
                                <div id="v2fa" class="fw-semibold">
                                    {{ Auth::user()->two_factor_enabled ? 'Activée' : 'Non activée' }}
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-grid gap-2">
                            <a href="{{ route('password.request') }}" class="btn btn-outline-secondary">
                                <i class="fa-solid fa-key me-1"></i> Changer le mot de passe
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal avatar (petit) -->
    <div class="modal fade modal-avatar" id="avatarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title">Photo de profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>

                <form method="POST" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="d-grid gap-2 mb-2">
                            <label for="avatarInputModal" class="btn btn-outline-secondary btn-sm"
                                style="cursor: pointer">
                                <i class="fa-solid fa-image me-1"></i> Choisir une image
                            </label>
                            <input id="avatarInputModal" type="file" name="avatar" accept="image/*" hidden
                                required>
                        </div>

                        <div class="crop-box mb-2" id="cropArea">
                            <img id="cropImg" class="crop-img" src="{{ Auth::user()->avatar_url ?? '' }}"
                                alt="Photo actuelle" />
                            <div class="crop-mask"></div>
                        </div>

                        <label for="zoomRange" class="form-label small mb-1">Zoom</label>
                        <input id="zoomRange" type="range" min="1" max="3" step="0.01"
                            value="1.2" class="form-range" />

                        <div class="small text-muted">
                            Astuce : déplacez l’image au doigt (mobile) ou à la souris.
                        </div>
                    </div>

                    <div class="modal-footer py-2">
                        <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-brand btn-sm" id="saveCrop">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Toast -->
    <div class="position-fixed start-50 translate-middle-x bottom-0 pb-3" style="z-index: 1080">
        <div id="toast" class="px-3 py-2 bg-dark text-white rounded-3 shadow d-none">
            Enregistré ✅
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            const $ = (s, root = document) => root.querySelector(s);

            // Avatar au chargement : lire depuis localStorage
            const storedAvatar = localStorage.getItem("avatarImage");
            if (storedAvatar) {
                $("#avatarImg").src = storedAvatar;
                $("#avatarImg").style.display = "block";
                $("#avatarInitials").style.display = "none";
            }

            const avatarInput = $("#avatarInput");
            const avatarBtn = $("#avatarBtn");
            const avatarModal = new bootstrap.Modal($("#avatarModal"));
            const pickFileBtn = $("#pickFile");
            const cropImg = $("#cropImg");
            const cropArea = $("#cropArea");
            const zoomRange = $("#zoomRange");
            const saveCropBtn = $("#saveCrop");

            let imgBlobUrl = null,
                naturalW = 0,
                naturalH = 0;
            let zoom = 1.2,
                baseScale = 1,
                scaleUI = 1;
            let offsetX = 0,
                offsetY = 0,
                dragging = false,
                lastX = 0,
                lastY = 0;

            function openAvatarModal() {
                avatarModal.show();
            }

            function resetCrop() {
                if (imgBlobUrl) {
                    URL.revokeObjectURL(imgBlobUrl);
                    imgBlobUrl = null;
                }
                cropImg.removeAttribute("src");
                offsetX = offsetY = 0;
                zoom = 1.2;
                zoomRange.value = "1.2";
                scaleUI = 1;
                baseScale = 1;
            }

            $("#avatarModal").addEventListener("hidden.bs.modal", resetCrop);

            function setupFromImage(url) {
                cropImg.onload = () => {
                    naturalW = cropImg.naturalWidth;
                    naturalH = cropImg.naturalHeight;
                    const size = cropArea.clientWidth;
                    baseScale = size / Math.min(naturalW, naturalH);
                    zoom = parseFloat(zoomRange.value || "1.2") || 1.2;
                    scaleUI = baseScale * zoom;
                    offsetX = 0;
                    offsetY = 0;
                    paintCrop();
                };
                cropImg.src = url;
            }

            function paintCrop() {
                clampOffsets();
                cropImg.style.transform =
                    `translate(calc(-50% + ${offsetX}px), calc(-50% + ${offsetY}px)) scale(${scaleUI})`;
            }

            function clampOffsets() {
                const size = cropArea.clientWidth;
                const sw = naturalW * scaleUI,
                    sh = naturalH * scaleUI;
                const ex = Math.max(0, (sw - size) / 2),
                    ey = Math.max(0, (sh - size) / 2);
                offsetX = Math.max(-ex, Math.min(ex, offsetX));
                offsetY = Math.max(-ey, Math.min(ey, offsetY));
            }

            avatarBtn.addEventListener("click", () => avatarInput.click());
            pickFileBtn.addEventListener("click", () => avatarInput.click());

            avatarInput.addEventListener("change", () => {
                const f = avatarInput.files?.[0];
                if (f && f.type.startsWith("image/")) startCropWithFile(f);
            });

            function startCropWithFile(file) {
                if (imgBlobUrl) {
                    URL.revokeObjectURL(imgBlobUrl);
                    imgBlobUrl = null;
                }
                imgBlobUrl = URL.createObjectURL(file);
                setupFromImage(imgBlobUrl);
                openAvatarModal();
            }

            zoomRange.addEventListener("input", () => {
                zoom = parseFloat(zoomRange.value || "1.2") || 1.2;
                const size = cropArea.clientWidth;
                scaleUI = (size / Math.min(naturalW, naturalH)) * zoom;
                paintCrop();
            });

            cropArea.addEventListener("pointerdown", (e) => {
                dragging = true;
                cropArea.setPointerCapture(e.pointerId);
                lastX = e.clientX;
                lastY = e.clientY;
            });

            window.addEventListener("pointermove", (e) => {
                if (!dragging) return;
                const dx = e.clientX - lastX,
                    dy = e.clientY - lastY;
                lastX = e.clientX;
                lastY = e.clientY;
                offsetX += dx;
                offsetY += dy;
                paintCrop();
            }, {
                passive: true
            });

            window.addEventListener("pointerup", () => (dragging = false));

            async function exportAvatarBlob() {
                const size = cropArea.clientWidth;
                const out = 320;
                const ratio = out / size;

                const canvas = document.createElement("canvas");
                canvas.width = out;
                canvas.height = out;
                const ctx = canvas.getContext("2d");

                ctx.save();
                ctx.beginPath();
                ctx.arc(out / 2, out / 2, out / 2, 0, Math.PI * 2);
                ctx.clip();

                const scaleCanvas = scaleUI * ratio;
                ctx.translate(out / 2 + offsetX * ratio, out / 2 + offsetY * ratio);
                ctx.scale(scaleCanvas, scaleCanvas);
                ctx.drawImage(cropImg, -naturalW / 2, -naturalH / 2);
                ctx.restore();

                return new Promise((res) =>
                    canvas.toBlob((b) => res(b), "image/png", 0.92)
                );
            }

            $("#saveCrop").addEventListener("click", async () => {
                try {
                    saveCropBtn.disabled = true;
                    saveCropBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-1"></span>Enregistrement…';
                    const blob = await exportAvatarBlob();

                    // Convertir le blob en base64
                    const reader = new FileReader();
                    reader.onloadend = function() {
                        const base64data = reader.result;
                        localStorage.setItem("avatarImage", base64data);
                        $("#avatarImg").src = base64data;
                        $("#avatarImg").style.display = "block";
                        $("#avatarInitials").style.display = "none";
                        avatarModal.hide();
                    };
                    reader.readAsDataURL(blob);

                } catch (e) {
                    console.error(e);
                    alert("Erreur lors de l’enregistrement");
                } finally {
                    saveCropBtn.disabled = false;
                    saveCropBtn.innerHTML = '<i class="fa-solid fa-floppy-disk me-1"></i> Enregistrer';
                }
            });
        })();
    </script>


<script src="{{ asset('js/google-translate.js') }}"></script>
</body>

</html>
