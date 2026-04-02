# Preparazione verifica informatica

## Connessione al db

E' fondamentale mettere l'istruzione mysqli_connect("localhost","utente_db(di solito rooot)","pwd(di solito vuota)","nome del db")

- mettere controllo su errore magari

## Pagine che inviano dati al form

html :

<form action ="paginaCheElabora.php" ,method ="POST/GET">
    <input type = text  value="nomeParamDaPassare"
    <input type="submit"> altrimenti non invio i dati...

</form>

## Pagine che recuperano i dati dai form

Se ho mandato i dati con la post
in $\_POST[value] , me li recupero.



## Logout

<?php
    // Inizia o riprende la sessione esistente. 
    // È necessario chiamarlo anche per poterla distruggere.
    session_start();

    // Rimuove tutte le variabili di sessione (come $_SESSION['id'] e $_SESSION['nome']).
    // In pratica, svuota l'array $_SESSION.
    session_unset();

    // Distrugge definitivamente il file della sessione sul server.
    // Da questo momento l'utente è ufficialmente disconnesso.
    session_destroy();

    // Reindirizza l'utente alla pagina di login dopo la disconnessione.
    header("Location: login.html");

    // Interrompe l'esecuzione dello script per sicurezza.
    exit();
?>
