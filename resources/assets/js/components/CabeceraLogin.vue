<template>
    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <img :src="formLogin.cRuta" class="img-avatar" style="height: 35px; border-radius: 50em; margin: 0 10px;" :alt="formLogin.cUsuario">
        <span class="d-md-down-none"> {{ formLogin.cUsuario }} </span>
    </a>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formLogin:{
                    cRuta: '',
                    cUsuario: ''
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
                    this.formLogin.cUsuario = response.data[0].cNombre;
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
        }
    }
</script>
