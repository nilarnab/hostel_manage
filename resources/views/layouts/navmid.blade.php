

<style>
    /* CENTRAL NAVBAR */
    #rc_logo {
        left: 30px;
        padding: 22px;
        position: absolute;
        color: #fff;
        font-size: 19px;
        text-decoration: none;
    }

    #rc_logo a {
        color: inherit;
        text-decoration: none;
    }

    .rc_nav {
        overflow: hidden;
        text-align: center;
        z-index: 6;

    }

    .rc_nav a {
        display: inline-block;
        margin-right: -4px;  /* inline-block gap fix */
        padding: 22px 22px;
        text-decoration: none;
        font-size: 18px;
        -webkit-transition: background 0.3s linear;
        -moz-transition: background 0.3s linear;
        -ms-transition: background 0.3s linear;
        -o-transition: background 0.3s linear;
        transition: background 0.3s linear;
        z-index: 9;
    }

    .rc_nav a:hover {
        color: #3c3c3c;
        font-size: 24px;
        z-index: 9;

    }

    .dark
    {
        background-color: #3c3c3c !important;
    }

    .dark_oval
    {
        background: linear-gradient(150deg, #3c3c3c, black) !important;
        box-shadow: 0px 0px 0px black !important;
        color: aliceblue !important;
    }

    .shadow_less
    {
        box-shadow: 0px 0px 0px black !important;
    }

    .bright_text
    {
        color: aliceblue !important;
    }

    .rc_nav .icon {
        display: none;
    }

    /*@media screen and (max-width: 820px) {*/
    /*    .rc_nav a {display: none;}*/
    /*    .rc_nav a.icon {*/
    /*        float: right;*/
    /*        display: block;*/
    /*        width: 60px;*/
    /*    }*/
    /*}*/

    /*@media screen and (max-width: 820px) {*/
    /*    .rc_nav.responsive {position: relative; top: 73px;}*/
    /*    .rc_nav.responsive .icon {*/
    /*        position: fixed;*/
    /*        right: 0;*/
    /*        top: 0;*/
    /*    }*/
    /*    .rc_nav.responsive a {*/
    /*        float: none;*/
    /*        display: block;*/
    /*        text-align: center;*/
    /*    }*/

    /*}*/

    .night_light
    {
        font-size: 22px;
    }

</style>



<!--    NAV LAYOUT-->
<div id="rc_logo">
    <a href="#home" title="Logo">LOGO</a> <!-- Swap this placeholder out for your logo image -->
</div>

<div class="rc_nav text" id="centered_nav">
    <a href="./logout">Logout</a>
    <a id="toogle_button"  class="night_light" onclick="toggle()"><i class="far fa-moon"></i></a>
    <a title="Menu" style="font-size:18px;" class="icon">&#9776;</a>

</div>

<div class="language_changer" style="position: absolute; right: 20px; top: 20px !important;">
    <div id="google_translate_element" ></div>
</div>


<div class="line" style="margin: auto"></div>

<!--     END-->

<main>
    @yield('post_nav')
</main>



