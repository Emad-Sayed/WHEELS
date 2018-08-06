<template>

    <div>
        <div id="option-div"  class="form-group" style="margin:0 auto; width:200px" >
            <label for="sel1">Search By Model:</label>
            <input  type="text" class="form-control"  placeholder="Car Model" v-model="searchField">
        </div>
        <div v-if="Spinner" style="margin:0 auto; width:70px">
        <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>CarID</th>
                <th>Category</th>
                <th>Model</th>
                <th>Color</th>
                <th>Price</th>
                <th>Seats</th>
                <th>Delete</th>
                <th>Update</th>
                <th>State</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="car in filteredCars">
                <td>{{car.id}}</td>
                <td>{{car.category_id}}</td>
                <td>{{car.model}}</td>
                <td>{{car.color}}</td>
                <td>{{car.price}}</td>
                <td>{{car.numberOfSeats}}</td>
                <td><button @click="deleteCar(car.id)" class="btn btn-danger">Delete</button></td>
                <td><button @click="updateCar(car)" class="btn btn-primary">Update</button></td>
                <td v-if="car.state==0" ><button @click="setUnavailable(car)" class="btn btn-success" style="width: 100px">Available</button></td>
                <td v-if="car.state==1" ><button @click="setAvailable(car)" class="btn btn-danger">Unavailable</button></td>
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
                cars:[],//main state
                searchField:'',
                Spinner:true
            }
        },
        created(){
            this.getCars();
        },
        methods:{
            getCars(){
                axios.get('api/Allcars',{headers:GetHeaders()})
                    .then(response=>{
                        this.cars=response.data.success;
                        this.Spinner=false;
                    })
            },
            deleteCar(car_id){
                if(confirm("are you sure you want to delete the car?"))
                {
                    axios.delete('api/car/'+car_id,{headers:GetHeaders()})
                        .then(response=>{
                            this.getCars()
                        })
                        .catch(err=>{
                            console.log(err);
                        })
                }

            },
            updateCar(car){
                this.$router.push({
                    name:'AddCar',
                    params:{ car:car}
                });
            },
            setAvailable(car){
                if(confirm('are you sure you want to set the car to available ?')){
                    let formData=new FormData();
                    formData.append('car_id',car.id);
                    axios.post('api/setAvailable',formData,{headers:GetHeaders()})
                            .then(response=>{
                            this.getCars();
                        })
                }
            },
            setUnavailable(car){
                if(confirm('are you sure you want to set the car to unavailable ?')){
                    let formData=new FormData();
                    formData.append('car_id',car.id);
                    axios.post('api/setUnavailable',formData,{headers:GetHeaders()})
                        .then(response=>{
                            this.getCars();
                        })
                }
            }
        },
        computed:{
            filteredCars(){
             return this.cars.filter((car)=>{
                 return car.model.match(this.searchField)
             })
            }
        }
    }
</script>