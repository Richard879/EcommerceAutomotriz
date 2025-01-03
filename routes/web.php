<?php

Route::get('/','Auth\LoginController@showLoginForm')->name('formlogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::middleware(['auth', 'verificarusuario'])->group(function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    //Dashboard
    Route::get('/dashboard/GetEmpleadosByRol', 'DashboardController@GetEmpleadosByRol');
    //====
    Route::get('/dashboard/GetCotizacionMontoByMes', 'DashboardController@GetCotizacionMontoByMes');
    Route::get('/dashboard/GetCotizacionMontoTotal', 'DashboardController@GetCotizacionMontoTotal');
    Route::get('/dashboard/GetCotizacionCantidadTotal', 'DashboardController@GetCotizacionCantidadTotal');
    Route::get('/dashboard/GetCotizacionesByUsuario', 'DashboardController@GetCotizacionesByUsuario');
    Route::get('/dashboard/GetCotizacionesByRol', 'DashboardController@GetCotizacionesByRol');
    //====
    Route::get('/dashboard/GetAsesoresByJV', 'DashboardController@GetAsesoresByJV');
    // Route::post('/dashboard/GetCotizacionesPorAsesorComercialDeJVEspecifico', 'DashboardController@GetCotizacionesPorAsesorComercialDeJVEspecifico');
    //====
    Route::get('/dashboard/GetPedidoMontoByMes', 'DashboardController@GetPedidoMontoByMes');
    Route::get('/dashboard/GetPedidoMontoTotal', 'DashboardController@GetPedidoMontoTotal');
    Route::get('/dashboard/GetPedidoCantidadTotal', 'DashboardController@GetPedidoCantidadTotal');
    Route::get('/dashboard/GetPedidosByUsuario', 'DashboardController@GetPedidosByUsuario');
    Route::get('/dashboard/GetPedidosByRol', 'DashboardController@GetPedidosByRol');

    //Notificaciones
    Route::post('/notification/get', 'NotificationController@get');

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
    Route::get('/parametro/GetListParametroByGrupoTodos', 'ParametroController@GetListParametroByGrupoTodos');
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
    Route::post('/tipoparametro/SetTipoParametro', 'ParametroController@SetTipoParametro');
    Route::get('/grupopar/GetGrupoParametroEventoCampania', 'GrupoParametroController@GetGrupoParametroEventoCampania');
    Route::get('/grupopar/GetListGrupoParametro', 'GrupoParametroController@GetListGrupoParametro');

    Route::get('/elemento/GetElementoByTipo', 'ElementoController@GetElementoByTipo');
    Route::get('/elemento/GetElementoByTipoBsq', 'ElementoController@GetElementoByTipoBsq');
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
    Route::post('/versionvehiculo/SetPlantillaVersionVeh', 'VersionVehiculoController@SetPlantillaVersionVeh');
    Route::get('/versionvehiculo/GetDataPlantillaVerVeh', 'VersionVehiculoController@GetDataPlantillaVerVeh');

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
    Route::get('/compra/exportCompraXLS', 'ExcelController@exportCompraXLS');
    Route::put('/compra/UpdCompraSucursal', 'CompraController@UpdCompraSucursal');

    Route::get('/listapreciovh/GetListaVh', 'ListaPrecioVersionVehController@GetListaVh');
    Route::post('/listapreciovh/SetListaVh', 'ListaPrecioVersionVehController@SetListaVh');
    Route::post('/listapreciovh/importFileListaPrecioVh', 'ExcelController@importFileListaPrecioVh');
    Route::post('/listapreciovh/readFileListaPrecioVh', 'ExcelController@readFileListaPrecioVh');
    Route::post('/listapreciovh/SetListaPrecioVhDetalle', 'ListaPrecioVersionVehController@SetListaPrecioVhDetalle');
    Route::get('/listapreciovh/GetListaVhDetalle', 'ListaPrecioVersionVehController@GetListaVhDetalle');
    Route::put('/listapreciovh/activar','ListaPrecioVersionVehController@activar');
    Route::put('/listapreciovh/desactivar','ListaPrecioVersionVehController@desactivar');
    Route::put('/listapreciovh/desactivarDetalle','ListaPrecioVersionVehController@desactivarDetalle');
    Route::post('/listapreciovh/UpdListaPrecioDetalle','ListaPrecioVersionVehController@UpdListaPrecioDetalle');
    Route::get('/listapreciovh/GetListaPrecioActiva', 'ListaPrecioVersionVehController@GetListaPrecioActiva');

    // Configurador Modelos
    Route::get('/modeloconfig/GetListModelos', 'ModeloConfigController@GetListModelos');
    Route::post('/modeloconfig/SetRegistrarDocs', 'ModeloConfigController@SetRegistrarDocs');
    Route::get('/modeloconfig/GetInfoDocsModelo', 'ModeloConfigController@GetInfoDocsModelo');
    Route::post('/modeloconfig/SetActualizarDocs', 'ModeloConfigController@SetActualizarDocs');
    Route::post('/modeloconfig/SetEliminarXMLByVersion', 'ModeloConfigController@SetEliminarXMLByVersion');
    Route::post('/modeloconfig/SetRegistrarXMLByVersion', 'ModeloConfigController@SetRegistrarXMLByVersion');
    Route::get('/modeloconfig/GetXMLByVersion', 'ModeloConfigController@GetXMLByVersion');

    Route::get('/woperativo/GetWOperativo', 'WarrantOperativoController@GetWOperativo');
    Route::post('/woperativo/SetWOperativo', 'WarrantOperativoController@SetWOperativo');
    Route::post('/woperativo/SetWOperativoCompra', 'WarrantOperativoController@SetWOperativoCompra');
    Route::get('/woperativo/GetWOperativoDetalle', 'WarrantOperativoController@GetWOperativoDetalle');
    Route::post('/woperativo/UpdEstadoWoDetalle', 'WarrantOperativoController@UpdEstadoWoDetalle');
    Route::get('/woperativo/GetFechaVenceByLinea', 'WarrantOperativoController@GetFechaVenceByLinea');
    Route::get('/woperativo/GetVehiculosWoSinOS', 'WarrantOperativoController@GetVehiculosWoSinOS');

    Route::get('/wfinanciero/GetWFinanciero', 'WarrantFinancieroController@GetWFinanciero');
    Route::post('/wfinanciero/SetWFinanciero', 'WarrantFinancieroController@SetWFinanciero');
    Route::post('/wfinanciero/SetWFinancieroDetalle', 'WarrantFinancieroController@SetWFinancieroDetalle');
    Route::get('/wfinanciero/GetWFinancieroDetalle', 'WarrantFinancieroController@GetWFinancieroDetalle');
    Route::post('/wfinanciero/UpdEstadoWoDetalle', 'WarrantFinancieroController@UpdEstadoWoDetalle');

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
    Route::post('/gescontacto/SetPatchContactoPerNatural', 'GestionContactoController@SetPatchContactoPerNatural');
    Route::put('/gescontacto/desactivaReferencia', 'GestionContactoController@desactivaReferencia');
    Route::get('/gescontacto/GetListContactoByRol', 'GestionContactoController@GetListContactoByRol');
    Route::get('/gescontacto/GetValidaPerDocumentoByTipo', 'GestionContactoController@GetValidaPerDocumentoByTipo');

    Route::get('/pedido/GetLstCotizacionIngresadas', 'PedidoController@GetLstCotizacionIngresadas');
    Route::get('/pedido/GetLstCompraByIdModelo', 'PedidoController@GetLstCompraByIdModelo');
    Route::get('/pedido/GetListaPrecioDetalleByIdCotizacion', 'PedidoController@GetListaPrecioDetalleByIdCotizacion');
    Route::post('/pedido/subirArchivo', 'PedidoController@subirArchivo');
    Route::post('/pedido/SetCabeceraPedido', 'PedidoController@SetCabeceraPedido');
    Route::get('/pedido/GetListPedidoByTipoEstado', 'PedidoController@GetListPedidoByTipoEstado');
    Route::get('/pedido/GetListPedidoAprobados', 'PedidoController@GetListPedidoAprobados');
    Route::get('/pedido/GetListPedidoAprobadosFinanciado', 'PedidoController@GetListPedidoAprobadosFinanciado');
    Route::put('/pedido/SetCambiarEstadoPedidoFinanciado', 'PedidoController@SetCambiarEstadoPedidoFinanciado');
    Route::get('/pedido/GetLstPedidosPendienteAprobacion', 'PedidoController@GetLstPedidosPendienteAprobacion');
    Route::put('/pedido/SetAprobarPedido', 'PedidoController@SetAprobarPedido');
    Route::get('/pedido/GetDocumentoByFormaPago', 'PedidoController@GetDocumentoByFormaPago');
    Route::get('/pedido/GetDocumentosById', 'PedidoController@GetDocumentosById');
    Route::get('/pedido/GetEstadoPedidoFinanciado', 'PedidoController@GetEstadoPedidoFinanciado');
    Route::put('/pedido/SetAnularPedido', 'PedidoController@SetAnularPedido');
    Route::get('/pedido/GetLstDetallePedido', 'PedidoController@GetLstDetallePedido');
    Route::post('/pedido/GetDetallePedido', 'PedidoController@GetDetallePedido');
    Route::post('/pedido/GetGenerarCartaResponsabilidad', 'PedidoController@GetGenerarCartaResponsabilidad');
    Route::post('/pedido/GetGenerarRequerimiento', 'PedidoController@GetGenerarRequerimiento');
    Route::get('/pedido/GetListPedidoForDscto', 'PedidoController@GetListPedidoForDscto');
    Route::get('/pedido/GetListHistorialPedidoDscto', 'PedidoController@GetListHistorialPedidoDscto');
    Route::post('/pedido/SetHistorialPedidoDscto', 'PedidoController@SetHistorialPedidoDscto');
    Route::get('/pedido/GetDireccionPersonaByPersona', 'PedidoController@GetDireccionPersonaByPersona');
    Route::get('/pedido/GetDireccionesByPersona', 'PedidoController@GetDireccionesByPersona');
    Route::post('/pedido/SetRegistrarDireccionPersona', 'PedidoController@SetRegistrarDireccionPersona');
    Route::get('/pedido/GetObtenerTipoPersona', 'PedidoController@GetObtenerTipoPersona');
    Route::get('/pedido/GetListContactoBySinCarteraMes', 'PedidoController@GetListContactoBySinCarteraMes');
    Route::get('/pedido/GetPedidoById', 'PedidoController@GetPedidoById');
    Route::get('/pedido/GetPedidoEVById', 'PedidoController@GetPedidoEVById');
    Route::get('/pedido/GetCampaniaObsequioByIdPedido', 'PedidoController@GetCampaniaObsequioByIdPedido');
    Route::post('/pedido/SapUpdPedidoByDocEntry', 'PedidoController@SapUpdPedidoByDocEntry');
    Route::get('/pedido/GetOrdenVenta', 'PedidoController@GetOrdenVenta');
    Route::get('/pedido/GetLlamadasServiciosByPedido', 'PedidoController@GetLlamadasServiciosByPedido');
    Route::get('/pedido/GetLstPedidoConDescuento', 'PedidoController@GetLstPedidoConDescuento');
    Route::get('/pedido/GetListDistribucionPedido', 'PedidoController@GetListDistribucionPedido');

    Route::get('/deposito/GetNumeroCuentaByBancoAndMoneda', 'PedidoDepositoController@GetNumeroCuentaByBancoAndMoneda');
    Route::get('/deposito/GetParDsctByParSrc', 'PedidoDepositoController@GetParDsctByParSrc');
    Route::post('/deposito/subirArchivo', 'PedidoDepositoController@subirArchivo');
    Route::post('/deposito/SetDepositoPedido', 'PedidoDepositoController@SetDepositoPedido');
    Route::get('/deposito/GetMontoTotalDepositos', 'PedidoDepositoController@GetMontoTotalDepositos');
    Route::get('/deposito/GetListPedidoConDeposito', 'PedidoDepositoController@GetListPedidoConDeposito');
    Route::get('/deposito/GetListDepositosPorPedido', 'PedidoDepositoController@GetListDepositosPorPedido');
    Route::put('/deposito/SetCambiarEstadoDeposito', 'PedidoDepositoController@SetCambiarEstadoDeposito');
    Route::put('/deposito/SetCambiarEstadoDepositoFinanciamiento', 'PedidoDepositoController@SetCambiarEstadoDepositoFinanciamiento');
    Route::put('/deposito/SetCambiarEstadoPedido', 'PedidoDepositoController@SetCambiarEstadoPedido');
    Route::put('/deposito/SetCambiarMontosDepositoByTCE', 'PedidoDepositoController@SetCambiarMontosDepositoByTCE');
    Route::put('/deposito/SetCambiarEstadoIncidencia', 'PedidoDepositoController@SetCambiarEstadoIncidencia');
    Route::put('/deposito/SetCambiarEstadoDepositoPreliminar', 'PedidoDepositoController@SetCambiarEstadoDepositoPreliminar');
    Route::get('/deposito/GetListPedidoAprobados', 'PedidoDepositoController@GetListPedidoAprobados');
    Route::post('/deposito/GetDetalleDeposito', 'PedidoDepositoController@GetDetalleDeposito');

    Route::get('/tipocambio/GetTipoCambioById', 'TipoCambioController@GetTipoCambioById');
    Route::get('/tipocambio/GetTipoCambioByFecha', 'TipoCambioController@GetTipoCambioByFecha');
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
    Route::post('/puga/DeletePermisosByUsuario', 'PerUsuGruAccController@DeletePermisosByUsuario');
    Route::post('/puga/SetPermisosByUsuario','PerUsuGruAccController@SetPermisosByUsuario');
    //Asignación Jefe Ventas
    Route::get('/puga/GetListAsesorComercialByJF', 'PerUsuGruAccController@GetListAsesorComercialByJF');
    Route::post('/puga/SetAsignarJefeVentas', 'PerUsuGruAccController@SetAsignarJefeVentas');

    Route::get('/pdi/GetListSolicitudByEstado', 'PdiProcesoController@GetListSolicitudByEstado');
    Route::get('/pdi/GetListCompra', 'PdiProcesoController@GetListCompra');
    Route::get('/pdi/GetListSeccion', 'PdiProcesoController@GetListSeccion');
    Route::get('/pdi/GetListItem', 'PdiProcesoController@GetListItem');
    Route::get('/pdi/GetElementoByTipo', 'PdiProcesoController@GetElementoByTipo');
    Route::get('/pdi/GetAccesoriosPdiEntrada', 'PdiProcesoController@GetAccesoriosPdiEntrada');
    Route::post('/pdi/SetCabeceraInspeccion', 'PdiProcesoController@SetCabeceraInspeccion');
    Route::get('/pdi/GetListPdi', 'PdiProcesoController@GetListPdi');
    Route::get('/pdi/GetDetalleTipoInspeccionById', 'PdiProcesoController@GetDetalleTipoInspeccionById');
    Route::get('/pdi/GetListPuntoInspeccion', 'PdiProcesoController@GetListPuntoInspeccion');
    Route::post('/pdi/UpdCabeceraInspeccion', 'PdiProcesoController@UpdCabeceraInspeccion');
    Route::post('/pdi/SetPlantillaPdi', 'PdiProcesoController@SetPlantillaPdi');
    Route::post('/pdi/SetAccesorioPdi', 'PdiProcesoController@SetAccesorioPdi');
    Route::post('/pdi/SetCabeceraInspeccionDocumento', 'PdiProcesoController@SetCabeceraInspeccionDocumento');
    Route::post('/pdi/GetDetallePDI', 'PdiProcesoController@GetDetallePDI');
    Route::get('/pdi/GetAccesoriosPdiEntregaVehiculo', 'PdiProcesoController@GetAccesoriosPdiEntregaVehiculo');
    Route::get('/pdi/GetLstVehiculoPaca', 'PdiProcesoController@GetLstVehiculoPaca');
    Route::get('/pdi/GetListDetalleAccesorio', 'PdiProcesoController@GetListDetalleAccesorio');
    Route::post('/pdi/GetReportePDI', 'PdiProcesoController@GetReportePDI');
    Route::post('/pdi/subirArchivo', 'PdiProcesoController@subirArchivo');
    Route::put('/pdi/activarInactivar', 'PdiProcesoController@activarInactivar');

    Route::post('/documentoadjunto/subirArchivo', 'DocumentoAdjuntoController@subirArchivo');
    Route::post('/documentoadjunto/subirArchivoPDI', 'DocumentoAdjuntoController@subirArchivoPDI');

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
    Route::get('/gescotizacion/GetLisDocsModelo', 'CotizacionController@GetLisDocsModelo');
    Route::get('/gescotizacion/GetDetalleCotizacionDistribucion', 'CotizacionController@GetDetalleCotizacionDistribucion');
    Route::get('/gescotizacion/GetLstCotizacionConDescuento', 'CotizacionController@GetLstCotizacionConDescuento');

    Route::get('/getComision/GetLineasByProveedor', 'ComisionController@GetLineasByProveedor');
    Route::get('/getComision/GetParametroByGrupo', 'ComisionController@GetParametroByGrupo');
    Route::post('/getComision/SetRegistrarComision', 'ComisionController@SetRegistrarComision');
    Route::get('/getComision/GetListComisiones', 'ComisionController@GetListComisiones');

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
    Route::post('/maestrovehiculo/SetRegistrarPropietario', 'MaestroVehiculoController@SetRegistrarPropietario');
    Route::get('/maestrovehiculo/GetDetalleMaestroVehiculo', 'MaestroVehiculoController@GetDetalleMaestroVehiculo');
    Route::get('/maestrovehiculo/GetDataPlantilla', 'MaestroVehiculoController@GetDataPlantilla');

    Route::get('/autorizacion/GetLstVehiculosByCriterio', 'AutorizacionController@GetLstVehiculosByCriterio');
    Route::get('/autorizacion/GetLstContactosByUsuario', 'AutorizacionController@GetLstContactosByUsuario');
    Route::get('/autorizacion/GetLstMisSolicitudes', 'AutorizacionController@GetLstMisSolicitudes');
    Route::get('/autorizacion/GetLstSolicitudesByTodos', 'AutorizacionController@GetLstSolicitudesByTodos');
    Route::get('/autorizacion/GetRefVehiculoByContacto', 'AutorizacionController@GetRefVehiculoByContacto');
    Route::post('/autorizacion/SetRegistrarSolicitudAutorizacion', 'AutorizacionController@SetRegistrarSolicitudAutorizacion');
    Route::put('/autorizacion/SetConformeNoConforme', 'AutorizacionController@SetConformeNoConforme');
    Route::get('/autorizacion/GetListCantidadEntregaByDia', 'AutorizacionController@GetListCantidadEntregaByDia');
    Route::get('/autorizacion/GetListHoraEntregaByDia', 'AutorizacionController@GetListHoraEntregaByDia');
    Route::get('/autorizacion/GetListHorasLibresPorFecha', 'AutorizacionController@GetListHorasLibresPorFecha');

    Route::get('/tramite/GetPedidosCanceladosByEstadoTramite', 'TramiteController@GetPedidosCanceladosByEstadoTramite');
    Route::get('/tramite/GetListFiltro', 'TramiteController@GetListFiltro');
    Route::post('/tramite/SetCabeceraTramite', 'TramiteController@SetCabeceraTramite');
    Route::post('/tramite/SetTramiteTarjeta', 'TramiteController@SetTramiteTarjeta');
    Route::get('/tramite/GetSolicitudesTramites', 'TramiteController@GetSolicitudesTramites');
    Route::get('/tramite/GetDetalleSolicitudTramite', 'TramiteController@GetDetalleSolicitudTramite');
    Route::get('/tramite/GetEstadosTarjetasPlaca', 'TramiteController@GetEstadosTarjetasPlaca');
    Route::post('/tramite/SetEstadoTramiteTarjeta', 'TramiteController@SetEstadoTramiteTarjeta');
    Route::post('/tramite/SetEstadoTramitePlaca', 'TramiteController@SetEstadoTramitePlaca');
    Route::get('/tramite/GetSolicitudesTramites', 'TramiteController@GetSolicitudesTramites');
    Route::get('/tramite/exportSolicitudes', 'TramiteController@exportSolicitudes');

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
    Route::post('/entregavehiculo/SetGenerarEntregaVehiculo','EntregaVehiculoController@SetGenerarEntregaVehiculo');
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
    Route::get('/cronograma/GetCronogramaFechasByMes','CronogramaController@GetCronogramaFechasByMes');
    Route::post('/cronograma/SetCronograma','CronogramaController@SetCronograma');
    Route::get('/cronograma/GetCronogramaByTipo','CronogramaController@GetCronogramaByTipo');

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

    Route::get('/asignacuota/GetLstVendedorSubLineaCuota','AsignaVendedorCuotaSublineaController@GetLstVendedorSubLineaCuota');
    Route::post('/asignacuota/SetRegistraAsignacionCuota','AsignaVendedorCuotaSublineaController@SetRegistraAsignacionCuota');

    Route::get('/usuario/GetListUsuarios','GestionUsuariosController@GetListUsuarios');
    Route::get('/usuario/GetListRoles','GestionUsuariosController@GetListRoles');
    Route::get('/usuario/GetListRolesBsq','GestionUsuariosController@GetListRolesBsq');
    Route::post('/usuario/SetRegistrarUsuario','GestionUsuariosController@SetRegistrarUsuario');
    Route::post('/usuario/SetEditarUsuario','GestionUsuariosController@SetEditarUsuario');
    Route::get('/usuario/GetListPermisosByRol','GestionUsuariosController@GetListPermisosByRol');
    Route::post('/usuario/SetPermisosByUsuario','GestionUsuariosController@SetPermisosByUsuario');
    Route::post('/usuario/SetEliminarPermisosByUsuario', 'GestionUsuariosController@SetEliminarPermisosByUsuario');
    Route::get('/usuario/GetInformacionUsuario','GestionUsuariosController@GetInformacionUsuario');
    Route::get('/usuario/GetInformacionUsuarioCabecera','GestionUsuariosController@GetInformacionUsuarioCabecera');
    Route::put('/usuario/SetCambiarEstadoUsuario','GestionUsuariosController@SetCambiarEstadoUsuario');
    Route::post('/usuario/SetEditarMiUsuario','GestionUsuariosController@SetEditarMiUsuario');
    Route::get('/usuario/GetListUsuariosByRol','GestionUsuariosController@GetListUsuariosByRol');
    Route::get('/usuario/GetListUsuariosBySucursal','GestionUsuariosController@GetListUsuariosBySucursal');
    Route::get('/usuario/GetListSubLineasByUsuario','GestionUsuariosController@GetListSubLineasByUsuario');

    Route::get('/cuentabancaria/GetBancosByEmpresa','CuentaBancariaController@GetBancosByEmpresa');
    Route::get('/almacen/GetAlmacenByLocalidad','AlmacenController@GetAlmacenByLocalidad');
    Route::get('/almacen/GetAlmacenPorDefecto','AlmacenController@GetAlmacenPorDefecto');
    Route::get('/almacen/GetAlmacen','AlmacenController@GetAlmacen');
    Route::get('/almacen/GetListAlmacen','AlmacenController@GetListAlmacen');
    Route::put('/almacen/SetCambiarEstado','AlmacenController@SetCambiarEstado');
    Route::post('/almacen/SetRegistrarAlmacen','AlmacenController@SetRegistrarAlmacen');
    Route::put('/almacen/SetActualizarAlmacen','AlmacenController@SetActualizarAlmacen');
    Route::put('/almacen/SetFlagActivaPorDefecto','AlmacenController@SetFlagActivaPorDefecto');

    Route::get('/persona/GetLstPersona','PersonaController@GetLstPersona');

    Route::post('/proyecto/importFileProyecto','ExcelController@importFileProyecto');
    Route::post('/proyecto/readFileProyecto', 'ExcelController@readFileProyecto');
    Route::post('/proyecto/AddonSetProyecto', 'IntProyectoController@AddonSetProyecto');
    Route::post('/proyecto/AddonIntegraSetProyecto','IntProyectoController@AddonIntegraSetProyecto');
    Route::get('/proyecto/AddonGetProyecto','IntProyectoController@AddonGetProyecto');

    //INTEGRACION SQL SERVER
    Route::post('/articulo/SetIntegraArticulo','IntArticuloController@SetIntegraArticulo');
    Route::post('/proyecto/SetIntegraProyecto','IntProyectoController@SetIntegraProyecto');
    Route::post('/tarjetaequipo/SetIntegraTarjetaEquipo','IntTarjetaEquipoController@SetIntegraTarjetaEquipo');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicioCompra','IntLlamadaServicioController@SetIntegraLlamadaServicioCompra');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicioVenta','IntLlamadaServicioController@SetIntegraLlamadaServicioVenta');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicio','IntLlamadaServicioController@SetIntegraLlamadaServicio');
    Route::post('/solucion/SetIntegraSolucion','IntLlamadaServicioController@SetIntegraSolucion');
    Route::post('/compra/SetIntegraCompra', 'CompraController@SetIntegraCompra');
    Route::post('/compra/SetIntegraCompraWO', 'CompraController@SetIntegraCompraWO');
    Route::post('/mercancia/SetIntegraMercancia', 'IntMercanciaController@SetIntegraMercancia');
    Route::post('/mercancia/SetIntegraMercanciaCompra', 'IntMercanciaController@SetIntegraMercanciaCompra');
    Route::post('/mercancia/SetIntegraMercanciaExit', 'IntMercanciaController@SetIntegraMercanciaExit');
    Route::post('/actividad/SetIntegraActividad','IntActividadController@SetIntegraActividad');
    Route::post('/actividad/SetIntegraActividadCompra','IntActividadController@SetIntegraActividadCompra');
    Route::post('/actividad/SetIntegraActividadVenta','IntActividadController@SetIntegraActividadVenta');
    Route::get('/actividad/GetIntegraActividadByItemCode','IntActividadController@GetIntegraActividadByItemCode');
    Route::post('/actividad/GetIntegraActividadVentaByItemCode','IntActividadController@GetIntegraActividadVentaByItemCode');
    Route::post('/actividad/SetIntegraActividadByServiceCall','IntActividadController@SetIntegraActividadByServiceCall');
    Route::get('/actividad/GetIntegraActividadWOByItemCode','IntActividadController@GetIntegraActividadWOByItemCode');
    Route::get('/actividad/GetIntegraActividadWFByItemCode','IntActividadController@GetIntegraActividadWFByItemCode');

    Route::post('/tablacosto/GetCompraConceptosTblCosto','IntTablaCostoController@GetCompraConceptosTblCosto');
    Route::post('/tablacosto/SetIntegraTblCostoCab','IntTablaCostoController@SetIntegraTblCostoCab');
    Route::post('/tablacosto/GetCompraFleteTblCosto','IntTablaCostoController@GetCompraFleteTblCosto');
    Route::post('/tablacosto/GetWOComisionTblCosto','IntTablaCostoController@GetWOComisionTblCosto');
    Route::post('/empleado/SetIntegraEmpleado','IntEmpleadoController@SetIntegraEmpleado');
    Route::post('/woperativo/SetIntegraAsientoContableWO','WarrantOperativoController@SetIntegraAsientoContableWO');
    Route::post('/wfinaciero/SetIntegraAsientoContableWF','WarrantFinancieroController@SetIntegraAsientoContableWF');

    Route::get('/accesoriovehiculo/GetListVehiculos','AccesorioVehiculoController@GetListVehiculos');
    Route::get('/accesoriovehiculo/GetListElemetosByVehiculo','AccesorioVehiculoController@GetListElemetosByVehiculo');
    Route::post('/accesoriovehiculo/DeleteElementosByVehiculo', 'AccesorioVehiculoController@DeleteElementosByVehiculo');
    Route::post('/accesoriovehiculo/SetElementosByVehiculo', 'AccesorioVehiculoController@SetElementosByVehiculo');
    Route::get('/accesoriovehiculo/GetListAccesoriosByVehiculo','AccesorioVehiculoController@GetListAccesoriosByVehiculo');

    Route::post('/comprobante/SetIntegraComprobante', 'IntComprobanteController@SetIntegraComprobante');
    Route::post('/comprobante/SetIntegraComprobanteFR', 'IntComprobanteController@SetIntegraComprobanteFR');
    Route::post('/comprobante/SetIntegraComprobanteWarrant', 'IntComprobanteController@SetIntegraComprobanteWarrant');

    Route::get('/reportes/exportDetalleVentaRetail', 'ExcelController@exportDetalleVentaRetail');
    Route::get('/reportes/exportarVentaHGSI', 'ExcelController@exportarVentaHGSI');
    Route::get('/reportes/exportarVentaDiaria', 'ExcelController@exportarVentaDiaria');
    Route::get('/reportes/exportarStock','ExcelController@exportarStock');
    Route::get('/reportes/exportarStockGeneral','ExcelController@exportarStockGeneral');
    Route::get('/reportes/exportarMetasVenta','ExcelController@exportarMetasVenta');
    Route::get('/reportes/exportarContactosLibres','ExcelController@exportarContactosLibres');
    Route::get('/reportes/exportarDistribucionDesc','ExcelController@exportarDistribucionDesc');
    Route::get('/reportes/exportarPedidoDeposito','ExcelController@exportarPedidoDeposito');
    Route::get('/reportes/exportarCotizacionesByFitro','ExcelController@exportarCotizacionesByFitro');
    Route::get('/reportes/exportarComisiones','ExcelController@exportarComisiones');
    Route::get('/reportes/exportarComisionesAdm','ExcelController@exportarComisionesAdm');
    Route::get('/reportes/exportarComisionesJV','ExcelController@exportarComisionesJV');

    Route::get('/dsctotorgados/GetListDistribucionDesc','DescuentosOtorgadosController@GetListDistribucionDesc');
    Route::post('/dsctotorgados/SetDistribucionDesc','DescuentosOtorgadosController@SetDistribucionDesc');
    Route::get('/dsctotorgados/GetListPedidoDistribuido','DescuentosOtorgadosController@GetListPedidoDistribuido');
    Route::post('/dsctotorgados/SetUpdDocNumNC','DescuentosOtorgadosController@SetUpdDocNumNC');
    Route::post('/dsctotorgados/SetPagarNC','DescuentosOtorgadosController@SetPagarNC');

    Route::get('/sobreprecio/GetListModelos','SobrePrecioController@GetListModelos');
    Route::post('/sobreprecio/SetAsignarSPByModelo','SobrePrecioController@SetAsignarSPByModelo');
    Route::get('/sobreprecio/GetListSPModelo','SobrePrecioController@GetListSPModelo');

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
    Route::post('/gescontacto/SapPatchNameContacto', 'Api\SapContactoController@SapPatchNameContacto');
    //Compra
    Route::post('/compra/SapSetCompra', 'Api\SapCompraController@SapSetCompra');
    Route::post('/compra/SapSetCompraWO', 'Api\SapCompraController@SapSetCompraWO');
    Route::post('/compra/SapPatchCompra', 'Api\SapCompraController@SapPatchCompra');
    Route::post('/compra/SapSetFacturaProveedorCompra', 'Api\SapCompraController@SapSetFacturaProveedorCompra');
    //Entrada Mercancia
    Route::post('/mercancia/SapSetMercanciaByOC', 'Api\SapMercanciaController@SapSetMercanciaByOC');
    Route::post('/mercancia/SapSetMercanciaEntry', 'Api\SapMercanciaController@SapSetMercanciaEntry');
    Route::post('/mercancia/SapSetMercanciaExit', 'Api\SapMercanciaController@SapSetMercanciaExit');
    //Articulo
    Route::post('/articulo/SapGetValidarArticulo', 'Api\SapArticuloController@SapGetValidarArticulo');
    Route::post('/articulo/SapSetArticulo', 'Api\SapArticuloController@SapSetArticulo');
    Route::post('/articulo/SapGetCostoPromedio', 'Api\SapArticuloController@SapGetCostoPromedio');
    Route::post('/articulo/SapSetSerialNumber', 'Api\SapArticuloController@SapSetSerialNumber');
    Route::post('/articulo/SapPatchArticulo', 'Api\SapArticuloController@SapPatchArticulo');
    Route::post('/articulo/SapPatchArticuloAll', 'Api\SapArticuloController@SapPatchArticuloAll');
    Route::post('/articulo/SapGetArticulo', 'Api\SapArticuloController@SapGetArticulo');
    //Pedido
    Route::post('/pedido/SapSetPedido', 'Api\SapPedidoController@SapSetPedido');
    Route::post('/pedido/prueba', 'Api\SapPedidoController@prueba');
    //Pedido Descuento
    Route::post('/pedido/SapSetPedidoDscto', 'Api\SapPedidoController@SapSetPedidoDscto');
    //Comprobante
    Route::post('/comprobante/SapSetFactura', 'Api\SapComprobanteController@SapSetFactura');
    Route::post('/comprobante/SapSetFacturaProveedorWO', 'Api\SapComprobanteController@SapSetFacturaProveedorWO');
    Route::post('/comprobante/SapSetFacturaProveedorWF', 'Api\SapComprobanteController@SapSetFacturaProveedorWF');
    Route::post('/comprobante/SapGetComprobanteByTipo', 'Api\SapComprobanteController@SapGetComprobanteByTipo');
    Route::post('/comprobante/SapSetFacturaReservaBorrador', 'Api\SapComprobanteController@SapSetFacturaReservaBorrador');
    Route::get('/comprobante/SapGetFacturaReservaByDraftKey', 'Api\SapComprobanteController@SapGetFacturaReservaByDraftKey');
    //Proyecto
    Route::post('/proyecto/SapSetProyecto', 'Api\SapProyectoController@SapSetProyecto');
    //TarjetaEquipo
    Route::post('/tarjetaequipo/SapSetTarjetaEquipo', 'Api\SapTarjetaEquipoController@SapSetTarjetaEquipo');
    Route::post('/tarjetaequipo/SapUpdSocioNegocio', 'Api\SapTarjetaEquipoController@SapUpdSocioNegocio');
    Route::post('/tarjetaequipo/SapUpdTarjetaPlaca', 'Api\SapTarjetaEquipoController@SapUpdTarjetaPlaca');
    Route::post('/tarjetaequipo/SapGetTarjetaEquipo', 'Api\SapTarjetaEquipoController@SapGetTarjetaEquipo');
    //LlamadaServicio
    Route::post('/llamadaservicio/SapSetLlamadaServicio', 'Api\SapLlamadaServicioController@SapSetLlamadaServicio');
    Route::post('/llamadaservicio/SapSetLlamadaServicioCompra', 'Api\SapLlamadaServicioController@SapSetLlamadaServicioCompra');
    Route::post('/llamadaservicio/SapSetLlamadaServicioVenta', 'Api\SapLlamadaServicioController@SapSetLlamadaServicioVenta');
    Route::post('/llamadaservicio/SapCloseLlamadaServicio', 'Api\SapLlamadaServicioController@SapCloseLlamadaServicio');
    Route::post('/solucion/SapSetSolucion', 'Api\SapLlamadaServicioController@SapSetSolucion');
    //Actividad
    Route::post('/actividad/SapSetActividadCompra', 'Api\SapActividadController@SapSetActividadCompra');
    Route::post('/actividad/SapSetActividadMercancia', 'Api\SapActividadController@SapSetActividadMercancia');
    Route::post('/actividad/SapSetActividadVenta', 'Api\SapActividadController@SapSetActividadVenta');
    Route::post('/actividad/SapSetActividad', 'Api\SapActividadController@SapSetActividad');
    Route::post('/actividad/SapSetActividadByServiceCallId', 'Api\SapActividadController@SapSetActividadByServiceCallId');
    //Tabla Costos
    Route::post('/tablacosto/SapSetTablaCostoCabecera','Api\SapTablaCostoController@SapSetTablaCostoCabecera');
    Route::post('/tablacosto/SapPachTablaCostoDetalle','Api\SapTablaCostoController@SapPachTablaCostoDetalle');
    Route::post('/tablacosto/SapPachTablaCosto','Api\SapTablaCostoController@SapPachTablaCosto');
    Route::post('/tablacosto/SapPachTablaCostoDscto','Api\SapTablaCostoController@SapPachTablaCostoDscto');
    Route::post('/tablacosto/SapPachTablaCostoDsctoPedidoDscto','Api\SapTablaCostoController@SapPachTablaCostoDsctoPedidoDscto');
    //Tipo Cambio
    Route::get('/tipocambio/SapGetTipoCambioByFecha', 'Api\SapTipoCambioController@SapGetTipoCambioByFecha');
    //Vendedor
    Route::post('/empleado/SapSetEmpleado', 'Api\SapEmpleadoController@SapSetEmpleado');
    Route::post('/empleado/SapPatchEmpleado', 'Api\SapEmpleadoController@SapPatchEmpleado');
    //Asiento Contable
    Route::post('/asiento/SapSetAsientoContableWO', 'Api\SapAsientoContableController@SapSetAsientoContableWO');
    Route::post('/asiento/SapSetAsientoContableWF', 'Api\SapAsientoContableController@SapSetAsientoContableWF');

    /// ============================================================
    /// METODOS ODBC
    /// ============================================================
    //Ubigeo
    Route::get('/ubigeo/SapGetUbigeo', 'Api\SapUbigeoController@SapGetUbigeo');
});
