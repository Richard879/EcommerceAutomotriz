@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <dashBoard></dashBoard>
    </template>
    <template v-if="menu==200101">
        <elementoventa :ruta="ruta"></elementoventa>
    </template>
    <template v-if="menu==200102">
        <versionvehiculo :ruta="ruta"></versionvehiculo>
    </template>
    <template v-if="menu==200103">
        <pditipoinspeccion :ruta="ruta"></pditipoinspeccion>
    </template>
    <template v-if="menu==200104">
        <pdiplantilla :ruta="ruta"></pdiplantilla>
    </template>

    <template v-if="menu==200201">
        <turnoventa :ruta="ruta"></turnoventa>
    </template>
    <template v-if="menu==200202">
        <objcomercial :ruta="ruta"></objcomercial>
    </template>
    <template v-if="menu==200203">
        <asignavendedormodelo :ruta="ruta" :usuario="{{ auth()->user() }}"></asignavendedormodelo>
    </template>
    <template v-if="menu==200204">
        <comision :ruta="ruta"></comision>
    </template>
    <template v-if="menu==200205">
        <pdipuntoinspeccion :ruta="ruta"></pdipuntoinspeccion>
    </template>

    <template v-if="menu==200301">
        <listapreciovh :ruta="ruta"></listapreciovh>
    </template>
    <template v-if="menu==200302">
        <compra :ruta="ruta"></compra>
    </template>
    <template v-if="menu==200303">
        <woperativo :ruta="ruta"></woperativo>
    </template>
    <template v-if="menu==200304">
        <wfinanciero :ruta="ruta"></wfinanciero>
    </template>
    <template v-if="menu==200305">
        <campania :ruta="ruta"></campania>
    </template>
    <template v-if="menu==200306">
        <gestioncontactojf :ruta="ruta"></gestioncontactojf>
    </template>
    <template v-if="menu==200307">
        <gestioncontactov :ruta="ruta"></gestioncontactov>
    </template>
    <template v-if="menu==200308">
        <cotizacion :ruta="ruta"></cotizacion>
    </template>
    <template v-if="menu==200309">
        <pedido :ruta="ruta"></pedido>
    </template>
    <template v-if="menu==200310">
        <aprobapedido :ruta="ruta"></aprobapedido>
    </template>
    <template v-if="menu==200311">
        <depositopedido :ruta="ruta"></depositopedido>
    </template>
    <template v-if="menu==200312">
        <solccjefeventa :ruta="ruta"></solccjefeventa>
    </template>
    <template v-if="menu==200313">
        <solccvendedor :ruta="ruta"></solccvendedor>
    </template>
    <template v-if="menu==200314">
        <asigvendedorturno :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorturno>
    </template>
    <template v-if="menu==200316">
        <maestrovehiculo :ruta="ruta"></maestrovehiculo>
    </template>
    <template v-if="menu==200317">
        <autorizacionadv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionadv>
    </template>
    <template v-if="menu==200318">
        <autorizacionjv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionjv>
    </template>
    <template v-if="menu==200319">
        <autorizacionv :ruta="ruta" @vista="CambiarMenu" :usuario="{{ auth()->user() }}"></autorizacionv>
    </template>
    <template v-if="menu==200320">
        <cierreventa :ruta="ruta"></cierreventa>
    </template>
    <template v-if="menu==200321">
        <cierrecompra :ruta="ruta"></cierrecompra>
    </template>
    <template v-if="menu==200322">
        <pdiprocesoinspeccion :ruta="ruta"></pdiprocesoinspeccion>
    </template>
@endsection