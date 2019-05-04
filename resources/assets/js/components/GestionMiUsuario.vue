<template>
    <transition name="slide-fade" appear>
        <main>
            <header class="page-header">
                <div class="container-fluid">
                    <h2 class="no-margin-bottom">
                        <vs-divider color="dark">MODULO ADMINISTRACIÓN DE USUARIOS</vs-divider>
                    </h2>
                </div>
            </header>

            <section class="forms">
                <div class="container-fluid">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="h4">ACTUALIZAR USUARIO</h3>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal">
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Usuario</label>
                                                <div class="col-sm-8">
                                                    <input type="text" v-model="fillUsuario.cusuario" style="text-transform:uppercase" class="form-control form-control-sm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">* Contraseña</label>
                                                <div class="col-sm-8">
                                                    <div class="input-group">
                                                        <input type="password" placeholder="INGRESE O GENERE CONTRASEÑA" v-model="fillUsuario.cpassword" style="text-transform:uppercase" class="form-control form-control-sm">
                                                        <div class="input-group-prepend">
                                                            <button type="button" title="Generar Contraseña" class="btn btn-info btn-corner btn-sm" @click="generarContrasena">
                                                                <i class="fa-lg fa fa-refresh"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <label class="col-sm-4 form-control-label">Fotografía</label>
                                                <div class="col-sm-8">
                                                    <input type="file" id="file-upload" @change="getFile" accept="image/*" class="form-control form-control-sm"/>
                                                </div>
                                                <div id="preview">
                                                    <img v-if="urlImage" :src="urlImage"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-9 offset-sm-5">
                                            <button type="button" class="btn btn-success btn-corner btn-sm" @click="guardarUsuario()">
                                                <i class="fa fa-save"></i> Actualizar
                                            </button>
                                            <button type="button" class="btn btn-secundary btn-corner btn-sm" @click="limpiarFormulario()">
                                                <i class="fa fa-close"></i> Cancelar
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                //==========================================================
                //================== REGISTRAR USUARIO =====================
                fillUsuario: {
                    nIdUsuario: '',
                    cusuario: '',
                    cpassword: '',
                    cRuta: ''
                },
                attachment: '',// Archivo a almacenar
                form: new FormData,// El archivo tendrá que ser enviado como elemento FormData
                urlImage: '',
                //==========================================================
                //================== VARIABLES SAP =====================
                arraySapRespuesta: [],
                arraySapUpdVendedor: [],
                jsonRespuesta: '',
                //==========================================================
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
                vistaFormulario: 1,
                loading: false
            }
        },
        computed:{},
        mounted(){
            this.obtenerInfoUsuario();
        },
        methods:{
            obtenerInfoUsuario(){
                var url = this.ruta + '/usuario/GetInformacionUsuarioCabecera';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id
                    }
                }).then(response => {
                    // console.log(response);
                    this.fillUsuario.nIdUsuario         = response.data[0].id;
                    this.urlImage                       = response.data[0].cPathImage;
                    this.fillUsuario.cusuario           = response.data[0].cUsuario;
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
            guardarUsuario(){
                if(this.validarRegistrarUsuario()){
                    this.accionmodal=1;
                    this.modal = 1;
                    return;
                }

                //AGREGAR ARCHIVO AL FORM DATA
                this.form.append('file', this.attachment);
                this.form.append('nidusuario', this.fillUsuario.nIdUsuario);
                this.form.append('cusuario', this.fillUsuario.cusuario);
                this.form.append('cpassword', this.fillUsuario.cpassword);

                const config = { headers: { 'Content-Type': 'multipart/form-data'  } };

                // Mostrar ProgressBar
                this.mostrarProgressBar();

                let url;
                url = this.ruta + '/usuario/SetEditarMiUsuario';
                axios.post(url, this.form, config).then(response => {
                    // console.log(response.data)
                    if(response.data[0].nFlagMsje == 1) {
                        swal(response.data[0].cMensaje);
                        this.obtenerInfoUsuario();
                        $("#myBar").hide();
                    } else {
                        swal(response.data[0].cMensaje);
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
            validarRegistrarUsuario(){
                let me = this;

                me.error = 0;
                me.mensajeError =[];

                if(!this.fillUsuario.cusuario) {
                    me.mensajeError.push('Debe Ingresar un Usuario, es un campo obligatorio ');
                }

                if(me.mensajeError.length){
                    me.error = 1;
                }
                return me.error;
            },
            generarContrasena(){
                let me = this;
                me.fillUsuario.cpassword = me.fillUsuario.cusuario  + '123';
            },
            getFile(e){
                let selectFile  = e.target.files[0];
                this.attachment = selectFile;
                this.urlImage   = URL.createObjectURL(selectFile);
            },
            limpiarFormulario(){
                this.fillUsuario.cusuario = '';
                this.fillUsuario.cpassword = '';
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
    .imgRedonda{
        width:30px;
        height:30px;
        border-radius:150px;
        border:3px solid #666;
    }
    #preview{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #preview img{
        max-width: 20%;
        min-width: 20%;
        max-height: 200px;
        border-radius: 120px;
        border: 5px solid #666;
    }
</style>
