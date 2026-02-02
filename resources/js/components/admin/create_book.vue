<template>
  <div>
    <form @submit.prevent="createBook">
      <div class="mb-3">
        <label for="bookName" class="form-label">Book Name</label>
        <input
          type="text"
          class="form-control"
          id="bookName"
          :class="{ 'is-invalid': errors.name }"
          v-model="newBook.name"
        />
        <div class="invalid-feedback" v-if="errors.name">
          {{ errors.name[0] }}
        </div>
      </div>
      <div class="mb-3">
        <div><label for="author" class="form-label">Author</label></div>
        <select
          name="author"
          class="form-select"
          :class="{ 'is-invalid': errors.author }"
          v-model="newBook.author_id"
        >
          <option disabled value="">Select Author</option>
          <option v-for="author in authors" :key="author.id" :value="author.id">
            {{ author.name }}
          </option>
        </select>
        <div class="invalid-feedback" v-if="errors.author">
          {{ errors.author[0] }}
        </div>
      </div>
      <div class="mb-3">
        <div><label for="category" class="form-label">Category</label></div>
        <select
          name="category"
          class="form-select"
          :class="{ 'is-invalid': errors.category }"
          v-model="newBook.category_id"
        >
          <option disabled value="">Select Category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <div class="invalid-feedback" v-if="errors.category">
          {{ errors.category[0] }}
        </div>
      </div>
      <div class="mb-3">
        <div><label for="bookType" class="form-label">Book Type</label></div>
        <select
          class="form-select"
          :class="{ 'is-invalid': errors.type }"
          v-model="selectedType"
          @change="newBook.type = selectedType"
        >
          <option disabled value="">Select Book Type</option>
          <option value="book">book</option>
          <option value="audiobook">Audiobook</option>
        </select>
        <div class="invalid-feedback" v-if="errors.type">
          {{ errors.type[0] }}
        </div>
      </div>
      <div class="mb-3" v-if="selectedType === 'audiobook'">
        <label for="bookFile" class="form-label">Book Narrrator</label>
        <input
          type="text"
          class="form-control"
          id="bookNarrrator"
          :class="{ 'is-invalid': errors.narrrator }"
          v-model="newBook.narrrator"
        />
        <div class="invalid-feedback" v-if="errors.narrrator">
          {{ errors.narrrator[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          src="/images/file_upload.png"
          alt="File Upload"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.fileInput.click()"
        />
        <input
          ref="fileInput"
          id="book-file"
          hidden=""
          name="file"
          type="file"
          accept=".epub,audio/*"
          @change="handleFileUpload"
          :class="{ 'is-invalid': errors.file }"
        />
        <div class="invalid-feedback" v-if="errors.file">
          {{ errors.file[0] }}
        </div>
      </div>
      <div class="mb-3">
        <img
          v-if="!newBookCoverImg"
          src="https://placehold.co/200x200"
          alt="Placeholder Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <img
          v-else
          :src="newBookCoverImg"
          alt="Cover Image"
          class="img-thumbnail mb-2"
          style="max-width: 200px; cursor: pointer"
          @click="$refs.imageInput.click()"
        />
        <input
          ref="imageInput"
          id="image-file"
          hidden=""
          name="cover_img"
          type="file"
          class="form-control"
          accept="image/*"
          @change="previewImage"
          :class="{ 'is-invalid': errors.cover_img }"
        />
        <div class="invalid-feedback" v-if="errors.cover_img">
          {{ errors.cover_img[0] }}
        </div>
      </div>
      <div class="mb-3">
        <label for="bookDescription" class="form-label">Book Description</label>
        <textarea
          class="form-control"
          id="bookDescription"
          rows="3"
          v-model="newBook.text"
          :class="{ 'is-invalid': errors.text }"
        ></textarea>
        <div class="invalid-feedback" v-if="errors.text">
          {{ errors.text[0] }}
        </div>
      </div>
      <button type="submit" class="btn">create</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'edit_book',
  props: ['authors', 'categories'],
  data() {
    return {
      newBook: {
        name: '',
        author_id: '',
        category_id: '',
        type: '',
        cover_img: null,
        file: null,
        narrator: '',
        text: '',
      },
      newBookCoverImg: null,
      selectedType: '',
      errors: {},
    };
  },
  methods: {
    createBook() {
      const formData = new FormData();

      const keyMap = {
        category_id: 'category',
        author_id: 'author',
      };

      for (const key in this.newBook) {
        if (key == 'narrator' && this.newBook.type !== 'audiobook') {
          continue;
        }
        const formKey = keyMap[key] ?? key;
        formData.append(formKey, this.newBook[key]);
      }

      axios
        .post('/admin/books', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          window.location.href = '/admin/books/' + response.data.book.id;
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
        this.newBookCoverImg = URL.createObjectURL(file);
        this.newBook.cover_img = file;
      }
    },

    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.newBook.file = file;
      }
    },
  },
};
</script>
