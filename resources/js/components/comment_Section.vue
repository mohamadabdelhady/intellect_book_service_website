<template>
    <div>
<make_review :user_id="this.user_id" :type="this.type" :id="this.id"></make_review>
        <hr>
<p class="h4 mt-4">What other readers think of the book.</p>

        <div class="mt-5">
            <p v-if="!comments_data.length" class="h5" style="margin-left:50px;">There is no reviews on this book, be the first one to review it.</p>
            <div class="comments" v-for="(comment,index) in comments_data">
                <div>
                    <img :src="comment.profile_img" class="userAvatar" v-if="comment.google_id!=null">
                    <img :src="'/images/users_profile_img/'+comment.profile_img" v-else class="userAvatar">
                    <a href="#"><span class="pl-1">{{comment.name}}</span></a>
                    <span style="float: right; color: #565c68;">{{ comment.updated_at | fromNow }}</span>
                </div>
                <p class="pt-2" style="padding-left: 60px;">{{comment.content}}</p>
                <hr>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    name: "comment_section",
    props: ['profile', 'is0auth', 'type', 'id', 'user_id'],
    data() {
        return {
            comments_data: [],
            page: 1,

        }
    },
    methods: {
        get_comments() {
            axios.get('load_all_comments/' + this.id + '/' + this.type + '?page=' + this.page).then(response => {
                $.each(response.data.data, (key, v) => {
                    this.comments_data.push(v);
                });
            })

        },


    },
    mounted() {
        this.get_comments();
        console.log(this.comments_data);
    },
    filters: {
        fromNow(date) {
            return moment(date).fromNow();
        }
    }
}

</script>

<style scoped>
.userAvatar{

    width: 40px;
    height: 40px;
    border-radius: 50%;
}

</style>
