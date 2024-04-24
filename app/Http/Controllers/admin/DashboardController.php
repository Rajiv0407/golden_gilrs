<?php

namespace App\Http\Controllers\admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB , session ;
use App\Models\User;
use App\Models\BookingRequest;
use App\Models\Event; 
use App\Models\Goodies;    

use Carbon\Carbon;  



class dashboardController extends Controller
{
    
     public function index(){

     	 $data['title']='Golden Girls' ;
         //return "Dashboard" ; exit ;
    	 return view('admin/dashboard',$data);

     }

   public function admin_dashboard(Request $request){

      $data['title']='Golden Girls' ;
      $booking=array();
      $event=array();
      /* car listing  */
	  $years_count=$items = User::select('*')->whereYear('created_at', date('Y'))->count(); 
      $month_count = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
	  $current_day=User::whereDate('created_at', Carbon::today())->count();
	  $total_count=User::count(); 
	  $data['year']=$years_count;
	  $data['month']=$month_count;
	  $data['day']=$current_day;
	  $data['total_count']=$total_count;
      
      $booking_years_count=$items = BookingRequest::select('*')->whereYear('created_at', date('Y'))->where('booking_type',1)->where('status',2)->count();
      $booking_month_count = BookingRequest::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('booking_type',1)->where('status',2)->count();
     $booking_current_day=BookingRequest::whereDate('created_at', Carbon::today())->where('booking_type',1)->where('status',2)->count();  

     $booking['booking_year']=$booking_years_count;
     $booking['booking_month']=$booking_month_count;
     $booking['booking_day']=$booking_current_day;

     $event_years_count=$items = BookingRequest::select('*')->whereYear('created_at', date('Y'))->where('booking_type',2)->where('status',2)->count();
      $event_month_count = BookingRequest::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->where('booking_type',2)->where('status',2)->count();
     $event_current_day=BookingRequest::whereDate('created_at', Carbon::today())->where('booking_type',2)->where('status',2)->count();  

     $event['event_year']=$event_years_count;
     $event['event_month']=$event_month_count;
     $event['event_day']=$event_current_day;

     $eventYear=DB::select("select Year(created_at) as year from booking_requests where booking_type=1 and status=2 group by Year(created_at)");

     $goodiesYear=DB::select("select Year(created_at) as year from booking_requests where booking_type=2 and status=2 group by Year(created_at)");

	 // echo "<pre>";print_r($booking);die;       
      echo view('admin/admin_dashboard',$data)->with('booking',$booking)->with('event',$event)->with('eventYear',$eventYear)->with('goodiesYear',$goodiesYear);  

    }

    public function bookingGoodiesChart(Request $request){  

    $year=isset($request->year)?$request->year:date("Y") ;
    $data=DB::select("select count(*) as totalBooking,MONTHNAME(created_at) as monthName,month(created_at) as monthNumber from booking_requests where booking_type=2 and status=2 and Year(created_at)=".$year." group by month(created_at)");
    $response=array();
        $dayData=array();
    if(!empty($data)){
       
        foreach ($data as $key => $value) {
            $dayWiseData=DB::select("select count(*) as totalBooking,DAY(created_at) as DAYNAME from booking_requests where booking_type=2 and status=2 and month(created_at)=".$value->monthNumber." group by day(created_at)");

            if(!empty($dayWiseData)){
                $dayWiseData1=array();
                foreach ($dayWiseData as $key => $value1) {
                    $dayWiseData1[]=array($value1->DAYNAME,$value1->totalBooking);
                }
            }

            $dayData[]=array("name"=>$value->monthName,"id"=>$value->monthName,"data"=>$dayWiseData1);

          $response[]=array("name"=>$value->monthName,"y"=>$value->totalBooking,"drilldown"=>$value->monthName);
        }

    }


    $resp=array('seriesData'=>$response,'drilldownData'=>$dayData) ;
    echo json_encode($resp); exit ;
 

    }

