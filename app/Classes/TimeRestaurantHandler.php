<?php
namespace App\Classes;

use Carbon\Carbon;
use Illuminate\Support\Str;
class TimeRestaurantHandler{

    public static function getDepartMinAndHourTurnToH_M(array $array)
    {   
        $carbon=Carbon::now();
        $count=0;
        $arrayOld= $array;
        $arrayNew=[];
        // dd($arrayOld);
        foreach ( $array as $key => $value) {
            if($key=="Start_h_$count"){
                $arrayNew["Start_$count"]=$value.':'.$array["Start_m_$count"] ;
                unset($arrayOld[$key],$arrayOld["Start_m_$count"]);
                
            
            }
            // echo'<pre>';
            // var_dump('kay=>'.$key.'value=>'.$value."count=>$count",$arrayNew);
            // echo'</pre>';
            
            if($key=="End_h_$count"){
                $arrayNew["End_$count"]=$value.':'.$array["End_m_$count"] ;
                unset($arrayOld[$key],$arrayOld["End_m_$count"]);
                $count++;
                
               
            }
        }
        return array_merge($arrayOld,$arrayNew);
    }



}