<?php

class Librerias 
{    
    private $raiz;
    private $directorios;
    private $librerias;
    private $css;
    private $clases;
    
    public function __construct($rutaRaiz = '')
    {
        $this->raiz        = $rutaRaiz;
        
        $this->directorios = array();
        $this->librerias   = array();
        $this->css         = array();
        $this->clases      = array();
        
        $this->cargarDirectorios();
        $this->cargarLibrerias();
        $this->cargarEstilos();
        $this->cargarClases();
    }
    
    private function cargarDirectorios()
    {
        $this->directorios['dir_raiz']          = $this->raiz;
        $this->directorios['dir_configuracion'] = $this->raiz . 'config/';
        $this->directorios['dir_temas']         = $this->raiz . 'css/default/';
        $this->directorios['dir_imagenes']      = $this->raiz . 'img/';
        $this->directorios['dir_modulos']       = $this->raiz . 'admin/modules/';
        $this->directorios['dir_subida']        = $this->raiz . 'upload/';
        $this->directorios['dir_language']      = $this->raiz . 'language/';
        $this->directorios['dir_sistema']       = $this->raiz . 'system/';
        $this->directorios['dir_upload']        = $this->raiz . 'upload/';
        $this->directorios['dir_js']            = $this->raiz . 'js/';
        $this->directorios['dir_clases']        = $this->raiz . 'classes/';
    }
    
	/* Librerias Javascript */
    private function cargarLibrerias()
    {
        $dirLibJavascript = $this->getDirectorio('dir_js');               
        # jquery
        $this->librerias['lib_jquery']             = $dirLibJavascript . 'js/jquery.js';        
        # jquery-ui
        $this->librerias['lib_jquery_ui']          = $dirLibJavascript . 'jqueryui/jquery.ui.js';        
        # datatables
        //$this->librerias['lib_datatables']         = $dirLibJavascript . 'datatables/media/js/jquery.dataTables.js';       
        //$this->librerias['lib_datatables_cfilter'] = $dirLibJavascript . 'datatables/addons/jquery.dataTables.columnFilter.js';        
        # fancibox
        //$this->librerias['lib_jfancibox']          = $dirLibJavascript . 'jfancyBox/source/jquery.fancybox.pack.js';        
        # jshowoff
        //$this->librerias['lib_jshowoff']           = $dirLibJavascript . 'jshowoff/jquery.jshowoff.js';
		# jvalidate
		$this->librerias['lib_jvalidate']          = $dirLibJavascript . 'jvalidate/jquery.validate.js';
        # load-image
        $this->librerias['lib_load_image']          = $dirLibJavascript . 'loadimage/load-image.min.js';
		# jbannerSlider
		//$this->librerias['lib_jbannerSlider']      = $dirLibJavascript . 'jbannerSlider/slides.min.jquery.js';
		//$this->librerias['lib_scriptJBS']          = $dirLibJavascript . 'jbannerSlider/script.js';
		# jsmartwizard
		//$this->librerias['lib_jsmartwizard']       = $dirLibJavascript . 'jsmartwizard/js/jquery.smartWizard-2.0.min.js';
		//$this->librerias['lib_jquery1_4']          = $dirLibJavascript . 'jsmartwizard/js/jquery-1.4.2.min.js';
    }
    
    private function cargarEstilos()
    {
        $dirLibJavascript = $this->getDirectorio('dir_js');
        
        // jqueryui
        $this->css['css_jquery_ui']     = $dirLibJavascript . 'jqueryui/themes/base/jquery.ui.all.css';
        
        // datatables
        //$this->css['css_datatables']    = $dirLibJavascript . 'datatables/media/css/jquery.dataTables_themeroller.css';
        
        // jprojekktor
        //$this->css['css_jprojekktor']   = $dirLibJavascript . 'jprojekktor/theme/style.css';
        
        // fancibox
        //$this->css['css_jfancibox']     = $dirLibJavascript . 'jfancyBox/source/jquery.fancybox.css';
        
        // jshowoff
        //$this->css['css_jshowoff']      = $dirLibJavascript . 'jshowoff/jshowoff.css';
		# jbannerSlider
		//$this->css['css_jbannerSlider'] = $dirLibJavascript . 'jbannerSlider/style.css';
		# jsmartwizard
		//$this->css['css_jsmartwizard']  = $dirLibJavascript .'jsmartwizard/styles/smart_wizard.css';
		//$this->css['css_jsmartwizard']  = $dirLibJavascript .'jsmartwizard/styles/smart_wizard_vertical.css';
    }
    
    private function cargarClases()
    {
        $dirClassesPHP = $this->getDirectorio('dir_clases');
        
        $this->clases['class_Sesion']    = $dirClassesPHP . 'sesion.class.php';
        $this->clases['class_Conexion']  = $dirClassesPHP . 'conexion.class.php';
        $this->clases['class_DBManager'] = $dirClassesPHP . 'dbmanager.class.php'; #manejador para postgres
        $this->clases['class_Upload']    = $dirClassesPHP . 'upload.class.php';
		$this->clases['class_FPDF']      = $dirClassesPHP . 'fpdf/fpdf.php';
		$this->clases['class_MPDF']      = $dirClassesPHP . 'MPDF/mpdf.php';
    }
    
    public function getDirectorio($nombre) {
        $ruta = $this->directorios[$nombre];
        if($ruta == '') {
            $ruta = $this->raiz;
        }
        return $ruta;
    }

    public function getLibreria($nombre) {
        $ruta = $this->librerias[$nombre];
        if($ruta == '') {
            $ruta = $this->raiz;
        }
        return $ruta;
    }

    public function getCSS($nombre) {
        $ruta = $this->css[$nombre];
        if($ruta == '') { 
            $ruta = $this->raiz;
        }
        return $ruta;
    }

    public function getClase($nombre) {
        $ruta = $this->clases[$nombre];
        if($ruta == '') {
            $ruta = $this->raiz;
        }
        return $ruta;
    }
}
?>
