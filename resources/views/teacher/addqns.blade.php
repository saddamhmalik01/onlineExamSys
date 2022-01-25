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
                <a class="nav-link" aria-current="page" href="{{route('dashboardTeacher')}}">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('viewteacher')}}"">Students</a>
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
              <div class=" form col" style="max-width: 900px">
                <h3 class="h3">Add Questions</h3>
                <form action="addquestion" method="post" style="border: 1px solid; padding: 15px; border-radius:10px">
                    @csrf
                    <input required hidden type="text" name='class' value={{$class}}><br>
                    <input required hidden type="text" name='no' value={{$qns}}><br>

                    @for($x = 0; $x <$qns;$x++)
                    <label>Question:{{$x+1}}</label>
                    <input required style="width: 510px" type="text" name='qns{{$x}}'><br><br>
                    <label>Option A:</label>
                    <input required style="margin-left: 10px" type="text" name='a{{$x}}'>
                    <label>Option B:</label>
                    <input required type="text" name='b{{$x}}'><br><br>
                    <label>Option C:</label>
                    <input required style="margin-left: 10px" type="text" name='c{{$x}}'>
                    <label>Option D:</label>
                    <input required type="text" name='d{{$x}}''><br><br>
                    <label>Answer:</label>
                    <select style="width: 100px; margin-left:120px" required class="form-select" name='ans{{$x}}' aria-label="Default select example">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                      </select>
                    <hr>
                    @endfor
                    <button style="margin-left:300px; width:200px" type="submit" class="btn btn-primary">Submit</button>
                </form>





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
</style>

