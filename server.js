var express = require('express');
var app = express();
var favicon = require('serve-favicon');
var https = require('https');
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
var Nightmare = require('nightmare');
var nightmare = Nightmare({ show: true });


var url = "mongodb://localhost:27017/";

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

  socket.on('pageLoading', function (data) {
    if (socket.handshake.session.userdata != null) {
      switch (data.right) {
        case 'Administrateur':
          if (socket.handshake.session.userdata.Administrateur == 'true') { socket.emit('isLegit', { player: socket.handshake.session.userdata }); } else { socket.emit('isNotLegit'); }
          break;
        case 'Recruteur':
          if (socket.handshake.session.userdata.Recruteur == 'true' || socket.handshake.session.userdata.Administrateur == 'true') { socket.emit('isLegit', { player: socket.handshake.session.userdata }); } else { socket.emit('isNotLegit'); }
          break;
        case 'RaidLead':
          if (socket.handshake.session.userdata.RaidLead == 'true' || socket.handshake.session.userdata.Administrateur == 'true') { socket.emit('isLegit', { player: socket.handshake.session.userdata }); } else { socket.emit('isNotLegit'); }
          break;
        case 'Rembourseur':
          if (socket.handshake.session.userdata.Rembourseur == 'true' || socket.handshake.session.userdata.Administrateur == 'true') { socket.emit('isLegit', { player: socket.handshake.session.userdata }); } else { socket.emit('isNotLegit'); }
          break;
        case 'ResponsableEco':
          if (socket.handshake.session.userdata.ResponsableEco == 'true' || socket.handshake.session.userdata.Administrateur == 'true') { socket.emit('isLegit', { player: socket.handshake.session.userdata }); } else { socket.emit('isNotLegit'); }
          break;
        default:
          socket.emit('isLegit', { player: socket.handshake.session.userdata });
          break;
      }
    } else {
      socket.emit('isNotLegit');
    }

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


  socket.on('requestPlayerData', function (data) {
    getCharacterSDeath(data.pseudo);
    //    socket.emit('resultRequestPlayerData', result);
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

function getCharacterSDeath(pseudo) {
  console.log(pseudo);
  var url = 'https://albiononline.com/fr/killboard/search?q=' + pseudo;
  console.log(url);

  var resultat = new Array();
  var path = '';
  var pass1 = nightmare
    .goto(url)
    .wait('a[data-reactid=".0.2.1.1.1.$player0.0"]')
    .click('a[data-reactid=".0.2.1.1.1.$player0.0"]')
    .wait('a[data-reactid=".0.2.1.1.0.0.1.0.0.2.$tbody.$0.$Killer.0.0"]')
    .click('a[data-reactid=".0.2.1.1.0.0.1.0.0.2.$tbody.$0.$Killer.0.0"]')
    .wait('tr[data-reactid=".0.2.1.1.0.0.0.2.0.2.$tbody.$0"]')
    .wait('tr[data-reactid=".0.2.1.1.0.0.0.4.0.2.$tbody.$0"]')
    .evaluate((pseudo) => {
      return $('strong:contains("' + pseudo + '")').parent().parent().parent().next().next().next().children().children().attr('data-reactid')
    }, pseudo)
    .catch(error => {
      console.error('Search failed:', error)
    });

  var pass2 = pass1.then(function (value) {
    return nightmare
      .click('a[data-reactid="' + value + '"]')
      .wait('a[data-reactid=".0.2.1.3.0.0.0.0.2.0.0.0.1.0"]')
      .evaluate((pseudo) => {
        return $('a:contains("' + pseudo + '")').parent().parent().parent().parent().next().children().next().children().attr('data-reactid')
      }, pseudo)
      .catch(error => {
        console.error('Search failed:', error)
      });
  });

  var pass3 = pass2.then(function (value) {
    path = value;
    return nightmare
      .evaluate((value) => {
        return $('div[data-reactid="' + value + '"]').children().attr('src')
      }, value)
  });
  pass3.then(function () { console.log(pass1); console.log(pass2); console.log(pass3); console.log(path);})


  //<img src="https://gameinfo.albiononline.com/api/gameinfo/items/T4_BAG.png?count=1&amp;quality=1" title="T4_BAG" data-reactid=".0.2.1.3.0.0.0.0.2.1.1.$5.0">
  //data-reactid=".0.2.1.3.0.0.0.0.2.1.1"
}




