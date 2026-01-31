<template>
  <div>
    <form @submit.prevent="createAdmin">
      <div class="mb-3">
        <label for="adminName" class="form-label">Admin Name</label>
        <input
          type="text"
          class="form-control"
          id="adminName"
          :class="{ 'is-invalid': errors.name }"
          v-model="newAdmin.name"
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
          v-model="newAdmin.email"
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
          v-model="newAdmin.password"
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
          v-model="newAdmin.password_confirmation"
        />
        <div class="invalid-feedback" v-if="errors.password_confirmation">
          {{ errors.password_confirmation[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!newAdminPhotoImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="newAdminPhotoImg"
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
      <div class="mb-3">
        <select class="form-select" v-model="newAdmin.role" :class="{ 'is-invalid': errors.role }">
          <option value="admin_super">Super Admin</option>
          <option value="admin_editor">Editor Admin</option>
        </select>
        <div class="invalid-feedback" v-if="errors.role">
          {{ errors.role[0] }}
        </div>
      </div>

      <button type="submit" class="btn">create</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'create_admin',
  props: [],
  data() {
    return {
      newAdmin: {
        name: '',
        profile_img: null,
        About: '',
      },
      newAdminPhotoImg: null,
      errors: {},
    };
  },
  methods: {
    createAdmin() {
      const formData = new FormData();

      const keyMap = {
        img: 'photo',
      };

      for (const key in this.newAdmin) {
        if (key === 'profile_img' && !this.newAdmin.profile_img) {
          continue;
        }
        const formKey = keyMap[key] ?? key;
        formData.append(formKey, this.newAdmin[key]);
      }

      axios
        .post('/admin/admins', formData, {
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
        this.newAuthorPhotoImg = URL.createObjectURL(file);
        this.newAuthor.img = file;
      }
    },
  },
};
</script>
