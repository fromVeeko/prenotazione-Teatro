var seatOutOfOrder = document.getElementById('seat-out-of-order');
var seatAvailable = document.getElementById('seat-available');
var seatOccupied = document.getElementById('seat-occupied');
var outputDiv = document.getElementById('js-conversation-div');
var seat = [seatOutOfOrder, seatAvailable, seatOccupied];


function stampaSedile(stato, IDPosto) {
    var posto = document.getElementById(IDPosto);
    //outputDiv.innerHTML = 'posto';
    if (stato == 'libero') {
        posto.innerHTML = "<img src = \"sediePNG/sediaBianca.png\"  width = '5%' onmousedown = \"informazioniSedilePassaggioMouse('"+IDPosto+"')\"></img>";
    } else {
        if (stato == 'occupato') {
            posto.innerHTML = "<img src = \"sediePNG/sediaGrigia.png\" width = '5%' onmousedown = \"informazioniSedilePassaggioMouse('"+IDPosto+"')\">";
        } else {
            posto.innerHTML = "<img src = \"sediePNG/sediaNera.png\" width = '5%' onmousedown = \"informazioniSedilePassaggioMouse('"+IDPosto+"')\">";
        }
    }
}

function informazioniSedilePassaggioMouse(IDPosto) {
    var lettereSedie = new Array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3'); //mi serve per stampare dopo la fila
    
    killInformazioniSedile();
        
    var fila = IDPosto.toString().slice(4, 6);
    var nPosto = IDPosto.slice(7);
    nPosto = nPosto.replace('_', '');
    fila = lettereSedie[fila.replace('_', '') - 1]; //in queste due righe pulisco la roba
    
    var parentDivId = document.getElementById(IDPosto).parentElement.id;
    /*console.log(IDPosto);
    console.log(fila);
    console.log(parentDivId);*/
    if (fila == 'sedie') { //almeno se è una poltrona-sedia la appende subito sotto la sedia e non sotto tutte le sedie. più leggibile
        var parentDiv = document.getElementById(IDPosto);
        //console.log(parentDiv);
    } else {
        var parentDiv = document.getElementById(parentDivId);
    }

    var infoDiv = document.createElement('div');
    infoDiv.className = 'infoSedile';
    parentDiv.appendChild(infoDiv);   

    infoDiv.innerHTML ="<button class = 'closeButton' onclick = 'killInformazioniSedile()'>&times;</button><div class = 'infoSedileContenuto'>" + "Fila = " + fila + "<br> Posto = " + nPosto + "</div>";
}

function killInformazioniSedile() {
    var arrayClassInfoSedile = document.getElementsByClassName('infoSedile');
    var index;
    while (arrayClassInfoSedile.length !== 0) {
        index = arrayClassInfoSedile.length - 1;
        var abramoId = arrayClassInfoSedile[index].parentElement.id;
        var abramo = document.getElementById(abramoId); //because isaac is offered to God in the bible. kinda funny
        abramo.removeChild(arrayClassInfoSedile[index]);
    }
}

function nuovaPrenotazione() {
    var alertDiv = document.createElement('div');
    alertDiv.id = 'alertDiv-nuovaPrenotazione';
    document.body.appendChild(alertDiv);
    alertDiv.innerHTML = 'Seleziona i posti che desideri';

    //cliccando nuovamente sul pulsante 'effettua prenotazione' (che ora cambia valore) si chiude la roba
    var buttonEP = document.getElementById('nuovaPrenotazione'); //eP = effettua prenotazione 
    buttonEP.style.visibility = 'hidden';
    var buttonTSP = document.getElementById('terminaSelezPosti');
    //console.log(buttonTSP);
    if (buttonTSP === null) {
        //console.log('in');
        var buttonTSP = document.createElement('button'); //TSP: termina selezione posti
        buttonTSP.id = 'terminaSelezPosti';
        buttonTSP.innerHTML = "CHIUDI SELEZIONE";
        document.body.appendChild(buttonTSP);
        buttonTSP.setAttribute("onclick", "terminaSelezPosti()"); 
               
        buttonTSP = document.getElementById('terminaSelezPosti');
        //console.log(buttonTSP);
    } else {
        buttonTSP.style.visibility = 'visible';
    }
    //selezionaPosti();
    /******************************************************* */
    /*
    var TSPVisibility = buttonTSP.style.visibility;
    var count = 0;
    console.log(buttonTSP.style.visibility);
    console.log('porcoggiuda');
    while (TSPVisibility === 'visible') {
        count++;
        console.log(count);
        document.addEventListener(`click`, function (e) {
            console.log(e.target.id);
        })
        TSPVisibility = buttonTSP.style.visibility;
    }*/
    
}

function terminaSelezPosti() {
    //console.log('qua');
    var buttonEP = document.getElementById('nuovaPrenotazione');
    var buttonTSP = document.getElementById('terminaSelezPosti');
    var alertDiv = document.getElementById('alertDiv-nuovaPrenotazione');
    buttonEP.style.visibility = 'visible';
    //if(buttonTSP !== null)
        buttonTSP.style.visibility = 'hidden';
    document.body.removeChild(alertDiv);
}

function selezionaPosti() {
    var buttonTSP = document.getElementById('terminaSelezPosti');
    var TSPVisibility = window.getComputedStyle(buttonTSP).visibility;
    console.log(TSPVisibility);
    var count = 0;
    while (TSPVisibility === 'visible') {
        document.addEventListener(`click`, function (e) {
            console.log('id target:');
            console.log(e.target.id);
        })
        TSPVisibility = window.getComputedStyle(buttonTSP).visibility;
    }

}

