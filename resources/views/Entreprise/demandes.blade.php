<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demandes d'achat reçues</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --info-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* Navigation moderne */
        .modern-nav {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        /* Cartes de statistiques glassmorphism */
        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--primary-gradient);
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
        }

        .glass-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .glass-card:hover::before {
            opacity: 1;
        }

        .glass-card:hover .card-content {
            color: white !important;
        }

        .glass-card.warning::before {
            background: var(--warning-gradient);
        }

        .glass-card.success::before {
            background: var(--success-gradient);
        }

        .glass-card.danger::before {
            background: var(--danger-gradient);
        }

        .glass-card.info::before {
            background: var(--info-gradient);
        }

        .card-content {
            position: relative;
            z-index: 1;
            transition: color 0.3s ease;
        }

        /* Titre principal */
        .main-title {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        /* Tableau moderne */
        .modern-table-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .modern-table {
            margin: 0;
            background: transparent;
        }

        .modern-table thead {
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
        }

        .modern-table thead th {
            border: none;
            font-weight: 600;
            color: #4a5568;
            padding: 1.5rem 1rem;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 1px;
        }

        .modern-table tbody tr {
            border: none;
            transition: all 0.3s ease;
        }

        .modern-table tbody tr:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: scale(1.01);
        }

        .modern-table tbody td {
            border: none;
            padding: 1.5rem 1rem;
            vertical-align: middle;
        }

        /* Badges modernes */
        .modern-badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .modern-badge.status-pending {
            background: var(--warning-gradient);
            color: white;
            animation: pulse-warning 2s infinite;
        }

        .modern-badge.status-accepted {
            background: var(--success-gradient);
            color: white;
        }

        .modern-badge.status-refused {
            background: var(--danger-gradient);
            color: white;
        }

        .modern-badge.status-processed {
            background: var(--info-gradient);
            color: white;
        }

        @keyframes pulse-warning {
            0%, 100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.7); }
            50% { box-shadow: 0 0 20px 5px rgba(249, 115, 22, 0); }
        }

        /* Boutons modernes */
        .modern-btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .modern-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .modern-btn:hover::before {
            left: 100%;
        }

        .modern-btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .modern-btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
        }

        .modern-btn-success {
            background: var(--success-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
        }

        .modern-btn-danger {
            background: var(--danger-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(250, 112, 154, 0.4);
        }

        .modern-btn-info {
            background: var(--info-gradient);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }

        /* Image produit */
        .product-image {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-image:hover {
            transform: scale(1.1);
        }

        /* Filtres modernes */
        .filter-pills {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .filter-pill {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 0.5rem 1rem;
            color: #4a5568;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .filter-pill:hover, .filter-pill.active {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        /* Modal moderne */
        .modern-modal .modal-content {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .modern-modal .modal-header {
            background: var(--primary-gradient);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
        }

        /* Animations */
        .fade-in {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stagger-animation {
            animation-delay: 0.1s;
        }

        .stagger-animation:nth-child(2) { animation-delay: 0.2s; }
        .stagger-animation:nth-child(3) { animation-delay: 0.3s; }
        .stagger-animation:nth-child(4) { animation-delay: 0.4s; }

        /* Loader moderne */
        .modern-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            backdrop-filter: blur(5px);
        }

        .loader-spinner {
            width: 60px;
            height: 60px;
            border: 4px solid rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            border-top-color: #667eea;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2rem;
            }
            
            .glass-card {
                margin-bottom: 1rem;
            }
            
            .filter-pills {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation moderne -->
    <nav class="navbar navbar-expand-lg modern-nav">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('entreprise.index') }}">
                <i class="fas fa-building me-2"></i> 
                <span style="background: var(--primary-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Interface Entreprise</span>
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link modern-btn modern-btn-primary" href="{{ route('entreprise.index') }}">
                    <i class="fas fa-arrow-left me-2"></i> Retour aux annonces
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <!-- En-tête principal -->
        <div class="text-center mb-5 fade-in">
            <h1 class="main-title">
                <i class="fas fa-envelope-open me-3"></i>
                Demandes d'Achat Reçues
            </h1>
            <p class="text-muted fs-5">Gérez vos demandes d'achat en toute simplicité</p>
        </div>

        <!-- Messages de succès/erreur -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show modern-btn" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Statistiques modernes -->
        <div class="row mb-5 g-4">
            <div class="col-6 col-md-3 fade-in stagger-animation">
                <div class="glass-card warning" onclick="filterStatut('en_attente')">
                    <div class="card-body text-center p-4 card-content">
                        <div class="mb-3">
                            <i class="fas fa-clock fa-3x"></i>
                        </div>
                        <h2 class="fw-bold mb-2">{{ $demandes->where('statut', 'en_attente')->count() }}</h2>
                        <p class="mb-0 text-uppercase fw-semibold">En Attente</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in stagger-animation">
                <div class="glass-card success" onclick="filterStatut('accepte')">
                    <div class="card-body text-center p-4 card-content">
                        <div class="mb-3">
                            <i class="fas fa-check fa-3x"></i>
                        </div>
                        <h2 class="fw-bold mb-2">{{ $demandes->where('statut', 'accepte')->count() }}</h2>
                        <p class="mb-0 text-uppercase fw-semibold">Acceptées</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in stagger-animation">
                <div class="glass-card danger" onclick="filterStatut('refuse')">
                    <div class="card-body text-center p-4 card-content">
                        <div class="mb-3">
                            <i class="fas fa-times fa-3x"></i>
                        </div>
                        <h2 class="fw-bold mb-2">{{ $demandes->where('statut', 'refuse')->count() }}</h2>
                        <p class="mb-0 text-uppercase fw-semibold">Refusées</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3 fade-in stagger-animation">
                <div class="glass-card info" onclick="filterStatut('traite')">
                    <div class="card-body text-center p-4 card-content">
                        <div class="mb-3">
                            <i class="fas fa-check-double fa-3x"></i>
                        </div>
                        <h2 class="fw-bold mb-2">{{ $demandes->where('statut', 'traite')->count() }}</h2>
                        <p class="mb-0 text-uppercase fw-semibold">Traitées</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtres modernes -->
        <div class="filter-pills mb-4 fade-in">
            <span class="filter-pill active" onclick="filterStatut('all')">
                <i class="fas fa-list me-2"></i>Toutes
            </span>
            <span class="filter-pill" onclick="filterStatut('en_attente')">
                <i class="fas fa-clock me-2"></i>En Attente
            </span>
            <span class="filter-pill" onclick="filterStatut('accepte')">
                <i class="fas fa-check me-2"></i>Acceptées
            </span>
            <span class="filter-pill" onclick="filterStatut('refuse')">
                <i class="fas fa-times me-2"></i>Refusées
            </span>
            <span class="filter-pill" onclick="filterStatut('traite')">
                <i class="fas fa-check-double me-2"></i>Traitées
            </span>
        </div>

        <!-- Tableau moderne des demandes -->
        <div class="modern-table-container fade-in">
            <div class="table-responsive">
                <table class="table modern-table" id="demandesTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-calendar me-2"></i>Date</th>
                            <th><i class="fas fa-box me-2"></i>Produit</th>
                            <th><i class="fas fa-user me-2"></i>Acheteur</th>
                            <th><i class="fas fa-phone me-2"></i>Contact</th>
                            <th><i class="fas fa-hashtag me-2"></i>Quantité</th>
                            <th><i class="fas fa-flag me-4"></i>Statut</th>
                            <th><i class="fas fa-cog me-2"></i>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($demandes as $demande)
                            <tr data-id="{{ $demande->id }}" data-statut="{{ $demande->statut }}">
                                <!-- Date de création -->
                                <td>{{ $demande->created_at->format('d/m/Y H:i') }}</td> 

                                <!-- Produit -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ optional($demande->produit)->image_url ?? asset('images/default.png') }}" 
                                            alt="{{ optional($demande->produit)->nom ?? 'Produit' }}" 
                                            class="product-image me-3"
                                            style="width:50px;height:50px;object-fit:cover;border-radius:8px;">
                                        <div>
                                            <strong>{{ optional($demande->produit)->nom ?? 'Produit inconnu' }}</strong><br>
                                            <span class="text-muted">
                                                {{ optional($demande->produit)->prix 
                                                    ? number_format($demande->produit->prix, 0, ',', ' ') . ' FCFA' 
                                                    : 'Prix non disponible' }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Acheteur -->
                                <td>{{ $demande->nom_acheteur }}</td>
                                <td>
                                    {{ $demande->email_acheteur }}<br>
                                    {{ $demande->telephone_acheteur }}
                                </td>

                                <!-- Quantité -->
                                <td>{{ $demande->quantite_demandee }}</td>

                                <!-- Statut -->
                                <td>
                                    @php
                                        switch($demande->statut) {
                                            case 'en_attente':
                                                $statusClass = 'status-pending';
                                                $statusText = 'En Attente';
                                                break;
                                            case 'accepte':
                                                $statusClass = 'status-accepted';
                                                $statusText = 'Acceptée';
                                                break;
                                            case 'refuse':
                                                $statusClass = 'status-refused';
                                                $statusText = 'Refusée';
                                                break;
                                            case 'traite':
                                                $statusClass = 'status-processed';
                                                $statusText = 'Traitée';
                                                break;
                                            default:
                                                $statusClass = 'status-pending';
                                                $statusText = 'En Attente';
                                        }
                                    @endphp
                                    <span class="modern-badge {{ $statusClass }}">{{ $statusText }}</span>
                                </td>

                                <!-- Actions -->
                                <td>
                                    <button class="btn modern-btn modern-btn-info" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#demandeModal{{ $demande->id }}">
                                        <i class="fas fa-eye me-2"></i>
                                    </button>   

                                    @if($demande->statut == 'en_attente')
                                        <button class="btn modern-btn modern-btn-success" 
                                                onclick="updateStatus({{ $demande->id }}, 'accepte')">
                                            <i class="fas fa-check me-2"></i>
                                        </button>   
                                        <button class="btn modern-btn modern-btn-danger" 
                                                onclick="updateStatus({{ $demande->id }}, 'refuse')">
                                            <i class="fas fa-times me-2"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Loader moderne -->
    <div id="loader" class="modern-loader">
        <div class="loader-spinner"></div>
    </div>

    <!-- Ajout du meta token CSRF pour JavaScript -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Loader lors des actions
        document.querySelectorAll('.action-form').forEach(form => {
            form.addEventListener('submit', function() {
                document.getElementById('loader').style.display = 'flex';
            });
        });

        // Mise à jour du statut avec animation
        function updateStatus(id, statut) {
            // Afficher le loader
            document.getElementById('loader').style.display = 'flex';
            
            // Créer le formulaire et l'envoyer
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/entreprise/demandes/${id}/statut`;
            form.style.display = 'none';
            
            // Token CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfToken);
            
            // Method PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            
            // Statut
            const statutInput = document.createElement('input');
            statutInput.type = 'hidden';
            statutInput.name = 'statut';
            statutInput.value = statut;
            form.appendChild(statutInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        // Filtrage dynamique par statut
        function filterStatut(statut) {
            // Mise à jour des pills actives
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filtrage des lignes
            let rows = document.querySelectorAll('#demandesTable tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    if (statut === 'all' || row.getAttribute('data-statut') === statut) {
                        row.style.display = '';
                        row.style.animation = 'fadeInUp 0.3s ease-out';
                    } else {
                        row.style.display = 'none';
                    }
                }, index * 50);
            });
        }

        // Système de toast notifications
        function showToast(message, type = 'info') {
            // Créer le toast
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Styles du toast
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success-gradient)' : 'var(--info-gradient)'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.3);
                z-index: 10000;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            document.body.appendChild(toast);
            
            // Animation d'entrée
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Animation de sortie et suppression
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(toast)) {
                        document.body.removeChild(toast);
                    }
                }, 300);
            }, 3000);
        }

        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments au chargement
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animation des lignes du tableau
            const rows = document.querySelectorAll('#demandesTable tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.4s ease-out';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 800 + index * 100);
            });
        });

        // Gestion des clics sur les cartes statistiques
        document.addEventListener('click', function(e) {
            if (e.target.closest('.glass-card')) {
                const card = e.target.closest('.glass-card');
                card.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    card.style.transform = '';
                }, 150);
            }
        });

        // Effet de parallaxe subtle sur les cartes
        document.addEventListener('mousemove', function(e) {
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                const rotateX = (y / rect.height) * 10;
                const rotateY = (x / rect.width) * -10;
                
                if (rect.left <= e.clientX && e.clientX <= rect.right && 
                    rect.top <= e.clientY && e.clientY <= rect.bottom) {
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(20px)`;
                } else {
                    card.style.transform = '';
                }
            });
        });000 FCFA</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="glass-card p-4 mb-3">
                                <h6 class="fw-bold mb-3">
                                    <i class="fas fa-user text-info me-2"></i>Informations Acheteur
                                </h6>
                                <div class="mb-2"><strong>Nom:</strong> Jean Dupont</div>
                                <div class="mb-2"><strong>Email:</strong> jean.dupont@email.com</div>
                                <div class="mb-2"><strong>Téléphone:</strong> +221 77 123 45 67</div>
                                <div class="mb-2"><strong>Date:</strong> 23/08/2025 à 14:30</div>
                            </div>
                        </div>
                    </div>
                    <div class="glass-card p-4">
                        <h6 class="fw-bold mb-3">
                            <i class="fas fa-comment text-warning me-2"></i>Message de l'Acheteur
                        </h6>
                        <p class="mb-0">Bonjour, je suis très intéressé par ce MacBook Pro M3. Pourriez-vous me confirmer sa disponibilité ? Merci.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn modern-btn modern-btn-success" onclick="updateStatus(1, 'accepte')">
                        <i class="fas fa-check me-2"></i>Accepter
                    </button>
                    <button class="btn modern-btn modern-btn-danger" onclick="updateStatus(1, 'refuse')">
                        <i class="fas fa-times me-2"></i>Refuser
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loader moderne -->
    <div id="loader" class="modern-loader">
        <div class="loader-spinner"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filtrage dynamique par statut
        function filterStatut(statut) {
            // Mise à jour des pills actives
            document.querySelectorAll('.filter-pill').forEach(pill => {
                pill.classList.remove('active');
            });
            event.target.classList.add('active');

            // Filtrage des lignes
            let rows = document.querySelectorAll('#demandesTable tbody tr');
            rows.forEach((row, index) => {
                setTimeout(() => {
                    if (statut === 'all' || row.getAttribute('data-statut') === statut) {
                        row.style.display = '';
                        row.style.animation = 'fadeInUp 0.3s ease-out';
                    } else {
                        row.style.display = 'none';
                    }
                }, index * 50);
            });
        }

        // Mise à jour du statut avec animation
        function updateStatus(id, statut) {
            // Afficher le loader
            document.getElementById('loader').style.display = 'flex';
            
            // Créer le formulaire et l'envoyer
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/entreprise/demandes/${id}/statut`;
            form.style.display = 'none';
            
            // Token CSRF
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            form.appendChild(csrfToken);
            
            // Method PUT
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            form.appendChild(methodInput);
            
            // Statut
            const statutInput = document.createElement('input');
            statutInput.type = 'hidden';
            statutInput.name = 'statut';
            statutInput.value = statut;
            form.appendChild(statutInput);
            
            document.body.appendChild(form);
            form.submit();
        }

        // Mettre à jour visuellement une ligne du tableau
        function updateRowStatus(id, statut) {
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                const statusCell = row.querySelector('.modern-badge');
                const actionsCell = row.querySelector('td:last-child');
                
                // Mise à jour du badge de statut
                statusCell.className = `modern-badge status-${statut}`;
                switch(statut) {
                    case 'accepte':
                        statusCell.textContent = 'Acceptée';
                        statusCell.className = 'modern-badge status-accepted';
                        break;
                    case 'refuse':
                        statusCell.textContent = 'Refusée';
                        statusCell.className = 'modern-badge status-refused';
                        break;
                    case 'traite':
                        statusCell.textContent = 'Traitée';
                        statusCell.className = 'modern-badge status-processed';
                        break;
                }
                
                // Mise à jour de l'attribut data-statut
                row.setAttribute('data-statut', statut);
                
                // Animation de mise à jour
                row.style.animation = 'fadeInUp 0.5s ease-out';
            }
        }

        // Système de toast notifications
        function showToast(message, type = 'info') {
            // Créer le toast
            const toast = document.createElement('div');
            toast.className = `toast-notification toast-${type}`;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            // Styles du toast
            toast.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? 'var(--success-gradient)' : 'var(--info-gradient)'};
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.3);
                z-index: 10000;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            `;
            
            document.body.appendChild(toast);
            
            // Animation d'entrée
            setTimeout(() => {
                toast.style.transform = 'translateX(0)';
            }, 100);
            
            // Animation de sortie et suppression
            setTimeout(() => {
                toast.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Animation au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            // Animation des éléments au chargement
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((el, index) => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                setTimeout(() => {
                    el.style.transition = 'all 0.6s ease-out';
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';
                }, index * 100);
            });

            // Animation des lignes du tableau
            const rows = document.querySelectorAll('#demandesTable tbody tr');
            rows.forEach((row, index) => {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-20px)';
                setTimeout(() => {
                    row.style.transition = 'all 0.4s ease-out';
                    row.style.opacity = '1';
                    row.style.transform = 'translateX(0)';
                }, 800 + index * 100);
            });
        });

        // Gestion des clics sur les cartes statistiques
        document.addEventListener('click', function(e) {
            if (e.target.closest('.glass-card')) {
                const card = e.target.closest('.glass-card');
                card.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    card.style.transform = '';
                }, 150);
            }
        });

        // Effet de parallaxe subtle sur les cartes
        document.addEventListener('mousemove', function(e) {
            const cards = document.querySelectorAll('.glass-card');
            cards.forEach(card => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                const rotateX = (y / rect.height) * 10;
                const rotateY = (x / rect.width) * -10;
                
                if (rect.left <= e.clientX && e.clientX <= rect.right && 
                    rect.top <= e.clientY && e.clientY <= rect.bottom) {
                    card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateZ(20px)`;
                } else {
                    card.style.transform = '';
                }
            });
        });

        // Recherche en temps réel (optionnel)
        function addSearchFunctionality() {
            const searchInput = document.createElement('input');
            searchInput.type = 'text';
            searchInput.className = 'form-control mb-3';
            searchInput.placeholder = 'Rechercher par nom, email ou produit...';
            searchInput.style.cssText = `
                background: var(--glass-bg);
                backdrop-filter: blur(10px);
                border: 1px solid var(--glass-border);
                border-radius: 12px;
                padding: 1rem;
            `;
            
            const tableContainer = document.querySelector('.modern-table-container');
            tableContainer.parentNode.insertBefore(searchInput, tableContainer);
            
            searchInput.addEventListener('input', function(e) {
                const searchTerm = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#demandesTable tbody tr');
                
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }

        // Activer la recherche (décommentez si nécessaire)
        // addSearchFunctionality();
    </script>

    <!-- Styles CSS supplémentaires pour les animations -->
    <style>
        /* Toast notifications */
        .toast-notification {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Effet de typing pour le titre principal */
        .main-title {
            overflow: hidden;
            white-space: nowrap;
            animation: typing 2s steps(20, end), blink-caret 0.75s step-end infinite;
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: #667eea; }
        }

        /* Effet de vague sur les boutons */
        .modern-btn {
            position: relative;
            overflow: hidden;
        }

        .modern-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s, height 0.3s;
        }

        .modern-btn:active::after {
            width: 200px;
            height: 200px;
        }

        /* Animation de rotation pour les icônes au hover */
        .modern-btn:hover i {
            animation: rotateIcon 0.3s ease;
        }

        @keyframes rotateIcon {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(180deg) scale(1.2); }
            100% { transform: rotate(360deg); }
        }

        /* Effet de glow sur les éléments actifs */
        .filter-pill.active,
        .glass-card:hover {
            box-shadow: 0 0 30px rgba(102, 126, 234, 0.4);
        }

        /* Animation de bounce pour les statistiques */
        .glass-card:hover .card-content h2 {
            animation: bounce 0.6s ease;
        }

        @keyframes bounce {
            0%, 20%, 60%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            80% { transform: translateY(-5px); }
        }

        /* Effet de gradient animé sur les badges en attente */
        .status-pending {
            background: linear-gradient(45deg, #f093fb, #f5576c, #4facfe, #00f2fe);
            background-size: 400% 400%;
            animation: gradientShift 3s ease infinite;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Responsive amélioré */
        @media (max-width: 768px) {
            .d-flex.gap-2 {
                flex-direction: column;
                gap: 0.5rem !important;
            }
            
            .modern-btn {
                width: 100%;
                justify-content: center;
            }
            
            .product-image {
                width: 40px;
                height: 40px;
            }
            
            .modern-table tbody td {
                padding: 1rem 0.5rem;
                font-size: 0.875rem;
            }
        }

        /* Mode sombre (optionnel) */
        @media (prefers-color-scheme: dark) {
            body {
                background: linear-gradient(135deg, #1a202c 0%, #2d3748 100%);
                color: #e2e8f0;
            }
            
            .modern-table tbody tr:hover {
                background: rgba(102, 126, 234, 0.1);
            }
            
            .text-dark {
                color: #e2e8f0 !important;
            }
            
            .text-muted {
                color: #a0aec0 !important;
            }
        }
    </style>
</body>
</html>