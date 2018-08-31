@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <dashBoard>DashBoard</dashBoard>
    </template>
    <template v-if="menu==1">
        <elementoventa :ruta="ruta"></elementoventa>
    </template>
    <template v-if="menu==2">
        <versionvehiculo :ruta="ruta"></versionvehiculo>
    </template>
    <template v-if="menu==5">
        <listapreciovh :ruta="ruta"></listapreciovh>
    </template>
    <template v-if="menu==6">
        <compra :ruta="ruta"></compra>
    </template>
    <template v-if="menu==7">
        <woperativo :ruta="ruta"></woperativo>
    </template>
    <template v-if="menu==8">
        <wfinanciero :ruta="ruta"></wfinanciero>
    </template>
    <template v-if="menu==9">
        <campania :ruta="ruta"></campania>
    </template>
    <template v-if="menu==10">
        <gestioncontactojf :ruta="ruta"></gestioncontactojf>
    </template>
    <template v-if="menu==11">
        <gestioncontactov :ruta="ruta"></gestioncontactov>
    </template>
    <template v-if="menu==12">
        <cotizacion :ruta="ruta"></cotizacion>
    </template>
    <template v-if="menu==13">
        <pedido :ruta="ruta"></pedido>
    </template>
    <template v-if="menu==14">
        <turnoventa :ruta="ruta"></turnoventa>
    </template>
@endsection
