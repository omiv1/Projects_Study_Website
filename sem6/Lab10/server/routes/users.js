const router = require('express').Router();
const { User, validate } = require('../models/user');
const bcrypt = require('bcrypt');
const tokenVerification = require('../middleware/tokenVerification');

// User registration route
router.post('/', async (req, res) => {
  try {
    const { error } = validate(req.body);
    if (error) return res.status(400).send({ message: error.details[0].message });

    const user = await User.findOne({ email: req.body.email });
    if (user) return res.status(409).send({ message: 'User with given email already exists!' });

    const salt = await bcrypt.genSalt(Number(process.env.SALT));
    const hashPassword = await bcrypt.hash(req.body.password, salt);

    await new User({ ...req.body, password: hashPassword }).save();
    res.status(201).send({ message: 'User created successfully' });
  } catch (error) {
    res.status(500).send({ message: 'Internal Server Error' });
  }
});

// Route to get all users (requires authentication)
router.get('/', tokenVerification, async (req, res) => {
  try {
    const users = await User.find();
    res.status(200).send({ data: users, message: 'User list' });
  } catch (error) {
    res.status(500).send({ message: error.message });
  }
});


// Route to get current user details (requires authentication)
router.get('/me', tokenVerification, async (req, res) => {
  try {
    const user = await User.findById(req.user._id);
    if (!user) return res.status(404).send({ message: 'User not found' });
    res.status(200).send(user);
  } catch (error) {
    res.status(500).send({ message: error.message });
  }
});

// Route to delete current user account (requires authentication)
router.delete('/me', tokenVerification, async (req, res) => {
  try {
    const user = await User.findByIdAndDelete(req.user._id);
    if (!user) return res.status(404).send({ message: 'User not found' });
    res.status(200).send({ message: 'User account deleted successfully' });
  } catch (error) {
    res.status(500).send({ message: error.message });
  }
});

module.exports = router;
