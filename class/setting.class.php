<?php

    class Setting
    {
        private $_titleWeb;
        private $_logoMenu;
        private $_logoLogin;

        public function __construct()
        {
            $this->_titleWeb  = ".::: GOTB :::.";
            $this->_logoMenu  = "../../img/logoGestec-OTB.png";
            $this->_logoLogin = "img/logoLogin.png";
        }

        public function getTitle()
        {
            return $this->_titleWeb;
        }

        public function getLogoMenu()
        {
            return $this->_logoMenu;
        }

        public function getLogoLogin()
        {
            return $this->_logoLogin;
        }
    }

?>
