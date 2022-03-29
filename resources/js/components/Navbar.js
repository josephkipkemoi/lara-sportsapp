import React from "react";
import { Link } from "react-router-dom";

function NavBar(){
 return (
     <nav className="navbar navbar-expand-lg navbar-dark bg-dark ">

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
   
 )
}

export default NavBar;