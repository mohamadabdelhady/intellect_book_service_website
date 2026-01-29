<template>
  <div>
    <form @submit.prevent="updateCategory">
      <div class="mb-3">
        <label for="bookName" class="form-label">Category Name</label>
        <input
          type="text"
          class="form-control"
          :class="{ 'is-invalid': errors.name }"
          id="bookName"
          v-model="selectedCategory.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!selectedCategoryBannerImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="selectedCategoryBannerImg"
          alt="banner Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <input
          ref="imageInput"
          id="image-file"
          hidden=""
          name="banner"
          type="file"
          class="form-control"
          accept="image/*"
          @change="previewImage"
          :class="{ 'is-invalid': errors.banner }"
        />
        <div class="invalid-feedback" v-if="errors.banner">
          {{ errors.banner[0] }}
        </div>
      </div>
      <button type="submit" class="btn">Update</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'edit_category',
  props: ['category'],
  data() {
    return {
      selectedCategory: { ...this.category },
      selectedCategoryBannerImg: this.category.banner_img,
      errors: {},
    };
  },
  methods: {
    updateCategory() {
      const formData = new FormData();

      formData.append('name', this.selectedCategory.name);

      if (this.selectedCategory.banner_img instanceof File) {
        formData.append('banner', this.selectedCategory.banner_img);
      }

      formData.append('_method', 'PUT');

      axios
        .post('/admin/categories/' + this.selectedCategory.id, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          window.location.href = '/admin/categories/' + response.data.category.id;
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
        this.selectedCategoryBannerImg = URL.createObjectURL(file);
        this.selectedCategory.banner_img = file;
      }
    },
  },
};
</script>
