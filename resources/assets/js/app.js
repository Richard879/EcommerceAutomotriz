require('./bootstrap');

window.Vue = require('vue');

Vue.component('dashboard', require('./components/Dashboard.vue'));
Vue.component('versionvehiculo', require('./components/VersionVehiculo.vue'));
Vue.component('elementoventa', require('./components/ElementoVenta.vue'));
Vue.component('listapreciovh', require('./components/ListaPrecioVersionVeh.vue'));
Vue.component('compra', require('./components/Compra.vue'));
Vue.component('woperativo', require('./components/WarrantOperativo.vue'));
Vue.component('wfinanciero', require('./components/WarrantFinanciero.vue'));
Vue.component('campania', require('./components/EventoCampania.vue'));
Vue.component('gestioncontactojf', require('./components/GestionContactoJefeVenta.vue'));
Vue.component('gestioncontactov', require('./components/GestionContactoVendedor.vue'));
Vue.component('cotizacion', require('./components/Cotizacion.vue'));
Vue.component('pedido', require('./components/Pedido.vue'));
Vue.component('aprobapedido', require('./components/AprobacionPedido.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        ruta: 'http://localhost:8080/saisacsys/public'
    }
});