<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;




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
            Log::debug('in UploadController@upload $name is '.$name);
            if ($request->input('disk')=='public'){
                $file->storeAs($destination,$name,'public');
            } else{
                $file->storeAs($destination,$name);
            }
            
        }
    return view('upload.index');

    }
}
