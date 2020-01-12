<?php

include_once '../../../api/common/response/response.php';
//include_once '../../config/database.php';

date_default_timezone_set('Asia/Bangkok');

$year = (date("Y") + 543);
$md = date("md");
$f_md = substr($year, 2).$md;
$time = date("Y-m-d H:i:s");

//$database = new Database();
//$conn = $database->getConnection();
$response = new Response();
$data = $response->getResponse();