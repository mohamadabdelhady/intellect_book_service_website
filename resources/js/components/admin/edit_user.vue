<template>
  <div>
    <form @submit.prevent="updateUser">
      <div class="mb-3">
        <label for="bookName" class="form-label">User Name</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
          id="bookName"
          v-model="selectedUser.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="UserEmail" class="form-label">User Email</label>
        <input
          type="email"
          class="form-control"
          id="userEmail"
          :class="{ 'is-invalid': errors.email }"
          v-model="selectedUser.email"
        />
        <div class="invalid-feedback" v-if="errors.email">
          {{ errors.email[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="userPassword" class="form-label">User Password</label>
        <input
          type="password"
          class="form-control"
          id="userPassword"
          :class="{ 'is-invalid': errors.password }"
          v-model="selectedUser.password"
        />
        <div class="invalid-feedback" v-if="errors.password">
          {{ errors.password[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="userPasswordConfirmation" class="form-label">Confirm Password</label>
        <input
          type="password"
          class="form-control"
          id="userPasswordConfirmation"
          :class="{ 'is-invalid': errors.password_confirmation }"
          v-model="selectedUser.password_confirmation"
        />
        <div class="invalid-feedback" v-if="errors.password_confirmation">
          {{ errors.password_confirmation[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!selectedUserPhotoImg"
          src="/images/user_default.png"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="selectedUserPhotoImg"
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
  name: 'edit_user',
  props: ['user'],
  data() {
    return {
      selectedUser: { ...this.user },
      selectedUserPhotoImg: this.user.profile_img
        ? '/storage/' + this.user.profile_img
        : '/images/user_default.png',
      errors: {},
    };
  },
  methods: {
    updateUser() {
      const formData = new FormData();

      formData.append('name', this.selectedUser.name);
      formData.append('email', this.selectedUser.email);
      formData.append('password', this.selectedUser.password);
      formData.append('password_confirmation', this.selectedUser.password_confirmation);
      if (this.selectedUser.profile_img instanceof File) {
        formData.append('photo', this.selectedUser.profile_img);
      }

      formData.append('_method', 'PUT');

      axios
        .post('/admin/users/' + this.selectedUser.id, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          window.location.href = '/admin/users/' + response.data.user.id;
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
