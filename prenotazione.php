<html>
    <head>
        <title>Prenotazione Posti</title>
        
        <link rel = "stylesheet" href = "awesomeStyle.css"></link>
    </head>
    <body>
        <div class = "hidden-div-loading-resources" >
            <img src = "sediePNG/sediaGrigia.png" id = "seat-occupied" width = '2%'>
            <img src = "sediePNG/sediaNera.png" id = "seat-standard" width = '2%'>
            <img src = "sediePNG/sediaVerde.png" id = "seat-available" width = '2%' >
            <img src = "sediePNG/sediaRossa.png" id = "seat-out-of-order" width = '2%'> <!--da cambiare altrimenti non capisco un ca-->
        </div>
        <div id = "js-conversation-div"></div>
        <div id = 'debug'>
            <button onclick = 'malimortacci()'>cliccami</button>
        </div>
        <?php
            include "sediePrenotazione-v0_2.php";
            $dataSerata = "01_02_2020";


            echo "SERATA: $dataSerata";
            $lettereSedie = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3');
            $postiPerFila = array ('a' => 13, 'b' => 13, 'c' => 13, 'd' => 13, 'e' => 13, 'f' => 9, 'g' => 13, 'h' => 13, 'i' => 13, 'l' => 13, 'm' => 13, 'n' => 13, 'sedie' => 15, 'f1' => 10, 'f2' => 9, 'f3' => 10);
            $numeroFile = 16;
            //echo $numeroFile;
            for ( $indiceFila = 1; $indiceFila <= $numeroFile; $indiceFila++){ //in questo for creo tutte le righe in cui consulta il db e poi me stampa a robba
                $filaCorrente = $lettereSedie[$indiceFila-1];
                $postiPerFilaCorrente = $postiPerFila[$filaCorrente];
                $IDFila = 'fila'.$indiceFila;
                echo "<div class = 'fila' id = '$IDFila'>";
                for ($indicePosto = 1; $indicePosto <= $postiPerFilaCorrente; $indicePosto++){
                    $IDPosto = $IDFila.'__'.$indicePosto;
                    $sedile = array(
                        'fila' => $filaCorrente,
                        'posto' => $indicePosto,
                        'stato' => '',
                        'nome_prenotante' => '',
                        'recapito' => ''
                    );
                    $informazioniSedile = visualizzaInformazioniSedile($dataSerata, $sedile); 
                    $statoPosto = $informazioniSedile['stato'];
                    echo ("<div class = 'poltrona'>
                           <p class = 'poltrona_p'  id = '$IDPosto' onload = \"stampaSedile($statoPosto, $IDPosto)\"></p>
                           </div>");                
                }
                echo "</div>
                ---------------------------";
            }
        ?>
        <script src="gestisciPrenotazione.js"></script>
    </body>
</html>