 <div class="dashbordWrapper">
                <div class="breadcrumbWrapper">
                    <nav aria-label="breadcrumb">
                        <h3 class="fs-5 m-0 fw-500">Dashboard </h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{URL::to('/')}}/administrator/dashboard#index">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
                <div class="dashboardBox">
                   <!-- <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                User Listed
                            </div>
                            <div class="card-body">
                                <p><span>Today</span><br><span><?php //echo $carToday ; ?></span></p>
                                <p><span>Monthly</span><br><span><?php //echo $carMonth ; ?></span></p>
                                <p><span>Yearly</span><br><span><?php //echo $carYear ; ?></span></p>
                            </div>
                        </div>
                    </div>  -->
                    <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Event Booking
                            </div>
                            <div class="card-body">
                                <p><span>Today</span><br><span><?php echo $event['event_day'] ; ?></span></p>
                                <p><span>Monthly</span><br><span><?php echo $event['event_month']; ?></span></p>
                                <p><span>Yearly</span><br><span><?php echo $event['event_year'] ; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Goodies Booking
                            </div>
                            <div class="card-body">
                                <p><span>Today</span><br><span><?php echo $booking['booking_day'] ; ?></span></p>
                                <p><span>Monthly</span><br><span><?php echo $booking['booking_month'] ; ?></span></p>
                                <p><span>Yearly</span><br><span><?php echo $booking['booking_year'] ; ?></span></p>
                            </div>
                        </div>
                    </div>
                    <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Customer Registration
                            </div>
                            <div class="card-body">
                                <p><span>Today</span><br><span><?php echo $day ; ?></span></p>
                                <p><span>Monthly</span><br><span><?php echo $month ; ?></span></p>
                                <p><span>Yearly</span><br><span><?php echo $year; ?></span></p>
								<p><span>Total</span><br><span><?php echo $total_count; ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashGraph">
                    <h3>Event Booking Sales History</h3>
                    <div style="float: right;">
                        
                        <select name="event_year" id="event_year" class="form-control" onchange="salesYearlyChart()"> 
                            <option value="2023">2023 </option>
                            <?php if(!empty($eventYear)){ 

                                foreach ($eventYear as $key => $value) {
                                ?> 
                            <option value="<?php echo $value->year ; ?>" <?php  if(date('Y')==$value->year){ ?> selected="selected" <?php } ?>><?php echo $value->year ; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                   <!--  <img src="{{URL::to('/public/admin')}}/images/topbar.png" alt=""> -->
                    <div id="salesYearly"></div>
                </div>

                <div class="dashGraph">
                    <h3>Goodies Booking Sales History</h3>
                    <div style="float: right;">
                        
                        <select name="goodies_year" id="goodies_year" class="form-control" onchange="salesGoodiesChart()"> 
                            <?php if(!empty($goodiesYear)){ 
                                foreach ($goodiesYear as $key => $value) {
                                ?> 
                            <option value="<?php echo $value->year ; ?>" <?php  if(date('Y')==$value->year){ ?> selected="selected" <?php } ?>><?php echo $value->year ; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                   <!--  <img src="{{URL::to('/public/admin')}}/images/topbar.png" alt=""> -->
                    <div id="goodiesYearly"></div>
                </div>
                <div class="dashboardBox">
                    <!-- <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Today
                            </div>
                            <div class="card-body">
                                <p><span>Total Booking</span><br><span><?php //echo $bookingToday ; ?></span></p>
                                <p><span>Amount</span><br><span><?php //echo $bookingTodayAmt ; ?></span></p>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Weekly
                            </div>
                            <div class="card-body">
                                <p><span>Total Booking</span><br><span><?php //echo $bookingWeekly ; ?></span></p>
                                <p><span>Amount</span><br><span><?php //echo $bookingWeeklyAmt ; ?></span></p>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="dashCard">
                        <div class="card">
                            <div class="card-header">
                                Monthly
                            </div>
                            <div class="card-body">
                                <p><span>Total Booking</span><br><span><?php //echo $bookingMonth ; ?></span></p>
                                <p><span>Amount</span><br><span><?php //echo $bookingMonthAmt ; ?></span></p>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!---- <div class="dashGraph">
                    <h3>Booking Sales History</h3>
                    <img src="{{URL::to('/public/admin')}}/images/topbar.png" alt="">
                </div> -->
            </div>

<script type="text/javascript">
    
    $(document).ready(function(){
       
        salesYearlyChart();       
        salesGoodiesChart();
    });


    function salesYearlyChart(){
         ajaxCsrf();
             var year=$('#event_year').val();
        $.ajax({
        type:"post",
        url:baseUrl+'/bookingYearlyChart',
        data:{'year':year},
        dataType:'json',
        beforeSend:function()
        {
            ajax_before();
        },
        success:function(html)
        {
            ajax_success() ;
            var seriesData = html.seriesData ;
            var drilldownData = html.drilldownData ;
           
            eventSalesChart(seriesData,drilldownData);      
        }
        });
    }

  function salesGoodiesChart(){
         ajaxCsrf();
         var year=$('#goodies_year').val();
        $.ajax({
        type:"post",
        url:baseUrl+'/bookingGoodiesChart',
        data:{'year':year},
        dataType:'json',
        beforeSend:function()
        {
            ajax_before();
        },
        success:function(html)
        {
            ajax_success() ;
            var seriesData = html.seriesData ;
            var drilldownData = html.drilldownData ;
            //console.log('drilldownData'+JSON.stringify(drilldownData));            
            goodiesYearly(seriesData,drilldownData);      
        }
        });
    }

function goodiesYearly(seriesData,drilldownData){

        Highcharts.chart('goodiesYearly', {
    chart: {
        type: 'column'
    },
       credits: {
    enabled: false
  },
    title: false,
    subtitle: false,
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: false


    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total bookings<br/>'
    },

    series: [
        {
            name: 'Goodies Bookings',
            colorByPoint: true,
            data: seriesData
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: drilldownData
    }
});

    
}
    function salesYearly(yearly,drilldownData){

        // Create the chart


  var chart = new   Highcharts.chart('salesYearly',
   {
        chart: {
            type: 'column'
        },

         title: {
        text: 'Booking Sales History'
    },
    subtitle: {
        text: ''
    }, credits: {
        enabled: false
      },exporting: { enabled: false },
        xAxis: {
            type: 'category'
        },yAxis: {
        title: {
          text: ''
        }

      },
        series: [{
            data: yearly,
            name:'Booking Sales Yearly'
        }],
        drilldown: {
            series: drilldownData
        }
    });
      
   /*   chart.series[1].name="Renamed";
chart.redraw();*/

    }

    function eventSalesChart(seriesData,drilldownData){

         Highcharts.chart('salesYearly', {
    chart: {
        type: 'column'
    },
     credits: {
    enabled: false
  },
    title: false,
    subtitle: false,
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: false


    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total booking<br/>'
    },

    series: [
        {
            showInLegend: false,
            name: 'Event Booking',
            colorByPoint: true,
            data: seriesData
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: drilldownData
    }
});
       

    }
</script>