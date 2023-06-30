<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareConnect</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/index.css">
</head>

<body>
    <div class="container-fluid" id="main">
        <div id="background"></div>
        <header>
            <div id="nav">
                <?php
                include './index-content/nav.php';
                ?>
            </div>
        </header>
        <section class="row">
            <div id="content">
                <?php
                include './index-content/login.php';
                ?>
                <div class="col" id="main_content">
                    <h1 id="content-title">CareConnect</h1>
                    <h4>Connecting You to a Better World</h4>
                    <button class="btn btn-outline-secondary" type="button" id="getting_started" style="color: #27374d;">Getting Started</button>
                    <div class="social">
                        <a href="https://www.facebook.com/"><i class="fa-sharp fa-solid fa-xmark" style="size: 30px;"></i></a>
                        <a href=""><i class="fa-brands fa-twitter"></i></a>
                        <a href="https://www.instagram.com/mhrznaamosh/"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        if (window.history.replaceState)
        {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="./scripts/login.js"></script>
    <script src="https://kit.fontawesome.com/2c695f0152.js" crossorigin="anonymous"></script>
</body>

</html>