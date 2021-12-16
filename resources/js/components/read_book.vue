<template>



</template>

<script>

export default {
    name: "read_book",
    props:['file_name'],
    data()
    {
        return{
            file_path:"books/epub_files/"+this.file_name+".epub",

        }
    },
    methods:{
        load_book()
        {

        }
    },
    mounted() {
        this.load_book();
        console.log();
    }
}
</script>

<style scoped>

</style>
