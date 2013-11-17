var express = require('express');

//scripts
var wrek = require('./wrek');

//express settings
var app = express();
app.set('port', process.env.PORT || 3000);
app.use(express.bodyParser());//for POST


app.get( '/wrek/:id?', wrek.handle ); //DIR method

app.post('/post', function(req, res){ //POST method
    console.log("post req");
    console.log(req.body);
    
    res.send("cool yo");
});

app.listen(3000);
