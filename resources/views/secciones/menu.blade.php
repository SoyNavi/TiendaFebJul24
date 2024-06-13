<div class="fixed-top">
  <nav class="navbar navbar-expand-md">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="images/logo-mini.jpg" alt="Bootstrap" width="80" height="80">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor03" 
      aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarColor03">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" style="color: #FCEE00;" href="/" onmouseover="this.style.color='#fff';" onmouseout="this.style.color='#FCEE00';">Home
              <span class="visually-hidden">(current)</span>
            </a>
          </li>
          @if (Auth::guard('web')->guest())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
          </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('clientes.index')}}">Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('perfiles.index')}}">Perfiles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('facturas.index')}}">Facturación</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('productos.index')}}">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('carrito.index')}}"><i class="bi bi-cart4"></i></a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
            <div class="dropdown-menu" style="background-color: #000; border-radius: 0px; border: 4px solid #FCEE00; padding: 0;">
              <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar sesión</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </div>
          </li>
          @endif
        </ul>
        <form class="d-flex">
          <input class="input-stand" type="search" placeholder="Search" style="width: 200%; margin-top: 10px; margin-right: 10px;">
          <button class="btn btn-secondarys" type="submit" style="
            background-color: transparent;
            width: 100%;
            margin-top: 10px;
            color: #FCEE00; 
            font-weight: bold;
            border-radius: 0px;
            border: 4px solid #FCEE00;"
            onmouseover="this.style.color='#fff'; this.style.borderColor='#fff';"
            onmouseout="this.style.color='#FCEE00'; this.style.borderColor='#FCEE00';">Search</button>
        </form>
      </div>
    </div>
  </nav>
</div>
