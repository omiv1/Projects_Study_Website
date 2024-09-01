const mongoose = require('mongoose');
const bcrypt = require('bcryptjs');
const {methods} = require("express/lib/router/route");
// const {sign} = require("jsonwebtoken");
const jwt = require('jsonwebtoken');

const UserSchema = new mongoose.Schema({
  username: { type: String, required: true, unique: true },
  password: { type: String, required: true },
});

UserSchema.pre('save', async function(next) {
  if (!this.isModified('password')) return next();
  this.password = this.password;
  next();
});

UserSchema.methods.generateAuthToken = function() {
  const token = jwt.sign({ _id: this._id }, process.env.JWTPRIVATEKEY, { expiresIn: '7d' });
  return token;
};

module.exports = mongoose.model('User', UserSchema);
