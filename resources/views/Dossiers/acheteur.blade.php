<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Acheteur - Catalogue des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-cart"></i> Interface Acheteur
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('entreprise.index') }}">
                    <i class="fas fa-building"></i> Vue Entreprise
                </a>
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fas fas-logout"></i> Déconnexion
                </a>
            </div> 
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="h3 text-success">
                    <i class="fas fa-store"></i> Catalogue des Produits
                </h1>
                <p class="text-muted">Découvrez les produits et services disponibles</p>
            </div>
        </div>

        <!-- Filtres de recherche -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('acheteur.index') }}">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Rechercher</label>
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Nom du produit..." value="{{ request('search') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Catégorie</label>
                            <select name="categorie" class="form-select">
                                <option value="">Toutes</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Prix min</label>
                            <input type="number" name="prix_min" class="form-control" 
                                   placeholder="0" value="{{ request('prix_min') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Prix max</label>
                            <input type="number" name="prix_max" class="form-control" 
                                   placeholder="1000000" value="{{ request('prix_max') }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Localisation</label>
                            <input type="text" name="localisation" class="form-control" 
                                   placeholder="Ville..." value="{{ request('localisation') }}">
                        </div>
                        <div class="col-md-1">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Messages -->
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
                        <div class="card h-100 shadow-sm border-0">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" 
                                     class="card-img-top" 
                                     style="height: 220px; object-fit: cover;"
                                     alt="{{ $annonce->titre }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 220px;">
                                    <i class="fas fa-image text-muted fa-4x"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">{{ $annonce->titre }}</h5>
                                    <span class="badge bg-success">{{ $annonce->categorie }}</span>
                                </div>
                                
                                <p class="card-text text-muted small mb-3">
                                    {{ Str::limit($annonce->description, 120) }}
                                </p>

                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-success fs-5">
                                            {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA
                                        </strong>
                                        <small class="text-muted">
                                            <i class="fas fa-box"></i> {{ $annonce->quantite }} disponible(s)
                                        </small>
                                    </div>
                                    <small class="text-muted">
                                        <i class="fas fa-map-marker-alt"></i> {{ $annonce->localisation }}
                                    </small>
                                </div>

                                <div class="mt-auto">
                                    <button type="button" class="btn btn-success w-100" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#demandeModal{{ $annonce->id }}">
                                        <i class="fas fa-shopping-cart"></i> Faire une demande
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de demande d'achat -->
                    <div class="modal fade" id="demandeModal{{ $annonce->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Demande d'achat - {{ $annonce->titre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form action="{{ route('acheteur.demande', $annonce->id) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nom complet *</label>
                                            <input type="text" name="nom_acheteur" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email *</label>
                                            <input type="email" name="email_acheteur" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Téléphone *</label>
                                            <input type="tel" name="telephone_acheteur" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Quantité souhaitée *</label>
                                            <input type="number" name="quantite_demandee" class="form-control" 
                                                   min="1" max="{{ $annonce->quantite }}" required>
                                            <div class="form-text">Maximum disponible : {{ $annonce->quantite }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Message (optionnel)</label>
                                            <textarea name="message" class="form-control" rows="3" 
                                                      placeholder="Informations complémentaires..."></textarea>
                                        </div>
                                        <div class="alert alert-info">
                                            <strong>Prix unitaire :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA<br>
                                            <strong>Localisation :</strong> {{ $annonce->localisation }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-paper-plane"></i> Envoyer la demande
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $annonces->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-search fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune annonce trouvée</h4>
                <p class="text-muted">Essayez de modifier vos critères de recherche</p>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>