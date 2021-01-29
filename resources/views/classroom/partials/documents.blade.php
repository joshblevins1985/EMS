<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Student</th>
                @foreach($classroom->documents as $document)
                <th>{{ $document->label }}</th>
                @endforeach  
            </tr>
            </thead>
            <tbody>
                 @foreach($classroom->students as $student)
                <tr>
                <td>
                     @if($student->user_id)
                        {{ $student->employee->last_name }} {{ $student->employee->first_name }} 
                        
                    @else
                    
                        {{ $student->temp_name }}
                    
                    @endif
                </td>
                @endforeach
                @foreach($classroom->documents as $document)
                <td>{{ $document->label }}</td>12
                @endforeach 
                </tr>
        </tbody>
    </table>
</div>


    






        
