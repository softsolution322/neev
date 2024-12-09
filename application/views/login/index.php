<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>
  <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/log_images/icons/favicon.ico"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link href="<?php echo base_url(); ?>assets/log_css/style.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/log_css/animate.min.css" rel="stylesheet" type="text/css">
  <link href="//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Monoton' rel='stylesheet' type='text/css'>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
 <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Roboto Condensed', sans-serif;
        background-color: #f5f5f5; /* Lighter, more neutral background */
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background: linear-gradient(145deg, #f5f5f5, #e0e5ec); /* Gradient for a soft look */
    }

    h1, h2 {
        text-align: center;
        color: #333; /* Darker text for contrast */
    }

    .main-w3layouts {
        background: rgba(255, 255, 255, 0.3); /* Lighter transparent background for a glowing effect */
        border-radius: 25px;
        padding: 50px;
        width: 100%;
       
        text-align: center;
        box-shadow: 
            8px 8px 20px rgba(0, 0, 0, 0.1), /* Softer shadow for a more elegant depth */
            -8px -8px 20px rgba(255, 255, 255, 0.6); /* Highlight shadow for 3D glass effect */
        backdrop-filter: blur(25px); /* Stronger blur effect */
        -webkit-backdrop-filter: blur(25px); /* For Safari */
        position: relative;
        animation: slideUp 0.5s ease-out;
    }

    /* Animation to create a smooth appearance */
    @keyframes slideUp {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    h1 {
        font-family: 'Monoton', cursive;
        font-size: 3rem;
        margin-bottom: 20px;
        color: #333;
    }

    h2 {
        font-size: 1.5rem;
        margin-bottom: 25px;
        font-weight: 400;
        color: #555;
    }

    label {
        color: #333;
        font-weight: 600;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"],
    input[type="password"] {
        background: rgba(255, 255, 255, 0.4); /* Lighter transparent inputs */
        border: none;
        border-radius: 12px;
        padding: 15px;
        width: 100%;
        margin: 10px 0;
        color: #333;
        font-size: 16px;
        box-shadow: 
            inset 4px 4px 8px rgba(0, 0, 0, 0.2), 
            inset -4px -4px 8px rgba(255, 255, 255, 0.5); /* Soft inner shadow */
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        outline: none;
        box-shadow: 
            inset 4px 4px 8px rgba(0, 0, 0, 0.3),
            inset -4px -4px 8px rgba(255, 255, 255, 0.7); /* Darker focus shadow for emphasis */
    }

    input[type="submit"] {
        background: #5f6368;
        color: #fff;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 12px;
        font-size: 18px;
        cursor: pointer;
        box-shadow: 
            4px 4px 8px rgba(0, 0, 0, 0.2), 
            -4px -4px 8px rgba(255, 255, 255, 0.5); /* Light elevated effect */
        transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
        background: #4a4d53;
        box-shadow: 
            4px 4px 10px rgba(0, 0, 0, 0.3), 
            -4px -4px 10px rgba(255, 255, 255, 0.6); /* Darker hover effect */
    }

    .wthree-text {
        margin-top: 20px;
    }

    p {
        font-size: 0.9rem;
        margin-top: 10px;
    }

    a {
        color: #5f6368;
        text-decoration: none;
        font-weight: 600;
    }

    a:hover {
        color: #333;
    }

    .msg {
        color: #661a00;
        font-weight: bold;
        text-align: center;
        margin-top: 10px;
        display: none;
    }

    .background-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #f5f5f5; /* Matching gradient background */
        z-index: -1;
    }
	  .agileits-top {
        background: rgba(255, 255, 255, 0.2); /* Slightly more transparent background */
        border-radius: 25px; /* Rounded corners */
        padding: 40px;
        max-width: 100%;
        width: 100%;
        box-shadow: 
            8px 8px 20px rgba(0, 0, 0, 0.1), /* Subtle shadow to give depth */
            -8px -8px 20px rgba(255, 255, 255, 0.5); /* Highlighted shadow for 3D effect */
        backdrop-filter: blur(25px); /* Glass effect with backdrop blur */
        -webkit-backdrop-filter: blur(25px); /* Safari support */
        text-align: center;
        position: relative;
        margin-top: 30px;
        animation: fadeIn 0.5s ease-out;
    }

    /* Fade-in animation for smooth appearance */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(50px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .agileits-top h1 {
        font-family: 'Monoton', cursive;
        font-size: 3rem;
        color: #333;
        margin-bottom: 20px;
    }

    .agileits-top p {
        font-size: 1rem;
        color: #555;
        margin-bottom: 25px;
        font-weight: 400;
    }

    .agileits-top a {
        font-size: 1.1rem;
        color: #5f6368;
        text-decoration: none;
        font-weight: 600;
    }

    .agileits-top a:hover {
        color: #333;
    }
</style>

</head>
<body>
  <div class="main-w3layouts wrapper"> 
    <h1><b>NEEV</b></h1><br>
    <h2><b>A STRONG FOUNDATION</b></h2>
    <h1>LOGIN</h1>
    <div class="main-agileinfo animated bounceIn">
      <?php if ($this->session->flashdata('msg')) { 
        echo $this->session->flashdata('msg');
      } ?>
      <form method="post" action="<?php echo base_url('login/loggedIn'); ?>">
        <div class="agileits-top"> 
          <label for="username">Username</label>
          <input class="text" type="text" name="Username" onkeyup="this.value = this.value.toUpperCase();" id="username" placeholder="Employee ID" autocomplete="off" value="<?php echo set_value('Username'); ?>"><br /><br />
          <label for="pass">Password</label>
          <input class="text" type="password" name="pass" id="pass" placeholder="Password" value="<?php echo set_value('pass'); ?>">
          <div class="wthree-text">    
            <div class="clear"></div>
          </div>   
          <input type="submit" value="SIGN IN" class="animated heartBeat delay-2s">
          <p><a href="<?php echo base_url('forgot_password/Forgot_password'); ?>">Forgot Password?</a></p>
          <p><center><div class="msg" id="msg">Incorrect Username or Password !!</div></center></p>
        </div>   
      </form>
    </div>
  </div>

  <script>
    function log() {
      var username = $("#username").val();
      var pass = $("#pass").val();
      $.post({
        url: "<?php echo base_url(); ?>Login/logg",
        type: "POST",
        data: {username: username, pass: pass},
        success: function(data) {
          if (data == 'Fees') {
            window.location = "<?php echo base_url('Login/fees_dashboard'); ?>";
          } else if (data == 'Teacher') {
            window.location = "<?php echo base_url('Login/teacher_dashboard'); ?>";
          } else if (data == 'Payroll') {
            window.location = "<?php echo base_url('Login/payroll_dashboard'); ?>";
          } else {
            $("#msg").show();
            $("#username").val('');
            $("#pass").val('');
            $("#msg").attr('class', 'animated infinite bounceIn');
          }
        }
      });
    }
  </script>
</body>
</html>
