<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UFF | Trabalho de Projeto de Software">
    <meta name="author" content="Caio Wey, Igor Lisboa">
    <title>{{env('APP_NAME')}}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="app">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="{{url('/')}}">{{env('APP_NAME')}}</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= (request()->routeIs('home') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('home') ?>">Home</a>
                    </li>
                    @auth
                    @if(auth()->user()->manager)
                    <li class="nav-item <?= (request()->routeIs('manager.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('manager.index') ?>">Gerentes</a>
                    </li>
                    @endif
                    @endif
                </ul>
                @auth
                <form method="POST" class="form-inline mt-2 mt-md-0" onsubmit="return confirm('<?= __('msg_logout_confirm') ?>')" action="<?= route('logout') ?>">
                    @csrf
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">{{auth()->user()->name}} - Sair</button>
                </form>
                @else
                <a class="btn btn-outline-info my-2 my-sm-0" href="<?= route('login') ?>">Login</a>
                @endif
            </div>
        </nav>
    </header>

    <main role="main" style="margin-top: 100px;">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @yield('content')
        <!-- FOOTER -->
        <footer class="container">
            <p class="float-right"><a href="#">Back to top</a></p>
            <p>© 2017-2020 Company, Inc. · <a href="#">Privacy</a> · <a href="#">Terms</a></p>
        </footer>
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            setInterval(keepTokenAlive, 1000 * 60 * 15); // every 15 mins

            function keepTokenAlive() {
                $.ajax({
                    url: '/keep-token-alive', //https://stackoverflow.com/q/31449434/470749
                    method: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(function(result) {
                    console.log(new Date() + $('meta[name="csrf-token"]').attr('content'));
                }).fail(function(err) {
                    window.location.reload();
                });
            }

        });
    </script>
</body>

</html>