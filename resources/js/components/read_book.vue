<template>
<div class="row">
<div id="epub_reader" class="m-auto">

</div>
    <div class="control_set col ml-1">
        <a href="#" v-on:click.prevent="next_page"><i class="fas fa-chevron-circle-right fa-2x"></i></a>
        <a href="#" v-on:click.prevent="previous_page"><i class="fas fa-chevron-circle-left fa-2x"></i></a>

    </div>
    <div class="mr-auto ml-auto mt-2">
        <a href="#" v-on:click.prevent="change_fontsize('+')"><i class="fas fa-plus-circle"></i></a>
        <span>{{this.font_size}}%</span>
        <a href="#" v-on:click.prevent="change_fontsize('-')"><i class="fas fa-minus-circle"></i></a>
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
            current_location:""

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
        }
    },
    mounted() {
        this.load_book();
        console.log(this.book.currentLocation);
    }
}
</script>

<style scoped>
#epub_reader{
    height: 70vh;
    width: 80vw;
}
</style>
