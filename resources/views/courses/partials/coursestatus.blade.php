
        
        
            <div class="row">
                
            <h2>Course Progress: {{$course_status}}</h2>
            <table class="table">
                <tr>
                    <th>Lesson</th>
                    <th>Status</th>
                </tr>
                @foreach($lessons as $lesson)
                
                <?php 
        $status=DB::table('lesson_log')
                    ->where('lesson_id','=',$lesson->id)
                    ->where('user_id','=',Auth::user()->id)
                    ->first();
    ?>
                    <tr>
                        <td>{{$lesson->title}}</td>
                        <td>
                            
                             @if (!$status)
                                <span class="badge badge-danger" id="{{'lesson_complate_id'.$lesson->id}}" data-id="{{$lesson->id}}" style="margin:10px; height:20px; margin-top:12px">Incomplete </span>
                              @else
                                <span class="badge badge-success" id="{{'lesson_complate_id'.$lesson->id}}" data-id="{{$lesson->id}}" style="margin:10px; height:20px; margin-top:12px">Completed </span>
                              @endif
                            
                            
                        </td>
                    </tr>
                @endforeach
            </table>
        
            </div>
            @permission('online.instructor.menu')
            <div class="row">
            @include('courses.partials.instructor_menu')
            </div>
             @endpermission

   