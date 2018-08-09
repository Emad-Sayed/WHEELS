<template>
    <div class="row well" style=" margin: auto; width: 400px;">
        <div class="well"><i>The Start Date begins from the day that after rendering request</i>
        </div>
        <div class="input-group input-group-sm" style="width:200px"><span class="input-group-addon" id="sizing-addon3">
            <i class="glyphicon glyphicon-calendar"></i></span>
            <input v-model="carRequest.numberOfDays" class="form-control" placeholder="Number OF Days" type="number" aria-describedby="sizing-addon3">
        </div><button @click="Cash" class="btn btn-warning" style="margin-top:10px ">Cash For this Peroid</button>
        <button class="btn btn-warning" style="margin-top:10px;margin-left:10px  ">Paypal For this Peroid</button>
        <div v-bind:class="{ ' alert alert-danger':ErrorMessage}"  style="margin-top:10px;" class="">{{message}}</div>
    </div>
</template>

<script>
    import{GetHeaders,isSet}from '../config.js'
    export default{
        props: ['car_id','RF_Label'],
        data(){
            return {
                carRequest:{
                    numberOfDays:1,
                    car_id:this.car_id
                },
                message:'',
                ErrorMessage:false,
            }
        },
        created(){
        },
        methods:{
            Cash(){
                if(isSet())
                {
                    let formData =new FormData();
                    formData.append('car_id',this.carRequest.car_id);
                    formData.append('numberOfDays',this.carRequest.numberOfDays);
                    axios.post('api/carRequest',formData,{headers:GetHeaders()})
                        .then(respone=>{
                            this.changeRF_Label();
                        })
                        .catch(error=>{
                            this.ErrorMessage=true;
                            this.message='Your Balance not enough or invalid period!!'
                        })
                }
                else {
                    this.$router.push('/login')
                }

            },
            changeRF_Label(){
                this.$emit('changeLabel',this.carRequest.numberOfDays)
            }
        }
    }
</script>