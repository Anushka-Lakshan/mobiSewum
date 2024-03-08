<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MobiSewum Login</title>
</head>

<body>
    <main>
        <ul class="light-rays">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>

            <li></li>
            <li></li>
        </ul>
        <div class="login">
            <h1>MobiSewum Admin Login</h1>

            <?php if (!empty($error)) : ?>
                <div class="error">
                    <?php foreach ($error as $key => $value) : ?>
                        <p><?= $value ?></p>
                    <?php endforeach ?>
                </div>
            <?php endif ?>

            <form action="<?=BASE_URL?>/admin-login" method="post">
                <div class="group">
                    <label for="uname">User Name</label>
                    <input type="text" name="uname" id="uname" value="<?= $_POST['uname'] ?? '' ?>" />
                </div>
                <div class="group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?= $_POST['password'] ?? '' ?>" />
                </div>
                <button>login</button>
            </form>
        </div>


        <style>
            @import url("https://fonts.googleapis.com/css2?family=Teko&display=swap");

            html,body {
                font-size: 1.1rem;
                margin: 0;
                padding: 0;
                overflow: hidden;
            }

            main .light-rays>*::before,
            main .light-rays {
                position: absolute;
                display: block;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            main {
                width: 100%;
                height: 100vh;
                background: radial-gradient(farthest-corner at 50% 0%, #23617d 0%, #112031 100%);
                display: grid;
                place-items: center;
                position: relative;
            }

            .error{
                color: red;
                text-align: center;
                background: white;
                padding: 5px 20px !important;
                margin-bottom: 5px;
                border-radius: 5px;
            }

            main .light-rays {
                pointer-events: none;
                filter: blur(0.6rem);
            }

            main .light-rays>* {
                --deg: 0;
                --length: 0rem;
                --thickness: 20px;
                --duration: 2s;
                --delay: 1s;
                --rotate: 0deg;
                --degRange: 72.5deg;
                --spreadRange: 40vw;
                position: absolute;
                transform-style: preserve-3d;
                perspective: 500px;
                width: var(--thickness);
                height: calc(20% + 370px + var(--length));
                left: 50%;
                transform: translateX(calc(-50% + var(--deg) * var(--spreadRange) * -1 + 0.5 * var(--spreadRange))) translateY(-100px) rotateZ(calc(var(--degRange) * -0.5 + var(--deg) * var(--degRange))) rotateX(0.01deg);
                transform-origin: center -100px;
                mix-blend-mode: screen;
                -webkit-animation: shimmer linear var(--duration) calc(var(--delay) * -1) infinite alternate forwards, rotate ease-in-out calc(var(--duration) * 3.14) calc(var(--delay) * -1) infinite alternate forwards;
                animation: shimmer linear var(--duration) calc(var(--delay) * -1) infinite alternate forwards, rotate ease-in-out calc(var(--duration) * 3.14) calc(var(--delay) * -1) infinite alternate forwards;
            }

            main .light-rays>*::before {
                content: "";
                background: linear-gradient(to bottom, #a6fff8, rgba(166, 255, 248, 0) 100%);
                transform-origin: top center;
                transform: rotateX(40deg);
            }

            main .light-rays>*:nth-child(1) {
                --deg: 0.6919158994;
                --thickness: 14.2066461533px;
                --length: -30.2790553189px;
                --duration: 1.5195645111s;
                --delay: 2.7874743507s;
                --rotate: -2.1087525571deg;
            }

            main .light-rays>*:nth-child(2) {
                --deg: 0.5177712449;
                --thickness: 19.395139656px;
                --length: 39.2529972252px;
                --duration: 2.1144528686s;
                --delay: 2.2759602205s;
                --rotate: -3.4012375632deg;
            }

            main .light-rays>*:nth-child(3) {
                --deg: 0.5028433182;
                --thickness: 25.1695026688px;
                --length: 21.6808392767px;
                --duration: 1.9866092291s;
                --delay: 2.4238406957s;
                --rotate: -3.4583226826deg;
            }

            main .light-rays>*:nth-child(4) {
                --deg: 0.800040648;
                --thickness: 13.4304376274px;
                --length: -1.2820777948px;
                --duration: 2.4364297593s;
                --delay: 2.7713389624s;
                --rotate: -2.1721381762deg;
            }

            main .light-rays>*:nth-child(5) {
                --deg: 0.2954308325;
                --thickness: 26.7789065418px;
                --length: -32.5839057647px;
                --duration: 1.5959503551s;
                --delay: 2.6378074784s;
                --rotate: 2.0797338653deg;
            }

            main .light-rays>*:nth-child(6) {
                --deg: 0.0762970593;
                --thickness: 13.5928063976px;
                --length: -5.6201418386px;
                --duration: 1.6776563897s;
                --delay: 2.3044598474s;
                --rotate: -0.6135260387deg;
            }

            main .light-rays>*:nth-child(7) {
                --deg: 0.6517238275;
                --thickness: 14.7138630468px;
                --length: 33.9400314811px;
                --duration: 1.4217036648s;
                --delay: 2.6639342573s;
                --rotate: 0.2183126545deg;
            }

            main .light-rays>*:nth-child(8) {
                --deg: 0.0162546323;
                --thickness: 23.2026898598px;
                --length: -43.3175027133px;
                --duration: 1.9751031642s;
                --delay: 2.142182061s;
                --rotate: 2.4058268627deg;
            }

            main .light-rays>*:nth-child(9) {
                --deg: 0.8080588423;
                --thickness: 15.8697768809px;
                --length: 5.005455736px;
                --duration: 1.8498744336s;
                --delay: 2.7310458007s;
                --rotate: -0.8067557365deg;
            }

            main .light-rays>*:nth-child(10) {
                --deg: 0.125159922;
                --thickness: 32.3768146648px;
                --length: 30.4986014084px;
                --duration: 1.7939761981s;
                --delay: 2.2522083563s;
                --rotate: 1.7857336931deg;
            }

            main .light-rays>*:nth-child(11) {
                --deg: 0.6573811286;
                --thickness: 30.8590808902px;
                --length: -18.9703342404px;
                --duration: 1.8839647569s;
                --delay: 2.9926474279s;
                --rotate: -0.7232503887deg;
            }

            main .light-rays>*:nth-child(12) {
                --deg: 0.5524223327;
                --thickness: 10.1626259088px;
                --length: -46.2628773556px;
                --duration: 2.0895791944s;
                --delay: 2.621864887s;
                --rotate: -0.1082912896deg;
            }

            main .light-rays>*:nth-child(13) {
                --deg: 0.6009446506;
                --thickness: 27.2282165914px;
                --length: 39.1770214218px;
                --duration: 2.4721144378s;
                --delay: 2.9625451458s;
                --rotate: 2.5565909021deg;
            }

            main .light-rays>*:nth-child(14) {
                --deg: 0.7163881296;
                --thickness: 15.6008037407px;
                --length: -31.6145918036px;
                --duration: 1.2117359502s;
                --delay: 2.8432847098s;
                --rotate: 2.3230077981deg;
            }

            main .light-rays>*:nth-child(15) {
                --deg: 0.2518979701;
                --thickness: 27.2679528362px;
                --length: -41.1948809747px;
                --duration: 2.199376119s;
                --delay: 2.0666178219s;
                --rotate: 1.2323450849deg;
            }

            main .light-rays>*:nth-child(16) {
                --deg: 0.3884658265;
                --thickness: 30.7442015888px;
                --length: -45.479992448px;
                --duration: 1.5671011875s;
                --delay: 2.5027738716s;
                --rotate: -2.5117055779deg;
            }

            main .light-rays>*:nth-child(17) {
                --deg: 0.652341305;
                --thickness: 8.2487922867px;
                --length: -39.682450942px;
                --duration: 2.2922927322s;
                --delay: 2.6811308156s;
                --rotate: 0.6828917527deg;
            }

            main .light-rays>*:nth-child(18) {
                --deg: 0.265109298;
                --thickness: 18.1146010804px;
                --length: 27.7511704368px;
                --duration: 1.0260928205s;
                --delay: 2.1718271861s;
                --rotate: 3.4229962901deg;
            }

            main .light-rays>*:nth-child(19) {
                --deg: 0.9327742592;
                --thickness: 27.3550708736px;
                --length: -6.3756674547px;
                --duration: 2.0935338295s;
                --delay: 2.9231130152s;
                --rotate: -1.9284381094deg;
            }

            main .light-rays>*:nth-child(20) {
                --deg: 0.1436315279;
                --thickness: 21.8005047364px;
                --length: -49.7587485365px;
                --duration: 1.2597335661s;
                --delay: 2.2833786023s;
                --rotate: -3.0189967314deg;
            }

            main .light-rays>*:nth-child(21) {
                --deg: 0.7655728781;
                --thickness: 26.3488987858px;
                --length: -44.8937239932px;
                --duration: 1.7315647789s;
                --delay: 2.3907628161s;
                --rotate: -1.1367852565deg;
            }

            main .light-rays>*:nth-child(22) {
                --deg: 0.9033717172;
                --thickness: 27.3687297732px;
                --length: 3.5387732542px;
                --duration: 2.2514697105s;
                --delay: 2.1210686278s;
                --rotate: 3.2293330887deg;
            }

            main .light-rays>*:nth-child(23) {
                --deg: 0.6932032391;
                --thickness: 15.5523582044px;
                --length: -9.9541948327px;
                --duration: 2.2361468064s;
                --delay: 2.3785276211s;
                --rotate: 2.5947440903deg;
            }

            main .light-rays>*:nth-child(24) {
                --deg: 0.2014083937;
                --thickness: 23.7981952298px;
                --length: 43.8710969083px;
                --duration: 1.9449445232s;
                --delay: 2.6867465967s;
                --rotate: 1.1310602826deg;
            }

            main .light-rays>*:nth-child(25) {
                --deg: 0.6706179909;
                --thickness: 26.6740669436px;
                --length: 48.5216006762px;
                --duration: 1.7304250984s;
                --delay: 2.175873718s;
                --rotate: 3.7867237646deg;
            }

            main .light-rays>*:nth-child(26) {
                --deg: 0.0156934009;
                --thickness: 28.7978682642px;
                --length: 37.3718272632px;
                --duration: 2.4181162501s;
                --delay: 2.7710351836s;
                --rotate: 2.4312963287deg;
            }

            main .light-rays>*:nth-child(27) {
                --deg: 0.4486087609;
                --thickness: 15.0398604858px;
                --length: -18.2081651445px;
                --duration: 1.7220283926s;
                --delay: 2.3189725261s;
                --rotate: 2.7887210387deg;
            }

            main .light-rays>*:nth-child(28) {
                --deg: 0.1302948294;
                --thickness: 11.7192560648px;
                --length: 38.6374462012px;
                --duration: 1.709570946s;
                --delay: 2.9334361492s;
                --rotate: -3.8944200704deg;
            }

            main .light-rays>*:nth-child(29) {
                --deg: 0.8115065487;
                --thickness: 16.4784609306px;
                --length: 31.0030976126px;
                --duration: 1.0133376632s;
                --delay: 2.9446621224s;
                --rotate: 3.3268252384deg;
            }

            main .light-rays>*:nth-child(30) {
                --deg: 0.4251958368;
                --thickness: 18.2148164955px;
                --length: 25.7993673094px;
                --duration: 2.0429129764s;
                --delay: 2.3904453591s;
                --rotate: -2.3565903655deg;
            }

            main .light-rays>*:nth-child(31) {
                --deg: 0.1388258945;
                --thickness: 15.9619838124px;
                --length: 36.278637554px;
                --duration: 1.5932767335s;
                --delay: 2.7125954702s;
                --rotate: -0.1986363734deg;
            }

            main .light-rays>*:nth-child(32) {
                --deg: 0.4478313807;
                --thickness: 29.4110948376px;
                --length: -48.1690687659px;
                --duration: 1.1668635826s;
                --delay: 2.8777036631s;
                --rotate: -2.7167731901deg;
            }

            main .login {
                display: flex;
                flex-direction: column;
                align-items: center;
                position: relative;
                z-index: 1;
                padding: 1rem;
                margin-top: -17.5vh;
                filter: drop-shadow(0px 3px 0px rgba(0, 0, 0, 0.2));
            }

            main .login h1 {
                font-family: "Teko", "Nunito Sans", sans-serif;
                display: flex;
                align-items: center;
                align-self: stretch;
                gap: 0.3em;
                background-image: linear-gradient(to bottom, white, #7ff);
                color: transparent;
                -webkit-background-clip: text;
                background-clip: text;
                text-align: center;
                white-space: nowrap;
                font-size: 5.4rem;
                opacity: 0.8;
            }

            main .login h1::before,
            main .login h1::after {
                content: "";
                display: block;
                height: 0.1em;
                flex: 1;
                background-image: inherit;
            }

            main .login form {
                display: grid;
                grid-template-columns: auto 1fr;
                grid-auto-rows: auto;
                grid-auto-flow: row dense;
                padding: 3rem 4rem;
                background-color: rgba(255, 255, 255, 0.05);
                box-shadow: 0px 0px 1.4rem inset rgba(255, 255, 255, 0.1);
                gap: 2rem;
                color: white;
            }

            main .login form .group {
                display: grid;
                grid-template-columns: subgrid;
                grid-column: 1/-1;
                gap: 1rem;
                align-items: center;
            }

            main .login form .group label {
                font-size: 1.4rem;
                text-align: right;
                opacity: 0.7;
            }

            main .login form .group input {
                flex: 1;
                min-width: 0;
                border: none;
                border-radius: 0px;
                font-size: inherit;
                padding: 4px 6px;
                outline: none;
                background-color: rgba(255, 255, 255, 0.3);
                color: inherit;
                transition: all 0.2s;
            }

            main .login form .group input:focus {
                background-color: rgba(112, 255, 255, 0.3);
            }

            main .login form button {
                grid-column: 1/-1;
                border: none;
                cursor: pointer;
                padding: 4px;
                font-size: inherit;
                font-size: 2rem;
                background-color: rgba(255, 255, 255, 0.3);
                color: white;
                text-transform: uppercase;
                transition: all 0.2s;
                outline: none;
            }

            main .login form button:hover,
            main .login form button:focus {
                color: #7ff;
                background-color: rgba(112, 255, 255, 0.3);
            }

            @-webkit-keyframes shimmer {
                0% {
                    opacity: 0.33;
                }

                100% {
                    opacity: 0.03;
                }
            }

            @keyframes shimmer {
                0% {
                    opacity: 0.33;
                }

                100% {
                    opacity: 0.03;
                }
            }

            @-webkit-keyframes rotate {
                0% {
                    rotate: 0deg;
                }

                100% {
                    rotate: var(--rotate);
                }
            }

            @keyframes rotate {
                0% {
                    rotate: 0deg;
                }

                100% {
                    rotate: var(--rotate);
                }
            }
        </style>
    </main>
</body>

</html>