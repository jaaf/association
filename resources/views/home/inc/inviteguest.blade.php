<div class="card">
                <div class="card-header">{{ 'Connexion'}}</div>
                <div class="light">
                <p> En tant qu'invité, vous ne pouvez voir que l'agenda et les liens utiles. Vous ne pourrez pas naviguer sur le site.</p>
                   <p>Pour accéder au reste du site, vous devez <strong>avoir un compte</strong> sur ce dernier et <strong>vous connecter</strong>. <p>
                   <p>Si vous n'avez pas de compte, vous pouvez en créer un en cliquant sur <strong>Créer un compte</strong> dans le bandeau supérieur.</p>
                    <p>Sachez que cela est très simple et ne prend que quelques minutes. </p>
                    
                </div>
                <div class="card-body">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{'Connexion'}}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{'Mot de passe oublié' }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>