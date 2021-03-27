<html>
    <head>
        <title>Prenotazione Posti</title>
        <script src="gestisciPrenotazione.js"></script>
        <link rel = "stylesheet" href = "awesomeStyle.css"></link>
    </head>
    <body>
        <div id = "js-conversation-div"></div>

        <?php
            include "sediePrenotazione-v0_2.php";
            $dataSerata = "01_02_2020";


            echo "<div id = \"data_serata\">SERATA: $dataSerata</div>";
            $lettereSedie = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3');
            $postiPerFila = array ('a' => 13, 'b' => 13, 'c' => 13, 'd' => 13, 'e' => 13, 'f' => 9, 'g' => 13, 'h' => 13, 'i' => 13, 'l' => 13, 'm' => 13, 'n' => 13, 'sedie' => 15, 'f1' => 10, 'f2' => 9, 'f3' => 10);
            $numeroFile = 16;
            //echo $numeroFile;
            for ( $indiceFila = 1; $indiceFila <= $numeroFile; $indiceFila++){ //in questo for creo tutte le righe in cui consulta il db e poi me stampa a robba
                $filaCorrente = $lettereSedie[$indiceFila-1];
                $postiPerFilaCorrente = $postiPerFila[$filaCorrente];
                $IDFila = 'fila'.$indiceFila;
                echo "<div class = 'fila' id = '$IDFila'>
                        <div class = 'nome_fila'>FILA:".strtoupper($filaCorrente)."</div> "; 
                if($filaCorrente != 'sedie'){
                    for ($indicePosto = $postiPerFilaCorrente; $indicePosto >= 1; $indicePosto--){
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
                        echo ("<div class = 'poltrona' id = '$IDPosto'>  
                                                     
                            <script>
                                stampaSedile('{$statoPosto}', '{$IDPosto}');
                            </script>                        
                       </div> \n");      
                                
                    }
                    echo "</div>";
                      
                }else{
                    echo("<div id = \"piano_superiore\">PIANO SUPERIORE</div>");
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
                        switch($indicePosto){
                            case 1:
                                echo("<div class = \"sedie_sx\">"); //essendo il primo, apro il tag
                                break;
                            case 11:
                                echo("</div><div class = \"sedie_dx\">");
                                break;
                        }
                        echo ("<div class = 'poltrona' id = '$IDPosto'>  
                                                         
                                <script>
                                    stampaSedile('{$statoPosto}', '{$IDPosto}');
                                </script>                        
                           </div> \n");
                        if($indicePosto == 15){
                            echo("</div>");
                        }    
                                
                    }
                    echo "</div>";
                }
                
            }
        ?>
        <button type = 'button' id = 'nuovaPrenotazione' onclick="nuovaPrenotazione()">EFFETTUA PRENOTAZIONE</button>
    </body>
</html>