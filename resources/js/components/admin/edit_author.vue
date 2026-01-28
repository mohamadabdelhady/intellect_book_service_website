<template>
  <div>
    <form @submit.prevent="updateAuthor">
      <div class="mb-3">
        <label for="bookName" class="form-label">Author Name</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
          id="bookName"
          v-model="selectedAuthor.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!selectedAuthorPhotoImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="selectedAuthorPhotoImg"
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
        <label for="authorDescription" class="form-label">About</label>
        <textarea
          class="form-control"
          id="authorDescription"
          rows="3"
          v-model="selectedAuthor.About"
          :class="{ 'is-invalid': errors.About }"
        ></textarea>
        <div class="invalid-feedback" v-if="errors.About">
          {{ errors.About[0] }}
        </div>
      </div>
      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'edit_author',
  props: ['author'],
  data() {
    return {
      selectedAuthor: { ...this.author },
      selectedAuthorPhotoImg: this.author.img
        ? '/storage/' + this.author.img
        : '/images/default.png',
      errors: {},
    };
  },
  methods: {
    updateAuthor() {
      const formData = new FormData();

      formData.append('name', this.selectedAuthor.name);
      formData.append('About', this.selectedAuthor.About);

      if (this.selectedAuthor.img instanceof File) {
        formData.append('photo', this.selectedAuthor.img);
      }

      formData.append('_method', 'PUT');

      axios
        .post('/admin/authors/' + this.selectedAuthor.id, formData, {
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
        this.selectedAuthorPhotoImg = URL.createObjectURL(file);
        this.selectedAuthor.img = file;
      }
    },
  },
};
</script>
