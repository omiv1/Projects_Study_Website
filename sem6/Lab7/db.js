// db.js

const mongoose = require('mongoose');

const connectDB = () => {
    mongoose.connect("mongodb+srv://Student:1234@cluster0.wktpfom.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0")
        .then((result) => {
            console.log("Połączono z bazą")
        }).catch((err) => {
        console.log("Nie można połączyć się z MongoDB. Błąd: " + err)
    });
}

module.exports = connectDB;