<html>
   <head>
    <title> Admin Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid bg-info" style="height: 100px">
          <a class="navbar-brand" href="{{route('dashboard')}}">Online Examination System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " href="{{route('dashboard')}}">Home</a>
                  </li>
              <li class="nav-item">
                <a class="nav-link " href="{{route('viewstudents')}}">Students</a>
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
              <div class="col-lg-1">
              </div>
              <div  style="border: 1px solid;border-radius:10px;" class="col-lg-10"><br>
              <span><strong> All Students</strong></span> <button class="btn btn-primary">       <a style="text-decoration: none; color:white" href="createstudent">Create New Student </a></button>

                     <table class="table mt-2" border="1">
                        <tr>
                            <th>ID </th>
                            <th>Name </th>
                            <th>Parentage </th>
                            <th>Class</th>
                            <th>Roll No.</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At </th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                        {{-- @foreach($data as $datas) --}}
                        @foreach($data as $user)
                         <tr>
                            <td>{{$user['id']}}</td>
                            <td>{{$user['name']}}</td>
                            <td>{{$user['father_name']}}</td>
                            <td> {{$user['class']}}  </td>
                            <td> {{$user['rollno']}}  </td>
                            <td> {{$user['email']}}  </td>
                            <td>  {{$user['created_at']}} </td>
                            <td> {{$user['updated_at']}}  </td>
                            <td><a href="editstudent/{{$user['id']}}"><button class="btn btn-primary">Edit</button></a></td>
                            <td><a href="deletestudent/{{$user['id']}}"><button class="btn btn-primary">Delete</button></a></td>
                        </tr>
                         @endforeach
                         {{-- @endforeach --}}
                     </table>
              </div>
              <div class="col-lg-1">
              </div>
          </div>
    </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
