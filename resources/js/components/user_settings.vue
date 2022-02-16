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
                    <form id="change_prof" action="prof_change" method="POST"  style="display: none;" enctype="multipart/form-data">
                        <input type="hidden" name="_token" v-bind:value="csrf">
                        <input type="file"  directory  accept="image/*" style="display: none;" id="upload-img_prof" class="form-control" name="profimg" onchange="document.getElementById('change_prof').submit()">
                    </form>
                    <button class="btn mt-3" style="width: 100%;" onclick="event.preventDefault(); document.getElementById('upload-img_prof').click();"><span class="float-right">Change image</span><i class="fas fa-user-circle fa-2x float-left"></i></button>
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
                <label class="h4">subscription information</label>
                <p v-if="days<=30">Your free trial status: {{remaining_days}} days left</p>
                <p v-else>Your free trial status: trial ended</p>
                <p v-if="plan!=null">Your current plan: {{plan}}</p>
                <p v-else>Your current plan: none</p>
                <div><span>automatic subscription renew: </span><input type="checkbox"></div>
                <button class="btn" type="button" data-toggle="modal" data-target="#myModal">Change your plan</button>
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">

                            <div class="modal-body">
                                <div><div class="ml-5 mb-2 plan">
                                    <div align="center">
                                        <div class="container ">
                                            <div class="row plans pt-2">
                                                <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planA';" style="cursor: pointer;"><p class="display-2">1</p><p style="font-size: large">month</p><p style="font-size: x-large">10 &#36;</p></div>
                                                <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planB';" style="cursor: pointer;"><p class="display-2">6</p><p style="font-size: large">month</p><p style="font-size: x-large">45 &#36;</p></div>
                                                <div class="col card mr-xl-5 mr-lg-5 mr-md-4 mr-sm-4 mr-3" onclick="window.location.href='choose/planC';" style="cursor: pointer;"><p class="display-2">1</p><p style="font-size: large">year</p><p style="font-size: x-large">100 &#36;</p></div>
                                            </div>
                                        </div>
                                    </div>

                                </div></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn m-auto" data-dismiss="modal">close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <hr>
                <label class="h4">payment method</label>
                <p><button class="btn">Add payment method</button></p>

        </div>


    </div>
</template>

<script>
export default {
    name: "user_settings",
    props:['user_name','profile_img','is0auth','user_email','route_update_info','route_update_password','errors_bag','days','plan'],
    data(){
        return{
            selected:"profile",
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            remaining_days:30-(this.days),

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
    .plan{
        display:none;
    }
}
</style>
