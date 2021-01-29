@csrf
<div class="col-sm-12 col-12">
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="policy_number" name="section" value="@if($edit == true)  @endif" class="form-control">
            <label for="policy_number">Protocol Section</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="title" name="number" value="@if($edit == true)  @endif" class="form-control">
            <label for="title">Section Number</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="region" name="region" value="@if($edit == true)  @endif" class="form-control">
            <label for="title">Region</label>
        </div>
    </div>
    
    <div class="md-form">
        <div class="md-form">
            <input  type="text" id="title" name="title" value="@if($edit == true)  @endif" class="form-control">
            <label for="title">Title</label>
        </div>
    </div>

   
        <div class="md-form">
            <textarea  id="gerneral_considerations" name="gerneral_considerations" value="@if($edit == true)  @endif" class="form-control"></textarea>
            <label for="gerneral_considerations">General Considerations</label>
        </div>
    
    
    
        <div class="md-form">
            <textarea  id="patient_presentation" name="patient_presentation" value="@if($edit == true)  @endif" class="form-control"></textarea>
            <label for="purpose">Patient Presentation</label>
        </div>
    
    
    
        <div class="md-form">
            <textarea  id="emt_treatment" name="emt_treatment" value="@if($edit == true)  @endif" class="form-control"></textarea>
            <label for="purpose">EMT Treatment</label>
        </div>
    
    
    
        <div class="md-form">
            <textarea  id="aemt_treatment" name="aemt_treatment" value="@if($edit == true)  @endif" class="form-control"></textarea>
            <label for="purpose">AEMT Treatment</label>
        </div>
    
    
        <div class="md-form">
            <textarea  id="paramedic_treatment" name="paramedic_treatment" value="@if($edit == true)  @endif" class="form-control"></textarea>
            <label for="purpose">Paramedic Treatment</label>
        </div>
    
    
    
    <button class="btn btn-info btn-block my-4" type="submit">Add New Policy</button>
</div>

<div class="col-sm-6 col-6">
    
</div>

