<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Administración de Permisos</h2>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR USUARIOS</h3>
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
                                                    <label class="col-sm-4 form-control-label">Sucursal</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillPuga.nidsucursal" filterable clearable placeholder="SELECCIONE UNA SUCURSAL" >
                                                            <el-option
                                                                v-for="item in arraySucursal"
                                                                :key="item.nIdPar"
                                                                :label="item.cParNombre"
                                                                :value="item.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Apellidos</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="fillPuga.cdescripcion" @keyup.enter="listarUsuarios(1)" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarUsuarios(1)">
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
                                    <h3 class="h4">LISTADO USUARIOS</h3>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayUsuarios.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Apellidos y Nombres</th>
                                                        <th>Perfil</th>
                                                        <th>Usuario</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="usuario in arrayUsuarios" :key="usuario.nIdUsuario">
                                                        <td v-text="usuario.nIdUsuario"></td>
                                                        <td v-text="usuario.cNombreUsuario"></td>
                                                        <td v-text="usuario.cGrupoParNombre"></td>
                                                        <td v-text="usuario.cUsuario"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Ver Permisos {{ usuario.cNombreUsuario }}</div>
                                                                <i @click="abrirFormulario('usuario','permisos', usuario)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                            </el-tooltip>&nbsp;
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
                                                                <a @click.prevent="cambiarPagina(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                            </li>
                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                            :class="[page==isActived?'active':'']">
                                                                <a class="page-link"
                                                                href="#" @click.prevent="cambiarPagina(page)"
                                                                v-text="page"></a>
                                                            </li>
                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                <a @click.prevent="cambiarPagina(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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

            <template v-else>
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4" v-text="tituloFormulario"></h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="col-lg-6"  style="max-height: 515px; overflow-x: auto;">
                                            <div id="lsttreegrupo">
                                                <ul v-for="(permiso, index1) in arrayPermisos" :key="permiso.nIdPar">
                                                    <li>{{ permiso.cParJerarquia + ' ' +  permiso.cParNombre }}
                                                        <input type="checkbox" v-model="arrayCheckPermisos[index1]" class="checkbox-template">
                                                        <ul v-for="(subpermiso, index2) in arraySubPermisos" :key="subpermiso.nIdPar">
                                                            <li v-if="subpermiso.nCanJerarquia==permiso.cParJerarquia">
                                                                {{ subpermiso.cParJerarquia + ' ' + subpermiso.cParNombre }}
                                                                <input type="checkbox" v-model="arrayCheckSubPermisos[index2]" class="checkbox-template">
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-4">
                                                <button type="button" v-if="accion==2" class="btn btn-success btn-corner btn-sm" @click="seleccionaPermisos()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario()">
                                                    <i class="fa fa-close"></i> Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </template>

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
        </main>
    </transition>
