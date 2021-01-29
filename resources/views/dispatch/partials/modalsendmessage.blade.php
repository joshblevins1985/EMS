<!-- Modal -->
<div class="modal fade right" id="modalSendMessage" tabindex="-1" role="dialog" aria-labelledby="modalSendMessageLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalSendMessageLabel">Send Message to Crew</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
       <form action="dispatch/message" id="send_message" method="POST">    
        
        <!--Textarea with icon prefix-->
        <div class="row">
            <label for="form10">Message to Crew</label>
        </div>
        {{ csrf_field() }}
        <div class="md-form">
          <i class="fas fa-pencil-alt prefix"></i>
          <textarea id="message" name="message" class="md-textarea form-control" rows="3"></textarea>
          
        </div>
        
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
<!-- Modal -->