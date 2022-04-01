import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import axios from "axios";

const initialState = [];

export const fetchGames = createAsyncThunk(
    'games/fetchAllGames',
    async () => {
        
        const response = await axios.get('api/v1/games');
 
        return response.data.data;
    }
);

export const postGames = createAsyncThunk(
    'games/postGames',
    async (request, thunkApi) => {

        const response = await axios.post('api/v1/betslips', request);

        return response.data;
    }
);

export const getCartGames = createAsyncThunk(
    'games/getCartGames',
    async (id, thunkApi) => {
        
        const response = await axios.get(`api/v1/betslips/sessions/${id}/session`);

        return response.data;
    }
);

export const clearCartGames = createAsyncThunk(
    'games/clearCartGames',
    async (id, thunkApi) => {
        
        const response = await axios.delete(`api/v1/betslips/sessions/${id}/session`);

        return response.data;
    }
);

export const removeSingleCartGame = createAsyncThunk(
    'games/removeSingleCartGame',
    async (request, thunkApi) => {
        
        const response = await axios.delete(`api/v1/betslips/sessions/${request.session_id}/session/games/${request.game_id}/game`);

        return response.data;
    }   
);

export const getCartOddsTotal = createAsyncThunk(
    'games/getCartOddsTotal',
    async (id, thunkApi) => {

        const response = await axios.get(`api/v1/betslips/sessions/${id}/session/odds-total`);

        return response.data;
    }
);

export const postPayOut = createAsyncThunk(
    'games/postPayout',
    async (id, thunkApi) => {

        const response = await axios.post(`api/v1/betslips/sessions/${id}/session/payout`,{
            'session_id' : id,
            'stake_amount' : 100
        });

        return response.data;
    }
);

export const getPayOut = createAsyncThunk(
    'games/getPayout',

    async (id, thunkApi) => {

        const response = await axios.get(`api/v1/betslips/sessions/${id}/session/payout`);

        return response.data
    }
)

export const gameSlice = createSlice({
    name: 'game',
    initialState: {
        payload: [],
        gameData: [],
        cartData:[],
        oddsTotal: 0,
        payout: 0,
        loading: 'idle'
    },
    extraReducers: (builder) => {
        builder.addCase(fetchGames.fulfilled, (state, action) => {
            state.payload.push(action.payload)
        }),
        builder.addCase(postGames.fulfilled, (state, action) => {
            state.gameData.push(action.payload)
        }),
        builder.addCase(getCartGames.fulfilled, (state, action) => {
            state.cartData = action.payload;
        }),
        builder.addCase(clearCartGames.fulfilled, (state, action) => {
            state.cartData = action.payload
        }),
        builder.addCase(getCartOddsTotal.fulfilled, (state, action) => {
            state.oddsTotal = action.payload
        }),
        builder.addCase(getPayOut.fulfilled, (state, action) => {
            state.payout = action.payload
        })
    }
});

export default gameSlice.reducer;