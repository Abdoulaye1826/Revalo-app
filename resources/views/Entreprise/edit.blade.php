<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ReValo - Réinventer la gestion durable grâce au numérique. Transformons les déchets en ressources durables et bâtissons un avenir meilleur.">
    <meta name="keywords" content="ReValo, gestion durable, innovation numérique, économie circulaire, inclusion sociale, environnement">
    <meta name="author" content="ReValo Team">
    <link rel="icon" href="recyclage.png" type="image/png">
    <title>Modifier l'Annonce - Interface Entreprise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --warning-gradient: linear-gradient(135deg, #ffeaa7 0%, #fab1a0 100%);
            --glass-bg: rgba(255, 255, 255, 0.25);
            --glass-border: rgba(255, 255, 255, 0.18);
            --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
            --shadow-hover: 0 15px 45px rgba(31, 38, 135, 0.5);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
            min-height: 100vh;
            overflow-x: hidden;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .glass-effect {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: var(--shadow-soft);
        }

        .navbar {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: none;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 800;
            letter-spacing: 2px;
            color: white !important;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }

        .btn-logout {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
            transform: translateY(-2px);
        }

        .main-container {
            padding: 50px 20px;
            min-height: calc(100vh - 80px);
        }

        .page-header {
            margin-bottom: 40px;
            opacity: 0;
            animation: slideInDown 1s ease 0.3s forwards;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            text-shadow: 0 5px 20px rgba(0,0,0,0.3);
            margin-bottom: 15px;
        }

        .breadcrumb-modern {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-modern .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .breadcrumb-modern .breadcrumb-item a:hover {
            color: white;
        }

        .breadcrumb-modern .breadcrumb-item.active {
            color: rgba(255, 255, 255, 0.6);
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 40px;
            box-shadow: var(--shadow-soft);
            opacity: 0;
            transform: translateY(50px);
            animation: slideInUp 0.8s ease 0.5s forwards;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            transition: all 0.5s;
            opacity: 0;
        }

        .form-container:hover::before {
            animation: shimmer 2s ease-in-out;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%) translateY(-100%) rotate(45deg);
                opacity: 0;
            }
            50% {
                opacity: 1;
            }
            100% {
                transform: translateX(100%) translateY(100%) rotate(45deg);
                opacity: 0;
            }
        }

        .form-section {
            margin-bottom: 35px;
            padding-bottom: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .form-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }

        .section-title i {
            margin-right: 15px;
            width: 24px;
            text-align: center;
            color: #4facfe;
        }

        .form-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .form-label .required {
            color: #ff6b6b;
            margin-left: 5px;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: white;
            padding: 15px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.25);
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.3);
            color: white;
            transform: translateY(-2px);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-select option {
            background: #1a1a2e;
            color: white;
        }

        .input-group {
            position: relative;
        }

        .input-group-text {
            background: var(--success-gradient);
            border: none;
            color: white;
            font-weight: 600;
            border-radius: 15px 0 0 15px;
            padding: 15px 20px;
        }

        .input-group .form-control {
            border-radius: 0 15px 15px 0;
        }

        .image-upload-area {
            border: 3px dashed rgba(255, 255, 255, 0.4);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .image-upload-area:hover {
            border-color: #4facfe;
            background: rgba(79, 172, 254, 0.1);
            transform: scale(1.02);
        }

        .image-upload-area.dragover {
            border-color: #00f2fe;
            background: rgba(0, 242, 254, 0.2);
            transform: scale(1.05);
        }

        .upload-icon {
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 20px;
        }

        .upload-text {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
            margin-bottom: 10px;
        }

        .current-image {
            max-width: 100%;
            max-height: 200px;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        .btn-gradient {
            background: var(--primary-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 15px 35px;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            position: relative;
            overflow: hidden;
            min-width: 150px;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            color: white;
        }

        .btn-success-modern {
            background: var(--success-gradient);
        }

        .btn-secondary-modern {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .btn-secondary-modern:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        .btn-danger-modern {
            background: var(--danger-gradient);
        }

        .floating-elements {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        .floating-element:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            left: 80%;
            animation-delay: 5s;
        }

        .floating-element:nth-child(3) {
            width: 60px;
            height: 60px;
            top: 80%;
            left: 20%;
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
            75% { transform: translateY(-20px) rotate(270deg); }
        }

        .alert-modern {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 15px;
            color: white;
            padding: 20px;
            margin-bottom: 30px;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-actions {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
        }

        .preview-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 25px;
            margin-top: 20px;
        }

        .preview-title {
            color: white;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .preview-title i {
            margin-right: 10px;
            color: #4facfe;
        }

        .char-counter {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.6);
            text-align: right;
            margin-top: 5px;
        }

        .char-counter.warning {
            color: #ffa726;
        }

        .char-counter.danger {
            color: #ff6b6b;
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 25px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .btn-gradient {
                padding: 12px 25px;
                min-width: 120px;
            }
            
            .main-container {
                padding: 30px 15px;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg glass-effect">
        <div class="container">
            <a class="navbar-brand" href="#">Revalo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="{{ route('entreprise.index') }}">
                            <i class="fas fa-briefcase me-2"></i> Mes annonces
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Modifier l'Annonce</h1>
        </div>
        <div class="form-container">
            @if ($errors->any())
                <div class="alert alert-modern">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('entreprise.update', $annonce->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-info-circle"></i>Détails de l'Annonce</h2>
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre de l'Annonce <span class="required">*</span></label>
                        <input type="text" class="form-control" id="titre" name="titre" value="{{ old('titre', $annonce->titre) }}" maxlength="100" required>
                        <div class="char-counter" id="titreCounter">0 / 100</div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description <span class="required">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" maxlength="1000" required>{{ old('description', $annonce->description) }}</textarea>
                        <div class="char-counter" id="descriptionCounter">0 / 1000</div>
                    </div>
                    <div class="mb-3">
                        <label for="categorie" class="form-label">Catégorie <span class="required">*</span></label>
                        <input type="text" class="form-control" id="categorie" name="categorie" value="{{ old('categorie', $annonce->categorie) }}" maxlength="100" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité <span class="required">*</span></label>
                        <input type="number" class="form-control" id="quantite" name="quantite" value="{{ old('quantite', $annonce->quantite) }}" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="prix" class="form-label">Prix (FCFA) <span class="required">*</span></label>
                        <input type="number" class="form-control" id="prix" name="prix" value="{{ old('prix', $annonce->prix) }}" min="0" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="localisation" class="form-label">Localisation <span class="required">*</span></label>
                        <input type="text" class="form-control" id="localisation" name="localisation" value="{{ old('localisation', $annonce->localisation) }}" maxlength="150" required>
                        <div class="char-counter" id="localisationCounter">0 / 150</div>
                    </div>
                </div>
                <div class="form-section">
                    <h2 class="section-title"><i class="fas fa-image"></i>Image de l'Annonce</h2>
                    <div class="image-upload-area" id="imageUploadArea">
                        @if($annonce->image)
                            <img src="{{ asset('storage/' . $annonce->image) }}" alt="Image Actuelle" class="current-image">
                        @else
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <p class="upload-text">Cliquez ou glissez-déposez pour télécharger une image</p>
                        @endif
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" style="display: none;">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-gradient btn-success-modern">Enregistrer les modifications</button>
                    <a href="{{ route('entreprise.index') }}" class="btn btn-gradient btn-secondary-modern ms-3">Annuler</a>
                </div>
            </form>
    </div>
    <div class="floating-elements">
        <div class="floating-element"></div>
        <div class="floating-element"></div>
        <div class="floating-element"></div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titreInput = document.getElementById('titre');
            const descriptionInput = document.getElementById('description');
            const localisationInput = document.getElementById('localisation');
            const titreCounter = document.getElementById('titreCounter');
            const descriptionCounter = document.getElementById('descriptionCounter');
            const localisationCounter = document.getElementById('localisationCounter');
            const imageUploadArea = document.getElementById('imageUploadArea');
            const imageInput = document.getElementById('image');

            function updateCharCount(input, counter, max) {
                const length = input.value.length;
                counter.textContent = `${length} / ${max}`;
                if (length > max * 0.8) {
                    counter.classList.add('danger');
                    counter.classList.remove('warning');
                } else if (length > max * 0.5) {
                    counter.classList.add('warning');
                    counter.classList.remove('danger');
                } else {
                    counter.classList.remove('warning', 'danger');
                }
            }

            titreInput.addEventListener('input', () => updateCharCount(titreInput, titreCounter, 100));
            descriptionInput.addEventListener('input', () => updateCharCount(descriptionInput, descriptionCounter, 1000));
            localisationInput.addEventListener('input', () => updateCharCount(localisationInput, localisationCounter, 150));

            // Initial count update
            updateCharCount(titreInput, titreCounter, 100);
            updateCharCount(descriptionInput, descriptionCounter, 1000);
            updateCharCount(localisationInput, localisationCounter, 150);

            // Image upload area events
            imageUploadArea.addEventListener('click', () => imageInput.click());

            imageUploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                imageUploadArea.classList.add('dragover');
            });

            imageUploadArea.addEventListener('dragleave', () => {
                imageUploadArea.classList.remove('dragover');
            });

            imageUploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                imageUploadArea.classList.remove('dragover');
                const files = e.dataTransfer.files;
                if (files.length > 0) {
                    imageInput.files = files;
                }   
            });
        });
    </script>
</body>
</html>