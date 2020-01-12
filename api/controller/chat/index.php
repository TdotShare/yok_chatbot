<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

include_once '../../common/command/setup.php';


$data = $response->getResponse();
//$conn = $database->getConnection(); 


include_once './config.php';

$read_message = true;
$stemp_message = []; //เก็บ ออปเจคคำตอบบอท { ข้อความที่ดัก , คำตอบ }
$stemp_data = []; //ตัวแปรเก็บ ฟอเมตคำตอบ

if (isset($data->message)) {
    for ($i = 0; $i < count($bot_message); $i++) {

        if ($read_message) {
            if ($bot_message[$i]['trap'] == $data->message) {
                $read_message = false; // false เมื่อเจอข้อความที่ดัก เพื่อไม่ให้วนเข้ามาเช็คอีก
                $stemp_message = $bot_message[$i];
            }
        }
    }

    if(!$read_message){
        //เมื่อเจอข้อความที่ดักไว้
        $stemp_data = [
            "user" => [
                "time" => $time ,
                "message" => $data->message ,
                "doc" => "ข้อความที่ User ส่งมา"
            ],
            "bot" =>[
                "time" => $time ,
                "message" => $stemp_message,
                "doc" => "ข้อความที่ Bot ส่งมา"
            ]
        ];

    }else{
        //เมื่อไม่เจอข้อความที่ดักไว้
        $stemp_data = [
            "user" => [
                "time" => $time ,
                "message" => $data->message ,
                "doc" => "ข้อความที่ User ส่งมา"
            ],
            "bot" =>[
                "time" => $time ,
                "message" => $bot_error,
                "doc" => "ข้อความที่ Bot ส่งมา"
            ]
        ];
    }
    
}else{

    //เมื่อ user ไม่ได้ส่งข้อความมา = null หรือ เข้ามาครั้งแรก
    $stemp_data = [
        "user" => [
            "time" => $time ,
            "message" => isset($data->message),
            "doc" => "ข้อความที่ User ส่งมา"
        ],
        "bot" =>[
            "time" => $time ,
            "message" => $bot_start . "( ข้อความเริ่มต้น )",
            "doc" => "ข้อความที่ Bot ส่งมา"
        ]
    ];
}

echo json_encode(array("result" =>  $stemp_data ));

