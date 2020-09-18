      <div class="container topbar z-index=100 ">
          <nav class="navbar navbar-expand-sm  ">

              {{-- With d-none d-lg-block logo hides on screen smaller than lg
              --}}
              <div class="col-md-3 d-none d-lg-block">
                  <div id="contain-logo">
                      <div id="logo">
                          <a class="rounded" href="{{ url('/') }}">{{ config('app.name', '') }}</a>
                      </div>
                  </div>
              </div>


              <!-- with ml-auto item align on right Side Of Navbar -->
              <ul class="navbar-nav ml-auto" z-index=100>
                  <!-- Authentication Links -->
                  @guest
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('login') }}">{{ 'Se connecter' }}</a>
                      </li>
                      @if (Route::has('register'))
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('register') }}">{{ 'Créer un compte' }}</a>
                          </li>
                      @endif
                  @else
                      @can('isAtLeastPhotoprovider')
                          <!-- Dropdown -->
                          <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                                  Administration
                              </a>
                              <div class="dropdown-menu">
                                  @can('isAtLeastWriter')
                                      <a class="dropdown-item" href="{{ route('posts.index') }}">Articles</a>
                                  @endcan
                                  @can('isAtLeastManager')
                                      <a class="dropdown-item" href="{{ route('infoletter.index') }}">Infoletters</a>
                                      <a class="dropdown-item" href="{{ route('adherent.index') }}">Adhérents</a>
                                  @endcan
                                  @can('isAtLeastPhotoprovider')
                                      <a class="dropdown-item" href="{{ route('filemanager.index') }}">Fournir des
                                          photos(contraint)</a>
                                  @endcan
                                  @can('isAdmin')

                                      <a class="dropdown-item" href="{{ route('upload.index') }}">Fournir des
                                          photos(libre)</a>

                                  @endcan
                                  <a class="dropdown-item" href="{{ route('home') }}">Retour à l'accueil</a>
                              </div>
                          </li>


                      @endcan
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbardrop2" data-toggle="dropdown">
                              Bienvenue {{ Auth::user()->firstname }} {{ Auth::user()->familyname }} !
                              @can('isAtLeastPhotoprovider')
                                  {{--Vous avez le rôle
                                  {{ Auth::user()->role }}.--}}
                              @endcan
                          </a>

                          <div class="dropdown-menu ">
                              <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                         document.getElementById('logout-form').submit();">
                                  {{ 'Se déconnecter' }}
                              </a>
                          </div>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                          </form>
                      </li>
                  @endguest
              </ul>
      </div>
      </div>
      </nav>
