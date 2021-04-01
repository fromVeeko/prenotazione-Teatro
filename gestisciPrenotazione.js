var seatOutOfOrder = document.getElementById('seat-out-of-order');
var seatAvailable = document.getElementById('seat-available');
var seatOccupied = document.getElementById('seat-occupied');
var outputDiv = document.getElementById('js-conversation-div');
var seat = [seatOutOfOrder, seatAvailable, seatOccupied];

window.onclick = function(event) {
    if (event.target == document.getElementById('modal-div')) {
        document.getElementById('modal-div').style.display = 'none';
    }
}

function stampaSedile(stato, IDPosto) {
    var posto = document.getElementById(IDPosto);
    //outputDiv.innerHTML = 'posto';
    if (stato == 'libero') {
        posto.innerHTML = "<img class = \"poltronaIMG\" src = \"sediePNG/sediaBianca.png\"   onclick = \"selezionaPostoOnClick('"+IDPosto+"')\"></img>";
    } else {
        if (stato == 'occupato') {
            posto.innerHTML = "<img class = \"poltronaIMG\" src = \"sediePNG/sediaGrigia.png\" onmouseover = \"stampaOccupato('"+IDPosto+"')\" onmouseout = \"killDiv('infoOccupato')\">";
        } else {
            posto.innerHTML = "<img class = \"poltronaIMG\" src = \"sediePNG/sediaNera.png\" onmouseover = \"stampaND('"+IDPosto+"')\" onmouseout = \" killDiv('infoOccupato')\">";
        }
    }
}

function selezionaPostoOnClick(IDPosto) {    
    var posto = document.getElementById(IDPosto);
    var immagineSedile = posto.firstChild;
    if (posto.classList.contains('selezionato')) {
        posto.classList.remove('selezionato');
        posto.firstChild.src = "sediePNG/sediaBianca.png";
    } else {
        posto.classList.add('selezionato');        
        posto.firstChild.src = "sediePNG/sediaNera.png"; 
    }
    //lastChild in questo caso è l'immagine temporanea, mi piacerebbe crearla blu

}

function stampaOccupato(IDPosto) {
    killDiv('infoOccupato');
    var posto = document.getElementById(IDPosto);
    infoDiv = document.createElement('div');
    infoDiv.className = 'infoOccupato';
    infoDiv.innerHTML = "La poltrona &egrave; gi&agrave; occupata";
    posto.parentNode.appendChild(infoDiv);
}

function stampaND(IDPosto) {
    killDiv('infoND');
    var posto = document.getElementById(IDPosto);
    infoDiv = document.createElement('div');
    infoDiv.className = 'infoOccupato';
    infoDiv.innerHTML = "Spiacenti, la poltrona non &grave; disponibile";
    posto.parentNode.appendChild(infoDiv);
}


function informazioniSedilePassaggioMouse(IDPosto) {
    var lettereSedie = new Array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'l', 'm', 'n', 'sedie', 'f1', 'f2', 'f3'); //mi serve per stampare dopo la fila
    
    killDiv('infoSedile');
        
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

    infoDiv.innerHTML = "<button class = 'closeButton' onclick = 'killInformazioniSedile()'>&times;</button><div class = 'infoSedileContenuto'>" + "Fila = " + fila + "<br> Posto = " + nPosto + "</div>";
    
}

function killDiv(className) {
    var arrayClass = document.getElementsByClassName(className);
    var index;
    while (arrayClass.length > 0) {
        index = arrayClass.length - 1;
        var abramoId = arrayClass[index].parentElement.id;
        var abramo = document.getElementById(abramoId); //because isaac is offered to God in the bible. kinda funny
        abramo.removeChild(arrayClass[index]);
    }
}

