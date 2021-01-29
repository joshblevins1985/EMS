
<label for="mileage"> Vehcile Mileage </label>
<input type="text" id="mileage" class="form-control mb-3" name="mileage" placeholder="Eneter Physical Vehicle Mileage">

<table class="table table-striped">

    <tbody>
        @foreach($questions as $question)
            <tr>
                <td>
                    {{ $question->question }}
                </td>
                <td>
                    <div class="radio radio-css radio-inline">
                    <input type="radio" name="{{ $question->id }}"  id="question{{$question->id}}1" value="1" checked />
                    <label for="question{{$question->id}}1">Passed</label>
                    <input type="radio" name="{{ $question->id }}" id="question{{ $question->id  }}2" value="0" />
                    <label for="question{{ $question->id  }}2">Failed</label>
                    </div>
                </td>
            </tr>
            
        @endforeach
        <tr>

        </tr>
    </tbody>
</table>

