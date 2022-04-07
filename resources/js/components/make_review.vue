<template>
    <div>
<div v-if="!my_review.length" class="review p-2" >
        <p class="txtb">What did you think of this book</p>
    <span class="mt-2 stars" style="padding-left: 60px;">
        <a href="#" class='' id="star_1" @mouseover="fill_star(1)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(1)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_2" @mouseover="fill_star(2)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(2)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_3" @mouseover="fill_star(3)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(3)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_4" @mouseover="fill_star(4)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(4)"><i class="fa fa-star fa-3x"></i></a>
        <a href="#" class='' id="star_5" @mouseover="fill_star(5)" @mouseleave="empty_star()" v-on:click.prevent="set_rating(5)"><i class="fa fa-star fa-3x"></i></a>
        <span class="ml-2 rate">{{my_rating}}/5</span>
        <span v-if="my_rating!=''" class="ml-2 rate"><a href="#" v-on:click.prevent="clear_rating">Clear rating</a></span>
    </span>
    <div class="mt-3">
        <textarea row="10" placeholder=" Write a review (optional)." class="comment_in" v-model="user_review" @keyup.enter="add_review"></textarea>
        <button v-if="edit_review==false" class="btn" style="height: 40px;" :disabled="user_review==''" v-on:click="add_review">Post</button>
        <div v-else>
        <button class="btn" style="height: 40px;" :disabled="user_review==''" v-on:click="update_review">Edit</button>
        <button class="btn ml-2 btn-cancel" style="height: 40px;" :disabled="user_review==''" v-on:click="cancel_edit">Cancel</button>
            </div>
        <p id="error_post" style="color: firebrick; display: none;">You have to pick a rating to post a review.</p>
    </div>

</div>
    <div v-else class="my_review p-2" v-for="(review,index) in my_review">
        <span class="txtb">Your review</span>
        <a href="#"><span class="pl-1">{{review.name}}</span></a>
        <span style="float: right;"><generate_stars :rating="review.rating"></generate_stars></span>
        <p class="pt-2 txts" style="padding-left: 60px;">{{review.review}}</p>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                ...
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('edit-btn').click();">Edit</a>
                <button type="button" class="btn btn-info btn-lg" v-on:click="edit_reviewF" style="display: none;" id="edit-btn"></button>
                <a class="dropdown-item" href="#" v-on:click.prevent="delete_review">Delete</a>

            </div>
        </div>
    </div>

    </div>
</template>

<script>
export default {
    name: "make_review",
    props: ['user_id', 'type', 'id','is_edit'],
    data() {
        return {
            my_rating: "",
            user_review: "",
            my_review: [],
            edit_review: false,
        }
    },
    methods: {
        fill_star(num) {
            console.log(num);
            for (let i = 1; i <= num; i++) {
               let targetDiv= document.getElementById('star_' + i).style.color = 'goldenrod';
                console.log(targetDiv);
            }
        },
        empty_star() {

            let current_rate = this.my_rating;
            for (let i = 5; i > current_rate; i--) {
                document.getElementById('star_' + i).style.color = '#212529';
            }
        },
        set_rating(num) {
            this.my_rating = num;
        },
        add_review() {
            if (this.my_rating != '') {
                document.getElementById('error_post').style.display = 'none';
                axios.post('post_review', {
                    review: this.user_review,
                    rating: this.my_rating,
                    id: this.id,
                    type: this.type,
                    user: this.user_id,
                })
                this.user_review = "";
                this.$emit('update_review');
            } else {
                document.getElementById('error_post').style.display = 'block';
            }
        },
        get_my_review() {
            axios.get('get_my_review/' + this.id + '/' + this.type).then(response => {
                if (response.data != "") {
                    this.my_review.push(response.data);

                } else {
                    this.my_review = [];
                }
            });
        },
        clear_rating() {
            this.my_rating = "";
            this.empty_star();
        },
        edit_reviewF() {
            this.user_review = this.my_review[0].review;
            this.my_rating = this.my_review[0].rating;
            this.my_review = [];
            this.edit_review = true;

        },
        update_review()
        {
            if (this.my_rating != '') {
                document.getElementById('error_post').style.display = 'none';
                axios.post('edit_review', {
                    review: this.user_review,
                    rating: this.my_rating,
                    user: this.user_id,
                })
                this.user_review = "";
                this.$emit('update_review');
            } else {
                document.getElementById('error_post').style.display = 'block';
            }
        },
        delete_review()
        {
            axios.get('delete_review/'+this.id+'/'+this.type).then(response => {
                this.$emit('update_review');
            });
        },
        cancel_edit()
        {
            this.$emit('update_review');
        }
    },
    mounted() {
        this.get_my_review();
    },
    updated() {
        this.fill_star(this.my_rating)
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
.my_review{
    background-color: #e1cfa9;
    border-radius: 1%;
}
    .fa-star {
        font-size: 4vw;
    }

    .rate {
        font-size: 2vw;

}

</style>
