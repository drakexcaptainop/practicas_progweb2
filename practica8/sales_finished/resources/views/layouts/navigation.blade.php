<nav class="container navbar navbar-expand-sm bg-dark navbar-dark mb-2">
    <ul class="navbar-nav">
        <li class="navbar-item">
            <x-nav-link class="nav-link" :href="route('dashboard')">
                Home
            </x-nav-link>
        </li>
        <li class="navbar-item">
            <x-nav-link class="nav-link" :href="route('ajaxcustomerslist')">
                Customers
            </x-nav-link>
        </li>
        <li class="navbar-item">
            <x-nav-link class="nav-link" :href="route('employeelist')">
                Employees
            </x-nav-link>
        </li>
    </ul>
    <div class="ml-auto text-white">
        <form class="form-inline" method="POST" action="{{ route('logout') }}">
            Welcome: {{ Auth::user()->name }}
            @csrf
            <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
                Log Out
            </x-responsive-nav-link>
        </form>
    </div>
</nav>