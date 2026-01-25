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
            <button type="button" class="btn btn-danger" @click="confirmDelete()">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12"
        v-for="book in booksData"
        :key="book.id"
      >
        <div class="card mb-4 shadow-sm">
          <img
            :src="'/books/' + book.cover_img"
            class="bd-placeholder-img card-img-top"
            width="100%"
            height="225"
            alt="Book Cover"
          />
          <div class="card-body">
            <h5 class="card-title">{{ book.name }}</h5>
            <p class="card-text">Author: {{ book.author_name }}</p>
            <p class="card-text">Type: {{ book.type }}</p>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a
                  :href="'/admin/books/' + book.id + '/edit'"
                  class="btn btn-sm btn-outline-secondary"
                  >Edit</a
                >
                <a :href="'/admin/books/' + book.id" class="btn btn-sm btn-outline-secondary"
                  >View</a
                >
                <button @click="deleteBook(book.id)" class="btn btn-sm btn-outline-secondary">
                  Delete
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 d-flex justify-content-center">
        <nav aria-label="Page navigation">
          <ul class="pagination">
            <li class="page-item" :class="{ disabled: !books.prev_page_url }">
              <a class="page-link" :href="books.prev_page_url" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#"
                >Page {{ books.current_page }} of {{ books.last_page }}</a
              >
            </li>
            <li class="page-item" :class="{ disabled: !books.next_page_url }">
              <a class="page-link" :href="books.next_page_url" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <li class="page-item">
              <a class="page-link" :href="books.first_page_url">First</a>
            </li>
            <li class="page-item">
              <a class="page-link" :href="books.last_page_url">Last</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { Modal } from 'bootstrap';

export default {
  name: 'get_books',
  props: ['books'],
  data() {
    return {
      booksData: this.books.data,
      selectedBook: null,
    };
  },
  methods: {
    confirmDelete() {
      axios
        .delete('/admin/books/' + this.selectedBook)
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          console.error('There was an error deleting the book!', error);
        });
    },
    deleteBook(bookId) {
      this.deleteModal.show();
      this.selectedBook = bookId;
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
