<!DOCTYPE html>
<body>
   
    <form action="logout.php" method="post">
        <input type="submit" value="Conferma logout">
    </form>

</body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    session_destroy();
    header('Location: login.php');
    exit();
}
?>