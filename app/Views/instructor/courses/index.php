<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content mt-4 container">
  <h2>Manage Courses</h2>

  <!-- Add Course Form -->
  <form id="addCourseForm" class="mt-3">
    <?= csrf_field() ?>
    <div class="row mb-2">
      <div class="col-md-4">
        <input type="text" name="title" class="form-control" placeholder="Course Title" required>
      </div>
      <div class="col-md-4">
        <input type="text" name="price" class="form-control" placeholder="Price" required>
      </div>
      <div class="col-md-4">
        <input type="text" name="description" class="form-control" placeholder="Description" required>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Add Course</button>
  </form>

  <hr>

  <!-- Course Table -->
  <table class="table table-bordered mt-4">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="courseTableBody"></tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    loadCourses();

    // Load all courses
    function loadCourses() {
        $.ajax({
            url: "<?= base_url('instructor/get-courses') ?>",
            type: "GET",
            dataType: "json",
            success: function(courses) {
                let html = "";
                $.each(courses, function(index, course) {
                    html += `
                        <tr>
                            <td>${course.id}</td>
                            <td>${course.title}</td>
                            <td>${course.price}</td>
                            <td>${course.description}</td>
                            <td>
                                <button class="btn btn-danger btn-sm deleteBtn" data-id="${course.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#courseTableBody').html(html);
            }
        });
    }

    // Add new course
    $('#addCourseForm').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('instructor/store-course') ?>",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire('Success', response.message, 'success');
                    $('#addCourseForm')[0].reset();
                    loadCourses();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            }
        });
    });

    // Delete course
    $(document).on('click', '.deleteBtn', function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('instructor/delete-course/') ?>" + id,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        Swal.fire('Deleted!', response.message, 'success');
                        loadCourses();
                    }
                });
            }
        });
    });
});
</script>
