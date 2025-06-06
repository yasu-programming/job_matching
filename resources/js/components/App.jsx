import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { AuthProvider } from '../contexts/AuthContext';
import Welcome from './Landing/Welcome';
import Login from './Auth/Login';
import Register from './Auth/Register';
import Dashboard from './Dashboard/Dashboard';
import Profile from './Profile/Profile';

function App() {
    return (
        <AuthProvider>
            <Router>
                <div className="min-h-screen bg-gray-100">
                    <Routes>
                        <Route path="/" element={<Welcome />} />
                        <Route path="/login" element={<Login />} />
                        <Route path="/register" element={<Register />} />
                        <Route path="/dashboard" element={<Dashboard />} />
                        <Route path="/profile" element={<Profile />} />
                        {/* Additional routes will be added here */}
                    </Routes>
                </div>
            </Router>
        </AuthProvider>
    );
}

export default App;