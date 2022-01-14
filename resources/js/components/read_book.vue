<template>
    <div>
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
        <a href="#" v-on:click.prevent="next_page" k><i class="fas fa-chevron-circle-right fa-2x"></i></a>
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
        <hr>
        <div class="row">

        <p class="h4">You can check the reviews other reader leave on this book, and make your own by going to the previous page</p>
        <button class="btn m-auto mt-2" v-on:click.prevent="go_check">Go check reviews</button>
            <a :href="'check_book_'+book_id" target="_blank" style="display:none;" id="check_reviews"></a>
        </div>
<!--        <button v-on:click="test">dfsa</button>-->
    </div>
</template>

<script>
import ePub from "epubjs";
export default {
    name: "read_book",
    props:['file_name','type','name','book_id'],
    data()
    {
        return{
            file_path:"/books/epub_files/"+this.file_name+".epub",
            book:"",
            rendition:"",
            displayed:"",
            font_size:100,
            reader_progress:'',
           id:this.book_id

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
            // this.set_reader_progress();
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
        },
        go_check()
        {
            document.getElementById('check_reviews').click();
        },
        set_reader_progress()
        {
        axios.post('set_book_progress',{
            book_id:this.book_id,
            progress:this.reader_progress,
            type:this.type
        });
        },

        get_reader_progress()
        {
            axios.get('get_book_progress/'+this.id+'/'+this.type).then(response => {
                if (response.data!=null) {
                    this.rendition.display(response.data)
                }
            });

        }
    },

    mounted() {
        this.load_book();
        this.get_reader_progress();
        this.rendition.on('relocated', (location) => {
            let temp=location.start.cfi;
            this.reader_progress=temp;
        });
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
        document.onkeydown = e => {
            if(e.keyCode=='39')
            {
                this.next_page();
            }
            else if(e.keyCode=='37')
            {
                this.previous_page();
            }
        }

        window.addEventListener('unload', this.set_reader_progress);

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
