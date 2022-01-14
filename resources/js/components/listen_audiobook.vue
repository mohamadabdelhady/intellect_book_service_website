<template>
    <div class="row">
        <img src="/audio_books/covers/5.jpeg" class="m-auto cover">
        <div class=" player m-auto">
            <div class="song-slider">
                <input type="range" :value="audio_seek" class="seek-bar" id="audio-seek">
                <span class="current-time">00:00</span>
                <span class="song-duration">{{this.get_duration()}}</span>
            </div>
            <div class="controllers row">
                <div class="m-auto">
                <a href="#" v-on:click.prevent="play_sound" class="ml-1"><i class="fas fa-play fa-2x" style=""></i></a>
<!--                <a href="#" v-on:click.prevent="stop_sound" class="ml-1"><i class="fas fa-stop fa-2x"></i></a>-->
                    <a href="#" v-on:click.prevent="pause_sound" class="ml-1"><i class="fas fa-pause fa-2x"></i></a>
                </div>
            </div>
            </div>

        </div>
</template>

<script>
import {Howl, Howler} from 'howler';
export default {
    name: "listen_audiobook",
    props:['file_name'],
    data()
    {
        return{
            sound:"",
            file_path:"/audio_books/audio_files/"+this.file_name+".mp3",
            audio_seek:0,
            volume:1.0,
            audio_duration:0,
            is_playing:false,
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
                     onplay: function(){
                         this.update_seekbar();
                     }
                });

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
              }
            },
            get_duration()
            {
                let duration=this.sound.duration();
                let hrs = ~~(duration / 3600);
                let mins = ~~((duration % 3600) / 60);
                let secs = ~~duration % 60;

                let ret = "";

                if (hrs > 0) {
                    ret += "" + hrs + ":" + (mins < 10 ? "0" : "");
                }

                ret += "" + mins + ":" + (secs < 10 ? "0" : "");
                ret += "" + secs;
                return ret;
            },
            update_seekbar(){
                console.log('jfla');
                let seek=this.sound.seek();
                this.audio_seek=(((seek / this.sound.duration()) * 100) || 0);
                if(this.sound.playing())
                {
                    this.update_seekbar();
                }
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
        // console.log(this.sound.duration());
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
