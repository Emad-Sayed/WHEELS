<template>
    <div class="container">
        <h1>{{message}}</h1>

        <form @submit.prevent="addCar">
            <div class="form-group" style="width:500px">
                <label >Car Model</label>
                <input v-model="car.model" type="text" class="form-control"  aria-describedby="emailHelp" placeholder="Enter Car Model">
            </div>
            <div class="form-group" style="width:500px">
                <label>CarColor</label>
                <input v-model="car.color" type="text" class="form-control"  placeholder="Enter Car Color">
            </div>
            <div class="form-group" style="width:500px">
                <label>Car Price</label>
                <input v-model="car.price" type="number" class="form-control"  placeholder="Enter Car Price">
            </div>
            <div class="form-group" style="width:500px">
                <label>Car Number of Seats</label>
                <input v-model="car.numberOfSeats" type="number" class="form-control"  placeholder="Enter Car Number of Seats">
            </div>

            <div class="form-group " style="width:500px">
                <label for="sel1">Category list:</label>
                <select v-model="car.categoryID" class="form-control" id="sel1">
                        <option v-for="category in categories" v-bind:value="category.id">{{category.categoryName}}</option>
                </select>
            </div>
            <div class="form-group">
                <label >Car Image</label>
                <input v-on:change="HandleFileUpload()" type="file" name="file" ref="file" class="form-control-file">
            </div>

            <div class="form-group">
                <label >Car Details Image</label>
                <input v-on:change="HandleFileUpload2()" type="file" name="file2" ref="file2" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script>
    import {GetHeaders,isSet} from '../../config'
    export default{
        data(){
            return {
                car:{
                    id:'',
                    model:'',
                    color:'',
                    price:'',
                    numberOfSeats:'',
                    categoryID:'',
                    image:'',
                    details:''
                },
                categories:[],
                addCarFlag:true, //to know if the submition for adding or updating
                message:'Add Car'
            }
        },
        created(){
            this.getCategories()
            if( this.$route.params.car){
                this.car=this.$route.params.car
                this.addCarFlag=false
                this.message='Update Car'
            }
        },
        methods:{
            getCategories(){
                axios.get('api/categoriesTable',{headers:GetHeaders()})
                    .then(response=>{
                        this.categories=response.data.success
                    })
            },
            HandleFileUpload(){
                this.car.image = this.$refs.file.files[0]
            },
            HandleFileUpload2(){
                this.car.details = this.$refs.file2.files[0]
            },
            addCar()
            {
                let formData = new FormData()
                if(this.addCarFlag==false) // if need update pass the id
                    formData.append('id', this.car.id)
                formData.append('file', this.car.image)
                formData.append('file2', this.car.details)
                formData.append('color', this.car.color)
                formData.append('numberOfSeats', this.car.numberOfSeats)
                formData.append('price', this.car.price)
                formData.append('model', this.car.model)
                formData.append('category_id', this.car.categoryID)
                axios.post( 'api/car',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                    .then(response => {
                        console.log(response);
                    })
                    .catch(function(){
                        console.log('FAILURE!!');
                    });
            }
        }
    }
</script>