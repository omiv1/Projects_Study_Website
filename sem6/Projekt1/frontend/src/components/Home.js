import React from 'react';
import { Container, Card } from 'react-bootstrap';

const Home = () => {
    return (
        <Container className="my-5">
            <Card className="text-center">
                <Card.Body>
                    <Card.Title>Welcome to the Project Management App</Card.Title>
                    <Card.Text>
                        Manage your projects effectively and efficiently.
                    </Card.Text>
                </Card.Body>
            </Card>
        </Container>
    );
};

export default Home;
