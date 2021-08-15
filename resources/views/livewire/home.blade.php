<div class=" ml-auto mr-auto p-10 w-full">
    <div class="row flex flex-col lg:flex-row ">
        <div class="  flex flex-col w-full lg:w-4/12 pr-2 ">
            @include('livewire.inc.agenda')
            @include('livewire.inc.liens')
          @include('livewire.inc.howto')
        </div>
        <div class="  flex flex-col w-full lg:w-8/12  my-col ">
             
            @auth
              @include('livewire.inc.maincol')
            @endauth
            @guest
             @include('livewire.inc.inviteguest')

            @endguest
        </div>
    </div>
</div>

