import React, { useEffect, useState } from 'react';
import axios from 'axios';
import { Route, Routes } from 'react-router-dom';
import Home from './components/Home';
import ProjectList from './components/ProjectList';
import ProjectDetail from './components/ProjectDetail';
import Login from './components/Login';
import Register from './components/Register';
import NavigationBar from './components/NavigationBar';

function App() {
    const [projects, setProjects] = useState([]);
    const [totalPages, setTotalPages] = useState(0);
    const [currentPage, setCurrentPage] = useState(1);
    const [type, setType] = useState('');
    const [types, setTypes] = useState([]);
    const [location, setLocation] = useState('Wszystkie');
    const [sortField, setSortField] = useState('');
    const [sortOrder, setSortOrder] = useState('asc');

    useEffect(() => {
        const fetchProjects = async () => {
            try {
                const response = await axios.get(`http://localhost:5000/api/projects?page=${currentPage}&limit=100&type=${type}&location=${location}&sortField=${sortField}&sortOrder=${sortOrder}`);
                setProjects(response.data.projects);
                setTotalPages(response.data.totalPages);
            } catch (error) {
                console.error('Error fetching projects', error);
            }
        };

        const fetchTypes = async () => {
            try {
                const response = await axios.get(`http://localhost:5000/api/type`);
                if (response.data) {
                    setTypes(response.data);
                } else {
                    setTypes([]);
                }
            } catch (error) {
                console.error('Error fetching types', error);
            }
        };

        fetchProjects();
        fetchTypes();
    }, [currentPage, type, location, sortField, sortOrder]);

    return (
        <>
            <NavigationBar />
            <Routes>
                <Route path="/" element={<Home />} />
                <Route path="/projectlist" element={<ProjectList
                    projects={projects}
                    setProjects={setProjects}
                    setCurrentPage={setCurrentPage}
                    setType={setType}
                    setLocation={setLocation}
                    setSortField={setSortField}
                    setSortOrder={setSortOrder}
                    types={types}
                    sortField={sortField}
                    sortOrder={sortOrder}
                    totalPages={totalPages}
                />} />
                <Route path="/projects/:id" element={<ProjectDetail projects={projects} />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
            </Routes>
        </>
    );
}

export default App;
