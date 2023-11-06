<?php
session_start();

if (isset($_SESSION['nome'])) {
    echo $_SESSION['nome'];
} else {
    echo 'Usuário não autenticado'; // Trate o caso em que o usuário não está autenticado
}
?>
