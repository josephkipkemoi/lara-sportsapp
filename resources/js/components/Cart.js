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
           <>
                <button onClick={() => updateCart(session_id, game_id)} className="float-end btn btn-danger btn-sm">x</button>
                <span className="d-block">{betslip_team_names}</span>
                <span className="d-block">{betslip_market}</span>
                <span className="d-block">{betslip_market_odds}</span>
           </>
        )
    }) : 'loading';

    const total_odds = useSelector(state => !!state.game.oddsTotal.odds_total ? state.game.oddsTotal.odds_total : 0);

    // const possible_win = useSelector(state => state.game.payout)
    
    return (
        <div>
            {!!cart ?
                <div>
                    <h1>Betslip</h1>
                    {listedCartGames}
                    <span className="d-block">Total Odds: {total_odds}</span>
                    <input className="form-group d-block" placeholder="stake" onChange={(e) => setPosswin(e.target.value * total_odds)}/>
                    <span className="d-block">Possible Win: Kshs {posswin}</span>
                    <button className="btn btn-danger btn-sm" onClick={() => dispatch(clearCartGames(1))}>Cancel</button>
                    <button className="btn btn-primary btn-sm">Place Bet</button>
                </div>
                    :   <h1>Place Bet</h1>
            }
        </div>
    )
}

export default Cart;
