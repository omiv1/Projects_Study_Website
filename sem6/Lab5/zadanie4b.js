const express = require('express');
const { check, validationResult } = require('express-validator');
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware do parsowania danych z formularza
app.use(express.urlencoded({ extended: true }));

// Obsługa zapytania GET
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form3.html"));
});

// Definicja trasy POST
app.post("/form", [
  // Walidacja
  check('nazwisko').isLength({ min: 1, max: 25 }).withMessage('Nazwisko musi mieć od 1 do 25 znaków').isAlpha().withMessage('Nazwisko może zawierać tylko litery alfabetu'),
  check('email').isEmail().withMessage('Podaj poprawny adres email'),
  check('wiek').isInt({ min: 0, max: 110 }).withMessage('Wiek musi być liczbą całkowitą od 0 do 110')
], (req, res) => {
  // Obsługa błędów walidacji
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    // Zwracamy listę błędów
    return res.status(422).json({ errors: errors.array().map(error => ({ field: error.param, message: error.msg })) });
  }

  // Pobranie danych z formularza
  const nazwisko = req.body.nazwisko;
  const email = req.body.email;
  const wiek = req.body.wiek;

  // Odesłanie danych użytkownika
  res.send(`
    <h2>Wprowadzone dane:</h2>
    <p>Nazwisko: ${nazwisko}</p>
    <p>Email: ${email}</p>
    <p>Wiek: ${wiek}</p>
  `);
});

// Start serwera
app.listen(PORT, () => {
  console.log(`Serwer działa na porcie ${PORT}`);
});
