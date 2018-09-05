@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <dashBoard>DashBoard</dashBoard>
    </template>
    <template v-if="menu==200101">
        <elementoventa :ruta="ruta"></elementoventa>
    </template>
    <template v-if="menu==200102">
        <versionvehiculo :ruta="ruta"></versionvehiculo>
    </template>
    <template v-if="menu==200201">
        <listapreciovh :ruta="ruta"></listapreciovh>
    </template>
    <template v-if="menu==200202">
        <compra :ruta="ruta"></compra>
    </template>
    <template v-if="menu==200203">
        <woperativo :ruta="ruta"></woperativo>
    </template>
    <template v-if="menu==200204">
        <wfinanciero :ruta="ruta"></wfinanciero>
    </template>
    <template v-if="menu==200205">
        <campania :ruta="ruta"></campania>
    </template>
    <template v-if="menu==200206">
        <gestioncontactojf :ruta="ruta"></gestioncontactojf>
    </template>
    <template v-if="menu==200207">
        <gestioncontactov :ruta="ruta"></gestioncontactov>
    </template>
    <template v-if="menu==200208">
        <cotizacion :ruta="ruta"></cotizacion>
    </template>
    <template v-if="menu==200209">
        <pedido :ruta="ruta"></pedido>
    </template>
    <template v-if="menu==200210">
        <aprobapedido :ruta="ruta"></aprobapedido>
    </template>
    <template v-if="menu==200211">
        <comision :ruta="ruta"></comision>
    </template>
    <template v-if="menu==200212">
        <objcomercial :ruta="ruta"></objcomercial>
    </template>
    <template v-if="menu==200213">
        <solcaracteristica :ruta="ruta"></solcaracteristica>
    </template>
    <template v-if="menu==200214">
        <asigvendedorturno :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorturno>
    </template>
    <template v-if="menu==200215">
        <turnoventa :ruta="ruta"></turnoventa>
    </template>
    <template v-if="menu==200216">
        <depositopedido :ruta="ruta"></depositopedido>
    </template>
    <template v-if="menu==200217">
        <vendedorlinea :ruta="ruta"></vendedorlinea>
    </template>
@endsection
