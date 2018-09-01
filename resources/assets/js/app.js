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
Vue.component('aprobapedido', require('./components/PedidoAprobacion.vue'));
Vue.component('comision', require('./components/Comision.vue'));
Vue.component('objcomercial', require('./components/ObjComercial.vue'));
Vue.component('solcaracteristica', require('./components/SolicitudCaracteristica.vue'));
Vue.component('asigvendedorturno', require('./components/AsigVendedorTurno.vue'));
Vue.component('turnoventa', require('./components/TurnoVenta.vue'));
Vue.component('depositopedido', require('./components/PedidoDeposito.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        ruta: 'http://172.20.6.62:8080/saisacsys/public'
    }
});