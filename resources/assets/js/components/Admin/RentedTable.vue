<template>

    <div>
        <div id="option-div"  class="form-group" style="margin:0 auto; width:200px" >
            <label for="sel1">Search By End Date:</label>
            <input  type="text" class="form-control"  placeholder="End Date" v-model="searchField">
        </div>
        <div v-if="Spinner" style="margin:0 auto; width:70px">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>CarID</th>
                <th>UserID</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="rentedCar in filteredCars">
                <td>{{rentedCar.car_id}}</td>
                <td>{{rentedCar.user_id}}</td>
                <td>{{rentedCar.start_date}}</td>
                <td>{{rentedCar.end_date}}</td>

            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import {GetHeaders,isSet} from '../../config'
    export default {
        data(){
            return {
                rentedCars:[],
                searchField:'',
                Spinner:true
            }
        },
        created(){
            this.getRentedCars()
        },
        methods:{
            getRentedCars(){
                axios.get('api/rentedCars',{headers:GetHeaders()})
                    .then(response=>{
                        this.rentedCars=response.data.success;
                        this.Spinner=false;
                    })
            }
        },
        computed:{
            filteredCars(){
                return this.rentedCars.filter((rentedCar)=>{
                    return rentedCar.end_date.match(this.searchField)
                })
            }
        }
    }
</script>