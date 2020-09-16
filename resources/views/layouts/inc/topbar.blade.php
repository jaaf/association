        <nav class="navbar navbar-expand-md  nav-bar-dark shadow-sm">
            <div class="container topbar">
                <div class="col-md-3">
                    <div id="contain-logo">
                      <div id="logo">
                       <a class="rounded" href="{{ url('/') }}">{{ config('app.name', '') }}</a>
                      </div>
                    </div>
                  </div>
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{'Se connecter'}}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{'Créer un compte' }}</a>
                                </li>
                            @endif
                        @else
                           @can('isAtLeastPhotoprovider') 
                                      <!-- Dropdown -->
                               <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle"
                                   href="#"
                                   id="navbardrop"
                                   data-toggle="dropdown">
                                   Administration
                                 </a>
                                 <div class="dropdown-menu">
                                    @can('isAtLeastWriter')
                                        <a class="dropdown-item" href="{{route('posts.index')}}">Articles</a>
                                   @endcan
                                   @can('isAtLeastManager')
                                        <a class="dropdown-item" href="{{route('infoletter.index')}}">Infoletters</a>
                                        <a class="dropdown-item"  href="{{route('adherent.index')}}">Adhérents</a>  
                                    @endcan
                                    @can('isAtLeastPhotoprovider')
                                        <a class="dropdown-item"  href="{{route('filemanager.index')}}">Fournir des photos(contraint)</a>
                                    @endcan
                                    @can('isAdmin')
                                    
                                        <a class="dropdown-item"  href="{{route('upload.index')}}">Fournir des photos(libre)</a>
                              
                                    @endcan
                                    <a class="dropdown-item"  href="{{route('home')}}">Retour à l'accueil</a> 
                                 </div>
                               </li>
                                

                            @endcan
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                   Bienvenue  {{ Auth::user()->firstname }}!  {{Auth::user()->familyname}}. 
                                   @can('isAtLeastPhotoprovider')
                                        Vous avez le rôle {{Auth::user()->role}}.
                                   @endcan
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ 'Se déconnecter' }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>