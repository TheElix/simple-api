<?php

class SayHello
{
    public $name;
    protected $nameLength;
    protected $httpResponseCode;
    protected static $msg = 'Hello';
    protected static $errorNumber;

    public function __construct( $string )
    {
        $this->name = $string;
        $this->nameLength = strlen($this->name);
    }

    public function getResponse()
    {
        if( (self::isDifferentLetters( $this->name, $this->nameLength)) &&
            ($this->nameLength <= 2) ){

            $this->httpResponseCode = 500;

            return self::getInformation( 4 );

        }elseif( (self::isDifferentLetters( $this->name, $this->nameLength)) &&
            ($this->nameLength >= 15) ){

            $this->httpResponseCode = 500;

            return self::getInformation( 5 );

        }elseif( $this->nameLength <= 2 ) {

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

            case 4:
                return json_encode(
                    [
                        "status" => "Error",
                        "msg" => "Name is too short, Please enter valid name"
                    ]
                );

            case 5:
                return json_encode(
                    [
                        "status" => "Error",
                        "msg" => "Name is too long, Please enter valid name"
                    ]
                );

            default:
                return json_encode(
                    [
                        "status" => "Success",
                        "msg" => self::$msg . " " . $name
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