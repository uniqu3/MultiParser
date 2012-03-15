<?php
#-------------------------------------------------------------------------
# Module: MultiParser - This module lets you grab any XML, RSS or Atom Feed as well as JSON Data which you can integrate on your website.
# This module is a fork from XMLMadeSimple created by Jean-Christophe Cuvelier.
# Original Author: Jean-Christophe Cuvelier.
# Fork Author: Goran Ilic - uniqu3e@gmail.com
#-------------------------------------------------------------------------
# CMS - CMS Made Simple is (c) 2009 by Ted Kulp (wishy@cmsmadesimple.org)
# This project's homepage is: http://www.cmsmadesimple.org

#-------------------------------------------------------------------------
#
# This program is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
# Or read it online: http://www.gnu.org/licenses/licenses.html#GPL
#
#
# Original:  XML Made Simple Feed class
#
# Author: Jean-Christophe Cuvelier (jcc@morris-chapman.com)
# Copyright: Jean-Christophe Cuvelier - Morris & Chapman Belgium
#
# Created: 20091021
#-------------------------------------------------------------------------

class MultiParser_utils {
    var $id;
    var $title;
    var $item_url;
    var $description;
    var $type;
    var $contents;
    var $config;
    var $add_params;

    const DB_NAME = 'module_multiparser_item';

    public function __construct() {
        $config = cms_utils::get_config();
    }

    public function __toString() {
        return $this->getTitle();
    }

    public function setId($value) {
        $this->id = $value;
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getItemDescription() {
        return $this->description;
    }

    public function setItemDescription($description) {
        $this->description = $description;
    }

    public function getType() {
        return $this->type;
    }    
    
    public function setType($type) {
        $this->type = $type;
    }    

    public function getItemUrl() {
        $separator = '';
        if ($this->add_params)
            $separator = strpos($this->item_url, '?') !== false ? '&' : '?';
        return trim($this->item_url) . $separator . $this->add_params;
    }

    public function setItemUrl($value) {
        $this->item_url = $value;
    }

    public function setAddParams($string) {
        $this->add_params = $string;
    }

    /**
     * getItem returns content of the item
     */
    public function getItem() {

        if ($module = cms_utils::get_module('MultiParser')) {
            $cache = $module->getPreference('cache');
        } else {
            $cache = 900;
        }
        if (empty($this->add_params) && $this->checkCache($cache)) {
            $this->getItemByCache();
        } else {
            $this->getItemByUrl();
        }
        if($this->GetType() != 'JSON') {
            return simplexml_load_string($this->contents);
        } else {
            return json_decode($this->contents);
        }
    }
    
    /**
     * getItemByUrl returns content from item URL 
     */
    protected function getItemByUrl() {
        $this->contents = file_get_contents($this->getItemUrl());
        $this->setItemCache();
    }

    /**
     * getItemByCache returns content from item cache file
     */
    protected function getItemByCache() {
        $this->contents = file_get_contents($this->getCachePath());
    }

    /**
     * setItemCache saves item content
     */
    protected function setItemCache() {
        file_put_contents($this->getCachePath(), $this->contents);
    }

    /**
     * checkCache checks cache file age 
     */
    protected function checkCache($lenght) {
        $file = $this->getCachePath();

        if (!is_file($file) || filemtime($file) < (time() - $lenght)) {
            // Cache too old
            return false;
        } else {
            return true;
        }
    }

    /**
     * getCachePath returns path to cached file 
     */
    protected function getCachePath() {
        return TMP_CACHE_LOCATION . '/multiparser_' . $this->getId() . '.tmp';
    }

    public static function compareEntryDates($a, $b) {
        return strcmp($a['updated'], $b['updated']);
    }

    public function Populate($row) {
        if (isset($row['id'])) {
            $this->id = $row['id'];
        }
        if (isset($row['title'])) {
            $this->title = $row['title'];
        }
        if (isset($row['type'])) {
            $this->type = $row['type'];
        }        
        if (isset($row['item_url'])) {
            $this->item_url = $row['item_url'];
        }
        if (isset($row['item_description'])) {
            $this->description = $row['item_description'];
        }
    }

    public function PopulateFromDb($row) {
        $this->Populate($row);
    }

    public function save() {
        // Upgrade or Insert ?
        if ($this->id != null) {
            $this->update();
            $this->getItemByUrl();
            
        } else {
            $this->insert();
        }

    }

    protected function update() {

        $db = cms_utils::get_db();

        $query = 'UPDATE  ' . cms_db_prefix() . self::DB_NAME . ' 
      
      SET ';

        $query .= 'title = ?, type = ?, item_url = ?, item_description = ?';

        $query .= '
      
      WHERE
      
      id = ?  ';

        $result = $db->Execute($query, array($this->getTitle(), $this->getType(), $this->getItemUrl(), $this->getItemDescription(), $this->getId()));

        return true;
    }

    protected function insert() {
        $db = cms_utils::get_db();

        $this->setId($db->GenID(cms_db_prefix() . self::DB_NAME . '_seq'));

        $query = 'INSERT INTO ' . cms_db_prefix() . self::DB_NAME . ' 
      
      SET  id = ?,  ';

        $query .= 'title = ?, type = ?, item_url = ?, item_description = ?';

        $db->Execute($query, array($this->getId(), $this->getTitle(), $this->getType(), $this->getItemUrl(), $this->getItemDescription()));

        return true;
    }

    public static function retrieveById($id) {
        return self::doSelectOne(array('where' => array('id' => $id)));
    }

    public static function doSelectOne($params = array()) {
        $items = self::doSelect($params);
        if ($items) {
            return $items[0];
        } else {
            return null;
        }
    }

    public static function doSelect($params = array()) {
        $instance = new self();

        $db = cms_utils::get_db();

        $query = 'SELECT * FROM ' . cms_db_prefix() . self::DB_NAME;

        $values = array();
        $fields = array();

        if (isset($params['where'])) {
            foreach ($params['where'] as $field => $value) {
                $fields[] = $field . ' =  ?';
                $values[] = $value;
            }
        }

        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $field => $value) {
                $fields[] = $field . ' IN (' . "'" . implode("','", $value) . "'" . ')';
            }
        }

        if (count($fields)) {
            $query .= ' WHERE ' . implode(' AND ', $fields);
        }

        $dbresult = $db->Execute($query, $values);

        $items = array();
        if ($dbresult && $dbresult->RecordCount() > 0) {
            while ($dbresult && $row = $dbresult->FetchRow()) {
                $item = new self();
                $item->PopulateFromDb($row);
                $items[] = $item;
            }
        }

        return $items;
    }

    public function delete() {
        $db = cms_utils::get_db();
        $query = 'DELETE FROM ' . cms_db_prefix() . self::DB_NAME;
        $query .= ' WHERE id = ?';
        $db->Execute($query, array($this->id));
    }

    public static function deleteById($id) {
        $item = self::retrieveById($id);
        $item->delete();
    }

}
