<?php    
    function creaMatricePosti(){//obsoleta
        $matricePosti = array();
        $numeroFile = 16; //considerando le file A - N, le sedie separate come un'unica fila e le tre file della galleria come tre file separate 
        $numeroPosti = 15; //considerando come n max di posti la fila fittizia delle sedie
        $lettereSedie = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3');
        for($indiceFila = 0; $indiceFila < $numeroFile; $indiceFila++){
            for($indicePosto = 0; $indicePosto < $numeroPosti; $indicePosto++){
                $matricePosti[$indiceFila][$indicePosto] = 'libero';
            }
        }
    } 

    function creaDatabasePosti(){
        include "accediDatabase.php";

        $link=mysqli_connect($host,$username,$password);  

        $str="CREATE DATABASE $dbname";
        $res=mysqli_query($link,$str);
        mysqli_select_db($link, $dbname);
    }

    function creaTabellaPostiEvento($tname){//prepara il db posti se non esiste (parecchia roba commentata da togliere, da sistemare in genere)
        include "accediDatabase.php";

        $link=mysqli_connect($host,$username,$password, $dbname);  
        //var_dump($link);
        $selectDB = mysqli_select_db($link, $dbname);
        if(!$link){
            die("Errore di connessione.".mysqli_error($link));
        }else{
            echo "<p>Connessione riuscita</p>";
        }

        $str="CREATE TABLE $tname(fila CHAR (5), posto INT (15), stato CHAR (8), nome_prenotante CHAR (40), recapito CHAR(100))";
        echo $str;
        $res=mysqli_query($link,$str);
        //echo "<br> $str <br>";
        var_dump($res);
        //$link=mysqli_connect($host,$username,$password, $dbname);        

        $numeroFile = 16; 
        //$numeroPosti = 15;
        $lettereSedie = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3');
        $status = array ('libero', 'occupato', 'non-disponibile', 'nava'); //nava == not available, essenzialmente roba che mi serve per avere una cosa quadrata che funzione (obsoleta)
        //echo "sono qua <br>";
        for($indiceFila = 0; $indiceFila < $numeroFile; $indiceFila++){
            if($indiceFila < 12){ //se la fila è della platea
                if($indiceFila == 5){ //se la fila è la F
                    $indicePosto = 0; 
                    //echo "l'indice e': ".$indiceFila."<br>";
                    do{
                        //echo "l'indice posto e': ".$indicePosto."<br>";
                        $posto = $indicePosto + 1;
                        $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')";//per i posti fittizi, setto lo status 'nava'
                        $res=mysqli_query($link,$str);
                        //echo $res;
                        $indicePosto++;
                    }while ($indicePosto < 9);
                }else{ //se la fila è una qualsiasi altra della platea
                    
                    if($indiceFila % 2 == 0){ //se la fila è pari (a, c, e, g, i, m)
                        //echo "l'indice e': ".$indiceFila."<br>";
                        $indicePosto = 0; 
                        while ($indicePosto < 13){ //per tutti i posti effettivi, setto lo status 'libero'
                            //echo "l'indice posto e': ".$indicePosto."<br>";
                            $posto = $indicePosto + 1;
                            $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')";
                            $res=mysqli_query($link,$str);
                            $indicePosto++;
                        }
                    }else{ //se la fila è dispari (b, d, h, l, m, n)
                        //echo "l'indice e': ".$indiceFila."<br>";
                        $indicePosto = 0;
                        while ($indicePosto < 13){ //per tutti i posti effettivi, setto lo status 'libero'
                            //echo "l'indice posto e': ".$indicePosto."<br>";
                            $posto = $indicePosto + 1;
                            $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')";
                            $res=mysqli_query($link,$str);
                            $indicePosto++;
                        }
                    }
                }
            }else{ //se la fila è della galleria
                if($indiceFila == 12){ //se la fila sono in realtà le sedie
                    //echo "l'indice e': ".$indiceFila."<br>";
                    $indicePosto = 0;
                    while ($indicePosto < 15){ //per tutti i posti effettivi, setto lo status 'libero' (ovvero tutti i posti)
                        //echo "l'indice posto e': ".$indicePosto."<br>";
                        $posto = $indicePosto + 1;
                        $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')"; 
                        $res=mysqli_query($link,$str);
                        $indicePosto++;
                    }
                }else{
                    if($indiceFila == 13 || $indiceFila == 15){ // se le file sono la 13 o la 15
                        //echo "l'indice e': ".$indiceFila."<br>";
                        $indicePosto = 0;
                        while ($indicePosto < 10){ //per tutti i posti effettivi, setto lo status 'libero'
                            //echo "l'indice posto e': ".$indicePosto."<br>";
                            $posto = $indicePosto + 1;
                            $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')";
                            $res=mysqli_query($link,$str);
                            $indicePosto++;
                        }
                    }else{
                        $indicePosto = 0; 
                        while ($indicePosto < 9){ //per tutti i posti effettivi, setto lo status 'libero'
                            //echo "l'indice posto e': ".$indicePosto."<br>";
                            $posto = $indicePosto + 1;
                            //$str="INSERT INTO $tname VALUES($lettereSedie[$indiceFila], $posto, $status[0])"; 
                            $str="INSERT INTO $tname(fila, posto, stato) VALUES('$lettereSedie[$indiceFila]', $posto, '$status[0]')";
                            $res=mysqli_query($link,$str);
                            $indicePosto++;
                            /*echo $str;
                            echo "<br>res vale::";
                            var_dump($res);
                            echo "::<br>";*/                            
                        }
                    }
                }
            }
        }
        mysqli_close($link);
    }

    function eliminaTabella($tbname){ //NOT WORKING??
        include "accediDatabase.php";
        $link = mysqli_connect($host, $username, $password, $dbname);

        if(!$link){
            die("eliminaTabella: Errore di connessione.".mysqli_error($link));
        }else{
            echo "<p>eliminaTabella: Connessione riuscita</p>";
        }
        $str = "DROP TABLE $tbname";
        echo $str;
        $res = mysqli_query($link, $str);
    }

    function nuovaPrenotazione($tbname, $sedile){
        include "accediDatabase.php";
        $link = mysqli_connect($host, $username, $password, $dbname);

        if(!$link){
            die("nuovaPrenotazione: Errore di connessione.".mysqli_error($link));
        }else{
            echo "<p>nuovaPrenotazione: Connessione riuscita</p>";
        }
        var_dump($sedile);
        $nomePrenotante = $sedile["nome_prenotante"];
        $recapito = $sedile["recapito"];
        $fila = $sedile["fila"];
        $posto = $sedile["posto"];
        echo "<br>$nomePrenotante | $recapito | $fila | $posto <br>";

        $str = "UPDATE $tbname 
                SET stato = 'occupato', nome_prenotante = '$nomePrenotante', recapito = '$recapito'
                WHERE fila ='$fila' AND posto = $posto ";
        $res = mysqli_query($link, $str);

        if($res){
            echo $str;
            echo " || Nuova prenotazione effettuata correttamente<br>";
           /* $str = "SELECT nome_prenotante, recapito, fila, posto
                    FROM $tbname
                    WHERE fila = '$fila' AND posto = '$posto'";
            echo $str;
            $res = mysqli_query($link, $str);
            echo $res.nome_prenotante;*/
        }
        else 
            echo "Errore nella nuova prenotazione<br>";
    }
    
    function rimuoviPrenotazione($tbname, $sedile){
        include "accediDatabase.php";
        $link = mysqli_connect($host, $username, $password, $dbname);

        if(!$link){
            die("rimuoviPrenotazione: Errore di connessione.".mysqli_error($link));
        }else{
            echo "<p>rimuoviPrenotazione: Connessione riuscita</p>";
        }
        $fila = $sedile["fila"];
        $posto = $sedile["posto"];
        $str = "UPDATE $tbname 
                SET stato = 'libero', nome_prenotante = null, recapito = null
                WHERE fila = '$fila' AND posto = $posto";
        echo $str;
        $res = mysqli_query($link, $str);
        
        if($res){
            echo $str;
            echo " || Prenotazione rimossa correttamente<br>";
        }            
        else 
            echo "Errore nella rimozione della prenotazione<br>";

    }

    function visualizzaInformazioniSedile($tbname, $sedile){
        include "accediDatabase.php";
        $link = mysqli_connect($host, $username, $password, $dbname);

        if(!$link){
            die("visualizzaInformazioniSedile: Errore di connessione.".mysqli_error($link));
        }else{
            //echo "<p>visualizzaInformazioniSedile: Connessione riuscita</p>";
        }

        $fila = $sedile["fila"];
        $posto = $sedile["posto"];
        $str = "SELECT nome_prenotante, recapito, stato 
                FROM $tbname
                WHERE fila = '$fila' AND posto = '$posto'";
        //echo $str;
        //echo "<br>";
        $res = mysqli_query($link, $str); 
        $visualizzato = mysqli_fetch_assoc($res);
        //var_dump($visualizzato);
        if($visualizzato['stato'] == 'occupato'){            
            //var_dump($visualizzato);
        }else{
            $visualizzato['nome_prenotante'] = '-';
            $visualizzato['recapito'] = '-';                      
            //var_dump($visualizzato);
        }
       
        //echo "Nome prenotante: $visualizzato[0] | Recapito: $visualizzato[1]";
        return $visualizzato; //ritorna un array con due dati: nome_prenotante e recapito
        mysqli_close($link);
    }

    function modificaPrenotazione($tbname, $sedile, $stato){

    }
    /**************************************************************************************************** */
    
    //include "accediDatabase.php";

    //$tbname = 'databaseDiProva';

    //$link=mysqli_connect($host,$username,$password);  
    //if(!mysqli_select_db($link, $dbname)){
    //    creaDatabasePosti();
    //}
//
    //if(!mysqli_query($link, "SELECT * FROM $tbname")){
    //    creaTabellaPostiEvento($tbname);
    //}
//
    //$sedile = array(    //utile per il debug
    //    'fila' => 'a',
    //    'posto' => 1,
    //    'nome_prenotante' => 'gianfranco pieroni',
    //    'recapito' => '3348481306'
    //);
    //var_dump($sedile);
    //$data = "01_02_2020";
    //creaTabellaPostiEvento($data);
    //nuovaPrenotazione($data, $sedile);
    ////rimuoviPrenotazione($data, $sedile);
    ////mysqli_query($link, "DROP DATABASE $dbname"); echo "database dropped";
    //
    //$visualizzato = visualizzaInformazioniSedile($data, $sedile);
//
    ////eliminaTabella($data);
    //mysqli_close($link);
    
    
?>