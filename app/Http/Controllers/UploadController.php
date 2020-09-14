<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;




class UploadController extends Controller
{

    public function index(){

        return view('upload.index');
    }
    public function upload(Request $request){
        //dd($request);
        $destination=$request->input('destination');
        
        $files=$request->file('files');
        foreach ($files as $file){
            $name=$file->getClientOriginalName();
            if ($request->input('disk')=='public'){
                $file->storeAs($destination,$name,'public');
            } else{
                $file->storeAs($destination,$name);
            }
            
        }
    return view('upload.index');

    }
}
