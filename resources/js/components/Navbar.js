import React from "react";
import { Link } from "react-router-dom";

function NavBar(){
 return (
     <>
     <nav className="d-flex align-items-center justify-content-between">
         <div className="d-flex align-items-center ml-2">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" className="bi bi-menu-button-wide" viewBox="0 0 16 16">
            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
            <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
         </svg>
            <h4 className="ml-2">SportsApp</h4>
         </div>
         <div>
            <Link to={'/login'} className="btn btn-warning btn-sm">Login</Link>
            <Link to={'/register'} className="btn btn-outline-warning btn-sm ml-2 mr-2">Register</Link>
         </div>
     </nav>
      <nav className="navbar navbar-expand-lg navbar-light bg-light">
        <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span className="navbar-toggler-icon"></span>
        </button>
        <div className="collapse navbar-collapse" id="navbarNav">
        <ul className="navbar-nav">
            <li className="nav-item active">
            <Link to="/" className="nav-link">Home</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Live (20)</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Jackpots</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Casino</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Virtuals</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Offers</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Virtuals</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Blog</Link>
            </li>
            <li className="nav-item">
            <Link className="nav-link" to="#">Results</Link>
            </li>
        </ul>

        </div>

        <div>
            <div className="form-inline my-2 my-lg-0">
                <ul className="navbar-nav">
                <li className="nav-item">
                    <Link className="nav-link" to="/help">Help & Support</Link>
                </li>
                <li className="nav-item"> 
                    <Link className="nav-link" to="#">Print Matches</Link>
                </li>
                <li className="nav-item">
                    <Link className="nav-link" to="#">Search</Link>
                </li>
                </ul>
            </div>
        </div>
</nav>
     </>
    
   
 )
}

export default NavBar;