
<html>
    <head>
     <title> Student Dashboard </title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
 <body>
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
         <div class="container-fluid bg-info" style="height: 100px">
           <a class="navbar-brand" href="#">Student Dashboard</a>
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
           <form class="d-flex">
            <a style="color:black" href="logout">Logout</a>
        </form>
         </div>

     </nav>
     @if(count($test)!==0)
     <form action="submittest" method="POST">
         @csrf
        <p hidden>{{$i=1;}}</p>
        <label> Class: {{$class}}<br>

        @foreach($test as $test)<br>
        <label style="margin-left: 10px">{{$i}}: {{$test->Question}}?</label><br>

        <input type="radio" name="ans{{$i}}" value='a'>
        <label for="html">{{$test->a}}</label><br>

        <input type="radio" name='ans{{$i}}' value='b'>
        <label>{{$test->b}}</label><br>

        <input type="radio" name='ans{{$i}}' value='c'>
        <label>{{$test->c}}</label><br>

        <input type="radio" name='ans{{$i}}' value='d'>
        <label>{{$test->d}}</label>
        <p hidden>{{$i++;}}</p>
        @endforeach
        <input type="text" name="no" value="{{$i-1}}" hidden>
        <input type="text" name="class" value="{{$class}}" hidden>
        <br>
        <button type="submit" >Submit Test</button>
     </form>
     @else
     <div style="margin-left: auto; margin-right:auto; display:bloc; max-width:500px">
     <p style="margin-top: 30px"><b><b> ***************Exam is not yet scheduled**************** </b></p>
        <p style="margin-left:120px"> Kindly try after some time </p></b>
     </div>
     @endif





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
     margin-left: 52px;
 }
 a{
     text-decoration: none;
     color: white;
 }
 div{
     border-radius: 5px;
 }
 p{

 }
 </style>

