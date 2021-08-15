<div class="w-full mx-auto px-5 border-2 border-white rounded-xl ">
    <div class="my-1 text-2xl text-center text-white"><strong>AGENDA</strong>
    </div> 
    <div class="shadow-md ">
        @foreach ($events as $index => $event)
            <div class="tab w-full overflow-hidden border-t bg-yellow-50 rounded-xl mb-1">
                <input class="absolute opacity-0" id="tab-single-{{ $index }}" type="radio" name="tabs2"
                    .{{ $index }}>
                <label class="block p-5 leading-normal cursor-pointer"
                    for="tab-single-{{$index}}">{{ $event->title }}</label>
                <div class="tab-content  overflow-hidden text-justify break-words p-2 border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                    <div class="p-5">{!! Markdown::parse($event->abstract) !!}</div>
                    <div class="p-4 ml-3 mr-3 text-indigo-500 border-t-2 border-indigo-500 "><a href="/post/{{ $event->id }}">Lire l'article</a></div>
                    <div class="p-4 ml-3 mr-3 text-indigo-500 border-t-2 border-indigo-500"><a href="/registration/{{ $event->id }}">S'inscrire à
                            l'événement</a>
                    </div>

                </div>
            </div>
        @endforeach

        
    </div>
</div>
<script>
    /* Optional Javascript to close the radio button version by clicking it again */
    var myRadios = document.getElementsByName('tabs2');
    var setCheck;
    var x = 0;
    for (x = 0; x < myRadios.length; x++) {
        myRadios[x].onclick = function() {
            if (setCheck != this) {
                setCheck = this;
            } else {
                this.checked = false;
                setCheck = null;
            }
        };
    }
</script>
