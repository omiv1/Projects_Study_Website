import React from 'react';
import { Container, Card, Row, Col } from 'react-bootstrap';

const Home = () => {
    return (
        <Container className="my-5">
            <Card className="text-center">
                <Card.Body>
                    <Card.Title>Witamy w aplikacji</Card.Title>
                    <Card.Text>
                        Aplikacje możliwia wizualizajcę i przeglądanie realizowanych inwestycji.
                    </Card.Text>
                </Card.Body>
            </Card>
            <Card className="mt-4">
                <Card.Body>
                    <Card.Title>Użyte Technologie</Card.Title>
                    <Row>
                        <Col md={6}>
                            <h5>Frontend</h5>
                            <ul>
                                <li>React</li>
                                <li>Bootstrap</li>
                                <li>Recharts</li>
                            </ul>
                        </Col>
                        <Col md={6}>
                            <h5>Backend</h5>
                            <ul>
                                <li>Node.js</li>
                                <li>Express.js</li>
                                <li>MongoDB</li>
                            </ul>
                        </Col>
                    </Row>
                </Card.Body>
            </Card>
            <Card className="mt-4">
                <Card.Body>
                    <Card.Title>Źródło Bazy Danych</Card.Title>
                    <Card.Text>
                        Dane do tego projektu pochodzą z bazy danych MongoDB hostowanej online.
                    </Card.Text>
                </Card.Body>
            </Card>
        </Container>
    );
};

export default Home;
