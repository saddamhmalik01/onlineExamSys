
<html>
   <head>
    <title> Student Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid bg-info" style="height: 100px">
          <a class="navbar-brand" href="{{route('dashstudent')}}">Student Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="viewstudents" hidden>Students</a>
              </li>
              <li class="nav-item">
                <a class="nav-link " hidden>Exams</a>
              </li>
            </ul>
            <form class="d-flex">
                <a style="color:black" href="logout">Logout</a>
            </form>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
          <div class="row">
              <div class="col-lg-3" style="border: 1px solid">
                  <h3> Student Profile</h3><hr>
                  @foreach ($user as $user)
                  {{-- <label> ID: {{ $user->id}}</label><br><hr> --}}
                  <label> Name: {{ $user->name}}</label><br><hr>
                  <label> Father's Name: {{ $user->father_name}}</label><br><hr>
                  <label> Email: {{ $user->email}}</label><br><hr>
                  <label> Class: {{ $user->class}}</label><br><hr>
                  <label> Roll No: {{ $user->rollno}}</label><br><hr>
                  <label> Created At: {{ $user->created_at}}</label><br><hr>
                  <label> Updated At: {{ $user->updated_at}}</label><br><hr>
                  @endforeach
                  <button class="btn btn-primary" style="margin-left: 50px"><a href="changepassword/{{$user->id}}">Change Password</a></button><hr>
              </div>
              <div class="col-lg-6" >
                <h3> Information </h3><hr>
                @if($marks)
                <label>Number of tests attempted: {{$count}} </label><hr>
                <label> Marks obtained in last: {{$marks->correct}}/{{$marks->total}}</label><hr>
                @endif
              </div>
              <div class="col-lg-3" style="border: 1px solid;">
                  <h3> Links </h3><hr>
                  <button class="btn btn-primary"><a href="start_test">Start Test</a></button><hr>
                  <button class="btn btn-primary"><a href="results">  View Results</a></button><hr>

              </div>
          </div>
    </div>
    <hr>
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
    margin-left: 52px;
}
input{
    max-width: 600px;
    margin-left: auto;
}
a{
    text-decoration: none;
    color: white;
}
div{
    border-radius: 5px;
}

</style>
