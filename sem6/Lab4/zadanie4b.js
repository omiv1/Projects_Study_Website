const express = require('express');
const { check, validationResult } = require('express-validator');
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware do parsowania danych z formularza
app.use(express.urlencoded({ extended: true }));

// Własna metoda oczyszczająca, usuwająca wszystkie litery oprócz pierwszych, tworząca inicjały
const createInitials = value => {
  const names = value.split(' ');
  const initials = names.map(name => name.charAt(0).toUpperCase()).join('');
  return initials;
};

// Obsługa zapytania GET
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form3.html"));
});

// Definicja trasy POST
app.post("/form", [
  // Walidacja
  check('nazwisko')
    .trim()
    .isLength({ min: 1, max: 25 }).withMessage('Nazwa musi mieć od 1 do 25 znaków')
    //.matches(/^[A-Z][a-ząćęłńóśźż]*$/).withMessage('Nazwisko musi zaczynać się wielką literą i zawierać tylko litery alfabetu')
    .bail()
    .customSanitizer(value => createInitials(value)),
  check('email').isEmail().withMessage('Podaj poprawny adres email').normalizeEmail(),
  check('wiek').isInt({ min: 0, max: 110 }).withMessage('Wiek musi być liczbą całkowitą od 0 do 110').stripLow()
], (req, res) => {
  // Obsługa błędów walidacji
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    // Zwracamy listę błędów
    return res.status(422).json({ errors: errors.array().map(error => ({ field: error.param, message: error.msg })) });
  }

  // Pobranie danych z formularza
  const imie = req.body.imie;
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
