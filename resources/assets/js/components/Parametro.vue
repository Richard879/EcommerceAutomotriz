<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom">Parámetros</h2>
            </div>
            </header>

            <template v-if="vistaFormulario">
                <section class="forms">
                    <div class="container-fluid">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="h4">LISTADO</h3>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Grupo</label>
                                                    <div class="col-sm-8">
                                                        <el-select v-model="fillParametro.nidgrupopar" filterable clearable placeholder="SELECCIONE" >
                                                            <el-option
                                                            v-for="item in arrayGrupoParametro"
                                                            :key="item.nIdGrupoPar"
                                                            :label="item.cGrupoParNombre"
                                                            :value="item.nIdGrupoPar">
                                                            </el-option>
                                                        </el-select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Descripción</label>
                                                    <div class="col-sm-8">
                                                        <el-input
                                                            placeholder=""
                                                            v-model="fillParametro.cparnombre"
                                                            clearable>
                                                        </el-input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-4">
                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarParametroByGrupo(1);">
                                                    <i class="fa fa-search"></i> Buscar
                                                </button>
                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('parametro','registrar')">
                                                    <i class="fa fa-file-o"></i> Nuevo
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <template v-if="arrayParametro.length">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-sm">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Grupo</th>
                                                        <th>Jerarquia</th>
                                                        <th>Nombre</th>
                                                        <th>Descripción</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="p in arrayParametro" :key="p.nIdPar">
                                                        <td v-text="p.nIdPar"></td>
                                                        <td v-text="p.nIdGrupoPar"></td>
                                                        <td v-text="p.cParJerarquia"></td>
                                                        <td v-text="p.cParAbreviatura"></td>
                                                        <td v-text="p.cParNombre"></td>
                                                        <td>
                                                            <el-tooltip class="item" :content="'Configurar Parámetro ' + p.cParNombre" effect="dark" placement="top-start">
                                                                <i @click="abrirModal('parametro', 'configurar', p)" :style="'color:#796AEE'" class="fa-md fa fa-cog"></i>
                                                            </el-tooltip>&nbsp;&nbsp;
                                                            <el-tooltip class="item" :content="'Editar ' + p.cParNombre" effect="dark" placement="top-start">
                                                                <i @click="abrirFormulario('parametro','actualizar', p)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                            </el-tooltip>&nbsp;&nbsp;
                                                            <template v-if="p.cSituacionRegistro=='A'">
                                                                <el-tooltip class="item" :content="'Desactivar ' + p.cParNombre" effect="dark" placement="top-start">
                                                                    <i @click="desactivar(p)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                                </el-tooltip>
                                                            </template>
                                                            <template v-else>
                                                                <el-tooltip class="item" :content="'Activar ' + p.cParNombre" effect="dark" placement="top-start">
                                                                    <i @click="activar(p)" :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                </el-tooltip>
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
                                    <h3 class="h4">LISTA DE PROVEEDORES</h3>
                                </div>
                                <div class="card-body">
                                    <form v-on:submit.prevent class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Grupo</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formParametro.nidgrupopar" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Jerarquía</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formParametro.cparjerarquia" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formParametro.cparabreviatura" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">* Descripción</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" v-model="formParametro.cparnombre" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-5">
                                                <button type="button" v-if="accion==1" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                    <i class="fa fa-save"></i> Registrar
                                                </button>
                                                <button type="button" v-if="accion==2" class="btn btn-secondary btn-corner btn-sm" @click="actualizar()">
                                                    <i class="fa fa-save"></i> Actualizar
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

            <!-- Show Errors -->
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

            <!-- Configuracion Tipo Parametro -->
            <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">CONFIGURACIONES</h3>
                                    </div>
                                    <div class="card-body">
                                        <template v-if="arrayTipoParametro.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acciones</th>
                                                            <th>Descripción</th>
                                                            <th>Tipo Parametro</th>
                                                            <th>Valor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="tipo in arrayTipoParametro" :key="tipo.nIdTipoPar">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Actualizar {{ tipo.cParNombre }}</div>
                                                                    <i @click="actualizarTipoParametro(tipo)" :style="'color:green'" class="fa-md fa fa-save"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="tipo.cParNombre"></td>
                                                            <td v-text="tipo.cTipoDescripcion"></td>
                                                            <td v-if="tipo.cTipoParametro=='D'">
                                                                <input type="text" v-model="tipo.cDatoParDescripcion" class="form-control form-control-sm">
                                                            </td>
                                                            <td v-if="tipo.cTipoParametro=='N'">
                                                                <input type="text" v-model="tipo.nDatoParNumerico" class="form-control form-control-sm">
                                                            </td>
                                                            <td v-if="tipo.cTipoParametro=='P'">
                                                                <input type="text" v-model="tipo.fDatoParPorcentual" class="form-control form-control-sm">
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
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoParametro(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaTipoParametro(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaTipoParametro(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
        props:['ruta'],
        data(){
            return {
                cempresa: sessionStorage.getItem("cNombreEmpresa"),
                arrayProveedor: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                // =============================================================
                // =========== VARIABLES PARAMETRO ===========
                fillParametro:{
                    nidgrupopar: '',
                    cparnombre: ''
                },
                formParametro:{
                    nidpar: 0,
                    nidgrupopar: '',
                    cparjerarquia: '',
                    cparabreviatura: '',
                    cparnombre: ''
                },
                arrayGrupoParametro: [],
                arrayParametro: [],
                arrayTipoParametro: [],
                // =============================================================
                pagination: {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
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
                accion: 0,
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
        mounted(){
            this.llenarComboGrupoParametro();
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
        methods:{
            llenarComboGrupoParametro(){
                var url = this.ruta + '/grupopar/GetListGrupoParametro';

                axios.get(url, {
                    params: {
                        'opcion' : 1
                    }
                }).then(response => {
                    this.arrayGrupoParametro = response.data.arrayGrupoParametro;
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
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor';

                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110023,
                        'cnombreproveedor' : this.fillProveedor.cnombreproveedor.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total = response.data.arrayProveedor.total;
                    this.paginationModal.per_page    = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayProveedor.last_page;
                    this.paginationModal.from        = response.data.arrayProveedor.from;
                    this.paginationModal.to           = response.data.arrayProveedor.to;
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
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formVersion.nidproveedor = nProveedorId;
                this.formVersion.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            validarBusqueda(){
                this.error = 0;
                this.mensajeError =[];
                if(this.fillParametro.nidgrupopar == 0 || !this.fillParametro.nidgrupopar){
                    this.mensajeError.push('Debes Seleccionar un Grupo');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarParametroByGrupo(page){
                if(this.validarBusqueda()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.mostrarProgressBar();
                var url = this.ruta + '/parametro/GetListParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : this.fillParametro.nidgrupopar,
                        'cparnombre': this.fillParametro.cparnombre,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayParametro = response.data.arrayParametro.data;
                    this.pagination.current_page =  response.data.arrayParametro.current_page;
                    this.pagination.total = response.data.arrayParametro.total;
                    this.pagination.per_page    = response.data.arrayParametro.per_page;
                    this.pagination.last_page   = response.data.arrayParametro.last_page;
                    this.pagination.from        = response.data.arrayParametro.from;
                    this.pagination.to           = response.data.arrayParametro.to;
                    $("#myBar").hide();
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
                this.listarParametroByGrupo(page);
            },
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/parametro/SetParametro';
                axios.post(url, {
                    nIdGrupoPar: parseInt(this.formParametro.nidgrupopar),
                    cParJerarquia: this.formParametro.cparjerarquia,
                    cParAbreviatura: this.formParametro.cparabreviatura,
                    cParNombre: this.formParametro.cparnombre
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Parámetro registrado');
                        this.limpiarFormulario();
                        this.listarParametroByGrupo(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Parámetro');
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

                if(this.accion == 2 && (this.formParametro.nidpar == 0 || !this.formParametro.nidpar)){
                    this.mensajeError.push('No ha seleccionado un Parámetro');
                }

                if(this.formParametro.nidgrupopar == ''){
                    this.mensajeError.push('Debes Ingresar una Grupo');
                };
                if(this.formParametro.cparnombre == ''){
                    this.mensajeError.push('Debes Ingresar una Nombre');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            actualizar(){
                var url = this.ruta + '/parametro/UpdParametroById';

                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                axios.post(url, {
                    nIdPar: parseInt(this.formParametro.nidpar),
                    nIdGrupoPar: parseInt(this.formParametro.nidgrupopar),
                    cParJerarquia: this.formParametro.cparjerarquia,
                    cParAbreviatura: this.formParametro.cparabreviatura,
                    cParNombre: this.formParametro.cparnombre
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Parámetro Actualizado');
                        this.limpiarFormulario();
                        this.listarParametroByGrupo(1);
                        this.vistaFormulario = 1;
                    }
                    else{
                        swal('Ya existe Parámetro');
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
            activar(parametro){
                swal({
                    title: 'Estas seguro de activar este Parámetro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/parametro/activar';
                            axios.put(url, {
                                nIdPar: parseInt(parametro.nIdPar)
                            }).then(response => {
                                swal(
                                'Activado!',
                                'El registro fue activado.'
                                );
                                this.listarParametroByGrupo(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            desactivar(parametro){
                swal({
                    title: 'Estas seguro de desactivar este Parámetro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/parametro/desactivar';
                            axios.put(url, {
                                nIdPar: parseInt(parametro.nIdPar)
                            }).then(response => {
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarParametroByGrupo(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            //================ CONFIGURAR TIPO PARAMETRO =====================
            listarTipoParametro(page){
                var url = this.ruta + '/tipoparametro/GetTipoByIdParametro';
                axios.get(url, {
                    params: {
                        'nidpar': this.formParametro.nidpar,
                        'ctipoparametro': '',
                        'nidtipopar': 0,
                        'page': page
                    }
                }).then(response => {
                    this.arrayTipoParametro = response.data.arrayTipoParametro.data;
                    this.paginationModal.current_page =  response.data.arrayTipoParametro.current_page;
                    this.paginationModal.total = response.data.arrayTipoParametro.total;
                    this.paginationModal.per_page    = response.data.arrayTipoParametro.per_page;
                    this.paginationModal.last_page   = response.data.arrayTipoParametro.last_page;
                    this.paginationModal.from        = response.data.arrayTipoParametro.from;
                    this.paginationModal.to           = response.data.arrayTipoParametro.to;
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
            cambiarPaginaTipoParametro(page){
                this.paginationModal.current_page=page;
                this.listarTipoParametro(page);
            },
            actualizarTipoParametro(objTipoPar){
                swal({
                    title: 'Estas seguro de actualizar este TipoParámetro?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Actualizar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            
                            var cDatoParDescripcion = "", nDatoParNumerico = 0, fDatoParPorcentual = 0;

                            if(objTipoPar.cTipoParametro == 'D'){
                                this.cDatoParDescripcion =  objTipoPar.cDatoParDescripcion;
                            };
                            if(objTipoPar.cTipoParametro == 'N'){
                                this.nDatoParNumerico =  objTipoPar.nDatoParNumerico;
                            };
                            if(objTipoPar.cTipoParametro == 'P'){
                                this.fDatoParPorcentual =  objTipoPar.fDatoParPorcentual; 
                            };

                            var url = this.ruta + '/tipoparametro/UpdTipoParametroById';
                            axios.post(url, {
                                'nIdTipoPar': parseInt(objTipoPar.nIdTipoPar),
                                'nIdPar': parseInt(objTipoPar.nIdPar),
                                'cTipoParametro': objTipoPar.cTipoParametro,
                                'cDatoParDescripcion': this.cDatoParDescripcion,
                                'nDatoParNumerico': this.nDatoParNumerico,
                                'fDatoParPorcentual': this.fDatoParPorcentual
                            }).then(response => {
                                swal(
                                'Actualizado!',
                                'El registro fue actulizado.'
                                );
                                this.listarTipoParametro(1);
                            })
                            .catch(function (error) {
                                console.log(error);
                                if (error.response) {
                                    if (error.response.status == 401) {
                                        swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                        location.reload('0');
                                    }
                                }
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel)
                        {
                        }
                    })
            },
            //==============================================
            cerrarModal(){
                //this.accionmodal==1;
                this.modal = 0
                /*this.nombre = '',
                this.descripcion = '',
                this.tituloModal = '',*/
                this.error = 0,
                this.mensajeError = ''
            },
            abrirModal(modelo, accion, data){
                switch(modelo){
                    case 'parametro':
                    {
                        switch(accion){
                            case 'configurar':
                            {
                                this.accionmodal=2;
                                this.modal = 1;
                                this.formParametro.nidpar = data.nIdPar;
                                this.listarTipoParametro(1);
                                break;
                            }
                        }
                    }
                }
            },
            abrirFormulario(modelo, accion, data){
                switch(modelo){
                    case 'parametro':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                if(this.validarBusqueda()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVO PARAMETRO';
                                this.limpiarFormulario();
                                this.formParametro.nidgrupopar = this.fillParametro.nidgrupopar;
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.limpiarFormulario();
                                this.formParametro.nidpar = data.nIdPar;
                                this.formParametro.nidgrupopar = data.nIdGrupoPar;
                                this.formParametro.cparjerarquia = data.cParJerarquia;
                                this.formParametro.cparnombre = data.cParNombre;
                                this.formParametro.cparabreviatura = data.cParAbreviatura;
                                this.tituloFormulario = 'ACTUALIZAR PARAMETRO';
                                break;
                            }
                        }
                    }
                }
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
            limpiarFormulario(){
                this.formParametro.nidpar = 0,
                this.formParametro.nidgrupopar = '',
                this.formParametro.cparjerarquia = '',
                this.formParametro.cparnombre = '',
                this.formParametro.cparabreviatura = ''
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
