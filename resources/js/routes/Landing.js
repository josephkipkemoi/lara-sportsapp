import React from "react";
import Game from "../components/Game";

import NavBar from "../components/Navbar";
import Cart from "../components/Cart";

function Landing(){
 return (
    <>
        <NavBar></NavBar>
        <div className="row">
            <div className="col-sm-3">
                <span>SideNav</span>
            </div>
            <div className="col-sm-6">
                <Game/>
            </div>
            <div className="col-sm-3">
                <Cart/>
            </div>            
        </div>        
    </>
 )
}

 

export default Landing;
