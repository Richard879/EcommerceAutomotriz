<?php

Route::get('/','Auth\LoginController@showLoginForm')->name('formlogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::middleware(['auth'])->group(function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/perrelacion/GetLstEmpresaByUsuario', 'PerRelacionController@GetLstEmpresaByUsuario');
    Route::get('/perrelacion/GetLstSucursalByEmpresa', 'PerRelacionController@GetLstSucursalByEmpresa');

    Route::get('/parametro/GetParametroByGrupo', 'ParametroController@GetParametroByGrupo');
    Route::get('/parametro/GetLstProveedor', 'ParametroController@GetLstProveedor');
    Route::get('/parametro/GetLineasByProveedor', 'ParametroController@GetLineasByProveedor');
    Route::get('/parametro/GetMarcasByProveedor', 'ParametroController@GetMarcasByProveedor');
    Route::get('/parametro/GetModelosByProveedor', 'ParametroController@GetModelosByProveedor');
    Route::get('/parametro/GetDocumentoNatural', 'ParametroController@GetDocumentoNatural');
    Route::get('/parametro/GetDocumentoJuridica', 'ParametroController@GetDocumentoJuridica');
    Route::get('/parametro/GetParametroById', 'ParametroController@GetParametroById');
    Route::get('/parametro/GetListParametroByGrupo', 'ParametroController@GetListParametroByGrupo');
    Route::get('/parametro/GetListSucursalByEmpresa', 'ParametroController@GetListSucursalByEmpresa');
    Route::get('/parametro/GetListParametroByNombre', 'ParametroController@GetListParametroByNombre');
    Route::get('/parametro/GetParametroByNombre', 'ParametroController@GetParametroByNombre');
    Route::get('/parametro/GetLstProveedorTodos', 'ParametroController@GetLstProveedorTodos');
    Route::post('/parametro/SetParametro', 'ParametroController@SetParametro');
    Route::post('/parametro/UpdParametroById', 'ParametroController@UpdParametroById');
    Route::put('/parametro/desactivar','ParametroController@desactivar');
    Route::put('/parametro/activar','ParametroController@activar');
    Route::get('/parametro/GetLineaMarcaModelo','ParametroController@GetLineaMarcaModelo');
    Route::post('/parametro/SetLineaMarcaModelo','ParametroController@SetLineaMarcaModelo');
    Route::put('/parametro/LineaMarcaModeloDesactiva','ParametroController@LineaMarcaModeloDesactiva');
    Route::put('/parametro/LineaMarcaModeloActiva','ParametroController@LineaMarcaModeloActiva');

    Route::get('/parparametro/GetListParParametroByGrupoTodos', 'ParParametroController@GetListParParametroByGrupoTodos');
    Route::post('/parparametro/SetParParametro', 'ParParametroController@SetParParametro');
    Route::post('/parparametro/ElmParParametro', 'ParParametroController@ElmParParametro');
    Route::get('/parparametro/GetParParametro', 'ParParametroController@GetParParametro');
    Route::get('/tipoparametro/GetTipoByIdParametro', 'ParametroController@GetTipoByIdParametro');
    Route::post('/tipoparametro/UpdTipoParametroById', 'ParametroController@UpdTipoParametroById');
    Route::get('/grupopar/GetGrupoParametroEventoCampania', 'GrupoParametroController@GetGrupoParametroEventoCampania');
    Route::get('/grupopar/GetListGrupoParametro', 'GrupoParametroController@GetListGrupoParametro');

    Route::get('/elemento/GetElementoByTipo', 'ElementoController@GetElementoByTipo');
    Route::post('/elemento/SetElemento', 'ElementoController@store');
    Route::put('/elemento/desactivar','ElementoController@desactivar');
    Route::put('/elemento/activar','ElementoController@activar');
    Route::post('/elemento/UpdElementoById', 'ElementoController@UpdElementoById');

    Route::post('/versionvehiculo/SetVersion', 'VersionVehiculoController@store');
    Route::get('/versionvehiculo/GetVersionVehiculo', 'VersionVehiculoController@GetVersionVehiculo');
    Route::post('/versionvehiculo/UpdVersionVehiculoById', 'VersionVehiculoController@UpdVersionVehiculoById');
    Route::put('/versionvehiculo/desactivar','VersionVehiculoController@desactivar');
    Route::put('/versionvehiculo/activar','VersionVehiculoController@activar');
    Route::get('/versionvehiculo/GetLineasByProveedor', 'VersionVehiculoController@GetLineasByProveedor');
    Route::get('/versionvehiculo/GetMarcaByLinea', 'VersionVehiculoController@GetMarcaByLinea');
    Route::get('/versionvehiculo/GetModeloByMarca', 'VersionVehiculoController@GetModeloByMarca');
    Route::get('/versionvehiculo/GetSubLineaByLinea', 'VersionVehiculoController@GetSubLineaByLinea');

    Route::post('/compra/importFileCompra', 'ExcelController@importFileCompra');
    Route::post('/compra/readFileCompra', 'ExcelController@readFileCompra');
    Route::post('/compra/SetCompra', 'CompraController@SetCompra');
    Route::get('/compra/GetCompra', 'CompraController@GetCompra');
    Route::put('/compra/desactivar','CompraController@desactivar');
    Route::post('/compra/importFileForum', 'ExcelController@importFileForum');
    Route::post('/compra/readFileForum', 'ExcelController@readFileForum');
    Route::post('/compra/SetForum', 'CompraController@SetForum');
    Route::get('/compra/GetCompraSinWOperativo', 'CompraController@GetCompraSinWOperativo');
    Route::get('/compra/GetCompraSinWFinanciero', 'CompraController@GetCompraSinWFinanciero');
    Route::post('/compra/UpdCompraById', 'CompraController@UpdCompraById');
    Route::get('/compra/GetLstCompraNoLineaCredito', 'CompraController@GetLstCompraNoLineaCredito');
    Route::post('/compra/UpdCompraLineaCreditoById', 'CompraController@UpdCompraLineaCreditoById');
    Route::get('/compra/GetListaPrecioByProveedor', 'CompraController@GetListaPrecioByProveedor');
    Route::put('/compra/activar','CompraController@activar');

    Route::get('/listapreciovh/GetListaVh', 'ListaPrecioVersionVehController@GetListaVh');
    Route::post('/listapreciovh/SetListaVh', 'ListaPrecioVersionVehController@SetListaVh');
    Route::post('/listapreciovh/importFileListaPrecioVh', 'ExcelController@importFileListaPrecioVh');
    Route::post('/listapreciovh/readFileListaPrecioVh', 'ExcelController@readFileListaPrecioVh');
    Route::post('/listapreciovh/SetListaPrecioVhDetalle', 'ListaPrecioVersionVehController@store');
    Route::get('/listapreciovh/GetListaVhDetalle', 'ListaPrecioVersionVehController@GetListaVhDetalle');
    Route::put('/listapreciovh/activar','ListaPrecioVersionVehController@activar');
    Route::put('/listapreciovh/desactivar','ListaPrecioVersionVehController@desactivar');
    Route::put('/listapreciovh/desactivarDetalle','ListaPrecioVersionVehController@desactivarDetalle');

    Route::get('/woperativo/GetWOperativo', 'WarrantOperativoController@GetWOperativo');
    Route::post('/woperativo/SetWOperativo', 'WarrantOperativoController@SetWOperativo');
    Route::post('/woperativo/SetWOperativoDetalle', 'WarrantOperativoController@SetWOperativoDetalle');
    Route::get('/woperativo/GetWOperativoDetalle', 'WarrantOperativoController@GetWOperativoDetalle');

    Route::get('/wfinanciero/GetWFinanciero', 'WarrantFinancieroController@GetWFinanciero');
    Route::post('/wfinanciero/SetWFinanciero', 'WarrantFinancieroController@SetWFinanciero');
    Route::post('/wfinanciero/SetWFinancieroDetalle', 'WarrantFinancieroController@SetWFinancieroDetalle');
    Route::get('/wfinanciero/GetWFinancieroDetalle', 'WarrantFinancieroController@GetWFinancieroDetalle');

    Route::post('/ec/SetEventoCampania', 'EventoCampaniaController@store');
    Route::post('/ec/SetDetalleEventoCampania', 'EventoCampaniaController@SetDetalleEventoCampania');
    Route::post('/ec/SetEventoElementoVenta', 'EventoCampaniaController@SetEventoElementoVenta');
    Route::post('/ec/SetDistribucionEventoByEC', 'EventoCampaniaController@SetDistribucionEventoByEC');
    Route::post('/ec/SetDistribucionEventoByElemento', 'EventoCampaniaController@SetDistribucionEventoByElemento');
    Route::get('/ec/GetEventoCampania', 'EventoCampaniaController@GetEventoCampania');
    Route::get('/ec/GetDistribucionByElementoVenta', 'EventoCampaniaController@GetDistribucionByElementoVenta');
    Route::put('/ec/desactivar', 'EventoCampaniaController@desactivar');
    Route::put('/ec/activar', 'EventoCampaniaController@activar');
    Route::post('/ec/SetEntregaEventoElementoVenta', 'EventoCampaniaController@SetEntregaEventoElementoVenta');

    Route::get('/ubigeo/GetDptos', 'UbigeoController@GetDptos');
    Route::get('/ubigeo/GetProvinciasByDpto', 'UbigeoController@GetProvinciasByDpto');
    Route::get('/ubigeo/GetDistritosByProv', 'UbigeoController@GetDistritosByProv');
    Route::get('/ubigeo/GetUbigeo', 'UbigeoController@GetUbigeo');

    Route::get('/gescontacto/GetLineasByUsuario', 'GestionContactoController@GetLineasByUsuario');
    Route::get('/gescontacto/GetMarcaByLinea', 'GestionContactoController@GetMarcaByLinea');
    Route::get('/gescontacto/GetModeloByMarca', 'GestionContactoController@GetModeloByMarca');
    Route::post('/gescontacto/SetContactoPerNatural', 'GestionContactoController@SetContactoPerNatural');
    Route::post('/gescontacto/SetContactoPerJuridica', 'GestionContactoController@SetContactoPerJuridica');
    Route::post('/gescontacto/SetContactoRefVehiculo', 'GestionContactoController@SetContactoRefVehiculo');
    Route::post('/gescontacto/SetContactoSegRefVehiculo', 'GestionContactoController@SetContactoSegRefVehiculo');
    Route::get('/gescontacto/GetListContactoByVendedor', 'GestionContactoController@GetListContactoByVendedor');
    Route::post('/gescontacto/SetContactoCarteraMes', 'GestionContactoController@SetContactoCarteraMes');
    Route::post('/gescontacto/SetContactoCarteraMesTodos', 'GestionContactoController@SetContactoCarteraMesTodos');
    Route::get('/gescontacto/GetListContactoBySinCarteraMes', 'GestionContactoController@GetListContactoBySinCarteraMes');
    Route::get('/gescontacto/GetCarteraMesByVendedor', 'GestionContactoController@GetCarteraMesByVendedor');
    Route::get('/gescontacto/GetContactoNaturalById', 'GestionContactoController@GetContactoNaturalById');
    Route::get('/gescontacto/GetContactoJuridicoById', 'GestionContactoController@GetContactoJuridicoById');
    Route::get('/gescontacto/GetRefVehiculoByContacto', 'GestionContactoController@GetRefVehiculoByContacto');
    Route::post('/gescontacto/SetSeguimiento', 'GestionContactoController@SetSeguimiento');
    Route::get('/gescontacto/GetListSeguimientoByIdAsignacion', 'GestionContactoController@GetListSeguimientoByIdAsignacion');
    Route::get('/gescontacto/GetListVendedoresByJFV', 'GestionContactoController@GetListVendedoresByJFV');
    Route::get('/gescontacto/GetListContactoByJFV', 'GestionContactoController@GetListContactoByJFV');
    Route::get('/gescontacto/GetListContactosLibres', 'GestionContactoController@GetListContactosLibres');
    Route::get('/gescontacto/GetListReferenciaVehiculoLibre', 'GestionContactoController@GetListReferenciaVehiculoLibre');
    Route::post('/gescontacto/SetAsignaReferenciaLibre', 'GestionContactoController@SetAsignaReferenciaLibre');
    //Route::get('/gescontacto/GetRefVehiculoByContactoPorReasignar', 'GestionContactoController@GetRefVehiculoByContactoPorReasignar');
    Route::post('/gescontacto/UpdReasignarReferenciaVehiculo', 'GestionContactoController@UpdReasignarReferenciaVehiculo');
    Route::get('/gescontacto/UpdReasignarContacto', 'GestionContactoController@UpdReasignarContacto');
    Route::get('/gescontacto/GetRefVehiculoByContacto_JFV', 'GestionContactoController@GetRefVehiculoByContacto_JFV');
    Route::post('/gescontacto/importFileLeads', 'ExcelController@importFileLeads');
    Route::post('/gescontacto/readFileLeads', 'ExcelController@readFileLeads');
    Route::post('/gescontacto/SetLeads', 'GestionContactoController@SetLeads');
    Route::get('/gescontacto/GetEstadoAsignacionSeguimiento', 'GestionContactoController@GetEstadoAsignacionSeguimiento');
    Route::put('/gescontacto/desactivarSeguimiento', 'GestionContactoController@desactivarSeguimiento');
    Route::post('/gescontacto/SetAmpliacionFechaVenceAsignacion', 'GestionContactoController@SetAmpliacionFechaVenceAsignacion');
    Route::post('/gescontacto/UpdCardCodeContacto', 'GestionContactoController@UpdCardCodeContacto');

    Route::get('/pedido/GetLstCotizacionIngresadas', 'PedidoController@GetLstCotizacionIngresadas');
    Route::get('/pedido/GetLstCompraByIdModelo', 'PedidoController@GetLstCompraByIdModelo');
    Route::get('/pedido/GetListaPrecioDetalleByIdCotizacion', 'PedidoController@GetListaPrecioDetalleByIdCotizacion');
    Route::post('/pedido/subirArchivo', 'PedidoController@subirArchivo');
    Route::post('/pedido/SetCabeceraPedido', 'PedidoController@SetCabeceraPedido');
    Route::get('/pedido/GetListPedidoByTipoEstado', 'PedidoController@GetListPedidoByTipoEstado');
    Route::get('/pedido/GetListPedidoAprobados', 'PedidoController@GetListPedidoAprobados');
    Route::get('/pedido/GetLstPedidosPendienteAprobacion', 'PedidoController@GetLstPedidosPendienteAprobacion');
    Route::put('/pedido/SetAprobarPedido', 'PedidoController@SetAprobarPedido');
    Route::get('/pedido/GetDocumentoByFormaPago', 'PedidoController@GetDocumentoByFormaPago');
    Route::get('/pedido/GetDocumentosById', 'PedidoController@GetDocumentosById');
    Route::put('/pedido/SetAnularPedido', 'PedidoController@SetAnularPedido');
    Route::get('/pedido/GetLstDetallePedido', 'PedidoController@GetLstDetallePedido');
    Route::post('/pedido/GetDetallePedido', 'PedidoController@GetDetallePedido');
    Route::get('/pedido/GetListPedidoForDscto', 'PedidoController@GetListPedidoForDscto');
    Route::get('/pedido/GetListHistorialPedidoDscto', 'PedidoController@GetListHistorialPedidoDscto');
    Route::post('/pedido/SetHistorialPedidoDscto', 'PedidoController@SetHistorialPedidoDscto');
    Route::get('/pedido/GetDireccionPersonaByPersona', 'PedidoController@GetDireccionPersonaByPersona');
    Route::get('/pedido/GetDireccionesByPersona', 'PedidoController@GetDireccionesByPersona');
    Route::post('/pedido/SetRegistrarDireccionPersona', 'PedidoController@SetRegistrarDireccionPersona');
    Route::get('/pedido/GetObtenerTipoPersona', 'PedidoController@GetObtenerTipoPersona');
    Route::get('/pedido/GetListContactoBySinCarteraMes', 'PedidoController@GetListContactoBySinCarteraMes');
    Route::get('/pedido/GetPedidoById', 'PedidoController@GetPedidoById');
    Route::post('/pedido/SapUpdPedidoByDocEntry', 'PedidoController@SapUpdPedidoByDocEntry');
    Route::post('/pedido/SapUpdFacturaByDocEntry', 'PedidoController@SapUpdFacturaByDocEntry');

    Route::get('/deposito/GetNumeroCuentaByBancoAndMoneda', 'PedidoDepositoController@GetNumeroCuentaByBancoAndMoneda');
    Route::get('/deposito/GetParDsctByParSrc', 'PedidoDepositoController@GetParDsctByParSrc');
    Route::post('/deposito/subirArchivo', 'PedidoDepositoController@subirArchivo');
    Route::post('/deposito/SetDepositoPedido', 'PedidoDepositoController@SetDepositoPedido');
    Route::get('/deposito/GetMontoTotalDepositos', 'PedidoDepositoController@GetMontoTotalDepositos');
    Route::get('/deposito/GetListPedidoConDeposito', 'PedidoDepositoController@GetListPedidoConDeposito');
    Route::get('/deposito/GetListDepositosPorPedido', 'PedidoDepositoController@GetListDepositosPorPedido');
    Route::put('/deposito/SetCambiarEstadoDeposito', 'PedidoDepositoController@SetCambiarEstadoDeposito');
    Route::put('/deposito/SetCambiarEstadoPedido', 'PedidoDepositoController@SetCambiarEstadoPedido');
    Route::put('/deposito/SetCambiarMontosDepositoByTCE', 'PedidoDepositoController@SetCambiarMontosDepositoByTCE');

    Route::get('/tipocambio/GetTipoCambioById', 'TipoCambioController@GetTipoCambioById');
    Route::get('/tipocambio/GetTipoCambioDay', 'TipoCambioController@GetTipoCambioDay');
    Route::post('/tipocambio/SetRegistrarTipoCambio', 'TipoCambioController@SetRegistrarTipoCambio');
    Route::post('/tipocambio/SetActualizarTipoCambio', 'TipoCambioController@SetActualizarTipoCambio');

    Route::post('/tipoinspeccion/SetTipoInspeccion', 'PdiTipoInspeccionController@SetTipoInspeccion');
    Route::get('/tipoinspeccion/GetListTipoInspeccion', 'PdiTipoInspeccionController@GetListTipoInspeccion');
    Route::put('/tipoinspeccion/activar', 'PdiTipoInspeccionController@activar');
    Route::put('/tipoinspeccion/desactivar', 'PdiTipoInspeccionController@desactivar');
    Route::post('/tipoinspeccion/UpdTipoInspeccionById', 'PdiTipoInspeccionController@UpdTipoInspeccionById');
    Route::get('/tipoinspeccion/GetFillTipoInspeccion', 'PdiTipoInspeccionController@GetFillTipoInspeccion');

    Route::get('/plantilla/GetListItems', 'PdiPlantillaSeccionController@GetListItems');
    Route::post('/plantilla/SetItemPlantilla', 'PdiPlantillaSeccionController@SetItemPlantilla');
    Route::put('/plantilla/activar', 'PdiPlantillaSeccionController@activar');
    Route::put('/plantilla/desactivar', 'PdiPlantillaSeccionController@desactivar');

    Route::get('/puntoinspeccion/GetListPuntoInspeccion', 'PdiPuntoInspeccionController@GetListPuntoInspeccion');
    Route::post('/puntoinspeccion/SetPuntoInspeccion', 'PdiPuntoInspeccionController@SetPuntoInspeccion');
    Route::post('/puntoinspeccion/UpdPuntoInspeccionById', 'PdiPuntoInspeccionController@UpdPuntoInspeccionById');
    Route::put('/puntoinspeccion/activar', 'PdiPuntoInspeccionController@activar');
    Route::put('/puntoinspeccion/desactivar', 'PdiPuntoInspeccionController@desactivar');

    Route::get('/puga/GetListMenuByUsuario', 'PerUsuGruAccController@GetListMenuByUsuario');
    Route::get('/puga/GetLstUsuarios', 'PerUsuGruAccController@GetLstUsuarios');
    Route::get('/puga/GetListPermisosByUsuario', 'PerUsuGruAccController@GetListPermisosByUsuario');
    Route::post('/puga/SetPermisosByUsuario', 'PerUsuGruAccController@SetPermisosByUsuario');
    Route::post('/puga/DeletePermisosByUsuario', 'PerUsuGruAccController@DeletePermisosByUsuario');
    //Asignación Jefe Ventas
    Route::get('/puga/GetListUsuarios2', 'PerUsuGruAccController@GetListUsuarios2');
    Route::post('/puga/SetAsignarJefeVentas', 'PerUsuGruAccController@SetAsignarJefeVentas');

    Route::get('/pdi/GetListSolicitudByEstado', 'PdiProcesoController@GetListSolicitudByEstado');
    Route::get('/pdi/GetListCompra', 'PdiProcesoController@GetListCompra');
    Route::get('/pdi/GetListSeccion', 'PdiProcesoController@GetListSeccion');
    Route::get('/pdi/GetListItem', 'PdiProcesoController@GetListItem');
    Route::post('/pdi/SetCabeceraInspeccion', 'PdiProcesoController@SetCabeceraInspeccion');
    Route::get('/pdi/GetListPdi', 'PdiProcesoController@GetListPdi');
    Route::get('/pdi/GetDetalleTipoInspeccionById', 'PdiProcesoController@GetDetalleTipoInspeccionById');
    Route::get('/pdi/GetListPuntoInspeccion', 'PdiProcesoController@GetListPuntoInspeccion');
    Route::post('/pdi/UpdCabeceraInspeccion', 'PdiProcesoController@UpdCabeceraInspeccion');
    Route::post('/pdi/SetPlantillaPdi', 'PdiProcesoController@SetPlantillaPdi');
    Route::post('/pdi/SetAccesorioPdi', 'PdiProcesoController@SetAccesorioPdi');
    Route::post('/pdi/SetCabeceraInspeccionDocumento', 'PdiProcesoController@SetCabeceraInspeccionDocumento');

    Route::post('/documentoadjunto/subirArchivo', 'DocumentoAdjuntoController@subirArchivo');

    Route::get('/gescotizacion/GetListReferencias', 'CotizacionController@GetListReferencias');
    Route::get('/gescotizacion/GetTipoLista', 'CotizacionController@GetTipoLista');
    Route::get('/gescotizacion/GetListVehiculos', 'CotizacionController@GetListVehiculos');
    Route::get('/gescotizacion/GetTipoCambio', 'CotizacionController@GetTipoCambio');
    Route::get('/gescotizacion/GetListCampañasByVehiculo', 'CotizacionController@GetListCampañasByVehiculo');
    Route::get('/gescotizacion/GetListEventoElementoVenta', 'CotizacionController@GetListEventoElementoVenta');
    Route::post('/gescotizacion/SetCabeceraCotizacion', 'CotizacionController@SetCabeceraCotizacion');
    Route::post('/gescotizacion/SetDetalleCotizacion', 'CotizacionController@SetDetalleCotizacion');
    Route::get('/gescotizacion/GetListCotizacionesByIdVendedor', 'CotizacionController@GetListCotizacionesByIdVendedor');
    Route::get('/gescotizacion/GetElementoByTipo', 'CotizacionController@GetElementoByTipo');
    Route::get('/gescotizacion/GetRefVehiculoByContacto', 'CotizacionController@GetRefVehiculoByContacto');
    Route::put('/setcotizacion/SetCambiarEstadoCotizacion', 'CotizacionController@SetCambiarEstadoCotizacion');
    Route::get('/getcotizacion/GetLstCotizacionPendientes', 'CotizacionController@GetLstCotizacionPendientes');
    //Route::get('/getcotizacion/GetLstCotizacionPendienteADV', 'CotizacionController@GetLstCotizacionPendienteADV');
    Route::get('/getcotizacion/GetDistribucionBySuperaDscto', 'CotizacionController@GetDistribucionBySuperaDscto');
    Route::get('/getcotizacion/GetDistribucionByElementoVenta', 'CotizacionController@GetDistribucionByElementoVenta');
    Route::post('/setcotizacion/SetDistribucionCotizacion', 'CotizacionController@SetDistribucionCotizacion');
    Route::get('/getcotizacion/GetLstDetalleCotizacion', 'CotizacionController@GetLstDetalleCotizacion');
    Route::get('/getcotizacion/GetDatosCotizacion', 'CotizacionController@GetDatosCotizacion');
    Route::post('/getcotizacion/GetDetalleCotizacion', 'CotizacionController@GetDetalleCotizacion');
    Route::get('/getcotizacion/GetListContactoByVendedor', 'CotizacionController@GetListContactoByVendedor');

    Route::get('/getComision/GetLineasByProveedor', 'ComisionController@GetLineasByProveedor');
    Route::get('/getComision/GetParametroByGrupo', 'ComisionController@GetParametroByGrupo');
    Route::post('/getComision/SetRegistrarComision', 'ComisionController@SetRegistrarComision');

    Route::get('/objComercial/getCompraActiva', 'ObjComercialController@getCompraActiva');
    Route::get('/objComercial/GetLstTipoBeneficio', 'ObjComercialController@GetLstTipoBeneficio');
    Route::get('/objComercial/getVentaActiva', 'ObjComercialController@getVentaActiva');
    Route::get('/objComercial/GetDetalleVehiculoCompra', 'ObjComercialController@GetDetalleVehiculoCompra');
    Route::post('/objComercial/SetRegistrarObjComercialCompra', 'ObjComercialController@SetRegistrarObjComercialCompra');
    Route::get('/objComercial/GetDetalleVehiculoVenta', 'ObjComercialController@GetDetalleVehiculoVenta');
    Route::post('/objComercial/SetRegistrarObjComercialVenta', 'ObjComercialController@SetRegistrarObjComercialVenta');

    Route::get('/asigVendedorTurno/GetParametroByParParent', 'AsigVendedorTurnoController@GetParametroByParParent');
    Route::post('/asigVendedorTurno/SetRegistrarVendedorTurno', 'AsigVendedorTurnoController@SetRegistrarVendedorTurno');
    Route::get('/asigVendedorTurno/GeLstDetalleTurno', 'AsigVendedorTurnoController@GeLstDetalleTurno');

    Route::get('/cartacaracteristica/GeLstCompras', 'CartaCaracteristicaController@GeLstCompras');
    Route::get('/cartacaracteristica/GetLstCotizacionAprobadas', 'CartaCaracteristicaController@GetLstCotizacionAprobadas');
    Route::post('/cartacaracteristica/SetRegistrarSCC', 'CartaCaracteristicaController@SetRegistrarSCC');
    Route::get('/cartacaracteristica/GetLstCartaCaracteristica', 'CartaCaracteristicaController@GetLstCartaCaracteristica');
    Route::get('/cartacaracteristica/GetLstCartaCaracteristicaByTodos', 'CartaCaracteristicaController@GetLstCartaCaracteristicaByTodos');
    Route::get('/cartacaracteristica/GetDetalleSolicitud', 'CartaCaracteristicaController@GetDetalleSolicitud');
    Route::put('/cartacaracteristica/SetConformeNoConforme', 'CartaCaracteristicaController@SetConformeNoConforme');
    Route::post('/cartacaracteristica/SetAprobadoNoAprobado', 'CartaCaracteristicaController@SetAprobadoNoAprobado');
    Route::put('/cartacaracteristica/SetAnularSCC', 'CartaCaracteristicaController@SetAnularSCC');

    Route::post('/maestrovehiculo/SetRegistrarVehiculoPlaca', 'MaestroVehiculoController@SetRegistrarVehiculoPlaca');
    Route::post('/maestrovehiculo/SetRegistrarPerNatural', 'MaestroVehiculoController@SetRegistrarPerNatural');
    Route::post('/maestrovehiculo/SetRegistrarPerJuridica', 'MaestroVehiculoController@SetRegistrarPerJuridica');
    Route::post('/maestrovehiculo/SetRegistrarSoat', 'MaestroVehiculoController@SetRegistrarSoat');
    Route::get('/maestrovehiculo/GetDetalleMaestroVehiculo', 'MaestroVehiculoController@GetDetalleMaestroVehiculo');

    Route::get('/autorizacion/GetLstVehiculosByCriterio', 'AutorizacionController@GetLstVehiculosByCriterio');
    Route::get('/autorizacion/GetLstContactosByUsuario', 'AutorizacionController@GetLstContactosByUsuario');
    Route::get('/autorizacion/GetLstMisSolicitudes', 'AutorizacionController@GetLstMisSolicitudes');
    Route::get('/autorizacion/GetLstSolicitudesByTodos', 'AutorizacionController@GetLstSolicitudesByTodos');
    Route::get('/autorizacion/GetRefVehiculoByContacto', 'AutorizacionController@GetRefVehiculoByContacto');
    Route::post('/autorizacion/SetRegistrarSolicitudAutorizacion', 'AutorizacionController@SetRegistrarSolicitudAutorizacion');
    Route::put('/autorizacion/SetConformeNoConforme', 'AutorizacionController@SetConformeNoConforme');

    Route::get('/tramite/GetPedidosCanceladosByEstadoTramite', 'TramiteController@GetPedidosCanceladosByEstadoTramite');
    Route::post('/tramite/SetCabeceraTramite', 'TramiteController@SetCabeceraTramite');
    Route::post('/tramite/SetTramiteTarjeta', 'TramiteController@SetTramiteTarjeta');
    Route::get('/tramite/GetSolicitudesTramites', 'TramiteController@GetSolicitudesTramites');
    Route::get('/tramite/GetDetalleSolicitudTramite', 'TramiteController@GetDetalleSolicitudTramite');
    Route::get('/tramite/GetEstadosTarjetasPlaca', 'TramiteController@GetEstadosTarjetasPlaca');
    Route::post('/tramite/SetEstadoTramiteTarjeta', 'TramiteController@SetEstadoTramiteTarjeta');
    Route::post('/tramite/SetEstadoTramitePlaca', 'TramiteController@SetEstadoTramitePlaca');

    Route::get('/turnoventa/GetLstTurnoVenta', 'TurnoVentaController@GetLstTurnoVenta');
    Route::post('/turnoventa/SetTurnoVenta', 'TurnoVentaController@store');
    Route::post('/turnoventa/UpdTurnoVentaById', 'TurnoVentaController@UpdTurnoVentaById');
    Route::put('/turnoventa/desactivar','TurnoVentaController@desactivar');
    Route::put('/turnoventa/activar','TurnoVentaController@activar');

    Route::get('/asignavendedormodelo/GetLstVendedorModelo','AsignaVendedorModeloController@GetLstVendedorModelo');
    Route::post('/asignavendedormodelo/SetAsignaModelo','AsignaVendedorModeloController@SetAsignaModelo');
    Route::post('/asignavendedormodelo/SetDesasignaModelo','AsignaVendedorModeloController@SetDesasignaModelo');

    Route::get('/asignavendedorcuota/GetLstVendedorCuota','AsignaVendedorCuotaController@GetLstVendedorCuota');
    Route::post('/asignavendedorcuota/SetRegistraAsignacionCuota','AsignaVendedorCuotaController@SetRegistraAsignacionCuota');

    Route::get('/entregavehiculo/GetLstInspecciones','EntregaVehiculoController@GetLstInspecciones');
    Route::post('/entregavehiculo/SetGenerarEntregaVehículo','EntregaVehiculoController@SetGenerarEntregaVehículo');
    Route::get('/entregavehiculo/GetLstArchivosAdjuntos','EntregaVehiculoController@GetLstArchivosAdjuntos');

    Route::post('/exhibicion/importFileExhibicion','ExcelController@importFileExhibicion');
    Route::post('/exhibicion/readFileExhibicion', 'ExcelController@readFileExhibicion');
    Route::post('/exhibicion/SetExhibicion', 'ExhibicionController@SetExhibicion');
    Route::get('/exhibicion/GetExhibicion', 'ExhibicionController@GetExhibicion');
    Route::put('/exhibicion/desactivar','ExhibicionController@desactivar');

    Route::get('/cronograma/GetCronogramaVentaActivo','CronogramaController@GetCronogramaVentaActivo');
    Route::get('/cronograma/GetCronogramaCompraActivo','CronogramaController@GetCronogramaCompraActivo');
    Route::get('/cronograma/GetCronogramaActivoByTipo','CronogramaController@GetCronogramaActivoByTipo');
    Route::post('/cronograma/SetActivarCronograma','CronogramaController@SetActivarCronograma');

    Route::post('/flete/SetFlete', 'FleteController@SetFlete');
    Route::get('/flete/GetListFlete', 'FleteController@GetListFlete');
    Route::get('/flete/GetComprasForFlete', 'FleteController@GetComprasForFlete');
    Route::get('/flete/GetListFleteDetalle', 'FleteController@GetListFleteDetalle');

    Route::get('/reporte/GetListSubReportesByReporte','ReporteController@GetListSubReportesByReporte');
    Route::post('/reporte/GetCotizacionGenerarReporte01','ReporteController@GetCotizacionGenerarReporte01');
    Route::post('/reporte/GetPedidoGenerarReporte04','ReporteController@GetPedidoGenerarReporte04');

    Route::get('/obsequio/GetObsequio', 'ObsequioController@GetObsequio');
    Route::post('/obsequio/SetObsequio', 'ObsequioController@SetObsequio');
    Route::post('/obsequio/SetDetalleObsequio', 'ObsequioController@SetDetalleObsequio');
    Route::post('/obsequio/SetObsequioElementoVenta', 'ObsequioController@SetObsequioElementoVenta');
    Route::get('/obsequio/GetDistribucionByElementoVenta', 'ObsequioController@GetDistribucionByElementoVenta');
    Route::put('/obsequio/desactivar', 'ObsequioController@desactivar');
    Route::put('/obsequio/activar', 'ObsequioController@activar');
    Route::post('/obsequio/SetDistribucionObsequioByObsequio', 'ObsequioController@SetDistribucionObsequioByObsequio');
    Route::post('/obsequio/SetDistribucionObsequioByElemento', 'ObsequioController@SetDistribucionObsequioByElemento');
    Route::post('/obsequio/SetEntregaObsequioElementoVenta', 'ObsequioController@SetEntregaObsequioElementoVenta');
    Route::get('/gescotizacion/GetListObsequiosByVehiculo', 'CotizacionController@GetListObsequiosByVehiculo');
    Route::get('/gescotizacion/GetListObsequioElementoVenta', 'CotizacionController@GetListObsequioElementoVenta');

    Route::get('/asignavendedorsublinea/GetLstVendedorSubLinea','AsignaVendedorSubLineaController@GetLstVendedorSubLinea');
    Route::post('/asignavendedorsublinea/SetAsignaSubLinea','AsignaVendedorSubLineaController@SetAsignaSubLinea');
    Route::post('/asignavendedorsublinea/SetDesasignaSubLinea','AsignaVendedorSubLineaController@SetDesasignaSubLinea');

    Route::get('/asignacuota/GetLstVendedorSubLineaCuota','AsignaVendedorCuotaSubLineaController@GetLstVendedorSubLineaCuota');
    Route::post('/asignacuota/SetRegistraAsignacionCuota','AsignaVendedorCuotaSubLineaController@SetRegistraAsignacionCuota');

    Route::get('/usuario/GetListUsuarios','GestionUsuariosController@GetListUsuarios');
    Route::get('/usuario/GetListRoles','GestionUsuariosController@GetListRoles');
    Route::post('/usuario/SetRegistrarUsuario','GestionUsuariosController@SetRegistrarUsuario');
    Route::get('/usuario/GetListPermisosByRol','GestionUsuariosController@GetListPermisosByRol');
    Route::post('/usuario/SetPermisosByUsuario','GestionUsuariosController@SetPermisosByUsuario');
    Route::get('/usuario/GetInformacionUsuario','GestionUsuariosController@GetInformacionUsuario');

    Route::get('/cuentabancaria/GetBancosByEmpresa','CuentaBancariaController@GetBancosByEmpresa');

    Route::get('/tablacosto/GetCompraTipoBeneficio','TablaCostoController@GetCompraTipoBeneficio');

    //INTEGRACION
    Route::post('/articulo/SetIntegraArticulo','IntArticuloController@SetIntegraArticulo');
    Route::post('/proyecto/SetIntegraProyecto','IntProyectoController@SetIntegraProyecto');
    Route::post('/tarjetaequipo/SetIntegraTarjetaEquipo','IntTarjetaEquipoController@SetIntegraTarjetaEquipo');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicio','IntLlamadaServicioController@SetIntegraLlamadaServicio');
    Route::post('/compra/SetIntegraCompra', 'CompraController@SetIntegraCompra');
    Route::post('/compra/SetIntegraMercancia', 'CompraController@SetIntegraMercancia');
    Route::post('/actividad/SetIntegraActividad','IntActividadController@SetIntegraActividad');
    Route::get('/actividad/GetIntegraActividadByItemCode','IntActividadController@GetIntegraActividadByItemCode');

    ///========================================
    /////=================  ROUTES SAP
    //
    /// ============================================================
    /// CONEXION HANNAH - LARAVEL
    /// ============================================================
    ///
    Route::post('/SAPLoginController/login', 'Api\SAPLoginController@login');
    Route::post('/SAPLoginController/logout', 'Api\SAPLoginController@logout');
    Route::get('/SAPLoginController/MetaData', 'Api\SAPLoginController@MetaData');
    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    //Gestión de Contacto
    Route::get('/gescontacto/SapGetValidarContacto', 'Api\SapContactoController@SapGetValidarContacto');
    Route::post('/gescontacto/SapSetContacto', 'Api\SapContactoController@SapSetContacto');
    Route::post('/gescontacto/SapSetContacto2', 'Api\SapContactoController@SapSetContacto2');
    Route::post('/gescontacto/SapSetUpdDireccionesContacto', 'Api\SapContactoController@SapSetUpdDireccionesContacto');
    //Compra
    Route::post('/compra/SapSetCompra', 'Api\SapCompraController@SapSetCompra');
    //Entrada Mercancia
    Route::post('/mercancia/SapSetMercanciaByOC', 'Api\SapMercanciaController@SapSetMercanciaByOC');
    //Articulo
    Route::post('/articulo/SapGetValidarArticulo', 'Api\SapArticuloController@SapGetValidarArticulo');
    Route::post('/articulo/SapSetArticulo', 'Api\SapArticuloController@SapSetArticulo');
    //Pedido
    Route::post('/pedido/SapSetPedido', 'Api\SapPedidoController@SapSetPedido');
    //Pedido Descuento
    Route::post('/pedido/SapSetPedidoDscto', 'Api\SapPedidoController@SapSetPedidoDscto');
    //Comprobante
    Route::post('/comprobante/SapSetFactura', 'Api\SapComprobanteController@SapSetFactura');
    //Proyecto
    Route::post('/proyecto/SapSetProyecto', 'Api\SapProyectoController@SapSetProyecto');
    //TarjetaEquipo
    Route::post('/tarjetaequipo/SapSetTarjetaEquipo', 'Api\SapTarjetaEquipoController@SapSetTarjetaEquipo');
    //LlamadaServicio
    Route::post('/llamadaservicio/SapSetLlamadaServicio', 'Api\SapLlamadaServicioController@SapSetLlamadaServicio');
    //Actividad
    Route::post('/actividad/SapSetActividad', 'Api\SapActividadController@SapSetActividad');
    /// ============================================================
    /// METODOS ODBC
    /// ============================================================
    //Ubigeo
    Route::get('/ubigeo/SapGetUbigeo', 'Api\SapUbigeoController@SapGetUbigeo');
});
