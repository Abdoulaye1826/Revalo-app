
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ReValo - Réinventer la gestion durable grâce au numérique. Transformons les déchets en ressources durables et bâtissons un avenir meilleur.">
    <meta name="keywords" content="ReValo, gestion durable, innovation numérique, économie circulaire, inclusion sociale, environnement">
    <meta name="author" content="ReValo Team">
    <link rel="icon" href="recyclage.png" type="image/png">
    <title>ReValo - Réinventer la gestion durable grâce au numérique</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            color: white;
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .footer {
            background: #2ECC71;
            color: white;
            text-align: center;
            padding: 1rem 0;
            position: relative;
        }

        .header.scrolled {
            background: rgba(46, 204, 113, 0.95);
            backdrop-filter: blur(10px);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
            font-weight: 400;
        }

        .nav-link:hover {
            color: rgba(255, 255, 255, 0.8);
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
        }

        .nav-link:focus {
            outline: none;
            border-color: #FF2D20;
            box-shadow: 0 0 0 2px rgba(255, 45, 32, 0.2);
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            color: #2ECC71;
        }

        .slogan {
            font-size: 0.9rem;
            font-weight: 300;
            opacity: 0.9;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background-image: url('/bgimage.JPG');
            /* background: linear-gradient(135deg, rgba(46, 204, 113, 0.8), rgba(39, 174, 96, 0.8)),  */
                        /* url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%"><stop offset="0%" style="stop-color:%234CAF50;stop-opacity:0.1" /><stop offset="100%" style="stop-color:%232E7D32;stop-opacity:0.3" /></linearGradient></defs><rect width="1200" height="800" fill="url(%23grad1)"/><circle cx="200" cy="150" r="50" fill="%2366BB6A" opacity="0.3"/><circle cx="800" cy="300" r="80" fill="%234CAF50" opacity="0.2"/><circle cx="1000" cy="600" r="60" fill="%2381C784" opacity="0.4"/><path d="M100,400 Q300,200 500,400 T900,400" stroke="%234CAF50" stroke-width="3" fill="none" opacity="0.6"/></svg>'); */
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-content {
            max-width: 800px;
            padding: 0 2rem;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            font-weight: 300;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }

        .cta-button {
            display: inline-block;
            background: white;
            color: #2ECC71;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            background: #f8f9fa;
        }

        /* Main Content */
        .main-content {
            padding-top: 80px;
        }

        .section {
            padding: 5rem 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* Features Section */
        .features {
            background: #f8f9fa;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #2ECC71;
            margin-bottom: 3rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2.5rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(50px);
        }

        .feature-card.animate {
            opacity: 1;
            transform: translateY(0);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }

        .feature-icon {
            font-size: 3rem;
            color: #2ECC71;
            margin-bottom: 1.5rem;
            display: inline-block;
            animation: bounce 2s infinite;
        }

        .feature-card:nth-child(2) .feature-icon {
            animation-delay: 0.2s;
        }

        .feature-card:nth-child(3) .feature-icon {
            animation-delay: 0.4s;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #333;
        }

        .feature-card p {
            color: #666;
            line-height: 1.7;
        }

        /* Stats Section */
        .stats {
            background: linear-gradient(135deg, #2ECC71, #27AE60);
            color: white;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            text-align: center;
        }

        .stat-card {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.6s ease;
        }

        .stat-card.animate {
            opacity: 1;
            transform: scale(1);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: block;
        }

        .stat-label {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        /* Scroll indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        .scroll-indicator i {
            font-size: 2rem;
            color: white;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-container {
                flex-direction: column;
                padding: 1rem;
                gap: 1rem;
            }

            .nav-links {
                order: -1;
                align-self: flex-end;
            }

            .slogan {
                margin-top: 0.5rem;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .section-title {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .feature-card {
                padding: 2rem;
            }

            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .nav-link {
                padding: 0.4rem 0.8rem;
                font-size: 0.9rem;
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2ECC71;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #27AE60;
        }
    </style>
            <style>
            @media (max-width: 768px) {
                #navToggle {
                    display: block !important;
                }
                .nav-links {
                    position: absolute;
                    top: 100%;
                    right: 0;
                    background: #2ECC71;
                    flex-direction: column;
                    align-items: flex-end;
                    width: 100%;
                    max-width: 260px;
                    box-shadow: 0 8px 24px rgba(46,204,113,0.13);
                    padding: 1rem 1.5rem;
                    gap: 0.7rem;
                    display: none;
                    z-index: 1001;
                }
                .nav-links.open {
                    display: flex !important;
                }
                .nav-container {
                    position: relative;
                }
            }
        </style>
</head>
<body class ="font-sans antialiased">
    <!-- Header -->
    <header class="header" id="header">
        <div class="nav-container">
            <div class="logo">
                <div class="logo-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <div style="font-size: 2rem; line-height: 1.2;">
                    <div>ReValo</div>
                    <div class="slogan">Réinventer la gestion durable grâce au numérique</div>
                </div>
            </div>
            <!-- Hamburger menu for mobile -->
            <button id="navToggle" aria-label="Ouvrir le menu" style="background: none; border: none; color: white; font-size: 2rem; display: none; cursor: pointer;">
                <i class="fas fa-bars"></i>
            </button>
            <div class="nav-links" id="navLinks">
                <a href="#hero" class="nav-link">
                    <i class="fas fa-home"></i> Accueil
                </a>
                <a href="#features" class="nav-link">
                    <i class="fas fa-info-circle"></i> Notre Mission
                </a>
                <a href="#objectifs" class="nav-link">
                    <i class="fas fa-bullseye"></i> Nos Objectifs
                </a>
                <a href="#a-propos" class="nav-link">
                    <i class="fas fa-users"></i> À propos
                </a>
                <a href="#stats" class="nav-link">
                    <i class="fas fa-chart-bar"></i> Nos Impacts
                </a>
                <a href="/login" class="nav-link" style="background: #5ee074dc; color: #fafafaff; font-weight: 700;  box-shadow: 0 2px 8px rgba(20, 28, 23, 0.1); transition: background 0.3s, color 0.3s;">
                    <i class="fas fa-sign-in-alt"></i> Se connecter
                </a>
            </div>
        </div>

    </header>
    <!-- Hero Section -->
    <section class="hero" id="hero" style="position: relative;">
        <div class="hero-content" style="position: relative; z-index: 2;">
            <h1>
                <span style="display: inline-block; background: rgba(255,255,255,0.12); border-radius: 18px; padding: 0.3em 1em;">
                    <i class="fas fa-leaf" style="color: #fff; margin-right: 0.5rem; animation: float 3s ease-in-out infinite;"></i>
                    ReValo
                </span>
            </h1>
            <p style="font-size: 1.3rem; margin-bottom: 2.5rem;">
                <span style="background: rgba(46,204,113,0.13); color: #fff; border-radius: 10px; padding: 0.4em 1em;">
                    Transformons ensemble les défis environnementaux en <span style="font-weight:600; color:#fff;">opportunités durables</span> grâce à l'<span style="color:#ffe082; font-weight:600;">innovation numérique</span>
                </span>
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="#features" class="cta-button" style="display: flex; align-items: center; gap: 0.7em;">
                    <i class="fas fa-rocket"></i> Découvrir notre vision
                </a>
            </div>
        </div>
        <!-- Animated Decorative SVGs -->
        <svg style="position: absolute; top: 10%; left: 5%; z-index:1;" width="80" height="80" viewBox="0 0 80 80" fill="none">
            <circle cx="40" cy="40" r="40" fill="#2ECC71" fill-opacity="0.12"/>
        </svg>
        <svg style="position: absolute; bottom: 10%; right: 8%; z-index:1;" width="60" height="60" viewBox="0 0 60 60" fill="none">
            <ellipse cx="30" cy="30" rx="30" ry="20" fill="#fff" fill-opacity="0.08"/>
        </svg>
        <!-- Scroll Indicator -->
        <div class="scroll-indicator" style="z-index: 3; cursor: pointer;">
            <i class="fas fa-chevron-down"></i>
        </div>
    </section>
    <!-- Main Content -->
    <main class="main-content">
        <!-- Features Section -->
        <section class="section features" id="features">
            <div class="container">
            <h2 class="section-title">Notre Mission</h2>
            <div class="features-grid">
                <div class="feature-card">
                <div class="feature-icon" style="color: #27AE60;">
                    <i class="fas fa-recycle"></i>
                </div>
                <h3 style="color: #27AE60;">Valorisation des déchets</h3>
                <p>Nous transformons les déchets en ressources précieuses grâce à des technologies innovantes, créant une économie circulaire vertueuse qui préserve notre planète.</p>
                </div>
                <div class="feature-card">
                <div class="feature-icon" style="color: #219150;">
                    <i class="fas fa-users"></i>
                </div>
                <h3 style="color: #219150;">Inclusion numérique</h3>
                <p>Notre approche favorise la création d'emplois durables et l'inclusion sociale, en donnant à chacun les outils numériques pour participer à la transition écologique.</p>
                </div>
                <div class="feature-card">
                <div class="feature-icon" style="color: #43B97F;">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 style="color: #43B97F;">Optimisation des ressources</h3>
                <p>Grâce à l'intelligence artificielle et l'analyse de données, nous optimisons l'utilisation des ressources naturelles pour un avenir plus durable.</p>
                </div>
            </div>
            </div>
        </section>
        <section class="section objetifs" id="objectifs">
            <div class="container">
            <h2 class="section-title">Pourquoi ReValo ?</h2>
            <div class="features-grid">
                <div class="feature-card">
                <div class="feature-icon" style="color: #27AE60;">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 style="color: #27AE60;">Innovation durable</h3>
                <p>Nous croyons en une innovation qui respecte l'environnement et améliore la qualité de vie de tous.</p>
                </div>
                <div class="feature-card">
                <div class="feature-icon" style="color: #219150;">
                    <i class="fas fa-globe"></i>
                </div>
                <h3 style="color: #219150;">Impact global</h3>
                <p>Notre vision est de créer un impact positif à l'échelle mondiale, en collaborant avec des partenaires engagés.</p>
                </div>
                <div class="feature-card">
                <div class="feature-icon" style="color: #43B97F;">
                    <i class="fas fa-heart"></i>
                </div>
                <h3 style="color: #43B97F;">Engagement social</h3>
                <p>Nous plaçons l'humain au cœur de notre démarche, en favorisant l'accès à la technologie pour tous.</p>
                </div>
            </div>
            </div>
        </section>
        <section class="section a-propos" id="a-propos" style="background: linear-gradient(135deg, #e8f5e9 60%, #ffffff 100%); position: relative; overflow: hidden;">
            <div class="container" style="position: relative; z-index: 2;">
            <h2 class="section-title" style="margin-bottom: 2rem; color: #27AE60;">
                <i class="fas fa-seedling" style="color: #27AE60; margin-right: 0.5rem;"></i>
                À propos de ReValo
            </h2>
            <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 2rem;">
                <div style="flex: 1 1 300px; min-width: 260px;">
                <p style="font-size: 1.15rem; color: #219150; margin-bottom: 1.2rem;">
                    <span style="background: #2ECC71; color: #fff; border-radius: 8px; padding: 0.2rem 0.7rem; font-weight: 600; margin-right: 0.5rem;">
                    <i class="fas fa-recycle"></i>
                    </span>
                    ReValo est une initiative qui vise à transformer la gestion des déchets en une opportunité durable grâce à l'innovation numérique.
                </p>
                <p style="font-size: 1.15rem; color: #219150;">
                    <span style="background: #27AE60; color: #fff; border-radius: 8px; padding: 0.2rem 0.7rem; font-weight: 600; margin-right: 0.5rem;">
                    <i class="fas fa-leaf"></i>
                    </span>
                    Notre mission est de créer un écosystème où les déchets deviennent des ressources, favorisant ainsi une économie circulaire et durable.
                </p>
                <div style="margin-top: 2rem;">
                    <button id="joinUsBtn" style="background: #27AE60; color: #fff; border: none; border-radius: 30px; padding: 0.8rem 2rem; font-size: 1.1rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 16px rgba(46,204,113,0.15); transition: background 0.2s;">
                    <i class="fas fa-hands-helping"></i> Rejoignez-nous
                    </button>
                </div>
                </div>
                <div style="flex: 1 1 300px; min-width: 260px; text-align: center;">
                <div style="display: inline-block; background: #fff; border-radius: 50%; box-shadow: 0 8px 32px rgba(46,204,113,0.13); padding: 2rem;">
                    <i class="fas fa-globe-europe" style="font-size: 3.5rem; color: #27AE60; animation: float 3s ease-in-out infinite;"></i>
                </div>
                <p style="margin-top: 1.5rem; color: #43B97F; font-style: italic;">
                    "Chaque déchet peut être valorisé, chaque ressource optimisée, chaque individu acteur d'un avenir plus vert."
                </p>
                </div>
            </div>
            </div>
            <!-- Decorative SVG background -->
            <svg style="position: absolute; bottom: -40px; right: -60px; z-index: 1;" width="220" height="120" viewBox="0 0 220 120" fill="none" xmlns="http://www.w3.org/2000/svg">
            <ellipse cx="110" cy="60" rx="110" ry="60" fill="#2ECC71" fill-opacity="0.08"/>
            </svg>
        </section>
        <section class="section" id="comments">
            <div class="container">
            <h2 class="section-title" style="color: #27AE60;">Comment ça marche ?</h2>
            <p style="text-align: center; font-size: 1.15rem; color: #219150; margin-bottom: 2rem;">
                ReValo utilise des technologies avancées pour collecter, trier et valoriser les déchets, transformant ainsi les défis environnementaux en opportunités durables.
            <div class="how-it-works-gallery" style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap; margin-bottom: 2rem;">
                <div class="how-step" style="background: #ddfbd7ff; border-radius: 18px; box-shadow: 0 6px 24px rgba(46,204,113,0.10); padding: 1.2rem 1.2rem 1.8rem 1.2rem; text-align: center; width: 300px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div style="margin-bottom: 1rem;">
                        <img src="/connecte.jpg" alt="Collecte des déchets" style="width: 100%; border-radius: 12px; box-shadow: 0 2px 8px rgba(46,204,113,0.10); transition: transform 0.3s;">
                    </div>
                    <div style="font-size: 2rem; color: #27AE60; margin-bottom: 0.5rem;">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div style="font-weight: 600; color: #27AE60; margin-bottom: 0.3rem;">Mise en relation (Offreurs ↔ Demandeurs)</div>
                    <div style="font-size: 0.98rem; color: #219150;">
                        Mise en relation intelligente entre offreurs et demandeurs de déchets, facilitant la collecte connectée et optimisée pour tous les acteurs (citoyens, entreprises, collectivités).
                    </div>
                </div>
                <div class="how-step" style="background: #ddfbd7ff; border-radius: 18px; box-shadow: 0 6px 24px rgba(46,204,113,0.10); padding: 1.2rem 1.2rem 1.8rem 1.2rem; text-align: center; width: 300px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div style="margin-bottom: 1rem;">
                        <img src="/securite.jpg" alt="Tri des déchets" style="width: 100%; border-radius: 12px; box-shadow: 0 2px 8px rgba(46,204,113,0.10); transition: transform 0.3s;">
                    </div>
                    <div style="font-size: 2rem; color: #43B97F; margin-bottom: 0.5rem;">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div style="font-weight: 600; color: #43B97F; margin-bottom: 0.3rem;">Transaction & Sécurisation</div>
                    <div style="font-size: 0.98rem; color: #219150;">
                        Transactions sécurisées et traçabilité assurée grâce à la technologie numérique, garantissant la transparence et la confiance entre les parties lors de l’échange et du tri des déchets.
                    </div>
                </div>
                <div class="how-step" style="background: #ddfbd7ff; border-radius: 18px; box-shadow: 0 6px 24px rgba(46,204,113,0.10); padding: 1.2rem 1.2rem 1.8rem 1.2rem; text-align: center; width: 300px; transition: transform 0.3s, box-shadow 0.3s;">
                    <div style="margin-bottom: 1rem;">
                        <img src="/logistique.jpg" alt="Valorisation des déchets" style="width: 100%; border-radius: 12px; box-shadow: 0 2px 8px rgba(46,204,113,0.10); transition: transform 0.3s;">
                    </div>
                    <div style="font-size: 2rem; color: #219150; margin-bottom: 0.5rem;">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <div style="font-weight: 600; color: #219150; margin-bottom: 0.3rem;">Logistique & Impact</div>
                    <div style="font-size: 0.98rem; color: #219150;">
                        Gestion logistique intelligente pour optimiser le transport et la valorisation des déchets, avec un suivi d'impact environnemental et social mesurable à chaque étape.
                    </div>
                </div>
            </div>

            </div>
        </section>
        <!-- Call to Action Section -->
        <section class="section cta" id="cta" style="background: linear-gradient(135deg, #e8f5e9 60%, #ffffff 100%); position: relative; overflow: hidden;">      
            <div class="container">
            <h2 class="section-title" style="color: #27AE60; margin-right: 0.5rem;">Rejoignez le mouvement ReValo</h2>
            <p style="font-size: 1.2rem; margin-bottom: 2rem;">
                Ensemble, nous pouvons transformer les déchets en ressources et bâtir un avenir durable pour tous.
            </p>
            <button id="joinUsBtn" style="background: #27AE60; color: #fff; border: none; border-radius: 30px; padding: 0.8rem 2rem; font-size: 1.1rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 16px rgba(46,204,113,0.15); transition: background 0.2s;">
                <i class="fas fa-hands-helping"></i> Rejoignez-nous
            </button>
            </div>
        </section>
            <!-- Stats Section -->
        <section class="section stats" id="stats" style="background: linear-gradient(135deg, #2ECC71, #2ECC71);">
            <div class="container">
            <h2 class="section-title" style="color: #fff;">Impacts Attendu</h2>
            <div class="stats-grid">
                <div class="stat-card">
                <span class="stat-number" data-target="87" style="color: #fff;">0</span>
                <div class="stat-label" style="color: #e8f5e9;">% de réduction des déchets</div>
                </div>
                <div class="stat-card">
                <span class="stat-number" data-target="1250" style="color: #fff;">0</span>
                <div class="stat-label" style="color: #e8f5e9;">Emplois créés</div>
                </div>
                <div class="stat-card">
                <span class="stat-number" data-target="45" style="color: #fff;">0</span>
                <div class="stat-label" style="color: #e8f5e9;">Partenaires engagés</div>
                </div>
                <div class="stat-card">
                <span class="stat-number" data-target="2300" style="color: #fff;">0</span>
                <div class="stat-label" style="color: #e8f5e9;">Tonnes CO² économisées</div>
                </div>
            </div>
            </div>
        </section>
        <!-- Footer Section -->
        <footer class="footer" id="footer">
            <div class="container">
            <p style="margin-bottom: 0.5rem;">&copy; 2025 ReValo. Tous droits réservés.</p>
            <!-- <p style="font-size: 0.9rem; opacity: 0.8;">
                <a href="/privacy-policy" style="color: #fff; text-decoration: underline;">Politique de confidentialité</a> |
                <a href="/terms-of-service" style="color: #fff; text-decoration: underline;">Conditions d'utilisation</a>
            </p> -->
            </div>
        </footer>
        <!-- Back to top button -->
        <a href="#hero" class="back-to-top" style="position: fixed; bottom: 2rem; right: 2rem; background: #27AE60; color: white; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 16px rgba(0,0,0,0.2); text-decoration: none; font-size: 1.5rem; transition: background 0.3s;">
            <i class="fas fa-arrow-up"></i>
        </a>
    </main>
        <!-- Floating scroll indicator -->
        <div class="scroll-indicator" style="position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 1000; cursor: pointer; animation: float 3s ease-in-out infinite;">
            <i class="fas fa-chevron-down" style="font-size: 2rem; color: white;"></i>
        </div>
        
    <script>
        // Mobile nav toggle
        document.addEventListener('DOMContentLoaded', function() {
            const navToggle = document.getElementById('navToggle');
            const navLinks = document.getElementById('navLinks');
            navToggle.addEventListener('click', function() {
                navLinks.classList.toggle('open');
            });
            // Close menu on link click (mobile)
            navLinks.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', () => {
                    if(window.innerWidth <= 768) navLinks.classList.remove('open');
                });
            });
        });
    </script>
    <script>
        // Animation on hover for each step
        document.querySelectorAll('.how-step').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px) scale(1.03)';
                card.style.boxShadow = '0 12px 32px rgba(46,204,113,0.18)';
            });
            card.addEventListener('mouseleave', () => {
                card.style.transform = '';
                card.style.boxShadow = '0 6px 24px rgba(46,204,113,0.10)';
            });
        });

        // Fade-in animation on scroll
        function animateHowSteps() {
            document.querySelectorAll('.how-step').forEach((card, idx) => {
                card.style.opacity = 0;
                card.style.transform = 'translateY(40px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.7s cubic-bezier(.77,0,.18,1)';
                    card.style.opacity = 1;
                    card.style.transform = 'translateY(0)';
                }, 200 + idx * 180);
            });
        }
        window.addEventListener('DOMContentLoaded', animateHowSteps);
    </script>
    <script>
        // Scroll indicator click scrolls to next section
        document.querySelector('.scroll-indicator').addEventListener('click', function() {
            const nextSection = document.querySelector('#features');
            if (nextSection) {
                nextSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });

        // Animate hero text on load
        window.addEventListener('DOMContentLoaded', () => {
            const heroContent = document.querySelector('.hero-content');
            heroContent.style.opacity = 0;
            heroContent.style.transform = 'translateY(40px)';
            setTimeout(() => {
                heroContent.style.transition = 'all 1s cubic-bezier(.77,0,.18,1)';
                heroContent.style.opacity = 1;
                heroContent.style.transform = 'translateY(0)';
            }, 200);
        });
    </script>
    <script>
        // Interactivity for "Rejoignez-nous" button
        document.getElementById('joinUsBtn').addEventListener('click', function() {
            window.location.href = '/register';
        });
    </script>
    <script>
        // Header scroll effect
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                    
                    // Animate counters if it's a stat card
                    if (entry.target.classList.contains('stat-card')) {
                        animateCounter(entry.target);
                    }
                }
            });
        }, observerOptions);

        // Observe feature cards and stat cards
        document.querySelectorAll('.feature-card, .stat-card').forEach(card => {
            observer.observe(card);
        });

        // Counter animation function
        function animateCounter(card) {
            const counter = card.querySelector('.stat-number');
            const target = parseInt(counter.getAttribute('data-target'));
            const duration = 2000; // 2 seconds
            const step = target / (duration / 16); // 60fps
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                counter.textContent = Math.floor(current).toLocaleString();
            }, 16);
        }

        // Add floating animation to scroll indicator
        const scrollIndicator = document.querySelector('.scroll-indicator');
        if (scrollIndicator) {
            scrollIndicator.style.animation = 'float 3s ease-in-out infinite';
        }

        // Parallax effect for hero section
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });

        // Hide scroll indicator when scrolling
        let scrollTimeout;
        window.addEventListener('scroll', () => {
            const indicator = document.querySelector('.scroll-indicator');
            if (indicator && window.scrollY > 100) {
                indicator.style.opacity = '0';
            } else if (indicator) {
                indicator.style.opacity = '1';
            }
        });

        // Add stagger animation to feature cards
        setTimeout(() => {
            const featureCards = document.querySelectorAll('.feature-card');
            featureCards.forEach((card, index) => {
                card.style.transitionDelay = `${index * 0.2}s`;
            });
        }, 100);

        // Add stagger animation to stat cards
        setTimeout(() => {
            const statCards = document.querySelectorAll('.stat-card');
            statCards.forEach((card, index) => {
                card.style.transitionDelay = `${index * 0.2}s`;
                observer.observe(card); // Re-observe to trigger animation
            });
        }, 100);
    </script>
</body>
</html>