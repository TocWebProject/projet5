<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JournalDeBord</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

        <!-- Lottie Animation Script -->
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .bottom{
                position: absolute;
                bottom: 10px
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 5px;
            }

            .copyright{
                margin: 5px 0px;
            }

            h2{
                margin-top: 0px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Accueil</a>
                    @else
                        <a href="{{ route('login') }}">Se Connecter</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">S'enregistrer</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">

                <div class="anim">
                    <lottie-player src="../animation/lf30_editor_5KYs8e.json"  background="transparent"  speed="0.7"  style="width: 100%; height: 200px;"  loop  autoplay></lottie-player>
                </div>
                
                <div class="title m-b-md">
                    Journal de Bord
                </div>
                <div class="links">
                    <h2>
                        Concentrer vous sur l'essentiel et avancer dans vos tâches tout en restant informé !
                    </h2>
                </div>
            </div>
            <div class="bottom links">
                <p class="copyright flex-center">© 2020 TocWebProject</p>
                <a href="#">RGPD</a>
                <a href="#">Mentions légales</a>
            </div>
        </div>
    </body>
</html>
