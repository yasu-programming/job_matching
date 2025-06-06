import React from 'react';
import { useAuth } from '../../contexts/AuthContext';
import { Link } from 'react-router-dom';

function Dashboard() {
    const { user, logout, isJobseeker, isCompany } = useAuth();

    const handleLogout = async () => {
        try {
            await logout();
        } catch (error) {
            console.error('Logout error:', error);
        }
    };

    if (!user) {
        return (
            <div className="min-h-screen bg-gray-100 flex items-center justify-center">
                <div className="text-center">
                    <h1 className="text-2xl font-bold text-gray-900 mb-4">Access Denied</h1>
                    <p className="text-gray-600 mb-4">You need to be logged in to access this page.</p>
                    <Link
                        to="/login"
                        className="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700"
                    >
                        Login
                    </Link>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-gray-100">
            {/* Navigation */}
            <nav className="bg-white shadow">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex items-center">
                            <Link to="/" className="flex-shrink-0">
                                <div className="w-8 h-8 flex items-center justify-center bg-gray-800 text-white rounded">
                                    <span className="font-bold">JM</span>
                                </div>
                            </Link>
                            <div className="ml-10 flex items-baseline space-x-4">
                                <Link
                                    to="/dashboard"
                                    className="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium"
                                >
                                    Dashboard
                                </Link>
                                <Link
                                    to="/profile"
                                    className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                >
                                    Profile
                                </Link>
                            </div>
                        </div>
                        <div className="flex items-center space-x-4">
                            <span className="text-gray-700">
                                {user.first_name} {user.last_name}
                            </span>
                            <span className="text-xs bg-gray-200 text-gray-800 px-2 py-1 rounded">
                                {user.user_type}
                            </span>
                            <button
                                onClick={handleLogout}
                                className="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                            >
                                Logout
                            </button>
                        </div>
                    </div>
                </div>
            </nav>

            {/* Page Header */}
            <header className="bg-white shadow">
                <div className="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 className="text-3xl font-bold text-gray-900">
                        {isJobseeker && 'Job Seeker Dashboard'}
                        {isCompany && 'Company Dashboard'}
                        {!isJobseeker && !isCompany && 'Dashboard'}
                    </h1>
                </div>
            </header>

            {/* Main Content */}
            <main>
                <div className="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <div className="px-4 py-6 sm:px-0">
                        <div className="border-4 border-dashed border-gray-200 rounded-lg p-8">
                            <div className="text-center">
                                <h2 className="text-2xl font-bold text-gray-900 mb-4">
                                    Welcome, {user.first_name}!
                                </h2>
                                <p className="text-gray-600 mb-6">
                                    {isJobseeker && 'Start exploring job opportunities and manage your applications.'}
                                    {isCompany && 'Manage your company profile and job postings.'}
                                    {!isJobseeker && !isCompany && 'Your dashboard is ready to go.'}
                                </p>

                                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                    {isJobseeker && (
                                        <>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Job Search</h3>
                                                <p className="text-gray-600 mb-4">Find your next opportunity</p>
                                                <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                    Browse Jobs
                                                </button>
                                            </div>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Applications</h3>
                                                <p className="text-gray-600 mb-4">Track your job applications</p>
                                                <button className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                    View Applications
                                                </button>
                                            </div>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Profile</h3>
                                                <p className="text-gray-600 mb-4">Update your profile and resume</p>
                                                <Link
                                                    to="/profile"
                                                    className="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 inline-block"
                                                >
                                                    Edit Profile
                                                </Link>
                                            </div>
                                        </>
                                    )}

                                    {isCompany && (
                                        <>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Job Postings</h3>
                                                <p className="text-gray-600 mb-4">Manage your job listings</p>
                                                <button className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                                                    Manage Jobs
                                                </button>
                                            </div>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Candidates</h3>
                                                <p className="text-gray-600 mb-4">Review candidate applications</p>
                                                <button className="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                    View Candidates
                                                </button>
                                            </div>
                                            <div className="bg-white p-6 rounded-lg shadow">
                                                <h3 className="text-lg font-semibold text-gray-900 mb-2">Company Profile</h3>
                                                <p className="text-gray-600 mb-4">Update company information</p>
                                                <Link
                                                    to="/profile"
                                                    className="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 inline-block"
                                                >
                                                    Edit Profile
                                                </Link>
                                            </div>
                                        </>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
}

export default Dashboard;