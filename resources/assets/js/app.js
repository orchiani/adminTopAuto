
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

Vue.component('Cliente', require('./components/Cliente.vue'));
Vue.component('Marca', require('./components/Marca.vue'));
Vue.component('Fragancia', require('./components/Fragancia.vue'));
Vue.component('Categoria', require('./components/Categoria.vue'));
Vue.component('Producto', require('./components/Producto.vue'));
Vue.component('Cliente', require('./components/Cliente.vue'));
Vue.component('Pedido', require('./components/Pedido.vue'));
Vue.component('User', require('./components/User.vue'));




const app = new Vue({
    el: '#app',
    data: {
        menu: 0,
    }
});
