<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO ASIGNACION DE SOBRE PRECIO POR MODELO</h2>
                    </vs-divider>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR MODELOS</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Empresa</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="cempresa" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Sucursal</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="csucursal" class="form-control form-control-sm" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Jefe de ventas</label>
                                                    <div class="col-sm-8">
                                                        <label v-text="formAsignaModelo.cJefeVentaNombre" class="form-control-label-readonly"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="formAsignaModelo.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarModelos(1)">
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
                                    <h3 class="h4">LISTADO MODELOS</h3>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayModelos.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Linea</th>
                                                        <th>Marca</th>
                                                        <th>Modelo</th>
                                                        <th>Sobre Precio</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(modelo, index) in arrayModelos" :key="index">
                                                        <td v-text="modelo.cNombreLinea"></td>
                                                        <td v-text="modelo.cNombreMarca"></td>
                                                        <td v-text="modelo.cNombreModelo"></td>
                                                        <td><input type="text" class="form-control" v-model="modelo.fSobrePrecio"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Actualizar Sobre Precio del Modelo {{ modelo.cNombreModelo }}</div>
                                                                <i @click="actualizarSobrePrecio(modelo)" :style="'color:#796AEE'" class="fa-md fa fa-refresh"></i>
                                                            </el-tooltip>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-sm-7">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                <a @click.prevent="cambiarPaginaModelo(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                            </li>
                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                            :class="[page==isActived?'active':'']">
                                                                <a class="page-link"
                                                                href="#" @click.prevent="cambiarPaginaModelo(page)"
                                                                v-text="page"></a>
                                                            </li>
                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                <a @click.prevent="cambiarPaginaModelo(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                            </li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                                <div class="col-sm-5">
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
            </template>

            <!-- Modal Errores -->
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
                                <div v-for="e in mensajeError" :key="e" v-text="e">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL PROVEEDOR -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTADO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">Nombre</label>
                                                        <div class="col-sm-8">
                                                            <div class="input-group">
                                                                <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                <div class="input-group-prepend">
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Buscar Proveedor </div>
                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </el-tooltip>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
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
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ proveedor.cParNombre }}</div>
                                                                    <i @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="proveedor.cParNombre"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
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
                                                    <div class="col-sm-5">
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </transition>
</template>


<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                arrayProveedor: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                formAsignaModelo:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nJefeVentaId: 0,
                    cJefeVentaNombre: 'NO ES JEFE DE VENTAS'
                },
                arrayModelos: [],
                // Variables Genericas
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
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaFormulario: 1
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
            }
        },
        mounted(){
            this.informacionUsuario();
        },
        methods:{
            informacionUsuario(){
                var url = this.ruta + '/parametro/GetParametroById';
                axios.get(url, {
                    params: {
                        'nidpar'        : this.usuario.id,
                        'nidgrupopar'   : 110025
                    }
                }).then(response => {
                    this.formAsignaModelo.nJefeVentaId      =   response.data[0].nIdPar;
                    this.formAsignaModelo.cJefeVentaNombre  =   response.data[0].cParNombre;
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
            validarVerificaJefeVenta(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formAsignaModelo.nJefeVentaId == 0){
                    this.mensajeError.push('Debe ser Jefe de Ventas para realizar la búsqueda');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =============================================================
            // ===========  LISTAR MODELOS POR EMPRESA/PROVEEDOR ===========
            // ==========================================================
            listarModelos(page){
                if(this.validarVerificaJefeVenta()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/sobreprecio/GetListModelos';
                axios.get(url, {
                    params: {
                        'nidempresa'    :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'   :   parseInt(sessionStorage.getItem("nIdSucursal")),
                        'nidproveedor'  :   this.formAsignaModelo.nidproveedor,
                        'page'          :   page
                    }
                }).then(response => {
                    this.arrayModelos               =   response.data.arrayModelos.data;
                    this.pagination.current_page    =   response.data.arrayModelos.current_page;
                    this.pagination.total           =   response.data.arrayModelos.total;
                    this.pagination.per_page        =   response.data.arrayModelos.per_page;
                    this.pagination.last_page       =   response.data.arrayModelos.last_page;
                    this.pagination.from            =   response.data.arrayModelos.from;
                    this.pagination.to              =   response.data.arrayModelos.to;
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
            cambiarPaginaModelo(page){
                this.pagination.current_page=page;
                this.listarModelos(page);
            },
            actualizarSobrePrecio(modelo){
                if(this.validarModelo(modelo)){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                let me = this;

                var url = this.ruta + '/sobreprecio/SetAsignarSPByModelo';
                axios.post(url, {
                    nIdEmpresa      : modelo.nIdEmpresa,
                    nIdMarca        : modelo.nIdMarca,
                    nIdModelo       : modelo.nIdModelo,
                    fSobrePrecio    : modelo.fSobrePrecio,
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal(response.data[0].cMensaje + modelo.cNombreModelo);
                        this.listarModelos();
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
            validarModelo(modelo){
                this.error = 0;
                this.mensajeError =[];

                if(modelo.fSobrePrecio == 0 || modelo.fSobrePrecio == '' || modelo.fSobrePrecio == '0.00'){
                    this.mensajeError.push('El Sobre Precio no puede ser 0 ó vacío');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ==========================================================
            // =============  MODAL PROVEEDORES ========================
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa'        : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidgrupopar'       : 110023,
                        'cnombreproveedor'  : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion'            : 0,
                        'page'              : page
                    }
                }).then(response => {
                    this.arrayProveedor                 =   response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =   response.data.arrayProveedor.current_page;
                    this.paginationModal.total          =   response.data.arrayProveedor.total;
                    this.paginationModal.per_page       =   response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      =   response.data.arrayProveedor.last_page;
                    this.paginationModal.from           =   response.data.arrayProveedor.from;
                    this.paginationModal.to             =   response.data.arrayProveedor.to;
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
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formAsignaModelo.nidproveedor      = nProveedorId;
                this.formAsignaModelo.cproveedornombre  = cProveedorNombre;
                this.cerrarModal();
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            // ==========================================================
            // =============  METODOS GENERECISO ========================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'proveedor':
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
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            limpiarFormulario(){
            },
            cambiarVistaFormulario(){
                if(this.accion == 1){
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }else{
                    this.limpiarFormulario();
                    this.vistaFormulario = 1;
                }
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];
                if(!this.fillVendedor.nidmarca || this.fillVendedor.nidmarca == 0){
                    this.mensajeError.push('No ha seleccionado Marca');
                }
                if(!this.fillVendedor.nidmodelo || this.fillVendedor.nidmodelo == 0){
                    this.mensajeError.push('No ha seleccionado Modelo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            },
            mostrarNombreJefeV(){
                //var opcion_seleccionada = arrayJefeVentas[2].nIdPar=1300020;
                var nomb='';
                for(var i=0;i<this.arrayJefeVentas.length;i++){
                    if(this.arrayJefeVentas[i].nIdPar==this.formAsignaModelo.nJefeVentaId){
                        nomb=this.arrayJefeVentas[i].cParNombre;
                        this.fillVendedor.cnombrejefeventas= nomb;
                        this.arrayProveedorLinea=[];
                    }
                }
            },
        }
    }
</script>

