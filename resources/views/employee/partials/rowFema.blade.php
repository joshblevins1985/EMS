@foreach($employees as $row)
<tr>
    <td>{{$row->last_name ?? ''}} {{$row->first_name ?? ''}}</td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [1,2,5,6,7,8,14,15])->where('status','<', 3)->get();

        ?>
        @if($cert)
        @foreach($cert as $cert)
            <div class="row">
                {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
            </div>
        @endforeach
            @else
                Missing
        @endif
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [3,9])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [4])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        Missing
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [10])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [11])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [12])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        <?php
        $cert = Vanguard\Certification::where('user_id', $row->user_id)->whereIn('type', [13])->where('status','<', 3)->get();

        ?>
        @if($cert)
            @foreach($cert as $cert)
                <div class="row">
                    {{\Carbon\Carbon::parse($cert->expiration_date)->format('m/d/Y')}}
                </div>
            @endforeach
        @else
            Missing
        @endif
    </td>
    <td>
        <a href="/employee/profile/{{$row->user_id}}"><i class="fad fa-file-pdf"></i></a>
    </td>
</tr>
@endforeach