@if(count($pages) > 0)
  @php $no = 1 @endphp
  <table id="alocation" class="table" style="width:100%">
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
        <td class="text-center">{{ $row['name'] }}</td>
        <td>{{ number_format($row['credit']) }}</td>
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
    $("#alocation").DataTable({
      destroy: true,
      "pageLength": 5
    });
  }
</script>