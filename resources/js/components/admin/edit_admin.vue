<template>
  <div>
    <form @submit.prevent="updateAdmin">
      <div class="mb-3">
        <label for="bookName" class="form-label">Admin Name</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
          id="bookName"
          v-model="selectedAdmin.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="adminEmail" class="form-label">Admin Email</label>
        <input
          type="email"
          class="form-control"
          id="adminEmail"
          :class="{ 'is-invalid': errors.email }"
          v-model="selectedAdmin.email"
        />
        <div class="invalid-feedback" v-if="errors.email">
          {{ errors.email[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="adminPassword" class="form-label">Admin Password</label>
        <input
          type="password"
          class="form-control"
          id="adminPassword"
          :class="{ 'is-invalid': errors.password }"
          v-model="selectedAdmin.password"
        />
        <div class="invalid-feedback" v-if="errors.password">
          {{ errors.password[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="adminPasswordConfirmation" class="form-label">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          id="adminPasswordConfirmation"
          :class="{ 'is-invalid': errors.password_confirmation }"
          v-model="selectedAdmin.password_confirmation"
        />
        <div class="invalid-feedback" v-if="errors.password_confirmation">
          {{ errors.password_confirmation[0] }}
        </div>
      </div>
      <div class="mb-3">
        <div><label for="adminRole" class="form-label">Admin Role</label></div>
        <select
          id="adminRole"
          class="form-select"
          v-model="selectedAdmin.role"
          :class="{ 'is-invalid': errors.role }"
        >
          <option value="admin_super">Super Admin</option>
          <option value="admin_editor">Editor</option>
        </select>
        <div class="invalid-feedback" v-if="errors.role">
          {{ errors.role[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!selectedAdminPhotoImg"
          src="/images/user_default.png"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="selectedAdminPhotoImg"
          alt="Photo Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <input
          ref="imageInput"
          id="image-file"
          hidden=""
          name="photo"
          type="file"
          class="form-control"
          accept="image/*"
          @change="previewImage"
          :class="{ 'is-invalid': errors.photo }"
        />
        <div class="invalid-feedback" v-if="errors.photo">
          {{ errors.photo[0] }}
        </div>
      </div>
      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'edit_admin',
  props: ['admin'],
  data() {
    return {
      selectedAdmin: { ...this.admin },
      selectedAdminPhotoImg: this.admin.profile_img
        ? '/storage/' + this.admin.profile_img
        : '/images/user_default.png',
      errors: {},
    };
  },
  methods: {
    updateAdmin() {
      const formData = new FormData();

      formData.append('name', this.selectedAdmin.name);
      formData.append('email', this.selectedAdmin.email);
      formData.append('password', this.selectedAdmin.password);
      formData.append('password_confirmation', this.selectedAdmin.password_confirmation);
      formData.append('role', this.selectedAdmin.role);
      if (this.selectedAdmin.profile_img instanceof File) {
        formData.append('photo', this.selectedAdmin.profile_img);
      }

      formData.append('_method', 'PUT');

      axios
        .post('/admin/admins/' + this.selectedAdmin.id, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          window.location.href = '/admin/admins/' + response.data.admin.id;
        })
        .catch((error) => {
          if (error.response && error.response.status === 422) {
            this.errors = error.response.data.errors;
          }
        });
    },

    previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedAdminPhotoImg = URL.createObjectURL(file);
        this.selectedAdmin.profile_img = file;
      }
    },
  },
};
</script>
