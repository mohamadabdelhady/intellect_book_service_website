<template>
  <div>
    <div class="modal" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Author</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this author?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="confirmDelete()">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-6 mb-4">
        <input
          type="text"
          class="form-control m-auto"
          placeholder="Search authors..."
          v-model="searchQuery"
          @keyup.enter="fetchAuthors"
        />
      </div>
      <div class="col-6 mb-4 text-end">
        <a href="/admin/authors/create" class="btn">Add New Author</a>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 min-vh-100 m-auto text-center"
        v-if="!authorsData.data.length"
      >
        <p class="txts">There are no authors available.</p>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12"
        v-for="author in authorsData.data"
        :key="author.id"
      >
        <div class="card mb-4 shadow-sm">
          <img
            :src="`/storage/${author.img}`"
            class="bd-placeholder-img card-img-top"
            width="100%"
            height="225"
            alt="Author Photo"
          />
          <div class="card-body">
            <h5 class="card-title">{{ author.name }}</h5>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a
                  :href="'/admin/authors/' + author.id + '/edit'"
                  class="btn btn-sm btn-outline-secondary"
                  >Edit</a
                >
                <a :href="'/admin/authors/' + author.id" class="btn btn-sm btn-outline-secondary"
                  >View</a
                >
                <button @click="deleteAuthor(author.id)" class="btn btn-sm btn-outline-secondary">
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
            <li class="page-item" :class="{ disabled: !authorsData.prev_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="authorsData.prev_page_url + '&query=' + searchQuery"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </a>
              <a v-else class="page-link" :href="authorsData.prev_page_url" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#"
                >Page {{ authorsData.current_page }} of {{ authorsData.last_page }}</a
              >
            </li>
            <li class="page-item" :class="{ disabled: !authorsData.next_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="authorsData.next_page_url + '&query=' + searchQuery"
                aria-label="Next"
              >
                <span aria-hidden="true">&raquo;</span>
              </a>
              <a v-else class="page-link" :href="authorsData.next_page_url" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="authorsData.first_page_url + '&query=' + searchQuery"
                >First</a
              >
              <a v-else class="page-link" :href="authorsData.first_page_url">First</a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="authorsData.last_page_url + '&query=' + searchQuery"
                >Last</a
              >
              <a v-else class="page-link" :href="authorsData.last_page_url">Last</a>
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
  name: 'get_authors',
  props: ['authors', 'query'],
  data() {
    return {
      authorsData: this.authors,
      selectedAuthor: null,
      searchQuery: this.query,
    };
  },
  methods: {
    confirmDelete() {
      axios
        .delete('/admin/authors/' + this.selectedAuthor)
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          console.error('There was an error deleting the author!', error);
        });
    },
    deleteAuthor(authorId) {
      this.deleteModal.show();
      this.selectedAuthor = authorId;
    },
    fetchAuthors() {
      window.location.href = `/admin/authors?query=${this.searchQuery}`;
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
