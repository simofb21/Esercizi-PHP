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