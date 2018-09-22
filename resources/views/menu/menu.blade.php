<template>
    <mimenu :ruta="ruta" @menu="mostrarMenu" :usuario="{{ auth()->user() }}"></mimenu>
</template>
