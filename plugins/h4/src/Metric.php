<?php

/**
 * @file
 * Contains H4Metric class.
 */

namespace SiteMaster\Plugins\H4;

use SiteMaster\Core\Auditor\MetricInterface;
use SiteMaster\Core\Auditor\Logger;
use SiteMaster\Core\Auditor\Site\Page;

class Metric extends MetricInterface
{

    /**
     * @param string $plugin_name
     * @param array $options
     */
//    public function __construct($plugin_name, array $options = array())
//    {
//        parent::__construct($plugin_name, $options);
//    }

    /**
     * Get the human readable name of this metric
     *
     * @return string The human readable name of the metric
     */
    public function getName()
    {
        return 'H4 Check';
    }

    /**
     * Get the Machine name of this metric
     *
     * This is what defines this metric in the database
     *
     * @return string The unique string name of this metric
     */
    public function getMachineName()
    {
        return 'h4_metric';
    }

    /**
     * Determine if this metric should be graded as pass-fail
     *
     * @return bool True if pass-fail, False if normally graded
     */
    public function isPassFail()
    {
        return false;
    }

    /**
     * Scan a given URI and apply all marks to it.
     *
     * All that this
     *
     * @param string $uri - the uri to scan
     * @param \DOMXPath $xpath - the xpath of the uri
     * @param int $depth - the current depth of the scan
     * @param \SiteMaster\Core\Auditor\Site\Page $page - the current page to scan
     * @param Logger\Metrics $logger The logger class which calls this method, you can access the spider, page, and scan from this
     *
     * @return bool True if there was a successful scan, false if not.  If false, the metric will be graded as incomplete
     */
    public function scan($uri, \DOMXPath $xpath, $depth, Page $page, Logger\Metrics $logger)
    {

//        if (false === $this->headless_results || isset($this->headless_results['exception'])) {
//            //mark this metric as incomplete
//            throw new RuntimeException('headless results are required for the axe metric');
//        }

        // Log stuff for debugging purposes.

        $handle = fopen('/var/www/html/uri.json', 'w') or die('Cannot open file:');
        fwrite($handle, json_encode($uri));
        fclose($handle);

        $handle = fopen('/var/www/html/xpath.json', 'w') or die('Cannot open file:');
        fwrite($handle, json_encode($xpath));
        fclose($handle);

        $handle = fopen('/var/www/html/depth.json', 'w') or die('Cannot open file:');
        fwrite($handle, json_encode($depth));
        fclose($handle);

        $handle = fopen('/var/www/html/page.json', 'w') or die('Cannot open file:');
        fwrite($handle, json_encode($page));
        fclose($handle);

        $handle = fopen('/var/www/html/logger.json', 'w') or die('Cannot open file:');
        fwrite($handle, json_encode($logger));
        fclose($handle);

        return true;
    }
}
