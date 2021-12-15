/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('load_book', require('./components/load_book.vue').default);
Vue.component('load_audiobooks', require('./components/load_audiobooks.vue').default);
Vue.component('generate_stars', require('./components/generate_stars.vue').default);
Vue.component('comment_section', require('./components/comment_Section.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import { library } from "@fortawesome/fontawesome-svg-core";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { fas } from '@fortawesome/free-solid-svg-icons'
library.add(fas);
import { fab } from '@fortawesome/free-brands-svg-icons';
library.add(fab);
import { far } from '@fortawesome/free-regular-svg-icons';
library.add(far);
import { dom } from "@fortawesome/fontawesome-svg-core";
dom.watch();

const app = new Vue({

    el: 'load_book',
});
const app2=new Vue({
    el:'load_audiobooks',
});
const app3=new Vue({
    el:'generate_stars',
});
const app4=new Vue({
    el:'comment_section',
});
app.component("font-awesome-icon", FontAwesomeIcon);
app2.component("font-awesome-icon", FontAwesomeIcon);
app3.component("font-awesome-icon", FontAwesomeIcon);
app4.component("font-awesome-icon", FontAwesomeIcon);
