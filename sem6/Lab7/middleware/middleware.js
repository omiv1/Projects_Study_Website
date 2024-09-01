// middleware/autoryzacja.js

const isAuthorized = (req, res, next) => {
    const password = "passwd"; // Ustawienie hasła
  
    // Sprawdzenie
    if (req.headers.authorization === password) {
      next(); // Użytkownik ma dostęp
    } else {
      // Dostęp zabroniony
      res.status(401).send("Dostęp zabroniony");
    }
  };
  
  module.exports = isAuthorized;
  