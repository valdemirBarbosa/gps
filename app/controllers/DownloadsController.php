<?php
namespace app\controllers;
use app\core\Controller;
use app\models\Upload_Model;

class DownloadsController extends Controller{
  public function index(){
    if ($handle = opendir($_GET['path'])) {
      while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
              //echo "<a href='".$entry."'>".$entry."</a>\n";
          }
      }
      closedir($handle);
   }

   $file = basename($_GET['file']);
   $file = $_GET['path'].$file;
   
   if(!file_exists($file)){ // file does not exist
         die('file not found');
   } else {
         header("Cache-Control: public");
         header("Content-Description: File Transfer");
         header("Content-Disposition: attachment; filename=$file");
         header("Content-Type: application/zip");
         header("Content-Transfer-Encoding: binary");
   
      // read the file from disk
      readfile($file);
   }
   }
}
