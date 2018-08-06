<template>
    <div class="container">
        <h1>{{message}}</h1>

        <form @submit.prevent="addCar">
            <div class="form-group" style="width:500px">
                <label>Category Name</label>
                <input v-model="category.categoryName" type="text" class="form-control"   placeholder="Enter Category Name">
            </div>
            <div class="form-group" style="width:500px">
                <label >Category Description</label>
                <textarea v-model="category.description" type="text" class="form-control" rows="10"  placeholder="Enter Category Description"></textarea>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>
<script>
    export default{
        data(){
            return {
                category:{
                    id:'',
                    categoryName:'',
                    description:''
                },
                message:'Add Category'
            }
        }
    }
</script>