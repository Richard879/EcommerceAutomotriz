<template>
    <transition name="slide-fade" appear>
        <li class="nav-item d-flex align-items-center">
            <el-select v-model="formCabecera.nidsucursal"
                       filterable
                       clearable
                       placeholder="SELECCIONE"
                       @change="changeSucursal">
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
                    nidempresa: 1300011,
                    nidsucursal: ''
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
                        'nidempresa': this.formCabecera.nidempresa
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
                //CAPTURO NUEVA SESIÓN nIdSucursal DE LA SUCURSAL SELECCIONADA
                sessionStorage.setItem("nIdSucursal", me.formCabecera.nidsucursal);
                me.arraySucursal.map(function(value, key) {
                    if(value.nIdPar == me.formCabecera.nidsucursal){
                        //CAPTURO NUEVA SESIÓN DEL cNombreSucursal SELECCIONADO
                        sessionStorage.setItem("cNombreSucursal", value.cParAbreviatura);
                    }
                });
                me.$emit('cabecera', me.formCabecera.nidsucursal);
                me.$bus.$emit('event', me.formCabecera);
            }
        },
    }
</script>
