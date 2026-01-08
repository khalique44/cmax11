<?php
namespace App\Http\Helpers;
use Illuminate\Support\Collection;
use App\GlobalSetting;
use Carbon\Carbon;
use App\Country;

class GeneralHelper
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
    			
    			$timeFrom = GeneralHelper::timeSlotFormat($timeFrom);
    			$timeTo = GeneralHelper::timeSlotFormat($timeTo);
    			
    			if($record->booking_time == "$timeFrom till $timeTo"){
    				
    				return true;
    			}
    		}
    	}

    	return false;
    }


    public static function getAvailableTimeSlots(){

        $timeFrom = GeneralHelper::getOption('laundry_available_time_from');
        $timeTo = GeneralHelper::getOption('laundry_available_time_to');
    }



   
    public static function getCitiesByCountry($countryId)
    {
        $country = Country::with(['states.cities' => function ($query) {
            $query->orderBy('name', 'asc');
        }])->find($countryId);

        if (!$country) {
            return collect();
        }

        $cities = collect();
        foreach ($country->states as $state) {
            $cities = $cities->merge($state->cities);
        }

        return $cities->sortBy('name')->values(); // Ensure fully sorted
    }
    

    public static function getStatusLabel($status = 1,$color = 'success'){
        $label = $status;
        if(is_numeric($status)){

            $label = $status == 1 ? 'Active' : 'Deactive';
            $color = $status == 1 ? 'success' : 'danger';
        }

        return '<span class="badge bg-'.$color.'">'.$label.'</span>';
    }


    public static function getMediaWithPublicDir($url){
        return $url;
    }

    public static function detectNumberUnit($number)
    {
        $number = (int)$number; // ensure integer

        if ($number >= 10000000) {
            return ['amount' => GeneralHelper::cleanDecimal(number_format($number / 10000000, 2)) , 'unit' => 'Crore'];
        } elseif ($number >= 100000) {
            return ['amount' => GeneralHelper::cleanDecimal(number_format($number / 100000, 2)) , 'unit' => 'Lakh'];
            
        } elseif ($number >= 1000) {
            return ['amount' => GeneralHelper::cleanDecimal(number_format($number / 1000, 2)) , 'unit' => 'Thousand'];            
        } else {
            return ['amount' => number_format($number) , 'unit' => 'Hundered'];
        }
    }

    public static function cleanDecimal($value): string
    {
        // Convert to float just in case
        $value = floatval($value);

        // If value is a whole number like 5.00 → return 5 (no decimal)
        if (fmod($value, 1) === 0.0) {
            return (string) intval($value);
        }

        // Otherwise, return with 2 decimal points
        return number_format($value, 2, '.', '');
    }



    public static function formatCurrency($amount, $symbol = 'PKR') {
        return $symbol . ' ' . $amount;
    }

    public static function parsePriceString($price, $format){

        $format = strtolower(trim($format));        

        if ($format == 'crore') {
            return (float) $price * 10000000;
        }

        if ($format == 'lakh') {
            return (float) $price * 100000;
        }

        return  $price; // fallback for raw numbers
    }

    public static function formatPriceRange(Collection $offers): array
    {
        if ($offers->isEmpty()) {
            return ['min' => null, 'max' => null];
        }

        $allValues = [];

        foreach ($offers as $offer) {
            if (!empty($offer->price_from)) {
                $allValues[] = GeneralHelper::parsePriceString($offer->price_from,$offer->price_from_in_format);
            }
            if (!empty($offer->price_to)) {
                $allValues[] = GeneralHelper::parsePriceString($offer->price_to, $offer->price_to_in_format);
            }
        }

        if (empty($allValues)) {
            return ['min' => null, 'max' => null];
        }

        $min = min($allValues);
        $max = max($allValues);

        return  [
            'min' => GeneralHelper::detectNumberUnit($min),
            'max' => GeneralHelper::detectNumberUnit($max),
        ];
    }

    public static function showSurveyFileds($project){

        if($project->rate_per_square || $project->development_charges || $project->utility_charges || $project->distance || $project->project_floors || $project->project_start_date ){
            return true;
        }

        return false;

    }

    public static function getYears($previous = 5, $forward = 1){
        $currentYear = now()->year;
		$years = range($currentYear - $previous, $currentYear + $forward);
        return $years;
    }

    public static function getMonths(){
        
        return $months = [
                    1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April',
                    5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August',
                    9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
                ];
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