<template>
  <div>
    <div class="modal" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Book</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this book?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="confirmDelete(book.id)">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
        <img
          :src="`/storage/${book.cover_img}`"
          class="bd-placeholder-img"
          height="auto"
          width="100%"
          margin="auto"
          alt="Book Cover"
        />
      </div>
      <div class="col-xl-6 col-lg-7 col-md-6 col-sm-6 col-12">
        <a :href="'/admin/books/' + book.id + '/edit'" class="btn btn-sm btn-outline-secondary"
          >Edit</a
        >
        <button type="button" class="btn btn-sm btn-outline-secondary" @click="deleteModal.show()">
          Delete
        </button>
        <h2>{{ book.name }}</h2>
        <p><strong>Author:</strong> {{ book.author_name }}</p>
        <p v-if="book.type === 'audiobook'"><strong>Narrator:</strong> {{ book.narrator }}</p>
        <p><strong>Type:</strong> {{ book.type }}</p>
        <p><strong>Description:</strong> {{ book.text }}</p>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
  name: 'view_book',
  props: ['book'],
  data() {
    return {};
  },
  methods: {
    confirmDelete(bookId) {
      axios
        .delete('/admin/books/' + bookId)
        .then((response) => {
          window.location.href = '/admin/books';
        })
        .catch((error) => {
          console.error('There was an error deleting the book:', error);
        });
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
