import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../contexts/AuthContext';

function Login() {
    const [formData, setFormData] = useState({
        email: '',
        password: '',
        remember: false
    });
    const [errors, setErrors] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const { login } = useAuth();
    const navigate = useNavigate();

    const handleChange = (e) => {
        const { name, value, type, checked } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: type === 'checkbox' ? checked : value
        }));
        // Clear errors when user starts typing
        if (errors[name]) {
            setErrors(prev => ({ ...prev, [name]: undefined }));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setErrors({});

        try {
            const user = await login({
                email: formData.email,
                password: formData.password,
                remember: formData.remember
            });

            // Redirect based on user type
            if (user.user_type === 'jobseeker') {
                navigate('/dashboard'); // Could be '/jobseeker/dashboard'
            } else if (user.user_type === 'company') {
                navigate('/dashboard'); // Could be '/company/dashboard'
            } else {
                navigate('/dashboard');
            }
        } catch (error) {
            if (error.response?.status === 422) {
                // Validation errors
                setErrors(error.response.data.errors || {});
            } else if (error.response?.status === 401) {
                // Authentication failed
                setErrors({ 
                    email: ['The provided credentials do not match our records.'] 
                });
            } else {
                setErrors({ 
                    general: ['An error occurred. Please try again.'] 
                });
            }
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <Link to="/">
                    <div className="w-20 h-20 flex items-center justify-center bg-gray-500 text-white rounded-lg">
                        <span className="text-xl font-bold">JM</span>
                    </div>
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {errors.general && (
                    <div className="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                        {errors.general[0]}
                    </div>
                )}

                <form onSubmit={handleSubmit}>
                    {/* Email Address */}
                    <div>
                        <label htmlFor="email" className="block font-medium text-sm text-gray-700">
                            Email
                        </label>
                        <input
                            id="email"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="email"
                            name="email"
                            value={formData.email}
                            onChange={handleChange}
                            required
                            autoFocus
                            autoComplete="username"
                        />
                        {errors.email && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.email[0]}
                            </div>
                        )}
                    </div>

                    {/* Password */}
                    <div className="mt-4">
                        <label htmlFor="password" className="block font-medium text-sm text-gray-700">
                            Password
                        </label>
                        <input
                            id="password"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="password"
                            name="password"
                            value={formData.password}
                            onChange={handleChange}
                            required
                            autoComplete="current-password"
                        />
                        {errors.password && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.password[0]}
                            </div>
                        )}
                    </div>

                    {/* Remember Me */}
                    <div className="block mt-4">
                        <label htmlFor="remember_me" className="inline-flex items-center">
                            <input
                                id="remember_me"
                                type="checkbox"
                                className="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember"
                                checked={formData.remember}
                                onChange={handleChange}
                            />
                            <span className="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div className="flex items-center justify-end mt-4">
                        <Link
                            to="/forgot-password"
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Forgot your password?
                        </Link>

                        <button
                            type="submit"
                            disabled={isLoading}
                            className="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
                        >
                            {isLoading ? 'Logging in...' : 'Log in'}
                        </button>
                    </div>

                    <div className="mt-4 text-center">
                        <Link
                            to="/register"
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Need an account? Register here
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    );
}

export default Login;