<template>
    <div class="container">

        <div class="row" style="background-color: #d2dae2"><div class="col-md-6" style="margin-top: 50px;">
            <img  v-bind:src="car_url+car.image" class="image-responsive">
        </div>
            <div class="col-md-6"><div class="row"><div class="col-md-12">
                <h1>{{car.category_name}}</h1>
            </div></div>
                <div class="row">
                <div class="col-md-12">
                    <span class="label label-primary">{{car.model}}</span>
                    <span class="monospaced"> WERCX</span></div>
                </div><div class="row"><div class="col-md-12">
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                    <div class="col-md-3"><span class="monospaced">{{car.numberOfSeats}}  Seats</span>
                    </div></div></div><div class="row"><div class="col-md-12 bottom-rule">
                    <h2 class="product-pric">LE {{car.price}}</h2>
                </div>
                </div>
                <div class="row add-to-cart">
                    <div class="col-md-4">
                        <button v-if="GetCar_Label" v-bind:class="{'disabled btn btn-danger':car_state==1}"
                                @click="renderingForm" class="btn btn-lg btn-brand btn-full-width btn-success" >{{message}}
                        </button>
                    </div>
                </div>
                <RF v-bind:RF_Label="RF_Label" v-bind:car_id="car_id"  v-if="RF_Label" v-on:changeLabel="update_RF_Label($event)"></RF>
                <div class="row well" id="Rendering_Form" style="display: none; margin-top: 15px; margin :auto; width: 400px"><div class="well">
                    <i>The Start Date begins from the day that after rendering request</i>
                </div>
                    <div class="input-group input-group-sm" style="width:200px"><span class="input-group-addon" id="sizing-addon3"><i class="glyphicon glyphicon-calendar"></i></span><input id="End_Date_Input" class="form-control" placeholder="Number OF Days" type="number" aria-describedby="sizing-addon3"></div><button class="btn btn-warnin<div class="row" style="margin-right:180px"><div class="col-md-4 text-center"><h3><span class="monospaced">In Stock</span></h3></div><div class="col-md-4 col-md-offset-1 text-center"><p>Street 103 ElThrer City Cairo</p></div></div><div class="row"><div class="col-md-12 top-10"><p>For Any help <a href=""> please call us on 01125346156</a></p></div></div><ul class="nav nav-tabs" role="tablist"><li role="presentation"><a href="#description" aria-controls="description" data-toggle="tab">Description</a></li><li role="presentation"><a href="#features" aria-controls="features" data-toggle="tab">Features</a></li><li role="presentation"><a href="#reviews" aria-controls="reviews" data-toggle="tab">Reviews</a></li></ul><div class="tab-content"><div id="description" class="tab-pane active" role="tabpanel"><p class="top-10">Lada Category Description</p></div><div id="features" class="tab-pane top-10" role="tabpanel"><p class="top-10">Amazing Speed </p></div><div id="reviews" class="tab-pane" role="tabpanel"><p class="top-10">Features The 'Brownie' Flash B is a box camera taking 2¼ × 3¼ frames on 620 film, made of sheet metal by Kodak Ltd. in England, 1958-60. A more luxurious version of the Brownie Six-20 Model F, it has a two-speed shutter (1/80, 1/40 +B), a close-focus (5-10ft) lens, a yellow filter and flash sync. The Flash B is very similar to the Brownie Flash IV, adding a two-speed shutter but lacking a tripod bush.</p></div></div></div></div>
        <hr>

    </div>
</template>

<script>
    import {isSet,GetHeaders} from '../config'
    import RentalForm from './RenderingForm.vue'
    export default{
        data(){
            return {
                car_id:'',
                car_state:'',
                car:{},
                RF_Label:false,
                GetCar_Label:true,
                message:'',
                car_url:'Images/Detailed/'
            }
        },
        components:{
            'RF':RentalForm
        },
        created(){
            if(this.$route.params.id) {//if route has a value (not refresh page)
                this.car_id = this.$route.params.id
                this.car_state = this.$route.params.state
                this.getCar()
            }
            else
                this.$router.push('/home'); // if made refresh will redirect to home page



        },
        methods:{
            getCar(){
                axios.get('api/car/'+this.car_id,{headers:GetHeaders()})
                    .then(respone=>{
                        this.car=respone.data.success
                        if(this.car.state==0){
                            this.message='GET CAR'
                        }
                        else{
                            this.message='UNAVAILABLE CAR'
                        }
                    })
                    .catch(err=>{
                        console.log(err)
                    })
            },
            renderingForm(){
                this.RF_Label=true;
                this.GetCar_Label=false;
            },
            update_RF_Label(updatedFlag){
                this.RF_Label=updatedFlag;
                this.car_state=1;
                this.GetCar_Label=true;
                this.message='You Have Got The Car';
            },
        }
    }
</script>