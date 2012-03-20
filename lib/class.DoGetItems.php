<?php
class DoGetItems extends MultiParser_utils {
    var $contents;
    var $add_params;

    const DB_NAME = 'module_multiparser_item';

    public function __construct() {
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
        if ($this->GetType() != 'JSON') {
            return simplexml_load_string($this->contents);
        } else {
            return json_decode($this->contents);
        }
    }

    protected function getItemByUrl() {
        $this->contents = file_get_contents($this->getItemUrl());
        $this->setItemCache();
    }

    protected function getCachePath() {
        return TMP_CACHE_LOCATION . '/multiparser_' . $this->getId() . '.tmp';
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
