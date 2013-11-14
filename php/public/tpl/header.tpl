<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Agenda Max</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/public/css/global.css" media="screen" />
        <link rel="shortcut icon" type="image/png" href="/public/img/favicon.png" />
        <link rel="apple-touch-icon" href="/public/img/favicon.png" />
        <!--<link rel="shortcut icon" href="http://www.google.com/a/agmagor.be/images/favicon.ico" >-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js" defer></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js" defer></script> <!-- Defer / Async scripts -->
        <script src="/public/js/agenda.js" defer></script>
        {*<meta name="viewport" content="width=device-width">*}
    </head>
    <body>
        <header>
            <h1>
                Ceci est notre header
            </h1>
            <a href="" data-href="#groupe" data-width="50%" data-rel="choix_groupe" class="poplight">Choisis ton groupe</a>
            <div id="choix_groupe" class="popup_block">
                <h2>Connexion</h2>
        	    <form id="login">
                    <input id="idENIB" type="text" placeholder="Identifiant ENIB" />
                    <input type="submit" value="Soumettre" disabled />
        	    </form>
                <p></p>
            </div>

        </header>
