<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Roboto+Mono:wght@100&display=swap"
        rel="stylesheet">
    <title>Hostel Manager</title>


    <style>
    html,
    body {
        height: 100%;
        padding: 0px;
        margin: 0px;
        background-color: rgb(216, 216, 216);
        color: rgb(22, 22, 22);

    }

    .big_card {
        height: 80%;
        position: absolute;
        left: 10%;
        top: 5%;
        width: 80%;

        padding: 40px;
        border-radius: 20px;
        font-family: 'Indie Flower', cursive;
    }

    .big_heading {

        font-size: 155px;
        text-align: center;
    }

    .line {
        width: 80%;
        height: 2px;
        border-radius: 50%;
        background-color: rgb(22, 22, 22);
        margin: auto;
    }

    .links {
        justify-content: center;
        margin: auto;
        text-align: center;
        font-size: 40px;
    }

    .login {
        margin-right: 200px;
    }

    a {
        color: rgb(22, 22, 22);
    }

    a:hover {
        color: black;
        text-decoration: underline;
        text-shadow: 0px 0px 20px white;
    }

    a:link {
        text-decoration: none;
    }
    </style>

</head>

<body>

    <div class="big_card">
        <div class="big_heading">
            Hostel<br>Manager
        </div>
        <br>
        <div class="line"></div>
        <br>
        <div class="links">
            <span class="login"><a href="./login">Login</a> </span><span class="register"><a
                    href="./register">register</a></span>
        </div>

    </div>

</body>

</html>