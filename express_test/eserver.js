var express = require('express');
//var params = require('express-params');

//scripts
var wrek = require('./wrek');

//express settings
var app = express();
//app.use(express.json());
//app.use(express.urlencoded()); //for POST
app.set('port', process.env.PORT || 3000);

app.use(express.bodyParser());


app.get( '/wrek/:id?', wrek.handle ); //DIR method

app.post('/post', function(req, res){
    console.log("post req");
    console.log(req.body);
    
    res.send("cool yo");
});


console.log(app.routes);


app.listen(3000);
