<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO MAESTRO DE VEHICULO</vs-divider>
                    </h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="tab01" href="#TabBuscarVehiculo" @click="tabBuscarVehiculo" role="tab" data-toggle="tab">
                                            <i class="fa fa-search"></i> BUSCAR VEHÍCULO
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tab02" href="#TabNuevoVehiculo" @click="tabNuevoVehiculo('', 1)" role="tab" data-toggle="tab">
                                            <i class="fa fa-truck"></i> NUEVO VEHÍCULO
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active show" id="TabBuscarVehiculo">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="h4">BUSCAR VEHÍCULOS.</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form class="form-horizontal">
                                                                <!--<div class="form-group row">
                                                                    <div class="col-md-6">
                                                                        <div class="row">
                                                                            <label class="col-md-4 form-control-label">*Tipo Persona</label>
                                                                            <div class="col-md-8">
                                                                                <el-radio-group v-model="fillBusquedaVehiculo.ntipopersona" @change="limpiarTabVehiculos()">
                                                                                    <el-radio v-for="tipo in arrayTipoPersona" :key="tipo.id" :label="tipo.value"> {{ tipo.text }} </el-radio>
                                                                                </el-radio-group>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Contacto</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaVehiculo.cfiltrodescripcion" @keyup.enter="buscarVehiculo(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro Documento</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaVehiculo.cnrodocumento" @keyup.enter="buscarVehiculo(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Marca</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillBusquedaVehiculo.nidmarca"
                                                                                            filterable
                                                                                            clearable
                                                                                            placeholder="SELECCIONE"
                                                                                            v-on:change="llenarComboModelo(1)">
                                                                                    <el-option
                                                                                    v-for="item in arrayMarca"
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
                                                                            <label class="col-sm-4 form-control-label">Modelo</label>
                                                                            <div class="col-sm-8">
                                                                                <el-select v-model="fillBusquedaVehiculo.nidmodelo"
                                                                                            filterable
                                                                                            clearable
                                                                                            placeholder="SELECCIONE" >
                                                                                    <el-option
                                                                                        v-for="item in arrayModelo"
                                                                                        :key="item.nIdModelo"
                                                                                        :label="item.cModeloNombre"
                                                                                        :value="item.nIdModelo">
                                                                                    </el-option>
                                                                                </el-select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nombre Comercial</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaVehiculo.cnombrecomercial" @keyup.enter="buscarVehiculo(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <div class="row">
                                                                            <label class="col-sm-4 form-control-label">Nro VIN</label>
                                                                            <div class="col-sm-8">
                                                                                <input type="text" v-model="fillBusquedaVehiculo.cnumerovin" @keyup.enter="buscarVehiculo(1)" class="form-control form-control-sm">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <div class="col-md-9 offset-md-5">
                                                                        <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="buscarVehiculo(1)">
                                                                            <i class="fa fa-search"></i> Buscar
                                                                        </button>
                                                                        <button type="button" class="btn btn-default btn-corner btn-sm" @click.prevent="limpiarTabBusquedaVehiculo">
                                                                            <i class="fa fa-recycle"></i> Limpiar
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
                                                            <form class="form-horizontal">
                                                                <div class="col-lg-12">
                                                                    <template v-if="arrayVehiculoBuscar.length">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-striped table-sm">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Acciones</th>
                                                                                        <th>Marca</th>
                                                                                        <th>Modelo</th>
                                                                                        <th>Nombre Comercial</th>
                                                                                        <th>Nro VIN</th>
                                                                                        <th>Tarjeta</th>
                                                                                        <th>Placa</th>
                                                                                        <th>Propietario</th>
                                                                                        <th>D.Identificación</th>
                                                                                        <th>Celular</th>
                                                                                        <th>SOAT</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr v-for="vehiculo in arrayVehiculoBuscar" :key="vehiculo.nIdVehiculoPlaca + vehiculo.nIdCompra">
                                                                                        <td>
                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                <div slot="content">Editar</div>
                                                                                                <i @click="tabNuevoVehiculo(vehiculo, 2)" :style="'color:#796AEE'" class="fa-md fa fa-edit"></i>
                                                                                            </el-tooltip>&nbsp;
                                                                                        </td>
                                                                                        <td v-text="vehiculo.cMarca"></td>
                                                                                        <td v-text="vehiculo.cModelo"></td>
                                                                                        <td v-text="vehiculo.cNombreComercial"></td>
                                                                                        <td v-text="vehiculo.cNumeroVin"></td>
                                                                                        <td v-text="vehiculo.cNroTarjeta"></td>
                                                                                        <td v-text="vehiculo.cPlaca"></td>
                                                                                        <td v-text="vehiculo.cPropietario"></td>
                                                                                        <td v-text="vehiculo.cNroIdentificacion"></td>
                                                                                        <td v-text="vehiculo.cNroCelular"></td>
                                                                                        <td v-text="vehiculo.cEstado"></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <div class="col-lg-12">
                                                                            <div class="row">
                                                                                <div class="col-lg-7">
                                                                                    <nav>
                                                                                        <ul class="pagination">
                                                                                            <li v-if="pagination.current_page > 1" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaVehiculos(pagination.current_page-1)" class="page-link" href="#">Ant</a>
                                                                                            </li>
                                                                                            <li  class="page-item" v-for="page in pagesNumber" :key="page"
                                                                                            :class="[page==isActived?'active':'']">
                                                                                                <a class="page-link"
                                                                                                href="#" @click.prevent="cambiarPaginaVehiculos(page)"
                                                                                                v-text="page"></a>
                                                                                            </li>
                                                                                            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                                                                                                <a @click.prevent="cambiarPaginaVehiculos(pagination.current_page+1)" class="page-link" href="#">Sig</a>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </nav>
                                                                                </div>
                                                                                <div class="col-lg-5">
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
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="TabNuevoVehiculo">
                                        <section class="forms">
                                            <div class="container-fluid">
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="tab0201" href="#TabVehiculo" @click="tabVehiculo();" role="tab" data-toggle="tab">
                                                                <i class="fa fa-car"></i> VEHÍCULO
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0202" href="#TabPropietario" role="tab" data-toggle="tab">
                                                                <i class="fa fa fa-user"></i> PROPIETARIO
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link disabled" id="tab0203" href="#TabSoat" role="tab" data-toggle="tab">
                                                                <i class="fa fa-address-card"></i> SOAT
                                                            </a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabVehiculo">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <!--<div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Placa</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Número de Placa"
                                                                                                v-model="fillNuevoVehiculo.cnroplaca"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Tarjeta Propiedad</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Número de Placa"
                                                                                                v-model="fillNuevoVehiculo.cnrotarjetapropiedad"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            -->
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Carroceria</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidclase"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                v-for="item in arrayClase"
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
                                                                                        <label class="col-sm-4 form-control-label">* Marca</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidmarca"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE"
                                                                                                        v-on:change="llenarComboModelo(2)">
                                                                                                <el-option
                                                                                                v-for="item in arrayMarca"
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
                                                                                        <label class="col-sm-4 form-control-label">* Modelo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidmodelo"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                    v-for="item in arrayModelo"
                                                                                                    :key="item.nIdModelo"
                                                                                                    :label="item.cModeloNombre"
                                                                                                    :value="item.nIdModelo">
                                                                                                </el-option>
                                                                                            </el-select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Color</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnombrecolor" class="form-control form-control-sm">
                                                                                            <!--<el-select v-model="fillNuevoVehiculo.nidcolor"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                v-for="item in arrayColor"
                                                                                                :key="item.nIdPar"
                                                                                                :label="item.cParNombre"
                                                                                                :value="item.nIdPar">
                                                                                                </el-option>
                                                                                            </el-select>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Año Modelo</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.nidaniomodelo" class="form-control form-control-sm">
                                                                                            <!--<el-select v-model="fillNuevoVehiculo.nidaniomodelo"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE AÑO MODELO">
                                                                                                <el-option
                                                                                                    v-for="item in arrayAnioModelo"
                                                                                                    :key="item.nIdPar"
                                                                                                    :label="item.cParNombre"
                                                                                                    :value="item.nIdPar">
                                                                                                </el-option>
                                                                                            </el-select>-->
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Tracción</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidtranccion"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE LA TRACCIÓN">
                                                                                                <el-option
                                                                                                    v-for="item in arrayTraccion"
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
                                                                                        <label class="col-sm-4 form-control-label">* Categoria</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidcategoria"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE LA CATEGORÍA">
                                                                                                <el-option
                                                                                                    v-for="item in arrayCategoria"
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
                                                                                        <label class="col-sm-4 form-control-label">* Cilindrada</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.nidcilindrada" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Transmisión</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidtransmision"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE UNA TRANSMISIÓN">
                                                                                                <el-option
                                                                                                    v-for="item in arrayTransmision"
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
                                                                                        <label class="col-sm-4 form-control-label">* Combustible</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-select v-model="fillNuevoVehiculo.nidcombustible"
                                                                                                        filterable
                                                                                                        clearable
                                                                                                        placeholder="SELECCIONE">
                                                                                                <el-option
                                                                                                    v-for="item in arrayCombustible"
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
                                                                                <!--<div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">*Fecha Venta</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillNuevoVehiculo.dfechaventa"
                                                                                                value-format="yyyy-MM-dd"
                                                                                                format="yyyy/MM/dd"
                                                                                                placeholder="">
                                                                                            </el-date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>-->
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Dúa</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnumerodua" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Motor</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnromotor" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Serie</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnroserie" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Rueda</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.cnrorueda" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Eje</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnroeje" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Potencia</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cpotencia" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Cilindros</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.cnrocilindros" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Asientos</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.cnroasiento" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° Pasajeros</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="number" v-model="fillNuevoVehiculo.cnropasajeros" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Peso Bruto</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Peso Bruto"
                                                                                                v-model="fillNuevoVehiculo.fpesobruto"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Peso Seco</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Peso Seco"
                                                                                                v-model="fillNuevoVehiculo.fpesoseco"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Altura</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Altura"
                                                                                                v-model="fillNuevoVehiculo.faltura"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Longitud</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Longitud"
                                                                                                v-model="fillNuevoVehiculo.flongitud"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Carga Útil</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Carga Útil"
                                                                                                v-model="fillNuevoVehiculo.fcargautil"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Ancho</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input-number
                                                                                                placeholder="Ancho"
                                                                                                v-model="fillNuevoVehiculo.fancho"
                                                                                                :min="1"
                                                                                                clearable>
                                                                                            </el-input-number>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--<div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Codigo Nacioens Unidas</label>
                                                                                        <div class="col-sm-8">
                                                                                            <input type="text" v-model="fillNuevoVehiculo.cnacionesunidas" class="form-control form-control-sm">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->
                                                                            <div class="form-group row">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click.prevent="activarTab0202">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabPropietario">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-12">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">
                                                                                        <strong>* Habilitar Formulario Nueva Persona?</strong>
                                                                                    </label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-checkbox v-model="checked" :label="checked ? 'Si' : 'No'"></el-checkbox>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <template v-if="checked">
                                                                            <ul class="nav nav-tabs">
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link" id="tab020201" href="#TabDatosPersonales" @click="tabDatosPersonales" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa-id-badge"></i> DATOS PERSONALES
                                                                                    </a>
                                                                                </li>
                                                                                <li class="nav-item">
                                                                                    <a class="nav-link disabled" id="tab020202" href="#TabDatosContacto" role="tab" data-toggle="tab">
                                                                                        <i class="fa fa fa-map-marker"></i> DATOS DE CONTACTO
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                            <div class="tab-content">
                                                                                <div class="tab-pane fade in active show" id="TabDatosPersonales">
                                                                                    <section class="forms">
                                                                                        <div class="container-fluid">
                                                                                            <div class="col-lg-12">
                                                                                                <form class="form-horizontal">
                                                                                                    <div v-if="nFlagEditar == 1 && cFlagTipoPersona == null || nFlagEditar == 2 && cFlagTipoPersona == null" class="form-group row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-md-4 form-control-label">*Tipo Persona</label>
                                                                                                                <div class="col-md-8">
                                                                                                                    <el-radio-group v-model="fillPropietario.ntipopersona" @change="cambiarTipoPersona">
                                                                                                                        <el-radio v-for="tipo in arrayTipoPersona" :key="tipo.id" :label="tipo.value"> {{ tipo.text }} </el-radio>
                                                                                                                    </el-radio-group>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">* Tipo Documento</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-select v-model="fillPropietario.ntpodocumento"
                                                                                                                                filterable
                                                                                                                                clearable
                                                                                                                                placeholder="Seleccione un Tipo de Documento">
                                                                                                                        <el-option
                                                                                                                        v-for="item in arrayTipoDocumento"
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
                                                                                                                <label class="col-sm-4 form-control-label">* Nro Documento</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        placeholder="Nro del Documento"
                                                                                                                        v-model="fillPropietario.cnrodocumento"
                                                                                                                        clearable>
                                                                                                                    </el-input>
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
                                                                                                                        <el-input
                                                                                                                            placeholder="Ingrese el Apellido Paterno"
                                                                                                                            v-model="fillPropietario.capepaterno"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label class="col-sm-4 form-control-label">* Apellido Materno</label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-input
                                                                                                                            placeholder="Ingrese el Apellido Materno"
                                                                                                                            v-model="fillPropietario.capematerno"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label v-text="fillPropietario.lblcnombres" class="col-sm-4 form-control-label"></label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-input
                                                                                                                            :placeholder="'Ingrese' + fillPropietario.lblcnombres"
                                                                                                                            v-model="fillPropietario.cnombre"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label class="col-sm-4 form-control-label">Fecha Nacimiento</label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-date-picker
                                                                                                                            v-model="fillPropietario.dfecnacimiento"
                                                                                                                            type="date"
                                                                                                                            value-format="yyyy-MM-dd"
                                                                                                                            format="dd/MM/yyyy"
                                                                                                                            placeholder="dd/mm/aaaa">
                                                                                                                        </el-date-picker>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </template>
                                                                                                    <template v-else>
                                                                                                        <div class="form-group row">
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label v-text="fillPropietario.lblcnombres" class="col-sm-4 form-control-label"></label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-input
                                                                                                                            :placeholder="'Ingrese' + fillPropietario.lblcnombres"
                                                                                                                            v-model="fillPropietario.cnombre"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </template>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-7 offset-sm-5">
                                                                                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab020202();">
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
                                                                                                                <label class="col-sm-4 form-control-label">* Ubigeo</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <div class="input-group">
                                                                                                                        <input type="text" v-model="fillPropietario.cubigeo" disabled="disabled" class="form-control form-control-sm">
                                                                                                                        <div class="input-group-prepend">
                                                                                                                            <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                                                <div slot="content">Buscar Ubigeo </div>
                                                                                                                                <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('ubigeo','buscar')">
                                                                                                                                    <i class="fa-lg fa fa-search"></i>
                                                                                                                                </button>
                                                                                                                            </el-tooltip>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">* Dirección</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese una Dirección'"
                                                                                                                        v-model="fillPropietario.cdireccion"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">* Email</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese un Email'"
                                                                                                                        v-model="fillPropietario.cmailprincipal"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">Email Alternativo</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese una Email Alternativo'"
                                                                                                                        v-model="fillPropietario.cmailalternativo"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">Telefono Fijo</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese un Telefono Fijo'"
                                                                                                                        v-model="fillPropietario.ctelefonofijo"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">* Celular</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese un N° Celular'"
                                                                                                                        v-model="fillPropietario.ncelular"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-group row">
                                                                                                        <div class="col-sm-6">
                                                                                                            <div class="row">
                                                                                                                <label class="col-sm-4 form-control-label">Celular Alternativo</label>
                                                                                                                <div class="col-sm-8">
                                                                                                                    <el-input
                                                                                                                        :placeholder="'Ingrese un N° Celular Alternativo'"
                                                                                                                        v-model="fillPropietario.ncelularalternativo"
                                                                                                                        clearable>
                                                                                                                    </el-input>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <template v-if="vistaDatosPersonaNatural">
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label class="col-sm-4 form-control-label">Estado Civil</label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-select v-model="fillPropietario.nestadocivil"
                                                                                                                                    filterable
                                                                                                                                    clearable
                                                                                                                                    placeholder="Seleccione un Estado Civil">
                                                                                                                            <el-option
                                                                                                                                v-for="item in arrayEstadoCivil"
                                                                                                                                :key="item.nIdPar"
                                                                                                                                :label="item.cParNombre"
                                                                                                                                :value="item.nIdPar">
                                                                                                                            </el-option>
                                                                                                                        </el-select>
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
                                                                                                                        <el-select v-model="fillPropietario.nprofesion"
                                                                                                                                    filterable
                                                                                                                                    clearable
                                                                                                                                    placeholder="Seleccione una Profesión" >
                                                                                                                            <el-option
                                                                                                                                v-for="item in arrayProfesion"
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
                                                                                                                    <label class="col-sm-4 form-control-label">Centro Laboral</label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-input
                                                                                                                            :placeholder="'Ingrese un Centro Laboral'"
                                                                                                                            v-model="fillPropietario.ccentrolaboral"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="form-group row">
                                                                                                            <div class="col-sm-6">
                                                                                                                <div class="row">
                                                                                                                    <label class="col-sm-4 form-control-label">Número de Licencia</label>
                                                                                                                    <div class="col-sm-8">
                                                                                                                        <el-input
                                                                                                                            :placeholder="'Número de Licencia'"
                                                                                                                            v-model="fillPropietario.cnrolicencia"
                                                                                                                            clearable>
                                                                                                                        </el-input>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </template>
                                                                                                </form>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-7 offset-sm-5">
                                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab0203();">
                                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                                    </button>
                                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarMaestroVehiculo(1)">
                                                                                                        <i class="fa fa-save"></i> Registrar
                                                                                                    </button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                        <template v-else>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Contacto</label>
                                                                                        <div class="col-sm-6" :class="[checked ? 'disabled' : '']">
                                                                                            <div class="input-group" :class="[checked ? 'disabled' : '']">
                                                                                                <input type="text" v-model="fillPropietario.cnombrecontacto" disabled="disabled" class="form-control form-control-sm">
                                                                                                <div class="input-group-prepend">
                                                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                                                        <div slot="content">Buscar Contacto</div>
                                                                                                        <button type="button" class="btn btn-info btn-corner btn-sm" @click="abrirModal('contacto','buscar')">
                                                                                                            <i class="fa-lg fa fa-search"></i>
                                                                                                        </button>
                                                                                                    </el-tooltip>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-12 offset-sm-5">
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="activarTab0203();">
                                                                                        <i class="fa fa-arrow-right"></i> Siguiente
                                                                                    </button>
                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarMaestroVehiculo(1)">
                                                                                        <i class="fa fa-save"></i> Registrar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </template>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                        <div role="tabpanel" class="tab-pane fade in active show" id="TabSoat">
                                                            <section class="forms">
                                                                <div class="container-fluid">
                                                                    <div class="col-lg-12">
                                                                        <form class="form-horizontal">
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* N° SOAT</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-input
                                                                                                placeholder="Número de SOAT"
                                                                                                v-model="fillSOAT.csoat"
                                                                                                clearable>
                                                                                            </el-input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">* Proveedor</label>
                                                                                        <div class="col-sm-8">
                                                                                            <div class="input-group">
                                                                                                <el-input placeholder="Seleccione un Proveedor" v-model="fillProveedor.cproveedornombre" :disabled="true" class="input-with-select" :clearable="true">
                                                                                                    <el-button slot="append" icon="el-icon-search" @click="abrirModal('proveedor','buscar')"></el-button>
                                                                                                </el-input>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Inicio</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillSOAT.dfechainicio"
                                                                                                type="date"
                                                                                                value-format="yyyy-MM-dd"
                                                                                                format="dd/MM/yyyy"
                                                                                                placeholder="dd/mm/aaaa">
                                                                                            </el-date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-6">
                                                                                    <div class="row">
                                                                                        <label class="col-sm-4 form-control-label">Fecha Fin</label>
                                                                                        <div class="col-sm-8">
                                                                                            <el-date-picker
                                                                                                v-model="fillSOAT.dfechafin"
                                                                                                type="date"
                                                                                                value-format="yyyy-MM-dd"
                                                                                                format="dd/MM/yyyy"
                                                                                                placeholder="dd/mm/aaaa">
                                                                                            </el-date-picker>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <div class="col-md-9 offset-md-5">
                                                                                    <button v-if="!arraySOAT.length" type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="agregarSOAT">
                                                                                        <i class="fa fa-plus"></i> Agregar
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="col-lg-12">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h3 class="h4">SOAT</h3>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <form class="form-horizontal">
                                                                                    <div class="col-lg-12">
                                                                                        <template v-if="arraySOAT.length">
                                                                                            <div class="table-responsive barraLateral">
                                                                                                <table class="table table-striped table-sm">
                                                                                                    <thead>
                                                                                                        <tr>
                                                                                                            <th>N° SOAT</th>
                                                                                                            <th>Proveedor</th>
                                                                                                            <th>Fecha Inicio</th>
                                                                                                            <th>Fecha Fin</th>
                                                                                                            <th>Estado</th>
                                                                                                            <th>Eliminar</th>
                                                                                                        </tr>
                                                                                                    </thead>
                                                                                                    <tbody>
                                                                                                        <tr v-for="(soat, index) in arraySOAT" :key="soat.nidsoat">
                                                                                                            <td v-text="soat.csoat"></td>
                                                                                                            <td v-text="soat.cproveedornombre"></td>
                                                                                                            <td v-text="soat.dfechainicio"></td>
                                                                                                            <td v-text="soat.dfechafin"></td>
                                                                                                            <td v-text="soat.cnombreestado"></td>
                                                                                                            <td>
                                                                                                                <a href="#" @click="removerSOAT(index);">
                                                                                                                    <i class='fa-md fa fa-trash'></i>
                                                                                                                </a>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tbody>
                                                                                                </table>
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="form-group row">
                                                                                                <div class="col-md-9 offset-md-5">
                                                                                                    <button type="button" class="btn btn-success btn-corner btn-sm" @click="registrarMaestroVehiculo(1)">
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
                                                                                </form>
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
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="h4">LISTA DE PROVEEDORES</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <label class="col-sm-4 form-control-label">Nombre</label>
                                                            <div class="col-sm-8">
                                                                <div class="input-group">
                                                                    <input type="text" v-model="fillProveedor.cproveedornombre" @keyup.enter="buscaProveedores" class="form-control form-control-sm">
                                                                    <div class="input-group-prepend">
                                                                        <button type="button" title="Buscar Proveedor" class="btn btn-info btn-corner btn-sm" @click="buscaProveedores">
                                                                            <i class="fa-lg fa fa-search"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr/>
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
                                                                        <a href="#" @click="asignarProveedor(proveedor)">
                                                                            <i class='fa-md fa fa-check-circle'></i>
                                                                        </a>
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
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-corner btn-sm" @click="cerrarModal()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Buscar Contactos -->
            <div class="modal fade" v-if="accionmodal==3" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">BUSQUEDA CONTACTOS</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Tipo Persona</label>
                                                        <div class="col-sm-8">
                                                            <label class="checkbox-inline" v-for="tipo in arrayTipoPersona" :key="tipo.id">
                                                                <input type="radio" class="radio-template" v-model="modalMisContactos.ntipopersona" :value="tipo.value" v-on:change="cambiarTipoPersonaMisContactos()">
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
                                                            <input type="text" v-model="modalMisContactos.cnrodocumento" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="row">
                                                        <label class="col-sm-4 form-control-label">* Nombres</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" v-model="modalMisContactos.cfiltrodescripcion" @keyup.enter="listarContactos(1)" class="form-control form-control-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="listarContactos(1);">
                                                        <i class="fa fa-search"></i> Buscar
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <br/>
                                        <template v-if="arrayContacto.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <template v-if="modalMisContactos.ntipopersona == 1">
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Contacto</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Dirección</th>
                                                                <th>Email</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cContacto }}</div>
                                                                        <i @click.prevent="asignarContacto(c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cContacto"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cDireccion"></td>
                                                                <td v-text="c.cEmail"></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                    <template v-else>
                                                        <thead>
                                                            <tr>
                                                                <th>Acciones</th>
                                                                <th>Razon Social</th>
                                                                <th>Nro Documento</th>
                                                                <th>Telefono</th>
                                                                <th>Email</th>
                                                                <th>Persona Contacto</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="c in arrayContacto" :key="c.nIdAsignacionContactoVendedor">
                                                                <td>
                                                                    <el-tooltip class="item" effect="dark" placement="top-start">
                                                                        <div slot="content">Seleccionar {{ c.cRazonSocial }}</div>
                                                                        <i @click.prevent="asignarContacto(c)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                    </el-tooltip>
                                                                </td>
                                                                <td v-text="c.cRazonSocial"></td>
                                                                <td v-text="c.cNumeroDocumento"></td>
                                                                <td v-text="c.nTelefonoMovil"></td>
                                                                <td v-text="c.cEmail"></td>
                                                                <td v-text="c.cContacto"></td>
                                                            </tr>
                                                        </tbody>
                                                    </template>
                                                </table>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <nav>
                                                            <ul class="pagination">
                                                                <li v-if="paginationModal.current_page > 1" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaMisContactos(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaMisContactos(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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

            <!-- Modal Ubigeo-->
            <div class="modal fade" v-if="accionmodal==5" :class="{ 'mostrar': modal }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="h4">UBIGEO</h3>
                                    </div>
                                    <div class="card-body">
                                        <form v-on:submit.prevent class="form-horizontal">
                                            <div class="form-group row">
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <el-select v-model="fillPropietario.nopcion" filterable clearable placeholder="SELECCIONE">
                                                                <el-option
                                                                v-for="item in arrayTipoUbigeo"
                                                                :key="item.value"
                                                                :label="item.text"
                                                                :value="item.value">
                                                                </el-option>
                                                            </el-select>
                                                        </div>
                                                        <div class="col-md-8" v-if="fillPropietario.nopcion != 0">
                                                            <input type="text" v-model="fillPropietario.cfiltro" class="form-control form-control-sm" @keyup.enter="llenarUbigeo(1)">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-9 offset-sm-5">
                                                    <button type="button" class="btn btn-primary btn-corner btn-sm" @click="llenarUbigeo(1)"><i class="fa fa-search"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </form>
                                        <template v-if="arrayUbigeo.length">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Acción</th>
                                                            <th>Código</th>
                                                            <th>Departamento</th>
                                                            <th>Provincia</th>
                                                            <th>Distrito</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="u in arrayUbigeo" :key="u.cCode">
                                                            <td>
                                                                <el-tooltip class="item" effect="dark" >
                                                                    <div slot="content">Asignar {{ u.cU_SYP_DIST }}</div>
                                                                    <i @click="asignarUbigeo(u)" :style="'color:#796AEE'" class="fa-md fa fa-check-circle"></i>
                                                                </el-tooltip>&nbsp;&nbsp;
                                                            </td>
                                                            <td v-text="u.cCode"></td>
                                                            <td v-text="u.cU_SYP_DEPA"></td>
                                                            <td v-text="u.cU_SYP_PROV"></td>
                                                            <td v-text="u.cU_SYP_DIST"></td>
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
                                                                    <a @click.prevent="cambiarPaginaUbigeo(paginationModal.current_page-1)" class="page-link" href="#">Ant</a>
                                                                </li>
                                                                <li  class="page-item" v-for="page in pagesNumberModal" :key="page"
                                                                :class="[page==isActivedModal?'active':'']">
                                                                    <a class="page-link"
                                                                    href="#" @click.prevent="cambiarPaginaUbigeo(page)"
                                                                    v-text="page"></a>
                                                                </li>
                                                                <li v-if="paginationModal.current_page < paginationModal.last_page" class="page-item">
                                                                    <a @click.prevent="cambiarPaginaUbigeo(paginationModal.current_page+1)" class="page-link" href="#">Sig</a>
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
                checked: true,
                // =============================================================
                // VARIABLES TAB BUSQUEDA VEHÍCULOS
                // =============================================================
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                fillBusquedaVehiculo: {
                    ntipopersona: '1',
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidaniomodelo: '',
                    dfechaventa: '',
                    cnombrecomercial: '',
                    cnumerovin: ''
                },
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioModelo: [],
                arrayVehiculoBuscar: [],
                // =============================================================
                // VARIABLES TAB NUEVO VEHÍCULOS
                // =============================================================
                // ======================================
                // VARIABLES SUBTAB VEHÍCULO
                // ======================================
                nFlagEditar: '',
                cFlagTipoPersona: null,
                fillNuevoVehiculo: {
                    nidcompra: 0,
                    nidvehiculo: '',
                    // cnroplaca: '',
                    // cnrotarjetapropiedad: '',
                    nidclase: '',
                    nidmarca: '',
                    nidmodelo: '',
                    cnombrecolor: '',
                    nidaniomodelo: '',
                    nidtranccion: '',
                    nidcategoria: '',
                    nidcilindrada: '',
                    nidtransmision:'',
                    nidcombustible: '',
                    dfechaventa: '',
                    cnromotor: '',
                    cnroserie: '',
                    cnrorueda: '',
                    cnroeje: '',
                    cpotencia: '',
                    cnrocilindros: '',
                    cnroasiento: '',
                    cnropasajeros: '',
                    fpesobruto: 0,
                    fpesoseco: 0,
                    faltura: 0,
                    flongitud: 0,
                    fcargautil: 0,
                    fancho: 0,
                    cnacionesunidas: '',
                    cnumerodua: ''
                },
                arrayClase: [],
                arrayColor: [],
                arrayTraccion: [],
                arrayCategoria: [],
                arrayCilindrada: [],
                arrayTransmision: [],
                arrayCombustible: [],
                // ======================================
                // VARIABLES SUBTAB PROPIETARIO
                // ======================================
                // =======================
                // SUBTAB DATOS PERSONALES
                // =======================
                fillPropietario: {
                    //Tab DATOS PERSONALES
                    nidpersona: '',
                    ntipopersona: '1',
                    ntpodocumento : '',
                    cnrodocumento : '',
                    capepaterno : '',
                    capematerno : '',
                    cnombre : '',
                    dfecnacimiento : '',
                    lblcnombres: '* Nombres',
                    //Tab DATOS DE CONTACTO
                    nidproveedor: '',
                    cproveedornombre: '',
                    cdireccion : '',
                    cmailprincipal : '',
                    cmailalternativo : '',
                    ctelefonofijo : '',
                    ncelular : '',
                    ncelularalternativo : '',
                    nestadocivil : '',
                    nprofesion : '',
                    ccentrolaboral : '',
                    cnrolicencia: '',
                    cubigeo: '',
                    nopcion: 0,
                    cfiltro: '',
                    cnombrecontacto: '',
                    cflagtipopersona: '',
                    nidpersonanatural: 0,
                    nidpersonajuridica: 0
                },
                arrayTipoDocumento: [],
                vistaDatosPersonaNatural: 1,
                arrayPropietario: [],
                // =======================
                // SUBTAB DATOS CONTACTO
                // =======================
                arrayDptos: [],
                arrayProv: [],
                arrayDist: [],
                arrayEstadoCivil: [],
                arrayProfesion: [],
                // ======================================
                // VARIABLES SUBTAB SOAT
                // ======================================
                fillSOAT: {
                    nidsoat: '',
                    csoat: '',
                    dfechainicio: '',
                    dfechafin: '',
                    nidestado: ''
                },
                fillProveedor:{
                    nidproveedor: 0,
                    cproveedornombre: ''
                },
                arrayProveedor: [],
                arraySOAT: [],
                // ======================================
                // VARIABLES UBIGEO
                // ======================================
                arrayUbigeo: [],
                arrayTipoUbigeo: [
                    { value: 0, text: 'TODO'},
                    { value: 1, text: 'DEPARTAMENTO'},
                    { value: 2, text: 'PROVINCIA'},
                    { value: 3, text: 'DISTRITO'}
                ],
                // ===============================
                // VARIABLES MODAL CONTACTO
                // ===============================
                modalMisContactos:{
                    ntipopersona: 1,
                    cnrodocumento: '',
                    cfiltrodescripcion: '',
                },
                arrayTipoPersona: [
                    { value: '1', text: 'NATURAL'},
                    { value: '2', text: 'JURIDICA'}
                ],
                arrayContacto: [],
                // =============================================================
                // VARIABLES GENÉRICAS
                // =============================================================
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
                accionmodal: 0,
                tituloModal:'',
                error: 0,
                errors: [],
                mensajeError: [],
                loading: false
            }
        },
        mounted() {
            this.tabBuscarVehiculo();
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
            },
        },
        methods: {
            // =================================================================
            // METODOS TAB BUSQUEDA VEHICULO
            // =================================================================
            tabBuscarVehiculo(){
                this.llenarComboMarca(1);
                this.llenarComboModelo(1);
                this.llenarComboAnioModelo();
                // this.buscarVehiculo();
            },
            limpiarTabVehiculos(){
                this.arrayVehiculoBuscar = [];
            },
            llenarComboMarca(data){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110032
                    }
                }).then(response => {
                    this.arrayMarca = response.data;
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
            llenarComboModelo(data, flag){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url,{
                    params: {
                        'nidmarca' : (data == 1) ? this.fillBusquedaVehiculo.nidmarca : this.fillNuevoVehiculo.nidmarca,
                        'opcion': 1
                    }
                }).then(response => {
                    this.arrayModelo = response.data.arrayModelo;
                    if(data == 1 && flag != 2) this.fillBusquedaVehiculo.nidmodelo=''
                    if(data == 2 && flag != 2) this.fillBusquedaVehiculo.nidmodelo=''
                    // (data == 1) ? this.fillBusquedaVehiculo.nidmodelo=0 : this.fillNuevoVehiculo.nidmodelo=0;
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
            llenarComboAnioModelo(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url,{
                    params: {
                        'ngrupoparid' : 110035
                    }
                }).then(response => {
                    this.arrayAnioModelo = response.data;
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
            buscarVehiculo(page){
                this.loading = true;
                var url = this.ruta + '/maestrovehiculo/GetDetalleMaestroVehiculo';
                axios.get(url, {
                    params: {
                        'nidempresa'            :   parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal'           :   parseInt(sessionStorage.getItem("nIdSucursal")),
                        'ntipopersona'          :   this.fillBusquedaVehiculo.ntipopersona,
                        'cnrodocumento'         :   String(this.fillBusquedaVehiculo.cnrodocumento.toString()),
                        'cfiltrodescripcion'    :   this.fillBusquedaVehiculo.cfiltrodescripcion.toString(),
                        'nidmarca'              :   this.fillBusquedaVehiculo.nidmarca,
                        'nidmodelo'             :   this.fillBusquedaVehiculo.nidmodelo,
                        'cnombrecomercial'      :   this.fillBusquedaVehiculo.cnombrecomercial,
                        'cnumerovin'            :   this.fillBusquedaVehiculo.cnumerovin,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculo;
                    this.arrayVehiculoBuscar        =   info.data;
                    //Pagination
                    this.pagination.current_page    =   info.current_page;
                    this.pagination.total           =   info.total;
                    this.pagination.per_page        =   info.per_page;
                    this.pagination.last_page       =   info.last_page;
                    this.pagination.from            =   info.from;
                    this.pagination.to              =   info.to;
                    this.loading = false;
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
            cambiarPaginaVehiculos(page){
                this.pagination.current_page=page;
                this.buscarVehiculo(page);
            },
            limpiarTabBusquedaVehiculo(){
                this.fillBusquedaVehiculo.ntipopersona = '1';
                this.fillBusquedaVehiculo.cnrodocumento = '';
                this.fillBusquedaVehiculo.cfiltrodescripcion = '';
                this.fillBusquedaVehiculo.nidmarca = '';
                this.fillBusquedaVehiculo.nidmodelo = '';
                this.fillBusquedaVehiculo.nidaniomodelo = '';
                this.fillBusquedaVehiculo.dfechaventa = '';
            },
            // =================================================================
            // METODOS TAB NUEVO VEHICULO
            // =================================================================
            /**
             * Si "data" es vacio y "op" es 1 viene de la selección del TAB Nuevo Vehículo
             * Si "data" no es vacio y "op" es 2 viene de presionar el botón "Editar"
             */
            tabNuevoVehiculo(data, op){
                this.nFlagEditar = op;
                this.tabVehiculo();
                this.limpiarTabBusquedaVehiculo();
                //this.llenarComboModelo(2);
                this.llenarComboColor();
                this.llenarComboAnioModelo();
                this.llenarComboTraccion();
                this.llenarComboCategoria();
                //this.llenarComboCilindrada();
                this.llenarComboTransmision();
                this.llenarComboCombustible();
                (this.nFlagEditar == 1) ? this.limpiarVehiculo(): this.cargarDatosEditar(data);
                this.llenarComboClase();
                this.llenarComboMarca(2);
                (this.nFlagEditar == 1) ? this.llenarComboModelo(2): this.llenarComboModelo(2,2);
                (this.nFlagEditar == 2) ? (this.checked = false) : (this.checked = true);
                this.fillPropietario.cnombrecontacto = data.cContacto;
                this.fillPropietario.cnombrecontacto = data.cContacto;
                this.fillPropietario.cflagtipopersona = data.cFlagTipoPersona;
                if(this.fillPropietario.cflagtipopersona == 'N'){
                    this.fillPropietario.nidpersonanatural = data.nIdPersona;
                }
                else{
                    this.fillPropietario.nidpersonajuridica = data.nIdPersona;
                }
            },
            // ================================
            // METODOS SUBTAB VEHICULO
            // ================================
            tabVehiculo(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link active');

                $('#TabBuscarVehiculo').removeClass('in active show');
                $('#TabNuevoVehiculo').addClass('in active show');

                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link active');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');
                $('#tab0203').removeClass('nav-link active');
                $('#tab0203').addClass('nav-link disabled');

                $('#TabVehiculo').addClass('in active show');
                $('#TabPropietario').removeClass('in active show');
                $('#TabSoat').removeClass("in active show");
            },
            llenarComboClase(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110030
                    }
                }).then(response => {
                    this.arrayClase = response.data;
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
            llenarComboColor(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110074
                    }
                }).then(response => {
                    this.arrayColor = response.data;
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
            llenarComboTraccion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110111
                    }
                }).then(response => {
                    this.arrayTraccion = response.data;
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
            llenarComboCategoria(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110117
                    }
                }).then(response => {
                    this.arrayCategoria = response.data;
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
            /*llenarComboCilindrada(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110114
                    }
                }).then(response => {
                    this.arrayCilindrada = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                });
            },*/
            llenarComboTransmision(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110115
                    }
                }).then(response => {
                    this.arrayTransmision = response.data;
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
            llenarComboCombustible(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110075
                    }
                }).then(response => {
                    this.arrayCombustible = response.data;
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
            activarTab0202(){
                if(this.validarTab0201()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link disabled');
                $('#tab0202').addClass('nav-link active');
                $('#tab0203').removeClass('nav-link active');
                $('#tab0203').addClass('nav-link disabled');

                $('#TabVehiculo').removeClass('in active show');
                $('#TabPropietario').addClass('in active show');
                $('#TabSoat').removeClass("in active show");
                this.tabPropietario();
            },
            validarTab0201(){
                this.error = 0;
                this.mensajeError =[];

                // if(!this.fillNuevoVehiculo.cnroplaca){
                //     this.mensajeError.push('Debes ingresar un número de placa');
                // };
                // if(this.fillNuevoVehiculo.cnroplaca){
                //     if(this.fillNuevoVehiculo.cnroplaca.length != 7){
                //         this.mensajeError.push('Ingrese un número de placa válido');
                //     };
                // }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ================================
            // METODOS SUBTAB PROPIETARIO
            // ================================
            tabPropietario(){
                (this.nFlagEditar == 1) ? this.limpiarPropietario(): '';
                this.tabDatosPersonales();
            },
            limpiarPropietario(){
                this.cFlagTipoPersona = null;//setear a null si se entra desde tab para mostrar el radio
                //Tab DATOS PERSONALES
                this.fillPropietario.nidpersona = ''
                this.fillPropietario.ntipopersona = '1'
                this.fillPropietario.ntpodocumento = '';
                this.fillPropietario.cnrodocumento = '';
                this.fillPropietario.capepaterno = '';
                this.fillPropietario.capematerno = '';
                this.fillPropietario.cnombre = '';
                this.fillPropietario.dfecnacimiento = '';
                this.cambiarTipoPersona();
                //Tab DATOS DE CONTACTO
                this.fillPropietario.ccode = '',
                this.fillPropietario.cubigeo = '',
                this.fillPropietario.cdireccion = '';
                this.fillPropietario.cmailprincipal = '';
                this.fillPropietario.cmailalternativo = '';
                this.fillPropietario.ctelefonofijo = '';
                this.fillPropietario.ncelular = '';
                this.fillPropietario.ncelularalternativo = '';
                this.fillPropietario.nestadocivil = '';
                this.fillPropietario.nprofesion = '';
                this.fillPropietario.ccentrolaboral = '';
                this.fillPropietario.cnrolicencia = '';
                //Tab DATOS SOAT
                this.fillSOAT.csoat = '';
                this.fillSOAT.dfechainicio = '';
                this.fillSOAT.dfechafin = '';
                this.fillSOAT.nidestado = '';
                this.fillProveedor.nidproveedor = 0;
                this.fillProveedor.cproveedornombre = '';
                this.arraySOAT = [];
            },
            // ===========================
            // SUBTAB - DATOS PERSONALES
            // ===========================
            tabDatosPersonales(){
                $('#tab020201').removeClass('nav-link active');
                $('#tab020201').addClass('nav-link active');
                $('#tab020202').removeClass('nav-link active');
                $('#tab020202').addClass('nav-link disabled');

                $('#TabDatosPersonales').addClass('in active show');
                $('#TabDatosContacto').removeClass('in active show');
                this.llenarComboTpoDocumento();
            },
            cambiarTipoPersona(){
                this.limpiarDatosPersonales();
                this.limpiarDatosContacto();
                this.limpiarSOAT();
                this.llenarComboTpoDocumento();
                if(this.fillPropietario.ntipopersona == '1') {
                    this.fillPropietario.lblcnombres = '* Nombres',
                    this.vistaDatosPersonaNatural = 1
                } else {
                    this.fillPropietario.lblcnombres = '* Razón Social',
                    this.vistaDatosPersonaNatural = 0
                }
            },
            llenarComboTpoDocumento(){
                if(this.fillPropietario.ntipopersona == 1) {
                    var url = this.ruta + '/parametro/GetDocumentoNatural';
                    axios.get(url,{
                        params: {
                            'ngrupoparid' : 110047,
                        }
                    }).then(response => {
                        this.arrayTipoDocumento = response.data;
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                } else {
                    var url = this.ruta + '/parametro/GetDocumentoJuridica';
                    axios.get(url,{
                        params: {
                            'ngrupoparid' : 110047,
                        }
                    }).then(response => {
                        this.arrayTipoDocumento = response.data;
                    }).catch(error => {
                        console.log(error);
                        if (error.response) {
                            if (error.response.status == 401) {
                                swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                                location.reload('0');
                            }
                        }
                    });
                }
            },
            limpiarDatosPersonales(){
                //Tab DATOS PERSONALES
                this.fillPropietario.ntpodocumento = '';
                this.fillPropietario.cnrodocumento = '';
                this.fillPropietario.capepaterno = '';
                this.fillPropietario.capematerno = '';
                this.fillPropietario.cnombre = '';
                this.fillPropietario.dfecnacimiento = '';
            },
            activarTab020202(){
                if(this.validarTab020201()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                $('#tab020201').removeClass('nav-link active');
                $('#tab020201').addClass('nav-link');
                $('#tab020202').removeClass('nav-link disabled');
                $('#tab020202').addClass('nav-link active');

                $('#TabDatosPersonales').removeClass('in active show');
                $('#TabDatosContacto').addClass('in active show');
                this.tabDatosContacto();
            },
            validarTab020201(){
                this.error = 0;
                this.mensajeError =[];

                let nrodocumento = this.fillPropietario.cnrodocumento;

                if(this.fillPropietario.ntpodocumento == 0) {
                    this.mensajeError.push('Debes Seleccionar Tipo Documento');
                }
                if(!nrodocumento){
                    this.mensajeError.push('Debes Ingresar Nro Documento');
                }
                if(this.fillPropietario.ntipopersona == 1) {
                    if(nrodocumento){
                        if(nrodocumento.length != 8) {
                            this.mensajeError.push('El Nro Documento debe contener 8 dígitos');
                        }
                    }

                    if(!this.fillPropietario.capepaterno){
                        this.mensajeError.push('Debes Ingresar Apellido Paterno');
                    }
                    if(!this.fillPropietario.capematerno){
                        this.mensajeError.push('Debes Ingresar Apellido Materno');
                    }
                    if(!this.fillPropietario.cnombre){
                        this.mensajeError.push('Debes Ingresar Nombres');
                    }
                    /*if(!this.fillPropietario.dfecnacimiento){
                        this.mensajeError.push('Debes Ingresar una Fecha de Nacimiento');
                    }

                    if(this.fillPropietario.dfecnacimiento){
                        let fecha_actual     = moment();
                        let fecha_nacimiento = moment(this.fillPropietario.dfecnacimiento);
                        if(fecha_actual.diff(fecha_nacimiento, 'days') < 0){
                            this.mensajeError.push('La Fecha de Nacimiento debe ser menor a la fecha de Actual');
                        }
                    }*/
                }
                if(this.fillPropietario.ntipopersona == 2) {
                    if(nrodocumento.length != 11) {
                        this.mensajeError.push('El Nro Documento debe contener 11 números');
                    }
                    if(nrodocumento){
                        if(!this.fillPropietario.cnombre){
                            this.mensajeError.push('Debes Ingresar Razon Social');
                        }
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ===========================
            // SUBTAB - DATOS CONTACTO
            // ===========================
            tabDatosContacto(){
                /*this.llenarComboDptos();
                this.llenarComboProv();
                this.llenarComboDist();*/
                this.llenarComboEstadoCivil();
                this.llenarComboProfesion();
            },
            limpiarDatosContacto(){
                //Tab DATOS DE CONTACTO
                this.fillPropietario.ccode = '';
                this.fillPropietario.cubigeo = '';
                this.fillPropietario.cdireccion = '';
                this.fillPropietario.cmailprincipal = '';
                this.fillPropietario.cmailalternativo = '';
                this.fillPropietario.ctelefonofijo = '';
                this.fillPropietario.ncelular = '';
                this.fillPropietario.ncelularalternativo = '';
                this.fillPropietario.nestadocivil = '';
                this.fillPropietario.nprofesion = '';
                this.fillPropietario.ccentrolaboral = '';
                this.fillPropietario.cnrolicencia = '';
            },
            llenarUbigeo(page){
                //var url = this.ruta + '/ubigeo/SapGetUbigeo';
                var url = this.ruta + '/ubigeo/GetUbigeo';
                axios.get(url, {
                    params: {
                        'nopcion': this.fillPropietario.nopcion,
                        'cfiltro': this.fillPropietario.cfiltro.toUpperCase().toString(),
                        'page': page
                    }
                }).then(response => {
                    this.arrayUbigeo = response.data.arrayUbigeo.data;
                    this.paginationModal.current_page =  response.data.arrayUbigeo.current_page;
                    this.paginationModal.total = response.data.arrayUbigeo.total;
                    this.paginationModal.per_page    = response.data.arrayUbigeo.per_page;
                    this.paginationModal.last_page   = response.data.arrayUbigeo.last_page;
                    this.paginationModal.from        = response.data.arrayUbigeo.from;
                    this.paginationModal.to           = response.data.arrayUbigeo.to;
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
            cambiarPaginaUbigeo(page){
                this.paginationModal.current_page=page;
                this.llenarUbigeo(page);
            },
            asignarUbigeo(u){
                this.fillPropietario.cubigeo = u.cU_SYP_DEPA + ' - ' + u.cU_SYP_PROV + ' - ' + u.cU_SYP_DIST;
                this.fillPropietario.ccode = u.cCode;
                this.fillPropietario.cdepartamento = u.cU_SYP_DEPA;
                this.fillPropietario.cprovincia = u.cU_SYP_PROV;
                this.fillPropietario.cdistrito = u.cU_SYP_DIST;
                this.cerrarModal();
            },
            llenarComboEstadoCivil(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110048
                    }
                }).then(response => {
                    this.arrayEstadoCivil = response.data;
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
            llenarComboProfesion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid' : 110049
                    }
                }).then(response => {
                    this.arrayProfesion = response.data;
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
            activarTab0203(){
                if(this.validarTab0202()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link');
                $('#tab0203').removeClass('nav-link disabled');
                $('#tab0203').addClass('nav-link active');

                $('#TabVehiculo').removeClass('in active show');
                $('#TabPropietario').removeClass('in active show');
                $('#TabSoat').addClass("in active show");
                this.tabSoat();
            },
            validarTab0202(){
                this.error = 0;
                this.mensajeError =[];

                if(this.checked==true){
                    if(this.fillPropietario.ccode == 0 || !this.fillPropietario.ccode){
                    this.mensajeError.push('Debe Seleccionar Ubigeo');
                    }
                    if(!this.fillPropietario.cdireccion){
                        this.mensajeError.push('Debes Ingresar Dirección');
                    }
                    if(this.fillPropietario.cmailprincipal){
                        if (!this.validarEmail(this.fillPropietario.cmailprincipal)) {
                            this.mensajeError.push('Debe ingresar un correo electronico válido.');
                        }
                    }
                    if(!this.fillPropietario.ncelular){
                        this.mensajeError.push('Debes Ingresar Celular');
                    }
                    if(this.fillPropietario.ncelular){
                        if(this.fillPropietario.ncelular.length > 9){
                            this.mensajeError.push('El numero de Celular es incorrecto');
                        }
                    }
                }
                if(this.checked==false){
                    if(this.fillPropietario.nidpersonanatural==0 && this.fillPropietario.nidpersonajuridica==0){
                        this.mensajeError.push('Debes seleccionar un Contacto');
                    }
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            validarEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            // ================================
            // METODOS SUBTAB SOAT
            // ================================
            tabSoat(){},
            limpiarSOAT(){
                //Tab DATOS SOAT
                this.fillSOAT.nidsoat = '';
                this.fillSOAT.csoat = '';
                this.fillSOAT.dfechainicio = '';
                this.fillSOAT.dfechafin = '';
                this.fillSOAT.nidestado = '';
                this.fillProveedor.nidproveedor = 0;
                this.fillProveedor.cproveedornombre = '';
                this.arraySOAT = [];
            },
            buscaProveedores(){
                this.listarProveedores(1);
            },
            listarProveedores(page){
                var url = this.ruta + '/parametro/GetListParametroByGrupo';
                axios.get(url, {
                    params: {
                        'ngrupoparid'   : 110076,
                        'cparnombre'    : this.fillProveedor.cproveedornombre.toString(),
                        'opcion'        : 0,
                        'page'          : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayParametro.data;
                    this.paginationModal.current_page   =  response.data.arrayParametro.current_page;
                    this.paginationModal.total          = response.data.arrayParametro.total;
                    this.paginationModal.per_page       = response.data.arrayParametro.per_page;
                    this.paginationModal.last_page      = response.data.arrayParametro.last_page;
                    this.paginationModal.from           = response.data.arrayParametro.from;
                    this.paginationModal.to             = response.data.arrayParametro.to;
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
            asignarProveedor(objProveedor){
                this.fillProveedor.nidproveedor = objProveedor.nIdPar;
                this.fillProveedor.cproveedornombre = objProveedor.cParNombre;
                this.cerrarModal();
            },
            agregarSOAT(){
                if(this.validarAgregarSOAT()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                let fecha_actual   = moment();
                let fecha_fin      = moment(this.fillSOAT.dfechafin);

                this.arraySOAT.push({
                    nidsoat             : this.fillSOAT.nidsoat,
                    csoat               : this.fillSOAT.csoat,
                    cproveedornombre    : this.fillProveedor.cproveedornombre,
                    dfechainicio        : this.fillSOAT.dfechainicio,
                    dfechafin           : this.fillSOAT.dfechafin,
                    cnombreestado       : (fecha_actual.diff(fecha_fin, 'days') <= 0) ? 'Activo' : 'Inactivo',
                    nidestado           : (fecha_actual.diff(fecha_fin, 'days') <= 0) ? 'A' : 'I'
                });
                toastr.success('Se Agregó el SOAT');
            },
            validarAgregarSOAT(){
                this.error = 0;
                this.mensajeError =[];

                if(!this.fillSOAT.csoat){
                    this.mensajeError.push('El número de SOAT es obligatorio');
                }
                if(this.fillSOAT.csoat.length != 8){
                    this.mensajeError.push('Ingrese un SOAT válido');
                }
                if(!this.fillProveedor.cproveedornombre || this.fillProveedor.nidproveedor == 0){
                    this.mensajeError.push('Debe seleccionar un proveedor');
                }
                if(!this.fillSOAT.dfechainicio){
                    this.mensajeError.push('La Fecha de inicio es un campo oblitagorio');
                }
                if(!this.fillSOAT.dfechafin){
                    this.mensajeError.push('La Fecha de fin es un campo oblitagorio');
                }

                let fecha_ini = moment(this.fillSOAT.dfechainicio);
                let fecha_fin = moment(this.fillSOAT.dfechafin);

                if(fecha_fin.diff(fecha_ini, 'days') < 0){
                    this.mensajeError.push('La Fecha de Fin no puede ser menor a la fecha de inicio');
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            removerSOAT(index){
                this.$delete(this.arraySOAT, index);
            },
            /**
             * REGISTRA EL MAESTRO VEHÍCULO
             */
            registrarMaestroVehiculo(){
                if(this.validarRegistroMaestroVehiculo()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                this.mostrarProgressBar();

                var url = this.ruta + '/maestrovehiculo/SetRegistrarVehiculoPlaca';
                axios.post(url, {
                    'fillNuevoVehiculo' : this.fillNuevoVehiculo,
                    'nFlagEditar'       : this.nFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        //Si el Contacto esta marcado como nuevo, se registra en la DB
                        if(this.checked == true) {
                            this.registrarNuevoContacto(response.data[0].nIdVehiculoPlaca);
                        } else {
                            //Sino se encuentra el propietario en la bandeja de contactos
                            this.registrarPropietario(response.data[0].nIdVehiculoPlaca);
                        }
                    } else {
                        swal('Ocurrio un error al registrar el vehículo');
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
            /**
             * REGISTRA EL NUEVO CONTACTO
             */
            registrarNuevoContacto(data){
                if (this.fillPropietario.ntipopersona == "1") {
                    this.registrarPersonaNatural(data);
                } else {
                    this.registrarPersonaJuridica(data);
                }
            },
            /**
             * REGISTRA CONTACTO NATURAL
             */
            registrarPersonaNatural(data){
                var url = this.ruta + '/maestrovehiculo/SetRegistrarPerNatural';
                axios.post(url, {
                    fillPropietario     :   this.fillPropietario,
                    nIdVehiculoPlaca    :   data,
                    nFlagEditar         :   this.nFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        if(this.arraySOAT.length > 0) {
                            this.registrarSOAT(data);
                        } else {
                            this.actualizarSapSetArticulo();
                            swal('El proceso fue registrado existosamente');
                        }
                    }else{
                        swal('El contacto ya se encuentra en nuestro registros');
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
            /**
             * REGISTRA CONTACTO JURIDICO
             */
            registrarPersonaJuridica(data){
                var url = this.ruta + '/maestrovehiculo/SetRegistrarPerJuridica';
                axios.post(url, {
                    fillPropietario     :   this.fillPropietario,
                    nIdVehiculoPlaca    :   data,
                    nFlagEditar         :   this.nFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarSOAT(data);
                    }else{
                        swal('El contacto ya se encuentra en nuestro registros');
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
            /**
             * REGISTRA SOAT
             */
            registrarSOAT(data){
                var url = this.ruta + '/maestrovehiculo/SetRegistrarSoat';
                axios.post(url, {
                    arraySOAT           :   this.arraySOAT,
                    fillProveedor       :   this.fillProveedor,
                    nIdVehiculoPlaca    :   data,
                    nFlagEditar         :   this.nFlagEditar
                }).then(response => {
                    this.actualizarSapSetArticulo();
                    // this.limpiarVehiculo();
                    // this.limpiarPropietario();
                    // this.reiniciarTabs();
                    swal('El proceso fue registrado existosamente');
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
            actualizarSapSetArticulo(){
                let me = this;
                me.loadingProgressBar("ACTUALIZANDO DATOS DEL VEHÍCULO EN SAP BUSINESS ONE...");

                var url = this.ruta + '/articulo/SapPatchArticuloAll';
                axios.post(url, {
                    fillNuevoVehiculo   :   this.fillNuevoVehiculo
                }).then(response => {
                    // console.log(response.data);
                    $("#myBar").hide();
                    me.loading.close();
                    swal('El proceso fue registrado existosamente');
                    this.limpiarVehiculo();
                    this.limpiarPropietario();
                    this.reiniciarTabs();
                    this.buscarVehiculo();
                }).catch(error => {
                    $("#myBar").hide();
                    swal({
                        type: 'error',
                        title: 'Error...',
                        text: 'Error al Generar la Actualizaciòn de Datos del Vehiculo en SapB1!',
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
            limpiarVehiculo(){
                this.fillNuevoVehiculo.nidvehiculo = '';
                // this.fillNuevoVehiculo.cnroplaca = '';
                // this.fillNuevoVehiculo.cnrotarjetapropiedad = '';
                this.fillNuevoVehiculo.nidclase = '';
                this.fillNuevoVehiculo.nidmarca = '';
                this.fillNuevoVehiculo.nidmodelo = '';
                this.fillNuevoVehiculo.cnombrecolor = '';
                this.fillNuevoVehiculo.nidaniomodelo = '';
                this.fillNuevoVehiculo.nidtranccion = '';
                this.fillNuevoVehiculo.nidcategoria = '';
                this.fillNuevoVehiculo.nidcilindrada = '';
                this.fillNuevoVehiculo.nidtransmision = '';
                this.fillNuevoVehiculo.nidcombustible = '';
                this.fillNuevoVehiculo.dfechaventa = '';
                this.fillNuevoVehiculo.cnrocilindros = '';
                this.fillNuevoVehiculo.cnrorueda = '';
                this.fillNuevoVehiculo.cnroeje = '';
                this.fillNuevoVehiculo.cpotencia = '';
                this.fillNuevoVehiculo.cnroserie = '';
                this.fillNuevoVehiculo.cnropasajeros = '';
                this.fillNuevoVehiculo.cnroasiento = '';
                this.fillNuevoVehiculo.fpesoseco = '';
                this.fillNuevoVehiculo.fpesobruto = '';
                this.fillNuevoVehiculo.flongitud = '';
                this.fillNuevoVehiculo.faltura = '';
                this.fillNuevoVehiculo.fancho = '';
                this.fillNuevoVehiculo.fcargautil = '';
                this.fillNuevoVehiculo.cnacionesunidas = '';
            },
            reiniciarTabs(){
                $('#tab01').removeClass('nav-link active');
                $('#tab01').addClass('nav-link active');
                $('#tab02').removeClass('nav-link active');
                $('#tab02').addClass('nav-link');

                $('#TabBuscarVehiculo').addClass('in active show');
                $('#TabNuevoVehiculo').removeClass('in active show');

                $('#tab0201').removeClass('nav-link active');
                $('#tab0201').addClass('nav-link');
                $('#tab0202').removeClass('nav-link active');
                $('#tab0202').addClass('nav-link disabled');
                $('#tab0203').removeClass('nav-link active');
                $('#tab0203').addClass('nav-link disabled');

                $('#TabVehiculo').removeClass('in active show');
                $('#TabPropietario').removeClass('in active show');
                $('#TabSoat').removeClass("in active show");
                this.tabBuscarVehiculo();
            },
            validarRegistroMaestroVehiculo(){
                this.error = 0;
                this.mensajeError =[];

                // if(this.arraySOAT.length > 0){
                //     this.mensajeError.push('Debe agregar un SOAT');
                // };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cargarDatosEditar(data){
                // console.log(data);
                this.limpiarVehiculo();
                this.limpiarPropietario();
                this.limpiarSOAT();

                let me = this;

                this.cFlagTipoPersona = data['cFlagTipoPersona'];//Capturo el Flag para saber si es PN, PJ o Libre

                //CAPTURAR DATOS DEL VEHICULO
                this.fillNuevoVehiculo.nidvehiculo          =   data['nIdVehiculoPlaca'];
                // this.fillNuevoVehiculo.cnroplaca            =   data['cPlaca'];
                // this.fillNuevoVehiculo.cnrotarjetapropiedad =   data['cNroTarjeta'];
                this.fillNuevoVehiculo.nidclase             =   (data['nIdClaseVehiculo'] == 0) ? '' : data['nIdClaseVehiculo'];
                this.fillNuevoVehiculo.nidmarca             =   (data['nIdMarca'] == 0) ? '' : data['nIdMarca'];
                this.fillNuevoVehiculo.nidmodelo            =   (data['nIdModelo'] == 0) ? '' : data['nIdModelo'];
                this.fillNuevoVehiculo.cnombrecolor         =   (data['cNombreColor'] == '') ? '' : data['cNombreColor'];
                this.fillNuevoVehiculo.nidaniomodelo        =   data['nAnioModelo'];
                this.fillNuevoVehiculo.nidtranccion         =   (data['nIdTraccion'] == 0) ? '' : data['nIdTraccion'];
                this.fillNuevoVehiculo.nidcategoria         =   (data['nIdCategoria'] == 0) ? '' : data['nIdCategoria'];
                this.fillNuevoVehiculo.nidcilindrada        =   (data['nIdCilindrada'] == 0) ? '' : data['nIdCilindrada'];
                this.fillNuevoVehiculo.nidtransmision       =   (data['nIdTransmision'] == 0) ? '' : data['nIdTransmision'];
                this.fillNuevoVehiculo.nidcombustible       =   (data['nIdCombustible'] == 0) ? '' : data['nIdCombustible'];
                this.fillNuevoVehiculo.dfechaventa          =   data['dFechaVenta'];
                this.fillNuevoVehiculo.cnromotor            =   (data['cNumeroMotor'] == 0) ? '' : data['cNumeroMotor'];
                this.fillNuevoVehiculo.cnumerodua           =   (data['cNumeroDua'] == '') ? '' : data['cNumeroDua'];
                this.fillNuevoVehiculo.cnroserie            =   (data['cNumeroVin'] == '') ? '' : data['cNumeroVin'] ;
                this.fillNuevoVehiculo.cnrorueda            =   (data['nNumeroRueda'] == 0) ? '' : data['nNumeroRueda'];
                this.fillNuevoVehiculo.cnroeje              =   (data['nNumeroEje'] == 0) ? '' : data['nNumeroEje'];
                this.fillNuevoVehiculo.cpotencia            =   (data['nPotencia'] == 0) ? '' : data['nPotencia'];
                this.fillNuevoVehiculo.cnrocilindros        =   (data['nNumeroCilindro'] == 0) ? '' : data['nNumeroCilindro'];
                this.fillNuevoVehiculo.cnroasiento          =   (data['nNumeroAsiento'] == 0) ? '' : data['nNumeroAsiento'];
                this.fillNuevoVehiculo.cnropasajeros        =   (data['nNumeroPasajero'] == 0) ? '' : data['nNumeroPasajero'] ;
                this.fillNuevoVehiculo.fpesobruto           =   data['fPesoBruto'];
                this.fillNuevoVehiculo.fpesoseco            =   data['fPesoSeco'];
                this.fillNuevoVehiculo.faltura              =   data['fAltura'];
                this.fillNuevoVehiculo.fancho               =   data['fAncho'];
                this.fillNuevoVehiculo.flongitud            =   data['fLongitud'];
                this.fillNuevoVehiculo.fcargautil           =   data['fCargaUtil'];
                /*this.fillNuevoVehiculo.cnacionesunidas      =   data['cCodigoNaciones'];/**/

                //CAPTURAR DATOS DE LA PERSONA NATURAL
                if (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) {
                    this.fillPropietario.nidpersona             =   (data['nIdPersona'] == undefined) ? '' : data['nIdPersona'];
                    this.fillPropietario.ntipopersona           =   (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? '1': '2';
                    this.vistaDatosPersonaNatural               =   (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? 1 : 0;
                    this.fillPropietario.ntpodocumento          =   data['nIdTipoDocumento'];
                    this.fillPropietario.cnrodocumento          =   data['cNumeroDocumento'];
                    this.fillPropietario.capepaterno            =   data['cApellidoPaterno'];
                    this.fillPropietario.capematerno            =   data['cApellidoMaterno'];
                    this.fillPropietario.cnombre                =   data['cNombre'];
                    this.fillPropietario.dfecnacimiento         =   data['dFechaNacimiento'];
                    this.fillPropietario.lblcnombres            =   (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? '* Nombres': '* Razón Social';
                    this.fillPropietario.ccode                  =   data['cCode'];
                    this.fillPropietario.cubigeo                =   data['cUbigeo'];
                    this.fillPropietario.cdireccion             =   data['cDireccion'];
                    this.fillPropietario.cmailprincipal         =   data['cEmail'];
                    this.fillPropietario.cmailalternativo       =   data['cEmailAlternativo'];
                    this.fillPropietario.ctelefonofijo          =   data['cTelefonoFijo'];
                    this.fillPropietario.ncelular               =   data['nTelefonoMovil'];
                    this.fillPropietario.ncelularalternativo    =   data['nTelefonoMovilAlternativo'];
                    this.fillPropietario.nestadocivil           =   (data['nIdEstadoCivil'] == 0 || data['nIdEstadoCivil'] == undefined) ? '' : data['nIdEstadoCivil'];
                    this.fillPropietario.nprofesion             =   (data['nIdProfesion'] == 0 || data['nIdProfesion'] == undefined) ? '' : data['nIdProfesion'];
                    this.fillPropietario.ccentrolaboral         =   (data['cCentroLaboral'] == 0 || data['cCentroLaboral'] == undefined) ? '' : data['cCentroLaboral'];
                    this.fillPropietario.cnrolicencia           =   (data['cNumeroLicenciaConducir'] == 0 || data['cNumeroLicenciaConducir'] == undefined) ? '' : data['cNumeroLicenciaConducir'];
                } else {
                    ///CAPTURAR DATOS DE LA PERSONA JURIDICA
                    this.fillPropietario.nidpersona             =   (data['nIdPersona'] == undefined) ? '' : data['nIdPersona'];
                    this.fillPropietario.ntipopersona           =   (data['cFlagTipoPersona'] == 'J') ? '2': '1';
                    this.llenarComboTpoDocumento();//cargo el listado de documentos de tipo juridico
                    this.vistaDatosPersonaNatural               =   (data['cFlagTipoPersona'] == 'J') ? 0 : 1;
                    this.fillPropietario.cnrodocumento          =   data['cRuc'];
                    this.fillPropietario.cnombre                =   data['cRazonSocial'];
                    this.fillPropietario.lblcnombres            =   (data['cFlagTipoPersona'] == 'J') ? '* Razón Social': '* Nombres';
                    this.fillPropietario.ccode                  =   data['cCode'];
                    this.fillPropietario.cubigeo                =   data['cUbigeo'];
                    this.fillPropietario.cdireccion             =   data['cDireccion'];
                    this.fillPropietario.cmailprincipal         =   data['cEmail'];
                    this.fillPropietario.cmailalternativo       =   data['cEmailAlternativo'];
                    this.fillPropietario.ctelefonofijo          =   data['cTelefonoFijo'];
                    this.fillPropietario.ncelular               =   data['nTelefonoMovil'];
                    this.fillPropietario.ncelularalternativo    =   data['nTelefonoMovilAlternativo'];

                    setTimeout(function() {
                        me.setearTipoDocumento(data)//Asignar idTipoDocumento cuando es del Rol Juridico despues de 2.5 seg (esperar a que cargue la lista de tipos de documento)
                    }, 3800);
                }

                //CAPTURAR DATOS DEL SOAT
                if (data['cNumeroSoat'] != null) {
                    this.fillSOAT.nidsoat               =   (data['nIdSoatVehiculo'] == undefined) ? '' : data['nIdSoatVehiculo'];
                    this.fillSOAT.csoat                 =   data['cNumeroSoat'];
                    this.fillSOAT.dfechainicio          =   data['dFechaInicioSOAT'];
                    this.fillSOAT.dfechafin             =   data['dFechaFinSOAT'];
                    this.fillSOAT.nidestado             =   data['cFlagEstadoActivoSOAT'];
                    this.fillProveedor.nidproveedor     =   data['nIdProveedorSOAT'];
                    this.fillProveedor.cproveedornombre =   data['cNombreProveedorSOAT'];

                    this.arraySOAT.push({
                        nidsoat             : this.fillSOAT.nidsoat,
                        csoat               : this.fillSOAT.csoat,
                        cproveedornombre    : this.fillProveedor.cproveedornombre,
                        dfechainicio        : this.fillSOAT.dfechainicio,
                        dfechafin           : this.fillSOAT.dfechafin,
                        cnombreestado       : (this.fillSOAT.nidestado == 'A') ? 'Activo' : 'Inactivo',
                        nidestado           : this.fillSOAT.nidestado
                    });
                }

                this.fillNuevoVehiculo.nidcompra  = data.nIdCompra;
                this.cargarDataPlantilla(data.nIdCompra);
            },
            setearTipoDocumento(data){
                let me = this;
                this.$nextTick().then(function () {
                    // console.log(me.arrayTipoDocumento[1]);
                    me.fillPropietario.ntpodocumento = me.arrayTipoDocumento[1].nIdPar;//asigno el tipo de documento RUC
                })
            },
            cargarDataPlantilla(nIdCompra){
                var url = this.ruta + '/maestrovehiculo/GetDataPlantilla';
                axios.get(url, {
                    params: {
                        'nIdCompra' : nIdCompra
                    }
                }).then(response => {
                    if (response.data.length > 0) {
                        //CAPTURAR DATOS DEL VEHICULO
                        this.fillNuevoVehiculo.nidclase             =   (response.data[0]['nIdCarroceria'] == 0) ? '' : response.data[0]['nIdCarroceria'];
                        this.fillNuevoVehiculo.nidtranccion         =   (response.data[0]['nIdTraccion'] == 0) ? '' : response.data[0]['nIdTraccion'];
                        this.fillNuevoVehiculo.nidcategoria         =   (response.data[0]['nIdCategoria'] == 0) ? '' : response.data[0]['nIdCategoria'];
                        this.fillNuevoVehiculo.nidcilindrada        =   (response.data[0]['nIdCilindrada'] == 0) ? '' : response.data[0]['nIdCilindrada'];
                        this.fillNuevoVehiculo.nidtransmision       =   (response.data[0]['nIdTransmision'] == 0) ? '' : response.data[0]['nIdTransmision'];
                        this.fillNuevoVehiculo.nidcombustible       =   (response.data[0]['nIdCombustible'] == 0) ? '' : response.data[0]['nIdCombustible'];
                        this.fillNuevoVehiculo.cnrorueda            =   (response.data[0]['nNroRuedas'] == 0) ? '' : response.data[0]['nNroRuedas'];
                        this.fillNuevoVehiculo.cnroeje              =   (response.data[0]['nNroEjes'] == 0) ? '' : response.data[0]['nNroEjes'];
                        this.fillNuevoVehiculo.cpotencia            =   (response.data[0]['nNroPotencia'] == 0) ? '' : response.data[0]['nNroPotencia'];
                        this.fillNuevoVehiculo.cnrocilindros        =   (response.data[0]['nNroCilindros'] == 0) ? '' : response.data[0]['nNroCilindros'];
                        this.fillNuevoVehiculo.cnroasiento          =   (response.data[0]['nNroAsientos'] == 0) ? '' : response.data[0]['nNroAsientos'];
                        this.fillNuevoVehiculo.faltura              =   response.data[0]['fAltura'];
                        this.fillNuevoVehiculo.flongitud            =   response.data[0]['fLongitud'];
                        this.fillNuevoVehiculo.facncho              =   response.data[0]['fAncho'];
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
            // ======================
            // MODAL BUSCAR CONTACTOS
            // ======================
            cambiarTipoPersonaMisContactos(){
                this.arrayContacto = [];
                this.cambiarPaginaMisContactos(1);
            },
            cambiarPaginaMisContactos(page){
                this.paginationModal.current_page=page;
                this.listarContactos(page);
            },
            listarContactos(page){
                var url = this.ruta + '/persona/GetLstPersona';
                axios.get(url, {
                    params: {
                        'nidempresa' : parseInt(sessionStorage.getItem("nIdEmpresa")),
                        'nidsucursal' : parseInt(sessionStorage.getItem("nIdSucursal")),
                        'ntipopersona' : this.modalMisContactos.ntipopersona,
                        'cnrodocumento' : String(this.modalMisContactos.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.modalMisContactos.cfiltrodescripcion.toString(),
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayPersona;
                    this.arrayContacto                = info.data;
                    this.paginationModal.current_page =  info.current_page;
                    this.paginationModal.total        = info.total;
                    this.paginationModal.per_page     = info.per_page;
                    this.paginationModal.last_page    = info.last_page;
                    this.paginationModal.from         = info.from;
                    this.paginationModal.to           = info.to;
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
            asignarContacto(objContacto){
                if(this.modalMisContactos.ntipopersona == 1){
                    this.fillPropietario.cflagtipopersona   =   'N',
                    this.fillPropietario.nidpersonanatural  =   objContacto.nIdPersonaNatural,
                    this.fillPropietario.nidpersonajuridica =   0,
                    this.fillPropietario.cnombrecontacto    =   objContacto.cContacto
                }else{
                    this.fillPropietario.cflagtipopersona   =   'J',
                    this.fillPropietario.nidpersonanatural  =   0,
                    this.fillPropietario.nidpersonajuridica =   objContacto.nIdPersonaJuridica,
                    this.fillPropietario.cnombrecontacto    =   objContacto.cContacto
                }
                this.cerrarModal();
                this.arrayContacto = [];
            },
            /**
             * REGISTRA PROPIETARIO
             */
            registrarPropietario(data){
                if(this.validarRegistroPropietario()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }
                var url = this.ruta + '/maestrovehiculo/SetRegistrarPropietario';
                axios.post(url, {
                    'cFlagTipoPersona'    : this.fillPropietario.cflagtipopersona,
                    'nIdPersonaNatural'   : this.fillPropietario.nidpersonanatural,
                    'nIdPersonaJuridica'  : this.fillPropietario.nidpersonajuridica,
                    'nIdVehiculoPlaca'    : data,
                    'nFlagEditar'         : this.nFlagEditar
                }).then(response => {
                    if(this.arraySOAT.length > 0) {
                        this.registrarSOAT(data);
                    } else {
                        this.actualizarSapSetArticulo();
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
            validarRegistroPropietario(){
                $("#myBar").hide();
                this.error = 0;
                this.mensajeError =[];

                // if(this.arraySOAT.length > 0){
                //     this.mensajeError.push('Debe agregar un SOAT');
                // };
                if(!this.fillPropietario.cnombrecontacto){
                    this.mensajeError.push('Debe seleccionar un Propietario');
                }
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // =================================================================
            // METODOS GENERICOS
            // =================================================================
            abrirModal(modelo, accion, data =[]){
                switch(modelo){
                    case "proveedor":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.listarProveedores(1);
                                this.accionmodal=2;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case 'ubigeo':
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=5;
                                this.modal = 1;
                                break;
                            }
                        }
                    }
                    break;
                    case "contacto":
                    {
                        switch(accion){
                            case 'buscar':
                            {
                                this.accionmodal=3;
                                this.modal = 1;
                                break;
                            }
                            break;
                        }
                    }
                }
            },
            //Limpiar Paginación
            limpiarPaginacion(){
                this.pagination.current_page =  0,
                this.pagination.total = 0,
                this.pagination.per_page = 0,
                this.pagination.last_page = 0,
                this.pagination.from  = 0,
                this.pagination.to = 0
            },
            limpiarPaginacionModal(){
                this.paginationModal.current_page =  0,
                this.paginationModal.total = 0,
                this.paginationModal.per_page = 0,
                this.paginationModal.last_page = 0,
                this.paginationModal.from  = 0,
                this.paginationModal.to = 0
            },
            //Cerrar Modal
            cerrarModal(){
                this.modal = 0;
                this.accionmodal = 0;
                this.error = 0;
                this.mensajeError = '';
                this.limpiarPaginacion();
                this.limpiarPaginacionModal();
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
        text-align: center;
        margin: auto;
    }
    .input-with-select .el-input-group__prepend {
        background-color: #fff;
    }
    .el-input-number{
        width: 100% !important;
    }
</style>
