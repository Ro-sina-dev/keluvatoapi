@extends('layouts.app')

@section('title', 'Inscription - Kuluvato')

@section('content')
<div class="auth-container" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px;">
    <div class="auth-card" style="background: white; border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); padding: 40px; width: 100%; max-width: 500px;">
        
        <!-- Header -->
        <div class="auth-header" style="text-align: center; margin-bottom: 40px;">
            <div class="logo" style="margin-bottom: 20px;">
                <img src="{{ asset('assets/IMG.png') }}" alt="Kuluvato" style="height: 60px;">
            </div>
            <h1 style="color: #333; font-size: 28px; font-weight: 600; margin: 0 0 10px 0;">Créer un compte</h1>
            <p style="color: #666; font-size: 16px; margin: 0;">Choisissez le type de compte qui vous correspond</p>
        </div>

        <!-- Options d'inscription -->
        <div class="register-options" style="display: flex; flex-direction: column; gap: 20px;">
            
            <!-- Inscription Client -->
            <div class="register-option" style="border: 2px solid #e1e5e9; border-radius: 15px; padding: 25px; cursor: pointer; transition: all 0.3s; position: relative;" onclick="selectRegisterType('client')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user" style="color: white; font-size: 20px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <h3 style="color: #333; font-size: 20px; font-weight: 600; margin: 0 0 8px 0;">Compte Client</h3>
                        <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.4;">Parfait pour acheter des meubles et accessoires de décoration</p>
                    </div>
                    <div class="radio" style="width: 20px; height: 20px; border: 2px solid #ddd; border-radius: 50%; position: relative;">
                        <div class="radio-dot" style="width: 10px; height: 10px; background: #4facfe; border-radius: 50%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s;"></div>
                    </div>
                </div>
            </div>

            <!-- Inscription Professionnel -->
            <div class="register-option" style="border: 2px solid #e1e5e9; border-radius: 15px; padding: 25px; cursor: pointer; transition: all 0.3s; position: relative;" onclick="selectRegisterType('pro')">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <div class="icon" style="width: 50px; height: 50px; background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-briefcase" style="color: white; font-size: 20px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <h3 style="color: #333; font-size: 20px; font-weight: 600; margin: 0 0 8px 0;">Compte Professionnel</h3>
                        <p style="color: #666; font-size: 14px; margin: 0; line-height: 1.4;">Idéal pour les entreprises, architectes et décorateurs</p>
                    </div>
                    <div class="radio" style="width: 20px; height: 20px; border: 2px solid #ddd; border-radius: 50%; position: relative;">
                        <div class="radio-dot" style="width: 10px; height: 10px; background: #fa709a; border-radius: 50%; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0; transition: opacity 0.3s;"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire d'inscription (caché par défaut) -->
        <div id="registerForm" style="display: none; margin-top: 30px;">
            <form id="registrationForm" method="POST">
                @csrf
                <input type="hidden" id="registerType" name="type" value="">
                
                <div style="margin-bottom: 20px;">
                    <label style="display: block; color: #333; font-weight: 600; margin-bottom: 8px;">Nom complet</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px 15px; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 16px; transition: border-color 0.3s;" placeholder="Votre nom complet">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; color: #333; font-weight: 600; margin-bottom: 8px;">Email</label>
                    <input type="email" name="email" required style="width: 100%; padding: 12px 15px; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 16px; transition: border-color 0.3s;" placeholder="votre@email.com">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; color: #333; font-weight: 600; margin-bottom: 8px;">Mot de passe</label>
                    <input type="password" name="password" required style="width: 100%; padding: 12px 15px; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 16px; transition: border-color 0.3s;" placeholder="Mot de passe sécurisé">
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; color: #333; font-weight: 600; margin-bottom: 8px;">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required style="width: 100%; padding: 12px 15px; border: 2px solid #e1e5e9; border-radius: 10px; font-size: 16px; transition: border-color 0.3s;" placeholder="Confirmer le mot de passe">
                </div>

                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 15px; border-radius: 10px; font-size: 16px; font-weight: 600; cursor: pointer; transition: transform 0.2s;">
                    Créer mon compte
                </button>
            </form>
        </div>

        <!-- Lien vers connexion -->
        <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e1e5e9;">
            <p style="color: #666; margin: 0;">Vous avez déjà un compte ? 
                <a href="{{ route('login') }}" style="color: #667eea; text-decoration: none; font-weight: 600;">Se connecter</a>
            </p>
        </div>
    </div>
</div>

<script src="{{ asset('js/google-translate.js') }}"></script>
  </body>
</html>

<script>
let selectedType = null;

function selectRegisterType(type) {
    // Réinitialiser toutes les options
    document.querySelectorAll('.register-option').forEach(option => {
        option.style.borderColor = '#e1e5e9';
        option.style.background = 'white';
        const dot = option.querySelector('.radio-dot');
        if (dot) dot.style.opacity = '0';
    });
    
    // Sélectionner l'option choisie
    const selectedOption = event.currentTarget;
    selectedOption.style.borderColor = type === 'client' ? '#4facfe' : '#fa709a';
    selectedOption.style.background = type === 'client' ? 'rgba(79, 172, 254, 0.05)' : 'rgba(250, 112, 154, 0.05)';
    
    const dot = selectedOption.querySelector('.radio-dot');
    if (dot) dot.style.opacity = '1';
    
    selectedType = type;
    
    // Afficher le formulaire
    document.getElementById('registerForm').style.display = 'block';
    document.getElementById('registerType').value = type;
    
    // Mettre à jour l'action du formulaire
    const form = document.getElementById('registrationForm');
    form.action = type === 'client' ? '{{ route("register.client") }}' : '{{ route("register.pro") }}';
    
    // Scroll vers le formulaire
    setTimeout(() => {
        document.getElementById('registerForm').scrollIntoView({ behavior: 'smooth' });
    }, 100);
}

// Gestion du formulaire
document.getElementById('registrationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = this.querySelector('button[type="submit"]');
    
    // Désactiver le bouton pendant l'envoi
    submitBtn.disabled = true;
    submitBtn.textContent = 'Création en cours...';
    
    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Redirection vers la page d'accueil ou dashboard
            window.location.href = '{{ route("home") }}';
        } else {
            // Afficher les erreurs
            alert(data.message || 'Une erreur est survenue');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de l\'inscription');
    })
    .finally(() => {
        // Réactiver le bouton
        submitBtn.disabled = false;
        submitBtn.textContent = 'Créer mon compte';
    });
});

// Améliorer l'UX des champs
document.querySelectorAll('input').forEach(input => {
    input.addEventListener('focus', function() {
        this.style.borderColor = selectedType === 'client' ? '#4facfe' : '#fa709a';
    });
    
    input.addEventListener('blur', function() {
        this.style.borderColor = '#e1e5e9';
    });
});
</script>

<style>
.register-option:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

button[type="submit"]:hover {
    transform: translateY(-2px);
}

button[type="submit"]:active {
    transform: translateY(0);
}
</style>
@endsection
