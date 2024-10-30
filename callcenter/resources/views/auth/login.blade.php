<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Caei Call center</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <!-- Styles -->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- Scripts -->
    <script>var hostUrl = "{{ asset('assets/') }}";</script>

    <style>
        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden;
            background-color: #f0f0f0; /* Couleur de fond au cas où la vidéo ne couvre pas tout */
        }
        .video-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        .video-background {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            object-fit: contain; /* Cela garantit que toute la vidéo est visible */
        }
        .content-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 1;
        }
        .login-form-container {
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 20px;
            max-width: 500px;
            width: 90%;
        }
        .logo-container {
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 1000;
            animation: moveLogoUp 1.5s ease-out forwards;
        }
        .logo-container img {
            max-width: 350px;
            height: auto;
            transition: transform 0.3s ease;
        }

        @keyframes moveLogoUp {
            from {
                top: 20px;
            }
            to {
                top: -50px; /* Augmenté de -20px à -50px */
            }
        }

        .btn-custom-login {
            background-color: #720512 !important;

            border-color: #720512 !important;
        }
        .btn-custom-login:hover {
            background-color: #5a040e !important;
            border-color: #5a040e !important;
        }
    </style>
</head>
<body id="kt_body" class="app-blank">


    <div class="video-container">
        <video autoplay muted loop class="video-background">
            <source src="{{ asset('assets/media/logos/call5.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="content-wrapper">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('assets/media/logos/logo1.png') }}" alt="Logo">
        </div>

        <div class="login-form-container">
            <form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form">
                @csrf

                <!-- Email Address -->
                <div class="fv-row mb-10">
                    <label for="email" class="form-label fs-6 fw-bold text-dark">{{ __('Email') }}</label>
                    <input id="email" class="form-control form-control-lg form-control-solid" type="email" name="email" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="fv-row mb-10">
                    <div class="d-flex flex-stack mb-2">
                        <label for="password" class="form-label fw-bold text-dark fs-6 mb-0">{{ __('Mot de passe') }}</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bold">{{ __('Forgot Password ?') }}</a>
                        @endif
                    </div>
                    <input id="password" class="form-control form-control-lg form-control-solid" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="fv-row mb-10">
                    <label for="remember_me" class="form-check form-check-custom form-check-solid">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <span class="form-check-label fw-semibold text-gray-700 fs-6">{{ __('Souviens-toi de moi') }}</span>
                    </label>
                </div>

                <div class="text-center">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5 btn-custom-login">
                        <span class="indicator-label">{{ __('Se Connecter') }}</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script> --}}
</body>
</html>
