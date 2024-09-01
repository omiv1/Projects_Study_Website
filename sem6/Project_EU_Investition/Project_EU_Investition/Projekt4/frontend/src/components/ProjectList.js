import React, { useEffect, useCallback } from 'react';
import axios from 'axios';
import { Container, Row, Col, Form, Button, ListGroup, InputGroup } from 'react-bootstrap';
import { Link } from 'react-router-dom';

const wojewodztwa = [
    "Wszystkie", "Cały Kraj", "DOLNOŚLĄSKIE", "KUJAWSKO-POMORSKIE", "LUBELSKIE", "LUBUSKIE",
    "ŁÓDZKIE", "MAŁOPOLSKIE", "MAZOWIECKIE", "OPOLSKIE",
    "PODKARPACKIE", "PODLASKIE", "POMORSKIE", "ŚLĄSKIE",
    "ŚWIĘTOKRZYSKIE", "WARMIŃSKO-MAZURSKIE", "WIELKOPOLSKIE", "ZACHODNIOPOMORSKIE", "Inne"
];

const categoryTranslations = {
    "Education": "Edukacja",
    "Energy": "Energetyka",
    "Research and Innovation": "Badania i Innowacje",
    "Health": "Zdrowie",
    "Transport": "Transport",
    "Society": "Społeczeństwo",
    "Environment": "Środowisko",
    "Culture and Tourism": "Kultura i Turystyka",
    "Administration": "Administracja",
    "Security": "Bezpieczeństwo",
    "Maritime Economy": "Gospodarka Morska",
    "Connectivity and Infrastructure": "Łączność i Infrastruktura",
    "Other": "Inne"
};

function ProjectList({
    projects,
    setProjects,
    setCurrentPage,
    setCategory,
    setLocation,
    setSortField,
    setSortOrder,
    categories,
    sortField,
    sortOrder,
    totalPages,
    currentPage,
    category,
    location,
    setTotalPages
}) {

    const fetchProjects = useCallback(async () => {
        try {
            const token = localStorage.getItem('token');

            if (!token) {
                throw new Error('No token found');
            }

            const response = await axios.get(`http://localhost:5000/api/projects`, {
                params: {
                    page: currentPage,
                    limit: 100,
                    category,
                    location,
                    sortField,
                    sortOrder
                },
                headers: { 'x-access-token': token }
            });

            setProjects(response.data.projects);
            setTotalPages(response.data.totalPages);
        } catch (error) {
            console.error('Error fetching projects', error);
            if (error.response && error.response.status >= 400 && error.response.status <= 500) {
                localStorage.removeItem('token');
                window.location.reload();
            }
        }
    }, [currentPage, category, location, sortField, sortOrder, setProjects, setTotalPages]);

    const handleCategoryChange = (event) => {
        setCategory(event.target.value);
        setCurrentPage(1);
    };

    const handleLocationChange = (event) => {
        setLocation(event.target.value);
        setCurrentPage(1);
    };

    const handleSortChange = (field) => {
        setSortField(field);
        setSortOrder((prevOrder) => (prevOrder === 'asc' ? 'desc' : 'asc'));
    };

    const goToPage = (page) => {
        setCurrentPage(page);
    };

    useEffect(() => {
        fetchProjects();
    }, [fetchProjects]);

    useEffect(() => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }, []);

    return (
        <Container>
            <Row className="my-3">
                <Col md={6}>
                    <InputGroup>
                        <InputGroup.Text>Kategoria</InputGroup.Text>
                        <Form.Control as="select" onChange={handleCategoryChange}>
                            <option value="">Wszystkie</option>
                            {categories.map((category, index) => (
                                <option key={index} value={category}>{categoryTranslations[category] || category}</option>
                            ))}
                        </Form.Control>
                    </InputGroup>
                </Col>
                <Col md={6}>
                    <InputGroup>
                        <InputGroup.Text>Lokalizacja</InputGroup.Text>
                        <Form.Control as="select" onChange={handleLocationChange}>
                            {wojewodztwa.map((location, index) => (
                                <option key={index} value={location}>{location}</option>
                            ))}
                        </Form.Control>
                    </InputGroup>
                </Col>
            </Row>
            <Row className="my-3">
                <Col>
                    <Button
                        variant="outline-primary"
                        onClick={() => handleSortChange('totalProjectValuePLN')}
                        className="w-100"
                    >
                        Wartość Projektu (PLN) {sortField === 'totalProjectValuePLN' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
                <Col>
                    <Button
                        variant="outline-primary"
                        onClick={() => handleSortChange('unionCoFinancingRate')}
                        className="w-100"
                    >
                        Wskaźnik Współfinansowania UE (%) {sortField === 'unionCoFinancingRate' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
                <Col>
                    <Button
                        variant="outline-primary"
                        onClick={() => handleSortChange('euCoFinancingPLN')}
                        className="w-100"
                    >
                        Współfinansowanie UE (PLN) {sortField === 'euCoFinancingPLN' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
            </Row>
            <ListGroup>
                {projects && projects.map(project => (
                    <ListGroup.Item key={project._id}>
                        <Link to={`/projects/${project._id}`}>
                            <h5>{project.projectName}</h5>
                        </Link>
                        <p><strong>Nazwa Beneficjenta:</strong> {project.beneficiaryName}</p>
                        <p><strong>Program:</strong> {project.program}</p>
                        <p><strong>Typ Interwencji: </strong>{project.typeOfIntervention}</p>
                    </ListGroup.Item>
                ))}
            </ListGroup>
            <Row className="my-3">
                <Col>
                    <div className="d-flex justify-content-center align-items-center">
                        <Button variant="light" onClick={() => goToPage(1)} disabled={currentPage === 1}>
                            1
                        </Button>
                        <Button variant="light" onClick={() => goToPage(currentPage - 1)} disabled={currentPage === 1}>
                            &lt;
                        </Button>
                        <div className="mx-2" style={{ fontSize: '1.2rem', fontWeight: 'bold' }}>
                            {currentPage}
                        </div>
                        <Button variant="light" onClick={() => goToPage(currentPage + 1)} disabled={currentPage === totalPages}>
                            &gt;
                        </Button>
                        <Button variant="light" onClick={() => goToPage(totalPages)} disabled={currentPage === totalPages}>
                            {totalPages}
                        </Button>
                    </div>
                </Col>
            </Row>
        </Container>
    );
}

export default ProjectList;
