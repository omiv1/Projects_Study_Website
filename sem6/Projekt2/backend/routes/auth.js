const express = require('express');
const router = express.Router();
const User = require('../models/User');
const jwt = require('jsonwebtoken');
const bcrypt = require('bcryptjs');

router.post('/register', async (req, res) => {
  const { username, password } = req.body;
  try {
    // Hash the password
    const hashedPassword = await bcrypt.hash(password, 10);

    const user = new User({ username, password: hashedPassword });
    await user.save();
    res.status(201).send('User registered');
  } catch (err) {
    res.status(500).send(err.message);
  }
});

router.post('/login', async (req, res) => {
  const { username, password } = req.body;
  try {
    const user = await User.findOne({ username });
    if (!user) {
      console.log(`User ${username} not found`);
      return res.status(401).send('User not found');
    }
    const validPassword = await bcrypt.compare(password, user.password);
    //const hashedPassword = await bcrypt.hash(password, 10);
    //const hashedPassword2 = await bcrypt.hash(hashedPassword, 10);
    // console.log(`Hashed password: ${hashedPassword}`)
    // console.log(`Password provided by user: ${password}`);
    // console.log(`Password stored in database: ${user.password}`);
    // console.log(`Result of password comparison: ${validPassword}`);
    if (!validPassword) {
      return res.status(401).send('Invalid password');
    }
    const token = jwt.sign({ id: user._id }, 'secretkey', { expiresIn: '1h' });
    res.json({ token });
  } catch (err) {
    console.log(err);
    res.status(500).send(err.message);
  }
});

module.exports = router;
