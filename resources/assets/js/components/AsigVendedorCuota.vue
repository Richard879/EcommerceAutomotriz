<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">AGINACIÓN VENDEDOR A CUOTA</h2>
                </div>
            </header>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                cempresa: 'SAISAC',
                csucursal: sessionStorage.getItem("cNombreSucursal"),
                nidproveedor: '',
                arrayProveedorLinea: [],
                arrayJefeVentas: [],
                arrayProveedor: [],
                arrayMarca: [],
                arrayModelo: [],
                arrayVendedorLinea: [],
                fillProveedor:{
                    cnombreproveedor: ''
                },
                fillVendedor:{
                    cnombreproveedor: '',
                    cnombrelineaventa: '',
                    nidlineaventa: 0,
                    cnombrejefeventas: '',
                    nidmarca: 0,
                    nidmodelo: 0
                },
                formAsignaModelo:{
                    nJefeVentaId: 0,
                    cJefeVentaNombre: 'NO ES JEFE DE VENTAS'
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
    }
</script>

<style>

</style>


