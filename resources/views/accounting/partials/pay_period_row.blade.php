<tr>
    <td>{{$row->start}}</td>
    
  
    </td>
    <td>
        {{$row->end}}

    </td>
    <td>
        <div class="row">
        <div class="col-3">
           {!! Form::open(['route' => 'accounting.payrollreport', 'id' => 'attendance-form']) !!}
       
        @csrf
        
        {{ Form::hidden('start_date', $row->start) }}
        {{ Form::hidden('end_date', $row->end) }}
  

        <button type="submit"  class="btn-link"><span class="badge badge-pill blue">Payroll Report</span></button>

        {!! Form::close() !!} 
        </div>
        
        <div class="col-3">
            {!! Form::open(['route' => 'accounting.attendancereport', 'id' => 'attendance-form']) !!}
        
        @csrf

       {{ Form::hidden('start_date', $row->id) }}
        {{ Form::hidden('end_date', $row->sin) }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill orange">Attendance Report</span></button>

        {!! Form::close() !!}
        </div>
        
        
        
        
        </div>
        
        
        
        
      
    </td>
</tr>