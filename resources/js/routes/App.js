import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import { Provider } from 'react-redux';
// Redux store
import { store } from '../store';
// Route Files / Resources 
import Landing from './Landing';
import Help from './Help';
import Login from './Login';
import Register from './Register';

function App() {
    return (
        <Landing/>
    )
}

export default App;

if (document.getElementById('app')) {
    ReactDOM.render( 
        <Provider store={store}>
            <BrowserRouter>
                <Routes>
                <Route path='/' element={<App />} /> 
                <Route path='/login' element={<Login />} />
                <Route path='/register' element={<Register />} />
                <Route path='/help' element={<Help />}/>
                </Routes>
            </BrowserRouter>
        </Provider>
       ,
    document.getElementById('app'));
}
