<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Keluvato • Gestion des couleurs</title>
  
  <!-- Fonts & Icons -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;800&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/4f6d5d3b2c.js" crossorigin="anonymous"></script>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <style>
    :root {
      --bg: #0b1020;
      --card: rgba(255, 255, 255, 0.06);
      --stroke: rgba(255, 255, 255, 0.12);
      --txt: #e8ecf2;
      --muted: #aab3c3;
      --brand: #6ea8fe;
      --danger: #ef4444;
    }
    
    body {
      background: var(--bg);
      color: var(--txt);
      font-family: 'Inter', sans-serif;
      padding: 2rem;
    }
    
    .card {
      background: var(--card);
      border: 1px solid var(--stroke);
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    
    .color-preview {
      width: 30px;
      height: 30px;
      border-radius: 4px;
      display: inline-block;
      border: 1px solid var(--stroke);
    }
    
    .btn-brand {
      background: var(--brand);
      color: white;
      border: none;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      font-weight: 500;
    }
    
    .btn-brand:hover {
      opacity: 0.9;
    }
    
    .table {
      color: var(--txt);
    }
    
    .table th {
      border-color: var(--stroke);
      font-weight: 600;
    }
    
    .table td {
      vertical-align: middle;
      border-color: var(--stroke);
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Gestion des couleurs</h2>
      <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">
        <i class="fas fa-arrow-left me-2"></i> Retour
      </a>
    </div>
    
    <div class="card p-4 mb-4">
      <h4>Ajouter une couleur</h4>
      <form id="colorForm" class="row g-3">
        @csrf
        <div class="col-md-5">
          <label for="name" class="form-label">Nom de la couleur</label>
          <input type="text" class="form-control bg-dark text-white border-secondary" id="name" required>
        </div>
        <div class="col-md-5">
          <label for="code" class="form-label">Code couleur (HEX)</label>
          <div class="input-group">
            <span class="input-group-text">#</span>
            <input type="text" class="form-control bg-dark text-white border-secondary" id="code" maxlength="6" required>
          </div>
        </div>
        <div class="col-md-2 d-flex align-items-end">
          <button type="submit" class="btn btn-brand w-100">
            <i class="fas fa-plus me-2"></i> Ajouter
          </button>
        </div>
      </form>
    </div>
    
    <div class="card p-4">
      <h4 class="mb-4">Couleurs disponibles</h4>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Couleur</th>
              <th>Code</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="colorsList">
            <!-- Les couleurs seront chargées ici dynamiquement -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <script>
    // Charger les couleurs au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
      loadColors();
      
      // Gestion de la soumission du formulaire
      document.getElementById('colorForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const name = document.getElementById('name').value.trim();
        let code = document.getElementById('code').value.trim();
        
        // S'assurer que le code commence par #
        if (!code.startsWith('#')) {
          code = '#' + code;
        }
        
        // Valider le format du code couleur
        if (!/^#[0-9A-Fa-f]{6}$/i.test(code)) {
          alert('Veuillez entrer un code couleur HEX valide (ex: FF5733)');
          return;
        }
        
        // Envoyer la requête AJAX
        fetch('{{ route('colors.store') }}', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            name: name,
            code: code
          })
        })
        .then(response => response.json())
        .then(data => {
          // Réinitialiser le formulaire
          document.getElementById('colorForm').reset();
          // Recharger la liste des couleurs
          loadColors();
        })
        .catch(error => {
          console.error('Erreur:', error);
          alert('Une erreur est survenue lors de l\'ajout de la couleur');
        });
      });
    });
    
    // Fonction pour charger les couleurs
    function loadColors() {
      fetch('{{ route('colors.index') }}')
        .then(response => response.json())
        .then(colors => {
          const colorsList = document.getElementById('colorsList');
          colorsList.innerHTML = '';
          
          colors.forEach(color => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${color.name}</td>
              <td>
                <div class="color-preview" style="background-color: ${color.code}"></div>
              </td>
              <td>${color.code}</td>
              <td>
                <button class="btn btn-sm btn-danger delete-color" data-id="${color.id}">
                  <i class="fas fa-trash"></i>
                </button>
              </td>
            `;
            colorsList.appendChild(row);
          });
          
          // Ajouter les écouteurs d'événements pour les boutons de suppression
          document.querySelectorAll('.delete-color').forEach(button => {
            button.addEventListener('click', function() {
              if (confirm('Êtes-vous sûr de vouloir supprimer cette couleur ?')) {
                deleteColor(this.dataset.id);
              }
            });
          });
        });
    }
    
    // Fonction pour supprimer une couleur
    function deleteColor(id) {
      fetch(`/admin/colors/${id}`, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          loadColors();
        } else {
          alert('Erreur lors de la suppression de la couleur');
        }
      })
      .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de la suppression de la couleur');
      });
    }
  </script>
</body>
</html>
