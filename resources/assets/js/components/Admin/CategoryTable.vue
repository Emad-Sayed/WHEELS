<template>

    <div>
        <div id="option-div"  class="form-group" style="margin:0 auto; width:200px" >
            <label for="sel1">Search By Name:</label>
            <input   type="text" class="form-control"  placeholder="Category Name" v-model="searchField">
        </div>
        <div v-if="Spinner" style="margin:0 auto; width:70px">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>CategoryID</th>
                <th>Name</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="category in filteredCategory">
                <td>{{category.id}}</td>
                <td>{{category.categoryName}}</td>
                <td><button @click="deleteCategory(category.id)" class="btn btn-danger">DELETE</button></td>
                <td><button @click="updateCategory(category)" class="btn btn-primary">UPDATE</button></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {GetHeaders,isSet} from '../../config'
    export default {
        data(){
            return{
                categories:[], //the state
                searchField:'',
                Spinner:true
            }
        },
        created(){
            this.getCategories();
        },
        methods:{
            getCategories(){
                axios.get('api/categoriesTable',{headers:GetHeaders()})
                    .then(response=>{
                        this.categories=response.data.success;
                        this.cateoriesTemp=response.data.success;
                        this.Spinner=false
                    })
            },
            deleteCategory(cat_id){
                if(confirm("Are you sure you want to delete the category with it's cars?"))
                {
                    axios.delete('api/category/'+cat_id,{headers:GetHeaders()})
                        .then(response=>{
                            this.getCategories();
                        })
                        .catch(err=>{
                            console.log(err)
                        })
                }

            },
            updateCategory(cat){

            }
        },
        computed:{
            filteredCategory(){
                return this.categories.filter((categ)=>{
                    return categ.categoryName.match(this.searchField)
                })
            }
        }

    }
</script>