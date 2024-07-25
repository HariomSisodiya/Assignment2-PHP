<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>User List</title>
</head>

<body>
    <?php
    // Database connection
    $conn = mysqli_connect('localhost', 'Hariom', '', 'userlogin') or die("Connection failed: " . mysqli_connect_error());

    if (!empty($_POST['email']) && !empty($_POST['pswd'])) {
        $email = $_POST['email'];
        $password = $_POST['pswd'];

        // Check login credentials
        $loginResult = mysqli_query($conn, "SELECT * FROM user WHERE Email = '$email'");

        if ($loginResult && $user = mysqli_fetch_assoc($loginResult)) {
            if (password_verify($password, $user['Password'])) {
                // Fetch user list
                $userListResult = mysqli_query($conn, "SELECT * FROM user");

                if ($userListResult) {
                    echo '<div class="container mt-4">';
                    echo '<h2 class="fw-bold text-danger text-center">User List</h2>';
                    echo '<table class="mt-3 table table-bordered table-striped">';
                    echo '<thead class="thead-dark">
                            <tr class="table-warning">
                                <th>Id</th>
                                <th>Username</th>
                                <th>Email</th>
                            </tr>
                          </thead><tbody>';

                    // Display user list
                    while ($row = mysqli_fetch_assoc($userListResult)) {
                        echo "<tr>
                                <td>{$row['Id']}</td>
                                <td>{$row['Username']}</td>
                                <td>{$row['Email']}</td>
                              </tr>";
                    }
                    echo '</tbody></table>';
                    echo '<a href="export.php"><button type="button" class="btn btn-danger mt-3 mb-3">Export to Excel</button></a>';
                    echo '</div>';
                } else {
                    echo '<div class="container mt-4"><div class="alert alert-danger" role="alert">Error retrieving user list.</div></div>';
                }
            } else {
                echo '<div class="container mt-4"><div class="alert alert-danger" role="alert">Invalid email or password.</div></div>';
            }
        } else {
            echo '<div class="container mt-4"><div class="alert alert-danger" role="alert">Invalid email or password.</div></div>';
        }
    }

    // Close connection
    mysqli_close($conn);
    ?>
</body>

</html>
