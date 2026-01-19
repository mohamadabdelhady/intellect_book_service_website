<template>
    <div>
<make_review :user_id="this.user_id" :id="this.id"  @update_review="updateR" :key="made_review"></make_review>

        <hr>
<p class="txtb mt-4">What other readers think of the book.</p>

        <div class="mt-5">
            <p v-if="!review_data.length" class="txts" style="margin-left:50px;">There is no reviews on this book, be the first one to review it.</p>
            <div class="comments" v-for="(review,index) in review_data">
                <div>
                    <img :src="review.user.profile_img" class="userAvatar" v-if="review.google_id!=null">
                    <img :src="'/images/users_profile_img/'+review.profile_img" v-else class="userAvatar">
                    <span class="pl-1">{{review.name}}</span>
                    <span style="float: right;"><generate_stars :rating="review.rating"></generate_stars></span>
                </div>
                <p class="pt-2" style="padding-left: 60px;">{{review.review}}</p>
                <hr>
            </div>
        </div>

    </div>

</template>

<script>
// import moment from 'moment';
import { route } from 'ziggy-js';

export default {
    name: "reviews_section",
    props: ['id', 'user_id'],
    data() {
        return {
            review_data: [],
            page: 1,
            made_review:1,
            edit_review:false,
        }
    },

    methods: {
        get_reviews() {
            axios.get(route('get-all-reviews', {id: this.id, page: this.page})).then(response => {
                $.each(response.data[0].data, (key, v) => {
                    console.log(v);
                    this.review_data.push(v);
                });
            })

        },

        updateR()
        {
            this.made_review++;

        },
    },
    mounted() {
        this.get_reviews();


    },
    // filters: {
    //     fromNow(date) {
    //         return moment(date).fromNow();
    //     }
    // }
}

</script>

<style scoped>
.userAvatar{

    width: 40px;
    height: 40px;
    border-radius: 50%;
}

</style>
