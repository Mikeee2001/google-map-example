<aside class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-paw"></i>
        <span class="text">VetCare</span>
    </div>

    <ul class="menu">

        <li>
            <a href="#"
                class="menu-link#">

                <i class="fa-solid fa-gauge"></i>
                <span class="text">Dashboard</span>

            </a>
        </li>

        <li>
            <a href="#" class="menu-link">

                <i class="fa-solid fa-calendar-check"></i>
                <span class="text">Appointments</span>

            </a>
        </li>

        <li>
            <a href="#"
                class="menu-link #">

                <i class="fa-solid fa-users"></i>
                <span class="text">Users</span>

            </a>
        </li>

        <li>
            <a href="#" class="menu-link">

                <i class="fa-solid fa-paw"></i>
                <span class="text">Pets</span>

            </a>
        </li>

        <li>
            <a href="{{ route('emergency') }}" class="menu-link">

                <i class="fa-solid fa-gear"></i>
                <span class="text">Emergency</span>

            </a>
        </li>

        <li>
            <a href="#" class="menu-link">

                <i class="fa-solid fa-gear"></i>
                <span class="text">Settings</span>

            </a>
        </li>

        <!-- LOGOUT FIXED -->
        <li>
            <a href="#" class="menu-link">


                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="text">Logout</span>

            </a>

            <form id="logout-form" >
                @csrf
            </form>
        </li>

    </ul>

</aside>
