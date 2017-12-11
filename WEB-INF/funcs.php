<?php

if (!defined('CORE_FUNCS')) {


    define('CORE_FUNCS', 'ADDED');

    /**
     * Description of Object
     *
     * @author Guilherme
     */
    class Object {

        private $value;

        public function __construct($value = null) {
            $this->value = $value;
        }

        /**
         * Method allows getting attritube value without calling the "getter" method
         * example: instead of $object->getName(), use $object->name
         * @param type $name
         * @return type
         */
        public function __get($name) {
            if (method_exists($this, $name)) {
                return $name;
            }
            $attribute = (ctype_upper($name[1]) ? $name : ucfirst($name));
            if (method_exists($this, "is" . $attribute)) {
                return (boolean) $this->{'is' . $attribute}();
            } else if (method_exists($this, "get" . $attribute)) {
                return $this->{'get' . $attribute}();
            }
            die("Getter not found for $name in Class " . get_class($this));
        }

        public function __invoke() {
            return $this->value;
        }

        public function equals($toCompare) {
            return $this === $toCompare && get_called_class($this) === get_class($toCompare);
        }

    }

    function debug($object) {
        ob_clean();
        print_r($object);
        die();
    }

    function is_xml($xml) {
        $doc = @simplexml_load_string($xml);
        if ($doc) {
            return true;
        } else {
            return false;
        }
    }

}