import { createSlice } from "@reduxjs/toolkit";

const initialState = [];

export const gameSlice = createSlice({
    name: 'game',
    initialState,
    reducers: {
        getGames: () => {

        }
    }
});

export const {getGames} = gameSlice.actions;

export default gameSlice.reducer;