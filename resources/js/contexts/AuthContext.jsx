import React, { createContext, useContext, useState, useEffect } from 'react';
import axios from 'axios';

const AuthContext = createContext();

export const useAuth = () => {
    const context = useContext(AuthContext);
    if (!context) {
        throw new Error('useAuth must be used within an AuthProvider');
    }
    return context;
};

export const AuthProvider = ({ children }) => {
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        // Initialize user from window.Laravel if available
        if (window.Laravel && window.Laravel.user) {
            setUser(window.Laravel.user);
        }
        setLoading(false);
    }, []);

    const login = async (credentials) => {
        try {
            // Get CSRF cookie first
            await axios.get('/sanctum/csrf-cookie');
            
            const response = await axios.post('/login', credentials);
            
            if (response.status === 200) {
                // Get user data after successful login
                const userResponse = await axios.get('/api/user');
                setUser(userResponse.data);
                return userResponse.data;
            }
        } catch (error) {
            throw error;
        }
    };

    const register = async (userData) => {
        try {
            await axios.get('/sanctum/csrf-cookie');
            
            const response = await axios.post('/register', userData);
            
            if (response.status === 200 || response.status === 201) {
                // Get user data after successful registration
                const userResponse = await axios.get('/api/user');
                setUser(userResponse.data);
                return userResponse.data;
            }
        } catch (error) {
            throw error;
        }
    };

    const logout = async () => {
        try {
            await axios.post('/logout');
            setUser(null);
            // Optionally redirect to home page
            window.location.href = '/';
        } catch (error) {
            console.error('Logout error:', error);
            // Still clear user data locally
            setUser(null);
        }
    };

    const value = {
        user,
        login,
        register,
        logout,
        loading,
        isAuthenticated: !!user,
        isJobseeker: user?.user_type === 'jobseeker',
        isCompany: user?.user_type === 'company'
    };

    return (
        <AuthContext.Provider value={value}>
            {children}
        </AuthContext.Provider>
    );
};