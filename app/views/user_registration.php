<!DOCKTYPE HTML PUBLIC>
<html>
<head>

<title>Admin Page</title> 
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript" src="../jquery.autocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="../jquery.autocomplete.css" />

<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#log").attr("action"), $("#log").serialize(), function(data){

		});
		return false;
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {

		$.post($("#tables").attr("action"), $("#tables").serialize(), function(data) {
		});
		return false;
	});
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#createtable").attr("action"), $("#createtable").serialize(), function(data) {
		});
		return false;
	});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#deletetable").attr("action"), $("#deletetable").serialize(), function(data) {
		});
		return false;
	});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#unassign").attr("action"), $("#unassign").serialize(), function(data) {
		});
		return false;
	});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#edittable").attr("action"), $("#edittable").serialize(), function(data) {
		});
		return false;
	});
});
</script>


<script type="text/javascript">
$(document).ready(function(){
	$("#html-form").submit(function() {
		$.post($("#save_edit").attr("action"), $("#save_edit").serialize(), function(data) {
		});
		return false;
	});
});
</script>
</head>

