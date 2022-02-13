<template>
    <div>

        <div class="settings_tab">
            <a href="#" v-on:click.prevent="change_selected('profile')"><span id="profile" class="ml-3">Profile settings</span></a>
            <a href="#" v-on:click.prevent="change_selected('subscription')"> <span id="subscription" class="ml-3">subscription settings</span></a>
        </div>
            <hr>
            <div class="row">
            <div class="col-12">
            <div id="profile_area" class="row"  style="display: none;">
                <div class="col-3" style="border-right:1px solid #cbcaca;">
                    <img :src="profile_img" class="user_profile" v-if="is0auth==true">
                    <img v-else :src="'/images/users_profile_img/'+profile_img" class="user_profile">
                    <button class="btn mt-1" style="width: 100%;"><span class=""></span></button>
                </div>
                <div class="col-9">

                </div>
            </div>
            <div id="subscription_area"  style="display: none;">
            </div>
            </div>
        </div>


    </div>
</template>

<script>
export default {
    name: "user_settings",
    props:['user_name','profile_img','is0auth'],
    data(){
        return{
            selected:"profile",


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
.settings_tab{

    font-size: large;
}
.user_profile{
    width: 200px;
    height: 200px;
    border-radius: 50%;
}

</style>
