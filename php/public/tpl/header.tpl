<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Agenda Max</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/public/css/global.css" media="screen" />
        <!--<link rel="shortcut icon" href="/public/img/favicon.ico" />-->
        <link rel="shortcut icon" href="http://www.google.com/a/agmagor.be/images/favicon.ico" >
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.min.js"></script> <!-- Defer / Async scripts -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/1.6.4/fullcalendar.css" />
        <script src="/public/js/agenda.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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
                    <input type="text" placeholder="Identifiant ENIB" />
                    <input type="submit" value="Soumettre" />
        	    </form>
            </div>

        </header>
