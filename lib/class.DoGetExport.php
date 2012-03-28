<?php
class DoGetExport extends MultiParser_utils {

    const DB_NAME = 'module_multiparser_export';

    public function __construct() {

    }

    protected function getCachePath() {
        $config = cms_utils::get_config();
        $mod    = cms_utils::get_module('MultiParser');
        return cms_join_path($config['uploads_path'], $mod->GetPreference('dir')) . DIRECTORY_SEPARATOR . 'mp_' . munge_string_to_url($this->GetTitle() . $this->GetId(), true) . '.' . strtolower($this->GetType());
    }

    protected function saveContents() {
        $config = cms_utils::get_config();
        $mod    = cms_utils::get_module('MultiParser');
        if ($mod->GetPreference('save_file') == 1) {
            if (!file_exists(cms_join_path($config['uploads_path'], $mod->GetPreference('dir')))) {
                @mkdir(cms_join_path($config['uploads_path'], $mod->GetPreference('dir')), 0755, true);
            }
            file_put_contents($this->getCachePath(), $mod->ProcessTemplateFromData($this->GetItemContent()));
        }
    }

    public function save() {
        if ($this->id != null) {
            $this->update();

        } else {
            $this->insert();
        }
        $this->saveContents();
    }

    protected function update() {

        $db = cms_utils::get_db();

        $query = 'UPDATE  ' . cms_db_prefix() . self::DB_NAME . ' 
      
      SET ';

        $query .= 'title = ?, type = ?, item_description = ?, item_content = ?';

        $query .= '
      
      WHERE
      
      id = ?  ';

        $result = $db->Execute($query, array($this->getTitle(), $this->getType(), $this->getItemDescription(), $this->getItemContent(), $this->getId()));

        return true;
    }

    protected function insert() {
        $db = cms_utils::get_db();

        $this->setId($db->GenID(cms_db_prefix() . self::DB_NAME . '_seq'));

        $query = 'INSERT INTO ' . cms_db_prefix() . self::DB_NAME . ' 
      
      SET  id = ?,  ';

        $query .= 'title = ?, type = ?, item_description = ?, item_content = ?';

        $db->Execute($query, array($this->getId(), $this->getTitle(), $this->getType(), $this->getItemDescription(), $this->getItemContent()));

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
?>