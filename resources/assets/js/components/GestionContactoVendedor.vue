<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">GESTIÓN DE CONTACTOS VENDEDOR</h2>
          </div>
        </header>
        
        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#TabMisContactos" @click="tabMisContactos();" role="tab" data-toggle="tab">
                                        <i class="fa fa-users"></i> MIS CONTACTOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabCarteraMes" @click="tabCarteraMes();" role="tab" data-toggle="tab">
                                        <i class="fa fa-suitcase"></i> CARTERA DEL MES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabSeguimiento" @click="tabSeguimiento();" role="tab" data-toggle="tab">
                                        <i class="fa fa-angle-double-right"></i> SEGUIMIENTO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabNuevoContacto" @click="tabNuevoContacto();" role="tab" data-toggle="tab">
                                        <i class="fa fa-user"></i> NUEVO CONTACTO
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="TabMisContactos">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">BUSCAR CONTACTOS</h3>
                                                    </div>
                                                    <div class="card-body"> 
                                                        <form class="form-horizontal">
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                        <div class="col-sm-8">
                                                                            <label class="checkbox-inline" v-for="tipo in lstTipoPersona" :key="tipo.id">
                                                                                <input type="radio" class="radio-template" v-model="formNuevoContacto.ntipopersona" v-bind:value="tipo.value" v-on:change="cambiarTipoPersona()">
                                                                                <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="csucursal" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Apellidos</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="csucursal" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">        
                                                                <div class="col-sm-9 offset-sm-5">
                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarEventoCampania();"><i class="fa fa-search"></i> Buscar</button>
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
                                                        <!--<template v-if="arrayEventoCampania.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Código</th>
                                                                            <th>Proveedor</th>
                                                                            <th>Tipo Evento</th>
                                                                            <th>Nombre Campaña</th>
                                                                            <th>Fecha Inicio.</th>
                                                                            <th>Fecha Fin</th>
                                                                            <th>Presupuesto</th>
                                                                            <th>Nivel Detalle</th>
                                                                            <th>Acciones</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="ec in arrayEventoCampania" :key="ec.nIdEventoCampania">                                                                        
                                                                            <td>{{ ec.nIdEventoCampania }}</td>
                                                                            <td>{{ ec.cNombreProveedor }}</td>
                                                                            <td>{{ ec.cTipoEvento }}</td>
                                                                            <td>{{ ec.cNombreEventoCampania }}</td>
                                                                            <td>{{ ec.dFechaInicio }}</td>
                                                                            <td>{{ ec.dFechaFin }}</td>
                                                                            <td>{{ ec.fValorPresupuesto }}</td>
                                                                            <td>{{ ec.cFlagDetalleEvento }}</td>
                                                                            <td>
                                                                                <template v-if="ec.cEventoCampaniaEstado=='A'">
                                                                                    <a href="#" @click="desactivar(ec.nIdEventoCampania)" data-toggle="tooltip" data-placement="top" 
                                                                                    v-bind:title="'Desactivar ' +ec.nIdEventoCampania">
                                                                                        <i class="fa-md fa fa-check-square"></i>
                                                                                    </a>
                                                                                </template>
                                                                                <template v-else>
                                                                                    <a href="#" @click="activar(ec.nIdEventoCampania)" data-toggle="tooltip" data-placement="top" 
                                                                                    v-bind:title="'Activar ' +ec.nIdEventoCampania">
                                                                                        <i v-bind:style="'color:red'" class="fa-md fa fa-square"></i>
                                                                                    </a>
                                                                                </template>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
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
                                                        </template>
                                                        <template v-else>
                                                            <table>
                                                                <tbody>
                                                                    <tr>
                                                                        <td colspan="10">No existen registros!</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </template>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabNuevoContacto">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="Tab11" href="#TabDatosPersonales" @click="tabDatosPersonales();" role="tab" data-toggle="tab">
                                                            <i class="fa fa-id-badge"></i> DATOS PERSONALES
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab22" href="#TabDatosContacto" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-map-marker"></i> DATOS DE CONTACTO
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab33" href="#TabReferenciaVehiculo" role="tab" data-toggle="tab">
                                                            <i class="fa fa-car"></i> REFERENCIA VEHICULO
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="TabDatosPersonales">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                                                    <div class="col-sm-8">
                                                                                        <label class="checkbox-inline" v-for="tipo in lstTipoPersona" :key="tipo.id">
                                                                                            <input type="radio" class="radio-template" v-model="formNuevoContacto.ntipopersona" v-bind:value="tipo.value" v-on:change="cambiarTipoPersona()">
                                                                                            <label for="" class="form-control-label" v-text="tipo.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Tipo Documento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.ntpodocumento" class="form-control form-control-sm">
                                                                                            <option v-for="item in arrayTipoDocumento" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="number" v-model="formNuevoContacto.cnrodocumento" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <template v-if="vistaDatosPersonaNatural">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Apellido Paterno</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.capepaterno" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Apellido Materno</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.capematerno" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label v-text="formNuevoContacto.lblcnombres" class="col-sm-4 form-control-label"></label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cnombres" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Fecha Nacimiento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="date" v-model="formNuevoContacto.dfecnacimiento" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">        
                                                                            <div class="col-sm-9 offset-sm-4">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab22();">
                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabDatosContacto">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Departamento</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.niddepartamento" class="form-control form-control-sm" v-on:change="llenarComboProv()">
                                                                                            <option v-for="dpto in listDptos" :key="dpto.id" :value="dpto.id" v-text="dpto.text">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Provincia</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.nidprovincia" class="form-control form-control-sm" v-on:change="llenarComboDist">
                                                                                            <option v-for="prov in listProv" :key="prov.id" :value="prov.id" v-text="prov.text">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Distrito</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select v-model="formNuevoContacto.niddistrito" class="form-control form-control-sm">
                                                                                            <option v-for="dist in listDist" :key="dist.id" :value="dist.id" v-text="dist.text">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cdireccion" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Email</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cmailprincipal" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Email Alternativo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.cmailalternativo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Telefono Fijo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ctelefonofijo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Celular</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ncelular" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Celular Alternativo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <input type="text" v-model="formNuevoContacto.ncelularalternativo" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <template v-if="vistaDatosPersonaNatural">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Estado Civil</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select v-model="formNuevoContacto.nestadocivil" class="form-control form-control-sm">
                                                                                                <option v-for="item in arrayEstadoCivil" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </template>
                                                                        </div>
                                                                        <template v-if="vistaDatosPersonaNatural">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Profesión</label>
                                                                                        <div class="col-sm-8">
                                                                                            <select v-model="formNuevoContacto.nprofesion" class="form-control form-control-sm">
                                                                                                <option v-for="item in arrayProfesion" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                                </option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Centro Laboral</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="formNuevoContacto.ccentrolaboral" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <div class="form-group row">        
                                                                            <div class="col-sm-9 offset-sm-4">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab33();">
                                                                                    <i class="fa fa-arrow-right"></i> Siguiente
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabReferenciaVehiculo">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <form class="form-horizontal"> 
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                    <div class="col-sm-8">
                                                                                        <div class="input-group">
                                                                                            <input type="hidden" v-model="formNuevoContacto.nidproveedor">
                                                                                            <input type="text" v-model="formNuevoContacto.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                                            <div class="input-group-prepend">
                                                                                                <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="abrirModal('proveedor','buscar')">
                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Linea Vehiculo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.nidlinea" class="form-control form-control-sm" v-on:change="llenarComboMarca();">
                                                                                            <option v-for="linea in arrayLinea" :key="linea.nIdPar" :value="linea.nIdPar"> {{ linea.cParNombre }}
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Marca</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.nidmarca" class="form-control form-control-sm" v-on:change="llenarComboModelo();">
                                                                                            <option v-for="marca in arrayMarca" :key="marca.nIdPar" :value="marca.nIdPar" v-text="marca.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">Modelo</label>
                                                                                    <div class="col-sm-8">
                                                                                        <select name="account" v-model="formNuevoContacto.nidmodelo" class="form-control form-control-sm">
                                                                                            <option v-for="modelo in arrayModelo" :key="modelo.nIdPar" :value="modelo.nIdPar" v-text="modelo.cParNombre">
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">        
                                                                            <div class="col-sm-9 offset-sm-5">
                                                                                <button type="button" class="btn btn-success btn-corner btn-sm" @click="asignarReferenciaVehiculo()">
                                                                                    <i class="fa fa-arrow-down"></i> Asignar
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">LISTADO</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <template v-if="arrayReferenciaVehiculo.length">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Proveedor</th>
                                                                                                <th>Línea</th>
                                                                                                <th>Marca</th>
                                                                                                <th>Modelo</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(referencia, index) in arrayReferenciaVehiculo" :key="referencia.nIdProveedor">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemReferenciaVehiculo(index)" data-toggle="tooltip" data-placement="top" 
                                                                                                        v-bind:title="'Eliminar Referencia'">
                                                                                                        <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i>
                                                                                                    </a>
                                                                                                </td>
                                                                                                <td>{{ referencia.cProveedorNombreRef }}</td>
                                                                                                <td>{{ referencia.cLineaNombreRef }}</td>
                                                                                                <td>{{ referencia.cMarcaNombreRef }}</td>
                                                                                                <td>{{ referencia.cModeloNombreRef }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>                                   
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="row">
                                                                                        <div class="col-lg-7">
                                                                                        </div>
                                                                                        <!--<div class="col-lg-5">
                                                                                            <div class="datatable-info">Mostrando {{ pagination.from }} a {{ pagination.to }} de {{ pagination.total }} registros</div>
                                                                                        </div>-->
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
                                                                <div class="form-group row">        
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarNuevoContacto()">
                                                                            <i class="fa fa-save"></i> Registrar
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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

        <div class="modal fade" v-if="accionmodal==2" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form>
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
                                                                    <input type="text" v-model="fillProveedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();"><i class="fa-lg fa fa-search"></i></button>
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
                                                                    <td>{{proveedor.cParNombre}}</td>
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
                cempresa: 'SAISAC',
                csucursal: 'CHICLAYO',
                canio: '2018',
                cmes: 'MAYO',
                nidempresa: 0,
                nidsucursal: 0,
                arrayTipoDocumento: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                arrayProveedor: [],
                arrayReferenciaVehiculo: [],
                listDptos:[],
                listProv : [],
                listDist: [],
                lstTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                formNuevoContacto:{
                    ntipopersona: 1,
                    ntpodocumento: 0,
                    cnrodocumento: '',
                    capepaterno: '',
                    capematerno: '',
                    cnombres: '',
                    dfecnacimiento: '',
                    lblcnombres: 'Nombres(*)',
                    niddepartamento: 0,
                    nidprovincia: 0,
                    niddistrito: 0,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    cdireccion: '',
                    cmailprincipal: '',
                    cmailalternativo: '',
                    ctelefonofijo: '',
                    ncelular: '',
                    ncelularalternativo: '',
                    nestadocivil: 0,
                    nprofesion: 0,
                    ccentrolaboral: '',
                    nidlinea: 0,
                    nidmarca: 0,
                    nidmodelo: 0
                },
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
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                vistaModal: 0,
                vistaDatosPersonaNatural: 1
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
        methods:{
            tabNuevoContacto(){
                this.cargarTabDatosPersonales();
            },            
            cambiarTipoPersona(){
                this.llenarComboTpoDocumento();
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    this.formNuevoContacto.lblcnombres = 'Nombres(*)',
                    this.vistaDatosPersonaNatural = 1
                }
                else
                {
                    this.formNuevoContacto.lblcnombres = 'Razón Social(*)',
                    this.vistaDatosPersonaNatural = 0
                }
            },
            cargarTabDatosPersonales(){
                this.llenarComboTpoDocumento();
                this.llenarComboDptos();
                this.llenarComboDptos();
                this.llenarComboProv();
                this.llenarComboDist();
                this.llenarComboEstadoCivil();
                this.llenarComboProfesion();
            },
            llenarComboTpoDocumento(){
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    var url = this.ruta + '/parametro/GetDocumentoNatural?ngrupoparid=' + 110047 
                                                                            + '&opcion=' + 0;
                    axios.get(url).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = 0;
                    }).catch(error => {
                        this.errors = error.response.data
                    });
                }
                else{
                    var url = this.ruta + '/parametro/GetDocumentoJuridica?ngrupoparid=' + 110047 
                                                                                + '&opcion=' + 0;
                    axios.get(url).then(response => {
                        this.arrayTipoDocumento = response.data;
                        this.formNuevoContacto.ntpodocumento = 0;
                    }).catch(error => {
                        this.errors = error.response.data
                    });
                }
            },
            llenarComboDptos(){
                var url = this.ruta + '/ubigeo/GetDptos';
                axios.get(url).then(response => {
                    this.listDptos = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboProv(){
                var url = this.ruta + '/ubigeo/GetProvinciasByDpto?niddepartamento=' + this.formNuevoContacto.niddepartamento;
                axios.get(url).then(response => {
                    this.listProv = response.data;
                    this.formNuevoContacto.nidprovincia = 0;
                    this.listDist = [];
                    this.llenarComboDist();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboDist(){
                var url = this.ruta + '/ubigeo/GetDistritosByProv?nidprovincia=' + this.formNuevoContacto.nidprovincia;
                axios.get(url).then(response => {
                    this.listDist = response.data;
                    this.formNuevoContacto.niddistrito = 0;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 130011 
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProveedor.cnombreproveedor.toString() 
                                                                    + '&opcion=' + 1
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total = response.data.arrayProveedor.total;
                    this.paginationModal.per_page    = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page   = response.data.arrayProveedor.last_page;
                    this.paginationModal.from        = response.data.arrayProveedor.from;
                    this.paginationModal.to           = response.data.arrayProveedor.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formNuevoContacto.nidproveedor = nProveedorId;
                this.formNuevoContacto.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
                this.arrayMarca = [];
                this.arrayModelo = [];
                this.llenarComboLinea();
            },
            llenarComboLinea(){
                this.nidempresa = 130011;

                var url = this.ruta + '/versionvehiculo/GetLineasByProveedor?nidempresa=' + this.nidempresa
                                                                    + '&nidproveedor=' + this.formNuevoContacto.nidproveedor;
                axios.get(url).then(response => {
                    this.arrayLinea = response.data;
                    this.formNuevoContacto.nidlinea = 0;
                    this.llenarComboMarca();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboMarca(){
                var url = this.ruta + '/versionvehiculo/GetMarcaByLinea?nidlinea=' + this.formNuevoContacto.nidlinea;

                axios.get(url).then(response => {
                    this.arrayMarca = response.data;
                    this.formNuevoContacto.nidmarca = 0;
                    this.arrayModelo = [];
                    this.llenarComboModelo();
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboModelo(){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca?nidmarca=' + this.formNuevoContacto.nidmarca;
                axios.get(url).then(response => {
                    this.arrayModelo = response.data;
                    this.formNuevoContacto.nidmodelo = 0;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboEstadoCivil(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110048 
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayEstadoCivil = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboProfesion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110049 
                                                                            + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayProfesion = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            asignarReferenciaVehiculo(){
                if(this.validaAsignarReferenciaVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var nidlinea = this.formNuevoContacto.nidlinea;
                var nidmarca = this.formNuevoContacto.nidmarca;
                var nidmodelo = this.formNuevoContacto.nidmodelo;
                var cLineaNombreRef = "";
                var cMarcaNombreRef = "";
                var cModeloNombreRef = "";

                $.each(this.arrayLinea, function (index, value) {
                    if(value.nIdPar == nidlinea){
                        cLineaNombreRef = value.cParNombre;
                    }
                });
                $.each(this.arrayMarca, function (index, value) {
                    if(value.nIdPar == nidmarca){
                        cMarcaNombreRef = value.cParNombre;
                    }
                });
                $.each(this.arrayModelo, function (index, value) {
                    if(value.nIdPar == nidmodelo){
                        cModeloNombreRef = value.cParNombre;
                    }
                });

                var nIdProveedorRef = this.formNuevoContacto.nidproveedor;
                var nIdLineaRef = this.formNuevoContacto.nidlinea;
                var nIdMarcaRef = this.formNuevoContacto.nidmarca;
                var nIdModeloRef = this.formNuevoContacto.nidmodelo;
                var cProveedorNombreRef = this.formNuevoContacto.cproveedornombre;

                if(this.encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef)){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Referencia Vehículo ya se encuentra agregada!',
                            })
                }
                else{
                    this.arrayReferenciaVehiculo.push({
                                nIdProveedorRef: nIdProveedorRef,
                                nIdLineaRef: nIdLineaRef,
                                nIdMarcaRef: nIdMarcaRef,
                                nIdModeloRef: nIdModeloRef,
                                cProveedorNombreRef: cProveedorNombreRef,
                                cLineaNombreRef: cLineaNombreRef,
                                cMarcaNombreRef: cMarcaNombreRef,
                                cModeloNombreRef: cModeloNombreRef
                    });
                    toastr.success('Se Agregó Referencia Vehiculo');
                }
            },
            encuentraReferenciaVehiculo(nIdProveedorRef, nIdLineaRef, nIdMarcaRef, nIdModeloRef){
                var sw=0;
                for(var i=0;i<this.arrayReferenciaVehiculo.length;i++){
                    if(this.arrayReferenciaVehiculo[i].nIdProveedorRef==nIdProveedorRef &&
                        this.arrayReferenciaVehiculo[i].nIdLineaRef==nIdLineaRef &&
                        this.arrayReferenciaVehiculo[i].nIdMarcaRef==nIdMarcaRef &&
                        this.arrayReferenciaVehiculo[i].nIdModeloRef==nIdModeloRef    ){
                        sw=true;
                    }
                }
                return sw;
            },
            validaAsignarReferenciaVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar Proveedor');
                };
                if(this.formNuevoContacto.nidlinea == 0){
                    this.mensajeError.push('Debes Seleccionar Linea');
                };
                if(this.formNuevoContacto.nidmarca == 0){
                    this.mensajeError.push('Debes Seleccionar Marca');
                };
                if(this.formNuevoContacto.nidmodelo == 0){
                    this.mensajeError.push('Debes Seleccionar Modelo');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemReferenciaVehiculo(index){
                this.$delete(this.arrayReferenciaVehiculo, index);
            },
            tabDatosPersonales(){
                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link disabled");
                $('#Tab33').removeClass('nav-link active');
                $('#Tab33').addClass("nav-link disabled");
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').removeClass('in active show');
            },
            activarTab22(){
                if(this.validarTab22()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab11').removeClass('nav-link active');
                $('#Tab11').addClass("nav-link");
                $('#Tab22').removeClass('nav-link disabled');
                $('#Tab22').addClass("nav-link active");
                $('#TabDatosPersonales').removeClass('in active show');
                $('#TabDatosContacto').addClass('in active show');
            },
            validarTab22(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.ntpodocumento == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Documento');
                };
                if(this.formNuevoContacto.ntipopersona == 1)
                {
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    };
                    if(!this.formNuevoContacto.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    };
                    if(!this.formNuevoContacto.cnombres){
                        this.mensajeError.push('Debes Ingresar Nombres');
                    };
                }
                
                if(this.formNuevoContacto.ntipopersona == 2){
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.cnombres){
                        this.mensajeError.push('Debes Ingresar Razon Social');
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            activarTab33(){
                if(this.validarTab33()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#Tab22').removeClass('nav-link active');
                $('#Tab22').addClass("nav-link");
                $('#Tab33').removeClass('nav-link disabled');
                $('#Tab33').addClass("nav-link active");
                $('#TabDatosContacto').removeClass('in active show');
                $('#TabReferenciaVehiculo').addClass('in active show');
            },
            validarTab33(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formNuevoContacto.niddepartamento == 0){
                    this.mensajeError.push('Debes Seleccionar Departamento');
                };
                if(this.formNuevoContacto.nidprovincia == 0){
                    this.mensajeError.push('Debes Seleccionar Provincia');
                };
                if(this.formNuevoContacto.niddistrito == 0){
                    this.mensajeError.push('Debes Seleccionar Distrito');
                };
                if(!this.formNuevoContacto.cdireccion){
                    this.mensajeError.push('Debes Ingresar Dirección');
                };
                if(!this.formNuevoContacto.cmailprincipal){
                    this.mensajeError.push('Debes Ingresar Email');
                };
                if(!this.formNuevoContacto.ncelular){
                    this.mensajeError.push('Debes Ingresar Celular');
                };
                /*if(this.formNuevoContacto.ntipopersona == 1)
                {
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    };
                    if(!this.formNuevoContacto.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    };
                    if(!this.formNuevoContacto.cnombres){
                        this.mensajeError.push('Debes Ingresar Nombres');
                    };
                }
                
                if(this.formNuevoContacto.ntipopersona == 2){
                    if(!this.formNuevoContacto.cnrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                    };
                    if(!this.formNuevoContacto.cnombres){
                        this.mensajeError.push('Debes Ingresar Razon Social');
                    };
                }*/

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            registrarNuevoContacto(){            
                var url = this.ruta + '/gescontacto/SetContactoPerNatural';
                axios.post(url, {
                    nIdTipoDocumento: this.formNuevoContacto.ntpodocumento,
                    cNumeroDocumento: String(this.formNuevoContacto.cnrodocumento),
                    cNombre: this.formNuevoContacto.cnombres,
                    cApellidoPaterno: this.formNuevoContacto.capepaterno,
                    cApellidoMaterno: this.formNuevoContacto.capematerno,
                    cUbigeo: this.formNuevoContacto.niddistrito,
                    cDireccion: this.formNuevoContacto.cdireccion,
                    cEmail: this.formNuevoContacto.cmailprincipal,
                    cEmailAlternativo: this.formNuevoContacto.cmailalternativo,
                    dFechaNacimiento: this.formNuevoContacto.dfecnacimiento,
                    nIdEstadoCivil: this.formNuevoContacto.nestadocivil,
                    cTelefonoFijo: this.formNuevoContacto.ctelefonofijo,
                    nTelefonoMovil: this.formNuevoContacto.ncelular,
                    nTelefonoMovilAlternativo: this.formNuevoContacto.ncelularalternativo,
                    cCentroLaboral: this.formNuevoContacto.ccentrolaboral,
                    nIdProfesion: this.formNuevoContacto.nprofesion,
                    nIdUsuario: 190011
                }).then(response => {
                    this.registrarReferenciaVehiculo(response.data[0].nIdContacto);
                    swal('Contacto registrado');
                    this.limpiarFormularioNuevoContacto();
                    this.tabDatosPersonales();
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistroContacto(){
            },
            registrarReferenciaVehiculo(nIdContacto){
                if(this.arrayReferenciaVehiculo.length > 0){
                    var url = this.ruta + '/gescontacto/SetContactoRefVehiculo';
                    axios.post(url, {
                        nIdContacto: nIdContacto,
                        data: this.arrayReferenciaVehiculo
                    }).then(response => {
                        this.limpiarFormularioNuevoContacto();
                        this.tabDatosPersonales();
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            tabCarteraMes(){},
            tabSeguimiento(){},
            cerrarModal(){
                this.modal = 0
                this.error = 0,
                this.mensajeError = ''
            },
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
            limpiarFormularioNuevoContacto()
            {
                this.arrayReferenciaVehiculo = [],
                this.cnrodocumento = '',
                this.capepaterno = '',
                this.capematerno = '',
                this.cnombres = '',
                this.dfecnacimiento = '',
                this.niddepartamento = 0,
                this.nidprovincia = 0,
                this.niddistrito = 0,
                this.cdireccion = '',
                this.cmailprincipal = '',
                this.cmailalternativo = '',
                this.ctelefonofijo = '',
                this.ncelular = '',
                this.ncelularalternativo = '',
                this.nestadocivil = 0,
                this.nestadocivil = 0,
                this.ccentrolaboral = ''
            },
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            }
        },
        mounted(){
            //this.tabBuscarEventoCampania();
        }
    }
</script>
<style>
       .mostrar{
            display: list-item !important;
            opacity: 1 !important;
            position: fixed !important;
            background-color: #3c29297a !important;
        }
        .modal-content{
            width: 100% !important;
            position: fixed !important;
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