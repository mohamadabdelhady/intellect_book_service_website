require('./bootstrap');
window.Vue = require('vue').default;

// 1. Import Ziggy and add it to the Vue Prototype
import { route } from 'ziggy-js';
Vue.prototype.route = route;

// 2. FontAwesome Setup
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { dom } from '@fortawesome/fontawesome-svg-core';
import Vue from 'vue';

library.add(fas, fab, far);
dom.watch();
Vue.component('font-awesome-icon', FontAwesomeIcon);

// 3. Register Components
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

// Admin Components
Vue.component('get_books', require('./components/admin/get_books.vue').default);
Vue.component('view_book', require('./components/admin/view_book.vue').default);
Vue.component('edit_book', require('./components/admin/edit_book.vue').default);
Vue.component('create_book', require('./components/admin/create_book.vue').default);
Vue.component('get_authors', require('./components/admin/get_authors.vue').default);
Vue.component('edit_author', require('./components/admin/edit_author.vue').default);
Vue.component('view_author', require('./components/admin/view_author.vue').default);
Vue.component('create_author', require('./components/admin/create_author.vue').default);

// 4. Create Vue Instance

const app = new Vue({
  el: '#app',
});
