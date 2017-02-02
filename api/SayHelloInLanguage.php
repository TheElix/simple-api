<?php

class SayHelloInLanguage extends SayHello
{
    public $language;
    private static $apiKey = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
    public function __construct($string,$lang)
    {
        parent::__construct($string);
        $this->language = $lang;
        $this->getTranslated();
    }

    public function getTranslated()
    {
        $googleQuery = "https://www.googleapis.com/language/translate/v2?q=". urlencode(self::$msg) ."&target=".
                        urlencode($this->language) ."&key=" . urlencode(self::$apiKey);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $googleQuery,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        if( curl_exec($curl) === false ){
            $this->httpResponseCode = 500;
        }

        $response = curl_exec($curl);

        $response = json_decode($response);
        self::$msg = $response->data->translations[0]->translatedText;

        curl_close($curl);

        $this->httpResponseCode = 200;
    }

}