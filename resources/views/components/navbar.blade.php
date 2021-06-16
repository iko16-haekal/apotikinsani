<style>

</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color: #343A40">
    <div class="container">
      <a class="navbar-brand" href="#">Apotek insani</a>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" aria-current="page" href="{{url("/")}}">Home</a>
          <a class="nav-link "  href="{{url("/products")}}">produk</a>
          @guest
          <a class="nav-link" href="{{url('/login')}}">Login</a>
          <a class="nav-link" href="{{url('/register')}}">Register</a>
          @endguest
          @auth
          <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{Auth::user()->name}}
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a  class="dropdown-item" href="{{ url('/keranjang') }}">
              keranjang
          </a></li>
            <li><a  class="dropdown-item" href="{{ url('/invoice') }}">
              invoice
          </a></li>
            <li><a  class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              Logout
          </a></li>
            
          </ul>
        </li>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
          @endauth
        </div>
        
      </div>
     
    </div>
  </nav>