<x-diapo-layout>





    <div x-data='{cpt: 0}' class="flex flex-col envel">
        <div class="sub-envel flex flex-col flex-shrink">
            <div id="slideshow" style="width: {{$w}}px;height:{{$h}}px">

                <div class="slide-wrapper" style="width: {{$w}}px;height:{{$h}}px" id='wrapper'>
                    @foreach ($images as $index => $image)

                        <div x-bind:class=" cpt>{{ $index }}? ' hidden' : ''"  style="width: {{$w}}px;height:{{$h}}px">
                            <img class=" object-scale-down"
                                src="{{ $base_dir }}/{{ $image }}" alt="First slide" />
                        </div>
                
                    @endforeach


                </div>
            </div>
            <div class="slide-button-line w-full mb-1 ">
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


    </div>

</x-diapo-layout>
