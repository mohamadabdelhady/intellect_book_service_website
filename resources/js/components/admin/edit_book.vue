<template>
  <div>
    <form @submit.prevent="updateBook">
      <div class="mb-3">
        <label for="bookName" class="form-label">Book Name</label>
        <input type="text" class="form-control" id="bookName" v-model="selectedBook.name" />
      </div>
      <div class="mb-3">
        <div><label for="authorSelect" class="form-label">Author</label></div>
        <select class="form-select" v-model="selectedBook.author_id">
          <option disabled value="">Select Author</option>
          <option v-for="author in authors" :key="author.id" :value="author.id">
            {{ author.name }}
          </option>
        </select>
      </div>
      <div class="mb-3">
        <div><label for="bookType" class="form-label">Book Type</label></div>
        <select class="form-select" v-model="selectedBook.type">
          <option disabled value="">Select Book Type</option>
          <option value="book">book</option>
          <option value="audiobook">Audiobook</option>
        </select>
      </div>
      <div class="mb-3">
        <img
          :src="selectedBookCoverImg"
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
          v-model="selectedBook.text"
        ></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</template>
<script>
export default {
  name: 'edit_book',
  props: ['book', 'authors'],
  data() {
    return {
      selectedBook: { ...this.book },
      selectedBookCoverImg: this.book.cover_img,
    };
  },
  methods: {
    updateBook() {
      axios
        .put('/admin/books/' + this.selectedBook.id, this.selectedBook)
        .then((response) => {
          window.location.href = '/admin/books/' + this.selectedBook.id;
        })
        .catch((error) => {
          console.error('There was an error updating the book:', error);
        });
    },

    previewImage(event) {
      const file = event.target.files[0];
      if (file) {
        this.selectedBookCoverImg = URL.createObjectURL(file);
        this.selectedBook.cover_img = file;
      }
    },
  },
};
</script>
