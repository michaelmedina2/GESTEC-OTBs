<?php

class Library
{
    private $path;
    private $directory;
    private $css;
    private $js;
    private $class;

    public function __construct($path='')
    {
        $this->path      = $path;
		$this->directory = array();
		$this->js        = array();
        $this->css       = array();
        $this->class     = array();

        $this->loadDirectory();
        $this->loadLibraryJS();
        $this->loadStylus();
        $this->loadClass();
    }

    private function loadDirectory()
    {
        $this->directory['dir_path']    = $this->path;
		$this->directory['dir_class']   = $this->path . 'class/';
        $this->directory['dir_theme']   = $this->path . 'css/';
        $this->directory['dir_image']   = $this->path . 'img/';
        $this->directory['dir_js']      = $this->path . 'js/';
        $this->directory['dir_lang']    = $this->path . 'lang/';
        $this->directory['dir_module']  = $this->path . 'modulo/';
        $this->directory['dir_system']  = $this->path . 'system/';
        $this->directory['dir_upload']  = $this->path . 'upload/';
    }

    private function loadLibraryJS()
    {
        $directoryJS = $this->getDirectory('dir_js');
        $this->js['lib_jquery']      = $directoryJS . 'jquery.js';
		$this->js['lib_bootstrap']   = $directoryJS . 'bootstrap.min.js';
        $this->js['lib_dataTables1'] = $directoryJS . 'jquery.dataTables.min.js';
        $this->js['lib_dataTables2'] = $directoryJS . 'dataTables.bootstrap.min.js';
		$this->js['lib_dataTables3'] = $directoryJS . 'dataTables.responsive.min.js';
		$this->js['lib_jqueryui']    = $directoryJS . 'jquery-ui.js';        
		$this->js['lib_jvalidate']   = $directoryJS . 'jquery.validate.js';
		$this->js['lib_jscript']     = $directoryJS . 'script.js';
	}

    private function loadStylus()
    {
        $directoryCSS = $this->getDirectory('dir_theme');
		
		$this->css['css_bootstrap1'] = $directoryCSS . 'bootstrap.min.css';
		$this->css['css_bootstrap2'] = $directoryCSS . 'bootstrap-theme.min.css';
		$this->css['css_dataTable1'] = $directoryCSS . 'dataTables.bootstrap.min.css';
		$this->css['css_dataTable2'] = $directoryCSS . 'responsive.bootstrap.min.css';
		$this->css['css_jqueryui']   = $directoryCSS . 'jquery-ui.css';
		$this->css['css_style']      = $directoryCSS . 'style.css';
    }

    private function loadClass()
    {
        $directoryClassPHP = $this->getDirectory('dir_class');
		
		$this->class['class_login']     = $directoryClassPHP . 'login.class.php';
        $this->class['class_Session']   = $directoryClassPHP . 'sesion.class.php';
        $this->class['class_DBManager'] = $directoryClassPHP . 'dbmanager.class.php'; #manejador para postgres
        $this->class['class_Upload']    = $directoryClassPHP . 'upload.class.php';
		$this->class['class_FPDF']      = $directoryClassPHP . 'fpdf/fpdf.php';
    }

    public function getDirectory($nameDirectory) 
	{
        $pathDirectory = $this->directory[$nameDirectory];
        if($pathDirectory == '') 
		{
            $pathDirectory = $this->path;
        }
        return $pathDirectory;
    }

    public function getJS($nameLibraryJS) 
	{
        $pathJS = $this->js[$nameLibraryJS];
        if($pathJS == '') 
		{
            $pathJS = $this->path;
        }
        return $pathJS;
    }

    public function getCSS($nameCSS) 
	{
        $pathCSS = $this->css[$nameCSS];
        if($pathCSS == '') 
		{
            $pathCSS = $this->path;
        }
        return $pathCSS;
    }

    public function getClass($nameClass) 
	{
        $pathClass = $this->class[$nameClass];
        if($pathClass == '')
		{
            $pathClass = $this->path;
        }
        return $pathClass;
    }
}

?>
