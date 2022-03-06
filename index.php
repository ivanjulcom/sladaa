<?php 
require 'include/dbconfig.php';
require 'include/Common.php';

if(isset($_SESSION['username']))
{
	?>
	<script>
	window.location.href="dashboard.php";
	</script>
	<?php 
}
else 
{
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
<meta charset="UTF-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
<title>Login Page - <?php echo $set['d_title'];?></title>
<link rel="shortcut icon"  href="<?php echo $set['logo'];?>">
<!-- General CSS Files -->
<link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
<link rel="stylesheet" href="assets/modules/izitoast/css/iziToast.min.css">
<!-- CSS Libraries -->
<link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<link rel="stylesheet" href="assets/css/components.min.css">

<style type="text/css">
	body .login {
    opacity: 1;
    top: 20px;
    -webkit-transition-timing-function: cubic-bezier(0.68, -0.25, 0.265, 0.85);
    -webkit-transition-property: opacity,box-shadow,top,left,-webkit-transform;
    transition-property: opacity,box-shadow,top,left,-webkit-transform;
    transition-property: transform,opacity,box-shadow,top,left;
    transition-property: transform,opacity,box-shadow,top,left,-webkit-transform;
    -webkit-transition-duration: .5s;
    transition-duration: .5s;
    -webkit-transform-origin: 161px 100%;
    transform-origin: 161px 100%;
    -webkit-transform: rotateX(0deg);
    transform: rotateX(0deg);
    position: relative;
    width: 320px;
    height: 480px;
    position: absolute;
    left: 0;
    right: 0;
    margin: auto;
    top: 0;
    bottom: 0;
}
	body {
  -webkit-perspective: 800px;
          perspective: 800px;
  height: 100vh;
  margin: 0;
  overflow: hidden;
  font-family: 'Gudea', sans-serif;
  background: #EA5C54;
  /* Old browsers */
  /* FF3.6+ */
  /* Chrome,Safari4+ */
  /* Chrome10+,Safari5.1+ */
  /* Opera 11.10+ */
  /* IE10+ */
  background:linear-gradient(0deg, rgba(0, 0, 0, 0.8), rgba(203, 255, 219, 0.7)),url(assets/img/bg-login.jpg);
  /* W3C */
  /* IE6-9 fallback on horizontal gradient */
}
body ::-webkit-input-placeholder {
  color: #4E546D;
}
*, *:before, *:after {
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  font-family: 'Nunito', sans-serif;
  color: #384047;
}

form {
  max-width: 300px;
  margin: 10px auto;
  padding: 20px;
  background: #f4f7f8;
  border-radius: 15px;
  box-shadow: 10px 20px 40px #545454;
}

h1 {
  margin: 0 0 30px 0;
  text-align: center;
}

input[type="text"],
input[type="password"],
input[type="date"],
input[type="datetime"],
input[type="email"],
input[type="number"],
input[type="search"],
input[type="tel"],
input[type="time"],
input[type="url"],
textarea,
select {
  background: rgba(255,255,255,0.1);
  border: none;
  font-size: 16px;
  height: auto;
  margin: 0;
  outline: 0;
  padding: 10px;
  width: 100%;
  background-color: #e8eeef;
  color: #000000;
  box-shadow: 0 1px 0 rgba(0,0,0,0.03) inset;
  margin-bottom: 10px;
}

input[type="radio"],
input[type="checkbox"] {
  margin: 0 4px 8px 0;
}

select {
  padding: 6px;
  height: 40px;
  border-radius: 2px;
}

.button {
  padding: 5px;
  color: #FFF;
  background-color: #4bc970;
  font-size: 18px;
  text-align: center;
  font-style: normal;
  border-radius: 5px;
  width: 100%;
  border: 1px solid #3ac162;
  border-width: 1px 1px 3px;
  box-shadow: 0 -1px 0 rgba(255,255,255,0.1) inset;
  margin-bottom: 10px;
}

fieldset {
  margin-bottom: 30px;
  border: none;
}

legend {
  font-size: 1.4em;
  margin-bottom: 10px;
}

label {
  display: block;
  margin-bottom: 8px;
}

label.light {
  font-weight: 300;
  display: inline;
}

.number {
  background-color: #5fcf80;
  color: #fff;
  height: 30px;
  width: 30px;
  display: inline-block;
  font-size: 0.8em;
  margin-right: 4px;
  line-height: 30px;
  text-align: center;
  text-shadow: 0 1px 0 rgba(255,255,255,0.2);
  border-radius: 100%;
}

@media screen and (min-width: 480px) {

  form {
    max-width: 480px;
  }

}
</style>
</head>

<body class="layout-4">

<div id="app">
	
<div class='login align'>
  
  <div class='login_fields'>
  	 <form method="POST" action="#">
  	 	<div class='login_title text-center'>
  	<img src="<?php echo $set['logo']; ?>" style="width:120px"  class=" mb-3"><br>
    <h6>Login to your Dashboard</h6>
  </div>
    <div class='login_fields__user'>
     
      <input placeholder='Username' type='text' name="username" tabindex="1" required autofocus>
       
      </input>
    </div>
    <div class='login_fields__password'>
      
      <input placeholder='Password' type='password' name="password" tabindex="2" required>
      
    </div>
	 <div class='login_fields__password'>
	 <select name="ltype" required>
	 <option value="">Select Role</option>
	 <option value="Admin">Admin</option>
	 <option value="Vendor">Vendor(Store)</option>
	 <option value="D_boy">Delivery Manager</option>
	 </select>
	 </div>
    <div class='login_fields__submit'>
      <input type='submit' value='Log In' class="button" name="sub_login">
      
    </div>
</form>
  </div>
  
</div>

	<?php 
	if(isset($_POST['sub_login']))
	{
	    
		$username = $_POST['username'];
		$password = $_POST['password'];
	
	 $h = new Common();
	 if($_POST['ltype'] == 'Admin')
	 {
	 $count = $h->Login($username,$password,'admin');
 if($count != 0)
 {
	 $_SESSION['username'] = $username;
	 $_SESSION['ltype'] = $_POST['ltype'];
	 ?>
	  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome Admin!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="dashboard.php"},3000);
	 </script>
	 <?php 
 }
 else 
 {
	 ?>
	 <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Wrong Data Enter!',
    message: 'Please Use Valid Data!!',
    position: 'topRight'
  });
	 </script>
	 <?php 
 }
	 }
	 else if($_POST['ltype'] == 'Vendor')
	 {
		$count = $h->Login($username,$password,'vendor');
 if($count != 0)
 {
	 $_SESSION['username'] = $username;
	 $_SESSION['ltype'] = $_POST['ltype'];
	 ?>
	  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome vendor!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="dashboard.php"},3000);
	 </script>
	 <?php 
 }
 else 
 {
	 ?>
	 <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Wrong Data Enter!',
    message: 'Please Use Valid Data!!',
    position: 'topRight'
  });
	 </script>
	 <?php 
 } 
	 }
	  else if($_POST['ltype'] == 'D_boy')
	 {
		$count = $h->Login($username,$password,'rider');
 if($count != 0)
 {
	 $_SESSION['username'] = $username;
	 $_SESSION['ltype'] = $_POST['ltype'];
	 ?>
	  <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.success({
    title: 'Login Successfully!!',
    message: 'Welcome Delivery Manager!!',
    position: 'topRight'
  });
	 
	 setTimeout(function(){ 
	 window.location.href="dashboard.php"},3000);
	 </script>
	 <?php 
 }
 else 
 {
	 ?>
	 <script src="assets/modules/izitoast/js/iziToast.min.js"></script>
	 <script>
 iziToast.error({
    title: 'Wrong Data Enter!',
    message: 'Please Use Valid Data!!',
    position: 'topRight'
  });
	 </script>
	 <?php 
 } 
	 }
	 else 
	 {
		 
	 }
		
	}
	?>
</div>

<!-- General JS Scripts -->
<?php require 'include/footer.php';?>

<script type="text/javascript">

$('input[type="text"],input[type="password"]').focus(function(){
  $(this).prev().animate({'opacity':'1'},200)
});
$('input[type="text"],input[type="password"]').blur(function(){
  $(this).prev().animate({'opacity':'.5'},200)
});

$('input[type="text"],input[type="password"]').keyup(function(){
  if(!$(this).val() == ''){
    $(this).next().animate({'opacity':'1','right' : '30'},200)
  } else {
    $(this).next().animate({'opacity':'0','right' : '20'},200)
  }
});

var open = 0;
$('.tab').click(function(){
  $(this).fadeOut(200,function(){
    $(this).parent().animate({'left':'0'})
  });
});


</script>
</body>


</html>