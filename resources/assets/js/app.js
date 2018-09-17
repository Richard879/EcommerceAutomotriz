require('./bootstrap');

window.Vue = require('vue');

import ElementUI from 'element-ui';
//import 'element-ui/lib/theme-chalk/index.css';
import locale from 'element-ui/lib/locale/lang/es';
window.Vue.use(ElementUI, { locale })

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
Vue.component('solccvendedor', require('./components/SolicitudCCVendedor.vue'));
Vue.component('solccjefeventa', require('./components/SolicitudCCJefeVenta.vue'));
Vue.component('asigvendedorturno', require('./components/AsigVendedorTurno.vue'));
Vue.component('turnoventa', require('./components/TurnoVenta.vue'));
Vue.component('depositopedido', require('./components/PedidoDeposito.vue'));
Vue.component('asignavendedormodelo', require('./components/AsignaVendedorModelo.vue'));
Vue.component('maestrovehiculo', require('./components/MaestroVehiculo.vue'));
Vue.component('autorizacionv', require('./components/AutorizacionV.vue'));
Vue.component('autorizacionjv', require('./components/AutorizacionJV.vue'));
Vue.component('autorizacionadv', require('./components/AutorizacionADV.vue'));
Vue.component('cierreventa', require('./components/CierreVenta.vue'));
Vue.component('cierrecompra', require('./components/CierreCompra.vue'));
Vue.component('cuotavendedor', require('./components/CuotaVendedor.vue'));
Vue.component('pditipoinspeccion', require('./components/pditipoinspeccion.vue'));
Vue.component('pdiplantilla', require('./components/pdiplantilla.vue'));
Vue.component('pdipuntoinspeccion', require('./components/pdipuntoinspeccion.vue'));


const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
        ruta: 'http://localhost:8080/saisacsys/public'
    }
});