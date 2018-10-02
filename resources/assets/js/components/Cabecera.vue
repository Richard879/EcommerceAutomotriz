<template>
    <transition name="slide-fade" appear>
        <li class="nav-item d-flex align-items-center">
            <el-select v-model="formCabecera.nidsucursal" filterable placeholder="Select" v-on:change="changeSucursal()">
                <el-option
                v-for="item in arraySucursal"
                :key="item.nIdPar"
                :label="item.cParAbreviatura"
                :value="item.nIdPar">
                </el-option>
            </el-select>
        </li>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formCabecera:{
                    nidsucursal: 0
                },
                arraySucursal:[]
            }
        },
        mounted(){
            this.listarSucursal();
        },
        methods:{
            listarSucursal(){
                var url = this.ruta + '/parametro/GetListSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidempresa': 1300011,
                        'opcion' : 0
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
                }).catch(error => {
                    console.log(error);
                    if (error.response) {
                        if (error.response.status == 401) {
                            location.reload('0');
                        }
                    }
                });
            },
            changeSucursal(){
                let me = this;
                sessionStorage.setItem("nIdSucursal", me.formCabecera.nidsucursal);
                me.arraySucursal.map(function(value, key) {
                    if(value.nIdPar == me.formCabecera.nidsucursal){
                        sessionStorage.setItem("cNombreSucursal", value.cParAbreviatura);
                    }
                });
                me.$emit('cabecera', me.formCabecera.nidsucursal);
                me.$bus.$emit('event', me.formCabecera);
            }
        },
    }
</script>

<style>
    /* TRANSITION */
    /* Enter and leave animations can use different */
    /* durations and timing functions.              */
    .slide-fade-enter-active {
        transition: all .8s ease;
    }
    .slide-fade-leave-active {
        transition: all .1s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
        /* .slide-fade-leave-active below version 2.1.8 */ {
        transform: translateX(10px);
        opacity: 0;
    }
</style>
