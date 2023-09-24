<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./style/styles.css" />
  <title>CareConnect</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
  <nav>
    <div class="nav__logo"><img src="./images/careconnect.png" alt=""></div>
    <ul class="nav__links">
      <li class="link"><a href="#">Home</a></li>
      <li class="link"><a href="javascript:void(0);" class="scroll-to" data-target="#features">Features</a></li>
      <li class="link"><a href="javascript:void(0);" class="scroll-to" data-target="#about">About Us</a></li>
      <li class="link"><a href="javascript:void(0);" class="scroll-to" data-target="#contact">Contact Us</a></li>
    </ul>
    <div class="dropdown">
      <button class="btn" id="loginbutton" onclick="myFunction()">Login <i class="fas fa-sort-down" id="sortdown"></i></button>
      <div id="myDropdown" class="dropdown-content">
        <a href="./logindoc.php">Login As Doctor</a>
        <a href="./loginpat.php">Login As Patient</a>
      </div>
    </div>
  </nav>
  <header class="section__container header__container">
    <h1 class="section__header">Connecting Care<br />Book Your Appointment Today</h1>
    <img src="./images/back.jpg" alt="header" id="back" />
  </header>
  <section class="section__container plan__container" id="features">
    <p class="subheader">HEALTHCARE SUPPORT</p>
    <h2 class="section__header">Plan your health with confidence</h2>
    <p class="description">
      Find help with your medical appointments and healthcare plans, and see what to expect along your journey to better health.
    </p>
    <div class="plan__grid">
      <div class="plan__content">
        <span class="number">01</span>
        <h4> Health Tips & Advice</h4>
        <p>
          Access helpful tips and advice on maintaining good health,
          managing specific medical conditions, and leading a healthy lifestyle.
        </p>
        <span class="number">02</span>
        <h4>Appointment Scheduling</h4>
        <p>
          Users can conveniently book appointments with their
          preferred doctors using an easy-to-use scheduling system.
        </p>
        <span class="number">03</span>
        <h4>Doctor Profiles</h4>
        <p>
          Detailed profiles of doctors, including
          qualifications and specialties, help users make informed
          choices about their healthcare providers.
        </p>
      </div>
      <div class="plan__image">
        <img src="./images/planB.jpg" alt="plan" />
        <img src="./images/planA.jpg" alt="plan" />
        <img src="./images/planC.jpg" alt="plan" />
      </div>
    </div>
  </section>
  <section class="memories" id="about">
    <div class="section__container memories__container">
      <div class="memories__header">
        <h2 class="section__header">
          Care for Life, Book with Ease
        </h2>
      </div>
      <div class="memories__grid">
        <div class="memories__card">
          <span><i class="ri-calendar-2-line"></i></span>
          <h4>Book & relax</h4>
          <p>
            With 'Book & Relax,' taking care of your
            health is stress-free. Sit back, book your appointments effortlessly, and focus on your well-being, while we handle the rest. Your health, our priority.
          </p>
        </div>
        <div class="memories__card">
          <span><i class="ri-shield-check-line"></i></span>
          <h4>Smart Checklist</h4>
          <p>
            Discover the Smart Checklist, a groundbreaking solution transforming your healthcare journey. With us, managing your appointments becomes a breeze, ensuring a seamless and efficient healthcare experience.
          </p>
        </div>
        <div class="memories__card">
          <span><i class="ri-bookmark-2-line"></i></span>
          <h4>Save More</h4>
          <p>
            Saving on Healthcare, Without Compromising Quality. Discover exclusive
            promotions and deals on appointments, prioritizing affordability while ensuring top-notch healthcare services. </p>
        </div>
      </div>
    </div>
  </section>
  <section class="subscribe">
    <div class="section__container subscribe__container">
      <h2 class="section__header">Subscribe newsletter & get latest news</h2>
      <form class="subscribe__form">
        <input type="text" placeholder="Enter your email here" />
        <button class="btn">Subscribe</button>
      </form>
    </div>
  </section>

  <footer class="footer">
    <div class="section__container footer__container" id="contact">
      <div class="footer__col">
        <h3>CareConnect</h3>
        <p>
          Where Excellence Connects. With a Dedicated Focus on Your Health and Well-being, CareConnect offers Exceptional Service and Seamless Appointments.
        <p>From Compassionate Care to Advanced Healthcare, We Connect Patients to a World of Trusted Medical Services, Ensuring Safe, Comfortable, and Unforgettable Experiences.
        </p>
      </div>
      <div class="footer__col">
        <h4>INFORMATION</h4>
        <a href="#">Home</a>
        <a href="#">Features</a>
        <a href="#">About Us</a>
        <a href="#">Contact Us</a>
      </div>
      <div class="footer__col">
        <h4>CONTACT</h4>
        <p>+977 9800000000</p>
        <p>Careconnect@gmail.com</p>
        <p>Socials</p>
      </div>
    </div>
    <div class="section__container footer__bar">
      <p>Copyright © 2023 CareConnect. All rights reserved.</p>
      <div class="socials">
        <a href="https://www.facebook.com/"><i class="ri-facebook-fill"></i></a>
        <a href="#"><i class="ri-twitter-fill"></i></a>
        <a href="#"><i class="ri-instagram-line"></i></a>
        <a href="#"><i class="ri-youtube-fill"></i></a>
      </div>
    </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- JavaScript to handle smooth scrolling -->
  <script>
    $(document).ready(function() {
      // Handle click event for navigation links
      $('.scroll-to').on('click', function(event) {
        event.preventDefault();
        const target = $(this).data('target');
        $('html, body').animate({
          scrollTop: $(target).offset().top
        }, 1000);
      });
    });

    const dropdown = document.getElementById("myDropdown");

    // Toggle the dropdown when clicking on the login button
    function myFunction() {
      if (dropdown.style.display === "block") {
        dropdown.style.display = "none";
      } else {
        dropdown.style.display = "block";
      }
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
      if (!event.target.matches('.btn') && !event.target.matches('.fa-sort-down')) {
        if (dropdown.style.display === "block") {
          dropdown.style.display = "none";
        }
      }
    }
  </script>
</body>

</html>