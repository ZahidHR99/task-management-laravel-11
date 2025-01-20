   <!-- Alert Box For Success Response-->
   @if(session('success'))
        <div class="alert alert-success fade show">
            {{ session('success') }}
        </div>
    @endif

<!-- Alert Box For Error or Failed Response-->
    @if(session('error'))
        <div class="alert alert-danger fade show">
            {{ session('error') }}
        </div>
    @endif


<!-- JavaScript to auto-hide alerts -->
<script>
    // Wait for the DOM to be ready
    document.addEventListener("DOMContentLoaded", function () {
        // Select all alerts
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(function (alert) {
            // Set a timeout to remove the alert after 3 seconds
            setTimeout(() => {
                alert.classList.add('fade'); // Add the fade class to trigger fading effect
                setTimeout(() => alert.remove(), 500); // Remove the alert after the fade effect
            }, 3000);
        });
    });
</script>