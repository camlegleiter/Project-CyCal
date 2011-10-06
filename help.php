<?php
$title = "Help";
include ("includes/header.php");
?>

<script type="text/javascript">
	$(function() {
		$('div.helpcontent').hide();
	
	    $("a.topic").toggle(
			function () {
				$("div.helpcontent").hide("fast");
				$(this).next(".helpcontent").show("fast");
				return false;
			},
			function () {
				$(this).next(".helpcontent").hide("fast");
				return false;
			}                      
		);
	});
</script>

<div id="Container_Wide">
	<h1>Help Topics:</h1>
	(Click on a topic to expand the help content related to that topic)
	<ul>
		<li><h3>Registering and Logging In</h3>
			<ul>
				<li><a class="topic">Signing Up</a>
					<div class="helpcontent">
					Words!
					</div>
				</li>
				<li><a class="topic">Signing In</a>
					<div class="helpcontent">
					Words Again!
					</div>
				</li>
			</ul>
		</li>
		<li><h3>User Account Information</h3>
			<ul>
				<li><a class="topic">Editing Your Personal Settings</a>
					<div class="helpcontent">
					There will eventually be things and such here!
					</div>
				</li>
			</ul>
		</li>
		<li><h3>Canvas</h3>
			<ul>
				<li><a class="topic">Adding a New Feed</a>
					<div class="helpcontent">
					Information on feed stuffs
					</div>
				</li>
				<li><a class="topic">Removing an Existing Feed</a>
					<div class="helpcontent">
					Information on removing feeds
					</div>
				</li>
				<li><a class="topic">Connecting With Friends</a>
					<div class="helpcontent">
						<ul>
							<li><a>Facebook</a>
							Update ALL the statuses!
							</li>
							<li><a>Twitter</a>
							Tweet ALL the updates!
							</li>
							<li><a>Google+</a>
							+1 ALL the Things!
							</li>
						</ul>
					</div>
				</li>
			</ul>
		</li>
		<li><h3>Editing Your Panels</h3>
			<ul>
				<li><a class="topic">Basic Features</a>
					<div class="helpcontent"></div>
				</li>
				<li><a class="topic">Customizing Your Panels</a>
					<ul>
						<li><a class="topic">Changing Colors</a>
							<div class="helpcontent"></div>
						</li>
						<li><a class="topic">Articles</a>
							<div class="helpcontent"></div>
						</li>
						<li><a class="topic">Notifications</a>
							<div>
								<ul>
									<li><a>Email & SMS</a>
									<div class="helpcontent"></div>
									</li>
								</ul>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li><h3>Other</h3>
			<ul>
				<li>5</li>
			</ul>
		</li>		
	</ul>
</div>

<?php
include ("includes/footer.php");
?>