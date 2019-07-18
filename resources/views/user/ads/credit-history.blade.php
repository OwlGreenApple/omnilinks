<?php $i = 1; ?>
@foreach($histories as $history)
  <tr>
    <td>
      <div class="menu-mobile">
        <div class="view-details" data-id="{{$i}}">
          <span class="menu-mobile icon-dropdown">
            <i class="fas fa-sort-down"></i>
          </span>  
          {{date('d F',strtotime($history->date))}}
        </div>
      </div>

      <div class="menu-nomobile">
        {{date('d F',strtotime($history->date))}}
      </div>
    </td> 
    <td class="menu-nomobile">
      @if($history->description=='top up')
        <span style="color:#1e88f5">Top Up Credit Success</span><br>
        Thank you for purchasing packages
      @else 
        <span>Point Used on Ads</span><br>
        Daily informations to your points activity 
      @endif
    </td>
    <td class="menu-nomobile">
      @if($history->description=='top up')
        -
      @else 
        {{$history->click}}
      @endif
    </td>
    <td class="menu-nomobile">
      @if($history->description=='top up')
        -
      @else 
        {{$history->view}}
      @endif
    </td>
    <td>
      @if($history->description=='top up')
        <span style="color:#1e88f5">
          +{{$history->selisih}} Points
        </span>
      @else 
        <span style="color:#FF7E7F">
          {{$history->selisih}} Points
        </span>
      @endif
    </td>
  </tr>

  <tr class="details-{{$i}} d-none">
    <td colspan="2">
      Description : 
      <b>
        @if($history->description=='top up')
          <span style="color:#1e88f5">Top Up Credit Success</span><br>
          Thank you for purchasing packages
        @else 
          <span>Point Used on Ads</span><br>
          Daily informations to your points activity 
        @endif
      </b><br>
      Click : 
      <b>
        @if($history->description=='top up')
          -
        @else 
          {{$history->click}}
        @endif
      </b><br>
      View : 
      <b>
        @if($history->description=='top up')
          -
        @else 
          {{$history->view}}
        @endif
      </b><br>
    </td>
  </tr>
  <?php $i++; ?>
@endforeach