<?php
/* SVN FILE: $Id: WeatherForecast.php 15 2009-10-18 10:14:07Z Chris $ */
/**
 * Weather Forecast widget
 *
 * Parses data from a weather forecast provider and creates a view.
 *
 * Three weather forecast providers are supported by default:
 * BBC (Note: the API is not published so the symbolMap is almost certainly incomplete)
 * Google (Note: the API is not published so the symbolMap is almost certainly incomplete)
 * Yahoo (Note: Yahoo data is provided by the Weather Channel)
 *
 * Adding a new provider by writing the {provider}Weather class and
 * placing the {provider}Weather.php file in the providers directory.
 *
 * Cacheing is supported to reduce bandwidth requirements.
 * Cacheing is for provider::location; this means that if you have multiple forecasts
 * for different locations and/or from different providers each is cached.
 *
 * @filesource
 * @copyright    Copyright 2009 PBM Web Development - All Rights Reserved
 * @package      weatherForecast
 * @since        V1.0.0
 * @version      $Revision: 15 $
 * @modifiedby   $LastChangedBy: Chris $
 * @lastmodified $Date: 2009-10-18 11:14:07 +0100 (Sun, 18 Oct 2009) $
 * @license      http://www.opensource.org/licenses/bsd-license.php The BSD License
 */

/**
 * Weather Forecast widget class
 *
 * <p><b>Options:</b></p>
 * <p><b>provider (string):</b><br>
 * Name of the weather forecast provider.
 * Can be specified with or without "Weather" at the end:
 * e.g. BBC and BBWeather will both use the BBCWeather provider</p>
 *
 * <p><b>params (array):</b><br>
 * Contains provider dependant parameters;
 * see the documentation for the provider classes.<br>
 * While the exact requiremets are provider dependant,
 * there are three common parameters:<br>
 * dateFormat (string) => Date format for days;
 * Used by {@link http://www.yiiframework.com/doc/api/CDateFormatter#format-detail CDateFormatter::format()},
 * see {@link http://www.unicode.org/reports/tr35/#Date_Format_Patterns Date Format Patterns}
 * for a description of formats. Default: "EEE d'&nbsp;'MMM yyyy"<br>
 * location (string) => location of the forecast in the providers format.
 * Default location is London, UK<br>
 * units (string) => Units to provide the forecast in.
 * "C"|"F" C=metric (default), F=imperial</p>
 *
 * <p><b>cache (mixed):</b><br>
 * integer: number of seconds before the forecast expires</br>
 * array:<br>
 * 0 (integer) => number of seconds before the forecast expires<br>
 * 1 (CCacheDependency) => Cache dependency object<br>
 * boolean false: Disable cacheing. i.e. every access creates a request
 * to the provider.<br>
 * null (default): Cache the forecast for one hour</p>
 *
 * <p><b>cssFile (mixed):</b><br>
 * string: Path to the CSS file to use<br>
 * boolean false: No CSS file<br>
 * null (default): Use the default CSS file</p>
 *
 * <p><b>symbolsDir (mixed):</b><br>
 * string: Path to the directory containing symbols to use<br>
 * boolen false: Use the providers symbols specified in the data (Google only)<br>
 * null (default): Use the default symbols</p>
 *
 * <p><b>symbolMap (mixed):</b><br>
 * array: Associative array that maps a forecast parameter
 * (e.g., description, code, etc.) to the symbol to use
 * for a given value of the parameter. e.g.
 * 'symbolMap' => array(
 *   'Partly Cloudy' => partly_cloudy.gif,
 *   'Sunny' => 'sunn.gif',
 *   etc.
 * );<br>
 * null (default): Use the provider's default symbol map</p>
 *
 * <p><b>Example Useage</b></p>
 * <p><code>
 * $this->widget('application.extensions.widgets.weatherForecast.WeatherForecast', array(
 *  'provider'=>'BBC',
 *  'params' => array(
 *  'location'=>'40', // BBCWeather::Paris
 *    'units' => 'C'
 *  ),
 *  'cache'=>array(
 *    3600, // Cache up to one hour
 *    new CExpressionDependency("date('H)") // Expire the cache at the top of the hour
 *  )
 * ));</code></p>
 *
 * @package weatherForecast
 */
class WeatherForecast extends CWidget {
  /**
   * @var string Forecast provider
   */
  public $provider;
  /**
   * @var array Parameters for the forecast provider
   */
  public $params;
  /**
   * @var mixed integer: the number of seconds in which the cached forecast will expire; array: (the number of seconds in which the cached forecast will expire, cache dependency object); boolean false: no cacheing
   * @link http://www.yiiframework.com/doc/api/CCache
   * @link http://www.yiiframework.com/doc/api/CCacheDependency
   */
  public $cache = 3600;
  /**
   * @var string Path of CSS file to use
   */
  public $cssFile;
  /**
   * @var string Path of directory containing symbols to use.
   * Set to false if the provider provides symbols to be used
   */
  public $symbolsDir;
  /**
   * @var array Map of a forecast parameter to symbols.
   * Leave empty if there is a 1:1 correlation between the parameter and symbol name
   */
  public $symbolMap;
  /**
   * @var object The active forecast provider
   */
  private $forecastProvider;
  /**
   * @var array Loaded forecast providers
   */
  private $forecastProviders;

