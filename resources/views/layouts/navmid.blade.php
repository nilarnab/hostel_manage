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
    margin-right: -4px;
    /* inline-block gap fix */
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


.dark_oval {
    background: linear-gradient(150deg, #3c3c3c, black) !important;
    box-shadow: 0px 0px 0px black !important;
    color: aliceblue !important;
}

.shadow_less {
    box-shadow: 0px 0px 0px black !important;
}

.bright_text {
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

.night_light {
    font-size: 22px;
}

.nav-link {
    font-size: small;
}
</style>



<!--    NAV LAYOUT-->
<nav class="navbar navbar-expand-md navbar-light bg-light" style="background-color: rgba(0, 0, 0, 0) !important;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text" id="navbarTogglerDemo01">
        <a class="navbar-brand text" href="#home" title="Logo">HostelManager</a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="/home">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/logout">logout</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/update_profile">Profile</a>
            </li>

            @if(\Illuminate\Support\Facades\Auth::user()->role == 2)
            <li class="nav-item">
                <a class="nav-link" href="/update_role">Update Role</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/mailer">Mailer</a>
            </li>

            @endif



            <li class="nav-item" align="center">
                {{--            <p style="font-size: small">language</p>--}}
                <div id="google_translate_element" style="color: black !important;"></div>
            </li>

            <li class="nav-item">
                <a id="toogle_button" class="nav-link night_light" onclick="toggle()"><i class="far fa-moon"></i></a>
            </li>
        </ul>


    </div>
</nav>

<div class="line" style="margin: auto"></div>
<br>
{{--<div class="language_changer" style="margin: auto!important;" align="center">--}}
{{--    <div id="google_translate_element" ></div>--}}
{{--</div>--}}

<!--     END-->

@yield('post_nav')