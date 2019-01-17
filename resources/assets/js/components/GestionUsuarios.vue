<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">Administración Usuarios</h2>
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
                                                        <input type="text" v-model="fillBsqUsuario.cdescripcion" class="form-control form-control-sm">
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
                                                        <td v-text="usuario.cParNombre"></td>
                                                        <td v-text="usuario.usuario"></td>
                                                        <td v-text="usuario.cGrupoParNombre"></td>
                                                        <td>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Ver Permisos {{ usuario.cParNombre }}</div>
                                                                <i @click="cambiarVistaFormulario(0, rol)" :style="'color:#796AEE'" class="fa-md fa fa-eye"></i>
                                                            </el-tooltip>&nbsp;
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Editar {{ usuario.cParNombre }}</div>
                                                                <i @click="cambiarVistaFormulario(0, rol)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
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
                    cdescripcion: ''
                },
                arrayEmpresas: [],
                arraySucursal: [],
                arrayUsuarios: [],
                //==========================================================
                //================== REGISTRO PERMISOS =====================

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
            this.listarEmpresa();
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
                var url = this.ruta + '/usuarios/GetListUsuarios';

                axios.get(url, {
                    params: {
                        'nidempresa': parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal': parseInt(sessionStorage.getItem("nIdSucursal")),
                        'cdescripcion': this.fillBsqUsuario.cdescripcion,
                        'opcion': 1,
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
    .imgRedonda {
        width:60px;
        height:60px;
        border-radius:150px;
        border:10px solid #666;
    }
</style>
