<template>
<div>
    <div class="row m-auto">
        <span class="fa fa-star checked" v-if="rating>=1"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="rating>=2"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="rating>=3"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked -" v-if="rating>=4"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="rating>=5"></span>
        <span class="fa fa-star " v-else></span>
        <span class="ml-2 rate">{{rating}}/5</span>
    </div>

</div>
</template>

<script>
export default {
    name: "generate_stars",
    props:['rating'],
    data()
    {
    return{
        size:0,
    }
    },
mounted(){

}
}

</script>

<style scoped>
.checked {
    color: goldenrod;
}
@media screen and (max-width: 576px) {
    .fa-star {
        font-size: .6rem;
    }

    .rate {
        font-size: .6rem;
    }
}
</style>
