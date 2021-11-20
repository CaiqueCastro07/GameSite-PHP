<!DOCTPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <title></title>
    </head>

    <body>

        <?php

        include('montar.php');
        include('processar.php');
        include('./Games/Memory/buildCardsDeck.php');
        include('./Games/Mines/buildMineField.php');

        formLayout();
        ?>

    </body>

    <style>
        .background {
            position: absolute;
            top: 0px;
            left: 0px;
            background-color: #37496e;
            width: 100vw;
            height: 100vh;
            justify-content: center;
            align-items: center;
            display: flex;
        }

        .input {
            position: absolute;
            bottom: 0px;
            left: 50vw;
            display: flex;
            height: 40px;
            width: 50px;
            z-index: 4;
        }

        .navbar {
            position: top;
            width: 100%;
            height: 10%;
            background-color: rgb(53, 53, 53);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .tab1 {
            display: grid;
            width: 14vw;
            height: 100%;
            margin: 5px;
            background-color: black;
            place-items: center;
            color: white;
        }

        .tab2 {
            display: grid;
            width: 14vw;
            height: 100%;
            margin: 5px;
            background-color: black;
            place-items: center;
            color: white;
        }

        b {
            color: white;
            font-size: 2vw;
        }

        .area {
            width: 85%;
            height: 85%;
            position: relative;
            display: flex;
            background-color: blue;
            justify-content: center;

        }

        .jogo {
            width: 98%;
            height: 90%;
            position: absolute;
            display: flex;
            bottom: 0px;
            background-color: white;
            align-items: center;
            justify-content: center;
        }

        .memory {
            height: 100%;
            width: 100%;
            background-color: rgb(255, 200, 200);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .mine {
            width: 100%;
            height: 100%;
            background-color: rgb(188, 255, 188);
            display: flex;
            justify-content: center;
            align-items: center;
        }


        .danger {
            height: 45px;
            width: 45px;
            background-color: #ADADAD;
            font-size: 25px;
            border-radius: 7px;
            border-width: 1px;
            border-style: inset;
        }

        .hidden {
            height: 45px;
            width: 45px;
            background-color: grey;
            border-radius: 7px;
            border-width: 1px;
            border-style: inset;

        }

        .bomb {
            height: 45px;
            width: 45px;
            background-color: red;
            font-size: 25px;
            border-radius: 7px;
            border-width: 1px;
            border-style: inset;
        }

        .container {
            height: 47px;
            width: 47px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .board {
            height: 438px;
            width: 438px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(45px, 1fr));
            grid-auto-rows: 45px;
            position: relative;
            top: 4%;
        }

        .submit {
            height: 45px;
            width: 45px;
            background-color: grey;
            text-indent: -9999px;
            border-radius: 7px;
        }

        .empty {
            height: 45px;
            width: 45px;
            background-color: #ADADAD;
            text-indent: -9999px;
            border-radius: 7px;
            border-width: 1px;
            border-style: inset;
        }

        .new {
            position: absolute;
            top: 10px;
        }

        .holdInfo {
            display: flex;
            z-index: 5;
            position: absolute;
            top: 2%;
        }

        .start {
            display: grid;
            background-color: red;
            place-items: center;
            height: 3.5vw;
            width: 6vw;
            border-radius: 10px;
            margin: 1px;
        }

        .timer {
            display: grid;
            place-items: center;
            height: 3.5vw;
            width: 6vw;
            border-radius: 10px;
            background-color: blue;
            margin: 1px;
        }

        .points {
            display: grid;
            place-items: center;
            height: 3.5vw;
            width: 6vw;
            border-radius: 10px;
            background-color: green;
            margin: 1px;
        }

        .choose {
            display: grid;
            place-items: center;
            height: 3.5vw;
            width: 3.5vw;
            background-color: rgb(213, 172, 255);
            border-radius: 10px;
            margin: 1px;
        }
        .card{
            display: flex;
            width: 17vh;
            height: 25.5vh;
            background-color: white;
            align-items: center;
            justify-content: center;
            background-size: contain;
            background-repeat: no-repeat;
            border-radius:5%;

        }
        .memBoard{
            display: grid;
            position: absolute;
            top:15%;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            grid-auto-rows: 200px;
            height:90%;
            width:90%;
        }
        .pickCard{
            text-indent: -9999px;
            width:17vh;
            height: 25.5vh;
            opacity: 0.0;
        }
    </style>

    </html>