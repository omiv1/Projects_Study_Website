import React from 'react';
import { useParams } from 'react-router-dom';
import { Container, Card } from 'react-bootstrap';

const ProjectDetail = ({ projects }) => {
    const { id } = useParams();

    if (!Array.isArray(projects) || projects.length === 0) {
        return <Container>Loading...</Container>;
    }

    const project = projects.find(p => p._id === id);

    if (!project) {
        return <Container>Project not found</Container>;
    }

    return (
        <Container className="my-3">
            <Card>
                <Card.Body>
                    <Card.Title>{project.projectName}</Card.Title>
                    <Card.Text>
                        <p><strong>Describe:</strong> {project.projectSummary}</p>
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
                    </Card.Text>
                </Card.Body>
            </Card>
        </Container>
    );
};

export default ProjectDetail;
