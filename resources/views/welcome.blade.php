<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wellmeadows Hospital</title>

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
            width:350px;
            padding:40px;
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
            text-align:center;

            /* MOVE TITLE HERE */
            margin-right:100px;
            margin-top:-50px;
        }

        .title-box h1{
            font-size:70px;
            margin-bottom:20px;
        }

        .title-box p{
            font-size:22px;
        }

    </style>
</head>

<body>

    <div class="hero">

        <div class="overlay"></div>

        <div class="login-box">

            <h2>Welcome Back</h2>
            <p>Please login to continue</p>

            <form>
                <input type="text" placeholder="Username">
                <input type="password" placeholder="Password">

                <div class="buttons">
                    <button type="submit">Login</button>
                </div>
            </form>

        </div>

        <div class="title-box">

            <h1>
                Wellmeadows<br>
                Hospital
            </h1>

            <p>24/7 Emergency Services Available</p>

        </div>

    </div>

</body>
</html>