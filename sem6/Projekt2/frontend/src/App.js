import React, { useState, useEffect } from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import NavigationBar from './components/NavigationBar';
import ProjectList from './components/ProjectList';
import ProjectDetail from './components/ProjectDetail';
import Chart from './components/Chart';
import Login from './components/Login';
import Register from './components/Register';
import PrivateRoute from './services/PrivateRoute';
import { Container } from 'react-bootstrap';
import api from './services/api'; // Import instancji axios

function App() {
    const [projects, setProjects] = useState([]);

    useEffect(() => {
        const fetchProjects = async () => {
            try {
                const response = await api.get('/projects'); // Użycie nowej instancji axios
                setProjects(response.data);
            } catch (error) {
                console.error('Error fetching projects:', error);
            }
        };

        fetchProjects();
    }, []);

    return (
        <Router>
            <NavigationBar />
            <Container className="mt-4">
                <Routes>
                    <Route path="/" element={<ProjectList projects={projects} />} />
                    <Route path="/projectlist" element={<ProjectList projects={projects} />} />
                    <Route path="/project/:id" element={<ProjectDetail projects={projects} />} />
                    <Route path="/login" element={<Login />} />
                    <Route path="/register" element={<Register />} />
                    <PrivateRoute path="/charts" element={<Chart />} />
                </Routes>
            </Container>
        </Router>
    );
}

export default App;
