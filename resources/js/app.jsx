import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import App from './components/App';

// Get the root element
const container = document.getElementById('app');
const root = createRoot(container);

// Render the App
root.render(<App />);
