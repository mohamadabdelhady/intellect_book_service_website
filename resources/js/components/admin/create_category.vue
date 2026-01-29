<template>
  <div>
    <form @submit.prevent="createCategory">
      <div class="mb-3">
        <label for="authorName" class="form-label">Category Name</label>
        <input
          type="text"
          class="form-control"
          id="authorName"
          :class="{ 'is-invalid': errors.name }"
          v-model="newCategory.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!newCategoryBannerImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="newCategoryBannerImg"
          alt="Banner Image"
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
      <button type="submit" class="btn">create</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'create_category',
  props: [],
  data() {
    return {
      newCategory: {
        name: '',
        banner_img: null,
      },
      newCategoryBannerImg: null,
      errors: {},
    };
  },
  methods: {
    createCategory() {
      const formData = new FormData();

      const keyMap = {
        banner_img: 'banner',
      };

      for (const key in this.newCategory) {
        const formKey = keyMap[key] ?? key;
        formData.append(formKey, this.newCategory[key]);
      }

      axios
        .post('/admin/categories', formData, {
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
        this.newCategoryBannerImg = URL.createObjectURL(file);
        this.newCategory.banner_img = file;
      }
    },
  },
};
</script>
