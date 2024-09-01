import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import { Form, Button, Container, Row, Col, Alert } from 'react-bootstrap';

const Register = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const response = await axios.post('http://localhost:5000/api/auth/register', { username, password });
      localStorage.setItem('token', response.data.token);

      navigate('/projectlist');
      window.location.reload();
    } catch (error) {
      setError('Rejestracja nie powiodła się');
    }
  };

  return (
      <Container>
        <Row className="justify-content-md-center">
          <Col md="4">
            <h2>Rejestracja</h2>
            {error && <Alert variant="danger">{error}</Alert>}
            <Form onSubmit={handleSubmit}>
              <Form.Group controlId="formUsername">
                <Form.Label>Nazwa użytkownika</Form.Label>
                <Form.Control
                    type="text"
                    placeholder="Wprowadź nazwę użytkownika"
                    value={username}
                    onChange={(e) => setUsername(e.target.value)}
                    required
                />
              </Form.Group>
              <Form.Group controlId="formPassword">
                <Form.Label>Hasło</Form.Label>
                <Form.Control
                    type="password"
                    placeholder="Wprowadź hasło"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    required
                />
              </Form.Group>
              <Button variant="primary" type="submit">
                Zarejestruj się
              </Button>
            </Form>
          </Col>
        </Row>
      </Container>
  );
};

export default Register;
