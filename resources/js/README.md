# React Frontend Components

This directory contains the React components for the job matching application frontend.

## Structure

```
resources/js/
├── components/
│   ├── App.jsx                 # Main application component with routing
│   ├── Auth/
│   │   ├── Login.jsx          # Login form component
│   │   └── Register.jsx       # Registration form component
│   ├── Common/
│   │   └── NotFound.jsx       # 404 page component
│   ├── Dashboard/
│   │   └── Dashboard.jsx      # Main dashboard with role-based UI
│   ├── Landing/
│   │   └── Welcome.jsx        # Welcome/landing page
│   └── Profile/
│       └── Profile.jsx        # User profile management
├── contexts/
│   └── AuthContext.jsx        # Authentication state management
├── app.jsx                     # React application entry point
└── bootstrap.js               # Axios configuration and CSRF setup
```

## Key Components

### App.jsx
Main application component that:
- Provides authentication context
- Sets up React Router
- Defines all application routes
- Handles 404 pages

### Authentication Components
- **Login.jsx**: User login with email/password and remember me
- **Register.jsx**: User registration with user type selection (jobseeker/company)
- **AuthContext.jsx**: Manages authentication state, login, logout, and user data

### Dashboard Components
- **Dashboard.jsx**: Role-based dashboard for jobseekers and companies
- Displays different content based on user type
- Includes navigation and quick action cards

### Profile Components
- **Profile.jsx**: User profile editing form
- Handles form validation and API communication
- Displays account information

## Features Implemented

1. **Complete SPA Architecture**
   - Client-side routing with React Router
   - Authentication state management
   - API integration with Laravel backend

2. **Authentication System**
   - Session-based authentication
   - CSRF token handling
   - User type management (jobseeker/company)
   - Automatic redirects based on user role

3. **User Interface**
   - Responsive design with Tailwind CSS
   - Form validation and error handling
   - Loading states and success messages
   - Consistent navigation across pages

4. **API Integration**
   - Axios configuration for Laravel API
   - Error handling for API responses
   - Session management and logout

## Usage

The React application is built using Vite and replaces the original Blade templates while maintaining all existing Laravel backend functionality.

### Build Commands
```bash
# Development build with watch
npm run dev

# Production build
npm run build

# Format code
npm run format
```

### Laravel Integration
The React app is served through Laravel using the `app.blade.php` template, which provides:
- CSRF token for API calls
- Initial user data from Laravel session
- Application configuration

## Migration Status

✅ **Completed:**
- Welcome page (from welcome.blade.php)
- Authentication forms (login/register)
- Dashboard with role-based UI
- Profile management
- API routes and SPA routing

⏳ **Future Enhancements:**
- Job listing components
- Application management
- File upload handling
- Advanced search and filtering
- Real-time notifications