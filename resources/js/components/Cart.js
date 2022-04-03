import React, { useEffect, useState } from "react";
import { useDispatch, useSelector } from "react-redux";
import { clearCartGames, getCartGames, getCartOddsTotal, getPayOut, removeSingleCartGame } from "../features/game/gameSlice";

function Cart() {

    const dispatch = useDispatch();

    const cart = useSelector(state => state.game.cartData.data);

    const [posswin, setPosswin] = useState(0);

    const updateCart = (session_id, game_id) => {
        dispatch(removeSingleCartGame({
            'session_id' : session_id,
            'game_id' : game_id
        }))

        dispatch(getCartGames(session_id))
        dispatch(getCartOddsTotal(session_id))
        // dispatch(getPayOut(session_id))
    }

    const listedCartGames = !!cart ? cart.map((game) => {
        const {betslip_market,betslip_market_odds,betslip_team_names, session_id, game_id} = game;
        return (
           <div className="row">
               <div className="col-1">
                <button onClick={() => updateCart(session_id, game_id)} className="btn btn-dark btn-sm h-100 rounded-0">x</button>
               </div>
               <div className="col-8">
                <span className="d-block">{betslip_team_names}</span>
                <span className="d-block">{betslip_market}</span>
                <small>Starts 03/04, 18:00</small>
               </div>
               <div className="col-2 ">
                <span className="d-block float-end">{betslip_market_odds}</span>
               </div>   
           </div>
        )
    }) : 'loading';

    const total_odds = useSelector(state => !!state.game.oddsTotal.odds_total ? state.game.oddsTotal.odds_total : 0);

    // const possible_win = useSelector(state => state.game.payout)
    
    return (
        <div>
            {!!cart ?
                <div className="row">
                    <div className="d-flex justify-content-end pe-auto" onClick={() => dispatch(clearCartGames(1))}>
                        <small >
                            Clear All
                        </small>
                        <i className="bi bi-list"></i>
                    </div>
                   
                    {listedCartGames}

                    <div className="d-flex justify-content-between mt-5">
                        <small>Total Odds</small>
                        <small>{total_odds}</small>
                    </div>
                    <div className="d-flex justify-content-between">
                        <small>Amount</small>
                        <input className="form-group d-block" type="number" value={100} onChange={(e) => setPosswin(e.target.value * total_odds)}/>
                    </div>
                    <div className="d-flex justify-content-between">
                        <small className="d-block">Final payout </small>
                        <small>KES{posswin}</small>
                    </div>
                     <button className="btn btn-warning btn-sm W-100">Place Bet</button>

                 </div>
                    :   <h1>Place Bet</h1>
            }
        </div>
    )
}

export default Cart;
