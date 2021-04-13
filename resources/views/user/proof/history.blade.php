@extends('layouts.app')

@section('content')

<div id="apf" class="container mb-5 main-cont">
    <div class="col-md-12 pr-0 div-btn mx-auto mt-5">
      <div class="table-responsive">
          <table id="history" class="cell-border compact stripe" style="width:100%">
            <thead>
              <tr>
                <th width="10%" class="text-center">No</th>
                <th class="text-center">Tanggal Transaksi</th>
                <th class="text-center">Page Name</th>
                <th class="text-center">IP Address</th>
                <th>Debit</th>
                <th>Kredit</th>
              </tr>
            </thead>   
          @if($pf->count() > 0)
            @php $no = 1 @endphp
            <tbody>
            @foreach($pf AS $row)
              <tr>
                <td class="text-center">{{ $no }}</td>
                <td class="text-center">{{ Date('d-M-Y -- H:i:s',strtotime($row->created_at)) }}</td>
                <td class="text-center">{{ $row->page_name }}</td>
                <td class="text-center">{{ $row->ip_address }}</td>
                <td>{{ str_replace(",",".",number_format($row->debit)) }}</td>
                <td>{{ str_replace(",",".",number_format($row->kredit)) }}</td>
              </tr>
              @php $no++ @endphp
            @endforeach
            </tbody>
          @endif
          </table>
      </div>
    </div>
<!-- -->   
</div>

<!-- javascript -->   
<script type="text/javascript">
  
  $(function()
  {
    table();
  });

  function table()
  {
    $("#history").DataTable({
      "destroy": true,
    });
  }

</script>
@endsection