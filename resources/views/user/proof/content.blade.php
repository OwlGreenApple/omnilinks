@if(count($pages) > 0)
  @php $no = 1 @endphp
  <table id="alocation" class="table cell-border" style="width:100%">
    <thead>
      <tr>
        <th width="8%" class="text-center">No</th>
        <th class="text-center">Page Name</th>
        <th>Credit</th>
        <th>Assign</th>
      </tr>
    </thead>   
    <tbody>
    @foreach($pages AS $row)
      <tr>
        <td class="text-center">{{ $no }}</td>
        <td id="pg_{{ $row['id'] }}" class="text-center"><a href="https://{{env('SHORT_LINK')}}/{{$row['name']}}" target="_blank">{{ $row['name'] }}</a></td>
        <td id="cd_{{ $row['id'] }}"><a href="{{url('proof_history')}}/?mod={{ $row['name'] }}" target="_blank">{{ str_replace(",",".",number_format($row['credit'])) }}</a></td>
        <td>
          <button id="pr_{{ $row['id'] }}" type="button" class="btn btn-success text-white btn-sm add">+</button>
          <button id="pr_{{ $row['id'] }}" type="button" class="btn btn-danger text-white btn-sm subs">-</button>
        </td>
      </tr>
      @php $no++ @endphp
    @endforeach
    </tbody>
  </table>
@endif

<script>
  $(function(){
    table();
  });

  function table()
  {
    var paging = parseInt('{{$paging}}');
    if(paging > 0)
    {
      paging = paging - 1;
    }

    var table = $("#alocation").DataTable({
      "destroy": true,
    });
    table.page(paging).draw( 'page' );
  }
</script>