<!-- Modal -->
<div class="modal fade" id="completeCourse" tabindex="-1" role="dialog" aria-labelledby="completeCourse" aria-hidden="true">
  <div class="modal-dialog modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="completeCourse">Student Course Completion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="{{ route('enrolled.complete') }}" method="POST" >
                        {{csrf_field()}}
                        
                        <input type="hidden" name="class_id" id="classId" value="">
                        <input type="hidden" name="user_id" id="userId" value="">
                        
                        <div class="md-form">
                            <input placeholder="Date of Completion" type="text" id="date" name="date" data-value="{{$class->end or ''}}" class="form-control datepicker">
                            <label for="date" >Date of Completion</label>
                        </div>

                        
                            


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Complete Course</button>

                    </form>
    </div>
  </div>
</div>
</div>