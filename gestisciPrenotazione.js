var seatOutOfOrder = document.getElementById('seat-out-of-order');
var seatAvailable = document.getElementById('seat-available');
var seatOccupied = document.getElementById('seat-occupied');
var outputDiv = document.getElementById('js-conversation-div');
var seat = [seatOutOfOrder, seatAvailable, seatOccupied];


function stampaSedile(stato, IDPosto) {
    console.log('1');
    var posto = document.getElementById(IDPosto);
    outputDiv.innerHTML = 'posto';
    if (stato == 'libero') {
        posto.innerHTML = stato+" ahahNO";
        posto.innerHTML = seatAvailable;
        posto.innerHTML = "<img src = \"sediePNG/sediaVerde.png\"  width = '2%' ></img>"
    } else {
        if (stato == 'occupato') {
            posto.innerHTML = `${stato} bweaf`;
            posto.innerHTML = seatOccupied;
        } else {
            posto.innerHTML = `${stato} ffffO`;
            posto.innerHTML = seatOutOfOrder;
        }
    }
}

function malimortacci() {
    var outputDiv = document.getElementById('js-conversation-div');
    outputDiv.innerHTML = 'memWHWHHWHWma';
}