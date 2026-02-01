<template>
  <div>
    <div class="modal" id="deleteModal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Admin</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this Admin?</p>
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
          placeholder="Search admins..."
          v-model="searchQuery"
          @keyup.enter="fetchAdmins"
        />
      </div>
      <div class="col-6 mb-4 text-end">
        <a href="/admin/admins/create" class="btn">Add New Admin</a>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12 min-vh-100 m-auto text-center"
        v-if="!adminsData.data.length"
      >
        <p class="txts">There are no admins available.</p>
      </div>
      <div
        class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12"
        v-for="admin in adminsData.data"
        :key="admin.id"
      >
        <div class="card mb-4 shadow-sm">
          <img
            :src="admin.profile_img ? `/storage/${admin.profile_img}` : '/images/user_default.png'"
            class="bd-placeholder-img card-img-top"
            width="100%"
            height="225"
            alt="Admin Photo"
          />
          <div class="card-body">
            <h5 class="card-title">{{ admin.name }}</h5>
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <a
                  :href="'/admin/admins/' + admin.id + '/edit'"
                  class="btn btn-sm btn-outline-secondary"
                  >Edit</a
                >
                <a :href="'/admin/admins/' + admin.id" class="btn btn-sm btn-outline-secondary"
                  >View</a
                >
                <button @click="deleteAdmin(admin.id)" class="btn btn-sm btn-outline-secondary">
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
            <li class="page-item" :class="{ disabled: !adminsData.prev_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="adminsData.prev_page_url + '&query=' + searchQuery"
                aria-label="Previous"
              >
                <span aria-hidden="true">&laquo;</span>
              </a>
              <a v-else class="page-link" :href="adminsData.prev_page_url" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#"
                >Page {{ adminsData.current_page }} of {{ adminsData.last_page }}</a
              >
            </li>
            <li class="page-item" :class="{ disabled: !adminsData.next_page_url }">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="adminsData.next_page_url + '&query=' + searchQuery"
                aria-label="Next"
              >
                <span aria-hidden="true">&raquo;</span>
              </a>
              <a v-else class="page-link" :href="adminsData.next_page_url" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="adminsData.first_page_url + '&query=' + searchQuery"
                >First</a
              >
              <a v-else class="page-link" :href="adminsData.first_page_url">First</a>
            </li>
            <li class="page-item">
              <a
                v-if="searchQuery && searchQuery.trim()"
                class="page-link"
                :href="adminsData.last_page_url + '&query=' + searchQuery"
                >Last</a
              >
              <a v-else class="page-link" :href="adminsData.last_page_url">Last</a>
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
  name: 'get_admins',
  props: ['admins', 'query'],
  data() {
    return {
      adminsData: this.admins,
      selectedAdmin: null,
      searchQuery: this.query,
    };
  },
  methods: {
    confirmDelete() {
      axios
        .delete('/admin/admins/' + this.selectedAdmin)
        .then((response) => {
          window.location.reload();
        })
        .catch((error) => {
          console.error('There was an error deleting the admin!', error);
        });
    },
    deleteAdmin(adminId) {
      this.deleteModal.show();
      this.selectedAdmin = adminId;
    },
    fetchAdmins() {
      window.location.href = `/admin/admins?query=${this.searchQuery}`;
    },
  },
  mounted() {
    this.deleteModal = new Modal(document.getElementById('deleteModal'));
  },
};
</script>
