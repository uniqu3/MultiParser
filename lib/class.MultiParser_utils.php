<?php
class MultiParser_utils extends MultiParser {
    var $id;
    var $title;
    var $item_url;
    var $description;
    var $content;
    var $type;
    var $contents;
    var $config;
    var $add_params;

    public function __construct() {
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

    public function getItemContent() {
        return $this->content;
    }

    public function setItemContent($content) {
        $this->content = $content;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setAddParams($string) {
        $this->add_params = $string;
    }

    public static function compareEntryDates($a, $b) {
        return strcmp($a['updated'], $b['updated']);
    }

    protected function getItemByCache() {
        $this->contents = file_get_contents($this->getCachePath());
    }

    protected function setItemCache() {
        file_put_contents($this->getCachePath(), $this->contents);
    }

    protected function checkCache($lenght) {
        $file = $this->getCachePath();

        if (!is_file($file) || filemtime($file) < (time() - $lenght)) {
            return false;
        } else {
            return true;
        }
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
        if (isset($row['item_content'])) {
            $this->content = $row['item_content'];
        }
    }

    public function PopulateFromDb($row) {
        $this->Populate($row);
    }

}
?>    