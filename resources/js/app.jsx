import './bootstrap';

import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-icons/font/bootstrap-icons.css';
import '../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';
 import { BrowserRouter } from 'react-router-dom';

 import Swal from 'sweetalert2'

window.Swal = Swal
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
})
window.toast = toast

import App from './Pages/App'

ReactDOM.createRoot(document.getElementById('app')).render(
    <BrowserRouter>
        <App/>
    </BrowserRouter>
);