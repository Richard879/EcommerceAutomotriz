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
        <solccvendedor :ruta="ruta"></solccvendedor>
    </template>
    <template v-if="menu==200214">
        <asigvendedorturno :ruta="ruta" :usuario="{{ auth()->user() }}"></asigvendedorturno>
    </template>
    <template v-if="menu==200103">
        <turnoventa :ruta="ruta"></turnoventa>
    </template>
    <template v-if="menu==200216">
        <depositopedido :ruta="ruta"></depositopedido>
    </template>
    <template v-if="menu==200217">
        <asignavendedormodelo :ruta="ruta" :usuario="{{ auth()->user() }}"></asignavendedormodelo>
    </template>
    <template v-if="menu==200218">
        <solccjefeventa :ruta="ruta"></solccjefeventa>
    </template>
    <template v-if="menu==200219">
        <maestrovehiculo :ruta="ruta"></maestrovehiculo>
    </template>
    <template v-if="menu==200220">
        <autorizacionv :ruta="ruta" :usuario="{{ auth()->user() }}"></autorizacionv>
    </template>
    <template v-if="menu==200221">
        <autorizacionjv :ruta="ruta" :usuario="{{ auth()->user() }}"></autorizacionjv>
    </template>
    <template v-if="menu==200222">
        <autorizacionadv :ruta="ruta" :usuario="{{ auth()->user() }}"></autorizacionadv>
    </template>
    <template v-if="menu==200223">
        <cierreventa :ruta="ruta"></cierreventa>
    </template>
    <template v-if="menu==200224">
        <cierrecompra :ruta="ruta"></cierrecompra>
    </template>
    <template v-if="menu==200225">
        <pditipoinspeccion :ruta="ruta"></pditipoinspeccion>
    </template>
    <template v-if="menu==200226">
        <pdiplantilla :ruta="ruta"></pdiplantilla>
    </template>
    <template v-if="menu==200227">
        <pdipuntoinspeccion :ruta="ruta"></pdipuntoinspeccion>
    </template>
    <template v-if="menu==200227">
        <pdiprocesoinspeccion :ruta="ruta"></pdiprocesoinspeccion>
    </template>
@endsection
