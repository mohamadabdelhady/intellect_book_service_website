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
            <p>Are you sure you want to delete this Category?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-danger" @click="confirmDelete(category.id)">
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-5 col-md-6 col-sm-6 col-12">
        <img
          :src="`/storage/${category.banner_img}`"
          class="bd-placeholder-img"
          height="auto"
          width="100%"
          margin="auto"
          alt="Book Cover"
        />
      </div>
      <div class="col-xl-6 col-lg-7 col-md-6 col-sm-6 col-12">
        <a
          :href="'/admin/categories/' + category.id + '/edit'"
          class="btn btn-sm btn-outline-secondary"
          >Edit</a
        >
        <button type="button" class="btn btn-sm btn-outline-secondary" @click="deleteModal.show()">
          Delete
        </button>
        <h2>{{ category.name }}</h2>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
import { Modal } from 'bootstrap';

export default {
  name: 'view_category',
  props: ['category'],
  data() {
    return {};
  },
  methods: {
    confirmDelete(categoryId) {
      axios
        .delete('/admin/categories/' + categoryId)
        .then((response) => {
          window.location.href = '/admin/categories';
        })
        .catch((error) => {
          console.error('There was an error deleting the category:', error);
        });
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
