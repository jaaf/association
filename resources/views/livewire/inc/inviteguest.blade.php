<div class="w-full mx-auto mt-5 p-5 text-white border-2 border-white rounded-xl ">
               
                <div class="light">
                    <p>Si vous lisez ce texte, c'est que vous n'êtes pas connecté et que vous êtes considéré comme un « invité ».</p>
                <p> En tant qu'invité, vous ne pourrez accéder à toutes les pages du site.</p>
                <p>Si vous n'êtes pas connecté et que vous cherchez à consulter une page réservée aux membres enregistrés, vous êtes automatiquement conduit sur le formulaire 
                    de connexion.
                </p>
                   <p>Pour accéder au reste du site, vous devez <strong>avoir un compte</strong> sur ce dernier et <strong>vous connecter</strong>. <p>
                   <p>Si vous n'avez pas de compte, vous pouvez en créer un en cliquant sur <strong>Créer un compte</strong> dans le bandeau supérieur ou en bas de cette encart.</p>
                    <p>Sachez que cela est très simple,  et ne prend que quelques minutes. </p>
                    <p>De plus, le fait d'être enregistré sur le site, vous perment de recevoir les lettres d'information de l'association pour vous prévenir de l'occurence d'un nouvel événement.</p>
                    
                </div> 
               
                <div class=" bg-gray-400 p-2 text-black mt-5">
                     <div class="text-2xl text-white">
                            Formulaire de connexion
                        </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{'Adresse électronique' }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{'Mot de passe'}}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{'Se souvenir de moi'}}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class=" mb-0">
                            <div class="flex flex-col">
                                <button type="submit" class=" mr-auto bg-green-400 border-2 border-green-800 p-1 rounded">
                                    {{'Connexion'}}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="italic text-indigo-500" href="{{ route('password.request') }}">
                                        {{'Réinitialiser le mot de passe' }}
                                    </a>
                                @endif
                                <a class="italic text-indigo-500" href="{{ route('register') }}">
                                        {{'Créer un compte' }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>