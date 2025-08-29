 <script>
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
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Animation au chargement
            const cards = document.querySelectorAll(".order-card");
            cards.forEach((card, index) => {
                card.style.opacity = "0";
                card.style.transform = "translateY(20px)";
                card.style.transition = "all 0.5s ease " + index * 0.1 + "s";

                setTimeout(() => {
                    card.style.opacity = "1";
                    card.style.transform = "translateY(0)";
                }, 100);
            });

            // Filtrage des commandes
            const filterButtons = document.querySelectorAll(".filter-btn");
            const orderCards = document.querySelectorAll(".order-card");

            filterButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    // Mise à jour de l'apparence des boutons
                    filterButtons.forEach((btn) => {
                        btn.style.background = "#f1f1f1";
                        btn.style.color = "#333";
                        btn.classList.remove("active");
                    });

                    this.style.background = "#1F4E5F";
                    this.style.color = "white";
                    this.classList.add("active");

                    // Récupération du filtre sélectionné
                    const filter = this.getAttribute("data-filter");

                    // Filtrage des cartes de commande
                    orderCards.forEach((card) => {
                        if (filter === "all") {
                            card.style.display = "block";
                        } else {
                            if (card.getAttribute("data-status") === filter) {
                                card.style.display = "block";
                            } else {
                                card.style.display = "none";
                            }
                        }

                        // Réappliquer l'animation
                        card.style.opacity = "0";
                        card.style.transform = "translateY(20px)";
                        setTimeout(() => {
                            card.style.opacity = "1";
                            card.style.transform = "translateY(0)";
                        }, 100);
                    });
                });
            });

            // Affichage des détails au clic sur une carte
            orderCards.forEach((card) => {
                card.addEventListener("click", function() {
                    // Ne rien faire si on clique sur un bouton ou un lien
                    if (
                        event.target.tagName === "BUTTON" ||
                        event.target.tagName === "A"
                    ) {
                        return;
                    }

                    // Ici vous pourriez rediriger vers une page de détails
                    // ou afficher un modal avec plus d'informations
                    console.log(
                        "Voir les détails de la commande:",
                        this.querySelector("h3").textContent
                    );
                });
            });
        });
    </script>
    <script>
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
    </script>

    <script>
        // Liste complète des pays avec leurs devises (exemple partiel)
        const countries = [{
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
            {
                code: "GB",
                name: "Royaume-Uni",
                currency: "GBP",
                symbol: "£",
                flag: "gb",
            },
            {
                code: "JP",
                name: "Japon",
                currency: "JPY",
                symbol: "¥",
                flag: "jp"
            },
            {
                code: "CA",
                name: "Canada",
                currency: "CAD",
                symbol: "$",
                flag: "ca",
            },
            {
                code: "AU",
                name: "Australie",
                currency: "AUD",
                symbol: "$",
                flag: "au",
            },
            {
                code: "CN",
                name: "Chine",
                currency: "CNY",
                symbol: "¥",
                flag: "cn"
            },
            {
                code: "BR",
                name: "Brésil",
                currency: "BRL",
                symbol: "R$",
                flag: "br",
            },
            {
                code: "IN",
                name: "Inde",
                currency: "INR",
                symbol: "₹",
                flag: "in"
            },
            // Ajoutez ici tous les autres pays nécessaires
        ];

        document.addEventListener("DOMContentLoaded", function() {
            const countryToggle = document.getElementById("countryToggle");
            const dropdownCountry = document.getElementById("dropdownCountry");
            const countryList = document.getElementById("countryList");
            const countrySearch = document.getElementById("countrySearch");
            const closeCountryMenu = document.getElementById("closeCountryMenu");

            // Générer la liste des pays
            function generateCountryList(filter = "") {
                countryList.innerHTML = "";
                const filtered = filter ?
                    countries.filter((c) =>
                        c.name.toLowerCase().includes(filter.toLowerCase())
                    ) :
                    countries;

                filtered.forEach((country) => {
                    const countryElement = document.createElement("div");
                    countryElement.className = "country-option";
                    countryElement.style.display = "flex";
                    countryElement.style.alignItems = "center";
                    countryElement.style.padding = "10px 15px";
                    countryElement.style.cursor = "pointer";
                    countryElement.style.borderBottom = "1px solid #f5f5f5";
                    countryElement.setAttribute("data-country", country.code);
                    countryElement.setAttribute("data-currency", country.currency);

                    countryElement.innerHTML = `
                <span style="width: 25px; height: 18px; background-image: url('https://flagcdn.com/w20/${country.flag}.png'); background-size: cover; margin-right: 10px;"></span>
                <span style="flex: 1; font-size: 14px;">${country.name}</span>
                <span style="color: #666; font-size: 13px;">${country.symbol} ${country.currency}</span>
            `;

                    countryElement.addEventListener("click", () =>
                        selectCountry(country)
                    );
                    countryList.appendChild(countryElement);
                });
            }

            // Sélectionner un pays
            function selectCountry(country) {
                document.querySelector(
                    ".country-flag"
                ).style.backgroundImage = `url('https://flagcdn.com/w20/${country.flag}.png')`;
                document.querySelector(".country-code").textContent = country.code;
                dropdownCountry.style.display = "none";

                // Ici vous pouvez implémenter la conversion
                convertPrices(country.currency);
                console.log(
                    `Pays sélectionné: ${country.name}, Devise: ${country.currency}`
                );
            }

            // Fonction de conversion (exemple)
            function convertPrices(targetCurrency) {
                // 1. Récupérer le taux de change depuis une API (ex: https://exchangerate-api.com)
                // 2. Convertir tous les prix sur la page
                // Exemple simplifié:
                fetch(`https://api.exchangerate-api.com/v4/latest/EUR`)
                    .then((response) => response.json())
                    .then((data) => {
                        const rate = data.rates[targetCurrency];
                        if (rate) {
                            document.querySelectorAll(".price").forEach((priceElement) => {
                                const originalPrice = parseFloat(
                                    priceElement.getAttribute("data-original-price")
                                );
                                const convertedPrice = (originalPrice * rate).toFixed(2);
                                priceElement.textContent = `${convertedPrice} ${targetCurrency}`;
                            });
                        }
                    })
                    .catch((error) => {
                        console.error("Erreur de conversion:", error);
                        // Solution de repli: afficher les prix dans la devise d'origine
                    });
            }

            // Gestion des événements
            countryToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                dropdownCountry.style.display =
                    dropdownCountry.style.display === "block" ? "none" : "block";
                if (dropdownCountry.style.display === "block") {
                    generateCountryList();
                    countrySearch.focus();
                }
            });

            closeCountryMenu.addEventListener("click", () => {
                dropdownCountry.style.display = "none";
            });

            countrySearch.addEventListener("input", (e) => {
                generateCountryList(e.target.value);
            });

            document.addEventListener("click", (e) => {
                if (!e.target.closest(".country-dropdown")) {
                    dropdownCountry.style.display = "none";
                }
            });

            // Initialisation
            generateCountryList();
        });
    </script>

    <script>
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
    </script>


    <script>
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
    </script>

    <script>
        // Gestion des dropdowns
        function setupDropdown(toggleId, dropdownId) {
            const toggle = document.getElementById(toggleId);
            const dropdown = document.getElementById(dropdownId);

            toggle.addEventListener("click", function(e) {
                e.stopPropagation();
                // Ferme tous les autres dropdowns
                document.querySelectorAll(".dropdown-menu").forEach((d) => {
                    if (d.id !== dropdownId) d.style.display = "none";
                });
                // Ouvre/ferme le dropdown actuel
                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            });
        }

        // Initialisation des dropdowns
        setupDropdown("userToggle", "dropdownUser");
        setupDropdown("helpToggle", "dropdownHelp");

        // Ferme les dropdowns quand on clique ailleurs
        document.addEventListener("click", function() {
            document.querySelectorAll(".dropdown-menu").forEach((d) => {
                d.style.display = "none";
            });
        });

        // Animation du point de notification utilisateur
        setInterval(() => {
            const pulse = document.querySelector(".user-pulse");
            if (Math.random() > 0.8) {
                pulse.style.display = "block";
                setTimeout(() => {
                    pulse.style.display = "none";
                }, 5000);
            }
        }, 30000);
    </script>

    <script>
        // Script pour le menu déroulant
        document
            .querySelector(".help-dropdown button")
            .addEventListener("click", function(e) {
                e.stopPropagation();
                const dropdown = document.querySelector(".dropdown-content");
                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            });

        // Fermer le menu si on clique ailleurs
        document.addEventListener("click", function() {
            document.querySelector(".dropdown-content").style.display = "none";
        });

        // Empêcher la fermeture quand on clique dans le menu
        document
            .querySelector(".dropdown-content")
            .addEventListener("click", function(e) {
                e.stopPropagation();
            });
    </script>

    <script>
        // Script pour le menu déroulant
        document
            .querySelector(".help-dropdown button")
            .addEventListener("click", function(e) {
                e.stopPropagation();
                const dropdown = document.querySelector(".dropdown-content");
                dropdown.style.display =
                    dropdown.style.display === "block" ? "none" : "block";
            });

        // Fermer le menu si on clique ailleurs
        document.addEventListener("click", function() {
            document.querySelector(".dropdown-content").style.display = "none";
        });

        // Empêcher la fermeture quand on clique dans le menu
        document
            .querySelector(".dropdown-content")
            .addEventListener("click", function(e) {
                e.stopPropagation();
            });
    </script>

    <script>
        // Chargement différé pour améliorer les performances
        document.addEventListener("DOMContentLoaded", function() {
            const iframe = document.querySelector(".youtube-container iframe");
            iframe.setAttribute("src", iframe.getAttribute("src"));
        });
    </script>
    <script>
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

        // Gestion du panier
        let cart = [];
        const cartIcon = document.getElementById("cart-icon");
        const cartCount = cartIcon.querySelector(".cart-count");
        const checkoutModal = document.getElementById("checkout-modal");
        const closeModal = document.querySelector(".close-modal");
        const cartItemsContainer = document.getElementById("cart-items");
        const subtotalElement = document.getElementById("subtotal");
        const totalElement = document.getElementById("total");

        // Ouvrir le panier
        cartIcon.addEventListener("click", function(e) {
            e.preventDefault();
            updateCartDisplay();
            checkoutModal.style.display = "block";
        });

        // Fermer le modal
        closeModal.addEventListener("click", function() {
            checkoutModal.style.display = "none";
        });

        // Ajouter au panier
        document.querySelectorAll(".btn-add-to-cart").forEach((btn) => {
            btn.addEventListener("click", function() {
                const id = this.getAttribute("data-id");
                const name = this.getAttribute("data-name");
                const price = parseFloat(this.getAttribute("data-price"));

                // Vérifier si l'article est déjà dans le panier
                const existingItem = cart.find((item) => item.id === id);

                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.push({
                        id,
                        name,
                        price,
                        quantity: 1,
                    });
                }

                // Mettre à jour le compteur du panier
                updateCartCount();

                // Afficher une notification
                alert(`${name} a été ajouté à votre panier!`);
            });
        });

        // Mettre à jour le compteur du panier
        function updateCartCount() {
            const totalItems = cart.reduce(
                (total, item) => total + item.quantity,
                0
            );
            cartCount.textContent = totalItems;
        }

        // Mettre à jour l'affichage du panier
        function updateCartDisplay() {
            cartItemsContainer.innerHTML = "";

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = "<p>Votre panier est vide.</p>";
                subtotalElement.textContent = "€0.00";
                totalElement.textContent = "€0.00";
                return;
            }

            let subtotal = 0;

            cart.forEach((item) => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const itemElement = document.createElement("div");
                itemElement.className = "summary-item";
                itemElement.innerHTML = `
                            <span>${item.name} x${item.quantity}</span>
                            <span>€${itemTotal.toFixed(2)}</span>
                        `;
                cartItemsContainer.appendChild(itemElement);
            });

            subtotalElement.textContent = `€${subtotal.toFixed(2)}`;
            totalElement.textContent = `€${subtotal.toFixed(2)}`;
        }

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
    </script>

    <script>
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
    </script>

    <script>
        // 🔄 Filtrage dynamique des commandes
        document.querySelectorAll('.filter-btn').forEach(button => {
            button.addEventListener('click', () => {
                // Retirer la classe active de tous les boutons
                document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
                // Activer le bouton cliqué
                button.classList.add('active');

                const filter = button.getAttribute('data-filter');

                document.querySelectorAll('.order-card').forEach(card => {
                    const status = card.getAttribute('data-status');

                    if (filter === 'all' || status === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.filter-btn');
            const cards = document.querySelectorAll('.order-card');

            // Message "aucun résultat" (créé une seule fois)
            let emptyMsg = document.getElementById('orders-empty-filter');
            if (!emptyMsg) {
                emptyMsg = document.createElement('p');
                emptyMsg.id = 'orders-empty-filter';
                emptyMsg.textContent = 'Aucune commande pour ce filtre.';
                emptyMsg.style.cssText = 'text-align:center;color:#666;display:none;margin-top:10px;';
                const list = document.querySelector('.orders-list');
                list && list.appendChild(emptyMsg);
            }

            function applyFilter(filter) {
                let visibleCount = 0;

                cards.forEach(card => {
                    const status = (card.getAttribute('data-status') || '').toLowerCase();
                    const show = (filter === 'all') || (status === filter);
                    card.style.display = show ? '' : 'none';
                    if (show) visibleCount++;
                });

                emptyMsg.style.display = visibleCount ? 'none' : '';
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    // style actif
                    buttons.forEach(b => {
                        b.classList.remove('active');
                        b.style.background = '#f1f1f1';
                        b.style.color = '#000';
                    });
                    btn.classList.add('active');
                    btn.style.background = '#1f4e5f';
                    btn.style.color = '#fff';

                    // filtre
                    const filter = btn.getAttribute('data-filter');
                    applyFilter(filter);
                });
            });

            // état initial = “Toutes”
            const active = document.querySelector('.filter-btn.active');
            applyFilter(active ? active.getAttribute('data-filter') : 'all');
        });
    </script>








payement





 <script>
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
    </script>

    <script src="{{ asset('js/google-translate.js') }}"></script>
</body>
</html>
