
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('categoria-component', require('./components/Categoria.vue'));
Vue.component('articulo-component', require('./components/Articulo.vue'));
Vue.component('cliente-component', require('./components/Cliente.vue'));
Vue.component('proveedor-component', require('./components/Proveedor.vue'));
Vue.component('rol-component', require('./components/Rol.vue'));
Vue.component('user-component', require('./components/User.vue'));


const app = new Vue({
    el: '#app',
    data :{
        menu : 0
    }
});
