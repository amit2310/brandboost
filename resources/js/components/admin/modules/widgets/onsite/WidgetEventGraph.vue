<template>
    <div>
        <div>
<!--            <apexchart  type="bar" :options="chartOptions" :series="series"></apexchart>-->
        </div>
        <div id="chartSubscriptions" style=" ">
            <apexchart type=bar height=220 width=250 :options="chartOptions" :series="series" />
        </div>
    </div>
</template>

<script>
    // Vue.component('apexchart', VueApexCharts)
    var colors2 = ['#008ffb'];
    export default {
        name: "WidgetEventGraph",
        data: function() {
            return {
                series: [{
                    name: "Desktops",
                    data: [4, 3, 4, 6, 3, 4, 7, 2, 3, /* 5, 3, 7, 4, 4, 4,3, 5, 7, 3, 5, 3, 7, 8, 4*/ ]
                }],
                chartOptions: {
                    chart: {
                        width:300,
                        height:'300px',
                        zoom: {
                            enabled: false
                        },

                        toolbar: {
                            show: false
                        }
                    },
                    colors: ['#008ffb'],
                    dataLabels: {
                        enabled: false
                    },
                    // dataLabels: {
                    //     style: {
                    //         colors: ['#008ffb', '#008ffb', '#9C27B0']
                    //     }
                    // },

                    grid: {
                        row: {
                            colors: ['#008ffb', '#008ffb', '#9C27B0']
                        },
                        column: {
                            colors: ['#008ffb', '#008ffb', '#9C27B0']
                        }
                    },
                    markers: {
                        colors: ['#008ffb', '#008ffb', '#9C27B0']
                    },
                    stroke: {
                        curve: 'stepline',
                        width: 1
                    },


                    grid: {
                        row: {
                            // colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.1
                        },
                        borderColor: '#eee',
                        strokeDashArray: 3
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                        labels: {
                            style: {
                                colors: ['#008ffb'],
                                fontSize: '14px',
                            fill: '#0f99b3'
                            },
                            show: false
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: ['#008ffb'],
                                fontSize: '16px'
                            }
                        }
                    },




                }
            }
        },
        methods:{
            getWidgetDetails: function () {
                //getData
                axios.get('/admin/widgets/statistics-details-stats-graph',{
                    params: {
                        // widgetID: this.$route.params.id,
                        // page: this.current_page,
                        // req:this.req,
                        widgetID: 1,
                        page: 1,
                        req:'all',
                    }
                })
                    .then(response => {
                        // console.log(response.data);
                        this.widget = response.data.oWidget;
                        this.allData = response.data.oStats;
                        console.log(this.allData);
                        this.loading =false;

                    });
            },
        }
    }
</script>

<style scoped>

</style>
