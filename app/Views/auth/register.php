<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
        body {
            background: url('https://images.pexels.com/photos/256417/pexels-photo-256417.jpeg?auto=compress&cs=tinysrgb&w=1600') no-repeat center center/cover;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.97);
            border-radius: 10px;
            padding: 40px 30px;
            width: 100%;
            max-width: 550px;
            box-shadow: 0px 5px 30px rgba(0, 0, 0, 0.3);
        }

        .form-title {
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
            letter-spacing: 1px;
        }

        .form-control {
            border-radius: 8px;
            padding: 10px;
        }

        .btn-submit {
            background-color: #a33939;
            border: none;
            color: #fff;
            font-weight: 500;
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background-color: #8a2e2e;
        }

        label {
            font-weight: 500;
        }

        .gender-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .note {
            color: #a33939;
            font-size: 0.85rem;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body class="bg-light">


    <div class="form-container">
        <h3 class="form-title">STUDENT REGISTRATION FORM</h3>
        <form id="registerForm">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" class="form-control" name="name" placeholder="First Name" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select class="form-control" name="role" required>
                    <option value="">-- Select Role --</option>
                    <option value="student">Student</option>
                    <option value="instructor">Instructor</option>
                </select>
            </div>

            <button type="submit" class="btn-submit mt-3">SUBMIT</button>
            <p class="note mt-3">Don’t have an account? <a href="<?= base_url('/') ?>">Login</a></p>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('register') ?>",
                method: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Registration Successful!',
                            text: response.message,
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            window.location.href = "<?= base_url('/') ?>";
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonColor: '#d33'
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>