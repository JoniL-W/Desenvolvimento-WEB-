<?php
    try {
        
        $coneccao = pg_connect("host=localhost
                                                port=5432 
                                                dbname=local
                                                user=postgres 
                                                password=unidavi");
        if($conexao) {
            echo "database conectado..";      
        
            $result = pg_query($conexao, 
                "SELECT COUNT(*) AS QTDTABS FROM PG_TABLES");
    
            while($row = pg_fetch_assoc($result)) {
                echo "<br>Result: " . $row['qtdtabs'];
            }

            $DadosPessoas = array(
                $_POST['campo_nome'],
                $_POST['campo_sobrenome'],
                $_POST['campo_email'],
                $_POST['campo_senha'],
                $_POST['campo_cidade'],
                $_POST['campo_estado']
            );

            $result = pg_query_params( $conexao,    
                            'INSERT INTO TBPESSOA 
            (PESNOME, PESSOBRENOME, PESEMAIL, PESPASSWORD, PESCIDADE, PESESTADO)
            VALUES ($1, $2, $3, $4, $5, $6)',
            $DadosPessoas);
            
            if($result) {
                echo 'gravou com sucesso <br>';
            }
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }


?>
