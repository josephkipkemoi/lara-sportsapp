import React from "react";
import { Link } from "react-router-dom";

function NavBar(){
 return (
     <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
            <Link to="/" class="nav-link">Home</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Live (20)</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Jackpots</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Casino</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Virtuals</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Offers</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Virtuals</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Blog</Link>
            </li>
            <li class="nav-item">
            <Link class="nav-link" to="#">Results</Link>
            </li>
        </ul>

        </div>

        <div>
            <div class="form-inline my-2 my-lg-0">
                <ul class="navbar-nav">
                <li class="nav-item">
                    <Link class="nav-link" to="/help">Help & Support</Link>
                </li>
                <li class="nav-item"> 
                    <Link class="nav-link" to="#">Print Matches</Link>
                </li>
                <li class="nav-item">
                    <Link class="nav-link" to="#">Search</Link>
                </li>
                </ul>
            </div>
        </div>
</nav>
   
 )
}

export default NavBar;