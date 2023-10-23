<?php

    // //Informações da conexão
    // $servidor = "localhost";
    // $usuario = "root";
    // $senha = "";
    // $banco = "gestor-atividades";

    // //Conectando no servidor do banco de dados
    // try {
    //     $conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    //     echo 'Conexao criada!';
    // } catch (PDOException $e) {
    //     echo 'Erro de conexão: ' . $e->getMessage();
    //     exit();
    // }    

    
    
    
    try {

        // Informações da conexão
        $servidor = "localhost";
        $usuario = "root";
        $senha = "";
        $banco = "gestor-atividades";

        // Conexão com o banco de dados usando PDO
        $conn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Consulta SQL
        $query = "SELECT * FROM atividades";
        
        // Executar a consulta
        $stmt = $conn->query($query);
    
        // Buscar os resultados
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
        exit();
    }
    
    
    
    

?>