<!-- Modal -->
<div class="modal fade top" id="applicationModal" tabindex="-1" role="dialog" aria-labelledby="applicationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-frame modal-top" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="applicationModalLabel">Application for Employment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<ul class="stepper horizontal horizontal-fix" id="horizontal-stepper-fix">
  <li class="step active">
    <div class="step-title waves-effect waves-dark">Applicant Demographics</div>
    <div class="step-new-content">
      <div class="row">
       @include('hr.partials.employeeform')
      </div>
      <div class="row">
        <div class="md-form col-12 ml-auto">
          <input id="email-horizontal-fix" type="email" class="validate form-control" required>
          <label for="email-horizontal-fix">Email</label>
        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary next-step" data-feedback="someFunction22">CONTINUE</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Military / Work History</div>
    <div class="step-new-content">
      <div class="row">
        <div class="md-form col-12 ml-auto">
          @include('hr.partials.workhx')
        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary next-step" data-feedback="someFunction22">CONTINUE</button>
        <button class="waves-effect waves-dark btn btn-sm btn-secondary previous-step">BACK</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Education History</div>
    <div class="step-new-content">
      <div class="row">
        <div class="md-form col-12 ml-auto">
        
        <form action="{{ route('application.store') }}" method="post" enctype="multipart/form-data" class="education_form">
        
          @include('hr.partials.educationhx')
          
          <button class="btn btn-primary btn-block my-4" type="submit" >Add Education History</button>
          {!! Form::close() !!}
        </div>
      </div>
      <div class="step-actions">
        <button class="waves-effect waves-dark btn btn-sm btn-primary next-step"  data-feedback="someFunction22">CONTINUE</button>
        <button class="waves-effect waves-dark btn btn-sm btn-secondary previous-step">BACK</button>
      </div>
      
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">References</div>
    <div class="step-new-content">
      Finish!
      <div class="step-actions">
        <button class="waves-effect waves-dark btn-sm btn btn-primary m-0 mt-4" type="button">SUBMIT</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Driving History</div>
    <div class="step-new-content">
      Finish!
      <div class="step-actions">
        <button class="waves-effect waves-dark btn-sm btn btn-primary m-0 mt-4" type="button">SUBMIT</button>
      </div>
    </div>
  </li>
  <li class="step">
    <div class="step-title waves-effect waves-dark">Pre-Interview Questionare</div>
    <div class="step-new-content">
      Finish!
      <div class="step-actions">
        <button class="waves-effect waves-dark btn-sm btn btn-primary m-0 mt-4" type="button">SUBMIT</button>
      </div>
    </div>
  </li>
</ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
