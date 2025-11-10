<?= $this->include('layouts/header')?>
<?= $this->include('layouts/navbar')?>
<?= $this->include('layouts/sidebar')?>
<div class="content">
  <h2 class="mb-4 mt-5">Welcome to Your Dashboard <?= ucfirst(session('name')) ?? 'Student'?></h2>

  <div class="row g-4">
    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="bi bi-book fs-1 text-primary"></i>
        <h5 class="mt-3">Your Courses</h5>
        <p>View and manage your enrolled subjects.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="bi bi-calendar-check fs-1 text-success"></i>
        <h5 class="mt-3">Attendance</h5>
        <p>Check your daily attendance records.</p>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card p-4 text-center">
        <i class="bi bi-bar-chart-line fs-1 text-warning"></i>
        <h5 class="mt-3">Results</h5>
        <p>Track your academic performance.</p>
      </div>
    </div>
  </div>
</div>
