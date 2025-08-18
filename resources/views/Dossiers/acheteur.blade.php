<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Acheteur - Catalogue des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; }
        .navbar { box-shadow: 0 2px 8px rgba(0,0,0,0.04); }
        .card {
            transition: transform 0.15s, box-shadow 0.15s;
            border-radius: 1rem;
        }
        .card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        }
        .card-img-top {
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            transition: filter 0.2s;
        }
        .card-img-top:hover {
            filter: brightness(0.95) saturate(1.2);
        }
        .badge.bg-success {
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            color: #222;
            font-weight: 600;
        }
        .form-control:focus, .form-select:focus {
            border-color: #38d39f;
            box-shadow: 0 0 0 0.2rem rgba(56,211,159,.15);
        }
        .btn-success {
            background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
            border: none;
            color: #222;
            font-weight: 600;
        }
        .btn-success:hover {
            background: linear-gradient(90deg, #38f9d7 0%, #43e97b 100%);
            color: #222;
        }
        .fade-in {
            animation: fadeInUp 0.7s;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px);}
            to { opacity: 1; transform: translateY(0);}
        }
        .input-group-text {
            background: #e9f7ef;
            border: none;
        }
        .modal-content {
            border-radius: 1rem;
        }
        .loader {
            display: none;
            width: 2rem;
            height: 2rem;
            border: 4px solid #38f9d7;
            border-top: 4px solid #43e97b;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: auto;
        }
        @keyframes spin {
            to { transform: rotate(360deg);}
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-shopping-cart"></i> Interface Acheteur
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('acheteur.mes-demandes') }}">
                    <i class="fas fa-list-alt"></i> Mes demandes
                </a>
                <a class="nav-link" href="{{ route('entreprise.index') }}">
                    <i class="fas fa-building"></i> Vue Entreprise
                </a>
                <a class="nav-link" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion 
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
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('acheteur.index') }}" autocomplete="off">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label" for="search">Rechercher</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                                <input type="text" id="search" name="search" class="form-control"
                                       placeholder="Nom du produit..." value="{{ request('search') }}" autocomplete="search">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="categorie">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-select">
                                <option value="">Toutes</option>
                                @isset($categories)
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ request('categorie') == $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="prix_min">Prix min</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                <input type="number" id="prix_min" name="prix_min" class="form-control"
                                       placeholder="0" value="{{ request('prix_min') }}" min="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="prix_max">Prix max</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                <input type="number" id="prix_max" name="prix_max" class="form-control"
                                       placeholder="1000000" value="{{ request('prix_max') }}" min="0" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label" for="localisation">Localisation</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" id="localisation" name="localisation" class="form-control"
                                       placeholder="Ville..." value="{{ request('localisation') }}" autocomplete="address-level2">
                            </div>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" class="btn btn-success w-100" aria-label="Rechercher">
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
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fermer"></button>
            </div>
        @endif

        <!-- Grille des annonces -->
        @isset($annonces)
        @if($annonces->count() > 0)
            <div class="row">
                @foreach($annonces as $annonce)
                    <div class="col-md-6 col-lg-4 mb-4 fade-in">
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
                    <div class="modal fade" id="demandeModal{{ $annonce->id }}" tabindex="-1" aria-labelledby="demandeModalLabel{{ $annonce->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="demandeModalLabel{{ $annonce->id }}">Demande d'achat - {{ $annonce->titre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                </div>
                                <form action="{{ route('acheteur.demande', $annonce->id) }}" method="POST" autocomplete="off" class="demande-form">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="nom_acheteur_{{ $annonce->id }}">Nom complet *</label>
                                            <input type="text" id="nom_acheteur_{{ $annonce->id }}" name="nom_acheteur" class="form-control" required autocomplete="name">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="email_acheteur_{{ $annonce->id }}">Email *</label>
                                            <input type="email" id="email_acheteur_{{ $annonce->id }}" name="email_acheteur" class="form-control" required autocomplete="email">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="telephone_acheteur_{{ $annonce->id }}">Téléphone *</label>
                                            <input type="tel" id="telephone_acheteur_{{ $annonce->id }}" name="telephone_acheteur" class="form-control" required autocomplete="tel">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="quantite_demandee_{{ $annonce->id }}">Quantité souhaitée *</label>
                                            <input type="number" id="quantite_demandee_{{ $annonce->id }}" name="quantite_demandee" class="form-control"
                                                   min="1" max="{{ $annonce->quantite }}" required>
                                            <div class="form-text">Maximum disponible : {{ $annonce->quantite }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="message_{{ $annonce->id }}">Message (optionnel)</label>
                                            <textarea id="message_{{ $annonce->id }}" name="message" class="form-control" rows="3"
                                                      placeholder="Informations complémentaires..."></textarea>
                                        </div>
                                        <div class="alert alert-info">
                                            <strong>Prix unitaire :</strong> {{ number_format($annonce->prix, 0, ',', ' ') }} FCFA<br>
                                            <strong>Localisation :</strong> {{ $annonce->localisation }}
                                        </div>
                                        <div class="loader"></div>
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
        @endisset
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animation d'apparition des cartes
        document.querySelectorAll('.fade-in').forEach((el, i) => {
            el.style.animationDelay = (i * 0.08) + 's';
        });

        // Loader lors de la soumission du formulaire de demande
        document.querySelectorAll('.demande-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                const loader = form.querySelector('.loader');
                if(loader) {
                    loader.style.display = 'block';
                }
                form.querySelectorAll('button[type=submit]').forEach(btn => btn.disabled = true);
            });
        });
    </script>
</body>
</html>