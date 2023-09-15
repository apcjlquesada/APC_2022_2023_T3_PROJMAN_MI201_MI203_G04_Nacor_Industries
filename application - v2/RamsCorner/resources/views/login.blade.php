<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rams Corner </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>

</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
</script>

<body
    style="background-image: url('{{ asset('images/loginBackground.png') }}');
             background-size: cover;
             background-position: center center;
             background-repeat:no-repeat;
             margin: 0;
             padding: 0;
             min-height: 100vh;
             display: flex;
             justify-content: center;
             align-items: center;">
    @include('sweetalert::alert')


    <!-- original  forms-->
    <!-- <div class="loginform" style=" position: absolute; top: 32%; right: 10%; width: 800px; height: 450px; background-color: #e3ae4392; border-radius: 25px; padding: 2%;">

    <form class="box needs-validation" novalidate method="POST" enctype="multipart/form-data" action="{{ url('loginUser') }}">
      @csrf
      <h4 style="color: white;">Email</h4>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
      <h4 style="color: white;">Password</h4>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
      <div style="position: absolute; left: 42%;">
        <button type="submit" class="btn btn-lg btn" style="color: white; ">
          <h1><u><b>LOGIN</b></u></h1>
        </button>
      </div>
    </form>

  </div>
  <style>
    .box input[type="email"],
    .box input[type="password"] {
      border: 0;
      background-color: #f5cc79;
      margin: 20px auto;
      text-align: center;
      padding: 30px 100px;
      border-radius: 24px;
    }

    .loginform button {
      justify-content: center;
    }
  </style> -->


    <!-- responsive form -->
    <div class="loginform">
        <form class="box needs-validation" novalidate method="POST" enctype="multipart/form-data"
            action="{{ url('loginUser') }}">
            @csrf
            <h4 style="color: white;">Email</h4>
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
            <h4 style="color: white;">Password</h4>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            <div class="button-container">
                <button type="submit" class="btn btn-lg" style="color: white;">
                    <h1><u><b>LOGIN</b></u></h1>
                </button>
            </div>
        </form>
    </div>
    <style>
        .loginform {
            position: absolute;
            top: 32%;
            right: 10%;
            width: 80%;
            /* Use a percentage of the container width instead of a fixed value */
            max-width: 800px;
            /* Set a maximum width to ensure it doesn't get too wide */
            background-color: #e3ae4392;
            border-radius: 25px;
            padding: 2%;
        }

        .box input[type="email"],
        .box input[type="password"] {
            border: 0;
            background-color: #f5cc79;
            margin: 20px auto;
            text-align: center;
            padding: 15px 50px;
            /* Adjust padding for smaller screens */
            border-radius: 24px;
            width: 100%;
            /* Make the input fields take up the full width */
        }

        .button-container {
            text-align: center;
        }

        /* Add a media query for smaller screens */
        @media (max-width: 768px) {
            .loginform {
                top: 10%;
                right: 5%;
            }

            .box input[type="email"],
            .box input[type="password"] {
                padding: 15px 30px;
            }
        }
    </style>


</body>



<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (() => {
        "use strict";
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");
        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                "submit",
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add("was-validated");
                },
                false
            );
        });
    })();
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous">
</script>

</html>
