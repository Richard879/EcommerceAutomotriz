<template>
    <div>
        <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <img :src="formLogin.cRuta" class="img-avatar" style="height: 35px; border-radius: 50em; margin: 0 10px;" :alt="formLogin.cUsuario">
            <span class="d-md-down-none"> {{ formLogin.cUsuario }} </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item">
                <i class="fa fa-user bg-orange"></i> {{ formLogin.cRol }}
            </a>
            <a class="dropdown-item" @click.prevent="logout">
                <i class="fa fa-lock"></i> Cerrar sesión
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formLogin:{
                    cRuta: '',
                    cUsuario: '',
                    cRol: ''
                }
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
                    this.formLogin.cRuta = response.data[0].cPathImage;
                    this.formLogin.cUsuario = response.data[0].cUsuario;
                    this.formLogin.cRol = response.data[0].cGrupoParNombre;
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
            logout(){
                axios.post('logout').then(function(response) {
                    location.reload('0');
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            swal("SU SESIÓN HA EXPIRADO, VUELVA INICIAR SESIÓN");
                            location.reload('0');
                        }
                    }
                })
            }
        }
    }
</script>
