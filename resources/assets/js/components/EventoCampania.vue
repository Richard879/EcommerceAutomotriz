<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">EVENTO CAMPAÑA</h2>
          </div>
        </header>
        
        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#TabBuscaEventoCampania" @click="tabBuscarEventoCampania();" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR EVENTO/CAMPAÑA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#TabNuevoEventoCamp" @click="tabNuevoEventoCampania();" role="tab" data-toggle="tab">
                                        <i class="fa fa-bullhorn"></i> NUEVO EVENTO/CAMAPAÑA
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active show" id="TabBuscaEventoCampania">
                                    <template v-if="vistaFormularioTabBuscar">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR EVENTO/CAMPAÑA</h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formEventoCamp.nidproveedor">
                                                                                    <input type="text" v-model="formEventoCamp.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                            <label class="col-sm-4 form-control-label">* Tipo Evento</label>
                                                                            <div class="col-sm-8">
                                                                                <select v-model="formEventoCamp.ntipo" class="form-control form-control-sm">
                                                                                    <option v-for="item in arrayTipoEC" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">        
                                                                    <div class="col-sm-9 offset-sm-4">
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
                                                            <template v-if="arrayEventoCampania.length">
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
                                                                                    <!--<a href="#" @click="activar(ec.nIdEventoCampania)" data-toggle="tooltip" data-placement="top" 
                                                                                        v-bind:title="'Asigna Distribución ' +ec.nIdEventoCampania">
                                                                                            <i class="fa-md fa fa-usd"></i>
                                                                                        </a>-->
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
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </template>
                                    
                                    <!--<template v-else>
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR WARRANT FINANCIERO</h3>
                                                        </div>
                                                        <div class="card-body"> 
                                                            <form class="form-horizontal">
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Estado</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="fillWFinancieroDetalle.nidwarrantfinanciero">
                                                                                    <select v-model="fillWFinancieroDetalle.nidestadowarrant" class="form-control form-control-sm">
                                                                                        <option v-for="item in arrayEstadoWarrant" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                        </option>
                                                                                    </select>
                                                                                    <span class="input-group-prepend">
                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="buscarWFinancieroDetalle();"><i class="fa-lg fa fa-search"></i></button>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
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
                                                            <template v-if="arrayWFinancieroDetalle.length">
                                                                <div class="table-responsive">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Código</th>
                                                                                <th>O/C</th>
                                                                                <th>Nombre Comercial</th>
                                                                                <th>Nro VIN</th>
                                                                                <th>Valor Warrant</th>
                                                                                <th>Estado</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="odetalle in arrayWFinancieroDetalle" :key="odetalle.nIdDetalleWarrant">                                                                        
                                                                                <td>{{ odetalle.nIdDetalleWarrant }}</td>
                                                                                <td>{{ odetalle.nOrdenCompra }}</td>
                                                                                <td>{{ odetalle.cNombreComercial }}</td>
                                                                                <td>{{ odetalle.cNumeroVin }}</td>
                                                                                <td>{{ odetalle.fValorWarrant }}</td>
                                                                                <td>{{ odetalle.cParNombre }}</td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <nav>
                                                                    <ul class="pagination">
                                                                        <li v-if="pagination.current_page > 1" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaDetalle(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                        </li>
                                                                        <li  class="page-item" v-for="page in pagesNumber" :key="page" 
                                                                        :class="[page==isActived?'active':'']">
                                                                            <a class="page-link" 
                                                                            href="#" @click.prevent="cambiarPaginaDetalle(page)" 
                                                                            v-text="page"></a>
                                                                        </li>                            
                                                                        <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                            <a @click.prevent="cambiarPaginaDetalle(pagination.current_page+1)" class="page-link" href="#">Sig</a>
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
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </template>-->
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabNuevoEventoCamp">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">NUEVO EVENTO/CAMPAÑA</h3>
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
                                                                        <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="formEventoCamp.dfechainicio" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Fecha Fin</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="date" v-model="formEventoCamp.dfechafin" class="form-control form-control-sm">
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
                                                                                <input type="hidden" v-model="formEventoCamp.nidproveedor">
                                                                                <input type="text" v-model="formEventoCamp.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                        <label class="col-sm-4 form-control-label">* Situación</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formEventoCamp.csituacion" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Tipo</label>
                                                                        <div class="col-sm-8">
                                                                            <select v-model="formEventoCamp.ntipo" class="form-control form-control-sm">
                                                                                <option v-for="item in arrayTipoEC" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Valor Presupuesto</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formEventoCamp.fvalorpresupuesto" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Descripción</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formEventoCamp.descripcion" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Documento</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="formEventoCamp.filedocumento" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <ul class="nav nav-tabs">
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="Tab1" href="#TabECAsignaDetalle" @click="desactivarTabs();" role="tab" data-toggle="tab">
                                                            <i class="fa fa-list"></i> ASIGNA DETALLE
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab2" href="#TabECAsignaElemento" role="tab" data-toggle="tab">
                                                            <i class="fa fa fa-sign-out"></i> ASIGNA ELEMENTO VENTA
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link disabled" id="Tab3" href="#TabECAsignaDistribucion" role="tab" data-toggle="tab">
                                                            <i class="fa fa-usd"></i> DISTRIBUCIÓN
                                                        </a>
                                                    </li>
                                                </ul>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active show" id="TabECAsignaDetalle">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">ASIGNAR DETALLE</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form class="form-horizontal">
                                                                                <div class="col-sm-12">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-3 form-control-label">* Detalle Evento Campaña</label>
                                                                                        <div class="col-sm-4">
                                                                                            <div class="input-group">
                                                                                                <input type="hidden" v-model="formEventoCamp.cflagdetalleevento">
                                                                                                <select v-model="formEventoCamp.ndetalle" class="form-control form-control-sm">
                                                                                                    <option v-for="item in arrayDetalleEC" :key="item.nIdGrupoPar" :value="item.nIdGrupoPar" v-text="item.cGrupoParNombre">
                                                                                                    </option>
                                                                                                </select>
                                                                                                <div class="input-group-prepend">
                                                                                                    <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="abrirModalAsignaDetalle('detalle','buscar')">
                                                                                                        <i class="fa-lg fa fa-search"></i>
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                            <br>
                                                                            <template v-if="arrayTemporalLinea.length">
                                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Código Proveedor</th>
                                                                                                <th>Nombre Proveedor</th>
                                                                                                <th>Código Línea</th>
                                                                                                <th>Nombre Línea</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(templinea, index)  in arrayTemporalLinea" :key="templinea.nIdLinea">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemLinea(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +templinea.cLineaNombre">
                                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                </td>
                                                                                                <td>{{ templinea.nIdProveedor }}</td>
                                                                                                <td>{{ templinea.cProveedorNombre }}</td>
                                                                                                <td>{{ templinea.nIdLinea }}</td>
                                                                                                <td>{{ templinea.cLineaNombre }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <br>
                                                                            </template>
                                                                            <template v-if="arrayTemporalMarca.length">
                                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Código Proveedor</th>
                                                                                                <th>Nombre Proveedor</th>
                                                                                                <th>Código Marca</th>
                                                                                                <th>Nombre Marca</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(tempmarca, index)  in arrayTemporalMarca" :key="tempmarca.nIdLinea">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemMarca(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +tempmarca.cMarcaNombre">
                                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                </td>
                                                                                                <td>{{ tempmarca.nIdProveedor }}</td>
                                                                                                <td>{{ tempmarca.cProveedorNombre }}</td>
                                                                                                <td>{{ tempmarca.nIdMarca }}</td>
                                                                                                <td>{{ tempmarca.cMarcaNombre }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <br>
                                                                            </template>
                                                                            <template v-if="arrayTemporalModelo.length">
                                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Código Proveedor</th>
                                                                                                <th>Nombre Proveedor</th>
                                                                                                <th>Código Modelo</th>
                                                                                                <th>Nombre Modelo</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(tempmodelo, index)  in arrayTemporalModelo" :key="tempmodelo.nIdModelo">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemModelo(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +tempmodelo.cModeloNombre">
                                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                </td>
                                                                                                <td>{{ tempmodelo.nIdProveedor }}</td>
                                                                                                <td>{{ tempmodelo.cProveedorNombre }}</td>
                                                                                                <td>{{ tempmodelo.nIdModelo }}</td>
                                                                                                <td>{{ tempmodelo.cModeloNombre }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <br>                                                                                
                                                                            </template>
                                                                            <div class="form-group row">        
                                                                                <div class="col-sm-9 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab2()">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabECAsignaElemento">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">ASIGNAR ELEMENTO VENTA</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form class="form-horizontal">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-6">
                                                                                        <div class="row">
                                                                                            <label class="col-sm-4 form-control-label">* ELEMENTO VENTA</label>
                                                                                            <div class="col-sm-8">
                                                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click="abrirModalAsignaElemento('elemento','buscar')">
                                                                                                    <i class="fa fa-search"></i> Buscar
                                                                                                </button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                            <br>
                                                                            <template v-if="arrayTemporalElemento.length">
                                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                                    <table class="table table-striped table-sm">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Acciones</th>
                                                                                                <th>Nombre Proveedor</th>
                                                                                                <th>Nombre Elemento</th>
                                                                                                <th>Valor Venta</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <tr v-for="(tempelemento, index)  in arrayTemporalElemento" :key="tempelemento.nIdElemento">
                                                                                                <td>
                                                                                                    <a href="#" @click="eliminarItemElemento(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +tempelemento.cElemenNombre">
                                                                                                    <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                </td>
                                                                                                <td>{{ tempelemento.cProveedorNombre }}</td>
                                                                                                <td>{{ tempelemento.cElemenNombre }}</td>
                                                                                                <td>{{ tempelemento.fElemenValorVenta }}</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                                <br>
                                                                            </template>
                                                                            <template v-else>
                                                                                <table>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td colspan="4">No existen registros!</td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </template>
                                                                            <div class="form-group row">        
                                                                                <div class="col-sm-9 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrar()">
                                                                                        <i class="fa fa-save"></i> REGISTRAR
                                                                                    </button>
                                                                                </div>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div role="tabpanel" class="tab-pane fade" id="TabECAsignaDistribucion">
                                                        <section class="forms">
                                                            <div class="container-fluid">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">ASIGNAR PRESUPUESTO COMPARTIDO</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <form class="form-horizontal">
                                                                                <div class="form-group row">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="hidden" v-model="formDistribucion.nideventocampania">
                                                                                        <label class="checkbox-inline" v-for="dist in lstTipoDistribucion" :key="dist.id">
                                                                                            <input type="radio" class="radio-template" v-model="formDistribucion.ntipodistribucion" v-bind:value="dist.value" v-on:change="cambiarVistaDistribucion()">
                                                                                            <label for="" class="form-control-label" v-text="dist.text"></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card">
                                                                        <div class="card-header">
                                                                            <h3 class="h4">DETALLE DISTRIBUCIÓN</h3>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <template v-if="vistaFormularioDistribucion">
                                                                                <form class="form-horizontal"> 
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="row">
                                                                                                <label class="col-sm-4 form-control-label">* Asignar Presupuesto</label>
                                                                                                <div class="col-sm-8">
                                                                                                    <div class="input-group">
                                                                                                        <select name="account" v-model="formDistribucion.ntipoproveedor" class="form-control form-control-sm" v-on:change="asignaEmpresaEC()">
                                                                                                            <option v-for="provdist in lstProveedorDitribucion" v-bind:value="provdist.value" v-bind:key="provdist.value">
                                                                                                                {{ provdist.text }}
                                                                                                            </option>
                                                                                                        </select>
                                                                                                        <div class="input-group-prepend">
                                                                                                            <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="buscarProveedorPorEC()">
                                                                                                                <i class="fa-sm fa fa-search"></i>
                                                                                                            </button>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                                <template v-if="arrayProveedorPorEC.length">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-striped table-sm">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>Acciones</th>
                                                                                                    <th>Código Prov.</th>
                                                                                                    <th>Proveedor</th>
                                                                                                    <th>% Distribución</th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody>
                                                                                                <tr v-for="(proveedor, index) in arrayProveedorPorEC" :key="proveedor.nIdEntidad">
                                                                                                    <td>
                                                                                                        <a href="#" @click="eliminarItemProveedorEC(index);" data-toggle="tooltip" data-placement="top" v-bind:title="'Eliminar ' +proveedor.cProveedorNombre">
                                                                                                        <i v-bind:style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                                    </td>
                                                                                                    <td>{{ proveedor.nIdEntidad }}</td>
                                                                                                    <td>{{ proveedor.cProveedorNombre }}</td>
                                                                                                    <td>
                                                                                                        <input type="number" v-model="arrayIndexEntidadValor[index]" class="form-control form-control-sm">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>                                    
                                                                                    </div>
                                                                                </template>
                                                                            </template>
                                                                            <template v-else>
                                                                                <form class="form-horizontal">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-sm-12">
                                                                                            <template v-if="arrayElementoDistribucion.length">
                                                                                                <div class="table-responsive">
                                                                                                    <table class="table table-striped table-sm">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th>Código</th>
                                                                                                                <th>Proveedor</th>
                                                                                                                <th>Tipo Elemento</th>
                                                                                                                <th>Nombre Elemento</th>
                                                                                                                <th>Precio de Venta</th>
                                                                                                                <th>Proveedor</th>
                                                                                                                <th>% Distribución</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <tr v-for="(eledist, index) in arrayElementoDistribucion" :key="eledist.nIdEventoElementoVenta">
                                                                                                                <td>{{ eledist.nIdEventoElementoVenta }}</td>
                                                                                                                <td>{{ eledist.cProveedorNombre }}</td>
                                                                                                                <td>{{ eledist.cTipoElemenNombre }}</td>
                                                                                                                <td>{{ eledist.cElemenNombre }}</td>
                                                                                                                <td>{{ eledist.fElemenValorVenta }}</td>
                                                                                                                <td>
                                                                                                                    <div class="input-group"> 
                                                                                                                        <input type="hidden" v-model="arrayIndexProvId[index]"> 
                                                                                                                        <input type="text" v-model="arrayIndexProvNombre[index]" class="form-control form-control-sm" readonly>
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="buscarProveedorPorElementoVenta(index)">
                                                                                                                                <i class="fa-sm fa fa-search"></i>
                                                                                                                            </button>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </td>
                                                                                                                <td>
                                                                                                                    <input type="number" v-model="arrayIndexProvValor[index]" class="form-control form-control-sm">
                                                                                                                </td>
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
                                                                                </form>
                                                                            </template>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">        
                                                                        <div class="col-sm-9 offset-sm-5">
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarAsignaDistribucion()">
                                                                                <i class="fa fa-save"></i> REGISTRAR
                                                                            </button>
                                                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cancelar()">
                                                                                <i class="fa fa-close"></i> CANCELAR
                                                                            </button>
                                                                        </div>
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
                                                                    <input type="text" v-model="fillProvedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
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

        <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="container-fluid">
                                <template v-if="vistaModal==0">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTADO LINEAS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre Linea</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="fillModal.clineanombre" @keyup.enter="buscarLineasByProveedor()" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Líneas" class="btn btn-info btn-corner btn-sm" @click="buscarLineasByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <template v-if="arrayLinea.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccione</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Linea</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="linea in arrayLinea" :key="linea.nIdLinea">
                                                                        <td>
                                                                            <a href="#" @click="asignarLineas(linea)">
                                                                                <i class='fa-md fa fa-check-circle'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>{{linea.cProveedorNombre}}</td>
                                                                        <td>{{linea.cLineaNombre}}</td>
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
                                                                                <a @click.prevent="cambiarPaginaLineasByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page" 
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link" 
                                                                                href="#" @click.prevent="cambiarPaginaLineasByProveedor(page)" 
                                                                                v-text="page"></a>
                                                                            </li>                            
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaLineasByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </template>
                                <template v-if="vistaModal==1">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTADO MARCAS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre Marca</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="fillModal.cmarcanombre" @keyup.enter="buscarMarcasByProveedor()" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Marcas" class="btn btn-info btn-corner btn-sm" @click="buscarMarcasByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <template v-if="arrayMarca.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccione</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Marca</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="marca in arrayMarca" :key="marca.nIdMarca">
                                                                        <td>
                                                                            <a href="#" @click="asignarMarcas(marca)">
                                                                                <i class='fa-md fa fa-check-circle'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>{{marca.cProveedorNombre}}</td>
                                                                        <td>{{marca.cMarcaNombre}}</td>
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
                                                                                <a @click.prevent="cambiarPaginaMarcasByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page" 
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link" 
                                                                                href="#" @click.prevent="cambiarPaginaMarcasByProveedor(page)" 
                                                                                v-text="page"></a>
                                                                            </li>                            
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaMarcasByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </template>
                                <template v-if="vistaModal==2">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTADO MODELOS</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <label class="col-sm-4 form-control-label">Nombre Modelo</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <input type="text" v-model="fillModal.cmodelonombre" @keyup.enter="buscarModelosByProveedor()" class="form-control form-control-sm">
                                                                        <div class="input-group-prepend">
                                                                            <button type="button" title="Buscar Marcas" class="btn btn-info btn-corner btn-sm" @click="buscarModelosByProveedor();"><i class="fa-lg fa fa-search"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="col-lg-12">
                                                    <template v-if="arrayModelo.length">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Seleccione</th>
                                                                        <th>Proveedor</th>
                                                                        <th>Modelo</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="modelo in arrayModelo" :key="modelo.nIdModelo">
                                                                        <td>
                                                                            <a href="#" @click="asignarModelos(modelo)">
                                                                                <i class='fa-md fa fa-check-circle'></i>
                                                                            </a>
                                                                        </td>
                                                                        <td>{{modelo.cProveedorNombre}}</td>
                                                                        <td>{{modelo.cModeloNombre}}</td>
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
                                                                                <a @click.prevent="cambiarPaginaModelosByProveedor(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                            </li>
                                                                            <li  class="page-item" v-for="page in pagesNumberModal" :key="page" 
                                                                            :class="[page==isActivedModal?'active':'']">
                                                                                <a class="page-link" 
                                                                                href="#" @click.prevent="cambiarPaginaModelosByProveedor(page)" 
                                                                                v-text="page"></a>
                                                                            </li>                            
                                                                            <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                                <a @click.prevent="cambiarPaginaModelosByProveedor(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                                </template>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> 

        <div class="modal fade" v-if="accionmodal==4" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="container-fluid">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="h4">BUSCAR ELEMENTO VENTA</h3>
                                        </div>
                                        <div class="card-body"> 
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label class="col-sm-2 form-control-label">Tipo Elemento</label>
                                                    <div class="col-sm-4">
                                                        <div class="input-group">
                                                            <select v-model="formEle.ntpoelemen" class="form-control form-control-sm">
                                                                <option v-for="item in arrayTipoElemento" :key="item.nIdPar" :value="item.nIdPar" v-text="item.cParNombre">
                                                                </option>
                                                            </select>
                                                            <div class="input-group-prepend">
                                                                <button type="button" title="Buscar" class="btn btn-info btn-corner btn-sm" @click="buscarElemento()">
                                                                    <i class="fa-lg fa fa-search"></i>
                                                                </button>
                                                            </div>
                                                        </div>
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
                                            <template v-if="arrayElementoVenta.length">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Código</th>
                                                                <th>Proveedor</th>
                                                                <th>Tipo Elemento</th>
                                                                <th>Nombre Elemento</th>
                                                                <th>Precio de Venta</th>
                                                                <th>Precio de Venta Mínimo</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="elemento in arrayElementoVenta" :key="elemento.nIdElemento">
                                                                <td>
                                                                    <a href="#" @click="asignarElemento(elemento)" data-toggle="tooltip" data-placement="top" 
                                                                        v-bind:title="'Asignar ' +elemento.cElemenNombre">
                                                                        <i class="fa-md fa fa-check-circle"></i>
                                                                    </a>
                                                                </td>
                                                                <td>{{ elemento.nIdElemento }}</td>
                                                                <td>{{ elemento.cProveedorNombre }}</td>
                                                                <td>{{ elemento.cTipoElemenNombre }}</td>
                                                                <td>{{ elemento.cElemenNombre }}</td>
                                                                <td>{{ elemento.fElemenValorVenta }}</td>
                                                                <td>{{ elemento.fElemenValorMinimoVenta }}</td>
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
                                                                        <a @click.prevent="cambiarPaginaElemento(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                    </li>
                                                                    <li  class="page-item" v-for="page in pagesNumber" :key="page" 
                                                                    :class="[page==isActived?'active':'']">
                                                                        <a class="page-link" 
                                                                        href="#" @click.prevent="cambiarPaginaElemento(page)" 
                                                                        v-text="page"></a>
                                                                    </li>                            
                                                                    <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                        <a @click.prevent="cambiarPaginaElemento(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> 

        <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                                    <input type="hidden" v-model="formDistribucion.nindex">
                                                                    <input type="text" v-model="fillProvedor.cnombreproveedor" @keyup.enter="buscaProveedores()" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Proveedores" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();">
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
                                                                        <a href="#" @click="asignarProveedorPorElementoVenta(proveedor.nIdPar, proveedor.cParNombre);">
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

        <div class="modal fade" v-if="accionmodal==6" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
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
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Proveedores" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores();">
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
                                                                        <a href="#" @click="asignarProveedorPorEC(proveedor);">
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
                arrayEventoCampania: [],
                arrayTipoEC: [],
                arrayDetalleEC: [],
                arrayProveedor: [],
                arrayLinea: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayTemporalLinea: [],
                arrayTemporalMarca: [],
                arrayTemporalModelo: [],
                arrayTipoElemento: [],
                arrayElementoVenta: [],
                arrayTemporalElemento: [],
                arrayElementoDistribucion: [],
                arrayProveedorPorEC: [],
                arrayIndexProvNombre: [],
                arrayIndexProvId: [],
                arrayIndexProvValor: [],
                arrayIndexEntidadValor: [],
                arrayElementoDistribucionEnvia: [],
                lstTipoDistribucion: [
                    { value: '1', text: 'POR EVENTO CAMPAÑA'},
                    { value: '2', text: 'POR ELEMENTO VENTA'}
                ],
                lstProveedorDitribucion:[
                    { value: '0', text: 'SELECCIONE'},
                    { value: '1', text: 'PROVEEDOR'},
                    { value: '2', text: 'EMPRESA'}
                ],
                arrayRegistraDetalle:[],
                fillModal:{
                    clineanombre: '',
                    cmarcanombre: '',
                    cmodelonombre: ''
                },
                fillProvedor:{
                    cnombreproveedor: ''
                },
                formEle:{
                    cempresa: 'SAISAC',
                    csucursal: 'CHICLAYO',
                    nidempresa : '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    ntpoelemen: 0,
                    nidmoneda: 0,
                    nidelemento: 0,
                    celenombre: '',
                    celecodigoerp: '',
                    felevalorventa: '',
                    felevarlorminventa: ''
                },
                fillEventoCamp:{
                    nideventocampania: 0,
                    ntipodistribucion: 1,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nindex: 0,
                    ntipoproveedor: 0,
                    fValorPorcentual: 0,
                    nentidad: 0
                },
                formEventoCamp:{
                    nidempresa: 0,
                    dfechainicio: '',
                    dfechafin: '',
                    nidproveedor: 0,
                    cproveedornombre: '',
                    csituacion: 'ACTIVA',
                    ntipo: 0,
                    fvalorpresupuesto: '',
                    descripcion:'',
                    filedocumento:'',
                    ndetalle: 0,
                    cflagdetalleevento: 'CA'               
                },
                formDistribucion:{
                    nideventocampania: 0,
                    ntipodistribucion: 1,
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nindex: 0,
                    ntipoproveedor: 0,
                    fValorPorcentual: 0,
                    nentidad: 0
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
                vistaFormularioTabBuscar: 0,
                vistaFormularioDistribucion: 0 
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
            llenarComboTipoEC(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110045 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoEC = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboDetalleEC(){
                var url = this.ruta + '/grupopar/GetGrupoParametroEventoCampania?opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayDetalleEC = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            llenarComboTpoElemento(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110027 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoElemento = response.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 1300011 
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProvedor.cnombreproveedor.toString() 
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
                this.formEventoCamp.nidproveedor = nProveedorId;
                this.formEventoCamp.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
            },
            tabBuscarEventoCampania(){
                this.vistaFormularioTabBuscar = 1;
                this.llenarComboTipoEC();
            },
            buscarEventoCampania(){
                this.vistaFormularioTabBuscar = 1;
                this.listarEventoCampania(1);
            },
            listarEventoCampania(page){
                this.nidempresa = 1300011;
                this.nidsucursal = 1300013;

                var url = this.ruta + '/ec/GetEventoCampania?nidempresa=' + this.nidempresa
                                                                + '&nidsucursal=' + this.nidsucursal
                                                                + '&nidproveedor=' + this.formEventoCamp.nidproveedor
                                                                + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayEventoCampania = response.data.arrayEventoCampania.data;
                    this.pagination.current_page =  response.data.arrayEventoCampania.current_page;
                    this.pagination.total = response.data.arrayEventoCampania.total;
                    this.pagination.per_page    = response.data.arrayEventoCampania.per_page;
                    this.pagination.last_page   = response.data.arrayEventoCampania.last_page;
                    this.pagination.from        = response.data.arrayEventoCampania.from;
                    this.pagination.to           = response.data.arrayEventoCampania.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarWFinancieros(page);
            },
            activar(nIdEventoCampania){
                swal({
                    title: 'Estas seguro de activar este Evento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/ec/activar';
                            axios.put(url , {
                                nIdEventoCampania: nIdEventoCampania
                            }).then(response => {                            
                                swal(
                                'Activado!',
                                'El registro fue activado.'
                                );
                                this.listarEventoCampania(1);
                                this.vistaFormularioTabBuscar = 1;                      
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) 
                        {
                        }
                    })
            },
            desactivar(nIdEventoCampania){
                
                swal({
                    title: 'Estas seguro de desactivar este Evento?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/ec/desactivar';
                            axios.put(url , {
                                nIdEventoCampania: nIdEventoCampania
                            }).then(response => {                            
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarEventoCampania(1);
                                this.vistaFormularioTabBuscar = 1;                  
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) 
                        {
                        }
                    })
            },
            cerrarModal(){
                this.modal = 0,
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
            tabNuevoEventoCampania(){
                this.limpiarFormulario();
                this.llenarComboTipoEC();
                this.cargarTabAsignaDetalle();
                this.cargarTabAsignaElemento();
            },
            cargarTabAsignaDetalle(){
                this.llenarComboDetalleEC();
            },
            abrirModalAsignaDetalle(modelo, accion, data =[]){
                switch(modelo){
                    case 'detalle':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validaAsignaDetalle()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                if(this.formEventoCamp.ndetalle == 110031){
                                    this.formEventoCamp.cflagdetalleevento = "LI";
                                    this.vistaModal = 0;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarLineasByProveedor();
                                }

                                if(this.formEventoCamp.ndetalle == 110032){
                                    this.formEventoCamp.cflagdetalleevento = "MA";
                                    this.vistaModal = 1;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarMarcasByProveedor();
                                }

                                if(this.formEventoCamp.ndetalle == 110033){
                                    this.formEventoCamp.cflagdetalleevento = "MO";
                                    this.vistaModal = 2;
                                    this.accionmodal=3;
                                    this.modal = 1;
                                    this.buscarModelosByProveedor();
                                }


                                break;
                            }
                        }
                    }
                }
            },
            validaAsignaDetalle(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formEventoCamp.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Proveedor');
                };
                if(this.formEventoCamp.ndetalle == 0){
                    this.mensajeError.push('Debes Seleccionar Detalle Evento Campaña');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarLineasByProveedor(){
                this.listarLineasByProveedor(1);
            },
            listarLineasByProveedor(page){
                this.nidempresa = 1300011;

                var url = this.ruta + '/parametro/GetLineasByProveedor?nidempresa=' + this.nidempresa
                                                                    + '&nidproveedor=' + this.formEventoCamp.nidproveedor
                                                                    + '&clineanombre=' + this.fillModal.clineanombre.toString()
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayLinea = response.data.arrayLinea.data;
                    this.paginationModal.current_page =  response.data.arrayLinea.current_page;
                    this.paginationModal.total = response.data.arrayLinea.total;
                    this.paginationModal.per_page    = response.data.arrayLinea.per_page;
                    this.paginationModal.last_page   = response.data.arrayLinea.last_page;
                    this.paginationModal.from        = response.data.arrayLinea.from;
                    this.paginationModal.to           = response.data.arrayLinea.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaLineasByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarLineasByProveedor(page);
            },
            asignarLineas(data =[]){
                if(this.encuentraLineas(data['nIdLinea'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Línea ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalLinea.push({
                                nIdLinea: data['nIdLinea'],
                                cLineaNombre: data['cLineaNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalMarca = [];
                    this.arrayTemporalModelo = [];
                    toastr.success('Se Agregó Línea');
                }
            },
            encuentraLineas(nIdLinea){
                var sw=0;
                for(var i=0;i<this.arrayTemporalLinea.length;i++){
                    if(this.arrayTemporalLinea[i].nIdLinea==nIdLinea){
                        sw=true;
                    }
                }
                return sw;
            },
            buscarMarcasByProveedor(){
                this.listarMarcasByProveedor(1);
            },
            listarMarcasByProveedor(page){
                this.nidempresa = 1300011;

                var url = this.ruta + '/parametro/GetMarcasByProveedor?nidempresa=' + this.nidempresa
                                                                    + '&nidproveedor=' + this.formEventoCamp.nidproveedor
                                                                    + '&cmarcanombre=' + this.fillModal.cmarcanombre.toString()
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayMarca = response.data.arrayMarca.data;
                    this.paginationModal.current_page =  response.data.arrayMarca.current_page;
                    this.paginationModal.total = response.data.arrayMarca.total;
                    this.paginationModal.per_page    = response.data.arrayMarca.per_page;
                    this.paginationModal.last_page   = response.data.arrayMarca.last_page;
                    this.paginationModal.from        = response.data.arrayMarca.from;
                    this.paginationModal.to           = response.data.arrayMarca.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaMarcasByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarMarcasByProveedor(page);
            },
            asignarMarcas(data =[]){
                if(this.encuentraMarcas(data['nIdMarca'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Esa Marca ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalMarca.push({
                                nIdMarca: data['nIdMarca'],
                                cMarcaNombre: data['cMarcaNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalLinea = [];
                    this.arrayTemporalModelo = [];
                    toastr.success('Se Agregó Marca');
                }
            },
            encuentraMarcas(nIdMarca){
                var sw=0;
                for(var i=0;i<this.arrayTemporalMarca.length;i++){
                    if(this.arrayTemporalMarca[i].nIdMarca==nIdMarca){
                        sw=true;
                    }
                }
                return sw;
            },
            buscarModelosByProveedor(){
                this.listarModelosByProveedor(1);
            },
            listarModelosByProveedor(page){
                this.nidempresa = 1300011;

                var url = this.ruta + '/parametro/GetModelosByProveedor?nidempresa=' + this.nidempresa
                                                                    + '&nidproveedor=' + this.formEventoCamp.nidproveedor
                                                                    + '&cmodelonombre=' + this.fillModal.cmodelonombre.toString()
                                                                    + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayModelo = response.data.arrayModelo.data;
                    this.paginationModal.current_page =  response.data.arrayModelo.current_page;
                    this.paginationModal.total = response.data.arrayModelo.total;
                    this.paginationModal.per_page    = response.data.arrayModelo.per_page;
                    this.paginationModal.last_page   = response.data.arrayModelo.last_page;
                    this.paginationModal.from        = response.data.arrayModelo.from;
                    this.paginationModal.to           = response.data.arrayModelo.to;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarPaginaModelosByProveedor(page){
                this.paginationModal.current_page=page;
                this.listarModelosByProveedor(page);
            },
            asignarModelos(data =[]){
                if(this.encuentraModelos(data['nIdModelo'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Modelo ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalModelo.push({
                                nIdModelo: data['nIdModelo'],
                                cModeloNombre: data['cModeloNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre']
                    });
                    this.arrayTemporalLinea = [];
                    this.arrayTemporalMarca = [];
                    toastr.success('Se Agregó Vehículo');
                }
            },
            encuentraModelos(nIdModelo){
                var sw=0;
                for(var i=0;i<this.arrayTemporalModelo.length;i++){
                    if(this.arrayTemporalModelo[i].nIdModelo==nIdModelo){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarItemLinea(index){
                this.$delete(this.arrayTemporalLinea, index);
                toastr.success('Se Eliminó Item Linea');
            },
            eliminarItemMarca(index){
                this.$delete(this.arrayTemporalMarca, index);
                toastr.success('Se Eliminó Item Marca');
            },
            eliminarItemModelo(index){
                this.$delete(this.arrayTemporalModelo, index);
                toastr.success('Se Eliminó Item Modelo');
            },
            cargarTabAsignaElemento(){
                this.llenarComboTpoElemento();
            },
            abrirModalAsignaElemento(modelo, accion, data =[]){
                switch(modelo){
                    case 'elemento':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                if(this.validaAsignaElemento()){
                                    this.accionmodal=1;
                                    this.modal = 1;
                                    return;
                                }

                                this.accionmodal=4;
                                this.modal = 1;
                                this.buscarElemento();
                                break;
                            }
                        }
                    }
                }
            },
            validaAsignaElemento(){
                this.error = 0;
                this.mensajeError =[];

                /*if(this.formEventoCamp.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Proveedor');
                };*/
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            buscarElemento(){
                this.listarElementos(1);
            },
            listarElementos(page){
                var url = this.ruta + '/elemento/GetElementoByTipo?nidempresa=' + 1300011 
                                                                     + '&nidtipoelemen=' + this.formEle.ntpoelemen
                                                                     + '&page='+ page;
                axios.get(url).then(response => {

                    this.arrayElementoVenta = response.data.arrayElementoVenta.data;
                    this.pagination.current_page =  response.data.arrayElementoVenta.current_page;
                    this.pagination.total = response.data.arrayElementoVenta.total;
                    this.pagination.per_page    = response.data.arrayElementoVenta.per_page;
                    this.pagination.last_page   = response.data.arrayElementoVenta.last_page;
                    this.pagination.from        = response.data.arrayElementoVenta.from;
                    this.pagination.to           = response.data.arrayElementoVenta.to;

                }).catch(error => {
                    this.errors = error
                });
            },
            cambiarPaginaElemento(page){
                this.paginationModal.current_page=page;
                this.listarElementos(page);
            },
            asignarElemento(data =[]){
                if(this.encuentraElementos(data['nIdElemento'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Elemento ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayTemporalElemento.push({
                                nIdElemento: data['nIdElemento'],
                                cTipoElemenNombre: data['cTipoElemenNombre'],
                                cElemenNombre: data['cElemenNombre'],
                                nIdProveedor: data['nIdProveedor'],
                                cProveedorNombre: data['cProveedorNombre'],
                                fElemenValorVenta: data['fElemenValorVenta']
                    });
                    toastr.success('Se Agregó Elemento');
                }
            },
            encuentraElementos(nIdElemento){
                var sw=0;
                for(var i=0;i<this.arrayTemporalElemento.length;i++){
                    if(this.arrayTemporalElemento[i].nIdElemento==nIdElemento){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarItemElemento(index){
                this.$delete(this.arrayTemporalElemento, index);
                toastr.success('Se Eliminó Item Elemento');
            },
            cargarDistPorEventoCampania(){
                this.cambiarVistaDistribucion();
            },
            cargarDistPorElementoVenta(){
                var url = this.ruta + '/ec/GetDistribucionByElementoVenta?nideventocampania=' + this.formDistribucion.nideventocampania;
                axios.get(url).then(response => {
                    this.arrayElementoDistribucion = response.data.arrayElementoDistribucion.data;
                }).catch(error => {
                    this.errors = error.response.data
                });
            },
            cambiarVistaDistribucion(){
                if(this.formDistribucion.ntipodistribucion==1){
                    this.vistaFormularioDistribucion = 1;
                    this.cargarDistPorEventoCampania();
                }
                else{
                    this.vistaFormularioDistribucion = 0;
                    this.cargarDistPorElementoVenta();
                }
            },
            buscarProveedorPorElementoVenta(index){
                this.accionmodal=5;
                this.modal = 1;
                this.formDistribucion.nindex = index;
                this.listarProveedorPorElementoVenta(1);
            },
            listarProveedorPorElementoVenta(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 1300011 
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProvedor.cnombreproveedor.toString() 
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
            asignarProveedorPorElementoVenta(nIdProveedor, cProveedorNombre){
                var index = this.formDistribucion.nindex;
                this.arrayIndexProvId[index] = nIdProveedor;
                this.arrayIndexProvNombre[index] = cProveedorNombre;
            },
            buscarProveedorPorEC(){
                if(this.validaBuscaProveedorPorEC()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.accionmodal=6;
                this.modal = 1;
                this.listarProveedorPorEC(1);
            },
            validaBuscaProveedorPorEC(){
                this.error = 0;
                this.mensajeError =[];

                if(this.formDistribucion.ntipoproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar la opción PROVEEDOR');
                };
                if(this.formDistribucion.ntipoproveedor == 2){
                    this.mensajeError.push('Debes Seleccionar la opción PROVEEDOR');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            listarProveedorPorEC(page){
                var url = this.ruta + '/parametro/GetLstProveedor?nidempresa=' + 1300011 
                                                                    + '&nidgrupopar=' + 110023
                                                                    + '&cnombreproveedor=' + this.fillProvedor.cnombreproveedor.toString() 
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
            asignarProveedorPorEC(data =[]){
                if(this.encuentraProveedorPorEC(data['nIdPar'])){
                        swal({
                            type: 'error',
                            title: 'Error...',
                            text: 'Ese Proveedor ya se encuentra agregado!',
                            })
                }
                else{
                    this.arrayProveedorPorEC.push({
                                nIdEntidad: data['nIdPar'],
                                cFlagEntidad: 'P',
                                cProveedorNombre: data['cParNombre']
                    });
                    toastr.success('Se Agregó Proveedor');
                }
            },
            encuentraProveedorPorEC(nIdEntidad){
                var sw=0;
                for(var i=0;i<this.arrayProveedorPorEC.length;i++){
                    if(this.arrayProveedorPorEC[i].nIdEntidad==nIdEntidad){
                        sw=true;
                    }
                }
                return sw;
            },
            eliminarItemProveedorEC(index){
                this.$delete(this.arrayProveedorPorEC, index);
                toastr.success('Se Eliminó Item Proveedor');
            },
            asignaEmpresaEC(){
                if(this.formDistribucion.ntipoproveedor == 2){
                    if(this.encuentraProveedorPorEC(1300011)){
                            swal({
                                type: 'error',
                                title: 'Error...',
                                text: 'Esa Empresa ya se encuentra agregada!',
                                })
                    }
                    else{
                        this.arrayProveedorPorEC.push({
                                    nIdEntidad: 1300011,
                                    cFlagEntidad: 'E',
                                    cProveedorNombre: 'AUTOMOTORES INKA'
                        });
                        toastr.success('Se Agregó Empresa');
                    }
                }
            },
            activarTab2(){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabECAsignaDetalle').removeClass('in active show');
                $('#TabECAsignaElemento').addClass('in active show');
            },
            activarTab3(){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link disabled");
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabECAsignaElemento').removeClass('in active show');
                $('#TabECAsignaDistribucion').addClass('in active show');
                this.vistaFormularioDistribucion = 1;
            },
            desactivarTabs(){
                $('#Tab2').addClass('disabled');
                //$('#Tab3').addClass('disabled');
            },
            registrar(){                
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
            
                var url = this.ruta + '/ec/SetEventoCampania';
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: 1300013,
                    nIdProveedor: parseInt(this.formEventoCamp.nidproveedor),
                    cNombreEventoCampania: this.formEventoCamp.descripcion,
                    nIdTipoEvento: this.formEventoCamp.ntipo,
                    dFechaInicio: this.formEventoCamp.dfechainicio,
                    dFechaFin: this.formEventoCamp.dfechafin,
                    fValorPresupuesto: this.formEventoCamp.fvalorpresupuesto,
                    cFlagDetalleEvento: this.formEventoCamp.cflagdetalleevento,
                    nIdUsuario: 190011
                }).then(response => {
                    this.registrarAsignaDetalle(response.data[0].nIdEventoCampania)
                    this.registrarAsignaElemento(response.data[0].nIdEventoCampania);
                    swal('Evento Campaña registrado');
                    this.activarTab3();
                    this.formDistribucion.nideventocampania = response.data[0].nIdEventoCampania;
                }).catch(error => {
                    console.log(error);
                });
            },
            registrarAsignaDetalle(nIdEventoCampania){
                if(this.arrayTemporalLinea.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalLinea;
                };
                if(this.arrayTemporalMarca.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalMarca;
                };
                if(this.arrayTemporalModelo.length > 0){
                    this.arrayRegistraDetalle = this.arrayTemporalModelo;
                };

                if (this.arrayRegistraDetalle.length > 0)
                {
                    var url = this.ruta + '/ec/SetDetalleEventoCampania';

                    axios.post(url, {
                        nIdEventoCampania: nIdEventoCampania,
                        cFlagDetalleEvento: this.formEventoCamp.cflagdetalleevento,
                        data: this.arrayRegistraDetalle,
                        nTotalRegistros: this.arrayRegistraDetalle.length,
                        fValorPresupuesto: this.formEventoCamp.fvalorpresupuesto,
                        nIdUsuario: 190011
                    }).then(response => {
                        //this.registrarAsignaDetalle(response.data);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            registrarAsignaElemento(nIdEventoCampania){
                if(this.arrayTemporalElemento.length > 0){
                    var url = this.ruta + '/ec/SetEventoElementoVenta';

                    axios.post(url, {
                        nIdEventoCampania: nIdEventoCampania,
                        data: this.arrayTemporalElemento,
                        nIdUsuario: 190011
                    }).then(response => {
                        //this.registrarAsignaDetalle(response.data);
                    }).catch(error => {
                        console.log(error);
                    });
                }
            },
            registrarAsignaDistribucion(){
                if(this.formDistribucion.ntipodistribucion==1){
                     
                    if(this.arrayProveedorPorEC.length > 0){
                        var list=[];
                        var listIndexEntidadValor=[];
                        listIndexProvValor = this.arrayIndexEntidadValor;

                        this.arrayProveedorPorEC.map(function(value, key) {
                            list.push({
                                nIdEntidad: value.nIdEntidad,
                                cFlagEntidad: value.cFlagEntidad,
                                fValorPorcentual: listIndexProvValor[key]
                            });
                        });

                        var url = this.ruta + '/ec/SetDistribucionEventoByEC';
                        axios.post(url, {
                            nIdEventoCampania: this.formDistribucion.nideventocampania,
                            data: list,
                            nIdUsuario: 190011
                        }).then(response => {
                            swal('Distribución registrada');
                            this.limpiarFormulario();
                            this.inicio();
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
                else{
                    if(this.arrayElementoDistribucion.length > 0){
                        var list=[];
                        var listIndexProvId=[];
                        var listIndexProvValor=[];
                        listIndexProvId = this.arrayIndexProvId;
                        listIndexProvValor = this.arrayIndexProvValor;

                        this.arrayElementoDistribucion.map(function(value, key) {
                            list.push({
                                nIdEventoElementoVenta: value.nIdEventoElementoVenta,
                                nIdEntidad: listIndexProvId[key],
                                fValorPorcentual: listIndexProvValor[key]
                            });
                        });

                        var url = this.ruta + '/ec/SetDistribucionEventoByElemento';
                        axios.post(url, {
                            data: list,
                            nIdUsuario: 190011
                        }).then(response => {
                            swal('Distribución registrada');
                            this.limpiarFormulario();
                            this.inicio();
                        }).catch(error => {
                            console.log(error);
                        });
                    }
                }
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];
              
                if(this.formEventoCamp.dfechainicio == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Inicio');
                };
                if(this.formEventoCamp.dfechafin == ''){
                    this.mensajeError.push('Debes Ingresar Fecha Fin');
                };
                if(this.formEventoCamp.nidproveedor == 0){
                    this.mensajeError.push('Debes Seleccionar un Proveedor');
                };
                if(this.formEventoCamp.ntipo == 0){
                    this.mensajeError.push('Debes Seleccionar un Tipo E/C');
                };
                if(!this.formEventoCamp.fvalorpresupuesto){
                    this.mensajeError.push('Debes Ingresar Valor Presupuesto');
                };           
                if(!this.formEventoCamp.descripcion){
                    this.mensajeError.push('Debes Ingresar Descripción');
                }; 
                if(this.formEventoCamp.dfechainicio > this.formEventoCamp.dfechafin){
                    this.mensajeError.push('La Fecha Inicio debe ser menor a la Fecha Fin.');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarDistribucion(){
                this.error = 0;
                this.mensajeError =[];
              
                if(this.formDistribucion.nideventocampania == 0){
                    this.mensajeError.push('Error en registro de Distribucion');
                };

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cancelar(){
                this.limpiarFormulario();
                this.inicio();
            },
            inicio(){
                $('#Tab1').removeClass("nav-link disabled");
                $('#Tab1').addClass('nav-link active');
                $('#Tab2').removeClass('nav-link active');
                $('#Tab2').addClass("nav-link disabled");
                $('#Tab3').removeClass('nav-link active');
                $('#Tab3').addClass("nav-link disabled");
                $('#TabECAsignaDetalle').addClass('in active show');
                $('#TabECAsignaElemento').removeClass('in active show');
                $('#TabECAsignaDistribucion').removeClass('in active show');
            },
            limpiarFormulario(){
                this.formEventoCamp.dfechainicio = '',
                this.formEventoCamp.dfechafin = '',
                this.formEventoCamp.nidproveedor = 0,
                this.formEventoCamp.cproveedornombre= '',
                this.formEventoCamp.fvalorpresupuesto = '',
                this.formEventoCamp.descripcion = '',
                this.formEventoCamp.ntipo = 0,
                this.formDistribucion.nideventocampania = 0,
                this.arrayTemporalLinea = [],
                this.arrayTemporalMarca = [],
                this.arrayTemporalModelo = [],
                this.arrayTemporalElemento = [],
                this.arrayElementoDistribucion = [],
                this.arrayProveedorPorEC = [],
                this.arrayElementoDistribucion = []
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
            this.tabBuscarEventoCampania();
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