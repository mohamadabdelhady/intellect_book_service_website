<template>
  <div>
    <form @submit.prevent="createAuthor">
      <div class="mb-3">
        <label for="authorName" class="form-label">Author Name</label>
        <input
          type="text"
          class="form-control"
          id="authorName"
          :class="{ 'is-invalid': errors.name }"
          v-model="newAuthor.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!newAuthorPhotoImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="newAuthorPhotoImg"
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
        <label for="bookDescription" class="form-label">About</label>
        <textarea
          class="form-control"
          id="bookDescription"
          rows="3"
          v-model="newAuthor.About"
          :class="{ 'is-invalid': errors.About }"
        ></textarea>
        <div class="invalid-feedback" v-if="errors.About">
          {{ errors.About[0] }}
        </div>
      </div>
      <button type="submit" class="btn">create</button>
    </form>
  </div>
</template>
<script>
import { error } from 'jquery';

export default {
  name: 'create_author',
  props: [],
  data() {
    return {
      newAuthor: {
        name: '',
        img: null,
        About: '',
      },
      newAuthorPhotoImg: null,
      errors: {},
    };
  },
  methods: {
    createAuthor() {
      const formData = new FormData();

      const keyMap = {
        img: 'photo',
      };

      for (const key in this.newAuthor) {
        const formKey = keyMap[key] ?? key;
        formData.append(formKey, this.newAuthor[key]);
      }

      axios
        .post('/admin/authors', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          window.location.href = '/admin/authors/' + response.data.author.id;
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
