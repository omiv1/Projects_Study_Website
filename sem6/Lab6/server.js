// server.js

const express = require('express');
const { check, validationResult } = require('express-validator');
const path = require('path');
const users = require('./users'); // Import danych użytkowników

const app = express();
const PORT = 3000;

// Middleware do parsowania danych z formularza
app.use(express.urlencoded({ extended: true }));
app.use(express.json()); // Dodanie obsługi JSON

// Obsługa zapytania GET
app.get("/api/users", (req, res) => {
  res.json(users);
});

// Definicja trasy POST
app.post('/api/users', (req, res) => {
 const newUser = {
 id: users.length + 1,
 name: req.body.name,
 email: req.body.email,
 status: "aktywny"
 };
 if (!newUser.name || !newUser.email) {
 return res.status(400).json({ msg: 'Wprowadź poprawne imię i nazwisko oraz email!' });
 }
 users.push(newUser);
 res.json(users);
});

// Definicja trasy PATCH
app.patch('/api/users/:id', (req, res) => {
 const found = users.some(user => user.id === parseInt(req.params.id));
 if (found) {
 const updUser = req.body;
 users.forEach(user => {
 if (user.id === parseInt(req.params.id)) {
 user.name = updUser.name ? updUser.name : user.name;
 user.email = updUser.email ? updUser.email : user.email;
 res.json({ msg: 'Dane użytkownika zaktualizowane', user });
 }
 });
 } else {
 res.status(400).json({ msg: `Użytkownik o id ${req.params.id} nie istnieje!` });
 }
});

// Definicja trasy DELETE
app.delete('/api/users/:id', (req, res) => {
 const found = users.some(user => user.id === parseInt(req.params.id));
 if (found) {
 res.json({
 msg: 'Użytkownik usunięty',
 users: users.filter(user => user.id !== parseInt(req.params.id))
 });
 } else {
 res.status(400).json({ msg: `Użytkownik o id ${req.params.id} nie istnieje!` });
 }
});

// Start serwera
app.listen(PORT, () => {
 console.log(`Serwer działa na porcie ${PORT}`);
});
