<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                margin-bottom: 30px;
            }
            #slideshow {
                /* margin: 50px auto; */
                position: relative;
                width: 300px;
                height: 510px;
                padding: 10px;
                /* box-shadow: 0 0 30px rgba(0,0,0,0.4); */
            }

            #slideshow > div {
                position: absolute;
                top: 10px;
                left: 10px;
            }
            #slideshow > div > img {
                border: 2px solid white;
                box-shadow: 0 0 20px white;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div id="slideshow">
                    <div>
                        <img src="http://farm6.static.flickr.com/5224/5658667829_2bb7d42a9c_m.jpg" alt="mustang.jpg"><br>
                        A newer Mustang.
                    </div>
                    <div>
                        <img src="http://www.htmlgoodies.com/imagesvr_ce/3798/camaro.jpg" alt="camaro.jpg"><br>
                        A modern Camaro.
                    </div>
                    <div>
                        <img src="http://www.htmlgoodies.com/imagesvr_ce/6859/classic.jpg" alt="classic.jpg"><br>
                        An oldie but a goodie!
                    </div>
                    <div>
                        <img src="http://www.htmlgoodies.com/imagesvr_ce/1767/classic2.jpg" alt="classic2.jpg"><br>
                        More old cars.
                    </div>
                    <div>
                        <img src="http://www.htmlgoodies.com/imagesvr_ce/5199/video_game_car.jpg" alt="video_game_car.jpg"><br>
                        A good rendering of a classic race car.
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script type='text/javascript'>
            $("#slideshow > div").hide();

            setInterval(function() {
                $('#slideshow > div:first')
                    .fadeOut(1000)
                    .next()
                    .fadeIn(1000)
                    .end()
                    .appendTo('#slideshow');
            },  5000);

    </script>
</html>
