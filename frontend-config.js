// Configuration API pour le frontend
// Remplacez vos URLs d'API codées en dur par cette configuration

class ApiConfig {
    constructor() {
        this.baseUrl = this.getApiUrl();
    }

    getApiUrl() {
        // Détection automatique de l'environnement
        const hostname = window.location.hostname;
        
        if (hostname === 'localhost' || hostname === '127.0.0.1') {
            return 'http://localhost:8000';
        }
        
        // Remplacez par l'URL de votre site en production
        return 'https://votre-site-deployee.com';
    }

    // Méthodes utilitaires pour les requêtes
    async get(endpoint) {
        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });
        return response.json();
    }

    async post(endpoint, data) {
        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }

    async postWithAuth(endpoint, data, token) {
        const response = await fetch(`${this.baseUrl}${endpoint}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'Authorization': `Bearer ${token}`
            },
            body: JSON.stringify(data)
        });
        return response.json();
    }
}

// Instance globale
const api = new ApiConfig();

// Exemples d'utilisation :
// api.get('/products').then(products => console.log(products));
// api.post('/login', {email: 'test@test.com', password: 'password'});

// Export pour utilisation dans d'autres fichiers
window.api = api;
