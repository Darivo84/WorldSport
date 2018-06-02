<div class="login">
    <!-- <img src="/images/logo.png"> -->
    <br>
    <br>

    @if (count($errors) > 0)
        <div class="alert adjusted alert-error">
                @foreach ($errors->all() as $error)
                    <i class="fa fa-exclamation-triangle"></i>
                            <strong>Error:</strong> {!! $error !!}<br>
                @endforeach
        </div>
    @endif

    @if(Session::has('message'))
        <div class="alert adjusted alert-success">
            <!-- <button class="close" data-dismiss="alert">×</button> -->
            <i class="fa fa-check-square-o"></i>
            <strong>Success: </strong> {{Session::get('message')}}
        </div>
    @endif
    
    <form method="POST" action="/login" class="login_form">        

        {!! csrf_field() !!}

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <br>
        <div>
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>

        <?php

            // if(isset($_GET['form']) && !empty($_GET['form'])) {
            //     $form = $_GET['form'];

            //     echo '<input type="hidden" name="form" value="'. $form .'">';
            // }
                

            // if(isset($_GET['id']) && !empty($_GET['id'])) {
            //     $id = $_GET['id'];
            //     echo '<input type="hidden" name="id" value="'. $id .'">';
            // }
                

        ?>

        <div>
            <button type="submit" class="default_btn">Login</button>
        </div>
    </form>
</div>

<style>
    /* LOGIN */

        body {
           background: url('/images/pw_maze_black.png'); 
        }

        .alert-error {
            text-align: center;
            color: #F21847;
        }

        .login {
            width: 350px;
            margin: 10% auto 0;
            background-color: #222;
            border: 1px solid #000;
            color: #fff;
            font-family: 'Open Sans';
            font-family: 'Arial';
        }

        .login_form {
            padding: 0 20px;
        }

        .login img {
            width: 100%;
        }

        .login_form div {
            padding: 10px;
        }

        .login_form div input[type='text'], .login_form div input[type='email'], 
        .login_form div input[type='password'] {
            padding: 5px;
            float: right;
        }

        .default_btn {
            display: inline-block;
            min-width: 150px;
            padding: 10px 20px;         
            margin: 5px;
            background-color: #0089ff;
            border: none;
            color: #fff;
            text-align: center;
            outline: none;
        }

    /* LOGIN */
</style>