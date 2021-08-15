<?php


namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class UploadPhoto extends Component

{
    use WithFileUploads;

    public $photos = [];
    public $current_dir;
    public $new_dir_name;
    public $urls = [];
    public $files; //files and dirs in the current directory
    public $dirs; //directories in the current directory
    public $breadcrumbs = [];
    public $iteration;
    public $isModalOpen;
    public $folder_to_delete;
    public $user;

    protected $listeners = ['deleteFolder' => 'deleteFolder', 'deleteImage' => 'deleteImage'];


    public function mount()
    {
        $this->user = auth()->user();
        if ($this->user->role === 'admin') {
            $this->current_dir = 'public/photos/admin';
        } else {
            $this->current_dir = 'public/photos/admin/User-' . $this->user->id;
        }


        $this->refreshFolderView();        //dd($this->files);
        $this->isModalOpen = true;
    }

    public function displayHelp()
    {
        $this->isModalOpen = true;
    }

    public function hideHelp()
    {
        $this->isModalOpen = false;
    }
    public function createBreadcrumb($path)
    {
        $this->breadcrumbs = [];
        array_push($this->breadcrumbs, $path);
        $pos = strlen($path);
        while ($pos > 13) {
            $pos = strripos($path, '/');
            $path = substr($path, 0, $pos);
            array_push($this->breadcrumbs, $path);
        }

        array_pop($this->breadcrumbs);
        if ($this->user->role != 'admin') {
            array_pop($this->breadcrumbs);
        }
        $this->breadcrumbs = array_reverse($this->breadcrumbs);
    }
    public function refreshFolderView()
    {
        $usable_path = substr($this->current_dir, 14);
        $this->dirs = Storage::directories($this->current_dir);
        $this->files = Storage::files($this->current_dir);
        $this->createBreadcrumb($this->current_dir);
    }

    public function createFolder()
    {
        $matches = null;
        preg_match("#^[A-Za-z'àáâãäåçÈÉÊËÎÏÔÙÛÜYŶŸèéêëìíîïðòóôõöùúûüýÿ\d_\-]+$#", $this->new_dir_name, $matches);
        if ($matches) {
            $response = Storage::makeDirectory($this->current_dir . '/' . $this->new_dir_name);
            if ($response == true) {
                $this->message('success', 'Le dossier a été créé !');
                $this->refreshFolderView();
            } else {
                $this->message('error', 'Impossible de créer le dossier ! Vérifiez les droits d\'accés. ');
            }
        } else {
            $this->message('error', 'Désolé, le dossier n\'a pas été créé ! Son nom ne doit comprendre que des chiffres, des lettres et des tirets (- ou _).');
        }
    }

    public function selectFolder($folder)
    {

        $this->current_dir = $folder;
        $this->refreshFolderView();
    }


    public function clearInputs()
    {
        $this->new_dir_name = '';
        $this->photos = [];
    }

    public function save()
    {

        $this->validate([
            'photos.*' => 'image|max:8192', // 2MB Max
        ]);
        $relative_dir = substr($this->current_dir, 7); //remove public/
        foreach ($this->photos as $index => $photo) {
            $photo->storeAs($relative_dir, $photo->getClientOriginalName(), 'public');
            $this->photos[$index] = null;
            $this->iteration++;
        }
        $this->refreshFolderView();
    }
    public function deleteImage($file)
    {
        Storage::delete($file);
        $this->refreshFolderView();
        $this->message('success', 'Suppression réussie. Le fichier ' . $file . ' a été supprimé.');
    }
    public function deleteFolder($dir)
    {
        //dd($dir);
        Storage::deleteDirectory($dir);
        $this->refreshFolderView();
        $this->message('success', 'Suppression réussie. Le dossier ' . $dir . ' a été supprimé.');
    }

    public function render()
    {
        if (Gate::allows('isAtLeastPhotoprovider')) {
            return view('livewire.upload-photo')->layout('layouts.diapo');
        } else {
            abort(403);
        }
    }

    private function message($mode, $message)
    {
        $this->alert($mode, $message, [
            'position' =>  'center',
            'timer' =>  $mode === 'success' ? '3000' : '',
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  $mode === 'success' ? false : true,
        ]);
    }
}
