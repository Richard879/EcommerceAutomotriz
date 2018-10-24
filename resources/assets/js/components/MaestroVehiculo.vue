<template>
    <main>
        <header class="page-header">
            <div class="container-fluid">
                <h2 class="no-margin-bottom"> MAESTRO VEHÍCULO</h2>
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
                                        <i class="fa fa-list-alt"></i> NUEVO VEHÍCULO
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
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <div class="row">
                                                                        <label class="col-md-4 form-control-label">*Tipo Persona</label>
                                                                        <div class="col-md-8 widthFull">
                                                                            <el-radio-group v-model="fillBusquedaVehiculo.ntipopersona">
                                                                                <el-radio v-for="tipo in arrayTipoPersona" :key="tipo.id" :label="tipo.value"> {{ tipo.text }} </el-radio>
                                                                            </el-radio-group>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Contacto</label>
                                                                        <div class="col-sm-8">
                                                                            <el-input
                                                                                placeholder="Nombre del Contacto"
                                                                                v-model="fillBusquedaVehiculo.cfiltrodescripcion"
                                                                                clearable>
                                                                            </el-input>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Nro Documento</label>
                                                                        <div class="col-sm-8">
                                                                            <el-input
                                                                                placeholder="Número de Documento"
                                                                                v-model="fillBusquedaVehiculo.cnrodocumento"
                                                                                clearable>
                                                                            </el-input>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-6">
                                                                    <div class="row">
                                                                        <label class="col-sm-4 form-control-label">Marca</label>
                                                                        <div class="col-sm-8 widthFull">
                                                                            <el-select v-model="fillBusquedaVehiculo.nidmarca"
                                                                                        filterable
                                                                                        clearable
                                                                                        placeholder="Seleccione una Marca"
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
                                                                        <div class="col-sm-8 widthFull">
                                                                            <el-select v-model="fillBusquedaVehiculo.nidmodelo"
                                                                                        filterable
                                                                                        clearable
                                                                                        placeholder="Seleccione un Modelo" >
                                                                                <el-option
                                                                                v-for="item in arrayModelo"
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
                                                                        <label class="col-sm-4 form-control-label">Año Fabricación</label>
                                                                        <div class="col-sm-8 widthFull">
                                                                            <el-select v-model="fillBusquedaVehiculo.nidaniofabricacion"
                                                                                        filterable
                                                                                        clearable
                                                                                        placeholder="Seleccione un Año de Fabricación">
                                                                                <el-option
                                                                                v-for="item in arrayAnioFabricacion"
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
                                                                        <label class="col-sm-4 form-control-label">*Fecha Venta</label>
                                                                        <div class="col-sm-8 widthFull">
                                                                            <el-date-picker
                                                                                v-model="fillBusquedaVehiculo.dfechaventa"
                                                                                value-format="yyyy-MM-dd"
                                                                                format="yyyy/MM/dd"
                                                                                type="date"
                                                                                placeholder="Seleccionar fecha de venta">
                                                                            </el-date-picker>
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
                                                                    <div class="table-responsive barraLateral">
                                                                        <el-table v-loading="loading" :data="arrayVehiculoBuscar" style="width: 100%">
                                                                            <el-table-column  property="cPlaca"   label="Placa"   width="100"></el-table-column>
                                                                            <el-table-column  property="cAnioFab"   label="Año Fabricación"   width="100"></el-table-column>
                                                                            <el-table-column  property="cMarca"   label="Marca"   width="120"></el-table-column>
                                                                            <el-table-column  property="cModelo"   label="Modelo"   width="170"></el-table-column>
                                                                            <el-table-column  property="cNroSerie"   label="Serie"   width="100"></el-table-column>
                                                                            <el-table-column  property="cNroTarjeta"   label="Tarjeta"   width="90"></el-table-column>
                                                                            <el-table-column  property="cPropietario"   label="Propietario"   width="130"></el-table-column>
                                                                            <el-table-column  property="cNroIdentificacion"   label="D.Identificación"  width="80"></el-table-column>
                                                                            <el-table-column  property="cNroCelular"   label="Celular"   width="80"></el-table-column>
                                                                            <el-table-column  property="cEstado"   label="SOAT"   show-overflow-tooltip></el-table-column>
                                                                            <el-table-column  fixed="right"   label="Acciones"   width="80">
                                                                                <template slot-scope="scope">
                                                                                    <el-tooltip class="item"
                                                                                                effect="dark"
                                                                                                content="Editar"
                                                                                                placement="top-start">
                                                                                        <el-button @click="tabNuevoVehiculo(scope.row, 2)"><i class="fa fa-edit"></i></el-button>
                                                                                    </el-tooltip>
                                                                                </template>
                                                                            </el-table-column>
                                                                        </el-table>
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
                                                                        <div class="form-group row">
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
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Clase</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidclase"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione una Clase">
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
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidmarca"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione una Marca"
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
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidmodelo"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione una Modelo">
                                                                                            <el-option
                                                                                            v-for="item in arrayModelo"
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
                                                                                    <label class="col-sm-4 form-control-label">* Color</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidcolor"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione una Color">
                                                                                            <el-option
                                                                                            v-for="item in arrayColor"
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
                                                                                    <label class="col-sm-4 form-control-label">* Año Fabricacion</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidaniofabricacion"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione un Año de Fabricacion">
                                                                                            <el-option
                                                                                            v-for="item in arrayAnioFabricacion"
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
                                                                                    <label class="col-sm-4 form-control-label">*Fecha Venta</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-date-picker
                                                                                            v-model="fillNuevoVehiculo.dfechaventa"
                                                                                            value-format="yyyy-MM-dd"
                                                                                            format="yyyy/MM/dd"
                                                                                            type="date"
                                                                                            placeholder="Seleccionar fecha de venta">
                                                                                        </el-date-picker>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* Combustible</label>
                                                                                    <div class="col-sm-8 widthFull">
                                                                                        <el-select v-model="fillNuevoVehiculo.nidcombustible"
                                                                                                    filterable
                                                                                                    clearable
                                                                                                    placeholder="Seleccione una Combustible">
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
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Motor</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Motor"
                                                                                            type="number"
                                                                                            v-model="fillNuevoVehiculo.cnromotor"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Serie</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Serie"
                                                                                            type="text"
                                                                                            v-model="fillNuevoVehiculo.cnroserie"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Rueda</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Rueda"
                                                                                            type="text"
                                                                                            v-model="fillNuevoVehiculo.cnrorueda"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Cilindros</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Cilindros"
                                                                                            type="number"
                                                                                            v-model="fillNuevoVehiculo.cnrocilindros"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Asientos</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Asientos"
                                                                                            type="number"
                                                                                            v-model="fillNuevoVehiculo.cnroasiento"
                                                                                            clearable>
                                                                                        </el-input>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <div class="col-sm-6">
                                                                                <div class="row">
                                                                                    <label class="col-sm-4 form-control-label">* N° Pasajeros</label>
                                                                                    <div class="col-sm-8">
                                                                                        <el-input
                                                                                            placeholder="Número de Pasajeros"
                                                                                            type="number"
                                                                                            v-model="fillNuevoVehiculo.cnropasajeros"
                                                                                            clearable>
                                                                                        </el-input>
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
                                                                        <div class="form-group row">
                                                                            <div class="col-md-9 offset-md-5">
                                                                                <button type="button" class="btn btn-primary btn-corner btn-sm" @click.prevent="activarTab0202">
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
                                                                                            <div v-if="cFlagEditar == 1 && cFlagTipoPersona == null || cFlagEditar == 2 && cFlagTipoPersona == null" class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-md-4 form-control-label">*Tipo Persona</label>
                                                                                                        <div class="col-md-8 widthFull">
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
                                                                                                        <div class="col-sm-8 widthFull">
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
                                                                                                        <label class="col-sm-4 form-control-label">* Departamento</label>
                                                                                                        <div class="col-sm-8 widthFull">
                                                                                                            <el-select v-model="fillPropietario.niddepartamento"
                                                                                                                        filterable
                                                                                                                        clearable
                                                                                                                        placeholder="Seleccione un Departamento"
                                                                                                                        v-on:change="llenarComboProv()">
                                                                                                                <el-option
                                                                                                                    v-for="item in arrayDptos"
                                                                                                                    :key="item.id"
                                                                                                                    :label="item.text"
                                                                                                                    :value="item.id">
                                                                                                                </el-option>
                                                                                                            </el-select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-sm-4 form-control-label">* Provincia</label>
                                                                                                        <div class="col-sm-8 widthFull">
                                                                                                            <el-select v-model="fillPropietario.nidprovincia"
                                                                                                                        filterable
                                                                                                                        clearable
                                                                                                                        placeholder="Seleccione una Provincia"
                                                                                                                        v-on:change="llenarComboDist()">
                                                                                                                <el-option
                                                                                                                    v-for="item in arrayProv"
                                                                                                                    :key="item.id"
                                                                                                                    :label="item.text"
                                                                                                                    :value="item.id">
                                                                                                                </el-option>
                                                                                                            </el-select>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <div class="col-sm-6">
                                                                                                    <div class="row">
                                                                                                        <label class="col-sm-4 form-control-label">* Distrito</label>
                                                                                                        <div class="col-sm-8 widthFull">
                                                                                                            <el-select v-model="fillPropietario.niddistrito"
                                                                                                                        filterable
                                                                                                                        clearable
                                                                                                                        placeholder="Seleccione un Distrito" >
                                                                                                                <el-option
                                                                                                                    v-for="item in arrayDist"
                                                                                                                    :key="item.id"
                                                                                                                    :label="item.text"
                                                                                                                    :value="item.id">
                                                                                                                </el-option>
                                                                                                            </el-select>
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
                                                                                                            <div class="col-sm-8 widthFull">
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
                                                                                                            <div class="col-sm-8 widthFull">
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
                                                                    <a href="#" @click="asignarProveedor(proveedor.nIdPar, proveedor.cParNombre);">
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
    </main>
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return {
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
                    nidaniofabricacion: '',
                    dfechaventa: ''
                },
                arrayMarca: [],
                arrayModelo: [],
                arrayAnioFabricacion: [],
                arrayVehiculoBuscar: [],
                // =============================================================
                // VARIABLES TAB NUEVO VEHÍCULOS
                // =============================================================
                // ======================================
                // VARIABLES SUBTAB VEHÍCULO
                // ======================================
                cFlagEditar: '',
                cFlagTipoPersona: null,
                fillNuevoVehiculo: {
                    nidvehiculo: '',
                    cnroplaca: '',
                    cnrotarjetapropiedad: '',
                    nidclase: '',
                    nidmarca: '',
                    nidmodelo: '',
                    nidcolor: '',
                    nidaniofabricacion: '',
                    dfechaventa: '',
                    nidcombustible: '',
                    cnromotor: '',
                    cnroserie: '',
                    cnrorueda: '',
                    cnrocilindros: '',
                    cnroasiento: '',
                    cnropasajeros: '',
                    fpesobruto: 0,
                    fpesoseco: 0,
                    faltura: 0,
                    flongitud: 0,
                    fcargautil: 0,
                    fancho: 0
                },
                arrayClase: [],
                arrayColor: [],
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
                    niddepartamento : '',
                    nidprovincia : '',
                    niddistrito : '',
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
                },
                arrayTipoDocumento: [],
                vistaDatosPersonaNatural: 1,
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
                this.llenarComboAnioFabricacion();
                this.buscarVehiculo();
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
                });
            },
            llenarComboModelo(data, flag){
                var url = this.ruta + '/versionvehiculo/GetModeloByMarca';
                axios.get(url,{
                    params: {
                        'nidmarca' : (data == 1) ? this.fillBusquedaVehiculo.nidmarca : this.fillNuevoVehiculo.nidmarca
                    }
                }).then(response => {
                    this.arrayModelo = response.data;
                    if(data == 1 && flag != 2) this.fillBusquedaVehiculo.nidmodelo=''
                    if(data == 2 && flag != 2) this.fillBusquedaVehiculo.nidmodelo=''
                    // (data == 1) ? this.fillBusquedaVehiculo.nidmodelo=0 : this.fillNuevoVehiculo.nidmodelo=0;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboAnioFabricacion(){
                var url = this.ruta + '/parametro/GetParametroByGrupo';
                axios.get(url,{
                    params: {
                        'ngrupoparid' : 110034
                    }
                }).then(response => {
                    this.arrayAnioFabricacion = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            buscarVehiculo(page){
                this.loading = true;
                var url = this.ruta + '/maestrovehiculo/GetDetalleMaestroVehiculo';
                axios.get(url, {
                    params: {
                        'ntipopersona' : this.fillBusquedaVehiculo.ntipopersona,
                        'cnrodocumento' : String(this.fillBusquedaVehiculo.cnrodocumento.toString()),
                        'cfiltrodescripcion' : this.fillBusquedaVehiculo.cfiltrodescripcion.toString(),
                        'nidmarca' : this.fillBusquedaVehiculo.nidmarca,
                        'nidmodelo' : this.fillBusquedaVehiculo.nidmodelo,
                        'nidaniofabricacion' : this.fillBusquedaVehiculo.nidaniofabricacion,
                        'dfechaventa' : this.fillBusquedaVehiculo.dfechaventa,
                        'page' : page
                    }
                }).then(response => {
                    let info = response.data.arrayVehiculo;
                    this.arrayVehiculoBuscar    = info.data;
                    //Pagination
                    this.pagination.current_page   =   info.current_page;
                    this.pagination.total          =   info.total;
                    this.pagination.per_page       =   info.per_page;
                    this.pagination.last_page      =   info.last_page;
                    this.pagination.from           =   info.from;
                    this.pagination.to             =   info.to;
                    this.loading = false;
                }).catch(error => {
                    console.log(error);
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
                this.fillBusquedaVehiculo.nidaniofabricacion = '';
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
                this.cFlagEditar = op;
                this.tabVehiculo();
                this.limpiarTabBusquedaVehiculo();
                //this.llenarComboModelo(2);
                this.llenarComboColor();
                this.llenarComboAnioFabricacion();
                this.llenarComboCombustible();
                (this.cFlagEditar == 1) ? this.limpiarVehiculo(): this.cargarDatosEditar(data);
                this.llenarComboClase();
                this.llenarComboMarca(2);
                (this.cFlagEditar == 1) ? this.llenarComboModelo(2): this.llenarComboModelo(2,2);
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
                        'ngrupoparid' : 110029
                    }
                }).then(response => {
                    this.arrayClase = response.data;
                }).catch(error => {
                    console.log(error);
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

                if(!this.fillNuevoVehiculo.cnroplaca){
                    this.mensajeError.push('Debes ingresar un número de placa');
                };
                if(this.fillNuevoVehiculo.cnroplaca){
                    if(this.fillNuevoVehiculo.cnroplaca.length != 7){
                        this.mensajeError.push('Ingrese un número de placa válido');
                    };
                }

                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            // ================================
            // METODOS SUBTAB PROPIETARIO
            // ================================
            tabPropietario(){
                (this.cFlagEditar == 1) ? this.limpiarPropietario(): '';
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
                this.fillPropietario.niddepartamento = '';
                this.fillPropietario.nidprovincia = '';
                this.fillPropietario.niddistrito = '';
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
                    if(!this.fillPropietario.dfecnacimiento){
                        this.mensajeError.push('Debes Ingresar una Fecha de Nacimiento');
                    }

                    if(this.fillPropietario.dfecnacimiento){
                        let fecha_actual     = moment();
                        let fecha_nacimiento = moment(this.fillPropietario.dfecnacimiento);
                        if(fecha_actual.diff(fecha_nacimiento, 'days') < 0){
                            this.mensajeError.push('La Fecha de Nacimiento debe ser menor a la fecha de Actual');
                        }
                    }
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
                this.llenarComboDptos();
                this.llenarComboProv();
                this.llenarComboDist();
                this.llenarComboEstadoCivil();
                this.llenarComboProfesion();
            },
            limpiarDatosContacto(){
                //Tab DATOS DE CONTACTO
                this.fillPropietario.niddepartamento = '';
                this.fillPropietario.nidprovincia = '';
                this.fillPropietario.niddistrito = '';
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
            llenarComboDptos(){
                var url = this.ruta + '/ubigeo/GetDptos';
                axios.get(url).then(response => {
                    this.arrayDptos = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboProv(){
                var url = this.ruta + '/ubigeo/GetProvinciasByDpto';
                axios.get(url, {
                    params: {
                        'niddepartamento' : this.fillPropietario.niddepartamento
                    }
                }).then(response => {
                    this.arrayProv = response.data;
                    (this.cFlagEditar == 1) ? this.fillPropietario.nidprovincia = 0 : ''
                    this.arrayDist = [];
                    this.llenarComboDist();
                }).catch(error => {
                    console.log(error);
                });
            },
            llenarComboDist(){
                var url = this.ruta + '/ubigeo/GetDistritosByProv';
                axios.get(url, {
                    params: {
                        'nidprovincia' : this.fillPropietario.nidprovincia
                    }
                }).then(response => {
                    this.arrayDist = response.data;
                    (this.cFlagEditar == 1) ? this.fillPropietario.niddistrito = 0 : ''
                }).catch(error => {
                    console.log(error);
                });
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

                if(!this.fillPropietario.niddepartamento){
                    this.mensajeError.push('Debes Seleccionar Departamento');
                }
                if(!this.fillPropietario.nidprovincia){
                    this.mensajeError.push('Debes Seleccionar Provincia');
                }
                if(!this.fillPropietario.niddistrito){
                    this.mensajeError.push('Debes Seleccionar Distrito');
                }
                if(!this.fillPropietario.cdireccion){
                    this.mensajeError.push('Debes Ingresar Dirección');
                }
                if(!this.fillPropietario.cmailprincipal){
                    this.mensajeError.push('El correo es obligatorio');
                } else if (!this.validarEmail(this.fillPropietario.cmailprincipal)) {
                    this.errors.push('Debe ingresar un correo electronico válido.');
                }
                if(!this.fillPropietario.ncelular){
                    this.mensajeError.push('Debes Ingresar Celular');
                }
                if(this.fillPropietario.ncelular){
                    if(this.fillPropietario.ncelular.length > 9){
                        this.mensajeError.push('El numero de Celular es incorrecto');
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
                var url = this.ruta + '/parametro/GetLstProveedor';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidgrupopar' : 110076,
                        'cnombreproveedor' : this.fillProveedor.cproveedornombre.toString(),
                        'opcion' : 0,
                        'page' : page
                    }
                }).then(response => {
                    this.arrayProveedor = response.data.arrayProveedor.data;
                    this.paginationModal.current_page   =  response.data.arrayProveedor.current_page;
                    this.paginationModal.total          = response.data.arrayProveedor.total;
                    this.paginationModal.per_page       = response.data.arrayProveedor.per_page;
                    this.paginationModal.last_page      = response.data.arrayProveedor.last_page;
                    this.paginationModal.from           = response.data.arrayProveedor.from;
                    this.paginationModal.to             = response.data.arrayProveedor.to;
                }).catch(error => {
                    console.log(error);
                });
            },
            cambiarPaginaProveedor(page){
                this.paginationModal.current_page=page;
                this.listarProveedores(page);
            },
            asignarProveedor(nProveedorId, cProveedorNombre){
                this.fillProveedor.nidproveedor = nProveedorId;
                this.fillProveedor.cproveedornombre = cProveedorNombre;
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
                var url = this.ruta + '/maestrovehiculo/SetRegistrarVehiculoPlaca';
                axios.post(url, {
                    fillNuevoVehiculo : this.fillNuevoVehiculo,
                    cFlagEditar       : this.cFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarNuevoContacto(response.data[0].nIdVehiculoPlaca);
                    }else{
                        swal('Ocurrio un error al registrar el vehículo');
                    }
                }).catch(error => {
                    console.log(error);
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
                    cFlagEditar         :   this.cFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarSOAT(data);
                    }else{
                        swal('El contacto ya se encuentra en nuestro registros');
                    }
                }).catch(error => {
                    console.log(error);
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
                    cFlagEditar         :   this.cFlagEditar
                }).then(response => {
                    if(response.data[0].nFlagMsje==1){
                        this.registrarSOAT(data);
                    }else{
                        swal('El contacto ya se encuentra en nuestro registros');
                    }
                }).catch(error => {
                    console.log(error);
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
                    cFlagEditar         :   this.cFlagEditar
                }).then(response => {
                    this.limpiarVehiculo();
                    this.limpiarPropietario();
                    this.reiniciarTabs();
                    swal('El proceso fue registrado existosamente');
                }).catch(error => {
                    console.log(error);
                });
            },
            limpiarVehiculo(){
                this.fillNuevoVehiculo.nidvehiculo = '';
                this.fillNuevoVehiculo.cnroplaca = '';
                this.fillNuevoVehiculo.cnrotarjetapropiedad = '';
                this.fillNuevoVehiculo.nidclase = '';
                this.fillNuevoVehiculo.nidmarca = '';
                this.fillNuevoVehiculo.nidmodelo = '';
                this.fillNuevoVehiculo.nidcolor = '';
                this.fillNuevoVehiculo.nidaniofabricacion = '';
                this.fillNuevoVehiculo.nidcombustible = '';
                this.fillNuevoVehiculo.dfechaventa = '';
                this.fillNuevoVehiculo.cnrocilindros = '';
                this.fillNuevoVehiculo.cnrorueda = '';
                this.fillNuevoVehiculo.cnroserie = '';
                this.fillNuevoVehiculo.cnropasajeros = '';
                this.fillNuevoVehiculo.cnroasiento = '';
                this.fillNuevoVehiculo.fpesoseco = '';
                this.fillNuevoVehiculo.fpesobruto = '';
                this.fillNuevoVehiculo.flongitud = '';
                this.fillNuevoVehiculo.faltura = '';
                this.fillNuevoVehiculo.fancho = '';
                this.fillNuevoVehiculo.fcargautil = '';
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

                if(this.arraySOAT.length == 0){
                    this.mensajeError.push('Debe agregar un SOAT');
                };
                if(this.mensajeError.length){
                    this.error = 1;
                }
                return this.error;
            },
            cargarDatosEditar(data){
                this.limpiarVehiculo();
                this.limpiarPropietario();
                this.limpiarSOAT();

                let me = this;

                this.cFlagTipoPersona = data['cFlagTipoPersona'];//Cpaturo el Flag para saber si es PN, PJ o Libre

                //CAPTURAR DATOS DEL VEHICULO
                this.fillNuevoVehiculo.nidvehiculo = data['nIdVehiculoPlaca'];
                this.fillNuevoVehiculo.cnroplaca = data['cPlaca'];
                this.fillNuevoVehiculo.cnrotarjetapropiedad = data['cNroTarjeta'];
                this.fillNuevoVehiculo.nidclase = (data['nIdClaseVehiculo'] == 0) ? '' : data['nIdClaseVehiculo'];
                this.fillNuevoVehiculo.nidmarca = (data['nIdMarca'] == 0) ? '' : data['nIdMarca'];
                this.fillNuevoVehiculo.nidmodelo = (data['nIdModelo'] == 0) ? '' : data['nIdModelo'];
                this.fillNuevoVehiculo.nidcolor = (data['nIdColor'] == 0) ? '' : data['nIdColor'];
                this.fillNuevoVehiculo.nidaniofabricacion = data['nAnioFabricacion'];
                this.fillNuevoVehiculo.dfechaventa = data['dFechaVenta'];
                this.fillNuevoVehiculo.nidcombustible = (data['nIdCombustible'] == 0) ? '' : data['nIdCombustible'];
                this.fillNuevoVehiculo.cnromotor = (data['cNumeroMotor'] == 0) ? '' : data['cNumeroMotor'];
                this.fillNuevoVehiculo.cnroserie = (data['cNroSerie'] == 0) ? '' : data['cNroSerie'] ;
                this.fillNuevoVehiculo.cnrorueda = (data['nNumeroRueda'] == 0) ? '' : data['nNumeroRueda'];
                this.fillNuevoVehiculo.cnrocilindros = (data['nNumeroCilindro'] == 0) ? '' : data['nNumeroCilindro'];
                this.fillNuevoVehiculo.cnroasiento = (data['nNumeroAsiento'] == 0) ? '' : data['nNumeroAsiento'];
                this.fillNuevoVehiculo.cnropasajeros = (data['nNumeroPasajero'] == 0) ? '' : data['nNumeroPasajero'] ;
                this.fillNuevoVehiculo.fpesobruto = data['fPesoBruto'];
                this.fillNuevoVehiculo.fpesoseco = data['fPesoSeco'];
                this.fillNuevoVehiculo.faltura = data['fAltura'];
                this.fillNuevoVehiculo.flongitud = data['fLongitud'];
                this.fillNuevoVehiculo.fcargautil = data['fCargaUtil'];

                //CAPTURAR DATOS DEL A PERSONA NATURAL
                if (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) {
                    this.fillPropietario.nidpersona = (data['nIdPersonaNatural'] == undefined) ? '' : data['nIdPersonaNatural'];
                    this.fillPropietario.ntipopersona = (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? '1': '2';
                    this.vistaDatosPersonaNatural = (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? 1 : 0;
                    this.fillPropietario.ntpodocumento = data['nIdTipoDocumento'];
                    this.fillPropietario.cnrodocumento = data['cNumeroDocumento'];
                    this.fillPropietario.capepaterno = data['cApellidoPaterno'];
                    this.fillPropietario.capematerno = data['cApellidoMaterno'];
                    this.fillPropietario.cnombre = data['cNombre'];
                    this.fillPropietario.dfecnacimiento = data['dFechaNacimiento'];
                    this.fillPropietario.lblcnombres = (data['cFlagTipoPersona'] == 'N' || data['cFlagTipoPersona'] == null) ? '* Nombres': '* Razón Social';
                    this.fillPropietario.niddepartamento = data['nIdDepartamento'];
                    this.fillPropietario.nidprovincia = data['nIdProvincia'];
                    this.fillPropietario.niddistrito = data['nIdDistrito'];
                    this.fillPropietario.cdireccion = data['cDireccion'];
                    this.fillPropietario.cmailprincipal = data['cEmail'];
                    this.fillPropietario.cmailalternativo = data['cEmailAlternativo'];
                    this.fillPropietario.ctelefonofijo = data['cTelefonoFijo'];
                    this.fillPropietario.ncelular = data['nTelefonoMovil'];
                    this.fillPropietario.ncelularalternativo = data['nTelefonoMovilAlternativo'];
                    this.fillPropietario.nestadocivil = (data['nIdEstadoCivil'] == 0 || data['nIdEstadoCivil'] == undefined) ? '' : data['nIdEstadoCivil'];
                    this.fillPropietario.nprofesion = (data['nIdProfesion'] == 0 || data['nIdProfesion'] == undefined) ? '' : data['nIdProfesion'];
                    this.fillPropietario.ccentrolaboral = (data['cCentroLaboral'] == 0 || data['cCentroLaboral'] == undefined) ? '' : data['cCentroLaboral'];
                    this.fillPropietario.cnrolicencia = (data['cNumeroLicenciaConducir'] == 0 || data['cNumeroLicenciaConducir'] == undefined) ? '' : data['cNumeroLicenciaConducir'];
                } else {
                    ///CAPTURAR DATOS DE LA PERSONA JURIDICA
                    this.fillPropietario.nidpersona = (data['nIdPersonaJuridica'] == undefined) ? '' : data['nIdPersonaJuridica'];
                    this.fillPropietario.ntipopersona = (data['cFlagTipoPersona'] == 'J') ? '2': '1';
                    this.llenarComboTpoDocumento();//cargo el listado de documentos de tipo juridico
                    this.vistaDatosPersonaNatural = (data['cFlagTipoPersona'] == 'J') ? 0 : 1;
                    this.fillPropietario.cnrodocumento = data['cRuc'];
                    this.fillPropietario.cnombre = data['cRazonSocial'];
                    this.fillPropietario.lblcnombres = (data['cFlagTipoPersona'] == 'J') ? '* Razón Social': '* Nombres';
                    this.fillPropietario.niddepartamento = data['nIdDepartamento'];
                    this.fillPropietario.nidprovincia = data['nIdProvincia'];
                    this.fillPropietario.niddistrito = data['nIdDistrito'];
                    this.fillPropietario.cdireccion = data['cDireccion'];
                    this.fillPropietario.cmailprincipal = data['cEmail'];
                    this.fillPropietario.cmailalternativo = data['cEmailAlternativo'];
                    this.fillPropietario.ctelefonofijo = data['cTelefonoFijo'];
                    this.fillPropietario.ncelular = data['nTelefonoMovil'];
                    this.fillPropietario.ncelularalternativo = data['nTelefonoMovilAlternativo'];

                    setTimeout(function() {
                        me.setearTipoDocumento(data)//Asignar idTipoDocumento cuando es del Rol Juridico despues de 2.5 seg (esperar a que cargue la lista de tipos de documento)
                    }, 3800);
                }

                //CAPTURAR DATOS DEL SOAT
                if (data['cNumeroSoat'] != null) {
                    this.fillSOAT.nidsoat = (data['nIdSoatVehiculo'] == undefined) ? '' : data['nIdSoatVehiculo'];
                    this.fillSOAT.csoat = data['cNumeroSoat'];
                    this.fillSOAT.dfechainicio = data['dFechaInicioSOAT'];
                    this.fillSOAT.dfechafin = data['dFechaFinSOAT'];
                    this.fillSOAT.nidestado = data['cFlagEstadoActivoSOAT'];
                    this.fillProveedor.nidproveedor = data['nIdProveedorSOAT'];
                    this.fillProveedor.cproveedornombre = data['cNombreProveedorSOAT'];

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
            },
            setearTipoDocumento(data){
                let me = this;
                this.$nextTick().then(function () {
                    console.log(me.arrayTipoDocumento[1]);
                    me.fillPropietario.ntpodocumento = me.arrayTipoDocumento[1].nIdPar;//asigno el tipo de documento RUC
                })
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
    .widthFull>.el-select>.el-input {
        width: 100%;
    }
    .el-input-number{
        width: 100% !important;
    }
    /* Estilos Modal */
    .menosPadding{
        padding: .31rem;
    }
    .subCabecera{
        justify-content: center;
        padding: 1rem;
        background: white;
    }
    .subCabecera>h3{
        color: black;
        font-size: 1rem;
        font-weight: bolder;
    }
    .flexRigth{
        display: flex;
        justify-content: center;
        align-items: flex-end;
        align-content: flex-end;
    }
    .flexLeft{
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        align-content: flex-start;
    }
    .flexLeft>h4{
        font-weight: bolder;
    }
</style>

