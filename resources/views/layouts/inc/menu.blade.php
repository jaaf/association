<div class="container">
    <nav class="navbar navbar-expand-sm  ">
      <!-- Brand -->
      <!--<a class="navbar-brand" href="#">Logo</a>-->

      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
            href="#"
            id="navbardrop"
            data-toggle="dropdown">
            Récits
          </a>
          <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2011])}}">2011</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2012])}}">2012</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2013])}}">2013</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2014])}}">2014</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2015])}}">2015</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2016])}}">2016</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2017])}}">2017</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2018])}}">2018</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2019])}}">2019</a>
            <a class="dropdown-item" href="{{route('posts.narratives',['year'=>2020])}}">2020</a>
          </div>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
            href="#"
            id="navbardrop"
            data-toggle="dropdown">
            Association
          </a>
          <div class="dropdown-menu">
          <a class="dropdown-item" href="{{route('posts.show',['post'=>133])}}">Personnes à contacter</a>
            <a class="dropdown-item" href="{{route('posts.show',['post'=>134])}}">Activités</a>
            <a class="dropdown-item" href="{{route('posts.show',['post'=>135])}}">Documents statutaires</a>
            {{--<a class="dropdown-item" href="">Liste des adhérents</a>--}}
            {{--<a class="dropdown-item" href="#">Enquêtes ouvertes</a>--}}
          </div>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
            href="#"
            id="navbardrop"
            data-toggle="dropdown">
            Culture
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{route('posts.show',['post'=>136])}}">Culture informatique</a>
            <a class="dropdown-item" href="{{route('posts.show',['post'=>137])}}">Jeux</a>
         
          </div>
        </li>
        <!-- Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"
            href="#"
            id="navbardrop"
            data-toggle="dropdown">
            Ce site
          </a>
          <div class="dropdown-menu">
          <a class="dropdown-item"href="{{route('posts.show',['post'=>139])}}">À propos de ce site</a>
            <a class="dropdown-item"href="{{route('posts.show',['post'=>138])}}">Aspects techniques de ce site</a>
            <a class="dropdown-item"href="{{route('posts.show',['post'=>140])}}">Utiliser ce site efficacement</a>
            <a class="dropdown-item"href="{{route('posts.show',['post'=>142])}}">Accédez aux vidéos et documents en téléchargement</a>
          </div>
        </li>

        <li class="nav-item"><a class="nav-link" href="contact">Contacts</a></li>
      </ul>
    </nav>
  </div>