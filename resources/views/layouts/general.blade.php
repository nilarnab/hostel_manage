<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- place for font awesome-->
    <script src="https://kit.fontawesome.com/8fedbb90c1.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="../../css/app.css" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>

        *
        {
            transition: 0.5s;
        }

        /* STATIC STYLES */
        html
        {
            padding: 0px;
            margin: 0px;
            height: 100%;
            background-color: rgb(230, 230, 230);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: hidden;
        }
        body {
            padding: 0px;
            margin: 0px;
            height: 100%;
            background-color: rgb(230, 230, 230);
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            overflow: scroll;
        }



        .cont {
            width: 90%;
            margin: auto;
            padding-top: 50px;
        }

        .holders {
            border-radius: 0px;

            height: max(500px, auto);
            overflow: hidden;

        }


        .carousel-item>img {

            width: auto;
            height: 500px;
        }

        .carousel-item>img:hover {
            transform: scale(2);
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            border-radius: 20px;
        }

        .carousel-inner {
            padding: 5px;
        }


        .graph {
            background: linear-gradient(#f3f3f3, #d8d8d8);
            box-shadow: 15px 15px 20px #919191,
            -10px -10px 10px #ffffff;
            padding-left: 11px;
            height: 440px !important;
            border-radius: 20px;
        }

        .graph:hover {
            box-shadow: 10px 10px 15px #919191,
            -10px -10px 10px #ffffff;
        }

        .bars {
            height: 100%;
            width: auto;
            background: linear-gradient(darkblue, #c6a5fa);
            box-shadow: -15px -15px 20px #919191,
            4px 4px 10px #ffffff;;
        }

        .bars:hover {
            box-shadow: -20px -20px 25px #757575;
        }

        .bar_1 {
            /*background: linear-gradient(90deg, rgb(4, 28, 136), rgb(71, 157, 255));*/

            animation-name: bar_1;
            animation-duration: 2s;
            animation-iteration-count: 1;
        }

        .bar_2 {
            /*background: linear-gradient(90deg, rgb(4, 28, 136), rgb(71, 157, 255));*/
            animation-name: bar_2;
            animation-duration: 2s;
            animation-iteration-count: 1;
        }

        .bar_3 {
            /*background: linear-gradient(90deg, rgb(4, 28, 136), rgb(71, 157, 255));*/
            animation-name: bar_3;
            animation-duration: 2s;
            animation-iteration-count: 1;
        }

        .row {
            height: auto;
            margin-bottom: 20px;

        }

        .row1 {
            height: 100%;
        }

        .text {
            font-size: 20px;
            background: -webkit-linear-gradient(rgb(115, 173, 252), rgb(190, 86, 252));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .text1 {
            font-size: 10px;
            background: -webkit-linear-gradient(tomato, rgb(233, 7, 241));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;

        }

        .cards {
            margin-left: 48px;
            margin-right: 48px;
            background: linear-gradient(white, #cac9c9);
            box-shadow: 4px 4px 15px #919191,
            -4px -4px 10px #ffffff;
            height: 300px;
            width: 500px;
            padding: 40px;

        }

        .elevate {
            box-shadow: 4px 4px 15px #919191,
            -4px -4px 10px #ffffff;
            padding: 20px;
            border-radius: 20px;
            margin-top: 20px;
            background: linear-gradient(white, #cac9c9);
        }

        .bar_holder {
            margin-left: 0px;
            transform: rotate(180deg);
            padding-left: 45px;

            justify-content: left;
        }

        .line {
            height: 1px;
            width: 80%;
            background: linear-gradient(90deg, blue, violet);
        }

        /* gradient generator */
        .border {
            border: 1px solid rgb(174, 0, 255) !important;
            border-radius: 20px !important;
        }

        .status {
            margin-top: 20px;
            height: 100px;
            width: auto;
            padding: 10px;
            justify-content: center;
            text-align: center;
            box-shadow: 10px 10px 15px #919191,
            -4px -4px 10px #ffffff;
            border-radius: 20px;

        }

        .status:hover,
        .cards:hover {

            box-shadow: 20px 20px 25px #757575,
            -10px -10px 10px #ffffff;

        }

        .status_text {
            font-size: 30px;
            font-weight: bolder;
        }

        .gradient_success {
            background: -webkit-linear-gradient(rgb(71, 255, 102), rgb(3, 133, 79));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .gradient_warning {
            background: -webkit-linear-gradient(rgb(255, 179, 122), rgb(133, 55, 3));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        #label
        {
            transform: rotate(0deg);
            font-size: 12px !important;
        }

        #graph_label
        {
            transform: translateX(-10px);
            text-align: center;
        }

        /* Table styles */
        .table
        {
            width: 80%;
            margin: auto;
        }

        .table_text
        {
            padding-top: 22px !important;
        }


        .success
        {
            font-weight: bold;
            color: darkgreen;
        }

        .red
        {
            font-weight: bold;
            color: tomato;
        }


        /* STYLE FOR ADMIN PANEL */
        .request_num
        {
            text-align: center;
            height: auto;
            padding: 20px;
            background-color: white;
            border-radius: 20px;
        }

        .request_num>#pending_requests>h2
        {
            font-size: 130px;
        }

        .users_number
        {
            text-align: center;
            height: 200px;
            padding: 20px;
            background-color: white;
            border-radius: 20px;
            margin-top: 20px;
        }

        .users_number>p
        {
            font-size: 50px;
            font-weight: bold;
        }

        .requests
        {
            margin-top: 20px;
            height: 300px;
            border-radius: 20px;
            overflow: auto;
            padding: 20px;
            background-color: white;
        }

        .requests>.text
        {
            text-align: center;
        }

        .mess_timing
        {
            margin-top: 20px;
            height: 300px;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            margin-bottom: 20px;
            overflow: auto;
        }

        .mess_timing>.text
        {
            text-align: center;
        }

        .personal_infos
        {
            margin-top: 20px;
            height: 300px;
            border-radius: 20px;
            padding: 20px;
            background-color: white;
            margin-bottom: 20px;
            overflow: auto;
        }

        .personal_infos>.text
        {
            text-align: center;
        }


        #body
        {

        }




    </style>


</head>
<body id="body">

    <div class="cont">
        <main>
            @yield('main')
        </main>
    </div>

    <script>
        // AOS.init();
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body>
</html>
