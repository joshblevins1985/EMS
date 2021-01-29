<form action="/assetSupportNote" method="post">
    
    @csrf
    <input type="hidden" id="ticketId" name="ticketId" value="">
   
    
    
    <!-- begin panel -->
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title">Support Ticket Note.</h4>
			
		</div>
		<div class="panel-body">
				<textarea class="textarea form-control wysihtml5"  name="description" placeholder="Enter a description of the problem you are experiencing." rows="12"></textarea>
		</div>
	</div>
	<!-- end panel -->
	
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block">Submit New Support Note</button>
    </div>
    
</form>