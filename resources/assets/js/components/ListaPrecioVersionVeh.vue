<template>
    <main>
        <header class="page-header">
          <div class="container-fluid">
            <h2 class="no-margin-bottom">LISTA DE PRECIOS</h2>
          </div>
        </header>
        
        <section>
            <div class="container-fluid">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Tab1" href="#TabBuscaListaPrecioVh" @click="tabBuscaListaPrecioVh()" role="tab" data-toggle="tab">
                                        <i class="fa fa-search"></i> BUSCAR LISTA PRECIO
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="Tab2" href="#TabAsignaDetalle" role="tab" data-toggle="tab">
                                        <i class="fa fa-usd"></i> AGREGAR DETALLE DE PRECIOS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link disabled" id="Tab3" href="#TabVerDetalle" role="tab" data-toggle="tab">
                                        <i class="fa fa-file-text-o"></i> DETALLE LISTA PRECIOS
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade in active show" id="TabBuscaListaPrecioVh">
                                    <template v-if="vistaFormTab1">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR LISTA</h3>
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
                                                                            <label class="col-sm-4 form-control-label">Proveedor</label>
                                                                            <div class="col-sm-8">
                                                                                <div class="input-group">
                                                                                    <input type="hidden" v-model="formListaPrecioVh.nidproveedor">
                                                                                    <input type="text" v-model="formListaPrecioVh.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                    <div class="col-sm-9 offset-sm-4">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click="buscarListaPrecioVh();">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="abrirFormulario('listapreciovh','registrarDetalle');">
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
                                                            <h3 class="h4">LISTADO</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <template v-if="arrayListaPrecioVh.length">
                                                                <div class="table-responsive">                              
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Código</th>       
                                                                                <th>Proveedor</th>
                                                                                <th>Periodo</th>
                                                                                <th>Nro Lista</th>
                                                                                <th>Tipo Lista</th>
                                                                                <th>Fecha Inicio<nav></nav></th>
                                                                                <th>Fecha Fin</th>
                                                                                <th>Acciones</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="lista in arrayListaPrecioVh" :key="lista.nIdListaPrecioVh" >
                                                                                <td v-text="lista.nIdListaPrecioVh"></td>
                                                                                <td v-text="lista.cProveedorNombre"></td>
                                                                                <td v-text="lista.cNumeroMes + '-' + lista.cAnio"></td>
                                                                                <td v-text="lista.nNroListaPrecio"></td>
                                                                                <td v-text="lista.cTipoLista"></td>
                                                                                <td v-text="lista.dFechaInicio"></td>
                                                                                <td v-text="lista.dFechaFin"></td>
                                                                                <td>
                                                                                    <a href="#" @click="activarTab2(lista.nIdListaPrecioVh, lista.cAnio, lista.cMes, lista.nIdProveedor, lista.cProveedorNombre, lista.nNroListaPrecio)" data-toggle="tooltip" data-placement="top" 
                                                                                        :title="'Agregar Detalle a Lista'">
                                                                                        <i class="fa-md fa fa-sign-in"></i>
                                                                                    </a>
                                                                                    <template v-if="lista.nListadoDetalleContador > 0">
                                                                                        <a href="#" @click="activarTab3(lista.nIdListaPrecioVh, lista.cAnio, lista.cMes, lista.nIdProveedor, lista.cProveedorNombre, lista.nNroListaPrecio)" data-toggle="tooltip" data-placement="top" 
                                                                                            :title="'Ver Detalle Lista ' +lista.nNroListaPrecio">
                                                                                            <i class="fa-md fa fa-eye"></i>
                                                                                        </a>
                                                                                    </template>
                                                                                    <template v-else>
                                                                                        SD
                                                                                    </template>
                                                                                    <template v-if="lista.cListaEstado=='A'">
                                                                                        <a href="#" @click="desactivar(lista.nIdListaPrecioVh)" data-toggle="tooltip" data-placement="top" 
                                                                                            :title="'Desactivar Lista ' +lista.nNroListaPrecio">
                                                                                            <i class="fa-md fa fa-check-square"></i>
                                                                                        </a>
                                                                                    </template>
                                                                                    <template v-else>
                                                                                        <a href="#" @click="activar(lista.nIdListaPrecioVh, lista.nIdProveedor, lista.nIdTipoLista)" data-toggle="tooltip" data-placement="top" 
                                                                                            :title="'Activar Lista ' +lista.nNroListaPrecio">
                                                                                            <i :style="'color:red'" class="fa-md fa fa-square"></i>
                                                                                        </a>
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
                                                            <h3 class="h4" v-text="tituloFormulario"></h3>
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
                                                                            <label class="col-sm-4 form-control-label">* Año</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="canio" class="form-control form-control-sm" readonly>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Mes</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="cmes" class="form-control form-control-sm" readonly>
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
                                                                                    <input type="hidden" v-model="formListaPrecioVh.nidproveedor">
                                                                                    <input type="text" v-model="formListaPrecioVh.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
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
                                                                            <label class="col-sm-4 form-control-label">Nro Lista Prov.</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="hidden" v-model="formListaPrecioVh.nidlistaprecioversionVeh">
                                                                                <input type="text" v-model="formListaPrecioVh.nnrolistaprecio" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Fecha Inicio</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="date" v-model="formListaPrecioVh.dfechainicio" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">* Tipo Lista</label>
                                                                            <div class="col-sm-8">
                                                                                <select name="account" v-model="formListaPrecioVh.nidtipolista" class="form-control form-control-sm">
                                                                                    <option v-for="tipolista in arrayTipoLista" :key="tipolista.nIdPar" :value="tipolista.nIdPar" v-text="tipolista.cParNombre">
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">        
                                                                    <div class="col-sm-9 offset-sm-4">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrar();">
                                                                            <i class="fa fa-save"></i> Registrar
                                                                        </button>
                                                                        <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="cambiarVistaFormulario();">
                                                                            <i class="fa fa-close"></i> Cerrar
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
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabAsignaDetalle">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">AGREGAR DETALLE</h3>
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
                                                                        <label class="col-sm-4 form-control-label">* Año</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="canio" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="cmes" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="hidden" v-model="formListaPrecioVh.nidproveedor">
                                                                            <input type="text" v-model="formListaPrecioVh.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Lista Prov.</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="hidden" v-model="formListaPrecioVh.nidlistaprecioversionVeh">
                                                                            <input type="text" v-model="formListaPrecioVh.nnrolistaprecio" class="form-control form-control-sm" readonly>
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
                                                        <div class="col-lg-12">
                                                            <div class="form-group row">
                                                                <div class="col-sm-8">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Adjunte Lista de Precios</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="file" id="file-upload" @change="getFile" accept=".xls,.xlsx" class="form-control form-control-sm"/>
                                                                            <!--<label for="file-upload" class="btn btn-warning btn-corner btn-sm">
                                                                                <i class="fa fa-upload"></i> Seleccione Archivo
                                                                            </label>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="row">
                                                                        <!--<input type="text" v-model="textFile" class="col-sm-6 form-control form-control-sm" readonly>
                                                                        <div class="col-sm-6">-->
                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="importFileListaPrecioVh()">
                                                                                <i class="fa fa-retweet"></i> Procesar
                                                                            </button>
                                                                        <!--</div>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <template v-if="arrayExcel.length">
                                                                <div class="table-responsive border" style="max-height: 300px; max-width:1200px; overflow-y: auto; overflow-x: auto;-ms-overflow-style: -ms-autohiding-scrollbar;">
                                                                    <table class="table table-striped table-sm">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Acciones</th>
                                                                                <th>Item</th>
                                                                                <th>Descripcion</th>
                                                                                <th>Año Fabricacion</th>
                                                                                <th>Año Modelo</th>
                                                                                <th>UM</th>
                                                                                <th>Mon.<nav></nav></th>
                                                                                <th>Prec. Base</th>
                                                                                <th>Dscto</th>
                                                                                <th>Prec.Cierre</th>
                                                                                <th>Placa</th>
                                                                                <th>Margen</th>
                                                                                <th>Costo Dealer</th>
                                                                                <th>Bono</th>
                                                                                <th>Prec. Cierre 2</th>
                                                                                <th>Flete</th>
                                                                                <th>TYP</th>
                                                                                <th>Precio.Vta P</th>
                                                                                <th>Dealer/Prec. Bono</th>
                                                                                <th>Bono.Especial</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr v-for="(lista, index) in arrayExcel" :key="lista.nIdVersionVh">
                                                                                <td><a href="#" @click="eliminarItemExcel(index);" data-toggle="tooltip" data-placement="top" :title="'Eliminar ' +lista.nOrdenListaPrecioVh">
                                                                                    <i :style="'color:red'" class="fa-md fa fa-times-circle"></i></a>
                                                                                </td>
                                                                                <td v-text="lista.nIdVersionVeh"></td>
                                                                                <td v-text="lista.cNombreComercial"></td>
                                                                                <td v-text="lista.nAnioFabricacion"></td>
                                                                                <td v-text="lista.nAnioModelo"></td>
                                                                                <td v-text="lista.cUnidadMedida"></td>
                                                                                <td v-text="lista.cMoneda"></td>
                                                                                <td v-text="lista.fPrecioBase"></td>
                                                                                <td v-text="lista.fDescuento"></td>
                                                                                <td v-text="lista.fPrecioCierre"></td>
                                                                                <td v-text="lista.fPlaca"></td>
                                                                                <td v-text="lista.fMargen"></td>
                                                                                <td v-text="lista.fCostoDealer"></td>
                                                                                <td v-text="lista.fBono"></td>
                                                                                <td v-text="lista.fPrecioCierre2"></td>
                                                                                <td v-text="lista.fFlete"></td>
                                                                                <td v-text="lista.fTYP"></td>
                                                                                <td v-text="lista.fPrecioVentaP"></td>
                                                                                <td v-text="lista.fPrecioBonoDealer"></td>
                                                                                <td v-text="lista.fBonoEspecial"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-lg-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-7">
                                                                        </div>
                                                                        <div class="col-lg-5">
                                                                            <div class="datatable-info">Total: {{ contadorArrayExcel }} registros</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">        
                                                                    <div class="col-sm-9 offset-sm-5">
                                                                        <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarDetalle()">
                                                                            <i class="fa fa-save"></i> Registrar
                                                                        </button>
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
                                    </section>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="TabVerDetalle">
                                    <section class="forms">
                                        <div class="container-fluid">
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="h4">INFORMACIÓN DETALLE</h3>
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
                                                                        <label class="col-sm-4 form-control-label">* Año</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="canio" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Mes</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" v-model="cmes" class="form-control form-control-sm" readonly>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="hidden" v-model="formListaPrecioVh.nidproveedor">
                                                                            <input type="text" v-model="formListaPrecioVh.cproveedornombre" disabled="disabled" class="form-control form-control-sm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Lista Prov.</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="hidden" v-model="formListaPrecioVh.nidlistaprecioversionVeh">
                                                                            <input type="text" v-model="formListaPrecioVh.nnrolistaprecio" class="form-control form-control-sm" readonly>
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
                                                        <template v-if="arrayListaPrecioVhDet.length">
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Código Det.</th>
                                                                            <th>Código Veh.</th>
                                                                            <th>Nombre Comercial</th>
                                                                            <th>Año Fabricación</th>
                                                                            <th>Año Modelo</th>
                                                                            <th>Moneda</th>
                                                                            <th>Costo Dealer</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr v-for="lpd in arrayListaPrecioVhDet" :key="lpd.nIdListaPrecioVersionVehDetalle">
                                                                            <td v-text="lpd.nIdListaPrecioVersionVehDetalle"></td>
                                                                            <td v-text="lpd.nIdVersionVeh"></td>
                                                                            <td v-text="lpd.cNombreComercial"></td>
                                                                            <td v-text="lpd.nAnioFabricacion"></td>
                                                                            <td v-text="lpd.nAnioModelo"></td>
                                                                            <td v-text="lpd.cSimboloMoneda"></td>
                                                                            <td v-text="lpd.fCostoDealer"></td>
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
                                                                    <input type="text" v-model="fillProvedor.cnombreproveedor" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Vehículos" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores"><i class="fa-lg fa fa-search"></i></button>
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
                arrayListaPrecioVh: [],
                arrayProveedor: [],
                arrayListaPrecioVhDet: [],
                arrayTipoLista: [],
                arrayExcel: [],
                contadorArrayExcel: 0,
                fillProvedor:{
                    cnombreproveedor: ''
                },
                formListaPrecioVh:{
                    nidproveedor: 0,
                    cproveedornombre: '',
                    nformapago: 0,
                    nidlistaprecioversionVeh: 0,
                    nnrolistaprecio: '',
                    dfechainicio: '',
                    nidtipolista: 0
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
                offsetModal:3,
                accion: 0,
                modal:0,
                tituloModal:'',
                tituloFormulario: '',
                vistaFormTab1: 1,
                accionmodal: 0,
                error: 0,
                errors: [],
                mensajeError: [],
                attachment: null,
                form: new FormData,
                textFile: ''
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
            tabBuscaListaPrecioVh(){
                this.formListaPrecioVh.nidproveedor = 0,
                this.formListaPrecioVh.cproveedornombre = '',
                this.desactivarTabs();
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
                    console.log(error);
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.formListaPrecioVh.nidproveedor = nProveedorId;
                this.formListaPrecioVh.cproveedornombre = cProveedorNombre;
                this.cerrarModal();
            },
            listarTipoLista(){
                var url = this.ruta + '/parametro/GetParametroByGrupo?ngrupoparid=' + 110044 
                                                                                + '&opcion=' + 0;
                axios.get(url).then(response => {
                    this.arrayTipoLista = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarListaPrecioVh(){
                this.listarListaPrecioVh(1);
            },
            listarListaPrecioVh(page){
                this.mostrarProgressBar();
                this.nidempresa = 1300011;
                this.nidsucursal = 1300013;

                var url = this.ruta + '/listapreciovh/GetListaVh?nidempresa=' + this.nidempresa
                                                                + '&nidsucursal=' + this.nidsucursal
                                                                + '&nidproveedor=' + this.formListaPrecioVh.nidproveedor
                                                                + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayListaPrecioVh = response.data.arrayListaPrecioVh.data;
                    this.pagination.current_page =  response.data.arrayListaPrecioVh.current_page;
                    this.pagination.total = response.data.arrayListaPrecioVh.total;
                    this.pagination.per_page    = response.data.arrayListaPrecioVh.per_page;
                    this.pagination.last_page   = response.data.arrayListaPrecioVh.last_page;
                    this.pagination.from        = response.data.arrayListaPrecioVh.from;
                    this.pagination.to           = response.data.arrayListaPrecioVh.to;
                 }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPagina(page){
                this.pagination.current_page=page;
                this.listarListaPrecioVh(page);
            },
            registrar(){
                if(this.validar()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                var url = this.ruta + '/listapreciovh/SetListaVh';
                axios.post(url, {
                    nIdEmpresa: 1300011,
                    nIdSucursal: 1300013,
                    nIdProveedor: parseInt(this.formListaPrecioVh.nidproveedor),
                    nIdCronograma: 220016,
                    nNroListaPrecio: parseInt(this.formListaPrecioVh.nnrolistaprecio),
                    dFechaInicio: this.formListaPrecioVh.dfechainicio,
                    nIdTipoLista: this.formListaPrecioVh.nidtipolista
                }).then(response => {
                    swal('Lista de Precio registrada');
                    this.limpiarFormulario();
                    this.listarListaPrecioVh(1);
                    this.vistaFormTab1 = 1;
                }).catch(error => {
                    console.log(error);
                });
            },
            validar(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.formListaPrecioVh.nidproveedor || this.formListaPrecioVh.nidproveedor == 0){
                    this.mensajeError.push('Debes Ingresar Proveedor');
                };
                if(!this.formListaPrecioVh.dfechainicio){
                    this.mensajeError.push('Debes Ingresar Fecha Inicio');
                };
                if(this.formListaPrecioVh.nidtipolista == 0){
                    this.mensajeError.push('Debes Seleccionar Tipo Lista');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            actualizar(){
                var url = this.ruta + '//categoria/actualizar';
                if(this.validar()){
                    return;
                }

                axios.put(url, {
                    nombre: this.nombre,
                    descripcion: this.descripcion,
                    id: this.id
                }).then(response => {
                    this.cerrarModal();
                    this.listar();
                }).catch(error => {
                    console.log(error);
                });
            },
            activar(nIdListaPrecioVersionVeh, nIdProveedor, nIdTipoLista){
                swal({
                    title: 'Estas seguro de activar esta Lista?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Activar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/listapreciovh/activar';
                            axios.put(url, {
                                nIdListaPrecioVersionVeh: nIdListaPrecioVersionVeh,
                                nIdProveedor: nIdProveedor,
                                nIdTipoLista: nIdTipoLista
                            }).then(response =>{     
                                if(response.data[0].nFlagMsje == 1)
                                {
                                    swal(
                                    'Activado!',
                                    'El registro fue activado.'
                                    );
                                    this.listarListaPrecioVh(1);  
                                }
                                else{
                                    swal('Ya existe Lista activa');
                                }                                                                               
                            })
                            .catch(function (error) {
                                console.log(error);
                            });
                        } else if (result.dismiss === swal.DismissReason.cancel) 
                        {
                        }
                    })
            },
            desactivar(nIdListaPrecioVersionVeh){
                swal({
                    title: 'Estás seguro de desactivar esta Lista?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Desactivar!',
                    cancelButtonText: 'No, cancelar!'
                    }).then((result) => {
                        if (result.value) {
                            var url = this.ruta + '/listapreciovh/desactivar';
                            axios.put(url, {
                                nIdListaPrecioVersionVeh: nIdListaPrecioVersionVeh
                            }).then(response =>{                            
                                swal(
                                'Desactivado!',
                                'El registro fue desactivado.'
                                );
                                this.listarListaPrecioVh(1);                           
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
                //this.accionmodal==1;
                this.modal = 0
                /*this.nombre = '',
                this.descripcion = '',
                this.tituloModal = '',*/
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
            abrirFormulario(modelo, accion, data =[]){
                switch(modelo){
                    case 'listapreciovh':
                    {
                        switch(accion){
                            case 'registrarDetalle':
                            {
                                this.vistaFormTab1 = 0;
                                this.tituloFormulario = 'NUEVA LISTA PRECIO';
                                this.limpiarFormulario();
                                this.listarTipoLista();
                                this.formListaPrecioVh.nnrolistaprecio = '';
                                break;
                            }
                            case 'actualizar':
                            {
                                //this.vistaFormTab1 = 0;
                                this.tituloFormulario = 'ACTUALIZAR ELEMENTO VENTA';
                                break;
                            }
                        }
                    }
                }
            },
            cambiarVistaFormTab1(){
                this.vistaFormTab1 = 1;
                this.limpiarFormulario();
            },
            activarTab2(nIdListaPrecioVersionVeh, cAnio, cMes, nIdProveedor, cProveedorNombre, nNroListaPrecio){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab2').removeClass('nav-link disabled');
                $('#Tab2').addClass("nav-link active");
                $('#TabBuscaListaPrecioVh').removeClass('in active show');
                $('#TabAsignaDetalle').addClass('in active show');
                this.formListaPrecioVh.nidlistaprecioversionVeh = nIdListaPrecioVersionVeh;
                this.canio  = cAnio;
                this.cmes = cMes
                this.formListaPrecioVh.nidproveedor = nIdProveedor;
                this.formListaPrecioVh.cproveedornombre = cProveedorNombre;
                this.formListaPrecioVh.nnrolistaprecio = nNroListaPrecio;
                this.limpiarFormulario();
            },
            activarTab3(nIdListaPrecioVersionVeh, cAnio, cMes, nIdProveedor, cProveedorNombre, nNroListaPrecio){
                $('#Tab1').removeClass('nav-link active');
                $('#Tab1').addClass("nav-link");
                $('#Tab3').removeClass('nav-link disabled');
                $('#Tab3').addClass("nav-link active");
                $('#TabBuscaListaPrecioVh').removeClass('in active show');
                $('#TabVerDetalle').addClass('in active show');
                this.formListaPrecioVh.nidlistaprecioversionVeh = nIdListaPrecioVersionVeh;
                this.canio  = cAnio;
                this.cmes = cMes
                this.formListaPrecioVh.nidproveedor = nIdProveedor;
                this.formListaPrecioVh.cproveedornombre = cProveedorNombre;
                this.formListaPrecioVh.nnrolistaprecio = nNroListaPrecio;
                this.limpiarFormulario();
                this.verDetalle();
            },
            desactivarTabs(){
                $('#Tab2').addClass('disabled');
                $('#Tab3').addClass('disabled');
            },
            verDetalle(){
                this.listarListaPrecioVhDetalle(1);
            },
            listarListaPrecioVhDetalle(page){
                this.mostrarProgressBar();

                var url = this.ruta + '/listapreciovh/GetListaVhDetalle?nidlistaprecioversionveh=' + this.formListaPrecioVh.nidlistaprecioversionVeh
                                                                                            + '&page='+ page;
                axios.get(url).then(response => {
                    this.arrayListaPrecioVhDet = response.data.arrayListaPrecioVhDet.data;
                    this.pagination.current_page =  response.data.arrayListaPrecioVhDet.current_page;
                    this.pagination.total = response.data.arrayListaPrecioVhDet.total;
                    this.pagination.per_page    = response.data.arrayListaPrecioVhDet.per_page;
                    this.pagination.last_page   = response.data.arrayListaPrecioVhDet.last_page;
                    this.pagination.from        = response.data.arrayListaPrecioVhDet.from;
                    this.pagination.to           = response.data.arrayListaPrecioVhDet.to;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaDetalle(page){
                this.pagination.current_page=page;
                this.listarListaPrecioVhDetalle(page);
            },
            getFile(e){
                //console.log(e);
                let selectFile = e.target.files[0];
                this.attachment = selectFile;
                //this.textFile = e.target.files[0].name;
            },
            importFileListaPrecioVh(){
                if(this.validarReadFileListaPrecioVh()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                this.form.append('file', this.attachment);
                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };
                var url = this.ruta + '/listapreciovh/importFileListaPrecioVh';
                axios.post(url, this.form, config).then(response=>{
                    this.readFileListaPrecioVh(response.data);
                }).catch(error => {
                    console.log(error);
                });
            },
            readFileListaPrecioVh(nameFile){
                this.mostrarProgressBar();
                var url = this.ruta + '/listapreciovh/readFileListaPrecioVh';
                axios.post(url, {
                    nameFile: nameFile
                }).then(response => {
                    
                    if(this.validaCamposExcel(response.data)){
                        this.accionmodal=1;
                        this.modal = 1;
                        return;
                    }

                    this.$delete(response.data, 0)
                    this.arrayExcel = response.data;
                    this.contadorArrayExcel = response.data.length;
                }).then(function (response) {
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                });
            },
            validaCamposExcel(foo){
                this.error = 0;
                this.mensajeError = [];
                var list=[];

                foo.map(function(value, key) {
                    if(key==0){
                        if(value.nIdVersionVeh != "Item"){
                                list.push('Falta celda Item, verifique el archivo.');
                        };
                        if(value.cNombreComercial != "Descripcion"){
                                list.push('Falta celda Descripción, verifique el archivo.');
                        };
                        if(value.cUnidadMedida != "UM"){
                                list.push('Falta celda UM, verifique el archivo.');
                        };
                        if(value.cMoneda != "Mon."){
                                list.push('Falta celda Mon., verifique el archivo.');
                        };
                    };
                });
                    
                if(list.length){
                    this.mensajeError = list;
                    this.error = 1;
                }
                return this.error;
            },
            eliminarItemExcel(index){
                this.$delete(this.arrayExcel, index)
            },
            registrarDetalle(){
                this.arrayListaPrecioVh = this.arrayExcel;

                if(this.validarRegistroDetalle()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                
                var url = this.ruta + '/listapreciovh/SetListaPrecioVhDetalle';
                axios.post(url, {
                    nIdListaPrecioVersionVeh: this.formListaPrecioVh.nidlistaprecioversionVeh,
                    data: this.arrayListaPrecioVh
                }).then(response => {
                    swal('Detalle de Lista registrada');
                    this.arrayExcel = [];
                    this.arrayListaPrecioVh = [];
                    //this.attachment = null;
                    //this.textFile = '';
                    $("#file-upload").val("");
                }).catch(error => {
                    console.log(error);
                });
            },
            validarRegistroDetalle(){
                this.error = 0;
                this.mensajeError =[];
                /*if(!this.textFile){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }*/
                if(this.arrayListaPrecioVh == []){
                    this.mensajeError.push('No hay Datos a Registrar');
                };
                if(this.nIdListaPrecioVersionVeh == 0){
                    this.mensajeError.push('No ha seleecioando Lista de Precio');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarReadFileListaPrecioVh(){
                this.error = 0;
                this.mensajeError =[];
                /*if(!this.textFile){
                    this.mensajeError.push('No hay Archivos Seleccionados');
                }*/
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cambiarVistaFormulario(){
                this.limpiarFormulario();
                this.vistaFormTab1 = 1;
            },
            limpiarFormulario(){
                this.arrayExcel = [],
                this.arrayListaPrecioVh = []
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
        },
        mounted(){
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
        /*input[type="file"] {
            display: none;
        }*/
</style>
