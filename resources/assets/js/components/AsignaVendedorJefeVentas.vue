<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">MODULO ASIGNACIÓN DE ASESOR COMERCIAL A JEFE DE VENTAS</h2>
                    </vs-divider>
                </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">BUSCAR ASESOR COMERCIAL</h3>
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
                                    <h3 class="h4">LISTADO ASESORES COMERCIALES</h3>
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
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="usuario in arrayUsuarios" :key="usuario.nIdUsuario">
                                                        <td v-text="usuario.nIdUsuario"></td>
                                                        <td v-text="usuario.cNombreUsuario"></td>
                                                        <td v-text="usuario.cGrupoParNombre"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Ver Permisos {{ usuario.cNombreUsuario }}</div>
                                                                <i @click="cambiarVistaFormulario(0, usuario)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
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
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">Información Usuario</h3>
                                        </div>
                                        <div class="card-body">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Rol</label>
                                                            <div class="col-sm-8">
                                                                <label v-text="formAsignacion.cGrupoParNombre" class="form-control form-control-sm"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">* Nombre</label>
                                                            <div class="col-sm-8">
                                                                <label v-text="formAsignacion.cNombreUsuario" class="form-control form-control-sm"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <template v-if="arrayUsuariosVendedores.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Acción</th>
                                                                <th>Codigo</th>
                                                                <th>Rol</th>
                                                                <th>Vendedor</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="p in arrayUsuariosVendedores" :key="p.nIdPar">
                                                                <td>
                                                                    <template v-if="p.nFlagParParametro==1">
                                                                        <el-tooltip class="item" :content="'Desactivar ' + p.cNombreUsuario" effect="dark" placement="top-start">
                                                                            <i :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                        </el-tooltip>
                                                                    </template>
                                                                    <template v-else>
                                                                        <el-tooltip class="item" :content="'Activar ' + p.cNombreUsuario" effect="dark" placement="top-start">
                                                                            <i @click="registrar(p)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                        </el-tooltip>
                                                                    </template>
                                                                </td>
                                                                <td v-text="p.nIdUsuario"></td>
                                                                <td v-text="p.cGrupoParNombre"></td>
                                                                <td v-text="p.cNombreUsuario"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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
                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="cambiarVistaFormulario(1)">
                                                <i class="fa fa-back"></i> Regresar
                                            </button>
                                        </div>
                                    </div>
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
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                //==========================================================
                //===================== LISTAR USUARIOS ====================
                fillPuga:{
                    nidempresa: parseInt(sessionStorage.getItem("nIdEmpresa")),
                    nidsucursal: '',
                    cdescripcion: ''
                },
                arrayUsuarios: [],
                arraySucursal: [],
                //==========================================================
                //================== REGISTRO PERMISOS =====================
                formAsignacion:{
                    nIdUsuario: '',
                    cNombreUsuario: '',
                    nIdParParent: '',
                    cGrupoParNombre: ''
                },
                arrayUsuariosVendedores: [],
                arrayParParametro: [],
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
                        'nidempresa': this.fillPuga.nidempresa
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
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
            listarUsuarios(page){
                if(this.validarBuscarUsuario()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puga/GetListAsesorComercialByJF';

                axios.get(url, {
                    params: {
                        'nidempresa'    : this.fillPuga.nidempresa,
                        'nidsucursal'   : this.fillPuga.nidsucursal,
                        'cdescripcion'  : this.fillPuga.cdescripcion,
                        'nidgrupopar'   : 110026,
                        'nidparparent'  : 0,
                        'page'          : page
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
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
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
            //==========================================================
            //===================== ASIGNAR JV =========================
            listarUsuariosJefeVentasByEmpSucur(data = null, op){
                var url = this.ruta + '/puga/GetListAsesorComercialByJF';

                axios.get(url, {
                    params: {
                        'nidempresa'    : this.fillPuga.nidempresa,
                        'nidsucursal'   : this.fillPuga.nidsucursal,
                        'cdescripcion'  : this.fillPuga.cdescripcion,
                        'nidgrupopar'   : 110025,
                        'nidparparent'  : (op == 1) ? this.formAsignacion.nIdParParent : data,
                        'opcion'        : 1
                    }
                }).then(response => {
                    this.arrayUsuariosVendedores = response.data.arrayUsuarios;
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
            registrar(p){
                //Valida que el JV que se selecciono es el mismo que ya se encuentra asignado
                if(p.nFlagParParametro == 1){
                    console.log("Es igual")
                    return;
                }

                //Valida que existe Vendedor
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/puga/SetAsignarJefeVentas';
                axios.post(url, {
                    nIdUsuario : this.formAsignacion.nIdUsuario,
                    nIdParParent : p.nIdUsuario
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal(response.data[0].cMensaje);
                        this.arrayUsuariosVendedores = [];
                        this.listarUsuariosJefeVentasByEmpSucur(p.nIdUsuario, 2);
                    }
                    else{
                        swal(response.data[0].cMensaje);
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
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formAsignacion.nIdUsuario && !this.formAsignacion.cNombreUsuario){
                    this.mensajeError.push('Debes Seleccionar un Asesor de Ventas para realizar Asignación');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            //==========================================================
            //===================== METODOS GENÉRICOS ====================
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

                                break;
                            }
                            case 'permisos':
                            {

                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formAsignacion.nIdUsuario = '';
                this.formAsignacion.cNombreUsuario = '';
                this.formAsignacion.nIdParParent = '';
                this.formAsignacion.cGrupoParNombre = '';
                this.arrayUsuariosVendedores = [];
            },
            cambiarVistaFormulario(op, data = null){
                if(op == 1) {
                    this.listarUsuarios(1);
                    this.limpiarFormulario();
                }
                if(op == 0){
                    this.formAsignacion.nIdUsuario = data.nIdUsuario;
                    this.formAsignacion.cNombreUsuario = data.cNombreUsuario;
                    this.formAsignacion.nIdParParent = data.nIdParParent;
                    this.formAsignacion.cGrupoParNombre = data.cGrupoParNombre;
                    this.listarUsuariosJefeVentasByEmpSucur(null, 1);
                }
                // console.log(data);
                this.vistaFormulario = op;
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
