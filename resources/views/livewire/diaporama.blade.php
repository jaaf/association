<div x-data='{cpt: 0,help:false}' class="flex flex-col envel"> 
    <div x-show="help==true" class="fixed top-24 left-5 bg-black text-white w-1/3 p-5">
        <div>
            <p>Le défilement des images est manuel. Utilisez les boutons en forme de chevrons sous l'image.</p>
            <p>
                La première chose que vous devez faire, c'est de choisir la plus grande échelle vous permettant
                d'afficher à la fois
                l'image ainsi que la ligne des boutons en chevrons et la ligne des vignettes qui doivent être placées
                dessous.
            </p>
            <p>Sur de très grands écrans vous pouvez être tenté de choisir un échelle supérieure à 1. Sachez que dans ce
                cas l'image risque d'être dilatée par rapport à sa taille normale et d'être moins nette.</p>
            <p>Les vignettes ne sont pas indispensables. Elles permettent surtout de rechercher rapidement une image. En
                cliquant à chaque fois sur la dernière pour défiler toute une liste d'images.</p>


        </div>
        <div>
            <p class=" text-yellow-200">L'échelle actuelle est : {{ $facteur }}</p>
        </div>
        <label for="facteur" class="form-field-title">Choisir l'échelle</label>
        <select class="form-field" wire:model="facteur">
            <option value="1.8">x 1,8</option>
            <option value="1.7">x 1,7</option>
            <option value="1.6">x 1,6</option>
            <option value="1.5">x 1,5</option>
            <option value="1.4">x 1,4</option>
            <option value="1.3">x 1,3</option>
            <option value="1.2">x 1,2</option>
            <option value="1.1">x 1,1</option>
            <option value="1">x 1</option>
            <option value="0.9">x 0.9</option>
            <option value="0.8">x 0.8</option>
            <option value="0.7">x 0.7</option>
        </select>
        <p> Ensuite vous pouvez utiliser les boutons chevrons pour avancer ou reculer dans la liste des images. Le
            bouton central en forme de double
            chevron vous permet de revenir sur la première image.</p>
        <p>Vous pouvez également cliquer sur une vignette pour afficher directement l'image. La ligne des vignettes
            défile alors pour se caler sur cette image en première position.</p>

        <div>
            <button x-on:click="help=help==true? false: true"
                class=" bg-green-600 text-gray-50  mt-2 p-1 border rounded-smfa ">Fermer ce dialogue<button>
        </div>
    </div>
    <div class="fixed top-4 left-5 flex flex-col">
        <a href="/post/{{ $post_id }}" class="text-gray-50 text-4xl fa fa-arrow-left fa-xs"></a>
        <button x-on:click="help=help==true? false: true" class="text-gray-50 pt-2 border-2 p-2 rounded-md mt-2">Aide et
            réglages<button>
    </div>

{{$base_dir}}    
    <div class="sub-envel flex flex-col flex-shrink">
        {{--  --}}
        <div id="slideshow" style="width: {{ $w * $facteur }}px;height:{{ $h * $facteur }}px">

            <div class="slide-wrapper" id='wrapper'>
                @foreach ($images as $index => $image)
                    {{-- If image number is less than the counter cpt make it hidden --}}
                    <div x-bind:class=" cpt>{{ $index }}? ' hidden' : ''">
                        <img class=" object-fit" width="{{ $w * $facteur }}" height="{{ $h * $facteur }}"
                            src="{{ $base_dir }}/{{ $image }}" alt="First slide" />
                    </div>

                @endforeach


            </div>
        </div>
        <div class="slide-button-line w-full mb-1 flex ">
            <button
                x-bind:class="cpt>0? 'slide-button text-gray-50 fa fa-angle-left fa-xs':' text-black slide-button  fa fa-angle-left fa-xs'"
                x-on:click="cpt=cpt-1;" class="slide-button  fa fa-angle-double-left fa-xs"></button>
            <button x-on:click="cpt=0;" class="slide-button text-gray-50 fa fa-angle-double-left fa-xs"></button>
            <button x-on:click="cpt=cpt+1;" class=" slide-button text-gray-50  fa fa-angle-right fa-xs"></button>

        </div>
    </div>

    <div id="thumbshow" flex flex-row>

        <div class="thumb-wrapper" id='thumb-wrapper'>
            @foreach ($images as $index => $image)

                <div x-bind:class=" cpt>{{ $index }}? 'thumb hidden' : 'thumb'"
                    x-on:click="cpt={{ $index }}"><img src="{{ $base_dir }}/{{ $image }}"
                        alt="First slide" />
                </div>
            @endforeach


        </div>
    </div>

    <script>

     
    </script>
</div>
