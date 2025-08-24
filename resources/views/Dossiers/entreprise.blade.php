<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ReValo - Réinventer la gestion durable grâce au numérique. Transformons les déchets en ressources durables et bâtissons un avenir meilleur.">
    <meta name="keywords" content="ReValo, gestion durable, innovation numérique, économie circulaire, inclusion sociale, environnement">
    <meta name="author" content="ReValo Team">
    <link rel="icon" href="recyclage.png" type="image/png">
    <title>Interface Entreprise - Gestion des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --glass-bg: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-hover: 0 15px 45px rgba(31, 38, 135, 0.5);
        }
        body {
            font-family: 'Inter', sans-serif;
            /* background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab); */
            
            background: linear-gradient(135deg, rgba(46, 204, 113, 0.8), rgba(39, 174, 96, 0.8)), 
                        url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%234CAF50;stop-opacity:0.1" /><stop offset="100%" style="stop-color:%232E7D32;stop-opacity:0.3" /></linearGradient></defs><rect width="1200" height="800" fill="url(%23grad1)"/><circle cx="200" cy="150" r="50" fill="%2366BB6A" opacity="0.3"/><circle cx="800" cy="300" r="80" fill="%234CAF50" opacity="0.2"/><circle cx="1000" cy="600" r="60" fill="%2381C784" opacity="0.4"/><path d="M100,400 Q300,200 500,400 T900,400" stroke="%234CAF50" stroke-width="3" fill="none" opacity="0.6"/></svg>');
            
            /* background-size: 400% 400%; */
            /* animation: gradientShift 15s ease infinite; */
            min-height: 100vh;
        }
        @keyframes gradientShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        .navbar {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            box-shadow: var(--shadow-soft);
        }
        .navbar-brand {
            font-weight: 800;
            color: white !important;
        }
        .nav-link {
            color: rgba(255,255,255,0.9)!important;
            font-weight: 500;
            position: relative;
        }
        .nav-link:hover {color:white!important;}
        .btn-gradient {
            background: var(--primary-gradient);
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            border: none;
            font-weight: 600;
        }
        .page-title {
            color: white;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .card-modern {
            background: var(--glass-bg);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--shadow-soft);
            transition: all 0.3s ease;
        }
        .card-modern:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: var(--shadow-hover);
        }
        .card-image {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        .badge-modern {
            background: var(--primary-gradient);
            border-radius: 50px;
            color: white;
            padding: 6px 14px;
        }
        .price-tag {
            color: #00f2fe;
            font-weight: 700;
            font-size: 1.2rem;
        }
        .btn-edit {background: var(--success-gradient); color: white;}
        .btn-delete {background: var(--danger-gradient); color: white;}
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#"><i class="fas fa-building me-2"></i>{{ Auth::user()->name }}</a>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3"><a class="nav-link" href="{{ route('entreprise.demandes') }}"><i class="fas fa-envelope me-1"></i>Demandes</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="{{ route('acheteur.index') }}"><i class="fas fa-shopping-cart me-1"></i>Vue Acheteur</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">@csrf
                            <button type="submit" class="btn btn-gradient"><i class="fas fa-sign-out-alt me-1"></i>Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="page-title"><i class="fas fa-bullhorn me-2"></i>Mes Annonces</h1>
            <a href="{{ route('entreprise.create') }}" class="btn btn-gradient"><i class="fas fa-plus me-1"></i>Nouvelle</a>
        </div>

        @if($annonces->count() > 0)
            <div class="row g-4">
                @foreach($annonces as $annonce)
                    <div class="col-md-6 col-lg-4">
                        <div class="card-modern h-100">
                            @if($annonce->image)
                                <img src="{{ asset('storage/' . $annonce->image) }}" class="card-image" alt="{{ $annonce->titre }}">
                            @else
                                <div class="card-image d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-image fa-2x text-muted"></i>
                                </div>
                            @endif
                            <div class="p-3">
                                <h5 class="text-white fw-bold">{{ $annonce->titre }}</h5>
                                <p class="text-white-50 small">{{ Str::limit($annonce->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge-modern">{{ $annonce->categorie }}</span>
                                    <span class="price-tag">{{ number_format($annonce->prix, 0, ',', ' ') }} FCFA</span>
                                </div>
                                <div class="text-white-50 small mb-3">
                                    <div><i class="fas fa-box me-1"></i>{{ $annonce->quantite }}</div>
                                    <div><i class="fas fa-map-marker-alt me-1"></i>{{ $annonce->localisation }}</div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('entreprise.edit', $annonce->id) }}" class="btn btn-edit btn-sm flex-fill"><i class="fas fa-edit me-1"></i>Modifier</a>
                                    <form id="delete-form-{{ $annonce->id }}" action="{{ route('entreprise.destroy', $annonce->id) }}" method="POST" style="display:none;">@csrf @method('DELETE')</form>
                                    <button data-annonce-id="{{ $annonce->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-delete btn-sm flex-fill"><i class="fas fa-trash me-1"></i>Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5 text-white">
                <i class="fas fa-bullhorn fa-4x opacity-50 mb-3"></i>
                <h4>Aucune annonce créée</h4>
                <a href="{{ route('entreprise.create') }}" class="btn btn-gradient mt-3"><i class="fas fa-plus"></i> Créer</a>
            </div>
        @endif
    </div>

    <!-- Modal de suppression -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background:var(--glass-bg);backdrop-filter:blur(15px);">
                <div class="modal-header" style="background:var(--danger-gradient);color:white;">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-1"></i> Supprimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-white text-center">
                    Êtes-vous sûr de vouloir supprimer cette annonce ?
                </div>
                <div class="modal-footer justify-content-center">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button class="btn btn-delete" id="confirmDeleteBtn">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let annonceIdToDelete = null;
        document.getElementById('deleteModal').addEventListener('show.bs.modal', function(event){
            annonceIdToDelete = event.relatedTarget.getAttribute('data-annonce-id');
        });
        document.getElementById('confirmDeleteBtn').addEventListener('click', function(){
            if(annonceIdToDelete){
                document.getElementById('delete-form-' + annonceIdToDelete).submit();
            }
        });
    </script>
</body>
</html>
