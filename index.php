<?php

$first_day_of_month = new DateTime('first day of this month');

$last_day_of_month = new DateTime('last day of this month');

$today = new DateTime('today');



/*---------------------------------------------------------------------------------------------------
-* Update the month counter
-* Because the date of today is between the last date and start dat of current month
-*
-*--------------------------------------------------------------------------------------------------*/
if($today->format('Y-m-d H:i:s') < $last_day_of_month->format('Y-m-d H:i:s') && $today->format('Y-m-d H:i:s') > $first_day_of_month->format('Y-m-d H:i:s')){
    
    /*---------------------------------------------
    *   update visitor counter of this month here           
    *   you can simply update the database column
    -----------------------------------------------*/
    

    
}


$first_day_of_week = new DateTime('first day of this week');

$last_day_of_week = new DateTime('last day of this week');


/*---------------------------------------------------------------------------------------------------
-* Update the Week counter
-* Because the date of today is between the last date and start dat of current Week
-*
-*--------------------------------------------------------------------------------------------------*/

if($today->format('Y-m-d H:i:s') < $last_day_of_week->format('Y-m-d H:i:s') && $today->format('Y-m-d H:i:s') > $first_day_of_week->format('Y-m-d H:i:s')){

    /*---------------------------------------------
    *   update visitor counter of this Week here          
    *   you can simply update the database column
    -----------------------------------------------*/
    


    

}




if(!empty($row[0]['todays_visits']) && $row[0]['todays_visits'] ! = NULL){
    $today_array_from_db = $row[0]['todays_visits'];    
}else{
    $today_array_from_db = array($today->format('Y-m-d')=>1);
}

$json_today_array_from_db = json_encode($today_array_from_db);



$array_today_array_from_db = json_decode($json_today_array_from_db,true);



if(array_key_exists($today->format('Y-m-d'),$array_today_array_from_db)){

    
    $old_val = $array_today_array_from_db[$today->format('Y-m-d')];

    $new_val = $old_val+1;
    $array_today_array_from_db[$today->format('Y-m-d')] = $new_val;

    $json_updated = json_decode($array_today_array_from_db);

    /*---------------------------------------------
    *   update visitor counter of today here          
    *   you can simply update the database column
    -----------------------------------------------*/

}else{


    $array_today_array_from_db[$today->format('Y-m-d')] = 1 ;
    $json_updated = json_decode($array_today_array_from_db);
    
    /*----------------------------------------------------------------
    *   update visitor counter of today here simply add 1 to database          
    *   you can simply update the database column
    ------------------------------------------------------------------*/

}

