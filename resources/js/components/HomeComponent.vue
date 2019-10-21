<template>
    <div>
        <h1>Bienvenido</h1>
        <p>
            <router-link v-bind:to="{ name:'alumnos'}">Alumnos</router-link>-<router-link v-bind:to="{ name:'cursos'}">Cursos</router-link>-<router-link v-bind:to="{ name:'materias'}">Materias</router-link>-<router-link v-bind:to="{ name:'preceptores'}">Preceptores</router-link>-<router-link v-bind:to="{ name:'profesores'}">Profesores</router-link>-<router-link v-bind:to="{ name:'boletin'}">Consultar</router-link>-<router-link v-bind:to="{ name:'configuracion'}">Configuración</router-link> 
        </p>
        <div class="container">
            <router-view></router-view>
        </div>
    </div>
</template>
<script>
    export default {}
</script>