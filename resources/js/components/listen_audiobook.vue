<template>
    <div class="row">
        <img src="/audio_books/covers/5.jpeg" class="m-auto cover">
        <div class=" player m-auto">
            <div>kfd;kf;</div>
<div class="controllers row">

    <div class="ml-auto mr-auto">
    <a href="#" v-on:click.prevent="play_sound" class="ml-1"><i class="fas fa-play fa-2x" style=""></i></a>
    <a href="#" v-on:click.prevent="stop_sound" class="ml-1"><i class="fas fa-stop fa-2x"></i></a>
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
            is_playing:false,
        }
    },
    methods:
        {
            load_audio()
            {
                 this.sound = new Howl({
                    src: [this.file_path],
                    html5: true
                });
            },
            play_sound()
            {
                if(!this.sound.playing()) {
                    this.sound.play();
                    this.is_playing=true;
                }
            },
            stop_sound()
            {
                if(this.sound.playing())
                {
                    this.sound.stop();
                    this.is_playing=false;
                }
            }
        },
    mounted() {
this.load_audio();

    }
}
</script>

<style scoped>
.player{
    background-color: #18181f;
    width:100vw;
    height:60px;

}

.controllers a{
    color: #e1cfa9;
    margin:5px;
}
.cover{
    height: 350px;
    width: 200px;
}
</style>
