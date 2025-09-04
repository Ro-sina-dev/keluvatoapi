<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Réinitialisation du mot de passe | Keluvato Group</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 2rem;
        position: relative;
      }

      .hero-content {
        max-width: 500px;
        margin: 0 auto;
        text-align: center;
        z-index: 1;
      }

      .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.2;
      }

      .hero-subtitle {
        font-size: 1.1rem;
        margin-bottom: 2rem;
        opacity: 0.9;
      }

      .form-section {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem;
      }

      .form-card {
      /* background: white;*/
        /*  border-radius: 10px;*/
        /*  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);*/
        padding: 2.5rem;
        width: 100%;
        max-width: 500px;
      }

      .form-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        text-align: center;
      }

      .form-subtitle {
        color: #666;
        text-align: center;
        margin-bottom: 2rem;
      }

      .form-group {
        margin-bottom: 1.5rem;
      }

      .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s;
      }

      .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(74, 107, 255, 0.2);
      }

      .btn {
        display: inline-block;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 6px;
        padding: 0.8rem 1.5rem;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        width: 100%;
        transition: all 0.3s;
      }

      .btn:hover {
        background: #3a56e0;
        transform: translateY(-1px);
      }

      .btn:active {
        transform: translateY(0);
      }

      .text-center {
        text-align: center;
      }

      .mt-3 {
        margin-top: 1.5rem;
      }

      .text-primary {
        color: var(--primary);
      }

      .alert {
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.5rem;
        font-size: 0.9rem;
      }

      .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
      }

      .text-danger {
        color: #dc3545;
        font-size: 0.8rem;
        margin-top: 0.25rem;
        display: block;
      }

      @media (max-width: 768px) {
        .auth-container {
          grid-template-columns: 1fr;
        }

        .hero-section {
          display: none;
        }
      }
    </style>
  </head>

  <body>
    <div class="auth-container">
      <div class="hero-section">
        <div class="hero-content">
          <h1 class="hero-title">RÉINITIALISATION DU MOT DE PASSE</h1>
          <p class="hero-subtitle">
            Entrez votre adresse email pour recevoir un lien de réinitialisation.
          </p>
        </div>
      </div>

      <div class="form-section">
        <div class="form-card">
          <h2 class="form-title">Mot de passe oublié ?</h2>
          <p class="form-subtitle">
            Entrez votre adresse email et nous vous enverrons un lien pour réinitialiser votre mot de passe.
          </p>

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>
          @endif

          <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
              <input
                type="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Votre adresse email"
                value="{{ old('email') }}"
                required
                autofocus
              >
              @error('email')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>

            <button type="submit" class="btn">
              Envoyer le lien de réinitialisation
            </button>
          </form>

          <div class="mt-3 text-center">
            <a href="{{ route('login') }}" class="text-primary">
              <i class="fas fa-arrow-left"></i> Retour à la connexion
            </a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
