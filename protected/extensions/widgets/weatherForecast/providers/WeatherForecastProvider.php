<?php
/* SVN FILE: $Id: WeatherForecastProvider.php 14 2009-10-13 13:43:06Z Chris $ */
/**
 * Weather Forecast Interface and Weather Forecast Objects
 *
 * @filesource
 * @copyright    Copyright 2009 PBM Web Development - All Rights Reserved
 * @package      weatherForecast
 * @subpackage   weatherForecast.providers
 * @version      $Revision: 14 $
 * @lastmodified $Date: 2009-10-13 14:43:06 +0100 (Tue, 13 Oct 2009) $
 * @license      http://www.opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * Weather Forecast Provider interface
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
interface IWeatherForecastProvider {
  public function getForecast($params, $symbols);
}

/**
 * Base class for Weather Forecast providers
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
abstract class WFBaseProvider implements IWeatherForecastProvider {
  /**
   * @var string Date format
   * @link http://www.yiiframework.com/doc/api/CDateFormatter
  */
  protected $dateFormat;
  /**
   * @var string Forecast location
   */
  protected $location;
  /**
   * @var string Path to symbol set to use
   */
  protected $symbolsDir;
  /**
   * @var array Units for display. C=metric, F=imperial
   */
  protected $units;

  protected function init($params, $symbols) {
    $params = array_merge($this->defaults, $params);

    foreach ($params as $param => $value) {
      $this->$param = $value;
    } // foreach

    $this->symbolsDir = $symbols[0];
    if (!empty($symbols[1])) $this->symbolMap = $symbols[1];
  }

  /**
   * Converts degrees Celcius degrees Farenheight to
   *
   * @param float $value The value to convert
   * @param mixed $precision Precision of the result
   * @return float The converted value
   */
  protected function c2f($value, $precision=0) {
    debugbreak();
    return round(((9/5)*$value)+32, $precision);
  }

  /**
   * Converts degrees Farenheight to degrees Celcius
   *
   * @param float $value The value to convert
   * @param mixed $precision Precision of the result
   * @return float The converted value
   */
  protected function f2c($value, $precision=0) {
    return round((5/9)*($value-32), $precision);
  }

  /**
   * Converts mph to kph
   *
   * @param float $value The value to convert
   * @param mixed $precision Precision of the result
   * @return float The converted value
   */
  protected function mph2kph($value, $precision=0) {
    return round($value * 1.609344, $precision);
  }
}

/**
 * Base class for Weather Forecast providers using XML feeds
 *
 * Reads XML data and provides an DOMXPath object for querying it
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
abstract class WFXMLProvider extends WFBaseProvider {
  /**
   * @var string DOMXPath Object
   */
  protected $xpath = null;
  /**
   * @var string XML response
   */
  private $xml;

  public function __get($name) {
    $getter='get'.$name;
    if (method_exists($this,$getter)) {
      return $this->$getter();
    }
    else {
      throw new CException(Yii::t('WeatherForecast','Property "{class}.{property}" is not defined.',
        array('{class}'=>get_class($this), '{property}'=>$name)));
    }
  }

  /**
   * Reads the URL and puts the content into $this->xml
   *
   * @param string $url
   * @throws CException if unable to read the URL
   */
  protected function read($url) {
    unset($this->xpath); // ensures the feed is recognised

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $this->xml = curl_exec($ch);
    curl_close($ch);
    //$this->xml = file_get_contents($url); // Use if PHP not compiled with cURL

    if (empty($this->xml)) {
      throw new CException(Yii::t('WeatherForecast','Unable to read url {url}.',
        array('{url}'=>$url)));
    }
  }

  /**
   * Creates a new XPath object from the XML
   */
  private function getXPath() {
    $doc = new DOMDocument;
    $doc->preserveWhiteSpace = false;
    $doc->loadXML(utf8_encode($this->xml));
    $this->xpath = new DOMXPath($doc);
    return $this->xpath;
  }
}

/**
 * Weather Forecast class
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class WFWeatherForecast extends WFBase {
  /**
   * @var string Name of the data provider
   */
  protected $provider;
  /**
   * @var string Date/time the forecast was issued
   */
  protected $issued;
  /**
   * @var WFWGS84Location Forecast location
   */
  protected $location;
  /**
   * @var CMap Days of the forecast
   */
  protected $days;

  /**
   * Weather forecast contructor
   */
  public function __construct() {
    $this->location = new WFWGS84Location();
    $this->days = new CMap();
  }
}

/**
 * Weather Forecast Day class
 *
 * Records the weather forecast for a given day
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class WFDay extends WFBase {
  /**
   * @var string Date for this day
   */
  protected $date;
  /**
   * @var string Forecast description
   */
  protected $description;
  /**
   * @var WFValue Humidity value
   */
  protected $humidity;
  /**
   * @var WFValue Maximum temperature value
   */
  protected $maxTemperature;
  /**
   * @var WFValue Minimum temperature value
   */
  protected $minTemperature;
  /**
   * @var WFValue Atmospheric pressure value
   */
  protected $pressure;
  /**
   * @var string Pressure trend
   */
  protected $pressureTrend;
  /**
   * @var string Time of sunrise
   */
  protected $sunrise;
  /**
   * @var string Time of sunset
   */
  protected $sunset;
  /**
   * @var string Path to the symbol representing the forecast
   */
  protected $symbol;
  /**
   * @var WFValue Current temperature value
   */
  protected $temperature;
  /**
   * @var WFValue Visibility value
   */
  protected $visibility;
  /**
   * @var WFValue Wind direction
   */
  protected $windDirection;
  /**
   * @var WFValue Wind speed value
   */
  protected $windSpeed;

  /**
   * Weather Forecast Day contructor
   */
  public function __construct() {
    $this->humidity       = new WFValue();
    $this->pressure       = new WFValue();
    $this->temperature    = new WFValue();
    $this->maxTemperature = new WFValue();
    $this->minTemperature = new WFValue();
    $this->visibility     = new WFValue();
    $this->windDirection  = new WFValue();
    $this->windSpeed      = new WFValue();
  }
}

/**
 * Weather Forecast Value class
 *
 * Holds a weather forecast value
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class WFValue extends WFBase {
  /**
   * @var mixed Value
   */
  protected $value;
  /**
   * @var string Units of the value
   */
  protected $units;
}

/**
 * Weather Forecast Location class
 *
 * Holds a location of a weather forecast
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class WFWGS84Location extends WFBase {
  /**
   * @var string Name of the location
   */
  protected $name;
  /**
   * @var float Latitude of the location
   */
  protected $lat;
  /**
   * @var float Longitude of the location
   */
  protected $long;
  /**
   * @var WFValue Altitude of the location
   */
  protected $alt;

  /**
   * Weather Forecast Location contructor
   */
  public function __construct() {
    $this->alt = new WFValue();
  }
}

/**
 * Weather Forecast base class
 *
 * Provides the magic functions
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
abstract class WFBase {
  public function __get($name) {
    if(property_exists($this,$name)) return $this->$name;
  }

  public function __set($name, $value) {
    if(property_exists($this,$name)) {
      $this->$name=$value;
      return true;
    }
    else {
      return false;
    }
  }

  public function __isset($name) {
    if(property_exists($this,$name) && isset($this->$name)) return true;
    else return false;
  }

  public function __unset($name) {
    if(property_exists($this,$name)) unset($this->$name);
  }
}
?>