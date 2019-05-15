<template>
    <!--<transition tag="ul" name="bounce" mode="out-in" appear>-->
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <vs-divider color="dark">
                        <h2 class="no-margin-bottom">REPORTES DE {{ formLogin.cUsuario }} - {{ formLogin.cRol }}</h2>
                    </vs-divider>
                </div>
            </header>

            <!--CONSULTAS/RETAIL || ADV/Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>CONSULTAS/RETAIL</h3>
                        </div>

                        <!-- ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                             <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="fa-md fa fa-file-excel-o" @click="exportarDetalleVentaRetail()"></i></div>
                                    <div class="title"><span><br>Detalle Venta Retail</span></div>
                                </div>
                             </div>
                             <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="fa-md fa fa-file-excel-o" @click="exportarVentaHGSI()"></i></div>
                                    <div class="title"><span><br>Ventas HGSI</span></div>
                                </div>
                             </div>
                        </template>
                    </div>
                </div>
            </section>

            <!--Marketing y Ventas || ADV/Gerencia-->
            <section class="dashboard-counts no-padding-bottom" v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                <div class="container-fluid">
                    <div class="row bg-white has-shadow">
                        <div class="col-xs-12" style="width: 100%;">
                            <h3>MARKETING Y VENTAS</h3>
                        </div>

                        <!-- ADV/Gerencia -->
                        <template v-if="formLogin.nIdRol == 110083 || formLogin.nIdRol == 110096">
                            <div class="col-xl-4 col-sm-6">
                                <div class="item d-flex align-items-center">
                                    <div class="icon bg-violet"><i class="fa-md fa fa-file-excel-o" @click="exportarVentaDiaria()"></i></div>
                                    <div class="title"><span><br>Venta Diaria</span></div>
                                </div>
                             </div>
                        </template>
                    </div>
                </div>
            </section>
        </main>
</template>

<script>
    import XLSX from 'xlsx'

    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formLogin:{
                    cRuta: '',
                    nIdUsuario: '',
                    cUsuario: '',
                    cRol: '',
                    nIdRol: ''
                },
                loading: false
            }
        },
        mounted(){
            this.cargarInformacionUsuario();
        },
        methods:{
            cargarInformacionUsuario(){
                var url = this.ruta + '/usuario/GetInformacionUsuarioCabecera';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id
                    }
                }).then(response => {
                    this.formLogin.cRuta        = response.data[0].cPathImage;
                    this.formLogin.nIdUsuario   = response.data[0].id;
                    this.formLogin.cUsuario     = response.data[0].cUsuario;
                    this.formLogin.cRol         = response.data[0].cGrupoParNombre;
                    this.formLogin.nIdRol       = response.data[0].nIdGrupoPar;
                    // this.loadAllDashboard();
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
            exportarDetalleVentaRetail(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportDetalleVentaRetail';
                axios.get(url).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Detalle Venta Retail'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
            },
            exportarVentaHGSI(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarVentaHGSI';
                axios.get(url).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Ventas HGSI'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
            },
            exportarVentaDiaria(){
                this.mostrarProgressBar();

                var url = this.ruta + '/reportes/exportarVentaDiaria';
                axios.get(url).then(response => {
                    let data = XLSX.utils.json_to_sheet(response.data)
                    const workbook = XLSX.utils.book_new()
                    const filename = 'Detalle Venta Diaria'
                    XLSX.utils.book_append_sheet(workbook, data, filename)
                    XLSX.writeFile(workbook, `${filename}.xlsx`)
                    $("#myBar").hide();
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal('VUELVA INICIAR SESIÓN - SESIÓN INHAUTORIZADA - 401');
                            location.reload('0');
                        }
                    }
                    $("#myBar").hide();
                });
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
    }
    .btnBuscar{
        width: 100%;
        padding: .5rem;
        margin-top: .4rem;
    }
    .no-padding-bottom{
        margin: .8rem !important;
    }
</style>
