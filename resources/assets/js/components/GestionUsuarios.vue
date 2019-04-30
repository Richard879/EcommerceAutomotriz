<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO ADMINISTRACIÓN DE USUARIOS</vs-divider>
                    </h2>
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
                                                    <label class="col-sm-4 form-control-label">Empresa</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillBsqUsuario.nidempresa"
                                                                    filterable
                                                                    @change="listarSucursal"
                                                                    clearable
                                                                     placeholder="SELECCIONE UNA EMPRESA" >
                                                            <el-option
                                                                v-for="item in arrayEmpresas"
                                                                :key="item.nIdPar"
                                                                :label="item.cParNombre"
                                                                :value="item.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Sucursal</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillBsqUsuario.nidsucursal" filterable clearable placeholder="SELECCIONE UNA SUCURSAL" >
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
                                                    <label class="col-sm-4 form-control-label">Rol</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillBsqUsuario.nidrol"
                                                                    filterable
                                                                    clearable
                                                                    placeholder="SELECCIONE UN ROL" >
                                                            <el-option
                                                                v-for="item in arrayRolesBsq"
                                                                :key="item.nIdGrupoPar"
                                                                :label="item.cGrupoParNombre"
                                                                :value="item.nIdGrupoPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Nombre</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="fillBsqUsuario.cdescripcion" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarUsuarios(1)">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="cambiarVistaFormulario(0)">
                                                    <i class="fa fa-file-o"></i> Nuevo
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
                                                        <th>Imagen</th>
                                                        <th>Codigo</th>
                                                        <th>Nombre</th>
                                                        <th>Usuario</th>
                                                        <th>Rol</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="usuario in arrayUsuarios" :key="usuario.nIdUsuario">
                                                        <td>
                                                            <img :src="usuario.cPathImage" :alt="usuario.cParNombre" class="imgRedonda">
                                                        </td>
                                                        <td v-text="usuario.nIdUsuario"></td>
                                                        <td v-text="usuario.cNombreCompleto"></td>
                                                        <td v-text="usuario.cUsuario"></td>
                                                        <td v-text="usuario.cNombreRol"></td>
                                                        <td>
                                                            <template v-if="!usuario.nSalesEmployeeCode">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Integrar Trabajador  {{ usuario.cNombreCompleto }}</div>
                                                                    <i @click="registrarSapBusinessEmpleado(usuario)" :style="'color:green'" class="fa-spin fa-md fa fa-cube"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </template>
                                                            <!-- @click="cambiarVistaFormulario(0, rol)" -->
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Editar {{ usuario.cNombreCompleto }}</div>
                                                                <i  @click="abrirModal('usuario', 'editar', usuario)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;
                                                            <template v-if="usuario.condicion == 1">
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Desactivar Usuario {{ usuario.cNombreCompleto }}</div>
                                                                    <i  @click="cambiarEstado(0, usuario)"
                                                                        :style="'color:red'"
                                                                        class="fa-md fa fa-trash"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Activar Usuario {{ usuario.cNombreCompleto }}</div>
                                                                    <i  @click="cambiarEstado(1, usuario)"
                                                                        :style="'color:green'"
                                                                        class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </template>
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
                                    <h3 class="h4">REGISTRAR NUEVO USUARIO</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Empresa</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillUsuario.nidempresa"
                                                                    filterable
                                                                    @change="listarSucursal2"
                                                                    clearable
                                                                     placeholder="SELECCIONE UNA EMPRESA" >
                                                            <el-option
                                                                v-for="item in arrayEmpresas"
                                                                :key="item.nIdPar"
                                                                :label="item.cParNombre"
                                                                :value="item.nIdPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Sucursal</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillUsuario.nidsucursal" filterable clearable placeholder="SELECCIONE UNA SUCURSAL" >
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
                                                    <label class="col-sm-4 form-control-label">* Nombre Completo</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="fillUsuario.cnombrecompleto" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Usuario</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="fillUsuario.cusuario" style="text-transform:uppercase" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <!-- <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Contraseña</label>
                                                    <div class="col-sm-8">
                                                        <input type="password" v-model="fillUsuario.cpassword" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Contraseña</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="password" placeholder="INGRESE O GENERE CONTRASEÑA" v-model="fillUsuario.cpassword" style="text-transform:uppercase" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Generar Contraseña" class="btn btn-info btn-corner btn-sm" @click="generarContrasena">
                                                                    <i class="fa-lg fa fa-refresh"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Rol</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillUsuario.nrol" filterable clearable placeholder="SELECCIONE UN ROL">
                                                            <el-option
                                                                v-for="item in arrayRoles"
                                                                :key="item.nIdGrupoPar"
                                                                :label="item.cGrupoParNombre"
                                                                :value="item.nIdGrupoPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Rol</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" placeholder="SELECCIONE UN ROL" v-model="fillUsuario.cnombrerol" disabled="disabled" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('rol','buscar')">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Fotografía</label>
                                                    <div class="col-sm-8">
                                                        <input type="file" id="file-upload" @change="getFile" accept="image/*" class="form-control form-control-sm"/>
                                                    </div>
                                                    <div id="preview">
                                                        <img v-if="urlImage" :src="urlImage"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarUsuario()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario(1)">
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
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">LISTAR ROLES</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillRol.crolnombre" @keyup.enter="bucarRol()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Rol" class="btn btn-info btn-corner btn-sm" @click="bucarRol();">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <template v-if="arrayRoles.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Seleccione</th>
                                                                <th>Nombre Rol</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="rol in arrayRoles" :key="rol.nIdPar">
                                                                <td>
                                                                    <a href="#" @click="asignarRol(rol.nIdGrupoPar, rol.cGrupoParNombre);">
                                                                        <i class='fa-md fa fa-check-circle'></i>
                                                                    </a>
                                                                </td>
                                                                <td v-text="rol.cGrupoParNombre"></td>
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
                            </form>
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
                //==========================================================
                //===================== LISTAR USUARIOS ====================
                fillBsqUsuario: {
                    nidempresa: '',
                    nidsucursal: '',
                    nidrol: '',
                    cdescripcion: ''
                },
                arrayEmpresas: [],
                arraySucursal: [],
                arrayRolesBsq: [],
                arrayUsuarios: [],
                //==========================================================
                //================== REGISTRAR USUARIO =====================
                flagRegistrarEditar: 1,
                fillUsuario: {
                    nIdUsuario: '',
                    nidempresa: '',
                    nidsucursal: '',
                    cnombrecompleto: '',
                    cusuario: '',
                    cpassword: '',
                    nrol: '',
                    cnombrerol: ''
                },
                fillRol:{
                    crolnombre: ''
                },
                arrayRoles: [],
                attachment: '',// Archivo a almacenar
                form: new FormData,// El archivo tendrá que ser enviado como elemento FormData
                urlImage: '',
                arrayPermisosbyRol: [],
                //==========================================================
                //================== VARIABLES SAP =====================
                arraySapRespuesta: [],
                arraySapUpdVendedor: [],
                jsonRespuesta: '',
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
                vistaFormulario: 1,
                loading: false
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
            this.listarEmpresa();
            this.listarRolesPreConfigBsq();
        },
        methods:{
            listarEmpresa(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110021
                    }
                }).then(response => {
                    this.arrayEmpresas = response.data;
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
            listarSucursal(){
                var url = this.ruta + '/parametro/GetListSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillBsqUsuario.nidempresa
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
            listarRolesPreConfigBsq(){
                var url = this.ruta + '/usuario/GetListRolesBsq';
                axios.get(url, {
                    params: {
                        'nidrol': this.fillBsqUsuario.nidrol
                    }
                }).then(response => {
                    this.arrayRolesBsq = response.data;
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
                if(this.validarListarUsuarios()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/usuario/GetListUsuarios';

                axios.get(url, {
                    params: {
                        'nidempresa'    :   this.fillBsqUsuario.nidempresa,
                        'nidsucursal'   :   this.fillBsqUsuario.nidsucursal,
                        'nidrol'        :   this.fillBsqUsuario.nidrol,
                        'cdescripcion'  :   this.fillBsqUsuario.cdescripcion,
                        'opcion': 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayUsuarios              =   response.data.arrayUsuarios.data;
                    this.pagination.current_page    =   response.data.arrayUsuarios.current_page;
                    this.pagination.total           =   response.data.arrayUsuarios.total;
                    this.pagination.per_page        =   response.data.arrayUsuarios.per_page;
                    this.pagination.last_page       =   response.data.arrayUsuarios.last_page;
                    this.pagination.from            =   response.data.arrayUsuarios.from;
                    this.pagination.to              =   response.data.arrayUsuarios.to;
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
            validarListarUsuarios(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillBsqUsuario.nidempresa){
                    this.mensajeError.push('Debe seleccionar una Empresa');
                }
                if(!this.fillBsqUsuario.nidsucursal){
                    this.mensajeError.push('Debe seleccionar una Sucursal');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarEstado(op, usuario){
                swal({
                    title: '¿Esta seguro de ' + ((op == 0) ? 'Desactivar' : ' Activar ') + ' Al Usuario ' + usuario.cNombreCompleto + '?',
                    text: 'Se Cerrarán las Sesiones en todos sus dispositivos!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, ' + ((op == 0) ? 'Desactivar' : ' Activar '),
                    cancelButtonText: 'No, cerrar!'
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        this.mostrarProgressBar();

                        var url = this.ruta + '/usuario/SetCambiarEstadoUsuario';
                        axios.put(url, {
                            nIdUsuario : usuario.nIdUsuario,
                            opcion : op
                        }).then(response => {
                            // console.log(response)
                            me.listarUsuarios(1);
                            $("#myBar").hide();
                            swal(
                                ((op == 0) ? 'Desactivado' : ' Activado '),
                                'El Usuario ' + usuario.cNombreCompleto +' ha sido ' + ((op == 0) ? 'Desactivado' : ' Activado ') + ' con éxito.',
                                'success'
                            )
                        }).catch(error => {
                            console.log(error);
                            if (error.response) {
                                if (error.response.status == 401) {
                                    swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                    location.reload('0');
                                }
                            }
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel) {}
                })
            },
            //====================================================================
            //===================== METODOS REGISTRAR USUARIO ====================
            // =======================
            // MODAL ROL
            // =======================
            bucarRol(){
                this.listarRolesPreConfig(1);
            },
            getFile(e){
                let selectFile  = e.target.files[0];
                this.attachment = selectFile;
                this.urlImage   = URL.createObjectURL(selectFile);
            },
            listarRolesPreConfig(){
                var url = this.ruta + '/usuario/GetListRoles';
                axios.get(url, {
                    params: {
                        'cnombre': this.fillRol.crolnombre
                    }
                }).then(response => {
                    this.arrayRoles = response.data;
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
            generarContrasena(){
                let me = this;
                me.fillUsuario.cpassword = me.fillUsuario.cusuario  + '123';
            },
            asignarRol(nIdGrupoPar, cGrupoParNombre){
                this.fillUsuario.nrol = nIdGrupoPar;
                this.fillUsuario.cnombrerol = cGrupoParNombre;
                this.cerrarModal();
            },
            listarSucursal2(){
                var url = this.ruta + '/parametro/GetListSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidempresa': this.fillUsuario.nidempresa
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
            registrarUsuario(){
                if(this.validarRegistrarUsuario()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //AGREGAR ARCHIVO AL FORM DATA
                this.form.append('file', this.attachment);
                this.form.append('nidusuario', this.fillUsuario.nIdUsuario);
                this.form.append('nidempresa', this.fillUsuario.nidempresa);
                this.form.append('nidsucursal', this.fillUsuario.nidsucursal);
                this.form.append('cnombrecompleto', this.fillUsuario.cnombrecompleto);
                this.form.append('cusuario', this.fillUsuario.cusuario);
                this.form.append('cpassword', this.fillUsuario.cpassword);
                this.form.append('nrol', this.fillUsuario.nrol);

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                // Mostrar ProgressBar
                this.mostrarProgressBar();

                let url;
                (this.flagRegistrarEditar == 1) ? (url = this.ruta + '/usuario/SetRegistrarUsuario') : (url = this.ruta + '/usuario/SetEditarUsuario');
                axios.post(url, this.form, config).then(response => {
                    // console.log(response.data)
                    if(response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);

                        (this.flagRegistrarEditar == 1) ? this.fillUsuario.nIdUsuario = response.data[0].nIdPar : '';
                        this.obtenerPermisosPorRol();
                    } else {
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
            validarRegistrarUsuario(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(!this.fillUsuario.nidempresa) {
                    me.mensajeError.push('Debe Seleccionar una Empresa, es un campo obligatorio ');
                }
                if(!this.fillUsuario.nidsucursal) {
                    me.mensajeError.push('Debe Seleccionar una Sucursal, es un campo obligatorio ');
                }
                if(!this.fillUsuario.cnombrecompleto) {
                    me.mensajeError.push('Debe Ingresar un Nombre, es un campo obligatorio ');
                }
                if(!this.fillUsuario.cusuario) {
                    me.mensajeError.push('Debe Ingresar un Usuario, es un campo obligatorio ');
                }
                if(!this.fillUsuario.cpassword) {
                    me.mensajeError.push('Debe Ingresar una Contraseña, es un campo obligatorio ');
                }
                if(!this.fillUsuario.nrol && !this.fillUsuario.cnombrerol) {
                    me.mensajeError.push('Debe seleccionar un Rol, es un campo obligatorio ');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            obtenerPermisosPorRol(){
                var url = this.ruta + '/usuario/GetListPermisosByRol';
                axios.get(url, {
                    params: {
                        'nrol': this.fillUsuario.nrol
                    }
                }).then(response => {
                    // console.log(response.data)
                    this.arrayPermisosbyRol = response.data;

                    (this.flagRegistrarEditar == 1) ? this.registrarPermisosByRol() : this.eliminarPermisosByRol();
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
            eliminarPermisosByRol(){
                let me = this;

                var url = this.ruta + '/usuario/SetEliminarPermisosByUsuario';
                axios.post(url, {
                    'nIdEmpresa'    :   this.fillUsuario.nidempresa,
                    'nIdSucursal'   :   this.fillUsuario.nidsucursal,
                    'nIdUsuario'    :   this.fillUsuario.nIdUsuario,
                    'nIdPerfil'     :   this.fillUsuario.nrol
                }).then(response => {
                    // console.log(response.data);
                    if(response.data[0].nFlagMsje == 1) {
                        me.registrarPermisosByRol()
                    } else {
                        swal("Ocurrio un error al eliminar los permisos del Usuario");
                    }
                }).catch(error => {
                    this.errors = error
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            registrarPermisosByRol(){
                let me = this;

                var url = this.ruta + '/usuario/SetPermisosByUsuario';
                axios.post(url, {
                    'nIdEmpresa'    :   this.fillUsuario.nidempresa,
                    'nIdSucursal'   :   this.fillUsuario.nidsucursal,
                    'nIdUsuario'    :   this.fillUsuario.nIdUsuario,
                    'nIdPerfil'     :   this.fillUsuario.nrol,
                    'arrayData'     :   this.arrayPermisosbyRol
                }).then(response => {
                    // console.log(response.data);
                    if(response.data[0].nFlagMsje == 1) {
                        // (me.flagRegistrarEditar == 1) ? this.registrarSapBusinessEmpleado2() : this.actualizarSapBusinessEmpleado();
                        if(me.flagRegistrarEditar == 1) {
                            // me.registrarSapBusinessEmpleado2()
                            me.limpiarFormulario();
                            $("#myBar").hide();
                            me.loading.close();
                        } else {
                            me.limpiarFormulario();
                            $("#myBar").hide();
                            me.loading.close();
                        }
                        // swal(response.data[0].cMensaje);
                        // this.cambiarVistaFormulario(1);
                    } else {
                        swal("Ocurrio un error al generar los permisos del Usuario");
                    }
                    // Ocultar ProgressBar
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
            registrarSapBusinessEmpleado2(){
                let me = this;
                this.mostrarProgressBar();
                me.loadingProgressBar("GENERANDO VENDEDOR EN SAP BUSINESS ONE...");

                var url = this.ruta + '/empleado/SapSetEmpleado';
                axios.post(url, {
                    cNombre : me.fillUsuario.cnombrecompleto,
                    cRol    : me.fillUsuario.cnombrerol
                }).then(response => {
                    me.arraySapRespuesta = response.data;
                    me.jsonRespuesta = '';
                    me.jsonRespuesta= JSON.parse(me.arraySapRespuesta);
                    if(me.jsonRespuesta.SalesEmployeeCode) {
                        console.log("Integración Vendedor - SAP : OK");
                        me.arraySapUpdVendedor.push({
                            'nUsuario'          :   parseInt(me.fillUsuario.nIdUsuario),
                            'SalesEmployeeCode' :   parseInt(me.jsonRespuesta.SalesEmployeeCode),
                            'cLogRespuesta'     :   me.arraySapRespuesta.toString()
                        });
                    }
                    // ==============================================================
                    // ================== ACTUALIZAR DOCENTRY PEDIDO ================
                    setTimeout(function() {
                        me.registroSgcVendedor();
                    }, 3800);
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al Generar el Vendedor en SapB1!',
                    });
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            actualizarSapBusinessEmpleado(){
                let me = this;
                this.mostrarProgressBar();
                me.loadingProgressBar("ACTUALIZANDO VENDEDOR EN SAP BUSINESS ONE...");

                var url = this.ruta + '/empleado/SapPatchEmpleado';
                axios.post(url, {
                    cNombre : usuario.cNombreCompleto,
                    cRol    : usuario.cNombreRol
                }).then(response => {
                    // console.log(response.data);
                    me.arraySapRespuesta = response.data;
                    me.jsonRespuesta = '';
                    me.jsonRespuesta= JSON.parse(me.arraySapRespuesta);
                    if(me.jsonRespuesta.SalesEmployeeCode) {
                        console.log("Integración Vendedor - SAP : OK");
                        me.arraySapUpdVendedor.push({
                            'nUsuario'          :   parseInt(usuario.nIdUsuario),
                            'SalesEmployeeCode' :   parseInt(me.jsonRespuesta.SalesEmployeeCode),
                            'cLogRespuesta'     :   me.arraySapRespuesta.toString()
                        });
                    }
                    // ==============================================================
                    // ================== ACTUALIZAR DOCENTRY PEDIDO ================
                    setTimeout(function() {
                        me.registroSgcVendedor();
                    }, 3800);
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al Actualizar el Vendedor en SapB1!',
                    });
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //========================================================================
            //===================== METODOS REGISTRAR USUARIO SAP ====================
            registrarSapBusinessEmpleado(usuario){
                // console.log(usuario);
                let me = this;
                this.mostrarProgressBar();
                me.loadingProgressBar("GENERANDO VENDEDOR EN SAP BUSINESS ONE...");

                var url = this.ruta + '/empleado/SapSetEmpleado';
                axios.post(url, {
                    cNombre : usuario.cNombreCompleto,
                    cRol    : usuario.cNombreRol
                }).then(response => {
                    // console.log(response.data);
                    me.arraySapRespuesta = response.data;
                    me.jsonRespuesta = '';
                    me.jsonRespuesta= JSON.parse(me.arraySapRespuesta);
                    if(me.jsonRespuesta.SalesEmployeeCode) {
                        console.log("Integración Vendedor - SAP : OK");
                        me.arraySapUpdVendedor.push({
                            'nUsuario'          :   parseInt(usuario.nIdUsuario),
                            'SalesEmployeeCode' :   parseInt(me.jsonRespuesta.SalesEmployeeCode),
                            'cLogRespuesta'     :   me.arraySapRespuesta.toString()
                        });
                    }
                    // ==============================================================
                    // ================== ACTUALIZAR DOCENTRY PEDIDO ================
                    setTimeout(function() {
                        me.registroSgcVendedor();
                    }, 3800);
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al Generar el Vendedor en SapB1!',
                    });
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            registroSgcVendedor(){
                let me = this;

                var sapUrl = me.ruta + '/empleado/SetIntegraEmpleado';
                axios.post(sapUrl, {
                    'arraySapUpdVendedor': me.arraySapUpdVendedor
                }).then(response => {
                    if (response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje)
                        this.limpiarFormulario();
                        $("#myBar").hide();
                        me.loading.close();
                    } else {
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Error en el Registro del Empleado!',
                        })
                    }
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 403) {
                            swal('ACCESO RESTRINGIDO - 403');
                            location.reload('0');
                        }
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },
            //============================================================
            //===================== METODOS GENÉRICOS ====================
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'rol':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.listarRolesPreConfig();
                                break;
                            }
                        }
                    }
                    break;
                    case 'usuario':
                    {
                        switch(accion){
                            case 'editar':
                            {
                                this.cambiarVistaFormulario(0);
                                this.fillUsuario.nIdUsuario         =   data['nIdUsuario'];
                                this.fillUsuario.nidempresa         =   data['nIdEmpresa'];
                                this.fillUsuario.nidsucursal        =   data['nIdSucursal'];
                                this.fillUsuario.cnombrecompleto    =   data['cNombreCompleto'];
                                this.fillUsuario.cusuario           =   data['cUsuario'];
                                this.fillUsuario.cpassword          =   '';
                                this.fillUsuario.nrol               =   data['nIdRol'];
                                this.fillUsuario.cnombrerol         =   data['cNombreRol'];
                                this.urlImage                       =   data['cPathImage'];
                                this.flagRegistrarEditar = 2;
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                //Busqueda
                this.listarEmpresa();
                this.fillBsqUsuario.nidempresa = '';
                this.fillBsqUsuario.nidsucursal = '';
                this.fillBsqUsuario.cdescripcion = '';
                this.arrayUsuarios = [];
                //Integracion
                this.arraySapRespuesta = [];
                this.jsonRespuesta = '';
                this.arraySapUpdVendedor = [];
                //Registrar
                this.fillUsuario.nIdUsuario = '';
                this.fillUsuario.nidempresa = '';
                this.fillUsuario.nidsucursal = '';
                this.fillUsuario.cnombrecompleto = '';
                this.fillUsuario.cusuario = '';
                this.fillUsuario.cpassword = '';
                this.fillUsuario.nrol = '';
                this.fillUsuario.cnombrerol = '';
                this.attachment = '';
                this.form = '';//Seteo a vacio
                this.form = new FormData;//Inicializo el Obj FormData
                this.urlImage = '';
                this.arrayPermisosbyRol = []
            },
            cambiarVistaFormulario(op, data = null){
                if(op == 1) {
                    this.limpiarFormulario();
                }
                if(op == 0){
                    this.flagRegistrarEditar = 1;
                    this.listarEmpresa();
                    this.listarRolesPreConfig();
                }
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
            },
            loadingProgressBar(texto){
                this.loading = this.$loading({
                    lock: true,
                    text: texto,
                    spinner: 'fa-spin fa-md fa fa-cube',
                    background: 'rgba(0, 0, 0, 0.7)'
                });
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
    .imgRedonda{
        width:30px;
        height:30px;
        border-radius:150px;
        border:3px solid #666;
    }
    #preview{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #preview img{
        max-width: 20%;
        min-width: 20%;
        max-height: 200px;
        border-radius: 120px;
        border: 5px solid #666;
    }
</style>
