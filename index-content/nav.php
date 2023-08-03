<nav class="navbar navbar-expand-lg bg-secondary-subtlebg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"> <img src="./images/logo.png" alt="CareConnect" width="85" height="50"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li> -->
      </ul>
        <button class="btn btn-outline" type="button" id="index-login"  onclick="showLogin()"><i class="bi bi-person-circle" id="user-icon" style="margin-bottom: 5px">      </i>Login</button>
    </div>
  </div>
</nav>
<script>
  function showLogin(){
    document.getElementById('loginDiv').style.overflow = 'hidden';
    document.getElementById('loginDiv').style.display='block';
    document.getElementById('main_content').style.display='none';
    document.getElementById('content').style.filter = 'blur(50%)';
  }
</script>