<template>
  <div>
    <p class="h1">{{ user_name }}'s bookmark list</p>
    <div class="results_tab">
      <a href="#" v-on:click.prevent="change_selected('ebook_results')"
        ><span id="ebook_results" class="ml-3">E-books ({{ books.length }})</span></a
      >
      <a href="#" v-on:click.prevent="change_selected('audiobooks_results')">
        <span id="audiobooks_results" class="ml-3">Audio books ({{ audiobooks.length }})</span></a
      >
      <hr style="width: 80vw" />
    </div>
    <div>
      <div id="ebook_results_area" style="display: none">
        <div v-if="books.length != 0" class="row">
          <div class=" " v-for="(book, index) in books">
            <a :href="route('check-book', book.book['id'])" class="book_card card">
              <img :src="'/books/' + book.book['cover_img']" class="book_img m-auto" />
              <p class="book_title m-auto h4">{{ book.book['name'] }}</p>
              <p class="book_title m-auto h6">By {{ book.book['author_name'] }}</p>
              <div class="row m-auto">
                <generate_stars :rating="book.book['rating']"></generate_stars>
              </div>
            </a>
          </div>
        </div>
        <div v-else>
          <p style="font-size: medium">Sorry, we didn't find any bookmark in e-books</p>
        </div>
      </div>
      <div id="audiobooks_results_area" style="display: none">
        <div v-if="audiobooks.length != 0" class="row">
          <div class="" v-for="(book, index) in audiobooks">
            <a :href="route('check-book', book.book['id'])" class="book_card card">
              <img :src="'/audio_books/covers/' + book.book['cover_img']" class="book_img m-auto" />
              <p class="book_title m-auto h4">{{ book.book['name'] }}</p>
              <p class="book_title m-auto h6">By {{ book.book['author_name'] }}</p>
              <p class="book_title m-auto h6">Narrator {{ book.book['narrator'] }}</p>
              <div class="row m-auto">
                <generate_stars :rating="book.book['rating']"></generate_stars>
              </div>
            </a>
          </div>
        </div>
        <div v-else>
          <p style="font-size: medium">Sorry, we didn't find any bookmark in Audio books</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { route } from 'ziggy-js';

export default {
  name: 'user_bookmark',
  props: ['books', 'audiobooks', 'user_name'],
  data() {
    return {
      selected: 'ebook_results',
      books: [],
      audiobooks: [],
    };
  },
  methods: {
    change_selected(select) {
      this.selected = select;
    },
  },
  mounted() {
    document.getElementById(this.selected).style = 'border-bottom:3px solid #565c68';
    document.getElementById(this.selected + '_area').style = 'display:block';
  },
  watch: {
    selected: function (newVal, oldVal) {
      document.getElementById(oldVal).style = 'border-bottom:none;';
      document.getElementById(oldVal + '_area').style = 'display:none;';
      document.getElementById(newVal).style = 'border-bottom:3px solid #565c68;';
      document.getElementById(newVal + '_area').style = 'display:block;';
    },
  },
};
</script>
<style scoped>
.results_tab {
  font-size: large;
}
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
    height: 320px;
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
