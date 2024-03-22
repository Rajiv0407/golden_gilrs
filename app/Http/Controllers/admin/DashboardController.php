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
	 // echo "<pre>";print_r($booking);die;       
      echo view('admin/admin_dashboard',$data)->with('booking',$booking)->with('event',$event);  

    }

    public function bookingYearlyChart(){
          

    $response = array('yearly'=>[],'drilldownData'=>[]) ;
   echo json_encode($response) ;




    
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
