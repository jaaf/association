<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class FilemanagerController extends Controller
{

    public static function formatTime($timestamp)
    {
        return (date("d/m/y", $timestamp));
    }

    private static function sortDir($files)
    {
        $dirs = array();
        $results = array();

        foreach ($files as $file) {
            if ($file['is_dir']) {
                array_push($dirs, $file);
            } else {
                array_push($results, $file);
            }
        }
        return array_merge($dirs, $results);
    }

    public function listDir($dir)
    {
        if (is_dir($dir)) {
            $directory = $dir;
            $result = array();
            $files = array_diff(scandir($directory), array('.', '..'));

            foreach ($files as $file) {
                $fullPath = $directory . '/' . $file;
                //on recherche les infos sur le fichier
                $filestat = stat($fullPath);
                $result[] = array(
                    'mtime' => $this->formatTime($filestat['mtime']),
                    //'size' => self::formatSize($filestat['size']),
                    'size' => $filestat['size'],
                    'name' => basename($fullPath),
                    'path' => preg_replace('@^\./@', '', $fullPath),
                    'is_dir' => is_dir($fullPath),
                    'is_readable' => is_readable($fullPath),
                    'is_writable' => is_writable($fullPath),
                    'is_executable' => is_executable($fullPath),
                    'is_deleteable' => true,
                );
            }
        } else {

            return (array('message' => 'Ce n\'est pas un dossier'));
        }
        return (array(
            'success' => true,
            'dir' => $dir,
            'is_writable' => is_writable($directory),
            'results' => $this->sortDir($result)
        ));
    }

    public function createDir($currentDir, $newDir)
    {
        $nD = trim($newDir);
        // $nD=$newDir;
        $cD = trim($currentDir);

        if (!file_exists($cD . '/' . $nD) and mkdir($cD . '/' . $nD)) {
            return (array('success' => true, 'message' => 'Le dossier ' . $cD . '/' . $nD . ' a été créé.'));
        } else {
            return (array('success' => false, 'message' => 'Problème! Le dossier ' . $cD . '/' . $nD . ' n\'a pu être créé. Vérifiez que ce dernier n\'existe pas déjà.'));
        }
    }
    public function deleteFile($filename)
    {
        if (!is_dir($filename)) {
            if (unlink($filename)) {
                return ['message' => 'Fichier correctement effacé'];
            } else {
                return ['message' => 'Échec de l\'effacement du fichier. Vérifier les permissions'];
            }
        }
        if (is_dir($filename) && count(scandir($filename)) == 2) {
            if (rmdir($filename)) {
                return ['message' => 'Dossier correctement effacé'];
            } else {
                return ['message' => 'Échec de l\'effacement du dossier. Vérifier les permissions'];
            }
        } else {
            return ['vide' => false, 'message' => 'Ce dossier n\'est pas vide. Effacement impossible'];
        }
    }



    public function manage(Request $request)
    {
        Log::debug('--------------------------------------');
        Log::debug('Receiving a  request in manage (start)');

        if ($request->ajax()) {
            //if ($request->isXmlHttpRequest()) {
            Log::debug('Receiving an AJAX request');
            $data = $request->input('to_do');
            Log::debug('Receiving an ajax request with ' . $data);
            $dir = $request->input('dir');
            switch ($data) {
                case 'list':
                    Log::debug('filemanager request for listing a dir ' . $request->input('new_dir'));
                    $response = $this->listDir($dir);
                    break;
                case 'delete':
                    $response = $this->deleteFile($request->input('filename'));
                    break;
                case 'mkdir':
                    Log::debug('filemanager request for creating a dir ' . $request->input('new_dir'));
                    $response = $this->createDir(
                        $request->input('current_dir'),
                        $request->input('new_dir')
                    );
                    break;
                case 'upload':
                    break;
                case 'upload_resize':
                    $fullName = $request->input('folder') . DIRECTORY_SEPARATOR . $request->input('filename');
                    $pos = strrpos($fullName, '.');
                    $fullName = substr($fullName, 0, $pos) . '.jpeg';

                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data); //return the length
                    //return the nb of char stored
                    $success = file_put_contents($fullName, $data);
                    $message = $success
                        ? 'File saved --' . $success . ' bytes'
                        : 'Unable to save the file.';
                    $response = array('message' => $message);
                    break;
            }
            //$resp=new Response(json_encode($response));$request->input('to_do');
            // return ($resp);
            //return response($response);
            return response()->json($response);
        } else {
            Log::debug('filemanager dealing wih NON AJAX request for' . $request->input('to_do'));
            return "not an ajax request";
        }
    }

    public function index(Request $request)
    {
        Log::debug('Entering index function in filemanager');





        $user = auth()->user();
        $user_id = $user->id;
        //the parameter "upload_directory" is set in config/services.yaml
        if (Gate::allows('isAdmin', $user)) {
            $destination_dir = public_path() . '/storage/photos/admin';
        } else {
            $destination_dir = public_path() . '/storage/photos/admin/' . $user_id;
        }


        if (!is_dir($destination_dir)) {
            mkdir($destination_dir, 0770, true);
        }
        //$route = DIRECTORY_SEPARATOR.$request->attributes->get('_route');
        //$route = DIRECTORY_SEPARATOR.$request->attributes->get('_route_params');
        $actionUrl = "/filemanager";

        $currentDir = $destination_dir;
        $actionUrl = $actionUrl;
        return view('filemanager.main', compact('currentDir', 'actionUrl'));
    }
}
