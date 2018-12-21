<?php
/* SVN FILE: $Id: BBCWeather.php 13 2009-10-13 13:36:59Z Chris $ */
/**
 * BBC Weather data provider
 *
 * @link http://news.bbc.co.uk/weather/ BBC Weather site
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
 * BBC Weather data provider
 *
 * <p>Values in params:<br>
 * dateFormat (string) => Date format for days;
 * Used by {@link http://www.yiiframework.com/doc/api/CDateFormatter#format-detail CDateFormatter::format()},
 * see {@link http://www.unicode.org/reports/tr35/#Date_Format_Patterns Date Format Patterns}
 * for a description of formats. Default: "EEE d'&nbsp;'MMM yyyy"<br>
 * location (string) => Location.<br>
 * To find the location id use the search on the above page.
 * The id is the number immediately after "http://news.bbc.co.uk/weather/"<br>
 * units (string) => Units to provide the forecast in.
 * "C"|"F" C=metric (default), F=imperial</p>
 *
 * @package    weatherForecast
 * @subpackage weatherForecast.providers
 */
class BBCWeather extends WFXMLProvider {
  /**
   * @var string Driver description
   */
  private $provider = "BBC Weather";
  /**#@+
   * BBC Weather URLs
   */
  /**
   * @var string BBC Weather url
   */
  private $url = 'http://news.bbc.co.uk/weather/';
  /**
   * @var string Observations - current conditions
   */
  private $observationsUrl = 'http://newsrss.bbc.co.uk/weather/forecast/%s/ObservationsRSS.xml';
  /**
   * @var string 3 Day forecast
   */
  private $next3DayUrl = 'http://newsrss.bbc.co.uk/weather/forecast/%s/Next3DaysRSS.xml';
  /**#@-*/
  /**
   * @var string Default values
   */
  protected $defaults = array(
    'location' => '2574', //London
    'units' => 'C',
    'dateFormat' => "EEE d'&nbsp;'MMM yyyy"
  );
  /**
   * @var array Maps weather conditions to symbols
   * Note: Probably not complete as the API is not documented
   */
  protected $symbolMap = array(
    'Clear Sky' => 'clear_night.png',
    'Drizzle' => 'drizzle.png',
    'Grey Cloud' => 'overcast.png',
    'Heavy Rain Shower' => 'showers_heavy.png',
    'Heavy Rain' => 'rain_heavy.png',
    'Light Rain' => 'rain.png',
    'Light Rain Shower' => 'showers.png',
    'Partly Cloudy' => 'partly_cloudy_day.png',
    'Sunny Intervals' => 'partly_cloudy_day.png',
    'Sunny' => 'sunny.png',
    'White Cloud' => 'cloudy.png'
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

    $this->read(vsprintf($this->observationsUrl,  $this->location));

    $issued = $this->xpath->evaluate('string(channel/lastBuildDate)');
    if (substr($issued, -5) == '+0100') {
      $tz = 'BST';
    }
    else {
      $tz = 'GMT';
    }
    $issued = substr($issued, 0, 22) . $tz;

    $forecast->provider = CHtml::link($this->provider, $this->url, array('rel'=>'external'));
    $forecast->issued = $issued;

    $location = $this->xpath->evaluate('string(channel/title)');
    preg_match('/for\s([- A-Za-z]+), ([ \w])+$/i', $location, $matches);
    $forecast->location->name = $matches[1];

    $contextNode = $this->xpath->evaluate('channel/item')->item(0);
    $forecast->location->lat  =
      $this->xpath->evaluate('string(geo:lat)', $contextNode);
    $forecast->location->long =
      $this->xpath->evaluate('string(geo:long)', $contextNode);

    $details = $this->getDetails($contextNode);

    $day = new WFDay();
    $day->date = 'Current Conditions';
    $day->description = $details['Description'];
    $day->symbol = $this->symbolsDir . $this->symbolMap[$day->description];
    $day->temperature->value   = $details['Temperature'][0];
    $day->temperature->units   = $details['Temperature'][1];
    $day->windSpeed->value     = $details['Wind Speed'][0];
    $day->windSpeed->units     = $details['Wind Speed'][1];
    $day->windDirection->value = $details['Wind Direction'];
    $day->humidity->value      = $details['Humidity'][0];
    $day->humidity->units      = $details['Humidity'][1];
    $day->visibility->value    = $details['Visibility'];
    $day->pressure->value      = $details['Pressure'][0];
    $day->pressure->units      = $details['Pressure'][1];
    $day->pressureTrend        = $details['Pressure Trend'];
    $forecast->days->add(0, $day);

    $this->read(vsprintf($this->next3DayUrl,  $this->location));

    $items = $this->xpath->evaluate('channel/item');
    for ($i = 0, $l = $items->length; $i < $l;) {
      $day = new WFDay();
      $details = $this->getDetails($items->item($i++));
      $day->date = $dateFormatter->format($this->dateFormat, "+$i days");
      $day->description           = $details['Description'];
      $day->symbol = $this->symbolsDir . $this->symbolMap[$day->description];
      $day->maxTemperature->value = $details['Max Temp'][0];
      $day->maxTemperature->units = $details['Max Temp'][1];
      $day->minTemperature->value = $details['Min Temp'][0];
      $day->minTemperature->units = $details['Min Temp'][1];
      $day->windSpeed->value      = $details['Wind Speed'][0];
      $day->windSpeed->units      = $details['Wind Speed'][1];
      $day->windDirection->value  = $details['Wind Direction'];
      $day->humidity->value       = $details['Humidity'][0];
      $day->humidity->units       = $details['Humidity'][1];
      $day->visibility->value     = $details['Visibility'];
      $day->pressure->value       = $details['Pressure'][0];
      $day->pressure->units       = $details['Pressure'][1];
      $forecast->days->add($i, $day);
    }

    return $forecast;
  }

