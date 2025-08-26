<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion | Keluvato Group</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />

    <style>
      :root {
        --primary: #4a6bff;
        --secondary: #4ecdc4;
        --dark: #292f36;
        --light: #f7fff7;
        --beige: #f5f5dc;
      }

      * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      body {
        font-family: "Montserrat", sans-serif;
        background-color: #f9f9f9;
        color: var(--dark);
        line-height: 1.6;
      }

      .auth-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
      }

      .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
          url("https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80")
            no-repeat center center;
        background-size: cover;
        color: white;
        padding: 3rem 2rem;
        display: flex;
        align-items: center;
        justify-content: center;
        filter: brightness(0.9);
      }

      .hero-content {
        text-align: center;
        max-width: 85%;
      }

      :root {
        --primary: #007bff;
      }

      body {
        background-color: #f8f9fa;
        font-family: "Arial", sans-serif;
      }

      .form-box {
        max-width: 500px;
        margin: 80px auto;
        background-color: #fff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      }

      .form-box h3 {
        margin-bottom: 1.5rem;
        color: var(--primary);
        text-align: center;
      }

      .tab-switch {
        display: flex;
        justify-content: center;
        margin-bottom: 2rem;
      }

      .tab-switch button {
        border: none;
        background: none;
        font-weight: bold;
        margin: 0 1rem;
        cursor: pointer;
        padding-bottom: 5px;
      }

      .tab-switch .active {
        border-bottom: 2px solid var(--primary);
        color: var(--primary);
      }

      .form-content {
        display: none;
      }

      .form-content.active {
        display: block;
      }

      .form-footer {
        font-size: 0.85rem;
        margin-top: 1rem;
        text-align: center;
      }

      .btn-secondary-custom {
        color: var(--primary);
        border: 1px solid var(--primary);
        text-align: center;
        display: block;
        width: 100%;
      }

      .hero-title {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        font-weight: 700;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
      }

      .hero-subtitle {
        font-size: 1.1rem;
        max-width: 90%;
        margin: 0 auto;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
      }

      .form-section {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        background-color: #fff;
      }

      .form-card {
        width: 100%;
        max-width: 420px;
        padding: 2.5rem;
        background: white;
      }

      .logo {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        text-align: center;
        margin-bottom: 1.8rem;
      }

      .form-tabs {
        display: flex;
        margin-bottom: 1.5rem;
        border-bottom: 1px solid #eee;
      }

      .tab-btn {
        padding: 0.7rem 1.2rem;
        background: none;
        border: none;
        font-weight: 600;
        color: #999;
        cursor: pointer;
        position: relative;
        font-size: 0.95rem;
      }

      .tab-btn.active {
        color: var(--primary);
      }

      .tab-btn.active::after {
        content: "";
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        height: 3px;
        background: var(--primary);
      }

      .form-content {
        display: none;
      }

      .form-content.active {
        display: block;
      }

      .form-group {
        margin-bottom: 1.2rem;
      }

      .form-control {
        width: 100%;
        padding: 0.9rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 0.95rem;
      }

      .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 2px rgba(74, 107, 255, 0.2);
      }

      .btn {
        width: 100%;
        padding: 0.9rem;
        border: none;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
      }

      .btn-primary {
        background: var(--primary);
        color: white;
      }

      .btn-primary:hover {
        background: #3a5aed;
        transform: translateY(-1px);
      }

      .divider {
        text-align: center;
        margin: 1.2rem 0;
        position: relative;
        color: #999;
        font-size: 0.85rem;
      }

      .divider::before,
      .divider::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 45%;
        height: 1px;
        background: #eee;
      }

      .divider::before {
        left: 0;
      }

      .divider::after {
        right: 0;
      }

      .social-auth {
        display: flex;
        justify-content: center;
        gap: 0.8rem;
      }

      .social-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        border: 1px solid #eee;
        cursor: pointer;
        transition: all 0.2s;
      }

      .social-btn:hover {
        transform: translateY(-2px);
      }

      .form-footer {
        text-align: center;
        margin-top: 1.2rem;
        font-size: 0.8rem;
        color: #666;
      }

      .form-footer a {
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
      }

      @media (max-width: 768px) {
        .auth-container {
          grid-template-columns: 1fr;
        }

        .hero-section {
          min-height: 200px;
        }

        .form-card {
          padding: 2rem 1.5rem;
        }

        .hero-title {
          font-size: 1.8rem;
        }
      }
    </style>
  </head>

  <body>
    <div class="auth-container">
      <div class="hero-section">
        <div class="hero-content">
          <h1 class="hero-title">BIENVENUE CHEZ KELUVATO</h1>
          <p class="hero-subtitle">
            Meubles, décoration et bricolage pour votre intérieur et extérieur
          </p>
        </div>
      </div>

      <div class="form-section">
        <div class="form-card">
          <div class="form-tabs">
            <button class="tab-btn active" onclick="switchTab(event, 'login')">
              Connexion
            </button>
            <button class="tab-btn" onclick="switchTab(event, 'register')">
              Inscription
            </button>
          </div>

                    <!-- FORMULAIRE login -->
            <div id="login-form" class="form-content active">
            <form method="POST" action="{{ route('login.submit') }}" id="form-login">
                @csrf
                <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="votre@email.com" required />
                </div>
                <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                </div>
                <div style="text-align: right; margin-bottom: 1rem">
                <a href="#" style="color: var(--primary); font-size: 0.8rem">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn btn-primary">Se connecter</button>

                <div class="mt-3">
                <button type="button" class="btn btn-secondary-custom" onclick="switchTabFromLink('professional')">
                    S'inscrire en tant que professionnel
                </button>
                </div>

                <div class="divider">ou continuer avec</div>
                <div class="social-auth">
                <div class="social-btn"><i class="fab fa-facebook-f"></i></div>
                <div class="social-btn"><i class="fab fa-google"></i></div>
                </div>
            </form>
            </div>

            <!-- FORMULAIRE client -->
            <div id="register-form" class="form-content">
            <form method="POST" action="{{ route('register.client') }}" id="form-register-client">
                @csrf
                <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Nom et prénom" required />
                </div>
                <div class="form-group">
                <input type="date" name="birth_date" class="form-control" placeholder="Date de naissance" />
                </div>
                <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="votre@email.com" required />
                </div>
                <div class="form-group">
                <input type="text" name="phone" class="form-control" placeholder="Votre numéro" required />
                </div>
                <div class="form-group">
                <select name="country" id="country" class="form-control" required>
                    <option value="" disabled selected>Votre pays</option>
                    <option value="FR">France</option>
                    <option value="BE">Belgique</option>
                    <option value="CH">Suisse</option>
                    <option value="CA">Canada</option>
                    <option value="US">États-Unis</option>
                    <option value="UK">Royaume-Uni</option>
                    <option value="DE">Allemagne</option>
                    <option value="ES">Espagne</option>
                    <option value="IT">Italie</option>
                    <option value="JP">Japon</option>
                    <option value="AU">Australie</option>
                </select>
                </div>
                <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                </div>
                <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Retapez votre mot de passe" required />
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire</button>
                <div class="form-footer">
                En cliquant, vous acceptez nos <a href="#">CGU</a> et <a href="#">Politique de confidentialité</a>
                </div>
            </form>
            </div>

            <!-- FORMULAIRE PRO -->
            <div id="professional-form" class="form-content">
            <form method="POST" action="{{ route('register.pro') }}" id="form-register-pro">
                @csrf
                <div class="form-group">
                <input type="text" name="company_name" class="form-control" placeholder="Nom de l'entreprise" required />
                </div>
                <div class="form-group">
                <input type="date" name="creation_date" class="form-control" placeholder="Date de création" />
                </div>
                <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Adresse e-mail professionnelle" required />
                </div>
                <div class="form-group">
                <select name="country" id="country-pro" class="form-control" required>
                    <option value="" disabled selected>Votre pays</option>
                    <option value="FR">France</option>
                    <option value="BE">Belgique</option>
                    <option value="CH">Suisse</option>
                    <option value="CA">Canada</option>
                    <option value="US">États-Unis</option>
                    <option value="UK">Royaume-Uni</option>
                    <option value="DE">Allemagne</option>
                    <option value="ES">Espagne</option>
                    <option value="IT">Italie</option>
                    <option value="JP">Japon</option>
                    <option value="AU">Australie</option>
                </select>
                </div>
                <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Mot de passe" required />
                </div>
                <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmer le mot de passe" required />
                </div>
                <button type="submit" class="btn btn-primary">S'inscrire comme professionnel</button>
                <div class="form-footer">
                En créant un compte professionnel, vous acceptez nos <a href="#">CGU</a> et notre <a href="#">Politique de confidentialité</a>.
                </div>
                <div class="mt-3">
                <button type="button" class="btn btn-secondary-custom" onclick="switchTabFromLink('register')">
                    ← Retour à l'inscription classique
                </button>
                </div>
            </form>
            </div>

        </div>
      </div>
    </div>

    <script>
      function switchTab(event, tabName) {
        document
          .querySelectorAll(".tab-btn")
          .forEach((btn) => btn.classList.remove("active"));
        event.target.classList.add("active");

        document
          .querySelectorAll(".form-content")
          .forEach((form) => form.classList.remove("active"));
        document.getElementById(tabName + "-form").classList.add("active");
      }

      function switchTabFromLink(tabName) {
        document
          .querySelectorAll(".form-content")
          .forEach((form) => form.classList.remove("active"));
        document.getElementById(tabName + "-form").classList.add("active");

        if (tabName !== "professional") {
          document
            .querySelectorAll(".tab-btn")
            .forEach((btn) => btn.classList.remove("active"));
          document
            .querySelector(`.tab-btn[onclick*="${tabName}"]`)
            .classList.add("active");
        }
      }
    </script>


    <script>
      // Gestion déconnexion
      document.addEventListener("click", async (e) => {
        if (e.target.closest("#logoutBtn")) {
          e.preventDefault();
          try {
            const token = localStorage.getItem("userToken");
            if (token) {
              await fetch("{{ url('/logout') }}", {
                method: "POST",
                headers: {
                  "Authorization": `Bearer ${token}`,
                  "X-Requested-With": "XMLHttpRequest",
                  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
              });
            }
          } catch (_) {}
          localStorage.removeItem("userToken");
          localStorage.removeItem("authUser");
          alert("Déconnecté");
          window.location.reload();
        }
      });
    </script>

  </body>
</html>
