<template>
    <cabecera :ruta="ruta" @cabecera="listarMenu" :usuario="{{ auth()->user() }}"></cabecera>
</template>