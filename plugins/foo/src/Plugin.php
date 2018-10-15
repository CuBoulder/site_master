<?php

namespace SiteMaster\Plugins\Foo;

use SiteMaster\Core\Events\RegisterTheme;
use SiteMaster\Core\Events\RoutesCompile;
//use SiteMaster\Core\Listener;
use SiteMaster\Core\Plugin\PluginInterface;

class Plugin extends PluginInterface {

  /**
   * Called when a plugin is installed.  Add sql changes and other logic here.
   *
   * @return mixed
   */
  public function onInstall() {
    return true;
  }

  /**
   * Please undo whatever you did in onInstall().  If you don't, someone might have a bad day.
   *
   * @return mixed
   */
  public function onUnInstall() {
    return true;
  }

  /**
   * Called when the plugin is updated (a newer version exists).
   *
   * @param $previousVersion int The previous installed version
   *
   * @return mixed
   */
  public function onUpdate($previousVersion) {
    return true;
  }

  /**
   * Returns the long name of the plugin
   *
   * @return mixed
   */
  public function getName() {
    return 'foo';
  }

  /**
   * Returns the version of this plugin
   * Follow a mmddyyyyxx syntax.
   *
   * for example 1118201301
   * would be 11/18/2013 - increment 1
   *
   * @return mixed
   */
  public function getVersion() {
    return true;
  }

  /**
   * Returns a description of the plugin
   *
   * @return mixed
   */
  public function getDescription() {
    return 'foo';
  }

  /**
   * Get an array of event listeners
   *
   * @return array
   */
  function getEventListeners() {
    $listeners = [];
    $listener = new Listener($this);

    $listeners[] = array(
      'event'    => RoutesCompile::EVENT_NAME,
      'listener' => array($listener, 'onRoutesCompile')
    );

    $listeners[] = array(
      'event'    => RegisterTheme::EVENT_NAME,
      'listener' => array($listener, 'onRegisterTheme')
    );

    $listeners[] = array(
      'event'    => \SiteMaster\Core\Events\Navigation\MainCompile::EVENT_NAME,
      'listener' => array($listener, 'onNavigationMainCompile')
    );

    return $listeners;
}}
