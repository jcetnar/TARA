<nav class='navbar navbar-default">
	<div class="container-fluid">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-espanded="false">
			<span class="sr-only">Toggle navigation</span?
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">TARA</a>
	</div>
	<div class="collapse navbar-collapse" id="bs-example-navbar=collapse-1">
		<ul class="nav navbar-nav">
			<li class="active"><a href="#">Status <span class="sr-only"> (current)</span></a></li>
			<li><a href="/immediate">Request Immediate Task</a></li>
		</ul>
	</div>
	</div>
</nav>
<!--
<ul class='nav nav-pills'> 
		<li role ="presentation" class="active">
			<a href="/status">Status
			<!--   <button type="button" class="btn btn-default navbar-btn">Status</button> -->
			</a>
		</li>
		<li role ="presentation">
			<a href='/immediatetask'>
				Immediate Task
			</a>
		</li>
<!-- if ($_SESSION['user_admin'] ==0 { include ("views/user.php);} if ($_SESSION['user_admin'] ==1) { include("views/admin.php"); -->
	<?php if ($isadmin): ?>
		<li role="presentation">
			<a href='/items'>
				Items
			</a>
		</li>
		<li role="presentation">
			<a href='/calendar'>
				Calendar
			</a>
		</li>
		<li role="presentation">
			<a href='/contact'>
				Contact
			<!-- for emergency contact info -->
			</a>
		</li>
		<li role="presentation">
			<a href='/logout'>
				Logout
			</a>
		</li>
	<?php else: ?>
		<li role="presentation">
			<!-- absolute link has a / -->
		 <a href='/login'>
				Login
			</a>
		</li>
	<?php endif; ?>
</ul>
-->
