const jwt = require('jsonwebtoken');

function tokenVerification(req, res, next) {
    const token = req.headers['x-access-token'];
    if (!token) {
        return res.status(403).send({ message: 'No token provided!' });
    }

    jwt.verify(token, process.env.JWTPRIVATEKEY, (err, decodedUser) => {
        if (err) {
            return res.status(401).send({ message: 'Unauthorized!' });
        }
        req.user = decodedUser;
        next();
    });
}

module.exports = tokenVerification;
