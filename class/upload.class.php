<?php

class Upload {

    /**
     *@La variable string contiene el nombre del archivo ha ser cargado.
     */
    var $FileName;
    /**
     *@La variable string contiene el nombre temporal del archivo ha ser cargado.
     */
    var $TempFileName;
    /**
     *@La variable string contiene el directorio donde los archivos deben ser cargados.
     */
    var $UploadDirectory;
    /**
     *@var string contains an array of valid extensions which are allowed to be uploaded.
     */
    var $ValidExtensions;
    /**
     *@La variable string contiene un mensaje que puede ser usado para la depuracion.
     */
    var $Message;
    /**
     *@La variable integer contiene el tamaño maximo de campos a ser cargados en bytes.
     */
    var $MaximumFileSize;
    /**
     *@La variable bool contiene si los archivos cargados son imagenes.
     */
    var $IsImage;
    /**
     *@La variable string contiene la direccion de correo electronico del receptor de diario de logs.
     */
    var $Email;
    /**
     *@La variable integer contiene el ancho maximo de imagenes a ser cargados.
     */
    var $MaximumWidth;
    /**
     *@La variable integer contiene la altura maxima de imagenes a ser cargados.
     */
    var $MaximumHeight;

    public function Upload()
    {

    }

    /**
     *@Metodo bool ValidateExtension() returns true/false si la extencion del archivo a ser cargado es valido o no
     *es permisible o no.
     *@return true si la extencion es valido.
     *@return false si la extencion es invalido.
     */
    public function ValidateExtension()
    {

        $FileName = trim($this->FileName);
        $FileParts = pathinfo($FileName);
        $Extension = strtolower($FileParts['extension']);
        $ValidExtensions = $this->ValidExtensions;

        if (!$FileName) {
            $this->SetMessage("ERROR: El nombre del archivo esta vacio.");
            return false;
        }

        if (!$ValidExtensions) {
            $this->SetMessage("WARNING: Todas las extenciones son validas.");
            return true;
        }

        if (in_array($Extension, $ValidExtensions)) {
            $this->SetMessage("MESSAGE: La extencion '$Extension' parece ser legitimo.");
            return true;
        } else {
            $this->SetMessage("Error: La extencion '$Extension' es invalido.");
            return false;
        }

    }

    /**
     *@Metodo bool ValidateSize() returns true/false si el tamaño del archivo es aceptable o  no.
     *@return true si el tamaño es mas pequeño que el valor.
     *@return false si el tamaño es mas grande que el valor.
     */
    public function ValidateSize()
    {
        $MaximumFileSize = $this->MaximumFileSize;
        $TempFileName = $this->GetTempName();
        $TempFileSize = filesize($TempFileName);

        if($MaximumFileSize == "") {
            $this->SetMessage("WARNING: No hay ninguna restricción de tamaño.");
            return true;
        }

        if ($MaximumFileSize <= $TempFileSize) {
            $this->SetMessage("ERROR: El archivo es demasiado grande. Debe ser menos que $MaximumFileSize y este es $TempFileSize.");
            return false;
        }

        $this->SetMessage("Message: El tamaño del archivo es menos que el $MaximumFileSize.");
        return true;
    }

    /**
     *@Metodo bool ValidateExistance() determina si el archivo ya existe. Si es asi, renombre $FileName.
     *@return true, nunca puede ser devuelto cuando todos los nombres de archivos deben ser únicos..
     *@return false, si el nombre del archivo no existe.
     */
    public function ValidateExistance()
    {
        $FileName = $this->FileName;
        $UploadDirectory = $this->UploadDirectory;
        $File = $UploadDirectory . $FileName;

        if (file_exists($File)) {
            $this->SetMessage("Message: El archivo '$FileName' ya existe.");
            $UniqueName = rand() . $FileName;
            $this->SetFileName($UniqueName);
            $this->ValidateExistance();
        } else {
            $this->SetMessage("Message: El nombre de archivo '$FileName' no existe.");
            return false;
        }
    }

    /**
     *@Metodo bool ValidateDirectory()
     *@return true el UploadDirectory existe, grabable, y tiene un corte de traling slash.
     *@return false el directoryo nunca se puso, no existe, o no es grabable.
     */
    public function ValidateDirectory()
    {
        $UploadDirectory = $this->UploadDirectory;

        if (!$UploadDirectory) {
            $this->SetMessage("ERROR: La variable de directorio está vacía.");
            return false;
        }

        if (!is_dir($UploadDirectory)) {
            $this->SetMessage("ERROR: El directorio '$UploadDirectory' no existe.");
            return false;
        }

        if (!is_writable($UploadDirectory)) {
            $this->SetMessage("ERROR: El directorio '$UploadDirectory' no es grabable.");
            return false;
        }

        if (substr($UploadDirectory, -1) != "/") {
            $this->SetMessage("ERROR: El corte de traling no existe (traling slash).");
            $NewDirectory = $UploadDirectory . "/";
            $this->SetUploadDirectory($NewDirectory);
            $this->ValidateDirectory();
        } else {
            $this->SetMessage("MESSAGE: El corte de traling Slash existe.");
            return true;
        }
    }

