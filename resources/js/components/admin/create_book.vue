<template>
  <div>
    <form @submit.prevent="createBook">
      <div class="mb-3">
        <label for="bookName" class="form-label">Book Name</label>
        <input type="text" class="form-control" id="bookName" v-model="newBook.name" />
      </div>
      <div class="mb-3">
        <div><label for="authorSelect" class="form-label">Author</label></div>
        <select class="form-select" v-model="newBook.author_id">
          <option disabled value="">Select Author</option>
          <option v-for="author in authors" :key="author.id" :value="author.id">
            {{ author.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <div><label for="categorySelect" class="form-label">Category</label></div>
        <select class="form-select" v-model="newBook.category_id">
          <option disabled value="">Select Category</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <div><label for="bookType" class="form-label">Book Type</label></div>
        <select class="form-select" v-model="newBook.type">
          <option disabled value="">Select Book Type</option>
          <option value="book">book</option>
          <option value="audiobook">Audiobook</option>
        </select>
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
        />
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
        />
      </div>
      <div class="mb-3">
        <label for="bookDescription" class="form-label">Book Description</label>
        <textarea
          class="form-control"
          id="bookDescription"
          rows="3"
          v-model="newBook.text"
        ></textarea>
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
        text: '',
      },
      newBookCoverImg: null,
    };
  },
  methods: {
    createBook() {
      const formData = new FormData();

      for (const key in this.newBook) {
        formData.append(key, this.newBook[key]);
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
          console.error('There was an error creating the book:', error);
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
