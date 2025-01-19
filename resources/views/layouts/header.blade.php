<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="/dashboard">
      Task Management
    </a>

    <!-- Toggle button -->
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
      </ul>
      <!-- Left links -->

      <div class="d-flex align-items-center">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button :href="route('logout')" data-mdb-ripple-init type="button" class="btn btn-primary me-3" onclick="event.preventDefault(); this.closest('form').submit();">
            Log Out
          </button>
        </form>

        <a
          data-mdb-ripple-init
          class="btn btn-dark px-3"
          href="#"
          role="button"
          ><i class="fab fa-github"></i
        ></a>
      </div>
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->