    /**
     *@Metodo bool ValidateImage()
     *@return true la imagen es mas pequeña que el alloted mide.
     *@return false el ancho y/o altura es mas grande entonces asignamos la dimencion.
     */
    public function ValidateImage() {
        $MaximumWidth = $this->MaximumWidth;
        $MaximumHeight = $this->MaximumHeight;
        $TempFileName = $this->TempFileName;

        if($Size = @getimagesize($TempFileName)) {
            $Width = $Size[0];   //$Width Es el ancho en pixeles de la imagen cargada al servidor.
            $Height = $Size[1];  //$Height Es la altura en pixeles de la imagen cargada al servidor.
        }

        if ($Width > $MaximumWidth) {
            $this->SetMessage("El ancho de la imagen [$Width] excede la cantidad maxima [$MaximumWidth].");
            return false;
        }

        if ($Height > $MaximumHeight) {
            $this->SetMessage("La altura de la imagen [$Height] excede la cantidad maxima [$MaximumHeight].");
            return false;
        }

        $this->SetMessage("La altura de la imagen [$Height] y el ancho [$Width] estan dentro de sus limitaciones.");
        return true;
    }

    /**
     *@Metodo bool SendMail() envia un correo electronico log a el administrador
     *@return true el correo electronico a sido enviado o transmitido.
     *@return false nunca fue enviado.
     *@todo crea un log mas information-friendly.
     */
    public function SendMail() {
        $To = $this->Email;
        $Subject = "File Uploaded";               //Cargar el archivo
        $From = "De: Uploader";                   //de cargado
        $Message = "Un archivo ha sido cargado."; //Un archivo ha sido cargado
        mail($To, $Subject, $Message, $From);
        return true;
    }


    /**
     *@method bool UploadFile() carga el archivo al servidor después de pasar todas las validaciones.
     *@return true el archivo fue cargado.
     *@return false la cargada Falló.
     */
    public function UploadFile()
    {

        if (!$this->ValidateExtension()) {
            die($this->GetMessage());
        }

        else if (!$this->ValidateSize()) {
            die($this->GetMessage());
        }

        else if ($this->ValidateExistance()) {
            die($this->GetMessage());
        }

        else if (!$this->ValidateDirectory()) {
            die($this->GetMessage());
        }
        /*
        else if ($this->IsImage && !$this->ValidateImage()) {
            die($this->GetMessage());
        }
        */
        else {

            $FileName = $this->FileName;
            $TempFileName = $this->TempFileName;
            $UploadDirectory = $this->UploadDirectory;

            if (is_uploaded_file($TempFileName)) {
                move_uploaded_file($TempFileName, $UploadDirectory . $FileName);
                return "";
            } else {
                return "";
            }

        }

    }

    #Accessors and Mutators más allá de este punto.
    #La documentación de Siginificant no es necesitada.
    public function SetFileName($argv)
    {
        $this->FileName = $argv;
    }

    public function SetUploadDirectory($argv)
    {
        $this->UploadDirectory = $argv;
    }

    public function SetTempName($argv)
    {
        $this->TempFileName = $argv;
    }

    public function SetValidExtensions($argv)
    {
        $this->ValidExtensions = $argv;
    }

    public function SetMessage($argv)
    {
        $this->Message = $argv;
    }

    public function SetMaximumFileSize($argv)
    {
        $this->MaximumFileSize = $argv;
    }

    public function SetEmail($argv)
    {
        $this->Email = $argv;
    }

    public function SetIsImage($argv)
    {
        $this->IsImage = $argv;
    }

    public function SetMaximumWidth($argv)
    {
        $this->MaximumWidth = $argv;
    }

    public function SetMaximumHeight($argv)
    {
        $this->MaximumHeight = $argv;
    }
    
    public function GetFileName()
    {
        return $this->FileName;
    }

    public function GetUploadDirectory()
    {
        return $this->UploadDirectory;
    }

    public function GetTempName()
    {
        return $this->TempFileName;
    }

    public function GetValidExtensions()
    {
        return $this->ValidExtensions;
    }

    public function GetMessage()
    {
        if (!isset($this->Message)) {
            $this->SetMessage("No Mensaje");
        }

        return $this->Message;
    }

    public function GetMaximumFileSize()
    {
        return $this->MaximumFileSize;
    }

    public function GetEmail()
    {
        return $this->Email;
    }

    public function GetIsImage()
    {
        return $this->IsImage;
    }

    public function GetMaximumWidth()
    {
        return $this->MaximumWidth;
    }

    public function GetMaximumHeight()
    {
        return $this->MaximumHeight;
    }
    
    public function configUpload($tam_max='100M', $carga_tam_max_file='100M', $time_max_exec='1000', $time_input_max='1000')
    {
        ini_set('post_max_size',$tam_max);
        ini_set('upload_max_filesize',$carga_tam_max_file);
        ini_set('max_execution_time',$time_max_exec);
        ini_set('max_input_time',$time_input_max);
    }
    
}

?>