function nuovaPrenotazione() {
    var postiSelezionati = document.getElementsByClassName('selezionato');
    for (var i = 0; i < postiSelezionati.length; i++){
        console.log(postiSelezionati[i]);
    }

    var modal = document.getElementById("modal-div");

    modal.style.display = "block";
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

function closeModal() {
    console.log('try');
    var modal = document.getElementById('modal-div');
    console.log(modal);
    modal.style.display = 'none';
}

function controllaInput() {
    var name = document.getElementById('nameInput').value;
    var mail = document.getElementById('mailInput').value;
    var tel = document.getElementById('telInput').value;
    document.getElementById('nameCheck').innerHTML = '';
    document.getElementById('telCheck').innerHTML = '';
    document.getElementById('mailCheck').innerHTML = '';
    document.getElementById('formCheck').innerHTML = '';
    var err = 0;
    console.log(name);
    console.log(mail);
    console.log(tel);

    //check sul nome
    for (var i = 0; i < name.length; i++){
        if (!isNaN(name[i]) && name[i] !== ' ') {
            document.getElementById('nameCheck').innerHTML = "Rimuovere i numeri dalla descrizione";
            err++;
        }            
    }

    //check sulla mail
    if ( ( !(mail.includes('@')) || !( mail.includes('.') ) ) && (mail != '')) {
        document.getElementById('mailCheck').innerHTML = "Mail non valida";
        err++;       
    }

    //check sul telefono
    if ((isNaN(tel) || !(tel.length > 9 && tel.length < 13) && tel !== '')) {
        document.getElementById('telCheck').innerHTML = "Numero di telefono non valido";
        err++; 
    }

    if (err === 0) {
        if (name !== '') {
            if (mail !== '' || tel !== '') {
                if(document.getElementsByClassName('selezionato').length === 0)
                    document.getElementById('formCheck').innerHTML = "Nessun posto selezionato!";
                document.getElementById('formSendButton').style.display = 'block';
            } else {
                document.getElementById('formCheck').innerHTML = "Inserire almeno un recapito (mail o telefono)";
            } 
        } else {
            document.getElementById('formCheck').innerHTML = "Inserire nome del prenotante";
        }
                
    }
        
}

function sanitize(string) {
    const map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#x27;',
        "/": '&#x2F;',
        "`": '&grave;'
    };
    const reg = /[&<>"'/]/ig;
    return string.replace(reg, (match)=>(map[match]));
}


function inviaAsinc() {
    var serverResp = document.getElementById('server-comm');
    var request = new XMLHttpRequest();
    var dataSerata = document.getElementById('data-serata').innerText;
    console.log(dataSerata);
    dataSerata = dataSerata.replace("SERATA: ", '').replace("/", "_");
    var nomePrenotante = document.getElementById('nameInput').value.replace(" ", "_");
    var mailPrenotante = document.getElementById('mailInput').value;
    var telPrenotante = document.getElementById('telInput').value;

    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            serverResp.innerHTML = request.responseText;
            if (request.responseText === "Prenotazione effettuata correttamente") {
                setTimeout(function () {
                    window.reload();
                }, 500);
            }
            console.log(request.responseText);
        }
    }

    request.open("POST", "insertIntoDB.php");
    request.setRequestHeader('content-type', 'application/x-www-form-urlencoded');

    //creo la stringa contenente i vari valori
    mailPrenotante = (mailPrenotante === '' ? 'xxx' : mailPrenotante);
    telPrenotante = (telPrenotante === '' ? 'xxx' : telPrenotante);

    var urlEncoded = "dataSerata=" + dataSerata + "&nomePrenotante=" + nomePrenotante + "&mailPrenotante=" + mailPrenotante + "&telPrenotante=" + telPrenotante;

    var postiPrenotati = document.getElementsByClassName('selezionato');
    var contaPosto;

    for (contaPosto = 1; contaPosto <= postiPrenotati.length; contaPosto++){
        urlEncoded += "&posto" + contaPosto + "=" + postiPrenotati[contaPosto - 1].id;
    }
    if (postiPrenotati.length === 0)
        serverResp.innerHTML = "Nessun posto selezionato!";
    else
        request.send(urlEncoded); 
    console.log(urlEncoded);
    
}
