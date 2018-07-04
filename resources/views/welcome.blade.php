<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #45451F; /* PIER */
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
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

            .content {
                text-align: center;
            }

            #welcomeImg {
                width: 70%;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #45451F; /* PIER */
                padding: 0 25px;
                font-size: 20px;
                font-weight: 900;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .top-right > a {
                font-size: 12px;
                font-weight: 600;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            /* ---- reset ---- */ body{ margin:0; font:normal 75% Arial, Helvetica, sans-serif; } canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #C2E6FF; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
        </style>
    </head>
    <body>

        <!-- particles.js container --> 
        <div id="particles-js"></div> 
        
        <!-- stats - count particles --> 
        {{-- <div class="count-particles"> 
            <span class="js-count-particles"></span> 
        </div> --}} 
        
        <div class="flex-center position-ref full-height">
            <div class="top-right links">
                <a href="{{ url('/about') }}">About</a>
            </div>

            <div class="content">
                <div class="title m-b-md">
                    <img id="welcomeImg" src="{{ asset('img/wagewave.jpg') }}">
                </div>

                @if (Route::has('login'))
                <div class="links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                    <a href="{{ route('register') }}">Register</a>
                @endauth
                </div>
                @endif
            </div>
        </div>

        <!-- particles.js lib - https://github.com/VincentGarreau/particles.js --> 
        <script src="{{ asset('js/particles.min.js') }}"></script>
        {{-- <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> --}}
        <!-- stats.js lib --> 
        {{-- <script src="http://threejs.org/examples/js/libs/stats.min.js"></script> --}}

        <script type="text/javascript">
            particlesJS("particles-js",{"particles":{"number":{"value":6,"density":{"enable":true,"value_area":800}},"color":{"value":"#007F52"},"shape":{"type":"polygon","stroke":{"width":1,"color":"#000"},"polygon":{"nb_sides":6},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.3,"random":true,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":71.02342786683108,"random":false,"anim":{"enable":true,"speed":10,"size_min":40,"sync":false}},"line_linked":{"enable":false,"distance":200,"color":"#ffffff","opacity":1,"width":2},"move":{"enable":true,"speed":8,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":false,"mode":"grab"},"onclick":{"enable":true,"mode":"remove"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});

                // var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function() { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
        </script>
    </body>
</html>
