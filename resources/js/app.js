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
Vue.component('reviews_section', require('./components/reviews_section.vue').default);
Vue.component('read_book', require('./components/read_book.vue').default);
Vue.component('listen_audiobook', require('./components/listen_audiobook.vue').default);
Vue.component('make_review', require('./components/make_review.vue').default);
Vue.component('search_results', require('./components/search_results.vue').default);
Vue.component('get_author_work', require('./components/get_author_work.vue').default);
Vue.component('user_bookmark', require('./components/user_bookmark.vue').default);
Vue.component('user_settings', require('./components/user_settings.vue').default);
Vue.component('book_genera', require('./components/book_genera.vue').default);
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
    el:'reviews_section',
});
const app5=new Vue({
    el:'read_book',
});
const app6=new Vue({
    el:'listen_audiobook',
});
const app7=new Vue({
    el:'make_review',
});
const app8=new Vue({
    el:'search_results',
});
const app9=new Vue({
    el:'get_author_work',
});
const app10=new Vue({
    el:'user_bookmark',
});
const app11=new Vue({
    el:'user_settings',
});
const app12=new Vue({
    el:'book_genera',
});
app.component("font-awesome-icon", FontAwesomeIcon);
app2.component("font-awesome-icon", FontAwesomeIcon);
app3.component("font-awesome-icon", FontAwesomeIcon);
app4.component("font-awesome-icon", FontAwesomeIcon);
app5.component("font-awesome-icon", FontAwesomeIcon);
app6.component("font-awesome-icon", FontAwesomeIcon);
app7.component("font-awesome-icon", FontAwesomeIcon);
app7.component("font-awesome-icon", FontAwesomeIcon);
