<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="fas fa-tools me-2 text-primary"></i>
            <strong>{{ config('app.name', 'Reclamations TT') }}</strong>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <!-- User (Regular User) -->
                @if(Auth::user()->user_type == 0)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('complaints.create') ? 'active' : '' }}" href="{{ route('complaints.create') }}">
                            <i class="fas fa-plus-circle"></i> Submit Complaint
                        </a>
                    </li>
                @endif

                <!-- Technician -->
                @if(Auth::user()->user_type == 2)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('technician.dashboard') ? 'active' : '' }}" href="{{ route('technician.dashboard') }}">
                            <i class="fas fa-wrench"></i> Technician Dashboard
                        </a>
                    </li>
                @endif

                <!-- Admin -->
                @if(Auth::user()->user_type == 1)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-user-shield"></i> Admin Panel
                        </a>
                    </li>
                @endif

                <!-- User Profile & Logout Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fas fa-user-edit"></i> Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
