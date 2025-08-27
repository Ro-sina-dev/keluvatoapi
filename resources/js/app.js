import './bootstrap';

        // Menus User & Aide — version simple et robuste
        (function() {
            const userToggle = document.getElementById("userToggle");
            const dropdownUser = document.getElementById("dropdownUser");
            const helpToggle = document.getElementById("helpToggle");
            const dropdownHelp = document.getElementById("dropdownHelp");

            function toggle(el) {
                if (!el) return;
                el.style.display = el.style.display === "block" ? "none" : "block";
            }

            function hideAll() {
                [dropdownUser, dropdownHelp].forEach((d) => {
                    if (d) d.style.display = "none";
                });
            }

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




        (function() {
            const input = document.getElementById('searchInput');
            const btn = document.getElementById('searchBtn');
            const dd = document.getElementById('searchDropdown');

            let cursor = -1; // index sélection clavier
            let items = []; // cache items affichés
            let lastQ = '';
            const DEBOUNCE_MS = 180;

            // util: debounce
            const debounce = (fn, ms) => {
                let t;
                return (...args) => {
                    clearTimeout(t);
                    t = setTimeout(() => fn(...args), ms);
                };
            };

            // util: première image
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

            // rendu dropdown
            function render(q, data) {
                items = data || [];
                cursor = -1;

                if (!q || !items.length) {
                    dd.innerHTML = q ? `
      <div class="search-empty">Aucun résultat pour “${escapeHtml(q)}”.</div>` : '';
                    dd.style.display = q ? 'block' : 'none';
                    if (q) dd.innerHTML += footer(q, 0);
                    return;
                }

                const html = [
                    ...items.map((p, i) => {
                        const img = firstImage(p.images) || 'https://via.placeholder.com/80x80?text=—';
                        const price = (p.price != null) ? `${Number(p.price).toFixed(2)} ${p.currency || ''}` :
                            '';
                        return `
          <div class="search-item" data-index="${i}" data-id="${p.id}">
            <img class="search-thumb" src="${img}" alt="">
            <div>
              <div class="search-title">${escapeHtml(p.name)}</div>
              <div class="search-price">${escapeHtml(price)}</div>
            </div>
          </div>
        `;
                    })
                ].join('');

                dd.innerHTML = html + footer(q, items.length);
                dd.style.display = 'block';

                // Bind click
                dd.querySelectorAll('.search-item').forEach(el => {
                    el.addEventListener('click', () => {
                        const id = el.getAttribute('data-id');
                        goToProduct(id);
                    });
                });

                // “Voir tous les résultats”
                const allLink = dd.querySelector('#searchSeeAll');
                if (allLink) allLink.addEventListener('click', (e) => {
                    e.preventDefault();
                    goToResults(q);
                });
            }

            //function footer(q, count) {
            // return `
        //  <div class="search-footer">
        //   <span>${count} résultat${count>1?'s':''}</span>
        //  <a href="#" id="searchSeeAll">Voir tous les résultats pour “${escapeHtml(q)}”</a>
        // </div>
        //`;
            //}

            // sécurité HTML
            function escapeHtml(s) {
                return String(s).replace(/[&<>"']/g, m => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                } [m]));
            }

            // navigation
            function goToProduct(id) {
                if (!id) return;
                window.location.href = `product.html?id=${encodeURIComponent(id)}`;
            }

            function goToResults(q) {
                // page résultats de ton choix
                window.location.href = `recherche.html?q=${encodeURIComponent(q)}`;
            }

            // fetch suggestions
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
                    // si l’utilisateur a déjà tapé autre chose, on ignore
                    if (q !== lastQ) return;
                    render(q, Array.isArray(data) ? data : []);
                } catch (e) {
                    console.error(e);
                    render(q, []);
                }
            }, DEBOUNCE_MS);

            // events
            input.addEventListener('input', (e) => doSearch(e.target.value));
            input.addEventListener('focus', () => {
                if (input.value.trim()) doSearch(input.value);
            });

            // bouton loupe = page résultats complète
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const q = input.value.trim();
                if (!q) return;
                goToResults(q);
            });

            // clavier: Entrée / Échap / ↑ / ↓
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
                    if (cursor >= 0 && items[cursor]) goToProduct(items[cursor].id);
                    else if (input.value.trim()) goToResults(input.value.trim());
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
                    } else {
                        el.classList.remove('active');
                    }
                });
            }

            // fermer si clic dehors
            document.addEventListener('click', (e) => {
                if (!dd.contains(e.target) && e.target !== input) {
                    dd.style.display = 'none';
                }
            });
        })();





        (function() {
            const CART_KEY = "cart";
            let cart = JSON.parse(localStorage.getItem(CART_KEY) || "[]");

            // DOM
            const cartLink = document.getElementById("cart-link");
            const cartCountEl = cartLink ?
                cartLink.querySelector(".cart-count") :
                null;
            const checkoutModal = document.getElementById("checkout-modal");
            const closeModal = checkoutModal ?
                checkoutModal.querySelector(".close-modal") :
                null;
            const cartItemsContainer = document.getElementById("cart-items");
            const subtotalElement = document.getElementById("subtotal");
            const totalElement = document.getElementById("total");

            // Utils
            const euro = (n) => `€${Number(n).toFixed(2)}`;
            const saveCart = () =>
                localStorage.setItem(CART_KEY, JSON.stringify(cart));

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
                    row.innerHTML = `<span>${item.name} x${item.quantity
                        }</span><span>${euro(itemTotal)}</span>`;
                    cartItemsContainer.appendChild(row);
                });

                subtotalElement.textContent = euro(subtotal);
                totalElement.textContent = euro(subtotal);
            }

            // Ajouter au panier
            document.querySelectorAll(".btn-add-to-cart").forEach((btn) => {
                btn.addEventListener("click", () => {
                    const id = btn.getAttribute("data-id");
                    const name = btn.getAttribute("data-name");
                    const price = parseFloat(btn.getAttribute("data-price") || "0");

                    const existing = cart.find((i) => i.id === id);
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

            // Clic sur l'icône Panier
            if (cartLink) {
                cartLink.addEventListener("click", (e) => {
                    e.preventDefault();
                    const userToken = localStorage.getItem("userToken");

                    // Non connecté → login
                    if (!userToken) {
                        window.location.href = "{{ route('login') }}";
                        return;
                    }

                    // Connecté → modal si présent, sinon page panier
                    if (checkoutModal) {
                        updateCartDisplay();
                        checkoutModal.style.display = "block";
                    } else {
                        window.location.href = "checkout.html";
                    }
                });
            }

            // Fermeture du modal
            if (closeModal && checkoutModal) {
                closeModal.addEventListener(
                    "click",
                    () => (checkoutModal.style.display = "none")
                );
                window.addEventListener("click", (e) => {
                    if (e.target === checkoutModal)
                        checkoutModal.style.display = "none";
                });
            }

            // Init compteur
            updateCartCount();
        })();








        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement("script");
                    d.innerHTML =
                        "window.__CF$cv$params={r:'95b1de7461e0b7a5',t:'MTc1MTgzMzkyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName("head")[0].appendChild(d);
                }
            }
            if (document.body) {
                var a = document.createElement("iframe");
                a.height = 1;
                a.width = 1;
                a.style.position = "absolute";
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = "none";
                a.style.visibility = "hidden";
                document.body.appendChild(a);
                if ("loading" !== document.readyState) c();
                else if (window.addEventListener)
                    document.addEventListener("DOMContentLoaded", c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        "loading" !== document.readyState &&
                            ((document.onreadystatechange = e), c());
                    };
                }
            }
        })();








        // Script pour gérer l'affichage mobile
        document.addEventListener("DOMContentLoaded", function() {
            // Gestion du menu burger
            const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
            const mobileMenuModal = document.getElementById("mobileMenuModal");
            const closeMobileMenu = document.getElementById("closeMobileMenu");

            if (mobileMenuToggle && mobileMenuModal) {
                mobileMenuToggle.addEventListener("click", function() {
                    mobileMenuModal.style.display = "block";
                    document.body.style.overflow = "hidden";
                });
            }

            if (closeMobileMenu && mobileMenuModal) {
                closeMobileMenu.addEventListener("click", function() {
                    mobileMenuModal.style.display = "none";
                    document.body.style.overflow = "auto";
                });
            }

            // Fermer le modal si on clique en dehors
            mobileMenuModal.addEventListener("click", function(e) {
                if (e.target === mobileMenuModal) {
                    mobileMenuModal.style.display = "none";
                    document.body.style.overflow = "auto";
                }
            });

            // Gestion des menus déroulants desktop
            const toggleButtons = document.querySelectorAll('[id$="Toggle"]');
            toggleButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.stopPropagation();
                    const dropdownId = this.id.replace("Toggle", "");
                    const dropdown = document.getElementById(dropdownId);
                    const isVisible = dropdown.style.display === "block";

                    // Fermer tous les autres menus
                    document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                        if (menu.id !== dropdownId) {
                            menu.style.display = "none";
                        }
                    });

                    // Basculer l'affichage du menu courant
                    dropdown.style.display = isVisible ? "none" : "block";
                });
            });

            // Fermer les menus déroulants quand on clique ailleurs
            document.addEventListener("click", function() {
                document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                    menu.style.display = "none";
                });
            });

            // Empêcher la fermeture quand on clique dans le menu
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.addEventListener("click", function(e) {
                    e.stopPropagation();
                });
            });

            // Fonction pour changer la langue
            window.changeLanguage = function(lang) {
                console.log("Changement de langue vers:", lang);
                // Ici vous ajouteriez la logique pour changer la langue
                document.querySelectorAll(".language-code").forEach((el) => {
                    el.textContent = lang.toUpperCase();
                });
                document.getElementById("mobileMenuModal").style.display = "none";
                document.body.style.overflow = "auto";
            };
        });












        let lastScrollTop = 0;
        const header = document.getElementById("mainHeader");

        window.addEventListener("scroll", function() {
            const scrollTop =
                window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                // On descend → cacher le header
                header.style.top = "-150px"; // adapte cette valeur à la hauteur de ton header
            } else {
                // On remonte → afficher le header
                header.style.top = "0";
            }

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // pour éviter valeurs négatives
        });


















        // Chargement différé pour améliorer les performances
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector(".youtube-container iframe");
            iframe.setAttribute("src", iframe.getAttribute("src"));
        });





        // Liste complète des pays (exemple partiel)
        const countrie = [{
                code: "FR",
                name: "France",
                currency: "EUR",
                symbol: "€",
                flag: "fr",
            },
            {
                code: "DE",
                name: "Allemagne",
                currency: "EUR",
                symbol: "€",
                flag: "de",
            },
            {
                code: "US",
                name: "États-Unis",
                currency: "USD",
                symbol: "$",
                flag: "us",
            },
            // ... autres pays ...
        ];

        // Dictionnaire de traduction
        const translations = {
            fr: {
                search_placeholder: "Rechercher des meubles, décoration...",
                select_country: "Sélectionnez votre pays",
                search_country: "Rechercher un pays...",
            },
            en: {
                search_placeholder: "Search for furniture, decor...",
                select_country: "Select your country",
                search_country: "Search for a country...",
            },
            es: {
                search_placeholder: "Buscar muebles, decoración...",
                select_country: "Selecciona tu país",
                search_country: "Buscar un país...",
            },
        };

        // Langue par défaut
        let currentLanguage = "fr";

        // Fonction pour changer la langue
        function changeLanguage(lang) {
            currentLanguage = lang;
            document.querySelector(".language-code").textContent =
                lang.toUpperCase();
            document.getElementById("dropdownLanguage").style.display = "none";

            // Mettre à jour les textes traduits
            document.querySelectorAll(".translate").forEach((el) => {
                const key = el.getAttribute("data-key");
                el.textContent = translations[lang][key] || translations["fr"][key];
            });

            // Mettre à jour le placeholder de recherche
            document.querySelector(".search-container input").placeholder =
                translations[lang]["search_placeholder"];
            document.getElementById("countrySearch").placeholder =
                translations[lang]["search_country"];

            // Sauvegarder la préférence
            localStorage.setItem("preferredLanguage", lang);
        }

        // Initialisation
        document.addEventListener("DOMContentLoaded", function() {
            // Récupérer la langue sauvegardée ou détecter la langue du navigateur
            const savedLanguage = localStorage.getItem("preferredLanguage");
            const browserLanguage = navigator.language.slice(0, 2);

            if (savedLanguage) {
                changeLanguage(savedLanguage);
            } else if (translations[browserLanguage]) {
                changeLanguage(browserLanguage);
            }

            // Gestion des menus déroulants
            const languageToggle = document.getElementById("languageToggle");
            const dropdownLanguage = document.getElementById("dropdownLanguage");

            languageToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                dropdownLanguage.style.display =
                    dropdownLanguage.style.display === "block" ? "none" : "block";
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest(".language-dropdown")) {
                    dropdownLanguage.style.display = "none";
                }
            });

            // ... (le reste de votre code existant pour les pays) ...
        });

        // ... (le reste de votre code JavaScript existant) ...











        // Gestion du menu mobile
        document.addEventListener("DOMContentLoaded", function() {
            const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
            const mobileMenuModal = document.getElementById("mobileMenuModal");
            const closeMobileMenu = document.getElementById("closeMobileMenu");
            const mobileMenuBack = document.getElementById("mobileMenuBack");
            const mobileMainMenu = document.getElementById("mobileMainMenu");
            const helpMenu = document.getElementById("helpMenu");
            const regionMenu = document.getElementById("regionMenu");
            const menuSections = document.querySelectorAll(".mobile-menu-section");

            // Ouvrir/fermer le menu mobile
            if (mobileMenuToggle) {
                mobileMenuToggle.addEventListener("click", function() {
                    mobileMenuModal.style.display = "block";
                    document.body.style.overflow = "hidden";
                });
            }

            closeMobileMenu.addEventListener("click", function() {
                mobileMenuModal.style.display = "none";
                document.body.style.overflow = "";
            });

            // Navigation dans les sous-menus
            menuSections.forEach((section) => {
                section.addEventListener("click", function() {
                    const target = this.getAttribute("data-target");
                    document.getElementById(target).style.display = "block";
                    mobileMainMenu.style.display = "none";
                    mobileMenuBack.style.display = "block";
                });
            });

            // Bouton retour
            mobileMenuBack.addEventListener("click", function() {
                mobileMainMenu.style.display = "block";
                helpMenu.style.display = "none";
                regionMenu.style.display = "none";
                this.style.display = "none";
            });

            // Annuler les paramètres régionaux
            document
                .querySelector(".cancel-region")
                ?.addEventListener("click", function() {
                    mobileMainMenu.style.display = "block";
                    regionMenu.style.display = "none";
                    mobileMenuBack.style.display = "none";
                });

            // Soumission des paramètres régionaux
            document
                .getElementById("mobileRegionForm")
                ?.addEventListener("submit", function(e) {
                    e.preventDefault();

                    const formData = new FormData(this);
                    const currency = formData.get("currency");
                    const country = formData.get("country");
                    const language = formData.get("language");

                    // Sauvegarder les préférences
                    localStorage.setItem(
                        "userSettings",
                        JSON.stringify({
                            currency: currency,
                            country: country,
                            language: language,
                        })
                    );

                    // Mettre à jour l'interface
                    updateRegionalSettings(currency, country, language);

                    // Revenir au menu principal
                    mobileMainMenu.style.display = "block";
                    regionMenu.style.display = "none";
                    mobileMenuBack.style.display = "none";


                });
        });

        function updateRegionalSettings(currency, country, language) {
            // Mettre à jour les éléments de l'interface en fonction des nouveaux paramètres
            console.log("Paramètres mis à jour:", {
                currency,
                country,
                language
            });
            // Implémentez ici la logique pour mettre à jour votre interface
        }





        // Fonctions pour gérer le modal
        function openCountryModal() {
            document.getElementById("dropdownCountry").style.display =
                "block";
        }

        function closeCountryModal() {
            document.getElementById("dropdownCountry").style.display =
                "none";
        }

        // Fermer quand on clique sur ×
        document.querySelector(".close").onclick = closeCountryModal;

        // Fermer quand on clique sur Annuler
        document.querySelector(".cancel-btn").onclick = closeCountryModal;

        // Fermer quand on clique en dehors du modal
        window.onclick = function(event) {
            if (
                event.target == document.getElementById("dropdownCountry")
            ) {
                closeCountryModal();
            }
        };



        document.getElementById("chatBtn").addEventListener("click", () => {
            document.getElementById("chatModal").style.display = "flex";
        });

        document.getElementById("closeChat").addEventListener("click", () => {
            document.getElementById("chatModal").style.display = "none";
        });

        document.getElementById("sendBtn").addEventListener("click", () => {
            const input = document.getElementById("chatInput");
            const message = input.value.trim();
            if (message !== "") {
                const chatBody = document.getElementById("chatBody");

                // Message utilisateur
                const userMsg = document.createElement("div");
                userMsg.className = "chat-message user";
                userMsg.textContent = message;
                chatBody.appendChild(userMsg);

                // Réponse bot simulée
                const botMsg = document.createElement("div");
                botMsg.className = "chat-message bot";
                botMsg.textContent =
                    "Merci pour votre message, nous vous répondrons bientôt !";
                chatBody.appendChild(botMsg);

                input.value = "";
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });






        class ARMeasurementApp {
            constructor() {
                this.isActive = false;
                this.measurementPoints = [];
                this.measurements = [];
                this.pixelsPerMM = 2;
                this.videoStream = null;

                this.currentFacingMode = "environment"; // Commence par la caméra arrière
                this.availableCameras = [];

                this.initializeElements();
                this.bindEvents();
                this.detectAvailableCameras();
            }

            initializeElements() {
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
                    // Nouveaux éléments pour le modal
                    permissionModal: document.getElementById("cameraPermissionModal"),
                    allowCameraBtn: document.getElementById("allowCameraBtn"),
                    denyCameraBtn: document.getElementById("denyCameraBtn"),
                    closePermissionModal: document.getElementById(
                        "closePermissionModal"
                    ),
                };
            }

            bindEvents() {
                if (this.elements.arBtn) {
                    this.elements.arBtn.addEventListener("click", () => this.startAR());
                }
                this.elements.closeBtn.addEventListener("click", () => this.stopAR());
                this.elements.addPointBtn.addEventListener("click", () =>
                    this.addMeasurementPoint()
                );
                this.elements.clearBtn.addEventListener("click", () =>
                    this.clearMeasurements()
                );
                this.elements.sendBtn.addEventListener("click", () =>
                    this.sendMeasurements()
                );

                this.elements.overlay.addEventListener("click", (e) => {
                    if (this.isActive) {
                        const rect = this.elements.overlay.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;
                        this.addPointAtPosition(x, y);
                    }
                });
            }

            async startAR() {
                try {
                    this.showStatus("Demande d'autorisation caméra...");

                    if (
                        !navigator.mediaDevices ||
                        !navigator.mediaDevices.getUserMedia
                    ) {
                        throw new Error("getUserMedia non supporté par ce navigateur");
                    }

                    const stream = await navigator.mediaDevices
                        .getUserMedia({
                            video: {
                                facingMode: "environment",
                                width: {
                                    ideal: 1920,
                                    min: 640
                                },
                                height: {
                                    ideal: 1080,
                                    min: 480
                                },
                            },
                        })
                        .catch(async (error) => {
                            if (
                                error.name === "OverconstrainedError" ||
                                error.name === "NotFoundError"
                            ) {
                                return await navigator.mediaDevices.getUserMedia({
                                    video: {
                                        facingMode: "user",
                                        width: {
                                            ideal: 1280,
                                            min: 640
                                        },
                                        height: {
                                            ideal: 720,
                                            min: 480
                                        },
                                    },
                                });
                            }
                            throw error;
                        });

                    this.videoStream = stream;
                    this.elements.video.srcObject = stream;

                    await new Promise((resolve, reject) => {
                        this.elements.video.onloadedmetadata = resolve;
                        this.elements.video.onerror = reject;
                        setTimeout(() => reject(new Error("Timeout")), 10000);
                    });

                    this.elements.arContainer.classList.remove("hidden");
                    this.hideStatus();
                    this.isActive = true;
                    this.calibrateScale();
                } catch (error) {
                    console.error("Erreur caméra:", error);
                    this.handleCameraError(error);
                }
            }

            handleCameraError(error) {
                let message = "";
                switch (error.name) {
                    case "NotAllowedError":
                        message = "🚫 Accès caméra refusé";
                        break;
                    case "NotFoundError":
                        message = "📷 Aucune caméra trouvée";
                        break;
                    default:
                        message = "❌ Erreur caméra";
                }
                this.showCameraPermissionDialog(message);
            }

            showCameraPermissionDialog(message) {
                const modal = document.createElement("div");
                modal.style.cssText = `
                    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0,0,0,0.9); display: flex; align-items: center;
                    justify-content: center; z-index: 9999; padding: 20px;
                `;

                const isChrome = /Chrome/.test(navigator.userAgent);
                const isFirefox = /Firefox/.test(navigator.userAgent);
                const isMobile = /Mobi|Android/i.test(navigator.userAgent);

                let instructions = "";
                if (isChrome) {
                    instructions =
                        "Cliquez sur l'icône 📷 dans la barre d'adresse et autorisez la caméra";
                } else if (isFirefox) {
                    instructions = 'Cliquez sur "Autoriser" dans la popup de Firefox';
                } else {
                    instructions =
                        "Autorisez l'accès à la caméra dans votre navigateur";
                }

                modal.innerHTML = `
                    <div style="background: white; padding: 30px; border-radius: 20px; max-width: 400px; text-align: center; color: #333;">
                        <div style="font-size: 60px; margin-bottom: 20px;">📷</div>
                        <h2 style="color: #ff4757; margin-bottom: 15px;">${message}</h2>
                        <p style="margin-bottom: 20px;">${instructions}</p>
                        <div style="background: #fff9c4; padding: 15px; border-radius: 8px; margin: 20px 0;">
                            <strong>⚠️ Important :</strong><br>
                            Vos images ne sont jamais enregistrées ni envoyées.
                        </div>
                        <div style="display: flex; gap: 15px; justify-content: center;">
                            <button onclick="window.location.reload()" style="padding: 15px 25px; background: #4a6bff; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                🔄 Réessayer
                            </button>
                            <button onclick="this.parentElement.parentElement.remove()" style="padding: 15px 25px; background: #636e72; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                ❌ Annuler
                            </button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);
                this.hideStatus();
            }

            stopAR() {
                if (this.videoStream) {
                    this.videoStream.getTracks().forEach((track) => track.stop());
                    this.videoStream = null;
                }
                this.elements.arContainer.classList.add("hidden");
                this.isActive = false;
                this.clearMeasurements();
            }

            calibrateScale() {
                const screenWidth = window.screen.width;
                const videoWidth = this.elements.video.videoWidth;
                this.pixelsPerMM = (videoWidth / screenWidth) * 0.5;
            }

            addPointAtPosition(x, y) {
                const point = {
                    id: Date.now(),
                    x: x,
                    y: y,
                    timestamp: new Date()
                };
                this.measurementPoints.push(point);
                this.renderPoint(point);

                if (this.measurementPoints.length >= 2) {
                    this.calculateAndRenderMeasurement();
                }
                this.updateUI();
            }

            addMeasurementPoint() {
                const centerX = this.elements.overlay.offsetWidth / 2;
                const centerY = this.elements.overlay.offsetHeight / 2;
                this.addPointAtPosition(centerX, centerY);
            }

            renderPoint(point) {
                const pointElement = document.createElement("div");
                pointElement.className = "measurement-point";
                pointElement.style.left = `${point.x}px`;
                pointElement.style.top = `${point.y}px`;
                this.elements.overlay.appendChild(pointElement);
            }

            calculateAndRenderMeasurement() {
                const points = this.measurementPoints;
                if (points.length < 2) return;

                const [point1, point2] = points.slice(-2);
                const pixelDistance = Math.sqrt(
                    Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
                );
                const realDistance = pixelDistance / this.pixelsPerMM / 10;

                const measurement = {
                    id: Date.now(),
                    point1,
                    point2,
                    pixelDistance,
                    realDistance,
                    timestamp: new Date(),
                };

                this.measurements.push(measurement);
                this.renderMeasurementLine(measurement);
            }

            renderMeasurementLine(measurement) {
                const {
                    point1,
                    point2,
                    realDistance
                } = measurement;

                const line = document.createElement("div");
                line.className = "measurement-line";

                const length = Math.sqrt(
                    Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
                );
                const angle =
                    (Math.atan2(point2.y - point1.y, point2.x - point1.x) * 180) /
                    Math.PI;

                line.style.width = `${length}px`;
                line.style.left = `${point1.x}px`;
                line.style.top = `${point1.y}px`;
                line.style.transform = `rotate(${angle}deg)`;
                line.style.transformOrigin = "0 50%";

                const label = document.createElement("div");
                label.className = "measurement-label";

                let displayDistance =
                    realDistance >= 100 ?
                    `${(realDistance / 100).toFixed(2)} m` :
                    `${realDistance.toFixed(1)} cm`;

                label.textContent = displayDistance;
                label.style.left = `${(point1.x + point2.x) / 2}px`;
                label.style.top = `${(point1.y + point2.y) / 2 - 30}px`;

                this.elements.overlay.appendChild(line);
                this.elements.overlay.appendChild(label);
                this.elements.lastMeasurement.textContent = displayDistance;
            }

            clearMeasurements() {
                this.measurementPoints = [];
                this.measurements = [];

                const measurementElements = this.elements.overlay.querySelectorAll(
                    ".measurement-point, .measurement-line, .measurement-label"
                );
                measurementElements.forEach((el) => el.remove());
                this.updateUI();
            }

            updateUI() {
                this.elements.pointCount.textContent = this.measurementPoints.length;
                const totalMeasurementsEl =
                    document.getElementById("totalMeasurements");
                if (totalMeasurementsEl) {
                    totalMeasurementsEl.textContent = this.measurements.length;
                }

                const instructionEl = document.getElementById("instructionText");
                if (instructionEl) {
                    if (this.measurementPoints.length === 0) {
                        instructionEl.innerHTML =
                            "📍 Cliquez sur le <strong>premier coin</strong> à mesurer";
                        instructionEl.style.color = "#4a6bff";
                    } else if (this.measurementPoints.length === 1) {
                        instructionEl.innerHTML =
                            "📍 Maintenant cliquez sur le <strong>second coin</strong>";
                        instructionEl.style.color = "#ff4757";
                    } else {
                        instructionEl.innerHTML =
                            "✅ Mesure terminée ! Vous pouvez en ajouter d'autres";
                        instructionEl.style.color = "#2ed573";
                    }
                }
            }

            async sendMeasurements() {
                if (this.measurements.length === 0) {
                    alert("Aucune mesure à envoyer. Ajoutez au moins 2 points.");
                    return;
                }

                this.showStatus("📤 Envoi des mesures...");

                const data = {
                    timestamp: new Date().toISOString(),
                    measurements: this.measurements.map((m) => ({
                        realDistance: m.realDistance,
                        pixelDistance: m.pixelDistance,
                        timestamp: m.timestamp,
                    })),
                    summary: {
                        totalMeasurements: this.measurements.length,
                        averageDistance: this.measurements.reduce((sum, m) => sum + m.realDistance, 0) /
                            this.measurements.length,
                    },
                };

                try {
                    console.log("📊 Données de mesure:", data);

                    // REMPLACEZ PAR VOTRE API :
                    // const response = await fetch('/api/measurements', {
                    //     method: 'POST',
                    //     headers: { 'Content-Type': 'application/json' },
                    //     body: JSON.stringify(data)
                    // });

                    await new Promise((resolve) => setTimeout(resolve, 1500));

                    this.showStatus("✅ Mesures envoyées avec succès!");
                    setTimeout(() => this.hideStatus(), 2000);
                } catch (error) {
                    console.error("Erreur envoi:", error);
                    this.showStatus("❌ Erreur lors de l'envoi");
                    setTimeout(() => this.hideStatus(), 3000);
                }
            }

            showStatus(message) {
                this.elements.statusText.textContent = message;
                this.elements.statusIndicator.classList.remove("hidden");
            }

            hideStatus() {
                this.elements.statusIndicator.classList.add("hidden");
            }
        }

        // Initialisation quand le DOM est prêt
        document.addEventListener("DOMContentLoaded", () => {
            new ARMeasurementApp();
        });



        // Gestion des likes
        document.querySelectorAll(".like-btn").forEach((btn) => {
            btn.addEventListener("click", function() {
                this.classList.toggle("liked");
                const icon = this.querySelector("i");
                if (this.classList.contains("liked")) {
                    icon.classList.remove("far");
                    icon.classList.add("fas");
                } else {
                    icon.classList.remove("fas");
                    icon.classList.add("far");
                }
            });
        });


        // Appliquer un coupon
        document
            .getElementById("apply-coupon")
            .addEventListener("click", function() {
                const couponCode = document.getElementById("coupon").value;

                if (couponCode.toUpperCase() === "KELU15") {
                    const subtotalText = subtotalElement.textContent;
                    const subtotal = parseFloat(subtotalText.replace("€", ""));
                    const discount = subtotal * 0.15;
                    const total = subtotal - discount;

                    // Ajouter la réduction au résumé
                    const discountElement = document.createElement("div");
                    discountElement.className = "summary-item";
                    discountElement.innerHTML = `
                            <span>Réduction (15%)</span>
                            <span>-€${discount.toFixed(2)}</span>
                        `;

                    // Vérifier si la réduction est déjà affichée
                    if (!document.getElementById("discount-element")) {
                        discountElement.id = "discount-element";
                        cartItemsContainer.appendChild(discountElement);
                    } else {
                        document.getElementById("discount-element").innerHTML =
                            discountElement.innerHTML;
                    }

                    totalElement.textContent = `€${total.toFixed(2)}`;
                    alert("Code promo appliqué avec succès!");
                } else {
                    alert("Code promo invalide");
                }
            });

        // Passer à la livraison
        document
            .getElementById("proceed-to-checkout")
            .addEventListener("click", function() {
                alert("Fonctionnalité de paiement à implémenter");
                // Ici, vous pourriez ajouter la logique pour passer à l'étape suivante du checkout
            });

        // Gestion des boutons flottants
        document
            .querySelector(".floating-buttons button:nth-child(1)")
            .addEventListener("click", function() {
                alert(
                    "Fonctionnalité de partage sur les réseaux sociaux à implémenter"
                );
            });

        document
            .querySelector(".floating-buttons button:nth-child(2)")
            .addEventListener("click", function() {
                alert("Fonctionnalité de cagnotte commune à implémenter");
            });

        // Redirection vers la page de détails au clic sur l'image du produit
        document.querySelectorAll(".product-img").forEach((img, index) => {
            img.style.cursor = "pointer";
            img.addEventListener("click", function() {
                // Liste des IDs des produits dans le même ordre qu'ils apparaissent sur la page
                const productIds = ["1", "2", "3",
                    "4"
                ]; // Correspond aux data-id des boutons "Ajouter au panier"

                // Récupérer l'ID du produit correspondant
                const productId = productIds[index];

                // Rediriger vers la page de détails avec l'ID en paramètre
                window.location.href = `product-details.html?id=${productId}`;
            });
        });


        // Navigation entre les étapes
        document
            .getElementById("proceed-to-delivery")
            .addEventListener("click", function() {
                document.getElementById("checkout-modal").style.display = "none";
                document.getElementById("delivery-modal").style.display = "block";
            });

        document
            .getElementById("proceed-to-payment")
            .addEventListener("click", function() {
                document.getElementById("delivery-modal").style.display = "none";
                document.getElementById("payment-modal").style.display = "block";
            });

        document
            .getElementById("confirm-order")
            .addEventListener("click", function() {
                document.getElementById("payment-modal").style.display = "none";
                document.getElementById("confirmation-modal").style.display = "block";
            });

        // Boutons de retour
        document
            .getElementById("back-to-cart")
            .addEventListener("click", function() {
                document.getElementById("delivery-modal").style.display = "none";
                document.getElementById("checkout-modal").style.display = "block";
            });

        document
            .getElementById("back-to-delivery")
            .addEventListener("click", function() {
                document.getElementById("payment-modal").style.display = "none";
                document.getElementById("delivery-modal").style.display = "block";
            });

        document
            .getElementById("return-to-shop")
            .addEventListener("click", function() {
                document.getElementById("confirmation-modal").style.display = "none";
                // Redirection vers la page d'accueil
                window.location.href = "/";
            });

        // Fermeture des modals
        document.querySelectorAll(".close-modal").forEach(function(btn) {
            btn.addEventListener("click", function() {
                this.closest(".modal").style.display = "none";
            });
        });

        // Ouverture du modal panier (exemple)
        function openCartModal() {
            document.getElementById("checkout-modal").style.display = "block";
        }


