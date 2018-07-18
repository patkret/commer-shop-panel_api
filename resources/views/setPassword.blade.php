<!DOCTYPE html>
<html>
<head>
    <style>
        body{
            background-color: #f5f5f5;
            padding: 0 50px;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
        }
        .mail__header{
            width: 80%;
            height: 70px;
            background-color: black;
            display: grid;
            grid-template-columns: 10% 1fr 3fr 10%;
            grid-template-areas: ". log-main log-desc .";
        }
        .logo__main{
            font-size: 2rem;
            color: yellow;
            grid-area: log-main;
            width: 25px;
        }
        .logo__desc{
            color: white;
            padding: 0;
            border-bottom: 3px solid yellow;
            grid-area: log-desc;
            width: 150px;
        }
    </style>
</head>
<body>
<header class="mail__header">
    <div class="logo__main"><p>M&P</p></div>
    <div class="logo__desc">
        <p>ALKOHOLE I WINA ŚWIATA</p></div>
</header>
<h1 >Witaj</h1>
<p>Twoje konto w sklepie zostało założone!</p>
<p>Nadano tymczasowe hasło</p>
<p><strong>{{$temporary_password}}</strong></p>
<p>Aby je zmienić kliknij: </p>
<a href="{{URL::to('client/'.$client_id.'/'.'set-account-password/' . $confirmation_code) }}">USTAW NOWE HASŁO </a>
</body>
</html>

