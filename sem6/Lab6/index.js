const express = require('express');
const app = express();
const PORT = 3000;

const routes = require('./api/routes');

app.use(express.json());

app.use('/api/users', routes);

app.listen(PORT, () => {
  console.log(`Serwer działa na porcie ${PORT}`);
});
