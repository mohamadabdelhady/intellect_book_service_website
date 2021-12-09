<template>
    <div>
<p class="h3">E-books</p>
    <hr >
        <div class="row">
        <div class="book_card card " v-for="(book, index) in books">
        <img :src="'/books/'+book['cover_img']" class="book_img m-auto">
            <p class="book_title m-auto h4">{{book['name']}}</p>
            <div class="row m-auto">
            <span class="fa fa-star checked fa-2x" v-if="book['rating']>=1"></span>
            <span class="fa fa-star fa-2x" v-else></span>
            <span class="fa fa-star checked fa-2x" v-if="book['rating']>=2"></span>
            <span class="fa fa-star fa-2x" v-else></span>
            <span class="fa fa-star checked fa-2x" v-if="book['rating']>=3"></span>
            <span class="fa fa-star fa-2x" v-else></span>
            <span class="fa fa-star checked fa-2x" v-if="book['rating']>=4"></span>
            <span class="fa fa-star fa-2x" v-else></span>
            <span class="fa fa-star checked fa-2x" v-if="book['rating']>=5"></span>
            <span class="fa fa-star fa-2x" v-else></span>
            </div>
            <div class="m-auto"><a :href="'read_book_'+book['id']"><i class="fas fa-book-reader fa-3x"></i></a></div>
            </div>
        </div>

    </div>

</template>

<script>
export default {

    data(){
        return {
            books:[],

        }
        },
    methods:{
        get_books(){
            axios.get('load_all_books').then(response=>(this.books=response.data))
        }
    },
    mounted(){
   this.get_books();

    }
}
</script>

<style scoped>
.book_card{
    border: 1px solid #e1cfa9;
    width: 15vw;
    height: 60vh;
    margin: 10px;
    background-color: white;
}
.book_img
{
    width:80%;
    height: 60%;

    /*text-align: center;*/

}
.checked {
    color: goldenrod;
}
.fa-book-reader{

}
</style>
