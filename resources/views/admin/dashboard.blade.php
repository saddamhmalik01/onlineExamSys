<html>
   <head>
    <title> Admin Dashboard </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
   </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid bg-info" style="height: 100px">
          <a class="navbar-brand" href={{ route('dashboard')}}>Admin Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('viewstudents')}}">Students</a>
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
              <div style="border: 1px solid" class="col-lg-3">
                  <h3 class="h3"> Admin Profile</h3>
                  <label>ID:{{$admin['id']}} </label><br><hr>
                  <label>Name:{{$admin['name']}} </label><br><hr>
                  <label>Email:{{$admin['email']}} </label><br><hr>
                  <label>Role:{{$admin['role']}} </label><br><hr>
                  <label>Created At:{{$admin['created_at']}} </label><br><hr>
                  <label>Updated At:{{$admin['updated_at']}} </label><br><hr>
                  <button class="btn btn-primary" style="margin-left: 50px"><a href="changepassword">Change Password</a></button><hr>

              </div>
              <div style="border: 1px solid" class="col-lg-9"><br>
                <span><strong> All Teachers    </strong></span><button class="btn btn-primary">       <a style="text-decoration: none; color:white" href="createuser">Create New Teacher </a></button>
                    <br><br>
                     <table class="table" border="1">
                        <tr>
                            <th>ID </th>
                            <th>Name </th>
                            <th>Email </th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Edit</th>
                            <th>Delete </th>
                        </tr>
                        {{-- @foreach($data as $datas) --}}
                        @foreach($data as $user)
                         <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td> {{$user->email}}  </td>
                            <td> {{$user->role}}  </td>
                            <td>  {{$user->created_at}} </td>
                            <td> {{$user->updated_at}}  </td>
                            <td><a href="edit/{{$user->id}}"><button class="btn btn-primary">Edit</button></a></td>
                            <td><a href="delete/{{$user->id}}"><button class="btn btn-primary">Delete</button></a></td>
                        </tr>
                         @endforeach
                         {{-- @endforeach --}}
                     </table>
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
