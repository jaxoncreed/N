var sh = require('execSync');

function run(){
    return sh.exec('ruby app/wrek.rb');
}


exports.run = run
