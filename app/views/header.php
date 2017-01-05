<ul class='nav nav-pills'> <!-- unordered list, list item -->
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
<!-- if ($_SESSION['user_admin'] ==0 { include ("views/user.php);} if ($_SESSION['user_admin'] ==1) { include("views/admin.php");
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
		<!-- <a href='/login'>
				Login -->
			<a href='/user_registration'>
				User Registration
			</a>
		</li>
	<?php endif; ?>
</ul>
