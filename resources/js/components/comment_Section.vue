<template>
    <div>
<p class="h4">Comment section</p>
    <div class="mt-3">
        <img :src="profile" class="userAvatar" v-if="google_id!=''">
        <img :src="'/images/users_profile_img/'+profile" v-else>
        <input placeholder=" Add a comment" class="comment_in" v-model="user_comment" @keyup.enter="add_comment">
        <button class="btn" style="height: 40px;" :disabled="user_comment==''" v-on:click="add_comment">Post</button>
    </div>
        <div class="mt-5">
            <p v-if="!comments_data.length" class="h5" style="margin-left:50px;">There is no comments on this book, be the first one to comment.</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "comment_section",
    props:['profile','google_id','type','id','user_id'],
    data(){
        return{
            comments_data:[],
            user_comment:"",
            page:1,
        }
    },
    methods:{
        get_comments()
        {
            axios.get('load_all_comments/'+this.id+'/'+this.type+'?page='+this.page).then(response=> {
                $.each(response.data.data, (key, v) => {
                    this.comments_data.push(v);
                });
            })

        },
        add_comment()
        {

            axios.post('post_comment',{
                comment:this.user_comment,
                id:this.id,
                type:this.type,
                user:this.user_id,
        })
            this.user_comment="";
        }

    },
    mounted() {
        this.get_comments();
    }
}
</script>

<style scoped>
.userAvatar{

    width: 40px;
    height: 40px;
    border-radius: 50%;
}
.comment_in{
    width: 80%;
    margin-left: 10px;
    outline: none;
    border: none;
    height: 40px;
    background-color: white;
}
</style>
