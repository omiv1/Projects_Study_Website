// api/routes.js
const express = require('express');
const router = express.Router();

const users = require("../users");
const metoda = require('../middleware/middleware');

router.use(metoda);

router.get('/', (req, res) => {
  res.json(users);
});

router.get('/:id', (req, res) => {
  const id = parseInt(req.params.id);
  const user = users.find(user => user.id === id);
  if (!user) {
    return res.status(404).json({ message: "Użytkownik o podanym ID nie został znaleziony" });
  }
  res.json(user);
});

router.post('/', (req, res) => {
    const newUser = req.body;
    
    let newId;
    if (users.length > 0) {
      let maxId = users[0].id;
      for (let i = 1; i < users.length; i++) {
        if (users[i].id > maxId) {
          maxId = users[i].id;
        }
      }
      newId = maxId + 1;
    } else {
      newId = 1;
    }
    
    newUser.id = newId;
    
    users.push(newUser);
    
    res.status(201).json(newUser);
  });
  
  router.delete('/:id', (req, res) => {
    const id = parseInt(req.params.id);
    
    // Znalezienie indeksu użytkownika do usunięcia
    const userIndex = users.findIndex(user => user.id === id);
    if (userIndex === -1) {
      return res.status(404).json({ message: "Użytkownik o podanym ID nie został znaleziony" });
    }
    
    // Zastąpienie elementu do usunięcia pustym obiektem
    users[userIndex] = {};
    
    res.status(204).send();
  });
  


module.exports = router;
