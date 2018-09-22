<template>
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
                });
            },
            changeSucursal(){
                sessionStorage.setItem("nIdSucursal", this.formCabecera.nidsucursal);
                this.$emit('cabecera', this.formCabecera.nidsucursal);
                this.$bus.$emit('event', this.formCabecera);
            }
        },
    }
</script>