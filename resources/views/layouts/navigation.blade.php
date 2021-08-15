<nav x-data="{ open: false }" class=" bg-gray-900 text-gray-400 ">
    <!-- Primary Navigation Menu -->
    {{-- Same breakpoints as in layout --}}
    <div class="w-full  xl:w-10/12 2xl:w-8/12 3xl:w-6/12 mx-auto px-3">
        <div class="flex justify-between h-12 text-gray-300">
            <div class="flex relative">
              

                <!-- Navigation Links -->
                <div class="col-md-3 d-none d-lg-block">
                    <div id="contain-logo">
                        <div id="logo">
                            <a class="rounded" href="{{ url('/') }}">{{ config('app.name', '') }}</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Administration Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    @can('isAtLeastPhotoprovider')<x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center text-sm font-medium  hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                    <div>
                                        Administration
                                    </div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Post -->


                                @can('isAtLeastWriter')
                                    <x-dropdown-link :href="route('post')">
                                        Articles
                                    </x-dropdown-link>
                                @endcan

                                @can('isAtLeastManager')
                                    <x-dropdown-link :href="route('infoletter')">
                                        Info-lettres
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('adherent')">
                                        Adhérents
                                    </x-dropdown-link>
                                @endcan

                                @can('isAtLeastPhotoprovider')
                                    <x-dropdown-link :href="route('upload-photo')">
                                        Téleverser des photos
                                    </x-dropdown-link>
                                @endcan


                            </x-slot>
                        </x-dropdown>
                    @endcan
                @endauth
            </div>
            <!-- Login register Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="flex items-center text-sm font-medium  hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @else Invité
                                @endif
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Authentication -->
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                                                    this.closest('form').submit();">
                                    Se déconnecter
                                </x-dropdown-link>
                            </form>
                        @endauth
                        @guest
                            <x-dropdown-link :href="route('login')">
                                Se connecter
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                Créer un compte
                            </x-dropdown-link>
                        @endguest
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>


</nav>
