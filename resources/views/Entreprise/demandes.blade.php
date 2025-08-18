<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes d'achat reçues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .stat-card {
            transition: transform .2s;
            cursor: pointer;
        }
        .stat-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #0001;
        }
        .badge-animated {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 #ffc10755; }
            70% { box-shadow: 0 0 0 10px #ffc10700; }
            100% { box-shadow: 0 0 0 0 #ffc10700; }
        }
        .table-hover tbody tr:hover {
            background-color: #f1f7ff;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('entreprise.index') }}">
                <i class="fas fa-building"></i> Interface Entreprise
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('entreprise.index') }}">
                    <i class="fas fa-arrow-left"></i> Retour aux annonces
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">
                <i class="fas fa-envelope"></i> Demandes d'achat reçues
            </h1>
            <div class="badge bg-primary fs-6">
                {{ $demandes->count() }} demande(s)
            </div>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistiques rapides -->
        <div class="row mb-4 g-3">
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-warning text-white" onclick="filterStatut('en_attente')">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h4 class="badge-animated">{{ $demandes->where('statut', 'en_attente')->count() }}</h4>
                        <small>En attente</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-success text-white" onclick="filterStatut('accepte')">
                    <div class="card-body text-center">
                        <i class="fas fa-check fa-2x mb-2"></i>
                        <h4>{{ $demandes->where('statut', 'accepte')->count() }}</h4>
                        <small>Acceptées</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-danger text-white" onclick="filterStatut('refuse')">
                    <div class="card-body text-center">
                        <i class="fas fa-times fa-2x mb-2"></i>
                        <h4>{{ $demandes->where('statut', 'refuse')->count() }}</h4>
                        <small>Refusées</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card bg-info text-white" onclick="filterStatut('traite')">
                    <div class="card-body text-center">
                        <i class="fas fa-check-double fa-2x mb-2"></i>
                        <h4>{{ $demandes->where('statut', 'traite')->count() }}</h4>
                        <small>Traitées</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres dynamiques -->
        <div class="mb-3 d-flex flex-wrap gap-2">
            <button class="btn btn-outline-primary btn-sm" onclick="filterStatut('all')">Toutes</button>
            <button class="btn btn-outline-warning btn-sm" onclick="filterStatut('en_attente')">En attente</button>
            <button class="btn btn-outline-success btn-sm" onclick="filterStatut('accepte')">Acceptées</button>
            <button class="btn btn-outline-danger btn-sm" onclick="filterStatut('refuse')">Refusées</button>
            <button class="btn btn-outline-info btn-sm" onclick="filterStatut('traite')">Traitées</button>
        </div>

        <!-- Liste des demandes -->
        @if($demandes->count() > 0)
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Liste des demandes</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="demandesTable">
                            <thead class="table-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Produit</th>
                                    <th>Acheteur</th>
                                    <th>Contact</th>
                                    <th>Quantité</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($demandes as $demande)
                                    <tr data-statut="{{ $demande->statut }}">
                                        <td>
                                            <small class="text-muted">
                                                {{ $demande->created_at->format('d/m/Y H:i') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($demande->annonce->image)
                                                    <img src="{{ asset('storage/' . $demande->annonce->image) }}" 
                                                         class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="fw-bold">{{ $demande->annonce->titre }}</div>
                                                    <small class="text-muted">{{ number_format($demande->annonce->prix, 0, ',', ' ') }} FCFA</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <div class="fw-bold">{{ $demande->nom_acheteur }}</div>
                                                <small class="text-muted">{{ $demande->email_acheteur }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <small>
                                                <i class="fas fa-phone"></i> {{ $demande->telephone_acheteur }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $demande->quantite_demandee }}</span>
                                        </td>
                                        <td>
                                            @switch($demande->statut)
                                                @case('en_attente')
                                                    <span class="badge bg-warning text-dark">En attente</span>
                                                    @break
                                                @case('accepte')
                                                    <span class="badge bg-success">Acceptée</span>
                                                    @break
                                                @case('refuse')
                                                    <span class="badge bg-danger">Refusée</span>
                                                    @break
                                                @case('traite')
                                                    <span class="badge bg-info text-dark">Traitée</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#detailsModal{{ $demande->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                                            type="button" data-bs-toggle="dropdown">
                                                        <i class="fas fa-cog"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <form class="action-form" action="{{ route('entreprise.demandes.statut', $demande->id) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="statut" value="accepte">
                                                                <button type="submit" class="dropdown-item text-success">
                                                                    <i class="fas fa-check"></i> Accepter
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form class="action-form" action="{{ route('entreprise.demandes.statut', $demande->id) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="statut" value="refuse">
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-times"></i> Refuser
                                                                </button>
                                                            </form>
                                                        </li>
                                                        <li>
                                                            <form class="action-form" action="{{ route('entreprise.demandes.statut', $demande->id) }}" method="POST">
                                                                @csrf @method('PUT')
                                                                <input type="hidden" name="statut" value="traite">
                                                                <button type="submit" class="dropdown-item text-info">
                                                                    <i class="fas fa-check-double"></i> Marquer comme traité
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal de détails -->
                                    <div class="modal fade" id="detailsModal{{ $demande->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Détails de la demande</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h6>Informations sur le produit</h6>
                                                            <table class="table table-sm">
                                                                <tr>
                                                                    <th>Produit:</th>
                                                                    <td>{{ $demande->annonce->titre }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Prix unitaire:</th>
                                                                    <td>{{ number_format($demande->annonce->prix, 0, ',', ' ') }} FCFA</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Quantité demandée:</th>
                                                                    <td>{{ $demande->quantite_demandee }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Montant total:</th>
                                                                    <td class="fw-bold text-success">
                                                                        {{ number_format($demande->annonce->prix * $demande->quantite_demandee, 0, ',', ' ') }} FCFA
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Informations sur l'acheteur</h6>
                                                            <table class="table table-sm">
                                                                <tr>
                                                                    <th>Nom:</th>
                                                                    <td>{{ $demande->nom_acheteur }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email:</th>
                                                                    <td>{{ $demande->email_acheteur }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Téléphone:</th>
                                                                    <td>{{ $demande->telephone_acheteur }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Date de demande:</th>
                                                                    <td>{{ $demande->created_at->format('d/m/Y à H:i') }}</td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    @if($demande->message)
                                                        <div class="mt-3">
                                                            <h6>Message de l'acheteur</h6>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-envelope-open fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Aucune demande reçue</h4>
                <p class="text-muted">Vous n'avez pas encore reçu de demandes d'achat</p>
            </div>
        @endif
    </div>

    <!-- Loader -->
    <div id="loader" style="display:none;position:fixed;top:0;left:0;width:100vw;height:100vh;background:#0003;z-index:9999;align-items:center;justify-content:center;">
        <div class="spinner-border text-primary" style="width:4rem;height:4rem;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filtrage dynamique par statut
        function filterStatut(statut) {
            let rows = document.querySelectorAll('#demandesTable tbody tr');
            rows.forEach(row => {
                if (statut === 'all' || row.getAttribute('data-statut') === statut) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Loader lors des actions
        document.querySelectorAll('.action-form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('loader').style.display = 'flex';
            });
        });
    </script>
</body>
</html>