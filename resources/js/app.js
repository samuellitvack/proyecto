/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.VueRouter = require('vue-router').default;
window.VueAxios = require('vue-axios').default;
window.Axios = require('axios').default;

window.Vue = require('vue');


let Home = require('./components/HomeComponent');

Vue.use(VueRouter, VueAxios, Axios);


import Alumnos from './components/AlumnosComponent';
import Boletin from './components/BoletinComponent';
import Configuracion from './components/ConfiguracionComponent';
import Cursos from './components/CursosComponent';
import Materias from './components/MateriasComponent';
import Preceptores from './components/PreceptoresComponent';
import Profesores from './components/ProfesoresComponent';


const routes = [
        {
            path: '/',
            name: 'home',
            component: Home
        },

        {
            path: '/alumnos',
            name: 'alumnos',
            component: Alumnos
        },

        {
            path: '/boletin',
            name: 'boletin',
            component: Boletin,
        },

        {
            path: '/configuracion',
            name: 'configuracion',
            component: Configuracion,
        },

        {
            path: '/cursos',
            name: 'cursos',
            component: Cursos,
        },

        {
            path: '/materias',
            name: 'materias',
            component: Materias,
        },

        {
            path: '/preceptores',
            name: 'preceptores',
            component: Preceptores,
        },

        {
            path: '/profesores',
            name: 'profesores',
            component: Profesores,
        },
    ];

const router = new VueRouter({routes: routes});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('alumnos-component', require('./components/AlumnosComponent.vue').default);
Vue.component('profesores-component', require('./components/ProfesoresComponent.vue').default);
Vue.component('preceptores-component', require('./components/PreceptoresComponent.vue').default);
Vue.component('materias-component', require('./components/MateriasComponent.vue').default);
Vue.component('cursos-component', require('./components/CursosComponent.vue').default);
Vue.component('configuracion-component', require('./components/ConfiguracionComponent.vue').default);
Vue.component('boletin-component', require('./components/BoletinComponent.vue').default);
Vue.component('home-component', require('./components/HomeComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

if(document.getElementById("app")){
 new Vue(
 	Vue.util.extend(
 		{router},
 		Home
 	)
 ).$mount('#app');
}
