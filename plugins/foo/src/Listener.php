<?php

namespace SiteMaster\Plugins\Foo;

use SiteMaster\Core\Events\Navigation\MainCompile;
use SiteMaster\Core\Events\RegisterTheme;
use SiteMaster\Core\Events\RoutesCompile;
use SiteMaster\Core\Plugin\PluginListener;

class Listener extends PluginListener {

  public function onRoutesCompile(RoutesCompile $event)
  {
    $event->addRoute('/^directory\/list\/$/', __NAMESPACE__ . '\Listing');
  }

  public function onRegisterTheme(RegisterTheme $event)
  {
    if ($event->getTheme() == 'directory') {
      $event->setPlugin($this->plugin);
    }
  }

  public function onNavigationMainCompile(MainCompile $event)
  {
    $event->addNavigationItem(\SiteMaster\Core\Config::get('URL') . 'directory/list/', 'Directory');
  }
}
