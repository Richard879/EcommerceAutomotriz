<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom"> APROBACIÓN DEL PEDIDO</h2>
          </div>
        </header>

        <section class="forms">
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="h4">BUSCAR PEDIDO</h3>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal">
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Empresa</label>
                                            <div class="col-sm-8">
                                                <input type="text" v-model="fillBusquedaPedido.cempresa" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Sucursal</label>
                                            <div class="col-sm-8">
                                                <input type="text" v-model="fillBusquedaPedido.csucursal" class="form-control form-control-sm" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="fillProveedor.nidproveedor">
                                                    <input type="text" v-model="fillProveedor.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                    <div class="input-group-prepend">
                                                        <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                            <i class="fa-lg fa fa-search"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-4 form-control-label">Linea</label>
                                            <div class="col-md-8">
                                                <select name="account" v-model="fillBusquedaPedido.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                    <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar" v-text="linea.cParNombre">
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-4 form-control-label">Marca</label>
                                            <div class="col-md-8">
                                                <select name="account" v-model="fillBusquedaPedido.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                    <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <label class="col-md-4 form-control-label">Modelo</label>
                                            <div class="col-md-8">
                                                <select name="account" v-model="fillBusquedaPedido.nidmodelo" class="form-control form-control-sm">
                                                    <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                            <div class="col-sm-8">
                                                <input type="date" v-model="fillBusquedaPedido.dfechainicio" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                            <div class="col-sm-8">
                                                <input type="date" v-model="fillBusquedaPedido.dfechafin" class="form-control form-control-sm">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-9 offset-sm-4">
                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPedidos(1)">
                                            <i class="fa fa-search"></i> Buscar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="h4">LISTADO</h3>
                        </div>
                        <div class="card-body">
                            <template v-if="arrayPedidos.length">
                                <div class="table-responsive">
                                    <table class="table table-striped table-sm">
                                        <thead>
                                            <tr>
                                                <th>Acciones</th>
                                                <th>N° Pedido</th>
                                                <th>Vendedor</th>
                                                <th>Contacto</th>
                                                <th>Vehículo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="pedido in arrayPedidos" :key="pedido.nIdCabeceraPedido">
                                                <td>
                                                    <a href="#" @click.prevent="aprobarPedido(pedido.nIdCabeceraPedido)" :title="'Aprobar ' +pedido.nIdCabeceraPedido">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                                <td v-text="pedido.nIdCabeceraPedido"></td>
                                                <td v-text="pedido.Vendedor"></td>
                                                <td v-text="pedido.cContacto"></td>
                                                <td v-text="pedido.Vehiculo"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <nav>
                                                <ul class="pagination">
                                                    <li v-if="pagination.current_page > 1" class="page-item">
                                                        <a @click.prevent="cambiarPaginaPedido(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                    </li>
                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                    :class="[page==isActived?'active':'']">
                                                        <a class="page-link"
                                                        href="#" @click.prevent="cambiarPaginaPedido(page)"
                                                        v-text="page"></a>
                                                    </li>
                                                    <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                        <a @click.prevent="cambiarPaginaPedido(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template v-else>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td colspan="10">No existen registros!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Modal Show Errors -->
        <div class="modal fade" v-if="accionmodal==1" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Automotores INKA</h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <div v-for="e in mensajeError" :key="e" v-text="e"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Buscar Proveedores -->
        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTADO</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cproveedornombre" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <template v-if="arrayProveedor.length">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-sm">
                                                            <thead>
                                                                <tr>
                                                                    <th>Seleccione</th>
                                                                    <th>Nombre Proveedor</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="proveedor in arrayProveedor" :key="proveedor.nIdPar">
                                                                    <td>
                                                                        <a href="#" @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre);">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
                                                                    </td>
                                                                    <td v-text="proveedor.cParNombre"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="col-lg-7">
                                                                <nav>
                                                                    <ul class="pagination">
                                                                        <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                        :class="[page==isActivedModal?'active':'']">
                                                                            <a class="page-link"
                                                                            href="#" @click.prevent="cambiarPaginaProveedor(page)"
                                                                            v-text="page"></a>
                                                                        </li>
                                                                        <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
                                                                        </li>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                            <div class="col-lg-5">
                                                                <div class="datatable-info">Mostrando {{ paginationModal.from }} a {{ paginationModal.to }} de {{ paginationModal.total }} registros</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td colspan="10">No existen registros!</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                fillBusquedaPedido:{
                    nidempresa: 1300011,
                    cempresa: 'SAISAC',
                    nidsucursal: 1300013,
                    csucursal: 'CHICLAYO',
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0,
                    dfechainicio: '',
                    dfechafin: ''
                },
                arrayPedidos: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                paginationModal: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset:3,
                modal:0,
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: []
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            isActivedModal: function(){
                return this.paginationModal.current_page;
            },
            pagesNumberModal: function() {
                if(!this.paginationModal.to) {
                    return [];
                }

                var from = this.paginationModal.current_page - this.offset;
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.paginationModal.last_page){
                    to = this.paginationModal.last_page;
                }

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
        methods: {
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBusquedaPedido.nidempresa,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.fillProveedor.nidproveedor = nProveedorId;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            llenarComboLinea(){
                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBusquedaPedido.nidempresa,
                        'nidproveedor' : this.fillProveedor.nidproveedor
                    }
                }).then(response => {
                    this.arrayLinea = response.data;
                    this.fillBusquedaPedido.nidlinea = 0;
                    this.llenarComboMarca();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea';

                axios.get(url, {
                    params: {
                        'nidlinea': this.fillBusquedaPedido.nidlinea
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
                    this.fillBusquedaPedido.nidmarca = 0;
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url, {
                    params: {
                        'nidmarca': this.fillBusquedaPedido.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    this.fillBusquedaPedido.nidmodelo = 0;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarPedidos(page){
                if(this.validarBuscarPedidos()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/getPedido/GetLstPedidos';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBusquedaPedido.nidempresa,
                        'nidsucursal' : this.fillBusquedaPedido.nidsucursal,
                        'nidlinea' : this.fillBusquedaPedido.nidlinea,
                        'nidmarca' : this.fillBusquedaPedido.nidmarca,
                        'nidmodelo' : this.fillBusquedaPedido.nidmodelo,
                        'dfechainicio': this.fillBusquedaPedido.dfechainicio,
                        'dfechafin': this.fillBusquedaPedido.dfechafin,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPedidos = response.data.arrayPedido.data;
                    this.pagination.current_page   =  response.data.arrayPedido.current_page;
                    this.pagination.total          = response.data.arrayPedido.total;
                    this.pagination.per_page       = response.data.arrayPedido.per_page;
                    this.pagination.last_page      = response.data.arrayPedido.last_page;
                    this.pagination.from           = response.data.arrayPedido.from;
                    this.pagination.to             = response.data.arrayPedido.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBuscarPedidos(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillBusquedaPedido.dfechainicio){
                    this.mensajeError.push('Debe ingresar una fecha de inicio');
                }

                if(!this.fillBusquedaPedido.dfechafin){
                    this.mensajeError.push('Debe ingresar una fecha de fin');
                }

                let fecha_ini = moment(this.fillBusquedaPedido.dfechainicio);
                let fecha_fin = moment(this.fillBusquedaPedido.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de inicio no puede ser menor a la fecha final');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPaginaPedido(page){
                this.paginationModal.current_page=page;
                this.buscarPedidos(page);
            },
            aprobarPedido(nIdPedido){
                swal({
                    title: '¿Esta seguro de aprobar el pedido N°' + nIdPedido + '?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#36A0FF',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Aceptar!',
                    cancelButtonText: 'Cancelar',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        var url = me.ruta + '/getPedido/aprobarPedido';
                        axios.put(url,{
                            nidpedido: nIdPedido
                        }).then(function (response) {
                            me.buscarPedidos(1);
                            swal(
                                'Aprobado!',
                                'El pedido ' + nIdPedido +' ha sido aprobado con éxito.',
                                'success'
                            )
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "proveedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarProveedores(1);
                                break;
                            }
                        }
                    }
                }
            },
            //Limpiar Paginación
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPaginacionModal(){
                this.paginationModal.current_page =  0,
                this.paginationModal.total = 0,
                this.paginationModal.per_page = 0,
                this.paginationModal.last_page = 0,
                this.paginationModal.from  = 0,
                this.paginationModal.to = 0
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
                //Modal Buscar Proveedores
                this.arrayProveedor = [];
            },
        }
    }
</script>

<style>
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: fixed !important;
        background-color: #3c29297a !important;
        overflow-y: scroll;
    }
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .error{
        display: flex;
        justify-content: center;
    }
    .text-center{
        color: red;
        font-weight: bold;
        font-size: 0.75rem;
        text-align: center;
        margin: auto;
    }
</style>
