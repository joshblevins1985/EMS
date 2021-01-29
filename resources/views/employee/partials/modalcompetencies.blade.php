<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalCompetency" tabindex="-1" role="dialog" aria-labelledby="exampleCompetency"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Competencies</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                <!--Panel-->
                <div class="card">
                    <div class=" card-header primary-color-dark white-text">
                        Employee Competencies
                    </div>
                    <div class="card-body">
                        
                            @foreach($competencies as $row)
                            <div class="row">
                            <div class="col-lg-3">
                                {{$row->competency->label}}
                            </div>
                            
                            
                            <div class="col-lg-9">
                                
                                    <form action="/emp/competency/complete" method="post" id="my_form">
                                        <div class="row">
                                    <div class="col-lg-6">
                                    <input placeholder="Selected date" type="text" id="completed" name="completed" value="@if($row->completed) {{Carbon\Carbon::parse($row->completed)->format('m/d/Y')}} @else @endif" class="form-control datepicker">
                                      <label for="date-picker-example">Date Completed</label>
                                    <input type="hidden" name="id" value="{{$row->id}}" >
                                    <input type="hidden" name="user_id" value="{{$employees->user_id}}" >
                                    </div>
                                    <div class="col-lg-6">
                                    <input type="submit" class="btn"  name="submit" value="Submit Row" />
                                <div id="server-results"><!-- For server results --></div>
                                </div>
                                </div>
                                </form>
                                
                                
                                
                                
                            </div>
                            </div>
                            @endforeach
 

                    </div>
                    <div class="card-footer text-muted primary-color-dark white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->

            </div>

            <!--Footer-->
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->
<script>
$("#my_form").submit(function(event){
	event.preventDefault(); //prevent default action 
	var post_url = $(this).attr("action"); //get form action url
	var request_method = $(this).attr("method"); //get form GET/POST method
	var form_data = $(this).serialize(); //Encode form elements for submission
	
	$.ajax({
		url : post_url,
		type: request_method,
		data : form_data
	}).done(function(response){ //
		$("#server-results").html(response);
	});
});

</script>