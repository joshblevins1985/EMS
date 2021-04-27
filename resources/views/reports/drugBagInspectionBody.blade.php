@if($inspection->items['expired'])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-white bg-danger text-center"> Expiration Notification</div>
                <div class="card-body">
                    <div class="row p-3">
                        In comparison with the last available drug bag inspection we are providing a list of medication
                        that could be in your drug bag and expiring.
                    </div>
                    <div class="row">
                        <table class="table table-striped">
                            <tr>
                                <th>Expired Drug</th>
                                <th>Disposal Method</th>
                            </tr>
                            @foreach($inspection->items['expired'] as $key => $value)

                                <?php $drug = \Vanguard\DrugBagInspectionItems::where('companyId', auth()->user()->employee->company_id)->where('arrayName', $value)->first() ?>
                                <tr>
                                    <th>{{$drug->name ?? ''}}</th>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$drug->arrayName}}"
                                                   id="{{$drug->arrayName}}" name="expiredDrugs[]" checked>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                This medication has been properly disposed of.
                                            </label>
                                        </div>
                                    </th>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endif
<div class="class">
    <div class="col-12 text-center"> <h3>Drug Expiration</h3> </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
            <tr>
                <?php $i = 0; ?>
                @foreach($inspection->items['drugs'] as $key => $value)

                    <?php
                    $drug = \Vanguard\DrugBagInspectionItems::where('companyId', auth()->user()->employee->company_id)->where('arrayName', $key)->first();
                    $i++;

                    // Making different path,depends on place where function is called,panel.php or homepage.php
                    if ($i % 3 === 0) {
                        echo '<tr></tr>';
                    }
                        if($value) { $message = \Carbon\Carbon::parse($value)->format('m-d-Y'); $bg =''; } else{ $message = 'Replace'; $bg = 'bg-warning';}
                    echo '<td class="'.$bg.'">' .
                        $drug->name
                        . '-' .
                        $message
                        . '</td>';

                    ?>
                @endforeach
            </tr>
        </table>


    </div>
</div>
<div class="class">
    <div class="col-12 text-center"> <h3>Missing or Needs Replaced</h3> </div>
</div>
<div class="row">
    <div class="col-12">
        <table class="table">
            <tr>
                <?php $i = 0; ?>
                @foreach($inspection->items['drugs'] as $key => $value)

                    @if(is_null($value))
                        <?php
                        $drug = \Vanguard\DrugBagInspectionItems::where('companyId', auth()->user()->employee->company_id)->where('arrayName', $key)->first();
                        $i++;

                        // Making different path,depends on place where function is called,panel.php or homepage.php
                        if ($i % 4 === 0) {
                            echo '<tr></tr>';
                        }

                        echo '<td class="">' .
                            $drug->name
                            .'</td>';

                        ?>
                        <?php
                        $drug = \Vanguard\DrugBagInspectionItems::where('companyId', auth()->user()->employee->company_id)->where('arrayName', $key)->first();
                        ?>
                        <td>{{$drug->name ?? ''}}</td>
                    @endif

                @endforeach
            </tr>
        </table>
    </div>
</div>

<div class="row mb-4"></div>

<div class="row">
    <div class="col-5 border-bottom"></div>
    <div class="col-2"></div>
    <div class="col-5 border-bottom"></div>
</div>
<?php
$assigned = \Vanguard\User::where('id', $inspection->items['baginfo']['assignedId'])->first();
$witness = \Vanguard\User::where('id', $inspection->items['baginfo']['witnessId'])->first();
?>
<div class="row">
    <div class="col-5 ">Medic / AEMT {{$assigned->first_name ?? ''}} {{$assigned->last_name ?? ''}}</div>
    <div class="col-2"></div>
    <div class="col-5 ">Witness {{$witness->first_name ?? ''}} {{$witness->last_name ?? ''}}</div>
</div>

