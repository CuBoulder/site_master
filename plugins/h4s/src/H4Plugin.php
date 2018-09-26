<?php

/**
 * @file
 * Contains H4Plugin class.
 */

namespace SiteMaster\Plugins\H4Metric;

use SiteMaster\Core\Plugin\PluginInterface;

class Plugin extends PluginInterface
{

    /**
     * Called when a plugin is installed.  Add sql changes and other logic here.
     *
     * @return mixed
     */
    public function onInstall()
    {
        return true;
    }

    /**
     * Please undo whatever you did in onInstall().  If you don't, someone might have a bad day.
     *
     * @return mixed
     */
    public function onUnInstall()
    {
        return true;
    }

    /**
     * Called when the plugin is updated (a newer version exists).
     *
     * @param $previousVersion int The previous installed version
     * @return mixed
     */
    public function onUpdate($previousVersion)
    {
        return true;
    }

    /**
     * Returns the long name of the plugin
     *
     * @return mixed
     */
    public function getName()
    {
        return 'H4 Checker';
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
    public function getVersion()
    {
        return true;
    }

    /**
     * Returns a description of the plugin
     *
     * @return mixed
     */
    public function getDescription()
    {
        return 'Checks page for H4 tag.';
    }

    /**
     * Get an array of event listeners
     *
     * @return array
     */
    function getEventListeners()
    {
        $listeners = array();

        return $listeners;
    }
}
