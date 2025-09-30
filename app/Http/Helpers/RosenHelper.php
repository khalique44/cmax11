<?php
namespace App\Http\Helpers;
use App\GlobalSetting;
use Carbon\Carbon;

class RosenHelper
{
	public static function setOption($optionKey,$optionValue){

		
		$record = GlobalSetting::where("option_key",$optionKey)->first();
        if(!$record){
           $object = GlobalSetting::create(["option_key" => $optionKey, 'option_value' => $optionValue]);
        }else{
           $object = GlobalSetting::where("option_key" , $optionKey)->update(['option_value' => $optionValue]);
        }

		return  $object->id ?? false;
	}

	public static function getOption($optionKey, $defaultValue = ''){

		$result = GlobalSetting::where("option_key",$optionKey)->first();

		return  $result->option_value ?? $defaultValue;
	}

	public static function deleteOption($optionKey){

		$record = GlobalSetting::where("option_key",$optionKey)->first();
        if(!$record){
            return abort(404);
        }
        return GlobalSetting::where("option_key",$optionKey)->delete();
	}

	public static function getDaysArray($date = ''){

        $today = !empty($date) ? $date : Carbon::now(); 
        $currentDay = $today->day;       
        $currentMonth = $today->month;       

        $lastDayofMonth = $today->endOfMonth();
        $lastDay = $lastDayofMonth->day;

        $days = [];

        for ($i=$currentDay; $i <= $lastDay; $i++){ 
            $days[] = $i;
        }

        return  $days;
    }

    public static function getMonthsArray(){

    	$today = Carbon::now(); 
        $currentDay = $today->day;       
        $currentMonth = $today->month;

    	 $months = ['January','Fabruary','March','April','May','June','July','August','September','October','November','December'];
    	 $monthsArray = [];
    	 foreach ($months as $key => $value) {
    	 	$counter = $key+1;
    	 	if($counter >= $currentMonth){
    	 		$monthsArray[$counter] = $value;
    	 	}
    	 	
    	 }

    	 return $monthsArray;
    }


    public static function getTimeSlots(){

    	$timeSlots = [];
    	$totalDays = 23;
    	for ($i=0; $i <= $totalDays; $i++) {

    		$timeSlots[$i] = str_pad($i, 2, '0', STR_PAD_LEFT).':00'; 
    		
    	}

    	return $timeSlots;

    }

    public static function timeSlotFormat($timeSlot){
    			$extraZero = str_contains($timeSlot,':00') ? '' : ':00';
    	return str_pad($timeSlot, 2, '0', STR_PAD_LEFT).$extraZero;
    }


    public static function getAvailableDatesFromTimeSLots($availabeTimeSLots){

    	$availableDates = [];
    	if(!empty($availabeTimeSLots)){
            foreach ($availabeTimeSLots as $key => $value) {
                $month = $value->month;
                $availableDates[] = str_pad($value->day, 2, '0', STR_PAD_LEFT).'/'.str_pad($month, 2, '0', STR_PAD_LEFT).'/'.$value->year;
            }
           
        }       

        return array_unique($availableDates);
    }

    public static function isSlotAlreadyBooked($bookedSlots,$timeFrom,$timeTo){

    	if(!empty($bookedSlots)){
    		foreach ($bookedSlots as $key => $record) {
    			
    			$timeFrom = RosenHelper::timeSlotFormat($timeFrom);
    			$timeTo = RosenHelper::timeSlotFormat($timeTo);
    			
    			if($record->booking_time == "$timeFrom till $timeTo"){
    				
    				return true;
    			}
    		}
    	}

    	return false;
    }


    public static function getAvailableTimeSlots(){

        $timeFrom = RosenHelper::getOption('laundry_available_time_from');
        $timeTo = RosenHelper::getOption('laundry_available_time_to');
    }


    /*public static function timeTo24($time){

        if(str_contains($time,'AM'){

            $time = explode(':', $time);
            $hour = (int)$time[0];
            if($hour < 12){
                $hour = $hour + 12;
            }else{
                $hour = 0;
            }
            

        }

    }*/
}