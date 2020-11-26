<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="UFF | Trabalho de Projeto de Software">
    <meta name="author" content="Caio Wey, Igor Lisboa">
    <title>{{ config('app.name') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body id="app">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="{{url('/')}}">{{ config('app.name') }}</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item <?= (request()->routeIs('home') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('home') ?>">Home</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('sale.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('sale.index') ?>">Vendas</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('client.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('client.index') ?>">Clientes</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('complaint.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('complaint.index') ?>">Reclamações</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('product-exchange.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('product-exchange.index') ?>">Troca de Produtos</a>
                    </li>
                    @auth
                    @if(auth()->user()->manager)
                    <li class="nav-item <?= (request()->routeIs('manager.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('manager.index') ?>">Gerentes</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('user.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('user.index') ?>">Vendedores (Caixas)</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('product.index') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('product.index') ?>">Produtos</a>
                    </li>
                    <li class="nav-item <?= (request()->routeIs('active_users') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('active_users') ?>">Usuários Ativos</a>
                    </li>
                    @endif
                    @endif
                </ul>
                @auth
                <ul class="navbar-nav">
                    <li class="nav-item <?= (request()->routeIs('your_user') ? 'active' : '')  ?>">
                        <a class="nav-link" href="<?= route('your_user') ?>">{{auth()->user()->name}}</a>
                    </li>
                </ul>
                <form method="POST" class="form-inline mt-2 mt-md-0" onsubmit="return confirm('<?= __('msg_logout_confirm') ?>')" action="<?= route('logout') ?>">
                    @csrf
                    <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Sair</button>
                </form>
                @else
                <div class="form-inline mt-2 mt-md-0">
                    <a class="btn btn-outline-info my-2 my-sm-0" href="<?= route('login') ?>">Login</a>
                </div>
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