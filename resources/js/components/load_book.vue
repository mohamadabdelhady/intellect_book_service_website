<template>
    <div>

<p class="h3">E-books</p>

    <hr >
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sort by
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('default')">default</a>
                <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('rate')">rating</a>
                <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('newest')">newest</a>
                <a class="dropdown-item" href="#" v-on:click.prevent="change_sort('oldest')">oldest</a>
            </div>
        </div>
        <div class="row" >
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
            <div class="m-auto"><a :href="'check_book_'+book['id']"><i class="fas fa-book-reader fa-3x"></i></a></div>
            </div>

        </div>
        <div class="row">
            <button class="btn m-auto mt-4" v-on:click="get_books" :disabled="last_page==true">Load more E-books</button>
        </div>
    </div>

</template>

<script>
export default {
name:'load_book',

    data(){
        return {
            books:[],
            page:1,
            last_page:false,
            sorting:"default",


        }
        },
    methods:{
        get_books(){
            axios.get('load_all_books/'+this.sorting+'?page='+this.page).then(response=> {
                $.each(response.data.data, (key, v) => {
                    this.books.push(v);
                    if (response.data.current_page==response.data.last_page){
                        this.last_page=true;
                    }

                });
            })
                    this.page++;

        },
        change_sort(sort)
        {
            this.page=1;
            this.sorting=sort;
            this.books=[];
            this.get_books();
        }
    },
created(){
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
