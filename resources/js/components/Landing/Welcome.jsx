import React from 'react';
import { Link } from 'react-router-dom';

function Welcome() {
    // This would eventually come from authentication context
    const isAuthenticated = false;

    return (
        <div className="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
            <header className="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6">
                <nav className="flex items-center justify-end gap-4">
                    {isAuthenticated ? (
                        <Link
                            to="/dashboard"
                            className="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                        >
                            Dashboard
                        </Link>
                    ) : (
                        <>
                            <Link
                                to="/login"
                                className="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal"
                            >
                                Log in
                            </Link>
                            <Link
                                to="/register"
                                className="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal"
                            >
                                Register
                            </Link>
                        </>
                    )}
                </nav>
            </header>
            
            <div className="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow">
                <main className="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                    <div className="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-white dark:bg-[#161615] dark:text-[#EDEDEC] shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                        <h1 className="mb-1 font-medium">Let's get started</h1>
                        <p className="mb-2 text-[#706f6c] dark:text-[#A1A09A]">
                            Laravel has an incredibly rich ecosystem. <br />
                            We suggest starting with the following.
                        </p>
                        <ul className="flex flex-col mb-4 lg:mb-6">
                            <li className="flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                                <span className="relative py-1 bg-white dark:bg-[#161615]">
                                    <span className="flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border dark:border-[#3E3E3A] border-[#e3e3e0]">
                                        <span className="rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5"></span>
                                    </span>
                                </span>
                                <span>
                                    Read the{' '}
                                    <a 
                                        href="https://laravel.com/docs" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        className="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1"
                                    >
                                        <span>Documentation</span>
                                        <svg
                                            width="10"
                                            height="11"
                                            viewBox="0 0 10 11"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            className="w-2.5 h-2.5"
                                        >
                                            <path
                                                d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001"
                                                stroke="currentColor"
                                                strokeLinecap="square"
                                            />
                                        </svg>
                                    </a>
                                </span>
                            </li>
                            <li className="flex items-center gap-4 py-2 relative before:border-l before:border-[#e3e3e0] dark:before:border-[#3E3E3A] before:bottom-1/2 before:top-0 before:left-[0.4rem] before:absolute">
                                <span className="relative py-1 bg-white dark:bg-[#161615]">
                                    <span className="flex items-center justify-center rounded-full bg-[#FDFDFC] dark:bg-[#161615] shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_1px_2px_0px_rgba(0,0,0,0.06)] w-3.5 h-3.5 border dark:border-[#3E3E3A] border-[#e3e3e0]">
                                        <span className="rounded-full bg-[#dbdbd7] dark:bg-[#3E3E3A] w-1.5 h-1.5"></span>
                                    </span>
                                </span>
                                <span>
                                    Watch video tutorials at{' '}
                                    <a 
                                        href="https://laracasts.com" 
                                        target="_blank" 
                                        rel="noopener noreferrer"
                                        className="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#f53003] dark:text-[#FF4433] ml-1"
                                    >
                                        <span>Laracasts</span>
                                        <svg
                                            width="10"
                                            height="11"
                                            viewBox="0 0 10 11"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                            className="w-2.5 h-2.5"
                                        >
                                            <path
                                                d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001"
                                                stroke="currentColor"
                                                strokeLinecap="square"
                                            />
                                        </svg>
                                    </a>
                                </span>
                            </li>
                        </ul>
                        <p className="mb-1 text-[#706f6c] dark:text-[#A1A09A]">
                            Job Matching Application - React Frontend Migration in Progress
                        </p>
                    </div>
                    
                    <div className="bg-[url('data:image/svg+xml,%3csvg%20xmlns=%27http://www.w3.org/2000/svg%27%20viewBox=%270%200%201080%20432%27%3e%3cpath%20d=%27M0%20432L360%20216L720%20216L1080%200V432Z%27%20fill=%27%23ff2d20%27/%3e%3c/svg%3e')] bg-cover bg-no-repeat bg-right overflow-hidden shadow-[inset_0px_0px_0px_1px_rgba(26,26,0,0.16)] dark:shadow-[inset_0px_0px_0px_1px_#fffaed2d] rounded-tl-lg rounded-tr-lg lg:rounded-tr-lg lg:rounded-bl-none lg:rounded-br-lg w-full lg:w-[350px] h-[200px] lg:h-auto order-last lg:order-last">
                        <div className="bg-[#ff2d20]/10 dark:bg-[#ff2d20]/10 w-full h-full flex items-center justify-center">
                            <div className="text-center p-4">
                                <h2 className="text-xl font-bold text-[#ff2d20] mb-2">Job Matching</h2>
                                <p className="text-sm text-[#706f6c] dark:text-[#A1A09A]">
                                    Connecting talent with opportunities
                                </p>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    );
}

export default Welcome;