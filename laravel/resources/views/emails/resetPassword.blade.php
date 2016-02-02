@if($language == 'de')

Sehr geehrte Leserin, sehr geehrter Leser,<br/>
vielen Dank für Ihre Anmeldung auf unserer Website.
<br/><br/>
Sie haben sich mit den folgenden Anmeldedaten bei uns registrieren lassen: <br/>
Email/Benutzername: {{ $mail }} <br/>
Ihr neues Passwort lautet: {{ $password }} 
<br/><br/>
Das Passwort wurde von unserem System generiert. Sie können es nach Ihrer Anmeldung mit ihrem neuen Passwort gerne im Bereich Einstellungen in ein Passwort ändern, das Sie sich gut merken können.
<br/><br/>
Vielen Dank, <br/>
Die splace Redaktion 

@else

Sehr geehrte Leserin, sehr geehrter Leser,<br/>
vielen Dank für Ihre Anmeldung auf unserer Website.
<br/><br/>
Sie haben sich mit den folgenden Anmeldedaten bei uns registrieren lassen: <br/>
Email/Benutzername: {{ $mail }} <br/>
Ihr neues Passwort lautet: {{ $password }} 
<br/><br/>
Das Passwort wurde von unserem System generiert. Sie können es nach Ihrer Anmeldung mit ihrem neuen Passwort gerne im Bereich Einstellungen in ein Passwort ändern, das Sie sich gut merken können.
<br/><br/>
Vielen Dank, <br/>
Die splace Redaktion 

@endif