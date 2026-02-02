<template>
  <div>
    <form @submit.prevent="createUser">
      <div class="mb-3">
        <label for="adminName" class="form-label">User Name</label>
        <input
          type="text"
          class="form-control"
          id="adminName"
          :class="{ 'is-invalid': errors.name }"
          v-model="newUser.name"
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
          id="adminEmail"
          :class="{ 'is-invalid': errors.email }"
          v-model="newUser.email"
        />
        <div class="invalid-feedback" v-if="errors.email">
          {{ errors.email[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">User Password</label>
        <input
          type="password"
          class="form-control"
          id="adminPassword"
          :class="{ 'is-invalid': errors.password }"
          v-model="newUser.password"
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
          id="userPasswordConfirmation"
          :class="{ 'is-invalid': errors.password_confirmation }"
          v-model="newUser.password_confirmation"
        />
        <div class="invalid-feedback" v-if="errors.password_confirmation">
          {{ errors.password_confirmation[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!newUserPhotoImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="newUserPhotoImg"
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
        <div class="invalid-feedback" v-if="errors.profile_img">
          {{ errors.photo[0] }}
        </div>
      </div>
      <button type="submit" class="btn">create</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'create_user',
  props: [],
  data() {
    return {
      newUser: {
        name: '',
        profile_img: null,
        password: '',
        password_confirmation: '',
      },
      newUserPhotoImg: null,
      errors: {},
    };
  },
  methods: {
    createUser() {
      const formData = new FormData();

      const keyMap = {
        img: 'photo',
      };

      for (const key in this.newUser) {
        if (key === 'profile_img' && !this.newUser.profile_img) {
          continue;
        }
        const formKey = keyMap[key] ?? key;
        formData.append(formKey, this.newUser[key]);
      }

      axios
        .post('/admin/users', formData, {
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
        this.newUserPhotoImg = URL.createObjectURL(file);
        this.newUser.profile_img = file;
      }
    },
  },
};
</script>
