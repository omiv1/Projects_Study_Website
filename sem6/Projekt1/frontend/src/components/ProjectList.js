import React, { useState } from 'react';
import { Container, Row, Col, Form, Button, ListGroup } from 'react-bootstrap';
import { Link } from 'react-router-dom';

const wojewodztwa = [
    "Wszystkie", "Cały Kraj", "DOLNOŚLĄSKIE", "KUJAWSKO-POMORSKIE", "LUBELSKIE", "LUBUSKIE",
    "ŁÓDZKIE", "MAŁOPOLSKIE", "MAZOWIECKIE", "OPOLSKIE",
    "PODKARPACKIE", "PODLASKIE", "POMORSKIE", "ŚLĄSKIE",
    "ŚWIĘTOKRZYSKIE", "WARMIŃSKO-MAZURSKIE", "WIELKOPOLSKIE", "ZACHODNIOPOMORSKIE", "Inne"
];

function ProjectList({ projects, setProjects, setCurrentPage, setType, setLocation, setSortField, setSortOrder, types, sortField, sortOrder, totalPages }) {
    const [currentPage, setCurrentPageState] = useState(1);

    const handleTypeChange = (event) => {
        setType(event.target.value);
        setCurrentPageState(1);
    };

    const handleLocationChange = (event) => {
        setLocation(event.target.value);
        setCurrentPageState(1);
    };

    const handleSortChange = (field) => {
        setSortField(field);
        setSortOrder((prevOrder) => (prevOrder === 'asc' ? 'desc' : 'asc'));
    };

    return (
        <Container>
            <Row className="my-3">
                <Col>
                    <Form.Group controlId="formType">
                        <Form.Label>Type</Form.Label>
                        <Form.Control as="select" onChange={handleTypeChange}>
                            {types.map((type, index) => (
                                <option key={index} value={type}>{type}</option>
                            ))}
                        </Form.Control>
                    </Form.Group>
                </Col>
                <Col>
                    <Form.Group controlId="formLocation">
                        <Form.Label>Location</Form.Label>
                        <Form.Control as="select" onChange={handleLocationChange}>
                            {wojewodztwa.map((location, index) => (
                                <option key={index} value={location}>{location}</option>
                            ))}
                        </Form.Control>
                    </Form.Group>
                </Col>
            </Row>
            <Row className="my-3">
                <Col>
                    <Button variant="link" onClick={() => handleSortChange('totalProjectValuePLN')}>
                        Total Project Value (PLN) {sortField === 'totalProjectValuePLN' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
                <Col>
                    <Button variant="link" onClick={() => handleSortChange('unionCoFinancingRate')}>
                        Union Co-Financing Rate (%) {sortField === 'unionCoFinancingRate' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
                <Col>
                    <Button variant="link" onClick={() => handleSortChange('euCoFinancingPLN')}>
                        EU Co-Financing (PLN) {sortField === 'euCoFinancingPLN' ? (sortOrder === 'asc' ? '↑' : '↓') : ''}
                    </Button>
                </Col>
            </Row>
            <ListGroup>
                {projects && projects.map(project => (
                    <ListGroup.Item key={project._id}>
                        <Link to={`/projects/${project._id}`}>
                            <h5>{project.projectName}</h5>
                        </Link>
                        <p><strong>Contract Number:</strong> {project.contractNumber}</p>
                        <p><strong>Beneficiary Name:</strong> {project.beneficiaryName}</p>
                        <p><strong>Fund:</strong> {project.fund}</p>
                        <p><strong>Specific Objective:</strong> {project.specificObjective}</p>
                        <p><strong>Program:</strong> {project.program}</p>
                        <p><strong>Priority:</strong> {project.priority}</p>
                        <p><strong>Measure:</strong> {project.measure}</p>
                        <p><strong>Total Project Value (PLN):</strong> {project.totalProjectValuePLN}</p>
                        <p><strong>Union Co-Financing Rate (%):</strong> {project.unionCoFinancingRate}</p>
                        <p><strong>EU Co-Financing (PLN):</strong> {project.euCoFinancingPLN}</p>
                        <p><strong>EURO Exchange Rate:</strong> {project.euroExchangeRate}</p>
                        <p><strong>Project Location:</strong> {project.projectLocation}</p>
                        <p><strong>Project Start Date:</strong> {new Date(project.projectStartDate).toLocaleDateString()}</p>
                        <p><strong>Project End Date:</strong> {new Date(project.projectEndDate).toLocaleDateString()}</p>
                        <p><strong>Type of Intervention:</strong> {project.typeOfIntervention}</p>
                    </ListGroup.Item>
                ))}
            </ListGroup>
            <Row className="my-3">
                <Col>
                    <div className="d-flex justify-content-center">
                        <Button variant="light" onClick={() => {setCurrentPageState(1); setCurrentPage(1);}} disabled={currentPage === 1}>
                            Pierwsza
                        </Button>
                        <Button variant="light" onClick={() => {setCurrentPageState(currentPage - 1); setCurrentPage(currentPage - 1);}} disabled={currentPage === 1}>
                            &lt;
                        </Button>
                        <div className="mx-2">
                            {currentPage}
                        </div>
                        <Button variant="light" onClick={() => {setCurrentPageState(currentPage + 1); setCurrentPage(currentPage + 1);}} disabled={currentPage === totalPages}>
                            &gt;
                        </Button>
                        <Button variant="light" onClick={() => {setCurrentPageState(totalPages); setCurrentPage(totalPages);}} disabled={currentPage === totalPages}>
                            Ostatnia
                        </Button>
                    </div>
                </Col>
            </Row>
        </Container>
    );
}

export default ProjectList;