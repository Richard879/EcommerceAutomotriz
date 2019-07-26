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

/**
 * Biblioteca Vee Validate - Validar Inputs de VueJs
 */
// Inside a component.
import VeeValidate from 'vee-validate';
var VueValidationEs = require('vee-validate/dist/locale/es');

// Vue.use(VeeValidate);
Vue.use(VeeValidate, {
    locale: 'es',
    dictionary: {
        es: VueValidationEs
    },
    errorBagName: 'vErrors'
});

Vue.component('cabecera', require('./components/Cabecera.vue'));
Vue.component('cabeceralogin', require('./components/CabeceraLogin.vue'));
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
Vue.component('cotizacion', require('./components/Cotizacion.vue'));
Vue.component('pedido', require('./components/Pedido.vue'));
Vue.component('pedidoaprobar', require('./components/PedidoAprobacion.vue'));
Vue.component('pedidodeposito', require('./components/PedidoDeposito.vue'));
Vue.component('pedidodepositoaprobar', require('./components/PedidoDepositoAprobar.vue'));
Vue.component('pedidodepositopreliminar', require('./components/PedidoDepositoPreliminar.vue'));
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
Vue.component('pditipoinspeccion', require('./components/pditipoinspeccion.vue'));
Vue.component('pdiplantilla', require('./components/PdiPlantillaInspeccion.vue'));
Vue.component('pdipuntoinspeccion', require('./components/PdiPuntoInspeccion.vue'));
Vue.component('pdiprocesoinspeccion', require('./components/PdiProcesoInspeccion.vue'));
Vue.component('tramite', require('./components/TramitePlaca.vue'));
Vue.component('entregavehiculo', require('./components/EntregaVehiculo.vue'));
Vue.component('permisos', require('./components/AdmPermisos.vue'));
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
Vue.component('lineamarcamodelo', require('./components/LineaMarcaModelo.vue'));
Vue.component('asignavendedorjefeventas', require('./components/AsignaVendedorJefeVentas.vue'));
Vue.component('gestionusuarios', require('./components/GestionUsuarios.vue'));
Vue.component('tipocambio', require('./components/TipoCambio.vue'));
Vue.component('almacen', require('./components/AlmacenConfig.vue'));
Vue.component('accesorioconfig', require('./components/AccesorioModeloConfig.vue'));
Vue.component('modeloconfig', require('./components/ModeloConfig.vue'));
Vue.component('generaproyecto', require('./components/GenerarProyecto.vue'));
Vue.component('gestionmiusuarios', require('./components/GestionMiUsuario.vue'));
Vue.component('reportes', require('./components/Reportes.vue'));
Vue.component('descotorgados', require('./components/DescuentoOtorgados.vue'));
Vue.component('spmodelo', require('./components/AsignarSPModelo.vue'));
Vue.component('logo', require('./components/logo.vue'));

const app = new Vue({
    el: '#app',
    data: {
        menu: 1300362,
        // ruta: 'http://172.20.6.87:8080/saisacsys/public',    //  REMOTAMENTE
        ruta: 'http://localhost:8080/saisacsys/public', //  LOCAL
        // ruta: 'http://172.20.0.62/pruebas/public', //  PRE PRODUCCIÓN
        // ruta: 'http://172.20.0.62/saisacsys/public', //  PRODUCCION
        notifications: []
    },
    mounted() {
        var userId = $('meta[name="userId"]').attr('content');
        Echo.private(`userlogout.${userId}`)
            .listen('LogoutFromEveryWhere', (e) => {
                // console.log(e);
                location.reload()
            })
        this.obtenerRolUsuario();
    },
    created() {
        // let me = this;
        // axios.post('notification/get').then(function(response) {
        //     // console.log(response.data);
        //     me.notifications = response.data;
        // }).catch(function(error) {
        //     console.log(error);
        // });

        // var userId = $('meta[name="userId"]').attr('content');
        // Echo.private('App.User.' + userId).notification((notification) => {
        //     // console.log(notification);
        // });
    },
    methods: {
        obtenerRolUsuario() {
            var url = this.ruta + '/usuario/GetInformacionUsuario';
            axios.get(url).then(response => {
                sessionStorage.setItem("nTipoRol", response.data.usuario[0].nIdGrupoPar);
                //alert(sessionStorage.getItem("nTipoRol"));
                //PARA EL ADV
                if (response.data.flag == 0 && response.data.usuario[0].nIdGrupoPar == '110083') {
                    swal('BUEN DÍA ' + response.data.usuario[0].cNombre + ', DEBE AGREGAR EL TIPO DE CAMBIO DEL DÍA');
                }
                //PARA OTROS USUARIOS
                if (response.data.flag == 0 && response.data.usuario[0].nIdGrupoPar != '110083') {
                    swal('BUEN DÍA ' + response.data.usuario[0].cNombre + ', CONTACTAR CON SU ADV PARA AGREGAR EL TIPO DE CAMBIO DEL DÍA');
                }
            }).catch(error => {
                console.log(error);
                if (error.response) {
                    if (error.response.status == 401) {
                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                        location.reload('0');
                    }
                }
            });
        },
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
