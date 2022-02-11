<template>
    <div>

        <div class="results_tab">
            <a href="#" v-on:click.prevent="change_selected('ebook_results')"><span id="ebook_results" class="ml-3">E-books</span></a>
            <a href="#" v-on:click.prevent="change_selected('audiobooks_results')"> <span id="audiobooks_results" class="ml-3">Audio books</span></a>
            <div class="dropdown float-right">
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
            <hr style="width: 80vw">
        </div>

        <div id="ebook_results_area"  style="display: none;">
            <div v-if="books.length!=0" class="row">

                <div class=" " v-for="(book, index) in books">
                    <a :href="'check_book_'+book['id']" class="book_card card">
                        <img :src="'/books/'+book['cover_img']" class="book_img m-auto">
                        <p class="book_title m-auto h4">{{book['name']}}</p>
                        <p class="book_title m-auto h6">By {{book['author']}}</p>
                        <div class="row m-auto">
                            <generate_stars :rating="book['rating']"></generate_stars>
                        </div>
                    </a>
                </div>
            </div>
            <div v-else>
                <p style="font-size: medium">Sorry, we didn't find any bookmark in e-books</p>
            </div>
        </div>
        <div id="audiobooks_results_area"  style="display:none;">
            <div v-if="audio.length!=0" class="row">
                <div class="" v-for="(book, index) in audio">
                    <a :href="'check_audio_'+book['id']" class="book_card card">
                        <img :src="'/audio_books/covers/'+book['cover_img']" class="book_img m-auto">
                        <p class="book_title m-auto h4">{{book['name']}}</p>
                        <p class="book_title m-auto h6">By {{book['author']}}</p>
                        <p class="book_title m-auto h6">Narrator {{book['narrator']}}</p>
                        <div class="row m-auto">
                            <generate_stars :rating="book['rating']"></generate_stars>
                        </div>
                    </a>
                </div>
            </div>

            <div v-else>
                <p style="font-size: medium">Sorry, we didn't find any bookmark in Audio books</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "book_genera",
    props:['genera'],
    data(){
        return{
            selected:"ebook_results",
            books:[],
            audio:[],
            book_page:1,
            audio_page:1,
            book_lastpage:false,
            audio_lastpage:false,
            sorting:"default",


        }
    },
    methods:
        {
            change_selected(select)
            {
                this.selected=select;
            },
            get_books(){
                axios.get('load_genera_books/'+this.genera+'/'+this.sorting+'?page='+this.book_page).then(response=> {
                    $.each(response.data.data, (key, v) => {
                        this.books.push(v);
                        if (response.data.current_page==response.data.last_page){
                            this.book_lastpage=true;
                        }

                    });
                })
                this.book_page++;

            },
            get_audio(){
                axios.get('load_genera_audio/'+this.genera+'/'+this.sorting+'?page='+this.audio_page).then(response=> {
                    $.each(response.data.data, (key, v) => {
                        this.audio.push(v);
                        if (response.data.current_page==response.data.last_page){
                            this.audio_lastpage=true;
                        }

                    });
                })
                this.audio_page++;

            },
            change_sort(sort)
            {
                this.book_page=1;
                this.audio_page=1,
                this.sorting=sort;
                this.books=[];
                this.audio=[];
                this.get_books();
                this.get_audio();
            }
        },
    created() {
        this.get_books();
        this.get_audio();
    },
    mounted() {

        document.getElementById(this.selected).style="border-bottom:3px solid #565c68";
        document.getElementById(this.selected+"_area").style="display:block";
            document.addEventListener('scroll', (e)=> {
                let documentHeight = document.body.scrollHeight;
                let currentScroll = window.scrollY + window.innerHeight;

                let modifier = 200;
                if(this.selected=="ebook_results" && this.book_lastpage==false) {
                    if (currentScroll + modifier > documentHeight) {
                        this.get_books();
                    }
                }
                else if(this.selected=="audiobooks_results" && this.audio_lastpage==false) {
                    if (currentScroll + modifier > documentHeight) {
                        this.get_audio();
                    }
                }
            })
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
.book_card{
    border: 1px solid #e1cfa9;
    width: 200px;
    height: 400px;
    margin: 10px;
    padding:5px;
    background-color: white;
}
.book_img
{
    width:80%;
    height: 60%;

}

</style>
