@extends('layouts.app')

@section('content')
<script type="text/javascript">
    // var currentPage="";
    function refreshDashboard() 
    {
        // if(currentPage=="")
        // {
        //   currentPage=;
        // }

        $.ajax({
            type: 'GET',
            url: "<?php echo url('/dash/load-dashboard'); ?>",
            dataType: 'text',
            success: function(result) {
                var data = jQuery.parseJSON(result);
                $('#content').html(data.view);
                //$('#pager').html(data.pager);
            }
        });
    }
    function deletePages(deletedataid) 
    {
        $.ajax({
            type: 'GET',
            url: "<?php echo url('/dash/delete-pages'); ?>",
            dataType: 'text',
            data: {
                deletedataid: deletedataid,
            },
            success: function(result) {
                var data = jQuery.parseJSON(result);
                if (data.status == 'success') {
                    refreshDashboard();
                }
            }
        });
    }
    $(document).ready(function() {
        refreshDashboard();
    });
</script>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<div class="container">
    <div class="row notif">
        <div class="col-md-12">
         <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>Masa trial anda akan berakhir dalam 5 hari. <span style="color:blue;">Subscribe</span>
        untuk terus menggunakan Omnilinks
        </div>
      </div>

        <div class="col-md-12">
            <a href="{{asset('/dash/new')}}" class="btn-primary btncreate">CREATE BIO LINK</a>
            <a href="{{asset('/dash/newsingle')}}" class="btn-warning btnsingle">CREATE SINGLE LINK</a>
            <div style="padding-top: 49px; margin-left: 20px; font-size: 20px;">
                <p>Omnilinkz Chart</p>
                <input type="text" name="search" class="form-cari" placeholder="Cari Link / Judul">
                <div style="float: right;">

                    <select name="bulan" class="form-control form-controll">
     <?php 
      $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            for($a=1;$a<=12;$a++)
            {
                 if($a==date("m"))
                 { 
                 $pilih="selected";
                 }
                 else 
                 {
                 $pilih="";
                 }
            echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
            }
        ?>
                    </select>
                    <select name="tahun" class="form-control form-controll">
                        <?php
              $thn_skr = date('Y');
             for ($x = $thn_skr; $x >= 1980; $x--) {
             ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                        <?php
              }
            ?>
                    </select>

                </div>
            </div>

            <div id="content">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@endsection