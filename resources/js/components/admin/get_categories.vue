<template>
  <div>
    <div class="modal" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this category?</p>
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
          placeholder="Search categories..."
          v-model="searchQuery"
          @keyup.enter="fetchCategories"
        />
      </div>
      <div class="col-6 mb-4 text-end">
        <a href="/admin/categories/create" class="btn">Add New Category</a>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 min-vh-100 m-auto text-center"
        v-if="!categoriesData.data.length"
      >
        <p class="txts">There are no categories available.</p>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12"
        v-for="category in categoriesData.data"
        :key="category.id"
      >
        <div class="card mb-4 shadow-sm">
          <img
            :src="
              category.banner_img
                ? `/storage/${category.banner_img}`
                : 'https://placehold.co/200x200'
            "
            width="100%"
            height="225"
            alt="Category banner"
          />
          <div class="card-body">
            <h5 class="card-title">{{ category.name }}</h5>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a
                  :href="'/admin/categories/' + category.id + '/edit'"
                  class="btn btn-sm btn-outline-secondary"
                  >Edit</a
                >
                <a
                  :href="'/admin/categories/' + category.id"
                  class="btn btn-sm btn-outline-secondary"
                  >View</a
                >
                <button
                  @click="deleteCategory(category.id)"
                  class="btn btn-sm btn-outline-secondary"
                >
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
            <li class="page-item" :class="{ disabled: !categoriesData.prev_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="categoriesData.prev_page_url + '&query=' + searchQuery"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </a>
              <a
                v-else
                class="page-link"
                :href="categoriesData.prev_page_url"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#"
                >Page {{ categoriesData.current_page }} of {{ categoriesData.last_page }}</a
              >
            </li>
            <li class="page-item" :class="{ disabled: !categoriesData.next_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="categoriesData.next_page_url + '&query=' + searchQuery"
                aria-label="Next"
              >
                <span aria-hidden="true">&raquo;</span>
              </a>
              <a v-else class="page-link" :href="categoriesData.next_page_url" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="categoriesData.first_page_url + '&query=' + searchQuery"
                >First</a
              >
              <a v-else class="page-link" :href="categoriesData.first_page_url">First</a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="categoriesData.last_page_url + '&query=' + searchQuery"
                >Last</a
              >
              <a v-else class="page-link" :href="categoriesData.last_page_url">Last</a>
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
  name: 'get_categories',
  props: ['categories', 'query'],
  data() {
    return {
      categoriesData: this.categories,
      selectedCategory: null,
      searchQuery: this.query,
    };
  },
  methods: {
    confirmDelete() {
      axios
        .delete('/admin/categories/' + this.selectedCategory)
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          console.error('There was an error deleting the category!', error);
        });
    },
    deleteCategory(categoryId) {
      this.deleteModal.show();
      this.selectedCategory = categoryId;
    },
    fetchCategories() {
      window.location.href = `/admin/categories?query=${this.searchQuery}`;
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
