<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interface Entreprise - Gestion des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e3e9f7 100%);
            min-height: 100vh;
        }
        .card {
            transition: transform 0.15s, box-shadow 0.15s;
            border-radius: 1rem;
        }
        .card:hover {
            transform: translateY(-6px) scale(1.03);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }
        .btn-outline-primary, .btn-outline-danger {
            transition: background 0.2s, color 0.2s;
        }
        .btn-outline-primary:hover {
            background: #0d6efd;
            color: #fff;
        }
        .btn-outline-danger:hover {
            background: #dc3545;
            color: #fff;
        }
        .navbar-brand {
            font-weight: bold;
            letter-spacing: 1px;
        }
        .badge {
            font-size: 0.9em;
        }
        .card-title {
            font-weight: 600;
        }
        .modal-content {
            border-radius: 1rem;
        }
        .fade-in {
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px);}
            to { opacity: 1; transform: none;}
        }
    </style>
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i> Interface Entreprise
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('entreprise.demandes') }}">
                    <i class="fas fa-envelope"></i> Demandes reçues
                </a>
                <a class="nav-link" href="{{ route('acheteur.index') }}">
                    <i class="fas fa-shopping-cart"></i> Vue Acheteur
                </a>
                <a class="nav-link" href="{{ route('logout') }}" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </nav> -->
<!-- Dans la navbar de votre blade -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i> {{ Auth::user()->name }}
            </a>
            <!-- Ou si vous avez un champ spécifique pour l'entreprise -->
            <!-- <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i> {{ Auth::user()->entreprise_name ?? Auth::user()->name }}
            </a> -->
            
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    <i class="fas fa-user"></i> Connecté en tant que: <strong>{{ Auth::user()->name }}</strong>
                </span>
                <a class="nav-link" href="{{ route('entreprise.demandes') }}">
                    <i class="fas fa-envelope"></i> Demandes reçues
                </a>
                <a class="nav-link" href="{{ route('acheteur.index') }}">
                    <i class="fas fa-shopping-cart"></i> Vue Acheteur
                </a>
                <a class="nav-link" href="{{ route('logout') }}" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>
    </nav>
    <div class="container mt-4 fade-in">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-primary">
                <i class="fas fa-bullhorn"></i> Mes Annonces
            </h1>
            <a href="{{ route('entreprise.create') }}" class="btn btn-success shadow">
                <i class="fas fa-plus"></i> Nouvelle Annonce
            </a>
        </div>

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

        @if($annonces->count() > 0)
            <div class="row g-4">
                @foreach($annonces as $annonce)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" 
                                     class="card-img-top" 
                                     style="height: 200px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;"
                                     alt="{{ $annonce->titre }}">
                            @else
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" 
                                     style="height: 200px; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
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
                                        <button 
                                            class="btn btn-outline-danger btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteModal"
                                            data-annonce-id="{{ $annonce->id }}">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </div>
                                    <!-- Formulaire de suppression caché -->
                                    <form id="delete-form-{{ $annonce->id }}" action="{{ route('entreprise.destroy', $annonce->id) }}" method="POST" style="display:none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
                <a href="{{ route('entreprise.create') }}" class="btn btn-primary shadow">
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
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let annonceIdToDelete = null;
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            annonceIdToDelete = button.getAttribute('data-annonce-id');
        });
        document.getElementById('confirmDeleteBtn').addEventListener('click', function () {
            if (annonceIdToDelete) {
                document.getElementById('delete-form-' + annonceIdToDelete).submit();
            }
        });
    </script>
</body>
</html>