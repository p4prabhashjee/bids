<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function apiNotificationForApp($token, $title, $sound = null, $description = null,$rem_id = null,$type = null){
      
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
            $fcmNotification = [
                "to" => $token,
                "notification" => [
                    "title"      => $title,
                    "body"       => $description,
                    "type"       => $type,
                    "rem_id"       => $rem_id,
                    "sound"       => $sound,
                    "click_action" => "ACTION_CATEGORY",
                    "actions" => [
                          [
                              "action" => "snooz-button",
                              "title" => "Like",
                              "url" => "https://example.com",
                          ],
                          [
                              "action" => "dismiss-button",
                              "title" => "Read more",
                              "url" => "https://example.com",
                          ]
                        ],
                ],
                'data' => [
                    "title"      => $title,
                    "body"       => $description,
                    "type"       => $type,
                    "rem_id"       => $rem_id,
                    "sound"       => $sound,
                    "click_action" => "ACTION_CATEGORY",
                    "actions" => [
                          [
                              "action" => "snooz-button",
                              "title" => "Like",
                              "url" => "https://example.com",
                          ],
                          [
                              "action" => "dismiss-button",
                              "title" => "Read more",
                              "url" => "https://example.com",
                          ]
                        ],
                ]
            ];   
    
        $headers = [
            'Authorization:key=AAAASMOgIYA:APA91bHNPMstcnNONnLia37HAgt1CC2tIdDAV2X2amjwNi1NWyIu4T_wWepyz6uoA4In9ySGQgkF3XzJKAfH9StCLC4uP__J-s2EVxsXJDforAJfUoBFY_G_Ak1nho_qygmQHWx2h1CY',
            'Content-Type: application/json'
        ];
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        // print_r($result);
        // die();
        curl_close($ch);
        return true;
    }
}
