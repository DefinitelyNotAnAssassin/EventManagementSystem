<div class="container-fluid">
	<?php session_start()

	?>
	<form action="" id="manage-register">
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<input type="hidden" name="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] :'' ?>">
		<input type="hidden" name="user_id" value = "<?php echo isset($_SESSION['login_id']) ? $_SESSION['login_id'] : '' ?>">
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			
			<input type="text" class="form-control" name="name"  value="<?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] :'' ?>" required>
		</div>
		
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
	</form>
</div>
<script>
	 $('.datetimepicker').datetimepicker({
	      format:'Y/m/d H:i',
	      startDate: '+3d'
	  })
	$('#manage-register').submit(function(e){
		e.preventDefault()
		start_load()
		$('#msg').html('')
		$.ajax({
			url:'admin/ajax.php?action=save_register',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Registration Request Sent.",'success')
						end_load()
						uni_modal("","register_msg.php")

				}
				else if (resp == 2){
					alert_toast("You have already registered for this event.",'info')
						end_load()
				}
			}
		})
	})
</script>