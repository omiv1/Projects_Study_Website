// AuthService.js
import React, { createContext, useContext, useState } from 'react';

const AuthContext = createContext();

export function useAuth() {
    return useContext(AuthContext);
}

export function AuthProvider({ children }) {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(null);

    const value = {
        user,
        token,
        setUser,
        setToken
    };

    return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}