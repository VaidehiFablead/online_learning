<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content">
    <h2 class="mb-4 mt-5">Welcome Instructor <?= ucfirst(session('name')) ?></h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card p-4 text-center">
                <i class="bi bi-plus-circle fs-1 text-primary"></i>
                <h5 class="mt-3">Add Course</h5>
                <p>Create a new course for your students.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center">
                <i class="bi bi-book fs-1 text-success"></i>
                <h5 class="mt-3">My Courses</h5>
                <p>View and manage your uploaded courses.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-4 text-center">
                <i class="bi bi-people fs-1 text-warning"></i>
                <h5 class="mt-3">Students</h5>
                <p>See which students have enrolled in your courses.</p>
            </div>
        </div>
    </div>
</div>