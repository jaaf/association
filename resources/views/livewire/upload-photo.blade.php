
    <div x-data="{ isUploading: false, progress: 0 ,newFolder:false}" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress" class=" p-8 bg-gray-800 min-h-screen">
    <div class="  ">
        @foreach ($photos as $index => $photo)
            @if ($photo)
                <div class=" w-36 inline-block">
                    <img class="" src="{{ $photo->temporaryUrl() }}">
                </div>
            @endif
        @endforeach
    </div>

 @if(!$isModalOpen)
    <!-- File Input -->
    <input type="file" wire:model="photos" multiple name="photos" class="upload_input" id="upload{{ $iteration }}">

    @error('photos.*') <span class="error">{{ $message }}</span> @enderror


    <button class="select_button" wire:click=save()>Sauvegarder les images</button>
   
    <button wire:click="displayHelp()" class="select_button bg-green-200 text-yellow-800 ml-32">Afficher l'aide</button>
    @endif
    @if ($isModalOpen)
        <div class="flex items-center justify-center h-screen">

            @include('livewire.upload-help')

        </div>
    @endif


    <!-- Progress Bar -->
    <div class="  p-1 flex flex-col mt-1 progress_container">
        @foreach ($photos as $index => $photo)
            @if ($photo)
                <progress class=" w-full mt-1" max="100" x-bind:value="progress"></progress>
            @endif
        @endforeach
    </div>
    <div>

    </div>
    <div id="breadcrumb" class="flex flex-row breadcrumb mt-3 mb-3">
        @foreach ($breadcrumbs as $crumb)
            <button wire:click="selectFolder('{{ $crumb }}')"
                class="breadcrumb_button">{{ basename($crumb) }}</button>
            <div class="dir_button fa fa-caret-right fa-xs text-sm p-1"></div>
        @endforeach
        {{-- <input class=" text-xs" type="text" wire:model="new_dir_name"> --}}
        <button class="file_button ml-3" x-on:click="newFolder=true"> Nouveau dossier</button>
        <div x-show='newFolder'>
            <input class=" text-xs" type="text" wire:model="new_dir_name" placeholder="Saissez un nom">
            <button class="file_button ml-3" wire:click="createFolder()" x-on:click="newFolder=false"> Créer le
                dossier</button>
            <button class="file_button ml-3" x-on:click="newFolder=false"> Abandonner</button>
        </div>

    </div>
    <div id="current_dir_content">
        @foreach ($dirs as $dir)
            <div class="flex flex-row align-middle  mb-2">
                <div class=""><button wire:click="selectFolder('{{ $dir }}')"
                        class="dir_button fa fa-folder fa-xs  p-1">{{ basename($dir) }}</button></div>
                <button wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => 'Le dossier', 'ident' => $dir]) }})"
                    class=" dir_delete ml-1   text-white">X</button>
            </div>

        @endforeach





        @foreach ($files as $file)

            <div class=" image_container  mt-4 w-16 h-12 overflow-hidden  inline-block">
                <img class=" m-1 object-cover " src={{ Storage::url($file) }}>
                <div  wire:click="$emit('openModal','livewire-modal',{{ json_encode(['type' => 'L\'image', 'ident' => $file]) }})"
                    class="image_delete text-xs ">X
                </div>
            </div>


        @endforeach
    </div>


</div>
