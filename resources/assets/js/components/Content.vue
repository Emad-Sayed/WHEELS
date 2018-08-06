<template>
    <div>
        <div class="container" style="margin: 0 auto;width:350px ">
        <nav   aria-label="Page navigation example">
            <ul class="pagination">
                <li @click="getCars(pagination.prev_page_url)"v-bind:class="{'disabled':!pagination.prev_page_url}" class="page-item "><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">Page of {{pagination.current_page}} of {{this.pagination.last_page}}</a></li>
                <li @click="getCars(pagination.next_page_url)" v-bind:class="{'disabled':!pagination.next_page_url}" class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        </div>
        <div v-if="Spinner" style="margin:0 auto; width:40px">
            <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </div>
    <div class="row">
        <div v-for="car in cars"  class="col-xs-18 col-sm-4 col-md-3">
            <div class="productbox"><div class="imgthumb img-responsive">
            <img v-bind:src="car_url+car.image"></div>
                <div class="caption"><h5>{{car.model}} AND {{car.color}}</h5><s class="text-muted">{{car.price+40}} </s><b class="finalprice">{{car.price}}  </b>
                    <b>Number of Seats {{car.numberOfSeats}}</b><a href="#" class="btn btn-default btn-xs pull-right" role="button">
                        <i class="glyphicon glyphicon-zoom-in"></i></a>
                    <p><button @click="getDetails(car.id,car.state,car.image)" class="btn btn-success btn-md btn-block" >Get Details</button></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
    import {GetHeaders,isSet} from '../config'
    export default{
        data(){
            return{
                cars:[],
                pagination:{},
                car_url:'Images/Cars/',
                Spinner:true
            }
            },
        created(){
            this.getCars()
        },
        methods:{
            getCars(dataURL){
                this.Spinner=true
                dataURL=dataURL||'api/cars'
                axios.get(dataURL)
                    .then(response=>{
                        this.cars=response.data.success.data;
                        this.pageInfo(response.data.success);
                        this.Spinner=false
                    })
                    .catch(err=>{
                        console.log(err)
                    })
            },
            pageInfo(paging_info){
                let pagination={
                    current_page:paging_info.current_page,
                    last_page:paging_info.last_page,
                    next_page_url:paging_info.next_page_url,
                    prev_page_url:paging_info.prev_page_url
                }
                this.pagination=pagination;
            },
            getDetails(car_id,car_state,car_image){
                this.$router.push({
                    name:'detailsName',
                    params:{ id : car_id,state:car_state,image:car_image}
                });
            }
        }
    }
</script>