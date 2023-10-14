<?php
$id = $_SESSION['id'];
$name = "SELECT Name FROM user WHERE Id = $id";
$nameResult = $conn->query($name);
$finalName = $nameResult->fetch_assoc();
?>
<style>
  header {
    display: flex;
    justify-content: space-between;
    padding: 1rem;
    top: 0;
    font-size: 1.5rem;
  }

  .clickable {
    cursor: pointer;
  }

  header .user {
    font-size: 1rem;
    margin-left: auto;
  }

  .user h4 i.fa-solid {
    margin-right: 5px;
    /* Adjust the spacing as needed */
  }

  #sortdown {
    position: relative;
    top: -3px;
  }

  .dropdown {
    position: relative;
    display: inline-block;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    min-width: 160px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 0.5rem;
  }

  .dropdown-content a {
    color: rgb(42, 40, 40);
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: 0.3s;
  }

  .dropdown a:hover {
    font-weight: bold;
  }
</style>
<header>
  <div class="user">
    <div class="dropdown">
      <h4 class="clickable" id="dropdownButton">
        <i class="fa-solid fa-user"></i> <?php echo $finalName['Name']; ?>
        <i class="fa-solid fa-sort-down" id="sortdown"></i>
      </h4>
      <div id="myDropdown" class="dropdown-content">
        <?php
        $currentUrl = $_SERVER['REQUEST_URI'];

        if (strpos($currentUrl, 'dashboard.php') == true) {
          echo "<a href='./doctor/editprofile.php'>Edit Profile</a>";
        } else {
          echo "<a href='./editprofile.php'>Edit Profile</a>";
        }
        // <a href="./editprofile.php">Edit Profile</a>
        ?>
      </div>
    </div>
  </div>
</header>

<script>
  const dropdown = document.getElementById("myDropdown");
  const dropdownButton = document.getElementById("dropdownButton");

  dropdownButton.addEventListener("click", function(event) {
    if (dropdown.style.display === "block") {
      dropdown.style.display = "none";
    } else {
      dropdown.style.display = "block";
    }
    event.stopPropagation(); // Prevent the click event from reaching the window.onclick
  });

  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.clickable')) {
      if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
      }
    }
  }
</script>