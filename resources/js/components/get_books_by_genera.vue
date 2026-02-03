<template>
  <div v-if="books.length > 0">
    <p class="h3">E-books</p>

    <hr />
    <div class="dropdown">
      <button
        class="btn dropdown-toggle"
        type="button"
        id="dropdownMenuButton"
        data-toggle="dropdown"
        aria-haspopup="true"
        aria-expanded="false"
      >
        Sort by
      </button>
      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('default')">default</a>
        <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('rate')">rating</a>
        <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('newest')">newest</a>
        <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('oldest')">oldest</a>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12" v-for="(book, index) in books">
        <a :href="route('check-book', { id: book['id'] })" class="book_card card">
          <img :src="'/storage/' + book['cover_img']" class="book_img m-auto" />
          <p class="book_title m-auto h4">{{ book['name'] }}</p>
          <p class="book_title m-auto h6">By {{ book['author_name'] }}</p>
          <div class="row m-auto" v-if="rating > 0">
            <generate_stars :rating="book['rating']"></generate_stars>
          </div>
          <div class="row m-auto" v-else>
            <p>No reviews</p>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <button class="btn m-auto mt-4" v-on:click="get_books" :disabled="last_page == true">
        Load more E-books
      </button>
    </div>
  </div>
</template>

<script>
import { route } from 'ziggy-js';
export default {
  name: 'get_books_by_genera',
  props: ['genera'],

  data() {
    return {
      books: [],
      page: 1,
      last_page: false,
      sorting: 'default',
    };
  },
  methods: {
    get_books() {
      axios
        .get(
          route('get-genera-books', {
            genera: this.genera,
            type: 'book',
            sort: this.sorting,
            page: this.book_page,
          }),
        )
        .then((response) => {
          $.each(response.data.data, (key, v) => {
            this.books.push(v);
            console.log(v);
            if (response.data.current_page == response.data.last_page) {
              this.last_page = true;
            }
          });
        });
      this.page++;
    },
    change_sort(sort) {
      this.page = 1;
      this.sorting = sort;
      this.books = [];
      this.get_books();
    },
  },
  created() {
    this.get_books();
  },
};
</script>

<style scoped>
.book_card {
  border: 1px solid #e1cfa9;
  width: 200px;
  height: 400px;
  margin: 10px;
  background-color: white;
}
@media screen and (max-width: 576px) {
  .book_card {
    border: 1px solid #e1cfa9;
    width: 150px;
    height: 200px;
    margin: 10px;
    padding: 5px;
    background-color: white;
    font-size: small;
  }
}
.book_img {
  width: 80%;
  height: 60%;
}
</style>
