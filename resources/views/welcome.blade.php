<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

    <style>
        body{
            margin: 0;
            display:flex; 
            height: 100vh;
            justify-content:center;
            aligh-items: center;
        }

        a{
            background-color: white;
            padding: 10px 40px;
            border: none;
            outline: none;
            border: 1px solid grey;
            height: 2rem !important;
            display: inline-block;
            margin-top: 17rem;
            cursor: pointer;
            border-radius: 10px;
        }
    </style>
<body>

    <a href="{{ route('google-auth') }}">
        Login With Google
    </a>
</body>
</html>