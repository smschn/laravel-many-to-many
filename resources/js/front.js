// questo file gestisce js per la parte front-office, cioè di tutte quelle routes visibili a chi NON ha fatto l'accesso.

window.Vue = require('vue'); // dichiaro Vue globalmente legandola all'oggetto window (la finestra del browser).

import Vue from 'vue'; // importo Vue.
import App from './views/App'; // importo il componente globale <App> in <\resources\js\views\App.vue>.

// creo nuova istanza di Vue.
const app = new Vue({
    el: '#root',
    render: h => h(App) // renderizzo subito il componente 'App' all'avvio.
});