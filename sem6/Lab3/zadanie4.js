const http = require('http');
const url = require('url');

http.createServer(function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    let q = url.parse(req.url, true).query;
    //let txt = q.year + " " + q.month + " " + q.day;
    let t = "A = " + q.a + ", B = " + q.b + " C = " + q.c;
    //res.end(t);

    let a = parseFloat(q.a);
    let b = parseFloat(q.b);
    let c = parseFloat(q.c);
    
    if (a + b > c && a + c > b && b + c > a) {
        let p = (a + b + c) / 2;
        let pole = Math.sqrt(p * (p - a) * (p - b) * (p - c));
        let txt = `Pole trojkata o bokach ${a}, ${b} i ${c} wynosi: ${pole.toFixed(2)}`;
        res.end(txt);
    } else {
        let txt = "Podane boki nie tworza trojkata";
        res.end(txt);
    }
}).listen(3000);
