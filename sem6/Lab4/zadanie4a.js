const express = require('express');
const { check, validationResult } = require('express-validator');
const path = require('path');

const app = express();
const PORT = 3000;

// Middleware do parsowania danych z formularza
app.use(express.urlencoded({ extended: true }));

// Obsługa zapytania GET na ścieżce /form
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form3.html"));
});

// Definicja trasy POST dla formularza z walidacją danych
app.post("/form", [
  check('nazwisko').isLength({ min: 3 }).withMessage('Nazwisko musi zawierać co najmniej 3 znaki'),
  check('email').isEmail().withMessage('Podaj poprawny adres email'),
  check('wiek').isNumeric().withMessage('Wiek musi być liczbą')
], (req, res) => {
  // Obsługa błędów walidacji
  const errors = validationResult(req);
  if (!errors.isEmpty()) {
    return res.status(422).json({ errors: errors.array() });
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
