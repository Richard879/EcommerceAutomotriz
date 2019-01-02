require('./bootstrap');

window.Vue = require('vue');

/**
 * Biblioteca Element UI - Interfaces Web
 */
import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/es';
window.Vue.use(ElementUI, { locale })

/**
 * Biblioteca VueSax - Interfaces Web
 */
import Vuesax from 'vuesax'
window.Vue.use(Vuesax)

/**
 * Biblioteca VueEventBus - Comunicación Componentes
 */
var VueEventBus = require('vue-event-bus')
Vue.use(VueEventBus)

Vue.component('cabecera', require('./components/Cabecera.vue'));
Vue.component('mimenu', require('./components/Menu.vue'));
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
Vue.component('gestioncontactoadv', require('./components/GestionContactoADV.vue'));
Vue.component('cotizacion', require('./components/Cotizacion.vue'));
Vue.component('pedido', require('./components/Pedido.vue'));
Vue.component('pedidoaprobar', require('./components/PedidoAprobacion.vue'));
Vue.component('pedidodeposito', require('./components/PedidoDeposito.vue'));
Vue.component('pedidodepositoaprobar', require('./components/PedidoDepositoAprobar.vue'));
Vue.component('pedidodescuento', require('./components/PedidoDescuento.vue'));
Vue.component('comision', require('./components/Comision.vue'));
Vue.component('objcomercial', require('./components/ObjComercial.vue'));
Vue.component('solccvendedor', require('./components/SolicitudCCVendedor.vue'));
Vue.component('solccjefeventa', require('./components/SolicitudCCJefeVenta.vue'));
Vue.component('asigvendedorturno', require('./components/AsigVendedorTurno.vue'));
Vue.component('turnoventa', require('./components/TurnoVenta.vue'));
Vue.component('asignavendedormodelo', require('./components/AsignaVendedorModelo.vue'));
Vue.component('maestrovehiculo', require('./components/MaestroVehiculo.vue'));
Vue.component('autorizacionv', require('./components/PdiAutorizacionV.vue'));
Vue.component('autorizacionjv', require('./components/PdiAutorizacionJV.vue'));
Vue.component('autorizacionadv', require('./components/PdiAutorizacionADV.vue'));
Vue.component('cierreventa', require('./components/CierreVenta.vue'));
Vue.component('cierrecompra', require('./components/CierreCompra.vue'));
Vue.component('pditipoinspeccion', require('./components/pditipoinspeccion.vue'));
Vue.component('pdiplantilla', require('./components/PdiPlantillaInspeccion.vue'));
Vue.component('pdipuntoinspeccion', require('./components/PdiPuntoInspeccion.vue'));
Vue.component('pdiprocesoinspeccion', require('./components/PdiProcesoInspeccion.vue'));
Vue.component('tramite', require('./components/Tramite.vue'));
Vue.component('asigvendedorcuota', require('./components/AsigVendedorCuota.vue'));
Vue.component('entregavehiculo', require('./components/EntregaVehiculo.vue'));
Vue.component('permisos', require('./components/AdmPermisos.vue'));
<<<<<<< HEAD
// Vue.component('cabecera', require('./components/Cabecera.vue'));
=======
>>>>>>> 0c442c19b2fe831809852dea3315df18e679d98b
Vue.component('cotizacionaprobar', require('./components/CotizacionAprobar.vue'));
Vue.component('exhibiciones', require('./components/Exhibiciones.vue'));
Vue.component('flete', require('./components/Flete.vue'));
Vue.component('reportecotizacion', require('./components/ReporteCotizacion.vue'));
Vue.component('obsequio', require('./components/Obsequio.vue'));
Vue.component('parametro', require('./components/Parametro.vue'));
Vue.component('asigvendedorsublinea', require('./components/AsignaVendedorSubLinea.vue'));
Vue.component('asigvendedorcuotasublinea', require('./components/AsignaVendedorCuotaSubLinea.vue'));
Vue.component('parparametro', require('./components/ParParametro.vue'));
Vue.component('cronograma', require('./components/Cronograma.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 1300362,
        ruta: 'http://172.20.6.54:8080/saisacsys/public'
    },
    methods: {
        reiniciaMenu: function(data) {
            let me = this;
            me.menu = 0;
        },
        mostrarMenu: function(data) {
            let me = this;
            me.menu = data;
        },
        CambiarMenu: function(data) {
            let me = this;
            me.menu = data;
        }
    },
});