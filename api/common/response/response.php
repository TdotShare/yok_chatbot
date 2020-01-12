<?php
class Response
{
    public $response;
    public function getResponse()
    {
        $this->response = json_decode(file_get_contents('php://input'));
        return $this->response;
    }
}