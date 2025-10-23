<?php
require_once("lab1.php");

 if ($coneccao){
    $sql = "SELECT pesnome, pessobrenome, pesemail, pescidade, pesestado FROM tbpessoa";
        $resultado = pg_query($conexao, $sql);
    if ($result){
         while ($row = pg_fetch_assoc($resultado)) {
            echo "<tr>
                    <td>{$row['pesnome']}</td>
                    <td>{$row['pessobrenome']}</td>
                    <td>{$row['pesemail']}</td>
                    <td>{$row['pescidade']}</td>
                    <td>{$row['pesestado']}</td>
                    </tr>";
                    $row = pg_fetch_assoc($result);
        }
    }

 }   


?>