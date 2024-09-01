const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

// Ustawienie parsera do przetwarzania danych z formularza
app.use(bodyParser.urlencoded({ extended: true }));

// Wysyłanie formularza
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form2.html"));
});

// Obsługa żądania z formularza
app.post("/result", (req, res) => {
    const name = req.body.name;
    const languages = req.body.languages || [];
  
    // Sprawdzenie czy podano imię i nazwisko oraz czy zaznaczono język
    if (!name || name.length < 2 || languages.length === 0) {
      res.send('Uzupełnij wszystkie pola formularza!');
    } else {
      res.send(`
        Imię i nazwisko: ${name}<br>
        Języki obce:
        ${languages.map(lang => `<li>${lang}</li>`).join('')}
       `);
    }
  });

app.listen(PORT, () => console.log(`Serwer działa na porcie ${PORT}`));
