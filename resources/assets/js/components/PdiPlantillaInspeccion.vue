<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">PLANTILLA DE INSPECCIÓN</h2>
          </div>
        </header>

        <template v-if="vistaFormulario">
            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">BUSCAR</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Empresa</label>
                                                <div class="col-sm-8">
                                                    <input v-model="cempresa" class="form-control form-control-sm" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Tipo Inspección</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="formPlantilla.nidtipoinspeccion" filterable placeholder="Select" >
                                                        <el-option
                                                        v-for="item in arrayTipoInspeccion"
                                                        :key="item.nIdTipoInspeccion"
                                                        :label="item.cNombreTipoInspeccion"
                                                        :value="item.nIdTipoInspeccion">
                                                        </el-option>
                                                    </el-select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Sección</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="formPlantilla.nidseccion" filterable placeholder="Select" >
                                                        <el-option
                                                        v-for="item in arraySeccion"
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
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarPlantilla()"><i class="fa fa-search"></i> Buscar</button>
                                            <!--<button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('plantila','registrar')"><i class="fa fa-file-o"></i> Nuevo</button>-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">LISTADO ITEMS</h3>
                            </div>
                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Área</label>
                                                <div class="col-sm-8">
                                                    <el-select v-model="formPlantilla.nidflag" filterable placeholder="Select" >
                                                        <el-option
                                                        v-for="item in arrayFlag"
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
                                                <label class="col-sm-4 form-control-label">Agregar Item</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="text" v-model="formPlantilla.citemnombre" disabled="disabled" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Buscar Item" class="btn btn-info btn-corner btn-sm" @click="abrirModal('item','buscar')">
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
                                <template v-if="arrayPlantilla.length">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Tipo Inspección</th>
                                                    <th>Sección</th>
                                                    <th>Área</th>
                                                    <th>Item Nombre</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="plantilla in arrayPlantilla" :key="plantilla.nIdPlantillaInspeccionSeccionItem">
                                                    <td v-text="plantilla.nIdPlantillaInspeccionSeccionItem"></td>
                                                    <td v-text="plantilla.cNombreTipoInspeccion"></td>
                                                    <td v-text="plantilla.cFlagInteriorExterior"></td>
                                                    <td v-text="plantilla.cSeccionNombre"></td>
                                                    <td v-text="plantilla.cItemNombre"></td>
                                                    <td>
                                                        <!--<el-tooltip class="item" effect="dark" placement="top-start">
                                                             <div slot="content">Editar {{ plantilla.cNombreTipoInspeccion }}</div>
                                                             <i @click="abrirFormulario('plantilla','actualizar', plantilla)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                        </el-tooltip>&nbsp;-->
                                                        <template v-if="plantilla.cSituacionRegistro=='A'">
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Desactivar {{ plantilla.cNombreTipoInspeccion }}</div>
                                                                <i @click="desactivar(plantilla.nIdTipoInspeccion)" :style="'color:#796AEE'" class="fa-md fa fa-check-square"></i>
                                                            </el-tooltip>
                                                        </template>
                                                        <template v-else>
                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                <div slot="content">Activar {{ plantilla.cNombreTipoInspeccion }}</div>
                                                                <i @click="activar(plantilla.nIdTipoInspeccion)" :style="'color:red'" class="fa-md fa fa-square"></i>
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

        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form v-on:submit.prevent class="form-horizontal">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">LISTA ITEM</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <label class="col-sm-4 form-control-label">Nombre</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" v-model="fillItem.citemnombre" @keyup.enter="listarItems(1)" class="form-control form-control-sm">
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar Items" class="btn btn-info btn-corner btn-sm" @click="listarItems(1)">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        <template v-if="arrayItem.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Seleccione</th>
                                                            <th>Nombre Proveedor</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in arrayItem" :key="item.nIdPar">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" placement="top-start">
                                                                    <div slot="content">Seleccionar {{ item.cParNombre }}</div>
                                                                    <i @click="asignarItem(item.nIdPar, item.cParNombre)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>
                                                            </td>
                                                            <td v-text="item.cParNombre"></td>
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
                                                                    <a @click.prevent="cambiarPaginaItem(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaItem(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaItem(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                cempresa: 'SAISAC',
                fillTipoInsp:{
                    cnombre: ''
                },
                formPlantilla:{
                    nidtipoinspeccion: 0,
                    nidflag: 0,
                    nidseccion: 0,
                    niditem: 0,
                    citemnombre: ''
                },
                arrayTipoInspeccion: [],
                arrayFlag: [],
                arraySeccion: [],
                arrayPlantilla: [],
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                fillItem:{
                    niditem: 0,
                    citemnombre: ''
                },
                arrayItem: [],
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
         mounted(){
            this.llenarComboTipoInspeccion();
            this.llenarFlag();
            this.llenarComboSeccion();
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
            llenarComboTipoInspeccion(){
                var url = this.ruta + '/tipoinspeccion/GetFillTipoInspeccion';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'cnombre': '',
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayTipoInspeccion = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarFlag(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110080,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arrayFlag = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboSeccion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110081,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arraySeccion = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            //================= BUSQUEDA PLANTILLA =======================
            buscarPlantilla(){
                if(this.validarBusqueda()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.listarItemPlantilla(1);
            },
            listarItemPlantilla(page){
                this.mostrarProgressBar();
                var url = this.ruta + '/plantilla/GetListItems';
                axios.get(url, {
                    params: {
                        'nidempresa' : 1300011,
                        'nidtipoinspeccion' : this.formPlantilla.nidtipoinspeccion,
                        'nidseccion': this.formPlantilla.nidseccion,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayPlantilla = response.data.arrayPlantilla.data;
                    this.paginationModal.current_page =  response.data.arrayPlantilla.current_page;
                    this.paginationModal.total = response.data.arrayPlantilla.total;
                    this.paginationModal.per_page    = response.data.arrayPlantilla.per_page;
                    this.paginationModal.last_page   = response.data.arrayPlantilla.last_page;
                    this.paginationModal.from        = response.data.arrayPlantilla.from;
                    this.paginationModal.to           = response.data.arrayPlantilla.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarBusqueda(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formPlantilla.nIdTipoInspeccion == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Inspección');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarTipoInspeccion(page);
            },
            //================= REGISTRO =======================
            asignarItem(nItemId, cItemNombre){
                var url = this.ruta + '/plantilla/SetItemPlantilla';

                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdTipoInspeccion: this.formPlantilla.nidtipoinspeccion,
                    nIdFlag: this.formPlantilla.nidflag,
                    nIdSeccion: this.formPlantilla.nidseccion,
                    nIdItem: nItemId
                }).then(response => {
                    if(response.data[0].nFlagMsje == 1)
                    {
                        swal('Item Agregado registrada');
                        this.vistaFormulario = 1;
                        this.listarItemPlantilla();
                    }
                    else{
                        swal('Ya existe Item');
                    }
                }).catch(error => {
                    console.log(error);
                });
            },
            //================= LISTADO ITEMS =======================
            listarItems(page){
                var url = this.ruta + '/parametro/GetListParametroByGrupo';

                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110082,
                        'opcion' : 1,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayItem = response.data.arrayParametro.data;
                    this.paginationModal.current_page =  response.data.arrayParametro.current_page;
                    this.paginationModal.total = response.data.arrayParametro.total;
                    this.paginationModal.per_page    = response.data.arrayParametro.per_page;
                    this.paginationModal.last_page   = response.data.arrayParametro.last_page;
                    this.paginationModal.from        = response.data.arrayParametro.from;
                    this.paginationModal.to           = response.data.arrayParametro.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaItem(page){
                this.paginationModal.current_page=page;
                this.listarItems(page);
            },
            registrar(){
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formPlantilla.nIdTipoInspeccion == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Inspección');
                };
                if(this.formPlantilla.nidseccion == 0){
                    this.mensajeError.push('Debes Seleccionar Sección');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activar(nIdTipoInspeccion){
                swal({
                    title: 'Estas seguro de activar este inspeccion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/tipoinspeccion/activar';
                        axios.put(url , {
                            nIdTipoInspeccion: nIdTipoInspeccion
                        }).then(response => {
                            swal(
                            'Activado!',
                            'El registro fue activado.'
                            );
                            this.listarTipoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            desactivar(nIdTipoInspeccion){
                swal({
                    title: 'Estas seguro de desactivar este inspeccion?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                }).then((result) => {
                    if (result.value) {
                        var url = this.ruta + '/tipoinspeccion/desactivar';
                        axios.put(url , {
                            nIdTipoInspeccion: nIdTipoInspeccion
                        }).then(response => {
                            swal(
                            'Desactivado!',
                            'El registro fue desactivado.'
                            );
                            this.listarTipoInspeccion(1);
                            this.vistaFormulario = 1;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                    } else if (result.dismiss === swal.DismissReason.cancel){}
                })
            },
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'plantila':
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 1;
                                this.tituloFormulario = 'NUEVA PLANTILLA DE INSPECCIÓN';
                                this.limpiarFormulario();
                                break;
                            }
                            case 'actualizar':
                            {
                                this.vistaFormulario = 0;
                                this.accion = 2;
                                this.tituloFormulario = 'ACTUALIZAR TIPO DE INSPECCIÓN';
                                this.formPlantilla.nidtipoinspeccion = data['nIdTipoInspeccion'];
                                this.formPlantilla.cnombre = data['cNombreTipoInspeccion'];
                                this.formPlantilla.nflagalmacen = (data['nFlagAlmacen'] == 1 ? true : false);
                                this.formPlantilla.nflagaccesorio = (data['nFlagAccesorio'] == 1 ? true : false);
                                this.formPlantilla.nflagtestdrive = (data['nFlagTestDrive'] == 1 ? true : false);
                                this.formPlantilla.nFlagSeccion = (data['nFlagSeccionInspeccion'] == 1 ? true : false);
                                this.formPlantilla.nflagfichatecnica = (data['nFlagValidarFichaTecnica'] == 1 ? true : false);
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
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case 'item':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validar()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=3;
                                this.modal = 1;
                                this.listarItems(1);
                                break;
                            }
                        }
                    }
                }
            },
            limpiarFormulario(){
                this.formPlantilla.nidtipoinspeccion= 0,
                this.formPlantilla.cnombre= '',
                this.formPlantilla.nflagalmacen=  0,
                this.formPlantilla.nflagaccesorio= 0,
                this.formPlantilla.nflagtestdrive= 0,
                this.formPlantilla.nflagseccion= 0,
                this.formPlantilla.nflagfichatecnica= 0
            },
            cambiarVistaFormulario(){
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