  /**
   * Initialises the widget
   *
   * Registers the CSS file and sets the required forecast provider,
   * loading it if required
   */
  public function init() {
    if ($this->cssFile !== false) {
      if ($this->cssFile === null) {
        $file = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'weather_forecast.css';
        $this->cssFile = Yii::app()->getAssetManager()->publish($file);
      }

      Yii::app()->getClientScript()->registerCssFile($this->cssFile);
    }

    if ($this->symbolsDir === null) {
      $this->symbolsDir = Yii::app()->getAssetManager()->publish(dirname(__FILE__) .DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.'symbols') . '/';
    }

    $this->provider .= (substr($this->provider, -7) != 'Weather' ? 'Weather' : '');
    $this->forecastProvider = $this->getProvider($this->provider);
  }

  /**
   * Display the forecast
   *
   * The cached forecast is used if enabled and not expired
   */
  public function run() {
    if ($this->cache !== false) {
      $location = isset($this->params['location']) ? $this->params['location'] : '';
      $forecast = Yii::app()->cache->get("weatherForecast.{$this->provider}.{$location}");
      if ($forecast === false) {
        $forecast = $this->forecastProvider->getForecast($this->params, array($this->symbolsDir, $this->symbolMap));
        if (is_integer($this->cache)) {
          $this->cache = array($this->cache, null);
        }
        Yii::app()->cache->set("weatherForecast.{$this->provider}.{$location}", $forecast, $this->cache[0], $this->cache[1]);
      }
    }
    else {
      $forecast = $this->forecastProvider->getForecast($this->params, array($this->symbolsDir, $this->symbolMap));
    }

    $this->render('weatherForecast', compact('forecast'));
  }

  /**
   * Factory method to load the forecast provider
   *
   * @param  string $provider Forecast provider
   * @return WFBaseProvider Forecast provider class
   * @throws CDbException if provider not suppored
   */
  private function getProvider($provider) {
    if (isset($this->forecastProviders[$provider])) {
      return $this->forecastProviders[$provider];
    }

    if (file_exists(dirname(__FILE__).DIRECTORY_SEPARATOR.'providers' . DIRECTORY_SEPARATOR . "$provider.php")) {
      include_once "providers/$provider.php";
      $this->forecastProviders[$provider] = new $provider;
      return $this->forecastProviders[$provider];
    }
    else {
      throw new CDbException(Yii::t('app', __CLASS__ . ' does not support {driver} as a provider.', array('{driver}'=>$provider)));
    }
  }

  /**
   * Renders the forecast table
   *
   * @param array $sections sections of the table
   * @param array $htmlOptions HTML options for the table
   * @return string The rendered table
   */
  public function renderTable($sections, $htmlOptions = array()) {
    $table = '';
    $sectionOrder = array('caption', 'thead', 'tfoot', 'tbody');

    foreach ($sectionOrder as $tag) {
      if (isset($sections[$tag])) {
        $table .= $this->renderTableSection($tag, $sections[$tag]);
      }
    } // foreach

    return Chtml::tag('table', $htmlOptions, $table);
  }

  private function renderTableSection($tag, $content) {
    if ($tag == 'caption') {
      $out = $this->renderTableElement($tag, $content);
    }
    else {
      $htmlOptions = isset($content['htmlOptions']) ? $content['htmlOptions'] : array();
      unset($content['htmlOptions']);

      $rows = '';
      foreach ($content as $key => $row) {
        $rows .= $this->renderTableRow($key, $row);
        $out = CHtml::tag($tag, $htmlOptions, $rows);
      } // foreach

    }
    return $out;
  }

  private function renderTableRow($key, $content) {
    $htmlOptions = isset($content['htmlOptions']) ? $content['htmlOptions'] : array();
    unset($content['htmlOptions']);

    if ($key%2) {
      if (isset($htmlOptions['class'])) $htmlOptions['class'] .= ' even';
      else $htmlOptions['class'] = 'even';
    }

    $cells = '';
    foreach ($content as $column => $cell) {
      if (is_string($cell)) {
        $cell = array($cell);
      }

      if (isset($cell['htmlOptions']['class'])) $cell['htmlOptions']['class'] .= ' column-' . ($column + 1);
      else $cell['htmlOptions']['class'] = 'column-' . ($column + 1);

      $cells .= $this->renderTableElement(isset($cell['htmlOptions']['scope']) ? 'th' : 'td', $cell);
      $out = CHtml::tag('tr', $htmlOptions, $cells);
    } // foreach

    return $out;
  }

private function renderTableElement($tag, $content) {
    if (is_array($content)) {
      $htmlOptions = isset($content['htmlOptions']) ? $content['htmlOptions'] : array();
      unset($content['htmlOptions']);
      $content = $content[0];
    }
    else {
      $htmlOptions = array();
    }

    return CHtml::tag($tag, $htmlOptions, $content);
  }
}
?>