<template>
    <nav class="side-navbar">
        <span class="heading">MENÚ PRINCIPAL</span>
        <ul class="list-unstyled">
            <li v-for="menu in arrayMenu" :key="menu.nIdPar">
                <a v-bind:href="menu.cReferencia" aria-expanded="false" data-toggle="collapse"> <i v-bind:class="menu.cParIcon"></i>{{ menu.cParNombre }}</a>
                <ul v-bind:id="menu.cParJerarquia" class="collapse list-unstyled ">
                    <div v-for="submenu in arraySubMenu" :key="submenu.nIdPar">
                        <li v-if="submenu.nCanJerarquia==menu.cParJerarquia" v-bind:id="submenu.cParJerarquia" @click="activaMenu(submenu.cParJerarquia)"><a href="#">{{ submenu.cParNombre }}</a></li>
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
        mounted(){
            this.listarPermisosByUsuario();
        },
        methods:{
            listarPermisosByUsuario(){
                var url = this.ruta + '/puga/GetListPermisosByUser';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'idsucursal': 1300013,
                        'nidusuario': this.usuario.id,
                        'nlenjerarquia': 4
                    }
                }).then(response => {
                    this.arrayMenu = response.data.arrayMenu.data;
                    this.listarSubPermisosByUsuario();
                }).catch(error => {
                    console.log(error);
                });
            },
            listarSubPermisosByUsuario(){
                var url = this.ruta + '/puga/GetListPermisosByUser';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'idsucursal': 1300013,
                        'nidusuario': this.usuario.id,
                        'nlenjerarquia': 6
                    }
                }).then(response => {
                    this.arraySubMenu = response.data.arrayMenu.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            activaMenu(nIdMenu){
                let me = this;
                me.$emit('menu', nIdMenu);
                ActivarMenu(nIdMenu);
            },
        },
    }
</script>
