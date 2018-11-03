<template>
    <cabecera :ruta="ruta" @cabecera="reiniciaMenu" :usuario="{{ auth()->user() }}"></cabecera>
</template>
