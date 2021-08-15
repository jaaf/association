<nav class=" bg-gray-800 border-white rounded-lg text-gray-400 mb-6">{{-- w-full xl:w-11/12 2xl:w-10/12 3xl:w-9/12--}}
    <!-- Primary Navigation Menu -->
    <div class="w-full     ">
        <div class=" flex flex-col md:flex-row sm:justify-evenly text-gray-300  w-full">
            <div class="">


                <!-- Navigation Links -->
                <div class="hidden  p-3 space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a class="fa-torii-gate fas  text-xl focus:text-red-200 hover:text-yellow-200 "  data-toggle="tooltip" title="Vers la page d'accueil" href="{{route('home')}}">
                        <span class="text-sm"></span> 
                    </a>

                </div>
            </div>

            <!-- History Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-yellow-200 hover:border-gray-300 focus:outline-none 
                            focus:text-red-200 focus:border-red-200 transition duration-150 ease-in-out
                             nav-button">
                            <div>
                                Historique
                            </div>

                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Post -->
                        <x-dropdown-link :href="route('post.list','2011')">
                            2011
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2012')">
                            2012
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2013')">
                            2013
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2014')">
                            2014
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2015')">
                            2015
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2016')">
                            2016
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2017')">
                            2017
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2018')">
                            2018
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2019')">
                            2019
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('post.list','2020')">
                            2020
                        </x-dropdown-link>{{--  --}}
                    </x-slot>
                </x-dropdown>

            </div>
            <!-- Association Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-yellow-200 hover:border-gray-300 
                            focus:outline-none focus:text-red-200 focus:border-gray-300 transition duration-150 ease-in-out
                             nav-button">
                            <div>
                                Association
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href=" route('who-to-contact') ">
                            Personnes à contacter
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('show-activities') ">
                            Activités
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('post.show', ['id' => 135]) ">
                            Documents statutaires
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('show-adherent')">
                            Liste des adhérents
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Culture Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-yellow-200 hover:border-gray-300 focus:outline-none 
                             focus:text-red-200 focus:border-gray-300 transition duration-150 ease-in-out nav-button">
                            <div>
                                Culture
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href=" route('post.show', ['id' => 136]) ">
                            Culture informatique
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('post.show', ['id' => 137]) ">
                            Jeux
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Ce site Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-yellow-200 hover:border-gray-300 
                            focus:outline-none focus:text-red-200 focus:border-gray-300 transition duration-150 ease-in-out
                              nav-button">
                            <div>
                                Ce site
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href=" route('post.show', ['id' => 139]) ">
                            À propos de ce site
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('post.show', ['id' => 138]) ">
                            Aspects techniques de ce site
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('post.show', ['id' => 140]) ">
                            Utiliser ce site efficacement
                        </x-dropdown-link>
                      
                    </x-slot>
                </x-dropdown>
            </div >
             <!-- Contact Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-yellow-200 hover:border-gray-300 
                            focus:outline-none focus:text-red-200 focus:border-gray-300 transition duration-150 ease-in-out
                              nav-button">
                            <div>
                               Contacts
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                         <x-dropdown-link :href=" route('who-to-contact') ">
                            Personnes à contacter
                        </x-dropdown-link>
                        <x-dropdown-link :href=" route('contact') ">
                            Laissez-nous un message
                        </x-dropdown-link>
                        
                    </x-slot>
                </x-dropdown>
            </div >
          
            
        </div>



    </div>

</nav>
