<template>
<div>
    <div class="results_tab">
        <a href="#" v-on:click.prevent="change_selected('ebook_results')"><span id="ebook_results" class="ml-3">E-books ({{books.length}})</span></a>
        <a href="#" v-on:click.prevent="change_selected('audiobooks_results')"> <span id="audiobooks_results" class="ml-3">Audio books ({{audio.length}})</span></a>
        <hr style="">
    </div>
    <div id="ebook_results_area"  style="display: none;">
        <div v-if="books.length!=0" class="">
            <div class="item " v-for="(book, index) in books">
                <a :href="'check_book_'+book['id']" class="" target="_blank">
            <img :src="'books/'+book['cover_img']" class="book_img">
                <span style="margin-left: 20px;">{{book['name']}}</span>
                <generate_stars :rating="book['rating']" style="float: right;"></generate_stars>
                </a>
            </div>
        </div>
    </div>
    <div id="audiobooks_results_area"  style="display: none;">
        <div v-if="audio.length!=0" class="col">
            <div class="item " v-for="(book, index) in audio">
                <a :href="'check_audio_'+book['id']" class="" target="_blank">
                <img :src="'books/'+book['cover_img']" class="book_img">
                <span>{{book['name']}}</span>
                <generate_stars :rating="book['rating']"></generate_stars>
                </a>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    name: "get_author_work",
    props:['books','audio'],
    data(){
        return{
            selected:"ebook_results",


        }
    },
    methods:
        {
            change_selected(select)
            {
                this.selected=select;
            }
        },
    mounted() {

        document.getElementById(this.selected).style="border-bottom:3px solid #565c68";
        document.getElementById(this.selected+"_area").style="display:block";
    },
    watch:{
        selected:function(newVal,oldVal)
        {
            document.getElementById(oldVal).style="border-bottom:none;";
            document.getElementById(oldVal+"_area").style="display:none;";
            document.getElementById(newVal).style="border-bottom:3px solid #565c68;";
            document.getElementById(newVal+"_area").style="display:block;";
        }
    }
}
</script>

<style scoped>
.results_tab{

    font-size: large;
}
.item{
    margin-bottom: 10px;
}
.book_img
{
    width:10%;
    height: 5%;

}
</style>
