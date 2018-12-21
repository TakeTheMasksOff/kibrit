<?php
/* SVN FILE: $Id: YahooWeather.php 13 2009-10-13 13:36:59Z Chris $ */
/**
 * Yahoo! Weather data provider
 *
 * @link http://developer.yahoo.com/weather/ Yahoo Weather API documentation
 * @filesource
 * @copyright    Copyright 2009 PBM Web Development - All Rights Reserved
 * @package      weatherForecast
 * @subpackage   weatherForecast.providers
 * @version      $Revision: 13 $
 * @modifiedby   $LastChangedBy: Chris $
 * @lastmodified $Date: 2009-10-13 14:36:59 +0100 (Tue, 13 Oct 2009) $
 * @license      http://www.opensource.org/licenses/bsd-license.php The BSD License
 */

include 'WeatherForecastProvider.php';

/**
 * Yahoo! Weather data provider
 *
 * <p>Values in params:<br>
 * dateFormat (string) => Date format for days;
 * Used by {@link http://www.yiiframework.com/doc/api/CDateFormatter#format-detail CDateFormatter::format()},
 * see {@link http://www.unicode.org/reports/tr35/#Date_Format_Patterns Date Format Patterns}
 * for a description of formats. Default: "EEE d'&nbsp;'MMM yyyy"<br>
 * location (string) => Location.<br>
 * To find the location id follow the instructions on the Yahoo Developer Weather RSS page.<br>
 * units (string) => Units to provide the forecast in.
 * "C"|"F" C=metric (default), F=imperial</p>
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class YahooWeather extends WFXMLProvider {
  /**
   * @var string Driver description
   */
  private $provider = "Yahoo! Weather";
  /**
   * @var string Yahoo! Weather feed
   */
  private $feed = 'http://weather.yahooapis.com/forecastrss?p=%s&u=%s';
  /**
   * @var string Yahoo! Weather url
   */
  private $url = 'http://weather.yahoo.com/';
  /**
   * @var string Default values
   */
  protected $defaults = array(
    'location' => 'UKXX0085', //London
    'units' => 'C',
    'dateFormat' => 'EEE d MMM yyyy'
  );
  /**
   * @var array Maps weather codes to symbols
   */
  protected $symbolMap = array(
    0 => 'tornado.png',
    1 => 'storm.png',
    2 => 'hurricane.png',
    3 => 'thunderstorm_severe.png',
    4 => 'thunderstorm.png',
    5 => 'sleet.png',
    6 => 'sleet.png',
    7 => 'sleet.png',
    8 => 'drizzle.png',
    9 => 'drizzle.png',
    10 => 'rain.png',
    11 => 'showers.png',
    12 => 'showers.png',
    13 => 'snow.png',
    14 => 'snow_showers.png',
    15 => 'snow.png',
    16 => 'snow.png',
    17 => 'hail.png',
    18 => 'sleet.png',
    19 => 'dust.png',
    20 => 'fog.png',
    21 => 'haze.png',
    22 => 'smoke.png',
    23 => 'windy.png',
    24 => 'windy.png',
    25 => 'cold.png',
    26 => 'cloudy.png',
    27 => 'partly_cloudy_night.png',
    28 => 'partly_cloudy_day.png',
    29 => 'partly_cloudy_night.png',
    30 => 'partly_cloudy_day.png',
    31 => 'clear_night.png',
    32 => 'sunny.png',
    33 => 'clear_night.png',
    34 => 'partly_cloudy_day.png',
    35 => 'hail.png',
    36 => 'hot.png',
    37 => 'thunderstorm.png',
    38 => 'thunderstorm.png',
    39 => 'thunderstorm.png',
    40 => 'showers.png',
    41 => 'snow_heavy.png',
    42 => 'snow_showers.png',
    43 => 'snow_heavy.png',
    44 => 'partly_cloudy_day.png',
    45 => 'thunder_showers.png',
    46 => 'snow_showers.png',
    47 => 'thunder_showers.png',
  );

  /**
   * Fetches the forecast from the provider's datasource
   *
   * Required by IWeatherForecastProvider interface
   *
   * @return WFWeatherForecast Forecast object
   */
  public function getForecast($params, $symbols) {
    $this->init($params, $symbols);

    $forecast = new WFWeatherForecast();
    $dateFormatter = Yii::app()->dateFormatter;
    $this->read(vsprintf($this->feed,  array($this->location, strtolower($this->units))));

    $contextNode = $this->xpath->evaluate('/rss/channel')->item(0);

    $forecast->provider  = CHtml::link($this->provider, $this->url, array('rel'=>'external'));
    $forecast->issued    = $this->xpath->evaluate('string(lastBuildDate)', $contextNode);
    $distanceUnits       = $this->xpath->evaluate('string(yweather:units/@distance)', $contextNode);
    $humidityUnits       = '%';
    $pressureUnits       = $this->xpath->evaluate('string(yweather:units/@pressure)', $contextNode);
    $speedUnits          = $this->xpath->evaluate('string(yweather:units/@speed)', $contextNode);
    $temperatureUnits    = $this->xpath->evaluate('string(yweather:units/@temperature)', $contextNode);

    $forecast->location->name = $this->xpath->evaluate('string(yweather:location/@city)', $contextNode);
    $forecast->location->lat  = $this->xpath->evaluate('string(item/geo:lat)', $contextNode);
    $forecast->location->long = $this->xpath->evaluate('string(item/geo:long)', $contextNode);

    $day = new WFDay();
    $day->date               = 'Current Conditions';
    $day->sunrise            = $this->xpath->evaluate('string(yweather:astronomy/@sunrise)', $contextNode);
    $day->sunset             = $this->xpath->evaluate('string(yweather:astronomy/@sunset)', $contextNode);
    $day->description        = $this->xpath->evaluate('string(item/yweather:condition/@text)', $contextNode);
    $day->symbol             = $this->symbolsDir . $this->symbolMap[$this->xpath->evaluate('string(item/yweather:condition/@code)', $contextNode)];
    $day->temperature->value = $this->xpath->evaluate('string(item/yweather:condition/@temp)', $contextNode);
    $day->temperature->units = $temperatureUnits;
    $day->windSpeed->value   = $this->xpath->evaluate('string(yweather:wind/@speed)', $contextNode);
    $day->windSpeed->units    = $speedUnits;
    $day->windDirection->value = $this->xpath->evaluate('string(yweather:wind/@direction)', $contextNode);
    $day->windDirection->units = '&#176;';
    $day->humidity->value    = $this->xpath->evaluate('string(yweather:atmosphere/@humidity)', $contextNode);
    $day->humidity->units    = $humidityUnits;
    $day->visibility->value  = $this->xpath->evaluate('string(yweather:atmosphere/@visibility)', $contextNode)/100;
    $day->visibility->units  = $distanceUnits;
    $day->pressure->value    = $this->xpath->evaluate('string(yweather:atmosphere/@pressure)', $contextNode);
    $day->pressure->units    = $pressureUnits;
    $day->pressureTrend      = $this->parsePressureTrend($contextNode);
    $forecast->days->add(0, $day);

    $items = $this->xpath->evaluate('item/yweather:forecast', $contextNode);
    for ($i = 0, $l = $items->length; $i < $l;) {
      $contextNode = $items->item($i++);
      $day = new WFDay();
      $day->date = $dateFormatter->format($this->dateFormat, $this->xpath->evaluate('string(@date)', $contextNode));
      $day->description = $this->xpath->evaluate('string(@text)', $contextNode);
      $day->symbol  = $this->symbolsDir . $this->symbolMap[$this->xpath->evaluate('string(@code)', $contextNode)];
      $day->maxTemperature->value = $this->xpath->evaluate('string(@high)', $contextNode);
      $day->maxTemperature->units = $temperatureUnits;
      $day->minTemperature->value = $this->xpath->evaluate('string(@low)', $contextNode);
      $day->minTemperature->units = $temperatureUnits;
      $forecast->days->add($i, $day);
    }

    return $forecast;
  }

  /**
   * Parses the pressure trend into  words
   *
   * @param DOMNode $contextNode The node from with to start XPath evaluation
   * @return string The pressure trend
   */
  private function parsePressureTrend($contextNode) {
    switch ($this->xpath->evaluate('string(yweather:atmosphere/@rising)', $contextNode)) {
      case 0:
        return 'Steady';
        break;
      case 1:
        return 'Rising';
        break;
      case 2:
        return 'Falling';
        break;
      default:
        return '';
        break;
    } // switch
  }
}
?>
