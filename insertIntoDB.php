<?php
    include "sediePrenotazione-v0_2.php";
    include "accediDatabase.php";
    //var_dump($_POST);
    $link=mysqli_connect($host,$username,$password);  
    $dataSerata = mysqli_real_escape_string($link, $_POST['dataSerata']); //che poi è il nome della tabella del database

    $nomePrenotante = mysqli_real_escape_string($link, $_POST['nomePrenotante']);
    $mailPrenotante = mysqli_real_escape_string($link, $_POST['mailPrenotante']);
    $telPrenotante = mysqli_real_escape_string($link, $_POST['telPrenotante']);
    $lettereSedie = array ('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3');
    $postiPrenotati =  [];
    $conta = 0;
    $provaDiOutput = $nomePrenotante." ".$mailPrenotante.$telPrenotante;
    foreach ($_POST as $posto){
        if($conta > 3){ //3 perchè prima ha il campo dataSerata, nome, mail, tel
            array_push($postiPrenotati, $posto);
            $provaDiOutput .= $posto;
        }            
        $conta++;
    }
    $err = 0;
    for ($i = 0; $i < strlen($nomePrenotante); $i++){
        if (is_numeric($nomePrenotante[$i]) && $nomePrenotante[$i] !== ' '){
            $err++; 
            $added = "Correggere il nome";   
        }
                 
    }

    if ( ( !(str_contains($mailPrenotante, '@')) || !( str_contains($mailPrenotante, '.') ) ) && ($mailPrenotante !== 'xxx')){
        $err++;
        $added = "Correggere la mail";
    }
        
    if($telPrenotante != "xxx"){
        if (  !is_numeric($telPrenotante) || !( strlen($telPrenotante) > 9 && strlen($telPrenotante) < 13 ) ){
            $err++;
            $added = "Correggere il numero di telefono";
        } 
    }
    
    
    if($err !== 0){
        echo("Prenotazione non valida. ".$added);
        die;
    }else{
        //echo("Attenzione! Nessun posto selezionato");
        $recapito = $mailPrenotante." || ".$telPrenotante;
        $contaPrenotazioniCorrette = 0;
        foreach($postiPrenotati as $posto){
            $filaPosto = (int)substr($posto, 4, 2);
            $numeroPosto = (int)substr($posto, 8, 2);
            if(!(is_numeric($filaPosto) || is_numeric($numeroPosto))){
                //echo ("Prenotazione non valida. Errore interno");
                die;
            }else{                
                //echo("cosa non sta funzionando pt2");
                $sedile = array(
                    'fila' => $lettereSedie[$filaPosto - 1],
                    'posto' => $numeroPosto,
                    'nome_prenotante' => $nomePrenotante,
                    'recapito' => $recapito    
                );
                $contaPrenotazioniCorrette += nuovaPrenotazione($dataSerata, $sedile); //nuovaPrenotazione ritorna 1 se tutto va a buon fine, 0 altrimenti
            }
            if($contaPrenotazioniCorrette === 0)
                break;
        }

        if($contaPrenotazioniCorrette ===  count($postiPrenotati) ){
            echo ("La prenotazione &egrave; avvenuta correttamente");
        }
        else{
            echo("&Egrave; avvenuto un errore");
            foreach($postiPrenotati as $posto){
                $sedile = array(
                    'fila' => $lettereSedie[$filaPosto - 1],
                    'posto' => $numeroPosto,
                    'nome_prenotante' => $nomePrenotante,
                    'recapito' => $recapito    
                );
                rimuoviPrenotazione($dataSerata, $sedile);
            }
        }
    }
  
    mysqli_close($link);
    
?>