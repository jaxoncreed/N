var sh = require('execSync');

function run(args){
    cmd = 'ruby app/wrek.rb';
    for(var i=0; i<args.length;i++)
        cmd = cmd + ' ' + args[i];
    return sh.exec(cmd);
}

function handle(req, res){
    console.log('handle request');
        console.log( req.route );
        console.log( req.params );
    res.send( run([]).stdout );
}

exports.run = run
