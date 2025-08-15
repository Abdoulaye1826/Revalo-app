@extends('auth.layout')

@section('content')

<div class="loader"></div>
<div id="app">
    <section class="section">
        <div id="logo-e-emergency-style">
            <span class="logo-text">ReValo</span>
        </div>
        
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="login-card">
                        <div class="card-header-custom">
                            <div class="welcome-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h3 class="welcome-title">Bon retour !</h3>
                            <p class="welcome-subtitle">Connectez-vous à votre espace ReValo</p>
                        </div>
                        
                        <div class="card-body-custom">
                            <form method="POST" action="{{ route('auth.login') }}" class="needs-validation" novalidate="">
                                @csrf
                                
                                <!-- Email Address -->
                                <div class="form-group-custom">
                                    <label for="email" class="form-label-custom">
                                        <i class="fas fa-envelope input-icon"></i>
                                        Adresse email
                                    </label>
                                    <input id="email" 
                                           type="email" 
                                           class="form-control-custom @error('email') is-invalid @enderror" 
                                           name="email" 
                                           value="{{ old('email') }}" 
                                           required 
                                           autofocus 
                                           autocomplete="username"
                                           placeholder="votre@email.com">
                                    @error('email')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Password -->
                                <div class="form-group-custom">
                                    <label for="password" class="form-label-custom">
                                        <i class="fas fa-lock input-icon"></i>
                                        Mot de passe
                                    </label>
                                    <div class="password-input-wrapper">
                                        <input id="password" 
                                               type="password" 
                                               class="form-control-custom @error('password') is-invalid @enderror" 
                                               name="password" 
                                               required 
                                               autocomplete="current-password"
                                               placeholder="••••••••">
                                        <button type="button" class="password-toggle" onclick="togglePassword()">
                                            <i class="fas fa-eye" id="toggleIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Remember Me & Forgot Password -->
                                <div class="form-options">
                                    <div class="custom-checkbox-wrapper">
                                        <input type="checkbox" name="remember" class="custom-checkbox-input" id="remember-me">
                                        <label class="custom-checkbox-label" for="remember-me">
                                            <span class="checkbox-custom"></span>
                                            Se souvenir de moi
                                        </label>
                                    </div>

                                </div>
                                
                                <!-- Submit Button -->
                                <div class="form-group-custom">
                                    <button type="submit" class="btn-login">
                                        <span class="btn-text">Se connecter</span>
                                        <i class="fas fa-arrow-right btn-icon"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="divider">
                                <span>ou</span>
                            </div>
                            
                            <div class="register-link">
                                <p>Vous n'avez pas de compte ?</p>
                                <a href="{{ route('register') }}" class="btn-register">
                                    Créer un compte
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="footer-text">
                        <p>&copy; {{ date('Y') }} ReValo - Tous droits réservés</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    :root {
        --primary-color: #3b82f6;
        --primary-hover: #2563eb;
        --secondary-color: #10b981;
        --accent-color: #f59e0b;
        --text-dark: #1f2937;
        --text-light: #6b7280;
        --text-lighter: #9ca3af;
        --bg-light: #f9fafb;
        --white: #ffffff;
        --border-light: #e5e7eb;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #84f8a3ff 0%, #8ee29aff 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('../public/asset/img/sante-sau-sl.jpeg') center/cover;
        opacity: 0.1;
        z-index: -1;
    }

    .section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 0;
        position: relative;
    }

    #logo-e-emergency-style {
        position: absolute;
        top: 2rem;
        left: 2rem;
        z-index: 10;
    }

    .logo-text {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--white);
        font-family: 'Inter', sans-serif;
        text-shadow: 0 4px 8px rgba(0,0,0,0.3);
        letter-spacing: -0.025em;
    }

    .logo-accent {
        color: var(--secondary-color);
        font-size: 1.5rem;
        margin-left: 0.25rem;
    }

    .login-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .login-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    }

    .card-header-custom {
        text-align: center;
        padding: 3rem 2rem 1rem;
        background: linear-gradient(135deg, var(--secondary-color) 80%, var(--primary-hover) 20%);
        color: var(--white);
        position: relative;
    }

    .welcome-icon {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.9;
    }

    .welcome-title {
        font-size: 1.875rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .welcome-subtitle {
        font-size: 1rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .card-body-custom {
        padding: 2.5rem;
    }

    .form-group-custom {
        margin-bottom: 1.75rem;
    }

    .form-label-custom {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .input-icon {
        margin-right: 0.5rem;
        color: var(--primary-color);
        width: 16px;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        font-size: 1rem;
        border: 2px solid var(--border-light);
        border-radius: 12px;
        background: var(--bg-light);
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-color);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }

    .form-control-custom.is-invalid {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .password-input-wrapper {
        position: relative;
    }

    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: var(--text-light);
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 6px;
        transition: all 0.2s ease;
    }

    .password-toggle:hover {
        color: var(--primary-color);
        background: rgba(59, 130, 246, 0.1);
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }

    .custom-checkbox-wrapper {
        display: flex;
        align-items: center;
    }

    .custom-checkbox-input {
        display: none;
    }

    .custom-checkbox-label {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
        color: var(--text-dark);
        cursor: pointer;
        font-weight: 500;
    }

    .checkbox-custom {
        width: 18px;
        height: 18px;
        border: 2px solid var(--border-light);
        border-radius: 4px;
        margin-right: 0.5rem;
        position: relative;
        transition: all 0.3s ease;
        background: var(--white);
    }

    .custom-checkbox-input:checked + .custom-checkbox-label .checkbox-custom {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    .custom-checkbox-input:checked + .custom-checkbox-label .checkbox-custom::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: var(--white);
        font-size: 12px;
        font-weight: bold;
    }

    .forgot-password {
        color: var(--primary-color);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .forgot-password:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .btn-login {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
        color: var(--white);
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .btn-text {
        transition: transform 0.3s ease;
    }

    .btn-icon {
        transition: transform 0.3s ease;
    }

    .btn-login:hover .btn-text {
        transform: translateX(-2px);
    }

    .btn-login:hover .btn-icon {
        transform: translateX(2px);
    }

    .divider {
        text-align: center;
        margin: 2rem 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: var(--border-light);
    }

    .divider span {
        background: var(--white);
        padding: 0 1rem;
        color: var(--text-lighter);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .register-link {
        text-align: center;
    }

    .register-link p {
        color: var(--text-light);
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .btn-register {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: var(--white);
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background: var(--primary-color);
        color: var(--white);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
    }

    .error-message {
        color: #ef4444;
        font-size: 0.75rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        font-weight: 500;
    }

    .footer-text {
        text-align: center;
        margin-top: 2rem;
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.875rem;
    }

    .loader {
        display: none;
    }

    @media (max-width: 768px) {
        #logo-e-emergency-style {
            position: static;
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-card {
            margin: 1rem;
            border-radius: 20px;
        }

        .card-header-custom {
            padding: 2rem 1.5rem 1rem;
        }

        .card-body-custom {
            padding: 2rem 1.5rem;
        }

        .welcome-title {
            font-size: 1.5rem;
        }

        .logo-text {
            font-size: 2rem;
        }

        .form-options {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card {
        animation: fadeInUp 0.6s ease-out;
    }
</style>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.getElementById('toggleIcon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }

    // Ajouter des effets d'interaction
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control-custom');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
    });
</script>

@endsection