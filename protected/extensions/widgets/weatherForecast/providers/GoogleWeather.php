<?php
/* SVN FILE: $Id: GoogleWeather.php 13 2009-10-13 13:36:59Z Chris $ */
/**
 * Google Weather data provider
 *
 * @copyright    Copyright 2009 PBM Web Development - All Rights Reserved
 * @filesource
 * @package      weatherForecast
 * @subpackage   weatherForecast.providers
 * @version      $Revision: 13 $
 * @modifiedby   $LastChangedBy: Chris $
 * @lastmodified $Date: 2009-10-13 14:36:59 +0100 (Tue, 13 Oct 2009) $
 * @license      http://www.opensource.org/licenses/bsd-license.php The BSD License
 */

include 'WeatherForecastProvider.php';

/**
 * Google Weather data provider
 *
 * <p>Values in params:<br>
 * dateFormat (string) => Date format for days;
 * Used by {@link http://www.yiiframework.com/doc/api/CDateFormatter#format-detail CDateFormatter::format()},
 * see {@link http://www.unicode.org/reports/tr35/#Date_Format_Patterns Date Format Patterns}
 * for a description of formats. Default: "EEE d'&nbsp;'MMM yyyy"<br>
 * language (string) => {@link http://en.wikipedia.org/wiki/List_of_ISO_639-1_codes ISO 639-1 code}.
 * Default: 'en' (English)<br>
 * location (string) => Location.<br>
 * The API is not published, but UK post codes, US zip codes and "place,region" seem to work.
 * Place is the name of a town or city. Region is a US state, country name or
 * an {@link http://en.wikipedia.org/wiki/ISO_3166-1_alpha-2 ISO 3166-1 alpha-2 code}.
 * Place and region are separated by a comma <b>only</b> - no spaces allowed.<br>
 * units (string) => Units to provide the forecast in.
 * "C"|"F" C=metric (default), F=imperial</p>
 *
 * @package  weatherForecast
 * @subpackage weatherForecast.providers
 */
class GoogleWeather extends WFXMLProvider {
  /**
   * @var string Driver description
   */
  private $provider = 'Google Weather';
  /**
   * @var string Forecast feed url
   */
  private $feed = 'http://www.google.com/ig/api?weather=%s&hl=%s';
  /**
   * @var string Language
   */
  protected $language;
  /**
   * @var string Default values
   */
  protected $defaults = array(
    'location' => 'London',
    'units' => 'C',
    'dateFormat' => "EEE d'&nbsp;'MMM yyyy",
    'language' => 'en'
  );
  /**
   * @var array Maps weather conditions to symbols
   * Note: Probably not complete as the API is not documented
   */
  protected $symbolMap = array(
    'Chance of Rain' => 'rain.png',
    'Chance of Showers' => 'showers.png',
    'Chance of Snow' => 'snow.png',
    'Chance of Storm' => 'storm.png',
    'Chance of Tstorm' => 'thunderstorm.png',
    'Clear' => 'sunny.png',
    'Cloudy' => 'cloudy.png',
    'Dust' => 'dust.png',
    'Flurries' => 'snow.png',
    'Fog' => 'fog.png',
    'Haze' => 'haze.png',
    'Icy' => 'icy.png',
    'Light Rain' => 'rain_light',
    'Mist' => 'mist.png',
    'Mostly Cloudy' => 'partly_cloudy_day.png',
    'Mostly Sunny' => 'partly_cloudy_day.png',
    'Overcast' => 'overcast.png',
    'Partly Cloudy' => 'partly_cloudy_day.png',
    'Partly Sunny' => 'partly_cloudy_day.png',
    'Rain' => 'rain.png',
    'Rain Showers' => 'showers.png',
    'Scattered Showers' => 'showers.png',
    'Showers' => 'showers_heavy.png',
    'Sleet' => 'sleet.png',
    'Smoke' => 'smoke.png',
    'Snow' => 'snow.png',
    'Storm' => 'storm.png',
    'Sunny' => 'sunny.png',
    'Thunderstorm' => 'thunderstorm.png',
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

    $this->read(vsprintf($this->feed,  array($this->location, $this->language)));

    $contextNode = $this->xpath->evaluate('/xml_api_reply/weather')->item(0);

    $issued = $this->xpath->evaluate('string(forecast_information/current_date_time/@data)', $contextNode);

    if (substr($issued, -5) == '+0100') {
      $tz = 'BST';
    }
    else {
      $tz = 'GMT';
    }
    $issued = substr($issued, 0, 20) . $tz;

    $forecast->provider = $this->provider;
    $forecast->issued = $issued;
    $forecast->location->name = $this->xpath->evaluate('string(forecast_information/city/@data)', $contextNode);
    $forecast->location->lat  = $this->xpath->evaluate('string(forecast_information/latitude_e6/@data)', $contextNode);
    $forecast->location->long = $this->xpath->evaluate('string(forecast_information/longitude_e6/@data)', $contextNode);

    $day = new WFDay();
    $day->date = 'Current Conditions';
    $day->description = $this->xpath->evaluate('string(current_conditions/condition/@data)', $contextNode);
    $day->symbol = $this->symbolsDir === false ? 'http://www.google.com' . $this->xpath->evaluate('string(icon/@data)', $contextNode) : $this->symbolsDir . $this->symbolMap[$day->description];
    $t = $this->xpath->evaluate('string(current_conditions/temp_f/@data)', $contextNode);
    $day->temperature->value = $this->units=='F'?$t:$this->f2c($t);
    $day->temperature->units = $this->units;

    $wind = $this->xpath->evaluate('string(current_conditions/wind_condition/@data)', $contextNode);
    preg_match('/([NESW]+) at (\d+)/i', $wind, $matches);
    $day->windSpeed->value = $this->units=='F'?$matches[2]:$this->mph2kph($matches[2]);
    $day->windSpeed->units = $this->units=='F'?'mph':'kph';
    $day->windDirection->value = $matches[1];

    $humidity = $this->xpath->evaluate('string(current_conditions/humidity/@data)', $contextNode);
    preg_match('/(\d+)/i', $humidity, $matches);
    $day->humidity->value = $matches[1];
    $day->humidity->units = '%';
    $forecast->days->add(0, $day);

    $items = $this->xpath->evaluate('forecast_conditions', $contextNode);
    for ($i = 0, $l = $items->length; $i < $l;) {
      $contextNode = $items->item($i++);
      $day = new WFDay();
      $day->date = $dateFormatter->format($this->dateFormat, "+$i days");
      $day->description = $this->xpath->evaluate('string(condition/@data)', $contextNode);
      $day->symbol = $this->symbolsDir === false ? 'http://www.google.com' . $this->xpath->evaluate('string(icon/@data)', $contextNode) : $this->symbolsDir . $this->symbolMap[$day->description];

      $t = $this->xpath->evaluate('string(high/@data)', $contextNode);
      $day->maxTemperature->value = $this->units=='F'?$t:$this->f2c($t);
      $day->maxTemperature->units = $this->units;

      $t = $this->xpath->evaluate('string(low/@data)', $contextNode);
      $day->minTemperature->value = $this->units=='F'?$t:$this->f2c($t);
      $day->minTemperature->units = $this->units;

      $forecast->days->add($i, $day);
    }

    return $forecast;
  }
}
?>