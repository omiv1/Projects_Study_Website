import React, { useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { useAuth } from './AuthService';

function Chart() {
    const auth = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (!auth.user || !auth.token) {
            navigate('/login');
        }
    }, [auth, navigate]);

    // ... reszta kodu komponentu
}

export default Chart;