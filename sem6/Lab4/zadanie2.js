const express = require('express');
const app = express();

const PORT = 3000;

// Definicja trasy z parametrem imie
app.get('/name/:imie', (req, res) => {
  const { imie } = req.params;
  res.status(200).type('text/html').send(`<h1>Cześć ${imie}!</h1>`);
});

// Definicja trasy z dwoma parametrami
app.get('/names/:imie1/:imie2', (req, res) => {
  const { imie1, imie2 } = req.params;
  res.status(200).type('text/html').send(`<h1>Cześć ${imie1} i ${imie2}!</h1>`);
});

app.listen(PORT, () => {
  console.log(`Serwer działa na porcie: ${PORT}`);
});
