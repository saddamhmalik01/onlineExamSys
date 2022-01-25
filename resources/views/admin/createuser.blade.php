<html>
   <head>
    <title> Admin Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid bg-info" style="height: 100px">
          <a class="navbar-brand" href="{{ route('dashboard')}}">Online Examination System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard')}}"">Home</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('viewstudents')}}"">Students</a>
              </li>
            </ul>
            <form class="d-flex">
                <a style="color:black;" href="logout">Logout</a>
            </form>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
          <div class="row">
              <div class="col-lg-3">
              </div>
              <div class="col-lg-6" style="max-width: 700px; border: 1px solid; border-radius:10px">
                <h3 class="h3" >Add New Teacher</h3><hr>
                <form class="form-control" action='adduser' method="POST">
                    @csrf
                    <br>
                <label>Name:</label><br>
                <input type="text"  name="name" placeholder="Enter name of the Teacher"><br><br>
                <label>Email:</label><br>
                <input type="email"  name="email" placeholder="Enter name of the Teacher"><br><br>
                <label>Password:</label><br>
                <input type="password"  name="password" value="password" placeholder="Password" disabled><br>
                <small style="font-size: 10; color:red; margin-left:110px" > *Password is default: 'password'</small><br><br>
                <button type="submit"  class="btn btn-primary" style="width: 200px; margin-left:310px;"> Add Teacher</button><br>

                <br>
                </form>
              </div>
              <div class="col-lg-3">
              </div>
          </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<style>
.form
{
    display: block;
    margin-left: auto;
    margin-right: auto;
    width: 60%;

}
label{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    font-weight: 600;
    margin-left: 110px;
}
input{

    margin-left: 110px;
    width: 400px;
    border-radius: 5px;
    margin-top: 5px;
}
</style>

