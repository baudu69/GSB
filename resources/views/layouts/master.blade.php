<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>GSB</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    @yield('head')
</head>
<body>
<nav class="navbar navbar-expand-sm">
    <div class="container-fluid">
        <ul class="navbar-nav navbar-left">
            <a class="navbar-brand" href="{{url('/')}}">GSB</a>
            @if (Session::get('id') != null)
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/lister')}}">Lister</a>
                </li>
            @endif
        </ul>

        <ul class="nav navbar-nav navbar-right">
            @if (Session::get('id') == null)
            <li class="nav-item">
                <a class="nav-link" href="{{url('signIn')}}">Connexion</a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{url('signOut')}}">Déconnexion</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<div id="body">
    @yield('contenu')
</div>
<footer class="footer">
    <div class="copyright">© 2020 Copyright:
        <a href="{{url('/')}}">GSB</a>
    </div>
</footer>
</body>
@yield('script')
</html>
