<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{secure_asset('dbcss/second_page.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>anikmore</title>
</head>
<body>
    @if (Session::has('message'))

    <script>
       alert("{{session()->get('message')}}")
    </script>
        
    @endif
     
     <div class=" container">
        <div class="login">
            <h1>HELLO ANIKMORE</h1>
            <p>Welcome to our server</p>
           
             <div class="input">
                <button> UPLOAD</button><br>
                <form method="post" action="{{route('post_third_page')}}">
                    @csrf
                    <input type="hidden" name="servername" value="{{session()->get('servername')}}">
                    <input type="hidden" name="username" value="{{session()->get('username')}}">
                    <input type="hidden" name="password" value="{{session()->get('password')}}">

                <button type="submit">DOWNLOAD</button>
                </form>
             </div>
            </div>
        </div>
     </div>
    
    
</body>
</html>