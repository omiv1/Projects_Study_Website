const express = require('express');
const { check, validationResult } = require('express-validator');
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware do parsowania danych z formularza
app.use(express.urlencoded({ extended: true }));

// Obsługa zapytania GET
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form2.html"));
});

// Definicja trasy POST
app.post("/result", [
  // Walidacja imienia i nazwiska
  check('name').isLength({ min: 2 }).withMessage('Imię i nazwisko musi mieć co najmniej 2 znaki'),
  // Walidacja języków
  check('languages').custom((value, { req }) => {
    if (!value || value.length === 0) {
      throw new Error('Wybierz co najmniej jeden język');
    }
    return true;
  })
], (req, res) => {
  // Obsługa błędów walidacji
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    // Zwracamy listę błędów
    return res.status(422).json({ errors: errors.array().map(error => ({ field: error.param, message: error.msg })) });
  }

  // Pobranie danych z formularza
  const name = req.body.name;
  const languages = req.body.languages;

  // Odesłanie danych użytkownika
  res.send(`
    <h2>Wprowadzone dane:</h2>
    <p>Imię i nazwisko: ${name}</p>
    <p>Wybrane języki:</p>
    <ul>
      ${languages.map(language => `<li>${language}</li>`).join('')}
    </ul>
  `);
});

// Start serwera
app.listen(PORT, () => {
  console.log(`Serwer działa na porcie ${PORT}`);
});