    public function bookingYearlyChart(Request $request){
     $year=isset($request->year)?$request->year:date("Y") ;
    $data=DB::select("select count(*) as totalBooking,MONTHNAME(created_at) as monthName,month(created_at) as monthNumber from booking_requests where booking_type=1 and status=2 and Year(created_at)=".$year." group by month(created_at)");
   
    if(!empty($data)){
        $response=array();
        $dayData=array();
        foreach ($data as $key => $value) {
            $dayWiseData=DB::select("select count(*) as totalBooking,DAY(created_at) as DAYNAME from booking_requests where booking_type=1 and status=2 and month(created_at)=".$value->monthNumber." group by day(created_at)");

            if(!empty($dayWiseData)){
                $dayWiseData1=array();
                foreach ($dayWiseData as $key => $value1) {
                    $dayWiseData1[]=array($value1->DAYNAME,$value1->totalBooking);
                }
            }

            $dayData[]=array("name"=>$value->monthName,"id"=>$value->monthName,"data"=>$dayWiseData1);

          $response[]=array("name"=>$value->monthName,"y"=>$value->totalBooking,"drilldown"=>$value->monthName);
        }

    }


    $resp=array('seriesData'=>$response,'drilldownData'=>$dayData) ;
    echo json_encode($resp); exit ;
    
    }

    public function monthwiseChart($year){
       
         // $bookingMonth = DB::select('select Month(createdOn) as monthS,Year(createdOn) as year_ , MonthName(createdOn) as monthName_, sum(amount) as amount from booking as b where Year(b.createdOn)="'.$year.'"   group by Month(b.createdOn)') ;
      DB::select("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
         $bookingMonth = DB::table('booking')
                 ->select( DB::raw('Month(createdOn) as monthS'), DB::raw('Year(createdOn) as year_'),DB::raw('MonthName(createdOn) as monthName_'),DB::raw('Round(sum(amount),2) as amount'))
                 ->whereRaw("Year(createdOn)='".$year."'")
                 ->groupBy(DB::raw('Month(createdOn)'))
                 ->get();

      if(!empty($bookingMonth)){
        $finalArray= [] ;
        $monthlySales = [] ;
        $DayWiseSales = [] ;
        foreach ($bookingMonth as $key => $value) {

            $month=$value->monthS ;
            $monthName_ = $value->monthName_ ;
            $year_ = $value->year_ ;
            $amount = $value->amount ;
            $monthDrillName =  $monthName_.$year_ ;
                $monthlySales[]=array("name"=>$monthName_ ,"y"=>$amount ,"drilldown"=>$monthDrillName);
           $finalArray[] = $this->dayWiseSalesChart($month,$monthDrillName,$year) ;       
           
        }
        
         $finalArray[]=array("name"=>$year ,"id"=>(int)$year,"data"=>$monthlySales) ;

    }
        return $finalArray ;
    }

    public function dayWiseSalesChart($month,$monthDrillName,$year){
        $dayWiseData = [] ;
        // $bookingDaywise = DB::select('select MonthName(createdOn) as monthN,Day(createdOn) as days, DayName(createdOn) as daySales, sum(amount) as amount from booking as b where Month(createdOn)='.$month.' and Year(createdOn)='.$year.' group by Day(createdOn)') ;
DB::select("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
            $bookingDaywise = DB::table('booking')
                 ->select( DB::raw('MonthName(createdOn) as monthN'), DB::raw('Day(createdOn) as days'),DB::raw('DayName(createdOn) as daySales'),DB::raw('Round(sum(amount),2) as amount'))
                 ->whereRaw("Month(createdOn)='".$month."'")
                 ->whereRaw("Year(createdOn)='".$year."'")
                 ->groupBy(DB::raw('Month(createdOn)'))
                 ->get();



        if(!empty($bookingDaywise)){               
        
            foreach ($bookingDaywise as $key => $val) {
                $DayWiseSales[]=array($val->days,$val->amount); 
             }

             $dayWiseData=array("name"=>$val->monthN , "id"=>$monthDrillName,"data"=>$DayWiseSales) ;
        }

        return $dayWiseData ;
    }
}
