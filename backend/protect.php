<?php
session_start();

if(isset($_SESSION['id'])) {
    echo "logado";
} else {
    echo "nao_logado";
}
?>
