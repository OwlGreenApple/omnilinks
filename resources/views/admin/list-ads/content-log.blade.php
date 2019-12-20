<!-- Buat show ads history allocation -->
@foreach($adsHistory as $data)
  <tr>
    <td data-label="jml_credit">
      {{$data->jml_credit}}
    </td>
    <td data-label="is_view">
      {{$data->is_view}}
    </td>
    <td data-label="is_click">
      {{$data->is_click}}
    </td>
    <td data-label="description">
      {{$data->description}}
    </td>
    <td data-label="credit_before">
      {{$data->credit_before}}
    </td>
    <td data-label="credit_after">
      {{$data->credit_after}}
    </td>
    <td data-label="Created At">
      {{$data->created_at}}
    </td>
  </tr>
@endforeach