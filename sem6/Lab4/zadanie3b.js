const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');

const app = express();
const PORT = 3000;

app.use(bodyParser.urlencoded({ extended: true }));

// Wysyłanie formularza
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form2.html"));
});

app.post("/result", (req, res) => {
    const name = req.body.name;
    const languages = req.body.languages || [];
  
    // Walidacja
    if (!name || name.length < 2 || languages.length === 0) {
      res.send('Uzupełnij wszystkie pola formularza!');
    } else {
      res.send(`
    <h2>Wprowadzone dane:</h2>
    <p>Imię i nazwisko: ${name}</p>
    <p>Wybrane języki:</p>
    <ul>
      ${languages.map(language => `<li>${language}</li>`).join('')}
    </ul>
  `);
    }
  });

app.listen(PORT, () => console.log(`Serwer działa na porcie ${PORT}`));
