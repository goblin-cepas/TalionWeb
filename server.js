var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/views/index.html');
})
    .get('/index', function (req, res) {
        res.sendFile(__dirname + '/views/index.html');
    })
    ;

io.on('connection', function (socket) {
    console.log('a user connected');
    socket.on('connexionUser', function (data) {
        console.log(data);
    });
});

http.listen(80, function () {
    console.log('listening on *:80');
});

