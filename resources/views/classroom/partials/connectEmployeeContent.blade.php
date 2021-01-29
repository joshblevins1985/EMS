<script src="/public/assets/plugins/select2/dist/js/select2.min.js"></script>
<form action="/classroom/connectEmployee" method="post">
                    @csrf
                    
                    <input type="hidden" name="student_id" value ="{{ $id }}" />
                    
                    <div class="form-group row">
							<label class="col-lg-4 col-form-label">Select Employee To Match</label>
							<div class="col-lg-8">
								<select class="default-select2 form-control" name="user_id">
								    @foreach($employees as $row)
									<option value="{{ $row->user_id }}">{{ $row->last_name }}, {{ $row->first_name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary">Submit Update</button>
                </form>
                
                
                    <script>
        var handleSelect2 = function() {
        	$(".default-select2").select2();
        
        };
        
        var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
  
    			handleSelect2();
    
    		}
    	};
    }();
    
    $(document).ready(function() {
    	FormPlugins.init();
    });
    </script>