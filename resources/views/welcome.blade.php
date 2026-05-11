<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WellMeadows Hospital</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family: Arial, sans-serif;
            overflow:hidden;
        }

        .hero{
            width:100%;
            height:100vh;
            background-image: url('/images/background.jpg');
            background-size: cover;
            background-position: center;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:0 100px;
            position:relative;
        }

        .overlay{
            position:absolute;
            inset:0;
            background:rgba(0,0,0,0.4);
        }

        .login-box,
        .title-box{
            position:relative;
            z-index:2;
        }

        .login-box{
            width:300px;
            padding:20px;
            background:rgba(255,255,255,0.15);
            backdrop-filter: blur(10px);
            border-radius:20px;
            color:white;
        }

        .login-box h2{
            text-align:center;
            margin-bottom:10px;
        }

        .login-box p{
            text-align:center;
            margin-bottom:25px;
            font-size:14px;
        }

        .login-box input{
            width:100%;
            padding:12px;
            margin-bottom:15px;
            border:none;
            border-radius:10px;
            outline:none;
        }

        .buttons button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:10px;
            cursor:pointer;
            font-weight:bold;
            background:white;
        }

        .title-box{
            color:white;
            text-align:left;
            z-index:2;
            position:relative;
            margin-right:100px;
            margin-top:-30px;

            left:120px;
        }

        .brand-name{
            position:absolute;
            top:20px;
            right:80px;
            z-index:2;
            color:white;
            font-size:22px;
            font-weight:bold;
        }

        .brand-name span{
            color:#ef4444;
            right:50px;
}


        .title-box h1{
            font-size:63px;
            line-height:1.20;
            margin-bottom:10px;
            font-weight:800;
        }


        .title-box p{
            font-size:15px;
            font-weight:bold;
        }

        .logos{
            width:80px;
            display:block;
            margin:0 auto 20px auto;
        }


    </style>
</head>

<body>

    <div class="hero">

        <div class="overlay"></div>

        <div class="login-box">


            <img src="images/logo.png" class="logos">
            <h2>Welcome Back</h2>
            <p>Please login to continue</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="email" name="email" placeholder="Email" required>

                <input type="password" name="password" placeholder="Password" required>

                <div class="buttons">
                    <button type="submit">Login</button>
                </div>

                @error('email')
                    <p style="color:red; text-align:center; margin-top:10px;">
                        {{ $message }}
                    </p>
                @enderror
            </form>

        </div>

        <div class="brand-name">
            Well<span>Meadows</span>
        </div>

        <div class="title-box">
            <h1>
                Your Partner in<br>
                Better Healthcare
            </h1>

    <p>
        Smart solutions for efficient and compassionate healthcare management.
    </p>
</div>

    </div>

</body>
</html>