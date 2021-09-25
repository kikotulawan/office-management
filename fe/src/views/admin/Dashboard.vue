<template>
<div>
    <div class="container-fluid px-5">
        <div class="d-flex justify-content-between">
            <h3 class="ms-2 fw-light">Dashboard</h3>
            <button class="btn btn-outline-secondary text-gray shadow-none px-4 me-2"><i class="bi bi-clock-fill me-2"></i>Time In</button>
        </div>
        <p class="text-muted ms-2 lh-1"><small>Welcome to eOffice Dashboard</small></p>
        <div class="d-inline-flex ms-2 mt-4 dashboard-card">
            <div class="card p-4 me-3">
                <p class="text-center  lh-1"><small>Available Leave</small></p>
                <h3 class="text-center fw-bold lh-1">11</h3>
            </div>
            <div class="card p-4 me-3">
                <p class="text-center  lh-1"><small>On-going Task</small></p>
                <h3 class="text-center fw-bold lh-1">7</h3>
            </div>
            <div class="card p-4 me-3">
                <p class="text-center lh-1"><small>Tardiness</small></p>
                <h3 class="text-center fw-bold lh-1">5</h3>
            </div>
            <div class="card p-4 me-3">
                <p class="text-center lh-1"><small>Absent</small></p>
                <h3 class="text-center fw-bold lh-1">2</h3>
            </div>
        </div>
    </div>
</div>
</template>