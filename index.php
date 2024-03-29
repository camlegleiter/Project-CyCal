<?php
require("includes/registerFunctions.php");

$title = "CyCal";
include 'includes/header.php';
?>
	<div id="Container_Skinny">
		<div id="MainContainer">
			<h2 style="text-align:center" id="LoginRegisterTxt">Login</h2>
			<form method='POST'>
				<?php
					/*foreach($errorarray as $value)
						echo "<p class='error' align='center'>$value</p>";
					if ($successmsg != "")
						echo "<p class='success' align='center'>$successmsg</p>";
					unset($errorarray);
					unset($successmsg);*/
					if($_SESSION['msg']['login-err'])
					{
						echo '<div class="error"><p>'.$_SESSION['msg']['login-err'].'</p></div>';
						unset($_SESSION['msg']['login-err']);
					}
					else if ($_SESSION['msg']['reg-success'])
					{
						echo '<div class="success"><p>'.$_SESSION['msg']['reg-success'].'</p></div>';
						unset($_SESSION['msg']['reg-success']);
					}
					if($_SESSION['msg']['reg-err'])
					{
						echo '<div class="error"><p>'.$_SESSION['msg']['reg-err'].'</p></div>';
						unset($_SESSION['msg']['reg-err']);
					}
				?>
				<fieldset>
					<table cellspacing="10px" cellpadding="10px">
						<tr>
							<td>
								<input type='text' id="textbox" name='username' onFocus="if(this.value=='Username')this.value='';" 
									onblur="if(this.value == ''){ this.value = 'Username';}" value="Username">
							</td>
						</tr>
						<tr>
							<td>
								<input type='text' id="textbox" name='password' onFocus="if(this.value=='Password'){this.value=''};this.type='password';" 
									onblur="if(this.value == ''){ this.value = 'Password';this.type='text'}" value="Password">
							</td>
						</tr>
						
							<tr>
								<td>
									<div id="RegisterDivPass">
										<input type='text' id="textbox" name='passwordagain' onFocus="if(this.value=='Confirm Password'){this.value=''};this.type='password';" 
											onblur="if(this.value == ''){ this.value = 'Confirm Password';this.type='text'}" value="Confirm Password">
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div id="RegisterDivBeta">
										<input type='text' id="textbox" name='betaKey' onFocus="if(this.value=='Beta Key')this.value='';" 
											onblur="if(this.value == ''){ this.value = 'Beta Key';}" value="Beta Key">
									</div>
								</td>
							</tr>
							<tr>
								<td align="center">
									<input type='submit' class="submit" id="submitButton" name='submit' value='Login'>
									<input type='button' class="register" id="registercancelButton" name='register' value='RegisterToggle'>	
								</td>
							</tr>
					</table>
				</fieldset>
			</form>
		</div>
	</div>
	
	<?php 
		include 'news.php';
	?>
	
	<script type="text/javascript">
		$(document).ready(function(){
			var regShow = false;
			
			<?php
				if ($_SESSION['msg']['formtype'] != 'register')
				{
					echo "
						$('#RegisterDivPass').hide();
						$('#RegisterDivBeta').hide();
					";
				}
				else
				{
					echo "
						regShow = true;
						//$('#submitOnlyButton').attr('name','submit');
						$('#submitButton').attr('value','Register');
						$('#registercancelButton').attr('class', 'cancel');
						$('#LoginRegisterTxt').html('Register');
					";
				}
			?>
			$('#registercancelButton').click(function(){
				if (regShow)
				{
					//$('#RegisterDivBeta').hide('fade',{},500,function(){$('#RegisterDivPass').hide('fade',{},500);});
					$('#RegisterDivBeta').hide();//'fade',{},500);
					$('#RegisterDivPass').hide();//'fade',{},500);
					regShow = false;
					//$('#submitOnlyButton').attr('name','submit');
					$('#submitButton').attr('value','Login');
					$('#registercancelButton').attr('class', 'register');
					$('#LoginRegisterTxt').html('Login');
				}
				else
				{
					//$('#RegisterDivPass').show('fade',{},500,function(){$('#RegisterDivBeta').show('fade',{},500);});
					$('#RegisterDivPass').show('fade',{},500);
					$('#RegisterDivBeta').show('fade',{},500);
					regShow = true;
					//$('#submitOnlyButton').attr('name','submit');
					$('#submitButton').attr('value','Register');
					$('#registercancelButton').attr('class', 'cancel');
					$('#LoginRegisterTxt').html('Register');

				}
				//location.href='register.php';
			});			
			
		});
	</script>

<?php
include 'includes/footer.php';
?>