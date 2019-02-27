<template>
    <transition name="slide-fade" appear>
        <li class="nav-item d-flex align-items-center">
            <el-select v-model="formCabecera.nidempresa"
                       filterable
                       clearable
                       placeholder="SELECCIONE"
                       @change="listarSucursalByEmpresa">
                <el-option
                    v-for="item in arrayEmpresa"
                    :key="item.nIdPar"
                    :label="item.cParAbreviatura"
                    :value="item.nIdPar">
                </el-option>
            </el-select>
            <el-select v-model="formCabecera.nidsucursal"
                       filterable
                       clearable
                       placeholder="SELECCIONE"
                       @change="changeSucursal">
                <el-option
                    v-for="item in arraySucursal"
                    :key="item.nIdPar"
                    :label="item.cParNombre"
                    :value="item.nIdPar">
                </el-option>
            </el-select>
            <span>&nbsp;T.C.C&nbsp;&nbsp;</span>
            <span v-text="cTipoCambio"></span>
        </li>
    </transition>
</template>

<script>
    export default {
        props:['ruta', 'usuario'],
        data(){
            return {
                formCabecera:{
                    nidempresa: '',
                    nidsucursal: ''
                },
                cTipoCambio: '',
                arrayEmpresa:[],
                arraySucursal:[]
            }
        },
        mounted(){
            //console.log("Entro a la Cabecera");
            this.listarEmpresaByUsuario();
            //this.listarSucursalByEmpresa();
        },
        created() {
            let me = this;
            setTimeout(function() {
                me.llenarTipoCambio();
            }, 1600);
            this.$bus.$on('tcc', function (data) {
               //console.log(data);
               me.llenarTipoCambio();
            })
        },
        methods:{
            llenarTipoCambio(){
                var url = this.ruta + '/tipocambio/GetTipoCambioByFecha';

                axios.get(url, {
                    params: {
                        'dfecha': moment().format('YYYY-MM-DD')
                    }
                }).then(response => {
                    this.cTipoCambio = response.data[0].fValorTipoCambioComercial;
                    //Parseo a 0 si es ".000"
                    this.cTipoCambio = parseFloat(this.cTipoCambio);
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
            listarEmpresaByUsuario(){
                var url = this.ruta + '/perrelacion/GetLstEmpresaByUsuario';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id
                    }
                }).then(response => {
                    this.arrayEmpresa = response.data;
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
            listarSucursalByEmpresa(){
                var url = this.ruta + '/perrelacion/GetLstSucursalByEmpresa';
                axios.get(url, {
                    params: {
                        'nidusuario': this.usuario.id,
                        'nidempresa': this.formCabecera.nidempresa
                    }
                }).then(response => {
                    this.arraySucursal = response.data;
                    this.formCabecera.nidsucursal = '';
                    this.changeSucursal();
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
            changeSucursal(){
                let me = this;
                sessionStorage.setItem("nIdEmpresa", me.formCabecera.nidempresa);
                me.arrayEmpresa.map(function(value, key) {
                    if(value.nIdPar == me.formCabecera.nidempresa){
                        //CAPTURO NUEVA SESIÓN DEL cNombreEmpresa SELECCIONADO
                        sessionStorage.setItem("cNombreEmpresa", value.cParAbreviatura);
                    }
                });
                //CAPTURO NUEVA SESIÓN nIdSucursal DE LA SUCURSAL SELECCIONADA
                sessionStorage.setItem("nIdSucursal", me.formCabecera.nidsucursal);
                me.arraySucursal.map(function(value, key) {
                    if(value.nIdPar == me.formCabecera.nidsucursal){
                        //CAPTURO NUEVA SESIÓN DEL cNombreSucursal SELECCIONADO
                        sessionStorage.setItem("cNombreSucursal", value.cParNombre);
                    }
                });
                me.$emit('cabecera', me.formCabecera.nidsucursal);
                me.$bus.$emit('event', me.formCabecera);
            }
        },
    }
</script>
