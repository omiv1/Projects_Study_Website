const http = require("http");
const hostname = "localhost";
const port = 3000;
const server = http.createServer((req, res) => {
    res.statusCode = 200;
    res.setHeader("Content-Type", "text/html");
    res.end(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Aplikacja w Node</title>
        </head>
        <body>
            <h1>Aplikacja w Node</h1>
            <p>To jest odpowiedź HTML</p>
            <ul>
                <li>1.</li>
                <li>2.</li>
                <li>3.</li>
            </ul>
        </body>
        </html>
    `);
});
server.listen(port, hostname, () => {
    console.log(`Server running at http://${hostname}:${port}/`);
});
