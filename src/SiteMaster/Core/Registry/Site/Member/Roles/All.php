<?php
namespace SiteMaster\Core\Registry\Site\Member\Roles;

use DB\RecordList;
use SiteMaster\Core\InvalidArgumentException;

class All extends RecordList
{
    public function __construct(array $options = array())
    {
        $this->options = $options + $this->options;
        
        $options['array'] = self::getBySQL(array(
            'sql'         => $this->getSQL($options),
            'returnArray' => true
        ));

        parent::__construct($options);
    }

    public function getDefaultOptions()
    {
        $options = array();
        $options['itemClass'] = '\SiteMaster\Core\Registry\Site\Member\Role';
        $options['listClass'] = __CLASS__;

        return $options;
    }
    
    public function getWhere()
    {
        $where = '';
        
        if (isset($this->options['member_id'])) {
            $where .= 'site_members_id = ' . (int) $this->options['member_id'] . ' ';
        }

        if (isset($this->options['approved'])) {
            $where .= 'approved = "' . self::escapeString($this->options['approved']) . '" ';
        }

        if (isset($this->options['site_id'])) {
            $where .= 'sites_members.sites_id = "' . (int) $this->options['site_id'] . '" ';
        }
        
        if ($where == '') {
            $where = 'true';
        }
        
        return 'WHERE ' . $where;
    }
    
    public function getOrderBy()
    {
        return 'ORDER BY roles.role_name ASC';
    }

    public function getSQL()
    {
        
        //Build the list
        $sql = "SELECT site_member_roles.id
                FROM site_member_roles
                LEFT JOIN roles ON (site_member_roles.roles_id = roles.id)
                LEFT JOIN site_members on (site_member_roles.site_members_id = site_members.id)
                " . $this->getWhere() . " 
                " . $this->getOrderBy();

        return $sql;
    }
}
