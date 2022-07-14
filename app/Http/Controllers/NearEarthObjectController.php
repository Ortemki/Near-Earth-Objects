<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NearEarthObject;

class NearEarthObjectController extends Controller
{

    public function potentially_hazardous()
    {
        $asteroid = new NearEarthObject;
        return  $asteroid->where('is_hazardous','=',true)->get();
    }


    public function fastest_asteroids()
    {
        $asteroid = new NearEarthObject;
        return  $asteroid->orderBy('speed', 'DESC')->get();
    }

    public function add_new_asteroids()
    {
        $today = date("Y-m-d");
        $three_days_ago = date("Y-m-d",time()-(3*86400));
        $app_key = 'jyBVuHvb0O4rLyOnF7v9eCZ0YxF3PZByiGMKut2U';

        $nasa_url = 'https://api.nasa.gov/neo/rest/v1/feed';

        $option = [
            'start_date'=>$three_days_ago,
            'end_date'=>$today,
            'api_key'=>$app_key
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $nasa_url . "?" . http_build_query($option));
        $response = curl_exec($ch);

        $new_asteroids = json_decode($response, true);
        curl_close($ch);


        foreach ($new_asteroids['near_earth_objects'] as $date){
            foreach($date as $object){
                print_r($object);
                $asteroid = new NearEarthObject;
                $asteroid->referenced = $object['neo_reference_id'];
                $asteroid->name = $object['name'];
                $asteroid->speed = $object['close_approach_data'][0]['relative_velocity']['kilometers_per_hour'];
                if($object['is_potentially_hazardous_asteroid'] !== null){
                    $asteroid->is_hazardous = $object['is_potentially_hazardous_asteroid'];
                }
                $asteroid->date = $object['close_approach_data'][0]['close_approach_date'];
                $asteroid->save();
            }
        }
        return $new_asteroids;
    }
}