</template>
<script>
    export default {
        props:['ruta'],
        data(){
            return {
                cempresa: 'SAISAC',
                //==========================================================
                //===================== LISTAR USUARIOS ====================
                fillPuga:{
                    nidempresa: 1300011,
                    nidsucursal: '',
                    cdescripcion: ''
                },
                arrayUsuarios: [],
                arraySucursal: [],
                //==========================================================
                //================== REGISTRO PERMISOS =====================
                formPuga:{
                    nidusuario: 0
                },
                arrayTemproralPermisos: [],
                arrayTemporalSubPermisos: [],
                arrayPermisos: [],
                arraySubPermisos: [],
                arrayCheckPermisos: [],
                arrayCheckSubPermisos: [],
                //==========================================================
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
            this.listarSucursal();
        },
        methods:{
            listarSucursal(){
                var url = this.ruta + '/parametro/GetListSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            listarUsuarios(page){
                if(this.validarBuscarUsuario()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puga/GetLstUsuarios';

                axios.get(url, {
                    params: {
                        'nidempresa': this.fillPuga.nidempresa,
                        'nidsucursal': this.fillPuga.nidsucursal,
                        'cdescripcion': this.fillPuga.cdescripcion,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayUsuarios = response.data.arrayUsuarios.data;
                    this.pagination.current_page =  response.data.arrayUsuarios.current_page;
                    this.pagination.total       = response.data.arrayUsuarios.total;
                    this.pagination.per_page    = response.data.arrayUsuarios.per_page;
                    this.pagination.last_page   = response.data.arrayUsuarios.last_page;
                    this.pagination.from        = response.data.arrayUsuarios.from;
                    this.pagination.to          = response.data.arrayUsuarios.to;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarUsuarios(page);
            },
            validarBuscarUsuario(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillPuga.nidsucursal){
                    this.mensajeError.push('Debe Seleccionar una Sucursal, es un campo Obligatorio');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarPermisos(nlenjerarquia){
                this.mostrarProgressBar();
                var url = this.ruta + '/puga/GetListPermisosByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillPuga.nidempresa,
                        'nidsucursal': this.fillPuga.nidsucursal,
                        'nidusuario': this.formPuga.nidusuario,
                        'nlenjerarquia': nlenjerarquia
                    }
                }).then(response => {
                    this.arrayPermisos = response.data;
                    this.listarSubPermisos(6);
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            listarSubPermisos(nlenjerarquia){
                var url = this.ruta + '/puga/GetListPermisosByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillPuga.nidempresa,
                        'nidsucursal': this.fillPuga.nidsucursal,
                        'nidusuario': this.formPuga.nidusuario,
                        'nlenjerarquia': nlenjerarquia
                    }
                }).then(response => {
                    this.arraySubPermisos = response.data;
                    this.llenarCheckBox();
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            llenarCheckBox(){
                let me = this;
                me.arrayPermisos.map(function(value, key){
                    me.arrayCheckPermisos[key] = value.cFlagVerifica == 0 ? 0 : value.cFlagVerifica;
                });
                me.arraySubPermisos.map(function(value, key){
                    me.arrayCheckSubPermisos[key] = value.cFlagVerifica == 0 ? 0 : value.cFlagVerifica;
                });

                jQuery(function ($) {
                    $("#lsttreegrupo").treeview();
                });
                $("#myBar").hide();
            },
            seleccionaPermisos(){
                let me = this;

                me.arrayTemproralPermisos = [];

                me.arrayPermisos.map(function(value, key) {
                    //Recorre los Permisos que esten activos
                    if(me.arrayCheckPermisos[key] == true) {
                        me.arrayTemproralPermisos.push({
                                nIdMenu: value.nIdPar
                        });
                    }
                });

                me.arraySubPermisos.map(function(value, key) {
                    //Recorre los SubPermisos que esten activos
                    if(me.arrayCheckSubPermisos[key] == true) {
                        me.arrayTemproralPermisos.push({
                                nIdMenu: value.nIdPar
                        });
                    }
                });
                this.eliminarPermisos();
            },
            eliminarPermisos(){
                var url = this.ruta + '/puga/DeletePermisosByUsuario';
                axios.post(url, {
                    'nIdEmpresa': this.fillPuga.nidempresa,
                    'nIdSucursal': sessionStorage.getItem("nIdSucursal"),
                    'nIdPerfil' : 0,
                    'nIdUsuario': this.formPuga.nidusuario
                }).then(response => {
                    this.registrarPermisos();
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            registrarPermisos(){
                /*if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }*/
                this.mostrarProgressBar();
                var url = this.ruta + '/puga/SetPermisosByUsuario';
                axios.post(url, {
                    'nIdEmpresa': this.fillPuga.nidempresa,
                    'nIdSucursal': this.fillPuga.nidsucursal,
                    'nIdPerfil' : 0,
                    'nIdUsuario': this.formPuga.nidusuario,
                    'arrayData':   this.arrayTemproralPermisos
                }).then(response => {
                    swal('Permisos Registrados');
                    // Para emitir eventos fuera del Componente primero
                    // El debe pasar como puente en el Componente
                    // De Igual Manera para recibir eventos hacia el Componente
                    // Primero debe pasar por el Componente
                    // this.$emit('cabecera', sessionStorage.getItem("nIdSucursal"));
                    this.$bus.$emit('event', this.fillPuga);
                    $("#myBar").hide();
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];
                /*if(this.formEle.nidproveedor == 0){
                    this.mensajeError.push('Debes Ingresar el Proveedor');
                };*/
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'usuario':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO ELEMENTO VENTA';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'permisos':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'PERMISOS';
                                this.formPuga.nidusuario = data['nIdUsuario'];
                                this.listarPermisos(4);
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formEle.nidproveedor= 0,
                this.formEle.cproveedornombre=  '',
                this.formEle.ntpoelemen= 0,
                this.formEle.nidmoneda= 0,
                this.formEle.celenombre= '',
                this.formEle.celecodigoerp= '',
                this.formEle.felevalorventa= '',
                this.formEle.felevarlorminventa='',
                this.arrayElementoVenta = []
            },
            cambiarVistaFormulario(){
                //this.limpiarFormulario();
                this.listarUsuarios(1);
                this.vistaFormulario = 1;
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            mostrarProgressBar(){
                $("#myBar").show();
                progress();
            }
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
    }
</style>
