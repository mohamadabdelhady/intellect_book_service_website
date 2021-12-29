<template>
<div class="review p-2">
        <p class="h3">What did you think of this book</p>
    <span class="mt-2" style="padding-left: 60px;">
        <a href="#" class='' id="star_1" @mouseover="fill_star(1)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(1)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_2" @mouseover="fill_star(2)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(2)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_3" @mouseover="fill_star(3)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(3)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_4" @mouseover="fill_star(4)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(4)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_5" @mouseover="fill_star(5)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(5)"><i class="fa fa-star fa-3x"></i></a>
        <span class="ml-2">{{this.my_rating}}/5</span>
        <span v-if="my_rating!=''" class="ml-2"><a href="#" v-on:click.prevent="clear_rating">Clear rating</a></span>
    </span>
    <div class="mt-3">
        <textarea row="10" placeholder=" Write a review (optional)." class="comment_in" v-model="user_review" @keyup.enter="add_review"></textarea>
        <button class="btn" style="height: 40px;" :disabled="user_review==''" v-on:click="add_review">Post</button>
    </div>
</div>
</template>

<script>
export default {
    name: "make_review",
    props:['user_id','type','id'],
    data() {
        return {
            my_rating: "",
            my_review: "",
            user_review: "",
        }
    },
    methods: {
        fill_star(num)
        {
            for (let i=1;i<=num;i++)
            {
                document.getElementById('star_'+i).style.color='goldenrod';
            }
        },
        empty_star()
        {

            let current_rate=this.my_rating;
            for (let i=5;i>current_rate;i--)
            {
                document.getElementById('star_'+i).style.color='#212529';
            }
        },
        set_rating(num)
        {
            this.my_rating=num;
        },
        add_review() {

            axios.post('post_review', {
                review: this.user_review,
                rating:this.my_rating,
                id: this.id,
                type: this.type,
                user: this.user_id,
            })
            this.user_review = "";
        },
        clear_rating()
        {
            this.my_rating="";
            this.empty_star();
        }
    },
    mounted() {

    }
}
</script>

<style scoped>
.comment_in{
    min-height: 100px;
    width: 100%;
    outline: none;
    border: none;
    background-color: white;
    border: 1px solid #f5eee2;
}
.comment_in:focus
{
    border: 1px solid #565c68;
}
.review{
    background-color: #e1cfa9;
    border-radius: 1%;
}
</style>
