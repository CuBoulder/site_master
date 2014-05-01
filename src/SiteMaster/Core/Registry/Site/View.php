<?php
namespace SiteMaster\Core\Registry\Site;

use SiteMaster\Core\Registry\Site;
use SiteMaster\Core\ViewableInterface;
use SiteMaster\Core\InvalidArgumentException;

class View implements ViewableInterface
{
    /**
     * @var array
     */
    public $options = array();

    /**
     * @var \SiteMaster\Core\Registry\Site
     */
    public $site = false;

    function __construct($options = array())
    {
        $this->options += $options;

        //get the site
        if (!isset($this->options['site_id'])) {
            throw new InvalidArgumentException('a site id is required', 400);
        }

        if (!$this->site = Site::getByID($this->options['site_id'])) {
            throw new InvalidArgumentException('Could not find that site', 400);
        }
    }

    /**
     * Get the viewable (cacheable) scan
     * 
     * @return false|\SiteMaster\Core\Auditor\Scan\View
     */
    public function getScan()
    {
        $options = $this->options;
        
        if (!$options['scan'] = $this->site->getLatestScan()) {
            return false;
        }
        
        return new \SiteMaster\Core\Auditor\Scan\View($options);
    }

    /**
     * Get the url for this page
     *
     * @return bool|string
     */
    public function getURL()
    {
        return $this->site->getURL();
    }

    /**
     * Get the title for this page
     *
     * @return string
     */
    public function getPageTitle()
    {
        return 'Site Home';
    }
}
