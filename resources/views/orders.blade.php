<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Keluvato - Meubles, Décoration & Bricolage</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">



    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


</head>

<body>
    @include('partials.header')



    <section class="orders-section" style="padding: 40px 0; background-color: #f9f9f9; min-height: 70vh">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px">
            <h1
                style="
            color: #1f4e5f;
            font-size: 2.5rem;
            margin-bottom: 30px;
            font-weight: 700;
            text-align: center;
          ">
                <i class="fas fa-box-open" style="margin-right: 15px"></i>Mes
                Commandes
            </h1>

            <div class="order-filters"
                style="
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
          ">
                <div class="filter-group" style="display: flex; gap: 10px">
                    <button class="filter-btn active" data-filter="all"
                        style="
                padding: 10px 20px;
                background: #1f4e5f;
                color: white;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Toutes
                    </button>
                    <button class="filter-btn" data-filter="pending"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        En cours
                    </button>
                    <button class="filter-btn" data-filter="delivered"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Livrées
                    </button>
                    <button class="filter-btn" data-filter="cancelled"
                        style="
                padding: 10px 20px;
                background: #f1f1f1;
                border: none;
                border-radius: 25px;
                cursor: pointer;
              ">
                        Annulées
                    </button>
                </div>

                <div class="search-orders" style="position: relative">
                    <input type="text" placeholder="Rechercher une commande..."
                        style="
                padding: 10px 15px;
                border: 1px solid #ddd;
                border-radius: 25px;
                width: 250px;
              " />
                    <i class="fas fa-search"
                        style="
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                color: #1f4e5f;
              "></i>
                </div>
            </div>

            <div class="orders-list">
                <!-- Commande 1 - En cours -->
                <div class="order-card" data-status="pending"
                    style="
              background: white;
              border-radius: 15px;
              box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
              margin-bottom: 25px;
              overflow: hidden;
              cursor: pointer;
            ">
                    <div class="order-header"
                        style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-bottom: 1px solid #f1f1f1;
                background: #f9f9f9;
              ">
                        <div class="order-info">
                            <h3 style="margin: 0; color: #1f4e5f; font-size: 1.2rem">
                                Commande #KL-2023-12548
                            </h3>
                            <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem">
                                Passée le 15 octobre 2023
                            </p>
                        </div>
                        <div class="order-status"
                            style="
                  background: #4a6bff;
                  color: white;
                  padding: 8px 15px;
                  border-radius: 20px;
                  font-size: 0.9rem;
                  font-weight: 500;
                ">
                            En cours de livraison
                        </div>
                    </div>

                    <div class="order-body" style="padding: 20px">
                        <div class="order-products"
                            style="
                  display: flex;
                  gap: 20px;
                  margin-bottom: 20px;
                  flex-wrap: wrap;
                ">
                            <div class="product-item" style="display: flex; gap: 15px; width: calc(50% - 10px)">
                                <img src="https://via.placeholder.com/80" alt="Produit"
                                    style="
                      width: 80px;
                      height: 80px;
                      object-fit: cover;
                      border-radius: 10px;
                    " />
                                <div class="product-details">
                                    <h4 style="margin: 0 0 5px; font-size: 1rem">
                                        Canapé d'angle en velours
                                    </h4>
                                    <p style="margin: 0; color: #666; font-size: 0.9rem">
                                        Quantité: 1
                                    </p>
                                    <p style="margin: 5px 0 0; font-weight: 600; color: #1f4e5f">
                                        499,99 €
                                    </p>
                                </div>
                            </div>

                            <div class="product-item" style="display: flex; gap: 15px; width: calc(50% - 10px)">
                                <img src="https://via.placeholder.com/80" alt="Produit"
                                    style="
                      width: 80px;
                      height: 80px;
                      object-fit: cover;
                      border-radius: 10px;
                    " />
                                <div class="product-details">
                                    <h4 style="margin: 0 0 5px; font-size: 1rem">
                                        Table basse en bois massif
                                    </h4>
                                    <p style="margin: 0; color: #666; font-size: 0.9rem">
                                        Quantité: 1
                                    </p>
                                    <p style="margin: 5px 0 0; font-weight: 600; color: #1f4e5f">
                                        149,99 €
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary"
                            style="
                  display: flex;
                  justify-content: space-between;
                  border-top: 1px solid #f1f1f1;
                  padding-top: 20px;
                ">
                            <div class="delivery-info">
                                <h4 style="margin: 0 0 10px; font-size: 1rem; color: #1f4e5f">
                                    <i class="fas fa-truck" style="margin-right: 10px"></i>Livraison prévue
                                </h4>
                                <p style="margin: 0; color: #666">
                                    Entre le 25 et 30 octobre 2023
                                </p>
                            </div>

                            <div class="order-total" style="text-align: right">
                                <p style="margin: 0 0 5px; color: #666">Total commande:</p>
                                <h3 style="margin: 0; color: #1f4e5f; font-size: 1.5rem">
                                    649,98 €
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commande 2 - Livrée -->
                <div class="order-card" data-status="delivered"
                    style="
              background: white;
              border-radius: 15px;
              box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
              margin-bottom: 25px;
              overflow: hidden;
              cursor: pointer;
            ">
                    <div class="order-header"
                        style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-bottom: 1px solid #f1f1f1;
                background: #f9f9f9;
              ">
                        <div class="order-info">
                            <h3 style="margin: 0; color: #1f4e5f; font-size: 1.2rem">
                                Commande #KL-2023-11876
                            </h3>
                            <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem">
                                Passée le 5 septembre 2023
                            </p>
                        </div>
                        <div class="order-status"
                            style="
                  background: #4caf50;
                  color: white;
                  padding: 8px 15px;
                  border-radius: 20px;
                  font-size: 0.9rem;
                  font-weight: 500;
                ">
                            Livrée
                        </div>
                    </div>

                    <div class="order-body" style="padding: 20px">
                        <div class="order-products"
                            style="
                  display: flex;
                  gap: 20px;
                  margin-bottom: 20px;
                  flex-wrap: wrap;
                ">
                            <div class="product-item" style="display: flex; gap: 15px; width: calc(50% - 10px)">
                                <img src="https://via.placeholder.com/80" alt="Produit"
                                    style="
                      width: 80px;
                      height: 80px;
                      object-fit: cover;
                      border-radius: 10px;
                    " />
                                <div class="product-details">
                                    <h4 style="margin: 0 0 5px; font-size: 1rem">
                                        Lampe design en métal
                                    </h4>
                                    <p style="margin: 0; color: #666; font-size: 0.9rem">
                                        Quantité: 2
                                    </p>
                                    <p style="margin: 5px 0 0; font-weight: 600; color: #1f4e5f">
                                        79,98 €
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary"
                            style="
                  display: flex;
                  justify-content: space-between;
                  border-top: 1px solid #f1f1f1;
                  padding-top: 20px;
                ">
                            <div class="delivery-info">
                                <h4 style="margin: 0 0 10px; font-size: 1rem; color: #1f4e5f">
                                    <i class="fas fa-check-circle"
                                        style="margin-right: 10px; color: #4caf50"></i>Livrée le 12 septembre 2023
                                </h4>
                                <p style="margin: 0; color: #666">
                                    Adresse: 12 Rue des Lilas, 75000 Paris
                                </p>
                            </div>

                            <div class="order-total" style="text-align: right">
                                <p style="margin: 0 0 5px; color: #666">Total commande:</p>
                                <h3 style="margin: 0; color: #1f4e5f; font-size: 1.5rem">
                                    79,98 €
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commande 3 - Annulée -->
                <div class="order-card" data-status="cancelled"
                    style="
              background: white;
              border-radius: 15px;
              box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
              margin-bottom: 25px;
              overflow: hidden;
              cursor: pointer;
            ">
                    <div class="order-header"
                        style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-bottom: 1px solid #f1f1f1;
                background: #f9f9f9;
              ">
                        <div class="order-info">
                            <h3 style="margin: 0; color: #1f4e5f; font-size: 1.2rem">
                                Commande #KL-2023-09542
                            </h3>
                            <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem">
                                Passée le 15 août 2023
                            </p>
                        </div>
                        <div class="order-status"
                            style="
                  background: #f44336;
                  color: white;
                  padding: 8px 15px;
                  border-radius: 20px;
                  font-size: 0.9rem;
                  font-weight: 500;
                ">
                            Annulée
                        </div>
                    </div>

                    <div class="order-body" style="padding: 20px">
                        <div class="order-products"
                            style="
                  display: flex;
                  gap: 20px;
                  margin-bottom: 20px;
                  flex-wrap: wrap;
                ">
                            <div class="product-item" style="display: flex; gap: 15px; width: 100%">
                                <img src="https://via.placeholder.com/80" alt="Produit"
                                    style="
                      width: 80px;
                      height: 80px;
                      object-fit: cover;
                      border-radius: 10px;
                    " />
                                <div class="product-details">
                                    <h4 style="margin: 0 0 5px; font-size: 1rem">
                                        Bibliothèque murale 120cm
                                    </h4>
                                    <p style="margin: 0; color: #666; font-size: 0.9rem">
                                        Quantité: 1
                                    </p>
                                    <p style="margin: 5px 0 0; font-weight: 600; color: #1f4e5f">
                                        129,99 €
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary"
                            style="
                  display: flex;
                  justify-content: space-between;
                  border-top: 1px solid #f1f1f1;
                  padding-top: 20px;
                ">
                            <div class="delivery-info">
                                <h4 style="margin: 0 0 10px; font-size: 1rem; color: #1f4e5f">
                                    <i class="fas fa-times-circle"
                                        style="margin-right: 10px; color: #f44336"></i>Annulée le 18 août 2023
                                </h4>
                                <p style="margin: 0; color: #666">
                                    Remboursement effectué le 20 août 2023
                                </p>
                            </div>

                            <div class="order-total" style="text-align: right">
                                <p style="margin: 0 0 5px; color: #666">Total commande:</p>
                                <h3 style="margin: 0; color: #1f4e5f; font-size: 1.5rem">
                                    129,99 €
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Commande 4 - En cours -->
                <div class="order-card" data-status="pending"
                    style="
              background: white;
              border-radius: 15px;
              box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
              margin-bottom: 25px;
              overflow: hidden;
              cursor: pointer;
            ">
                    <div class="order-header"
                        style="
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px;
                border-bottom: 1px solid #f1f1f1;
                background: #f9f9f9;
              ">
                        <div class="order-info">
                            <h3 style="margin: 0; color: #1f4e5f; font-size: 1.2rem">
                                Commande #KL-2023-12879
                            </h3>
                            <p style="margin: 5px 0 0; color: #666; font-size: 0.9rem">
                                Passée le 20 octobre 2023
                            </p>
                        </div>
                        <div class="order-status"
                            style="
                  background: #4a6bff;
                  color: white;
                  padding: 8px 15px;
                  border-radius: 20px;
                  font-size: 0.9rem;
                  font-weight: 500;
                ">
                            En préparation
                        </div>
                    </div>

                    <div class="order-body" style="padding: 20px">
                        <div class="order-products"
                            style="
                  display: flex;
                  gap: 20px;
                  margin-bottom: 20px;
                  flex-wrap: wrap;
                ">
                            <div class="product-item" style="display: flex; gap: 15px; width: 100%">
                                <img src="https://via.placeholder.com/80" alt="Produit"
                                    style="
                      width: 80px;
                      height: 80px;
                      object-fit: cover;
                      border-radius: 10px;
                    " />
                                <div class="product-details">
                                    <h4 style="margin: 0 0 5px; font-size: 1rem">
                                        Chaise de bureau ergonomique
                                    </h4>
                                    <p style="margin: 0; color: #666; font-size: 0.9rem">
                                        Quantité: 1
                                    </p>
                                    <p style="margin: 5px 0 0; font-weight: 600; color: #1f4e5f">
                                        229,99 €
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="order-summary"
                            style="
                  display: flex;
                  justify-content: space-between;
                  border-top: 1px solid #f1f1f1;
                  padding-top: 20px;
                ">
                            <div class="delivery-info">
                                <h4 style="margin: 0 0 10px; font-size: 1rem; color: #1f4e5f">
                                    <i class="fas fa-box" style="margin-right: 10px"></i>En
                                    préparation
                                </h4>
                                <p style="margin: 0; color: #666">
                                    Expédition prévue sous 2-3 jours
                                </p>
                            </div>

                            <div class="order-total" style="text-align: right">
                                <p style="margin: 0 0 5px; color: #666">Total commande:</p>
                                <h3 style="margin: 0; color: #1f4e5f; font-size: 1.5rem">
                                    229,99 €
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pagination" style="display: flex; justify-content: center; margin-top: 40px">
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #1f4e5f;
              color: white;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    1
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    2
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    3
                </button>
                <button
                    style="
              padding: 10px 15px;
              background: #f1f1f1;
              border: none;
              border-radius: 5px;
              margin: 0 5px;
              cursor: pointer;
            ">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </section>


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

    <style>
        /* Styles existants... */

        /* Nouveaux styles pour la sélection de langue */
        .language-dropdown .dropdown-menu div:hover {
            background-color: #f8f8f8;
        }

        /* Styles responsives */
        @media (max-width: 992px) {
            .search-container {
                order: 1;
                flex: 1 1 100% !important;
                max-width: 100% !important;
                margin: 10px 0 !important;
            }

            .header-container {
                flex-wrap: wrap !important;
            }

            .country-code,
            .language-code {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .header-icons {
                gap: 8px !important;
            }
        }
    </style>

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

    <div id="checkout-modal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Votre panier</h3>
                <div id="cart-items">
                    <!-- Les articles du panier seront ajoutés ici dynamiquement -->
                    <div class="cart-item">
                        <img src="produit1.jpg" alt="Produit" width="60" />
                        <div class="cart-item-details">
                            <h4>Nom du produit</h4>
                            <p>Quantité: 1</p>
                        </div>
                        <div class="cart-item-price">€19.99</div>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span id="subtotal">€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="total">€19.99</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="coupon">Code promo</label>
                    <input type="text" id="coupon" class="form-control"
                        placeholder="Entrez votre code promo" />
                    <button id="apply-coupon" class="btn btn-primary" style="margin-top: 0.5rem">
                        Appliquer
                    </button>
                </div>

                <button id="proceed-to-delivery" class="btn btn-primary" style="margin-top: 1.5rem">
                    Passer à la livraison
                </button>
            </div>
        </div>
    </div>

    <div id="delivery-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step active">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Informations de livraison</h3>

                <div class="form-group">
                    <label for="full-name">Nom complet</label>
                    <input type="text" id="full-name" class="form-control" placeholder="Votre nom complet" />
                </div>

                <div class="form-group">
                    <label for="delivery-address">Adresse</label>
                    <input type="text" id="delivery-address" class="form-control" placeholder="Votre adresse" />
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="delivery-city">Ville</label>
                        <input type="text" id="delivery-city" class="form-control" placeholder="Votre ville" />
                    </div>
                    <div class="form-group">
                        <label for="delivery-zip">Code postal</label>
                        <input type="text" id="delivery-zip" class="form-control" placeholder="Code postal" />
                    </div>
                </div>

                <div class="form-group">
                    <label for="delivery-country">Pays</label>
                    <select id="delivery-country" class="form-control">
                        <option value="">Sélectionnez un pays</option>
                        <option value="FR">France</option>
                        <option value="BE">Belgique</option>
                        <option value="CH">Suisse</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="delivery-phone">Téléphone</label>
                    <input type="tel" id="delivery-phone" class="form-control"
                        placeholder="Votre numéro de téléphone" />
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                </div>

                <button id="proceed-to-payment" class="btn btn-primary">
                    Passer au paiement
                </button>
                <button id="back-to-cart" class="btn btn-secondary">
                    Retour au panier
                </button>
            </div>
        </div>
    </div>

    <div id="payment-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step completed">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step active">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <h3>Méthode de paiement</h3>

                <div class="payment-methods">
                    <div class="payment-method active">
                        <input type="radio" name="payment-method" id="credit-card" checked />
                        <label for="credit-card">Carte de crédit</label>
                        <div class="payment-details">
                            <div class="form-group">
                                <label for="card-number">Numéro de carte</label>
                                <input type="text" id="card-number" class="form-control"
                                    placeholder="1234 5678 9012 3456" />
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="card-expiry">Date d'expiration</label>
                                    <input type="text" id="card-expiry" class="form-control"
                                        placeholder="MM/AA" />
                                </div>
                                <div class="form-group">
                                    <label for="card-cvc">CVC</label>
                                    <input type="text" id="card-cvc" class="form-control" placeholder="123" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="card-name">Nom sur la carte</label>
                                <input type="text" id="card-name" class="form-control" placeholder="Votre nom" />
                            </div>
                        </div>
                    </div>

                    <div class="payment-method">
                        <input type="radio" name="payment-method" id="paypal" />
                        <label for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="checkout-summary">
                    <div class="summary-item">
                        <span>Sous-total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Livraison</span>
                        <span>Gratuite</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="terms-agree" />
                    <label for="terms-agree">J'accepte les conditions générales de vente</label>
                </div>

                <button id="confirm-order" class="btn btn-primary">
                    Confirmer la commande
                </button>
                <button id="back-to-delivery" class="btn btn-secondary">
                    Retour à la livraison
                </button>
            </div>
        </div>
    </div>

    <div id="confirmation-modal" class="modal" style="display: none">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <h2>Finaliser votre commande</h2>

            <div class="checkout-steps">
                <div class="step completed">
                    <div class="step-number">1</div>
                    <div>Panier</div>
                </div>
                <div class="step completed">
                    <div class="step-number">2</div>
                    <div>Livraison</div>
                </div>
                <div class="step completed">
                    <div class="step-number">3</div>
                    <div>Paiement</div>
                </div>
                <div class="step active">
                    <div class="step-number">4</div>
                    <div>Confirmation</div>
                </div>
            </div>

            <div class="checkout-form">
                <div class="confirmation-message">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
                        fill="none" stroke="#4CAF50" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <h3>Commande confirmée !</h3>
                    <p>
                        Merci pour votre achat. Votre commande #12345 a été passée avec
                        succès.
                    </p>
                    <p>Un email de confirmation vous a été envoyé.</p>
                </div>

                <div class="order-summary">
                    <h4>Détails de la commande</h4>
                    <div class="summary-item">
                        <span>Date</span>
                        <span>21 juillet 2025</span>
                    </div>
                    <div class="summary-item">
                        <span>Total</span>
                        <span>€19.99</span>
                    </div>
                    <div class="summary-item">
                        <span>Méthode de paiement</span>
                        <span>Carte de crédit</span>
                    </div>
                    <div class="summary-item">
                        <span>Adresse de livraison</span>
                        <span>123 Rue Example, Paris, France</span>
                    </div>
                </div>

                <button id="return-to-shop" class="btn btn-primary">
                    Retour à la boutique
                </button>
            </div>
        </div>
    </div>

    <div class="floating-buttons">
        <button id="arMeasureBtn" class="floating-btn"
            style="background: linear-gradient(to right, #4a6bff, #6b8cff)" title="Mesurer votre espace">
            <i class="fas fa-ruler-combined text-xl"></i>
        </button>

        <button class="floating-btn" style="background: linear-gradient(to right, #4ecdc4, #6ad9d1)"
            title="Cagnotte commune">
            <i class="fas fa-gift text-xl"></i>
        </button>

        <button id="chatBtn" class="floating-btn" style="background: linear-gradient(to right, #038a40, #037c1d)"
            title="Chat en direct">
            <i class="fas fa-comments text-xl"></i>
        </button>
    </div>

    <div id="chatModal" class="chat-modal">
        <div class="chat-header">
            Assistant Virtuel
            <span id="closeChat" class="close-btn">&times;</span>
        </div>
        <div class="chat-body" id="chatBody">
            <div class="chat-message bot">
                Bonjour ! Comment puis-je vous aider ?
            </div>
        </div>
        <div class="chat-input">
            <input type="text" id="chatInput" placeholder="Écrivez votre message..." />
            <button id="sendBtn">Envoyer</button>
        </div>
    </div>


    <script>
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
    </script>



    <div id="arContainer" class="hidden">
        <video id="videoStream" autoplay muted playsinline></video>

        <div class="ar-overlay" id="arOverlay">
            <div class="crosshair"></div>
        </div>

        <div class="measurement-info">
            <h3 style="margin-bottom: 15px; color: #4a6bff">
                <i class="fas fa-ruler"></i> Mesures
            </h3>
            <div class="info-item">
                <span>Points placés:</span>
                <span id="pointCount">0</span>
            </div>
            <div class="info-item">
                <span>Dernière mesure:</span>
                <span id="lastMeasurement">-</span>
            </div>
            <div class="info-item">
                <span>Total mesures:</span>
                <span id="totalMeasurements">0</span>
            </div>
            <div id="instructionText"
                style="
            margin-top: 15px;
            padding: 10px;
            background: rgba(74, 107, 255, 0.1);
            border-radius: 8px;
            font-size: 12px;
            color: #4a6bff;
          ">
                📍 Cliquez sur le premier coin, puis sur le second pour mesurer la
                distance
            </div>
        </div>

        <div class="controls-panel">
            <button class="control-btn primary" id="addPointBtn">
                <i class="fas fa-plus"></i>
                Ajouter Point
            </button>
            <button class="control-btn secondary" id="clearBtn">
                <i class="fas fa-trash"></i>
                Effacer
            </button>
            <button class="control-btn" id="switchCameraBtn"
                style="background: linear-gradient(135deg, #ff9f43, #feca57)">
                <i class="fas fa-sync-alt"></i>
                Changer Caméra
            </button>
            <button class="control-btn success" id="sendMeasurementsBtn">
                <i class="fas fa-paper-plane"></i>
                Envoyer
            </button>
            <button class="control-btn" id="closeArBtn" style="background: #636e72">
                <i class="fas fa-times"></i>
                Fermer
            </button>
        </div>
    </div>

    <div id="statusIndicator" class="status-indicator hidden">
        <div class="loading-spinner"></div>
        <div id="statusText">Initialisation de la caméra...</div>
    </div>

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

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-container">
                <div class="footer-col">
                    <h3>Keluvato Group</h3>
                    <p>
                        Vente à distance d'articles meubles, décoration d'intérieur et
                        extérieur, produits de bricolage et construction.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-pinterest"></i></a>
                    </div>
                </div>

                <div class="footer-col">
                    <h3>Boutique</h3>
                    <ul>
                        <li><a href="#">Meubles</a></li>
                        <li><a href="#">Décoration</a></li>
                        <li><a href="#">Bricolage</a></li>
                        <li><a href="#">Construction</a></li>
                        <li><a href="#">Promotions</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Aide</h3>
                    <ul>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Livraison</a></li>
                        <li><a href="#">Retours</a></li>
                        <li><a href="#">Guide des tailles</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <h3>Informations</h3>
                    <ul>
                        <li><a href="#">À propos</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">CGV</a></li>
                        <li><a href="#">Politique de confidentialité</a></li>
                        <li><a href="#">Mentions légales</a></li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2023 Keluvato Group. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

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
                "4"]; // Correspond aux data-id des boutons "Ajouter au panier"

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

    <script src="js/app-auth.js" defer></script>

    <script src="js/main.js"></script>
</body>

</html>
