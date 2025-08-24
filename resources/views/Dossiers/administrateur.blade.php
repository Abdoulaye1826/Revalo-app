<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #84f8a3ff 0%, #8ee29aff 100%);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            padding: 2rem 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 0 2rem 2rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .sidebar-header h2 {
            color: #333;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: block;
            padding: 1rem 2rem;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .menu-item:hover,
        .menu-item.active {
            background: rgba(102, 126, 234, 0.1);
            border-left-color: #667eea;
            color: #667eea;
        }

        .menu-item i {
            width: 20px;
            margin-right: 0.5rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 280px;
            padding: 2rem;
        }

        .top-bar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: between;
            align-items: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            flex: 1;
        }

        .welcome-text h1 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .welcome-text p {
            color: #666;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logout-btn {
            background: #ff6b6b;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .logout-btn:hover {
            background: #ff5252;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-icon.users { background: linear-gradient(45deg, #667eea, #764ba2); }
        .stat-icon.companies { background: linear-gradient(45deg, #f093fb, #f5576c); }
        .stat-icon.buyers { background: linear-gradient(45deg, #4facfe, #00f2fe); }
        .stat-icon.orders { background: linear-gradient(45deg, #43e97b, #38f9d7); }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 0.9rem;
        }

        /* Content Sections */
        .content-section {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #333;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5a6fd8;
        }

        .btn-danger {
            background: #ff6b6b;
            color: white;
        }

        .btn-danger:hover {
            background: #ff5252;
        }

        /* Table Styles */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        .data-table th,
        .data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .data-table th {
            background: rgba(102, 126, 234, 0.1);
            color: #333;
            font-weight: 600;
        }

        .data-table tr:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .status-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-active {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-inactive {
            background: #f8d7da;
            color: #721c24;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
        }

        .modal-content {
            background: white;
            margin: 50px auto;
            padding: 2rem;
            border-radius: 15px;
            width: 90%;
            max-width: 500px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .top-bar {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-cog"></i>ReValo Administration</h2>
            </div>
            <nav class="sidebar-menu">
                <a href="#" class="menu-item active" data-section="dashboard">
                    <i class="fas fa-tachometer-alt"></i> Tableau de bord
                </a>
                <a href="#" class="menu-item" data-section="users">
                    <i class="fas fa-users"></i> Utilisateurs
                </a>
                <a href="#" class="menu-item" data-section="companies">
                    <i class="fas fa-building"></i> Entreprises
                </a>
                <a href="#" class="menu-item" data-section="buyers">
                    <i class="fas fa-shopping-cart"></i> Acheteurs
                </a>
                <a href="#" class="menu-item" data-section="orders">
                    <i class="fas fa-clipboard-list"></i> Commandes
                </a>
                <a href="#" class="menu-item" data-section="settings">
                    <i class="fas fa-cog"></i> Paramètres
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="welcome-text">
                    <h1>Bienvenue, Administrateur</h1>
                    <p>Gérez votre plateforme depuis ce tableau de bord</p>
                </div>
                <div class="user-info">
                    <span>Admin</span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        <button type="submit" class="logout-btn">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </button>
                    </form>
                </div>
            </div>
            <!-- Stats Cards -->
            <div class="stats-grid
">
                <div class="stat-card">
                    <div class="stat-icon users"><i class="fas fa-users"></i></div>
                    <div class="stat-number">150</div>
                    <div class="stat-label">Utilisateurs</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon companies"><i class="fas fa-building"></i></div>
                    <div class="stat-number">50</div>
                    <div class="stat-label">Entreprises</div>
                </div>  
                <div class="stat-card">
                    <div class="stat-icon buyers"><i class="fas fa-shopping-cart"></i></div>
                    <div class="stat-number">200</div>
                    <div class="stat-label">Acheteurs</div>
                </div>  
                <div class="stat-card">
                    <div class="stat-icon orders"><i class="fas fa-clipboard-list"></i></div>
                    <div class="stat-number">75</div>
                    <div class="stat-label">Commandes</div>
                </div>
            </div>  
            <!-- Content Sections -->
            <div id="dashboard-section" class="content-section">
                <div class="section-header">
                    <h2 class="section-title"><i class="fas fa-tachometer-alt"></i> Tableau de bord</h2>
                </div>
                <p>Bienvenue sur votre tableau de bord. Ici, vous pouvez voir les statistiques clés et gérer les utilisateurs, entreprises et commandes.</p>
            </div>   

        </main>
    </div>

    <!-- User Modal -->
    <div id="userModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Nouvel Utilisateur</h3>
                <button class="close" onclick="closeModal('userModal')">&times;</button>
            </div>
            <form>
                <div class="form-group">
                    <label>Prénom</label>
                    <input type="text" required />
                </div>
                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" required />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" required />
                </div>
                <div class="form-group">
                    <label>Type d'utilisateur</label>
                    <select required>
                        <option value="">Sélectionner</option>
                        <option value="admin">Administrateur</option>
                        <option value="entreprise">Entreprise</option>
                        <option value="acheteur">Acheteur</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" required />
                </div>
                <button type="submit" class="btn btn-primary">Créer l'utilisateur</button>
            </form>
        </div>
    </div>

    <script>
        // Navigation
        document.querySelectorAll('.menu-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all menu items
                document.querySelectorAll('.menu-item').forEach(i => i.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all sections
                document.querySelectorAll('.content-wrapper').forEach(section => {
                    section.style.display = 'none';
                });
                
                // Show selected section
                const sectionName = this.getAttribute('data-section');
                const section = document.getElementById(sectionName + '-section');
                if (section) {
                    section.style.display = 'block';
                }
            });
        });

        // Modal functions
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }

        // User management functions
        function editUser(userId) {
            alert('Modifier l\'utilisateur ID: ' + userId);
            // Implement edit functionality
        }

        function deleteUser(userId) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                alert('Utilisateur ' + userId + ' supprimé');
                // Implement delete functionality
            }
        }

        // Animate numbers on page load
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const target = parseInt(number.textContent);
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.textContent = Math.floor(current);
                }, 30);
            });
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            animateNumbers();
        });
    </script>
</body>
</html>