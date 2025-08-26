# Guide de Déploiement - Projet E-commerce Laravel

## Problèmes courants et solutions

### 1. Configuration CORS
**Problème :** Les requêtes frontend sont bloquées par CORS en production.

**Solution :** 
- Modifiez votre fichier `.env` en production :
```
CORS_ALLOWED_ORIGINS=https://votre-frontend.com,https://www.votre-frontend.com
```

### 2. URLs d'API
**Problème :** URLs codées en dur pour localhost dans le frontend.

**Solution :** Créez un fichier de configuration dans votre frontend :
```javascript
// config.js
const API_CONFIG = {
    development: 'http://localhost:8000/api/v1',
    production: 'https://votre-api.com/api/v1'
};

export const API_URL = API_CONFIG[process.env.NODE_ENV] || API_CONFIG.production;
```

### 3. Base de données
**Problème :** SQLite ne fonctionne pas sur tous les hébergeurs.

**Solutions :**
- **Option 1 :** Migrer vers MySQL/PostgreSQL
- **Option 2 :** Utiliser un hébergeur supportant SQLite (comme Railway, Heroku)

### 4. Variables d'environnement
Créez un fichier `.env` en production avec :
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-api.com

# CORS
CORS_ALLOWED_ORIGINS=https://votre-frontend.com

# Base de données (exemple MySQL)
DB_CONNECTION=mysql
DB_HOST=votre-host-db
DB_PORT=3306
DB_DATABASE=votre_base
DB_USERNAME=votre_user
DB_PASSWORD=votre_password
```

## Étapes de déploiement

### Backend Laravel
1. **Hébergeur recommandé :** Railway, DigitalOcean, ou Heroku
2. **Commandes à exécuter :**
```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan migrate --force
```

### Frontend
1. **Hébergeur recommandé :** Netlify, Vercel, ou GitHub Pages
2. **Modifiez les URLs d'API** dans votre JavaScript
3. **Testez les requêtes AJAX** avec les nouvelles URLs

## Configuration JavaScript Frontend

Remplacez vos URLs d'API par :
```javascript
// Détection automatique de l'environnement
const API_BASE_URL = window.location.hostname === 'localhost' 
    ? 'http://localhost:8000/api/v1'
    : 'https://votre-api-deployee.com/api/v1';

// Exemple d'utilisation
fetch(`${API_BASE_URL}/products`)
    .then(response => response.json())
    .then(data => console.log(data));
```

## Checklist avant déploiement

- [ ] Configurer les variables d'environnement
- [ ] Modifier les URLs d'API dans le frontend
- [ ] Tester CORS avec le domaine de production
- [ ] Migrer la base de données si nécessaire
- [ ] Activer HTTPS sur les deux domaines
- [ ] Tester toutes les fonctionnalités en production
