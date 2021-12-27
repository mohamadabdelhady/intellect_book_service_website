<template>
<div class="row" id="reader_frame">
<div id="epub_reader" class="m-auto">
<div id="full_screen_controllers" style="display: none;" class="ml-2 mb-2 mt-1">

    <a href="#" v-on:click.prevent="previous_page"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
    <a href="#" v-on:click.prevent="next_page"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
    <span class="ml-5">
        <a href="#" v-on:click.prevent="change_fontsize('-')"><i class="fas fa-minus-circle"></i></a>
        <span>{{this.font_size}}%</span>
        <a href="#" v-on:click.prevent="change_fontsize('+')"><i class="fas fa-plus-circle"></i></a>

    </span>
    <a href="#" v-on:click.prevent="exit_fullScreen"><i class="fas fa-times-circle fa-2x mr-2" style="float:right;"></i></a>
</div>
</div>
    <div class="control_set col ml-1">
        <a href="#" v-on:click.prevent="next_page"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
        <a href="#" v-on:click.prevent="previous_page"><i class="fas fa-chevron-circle-left fa-2x"></i></a>
        <a href="#" v-on:click.prevent="fullScreen"><i class="fas fa-expand fa-2x"></i></a>

    </div>

    <div class="mr-auto ml-auto mt-2">

        <span>
         <a href="#" v-on:click.prevent="change_fontsize('-')"><i class="fas fa-minus-circle"></i></a>
        <span>{{this.font_size}}%</span>
        <a href="#" v-on:click.prevent="change_fontsize('+')"><i class="fas fa-plus-circle"></i></a>

            </span>
    </div>
</div>
</template>

<script>
import ePub from "epubjs";
export default {
    name: "read_book",
    props:['file_name'],
    data()
    {
        return{
            file_path:"/books/epub_files/"+this.file_name+".epub",
            book:"",
            rendition:"",
            displayed:"",
            font_size:100,
            current_location:'',
            is_full:document.fullscreenElement,

        }
    },
    methods:{
        load_book()
        {
            this.book=ePub(this.file_path);
            this.rendition=this.book.renderTo("epub_reader",{width:"100%",height:"100%"});
            this.rendition.themes.fontSize(this.font_size);
            this.displayed=this.rendition.display();
        },
        next_page()
        {
            this.rendition.next();
        },
        previous_page()
        {
            this.rendition.prev();
        },
        change_fontsize(sign)
        {
            if(sign=="-")
            {
                this.font_size--;
                this.rendition.themes.fontSize(this.font_size+'%');
            }
             else if(sign=="+")
            {
                this.font_size++
                this.rendition.themes.fontSize(this.font_size+'%');
            }
        },
        fullScreen()
        {
            document.getElementById('epub_reader').requestFullscreen();

        },
        exit_fullScreen()
        {
            document.exitFullscreen();
        }
    },
    mounted() {
        this.load_book();
        document.onfullscreenchange=function()
        {
            if(document.fullscreenElement!=null)
            {
                document.getElementById('full_screen_controllers').style.display='block';
            }
            else {
                document.getElementById('full_screen_controllers').style.display='none';
            }
        }
    },
    created() {

    }
}
</script>

<style scoped>
#epub_reader{
    height: 70vh;
    width: 80vw;
}
</style>
