<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<style>
    .profile-wrapper {
        min-height: calc(100vh - 80px);
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f8f9fa;
    }

    .profile-card {
        width: 100%;
        max-width: 550px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.15);
        padding: 30px 25px;
    }

    /* Red border on invalid input */
    input.error {
        border-color: red !important;
        /* background-color: #ffecec !important; */
    }

    /* Error message style */
    label.error {
        color: red;
        font-size: 14px;
        margin-top: 4px;
    }
</style>

<div class="profile-wrapper">
    <div class="profile-card">
        <h4 class="text-center mb-4">Edit Profile</h4>

        <form id="editForm">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label fw-bold">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= esc($user['name']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= esc($user['email']) ?>">
            </div>

            <div class="d-flex justify-content-between mt-3">
                <button type="submit" class="btn btn-primary px-4">Update</button>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary px-4">Back</a>
            </div>
        </form>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {

    // ✅ jQuery validation setup
    $('#editForm').validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 3 characters"
            },
            email: {
                required: "Please enter your email",
                email: "Enter a valid email"
            }
        },
        errorClass: "error", // adds .error class
        highlight: function(element) {
            $(element).addClass('error'); // red border
        },
        unhighlight: function(element) {
            $(element).removeClass('error'); // remove red border when valid
        },
        submitHandler: function(form) {
            $.ajax({
                url: "<?= base_url('update-profile') ?>",
                type: "POST",
                data: $(form).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response.message
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    });
                }
            });
        }
    });

});
</script>
