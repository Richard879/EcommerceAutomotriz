<template>
    <transition name="slide-fade" appear>
         <a href="#" class="navbar-brand">
            <div class="brand-text brand-big">
                <span>
                    <template v-if="nIdEmpresa == 1300011">
                        <img class="navbar-brand-full" src="img/logo.png" width="220" height="30" alt="AUTOMOTORES INKA">
                    </template>
                    <template v-else-if="nIdEmpresa == 1300717">
                        <img class="navbar-brand-full" src="img/logo_inkalider.png" width="220" height="30" alt="INKA LIDER">
                    </template>
                    <template v-else>
                        <span>Cargando...</span>
                    </template>
                </span>
            </div>
            <div class="brand-text brand-small">
                <template v-if="nIdEmpresa == 1300011">
                    <strong class="estilos">SAISAC</strong>
                </template>
                <template v-else-if="nIdEmpresa == 1300717">
                    <strong class="estilos">ILIASAC</strong>
                </template>
                <template v-else>
                    <span>Cargando...</span>
                </template>
            </div>
        </a>
    </transition>
</template>

<script>
    export default {
        props:['usuario'],
        data(){
            return {
                nIdEmpresa : '',
                cRuta: ''
            }
        },
        created(){
            let me = this;
            this.$bus.$on('event', function (data) {
                // console.log(data);
                me.setearEmpresa(data);
            })
        },
        methods:{
            setearEmpresa(data){
                this.nIdEmpresa = data.nidempresa;
            },
        }
    }
</script>

<style scoped>
    .estilos{
        font-weight: bold;
    }
</style>
