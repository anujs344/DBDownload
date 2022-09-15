<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{secure_asset('dbcss/third_page.css')}}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <title>anikmore</title>
</head>
<body>
    
     <div class=" container">
        <div class="login">
             <img src="{{secure_asset('images/database.svg')}}">
            <h1>WELCOME TO OUR SERVER</h1>
            <p class="subhead">You can download your databases</p>
            <div class="login-details">
                <div class="options">
                    <p>Select databases you have to download</p>
                    <form action="{{route('post_third_page')}}" method="post">
                        <input type="hidden" name="servername" value="{{session()->get('servername')}}">
                    <input type="hidden" name="username" value="{{session()->get('username')}}">
                    <input type="hidden" name="password" value="{{session()->get('password')}}">
                        @csrf
                        <select class="form-select" aria-label="Default select example" name="dbname" onchange="this.form.submit()">
                            @if (isset($option))
                                <option selected>{{$option}}</option>
                            @else
                                
                            <option selected>Select Databases</option>
                            @endif
                            @foreach ($group_arr as $item)
                            <option value="{{$item}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </form>
                    
                </div>

                <form method="POST" action="{{route('download')}}">
                    @csrf

                <div class="options">
                    <p>Choose Table from the databases</p>
                    @if (isset($option))
                    
                    <input type="hidden" name="dbname" value="{{$option}}">             
                    <input type="hidden" name="servername" value="{{session()->get('servername')}}">
                    <input type="hidden" name="username" value="{{session()->get('username')}}">
                    <input type="hidden" name="password" value="{{session()->get('password')}}">           
                    @endif
                    <select class="form-select" aria-label="Default select example" name="tablename">
                        @if (isset($option))

                        @foreach ($group_table as $item)
                        <option value="{{$item}}">{{$item}}</option>                                                        
                        @endforeach
                        @else
                        <option value="">Please select database</option>                            
                        @endif
                    </select>
                </div>

                <div class="options">
                    <p>Select file format to downlaod</p>
                    <select class="form-select" aria-label="Default select example" name="type" required>
                        @if (isset($option))
                        <option value="csv">CSV</option>
                        <option value="pdf">PDF</option>
                        <option value="txt">DOCS</option>
                    @else
                        
                    <option selected value="null">Select File formats</option>
                    @endif
                       
                    </select>
                    
                </div>

                <button type="submit">DOWNLOAD</button>
                <span class="badge bg-secondary"></span>
                </form>

        </div>
     </div>
     </div>
    
    
</body>
</html>