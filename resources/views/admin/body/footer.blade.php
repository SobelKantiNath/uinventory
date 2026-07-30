<footer class="footer border-top py-1 bg-white">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-between">
            <div class="col-md-6 text-center text-md-start">
                <span class="fs-13 text-muted">
                    &copy; {{ date('Y') }} 
                    <span class="fw-semibold text-dark">NU-Inventory</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0.5 fs-10 ms-2">v1.0.0</span>
                    - Management System
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span class="fs-13 text-muted">
                    Crafted with 
                    <i class="mdi mdi-heart text-danger heartbeat-icon" style="display: inline-block;"></i> 
                    by 
                    <a href="#!" class="text-primary fw-semibold text-decoration-none footer-author-link">Sobel Kanti Nath</a>
                </span>
            </div>
        </div>
    </div>
</footer>

<style>
    @keyframes footerHeartbeat {
        0% { transform: scale(1); }
        15% { transform: scale(1.2); }
        30% { transform: scale(1); }
        45% { transform: scale(1.2); }
        70% { transform: scale(1); }
    }
    .heartbeat-icon {
        animation: footerHeartbeat 1.8s infinite;
        color: #ef4444 !important;
    }
    .footer-author-link {
        transition: color 0.2s ease-in-out;
    }
    .footer-author-link:hover {
        color: #0d6efd !important;
        text-decoration: underline !important;
    }
</style>
