<?php namespace App\Extensions;

class LaravelLocalization extends \Mcamara\LaravelLocalization\Facades\LaravelLocalization
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public static function getSupportedLocalesAssoc()
    {
        $array = []; 
        foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        {
            $array[$localeCode] = $properties['native'];
        }
        return $array;
    }
}