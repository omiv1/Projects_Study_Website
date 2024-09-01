import React, { useState, useEffect } from 'react';
import { Navbar, Nav, Button } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import logo from '../logo.png'; // Import logo

const NavigationBar = () => {
    const [isLoggedIn, setIsLoggedIn] = useState(false);

    useEffect(() => {
        const token = localStorage.getItem('token');
        setIsLoggedIn(!!token);
    }, []);

    const handleLogout = () => {
        localStorage.removeItem('token');
        setIsLoggedIn(false);
    };

    return (
        <Navbar bg="light" expand="lg">
            <Navbar.Brand as={Link} to="/">
                <img
                    src={logo} // Change to your logo path
                    width="32"
                    height="32"
                    className="d-inline-block align-top"
                    alt="Logo"
                />
            </Navbar.Brand>
            <Navbar.Toggle aria-controls="basic-navbar-nav" />
            <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="mr-auto">
                    <Nav.Link as={Link} to="/projectlist">Project List</Nav.Link>
                    {isLoggedIn && <Nav.Link as={Link} to="/charts">Charts</Nav.Link>}
                </Nav>
                <Nav className="ml-auto">
                    {isLoggedIn ? (
                        <Button variant="outline-danger" onClick={handleLogout}>Logout</Button>
                    ) : (
                        <>
                            <Button variant="outline-success" as={Link} to="/login">Log In</Button>
                            <Button variant="outline-primary" as={Link} to="/register" className="ml-2">Register</Button>
                        </>
                    )}
                </Nav>
            </Navbar.Collapse>
        </Navbar>
    );
};

export default NavigationBar;