<template>
    <mimenu :ruta="ruta" @menu="mostrarMenu" :idsucursal="changeMenu" :usuario="{{ auth()->user() }}"></mimenu>
</template>