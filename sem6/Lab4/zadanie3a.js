const express = require('express');
const path = require('path');
const app = express();
const PORT = 3000;

// Wysyłanie formularza
app.get("/form", (req, res) => {
  res.sendFile(path.join(__dirname, "form1.html"));
});

// Obsługa żądania z formularza
app.get("/result", (req, res) => {
  let username = req.query.username;
  let password = req.query.password;

  // Sprawdzenie czy pola użytkownika i hasła zostały uzupełnione
  if (!username || !password) {
    res.send("Uzupełnij dane!");
  } else {
    res.send("Użytkownik: " + username + "<br>Hasło: " + password);
  }
});

app.listen(PORT, () => console.log(`Serwer działa na porcie ${PORT}`));
