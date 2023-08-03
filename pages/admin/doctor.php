<?php
session_start();
require '../../actions/Connection.php';


if (!isset($_SESSION["role"])) {
    header("location: ../../index.php");
    exit();
    
}
elseif($_SESSION["role"] != 3){
    header("location: ../../index.php");
    exit();
}
if (isset($_SESSION['verification_success']) && $_SESSION['verification_success']) {
    unset($_SESSION['verification_success']); // Unset the session variable to avoid showing the SweetAlert again on page refresh

    // Show the SweetAlert
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Verification Success',
                text: 'Selected doctors verified successfully!',
                showConfirmButton: false,
                timer: 2000
            });
        });
    </script>";
}
function getTotalDoctors()
{
    global $conn;
    $sql = "SELECT COUNT(*) as total_users FROM user WHERE role_id = 1";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
$success = false;
$sql_select = "SELECT * FROM user u INNER JOIN doctor d ON u.id = d.user_id;";
$result = $conn->query($sql_select);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor | CareConnect</title>
    <link rel="stylesheet" href="../../style/adminDoctor.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2>CareConnect</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="../admdashboard.php"><i class="fa-solid fa-igloo"></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="./patient.php"><i class="fa-solid fa-user-group"></i>
                        <span>Patients</span></a>
                </li>
                <li><a href="" class="active"><i class="fa-solid fa-user-doctor"></i>
                        <span>Doctors</span></a>
                </li>
                <li>
                    <a href="./report.php"><i class="fa-solid fa-file-invoice"></i>
                        <span>Reports</span></a>
                </li>
                <li>
                    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Log Out</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <?php
        include 'header.php';
        ?>
        <main>
            <div class="table">
                <div class="table_header">
                    <h3>Total Doctors : <?php echo getTotalDoctors(); ?></h3><form action="./verifyDoctor.php" method="post"><button id='verifyDoc' type="submit" name="submit">Verify</button>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Specialist</th>
                                <th>Experience</th>
                                <th>Degree</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $isVerified = $row['IsVerified'];
                                    echo '<script>console.log('.$isVerified.')</script>';
                                    echo "<tr>
                                                    <td><input type='checkbox' name='doctors[]' value='$row[Id]'></td>
                                                    <td>$row[Id]</td>
                                                    <td>$row[Name]</td>
                                                    <td>$row[Address]</td>
                                                    <td>$row[Email]</td>
                                                    <td>$row[Phone_Number]</td>
                                                    <td>$row[Specialization]</td>
                                                    <td>$row[Experience]</td>
                                                    <td>$row[Degree]</td>
                                                    <td>";
                                                    if ($isVerified == 0){
                                                    echo "<button class='editDel' name='submitSolo'>Verify</button>";}
                                                    else {
                                                        echo "<button class='disableVerify' disabled>Verified</button>";
                                                    }
                                                    echo "<button class='editDel' type='button' onclick='confirmation($row[Id])'>Delete</button>
                                                    </td>
                                                </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='9'>No data found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
        function confirmation(userId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "delete_user.php?id=" + userId;
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>