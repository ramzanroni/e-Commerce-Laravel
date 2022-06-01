<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="..." alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">User Menu</h5>
    </div>
    <ul class="list-group list-group-flush">
        <a href="/" class="btn btn-info btn-sm btn-block">Home</a>
        <a href="/user_order" class="btn btn-info btn-sm btn-block">My Order</a>
        <a class="btn btn-danger btn-sm btn-block" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
        Logout
     </a>

     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
         @csrf
     </form>
    </ul>
    <div class="card-body">
        
    </div>
</div>