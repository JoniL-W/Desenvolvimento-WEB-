<?php

    abstract class htmlElement {

        private $name;
        private $id;
        private $style;

        public function getName() {
            return $this->name;
        }

        public function setName($sName) {
            $this->name = $sName;
        }

        public function getId() {
            return $this->id;
        }

        public function setId($sId) {
            $this->id = $sId;
        }

        public function getStyle() {
            if(isset($this->style) && $this->style != '') {
                return 'style="' . $this->style . '"';
            }
            return '';
        }

        public function setStyle($sStyle) {
            $this->style = $sStyle;
        }

        abstract function renderHtml();

    }

?>