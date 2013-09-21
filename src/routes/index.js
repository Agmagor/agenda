fs = require('fs')
var cal = require('ical');
var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

exports.index = function(req, res){
    var str = "";
    cal.fromURL("http://edt.enib.fr/ics.php?username=p0baudry&pass='cDBiYXVkcnk='", {}, function(err, data) {
        for (var k in data){
            if (data.hasOwnProperty(k)) {
                var ev = data[k];
                if (!ev.start) break;
                str+= "Conference " + ev.summary + ' is in ' +  ev.location +  ' on the ' +  ev.start.getDate() +  ' of ' +  months[ev.start.getMonth()] + "\r\n";
                console.log(str);
            }
        }
        res.render('index', { title: 'Ponai', data: str });
    });
};
