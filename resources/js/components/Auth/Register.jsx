import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../../contexts/AuthContext';

function Register() {
    const [formData, setFormData] = useState({
        user_type: '',
        first_name: '',
        last_name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: ''
    });
    const [errors, setErrors] = useState({});
    const [isLoading, setIsLoading] = useState(false);
    const { register } = useAuth();
    const navigate = useNavigate();

    const handleChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({
            ...prev,
            [name]: value
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
            const user = await register(formData);

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
                    {/* User Type Selection */}
                    <div className="mb-4">
                        <label htmlFor="user_type" className="block font-medium text-sm text-gray-700">
                            Account Type
                        </label>
                        <select
                            id="user_type"
                            name="user_type"
                            className="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            value={formData.user_type}
                            onChange={handleChange}
                            required
                        >
                            <option value="">Select Account Type</option>
                            <option value="jobseeker">Job Seeker</option>
                            <option value="company">Company</option>
                        </select>
                        {errors.user_type && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.user_type[0]}
                            </div>
                        )}
                    </div>

                    {/* First Name */}
                    <div>
                        <label htmlFor="first_name" className="block font-medium text-sm text-gray-700">
                            First Name
                        </label>
                        <input
                            id="first_name"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="text"
                            name="first_name"
                            value={formData.first_name}
                            onChange={handleChange}
                            required
                            autoFocus
                            autoComplete="given-name"
                        />
                        {errors.first_name && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.first_name[0]}
                            </div>
                        )}
                    </div>

                    {/* Last Name */}
                    <div className="mt-4">
                        <label htmlFor="last_name" className="block font-medium text-sm text-gray-700">
                            Last Name
                        </label>
                        <input
                            id="last_name"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="text"
                            name="last_name"
                            value={formData.last_name}
                            onChange={handleChange}
                            required
                            autoComplete="family-name"
                        />
                        {errors.last_name && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.last_name[0]}
                            </div>
                        )}
                    </div>

                    {/* Email Address */}
                    <div className="mt-4">
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
                            autoComplete="username"
                        />
                        {errors.email && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.email[0]}
                            </div>
                        )}
                    </div>

                    {/* Phone */}
                    <div className="mt-4">
                        <label htmlFor="phone" className="block font-medium text-sm text-gray-700">
                            Phone (Optional)
                        </label>
                        <input
                            id="phone"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="text"
                            name="phone"
                            value={formData.phone}
                            onChange={handleChange}
                            autoComplete="tel"
                        />
                        {errors.phone && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.phone[0]}
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
                            autoComplete="new-password"
                        />
                        {errors.password && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.password[0]}
                            </div>
                        )}
                    </div>

                    {/* Confirm Password */}
                    <div className="mt-4">
                        <label htmlFor="password_confirmation" className="block font-medium text-sm text-gray-700">
                            Confirm Password
                        </label>
                        <input
                            id="password_confirmation"
                            className="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                            type="password"
                            name="password_confirmation"
                            value={formData.password_confirmation}
                            onChange={handleChange}
                            required
                            autoComplete="new-password"
                        />
                        {errors.password_confirmation && (
                            <div className="mt-2 text-sm text-red-600">
                                {errors.password_confirmation[0]}
                            </div>
                        )}
                    </div>

                    <div className="flex items-center justify-end mt-4">
                        <Link
                            to="/login"
                            className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Already registered?
                        </Link>

                        <button
                            type="submit"
                            disabled={isLoading}
                            className="ml-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50"
                        >
                            {isLoading ? 'Registering...' : 'Register'}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}

export default Register;