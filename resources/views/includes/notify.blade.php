<?php 
$msg = Session::get('msg');
$msg_content = Session::get('msg_content');
if($msg == "added") { ?> 
	<div class="alert alert-success" id="success-alert">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>Success! </strong>
	    {{$msg_content}}
	</div>
<?php } elseif($msg == "delete") { ?>
	<div class="alert alert-danger" id="success-alert">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>Success! </strong>
	    {{$msg_content}}
	</div>	
<?php } elseif($msg == 'error') { ?>
	<div class="alert alert-danger" id="success-alert">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>Error! </strong>
	    {{$msg_content}}
	</div>
<?php } elseif ($msg == "updated") { ?>
	<div class="alert alert-success" id="success-alert">
	    <button type="button" class="close" data-dismiss="alert">x</button>
	    <strong>Success! </strong>
	    {{$msg_content}}
	</div>
<?php } ?>