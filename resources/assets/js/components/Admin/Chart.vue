<template>
    <div >
    <canvas id=pieChart  width=200  height=100></canvas>
    <hr>
    </div>
</template>
<script>
    import {GetHeaders} from '../../config'
    export default{
        data(){
            return {
                count: 0
            }
        },
        created(){
        },
        methods: {
            Draw(){
                axios.get('api/statistics', {headers: GetHeaders()})
                    .then(respone => {
                        var AvailableCars=respone.data.success.Available;
                        var Unavailable=respone.data.success.Unavailable;
                        var ctxP = document.getElementById("pieChart").getContext('2d');
                        var myPieChart = new Chart(ctxP, {
                            type: 'pie',
                            data: {
                                labels: ["Available Cars " + AvailableCars, "Busy Cars " +Unavailable],
                                datasets: [
                                    {
                                        data: [AvailableCars,Unavailable],
                                        backgroundColor: ["#F7464A", "#46BFBD", "#4D5360"],
                                        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1"]
                                    }
                                ]

                            }
                        });
                        options: {
                            responsive: true
                        }
                    })

            },
        },
        mounted: function () {
            this.$nextTick(function () {
                // Code that will run only after the
                // entire view has been rendered
                this.Draw()
            })
        }
    }
</script>