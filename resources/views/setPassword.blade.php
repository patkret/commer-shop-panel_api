<h1>Witaj</h1>
<p>Twoje konto w sklepie zostało założone!</p>
<p>Nadano tymczasowe hasło</p>
<p><strong>{{$temporary_password}}</strong></p>
<p>Aby je zmienić kliknij: </p>
<a href="{{URL::to('client/'.$client_id.'/'.'set-account-password/' . $confirmation_code) }}">USTAW NOWE HASŁO </a>