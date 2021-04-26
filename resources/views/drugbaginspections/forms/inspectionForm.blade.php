<form action="/drugbaginspection/add" role="form" id="inspectionForm" method="POST">
    @csrf
    <div class="row mb-3">
        <div class="col-xl-12">
            <select class="form-control select2" id="drugBagId" name="drugBagId"
                    searchable="Search here.." style="width: 100%" required>
                <option selected> Please Select Drug Bag</option>
                @foreach($drugBags as $row)
                    <option value="{{$row->id}}"  @if($row->id == $id) selected @endif > {{$row->bag_number}} </option>
                @endforeach
            </select>
        </div>
    </div>
    @if($drugBag)
        @if($drugBag->inspection)
            <?php
            $dates = $drugBag->inspection->items['drugs'];
            $eom = \Carbon\Carbon::now()->endOfMonth();
            $eom = strtotime($eom);
            $inDateRange = count(
                array_filter(
                    $dates,
                    function($value) use($eom) {
                        if(DateTime::createFromFormat('Y-m-d', $value) !== false){

                            $value = strtotime($value);
                            return ($value <= $eom );
                        }

                    }
                )
            )
            ?>
            @if($inDateRange)
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header text-white bg-danger text-center"> Expiration Notification </div>
                            <div class="card-body">
                                <div class="row p-3">
                                    In comparison with the last available drug bag inspection we are providing a list of medication that could be in your drug bag and expiring.
                                </div>
                                <div class="row">
                                    <table class="table table-striped">
                                        <tr>
                                            <th>Expired Drug</th>
                                            <th>Date Expired</th>
                                            <th>Disposal Method</th>
                                        </tr>
                                        @foreach($drugBag->inspection->items['drugs'] as $key => $value)

                                            @if(DateTime::createFromFormat('Y-m-d', $value) !== false)
                                                @if(\Carbon\Carbon::parse($value) <= \Carbon\Carbon::now()->endOfMonth())
                                                    <?php $drug = \Vanguard\DrugBagInspectionItems::where('companyId', auth()->user()->companyId)->where('arrayName', $key)->first() ?>
                                                    <tr>
                                                        <th>{{$drug->name ?? ''}}</th>
                                                        <th>{{\Carbon\Carbon::parse($value)->format('m-d-Y')}}</th>
                                                        <th>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="{{$drug->arrayName}}" id="{{$drug->arrayName}}" name="expiredDrugs[]">
                                                                <label class="form-check-label" for="flexCheckDefault">
                                                                    This medication has been properly disposed of.
                                                                </label>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @endif
                                            @endif

                                        @endforeach

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endif
        @endif
    @endif
    <div class="row mt-3">
        <div class="col-xl-6">
            <div class="form-group">
                <label>Old Seal Number</label>

                <input type="number" class="form-control date" name="oldSeal" value="{{$drugBag->currentSealNumber ?? ''}}"/>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group">
                <label>New Seal Number</label>

                <input type="number" class="form-control date" name="newSeal" value=""/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="form-group">
                <label>Employee Completing</label>
                <select class="form-control select2"  name="assignedId"
                        searchable="Search here.." style="width: 100%" required>
                    <option value="" disabled selected>Select your option</option>
                    @foreach($employees as $row)
                        <option value="{{$row->id}}"  @if($row->id == auth()->user()->id) selected @endif > {{$row->last_name}} {{$row->first_name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group">
                <label>Employee Witnessing</label>
                <select class="form-control select2" id="witnessId" name="witnessId"
                        searchable="Search here.." style="width: 100%" required>
                    <option value="" disabled selected>Select your option</option>
                    @foreach($employees as $row)
                        <option value="{{$row->id}}" > {{$row->last_name}} {{$row->first_name}} </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        @if($drugs)
            @foreach($drugs as $row)
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>{{ $row->name }}</label>

                        <input type="date" class="form-control date @if($drugBag->inspection) @if(array_key_exists($row->arrayName ,$drugBag->inspection->items['drugs']) ) @if(\Carbon\Carbon::now()->endOfMonth() >= \Carbon\Carbon::parse($drugBag->inspection->items['drugs'][$row->arrayName])) text-danger @endif @endif @endif  " name="{{ $row->arrayName }}" value="{{$drugBag->inspection->items['drugs'][$row->arrayName] ?? null}}"/>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <button type="button" id="inspectionFormButton" class="btn btn-block btn-success"> Submit Inspection </button>
</form>
