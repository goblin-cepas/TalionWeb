var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var MongoClient = require('mongodb').MongoClient;
var assert = require('assert');
var fs = require('fs');
const url = "mongodb://localhost:27017/";

/*
MongoClient.connect(url, function(err, db) {
    if (err) throw err;
    var dbo = db.db("Talion");
    var myobj = { name: "Company Inc", address: "Highway 37" };
    dbo.collection("customers").insertOne(myobj, function(err, res) {
      if (err) throw err;
      console.log("1 document inserted");
      db.close();
    });
  }); 
*/

MongoClient.connect(url, function (err, db) {
  if (err) throw err;
  var dbo = db.db("Talion");
  dbo.collection("customers").findOne({}, function (err, result) {
    if (err) throw err;
    console.log(result.name);
    db.close();
  });
});

app.get('/', function (req, res) {
  loadPage("index", res);
})
  .get('/index', function (req, res) {
    loadPage("index", res);
  })
  .get('/inscription', function (req, res) {
    loadPage("inscription", res);
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

function loadPage(page, res) {
  res.write(fs.readFileSync(__dirname + '/views/header.html', 'utf8'));
  res.write(fs.readFileSync(__dirname + '/views/' + page + '.html', 'utf8'));
  res.write(fs.readFileSync(__dirname + '/views/footer.html', 'utf8'));
  res.end();
}