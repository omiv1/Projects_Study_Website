require('dotenv').config();
const express = require('express');
const cors = require('cors');
const connection = require('./db');
const tokenVerification = require('./middleware/tokenVerification');
const userRoutes = require('./routes/users');
const authRoutes = require('./routes/auth');

const app = express();

// Middleware
app.use(express.json());
app.use(cors());

// Routes that require token verification
app.use('/api/users', tokenVerification, userRoutes);

// Routes that do not require token verification
app.use('/api/auth', authRoutes);

// Connect to database
connection();

const port = process.env.PORT || 8080;
app.listen(port, () => console.log(`Listening on port ${port}`));
