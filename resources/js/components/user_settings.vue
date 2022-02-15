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
                    <form method="POST" :action="route_update_info">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                    <label>Name</label>
                    <input type="name" class="form-control input" id="Inputusername" :value="user_name" name="name">
                        </div>
                        <div class="form-group">
                    <label class="mt-2">Email</label>
                    <input type="email" class="form-control input" id="InputEmail" :value="user_email" name="email">
                        </div>
                    <button class="btn mt-4" type="submit">Update</button>
                    </form>
                    <hr>
                    <form method="POST" :action="route_update_password">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input type="hidden" name="_method" value="PUT">
                    <label>Change password</label>
                        <div class="form-group">
                    <input type="password" class="form-control input mt-3" placeholder="Current password" name="current_password">
                        </div>
                        <div class="form-group">
                    <input type="password" class="form-control input mt-3" placeholder="Password" name="password">
                        </div>
                        <div class="form-group">
                    <input type="password" class="form-control input mt-3" placeholder="Confirm password" name="password_confirmation">
                        </div>
                    <button class="btn mt-4" type="submit">Change password</button>
                    </form>
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
    props:['user_name','profile_img','is0auth','user_email','route_update_info','route_update_password','errors_bag'],
    data(){
        return{
            selected:"profile",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

        }
    },
    methods:
        {
            change_selected(select)
            {
                this.selected=select;
            },
            error_handeling()
            {
                    if(errors_bag => updateProfileInformation)
                    {

                    }
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
