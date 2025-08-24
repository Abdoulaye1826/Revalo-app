<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ReValo - Réinventer la gestion durable grâce au numérique. Transformons les déchets en ressources durables et bâtissons un avenir meilleur.">
    <meta name="keywords" content="ReValo, gestion durable, innovation numérique, économie circulaire, inclusion sociale, environnement">
    <meta name="author" content="ReValo Team">
    <link rel="icon" href="recyclage.png" type="image/png">
    <title>Mes demandes d'achat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container">
            <a class="navbar-brand" href="{{ route('acheteur.index') }}">
                <i class="fas fa-shopping-cart"></i> Interface Acheteur
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('boutique.index') }}">
                    <i class="fas fa-arrow-left"></i> Retour au catalogue
                </a>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-success">
                <i class="fas fa-list-alt"></i> Mes demandes d'achat
            </h1>
        </div>

        <!-- Formulaire de recherche par email -->
        @if(!$email)
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center mb-4">
                                <i class="fas fa-search"></i> Rechercher mes demandes
                            </h5>
                            <form method="GET" action="{{ route('acheteur.mes-demandes') }}">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Votre adresse email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           placeholder="Entrez l'email utilisé lors de vos demandes" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fas fa-search"></i> Rechercher mes demandes
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Affichage des demandes -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong>Email recherché:</strong> {{ $email }}
                            <br>
                            <small class="text-muted">{{ $demandes->count() }} demande(s) trouvée(s)</small>
                        </div>
                        <a href="{{ route('acheteur.mes-demandes') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-search"></i> Nouvelle recherche
                        </a>
                    </div>
                </div>
            </div>

            @if($demandes->count() > 0)
                <!-- Statistiques rapides -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-clock fa-2x mb-2"></i>
                                <h4>{{ $demandes->where('statut', 'en_attente')->count() }}</h4>
                                <small>En attente</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check fa-2x mb-2"></i>
                                <h4>{{ $demandes->where('statut', 'accepte')->count() }}</h4>
                                <small>Acceptées</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-times fa-2x mb-2"></i>
                                <h4>{{ $demandes->where('statut', 'refuse')->count() }}</h4>
                                <small>Refusées</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body text-center">
                                <i class="fas fa-check-double fa-2x mb-2"></i>
                                <h4>{{ $demandes->where('statut', 'traite')->count() }}</h4>
                                <small>Traitées</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Liste des demandes -->
                <div class="row">
                    @foreach($demandes as $demande)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm">
                                @if($demande->annonce->image)
                                    <img src="{{ asset('storage/' . $demande->annonce->image) }}" 
                                         class="card-img-top" style="height: 200px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                         style="height: 200px;">
                                        <i class="fas fa-image text-muted fa-3x"></i>
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $demande->annonce->titre }}</h5>
                                    
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            @switch($demande->statut)
                                                @case('en_attente')
                                                    <span class="badge bg-warning">
                                                        <i class="fas fa-clock"></i> En attente
                                                    </span>
                                                    @break
                                                @case('accepte')
                                                    <span class="badge bg-success">
                                                        <i class="fas fa-check"></i> Acceptée
                                                    </span>
                                                    @break
                                                @case('refuse')
                                                    <span class="badge bg-danger">
                                                        <i class="fas fa-times"></i> Refusée
                                                    </span>
                                                    @break
                                                @case('traite')
                                                    <span class="badge bg-info">
                                                        <i class="fas fa-check-double"></i> Traitée
                                                    </span>
                                                    @break
                                            @endswitch
                                            <small class="text-muted">
                                                {{ $demande->created_at->format('d/m/Y') }}
                                            </small>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row text-center">
                                            <div class="col-4">
                                                <small class="text-muted">Quantité</small>
                                                <div class="fw-bold">{{ $demande->quantite_demandee }}</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Prix unitaire</small>
                                                <div class="fw-bold">{{ number_format($demande->annonce->prix, 0, ',', ' ') }}</div>
                                            </div>
                                            <div class="col-4">
                                                <small class="text-muted">Total</small>
                                                <div class="fw-bold text-success">
                                                    {{ number_format($demande->annonce->prix * $demande->quantite_demandee, 0, ',', ' ') }} F
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-auto">
                                        <button type="button" class="btn btn-outline-primary w-100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#detailsModal{{ $demande->id }}">
                                            <i class="fas fa-eye"></i> Voir les détails
                                        </button>
                                    </div>
                                </div>

                                <!-- Badge de date en coin -->
                                <div class="position-absolute top-0 end-0 m-2">
                                    <small class="badge bg-dark">
                                        {{ $demande->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de détails -->
                        <div class="modal fade" id="detailsModal{{ $demande->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Détails de votre demande</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                @if($demande->annonce->image)
                                                    <img src="{{ asset('storage/' . $demande->annonce->image) }}" 
                                                         class="img-fluid rounded mb-3">
                                                @endif
                                                <h6>Informations sur le produit</h6>
                                                <table class="table table-sm">
                                                    <tr>
                                                        <th>Produit:</th>
                                                        <td>{{ $demande->annonce->titre }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description:</th>
                                                        <td>{{ Str::limit($demande->annonce->description, 100) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Catégorie:</th>
                                                        <td>{{ $demande->annonce->categorie }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Localisation:</th>
                                                        <td>{{ $demande->annonce->localisation }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Détails de votre demande</h6>
                                                <table class="table table-sm">
                                                    <tr>
                                                        <th>Date de demande:</th>
                                                        <td>{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Statut:</th>
                                                        <td>
                                                            @switch($demande->statut)
                                                                @case('en_attente')
                                                                    <span class="badge bg-warning">En attente de traitement</span>
                                                                    @break
                                                                @case('accepte')
                                                                    <span class="badge bg-success">Demande acceptée</span>
                                                                    @break
                                                                @case('refuse')
                                                                    <span class="badge bg-danger">Demande refusée</span>
                                                                    @break
                                                                @case('traite')
                                                                    <span class="badge bg-info">Demande traitée</span>
                                                                    @break
                                                            @endswitch
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Quantité demandée:</th>
                                                        <td>{{ $demande->quantite_demandee }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Prix unitaire:</th>
                                                        <td>{{ number_format($demande->annonce->prix, 0, ',', ' ') }} FCFA</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Montant total:</th>
                                                        <td class="fw-bold text-success">
                                                            {{ number_format($demande->annonce->prix * $demande->quantite_demandee, 0, ',', ' ') }} FCFA
                                                        </td>
                                                    </tr>
                                                </table>

                                                @if($demande->statut == 'accepte')
                                                    <div class="alert alert-success">
                                                        <i class="fas fa-info-circle"></i>
                                                        <strong>Bonne nouvelle !</strong> Votre demande a été acceptée. 
                                                        L'entreprise devrait vous contacter prochainement.
                                                    </div>
                                                @elseif($demande->statut == 'refuse')
                                                    <div class="alert alert-danger">
                                                        <i class="fas fa-info-circle"></i>
                                                        Votre demande a été refusée. 
                                                        Vous pouvez essayer de contacter directement l'entreprise.
                                                    </div>
                                                @elseif($demande->statut == 'traite')
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-check-double"></i>
                                                        Cette demande a été marquée comme traitée.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        @if($demande->message)
                                            <div class="mt-3">
                                                <h6>Votre message</h6>
                                                <div class="alert alert-light">
                                                    {{ $demande->message }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Aucune demande trouvée</h4>
                    <p class="text-muted">Aucune demande d'achat trouvée pour l'email: <strong>{{ $email }}</strong></p>
                    <a href="{{ route('acheteur.index') }}" class="btn btn-success">
                        <i class="fas fa-shopping-cart"></i> Parcourir les produits
                    </a>
                </div>
            @endif
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>