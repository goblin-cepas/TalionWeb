var express = require('express');
var app = express();
var favicon = require('serve-favicon');
var http = require('http').createServer(app);
var io = require('socket.io')(http),
  session = require("express-session")({
    secret: "my-secret",
    resave: true,
    saveUninitialized: true
  }),
  sharedsession = require("express-socket.io-session");
var MongoClient = require('mongodb').MongoClient;
var assert = require('assert');
var path = require('path')
var fs = require('fs');
const url = "mongodb://localhost:27017/";

app.use(favicon(path.join(__dirname, 'ressources', 'favicon.ico')))
app.use(express.static('ressources'));
app.use(session);
io.use(sharedsession(session));

app.get('/', function (req, res) {
  loadPage("index", res);
})
  .get('/index', function (req, res) {
    loadPage("index", res);
  })
  .get('/inscription', function (req, res) {
    loadPage("inscription", res);
  })
  .get('/users', function (req, res) {
    loadPage("users", res);
  })
  .get('/refundRequest', function (req, res) {
    loadPage("refundRequest", res);
  })
  ;


io.on('connection', function (socket) {
  console.log('a user connected');
  socket.on('connexionUser', function (data) {
    console.log(data);
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myquery = { pseudo: data.pseudo };
      dbo.collection("users").findOne(myquery, function (err, obj) {
        if (err) throw err;
        if (obj != null) {
          if (obj.password == data.password) {
            socket.handshake.session.userdata = obj;
            socket.handshake.session.save();
            socket.emit('session', socket.handshake.session.userdata);
            console.log(socket.handshake.session.userdata);
          } else {
            socket.emit('WrongPassword', { pseudo: data.pseudo });
          }
        } else {
          socket.emit('WrongPseudo', { pseudo: data.pseudo });
        }
        db.close();
      });
    });
  });
  socket.on('documentReady', function () {
    socket.emit('session', socket.handshake.session.userdata);
  });

  socket.on('deconnexionUser', function () {
    console.log("déconnexion User");
    socket.handshake.session.userdata = null;
    socket.handshake.session.save();
    socket.emit('sessionDestroy');
  });
  
  socket.on('findUser', function (data) {
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myquery = { pseudo: data.pseudo };
      dbo.collection("users").findOne(myquery, function (err, obj) {
        if (err) throw err;
        console.log(data.pseudo);
        if (obj != null) {
          socket.emit('userExist', { pseudo: data.pseudo });
        } else {
          socket.emit('userDidntExist');
        }
        db.close();
      });
    });
  });
  socket.on('createUser', function (data) {
    console.log(data);
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myobj = { pseudo: data.pseudo, password: data.password, Administrateur: "false", Rembourseur: "false", Recruteur: "false", RaidLead: "false", ResponsableEco: "false" };
      dbo.collection("users").insertOne(myobj, function (err, res) {
        if (err) throw err;
        console.log("un utilisateur a été ajouté");
        db.close();
      });
    });
  });
  socket.on('requireUsers', function (data) {
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      dbo.collection("users").find({}).toArray(function (err, result) {
        if (err) throw err;
        socket.emit('resultUsers', result);
        db.close();
      });
    });
  });
  socket.on('supprimerUser', function (data) {
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myquery = { pseudo: data.pseudo };
      dbo.collection("users").deleteOne(myquery, function (err, obj) {
        if (err) throw err;
        console.log("un utilisateur a été supprimé");
        db.close();
      });
    });
  });

  socket.on('updateUser', function (data) {
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myquery = { pseudo: data.pseudo };
      var newvalues;
      switch (data.attribut) {
        case 'Administrateur':
          newvalues = { $set: { Administrateur: data.value } };
          break;
        case 'Rembourseur':
          newvalues = { $set: { Rembourseur: data.value } };
          break;
        case 'Recruteur':
          newvalues = { $set: { Recruteur: data.value } };
          break;
        case 'RaidLead':
          newvalues = { $set: { RaidLead: data.value } };
          break;
        case 'ResponsableEco':
          newvalues = { $set: { ResponsableEco: data.value } };
          break;
        default:
          console.log('Erreur lors de l\'update de' + data.pseudo);
      }
      dbo.collection("users").updateOne(myquery, newvalues, function (err, res) {
        if (err) throw err;
        console.log(data.pseudo + " a été modifié");
        MongoClient.connect(url, function (err, db) {
          if (err) throw err;
          var dbo = db.db("Talion");
          dbo.collection("users").findOne({ pseudo: data.pseudo }, function (err, result) {
            if (err) throw err;
            console.log(result);
            socket.emit('userUpdated', result);
            db.close();
          });
        });
        db.close();
      });
    });

  });
  socket.on('fileSended', function (data) {
    console.log('file')
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