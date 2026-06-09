<header class="topbar">

    <button class="burger" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars"></i>
    </button>

    <div>
        <strong>{{ optional(auth()->user())->fullname ?? 'Admin' }}</strong>
    </div>

</header>
