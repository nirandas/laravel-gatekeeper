<?php 

namespace Nirandas\LaravelGatekeeper;

class Verifier {
    public static function rule($error='Gatekeeper verification failed.'){
    return function($attr,$value,$fail)use($error){
        if(!static::verify(env('GATEKEEPER_CLIENT_ID'), env('GATEKEEPER_CLIENT_SECRET'), $value)){
                        $fail($error);
        }
            };
    }
    public static function verify($client_id,$client_secret,$gatekeeper_session_key){
            $url='https://gatekeeper.webforms.online/api/v1/verify';
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL,$url); 
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type'=>'application/x-www-form-urlencoded']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'client_id=' . rawurlencode($client_id) . '&secret=' . rawurlencode($client_secret) . '&session_token=' . rawurlencode($gatekeeper_session_key));
    $data=curl_exec($ch);
                if(!$data) return false;
    $data=json_decode($data);
    return isset($data->verified)? true: false;
}
}
