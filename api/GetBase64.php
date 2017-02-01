<?php

class GetBase64
{
    public $file;
    protected $httpResponseCode;

    public function __construct( $file )
    {
        $this->file = $file;
    }

    public function getResponse()
    {
        if (empty($this->file)){
            $this->httpResponseCode = 500;

            return json_encode(
                [
                    "status" => "Error",
                    "msg" => "Invalid File"
                ]
            );
        }
        $this->httpResponseCode = 200;

        return json_encode(
            [
                "status" => "Success",
                "msg" => base64_encode(file_get_contents($this->file))
            ]
        );

    }

    public function getResponseCode()
    {
        return http_response_code($this->httpResponseCode);
    }

}