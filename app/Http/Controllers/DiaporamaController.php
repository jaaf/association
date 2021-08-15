<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiaporamaController extends Controller
{
  /**
     * Display the specified dir as slide showr
     *
     * @param  int  $post_id
     * @param  int $dir 
     * @return \Illuminate\Http\Response
     */
    public function show($post_id,$dir)
    {
        $dir=str_replace('-','/',$dir);
        $dirToScan= '../public/storage/photos/'.$dir;
        $base_dir =  '/storage/photos/'.$dir;
       
        $images=scandir($dirToScan);
        array_shift($images);//skip . and ..
        array_shift($images);
        $h=800;
        $w=1200;
        return view('diaporama', compact('images','base_dir','post_id','h','w'));
    }

}
