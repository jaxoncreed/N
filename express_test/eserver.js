var express = require('express');
var params = require('express-params');
var app = express();
var wrek = require('./wrek');




/*app.run_callback = function(error, stdout, stderr) {
    console.log("ER:" + error);
    console.log("SO:" + stdout);
    console.log("SE:" + stderr);
    //if (error !== null)
    this.parent.result = stdout;
    //return stdout;
}*/

/*app.run = function(){
  console.log("runapp called");
  console.log(this);
  require('child_process').exec('cat *.js bad_file | wc -l', this.run_callback);
  //console.log(this.result);
  //console.log("killing command");
  //ls.kill('SIGHUP');
  return this.result;
}*/

/*exec('cat *.js bad_file | wc -l',
  function (error, stdout, stderr) {
    console.log('stdout: ' + stdout);
    console.log('stderr: ' + stderr);
    if (error !== null) {
      console.log('exec error: ' + error);
    }
});*/





app.get('/wrek', function(req, res){
  console.log("request received");
  res.send( wrek.run() );
});


/*app.param('user', function(req, res, next, id){
  User.find(id, function(err, user){
    if (err) {
      next(err);
    } else if (user) {
      req.user = user;
      next();
    } else {
      next(new Error('failed to load user'));
    }
  });
});*/



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
