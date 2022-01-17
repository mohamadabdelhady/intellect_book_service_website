<template>
    <div>
    <div class="row">
        <img src="/audio_books/covers/5.jpeg" class="m-auto cover">
        <div class=" player m-auto">
            <div class="song-slider">
                <input type="range" :value="audio_seek" class="seek-bar" id="audio-seek">
                <span class="current-time">{{audio_seek_formated}}</span>
                <span class="song-duration">{{get_duration(sound.duration())}}</span>
            </div>
            <div class="controllers row">
                <div class="m-auto">
                <a href="#" v-on:click.prevent="play_sound" class="ml-1"><i class="fas fa-play fa-2x" style=""></i></a>
<!--                <a href="#" v-on:click.prevent="stop_sound" class="ml-1"><i class="fas fa-stop fa-2x"></i></a>-->
                    <a href="#" v-on:click.prevent="pause_sound" class="ml-1"><i class="fas fa-pause fa-2x"></i></a>
                    <button v-on:click="seek">seek</button>
                </div>
            </div>
            </div>

        </div>
        <hr>
        <div class="row">

            <p class="h4">You can check the reviews other reader leave on this book, and make your own by going to the previous page</p>
            <button class="btn m-auto mt-2" v-on:click.prevent="go_check">Go check reviews</button>
            <a :href="'check_audio_'+book_id" target="_blank" style="display:none;" id="check_reviews"></a>
        </div>
    </div>
</template>

<script>
import {Howl, Howler} from 'howler';
export default {
    name: "listen_audiobook",
    props:['file_name','book_id'],
    data()
    {
        return{
            sound:"",
            file_path:"/audio_books/audio_files/"+this.file_name+".mp3",
            audio_seek:0,
            audio_seek_formated:"00:00",
            volume:1.0,
            audio_duration:0,
            is_playing:"",
        }
    },
    methods:
        {
            load_audio()
            {
                 this.sound = new Howl({
                    src: [this.file_path],
                    html5: true,
                     autoplay:false,
                     onplay: () => {
                         this.is_playing= setInterval(this.update_seekbar,1000);
                     }
                });

            },
            seek(){

            },
            go_check()
            {
                document.getElementById('check_reviews').click();
            },
            play_sound()
            {
                if(!this.sound.playing()) {

                   this.sound.play();

                }


            },
            pause_sound()
            {
              if(this.sound.playing())
              {
                  this.sound.pause();
                  clearInterval(this.is_playing);
              }
            },
            get_duration(duration)
            {
                var minutes = Math.floor(duration / 60) || 0;
                var seconds = Math.floor(duration - minutes * 60) || 0;
                return (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            },
            update_seekbar(){
                let seek=this.sound.seek();
                this.audio_seek=(((seek / this.sound.duration()) * 100) || 0);
               this.audio_seek_formated= this.get_duration(Math.round(seek));

            },
        },
    mounted() {
        this.$nextTick(function () {

        });
    },
    created() {
        this.load_audio();
    },
    beforeUpdate() {

    },

}
</script>

<style scoped>
.player{
    background-color: #f1f1f0;
    border:1px solid #e1cfa9;
    width:100vw;
    height:80px;
    border-radius: 1%;
}

.controllers a{
    color: #565c68;

}
.cover{
    height: 350px;
    width: 200px;
}
/*#myProgress {*/
/*    width: 100%;*/
/*    background-color: #18181f;*/
/*}*/

/*#myBar {*/
/*    width: 1%;*/
/*    height: 30px;*/
/*    background-color: white;*/
/*}*/
.song-slider{
    width: 98%;
    position: relative;
}

.seek-bar{
    -webkit-appearance: none;
    margin-left:5px;
    width: 80vw;
    height: 5px;
    border-radius: 10px;
    background: white;
    overflow: hidden;
    cursor: pointer;
}

.seek-bar::-webkit-slider-thumb{
    -webkit-appearance: none;
    width: 1px;
    height: 20px;
    box-shadow: -80vw 0 0 80vw #e1cfa9;
}
.current-time,
.song-duration{
    font-size: 14px;
    margin-left:5px;
}

.song-duration{
    position: absolute;
    right: 0;
}

</style>
