var sh = require('execSync');

var required_args = [];
var optional_args = ['id'];

function run(args){
    cmd = 'ruby app/wrek.rb';
    for(var i=0; i<args.length;i++)
        cmd = cmd + ' ' + args[i];
    return sh.exec(cmd);
}

function handle(req, res){
    console.log('handle request');
        console.log( req.route );
    var args = [];
    for(var i=0; i< required_args.length; i++){
        if (req.params[required_args[i]] !== undefined)
            args.push(req.params[required_args[i]]);
    }
    for(var i=0; i< optional_args.length; i++){
        if (req.params[optional_args[i]] !== undefined)
            args.push(req.params[optional_args[i]]);
    }
    //console.log(req.params[optional_args[i]]);
    console.log(args);
    res.send( run(args).stdout );
}

exports.handle = handle
