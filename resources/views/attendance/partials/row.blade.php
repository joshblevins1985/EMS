<tr>
    <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
    
  
    </td>
    <td>
        {{$row->sin}}

    </td>
    <td>
        <div class="row">
        <div class="col-3">
           {!! Form::open(['route' => 'attendance.store', 'id' => 'attendance-form']) !!}
       
        @csrf
        
        {{ Form::hidden('schedule_id', $row->id) }}
        {{ Form::hidden('date', $row->sin) }}
        {{ Form::hidden('user_id', $row->user_id) }}
        {{ Form::hidden('status', '9') }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill blue">No Time Clock</span></button>

        {!! Form::close() !!} 
        </div>
        
        <div class="col-3">
            {!! Form::open(['route' => 'attendance.store', 'id' => 'attendance-form']) !!}
        
        @csrf

        {{ Form::hidden('schedule_id', $row->id) }}
        {{ Form::hidden('date', $row->sin) }}
        {{ Form::hidden('user_id', $row->user_id) }}
        {{ Form::hidden('status', '9') }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill orange">Call Off</span></button>

        {!! Form::close() !!}
        </div>
        
        <div class="col-3">
            {!! Form::open(['route' => 'attendance.store', 'id' => 'attendance-form']) !!}
        
        @csrf
        {{ Form::hidden('schedule_id', $row->id) }}
        {{ Form::hidden('date', $row->sin) }}
        {{ Form::hidden('user_id', $row->user_id) }}
        {{ Form::hidden('status', '9') }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill red">No Call No Show</span></button>

        {!! Form::close() !!}
        </div>
        
        <div class="col-3">
            {!! Form::open(['route' => 'attendance.store', 'id' => 'attendance-form']) !!}
        
        @csrf
        {{ Form::hidden('schedule_id', $row->id) }}
        {{ Form::hidden('date', $row->sin) }}
        {{ Form::hidden('user_id', $row->user_id) }}
        {{ Form::hidden('status', '9') }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill red">Black out Call Off</span></button>

        {!! Form::close() !!}
        </div>
        
        
        </div>
        
        
        
        
      
    </td>
</tr>