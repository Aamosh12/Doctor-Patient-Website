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
if (isset($_SESSION['deleteUser'])) {
    // Display the success message
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire(
            'Deleted!',
            'Patient has been deleted.',
            'success'
        );
    });
    </script>";
    // Unset the session variable
    unset($_SESSION['deleteUser']);
}
function getTotalPatients()
{
    global $conn;
    $sql = "SELECT COUNT(*) as total_users FROM user WHERE role_id = 2";
    $totaluser = $conn->query($sql);
    if ($totaluser->num_rows > 0) {
        $user = $totaluser->fetch_assoc();
        return $user['total_users'];
    }
}
$sql_select = "SELECT * FROM user WHERE Role_id = 2";
$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient | CareConnect</title>
    <link rel="stylesheet" href="../../style/adminPatient.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <a href=""  class="active"><i class="fa-solid fa-user-group"></i>
                        <span>Patients</span></a>
                </li>
                <li><a href="./doctor.php"><i class="fa-solid fa-user-doctor"></i>
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
                    <h3>Total Patient : <?php echo getTotalPatients(); ?></h3>
                </div>
                <div class="table_section">
                    <table>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                                    <td>$row[Id]</td>
                                                    <td>$row[Name]</td>
                                                    <td>$row[Address]</td>
                                                    <td>$row[Email]</td>
                                                    <td>$row[Phone_Number]</td>
                                                    <td>";
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
                    window.location.href = "delete_pat.php?id=" + userId;
                }
            })
        }
    </script>
</body>

</html>