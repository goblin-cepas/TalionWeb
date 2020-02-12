var app = require('express')();
var http = require('http').createServer(app);
var io = require('socket.io')(http);
var MongoClient = require('mongodb').MongoClient;
var assert = require('assert');
var fs = require('fs');
const url = "mongodb://localhost:27017/";

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
  ;

io.on('connection', function (socket) {
  console.log('a user connected');
  socket.on('connexionUser', function (data) {
    console.log(data);
  });
  socket.on('createUser', function (data) {
    console.log(data);
    MongoClient.connect(url, function (err, db) {
      if (err) throw err;
      var dbo = db.db("Talion");
      var myobj = { pseudo: data.pseudo, password: data.password, Administrateur: data.isAdmin, Rembourseur: data.isRembourseur, Recruteur: data.isRecruteur, RaidLead: data.isRaidLead, ResponsableEco: data.isEco };
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