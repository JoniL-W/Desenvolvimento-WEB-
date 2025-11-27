<?php
    try {
       
        $coneccao = pg_connect("host=localhost
                                                port=5432
                                                dbname=local
                                                user=postgres
                                                password=unidavi");
        if($coneccao) {
            echo "database conectado..";      
       
            $result = pg_query($coneccao,
                "SELECT COUNT(*) AS QTDTABS FROM PG_TABLES");
   
            while($row = pg_fetch_assoc($result)) {
                echo "<br>Result: " . $row['qtdtabs'];
            }


            $DadosPessoas = array(
                $_POST['nome'],
                $_POST['sobrenome'],
                $_POST['email'],
                $_POST['senha'],
                $_POST['cidade'],
                $_POST['estado'],
            );


            $result = pg_query_params( $coneccao,    
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