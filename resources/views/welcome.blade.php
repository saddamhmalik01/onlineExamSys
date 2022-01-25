<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>
            Exam System
        </title>
    </head>
    <body>
        <nav class="navbar navbar-light bg-info">
            <div class="container-fluid">
              <span class="navbar-brand mb-0 h1">Online Examination System</span>
              <span> <a style="text-decoration: none; color:white" href="studentlogin" ><b>Student Login</b> </a>

            </div>
          </nav>

        <div class="container-fluid">
            <div class="form-control form mt-5">

        <form style='margin-left:100px' action="login" method="POST">
            <br><br>
            <h2 class="h2">Staff Login</h2><br><br><br>
            @csrf
            <label><strong> Email: </strong></label><br>
            <input class="form-control" style="width: 500px" type="email" placeholder="Enter your email" name='email'><br><br>
            <label><strong> Password: </strong> </label><br>
            <input class="form-control"style="width: 500px" type="password" placeholder="Enter your password" name='password'><br><br>
            <button class="btn-primary" style="width: 500px; border-radius:5px" type="submit">Login</button><br><br>
        </form>
            </div>
    </div>
    </body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<style>
    .navbar{
        min-height: 100px;
    }
    .navbar-brand{
        font-size: xx-large;

    }
    .form{
        display: block;
        margin-left: auto;
        margin-right: auto;
        min-height: 600px;
        width: 50%;
        background-color: aliceblue;
        border-radius: 10px
    }
    label{
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-style: italic;
        font-size: 16 px;

    }

</style>
