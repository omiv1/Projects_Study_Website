const express = require('express');
const app = express();
const PORT = 3000;

// Routing dla endpointu głównego
app.get('/', function (req, res) {
  res.send('Prosty serwer oparty na szkielecie programistycznym Express!');
});

// Routing dla endpointu /about
app.get('/about', function (req, res) {
  res.send('Autor strony: Jan Kowalski');
});

// Ustawienie nasłuchiwania serwera na zdefiniowanym porcie
app.listen(PORT, () => {
  console.log(`Serwer działa na porcie: ${PORT}`);
});
