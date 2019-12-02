let conn = new WebSocket('ws://localhost:' + wsPort);
const idMessages = 'chatMessages';

conn.onopen = function(e) {
    console.log('Connection established!');
};

conn.onerror = function(e) {
    console.log('Connection fail!');
}

conn.onmessage = function(e) {
    //console.log(e.data);
    document.getElementById(idMessages).value = document.getElementById(idMessages).value + e.data + '\n';
};

function sendMsg() {
    const msg = document.getElementById('msgInput').value;
    document.getElementById('msgInput').value = '';
    
    if (msg) {
        conn.send(msg);
    }
}
