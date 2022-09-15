<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{secure_asset('dbcss/first_page.css')}}" rel="stylesheet">
    <title>anikmore</title>
</head>
<body>
   @if (Session::has('message'))

   <script>
      alert("{{session()->get('message')}}");
   <script>
       
   @endif
    
     <div class=" container">
        <div class="login">
         <form method="POST"  action="{{route('authentication')}}">  
            @csrf
            <h1>USER<br>AUTHENTICATION</h1>
            <div class="login-details">
            <div class="input">
                 <input type="text" placeholder="Your Servername" name="servername">
            </div>
            <div class="input">
                <input type="text" placeholder="Your Username" name="username">
             </div>
             <div class="input">
                <input type="password" placeholder="Your password" name="password">
             </div>
             <div class="input">
                <button type="submit"> SUBMIT</button>
             </div>
             
            </div>
         </form>


        </div>
     </div>
    
    
</body>
</html>