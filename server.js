/*
const http = require('http');
var fs = require('fs');
const app = require('express')();

const port = 80;


const server = http.createServer(app);
const io = require('socket.io').listen(server);

app.get('/', function (req, res) {
    loadPage("index", res);
})
    .get('/index', function (req, res) {
        loadPage("index", res);
    })
    .use(function (req, res, next) {
        res.setHeader('Content-Type', 'application/javascript;charset=UTF-8');
        res.status(404).send("Cette page n'existe pas.");
    })
    .listen(port, function (req, res, next) {
        console.log('Server running on port 80');
    });

function loadPage(page, res) {
    console.log('un client accède à la page ' + page);
    fs.readFile(__dirname + '/views/' + page + '.html', 'utf-8', function (error, content) {

        res.end(content);
    });
}

io.on('connection', function (socket) {
    console.log('a user connected');
});
*/

var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);

app.get('/', function (req, res) {
    res.sendFile(__dirname + '/index.html');
});

io.on('connection', function (socket) {
    console.log('a user connected');
});

http.listen(80, function () {
    console.log('listening on *:80');
});

