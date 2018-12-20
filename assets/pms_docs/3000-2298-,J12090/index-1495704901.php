<?php 
$conn=mysqli_connect('localhost','root','','testing');
?>
<div>
<form name="myform" method="POST"  onSubmit="myFunction()">
<table>
<tr>
<td>
Username:
</td>
<td>
<input type="text" name="username"  required placeholder="Please Enter UserName">
</td>
</tr>
<tr>
<td>
Username:
</td>
<td>
<input type="password" name="password"  required placeholder="Please Enter password">
</td>
</tr>
<tr>
<td>
<input type="submit" name="submit" value="Submit">
</td>
</tr>

</table>
</form>

</div>
<?php
if(isset($_POST['submit']))
{
	$user=$_POST['username'];
	$pass=$_POST['password'];
	$iqry="insert into test(username,password) values('$user','$pass')";
	$exe=mysqli_query($conn,$iqry);
	if($exe)
	{
		echo "Success";
	}
	else
	{
		echo "Failed";
	}
}
?>
<script>
function  myFunction()
{
	var user=document.['myform']['username'].value;
	var pass=document.['myform']['password'].value;
	if(user.length<8)
	{
		alert("username must be 8 characters");
		document.username.focu;
		return false
	}
	if(pass.length<6 && pass.length>15)
	{
			alert("password must be 8 characters");
		document.username.focu;
		return false
	}
}
</script>