var sh = require('execSync');


//depends
var args = {
    required: [],
    optional: ['id']
}
var cmd = 'ruby app/wrek.rb';
var methods = {dir: true, post: true, get: false];
///////////////////////////////////////////////
function _run(args){
    for(var i=0; i<args.length;i++)
        cmd = cmd + ' ' + args[i];
    return sh.exec(cmd);
}

function _handle(inputs, req, res){
    var a = [];
    for(var i=0; i< args.required.length; i++){
        if (inputs[args.required[i]] !== undefined)
            a.push(inputs[args.required[i]]);
    }
    for(var i=0; i< args.optional.length; i++){
        if (inputs[args.optional[i]] !== undefined)
            a.push(inputs[args.optional[i]]);
    }
    //console.log(req.params[optional_args[i]]);
    //console.log(a);
    res.send( _run(a).stdout );
}

function dir_handle(req, res){
    console.log('DIR request');
    _handle(req.params, req, res);
}
function post_handle(req, res){
    console.log("POST request");
    _handle(req.body, req, res);
}

if (methods.dir) exports.dir_handle = dir_handle;
if (methods.post) exports.post_handle = post_handle;
