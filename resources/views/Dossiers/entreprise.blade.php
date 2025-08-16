<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Entreprise - Gestion des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i> Interface Entreprise
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('acheteur.index') }}">
                    <i class="fas fa-shopping-cart"></i> Vue Acheteur
                </a>
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fas fas-logout"></i> Déconnexion
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header avec bouton d'ajout -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">
                <i class="fas fa-bullhorn"></i> Mes Annonces
            </h1>
            <a href="{{ route('entreprise.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Nouvelle Annonce
            </a>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Grille des annonces -->
        @if($annonces->count() > 0)
            <div class="row">
                @foreach($annonces as $annonce)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover;"
                                     alt="{{ $annonce->titre }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px;">
                                    <i class="fas fa-image text-muted fa-3x"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-truncate">{{ $annonce->titre }}</h5>
                                <p class="card-text text-muted small">{{ Str::limit($annonce->description, 100) }}</p>
                                
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="badge bg-secondary">{{ $annonce->categorie }}</span>
                                        <strong class="text-success">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</strong>
                                    </div>
                                    
                                    <div class="small text-muted mb-3">
                                        <div><i class="fas fa-box"></i> Quantité: {{ $annonce->quantite }}</div>
                                        <div><i class="fas fa-map-marker-alt"></i> {{ $annonce->localisation }}</div>
                                    </div>

                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('entreprise.edit', $annonce->id) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>
                                        <form action="{{ route('entreprise.destroy', $annonce->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette annonce ?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-bullhorn fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune annonce créée</h4>
                <p class="text-muted">Commencez par créer votre première annonce</p>
                <a href="{{ route('entreprise.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Créer une annonce
                </a>
            </div>
        @endif
    </div>

    <!-- Modal de confirmation de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir supprimer cette annonce ? Cette action est irréversible.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>