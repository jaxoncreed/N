var express = require('express');
var params = require('express-params');
var app = express();
var wrek = require('./wrek');



/*app.get('/wrek', function(req, res){
    console.log('/wrek request');
    res.send = wrek.run();
});*/

/*app.get('/wrek', function(req, res){ // /^\/wrek\/[0-9]+$/
    console.log('/wrek request');
    res.send( wrek.run([]).stdout );
});*/

/*app.param(':id', function(d){
    return parseInt(d);
});*/

app.get('/wrek/:id?/:meow?', wrek.handle );

console.log(app.routes);


app.listen(3000);


/*
    FUNCTIONS
    /function_name
    /function_name  | (POST arguments)
    /function_name/first_argument
    /function_name?GET=arguments
    
    REST OBJECTS
    /class_name/new                 -> return instanceid
    /class_name/instanceid          -> return object (without methods)
    /class_name/instanceid/property -> return instance.property
    /class_name/instanceid/method   -> retrun result of
        (ARGS: POST or GET)

    LIBRARIES
    /library/method
    /library/method  | (POST arguments)
    /library/method/first_argument
    /library/method?GET=arguments

*/