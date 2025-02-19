@if (session('success'))
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
    <div class="toast-container top-0 end-0 p-3" style="z-index: 10000">
        <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">{{ session('success') }}</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = (event) => {
                    let toastAlert = document.querySelector('.toast');
                    let toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }
</script>
@endif

@if (session('danger'))
<div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">{{ session('danger') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
<script>
    window.onload = (event) => {
                    let toastAlert = document.querySelector('.toast');
                    let toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }
</script>
@endif

@if (session('warning'))
<div class="toast align-items-center text-bg-warning border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">{{ session('warning') }}</div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
            aria-label="Close"></button>
    </div>
</div>
<script>
    window.onload = (event) => {
                    let toastAlert = document.querySelector('.toast');
                    let toast = new bootstrap.Toast(toastAlert);
                    toast.show();
                }
</script>
@endif
