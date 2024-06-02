<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Portfolio</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="Portfolio.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .circle {
      width: 100px;
      height: 100px;
      background-color: rgb(56, 56, 56);
      opacity: 90%;
      border-radius: 50%;
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 9998;
    }

    .popup {
      display: none;
      position: fixed;
      width: 500px;
      top: 35%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgb(64, 64, 64);
      padding: 20px;
      border: 1px solid #ccc;
      z-index: 9999;
      color: white;
      border-radius: 10px;
    }

    .chat-box {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 400px;
  background-color: #f0f0f0;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 10px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}
#chatInterface {
            width: 100%;
            height: 450px; /* Adjust the height here */
            border: 1px solid #ccc;
            overflow-y: scroll; /* Enable scrolling if content exceeds height */
        }
.chat-content {
  text-align: center;
}

#openChatBtn {
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 9999; /* Ensure it appears above other content */
}

#closeChatBtn {
  margin-top: 10px;
}

.sticky {
  position: fixed;
  bottom: 20px;
  right: 20px;
}

#chatInterface::-webkit-scrollbar {
  display: none;
}

  </style>
</head>

<body>
  <!-- nav start -->
  <nav class="navbar navbar-expand-xl bg-body-tertiary position-sticky top-0" style="z-index: 1">
    <div class="container-fluid">
      <a class="navbar-brand fs-2 ms-5" href="#" style="font-weight: 900; letter-spacing: 1px">Sundew</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav" id="navbar-nav" style="margin-right: 3%">
          <li class="nav-item">
            <a class="nav-link active fs-5" aria-current="page" href="#home"
              style="font-weight: 800; color: #01867d">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="#services" style="font-weight: 800; color: #01867d">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5" href="#features" style="font-weight: 800; color: #01867d">Features</a>
          </li>
          <li class="nav-item">
            <!-- <button id="loginButton" class="ms-1" style="background-color: transparent; border: none">
              <a class="nav-link fs-5" style="font-weight: 800; color: #01867d">Login</a>
            </button> -->
          <?php
        if(!isset($_SESSION['email'])){?>

          <button id="loginButton" class="ms-1" style="background-color: transparent; border: none">
              <a class="nav-link fs-5" style="font-weight: 800; color: #01867d">Login</a>
            </button>
          <?php } 

          else {
            ?>

          <div class="btn-group dropdown-center mt-1 ms-4" >
          <button type="button" class="btn dropdown-toggle text-white" style="background-color: #01867d" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $_SESSION['user'];?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="index1.php" id="messege">Messege</a></li>
            <li><a class="dropdown-item" href="#" id="logout">Logout</a></li>
          </ul>
        </div>
            <?php
           }
          ?>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- nav end -->

  <button id="openChatBtn" class="sticky"style="border: none; background: 6px #5E5E5E; padding: 12px; border-radius: 100%; "><i class="fab fa-facebook-messenger fs-1" style="color: #01A99D;"></i></button>
  <div id="chatBox" class="chat-box" style="background-color: #01A99D;">
    <div class="chat-content" style="background-color: #01A99D;">
      <h3 style="color: #FFFFFF; display: inline; ">Chats</h3>
      <a class="ms-1 fs-3" id="closeChatBtn" style="float: right; margin-top: -3px; color: white;"><i class="fa-solid fa-xmark"></i> </a>
      <div id="chatInterface">
        <!-- Embed the search page using an iframe -->
        <iframe src="index1.php" frameborder="0" style="width: 100%; height: 100%;"></iframe>
    </div>


      
    </div>
  </div>

  <!-- Home section start-->
  <section id="home" class="vh100">
    <div class="primary" style="
          background-image: url(./Images/background-1.png);
          background-size: 100%;
          background-repeat: no-repeat;
        ">
      <div class="col-10 row mx-auto vh-100 align-items-center">
        <div class="col-5" style="height: auto">
          <h1 class="header1 text-white">"Boost Your Service"</h1>
          <p class="fs-4 pt-4 text-white">
            Say goodbye to paperwork headaches & inefficiency.Thank you for
            considering Robodent as your dental practice's digital ally. We're
            excited to embark on this journey with you as we redefine the
            dental industry, one smile at a time.
          </p>
        </div>
        <div class="col-6 ps-5" style="height: auto">
          <img src="./Images/img-1.png" alt="" style="width: 900px" />
        </div>
      </div>
    </div>
  </section>
  <!-- Home section start-->

  <!-- Services section start -->
  <section id="services" class="vh-100">
    <div style="height: 150px"></div>

    <div class="col-10 row vh-100 mx-auto">
      <div class="col-4" style="text-align: center">
        <i class="fa-solid fa-phone mb-5 pt-4 circle" style="font-size: 50px; color: #00a99d"></i>
        <h1 class="mb-3">Training and Support</h1>
        <p class="col-6 mx-auto fs-5">
          Assess the clinic's capacity for training staff on your software and
          the level of support they may require during the transition.
        </p>
      </div>
      <div class="col-4" style="text-align: center">
        <i class="fa-solid fa-cloud mb-5 pt-4 circle" style="font-size: 50px; color: #00a99d"></i>
        <h1 class="mb-3">Setup</h1>
        <p class="col-6 mx-auto fs-5">
          Our expert technicians will tailor the setup to your specific
          requirements, ensuring a perfect fit for your needs.
        </p>
      </div>
      <div class="col-4" style="text-align: center">
        <i class="fa-solid fa-gift mb-5 pt-4 circle" style="font-size: 50px; color: #00a99d"></i>
        <h1 class="mb-3">Demo & Trial</h1>
        <p class="col-6 mx-auto fs-5">
          Offer the clinic a demo or trial of your software to allow them to
          experience it firsthand and assess its fit for their needs.
        </p>
      </div>
    </div>
  </section>
  <!-- Services section start -->

  <!-- Features Section start-->

  <section id="features" class="vh100">
    <div class="row mx-auto vh-100 align-items-center" style="
          background-image: url(./Images/back-3.jpg);
          background-size: cover;
        ">
      <div class="col-6 ps-5 ms-4" style="height: auto">
        <img src="./Images/background-2.png" alt="" style="width: 700px" />
      </div>
      <div class="col-5 ms-5" style="width: 650px">
        <h1 class="header1 text-black">"Patient Management"</h1>
        <p class="fs-5 pt-4 text-black">
          Patient Profiles: Maintain comprehensive patient records with
          personal information, medical history, and contact details and
          appointment records. Treatment History: Keep a detailed history of
          past treatments and diagnoses for each patient.
        </p>
      </div>
    </div>

    <div class="col-10 row mx-auto vh-100 align-items-center">
      <div class="col-5" style="height: auto">
        <h1 class="header1 text-black fs-1">"Billing Features :"</h1>
        <p class="fs-5 pt-2 text-black">
          The billing feature in Sundew simplifies the process of generating
          invoices and managing payments for dental services. It offers a
          user-friendly interface that allows dental professionals to:
        </p>
        <ul id="billing-features-ul">
          <li>
            <h2 class="header2 text-black fs-3">Create Invoices:</h2>
            <p class="fs-5 text-black">
              Easily generate invoices for a range of dental treatments and
              services provided to patients.
            </p>
          </li>
          <li>
            <h2 class="header2 text-black fs-3">Customization :</h2>
            <p class="fs-5 text-black">
              Customize invoices with the clinic's branding, payment terms,
              and itemized services for transparency.
            </p>
          </li>
          <li>
            <h2 class="header2 text-black fs-3">Automatic Calculations :</h2>
            <p class="fs-5 text-black">
              Automatically calculate charges, taxes, and discounts, reducing
              the risk of errors in billing.
            </p>
          </li>
        </ul>
      </div>
      <div class="col-6 ps-5" style="height: auto">
        <img src="./Images/background-3.png" alt="" style="width: 820px" />
      </div>
    </div>

    <div class="col-10 row mx-auto vh-100 align-items-center">
      <div class="col-6 ps-5" style="height: auto">
        <img src="./Images/background-4.png" alt="" style="width: 700px" />
      </div>
      <div class="col-5 ms-5" style="height: auto">
        <h1 class="header1 text-black">"Treat Management"</h1>
        <p class="fs-4 pt-4 text-black">
          This feature in Robodent, streamlines treatment operations by
          allowing dentists and staff to efficiently record treatment details
          by choosing teeth and treatments and also allow to review treatment
          history data to track patient progress. This feature optimizes the
          clinic's workflows and ensures that all treatment processes are
          well-documented Appointment Scheduling: Efficiently schedule and
          manage patient appointments, with real-time availability checks,
          automated reminders, and the ability to reschedule or cancel
          appointments when necessary.
        </p>
      </div>
    </div>
  </section>
  <!-- Features Section end-->

  <!-- Footer Start -->
  <footer class="bg-dark text-white pt-5 pb-4">
    <div class="col-10 text-center mx-auto" style="width: 80%">
      <div class="row text-center text-md-left">
        <div class="col-3 mx-auto mt-3">
          <h3 class="text-uppercase mb-4 font-weight-bold" style="color: #00a99d">
            About Company
          </h3>
          <p class="fs-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus
            lacinia odio vitae vestibulum vestibulum.
          </p>
        </div>

        <div class="col-2 mx-auto mt-3">
          <h3 class="text-uppercase mb-4 font-weight-bold" style="color: #00a99d">
            Quick Links
          </h3>
          <p class="fs-4">
            <a href="#home" class="text-white" style="text-decoration: none">Home</a>
          </p>
          <p class="fs-4">
            <a href="#services" class="text-white" style="text-decoration: none">Services</a>
          </p>
          <p class="fs-4">
            <a href="#features" class="text-white" style="text-decoration: none">Features</a>
          </p>
        </div>

        <div class="col-3 mx-auto mt-3">
          <h3 class="text-uppercase mb-4 font-weight-bold" style="color: #00a99d">
            Follow Us
          </h3>
          <p class="fs-4">
            <a href=" #" class="text-white" style="text-decoration: none"><i class="fab fa-facebook-f"></i> Facebook</a>
          </p>
          <p class="fs-4">
            <a href="#" class="text-white" style="text-decoration: none"><i class="fab fa-twitter"></i> Twitter</a>
          </p>
          <p class="fs-4">
            <a href="#" class="text-white" style="text-decoration: none"><i class="fab fa-instagram"></i> Instagram</a>
          </p>
          <p class="fs-4">
            <a href="#" class="text-white" style="text-decoration: none"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
          </p>
        </div>

        <div class="col-4 mx-auto mt-3">
          <h3 class="text-uppercase mb-4 font-weight-bold" style="color: #00a99d">
            Contact
          </h3>
          <p class="fs-4">
            <i class="fas fa-home mr-3"></i> 1234 Street Name, City, State,
            56789
          </p>
          <p class="fs-4">
            <i class="fas fa-envelope mr-3"></i> info@example.com
          </p>
          <p class="fs-4">
            <i class="fas fa-phone mr-3"></i> + 01 234 567 88
          </p>
          <p class="fs-4">
            <i class="fas fa-print mr-3"></i> + 01 234 567 89
          </p>
        </div>
      </div>

      <hr class="mb-4" />

      <div class="row align-items-center">
        <div class="col-7">
          <p class="text-center text-md-left fs-4">
            Â© 2024 Company Name. All rights reserved.
          </p>
        </div>

        <div class="col-5">
          <div class="text-center text-md-right">
            <ul class="list-unstyled list-inline">
              <li class="list-inline-item">
                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px"><i
                    class="fab fa-facebook-f"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px"><i
                    class="fab fa-twitter"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px"><i
                    class="fab fa-google-plus"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px"><i
                    class="fab fa-linkedin-in"></i></a>
              </li>
              <li class="list-inline-item">
                <a href="#" class="btn-floating btn-sm text-white" style="font-size: 23px"><i
                    class="fab fa-instagram"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->



  <!-- Login and Signup Popup model start -->

  <!-- Login popup model start -->
  <div id="loginPopup" class="popup">
    <div class="col-3 my-3 mx-auto" style="width: auto">
      <div class="form-container">
        <div class="form-wrapper">
          <form>
            <label for="login" class="fs-2 mb-3">Login</label>
            <div class="mb-3">
              <label for="email" class="form-label">
                Email address
              </label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" />
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" />
            </div>
            <div class="row my-3">
              <p class="text-white">
                Don't have an Account?
                <a id="signUpLink" class="col-3" style="text-decoration: none; color: #00a99d">Sign Up</a>
              </p>
            </div>
            <button class="btn btn-primary" id="login-button">Login</button>
            <button type="button" id="cancelButton" class="btn btn-secondary" style="margin-left: 10px">
              Cancel
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Login popup model end -->

  <!-- signup popup model start -->
  <div id="signupPopup" class="popup">
    <div class="col-3 my-3 mx-auto" style="width: auto">
      <div class="form-container">
        <div class="form-wrapper">
          <form>
            <label for="signup" class="fs-2 mb-3">Sign Up</label>
            <div class="mb-3">
              <label for="name" class="form-label">Full Name</label>
              <input type="text" class="form-control" id="name" />
            </div>
            <div class="mb-3">
              <label for="signup-email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="signup-email" aria-describedby="emailHelp" />
            </div>
            <div class="mb-3">
              <label for="signup-password" class="form-label">Password</label>
              <input type="password" class="form-control" id="signup-password" />
            </div>
            <div class="row my-3">
              <p class="text-white">
                Already have an Account?
                <a id="loginLink" class="col-3" style="text-decoration: none; color: #00a99d">Login</a>
              </p>
            </div>
            <button class="btn btn-primary" id="signup-button">Sign Up</button>
            <button type="button" id="cancelSignupButton" class="btn btn-secondary" style="margin-left: 10px">
              Cancel
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- signup popup model end -->

  <div id="overlay" class="overlay"></div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script>
    $(document).ready(function () {

      $("#loginButton").click(function () {
        $("#loginPopup").show();
        $("#overlay").show();
      });

      $("#cancelButton, #cancelSignupButton").click(function () {
        $("#loginPopup").hide();
        $("#signupPopup").hide();
        $("#overlay").hide();
      });

      $("#signUpLink").click(function (e) {
        e.preventDefault();
        $("#loginPopup").hide();
        $("#signupPopup").show();
      });

      $("#loginLink").click(function (e) {
        e.preventDefault();
        $("#signupPopup").hide();
        $("#loginPopup").show();
      });

    });

    // document.addEventListener('DOMContentLoaded', function () {
    //   let options = {
    //     threshold: 0.1
    //   };

    //   let observer = new IntersectionObserver(function (entries, observer) {
    //     entries.forEach(entry => {
    //       if (entry.isIntersecting) {
    //         entry.target.classList.add('visible');
    //         observer.unobserve(entry.target);
    //       }
    //     });
    //   }, options);

    //   document.querySelectorAll('p').forEach(p => {
    //     observer.observe(p);
    //   });
    // });
  </script>
  <!-- Login and Signup Popup model end -->

  <script>
        
        $('Document').ready(function(){

          $('#openChatBtn').click(function() {

    $('#chatBox').fadeIn();
    $('#openChatBtn').hide();
  });

  $('#closeChatBtn').click(function() {
    $('#chatIframe').remove();
    $('#chatBox').fadeOut();
    $('#openChatBtn').show();
  });

          $('#login-button').click(function(e){
    e.preventDefault();
    var email = $('#email').val();
    var password = $('#password').val();
        $.ajax({
          method: "POST",
          url: "loginapi.php",
          data: {email:email,pass:password}
        })
        .done(function(msg){
          if(msg == 'SUCCESS'){
            window.location.href="index.php";
          }
          else{
            $('#result').html(msg);
          }
        });
    });

            $('#signup-button').click(function(e){
                e.preventDefault();
                var email = $('#signup-email').val();
                var password = $('#signup-password').val();
                var username = $('#name').val();
                
                $.ajax({
                    method: "POST",
                    url: "regisisterapi.php",
                    data: {username:username,email:email,pass:password}
                })

            .done(function(msg){
               console.log(msg);
               if(msg == 'SUCCESS'){
                 window.location.href="index.php";

               }
               else if(msg == 'Already Registered'){
               $('#result').html('This email is already registered');
               }
               else{
                 alert("Unable to register!");
               }
      
             });

            });


            $("#logout").click(function(){
        $.ajax({
            url: 'logout.php', // Replace 'logout.php' with the path to your server-side script that destroys the session
            type: 'POST',
            success: function(data){
                // Handle the success response, if needed
                console.log("Session destroyed successfully");
                // Redirect to another page or perform any other action after logout
                window.location.href = 'index.php'; // Replace 'logout_success.html' with the desired redirect URL
            },
            error: function(xhr, status, error){
                // Handle any error that occurs during the AJAX request
                console.error("Error destroying session: " + error);
            }
        });
    });

          });

          const searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    userList = document.querySelector(".users-list");

    searchIcon.onclick = () => {
        searchBar.classList.toggle("show");
        searchIcon.classList.toggle("active");
        searchBar.focus();

        if(searchBar.classList.contains("active")){
            searchBar.value = "";
            searchBar.classList.remove("active");
        }
    }
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;

    if(searchTerm!= "")
    {
        searchBar.classList.add("active");
    }else{
        searchBar.classList.remove("active");
    }
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "search.php", true);
    xhr.onload = () => {
        if(xhr.readyState=== XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);   
}
    </script>

</body>

</html>