<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('entreprise.index') }}">
                <i class="fas fa-arrow-left"></i> Retour aux annonces
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">
                            <i class="fas fa-plus-circle"></i> Créer une nouvelle annonce
                        </h4>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('entreprise.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label for="titre" class="form-label">Titre de l'annonce *</label>
                                        <input type="text" class="form-control" id="titre" name="titre" 
                                               value="{{ old('titre') }}" required 
                                               placeholder="Ex: polystérène expansé pour construction">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="categorie" class="form-label">Catégorie *</label>
                                        <select class="form-select" id="categorie" name="categorie" required>
                                            <option value="">Choisir une catégorie</option>
                                            @foreach($categories as $cat)
                                                <option value="{{ $cat }}" {{ old('categorie') == $cat ? 'selected' : '' }}>
                                                    {{ $cat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description *</label>
                                <textarea class="form-control" id="description" name="description" 
                                          rows="4" required placeholder="Décrivez votre produit en détail...">{{ old('description') }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="prix" class="form-label">Prix (FCFA) *</label>
                                        <input type="number" class="form-control" id="prix" name="prix" min="0"
                                               placeholder="Ex: 850000">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="quantite" class="form-label">Quantité disponible *</label>
                                        <input type="number" class="form-control" id="quantite" name="quantite" 
                                               value="{{ old('quantite') }}" required min="1" max="1000000"
                                               oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                               placeholder="Ex: 10">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="localisation" class="form-label">Localisation *</label>
                                        <input type="text" class="form-control" id="localisation" name="localisation" 
                                               value="{{ old('localisation') }}" required
                                               placeholder="Ex: Dakar, Sénégal">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label">Image du produit</label>
                                <input type="file" class="form-control" id="image" name="image" 
                                       accept="image/jpeg,image/png,image/jpg,image/gif">
                                <div class="form-text">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB</div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('entreprise.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Annuler
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Créer l'annonce
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script pour prévisualiser l'image -->
    <script>
        document.getElementById('image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Créer ou mettre à jour la prévisualisation
                    let preview = document.getElementById('image-preview');
                    if (!preview) {
                        preview = document.createElement('img');
                        preview.id = 'image-preview';
                        preview.className = 'img-fluid mt-2 rounded';
                        preview.style.maxHeight = '200px';
                        document.getElementById('image').parentNode.appendChild(preview);
                    }
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Formatage du prix en temps réel
        document.getElementById('prix').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            if (value) {
                e.target.value = parseInt(value).toLocaleString('fr-FR');
            }
        });
    </script>
</body>
</html>