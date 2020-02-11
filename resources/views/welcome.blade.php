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

            ._slider {
                position: relative;
                overflow: hidden;
                margin-left: 15px;
            }
            ._slider:hover ._slider_next, ._slider:hover ._slider_prev {
                display: block;
            }
            ._slider_next, ._slider_prev {
                position: absolute;
                top: 35%;
                z-index: 999;
                display: none;
                width: auto;
                height: auto;
                padding: 2% 4%;
                background: #000;
                color: #fff;
                text-decoration: none;
                font-weight: 600;
                font-size: 2em;
                opacity: 0.8;
                cursor: pointer;
            }
            ._slider_next:hover, ._slider_prev:hover {
                opacity: 1;
                -webkit-transition: all 0.2s ease;
            }
            ._slider_next {
                right: 0;
            }
            ._slider ul {
                position: relative;
                height: 500px;
                margin: 0;
                padding: 0;
                list-style: none;
            }
            ._slider ul li {
                float: left;
                margin: 0;
                padding: 0;
                position: relative;
                background: #ccc;
                display: block;
                width: 500px;
                line-height: 200px;
                text-align: center;
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
                <div class="_slider">
                    <a href="#" class="_slider_next">&#10095;</a>
                    <a href="#" class="_slider_prev">&#10094;</a>
                    <ul>
                        <li>SLIDE 1</li>
                        <li>SLIDE 2</li>
                        <li>SLIDE 3</li>
                        <li>SLIDE 4</li>
                    </ul>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
    <script type='text/javascript'>
        jQuery(document).ready(function ($) {

            var interval;
            interval = setInterval(function () {
                moveRight();
            }, 3000);

            $('._slider').mouseover(function(){
                clearInterval(interval);
            });

            $('._slider').mouseleave(function(){
                interval = setInterval(function () {
                    moveRight();
                }, 3000);
            });

            var slideCount = $('._slider ul li').length;
            var slideWidth = $('._slider ul li').width();
            var slideHeight = $('._slider ul li').height();
            var sliderUlWidth = slideCount * slideWidth;

            $('._slider').css({ width: slideWidth, height: slideHeight });

            $('._slider ul').css({ width: sliderUlWidth, marginLeft: - slideWidth });

            $('._slider ul li:last-child').prependTo('._slider ul');

            function moveLeft() {
                $('._slider ul').animate({
                    left: + slideWidth
                }, 200, function () {
                    $('._slider ul li:last-child').prependTo('._slider ul');
                    $('._slider ul').css('left', '');
                });
            };

            function moveRight() {
                $('._slider ul').animate({
                    left: - slideWidth
                }, 200, function () {
                    $('._slider ul li:first-child').appendTo('._slider ul');
                    $('._slider ul').css('left', '');
                });
            };

            $('._slider_prev').click(function () {
                moveLeft();
                return false;
            });

            $('._slider_next').click(function () {
                moveRight();
                return false;
            });

        });

    </script>
</html>
