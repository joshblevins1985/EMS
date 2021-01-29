<div class = "panel panel-default">
   <div class = "panel-heading bg-dark">
      <div class="col-xl-10">
           Attached Assets
       </div>
       <div class="col-xl-1 pull-right">
           <span class="text-success pull-right"><a data-toggle="modal" data-target="#attachAsset" data-assetid="{{ $asset->id }}"><i class="far fa-plus-square"></i></a></span>
       </div>
   </div>
   
   <div class = "panel-body">
      <table class="table table">
          <thead>
              <tr>
                  <th>Asset Tag</th>
              </tr>
          </thead>
          <tbody>
              @if(count($asset->attached))
              @foreach($asset->attached as $row)
              <tr>
                  <td>{{ $row->asset->asset_tag }}</td>
              </tr>
              @endforeach
              @else
              <tr>
                  <td>
                      No Assets Attached
                  </td>
              </tr>
              @endif
          </tbody>
      </table>
   </div>
</div>