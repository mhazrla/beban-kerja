@if (session('alert'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: "{{ session('alert.title') }}",
                text: "{{ session('alert.text') }}",
                icon: "{{ session('alert.icon') }}",
                confirmButtonText: "{{ session('alert.confirmButtonText') }}"
            });
        });
    </script>
@endif
