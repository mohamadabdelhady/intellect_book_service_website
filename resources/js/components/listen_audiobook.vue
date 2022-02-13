<template>
    <div>
    <div class="row">

        <img :src="'/audio_books/covers/'+book_cover['cover_img']" class="m-auto cover">
        <div class="player">
            <div class="song-slider">
                <input type="range" value="0" class="seek-bar" id="audio-seek" >
                <span class="current-time">{{audio_seek_formated}}</span>
                <span class="song-duration">{{get_duration(sound.duration())}}</span>
            </div>
            <div class="controllers row">
                <div class="m-auto">
                <a href="#" v-on:click.prevent="play_sound" class="ml-1"><i class="fas fa-play fa-2x" style=""></i></a>
                    <a href="#" v-on:click.prevent="pause_sound" class="ml-1"><i class="fas fa-pause fa-2x"></i></a>

                </div>

                <div>
                    <span class="mr-2">
                        <span>play rate</span>
        <a href="#" v-on:click.prevent="change_rate('-')"><i class="fas fa-minus-circle"></i></a>
        <span>{{playback_rate}}</span>
        <a href="#" v-on:click.prevent="change_rate('+')"><i class="fas fa-plus-circle"></i></a>

    </span>
                    <a href="#" v-on:click.prevent="mute_sound" class="ml-1"><i class="fas fa-volume-mute" style="" id="mute"></i></a>
                    <span>{{volume}}%</span>
                    <input type="range" :value="volume" class="seek-bar" id="volume" style="width:5vw;margin-right:50px " >

                </div>
            </div>

            </div>

        </div>
        <hr>
        <div class="">

            <p align="center" class="txts">You can check the reviews other reader leave on this book, and make your own by going to the previous page</p>
            <p align="center"><button class="btn mt-2" v-on:click.prevent="go_check">Go check reviews</button></p>
            <a :href="'check_audio_'+book_id" target="_blank" style="display:none;" id="check_reviews"></a>
        </div>
    </div>
</template>

<script>
import {Howl, Howler} from 'howler';
export default {
    name: "listen_audiobook",
    props:['file_name','book_id','type','book_cover'],
    data()
    {
        return{
            sound:"",
            file_path:"/audio_books/audio_files/"+this.file_name+".mp3",
            audio_seek:0,
            audio_seek_formated:"00:00",
            volume:100,
            audio_duration:0,
            is_playing:"",
            playback_rate:1.0,
            mute:false,
            reader_progress:0,
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
            change_rate(sign){

                if(sign=='-'&&this.playback_rate>0.5)
                {

                    this.playback_rate=this.playback_rate-0.5;
                    this.sound.rate(this.playback_rate);
                }
                else if(sign=='+'&&this.playback_rate<4.0)
                {
                    this.playback_rate=this.playback_rate+0.5;
                    this.sound.rate(this.playback_rate);
                }
            },
            mute_sound()
            {
                this.mute=!this.mute;
                if(this.mute==true)
                {
                    document.getElementById('mute').style='color:firebrick';
                }
                else {
                    document.getElementById('mute').style='color:#565c68';

                }
                this.sound.mute(this.mute);
            },
            go_check()
            {
                document.getElementById('check_reviews').click();
            },
            play_sound()
            {
                if(!this.sound.playing()) {
                    if(this.reader_progress!=0)
                    {
                        this.sound.seek(this.reader_progress);
                        this.sound.play();
                    }
                    else {
                        this.sound.play();
                    }
                }


            },
            pause_sound()
            {
              if(this.sound.playing())
              {
                  this.sound.pause();

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
                document.getElementById('audio-seek').value=this.audio_seek;
               this.audio_seek_formated= this.get_duration(Math.round(seek));
               if (!this.sound.playing())
               {
                   clearInterval(this.is_playing);
               }

            },
            change_seek()
            {

                let per=document.getElementById('audio-seek').value;
                let seek=(this.sound.duration()*(per/100));
                this.sound.seek(seek);
                // console.log(per);
                // console.log(seek);
                // console.log('this '+this.sound.seek());
            },
            change_volume()
            {
                this.volume=document.getElementById('volume').value;
                let set_vol=this.volume/100;
                this.sound.volume(set_vol);
            },
            set_reader_progress()
            {
                let progress=this.sound.seek();
                axios.post('set_book_progress',{
                    book_id:this.book_id,
                    progress:progress,
                    type:this.type
                });
            },

            get_reader_progress()
            {
                axios.get('get_book_progress/'+this.book_id+'/'+this.type).then(response => {
                    if (response.data!=null) {
                        this.reader_progress=response.data;
                    }
                });

            }
        },
    mounted() {
        document.getElementById('audio-seek').addEventListener('change', this.change_seek, false);
        document.getElementById('volume').addEventListener('change', this.change_volume, false);
        this.get_reader_progress();
        window.addEventListener('unload', this.set_reader_progress);
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
@media screen and (max-width: 576px){
    .cover{
        height: 250px;
        width: 200px;
    }

}
</style>
