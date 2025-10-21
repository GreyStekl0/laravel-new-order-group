import './bootstrap';

import '../scss/app.scss';
import 'bootstrap';
import '@fortawesome/fontawesome-free/css/all.min.css';
import {Toast} from 'bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.toast[data-auto-show="true"]').forEach(el => {
        const t = new Toast(el);
        t.show();
    });
});
