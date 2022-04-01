import React from "react";
import { Link } from "react-router-dom";
import ChatBot from "../components/ChatBot";
import NavBar from "../components/Navbar";

function Login() {
    return (
        <>
            <NavBar/>
            <LoginForm/>
            <ChatBot/>
        </>
    )
}

function LoginForm() {
    return (
        <div className="container">       
            <div className="p-3 form-group">
                <Link to="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" className="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                    </svg>
                </Link>
                <p className="d-flex justify-content-center">Login</p>
                <h4>SportsApp</h4>
                <span className="d-block mt-5">Enter your phone number and password below to Login to your existing account. Otherwise click on Register with the same details to create a new account.</span>
                
                <label htmlFor="exampleInputEmail1" className="mt-1">Phone Number</label>
                <input type="email" className="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="e.g. 0712 345678"/>
                <small id="emailHelp" className="form-text text-muted">Enter your phone number</small>
                <label htmlFor="exampleInputPassword1" className="d-block mt-2">Password</label>
                <input type="password" className="form-control" id="exampleInputPassword1" aria-describedby="PasswordHelp"/>
                <small id="PasswordHelp" className="form-text text-muted">Enter your password</small>
                <Link to={'/recover-password'} className="d-block mt-2 float-end">Forgot Your Password?</Link>
                <div className="form-check mt-2">
                    <input className="form-check-input" type="checkbox" id="gridCheck"/>
                    <label className="form-check-label" htmlFor="gridCheck">
                        Keep me logged in
                    </label>
                </div>
                <button className="btn btn-warning fw-bold w-100 mt-2">Login</button>
                <div  className="mt-3 text-center">
                <Link to={'/register'}>Don't have an account? Register here</Link>
                </div>
            </div>
        </div>
    )
}

export default Login;