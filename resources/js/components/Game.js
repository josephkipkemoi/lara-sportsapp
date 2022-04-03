import { uniqueId } from "lodash";
import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { Link } from "react-router-dom";
import { fetchGames, getCartGames, getCartOddsTotal, getPayOut, postGames, postPayOut } from "../features/game/gameSlice";

function Game(){

    const dispatch = useDispatch();

    const [cart, setCart] = useState({
        'session_id': '',
        'game_id' : '',
        'betslip_team_names' : '',
        'betslip_market': '',
        'betslip_market_odds' : '',
    });

    const [home, setHome] = useState('');
 
    useEffect(() => {
        dispatch(fetchGames())
        cartAction()
    },[dispatch]);

    const game = useSelector(state => state.game.payload);
    
    const updateCart = (home,away,game_id) => {
   
        setHome(home);
    }


    const cartAction = () => {
        // console.log(home)
        // dispatch(postGames({
        //     'session_id' : 1,
        //     'game_id' : 1,
        //     'betslip_team_names' : 'ad',
        //     'betslip_market' : home,
        //     'betslip_market_odds' : 3
        // }))
        // dispatch(postPayOut(1))

        dispatch(getCartGames(1))
        dispatch(getCartOddsTotal(1))

    };

    const listedGames = game[0] ? game[0].map((games,key) => {
        return (
            <div className="row">
                <div className="d-flex justify-content-between">
                    <small className="d-block text-secondary" key={uniqueId()}>{games.game_category}</small>
                    <small className="d-block text-secondary" key={uniqueId()}>{games.kick_off_time}</small>
                </div>
                <div className="col-6">
                    <span className="d-block" key={uniqueId()}>{games.home_team}</span>
                    <span className="d-block" key={uniqueId()}>{games.away_team}</span>
                </div>
                <div className="col-2">
                    <button className="btn btn-primary rounded-pill btn-sm w-100" key={uniqueId()} onClick={(e) => (
                    e.preventDefault(),   
                    dispatch(postGames({
                        'session_id' : 1,
                        'game_id' : games.game_id,
                        'betslip_team_names' : games.home_team + ' ' + games.away_team,
                        'betslip_market' : games.home_team,
                        'betslip_market_odds' : games.odds_home
                    })), 
                    cartAction() )}>
                        {games.odds_home}
                    </button>
                </div>
                <div className="col-2 justify-content-center">
                        {games.draw ?
                            <button className="btn btn-primary rounded-pill btn-sm w-100" key={uniqueId()} onClick={(e) => (
                            e.preventDefault(),   
                            dispatch(postGames({
                                'session_id' : 1,
                                'game_id' : games.game_id,
                                'betslip_team_names' : games.home_team + ' ' + games.away_team,
                                'betslip_market' : games.away_team,
                                'betslip_market_odds' : games.odds_away
                            })), 
                            cartAction() )}>
                             </button>
                        : ''}
                </div>
                <div className="col-2">
                    <button className="btn btn-primary rounded-pill btn-sm w-100" key={uniqueId()} onClick={(e) => (
                    e.preventDefault(),   
                    dispatch(postGames({
                        'session_id' : 1,
                        'game_id' : games.game_id,
                        'betslip_team_names' : games.home_team + ' ' + games.away_team,
                        'betslip_market' : games.away_team,
                        'betslip_market_odds' : games.odds_away
                    })), 
                    cartAction() )}>
                        {games.odds_away}
                    </button>
                </div>   
                <div className="d-flex justify-content-end mb-2 mt-0 pt-0">
                    <small><Link to={"#"} className="text-warning fw-bold">+13 Markets</Link></small>
                </div>         
            </div>            
            )
    }) : 'loading';

 return (
     <>
         {game.length > 0 ? //if 
            <div className="row">                                
                <div className="col-6"><small>Teams</small></div>
                <div className="col-2 text-center"><small>1</small></div>
                <div className="col-2 text-center"><small>X</small></div>
                <div className="col-2 text-center"><small>2</small></div>
                {listedGames} 
            </div>                
            : // else
          <h1>No games check again later</h1> 
          }         
     </>
 )
}

export default Game;