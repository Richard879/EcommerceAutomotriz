<template>
        <nav class="side-navbar">
            <span class="heading">MENÚ PRINCIPAL</span>
            <ul class="list-unstyled">
                <li v-for="menu in arrayMenu" :key="menu.nIdPar">
                    <a v-bind:href="menu.cReferencia" aria-expanded="false" data-toggle="collapse">
                        <i v-bind:class="menu.cParIcon"></i>{{ menu.cParNombre }}
                    </a>
                    <ul v-bind:id="menu.cParJerarquia" class="collapse list-unstyled ">
                        <div v-for="submenu in arraySubMenu" :key="submenu.nIdPar">
                            <li v-if="submenu.nCanJerarquia==menu.cParJerarquia" v-bind:id="submenu.cParJerarquia" @click="activaMenu(submenu.nIdPar,submenu.cParJerarquia)">
                                <a href="#">{{ submenu.cParNombre }}</a>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </nav>
</template>
<script>
export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                arrayMenu:[],
                arraySubMenu:[]
            }
        },
        created(){
            let me = this;
            this.$bus.$on('event', function (data) {
               //console.log(data);
               me.listarPermisosByUsuario();
            })
           //this.$bus.$on('logged-in', this.mostrar);
        },
        methods:{
            listarPermisosByUsuario(){
                var url = this.ruta + '/puga/GetListMenuByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'nidusuario': this.usuario.id,
                        'nlenjerarquia': 4
                    }
                }).then(response => {
                    this.arrayMenu = response.data;
                    this.listarSubPermisosByUsuario();
                }).catch(error => {
                    console.log(error);
                });
            },
            listarSubPermisosByUsuario(){
                var url = this.ruta + '/puga/GetListMenuByUsuario';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'nidsucursal': sessionStorage.getItem("nIdSucursal"),
                        'nidusuario': this.usuario.id,
                        'nlenjerarquia': 6
                    }
                }).then(response => {
                    this.arraySubMenu = response.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            activaMenu(nIdMenu, cParJerarquia){
                let me = this;
                me.$emit('menu', cParJerarquia);

                $('ul li.active').removeClass('active');
                var mimenu = document.getElementById(cParJerarquia);
                $(mimenu).addClass('active');
            },
        },
    }
</script>
