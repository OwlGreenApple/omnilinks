<?php 
use App\Link;
use App\Banner;
$grandTotalClick=0;
$grandTotalView=0;
?>
@foreach($pages as $page)
  <tr>
    <td data-label="name">
      {{$page->names}}
    </td>
    <td data-label="premium name">
      {{$page->premium_names}}
    </td>
    <td data-label="Link counter">
      <?php 
        echo number_format(Link::where("pages_id",$page->id)->sum('counter')); 
      ?>
    </td>
    <td data-label="Banner counter">
      <?php 
        echo number_format(Banner::where("pages_id",$page->id)->sum('counter')); 
      ?>
    </td>
    <td data-label="WA counter">
      <?php echo number_format($page->wa_link_counter); ?>
    </td>
    <td data-label="Line counter">
      <?php echo number_format($page->line_link_counter); ?>
    </td>
    <td data-label="Telegram counter">
      <?php echo number_format($page->telegram_link_counter); ?>
    </td>
    <td data-label="Skype counter">
      <?php echo number_format($page->skype_link_counter); ?>
    </td>
    <td data-label="FB Messenger counter">
      <?php echo number_format($page->messenger_link_counter); ?>
    </td>
    <td data-label="Youtube counter">
      <?php echo number_format($page->youtube_link_counter); ?>
    </td>
    <td data-label="FB Profile counter">
      <?php echo number_format($page->fb_link_counter); ?>
    </td>
    <td data-label="Twitter counter">
      <?php echo number_format($page->twitter_link_counter); ?>
    </td>
    <td data-label="IG counter">
      <?php echo number_format($page->ig_link_counter); ?>
    </td>
    <td data-label="Total counter">
      <?php 
        $grandTotalClick += $page->total_counter; 
        echo number_format($page->total_counter); 
      ?>
    </td>
    <td data-label="View counter">
      <?php 
        $grandTotalView += $page->total_view; 
        echo number_format($page->total_view); 
      ?>
    </td>
  </tr>
@endforeach
<script>
  $("#grand-total-all-click").html("<?php echo $grandTotalClick; ?>");
  $("#grand-total-all-view").html("<?php echo $grandTotalView; ?>");
</script>
