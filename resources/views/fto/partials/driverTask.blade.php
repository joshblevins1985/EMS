@if($drivingTasks)

<div class="row">
    <div class="col-xl-12">
        <div class="card">
        <h1>Pre Response Inspection</h1>
        <div class="card-body">
            <table class="table table-striped">
                @foreach($drivingTasks->where('category', 1) as $dt)
            <thead>
                <tr>
                    <th>Task</th>
                    <th>{{ $dt->task }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    @if($dt->driversCheck->where('checkoff_id', $row->id))
                        @foreach($dt->driversCheck->where('checkoff_id', $row->id) as $dc)
                        <td>Date:</td>
                        <td></td>
                            @if($dc)
                                @if($dc->grade)
                                @if($dc->grade == 1) 
                                <td class="bg-success">Succesfull</td> 
                                @elseif($dc->grade == 2) 
                                <td class="bg-warning">Needs Improvement</td> 
                                @elseif($dc->grade == 3) 
                                <td class="bg-danger">Unsatisfactory</td>
                                @elseif($dc->grade == 4)
                                <td>N/A</td>
                                @else
                                <td>Unknown</td>
                                @endif 
                            @else
                   
                        <td><a>Grade Now</a></td>   
                            @endif
                            @else
                                <td>Date:</td>
                        <td></td>
                        <td><a>Grade Now</a></td> 
                            @endif
                        @endforeach
                    @else    
                              <td>Date:</td>
                        <td></td>
                        <td><a>Grade Now</a></td>
                      @endif
                    
    
                </tr>
            </tbody>
            @endforeach
        </table>
        </div>
    </div>
    </div>
    
        <div class="col-xl-12">
        <div class="card">
        <h1>Non Emergency Driving Evaluation</h1>
        <div class="card-body">
            <table class="table table-striped">
                @foreach($drivingTasks->where('category', 2) as $dt)
            <thead>
                <tr>
                    <th>Task</th>
                    <th>{{ $dt->task }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    
                    @if($dt->driversCheck->where('checkoff_id', $row->id))
                        @foreach($dt->driversCheck->where('checkoff_id', $row->id) as $dc)
                        <td>Date:</td>
                        <td></td>
                            @if($dc)
                                @if($dc->grade)
                                @if($dc->grade == 1) 
                                <td class="bg-success">Succesfull</td> 
                                @elseif($dc->grade == 2) 
                                <td class="bg-warning">Needs Improvement</td> 
                                @elseif($dc->grade == 3) 
                                <td class="bg-danger">Unsatisfactory</td>
                                @elseif($dc->grade == 4)
                                <td>N/A</td>
                                @else
                                <td>Unknown</td>
                                @endif 
                            @else
                   
                        <td><a>Grade Now</a></td>   
                            @endif
                            @else
                                <td>Date:</td>
                        <td></td>
                        <td><a>Grade Now</a></td> 
                            @endif
                        @endforeach
                    @else    
                              <td>Date:</td>
                        <td></td>
                        <td><a>Grade Now</a></td>
                      @endif
                    
    
                </tr>
            </tbody>
            @endforeach
        </table>
        </div>
    </div>
    </div>
    
        
</div>

@else
None
@endif