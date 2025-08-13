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
                    <div class="register-card">
                        <div class="card-header-custom">
                            <div class="welcome-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <h3 class="welcome-title">Rejoignez ReValo !</h3>
                            <p class="welcome-subtitle">Créez votre compte en quelques étapes</p>
                        </div>
                        
                        <div class="card-body-custom">
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                                @csrf
                                
                                <!-- Nom et Prénom -->
                                <div class="form-row">
                                    <div class="form-group-custom half-width">
                                        <label for="prenom" class="form-label-custom">
                                            <i class="fas fa-user input-icon"></i>
                                            Prénom
                                        </label>
                                        <input id="prenom" 
                                               type="text" 
                                               class="form-control-custom @error('prenom') is-invalid @enderror" 
                                               name="prenom" 
                                               value="{{ old('prenom') }}" 
                                               required 
                                               autofocus 
                                               placeholder="Prénom">
                                        @error('prenom')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group-custom half-width">
                                        <label for="nom" class="form-label-custom">
                                            <i class="fas fa-user input-icon"></i>
                                            Nom
                                        </label>
                                        <input id="nom" 
                                               type="text" 
                                               class="form-control-custom @error('nom') is-invalid @enderror" 
                                               name="nom" 
                                               value="{{ old('nom') }}" 
                                               required 
                                               placeholder="Nom">
                                        @error('nom')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
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
                                           autocomplete="username"
                                           placeholder="revalo@example.com">
                                    @error('email')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Téléphone -->
                                <div class="form-group-custom">
                                    <label for="telephone" class="form-label-custom">
                                        <i class="fas fa-phone input-icon"></i>
                                        Téléphone
                                    </label>
                                    <input id="telephone" 
                                           type="tel" 
                                           class="form-control-custom @error('telephone') is-invalid @enderror" 
                                           name="phone" 
                                           value="{{ old('telephone') }}" 
                                           required 
                                           placeholder="+221 XX XXX XX XX">
                                    @error('telephone')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Date de naissance et Genre -->
                                <div class="form-row">
                                    <div class="form-group-custom half-width">
                                        <label for="birth_date" class="form-label-custom">
                                            <i class="fas fa-calendar input-icon"></i>
                                            Date de naissance
                                        </label>
                                        <input id="birth_date" 
                                               type="date" 
                                               class="form-control-custom @error('birth_date') is-invalid @enderror" 
                                               name="birth_date" 
                                               value="{{ old('birth_date') }}" 
                                               required>
                                        @error('birth_date')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group-custom half-width">
                                        <label for="gender" class="form-label-custom">
                                            <i class="fas fa-venus-mars input-icon"></i>
                                            Genre
                                        </label>
                                        <select id="gender" 
                                                class="form-control-custom @error('gender') is-invalid @enderror" 
                                                name="gender" 
                                                required>
                                            <option value="">Sélectionner</option>
                                            <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                                            <option value="femmme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
                                            <option value="autre" {{ old('gender') == 'autre' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        @error('gender')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <!-- Passwords -->
                                <div class="form-row">
                                    <div class="form-group-custom half-width">
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
                                                   autocomplete="new-password"
                                                   placeholder="••••••••">
                                            <button type="button" class="password-toggle" onclick="togglePassword('password', 'toggleIcon1')">
                                                <i class="fas fa-eye" id="toggleIcon1"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <div class="error-message">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group-custom half-width">
                                        <label for="password_confirmation" class="form-label-custom">
                                            <i class="fas fa-lock input-icon"></i>
                                            Confirmer
                                        </label>
                                        <div class="password-input-wrapper">
                                            <input id="password_confirmation" 
                                                   type="password" 
                                                   class="form-control-custom" 
                                                   name="password_confirmation" 
                                                   required 
                                                   autocomplete="new-password"
                                                   placeholder="••••••••">
                                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                                                <i class="fas fa-eye" id="toggleIcon2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Password Strength Indicator -->
                                <div class="password-strength">
                                    <div class="strength-meter">
                                        <div class="strength-meter-fill" id="strengthMeter"></div>
                                    </div>
                                    <div class="strength-text" id="strengthText">Force du mot de passe</div>
                                </div>
                                
                                <!-- Terms and Conditions -->
                                <div class="form-group-custom">
                                    <div class="custom-checkbox-wrapper">
                                        <input type="checkbox" name="terms" class="custom-checkbox-input" id="terms" required>
                                        <label class="custom-checkbox-label" for="terms">
                                            <span class="checkbox-custom"></span>
                                            J'accepte les <a href="#" class="terms-link">conditions d'utilisation</a> et la <a href="#" class="terms-link">politique de confidentialité</a>
                                        </label>
                                    </div>
                                    @error('terms')
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Newsletter -->
                                <div class="form-group-custom">
                                    <div class="custom-checkbox-wrapper">
                                        <input type="checkbox" name="newsletter" class="custom-checkbox-input" id="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                                        <label class="custom-checkbox-label" for="newsletter">
                                            <span class="checkbox-custom"></span>
                                            Je souhaite recevoir des informations sur les nouveautés ReValo
                                        </label>
                                    </div>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="form-group-custom">
                                    <button type="submit" class="btn-register" id="registerBtn">
                                        <span class="btn-text">Créer mon compte</span>
                                        <i class="fas fa-user-plus btn-icon"></i>
                                    </button>
                                </div>
                            </form>
                            
                            <div class="divider">
                                <span>ou</span>
                            </div>
                            
                            <div class="login-link">
                                <p>Vous avez déjà un compte ?</p>
                                <a href="{{ route('login') }}" class="btn-login-link">
                                    <i class="fas fa-sign-in-alt"></i>
                                    Se connecter
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
        --danger-color: #ef4444;
        --warning-color: #f59e0b;
        --success-color: #10b981;
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

    .register-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        box-shadow: var(--shadow-xl);
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
        max-width: 600px;
        margin: 0 auto;
    }

    .register-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    }

    .card-header-custom {
        text-align: center;
        padding: 2.5rem 2rem 1rem;
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

    .form-row {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.75rem;
    }

    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-group-custom.half-width {
        flex: 1;
        margin-bottom: 0;
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
        color: var(--secondary-color);
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
        border-color: var(--secondary-color);
        background: var(--white);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        transform: translateY(-1px);
    }

    .form-control-custom.is-invalid {
        border-color: var(--danger-color);
        background: #fef2f2;
    }

    select.form-control-custom {
        cursor: pointer;
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
        color: var(--secondary-color);
        background: rgba(16, 185, 129, 0.1);
    }

    .password-strength {
        margin-top: 0.5rem;
    }

    .strength-meter {
        height: 4px;
        background: var(--border-light);
        border-radius: 2px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .strength-meter-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 2px;
    }

    .strength-text {
        font-size: 0.75rem;
        color: var(--text-light);
        font-weight: 500;
    }

    .custom-checkbox-wrapper {
        display: flex;
        align-items: flex-start;
        gap: 0.5rem;
    }

    .custom-checkbox-input {
        display: none;
    }

    .custom-checkbox-label {
        display: flex;
        align-items: flex-start;
        font-size: 0.875rem;
        color: var(--text-dark);
        cursor: pointer;
        font-weight: 500;
        line-height: 1.4;
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
        flex-shrink: 0;
        margin-top: 2px;
    }

    .custom-checkbox-input:checked + .custom-checkbox-label .checkbox-custom {
        background: var(--secondary-color);
        border-color: var(--secondary-color);
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

    .terms-link {
        color: var(--secondary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .terms-link:hover {
        text-decoration: underline;
    }

    .btn-register {
        width: 100%;
        padding: 1rem 1.5rem;
        background: linear-gradient(135deg, var(--secondary-color) 0%, #059669 100%);
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

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-register:active {
        transform: translateY(0);
    }

    .btn-register:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .btn-text {
        transition: transform 0.3s ease;
    }

    .btn-icon {
        transition: transform 0.3s ease;
    }

    .btn-register:hover .btn-text {
        transform: translateX(-2px);
    }

    .btn-register:hover .btn-icon {
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

    .login-link {
        text-align: center;
    }

    .login-link p {
        color: var(--text-light);
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .btn-login-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: var(--white);
        color: var(--secondary-color);
        border: 2px solid var(--secondary-color);
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .btn-login-link:hover {
        background: var(--secondary-color);
        color: var(--white);
        transform: translateY(-1px);
        box-shadow: var(--shadow-md);
        text-decoration: none;
    }

    .error-message {
        color: var(--danger-color);
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

        .register-card {
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

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .form-group-custom.half-width {
            margin-bottom: 1.5rem;
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

    .register-card {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Password strength colors */
    .strength-weak { background: var(--danger-color); }
    .strength-fair { background: var(--warning-color); }
    .strength-good { background: var(--primary-color); }
    .strength-strong { background: var(--success-color); }
</style>

<script>
    function togglePassword(inputId, iconId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = document.getElementById(iconId);
        
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

    // Password strength checker
    function checkPasswordStrength(password) {
        let strength = 0;
        let feedback = [];

        if (password.length >= 8) strength++;
        else feedback.push('Au moins 8 caractères');

        if (/[a-z]/.test(password)) strength++;
        else feedback.push('Une minuscule');

        if (/[A-Z]/.test(password)) strength++;
        else feedback.push('Une majuscule');

        if (/[0-9]/.test(password)) strength++;
        else feedback.push('Un chiffre');

        if (/[^A-Za-z0-9]/.test(password)) strength++;
        else feedback.push('Un caractère spécial');

        return { strength, feedback };
    }

    function updatePasswordStrength() {
        const password = document.getElementById('password').value;
        const strengthMeter = document.getElementById('strengthMeter');
        const strengthText = document.getElementById('strengthText');
        
        if (!password) {
            strengthMeter.style.width = '0%';
            strengthMeter.className = 'strength-meter-fill';
            strengthText.textContent = 'Force du mot de passe';
            return;
        }

        const { strength, feedback } = checkPasswordStrength(password);
        const percentage = (strength / 5) * 100;
        
        strengthMeter.style.width = percentage + '%';
        strengthMeter.className = 'strength-meter-fill';
        
        if (strength <= 2) {
            strengthMeter.classList.add('strength-weak');
            strengthText.textContent = 'Faible - ' + feedback.slice(0, 2).join(', ');
        } else if (strength === 3) {
            strengthMeter.classList.add('strength-fair');
            strengthText.textContent = 'Moyen - ' + feedback.slice(0, 1).join(', ');
        } else if (strength === 4) {
            strengthMeter.classList.add('strength-good');
            strengthText.textContent = 'Bon';
        } else {
            strengthMeter.classList.add('strength-strong');
            strengthText.textContent = 'Excellent';
        }
    }

    // Form validation
    function validateForm() {
        const form = document.querySelector('form');
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;
        const terms = document.getElementById('terms').checked;
        const registerBtn = document.getElementById('registerBtn');
        
        let isValid = true;
        
        // Check if passwords match
        if (password && confirmPassword && password !== confirmPassword) {
            isValid = false;
        }
        
        // Check if terms are accepted
        if (!terms) {
            isValid = false;
        }
        
        // Check password strength
        const { strength } = checkPasswordStrength(password);
        if (strength < 3) {
            isValid = false;
        }
        
        registerBtn.disabled = !isValid;
    }

    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.form-control-custom');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const termsCheckbox = document.getElementById('terms');
        
        // Add focus effects
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('focused');
            });
        });
        
        // Password strength checking
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                updatePasswordStrength();
                validateForm();
            });
        }
        
        // Form validation
        if (confirmPasswordInput) {
            confirmPasswordInput.addEventListener('input', validateForm);
        }
        
        if (termsCheckbox) {
            termsCheckbox.addEventListener('change', validateForm);
        }
        
        // Phone number formatting
        const phoneInput = document.getElementById('telephone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.startsWith('221')) {
                    value = value.substring(3);
                }
                if (value.length > 0) {
                    if (value.length <= 2) {
                        value = `+221 ${value}`;
                    } else if (value.length <= 5) {
                        value = `+221 ${value.substring(0, 2)} ${value.substring(2)}`;
                    } else if (value.length <= 7) {
                        value = `+221 ${value.substring(0, 2)} ${value.substring(2, 5)} ${value.substring(5)}`;
                    } else {
                        value = `+221 ${value.substring(0, 2)} ${value.substring(2, 5)} ${value.substring(5, 7)} ${value.substring(7, 9)}`;
                    }
                }
                e.target.value = value;
            });
        }
        
        // Form submission handling
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(e) {
                const registerBtn = document.getElementById('registerBtn');
                if (registerBtn && !registerBtn.disabled) {
                    registerBtn.innerHTML = `
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>Création en cours...</span>
                    `;
                    registerBtn.disabled = true;
                }
            });
        }
        
        // Initial validation
        validateForm();
    });
    
    // Email validation
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
    
    // Real-time email validation
    document.addEventListener('DOMContentLoaded', function() {
        const emailInput = document.getElementById('email');
        if (emailInput) {
            emailInput.addEventListener('blur', function() {
                const email = this.value;
                if (email && !validateEmail(email)) {
                    this.classList.add('is-invalid');
                } else {
                    this.classList.remove('is-invalid');
                }
            });
        }
    });
</script>

@endsection