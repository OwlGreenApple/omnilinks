<?php 
use App\User;
use App\AdsHistory;
$grandTotalClick = 0;
$grandTotalView = 0;
?>
@foreach($ads as $data)
  <tr>
    <td data-label="Email">
      <?php 
        $user = User::find($data->user_id);
        if(!is_null($user)){
          echo $user->email;
        }
      ?>
    </td>
    <td data-label="Headline">
      {{$data->headline}}
    </td>
    <td data-label="Credit">
      {{$data->credit}}
    </td>
    <td data-label="Click">
      <?php 
        $click = AdsHistory::where('ads_id',$data->id)
                      ->where("is_click",1)
                      ->count();
        $grandTotalClick += $click;
        echo number_format($click);
      ?>
    </td>
    <td data-label="View">
      <?php 
        $view = AdsHistory::where('ads_id',$data->id)
                      ->where("is_view",1)
                      ->count();
        $grandTotalView += $view;
        echo number_format($view);
      ?>
    </td>
    <td data-label="Created">
      {{$data->created_at}}
    </td>
    <td data-label="Action">
      <button type="button" class="btn btn-primary btn-log" data-toggle="modal" data-target="#view-log" data-id="{{$data->id}}">
        Log
      </button>
    </td>
    <td data-label="Link">
      {{$data->link}}
    </td>
    <td data-label="Description">
      {{$data->description}}
    </td>
  </tr>
@endforeach
<script>
  $("#grand-total-all-click").html("<?php echo number_format($grandTotalClick); ?>");
  $("#grand-total-all-view").html("<?php echo number_format($grandTotalView); ?>");
</script>