  /**
   * Extracts the details from the title and description nodes of the context node
   *
   * @param DOMNode $contextNode The node from with to start XPath evaluation
   * @return array The forecast details
   */
  private function getDetails($contextNode) {
    $_details = explode(',', $this->xpath->evaluate('string(title)', $contextNode));
    foreach ($_details as $_detail) {
      $detail = explode(':', $_detail);

      if (strpos($detail[0], ' ') !== false) {
        $detail[0] = substr($detail[0], 0, strpos($detail[0], ' '));
        $detail[1] = substr($detail[2], 0, strpos($detail[2], '.'));
      }

      if (in_array($detail[0], array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'))) {
        $details['Description'] = ucwords(trim($detail[1]));
      }
    } // foreach

    $_details = explode(',', $this->xpath->evaluate('string(description)', $contextNode));
    foreach ($_details as $_detail) {
      $detail = explode(':', $_detail);

      if (empty($detail[1])) {
        $details['Pressure Trend'] = trim($detail[0]);
      }
      else {
        $detail[0] = trim($detail[0]);
        $detail[1] = trim($detail[1]);
        switch ($detail[0]) {
          case 'Max Temp':
          case 'Min Temp':
          case 'Temperature':
            // The length value in substr MAY depend on the system encoding
            $detail[1] = explode(' ', $detail[1]);
            if ($this->units == 'C') {
              $value = substr($detail[1][0], 0, -3);
            }
            else {
              $value = substr($detail[1][1], 1, -4);
            }
            $details[$detail[0]] = array($value, $this->units);
            break;
          case 'Wind Speed':
            $value = $this->units=='F' ? substr($detail[1], 0, -3) : $this->mph2kph(substr($detail[1], 0, -3));
            $units = $this->units=='F'?'mph':'kph';
            $details[$detail[0]] = array($value, $units);
            break;
          case 'Pressure':
            $value = substr($detail[1], 0, -2);
            $units = substr($detail[1], -2);
            $details[$detail[0]] = array($value, $units);
            break;
          case 'Relative Humidity':
          case 'Humidity':
            $value = substr($detail[1], 0, -1);
            $units = substr($detail[1], -1);
            $details[substr($detail[0], -8)] = array($value, $units);
            break;
          default:
            $details[$detail[0]] = $detail[1];
            break;
        } // switch
      }
    } // foreach
    return $details;
  }
}
?>