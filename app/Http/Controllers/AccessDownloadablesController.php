<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessDownloadablesController extends Controller
{
     public function display($file){
        $path="storage".DIRECTORY_SEPARATOR."downloadables".DIRECTORY_SEPARATOR.$file;
        
     /*   $ext=pathinfo($file)['extension'];
        switch ($ext) {
            case 'mp4':
                $type='video/mp4';
                break;
            case 'ogv':
                $type='video/ogg';
                break;
           
        }

    dd($ext);*/
        return response()->file($path);
    }

    public function download($file){
        $path="storage".DIRECTORY_SEPARATOR."downloadables".DIRECTORY_SEPARATOR.$file;
      /*  $a=pathinfo($file);
        $ext=$a['extension'];
        $type="";
        switch ($ext) {
            case 'mp4':
                $type='video/mp4';
                break;
            case 'ogv':
                $type='video/ogg';
                break;
           
        }
        dd($type);*/
        return response()->download($path);
    }
}
