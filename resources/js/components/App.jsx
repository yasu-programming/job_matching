import React from 'react';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Welcome from './Landing/Welcome';

function App() {
    return (
        <Router>
            <div className="min-h-screen bg-gray-100">
                <Routes>
                    <Route path="/" element={<Welcome />} />
                    {/* Additional routes will be added here */}
                </Routes>
            </div>
        </Router>
    );
}

export default App;