const http = require('http');
const qs = require('querystring');

let items = [];

function show(res) {
    let html = '<html><head><title>Lista zadan</title></head><body>'
             + '<h1>Lista zadan</h1>'
             + '<form method="post" action="/">'
             + '<input type="text" name="item" />'
             + '<input type="submit" value="Dodaj" />'
             + '</form>'
             + '<form method="post" action="/removeAll">'
             + '<input type="submit" value="Skasuj" />'
             + '</form>'
             + '<ul>'
             + items.map(function (item) {
                 return '<li>' + item + '</li>';
               }).join('')
             + '</ul>'
             + '</body></html>';
    res.setHeader('Content-Type', 'text/html');
    res.setHeader('Content-Length', Buffer.byteLength(html));
    res.end(html);
}


function notFound(res) {
    res.statusCode = 404;
    res.setHeader('Content-Type', 'text/plain');
    res.end('Not Found');
}

function badRequest(res) {
    res.statusCode = 400;
    res.setHeader('Content-Type', 'text/plain');
    res.end('Bad Request');
}

function add(req, res) {
    let body = '';
    req.setEncoding('utf8');
    req.on('data', function (chunk) {
        body += chunk;
    });
    req.on('end', function () {
        let obj = qs.parse(body);
        items.push(obj.item);
        show(res);
    });
}

const server = http.createServer(function (req, res) {
    if ('/' == req.url) {
        switch (req.method) {
            case 'GET':
                show(res);
                break;
            case 'POST':
                add(req, res);
                break;
            default:
                badRequest(res);
        }
    } else if ('/removeAll' == req.url && req.method === 'POST') {
        removeAll(req, res);
    } else {
        notFound(res);
    }
});

function removeAll(req, res) {
    items = [];
    show(res);
}


server.listen(3000, () => {
    console.log('Server running at http://localhost:3000/');
});
