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
    echo "<br>update counter of this month<br>";

    $db->query("UPDATE profile  SET total_monthly_visits = total_monthly_visits + 1  WHERE id = '". $userID ."'");
}


$first_day_of_week = new DateTime('first day of this week');

$last_day_of_week = new DateTime('last day of this week');


/*---------------------------------------------------------------------------------------------------
-* Update the Week counter
-* Because the date of today is between the last date and start dat of current Week
-*
-*--------------------------------------------------------------------------------------------------*/

if($today->format('Y-m-d H:i:s') < $last_day_of_week->format('Y-m-d H:i:s') && $today->format('Y-m-d H:i:s') > $first_day_of_week->format('Y-m-d H:i:s')){
    echo "<br>update counter of this Week<br>";

    $db->query("UPDATE profile  SET total_weekly_visits = total_weekly_visits + 1  WHERE id = '". $userID ."'");

}


/*echo $today->format('Y-m-d');
*/

if(!empty($row[0]['todays_visits']) && $row[0]['todays_visits'] ! = NULL){
    $today_array_from_db = $row[0]['todays_visits'];    
}else{
    $today_array_from_db = array($today->format('Y-m-d')=>1);
}

$json_today_array_from_db = json_encode($today_array_from_db);

/*print_r($json_today_array_from_db);*/

$array_today_array_from_db = json_decode($json_today_array_from_db,true);



if(array_key_exists($today->format('Y-m-d'),$array_today_array_from_db)){

    /*echo "yes it does exists";*/
    $old_val = $array_today_array_from_db[$today->format('Y-m-d')];

    $new_val = $old_val+1;
    $array_today_array_from_db[$today->format('Y-m-d')] = $new_val;

    $json_updated = json_decode($array_today_array_from_db);

    $db->query("UPDATE profile  SET todays_visits = '".$json_updated."'  WHERE id = '". $userID ."'");

}else{


    $array_today_array_from_db[$today->format('Y-m-d')] = 1 ;
    $json_updated = json_decode($array_today_array_from_db);
    
    $db->query("UPDATE profile  SET todays_visits = '".$json_updated."'  WHERE id = '". $userID ."'");

}

