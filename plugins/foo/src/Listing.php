<?php

namespace SiteMaster\Plugins\Foo;

use League\Csv\Statement;
use SiteMaster\Core\Config;
use SiteMaster\Core\ViewableInterface;
use League\Csv\Reader;

require '/var/www/html/vendor/league/csv/autoload.php';

class Listing implements ViewableInterface {


//  private $perp;
//
//  public function __construct(new Config()) {
//    $this->perp = new Config();
//  }

  private $reader;

  private $records;

  public function getURL() {
    return Config::get('URL') . 'directory/list/';
  }

  public function getPageTitle() {
    return 'Directory Listing';
  }

  public function foo() {
    return 'foo please';
  }

  public function getThemeData($route) {

    $path = $this->getFilepath($route);

    $this->reader = Reader::createFromPath(Config::get('ROOT_DIR'). '/plugins/foo/'. $path, 'r');
    $this->reader->setHeaderOffset(0);
    $records = (new Statement())->process($this->reader);


    $output = $this->recordsList($records);

    return $output;
  }


  public function recordsList($records) {
    $headers = $records->getHeader();

    $list = [];
    foreach ($records->getRecords() as $record) {
      // All rows have all columns.
      // This is brittle.
      $list[$record[$headers[0]]][$record[$headers[1]]][] = $record[$headers[2]];

    }

    return $list;
  }


  function recursive($value) {
    foreach ($value as $key => $value) {
      //If $value is an array.
      if (is_array($value)) {
        //We need to loop through it.
        recursive($value);
      }
      else {
        //It is not an array, so print it out.
        echo $value, '<br>';
      }
    }
  }

  private function getFilepath($route) {
    $routes = Config::get('DIRECTORY_FILES');
    return $routes[$route];
  }

}
