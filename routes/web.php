<?php

Route::get('/','Auth\LoginController@showLoginForm')->name('formlogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');

Route::middleware(['auth'])->group(function(){
    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout')->middleware('verificarusuario');

    Route::get('/perrelacion/GetLstEmpresaByUsuario', 'PerRelacionController@GetLstEmpresaByUsuario')->middleware('verificarusuario');
    Route::get('/perrelacion/GetLstSucursalByEmpresa', 'PerRelacionController@GetLstSucursalByEmpresa')->middleware('verificarusuario');

    Route::get('/parametro/GetParametroByGrupo', 'ParametroController@GetParametroByGrupo')->middleware('verificarusuario');
    Route::get('/parametro/GetLstProveedor', 'ParametroController@GetLstProveedor')->middleware('verificarusuario');
    Route::get('/parametro/GetLineasByProveedor', 'ParametroController@GetLineasByProveedor')->middleware('verificarusuario');
    Route::get('/parametro/GetMarcasByProveedor', 'ParametroController@GetMarcasByProveedor')->middleware('verificarusuario');
    Route::get('/parametro/GetModelosByProveedor', 'ParametroController@GetModelosByProveedor')->middleware('verificarusuario');
    Route::get('/parametro/GetDocumentoNatural', 'ParametroController@GetDocumentoNatural')->middleware('verificarusuario');
    Route::get('/parametro/GetDocumentoJuridica', 'ParametroController@GetDocumentoJuridica')->middleware('verificarusuario');
    Route::get('/parametro/GetParametroById', 'ParametroController@GetParametroById')->middleware('verificarusuario');
    Route::get('/parametro/GetListParametroByGrupo', 'ParametroController@GetListParametroByGrupo')->middleware('verificarusuario');
    Route::get('/parametro/GetListSucursalByEmpresa', 'ParametroController@GetListSucursalByEmpresa')->middleware('verificarusuario');
    Route::get('/parametro/GetListParametroByNombre', 'ParametroController@GetListParametroByNombre')->middleware('verificarusuario');
    Route::get('/parametro/GetParametroByNombre', 'ParametroController@GetParametroByNombre')->middleware('verificarusuario');
    Route::get('/parametro/GetLstProveedorTodos', 'ParametroController@GetLstProveedorTodos')->middleware('verificarusuario');
    Route::post('/parametro/SetParametro', 'ParametroController@SetParametro')->middleware('verificarusuario');
    Route::post('/parametro/UpdParametroById', 'ParametroController@UpdParametroById')->middleware('verificarusuario');
    Route::put('/parametro/desactivar','ParametroController@desactivar')->middleware('verificarusuario');
    Route::put('/parametro/activar','ParametroController@activar')->middleware('verificarusuario');
    Route::get('/parametro/GetLineaMarcaModelo','ParametroController@GetLineaMarcaModelo')->middleware('verificarusuario');
    Route::post('/parametro/SetLineaMarcaModelo','ParametroController@SetLineaMarcaModelo')->middleware('verificarusuario');
    Route::put('/parametro/LineaMarcaModeloDesactiva','ParametroController@LineaMarcaModeloDesactiva')->middleware('verificarusuario');
    Route::put('/parametro/LineaMarcaModeloActiva','ParametroController@LineaMarcaModeloActiva')->middleware('verificarusuario');

    Route::get('/parparametro/GetListParParametroByGrupoTodos', 'ParParametroController@GetListParParametroByGrupoTodos')->middleware('verificarusuario');
    Route::post('/parparametro/SetParParametro', 'ParParametroController@SetParParametro')->middleware('verificarusuario');
    Route::post('/parparametro/ElmParParametro', 'ParParametroController@ElmParParametro')->middleware('verificarusuario');
    Route::get('/parparametro/GetParParametro', 'ParParametroController@GetParParametro')->middleware('verificarusuario');
    Route::get('/tipoparametro/GetTipoByIdParametro', 'ParametroController@GetTipoByIdParametro')->middleware('verificarusuario');
    Route::post('/tipoparametro/UpdTipoParametroById', 'ParametroController@UpdTipoParametroById')->middleware('verificarusuario');
    Route::get('/grupopar/GetGrupoParametroEventoCampania', 'GrupoParametroController@GetGrupoParametroEventoCampania')->middleware('verificarusuario');
    Route::get('/grupopar/GetListGrupoParametro', 'GrupoParametroController@GetListGrupoParametro')->middleware('verificarusuario');

    Route::get('/elemento/GetElementoByTipo', 'ElementoController@GetElementoByTipo')->middleware('verificarusuario');
    Route::post('/elemento/SetElemento', 'ElementoController@store')->middleware('verificarusuario');
    Route::put('/elemento/desactivar','ElementoController@desactivar')->middleware('verificarusuario');
    Route::put('/elemento/activar','ElementoController@activar')->middleware('verificarusuario');
    Route::post('/elemento/UpdElementoById', 'ElementoController@UpdElementoById')->middleware('verificarusuario');

    Route::post('/versionvehiculo/SetVersion', 'VersionVehiculoController@store')->middleware('verificarusuario');
    Route::get('/versionvehiculo/GetVersionVehiculo', 'VersionVehiculoController@GetVersionVehiculo')->middleware('verificarusuario');
    Route::post('/versionvehiculo/UpdVersionVehiculoById', 'VersionVehiculoController@UpdVersionVehiculoById')->middleware('verificarusuario');
    Route::put('/versionvehiculo/desactivar','VersionVehiculoController@desactivar')->middleware('verificarusuario');
    Route::put('/versionvehiculo/activar','VersionVehiculoController@activar')->middleware('verificarusuario');
    Route::get('/versionvehiculo/GetLineasByProveedor', 'VersionVehiculoController@GetLineasByProveedor')->middleware('verificarusuario');
    Route::get('/versionvehiculo/GetMarcaByLinea', 'VersionVehiculoController@GetMarcaByLinea')->middleware('verificarusuario');
    Route::get('/versionvehiculo/GetModeloByMarca', 'VersionVehiculoController@GetModeloByMarca')->middleware('verificarusuario');
    Route::get('/versionvehiculo/GetSubLineaByLinea', 'VersionVehiculoController@GetSubLineaByLinea')->middleware('verificarusuario');

    Route::post('/compra/importFileCompra', 'ExcelController@importFileCompra')->middleware('verificarusuario');
    Route::post('/compra/readFileCompra', 'ExcelController@readFileCompra')->middleware('verificarusuario');
    Route::post('/compra/SetCompra', 'CompraController@SetCompra')->middleware('verificarusuario');
    Route::get('/compra/GetCompra', 'CompraController@GetCompra')->middleware('verificarusuario');
    Route::put('/compra/desactivar','CompraController@desactivar')->middleware('verificarusuario');
    Route::post('/compra/importFileForum', 'ExcelController@importFileForum')->middleware('verificarusuario');
    Route::post('/compra/readFileForum', 'ExcelController@readFileForum')->middleware('verificarusuario');
    Route::post('/compra/SetForum', 'CompraController@SetForum')->middleware('verificarusuario');
    Route::get('/compra/GetCompraSinWOperativo', 'CompraController@GetCompraSinWOperativo')->middleware('verificarusuario');
    Route::get('/compra/GetCompraSinWFinanciero', 'CompraController@GetCompraSinWFinanciero')->middleware('verificarusuario');
    Route::post('/compra/UpdCompraById', 'CompraController@UpdCompraById')->middleware('verificarusuario');
    Route::get('/compra/GetLstCompraNoLineaCredito', 'CompraController@GetLstCompraNoLineaCredito')->middleware('verificarusuario');
    Route::post('/compra/UpdCompraLineaCreditoById', 'CompraController@UpdCompraLineaCreditoById')->middleware('verificarusuario');
    Route::get('/compra/GetListaPrecioByProveedor', 'CompraController@GetListaPrecioByProveedor')->middleware('verificarusuario');
    Route::put('/compra/activar','CompraController@activar')->middleware('verificarusuario');

    Route::get('/listapreciovh/GetListaVh', 'ListaPrecioVersionVehController@GetListaVh')->middleware('verificarusuario');
    Route::post('/listapreciovh/SetListaVh', 'ListaPrecioVersionVehController@SetListaVh')->middleware('verificarusuario');
    Route::post('/listapreciovh/importFileListaPrecioVh', 'ExcelController@importFileListaPrecioVh')->middleware('verificarusuario');
    Route::post('/listapreciovh/readFileListaPrecioVh', 'ExcelController@readFileListaPrecioVh')->middleware('verificarusuario');
    Route::post('/listapreciovh/SetListaPrecioVhDetalle', 'ListaPrecioVersionVehController@store')->middleware('verificarusuario');
    Route::get('/listapreciovh/GetListaVhDetalle', 'ListaPrecioVersionVehController@GetListaVhDetalle')->middleware('verificarusuario');
    Route::put('/listapreciovh/activar','ListaPrecioVersionVehController@activar')->middleware('verificarusuario');
    Route::put('/listapreciovh/desactivar','ListaPrecioVersionVehController@desactivar')->middleware('verificarusuario');
    Route::put('/listapreciovh/desactivarDetalle','ListaPrecioVersionVehController@desactivarDetalle')->middleware('verificarusuario');

    Route::get('/woperativo/GetWOperativo', 'WarrantOperativoController@GetWOperativo')->middleware('verificarusuario');
    Route::post('/woperativo/SetWOperativo', 'WarrantOperativoController@SetWOperativo')->middleware('verificarusuario');
    Route::post('/woperativo/SetWOperativoDetalle', 'WarrantOperativoController@SetWOperativoDetalle')->middleware('verificarusuario');
    Route::get('/woperativo/GetWOperativoDetalle', 'WarrantOperativoController@GetWOperativoDetalle')->middleware('verificarusuario');

    Route::get('/wfinanciero/GetWFinanciero', 'WarrantFinancieroController@GetWFinanciero')->middleware('verificarusuario');
    Route::post('/wfinanciero/SetWFinanciero', 'WarrantFinancieroController@SetWFinanciero')->middleware('verificarusuario');
    Route::post('/wfinanciero/SetWFinancieroDetalle', 'WarrantFinancieroController@SetWFinancieroDetalle')->middleware('verificarusuario');
    Route::get('/wfinanciero/GetWFinancieroDetalle', 'WarrantFinancieroController@GetWFinancieroDetalle')->middleware('verificarusuario');

    Route::post('/ec/SetEventoCampania', 'EventoCampaniaController@store')->middleware('verificarusuario');
    Route::post('/ec/SetDetalleEventoCampania', 'EventoCampaniaController@SetDetalleEventoCampania')->middleware('verificarusuario');
    Route::post('/ec/SetEventoElementoVenta', 'EventoCampaniaController@SetEventoElementoVenta')->middleware('verificarusuario');
    Route::post('/ec/SetDistribucionEventoByEC', 'EventoCampaniaController@SetDistribucionEventoByEC')->middleware('verificarusuario');
    Route::post('/ec/SetDistribucionEventoByElemento', 'EventoCampaniaController@SetDistribucionEventoByElemento')->middleware('verificarusuario');
    Route::get('/ec/GetEventoCampania', 'EventoCampaniaController@GetEventoCampania')->middleware('verificarusuario');
    Route::get('/ec/GetDistribucionByElementoVenta', 'EventoCampaniaController@GetDistribucionByElementoVenta')->middleware('verificarusuario');
    Route::put('/ec/desactivar', 'EventoCampaniaController@desactivar')->middleware('verificarusuario');
    Route::put('/ec/activar', 'EventoCampaniaController@activar')->middleware('verificarusuario');
    Route::post('/ec/SetEntregaEventoElementoVenta', 'EventoCampaniaController@SetEntregaEventoElementoVenta')->middleware('verificarusuario');

    Route::get('/ubigeo/GetDptos', 'UbigeoController@GetDptos')->middleware('verificarusuario');
    Route::get('/ubigeo/GetProvinciasByDpto', 'UbigeoController@GetProvinciasByDpto')->middleware('verificarusuario');
    Route::get('/ubigeo/GetDistritosByProv', 'UbigeoController@GetDistritosByProv')->middleware('verificarusuario');
    Route::get('/ubigeo/GetUbigeo', 'UbigeoController@GetUbigeo')->middleware('verificarusuario');

    Route::get('/gescontacto/GetLineasByUsuario', 'GestionContactoController@GetLineasByUsuario')->middleware('verificarusuario');
    Route::get('/gescontacto/GetMarcaByLinea', 'GestionContactoController@GetMarcaByLinea')->middleware('verificarusuario');
    Route::get('/gescontacto/GetModeloByMarca', 'GestionContactoController@GetModeloByMarca')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoPerNatural', 'GestionContactoController@SetContactoPerNatural')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoPerJuridica', 'GestionContactoController@SetContactoPerJuridica')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoRefVehiculo', 'GestionContactoController@SetContactoRefVehiculo')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoSegRefVehiculo', 'GestionContactoController@SetContactoSegRefVehiculo')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListContactoByVendedor', 'GestionContactoController@GetListContactoByVendedor')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoCarteraMes', 'GestionContactoController@SetContactoCarteraMes')->middleware('verificarusuario');
    Route::post('/gescontacto/SetContactoCarteraMesTodos', 'GestionContactoController@SetContactoCarteraMesTodos')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListContactoBySinCarteraMes', 'GestionContactoController@GetListContactoBySinCarteraMes')->middleware('verificarusuario');
    Route::get('/gescontacto/GetCarteraMesByVendedor', 'GestionContactoController@GetCarteraMesByVendedor')->middleware('verificarusuario');
    Route::get('/gescontacto/GetContactoNaturalById', 'GestionContactoController@GetContactoNaturalById')->middleware('verificarusuario');
    Route::get('/gescontacto/GetContactoJuridicoById', 'GestionContactoController@GetContactoJuridicoById')->middleware('verificarusuario');
    Route::get('/gescontacto/GetRefVehiculoByContacto', 'GestionContactoController@GetRefVehiculoByContacto')->middleware('verificarusuario');
    Route::post('/gescontacto/SetSeguimiento', 'GestionContactoController@SetSeguimiento')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListSeguimientoByIdAsignacion', 'GestionContactoController@GetListSeguimientoByIdAsignacion')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListVendedoresByJFV', 'GestionContactoController@GetListVendedoresByJFV')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListContactoByJFV', 'GestionContactoController@GetListContactoByJFV')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListContactosLibres', 'GestionContactoController@GetListContactosLibres')->middleware('verificarusuario');
    Route::get('/gescontacto/GetListReferenciaVehiculoLibre', 'GestionContactoController@GetListReferenciaVehiculoLibre')->middleware('verificarusuario');
    Route::post('/gescontacto/SetAsignaReferenciaLibre', 'GestionContactoController@SetAsignaReferenciaLibre')->middleware('verificarusuario');
    //Route::get('/gescontacto/GetRefVehiculoByContactoPorReasignar', 'GestionContactoController@GetRefVehiculoByContactoPorReasignar')->middleware('verificarusuario');
    Route::post('/gescontacto/UpdReasignarReferenciaVehiculo', 'GestionContactoController@UpdReasignarReferenciaVehiculo')->middleware('verificarusuario');
    Route::get('/gescontacto/UpdReasignarContacto', 'GestionContactoController@UpdReasignarContacto')->middleware('verificarusuario');
    Route::get('/gescontacto/GetRefVehiculoByContacto_JFV', 'GestionContactoController@GetRefVehiculoByContacto_JFV')->middleware('verificarusuario');
    Route::post('/gescontacto/importFileLeads', 'ExcelController@importFileLeads')->middleware('verificarusuario');
    Route::post('/gescontacto/readFileLeads', 'ExcelController@readFileLeads')->middleware('verificarusuario');
    Route::post('/gescontacto/SetLeads', 'GestionContactoController@SetLeads')->middleware('verificarusuario');
    Route::get('/gescontacto/GetEstadoAsignacionSeguimiento', 'GestionContactoController@GetEstadoAsignacionSeguimiento')->middleware('verificarusuario');
    Route::put('/gescontacto/desactivarSeguimiento', 'GestionContactoController@desactivarSeguimiento')->middleware('verificarusuario');
    Route::post('/gescontacto/SetAmpliacionFechaVenceAsignacion', 'GestionContactoController@SetAmpliacionFechaVenceAsignacion')->middleware('verificarusuario');
    Route::post('/gescontacto/UpdCardCodeContacto', 'GestionContactoController@UpdCardCodeContacto')->middleware('verificarusuario');

    Route::get('/pedido/GetLstCotizacionIngresadas', 'PedidoController@GetLstCotizacionIngresadas')->middleware('verificarusuario');
    Route::get('/pedido/GetLstCompraByIdModelo', 'PedidoController@GetLstCompraByIdModelo')->middleware('verificarusuario');
    Route::get('/pedido/GetListaPrecioDetalleByIdCotizacion', 'PedidoController@GetListaPrecioDetalleByIdCotizacion')->middleware('verificarusuario');
    Route::post('/pedido/subirArchivo', 'PedidoController@subirArchivo')->middleware('verificarusuario');
    Route::post('/pedido/SetCabeceraPedido', 'PedidoController@SetCabeceraPedido')->middleware('verificarusuario');
    Route::get('/pedido/GetListPedidoByTipoEstado', 'PedidoController@GetListPedidoByTipoEstado')->middleware('verificarusuario');
    Route::get('/pedido/GetListPedidoAprobados', 'PedidoController@GetListPedidoAprobados')->middleware('verificarusuario');
    Route::get('/pedido/GetLstPedidosPendienteAprobacion', 'PedidoController@GetLstPedidosPendienteAprobacion')->middleware('verificarusuario');
    Route::put('/pedido/SetAprobarPedido', 'PedidoController@SetAprobarPedido')->middleware('verificarusuario');
    Route::get('/pedido/GetDocumentoByFormaPago', 'PedidoController@GetDocumentoByFormaPago')->middleware('verificarusuario');
    Route::get('/pedido/GetDocumentosById', 'PedidoController@GetDocumentosById')->middleware('verificarusuario');
    Route::put('/pedido/SetAnularPedido', 'PedidoController@SetAnularPedido')->middleware('verificarusuario');
    Route::get('/pedido/GetLstDetallePedido', 'PedidoController@GetLstDetallePedido')->middleware('verificarusuario');
    Route::post('/pedido/GetDetallePedido', 'PedidoController@GetDetallePedido')->middleware('verificarusuario');
    Route::get('/pedido/GetListPedidoForDscto', 'PedidoController@GetListPedidoForDscto')->middleware('verificarusuario');
    Route::get('/pedido/GetListHistorialPedidoDscto', 'PedidoController@GetListHistorialPedidoDscto')->middleware('verificarusuario');
    Route::post('/pedido/SetHistorialPedidoDscto', 'PedidoController@SetHistorialPedidoDscto')->middleware('verificarusuario');
    Route::get('/pedido/GetDireccionPersonaByPersona', 'PedidoController@GetDireccionPersonaByPersona')->middleware('verificarusuario');
    Route::get('/pedido/GetDireccionesByPersona', 'PedidoController@GetDireccionesByPersona')->middleware('verificarusuario');
    Route::post('/pedido/SetRegistrarDireccionPersona', 'PedidoController@SetRegistrarDireccionPersona')->middleware('verificarusuario');
    Route::get('/pedido/GetObtenerTipoPersona', 'PedidoController@GetObtenerTipoPersona')->middleware('verificarusuario');
    Route::get('/pedido/GetListContactoBySinCarteraMes', 'PedidoController@GetListContactoBySinCarteraMes')->middleware('verificarusuario');
    Route::get('/pedido/GetPedidoById', 'PedidoController@GetPedidoById')->middleware('verificarusuario');
    Route::get('/pedido/GetPedidoEVById', 'PedidoController@GetPedidoEVById')->middleware('verificarusuario');
    Route::get('/pedido/GetCampaniaObsequioByIdPedido', 'PedidoController@GetCampaniaObsequioByIdPedido')->middleware('verificarusuario');
    Route::post('/pedido/SapUpdPedidoByDocEntry', 'PedidoController@SapUpdPedidoByDocEntry')->middleware('verificarusuario');
    Route::post('/pedido/SapUpdFacturaByDocEntry', 'PedidoController@SapUpdFacturaByDocEntry')->middleware('verificarusuario');

    Route::get('/deposito/GetNumeroCuentaByBancoAndMoneda', 'PedidoDepositoController@GetNumeroCuentaByBancoAndMoneda')->middleware('verificarusuario');
    Route::get('/deposito/GetParDsctByParSrc', 'PedidoDepositoController@GetParDsctByParSrc')->middleware('verificarusuario');
    Route::post('/deposito/subirArchivo', 'PedidoDepositoController@subirArchivo')->middleware('verificarusuario');
    Route::post('/deposito/SetDepositoPedido', 'PedidoDepositoController@SetDepositoPedido')->middleware('verificarusuario');
    Route::get('/deposito/GetMontoTotalDepositos', 'PedidoDepositoController@GetMontoTotalDepositos')->middleware('verificarusuario');
    Route::get('/deposito/GetListPedidoConDeposito', 'PedidoDepositoController@GetListPedidoConDeposito')->middleware('verificarusuario');
    Route::get('/deposito/GetListDepositosPorPedido', 'PedidoDepositoController@GetListDepositosPorPedido')->middleware('verificarusuario');
    Route::put('/deposito/SetCambiarEstadoDeposito', 'PedidoDepositoController@SetCambiarEstadoDeposito')->middleware('verificarusuario');
    Route::put('/deposito/SetCambiarEstadoPedido', 'PedidoDepositoController@SetCambiarEstadoPedido')->middleware('verificarusuario');
    Route::put('/deposito/SetCambiarMontosDepositoByTCE', 'PedidoDepositoController@SetCambiarMontosDepositoByTCE')->middleware('verificarusuario');

    Route::get('/tipocambio/GetTipoCambioById', 'TipoCambioController@GetTipoCambioById')->middleware('verificarusuario');
    Route::get('/tipocambio/GetTipoCambioByFecha', 'TipoCambioController@GetTipoCambioByFecha')->middleware('verificarusuario');
    Route::post('/tipocambio/SetRegistrarTipoCambio', 'TipoCambioController@SetRegistrarTipoCambio')->middleware('verificarusuario');
    Route::post('/tipocambio/SetActualizarTipoCambio', 'TipoCambioController@SetActualizarTipoCambio')->middleware('verificarusuario');

    Route::post('/tipoinspeccion/SetTipoInspeccion', 'PdiTipoInspeccionController@SetTipoInspeccion')->middleware('verificarusuario');
    Route::get('/tipoinspeccion/GetListTipoInspeccion', 'PdiTipoInspeccionController@GetListTipoInspeccion')->middleware('verificarusuario');
    Route::put('/tipoinspeccion/activar', 'PdiTipoInspeccionController@activar')->middleware('verificarusuario');
    Route::put('/tipoinspeccion/desactivar', 'PdiTipoInspeccionController@desactivar')->middleware('verificarusuario');
    Route::post('/tipoinspeccion/UpdTipoInspeccionById', 'PdiTipoInspeccionController@UpdTipoInspeccionById')->middleware('verificarusuario');
    Route::get('/tipoinspeccion/GetFillTipoInspeccion', 'PdiTipoInspeccionController@GetFillTipoInspeccion')->middleware('verificarusuario');

    Route::get('/plantilla/GetListItems', 'PdiPlantillaSeccionController@GetListItems')->middleware('verificarusuario');
    Route::post('/plantilla/SetItemPlantilla', 'PdiPlantillaSeccionController@SetItemPlantilla')->middleware('verificarusuario');
    Route::put('/plantilla/activar', 'PdiPlantillaSeccionController@activar')->middleware('verificarusuario');
    Route::put('/plantilla/desactivar', 'PdiPlantillaSeccionController@desactivar')->middleware('verificarusuario');

    Route::get('/puntoinspeccion/GetListPuntoInspeccion', 'PdiPuntoInspeccionController@GetListPuntoInspeccion')->middleware('verificarusuario');
    Route::post('/puntoinspeccion/SetPuntoInspeccion', 'PdiPuntoInspeccionController@SetPuntoInspeccion')->middleware('verificarusuario');
    Route::post('/puntoinspeccion/UpdPuntoInspeccionById', 'PdiPuntoInspeccionController@UpdPuntoInspeccionById')->middleware('verificarusuario');
    Route::put('/puntoinspeccion/activar', 'PdiPuntoInspeccionController@activar')->middleware('verificarusuario');
    Route::put('/puntoinspeccion/desactivar', 'PdiPuntoInspeccionController@desactivar')->middleware('verificarusuario');

    Route::get('/puga/GetListMenuByUsuario', 'PerUsuGruAccController@GetListMenuByUsuario')->middleware('verificarusuario');
    Route::get('/puga/GetLstUsuarios', 'PerUsuGruAccController@GetLstUsuarios')->middleware('verificarusuario');
    Route::get('/puga/GetListPermisosByUsuario', 'PerUsuGruAccController@GetListPermisosByUsuario')->middleware('verificarusuario');
    Route::post('/puga/SetPermisosByUsuario', 'PerUsuGruAccController@SetPermisosByUsuario')->middleware('verificarusuario');
    Route::post('/puga/DeletePermisosByUsuario', 'PerUsuGruAccController@DeletePermisosByUsuario')->middleware('verificarusuario');
    //Asignación Jefe Ventas
    Route::get('/puga/GetListUsuarios2', 'PerUsuGruAccController@GetListUsuarios2')->middleware('verificarusuario');
    Route::post('/puga/SetAsignarJefeVentas', 'PerUsuGruAccController@SetAsignarJefeVentas')->middleware('verificarusuario');

    Route::get('/pdi/GetListSolicitudByEstado', 'PdiProcesoController@GetListSolicitudByEstado')->middleware('verificarusuario');
    Route::get('/pdi/GetListCompra', 'PdiProcesoController@GetListCompra')->middleware('verificarusuario');
    Route::get('/pdi/GetListSeccion', 'PdiProcesoController@GetListSeccion')->middleware('verificarusuario');
    Route::get('/pdi/GetListItem', 'PdiProcesoController@GetListItem')->middleware('verificarusuario');
    Route::post('/pdi/SetCabeceraInspeccion', 'PdiProcesoController@SetCabeceraInspeccion')->middleware('verificarusuario');
    Route::get('/pdi/GetListPdi', 'PdiProcesoController@GetListPdi')->middleware('verificarusuario');
    Route::get('/pdi/GetDetalleTipoInspeccionById', 'PdiProcesoController@GetDetalleTipoInspeccionById')->middleware('verificarusuario');
    Route::get('/pdi/GetListPuntoInspeccion', 'PdiProcesoController@GetListPuntoInspeccion')->middleware('verificarusuario');
    Route::post('/pdi/UpdCabeceraInspeccion', 'PdiProcesoController@UpdCabeceraInspeccion')->middleware('verificarusuario');
    Route::post('/pdi/SetPlantillaPdi', 'PdiProcesoController@SetPlantillaPdi')->middleware('verificarusuario');
    Route::post('/pdi/SetAccesorioPdi', 'PdiProcesoController@SetAccesorioPdi')->middleware('verificarusuario');
    Route::post('/pdi/SetCabeceraInspeccionDocumento', 'PdiProcesoController@SetCabeceraInspeccionDocumento')->middleware('verificarusuario');

    Route::post('/documentoadjunto/subirArchivo', 'DocumentoAdjuntoController@subirArchivo')->middleware('verificarusuario');

    Route::get('/gescotizacion/GetListReferencias', 'CotizacionController@GetListReferencias')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetTipoLista', 'CotizacionController@GetTipoLista')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListVehiculos', 'CotizacionController@GetListVehiculos')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetTipoCambio', 'CotizacionController@GetTipoCambio')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListCampañasByVehiculo', 'CotizacionController@GetListCampañasByVehiculo')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListEventoElementoVenta', 'CotizacionController@GetListEventoElementoVenta')->middleware('verificarusuario');
    Route::post('/gescotizacion/SetCabeceraCotizacion', 'CotizacionController@SetCabeceraCotizacion')->middleware('verificarusuario');
    Route::post('/gescotizacion/SetDetalleCotizacion', 'CotizacionController@SetDetalleCotizacion')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListCotizacionesByIdVendedor', 'CotizacionController@GetListCotizacionesByIdVendedor')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetElementoByTipo', 'CotizacionController@GetElementoByTipo')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetRefVehiculoByContacto', 'CotizacionController@GetRefVehiculoByContacto')->middleware('verificarusuario');
    Route::put('/setcotizacion/SetCambiarEstadoCotizacion', 'CotizacionController@SetCambiarEstadoCotizacion')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetLstCotizacionPendientes', 'CotizacionController@GetLstCotizacionPendientes')->middleware('verificarusuario');
    //Route::get('/getcotizacion/GetLstCotizacionPendienteADV', 'CotizacionController@GetLstCotizacionPendienteADV')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetDistribucionBySuperaDscto', 'CotizacionController@GetDistribucionBySuperaDscto')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetDistribucionByElementoVenta', 'CotizacionController@GetDistribucionByElementoVenta')->middleware('verificarusuario');
    Route::post('/setcotizacion/SetDistribucionCotizacion', 'CotizacionController@SetDistribucionCotizacion')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetLstDetalleCotizacion', 'CotizacionController@GetLstDetalleCotizacion')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetDatosCotizacion', 'CotizacionController@GetDatosCotizacion')->middleware('verificarusuario');
    Route::post('/getcotizacion/GetDetalleCotizacion', 'CotizacionController@GetDetalleCotizacion')->middleware('verificarusuario');
    Route::get('/getcotizacion/GetListContactoByVendedor', 'CotizacionController@GetListContactoByVendedor')->middleware('verificarusuario');

    Route::get('/getComision/GetLineasByProveedor', 'ComisionController@GetLineasByProveedor')->middleware('verificarusuario');
    Route::get('/getComision/GetParametroByGrupo', 'ComisionController@GetParametroByGrupo')->middleware('verificarusuario');
    Route::post('/getComision/SetRegistrarComision', 'ComisionController@SetRegistrarComision')->middleware('verificarusuario');
    Route::get('/getComision/GetListComisiones', 'ComisionController@GetListComisiones')->middleware('verificarusuario');

    Route::get('/objComercial/getCompraActiva', 'ObjComercialController@getCompraActiva')->middleware('verificarusuario');
    Route::get('/objComercial/GetLstTipoBeneficio', 'ObjComercialController@GetLstTipoBeneficio')->middleware('verificarusuario');
    Route::get('/objComercial/getVentaActiva', 'ObjComercialController@getVentaActiva')->middleware('verificarusuario');
    Route::get('/objComercial/GetDetalleVehiculoCompra', 'ObjComercialController@GetDetalleVehiculoCompra')->middleware('verificarusuario');
    Route::post('/objComercial/SetRegistrarObjComercialCompra', 'ObjComercialController@SetRegistrarObjComercialCompra')->middleware('verificarusuario');
    Route::get('/objComercial/GetDetalleVehiculoVenta', 'ObjComercialController@GetDetalleVehiculoVenta')->middleware('verificarusuario');
    Route::post('/objComercial/SetRegistrarObjComercialVenta', 'ObjComercialController@SetRegistrarObjComercialVenta')->middleware('verificarusuario');

    Route::get('/asigVendedorTurno/GetParametroByParParent', 'AsigVendedorTurnoController@GetParametroByParParent')->middleware('verificarusuario');
    Route::post('/asigVendedorTurno/SetRegistrarVendedorTurno', 'AsigVendedorTurnoController@SetRegistrarVendedorTurno')->middleware('verificarusuario');
    Route::get('/asigVendedorTurno/GeLstDetalleTurno', 'AsigVendedorTurnoController@GeLstDetalleTurno')->middleware('verificarusuario');

    Route::get('/cartacaracteristica/GeLstCompras', 'CartaCaracteristicaController@GeLstCompras')->middleware('verificarusuario');
    Route::get('/cartacaracteristica/GetLstCotizacionAprobadas', 'CartaCaracteristicaController@GetLstCotizacionAprobadas')->middleware('verificarusuario');
    Route::post('/cartacaracteristica/SetRegistrarSCC', 'CartaCaracteristicaController@SetRegistrarSCC')->middleware('verificarusuario');
    Route::get('/cartacaracteristica/GetLstCartaCaracteristica', 'CartaCaracteristicaController@GetLstCartaCaracteristica')->middleware('verificarusuario');
    Route::get('/cartacaracteristica/GetLstCartaCaracteristicaByTodos', 'CartaCaracteristicaController@GetLstCartaCaracteristicaByTodos')->middleware('verificarusuario');
    Route::get('/cartacaracteristica/GetDetalleSolicitud', 'CartaCaracteristicaController@GetDetalleSolicitud')->middleware('verificarusuario');
    Route::put('/cartacaracteristica/SetConformeNoConforme', 'CartaCaracteristicaController@SetConformeNoConforme')->middleware('verificarusuario');
    Route::post('/cartacaracteristica/SetAprobadoNoAprobado', 'CartaCaracteristicaController@SetAprobadoNoAprobado')->middleware('verificarusuario');
    Route::put('/cartacaracteristica/SetAnularSCC', 'CartaCaracteristicaController@SetAnularSCC')->middleware('verificarusuario');

    Route::post('/maestrovehiculo/SetRegistrarVehiculoPlaca', 'MaestroVehiculoController@SetRegistrarVehiculoPlaca')->middleware('verificarusuario');
    Route::post('/maestrovehiculo/SetRegistrarPerNatural', 'MaestroVehiculoController@SetRegistrarPerNatural')->middleware('verificarusuario');
    Route::post('/maestrovehiculo/SetRegistrarPerJuridica', 'MaestroVehiculoController@SetRegistrarPerJuridica')->middleware('verificarusuario');
    Route::post('/maestrovehiculo/SetRegistrarSoat', 'MaestroVehiculoController@SetRegistrarSoat')->middleware('verificarusuario');
    Route::post('/maestrovehiculo/SetRegistrarPropietario', 'MaestroVehiculoController@SetRegistrarPropietario')->middleware('verificarusuario');
    Route::get('/maestrovehiculo/GetDetalleMaestroVehiculo', 'MaestroVehiculoController@GetDetalleMaestroVehiculo')->middleware('verificarusuario');

    Route::get('/autorizacion/GetLstVehiculosByCriterio', 'AutorizacionController@GetLstVehiculosByCriterio')->middleware('verificarusuario');
    Route::get('/autorizacion/GetLstContactosByUsuario', 'AutorizacionController@GetLstContactosByUsuario')->middleware('verificarusuario');
    Route::get('/autorizacion/GetLstMisSolicitudes', 'AutorizacionController@GetLstMisSolicitudes')->middleware('verificarusuario');
    Route::get('/autorizacion/GetLstSolicitudesByTodos', 'AutorizacionController@GetLstSolicitudesByTodos')->middleware('verificarusuario');
    Route::get('/autorizacion/GetRefVehiculoByContacto', 'AutorizacionController@GetRefVehiculoByContacto')->middleware('verificarusuario');
    Route::post('/autorizacion/SetRegistrarSolicitudAutorizacion', 'AutorizacionController@SetRegistrarSolicitudAutorizacion')->middleware('verificarusuario');
    Route::put('/autorizacion/SetConformeNoConforme', 'AutorizacionController@SetConformeNoConforme')->middleware('verificarusuario');

    Route::get('/tramite/GetPedidosCanceladosByEstadoTramite', 'TramiteController@GetPedidosCanceladosByEstadoTramite')->middleware('verificarusuario');
    Route::post('/tramite/SetCabeceraTramite', 'TramiteController@SetCabeceraTramite')->middleware('verificarusuario');
    Route::post('/tramite/SetTramiteTarjeta', 'TramiteController@SetTramiteTarjeta')->middleware('verificarusuario');
    Route::get('/tramite/GetSolicitudesTramites', 'TramiteController@GetSolicitudesTramites')->middleware('verificarusuario');
    Route::get('/tramite/GetDetalleSolicitudTramite', 'TramiteController@GetDetalleSolicitudTramite')->middleware('verificarusuario');
    Route::get('/tramite/GetEstadosTarjetasPlaca', 'TramiteController@GetEstadosTarjetasPlaca')->middleware('verificarusuario');
    Route::post('/tramite/SetEstadoTramiteTarjeta', 'TramiteController@SetEstadoTramiteTarjeta')->middleware('verificarusuario');
    Route::post('/tramite/SetEstadoTramitePlaca', 'TramiteController@SetEstadoTramitePlaca')->middleware('verificarusuario');

    Route::get('/turnoventa/GetLstTurnoVenta', 'TurnoVentaController@GetLstTurnoVenta')->middleware('verificarusuario');
    Route::post('/turnoventa/SetTurnoVenta', 'TurnoVentaController@store')->middleware('verificarusuario');
    Route::post('/turnoventa/UpdTurnoVentaById', 'TurnoVentaController@UpdTurnoVentaById')->middleware('verificarusuario');
    Route::put('/turnoventa/desactivar','TurnoVentaController@desactivar')->middleware('verificarusuario');
    Route::put('/turnoventa/activar','TurnoVentaController@activar')->middleware('verificarusuario');

    Route::get('/asignavendedormodelo/GetLstVendedorModelo','AsignaVendedorModeloController@GetLstVendedorModelo')->middleware('verificarusuario');
    Route::post('/asignavendedormodelo/SetAsignaModelo','AsignaVendedorModeloController@SetAsignaModelo')->middleware('verificarusuario');
    Route::post('/asignavendedormodelo/SetDesasignaModelo','AsignaVendedorModeloController@SetDesasignaModelo')->middleware('verificarusuario');

    Route::get('/asignavendedorcuota/GetLstVendedorCuota','AsignaVendedorCuotaController@GetLstVendedorCuota')->middleware('verificarusuario');
    Route::post('/asignavendedorcuota/SetRegistraAsignacionCuota','AsignaVendedorCuotaController@SetRegistraAsignacionCuota')->middleware('verificarusuario');

    Route::get('/entregavehiculo/GetLstInspecciones','EntregaVehiculoController@GetLstInspecciones')->middleware('verificarusuario');
    Route::post('/entregavehiculo/SetGenerarEntregaVehiculo','EntregaVehiculoController@SetGenerarEntregaVehiculo')->middleware('verificarusuario');
    Route::get('/entregavehiculo/GetLstArchivosAdjuntos','EntregaVehiculoController@GetLstArchivosAdjuntos')->middleware('verificarusuario');

    Route::post('/exhibicion/importFileExhibicion','ExcelController@importFileExhibicion')->middleware('verificarusuario');
    Route::post('/exhibicion/readFileExhibicion', 'ExcelController@readFileExhibicion')->middleware('verificarusuario');
    Route::post('/exhibicion/SetExhibicion', 'ExhibicionController@SetExhibicion')->middleware('verificarusuario');
    Route::get('/exhibicion/GetExhibicion', 'ExhibicionController@GetExhibicion')->middleware('verificarusuario');
    Route::put('/exhibicion/desactivar','ExhibicionController@desactivar')->middleware('verificarusuario');

    Route::get('/cronograma/GetCronogramaVentaActivo','CronogramaController@GetCronogramaVentaActivo')->middleware('verificarusuario');
    Route::get('/cronograma/GetCronogramaCompraActivo','CronogramaController@GetCronogramaCompraActivo')->middleware('verificarusuario');
    Route::get('/cronograma/GetCronogramaActivoByTipo','CronogramaController@GetCronogramaActivoByTipo')->middleware('verificarusuario');
    Route::post('/cronograma/SetActivarCronograma','CronogramaController@SetActivarCronograma')->middleware('verificarusuario');

    Route::post('/flete/SetFlete', 'FleteController@SetFlete')->middleware('verificarusuario');
    Route::get('/flete/GetListFlete', 'FleteController@GetListFlete')->middleware('verificarusuario');
    Route::get('/flete/GetComprasForFlete', 'FleteController@GetComprasForFlete')->middleware('verificarusuario');
    Route::get('/flete/GetListFleteDetalle', 'FleteController@GetListFleteDetalle')->middleware('verificarusuario');

    Route::get('/reporte/GetListSubReportesByReporte','ReporteController@GetListSubReportesByReporte')->middleware('verificarusuario');
    Route::post('/reporte/GetCotizacionGenerarReporte01','ReporteController@GetCotizacionGenerarReporte01')->middleware('verificarusuario');
    Route::post('/reporte/GetPedidoGenerarReporte04','ReporteController@GetPedidoGenerarReporte04')->middleware('verificarusuario');

    Route::get('/obsequio/GetObsequio', 'ObsequioController@GetObsequio')->middleware('verificarusuario');
    Route::post('/obsequio/SetObsequio', 'ObsequioController@SetObsequio')->middleware('verificarusuario');
    Route::post('/obsequio/SetDetalleObsequio', 'ObsequioController@SetDetalleObsequio')->middleware('verificarusuario');
    Route::post('/obsequio/SetObsequioElementoVenta', 'ObsequioController@SetObsequioElementoVenta')->middleware('verificarusuario');
    Route::get('/obsequio/GetDistribucionByElementoVenta', 'ObsequioController@GetDistribucionByElementoVenta')->middleware('verificarusuario');
    Route::put('/obsequio/desactivar', 'ObsequioController@desactivar')->middleware('verificarusuario');
    Route::put('/obsequio/activar', 'ObsequioController@activar')->middleware('verificarusuario');
    Route::post('/obsequio/SetDistribucionObsequioByObsequio', 'ObsequioController@SetDistribucionObsequioByObsequio')->middleware('verificarusuario');
    Route::post('/obsequio/SetDistribucionObsequioByElemento', 'ObsequioController@SetDistribucionObsequioByElemento')->middleware('verificarusuario');
    Route::post('/obsequio/SetEntregaObsequioElementoVenta', 'ObsequioController@SetEntregaObsequioElementoVenta')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListObsequiosByVehiculo', 'CotizacionController@GetListObsequiosByVehiculo')->middleware('verificarusuario');
    Route::get('/gescotizacion/GetListObsequioElementoVenta', 'CotizacionController@GetListObsequioElementoVenta')->middleware('verificarusuario');

    Route::get('/asignavendedorsublinea/GetLstVendedorSubLinea','AsignaVendedorSubLineaController@GetLstVendedorSubLinea')->middleware('verificarusuario');
    Route::post('/asignavendedorsublinea/SetAsignaSubLinea','AsignaVendedorSubLineaController@SetAsignaSubLinea')->middleware('verificarusuario');
    Route::post('/asignavendedorsublinea/SetDesasignaSubLinea','AsignaVendedorSubLineaController@SetDesasignaSubLinea')->middleware('verificarusuario');

    Route::get('/asignacuota/GetLstVendedorSubLineaCuota','AsignaVendedorCuotaSubLineaController@GetLstVendedorSubLineaCuota')->middleware('verificarusuario');
    Route::post('/asignacuota/SetRegistraAsignacionCuota','AsignaVendedorCuotaSubLineaController@SetRegistraAsignacionCuota')->middleware('verificarusuario');

    Route::get('/usuario/GetListUsuarios','GestionUsuariosController@GetListUsuarios')->middleware('verificarusuario');
    Route::get('/usuario/GetListRoles','GestionUsuariosController@GetListRoles')->middleware('verificarusuario');
    Route::post('/usuario/SetRegistrarUsuario','GestionUsuariosController@SetRegistrarUsuario')->middleware('verificarusuario');
    Route::get('/usuario/GetListPermisosByRol','GestionUsuariosController@GetListPermisosByRol')->middleware('verificarusuario');
    Route::post('/usuario/SetPermisosByUsuario','GestionUsuariosController@SetPermisosByUsuario')->middleware('verificarusuario');
    Route::get('/usuario/GetInformacionUsuario','GestionUsuariosController@GetInformacionUsuario')->middleware('verificarusuario');
    Route::get('/usuario/GetInformacionUsuarioCabecera','GestionUsuariosController@GetInformacionUsuarioCabecera')->middleware('verificarusuario');
    Route::put('/usuario/SetCambiarEstadoUsuario','GestionUsuariosController@SetCambiarEstadoUsuario')->middleware('verificarusuario');

    Route::get('/cuentabancaria/GetBancosByEmpresa','CuentaBancariaController@GetBancosByEmpresa')->middleware('verificarusuario');

    Route::get('/persona/GetLstPersona','PersonaController@GetLstPersona')->middleware('verificarusuario');

    //INTEGRACION SQL SERVER
    Route::post('/articulo/SetIntegraArticulo','IntArticuloController@SetIntegraArticulo')->middleware('verificarusuario');
    Route::post('/proyecto/SetIntegraProyecto','IntProyectoController@SetIntegraProyecto')->middleware('verificarusuario');
    Route::post('/tarjetaequipo/SetIntegraTarjetaEquipo','IntTarjetaEquipoController@SetIntegraTarjetaEquipo')->middleware('verificarusuario');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicio','IntLlamadaServicioController@SetIntegraLlamadaServicio')->middleware('verificarusuario');
    Route::post('/llamadaservicio/SetIntegraLlamadaServicioVenta','IntLlamadaServicioController@SetIntegraLlamadaServicioVenta')->middleware('verificarusuario');
    Route::post('/compra/SetIntegraCompra', 'CompraController@SetIntegraCompra')->middleware('verificarusuario');
    Route::post('/compra/SetIntegraMercancia', 'CompraController@SetIntegraMercancia')->middleware('verificarusuario');
    Route::post('/actividad/SetIntegraActividad','IntActividadController@SetIntegraActividad')->middleware('verificarusuario');
    Route::post('/actividad/SetIntegraActividadVenta','IntActividadController@SetIntegraActividadVenta')->middleware('verificarusuario');
    Route::get('/actividad/GetIntegraActividadByItemCode','IntActividadController@GetIntegraActividadByItemCode')->middleware('verificarusuario');
    Route::post('/actividad/GetIntegraActividadVentaByItemCode','IntActividadController@GetIntegraActividadVentaByItemCode')->middleware('verificarusuario');
    Route::post('/tablacosto/GetCompraConceptosTblCosto','IntTablaCostoController@GetCompraConceptosTblCosto')->middleware('verificarusuario');
    Route::post('/tablacosto/SetIntegraTblCostoCab','IntTablaCostoController@SetIntegraTblCostoCab')->middleware('verificarusuario');
    Route::post('/tablacosto/GetCompraFleteTblCosto','IntTablaCostoController@GetCompraFleteTblCosto')->middleware('verificarusuario');
    Route::post('/empleado/SetIntegraEmpleado','IntEmpleadoController@SetIntegraEmpleado')->middleware('verificarusuario');

    ///========================================
    /////=================  ROUTES SAP
    //
    /// ============================================================
    /// CONEXION HANNAH - LARAVEL
    /// ============================================================
    ///
    Route::post('/SAPLoginController/login', 'Api\SAPLoginController@login')->middleware('verificarusuario');
    Route::post('/SAPLoginController/logout', 'Api\SAPLoginController@logout')->middleware('verificarusuario');
    Route::get('/SAPLoginController/MetaData', 'Api\SAPLoginController@MetaData')->middleware('verificarusuario');
    /// ============================================================
    /// METODOS SERVICES LAYER
    /// ============================================================
    ///
    //Gestión de Contacto
    Route::get('/gescontacto/SapGetValidarContacto', 'Api\SapContactoController@SapGetValidarContacto')->middleware('verificarusuario');
    Route::post('/gescontacto/SapSetContacto', 'Api\SapContactoController@SapSetContacto')->middleware('verificarusuario');
    Route::post('/gescontacto/SapSetContacto2', 'Api\SapContactoController@SapSetContacto2')->middleware('verificarusuario');
    Route::post('/gescontacto/SapSetUpdDireccionesContacto', 'Api\SapContactoController@SapSetUpdDireccionesContacto')->middleware('verificarusuario');
    //Compra
    Route::post('/compra/SapSetCompra', 'Api\SapCompraController@SapSetCompra')->middleware('verificarusuario');
    //Entrada Mercancia
    Route::post('/mercancia/SapSetMercanciaByOC', 'Api\SapMercanciaController@SapSetMercanciaByOC')->middleware('verificarusuario');
    //Articulo
    Route::post('/articulo/SapGetValidarArticulo', 'Api\SapArticuloController@SapGetValidarArticulo')->middleware('verificarusuario');
    Route::post('/articulo/SapSetArticulo', 'Api\SapArticuloController@SapSetArticulo')->middleware('verificarusuario');
    Route::post('/articulo/SapGetCostoPromedio', 'Api\SapArticuloController@SapGetCostoPromedio')->middleware('verificarusuario');
    //Pedido
    Route::post('/pedido/SapSetPedido', 'Api\SapPedidoController@SapSetPedido')->middleware('verificarusuario');
    Route::post('/pedido/prueba', 'Api\SapPedidoController@prueba')->middleware('verificarusuario');
    //Pedido Descuento
    Route::post('/pedido/SapSetPedidoDscto', 'Api\SapPedidoController@SapSetPedidoDscto')->middleware('verificarusuario');
    //Comprobante
    Route::post('/comprobante/SapSetFactura', 'Api\SapComprobanteController@SapSetFactura')->middleware('verificarusuario');
    //Proyecto
    Route::post('/proyecto/SapSetProyecto', 'Api\SapProyectoController@SapSetProyecto')->middleware('verificarusuario');
    //TarjetaEquipo
    Route::post('/tarjetaequipo/SapSetTarjetaEquipo', 'Api\SapTarjetaEquipoController@SapSetTarjetaEquipo')->middleware('verificarusuario');
    //LlamadaServicio
    Route::post('/llamadaservicio/SapSetLlamadaServicio', 'Api\SapLlamadaServicioController@SapSetLlamadaServicio')->middleware('verificarusuario');
    Route::post('/llamadaservicio/SapSetLlamadaServicioVenta', 'Api\SapLlamadaServicioController@SapSetLlamadaServicioVenta')->middleware('verificarusuario');
    //Actividad
    Route::post('/actividad/SapSetActividad', 'Api\SapActividadController@SapSetActividad')->middleware('verificarusuario');
    Route::post('/actividad/SapSetActividadVenta', 'Api\SapActividadController@SapSetActividadVenta')->middleware('verificarusuario');
    Route::post('/actividad/SapSetActividadEntregaVeh', 'Api\SapActividadController@SapSetActividadEntregaVeh')->middleware('verificarusuario');
    //Tabla Costos
    Route::post('/tablacosto/SapSetTablaCostoCabecera','Api\SapTablaCostoController@SapSetTablaCostoCabecera')->middleware('verificarusuario');
    Route::post('/tablacosto/SapPachTablaCostoDetalle','Api\SapTablaCostoController@SapPachTablaCostoDetalle')->middleware('verificarusuario');
    Route::post('/tablacosto/SapPachTablaCosto','Api\SapTablaCostoController@SapPachTablaCosto')->middleware('verificarusuario');
    Route::post('/tablacosto/SapPachTablaCostoDscto','Api\SapTablaCostoController@SapPachTablaCostoDscto')->middleware('verificarusuario');
    //Tipo Cambio
    Route::get('/tipocambio/SapGetTipoCambioByFecha', 'Api\SapTipoCambioController@SapGetTipoCambioByFecha')->middleware('verificarusuario');
    //Vendedor
    Route::post('/empleado/SapSetEmpleado', 'Api\SapEmpleadoController@SapSetEmpleado')->middleware('verificarusuario');
    /// ============================================================
    /// METODOS ODBC
    /// ============================================================
    //Ubigeo
    Route::get('/ubigeo/SapGetUbigeo', 'Api\SapUbigeoController@SapGetUbigeo')->middleware('verificarusuario');
});
