<?php

    require_once 'lib/htmltable.php';
    require_once 'lib/htmlinput.php';

    $oTabela = new htmlTable();
    $oTabela->setDados(array(
                         0 => array(
                            0 => 'jonathan',
                            1 => 'jonathan.wiessner@unidavi.edu.br'
                        ),
                        1 => array(
                            0 => 'lucas',
                            1 => 'lucas@unidavi.edu.br'
                        ))
                       );

    echo $oTabela->renderHtml();
    
    echo "<br><br>";

    $oInput = new htmlinput();
    $oInput->setTitulo("Campo");
    echo $oInput->renderHtml();

?>