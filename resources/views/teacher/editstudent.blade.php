<html>
   <head>
    <title> Teacher Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid bg-info" style="height: 100px">
          <a class="navbar-brand" href="{{route('dashboardTeacher')}}">Online Examination System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href={{ route('dashboardTeacher')}}>Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href={{route('viewteacher')}}>Students</a>
              </li>

            </ul>
            <form class="d-flex">
                <a href="logout">Logout</a>
            </form>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
          <div class="row">
              <div class="col-lg-3">
              </div>
              <div  style="border: 1px solid;border-radius:10px;" class="col-lg-6"><br>
              <span><strong>Edit Student</strong></span><hr>
              <form  method="POST" action="updatestudent">
                  @csrf
                  <input type="hidden" name="id" value={{$user['id']}}><br>
                  <label>Name: </label><br>
                  <input type="text" class="form-control" name="name" value={{$user['name']}}><br><br>
                  <label>Father's Name: </label><br>
                  <input type="text" class="form-control" name="father_name" value={{$user['father_name']}}><br><br>
                  <label>Email: </label><br>
                  <input type="text" class="form-control" name="email" value={{$user['email']}}><br><br>
                  <label>Roll No: </label><br>
                  <input type="text" class="form-control" name="rollno" value={{$user['rollno']}}><br><br>
                  <label>Class: </label><br>
                  <input type="text" class="form-control" name="class" value={{$user['class']}}><br><br>
                  <button style="margin-left: 205px; width:200px" type="submit" class="btn btn-primary">Update</button>
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
        width: 80%;

    }
    label{
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        font-weight: 600;
        margin-left: 52px;
    }
    input{
        width: 300px;
        margin-left: auto;
        border-radius: 5px;
    }
    a{
        text-decoration: none;
        color: white;
    }
    div{
        border-radius: 5px;
    }
    .form-control
    {
        width: 600px
    }
    </style>
