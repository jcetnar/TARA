<ul class='nav'> <!-- unordered list, list item -->
		<li>
			<a href='/status'>
				Status
			</a>
		</li>
		<li>
			<a href='/immediatetask'>
				Immediate Task
			</a>
		</li>
<!-- if ($_SESSION['user_admin'] ==0 { include ("views/user.php);} if ($_SESSION['user_admin'] ==1) { include("views/admin.php");
	<?php if ($isadmin): ?>
		<li>
			<a href='/items'>
				Items
			</a>
		</li>
		<li>
			<a href='/calendar'>
				Calendar
			</a>
		</li>
		<li>
			<a href='/contact'>
				Contact
			<!-- for emergency contact info -->
			</a>
		</li>
		<li>
			<a href='/logout'>
				Logout
			</a>
		</li>
	<?php else: ?>
		<li>
			<!-- absolute link has a / -->
		<!-- <a href='/login'>
				Login -->
			<a href='/user_registration'>
				User Registration
			</a>
		</li>
	<?php endif; ?>
</ul>
