<template>
<div>
    <div class="row m-auto">
        <span class="fa fa-star checked" v-if="this.rating>=1"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="this.rating>=2"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="this.rating>=3"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked -" v-if="this.rating>=4"></span>
        <span class="fa fa-star " v-else></span>
        <span class="fa fa-star checked " v-if="this.rating>=5"></span>
        <span class="fa fa-star " v-else></span>
        <span class="ml-2">{{this.rating}}/5</span>
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
</style>
