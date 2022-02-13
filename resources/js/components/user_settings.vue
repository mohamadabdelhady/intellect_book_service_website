<template>
    <div>

        <div class="settings_tab">
            <a href="#" v-on:click.prevent="change_selected('profile')"><span id="profile" class="ml-3">Profile settings</span></a>
            <a href="#" v-on:click.prevent="change_selected('subscription')"> <span id="subscription" class="ml-3">subscription settings</span></a>
        </div>
            <hr>
            <div id="profile_area"style="display: none;">
                <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 col-5" style="border-right:1px solid #cbcaca;">
                    <img :src="profile_img" class="user_profile " v-if="is0auth==true">
                    <img v-else :src="'/images/users_profile_img/'+profile_img" class="user_profile">
                    <button class="btn mt-3" style="width: 100%;"><span class="">Change image</span></button>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-8 col-sm-7 col-7">
                    <label>Name</label>
                    <input type="firstname" class="form-control input" id="Inputusername" :value="user_name" name="first_name">
                    <label class="mt-2">Email</label>
                    <input type="email" class="form-control input" id="InputEmail" :value="user_email" name="email">
                    <button class="btn mt-4">Update</button>
                    <hr>
                    <label>Change password</label>
                    <input type="password" class="form-control input mt-3" placeholder="Current password" name="current_password">
                    <input type="password" class="form-control input mt-3" placeholder="Password" name="password">
                    <input type="password" class="form-control input mt-3" placeholder="Confirm password" name="confirm_password">
                    <button class="btn mt-4">Change password</button>
                </div>
                </div>
            </div>
            <div id="subscription_area"  style="display: none;">
        </div>


    </div>
</template>

<script>
export default {
    name: "user_settings",
    props:['user_name','profile_img','is0auth','user_email'],
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
.input{
    width: 30vw;
}
@media screen and (max-width: 576px){
    .user_profile{
        width: 150px;
        height: 150px;
    }
    .input{
        width: 45vw;
    }
}
</style>
