# Guide de Déploiement Simplifié - Routes Web

## Changements effectués

✅ **Routes déplacées** de `api.php` vers `web.php`
✅ **CORS simplifié** - plus de problèmes de cross-origin
✅ **Configuration frontend** mise à jour

## Nouvelles URLs

**Avant (API):**
```
http://localhost:8000/api/v1/products
http://localhost:8000/api/v1/categories
```

**Maintenant (Web):**
```
http://localhost:8000/products
http://localhost:8000/categories
```

## Utilisation dans votre frontend

```javascript
// Inclure le fichier frontend-config.js
<script src="frontend-config.js"></script>

// Utilisation
api.get('/products').then(data => console.log(data));
api.get('/categories').then(data => console.log(data));
api.post('/login', {email: 'test@test.com', password: 'password'});
```

## Avantages de cette approche

- ✅ **Plus de problèmes CORS** - même domaine
- ✅ **Déploiement simplifié** - un seul site à héberger
- ✅ **URLs plus courtes** - pas de préfixe `/api/v1`
- ✅ **Configuration minimale** - fonctionne partout

## Déploiement

1. **Hébergez votre site Laravel** sur n'importe quel hébergeur PHP
2. **Mettez vos fichiers frontend** dans le dossier `public/`
3. **Configurez votre base de données** dans `.env`
4. **C'est tout !** Plus besoin de configuration CORS

## Structure recommandée

```
public/
├── index.php (Laravel)
├── votre-frontend/
│   ├── index.html
│   ├── style.css
│   ├── script.js
│   └── frontend-config.js
```

Vos fichiers frontend et backend seront sur le même domaine, éliminant tous les problèmes de CORS !
