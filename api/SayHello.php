<?php

class SayHello
{
    public $name;
    protected $nameLength;
    protected $httpResponseCode;
    protected static $errorNumber;

    public function __construct( $string )
    {
        $this->name = $string;
        $this->nameLength = strlen($this->name);
    }

    public function getResponse()
    {
        if( $this->nameLength <= 2 ) {

            $this->httpResponseCode = 500;

            return self::getInformation( 1 );
        } elseif ( $this->nameLength >= 15 ) {
            $this->httpResponseCode = 500;

            return self::getInformation( 2 );
        } elseif ( self::isDifferentLetters( $this->name, $this->nameLength) ) {
            $this->httpResponseCode = 500;

            return self::getInformation( 3 );
        } else{
            $this->httpResponseCode = 200;

            return self::getInformation( 0, $this->name );
        }
    }

    public function getResponseCode()
    {
        return http_response_code($this->httpResponseCode);
    }

    static function getInformation( $errorNumber = 0, $name = null )
    {
        switch ( $errorNumber ){
            case 1:
                return json_encode(
                    [
                        "status" => "Error",
                        "msg" => "Name is too short"
                    ]
                );

            case 2:
                return json_encode(
                    [
                        "status" => "Error",
                        "msg" => "Name is too long"
                    ]
                );

            case 3:
                return json_encode(
                    [
                        "status" => "Error",
                        "msg" => "Name is invalid"
                    ]
                );

            default:
                return json_encode(
                    [
                        "status" => "Success",
                        "msg" => "Hello " . $name
                    ]
                );
        }
    }

    static function isDifferentLetters( $name, $length )
    {
        $prevLetter = '';
        for($i=0;$i<=$length;$i++){
            if($name[$i] === $prevLetter){
                return true;
            }
            $prevLetter = $name[$i];
        }

        return false;

    }

}