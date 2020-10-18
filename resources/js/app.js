require('./bootstrap');

window.Vue = require('vue');
window.events = new Vue()

window.Vue.prototype.authorize = function($callback){
    return window.App.user ? $callback(window.App.user) : false;
}

window.flash = function($message){
    window.events.$emit('flash', $message)
} // call as flash('message')

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);

Vue.component('thread-view', require('./pages/Thread.vue').default);

const app = new Vue({
    el: '#app',
});
