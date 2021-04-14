@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/animate-2.css')}}">
<link rel="stylesheet" href="{{asset('assets/whatsapp-chat-support/whatsapp-chat-support.css')}}">

<style type="text/css">

  @media screen and (max-width: 768px) {
    .menu-nomobile{
      display: none;
    }

    .menu-mobile {
      display: block;
    }
  }

  .btn-copy {
    cursor: pointer;
  }

  .proof-wrapper{
    position: relative !important;
  }

  .themes.selected, .wallpapers.selected{
    border: 3px solid #0062CC;
  }

  .wcs_fixed_right{
    bottom : -60px;
  }
</style>

<script type="text/javascript">
  var template;
  var changelink = 0;
  var changechat = 0;
  var changepixel = 0;
  var changeproof = 0;

  var templates = [
    {
     "id": 1,
     "theme": "wallpaper1",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 2,
     "theme": "wallpaper2",
     "bio_font_color": "#740000",
     "button_color": "#740000",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#680C0C"
    },
    {
     "id": 3,
     "theme": "wallpaper3",
     "bio_font_color": "#393939",
     "button_color": "#393939",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#0F0D0D"
    },
    {
     "id": 4,
     "theme": "wallpaper4",
     "bio_font_color": "#9B4E40",
     "button_color": "#9B4E40",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#883525"
    },
    {
     "id": 5,
     "theme": "wallpaper5",
     "bio_font_color": "#987C15",
     "button_color": "#987C15",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#82690E"
    },
    {
     "id": 6,
     "theme": "wallpaper6",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6422E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 7,
     "theme": "wallpaper7",
     "bio_font_color": "#3D0D71",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 8,
     "theme": "wallpaper8",
     "bio_font_color": "#393939",
     "button_color": "#393939",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#0F0D0D"
    },
    {
     "id": 9,
     "theme": "wallpaper9",
     "bio_font_color": "#393939",
     "button_color": "#FFFFFF",
     "font_button_color": "#393939",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 10,
     "theme": "wallpaper10",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 11,
     "theme": "wallpaper11",
     "bio_font_color": "#505050",
     "button_color": "#505050",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#393939"
    },
    {
     "id": 12,
     "theme": "wallpaper12",
     "bio_font_color": "#3D0D71",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 13,
     "theme": "wallpaper13",
     "bio_font_color": "#393939",
     "button_color": "#FFFFFF",
     "font_button_color": "#393939",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 14,
     "theme": "wallpaper14",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E4582",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 15,
     "theme": "wallpaper15",
     "bio_font_color": "#C74A3A",
     "button_color": "#C74A3A",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#A5463A"
    },
    {
     "id": 16,
     "theme": "wallpaper16",
     "bio_font_color": "#800B0B",
     "button_color": "#800B0B",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#5E0909"
    },
    {
     "id": 17,
     "theme": "wallpaper17",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#505050",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 18,
     "theme": "wallpaper18",
     "bio_font_color": "#034FA2",
     "button_color": "#034FA2",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#154F8F"
    },
    {
     "id": 19,
     "theme": "wallpaper19",
     "bio_font_color": "#BD2D8C",
     "button_color": "#BD2D8C",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#891762"
    },
    {
     "id": 20,
     "theme": "wallpaper20",
     "bio_font_color": "#8C1E10",
     "button_color": "#8C1E10",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#731E13"
    },
    {
     "id": 21,
     "theme": "wallpaper21",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 22,
     "theme": "bubble-bg-blue",
     "bio_font_color": "#034FA2",
     "button_color": "#034FA2",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#154F8F"
    },
    {
     "id": 23,
     "theme": "bubble-bg-orange",
     "bio_font_color": "#3D0D71",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 24,
     "theme": "bubble-bg-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E4582",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 25,
     "theme": "bubble-bg-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#401A84",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 26,
     "theme": "bubble-bg-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#EE464E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 27,
     "theme": "bubble-bg-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C57D06",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 28,
     "theme": "bubble-blue",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 29,
     "theme": "bubble-brown",
     "bio_font_color": "#8C1E10",
     "button_color": "#8C1E10",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#731E13"
    },
    {
     "id": 30,
     "theme": "bubble-colorful",
     "bio_font_color": "#BD2D8C",
     "button_color": "#BD2D8C",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#891762"
    },
    {
     "id": 31,
     "theme": "bubble-green",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 32,
     "theme": "bubble-orange",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 33,
     "theme": "bubble-purple",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 34,
     "theme": "bubble-red",
     "bio_font_color": "#740000",
     "button_color": "#740000",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#680C0C"
    },
    {
     "id": 35,
     "theme": "bubble-soft",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 36,
     "theme": "bubble-up-bg-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E4582",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 37,
     "theme": "bubble-up-bg-brown",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#393939",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 38,
     "theme": "bubble-up-bg-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 39,
     "theme": "bubble-up-bg-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E4582",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 40,
     "theme": "bubble-up-bg-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#401A84",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 41,
     "theme": "bubble-up-bg-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#EE464E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 42,
     "theme": "bubble-up-blue",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 43,
     "theme": "bubble-up-green",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 44,
     "theme": "bubble-up-lilac",
     "bio_font_color": "#505050",
     "button_color": "#505050",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#393939"
    },
    {
     "id": 45,
     "theme": "bubble-up-mocca",
     "bio_font_color": "#8C1E10",
     "button_color": "#8C1E10",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#731E13"
    },
    {
     "id": 46,
     "theme": "bubble-up-orange",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 47,
     "theme": "bubble-up-pink",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 48,
     "theme": "bubble-up-red",
     "bio_font_color": "#800B0B",
     "button_color": "#800B0B",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#5E0909"
    },
    {
     "id": 49,
     "theme": "bubble-up-soft-color",
     "bio_font_color": "#034FA2",
     "button_color": "#034FA2",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#154F8F"
    },
    {
     "id": 50,
     "theme": "cloud-bg-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 51,
     "theme": "cloud-bg-cyan",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#034FA2",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 52,
     "theme": "cloud-bg-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 53,
     "theme": "cloud-bg-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 54,
     "theme": "cloud-bg-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E4582",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 55,
     "theme": "cloud-bg-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#401A84",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 56,
     "theme": "cloud-bg-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#EE464E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 57,
     "theme": "cloud-bg-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C57D06",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 58,
     "theme": "cloud-blue-orange",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 59,
     "theme": "cloud-brown",
     "bio_font_color": "#8C1E10",
     "button_color": "#8C1E10",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#731E13"
    },
    {
     "id": 60,
     "theme": "cloud-gold",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 61,
     "theme": "cloud-gray",
     "bio_font_color": "#505050",
     "button_color": "#505050",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#393939"
    },
    {
     "id": 62,
     "theme": "cloud-green-yellow",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 63,
     "theme": "cloud-green",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 64,
     "theme": "cloud-light-blue",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 65,
     "theme": "cloud-orange",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 66,
     "theme": "cloud-pastel",
     "bio_font_color": "#C74A3A",
     "button_color": "#C74A3A",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#A5463A"
    },
    {
     "id": 67,
     "theme": "cloud-pink",
     "bio_font_color": "#BD2D8C",
     "button_color": "#BD2D8C",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#891762"
    },
    {
     "id": 68,
     "theme": "cloud-purple-yellow",
     "bio_font_color": "#3D0D71",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 69,
     "theme": "cloud-purple",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 70,
     "theme": "cloud-red",
     "bio_font_color": "#740000",
     "button_color": "#740000",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#680C0C"
    },
    {
     "id": 71,
     "theme": "cloud-soft",
     "bio_font_color": "#034FA2",
     "button_color": "#034FA2",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#154F8F"
    },
    {
     "id": 72,
     "theme": "confetti-bg-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 73,
     "theme": "confetti-bg-latte",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#393939",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 74,
     "theme": "confetti-bg-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 75,
     "theme": "confetti-bg-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#BD2D8C",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 76,
     "theme": "confetti-bg-white",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 77,
     "theme": "confetti-bg-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C57D06",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 78,
     "theme": "confetti-blue",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 79,
     "theme": "confetti-brown",
     "bio_font_color": "#8C1E10",
     "button_color": "#8C1E10",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#731E13"
    },
    {
     "id": 80,
     "theme": "confetti-gray",
     "bio_font_color": "#505050",
     "button_color": "#505050",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#393939"
    },
    {
     "id": 81,
     "theme": "confetti-green",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 82,
     "theme": "confetti-pink",
     "bio_font_color": "#BD2D8C",
     "button_color": "#BD2D8C",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#891762"
    },
    {
     "id": 83,
     "theme": "confetti-purple",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 84,
     "theme": "confetti-red",
     "bio_font_color": "#740000",
     "button_color": "#740000",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#680C0C"
    },
    {
     "id": 85,
     "theme": "confetti-soft",
     "bio_font_color": "#034FA2",
     "button_color": "#034FA2",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#154F8F"
    },
    {
     "id": 86,
     "theme": "disk-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 87,
     "theme": "disk-dual-color",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 88,
     "theme": "disk-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0 E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 89,
     "theme": "disk-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 90,
     "theme": "disk-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#BD2D8C",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 91,
     "theme": "disk-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 92,
     "theme": "disk-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#740000",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 93,
     "theme": "disk-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 94,
     "theme": "gradient-blue-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 95,
     "theme": "gradient-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 96,
     "theme": "gradient-cyan",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 97,
     "theme": "gradient-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 98,
     "theme": "gradient-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 99,
     "theme": "gradient-peach",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 100,
     "theme": "gradient-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 101,
     "theme": "gradient-soft-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 102,
     "theme": "leaves-bg-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 103,
     "theme": "leaves-bg-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 104,
     "theme": "leaves-bg-moca",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 105,
     "theme": "leaves-bg-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 106,
     "theme": "leaves-bg-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 107,
     "theme": "leaves-bg-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#740000",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 108,
     "theme": "leaves-blue",
     "bio_font_color": "#122B74",
     "button_color": "#122B74",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#081F66"
    },
    {
     "id": 109,
     "theme": "leaves-gray",
     "bio_font_color": "#505050",
     "button_color": "#505050",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#393939"
    },
    {
     "id": 110,
     "theme": "leaves-green",
     "bio_font_color": "#0E8012",
     "button_color": "#0E8012",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#086A0C"
    },
    {
     "id": 111,
     "theme": "leaves-pastel",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 112,
     "theme": "leaves-pink",
     "bio_font_color": "#BD2D8C",
     "button_color": "#BD2D8C",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#891762"
    },
    {
     "id": 113,
     "theme": "leaves-purple",
     "bio_font_color": "#B707AC",
     "button_color": "#B707AC",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#991691"
    },
    {
     "id": 114,
     "theme": "leaves-red",
     "bio_font_color": "#740000",
     "button_color": "#740000",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#680C0C"
    },
    {
     "id": 115,
     "theme": "leaves-yellow",
     "bio_font_color": "#C6670E",
     "button_color": "#C6670E",
     "font_button_color": "#FFFFFF",
     "button_hover_color": "#974E0A"
    },
    {
     "id": 116,
     "theme": "wave-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 117,
     "theme": "wave-brown",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 118,
     "theme": "wave-dual-tone",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 119,
     "theme": "wave-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 120,
     "theme": "wave-mocca",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 121,
     "theme": "wave-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 122,
     "theme": "wave-peach",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#3D0D71",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 123,
     "theme": "wave-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#BD2D8C",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 124,
     "theme": "wave-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 125,
     "theme": "wave-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#740000",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 126,
     "theme": "wave-soft-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 127,
     "theme": "wave-soft-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 128,
     "theme": "wave-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 129,
     "theme": "waves-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 130,
     "theme": "waves-chocolate",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 131,
     "theme": "waves-green",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#0E8012",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 132,
     "theme": "waves-grey",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#505050",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 133,
     "theme": "waves-light-blue",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#081F66",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 134,
     "theme": "waves-light-brown",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 135,
     "theme": "waves-ocean",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#122B74",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 136,
     "theme": "waves-orange",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 137,
     "theme": "waves-pink",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#BD2D8C",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 138,
     "theme": "waves-purple",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#B707AC",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 139,
     "theme": "waves-red",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#740000",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 140,
     "theme": "waves-sand",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#8C1E10",
     "button_hover_color": "#F5F5F5"
    },
    {
     "id": 141,
     "theme": "waves-yellow",
     "bio_font_color": "#FFFFFF",
     "button_color": "#FFFFFF",
     "font_button_color": "#C6670E",
     "button_hover_color": "#F5F5F5"
    },
    {
       "id": 142,
       "theme": "abstract-black-animate",
       "bio_font_color": "#ffffff",
       "button_color": "#ff6cb5",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 143,
       "theme": "abstract-blue-wave",
       "bio_font_color": "#ffffff",
       "button_color": "#cdebff",
       "font_button_color": "#00385f",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 144,
       "theme": "abstract-fade-in",
       "bio_font_color": "#ffffff",
       "button_color": "#e45bb9",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 145,
       "theme": "abstract-shadow-fall",
       "bio_font_color": "#ffffff",
       "button_color": "#004573",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 146,
       "theme": "abstract-live-bg",
       "bio_font_color": "#062841",
       "button_color": "#062841",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 147,
       "theme": "abstract-motion-bg",
       "bio_font_color": "#ffffff",
       "button_color": "#f15a29",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 148,
       "theme": "abstract-bubble",
       "bio_font_color": "#ffffff",
       "button_color": "#004162",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 149,
       "theme": "abstract-snow",
       "bio_font_color": "#ffffff",
       "button_color": "#22622d",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 150,
       "theme": "abstract-wave-red-2",
       "bio_font_color": "#ffffff",
       "button_color": "#cccccc",
       "font_button_color": "#e21400",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 151,
       "theme": "abstract-waves-acti",
       "bio_font_color": "#ffffff",
       "button_color": "#c21b20",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"	
    },
    {
       "id": 152,
       "theme": "abstract-interstellar",
       "bio_font_color": "#201f1f",
       "button_color": "#fdbdbf",
       "font_button_color": "#c21b20",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 153,
       "theme": "abstract-trianglify-the-little-mermaid",
       "bio_font_color": "#ffffff",
       "button_color": "#ffffff",
       "font_button_color": "#047c9a",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 154,
       "theme": "abstract-confetti-doodles",
       "bio_font_color": "#ffffff",
       "button_color": "#ff8a00",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 155,
       "theme": "abstract-gradient-brown",
       "bio_font_color": "#ffffff",
       "button_color": "#4d3d30",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 156,
       "theme": "abstract-gradient-exo",
       "bio_font_color": "#ffffff",
       "button_color": "#ffffff",
       "font_button_color": "#e78872",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 157,
       "theme": "abstract-ripple-blue",
       "bio_font_color": "#1d6eea",
       "button_color": "#ffffff",
       "font_button_color": "#1d6eea",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 158,
       "theme": "abstract-ripple-pink",
       "bio_font_color": "#cb3045",
       "button_color": "#ecb47e",
       "font_button_color": "#ecb3045",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 159,
       "theme": "abstract-trianglify-bee",
       "bio_font_color": "#ffffff",
       "button_color": "#8d5410",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 160,
       "theme": "abstract-waves-bleach",
       "bio_font_color": "#ffffff",
       "button_color": "#7f807a",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 161,
       "theme": "abstract-trianglify-wedding",
       "bio_font_color": "#161616",
       "button_color": "#7f807a",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 162,
       "theme": "abstract-trianglify-frozen",
       "bio_font_color": "#ffffff",
       "button_color": "#736187",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 163,
       "theme": "abstract-waves-magica-adoka",
       "bio_font_color": "#f56440",
       "button_color": "#ffffff",
       "font_button_color": "#f56440",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 164,
       "theme": "abstract-waves-tableau",
       "bio_font_color": "#ffffff",
       "button_color": "#f56440",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    },
    {
       "id": 165,
       "theme": "abstract-waves-bluex",
       "bio_font_color": "#ffffff",
       "button_color": "#946d8d",
       "font_button_color": "#ffffff",
       "button_hover_color": "#F5F5F5"
    }
  
  ];
  template = templates[0];
  var picker,dataView,dataFree;
  var color_picker,rounded,outline;
  // https://www.shift8web.ca/2017/01/use-jquery-sort-reorganize-content/
  function sortMeBy(arg, sel, elem, order) {
    var $selector = $(sel),
    $element = $selector.children(elem);
    $element.sort(function(a, b) {
            var an = parseInt(a.getAttribute(arg)),
            bn = parseInt(b.getAttribute(arg));
            if (order == "asc") {
                    if (an > bn)
                    return 1;
                    if (an < bn)
                    return -1;
            } else if (order == "desc") {
                    if (an < bn)
                    return 1;
                    if (an > bn)
                    return -1;
            }
            return 0;
    });
    $element.detach().appendTo($selector);
  }
  
  function loadLinkBio(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/link-bio');?>",
      data: { id: <?php echo $pages->id; ?>},
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('.sortable-link').html(data.view);
        loadPixelPage();
      }
    });
  }
  
  /*SAVE TAMPILAN AND DESCRIPTION*/
  function tambahTemp() {
    var form = $('#saveTemplate')[0];
    var formData = new FormData(form);
    var desc = $("#description").html();
    var desc_text = $("#description").text();

    /*console.log(desc_text.length);
    return false;*/

    if(desc_text.length > 104)
    {
      alert("Deskripsi melebihi 104 karakter");
      return false;
    }

    formData.append('description',desc);
    formData.append('proof_text_color',$("#proof_preview").attr('proof-text'));
   
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      dataType: 'json',
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      url: "<?php echo url('/save-template');?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      statusCode: {
        419: function() { 
          window.location.href = "<?php echo url('/login');?>"; //or what ever is your login URI 
        }
      },
      success: function(data) {
        
        $(window).scrollTop(0);
        if(data.status == "success") {
          /*changed = 0;
          changelink = 0;
          changechat = 0;
          changepixel = 0;
          changeproof = 0;
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");*/
         
          reloadPage(3);
        }
        if(data.status == "error") {
            $('#loader').hide();
            $('.div-loading').removeClass('background-load');

            //var data=jQuery.parseJSON(result);
            $("#pesanAlert").html(data.message);
            $("#pesanAlert").show();
            $("#pesanAlert").addClass("alert-danger");
            $("#pesanAlert").removeClass("alert-success");
            $(".alert-success").hide();
        }
      },
      error : function(xhr,throwable,other){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
  }

  //to make serialize to normal data
  function rearray_serialize(data)
  {
    var obj;
    var arr = [];
    data = data.split("&");
    var gdata = data;
    var len = data.length;

    //data name
    data = data[0].split("="); //just to take data name
    var data_name = data[0].split('[]')[0];
   
    //data value
    for(x=0;x<len;x++)
    {
      var data_value = gdata[x].split("=")[1];
      arr.push(data_value);
    }

    // convert array to object
    arr = Object.assign({}, arr); 
    obj = { [data_name] : arr };
    // console.log(obj);
    return obj;
  }

  function tambahPages() {
    var youtube_id = $('input[name="embed"]').val();
    var data = new FormData($("#savelink")[0]);
    /*var msg = rearray_serialize($('.sortable-msg').sortable('serialize'));
    data.append('msg',JSON.stringify(msg));*/

    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      processData:false,
      cache:false,
      contentType: false,
      dataType: 'text',
      /*data: $("#savelink").serialize() + '&' + $('.sortable-msg').sortable('serialize') + '&' + $('.sortable-link').sortable('serialize') + '&' + $('.sortable-sosmed').sortable('serialize'), */
      // data: $("#savelink").serialize(), 
      data : data,
      url: "{{ url('save-link') }}",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      statusCode: {
        419: function() { 
          window.location.href = "<?php echo url('/login');?>"; //or what ever is your login URI 
        }
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $(window).scrollTop(0);
        var data = jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();

         load_embed();

        if (data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
          // loadLinkBio();
          //new 
          // $(".delete-link").parents("li").each(function( index ) {
            // if ($(this).val() != ''){
              // $(this).remove();
            // }
          // });
          changed = 0;
          changelink = 0;
          changechat = 0;
          changepixel = 0;
          changeproof = 0;
          refreshwa();
          loadLinkBio();
          refreshpixel();
          return true;
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
          return false;
        }
      },
      error : function(xhr)
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
  }

  // SAVE PIXEL
  function tambahpixel(proof) 
  {
    //CHECK WHETHER SCRIPT HAS ERROR OR NOT
    var data_script;
    var elscript = document.getElementById("error-script");
    elscript.innerHTML = ''; //to make element error-script have default value length
    window.onerror = function(error){
        $("#pesanAlert").html('Javascript error silahkan cek kembali');
        $("#pesanAlert").addClass("alert-danger");
        $("#pesanAlert").removeClass("alert-success");
        $("#pesanAlert").show();
        //alert(error);
        elscript.innerHTML = error;
    };

    data_script = $("#script").val();
    $("#script-code").html(data_script);
    var len = elscript.innerHTML.length;

    if(len > 0)
    {
        location.href="#pesanAlert";
        $("#script-code").html('');
        return false;
    }

    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      url: "{{ url('save-pixel') }}",
      dataType: 'text',
      data:  $("#savepixel").serialize(),
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#script').val("");
        $('#judul').val("");
        $('#editidpixel').val("");
        $(".error").hide();
        $(window).scrollTop(0);
        refreshpixel();
        loadPixelPage();

        changed = 0;
        changelink = 0;
        changechat = 0;
        changepixel = 0;
        changeproof = 0;

        var data = jQuery.parseJSON(result);
        $(".alertTitle").removeClass("alert-danger");
        $(".alertTitle").html('');

        $("#pesanAlert").html(data.message);
        $(".alertTitle").html(data.errtitle);
        $("#pesanAlert").show();
        // $(window).scrollTop(0);
        if(data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert, .alertTitle").removeClass("alert-danger");
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
          location.href="#pesanAlert";
        } 
        if (data.statustitle == "error") {
          $(".alertTitle").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-danger");
          location.href="#pesanAlert";
        } 
        if (data.statusfb == "error") {
          $(".error").show();
          $(".fb_id").html(data.fb_id);
          $(".fb_event").html(data.fb_event);
          $(".fb_custom_event").html(data.fb_custom_event);
          location.href="#pesanAlert";
        }
        
      },
      error : function(xhr){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    }); 
  }

  function tambahBanner() {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      dataType: 'text',
      url: "<?php echo url('/banner/load-banner') ;?>",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('.contentBanner').append(data.view);
      }
    });
  }

  function refreshpixel() {
    //console.log($('#idpage').val());
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      data: {
        idpage: $('#idpage').val(),
      },
      url: "<?php echo url('/load-pixel'); ?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#content').html(data.view);
        adaptiveLink();
        //$('.pixellink').html(data.pixelink);
      }
    });
  }

  function delete_pixel(idpixel) {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      data: {
        idpixel: idpixel,
      },
      url: "<?php echo url ('/pixel/deletepixel'); ?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshpixel();
        }

        $('#delete-success').modal('show');
        setTimeout(function(){
          $('#delete-success').modal('hide')
        }, 3000);

        changed = 0;
        changelink = 0;
        changechat = 0;
        changepixel = 0;
        changeproof = 0;
      }
    });
  }

  function loadPixel(){
    $.ajax({
      // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/load-pixel-page'); ?>",
    /*  data: { id:0 },*/
      dataType: 'json',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        dataView = result.view;
        dataFree = result.free;

         //if klo free maka replace element dengan label 
        if (dataFree == "1") {
          $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 7 hari, Silahkan <a href='{{ url('pricing') }}' target='_blank'>Upgrade</a></label>" );
        }

        /*var data = jQuery.parseJSON(result);*/
        // $(selector).html(data.view);
       /* dataView = data.view;
        dataFree = data.free;*/
      }
    });
  }

  loadPixel();

  function loadPixelPage() {
    $("#wapixel").html(dataView);
    $("#wapixel").val('{{$pages->wa_pixel_id}}');
    $("#telegrampixel").html(dataView);
    $("#telegrampixel").val('{{$pages->telegram_pixel_id}}');
    $("#skypepixel").html(dataView);
    $("#skypepixel").val('{{$pages->skype_pixel_id}}');
    $("#linepixel").html(dataView);
    $("#linepixel").val('{{$pages->line_pixel_id}}');
    $("#messengerpixel").html(dataView);
    $("#messengerpixel").val('{{$pages->messenger_pixel_id}}');
    $("#youtubepixel").html(dataView);
    $("#youtubepixel").val('{{$pages->youtube_pixel_id}}');
    $("#fbpixel").html(dataView);
    $("#fbpixel").val('{{$pages->fb_pixel_id}}');
    $("#igpixel").html(dataView);
    $("#igpixel").val('{{$pages->ig_pixel_id}}');
    $("#tkpixel").html(dataView);
    $("#tkpixel").val('{{$pages->tk_pixel_id}}');
    $("#twitterpixel").html(dataView);
    $("#twitterpixel").val('{{$pages->twitter_pixel_id}}');
    <?php if(!$banner->count()) { ?>
      $(".bannerpixel").html(dataView);
      $(".bannerpixel").val(0);
    <?php } ?>
    
    <?php 
    if($links->count()) {
      // foreach($links as $link) {
    ?>
        $(".link-list").each(function( index ) {
          $(this).find("select.linkpixel").html(dataView);
          $(this).find("select.linkpixel").val($(this).find("select.linkpixel").attr('data-pixel-id'));
          // $(this).find("select.linkpixel").val($(this).find("select").attr('data-pixel-id'));
        });
     
    <?php 
      // }
    }
    else {
    ?>
      $("#linkpixel-1").html(dataView);
      $("#linkpixel-1").val(0);
      $("#linkpixel-2").html(dataView);
      $("#linkpixel-2").val(0);
    <?php } ?>    
    // $(".sortable-link > li:visible").each(function( index ) {
      // console.log( index + ": " + $( this ).text() );
      // $(this).find("select").html(dataView);
      // $(this).find("select").val(0);
    // });
    if (dataFree == "1") {
      $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 7 hari, Silahkan <a href='<?php echo url('pricing'); ?>' target='_blank'>Upgrade</a></label>" );
    }
    
    @foreach($banner as $ban)
    $(".bannerpixel-{{$ban->id}}").html(dataView);
    $(".bannerpixel-{{$ban->id}}").val('{{$ban->pixel_id}}');
    @endforeach
  }
  
  function tambahwalink() {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      data: $("#savewalink").serialize(),
      url: "<?php echo url('/save-walink');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        var data = jQuery.parseJSON(result);
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $('#nomorwa').val("");
        $('#pesan-wa').val("");
        $(window).scrollTop(0);
        ///$('#demo').val("");
        refreshwa();
        
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
        // $(window).scrollTop(0);
        if(data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
        }
        
      }
    });
  }

  function refreshwa() {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/load-wa-link');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $('#contentwa').html(data.viewer);
      }
    });
  }

  function deletewalink(idwalink) {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      data: {
        idwalink: idwalink,
      },
      url: "<?php echo url('/walink/deletewalink');?>",
      dataType: 'text',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        if (data.status == 'success') {
          refreshwa();
        }

        $('#delete-success').modal('show');
        setTimeout(function(){
          $('#delete-success').modal('hide')
        }, 3000);
      }
    });
  }

  //SCALE BANNER IMAGE
  $(window).on('load', function(){
      resize();
  });

  function resize()
  {
     var cons = 2.17;
     var hin = 0;
     /* image banner */
     $(".banner-image").each(function(i){
         var width = $(this).eq(i).width();
         hin = width/cons;
         hin = Number(hin.toFixed(1));
         $(this).eq(i).height(hin);
     });
  }

  function plusSlides(n) {
    showSlides(slideIndex += n );
  }

  function currentSlide(n,f) {
    showSlides(slideIndex = n,f);
  }

  function showSlides(n,f=null) {
    var i;
    var fr = $(".slideshow-container").attr('fst');
    // let slides = document.getElementsByClassName("mySlides");
    // let slides = document.getElementsByClassName("mySlides");
    if ($('.preview-mobile').hasClass('preview-none')){
      var dots = $(".dot");
      var slides = $(".mySlides");
    }
    else {
      var dots = $(".preview-mobile .dot");
      var slides = $(".preview-mobile .mySlides");
    }
    // console.log(n);  
    // console.log(slides.length);
    
    if (n > slides.length) {// need to be fix
        slideIndex = 1;
    }
    if (n < 1) {
      slideIndex = slides.length;
    }
    for (i = 0; i < slides.length; i++) 
    {
      slides[i].style.display = "none";
      //slides[i].value='hid';
    }
    for (i = 0; i < dots.length; i++) 
    {
      dots[i].className = dots[i].className.replace("activated","");
    }

    // first slides 
    if(fr === "first" && n == 1)
    {
      slideIndex = 2;
    }

    if(f == "first")
    {
      slideIndex = 1;
    }

    if (slides.length>0) {
      slides[slideIndex-1].style.display = "block";
    }
    if (dots.length>0) {
      dots[slideIndex-1].className +=" activated";
    }

    $(".slideshow-container").attr('fst',null);
  }
  
  function dotsok()
  {
    let i,a=0,dotselement,slidesid;
    dotselement=$('#dot-view');
    slidesid=$('.mySlides');
    for (i = 0; i < slidesid.length ; i++) 
    {
      a+=1;
      dotselement.append('<span class="dot picture-id-'+a+'-dot input-picture-'+a+'-dot" id="input-picture-'+a+'-dot" onclick="currentSlide('+i+')"></span>');
    }
     if ($(".dot").length==1) {
      $(".dot").parent().hide();
      $('.prev').hide();
      $('.next').hide();
    }
  }

  //isi template dulu 
  strTemplate = "";
  <?php if (!is_null($pages->wallpaper)) { ?>
    strTemplate = "<?php echo $pages->wallpaper; ?>";
  <?php } ?>
  <?php if (!is_null($pages->gif_template)) { ?>
    strTemplate = "<?php echo $pages->gif_template; ?>";
  <?php } ?>
  res = strTemplate.replace("animation-", "");
  //cek ada ngga di json
  $.each( templates, function( key, value ) {
    if (res == value.theme) {
      template = value;
    }
  });

  function check_outlined(){
    // if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
      if ($('.outlined').prop("checked") == true) {
        //$(".mobile1").addClass("outlinedview");
        $(".screen").addClass("outlinedview");
        $('.outlined').val(1);

        $('.btnview').css("background-color","transparent");
        if ($('#is_text_color').prop("checked") == false) {
          $('.btnview').css("border-color",$("#colorOutlineButton").val());
          $('.btnview').css("color",$("#colorOutlineButton").val());
        } else {
          // $('.btnview').css("border-color",$('#textColor').val());
          $('.btnview').css("border-color",$("#colorOutlineButton").val());
          $('.btnview').css("color",$('#textColor').val());
        }

        /*$('.btnview').css("border-color",$("#colorButton").val());
        $('.btnview').css("color",$("#colorOutlineButton").val());*/
      } else if ($('.outlined').prop("checked") == false) {
        //$(".mobile1").removeClass("outlinedview");
        $(".screen").removeClass("outlinedview");
        $('.outlined').val(0);
        
        $('.btnview').css("background-color",$("#colorButton").val());
        $('.btnview').css("border-color",'transparent');
        //$('.btnview').css("color","#fff");
        if ($('#is_text_color').prop("checked") == false) {
          $('.btnview').css("color",$("#colorOutlineButton").val());
        } else {
          $('.btnview').css("color",$("#textColor").val());
        }
      }
      if ($('#is_bio_color').prop("checked") == true) {
        $('.description').css("color",$("#bioColor").val());
        $('.proof-wrapper-preview').css("background-color",$("#bioColor").val());
        $('#sm-preview li a').css("color",$("#bioColor").val()+" !important");
        $('.powered-omnilinks a').css("color",$("#bioColor").val()+" !important");
      }
    // } 
    // else 
    if ( ($('#modeBackground').val()=="wallpaper") || ($('#modeBackground').val()=="animation") ) {
      if ($('.outlined').prop("checked") == false) {
        $('.btnview').css("border-color",template.button_color);
        $('.btnview').css("background-color",template.button_color);
        $('.btnview').css("color",template.font_button_color);
      }
      if ($('#is_text_color').prop("checked") == false) {
        $('.btnview').css("color",template.font_button_color);
      } else {
        $('.btnview').css("color",$("#textColor").val());
      }
      if ($('#is_bio_color').prop("checked") == false) {
        $('.description').css("color",template.bio_font_color);
        // $('.proof-wrapper-preview').css("background-color",template.bio_font_color);
        $('#sm-preview li a').css("color",template.bio_font_color+" !important");
        $('.powered-omnilinks a').css("color",template.bio_font_color+" !important");
      }
      
    }
  }

  function check_rounded(){
    if ($('.rounded').prop("checked") == true) {
      //$(".mobile1").addClass("roundedview");
      $(".screen").addClass("roundedview");
      $('.rounded').val(1);
    } 
    else if ($('.rounded').prop("checked") == false) {
      //$(".mobile1").removeClass("roundedview");
      $(".screen").removeClass("roundedview");
      $('.rounded').val(0);
    }
  }

  <?php if ($user->membership<>'free') { ?>  
  function check_powered(){
    if ($('#powered').prop("checked") == true) {
      $("#poweredview").children().show();
      $('#powered').val(1);
    }
    else if ($('#powered').prop("checked") == false) {
      $("#poweredview").children().hide();
      $('#powered').val(0);
    }
  }
  <?php } ?>

  function check_click_bait(){
    if ($('#is_click_bait').prop("checked") == true) {
      $("#phonecolor").addClass("service");
      // $("#viewLink li").first().addClass("animate-buzz");
      $("#viewLink").find('li:not(:empty):first').addClass("animate-buzz");
      $('#is_click_bait').val(1);
    }
    else if ($('#is_click_bait').prop("checked") == false) {
      $("#phonecolor").removeClass("service");
      // $("#viewLink li").first().removeClass("animate-buzz");
      $("#viewLink").find('li:not(:empty):first').removeClass("animate-buzz");
      $('#is_click_bait').val(0);
    }
  }
  
  function check_text_color(){
    if ($('#is_text_color').prop("checked") == true) {
      $('#is_text_color').val(1);
    }
    else if ($('#is_text_color').prop("checked") == false) {
      $('#is_text_color').val(0);
    }
    check_outlined();
    check_rounded();
  }

  function check_bio_color(){
    if ($('#is_bio_color').prop("checked") == true) {
      $('#is_bio_color').val(1);
    }
    else if ($('#is_bio_color').prop("checked") == false) {
      $('#is_bio_color').val(0);
    }
    check_outlined();
    check_rounded();
  }

  function delete_photo(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type : 'get',
      url : "<?php echo url('/delete-photo') ?>",
      dataType: 'text',
      data : {
        id: "<?php echo $uuid; ?>",
      },
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        
        $('#pesanAlert').html(data.message);
        $('#pesanAlert').show();
        if(data.status=='success'){
          $('#pesanAlert').removeClass('alert-warning');
          $('#pesanAlert').addClass('alert-success');
          
          //
          $('#wizardPicturePreview').attr('src', "<?php echo asset('image/no-photo.jpg'); ?>").fadeIn('slow');
          // $('#viewpicture').attr('src', "<?php echo asset('image/no-photo.jpg'); ?>").fadeIn('slow');
          $('#viewpicture').attr('src', "").fadeIn('slow');
          $('.div-picture').hide();
          
          $("#wizardPicturePreview-delete").hide();
        } else {
          $('#pesanAlert').removeClass('alert-success');
          $('#pesanAlert').addClass('alert-warning');
        }
      }
    });  
  }

  // fixFont
  /*%F0%9D%97%A6
  %F0%9D%97%BC
  %F0%9D%97%B9
  %F0%9D%97%B1
  %F0%9D%97%AE
  %F0%9D%97%B1
  %F0%9D%98%82
  %F0%9D%9F%B1
  %F0%9D%9F%B2*/

  function tambah_premiumid() 
  {
    /*var val = $('#custom_id').val();
    $(".btn-premiumid").html(val);
    return false;*/
    $.ajax({
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data: $('#form-premiumID').serialize().replace(/\%F0+|\%9D+/g,""),
      url: "{{ url('/premium-id-biolinks/tambah') }}",
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        var data = jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
        if (data.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
          $("#custom-link-show").html(data.customLink);
          $("#btn-copy-custom-link").attr("data-link",data.customLink);
        }
        if (data.status == "error") {
          $("#pesanAlert").addClass("alert-danger");
          $("#pesanAlert").removeClass("alert-success");
        }
      }
    });
  }
    function renameColMessage(){
      arrGetViewCount = $('#getview li:visible').length;
      mydiv = Math.floor(arrGetViewCount/3);
      mymod = arrGetViewCount%3;

      colsisa = 0;
      if(mymod>0){
        colsisa = 12/mymod;
      }

      col = 0;
      count_3 = 0;
      counter = 1;
      $( "#getview li:visible" ).each(function() {
        if(mydiv<=0){
          //0
          col = colsisa;
        } else {
          col = 4;
          //1
        }
        
        //do things here, untuk membetulkan col, menghide tulisan
        $( this ).attr("class", "link pl-1 pr-1 col-"+col );
        $(this).find("label").show();
        if(mydiv>0){
          $(this).find("label").hide();
        }
        
        counter += 1;
        
        count_3 = count_3 + 1;
        if(count_3>=3){
          mydiv = mydiv-1;
          count_3 = 0;
        } 
        
      });
    }
    
</script>

<section id="tabs" class="col-md-10 offset-md-1 col-12 pl-0 pr-0 project-tab">
  <div class="container body-content-mobile main-cont">
    <div class="row">
      <div class="col-md-12">
        <h4 style="color: #106BC8">
          <a href="{{url('/')}}">
            <button class="btn btn-default btn-back mb-2">
              <i class="fas fa-arrow-circle-left"></i>
              Back
            </button>
          </a>
        </h4>
      
        <!--
        <br>
        @if(Auth::user()->membership=='free')
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="close" aria-label="Close" data-dismiss="alert">
              <span aria-hidden="true">×</span>
            </button>
            <?php  
              $time = Helper::get_trial_time();
              echo $time;
            ?>
            
            <a class="back-link" href="{{url('pricing')}}">
              Subscribe
            </a>
            untuk terus menggunakan Omnilinkz
          </div>
        @endif-->
      </div>
      
      <div class="offset-lg-0 col-lg-7 offset-md-1 col-md-10">
        <div id="pesanAlert" class="alert mb-0"></div>
      </div>

      <div class="col-12">
        <button class="btn btn-success mt-3 mb-3 btn-premium">
          <i class="fas fa-star"></i> <?php if (is_null($pages->premium_names)) { echo "Get"; } else { echo "Update"; } ?> Custom Link
        </button>
      </div>

      <!-- form API -->
      <div class="col-lg-7 col-md-12 col-sm-12 col-12 mb-2">
        <span class="err_connect"><!-- notification --></span>
       <!--  <div class="form-check">
            <input id="connect_activrespon" type="checkbox" class="form-check-input connect_check"  $connect_activrespon>
            <label class="form-check-label">Connect Activrespon <span class="tooltipstered" title="<div class='panel-content'>Jika anda memiliki akun activrespon,<br/> maka anda bisa me-connect-kan form ke list activrespon</div>">
              <i class="fas fa-question-circle icon-reflink"></i>
              </span>
            </label>
        </div> -->
        <div class="form-check">
            <input id="connect_mailchimp" type="checkbox" class="form-check-input connect_check" {{$connect_mailchimp}}>
            <label class="form-check-label"><span class="mailchimp_label">Connect Mailchimp</span> <span class="tooltipstered" title="<div class='panel-content'>Jika anda memiliki akun mailchimp,<br/> maka anda bisa me-connect-kan form ke audience/list pada akun mailchimp anda</div>">
              <i class="fas fa-question-circle icon-reflink"></i>
              </span></label>
        </div>

        <form id="save_connect" class="row mt-2 mb-3">
          <div class="col-lg-9 col-md-12 col-sm-12 col-12">
            <!-- activrespon -->
           <!--  <div id="activrespon">
              <div class="form-group">
                <input placeholder="Form Activrespon" type="text" class="form-control" maxlength="190" name="act_form_text" value="{{ $pages->act_form_text }}"/>
                <div class="error err_act_form_text"></div>
              </div> 

              <div class="form-group">
                <input placeholder="Form Activrespon Bottom" type="text" class="form-control" maxlength="190" name="act_form_bottom" value="{{ $pages->act_form_bottom }}"/>
                <div class="error err_act_form_bottom"></div>
              </div>

              <div class="form-group">
                <input placeholder="Activrespon API-KEY" type="text" class="form-control" maxlength="190" name="list_id" value="{{ $pages->list_id }}"/>
                <div class="error err_list_id"></div>
              </div>
            </div> -->

            <!-- mailchimp -->
            <div id="mailchimp" class="mb-2">
              <div class="form-group d-flex">
                <input placeholder="Form Mailchimp" type="text" class="form-control" maxlength="190" name="mc_form_text" value="{{ $pages->mc_form_text }}"/>
                <div class="error err_mc_form_text"></div>
              </div>

              <div class="form-group d-flex">
                <input placeholder="Form Mailchimp Bottom" type="text" class="form-control" maxlength="190" name="mc_form_bottom" value="{{ $pages->mc_form_bottom }}"/>
                <div class="error err_mc_form_bottom"></div>
              </div>

              <div class="form-group d-flex">
                <input placeholder="Mailchimp API-KEY" type="text" class="form-control mr-2" maxlength="190" name="api_key" value="{{ $pages->api_key_mc }}"/>
                <span class="tooltipstered" title="<div class='panel-content'>login dahulu pada akun mailchimp anda <br/> dan masuk pada : <br/> Account &rarr; Extras &rarr; API keys<br/>Account terletak pada menu bagian paling bawah sebelah kiri,<br/> dan apabila cursor diarahkan akan mengeluarkan text username anda</div>">
                <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
              <div class="error err_api_key"></div>

              <div class="form-group d-flex">
                <input placeholder="Mailchimp Server" type="text" class="form-control mr-2" maxlength="190" name="server_mailchimp" value="{{ $pages->server_mailchimp }}"/>
                <span class="tooltipstered" title="<div class='panel-content'>Login dahulu pada akun mailchimp anda,<br/> arahkan cursor anda pada address bar dan copy usx,<br/> contoh : https://us9.admin.mailchimp.com/ <br/> maka anda cukup meng-copy yang <b>us9</b> saja.</div>">
                <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div> 
              <div class="error err_server_mailchimp"></div>

              <div class="form-group d-flex">
                <input placeholder="Mailchimp Audience/List id" type="text" class="form-control mr-2" maxlength="100" name="audience_id" value="{{ $pages->audience_id }}"/>
                 <span class="tooltipstered" title="<div class='panel-content'>Login dahulu pada akun mailchimp anda, pilih menu : <br/> Audience &rarr; All contacts &rarr; Settings &rarr; Audience names and defaults <br/> pada text Audience ID ada code seperti ini : <b>fa483e0c87</b> </div>">
                <i class="fas fa-question-circle icon-reflink"></i>
                </span>
              </div>
              <div class="error err_audience_id"></div>

              <select name="position_api" class="form-control mb-2">
              <option value="0">Tampilkan di atas</option>
              <option value="1">Tampilkan di bawah</option>
              </select>
              <div class="error err_position_api"></div>
              <button class="btn btn-primary">Save</button>
            <!-- end mailchimp -->
            </div>
            
          </div>
        </form>
      </div>

      <div class="offset-lg-0 col-lg-7 offset-md-1 col-md-10">
        @if(Session::has('msg'))
          <div class="alert alert-success">{{ Session::get('msg') }}</div>
        @endif
      </div>
      
      <div class="col-12">
        <a href="https://{{env('SHORT_LINK')}}/{{$custom_link}}" target="_blank" id="custom-link-show">https://{{env('SHORT_LINK')}}/{{$custom_link}}</a> <span id="btn-copy-custom-link" class="btn-copy" data-link="https://{{env('SHORT_LINK')}}/{{$custom_link}}"><i class="fas fa-file"></i></span>
      </div>

      <div class="offset-lg-0 col-lg-7 offset-md-1 col-md-10">
        

        <div class="card carddash" style="margin-bottom:20px;">
          <div class="card-body">
            <ul class="mb-4 nav nav-tabs">
              <li class="nav-item">
                <a href="#link" class="nav-link link @php $x = 0 @endphp @if($mod == 1 || $mod == 2 || $mod == 3) @php $x = 1 @endphp @endif @if($x==0) active @endif" role="tab" data-toggle="tab">
                  Link
                </a>
              </li>

              <li class="nav-item">
                <a href="#style" class="nav-link link @if($mod == 3) active @endif" role="tab" data-toggle="tab">
                  Tampilan
                </a>
              </li>
              
              <?php 
                $dt1 = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
                $dt2 = Carbon::now();
                if ( ($user->membership=='free') && ($dt2->gt($dt1)) ) {
                }
                else {
              ?>
              <li class="nav-item">
                <a href="#pixel" class="nav-link link" role="tab" data-toggle="tab">
                  Pixel
                </a>
              </li> 

              <li class="nav-item">
                <a href="#proof" class="nav-link link @if($mod == 2) active @endif" role="tab" data-toggle="tab">
                  Activproof
                </a>
              </li>
              <?php } ?>

              <li class="nav-item">
                <a href="#walink" class="nav-link link" role="tab" data-toggle="tab">
                  WA Link Creator
                </a>
              </li> 

              @if($valid == true)
              <li class="nav-item">
                <a href="#wachat" class="nav-link link @if($mod == 1) active @endif" role="tab" data-toggle="tab">
                  WA Chat
                </a>
              </li>
              @endif

            </ul>

            <div class="tab-content">

              <!-- tab 1-->
              <div role="tabpanel" class="tab-pane fade in @php $x = 0 @endphp @if($mod == 1 || $mod == 2 || $mod == 3) @php $x = 1 @endphp @endif @if($x==0) active show @endif" id="link">

                <form method="post" id="savelink" action="{{url('save-link')}}" novalidate>
                  {{ csrf_field() }}

                  <!--messengers!-->
                  <input type="hidden" name="uuid" value="{{$uuid}}">

                  <label class="mb-3 blue-txt">
                    Messenger
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="tambah">
                    <i class="fas fa-plus"></i>
                  </button>

                  <div class="hid mb-5">
                    <ul class="sortable-msg">
                      <li id="msg-li-wa"> <!-- wa -->
                        <div id="wa" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-whatsapp"></i>
                                  </div>
                                </div>
                                <input type="text" name="wa" class="form-control wa-input" value="{{$pages->wa_link}}" id="input-msg-wa" onkeypress="return hanyaAngka(event)" placeholder="Masukkan nomor WhatsApp ex : 6281...">
                                <input type="hidden" name="sortmsg[]" value="" data-val="wa" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="wapixel" class="form-control linkpixel" id="wapixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletewa">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-telegram"> <!-- telegram -->
                        <div id="telegram" class="messengers div-table hide"  style="display:none;" >
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-telegram-plane"></i>
                                  </div>
                                </div>
                                <input type="text" name="telegram" class="form-control telegram-input" id="" value="{{$pages->telegram_link}}" placeholder="Masukkan username Telegram">
                                <input type="hidden" name="sortmsg[]" value="" data-val="telegram" class="input-hidden">
                              </div>

                              <div class="col-md-12 col-12 pr-0 pl-0">
                                <select name="telegrampixel" id="telegrampixel" class="form-control linkpixel"></select>
                              </div>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletetelegram">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-skype"> <!-- skype -->
                        <div id="skype" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-skype"></i>
                                  </div>
                                </div>
                                <input type="text" name="skype" class="form-control skype-input" id="" value="{{$pages->skype_link}}" placeholder="Masukkan username Skype">
                                <input type="hidden" name="sortmsg[]" value="" data-val="skype" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="skypepixel" class="form-control linkpixel" id="skypepixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deleteskype">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span> 
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-line"> <!-- line -->
                        <div id="line" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-line"></i>
                                  </div>
                                </div>
                                <input type="text" name="line" class="form-control line-input" value="{{$pages->line_link}}" id="" placeholder="Masukkan username Line">
                                <input type="hidden" name="sortmsg[]" value="" data-val="line" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="linepixel" class="form-control linkpixel" id="linepixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deleteline">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>

                      <li id="msg-li-messenger"> <!-- messenger -->
                        <div id="messenger" class="messengers div-table hide" style="display:none;">
                          <div class="div-cell">
                            <span class="handle">
                              <i class="fas fa-bars"></i>
                            </span>
                          </div>

                          <div class="div-cell">
                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <i class="fab fa-facebook-messenger"></i>
                                  </div>
                                </div>
                                <input type="text" name="messenger" class="form-control messenger-input" value="{{$pages->messenger_link}}" id="" placeholder="Masukkan username Messenger">
                                <input type="hidden" name="sortmsg[]" value="" data-val="messenger" class="input-hidden">
                              </div>
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="messengerpixel" class="form-control linkpixel" id="messengerpixel"></select>
                            </div>
                          </div>

                          <div class="div-cell cell-btn" id="deletemessenger">
                            <span>
                              <i class="far fa-trash-alt"></i>
                            </span>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>

                  <!--Links-->
                  <label class="mb-3 blue-txt">
                    Link
                  </label>
                  <label class="switch" style="margin-left:33px;margin-right:15px;">
                    <input type="checkbox" name="is_click_bait" id="is_click_bait" value="<?php if($pages->is_click_bait) echo '1'; ?>" <?php if($pages->is_click_bait) echo 'checked'; ?>>
                    <span class="slider round"></span>
                  </label>
                  <label class="caption">
                    Buzz Animation
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="addlink">
                    <i class="fas fa-plus"></i>
                  </button>
                  <br>

                  <div class="row">
                    <div class="col-md-2 col-3">
                    </div>
                    <div class="col-md-4 col-4">
                    </div>
                    <div class="col-md-4 col-4">
                    </div>
                  </div>
                  
                  <div class="mb-5">
                    <ul class="sortable-link a">
                      <!-- link displayed here -->
                    </ul>
                  </div>

                  <!--social media-->
                  <label class="mb-3 blue-txt">
                    Media Sosial
                    <span class="tooltipstered" title="<div class='panel-heading'>Media Sosial</div><div class='panel-content'>
                    Youtube : https://youtube.com/namachannel <br>
                    Facebook : https://facebook.com/username-facebook <br>
                    Instagram : username-instagram <br>
                    Twitter : username-twitter <br>
                    Tiktok : username-tiktok <br>
                    </div>">
                      <i class="fas fa-question-circle icon-reflink"></i>
                    </span>
                  </label>
                  <button type="button" class="float-right btn btn-primary btn-sm" id="sm">
                    <i class="fas fa-plus"></i>
                  </button>

                  <ul class="sortable-sosmed">
                    <li id="sosmed-youtube">
                      <div id="youtube" class="socialmedia div-table mb-4 hide">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="youtube" class="input-hidden">
      
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-youtube"></i>
                                </div>
                              </div>
                              <input type="text" name="youtube" class="form-control youtube-input" id="" placeholder="masukkan channel youtube url" value="{{$pages->youtube_link}}">
                            </div>
                          </div> 
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="youtubepixel" id="youtubepixel" class="form-control linkpixel">
                            </select>
                          </div> 
                        </div>
                          
                        <div class="div-cell cell-btn" id="deleteyoutube">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>                      
                    </li>

                    <li id="sosmed-fb">
                      <div id="fb" class="socialmedia div-table hide" data-type="fb" style="">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="fb" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-facebook-f"></i>
                                </div>
                              </div>
                              <input type="text" name="fb" class="form-control fb-input" value="{{$pages->fb_link}}" id="" placeholder="masukkan username facebook">
                            </div>

                            <div class="col-md-12 col-12 pr-0 pl-0">
                              <select name="fbpixel" id="fbpixel" class="form-control linkpixel"></select>
                            </div>
                          </div>
                        </div>
                        
                        <div class="div-cell cell-btn" id="deletefb">
                          <span>
                            <i class="far fa-trash-alt"></i>  
                          </span>
                        </div>
                      </div>
                    </li>

                    <li id="sosmed-twitter">
                      <div id="twitter" class="socialmedia div-table hide" data-type="twitter" style="">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="twitter" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-twitter"></i>
                                </div>
                              </div>
                              <input type="text" name="twitter" class="form-control twitter-input" id="" placeholder="masukkan username twitter" value="{{$pages->twitter_link}}">
                            </div>
                          </div>
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="twitterpixel" id="twitterpixel" class="form-control linkpixel">
                            </select>
                          </div>
                        </div>
                          
                        <div class="div-cell cell-btn" id="deletetwitter">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>
                    </li>

                    <li id="sosmed-ig">
                      <div id="ig" class="socialmedia div-table hide" data-type="ig" style="">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="ig" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                  <i class="fab fa-instagram"></i>
                                </div>
                              </div>
                              <input type="text" name="ig" class="form-control ig-input" value="{{$pages->ig_link}}" id="" placeholder="masukkan username instagram">
                            </div>
                          </div>
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="igpixel" id="igpixel" class="form-control linkpixel">
                            </select>
                          </div>
                        </div>
                          
                        <div class="div-cell cell-btn" id="deleteig">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>
                    </li>

                    <li id="sosmed-tiktok">
                      <div id="tiktok" class="socialmedia div-table hide" data-type="tiktok" style="">
                        <input type="hidden" name="sortsosmed[]" value="" data-val="tiktok" class="input-hidden">
                        <div class="div-cell">
                          <span class="handle">
                            <i class="fas fa-bars"></i>
                          </span>
                        </div>

                        <div class="div-cell">
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text">
                                 <i class="fab fa-tiktok"></i>
                                </div>
                              </div>
                              <input type="text" name="tiktok" class="form-control tiktok-input" value="{{$pages->tk_link}}" id="" placeholder="masukkan username tiktok tanpa @">
                            </div>
                          </div>
                          <div class="col-md-12 col-12 pr-0 pl-0">
                            <select name="tkpixel" id="tkpixel" class="form-control linkpixel">
                            </select>
                          </div>
                        </div>
                          
                        <div class="div-cell cell-btn" id="deletetk">
                          <span>
                            <i class="far fa-trash-alt"></i>
                          </span>
                        </div>
                      </div>
                    </li>
                  </ul>

                  <!-- -modal option for social media -->
                  <div class="modal fade" id="modal-social-media" tabindex="-1" role="dialog"aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Social Media
                                </div>
                                <div class="modal-body">
                                  <!-- Youtube -->
                                  <div class="form-check">
                                      <input id="check_youtube" type="checkbox" class="form-check-input check_social" data-check="youtube">
                                      <label class="form-check-label"><i class="fab fa-youtube"></i> Youtube</label>
                                  </div>
                                  <!-- Facebook -->
                                  <div class="form-check">
                                      <input id="check_fb" type="checkbox" class="form-check-input check_social" data-check="fb">
                                      <label class="form-check-label"><i class="fab fa-facebook-f"></i> Facebook</label>
                                  </div>
                                  <!-- Twitter -->
                                  <div class="form-check">
                                      <input id="check_twitter" type="checkbox" class="form-check-input check_social" data-check="twitter">
                                      <label class="form-check-label"><i class="fab fa-twitter"></i> Twitter</label>
                                  </div>
                                  <!--  Instagram -->
                                  <div class="form-check">
                                      <input id="check_ig" type="checkbox" class="form-check-input check_social" data-check="ig">
                                      <label class="form-check-label"><i class="fab fa-instagram"></i> Instagram</label>
                                  </div>
                                  <!--  Tiktok -->
                                  <div class="form-check">
                                      <input id="check_tiktok" type="checkbox" class="form-check-input check_social" data-check="tiktok">
                                      <label class="form-check-label"><i class="fab fa-tiktok"></i> Tiktok</label>
                                  </div>
                                  <!-- end -->
                                </div>
                                <div class="modal-footer">
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div> 

                  <div class="as offset-md-8 col-md-4 pr-0 menu-nomobile">
                    <button type="button" id="btn-save-link" class="btn btn-primary btn-block btn-biolinks btn-save-link">
                      <!--<i class="far fa-save" style="margin-right:5px;"></i>-->
                      SAVE
                    </button>
                  </div>

                  <div class="menu-mobile">
                    <div class="row btn-mobile">
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-default btn-block btn-preview">
                          PREVIEW
                        </button>
                      </div>
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-primary btn-block btn-save-preview btn-save-link">
                          SAVE
                        </button>  
                      </div>
                    </div>  
                  </div>
                  
                </form>
              </div>
      
              <!-- TAB 3 -->
              <div role="tabpanel" class="tab-pane fade " id="walink">
                <form id="savewalink" method="post" style="margin-bottom: 40px;margin-top: 40px;">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <span class="blue-txt">
                    WhatsApp Link Creator
                  </span>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-4">
                      <label for="nomorwa" class="control-label">
                        WhatsApp Method
                      </label>  
                    </div>
                    
                    <div class="col-md-6 col-9 pr-1">
                      <div class="radio">
                        <label><input type="radio" name="optRadioWaMethod" checked value="standard" id="radio_button_wa_standard"> Standard</label>
                        <label><input type="radio" name="optRadioWaMethod" value="deepLink" id="radio_button_wa_deep_link"> Deep Link</label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-4">
                      <label for="nomorwa" class="control-label">
                        Masukkan Nomor WA
                      </label>  
                    </div>

                    <div class="col-md-6 col-9 pr-1">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
                            +62
                          </div>
                        </div>
                        <input type="text" name="nomorwa" id="nomorwa" class="form-control col-md-12" onkeypress="return hanyaAngka(event)">
                      </div>
                    </div>

                    <div class="col-md-2 col-3 pl-0 text-right">
                      <button type="reset" class="btn btn-danger btn-reset ">
                        Reset
                      </button>
                    </div>
                  </div>

                  <div class="card">
                    <span class="card-header card-gray">
                      Masukkan Pesan
                    </span>
                    <textarea class="form-control" name="pesan" id="pesan-wa" style="height:100px"></textarea>
                  </div>

                  <input type="text" name="editidwa" hidden="" id="editidwa">
                  <textarea id="demo" hidden="" name="textlink"></textarea>

       
                  <div class="offset-md-6 col-md-6 pl-0 pr-0 text-right">
                    <button type="button" class="btn btn-primary btn-block btn-biolinks" id="generate" style="margin-top: 20px;">
                      SAVE & CREATE LINK
                    </button>  
                  </div>  
              
                </form>

                <hr>

                <div class="margin" style="margin-top: 20px;">
                  <span class="blue-txt mb-4">
                    Recent WhatsApp Link Creator
                  </span>
                  <div class="accordion mt-3" id="accordionExample">
                    <div id="contentwa"></div>
                  </div>
                </div>
              </div>

              <!-- TAB 4 -->
              <div class="tab-pane fade" id="pixel">
                <form id="savepixel" method="post" style="margin-bottom: 40px;margin-top: 40px;">
                  {{ csrf_field() }}
                  <input type="hidden" name="uuidpixel" value="{{$uuid}}">
                  <input type="hidden" name="idpage" id="idpage" value="{{$pageid}}">
                  <span class="blue-txt">
                    Pixel Retargetting
                  </span>

                  <div class="fb-pixel-option">
                    <div class="form-group">
                        <label class="control-label">Pixel ID</label>  
                        <input type="text" class="form-control" name="fb_id" />
                        <span class="error fb_id"><!-- error --></span>
                    </div> 

                    <div class="form-group">
                        <label class="control-label">FB Pixel Event</label>  
                        <select class="form-control" name="fb_event">
                          <option value="AddPaymentInfo">AddPaymentInfo</option>
                          <option value="AddToCart">AddToCart</option>
                          <option value="AddToWishlist">AddToWishlist</option>
                          <option value="CompleteRegistration">CompleteRegistration</option>
                          <option value="Contact">Contact</option>
                          <option value="CustomizeProduct">CustomizeProduct</option>
                          <option value="Donate">Donate</option>
                          <option value="FindLocation">FindLocation</option>
                          <option value="InitiateCheckout">InitiateCheckout</option>
                          <option value="Lead">Lead</option>
                          <option value="Purchase">Purchase</option>
                          <option value="Schedule">Schedule</option>
                          <option value="Search">Search</option>
                          <option value="StartTrial">StartTrial</option>
                          <option value="SubmitApplication">SubmitApplication</option>
                          <option value="Subscribe">Subscribe</option>
                          <option value="ViewContent">ViewContent</option>
                          <option value="CustomEvent">Custom Event</option>
                        </select>
                        <span class="error fb_event"><!-- error --></span>
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" name="fb_custom_event" placeholder="Nama Event" />
                        <span class="error fb_custom_event"><!-- error --></span>
                    </div>
                  </div> 

                  <textarea class="form-control mt-3" name="script" id="script" style="height:100px"></textarea>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-2">
                      <label class="control-label">
                        Jenis
                      </label>  
                    </div>
                    
                    <div class="col-md-6 col-12">
                      <select class="form-control col-md-12" name="jenis_pixel" id="jenis_pixel">
                        <option value="fb">
                          FB Pixel
                        </option>
                        <option value="twitter">
                          Twitter Retargetting
                        </option>
                        <option value="google">
                          Google Retargetting
                        </option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-2">
                      <label class="control-label">
                        Title
                      </label>  
                    </div>
                    
                    <div class="col-md-6 col-12 mb-3">
                      <input type="text" class="form-control col-md-12" name="title" placeholder="Masukkan Judul" id="judul">
                      <input type="text" name="editidpixel" hidden id="editidpixel">
                      <div class="alertTitle alert "><!-- Error --></div>
                    </div>

                    <div class="col-md-4 pl-md-0 pl-3 text-center">
                      <button type="button" id="btnpixel" class="btn btn-primary btn-setting-biolinks mr-2" style="width:45%">
                        Save
                      </button>
                      <button type="reset" class="btn btn-danger btn-reset btn-setting-biolinks" style="width:45%">
                        Reset
                      </button>
                    </div>
                  </div>

                </form>

                <hr>

                <span class="blue-txt">
                  Recent Pixel Retargetting
                </span>
                <div class="accordion mt-3" id="accordionExample">
                  <div id="content"></div>
                </div>
              </div>

               <!-- TAB 6 -->
              <div id="proof" class="tab-pane fade in @if($mod==2) active show @endif">
                <div class="notice"><!-- display message --></div>
                <form id="saveproof" class="mb-4 mt-4">

                  <span class="blue-txt">ActivProof</span>
                    
                  <div class="form-group mt-3 mb-4 row">
                    <div class="col-md-2">
                      <label class="control-label">Name</label>  
                    </div>
                    <div class="col-lg-12 mb-3">
                      <input type="text" class="form-control" name="proof_name" placeholder="Masukkan Nama" maxlength="14" />
                      <small>Maksimal 14 karakter</small>
                      <div class="error proof_name"><!-- Error --></div>
                    </div>

                    <div class="col-md-2">
                      <label class="control-label">Text</label>  
                    </div>
                    <div class="col-lg-12 mb-3">
                      <textarea maxlength="125" class="form-control" name="proof_text" placeholder="Masukkan Text"></textarea>
                      <small>Maksimal 125 karakter</small>
                      <div class="error proof_text"><!-- Error --></div>
                    </div>

                    <div class="col-md-2">
                      <label class="control-label">Image</label>  
                    </div>
                    <div class="col-lg-12 mb-3">
                      <input type="file" class="form-control" name="proof_image" placeholder="Masukkan Text" />
                      <small>Ukuran 100 x100 pixel, tipe harus : jpg, jpeg, png</small>
                      <span class="proof_notes"></span>
                      <span class="error proof_image"><!-- Error --></span>
                    </div>

                    <div class="col-md-2">
                      <label class="control-label">Stars</label>  
                    </div>
                    <div class="col-lg-12 mb-3">
                      <input type="number" value="5" min="1" max="5" class="form-control" name="proof_stars" placeholder="Jumlah bintang" />
                      <span class="error proof_stars"><!-- Error --></span>
                    </div>

                    <div class="col-md-4 ml-auto pl-md-0 pl-3 text-center">
                        <button type="submit" id="btn_proof" class="btn btn-primary btn-setting-biolinks mr-2" style="width:45%">
                          Save
                        </button>
                      <button type="reset" class="btn btn-danger btn-reset btn-proof-reset btn-setting-biolinks" style="width:45%">
                        Reset
                      </button>
                    </div>
                  </div>

                </form>

                <!-- proof list -->
                <span class="blue-txt">
                  List of Proofs
                </span>
                <div class="accordion mt-3" id="accordionExample">
                  <div id="loaded_proof"></div>
                </div>

              </div>
              
              <!-- TAB 2 -- Tampilan -->
              <div role="tabpanel" class="tab-pane fade in @if($mod==3) active show @endif" id="style">
                <form method="post" id="saveTemplate" enctype="multipart/form-data">

                  {{ csrf_field() }}
                  <input type="hidden" name="uuidtemp" value="{{$uuid}}">
                  <div class="form-group">
                    <div class="col-md-12">
                      <div class="row mt-5">
                        <div class="col-md-4 mb-3 picture-container">
                          <div class="picture" style="width: 106px;height: 106px;">
                            <img src="<?php 
                            if(is_null($pages->image_pages)){
                              echo asset('image/no-photo.jpg');
                            } 
                            else {
                              echo Storage::disk('s3')->url($pages->image_pages);
                            }
                            ?>" class="picture-src img-responsive" id="wizardPicturePreview" title="" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')" style="width:100%;height:100%;object-fit: cover;object-position: center;">
                            <input type="file" name="imagepages" id="file-wizard-picture" class="" accept=".png, .jpg">
                          </div>
                          <!--<i class="fa fa-trash" id="wizardPicturePreview-delete" aria-hidden="true"></i>-->
                          <span id="wizardPicturePreview-delete" aria-hidden="true" style="color: red">Delete</span>
                        </div>
                        <div class="col-md-8">
                          <input type="text" name="judul" id="pagetitle" value="<?php if (is_null($pages->page_title)) { echo "Your Title Here"; } else { echo $pages->page_title; } ?>" class="form-control" placeholder="Masukkan judul" style="margin-bottom: 5px">

                          <!-- editor -->
                          <!-- <textarea id="description" name="description" class="form-control" style="margin-bottom: 5px;resize: none;" rows="3" cols="53" maxlength="80" wrap="hard" placeholder="Max 80 character" no-resize>{{ $description }}
                            </textarea> -->

                          <!-- <div id="description" contenteditable="true"> -->
                          <div id="description" placeholder="Maksimal 104 Karakter" contenteditable="true">{!! $description !!}</div>

                          <fieldset>

                            <button type="button" id='create_italic' class="btn btn-primary text-white btn-sm" title="Italicize Highlighted Text"><i>Italic</i>
                            </button>

                            <!-- click on Event Attribute -->
                            <button type="button" id="create_bold" class="btn btn-primary text-white btn-sm"><b>Bold</b>
                            </button>

                          </fieldset>
                         

                          <input placeholder="eg : https://omnilinkz.com" id="url" class="form-control" type="text" />  

                          <div><small><b>Note</b> : Untuk menggunakan link, masukkan link di kolom atas, kemudian blok tulisan / text yang akan di link dan click tombol <b>Buat Link</b> kemudian click tombol <b>Save</b>.</small> </div>
                         
                          <button type="button" class="btn btn-primary btn-sm mt-1" id="make-bold">Buat Link</button>

                        </div>
                        <div class="col-md-12 mt-4">
                        @if(Auth::user()->membership!='free') 
                          <button type="button" class="float-right mb-3 btn btn-primary btn-sm" id="addBanner">
                            <i class="fas fa-plus"></i>
                          </button>
                        @endif
                        @if(Auth::user()->membership!='free')
                          <span class="blue-txt">
                            Banner Promo
                          </span>
                          <div class="contentBanner mb-4">
                            <div id="loadbanner" class="c div-banner">
                              @include('user.dashboard.bannerload')
                            </div>
                          </div>
                        @endif
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <input type="hidden" name="modeBackground" id="modeBackground" value="gradient">
                      <input type="hidden" name="backtheme" id="backtheme" value="colorgradient1">
                      <input type="hidden" name="wallpaperclass" id="wallpaperclass" value="wallpaper1">
                      <input type="hidden" name="animationclass" id="animationclass" value="animation-abstract-black-animate animation-core">
                      <p class="blue-txt">
                        Theme
                      </p>
                      
                      <div class="row mb-2">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="rounded" class="rounded" value="<?php if($pages->is_rounded) echo '1'; ?>" <?php if($pages->is_rounded) echo 'checked';?>>
                            <span class="slider round"></span>
                          </label>
                          
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Rounded buttons 
                            <span class="tooltipstered" title="<div class='panel-heading'>Rounded buttons</div><div class='panel-content'>Atur warna & bentuk button sesuai keinginanmu</div>">
                              <i class="fas fa-question-circle icon-reflink"></i>
                            </span>
                          </label>
                        </div>
                        <div class="col-md-5 col-5">
                          <a href="" id="link-custom-background-color" class="nav-link p-0">Custom Color</a>
                        </div>
                      </div>
                      <!-- Modal For Color Picker Button-->
                      <div class="modal fade" id="modal-color-picker-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Background Color For The Buttons
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                      <div align="center">
                                        <div id="colorpickerButton"></div>
                                        <input type="text" id="colorButton" name="colorButton" value="#123456">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-btn" type="button" data-dismiss="modal">Apply</button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>  

                      <div class="row mb-2">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="outlined" class="outlined" value="<?php if($pages->is_outlined) echo '1'; ?>" <?php if($pages->is_outlined) echo 'checked'; ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Outlined buttons
                            <span class="tooltipstered" title="<div class='panel-heading'>Outlined buttons</div><div class='panel-content'>Atur warna & tampilan buttonmu hanya berbentuk garis saja</div>">
                              <i class="fas fa-question-circle icon-reflink"></i>
                            </span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <a href="" id="link-custom-outline-color" class="nav-link p-0">Custom Color</a>
                        </div>
                      </div>
                      <!-- Modal For Color Picker Button-->
                      <div class="modal fade" id="modal-color-picker-outline-button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Outline Color For The Buttons
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                      <div align="center">
                                        <div id="colorpickerOutlineButton"></div>
                                        <input type="text" id="colorOutlineButton" name="colorOutlineButton" value="#ffffff">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-out" type="button" data-dismiss="modal" >Apply </button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>  
                      
                      <div class="row mb-2">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="is_text_color" id="is_text_color" class="is_text_color" value="<?php if($pages->is_text_color) echo '1'; ?>" <?php if($pages->is_text_color) echo 'checked'; ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Text & Hover Color
                            <span class="tooltipstered" title="<div class='panel-heading'>Text & Hover Color</div><div class='panel-content'>Atur warna teks & hover button sesuai keinginanmu</div>">
                              <i class="fas fa-question-circle icon-reflink"></i>
                            </span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <a href="" id="link-text-color" class="nav-link p-0">Custom Color</a>
                        </div>
                      </div>
                      <!-- Modal For Color Picker Button-->
                      <div class="modal fade" id="modal-color-picker-text-color" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Text & Hover Color 
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                      <div align="center">
                                        <div id="colorpickerTextColor"></div>
                                        <input type="text" id="textColor" name="textColor" value="#ffffff">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-text" type="button" data-dismiss="modal" >Apply </button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="row mb-2">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input type="checkbox" name="is_bio_color" id="is_bio_color" class="" value="<?php if($pages->is_bio_color) echo '1'; ?>" <?php if($pages->is_bio_color) echo 'checked'; ?>>
                            <span class="slider round"></span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Bio Color
                            <span class="tooltipstered" title="<div class='panel-heading'>Bio Color</div><div class='panel-content'>Atur warna Bio, Icon Media Sosial & Activproof sesuai keinginanmu</div>">
                              <i class="fas fa-question-circle icon-reflink"></i>
                            </span>
                          </label>
                        </div>
                        <div class="col-md-4 col-4">
                          <a href="" id="link-bio-color" class="nav-link p-0">Custom Color</a>
                        </div>
                      </div>
                      <!-- Modal For Color Picker Button-->
                      <div class="modal fade" id="modal-color-picker-bio-color" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    Choose Bio Color 
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-md-4 col-xs-4">
                                      <div align="center">
                                        <div id="colorpickerBioColor"></div>
                                        <input type="text" id="bioColor" name="bioColor" value="#ffffff">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button class="btn btn-primary btn-apply-bio" type="button" data-dismiss="modal" >Apply </button>
                                  <button type="button" data-dismiss="modal" class="btn" >Close </button>
                                </div>
                            </div>
                        </div>
                      </div>
                      <?php if ($user->membership<>'free') { ?>  
                        <div class="row">
                          <div class="col-md-2 col-3">
                            <label class="switch">
                              <input type="checkbox" name="powered" id="powered" value="<?php if($pages->powered) { echo '1'; } ?>" <?php if($pages->powered) echo 'checked'; ?>>
                              <span class="slider round"></span>
                            </label>
                          </div>
                          <div class="col-md-8 col-8">
                            <label class="caption">
                              Powered By Omnilinkz
                            </label>
                          </div>
                          <div class="col-md-4 col-4">
                          </div>
                        </div>
                      <?php } ?>
                    </div>
                    
                    <div class="as">
                      <!-- Bootstrap CSS -->
                      <ul class="nav nav-tabs sub-nav mt-4" role="tablist">
                        <li class="nav-item sub-nav">
                          <a class="nav-link active" href="#references" id="solid" role="tab" data-toggle="tab">Solid</a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="#buzz" id="gradient" role="tab" data-toggle="tab">Gradient <!--<sup>pro</sup>--></a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="#wallpaper" id="wallpaper-tab" role="tab" data-toggle="tab">Wallpaper <!--<sup>pro</sup>--></a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="<?php if ( ($user->membership=='elite') || ($user->membership=='super')) { echo "#animation"; } else { echo "#"; } ?>" id="animation-tab" role="tab" <?php if ( ($user->membership=='elite') || ($user->membership=='super') ) { echo 'data-toggle="tab"'; } ?>>Animation <sup>elite</sup></a>
                        </li>
                      </ul>
                      <!-- Tab panes -->
                      <div class="tab-content mt-4 mb-4">

                        <!--theme color -->
                        <div role="tabpanel" class="tab-pane fade in  " id="buzz">

                          <div class="theme mrgtp text-center">
                            @include('user.dashboard.background.theme-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade active show" id="references">
                          <div align="center">
                            <div id="colorpicker"></div>
                            <input type="text" id="color" name="color" value="#ffffff">
                          </div>
                        </div>
                        

                        <div role="tabpanel" class="tab-pane fade" id="wallpaper">
                          <div align="center">
                            @include('user.dashboard.background.wallpaper-page')
                          </div>
                        </div>

                        <div role="tabpanel" class="tab-pane fade" id="animation">
                          <select id="select-animation">
                            <option value="abstract">abstract *new</option>
                            <option>bubble</option>
                            <option>bubble-up</option>
                            <option>cloud</option>
                            <option>confetti</option>
                            <option>disk</option>
                            <option>gradient</option>
                            <option>leaves</option>
                            <option>wave</option>
                            <option>waves</option>
                          </select>
                          <div align="center">
                            @include('user.dashboard.background.animation-page')
                          </div>
                        </div>

                        
                      </div>

                      <div class="offset-md-8 col-md-4 pr-0 menu-nomobile">
                        <button type="button" class="btn btn-primary btn-block btn-biolinks savetemp" id="savetemp">
                          <!--<i class="far fa-save" style="margin-right:5px;"></i>-->
                          SAVE
                        </button>  
                      </div>

                      <div class="menu-mobile">
                        <div class="row btn-mobile">
                          <div class="col-6 pl-0 pr-0">
                            <button type="button" class="btn btn-default btn-block btn-preview">
                              PREVIEW
                            </button>
                          </div>
                          <div class="col-6 pl-0 pr-0">
                            <button type="button" class="btn btn-primary btn-block btn-save-preview savetemp">
                              SAVE
                            </button>  
                          </div>
                        </div>  
                      </div>

                    </div>
                  </div>
                </form>

              </div>

              <!-- TAB 5-->
              <div role="tabpanel" class="tab-pane fade in @if($mod==1) active show @endif" id="wachat">
               
                  <label class="mb-3 blue-txt">
                    Chat Settings
                  </label>
                      
                  <form method="post" id="savewa" action="{{url('save-link')}}" novalidate>
                      {{ csrf_field() }}
                      <input type="hidden" name="uuid" value="{{$uuid}}">

                      <!-- enable button -->
                      <div class="row mb-2">
                        <div class="col-md-2 col-3">
                          <label class="switch">
                            <input class="enable_closest" type="checkbox" name="enable_chat" @if($pages->enable_chat == 1) checked @endif />
                            <span class="slider round"></span>
                          </label>
                          
                        </div>
                        <div class="col-md-4 col-4">
                          <label class="caption">
                            Enable Chat
                            <span class="tooltipstered" title="<div class='panel-heading'>Enable Chat</div><div class='panel-content'>Menampilkan WA chat link</div>">
                              <i class="fas fa-question-circle icon-reflink"></i>
                            </span>
                          </label>
                        </div>
                      </div>

                      <!-- buzz button -->
                      <div class="row mb-2">
                          <div class="col-md-2 col-3">
                            <label class="switch">
                              <input type="checkbox" class="enable_closest" name="buzz_btn" class="rounded" @if($pages->buzz_btn == 1) checked @endif>
                              <span class="slider round"></span>
                            </label>
                            
                          </div>
                          <div class="col-md-4 col-4">
                            <label class="caption">
                              Buzz Button
                              <span class="tooltipstered" title="<div class='panel-heading'>Buzz Button</div><div class='panel-content'>Memberikan efek buzz atau getaran</div>">
                                <i class="fas fa-question-circle icon-reflink"></i>
                              </span>
                            </label>
                          </div>
                      </div>

                       <!-- wa header -->
                      <div class="row mb-2">
                          <div class="col-md-8">
                              <textarea class="form-control" name="wa_header">@if($pages->wa_header == null || empty($pages->wa_header)) Text Header WA @else {{$pages->wa_header}} @endif</textarea>
                          </div>

                          <div class="col-md-4 row">
                            <label class="caption">
                              WA Header Text
                              <span class="tooltipstered" title="<div class='panel-heading'>WA Header Text</div><div class='panel-content'>Mengganti text pada header WA chat</div>">
                                <i class="fas fa-question-circle icon-reflink"></i>
                              </span>
                            </label>
                          </div>
                      </div>

                       <!-- wa button -->
                      <div class="row mb-2">
                          <div class="col-md-8">
                              <input type="text" class="form-control" name="wa_btn_text" value="@if($pages->wa_btn_text == null || empty($pages->wa_btn_text)) Text Button WA @else {{$pages->wa_btn_text}} @endif" />
                          </div>

                          <div class="col-md-4 row">
                             <!-- IF NEED STYLING JUST OPEN THIS REMARK
                             <a class="btn btn-success textbold">Bold</a>
                             <a class="btn btn-success texttalic">Italic</a>
                           -->

                            <label class="caption">
                              WA Button Text
                              <span class="tooltipstered" title="<div class='panel-heading'>Wa Button Text</div><div class='panel-content'>Mengganti text pada tombol wa</div>">
                                <i class="fas fa-question-circle icon-reflink"></i>
                              </span>
                            </label>
                          </div>
                      </div>

                      <!-- pixel -->
                      <div class="row mb-2">
                          <div class="col-md-8">
                             <select name="wapixelchat" class="form-control linkpixel" id="wapixelchat"></select>
                          </div>

                          <div class="col-md-4 row">
                            <label class="caption">
                              Pixel Retargetting
                            </label>
                          </div>
                      </div>

                  <!-- end settings -->

                  <div class="as offset-md-8 col-md-4 pr-0 menu-nomobile">
                    <button type="button" id="btn-save-wa-chat" class="btn btn-primary btn-block btn-biolinks">
                      SAVE
                    </button>
                  </div>

                  <div class="menu-mobile">
                    <div class="row btn-mobile">
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-default btn-block btn-preview">
                          PREVIEW
                        </button>
                      </div>
                      <div class="col-6 pl-0 pr-0">
                        <button type="button" class="btn btn-primary btn-block btn-save-preview btn-save-link">
                          SAVE
                        </button>  
                      </div>
                    </div>  
                  </div>
                  
                </form>

                <!-- chat members -->

                  <label class="mb-3 mt-3 blue-txt">
                    Users
                  </label>

                  <div class="row mb-4">
                     <div class="col-md-12">
                      <button type="button" class="mt-1 btn btn-primary btn-sm chat_register">
                        Create New User  
                      </button>
                    </div>
                  </div>

                  <!-- wa members -->
                  @if(!is_null($wachat))
                    <div id="wa_chat_member_data"></div>
                  @endif
                  <!-- end wa members -->

                  <!-- end chat members -->
              </div>

            </div>
          </div>
        </div>
      </div>

      <!--phone preview-->
      <div class="col-md-5">
        <div class="fixed">
          <div class="center preview-center">
            <div class="mobile d-none d-lg-block">
              <div class="mobile1">
                <div class="screen " id="phonecolor" style="border:none; overflow-y:auto; ">
                  <!--screen-->
                  <header id="proof-fix-preview" class="col-md-12" style="padding-top: 17px; padding-bottom: 12px;">

                  <!-- proof-preview -->
                  <div id="proof_preview" proof-text="black" >
                    @include('user.dashboard.previewproof')
                  </div>

                    <div class="row">
                      <div class="col-md-2 col-3">
                        <div class="div-picture">
                          <?php  
                            $viewpicture = asset('/image/no-photo.jpg');
                            if(!is_null($pages->image_pages)){
                              // echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); 
                              $viewpicture = Storage::disk('s3')->url($pages->image_pages);
                            }
                          ?>
                          <img id="viewpicture" src="<?php echo $viewpicture ?>" style="width:100%;height:100%;border-radius: 50%;object-fit: cover;object-position: center;" altSrc="{{asset('/image/no-photo.jpg')}}" onerror="this.src = $(this).attr('altSrc')">
                        </div>
                      </div>
                      <div class="col-md-10 col-9 p-2">
                        <ul class="mobile-desc ">
                          <li style="display: block; margin-bottom: -15px; font-size : 18px">
                            <span class="font-weight-bold"><p class="description" style="color: #fff;" id="outputtitle"></p></span>
                          </li>
                          <li style="display: block; margin-bottom: -15px;">
                            <p class="description" style="color: #fff; word-break: break-all;" id="outputdescription"></p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </header>

                  <!-- banner -->
                  @if(Auth::user()->membership!='free')
                  <div class="col-md-12 fix-image ">
                    <div class="slideshow-container">
                      <div class="ap" id="viewbanner">
                      <?php 
                      if($banner->count() > 0){
                        $ut=0;
                        foreach($banner as $ban) {
                          $ut+=1; 
                          if (!is_null($ban->images_banner)){
                      ?>
                        <div class="mySlides mylides fit" id="picture-id-<?=$ut?>-get">
                          <?php
                            if ($ban->images_banner=="0"){
                              $bg_image = asset('/image/434x200.jpg');
                            }
                            else {
                              $bg_image = Storage::disk('s3')->url($ban->images_banner);
                            }
                          ?>
                          <div id="image-update-<?=$ut?>" style="background-image:url('<?php echo $bg_image; ?>');" class="banner-image test input-picture-<?=$ut?>-get"></div>
                        </div>
                      <?php 
                        }}?>


                      @if(Auth::user()->membership!='free')
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>
                      @endif
                      <?php } ?>
                      </div>
                    </div>
                  
                    <div style="text-align:center ; margin-top: -25px;" id="dot-view"></div>
                  </div>
                  @endif
                  
                  <!-- social media links -->

                  <!-- proof-preview -->
                  <ul class="row links messengers links-num-1 "id="getview" style="margin-top: 12px; margin-left: 15px; margin-right: 10px;">
                    <li class="link col pl-1 pr-1 hide" id="waviewid"> 
                      <a href="#" class="btn btn-md btnview txthov" style="width: 100%;font-size:11px;height: 40px;padding: 10px;" id="walinkview">
                        <i class="fab fa-whatsapp" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Whatsapp
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="telegramviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="telegramlinkview">
                        <i class="fab fa-telegram-plane" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Telegram
                        </label>
                      </a>
                    </li> 
                    <li class="link col pl-1 pr-1 hide" id="skypeviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="skypelinkview">
                        <i class="fab fa-skype" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Skype
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="lineviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="linelinkview">
                        <i class="fab fa-line" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Line
                        </label>
                      </a>
                    </li>
                    <li class="link col pl-1 pr-1 hide" id="messengerviewid" >
                      <a href="#" class="btn btn-md btnview txthov" style="
                      width: 100%;font-size:11px;height: 40px;padding: 10px;" id="messengerlinkview">
                        <i class="fab fa-facebook-messenger" style="font-size:14px;"></i>
                        <label class="" style="font-size:11px;">
                          Messenger
                        </label>
                      </a>
                    </li>
                  </ul>

                  <!-- FORM API -->
                  <div id="form_api_0">
                  <!-- form connect API activrespon -->

                  <div id="form_api_move">
                    <form id="connect_preview_activrespon" class="col-12 mb-2">
                      <h5 class="description text-center"><b id="act_text">{{ $pages->act_form_text }}</b></h5>
                      <h5 class="description text-center"><b id="act_bottom_text">{{ $pages->act_form_bottom }}</b></h5>
                      
                      <div class="form-group mt-3 mb-4 row">
                        <div class="col-lg-12 mb-3">
                          <input type="text" class="form-control" placeholder="Nama" maxlength="50" />
                        </div>

                        <div class="col-lg-12 mb-3">
                          <input type="email" class="form-control" placeholder="Email" />
                        </div>

                        <div class="col-lg-12 mb-3">
                          <input type="phone" class="form-control" placeholder="Phone example +628xxxxxxx" />
                        </div>

                        <div class="col-12">
                         <button type="button" class="btn btnview col-lg-12">Submit</button>
                        </div>
                      </div>
                    </form>

                    <!-- form connect API mailchimp -->

                    <form id="connect_preview_mailchimp" class="col-12 mb-2">
                      <h5 class="description text-center"><b id="mc_text">{{ $pages->mc_form_text }}</b></h5>
                      <h5 class="description text-center"><b id="mc_bottom_text">{{ $pages->mc_form_bottom }}</b></h5>

                      <div class="form-group mt-3 mb-4 row">
                        <div class="col-lg-12 mb-3">
                          <input type="email" class="form-control" placeholder="Email" />
                        </div>

                        <div class="col-lg-12 mb-3">
                          <input type="text" class="form-control" placeholder="First Name" />
                        </div>

                        <div class="col-lg-12 mb-3">
                          <input type="text" class="form-control" placeholder="Last Name" />
                        </div>

                        <div class="col-12">
                         <button type="button" class="btn btnview col-lg-12">Submit</button>
                        </div>
                      </div>
                    </form>
                  <!-- end form_api_move -->
                  </div>

                  </div>

                  <!-- links -->

                  <div class="row display_links" style="font-size: xx-small; margin-left: 3px; margin-right: 2px; font-weight: 700;">
                    <!-- display preview links here .display_links -->
                    <ul class="col-md-12" id="viewLink" >
                      @if($links->count() > 0)
                        @foreach($links as $link)
                          <li id="link-preview-{{$link->id}}">
                              @if($link->options == 1)
                                <span id="link-url-update-{{$link->id}}-get" class="embed-ln-{{$link->id}}">
                                  <a id="textprev-update-{{$link->id}}" href="#" class="btn btn-md btnview title-{{$link->id}}-view-update txthov @if($link->icon_link !== null)image_icon_link_btn @endif" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;">
                                    @if($link->icon_link !== null) 
                                      <img id="preview_title-{{$link->id}}-view-update" src="{!! Storage::disk('s3')->url($link->icon_link) !!}" class="rounded-circle image_icon_link" />
                                    @else
                                      <img src="{{ url('/image/transparent.png') }}" id="preview_title-{{$link->id}}-view-update" class="rounded-circle image_icon_link" />
                                    @endif
                                   {{$link->title}}
                                  </a>
                                </span>
                              @else
                                <span id="link-url-update-{{$link->id}}-get" class="embed-{{$link->id}}">
                                  <div class="embed-responsive embed-responsive-16by9">
                                      <iframe style="padding : 12px" class="embed-responsive-item ifr-{{$link->id}}" src="https://www.youtube.com/embed/{{ $link->youtube_embed }}?rel=0" allowfullscreen></iframe>
                                  </div>
                                </span>
                              @endif
                          </li>
                        @endforeach
                      @endif
                    </ul>
                  </div>

                  <!-- FORM API BOTTOM -->
                  <div id="form_api_1"><!-- kalo user pilih opsi tampilkan di bawah --></div>

                  <!-- SM preview -->
                  <ul class="row rows " style="padding-left: 27px; padding-right: 44px;" id="sm-preview">
                    <li class="col linked hide" id="youtubeviewid">
                      <a href="#" title="Youtube">
                        <i class="fab fa-youtube"></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="fbviewid" >
                      <a href="#" title="fb" >
                        <i class="fab fa-facebook-square" ></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="twitterviewid">
                      <a href="#" title="Twitter">
                        <i class="fab fa-twitter-square"></i>
                      </a>
                    </li>
                    <li class="col linked hide" id="igviewid">
                      <a href="#" title="ig" >
                        <i class="fab fa-instagram" ></i>
                      </a>  
                    </li>  
                    <li class="col linked hide" id="tiktokviewid" style="margin-top : -3px">
                      <a href="#" title="tk" >
                        <i style="font-size:25px" class="fab fa-tiktok"></i>
                      </a>  
                    </li>  
                  </ul>
                  
                    <div class="col-md-12 mb-4 mt-4" align="center" id="poweredview">
                      <div class="powered-omnilinks">
                        <a href="{{url('/')}}">
                          <!--powered by
                          <br>Omnlinkz-->
                          <img style="width: 110px;" src="{{asset('image/powered-by.png')}}">
                        </a>
                      </div>
                    </div>

                    <!-- Whatsapp chat popup -->
                    @if(!is_null($wachat) && !is_null($pages) && $valid == true)
                    <div class="whatsapp_chat_support wcs_fixed_right wcs-show" id="example">
                        <div class="wcs_button">
                          <i class="fab fa-whatsapp"></i>
                          <span class="wcs_text">{{$pages->wa_btn_text}}</span>

                          <!-- popup -->
                          <div class="wcs_popup" style="visibility: visible"> 
                              <div class="wcs_popup_header">
                                  <span class="wcs_text_header">{!! htmlspecialchars_decode($pages->wa_header) !!}
                                  </span>
                              </div>  
                              <div class="wcs_popup_person_container">
                                  <div 
                                      class="wcs_popup_person" 
                                      data-number="{{$wachat->wa_number}}"
                                      data-text = "{{$wachat->wa_text}}"
                                  >
                                      <div class="wcs_popup_person_img"><img src="{{ Storage::disk('s3')->url($wachat->photo) }}" alt=""></div>
                                      <div class="wcs_popup_person_content">
                                          <div class="wcs_popup_person_name">{{$wachat->member_name}}</div>
                                          <div class="wcs_popup_person_description">{{$wachat->position}}</div>
                                          <!--<div class="wcs_popup_person_status">I'm Online</div>-->
                                      </div>  
                                  </div>
                              </div>
                          </div>
                            <!-- end popup -->
                        </div>  
                    </div>
                    @else
                    <!-- for preview if user hasn't registered yet -->
                    <div class="whatsapp_chat_support wcs_fixed_right wcs-show" id="example">
                        <div class="wcs_button">
                          <i class="fab fa-whatsapp"></i>
                          <span class="wcs_text"></span>

                          <!-- popup -->
                          <div class="wcs_popup" style="visibility: visible"> 
                              <div class="wcs_popup_header">
                                  <span class="wcs_text_header">
                                  </span>
                              </div>  
                              <div class="wcs_popup_person_container">
                                  <div 
                                      class="wcs_popup_person" 
                                      data-number=""
                                      data-text = ""
                                  >
                                      <div class="wcs_popup_person_img"><img src="{{asset('/image/no-photo.jpg')}}" alt=""></div>
                                      <div class="wcs_popup_person_content">
                                          <div class="wcs_popup_person_name">Name</div>
                                          <div class="wcs_popup_person_description">Position</div>
                                      </div>  
                                  </div>
                              </div>
                          </div>
                            <!-- end popup -->
                        </div>  
                    </div>
                    @endif
                    <!-- --> 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- untuk preview di mobile -->
  <div class="preview-mobile preview-none">
  </div>

</section>

<!-- Modal Update Premium ID -->
<div class="modal fade" id="premium-id" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div id="test"></div>
      <div class="modal-header header-premiumid">
        <h5 class="modal-title font-premiumid big" id="modaltitle">
          Custom Link
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form-premiumID">
          @csrf

          <input type="hidden" name="id" value="{{$pages->id}}">  

          <div class="form-group">
            <div class="col-12">
              ID Default
            </div>
            <div class="col-12">
              <input class="col-12 form-control" type="text" name="id_default" id="id_default" value="<?php echo env('SHORT_LINK').'/'.$pages->names ?>" readonly>
            </div>
          </div>

          <div class="form-group">
            <div class="col-12 font-premiumid">
              <b>Custom Link</b>
            </div>
            <div class="col-auto">
              <div class="input-group mb-2">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    <?php echo env('SHORT_LINK').'/'; ?>
                  </div>
                </div>
                <input class="form-control" type="text" name="custom_id" id="custom_id" placeholder="YOURLINK" value="<?php if($pages->premium_id!=0) echo $pages->premium_names ?>"> 
              </div>
            </div>
          </div>
        </form>

        <div class="col-12 mb-4" style="margin-top: 30px">
          <button class="btn btn-success btn-block btn-premiumid" data-dismiss="modal">
            UPDATE LINK
          </button>  
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal">
            Kembali
          </a>  
        </div>
        

      </div>
    </div>

  </div>
</div>

<!-- Modal Beli Premium ID -->
<div class="modal fade" id="premium-id-beli" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <img src="{{asset('image/icon-premium-id.png')}}">
        <h5 class="font-premiumid big mt-3 mb-4">
          Custom Link Anda
        </h5>
        <p>Buat Customer Anda lebih mudah mengingat profile online shop Anda dengan custom link anda</p>

        <div class="col-12 offset-lg-1 col-lg-10 mt-5 mb-5">
          <div class="row">
            <div class="col-lg-4 col-12 text-lg-left text-center">
              Link Default <br>
              <?php echo env('SHORT_LINK').'/YtBu8L' ?>
            </div>
            <div class="col-lg-4 col-12">
              <img class="arrow" src="{{asset('image/arrow-green.png')}}">
            </div>
            <div class="col-lg-4 col-12 text-lg-left text-center">
              <span class="font-premiumid">
                Custom Link
              </span> <br>
              <b><?php echo env('SHORT_LINK').'/YOURLINK' ?></b>
            </div>  
          </div>
          
        </div>
        <div class="col-12 col-md-10 offset-md-1 mb-4" style="margin-top: 30px">
          <a href="{{url('pricing')}}" target="_blank" class="free-underline">
            <button class="btn btn-success btn-block btn-beli-premium">
              BELI SEKARANG
            </button>    
          </a>
          
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal" class="free-underline">
            Lain Kali
          </a>  
        </div>
        

      </div>
    </div>

  </div>
</div>

<!-- Modal Beli Premium ID 2, klo klik background animation-->
<div class="modal fade" id="premium-id-beli-2" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <h5 class="font-premiumid big mt-3 mb-4">
          Custom Background Anda
        </h5>
        <img src="{{asset('image/icon-premium-id-2.png')}}" class='img-responsive md-12'>
        <p>Ingin tampilan Biolink anda lebih menarik seperti ini </p>

        <!--<div class="col-12 offset-lg-1 col-lg-10 mt-5 mb-5">
          <div class="row">
            <div class="col-lg-4 col-12 text-lg-left text-center">
              Link Default <br>
              <?php echo env('SHORT_LINK').'/YtBu8L' ?>
            </div>
            <div class="col-lg-4 col-12">
              <img class="arrow" src="{{asset('image/arrow-green.png')}}">
            </div>
            <div class="col-lg-4 col-12 text-lg-left text-center">
              <span class="font-premiumid">
                Custom Link
              </span> <br>
              <b><?php echo env('SHORT_LINK').'/YOURLINK' ?></b>
            </div>  
          </div>
          
        </div>
        -->
        <div class="col-12 col-md-10 offset-md-1 mb-4" style="margin-top: 30px">
          <a href="{{url('pricing')}}" target="_blank" class="free-underline">
            <button class="btn btn-success btn-block btn-beli-premium">
              BELI SEKARANG
            </button>    
          </a>
          
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal" class="free-underline">
            Lain Kali
          </a>  
        </div>
        

      </div>
    </div>

  </div>
</div>

<!-- Modal Delete Confirmation -->
<div class="modal fade" id="confirm-delete" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Confirmation Delete
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <input type="hidden" name="id_delete_link" id="id_delete_link">
        <input type="hidden" name="id_delete_pixel" id="id_delete_pixel">
        <input type="hidden" name="type" id="type">

        Apa Anda yakin untuk <i>menghapus</i> data berikut ?
        <br><br>
        <span class="txt-mode"></span>
        <br>
        
        <div class="col-12 mb-4" style="margin-top: 30px">
          <button class="btn btn-danger btn-block btn-delete-ok" data-dismiss="modal">
            YA, HAPUS SEKARANG
          </button>
        </div>
        
        <div class="col-12 text-center mb-4">
          <a href="#" data-dismiss="modal">
            Kembali ke Dashboard
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Delete Success -->
<div class="modal fade" id="delete-success" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content content-premiumid">
      <div class="modal-header header-premiumid">
        <h5 class="modal-title" id="modaltitle">
          Delete Success
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body text-center">
        <img id="img-success" src="{{asset('image/success.gif')}}" style="max-width: 100px"><br>
        <span class="txt-mode"></span>, berhasil <b>dihapus!</b><br>
        Anda akan diarahkan ke <i>Dashboard</i> dalam 3 detik

        <div class="col-12 text-center mb-4" style="margin-top: 30px">
          <a href="#" data-dismiss="modal">
            Ke Dashboard
          </a>  
        </div>
      </div>

    </div>   
  </div>
</div>

<!-- Modal Copy Link -->
<div class="modal fade" id="copy-link" role="dialog">
  <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">
          Copy Link
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        Copy link berhasil!
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          OK
        </button>
      </div>
    </div>
      
  </div>
</div>

<!-- Modal Alert To Prevent Unsave -->
<div class="modal fade" id="unsave" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        Please save your data before change into another tab, or <a href="#" id="reload-cancel">cancel</a>
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          OK
        </button>
      </div>
    </div>
      
  </div>
</div>

<!-- Modal Alert To Prevent Add WA-Chat user more than 5 -->
<div class="modal fade" id="wa-chat-max" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        Member chat WA maksimal hanya 5
      </div>
      <div class="modal-footer" id="foot">
        <button class="btn btn-primary" data-dismiss="modal">
          OK
        </button>
      </div>
    </div>
      
  </div>
</div>

<!-- Modal To Insert chat members -->
<div class="modal fade" id="wa_chat_member" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="chat_error"><!-- --></div>
        <form id="chat_member">
              <div class="form-group">
                <label>Admin Name:</label>
                <input class="form-control" name="chat_member_name" placeholder="Masukan Nama" />
              </div>
              <div class="form-group">
                <label>Admin Position:</label>
                <input class="form-control" name="chat_member_position" placeholder="Masukkan Posisi / Jabatan" />
              </div>
              <div class="form-group">
                <label>Admin WA Number:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      +62
                    </div>
                  </div>
                  <input type="text" name="chat_member_number" class="form-control col-md-12" onkeypress="return hanyaAngka(event)" />
                </div>
              </div>
              <div class="form-group">
                <label>Admin WA Text:</label>
                <input class="form-control" name="chat_member_text" />
              </div>
              <div class="form-group">
                <label>Photo: Ukuran harus 1 : 1 dan dengan format jpg</label>
                <span class="file_name"><!-- display file name --></span>
                <input type="file" class="form-control" name="chat_member_photo" />
              </div>
              <span class="editrue"></span>
              <input type="hidden" name="uuid" value="{{$uuid}}">
              <input type="hidden" name="pageid" value="{{$pages->id}}">  
      </div>
      <div class="modal-footer" id="foot">
        <button type="submit" class="btn btn-primary btn-status">Register</button>
        <button class="btn btn-default" data-dismiss="modal">
          Cancel
        </button>
      </div>
      </form>

    </div>
      
  </div>
</div>

<!-- count length to determine if script has error -->
<div style="visibility: hidden" id="error-script"></div>

<script src="{{asset('js/farbtastic.js')}}"></script>
<script src="{{asset('js/biolinks.js')}}"></script>
<noscript>Jalankan Javascript di browser anda</noscript>

<script src="{{asset('assets/whatsapp-chat-support/components/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/whatsapp-chat-support/components/moment/moment-timezone-with-data.min.js')}}"></script>
<script src="{{asset('assets/whatsapp-chat-support/whatsapp-chat-support.js')}}"></script>

<script type="text/javascript">
  /*DELAY ON KEYUP
  function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
  } */

  $("#example").whatsappChatSupport();

  $(function(){
    fix_center();

    //CHANGE TEXT ON WA BUTTON
    $("input[name=wa_btn_text]").on('keypress keyup',function(e){
      var text = $(this).val();
      var max = 24; 
      $(".wcs_text").html(text);

      if(text.length >= max)
      {
          e.preventDefault();
          alert('Maksimal text tombol WA adalah 24 karakter');
          text.substring(0,max);
      }
      else
      {
         fix_center();
      }
    });

    /*$(window).resize(function() 
    {
        setRightPost(".wcs_popup");   
    });*/

    wa_preview_header_text();
    getSelected();
    displayWaText();
    wachatloadPixel();
    change_link();
    pastePreview();
    createLinkDescription();
    createItalic();
    create_bold();
    createProof();
    editProof();
    deleteProof();
    resetProof();
    load_proof();
    change_proof_settings();
    setWAPopupPos();

    setTimeout(function(){
      proof_text_color();
    },1000);
    run_checkbox_connect_api();
    checkbox_connect_api();
    save_connect();
    move_api_form("{{$pages->position_api}}");
    //proof_preview();
    //callMaintainPlus();
    mailchimp_label();
  });

  function move_api_form(tab)
  {
    /*when page load*/
    var move = $("#form_api_"+tab);
    $("#form_api_move").appendTo(move);

    /*when user choose option*/
    $("select[name='position_api']").change(function(){
      var value= $(this).val();
      $("#form_api_move").appendTo($("#form_api_"+value));
    });
  }


  function save_connect()
  {
    $("#save_connect").submit(function(e){
      e.preventDefault();
      var check_len = $(".connect_check:checked").length;
      var data = $(this).serializeArray();
      data.push(
        {'name': 'connect_activrespon','value':$("#connect_activrespon").attr('data')},
        {'name': 'connect_mailchimp','value':$("#connect_mailchimp").attr('data')},
        {'name': 'page_id','value':'{{ $pages->id }}'}
      );

      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: data,
        url: "{{ url('save-connect') }}",
        dataType: 'json',
        beforeSend: function()
        {
          $('#loader').show();
          $('.div-loading').addClass('background-load');
        }, 
        success: function(result) 
        {
          $('#loader').hide();
          $('.div-loading').removeClass('background-load');

          if(result.error == 1)
          {
            //activrespon
            (result.msg == 1) ? $(".err_connect").html('<div class="alert alert-danger">Invalid API-KEY Activrespon.</div>'):'';

            //mailchimp
            (result.msg == 2) ? $(".err_connect").html('<div class="alert alert-danger">Invalid API-KEY or server Mailchimp!</div>'):'';
          }
          else if(result.error == 2)
          {
            $(".error").show();
            $(".err_list_id").html(result.list_id);
            $(".err_server_mailchimp").html(result.server_mailchimp);
            $(".err_api_key").html(result.api_key);
            $(".err_audience_id").html(result.audience_id);
            $(".err_act_form_text").html(result.act_form_text);
            $(".err_act_form_bottom").html(result.act_form_bottom);
            $(".err_mc_form_text").html(result.mc_form_text);
            $(".err_mc_form_bottom").html(result.mc_form_bottom);
            $(".err_position_api").html(result.position_api);
          }
          else
          {
            $(".error").hide();
            $(".err_connect").html('<div class="alert alert-success">Form status telah diubah.</div>')
            if(check_len < 1)
            {
              $("#save_connect").hide();
            }
            $(".alert").delay(5000).fadeOut(3000);
          }
        },
        error : function(xhr){
          $('#loader').hide();
          $('.div-loading').removeClass('background-load');
          console.log(xhr.responseText);
        }
      });
      //end ajax
    });
  }

  function mailchimp_label()
  {
    $(".mailchimp_label").click(function(){
      var check = $("#connect_mailchimp").is(":checked");

      if(check == true)
      {
        $("#connect_mailchimp").prop('checked',false);
      }
      else
      {
        $("#connect_mailchimp").prop('checked',true);
      }
      checkbox_connect_api();
    });
  }

  function checkbox_connect_api(press)
  {
    var checked = 0;
    var position_api = "{!! $pages->position_api !!}";
    $(".connect_check").each(function(e){
      if($(this).is(':checked') == true)
      {
        checked++;
      }
    });

    if(checked > 0 || press == 1)
    {
      $("#save_connect").show();
    }
    else
    {
      $("#save_connect").hide();
    }

    if($("#connect_activrespon").is(":checked") == true)
    {
      $("#activrespon").show();
      $("#connect_preview_activrespon").show();
      $("#connect_activrespon").attr('data',1);
    }
    else
    {
      $("#connect_activrespon").attr('data',0);
      $("#connect_preview_activrespon").hide();
      $("#activrespon").hide();
    } 

    if($("#connect_mailchimp").is(":checked") == true)
    {
      $("#mailchimp, #connect_preview_mailchimp").show();
      $("#connect_mailchimp").attr('data',1);
    }
    else
    {
      $("#connect_mailchimp").attr('data',0);
      $("#mailchimp, #connect_preview_mailchimp").hide();
    }

    //pasang posisi value sesuai dari yang dipasang oleh user
    $("select[name='position_api'] option[value='"+position_api+"']").prop('selected',true);
  }

  function run_checkbox_connect_api()
  {
    /*preview for api title text*/
    $("input[name='act_form_text']").on('keypress keyup',function(){
      var text_ac = $(this).val();
      $("#act_text").html(text_ac);
    });
    $("input[name='mc_form_text']").on('keypress keyup',function(){
      var text_mc = $(this).val();
      $("#mc_text").html(text_mc);
    }); 

    $("input[name='act_form_bottom']").on('keypress keyup',function(){
      var text_ac_bt = $(this).val();
      $("#act_bottom_text").html(text_ac_bt);
    });
    $("input[name='mc_form_bottom']").on('keypress keyup',function(){
      var text_mc_bt = $(this).val();
      $("#mc_bottom_text").html(text_mc_bt);
    });

    /*run connect check when user click*/
    $(".connect_check").click(function(){
      checkbox_connect_api(1);
    });
  }

  // give default color to proof tetx when page loaded
  function proof_text_color(){
      var color = $('.description').css('Color');
      color = hexc(color);
      $("#proof_preview").attr('proof-text',hexToRgb(color));
  }

  // convert RGB to HEX color (ex : #0000)
  function hexc(colorval) {
    var parts = colorval.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    delete(parts[0]);
    for (var i = 1; i <= 3; ++i) {
      parts[i] = parseInt(parts[i]).toString(16);
      if (parts[i].length == 1) parts[i] = '0' + parts[i];
    }
    color = '#' + parts.join('');
    return color;
  }

  //TO MEASURE COLOR DEPTH TO DETERMINE TEXT WHITE OR BLACK
    function hexToRgb(hex) {
      // Expand shorthand form (e.g. "03F") to full form (e.g. "0033FF")
      var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
      hex = hex.replace(shorthandRegex, function(m, r, g, b) {
        return r + r + g + g + b + b;
      });

      var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);

      var r = parseInt(result[1], 16);
      var g = parseInt(result[2], 16);
      var b = parseInt(result[3], 16);
      var yiq = ((r*299)+(g*587)+(b*114))/1000;
     /* return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
      } : null;*/
      return (yiq >= 128) ? 'black' : 'white';
    }

   function setWAPopupPos() {
    var default_len = 113;
    var textlen = $(".wcs_text").text().length - 2;
    var diff_len = textlen * 3.6;
    var total_len = default_len - diff_len;
    $(".wcs_popup").css({'left':'-'+total_len+'px','width':'280px'});   
  }

  function proof_preview()
  {
    $.ajax({
      type: 'GET',
      url: "{{ url('load-proof') }}",
      data: { pageid : '{{ $pageid }}',preview : 1 },
      dataType: 'json',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        // $("#proof_preview").html(result);
      },
      error : function(xhr)
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
  }

  function reloadPage(page)
  {
    var url = window.location.href; 
    url = url.split("?");
    location.href= url[0]+"/?mod="+page;
  }

  function change_proof_settings()
  {
    $("body").on("click","input[name='proof_setting']",function(){
      $.ajax({
        type: 'GET',
        url: "{{ url('proof_settings') }}",
        data: { pageid : '{{ $pageid }}' },
        dataType: 'json',
        beforeSend: function()
        {
          $('#loader').show();
          $('.div-loading').addClass('background-load');
        },
        success: function(result) {
         
          if(result.res == 1)
          {
            /*$(".notice").html('<div class="alert alert-success">Proof setting telah di ubah</div>');*/
             reloadPage(2);
          }
          else
          {
            $('#loader').hide();
            $('.div-loading').removeClass('background-load');

            $(".notice").html('<div class="alert alert-danger">Server terlalu sibuk, silahkan coba lagi nanti.</div>');
            $(window).scrollTop($("#proof").offset().top);
          }
        },
        error : function(xhr)
        {
          $('#loader').hide();
          $('.div-loading').removeClass('background-load');
          console.log(xhr.responseText);
        }
      });
      //end ajax
    });
  }

  function createProof()
  {
     $("#saveproof").submit(function(e){
        e.preventDefault();

        var msg;
        var edit = $("#btn_proof").attr('status');
        var data = new FormData(this);
        data.append('page_id','{{ $pageid }}');

        if(edit == undefined)
        {
            data.append('status',0);
            msg = 'Data berhasil ditambahkan';
        }
        else
        {
            data.append('status',edit);
            msg = 'Data berhasil diubah';
        }

        $.ajax({
          type: 'POST',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          dataType: 'json',
          data: data,
          url: "{{ url('save-proof') }}",
          cache:false,
          contentType: false,
          processData: false,
          beforeSend: function()
          {
            $('#loader').show();
            $('.div-loading').addClass('background-load');
          }, 
          success: function(result) {
          
            if(result.error == 1)
            {
                $('#loader').hide();
                $('.div-loading').removeClass('background-load');

                $(".proof_name").html(result.proof_name);
                $(".proof_text").html(result.proof_text);
                $(".proof_stars").html(result.proof_stars);
                $(".proof_image").html(result.proof_image);

                return false;
            }

            if(result.data == 1) 
            {
                // load_proof();
                reloadPage(2);
               /* $(".btn-proof-reset").trigger('click');
                $(".notice").html('<div class="alert alert-success">'+msg+'</div>');*/

            }
            else
            {
                $('#loader').hide();
                $('.div-loading').removeClass('background-load');

                $(".notice").html('<div class="alert alert-danger">Server terlalu sibuk, silahkan coba lagi nanti.</div>');
            }
            $(".error").html('');
          },
          error : function(xhr){
            $('#loader').hide();
            $('.div-loading').removeClass('background-load');
            console.log(xhr.responseText);
          }
        });
        //end ajax
     });
  }

  function editProof()
  {
    $("body").on("click",".btn-editproof",function()
    {
      $("input[name='proof_name']").val($(this).attr('data-name'));
      $("textarea[name='proof_text']").val($(this).attr('data-text'));
      $(".proof_notes").html('<small>Biarkan tetap kosong apabila tidak ingin merubah image</small>');
      $("input[name='proof_stars']").val($(this).attr('data-star'));
      $("#btn_proof").attr('status',$(this).attr('dataedit'));
      $(window).scrollTop($("#proof").offset().top);
    });
  }

  function deleteProof()
  {
    $("body").on("click",".btn-delete-proof",function()
    {
      var id = $(this).attr('dataid');
      var warn = confirm('Apakah yakin mau menghapus?');

      if(warn == false)
      {
        return false;
      }
      else
      {
        $.ajax({
          type: 'GET',
          url: "{{ url('delete-proof') }}",
          data: { 'id' : id },
          dataType: 'json',
          beforeSend: function()
          {
            $('#loader').show();
            $('.div-loading').addClass('background-load');
          },
          success: function(result) {
            $('#loader').hide();
            $('.div-loading').removeClass('background-load');
            
            if(result.res == 1)
            {
              $(".notice").html('<div class="alert alert-success">Data berhasil di hapus</div>');
              load_proof();
            }
            else
            {
              $(".notice").html('<div class="alert alert-danger">Server terlalu sibuk, mohon dicoba lagi nanti</div>');
            }
          },
          error : function(xhr)
          {
            $('#loader').hide();
            $('.div-loading').removeClass('background-load');
            console.log(xhr.responseText);
          }
        });
      //end ajax
      }
    });
  }

  function resetProof()
  {
    $(".btn-proof-reset").click(function(){
      $("#btn_proof").removeAttr('status');
      $(".proof_notes").html('');
      $(".error").html('');
    }); 
  }

  function load_proof()
  {
    $.ajax({
      type: 'GET',
      url: "{{ url('load-proof') }}",
      data: { pageid : '{{ $pageid }}' },
      dataType: 'html',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        $("#loaded_proof").html(result);
      },
      error : function(xhr)
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
      }
    });
  }

  function createItalic()
  {
    $('#create_italic').click(function(){
        document.execCommand('italic', false, null);
    });
  }

  function create_bold()
  {
    var editable = $("[contenteditable]");

    $('#create_bold').click(function(){
        createBold();
    });
  }

  /*document.getElementById('create_bold').onclick = function(){
    document.execCommand('bold', false, null);
  };*/

  /*addEventListener('click', function(e) {
    document.execCommand('bold', false, null);
  });*/

  function createLinkDescription()
  {
    $('#make-bold').click(function(event){
        event.preventDefault();
        var url = $("#url").val();
        var reg = new RegExp(/^http\:\/\/|^https\:\/\//i);
        var check_http = reg.test(url);

        if(check_http == false)
        {
          alert("Kolom link harus menggunakkan http:// atau https://");
        }
        else if(url === '')
        {
          alert("Kolom link tidak boleh kosong");
        }
        else
        {
          createLink();
        }
        
    });
  }

  function adaptiveLink()
  {
    setTimeout(function(){
      load_embed();
    },300);
  }

  function pastePreview()
  {
    $("body").on("paste",".emb",function(e){
      var cl = $(this).attr('class');
      cl = cl.split(' ');
      var counter = cl[1].split('_');
      var id;

      if(counter[1] == "new")
      {
          id = counter[1]+"_"+counter[2];
      }
      else
      {
          id = counter[1];
      }

      var pastedData = e.originalEvent.clipboardData.getData('text');
      pastedData = pastedData.split("=");

      setTimeout(function(){
        $(".em_"+id).val(pastedData[1]);
      },100);
      
      $(".ifr-"+id).attr("src","https://www.youtube.com/embed/"+pastedData[1]+"?rel=0")
    })
  }

  function load_embed()
  {
     $(".link_option").each(function(i){
        var id = $(this).attr('id');
        var value = $(this).val();
        embed_link(value,id)
      });
  }

  function change_link()
  {
    $("body").on("change",".link_option",function(){
      var value = $(this).val();
      var id = $(this).attr('id');
      embed_link(value,id)
    });
  }

  function embed_link(value,id){
     if(value == 2)
      {
        $(".sel_"+id).hide();
        $(".lnp_"+id).hide();
        // $(".lnp_"+id).css({"visibility":"hidden"});
        $(".em_"+id).show();     
        var youtube_id = $(".em_"+id).val();    

        $(".embed-ln-"+id).html(
          '<span id="link-url-'+id+'-preview"  class="embed-'+id+'">'+
          '<div class="embed-responsive embed-responsive-16by9">'+
          '<iframe style="padding : 12px" class="embed-responsive-item ifr-'+id+'" src="https://www.youtube.com/embed/'+youtube_id+'?rel=0" allowfullscreen></iframe>'+
          '</div></span>'
        );
      }
      else
      {
        var title = $("#title-"+id+"-view-update").val();
        if(title === "" || title === undefined){
          title = "Masukkan Link"
        }

        $(".sel_"+id).show();
        $(".lnp_"+id).show();
        // $(".lnp_"+id).css({"visibility":"visible"});
        $(".em_"+id).hide();
         
        $(".embed-"+id).html(
        '<span id="link-url-update-'+id+'-get" class="embed-ln-'+id+'">'+
          '<a href="#" class="btn btn-md btnview title-'+id+'-view-update txthov" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;">'+title+'</a>'+
        '</span>'
        );
      }
  }

  //To display wa btn text if wa user hasn't registered yet
  function displayWaText()
  {
    var btn_wa_txt = $("input[name=wa_btn_text]").val();
    var btn_wa_header = $("textarea[name=wa_header]").val();
    $(".wcs_text").html(btn_wa_txt);
    $(".wcs_text_header").html(btn_wa_header);
  }

  //TO GIVE SYMBOL + IF USER DELETE IT ON PHONE NUMBER
  function maintainPlus()
  {
    var chatnumber = $("input[name=chat_member_number]").val();
    var check = chatnumber.substring(0,1);
    
    if(check !== '+')
    {
        var updated = chatnumber.replace(chatnumber,'+'+chatnumber);
        $("input[name=chat_member_number]").val(updated);
    }
  }

  function callMaintainPlus()
  {
      $("body").on("keyup","input[name=chat_member_number]",function(){
          maintainPlus();
      });
  }

   function getwachatbutton(){
    $.ajax({
      type : 'GET',
      url : '{{url("getwachatbutton")}}/{{$pages->id}}',
      dataType : 'html',
      success : function(result){
        $("#example").html(result);
      }
    });
  };

  // SET PREVIEW FOR WA HEADER
  function wa_preview_header_text()
  {
    $("textarea[name=wa_header]").on('keypress keyup',function(e){
      var text = $(this).val();
      var max = 500; 
      $(".wcs_text_header").html(text);
    
      if(text.length >= max)
      {
          e.preventDefault();
          alert('Maksimal teks header WA adalah 500 karakter');
          text.substring(0,max);
      }
      else
      {
         fix_center();
      }
    });
  }

  function getSelected()
  {
    $("textarea[name=wa_header]").select(function(e) {
        var str;
        var val = $(this).val();
        var start = e.target.selectionStart;
        var end = e.target.selectionEnd;
        var getall = this.value.substring(0, val.length);
        var sel = this.value.substring(start, end);

        //BOLD
        $(".textbold").click(function(){
          str = getall.replace(sel,'<b>'+sel+'</b>');
          $("textarea[name=wa_header]").val(str);
        });
        
        //ITALIC
        $(".textitalic").click(function(){
          str = getall.replace(sel,'<b>'+sel+'</b>');
          $("textarea[name=wa_header]").val(str);
        });


    });
  }

  //MAKE WA BUTTON ALWAYS ON CENTER
  function fix_center(){
    var screenwidth = $(".screen").width();
    var containerWidth = $(".wcs_button").outerWidth();
    var leftMargin = (screenwidth-containerWidth)/2;  
    $("#example").css("marginLeft", leftMargin);  
  }

   function wachatloadPixel(){
    $.ajax({
      type: 'GET',
      url: "{{route('wachatpixel')}}",
      data: { pageid : '{{$pages->id}}' },
      dataType: 'html',
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        $("#wapixelchat").html(result);
      }
    });
  }
</script>

<script type="text/javascript">
  var elhtml;
  let idpic=6;
  let counterBanner=0;
  var changed = 0;

  $(function(){
    $('body').on('click','#btn-save-wa-chat',function(){
      wachatSettings();
    })
    open_chat_member_registration();
    open_edit_member();
    save_chat_member();
    load_chat_member();
    delete_chat_member();
    chat_preview_enable();
    chat_buzz_enable();
    descPlaceholder();
    upload_image_icon();
    change_pixel();
    fb_pixel_detector();
    fb_custom_event();
    fb_custom_event_sel();
  });

  /* FB custom event */
  function fb_custom_event_sel()
  {
    $("select[name='fb_event']").change(() => {
      fb_custom_event();
    });
  }

  function fb_custom_event()
  {
    var fb_event = $("select[name='fb_event'] > option:selected").val();
    if(fb_event == 'CustomEvent')
    {
      $("input[name='fb_custom_event']").prop('disabled',false);
      $("input[name='fb_custom_event']").show();
    }
    else
    {
      $("input[name='fb_custom_event']").prop('disabled',true);
      $("input[name='fb_custom_event']").hide();
    }
  }

  /*CHANGE PIXEL OPTIONS*/
  function change_pixel()
  {
    $("#jenis_pixel").change(function(){
      fb_pixel_detector();
      fb_custom_event();
    });
  }

  /*TO DETECT IF PIXEL DROPDOWN SELECTED ON FBPIXEL*/
  function fb_pixel_detector(sel)
  {
    var sel = $("select[name='jenis_pixel'] > option:selected").val();
    if(sel == 'fb')
    {
      $(".fb-pixel-option").show();
      $("#script").val('').hide();
      $(".fb-pixel-option > .form-group > input, .fb-pixel-option > .form-group > select").prop('disabled',false);
    }
    else
    {
      $(".fb-pixel-option").hide();
      $("#script").show();
      $(".fb-pixel-option > .form-group > input, .fb-pixel-option > .form-group > select").prop('disabled',true);
      $("select[name='fb_event'] > option[value='AddPaymentInfo']").prop('selected',true);
    }
  }

  /*PLACE HOLDER DESCRIPTION*/
  function descPlaceholder()
  {
    $("#description").focusout(function(){
        var element = $(this);        
        if (!element.text().replace(" ", "").length) {
            element.empty();
        }
    });
  }
 
 function load_chat_member(){
    var uid = $("input[name=uuid]").val();
    var data = '';

    $.ajax({
       type: 'GET',
       url : "{{route('getwachat')}}",
       dataType: 'json',
       data : {'uid' : uid},
       success: function(result) {

          for(i=0;i<result.length;i++)
          {
              data +=  '<div class="card card-none mb-4">';
              data +=  '<div class="card-header card-gray">';
              data +=  '<span class="view-wa">'+result[i].name+'</span>';
              data +=  '<button type="button" class="del_chat_member btn btn-sm btn-danger float-right" id="'+result[i].id+'">';
              data +=  '<i class="fas fa-trash-alt"></i>';
              data +=  '</button>';
              data +=  '<button type="button" class="edit_wa_member btn btn-sm btn-primary float-right mr-2" data-edit="true" data-nm = "'+result[i].name+'" data-pos="'+result[i].position+'" data-num="'+result[i].wa_number+'" data-text="'+result[i].wa_text+'" class="edit_wa_member" id="'+result[i].id+'" data-img="'+result[i].photo+'"">';

              data +=  '<i class="fas fa-pencil-alt"></i>';
              data +=  '</button>';
              data +=  '<div class="clearfix"></div>';
              data +=  '</div>';  //end class card-header
              data +=  '</div>'; //end class card-none
          } 
          $("#wa_chat_member_data").html(data);
       }
    });
 }

 //SAVE ALL DATA FROM TAB 5
  function wachatSettings() {
    var getdata = document.getElementById('savewa');
    var data = new FormData(getdata);

    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'json',
      data: data,
      url: "{{route('savewachat')}}",
      cache:false,
      contentType: false,
      processData: false,
      beforeSend: function()
      {
        $('#loader').show();
        $('.div-loading').addClass('background-load');
      }, 
      statusCode: {
        419: function() { 
          window.location.href = "<?php echo url('/login');?>"; //or what ever is your login URI 
        }
      },
      success: function(result) {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        $(window).scrollTop(0);
        $("#pesanAlert").html(result.message);
        $("#pesanAlert").show();
        if (result.status == "success") {
          $("#pesanAlert").addClass("alert-success");
          $("#pesanAlert").removeClass("alert-danger");
        
          load_chat_member();
          changed = 0;
          changelink = 0;
          changechat = 0;
          changepixel = 0;
          changeproof = 0;
          refreshwa();
          loadLinkBio();
          refreshpixel();
          return true;
        } 
        else 
        {
           $("#pesanAlert").addClass("alert-danger");
           $("#pesanAlert").removeClass("alert-success");
           return false;
        }
      },
      error: function(xhr){
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
      }
    });
  }

  // TO DISPLAY CHAT PREVIEW 
  function chat_preview_enable()
  {
    var check = $("input[name=enable_chat]").prop("checked");
    if(check == true)
    {
        $("#example").show();
    }
    else
    {
        $("#example").hide();
    }

    $("body").on("click","input[name=enable_chat]",function(){
      if($(this).prop("checked") == true){
        $("#example").show();
        fix_center();
      }else{
        $("#example").hide();
      }
    });
  }

  function chat_buzz_enable()
  {
    var check = $("input[name=buzz_btn]").prop("checked");
    if(check == true)
    {
        $("#example").addClass('service');
        $(".wcs_button").addClass('animate-buzz');
    }
    else
    {
        $("#example").removeClass('service');
        $(".wcs_button").removeClass('animate-buzz');
    }

    $("body").on("click","input[name=buzz_btn]",function(){
        fix_center();
        if($(this).prop("checked") == true){
          $("#example").addClass('service');
          $(".wcs_button").addClass('animate-buzz');
        }else{
          $("#example").removeClass('service');
          $(".wcs_button").removeClass('animate-buzz');
        }
    });
  }

  function open_chat_member_registration()
  {
    $("body").on("click",".chat_register",function(){
      var len = $(".chat-list").length;
      if(len == 5)
      {
        $("#wa-chat-max").modal();
      }
      else 
      {
        var uuid = $("input[name=uuid]").val();
        var pageid = $("input[name=pageid]").val();

        $("#chat_member :input").val('');
        $('.btn-status').html('Add User');
        $(".editrue").html('');
        $("input[name=uuid]").val(uuid);
        $("input[name=pageid]").val(pageid);
        $(".file_name").html('');
        $("#wa_chat_member").modal();
      }
      
    });
  }

  function open_edit_member()
  {
    $("body").on("click",".edit_wa_member",function(){
      var wa_id = $(this).attr('id');
      var uuid = $("input[name=uuid]").val();
      var pageid = $("input[name=pageid]").val();
      var filename = $(this).attr('data-img');

      $('.btn-status').html('Save');
      $("input[name=chat_member_name]").val($(this).attr('data-nm'));
      $("input[name=chat_member_position]").val($(this).attr('data-pos'));
      $("input[name=chat_member_number]").val($(this).attr('data-num'));
      $("input[name=chat_member_text]").val($(this).attr('data-text'));
      $("input[name=uuid]").val(uuid);
      $("input[name=pageid]").val(pageid);
      $(".file_name").html('<br/><label>File saat ini: <img src="'+filename+'"/></label>');

      $(".editrue").html('<input type="hidden" name="wa_id" readonly="readonly" value="'+wa_id+'">');

      $("#wa_chat_member").modal();
    });
  }

  //SAVE WA MEMBER
  function save_chat_member()
  {
    $("#chat_member").submit(function(e){
      e.preventDefault();
      var formData = new FormData(this);

      $.ajax({ 
        type: 'POST',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        cache:false,
        contentType: false,
        processData: false,
        data: formData,
        url: "{{route('savewachatmember')}}",
        dataType: 'json',
        beforeSend: function()
        {
          $('#loader').show();
          $('.div-loading').addClass('background-load');
        },
        success: function(result) {
          if (result.status == "success") {
            $("#pesanAlert").html(result.message);
            $("#pesanAlert").show();

            $("#pesanAlert").addClass("alert-success");
            $("#pesanAlert").removeClass("alert-danger");
            $(window).scrollTop(0);

            $("#wa_chat_member").modal('toggle');
            $(".chat_error").removeClass("alert alert-danger");
            $(".chat_error").html('');
            //$("#chat_member :input").val('');

            if(result.edit == 1)
            {
              $('#loader').hide();
              $('.div-loading').removeClass('background-load');

              changed = 0;
              changelink = 0;
              changechat = 0;
              changepixel = 0;
              changeproof = 0;
              refreshwa();
              loadLinkBio();
              refreshpixel();
              //load_chat_member();
            } else {
              /*var url = window.location.href; 
              location.href= url+"/?mod=1";*/
              reloadPage(1);
            }
            
          } 
          else 
          {
             $('#loader').hide();
             $('.div-loading').removeClass('background-load');

             $(".chat_error").addClass("alert alert-danger");
             $(".chat_error").html(result.message);
             return false;
          }
        }
      })//ajax closing

    });
  }

  function delete_chat_member()
  {
      $("body").on("click",".del_chat_member",function(){
        var id = $(this).attr('id');
        var len = $(".chat-list").length;
        var conf = confirm('Apakah yakin mau menghapus?');

        if(conf == true)
        {
           $.ajax({
            type: 'GET',
            data: {'id' : id},
            url: "{{route('delwachatmember')}}",
            dataType: 'json',
            beforeSend: function()
            {
              $('#loader').show();
              $('.div-loading').addClass('background-load');
            },
            success : function(result) {
               $(window).scrollTop(0);
               $("#pesanAlert").html(result.message);
               $("#pesanAlert").show();

               if(result.status == "success") {
                  $("#pesanAlert").addClass("alert-success");
                  $("#pesanAlert").removeClass("alert-danger");

                  //to determine whether wa chat link tab or not
                  /*var url = window.location.href; 
                  location.href= url+"/?mod=1";*/
                  reloadPage(1);
                  
                } else {
                  $("#pesanAlert").addClass("alert-danger");
                  $("#pesanAlert").removeClass("alert-success");
                  return false;
                }
            }
          });
          //
        }
        else
        {
          return false;
        }

      });
  }

   //ALERT WHEN USER FORGOT TO SAVE
   $( ":input" ).change(function() {
      changed = $(this).closest('#saveTemplate').data('changed', true);
      changelink = $(this).closest('#savelink').data('changed', true);
      changepixel = $(this).closest('#savepixel').data('changed', true);
      changeproof = $(this).closest('#saveproof').data('changed', true);
      changechat = $(this).closest('#savewa').data('changed', true);
    });

   $("#addlink, #tambah, #sm, .cell-btn, #addBanner").click(function()
   {
        changed = 1;
   });

   $(".bannerpixel, .banner-title, .banner-link").on("change",function(){
        changed = 1;
   });

   $("body").on("click",".btn-editpixel",function(){
      changepixel = 1;
   });

  $("body").on("click",".link",function()
  {
     if(changed > 0 ||changed.length > 0 || changelink.length > 0 || changelink > 0 ||  changepixel.length > 0 || changepixel > 0 ||changeproof.length > 0 || changeproof >0 || changechat.length > 0 || changechat > 0)
     {
        $("#unsave").modal();
        return false;
     }
  });

  //..
  
  //.. TO DETERMINE PREVIEW AND MOVE PREVIEW ELEMENT
  $('body').on('click', '.btn-preview', function() {
    //$('.preview-mobile').html($('.mobile1').html());
    var checkclass = $('.preview-mobile').hasClass('preview-none');

    if(checkclass == true)
    {
        $('.preview-mobile').prepend($('.screen'));
        $('.preview-mobile').toggleClass('preview-none');
    }
    else
    {
        $('.preview-mobile').toggleClass('preview-none');
        $('.mobile1').prepend($('.screen'));

    }
    fix_center();
    resize();
  });


  $('body').on('click', '.themes', function() {
    $('.themes').removeClass('selected');
    $(this).addClass('selected');
    changed = 1;
  });  

  //TO FORCE USER TO SAVE IF USER HAD MAKE CHANGE
  $('body').on('change', '.focuslink-update,.linkpixel', function() {
  // $(".focuslink-update,.linkpixel").on("change",function()
      changed = 1;
  });    

  $('body').on('click', '.cell-btn', function() {
  // $(".cell-btn").on("click",function()
      changed = 1;
  }); 
 
  $('body').on('click', '.wallpapers', function() {
    $('.wallpapers').removeClass('selected');
    res = $("#phonecolor").attr("class").substr(7);
    res = res.replace("animation-", "");
    //cek ada ngga di json
    $.each( templates, function( key, value ) {
      if (res == value.theme) {
        template = value;

        $('#is_text_color').prop('checked', false);
        $('#is_bio_color').prop('checked', false);
        $('.outlined').prop('checked', false);

        /*$("#colorOutlineButton").val(template.button_color);
        $('#textColor').val(template.font_button_color);
        $("#bioColor").val(template.bio_font_color);*/

        $('.btnview').css("border-color",template.button_color);
        $('.btnview').css("background-color",template.button_color);
        $('.btnview').css("color",template.font_button_color);
        $('.description').css("color",template.bio_font_color);
       /* $('.proof-wrapper-preview').css("background-color",template.button_color);*/
        $('#sm-preview li a').css("color",template.bio_font_color+" !important");
        $('.powered-omnilinks a').css("color",template.bio_font_color+" !important");
        
        check_outlined();
        check_rounded();
      }
    });
    changed = 1;
    $(this).addClass('selected');
  });  

  $('body').on('click', 'ul.nav-tabs', function() {
    if(!$('#pesanAlert').hasClass('alert-success')){
      $('#pesanAlert').hide();
    }
  });

  $( "body" ).on( "click", ".btn-copy", function(e) 
  {
    e.preventDefault();
    e.stopPropagation();

    //var id = $(this).attr("data-id");
    var link = $(this).attr("data-link");

    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = link;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);

    /*$(".link-"+id).select();
    document.execCommand("copy");*/
    $('#copy-link').modal('show');
  });

  $(document).ready(function() {
      <?php 
      $dt1 = Carbon::createFromFormat('Y-m-d H:i:s', $user->valid_until);
      $dt2 = Carbon::now();
      if ( ($user->membership=='free') && ($dt2->gt($dt1)) ) {
      ?>
      $('#modal-freetrial-expired').modal({
        backdrop: 'static',
        keyboard: false
      });
      <?php } ?>
      
      loadLinkBio();
      dotsok();
      let inputtitle=$('#pagetitle');
      let outputtitle=$('#outputtitle');
      
      //first character cannot be 0
      // $("#nomorwa").rules("add", { regex: "^[^0]$" });
      $('#nomorwa,#input-msg-wa').keypress(function(e){
        if (this.value.length == 0 && e.which == 48 ){
          return false;
        }
      });
      $('#nomorwa,#input-msg-wa').on('input propertychange paste', function (e) {
          var reg = /^0+/gi;
          if (this.value.match(reg)) {
              this.value = this.value.replace(reg, '');
          }
      });
      $('body').on('keyup', '#nomorwa,#input-msg-wa', function() {
          newval = $(this).val().replace(/[^0-9.]/g, "");
          $(this).val(newval);
      });

      $('#reload-cancel').click(function(e){
        e.preventDefault();
        location.reload();
      });

      $(window).scroll(function() {
        wS = $(this).scrollTop();
        wH = $(window).height();
        if (wH<825){
          if (wS<=40){
            // $(".fixed").css("top","415px");
            $( ".fixed" ).animate({
              top: 415
            }, 5, function() {
              // Animation complete.
              $(".fixed").css("top","415px");
            });
          }
          else {
            // $(".fixed").css("top","50%");
            $( ".fixed" ).animate({
              top: '50%'
            }, 50, function() {
              // Animation complete.
              $(".fixed").css("top","50%");
            });          
          }
        }
      });

      $(window).scrollTop(1);

      $(".navbar").css("z-index", "1");
      $(".navbar").css("position", "static");
      $(".dropdown-item").css("z-index", "41");

      inputtitle.keyup(function(){
        outputtitle.text(inputtitle.val());
      });
      outputtitle.text(inputtitle.val());
          
     /* $('#description').keydown(function(e){
        newLines = $(this).val().split("\n").length;
        console.log(e.keyCode);
        if(e.keyCode == 13 && newLines >= 3) {
          return false;
        }
        else {
          tempStr = $(this).val().replace(/\n/g, "<br>");;
          $('#outputdescription').html(tempStr);
        }
      });*/

      /* RENOV */

      tempStr = $('#description').html();
      $('#outputdescription').html(tempStr);

      $(document).on("input", "#description", function(e) {
        $(this).find("span").contents().unwrap();
      });

      $('#description').keypress(function(e)
      {
        var desctext = $("#description").text().length;
        $(this).find("div").removeAttr('style');
        // $(this).find("remove").replaceWith("<br>");

        if(desctext >= 104)
        {
            return false;
        }

        if(e.keyCode == 13){
          newLines = $(this).find("div").length;
        }

        if(e.keyCode == 13 && newLines >= 3) {
          return false;
        }
        else {
          tempStr = $('#description').html();
          $('#outputdescription').html(tempStr);
        }
      });

      $('#description').keyup(function(e){
        tempStr = $(this).html();
        $('#outputdescription').html(tempStr);
      });
      // tempStr = $('#description').val().replace(/\n/g, "<br>");
      

      $("#create_bold, #create_italic, #make-bold").click(function(){
         tempStr = $('#description').html();
         $('#outputdescription').html(tempStr);
      });

    //CHANGE TEXT ON PREVIEW LINK
    
    //NEW LINK
    $(document).on('keyup keypress','.focuslink',function(){
      var number_id = $(this).attr('data-id');
      var value = $(this).val();
      var len = value.length;

      var prevtext = $("#textprev-new-"+number_id)[0];
      prevtext.lastChild.nodeValue=value;
      
      if(len >= 16)
      {
        return false;
      }

      if (len <= 0) {
        prevtext.lastChild.nodeValue='Masukkan Link';
      }
    });

    //UPDATE LINK
    $(document).on('keyup keypress',".focuslink-update",function()
    {
      var number_id = $(this).attr('data-id');
      var value = $(this).val();
      var len = value.length;

      var prevtext = $("#textprev-update-"+number_id)[0];
      prevtext.lastChild.nodeValue=value;
      
      if(len >= 16)
      {
        return false;
      }

      if (len <= 0) {
        prevtext.lastChild.nodeValue='Masukkan Link';
      }

    });


   /* OLD CODE 
     $(document).on('focus','.focuslink',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink+'-get');
      $(document).on('keyup',inputlinkview,function(){
         outputviewlink.text(inputlinkview.val());
         if (inputlinkview.val()=='') {
          outputviewlink.text('Masukkan Link');
         }
      });
    });

    $(document).on('focus','.focuslink-update',function(){
      let inputlinkview=$(this);
      let getoutputviewlink=inputlinkview.attr('id');
      let outputviewlink=$('.'+getoutputviewlink);

      $(document).on('keyup',inputlinkview,function(){
        outputviewlink.text(inputlinkview.val());
        if (inputlinkview.val()=='') {
          outputviewlink.text('Masukkan Link');
        }
      }); 
    });*/

    $('.outlined').click(function() {
      check_outlined();
    });
    <?php if($pages->is_rounded) {?>
      //$(".mobile1").addClass("roundedview");
      $(".screen").addClass("roundedview");
    <?php } ?>

    $('.rounded').click(function() {
      check_rounded();
    });
    <?php if ($user->membership<>'free') { ?>  
      $('#powered').click(function() {
        check_powered();
      });
    <?php } ?>
    $('#is_click_bait').click(function() {
      check_click_bait();
    });
    $('#is_text_color').click(function() {
      check_text_color();
      onTextColorChange($("#textColor").val());
    });
    $('#is_bio_color').click(function() {
      check_bio_color();
      onBioColorChange($("#bioColor").val());
    });
    /*$("#powered").click(function(){
      if ($(this).prop("checked")==true) {
        $("#poweredview").children().show();
      }
      else if($(this).prop("checked")==false){
        $("#poweredview").children().hide(); 
      }
    });*/
    $(document).on('click', '#gradient', function() {
      <!--<?php if ($user->membership<>'free') { ?>-->
      $('#modeBackground').val('gradient');
      // $('#backtheme').val('colorgradient1');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen "+$('#backtheme').val());
      check_outlined();
      check_rounded();
      <!--<?php } ?>-->
      <!--<?php if ($user->membership=='free') { ?>-->
      // $("#premium-id-beli-2").modal();
      <!--<?php } ?>-->
    });
    $(document).on('click', '#solid', function() {
      $('#is_text_color').prop('checked', false);
      $('#is_bio_color').prop('checked', false);
      $('.outlined').prop('checked', false);

      $('#modeBackground').val('solid');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",$("#color").val());
      // $("#backtheme").val();
      check_outlined();
      check_rounded();
    });
    $(document).on('click', '#wallpaper-tab', function() {
      <!--<?php if ($user->membership<>'free') { ?>-->
        $("#textColor").val("#000");
        $("#bioColor").val("#000");
        $('#modeBackground').val('wallpaper');
        $("#phonecolor").removeClass();
        $("#phonecolor").addClass("screen "+$('#wallpaperclass').val());
        check_outlined();
        check_rounded();
      <!--<?php } ?>-->
      <!--<?php if ($user->membership=='free') { ?>-->
      // $("#premium-id-beli-2").modal();
      <!--<?php } ?>-->
    });
    $(document).on('click', '#animation-tab', function() {
      <?php if ( ($user->membership=='elite') || ($user->membership=='super') ) { ?>
        $("#textColor").val("#000");
        $("#bioColor").val("#000");
        $('#modeBackground').val('animation');
        $("#phonecolor").removeClass();
        $("#phonecolor").addClass("screen "+$('#animationclass').val());
        check_outlined();
        check_rounded();
      <?php } ?>
      <?php if ($user->membership=='free') { ?>
      $("#premium-id-beli-2").modal();
      <?php } ?>
    });
    $(document).on('click', '.btn-premiumid', function() {
      tambah_premiumid();
    });
    $(document).on('click', '.btn-premium', function() 
    {
      <?php if(Auth::user()->membership=='free') { ?>
        $('#premium-id-beli').modal('show');
      <?php } else { ?>
        $('#premium-id').modal('show');
      <?php } ?>
    });
    <?php if (!is_null($pages->color_picker)) { ?>
      color_picker = "<?php echo $pages->color_picker; ?>";
      $('#color').val(color_picker);
      // $("#solid").click();

      $('#modeBackground').val('solid');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",$("#color").val());
      check_outlined();
      check_rounded();

    <?php } ?>
    <?php if (!is_null($pages->template)) { ?>
      $('#backtheme').val("<?php echo $pages->template; ?>");
      $("#gradient").click();
    <?php } ?>
    <?php if (!is_null($pages->wallpaper)) { ?>
      $('#wallpaperclass').val("<?php echo $pages->wallpaper; ?>");
      $("#wallpaper-tab").click();
      // $(".thumb-"+template.theme).click();
        $('.btnview').css("border-color",template.button_color);
        $('.btnview').css("background-color",template.button_color);
        $('.btnview').css("color",template.font_button_color);
        $('.description').css("color",template.bio_font_color);
        // $('.proof-wrapper-preview').css("background-color",template.bio_font_color);
        $('#sm-preview li a').css("color",template.bio_font_color+" !important");
        $('.powered-omnilinks a').css("color",template.bio_font_color+" !important");
        check_outlined();
        check_rounded();
      
    <?php } ?>
    <?php if (!is_null($pages->gif_template)) { ?>
      $('#animationclass').val("<?php echo $pages->gif_template; ?>");
      $("#animation-tab").click();
      // $(".thumb-"+template.theme).click();
        $('.btnview').css("border-color",template.button_color);
        $('.btnview').css("background-color",template.button_color);
        $('.btnview').css("color",template.font_button_color);
        $('.description').css("color",template.bio_font_color);
        // $('.proof-wrapper-preview').css("background-color",template.bio_font_color);
        $('#sm-preview li a').css("color",template.bio_font_color+" !important");
        $('.powered-omnilinks a').css("color",template.bio_font_color+" !important");
        check_outlined();
        check_rounded();
    <?php } ?>

    //for bacground, outline color 
    <?php if (!is_null($pages->rounded)) { ?>
      $('#colorButton').val("<?php echo $pages->rounded; ?>");
      // $('.btnview').css("background-color","<?php echo $pages->rounded; ?>");
    <?php } ?>
    <?php if (!is_null($pages->outline)) { ?>
      outline = "<?php echo $pages->outline; ?>";
      $('#colorOutlineButton').val(outline);
      $('.btnview').css("border-color",outline);
    <?php } ?>

    <?php if($pages->is_outlined) {?>
      //$(".mobile1").addClass("outlinedview");
      $(".screen").addClass("outlinedview");
      $('.btnview').css("background-color","transparent");
      $('.btnview').css("color",outline);
      $('.description').css("color",outline);
      // $('.proof-wrapper-preview').css("background-color",outline);
      $('#sm-preview li a').css("color",outline+" !important");
    <?php } else {?>
      $('.btnview').css("background-color",outline);
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
      // $('.proof-wrapper-preview').css("background-color","#fff");
      $('#sm-preview li a').css("color","#fff !important");
    <?php } ?>
    
    <?php if($pages->is_text_color) {?>
      //$(".mobile1").addClass("outlinedview");
      $("#textColor").val("<?php echo $pages->text_color; ?>");
      $('.btnview').css("color","<?php echo $pages->text_color; ?>");
      $('.description').css("color","<?php echo $pages->text_color; ?>");
      // $('.proof-wrapper-preview').css("background-color","<?php echo $pages->text_color; ?>");
      $('#sm-preview li a').css("color","<?php echo $pages->text_color; ?>");
    <?php } else {?>
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
      // $('.proof-wrapper-preview').css("background-color","#fff");
      $('#sm-preview li a').css("color","#fff");
    <?php } ?>
    
    <?php if($pages->is_bio_color) {?>
      //$(".mobile1").addClass("outlinedview");
      $("#bioColor").val("<?php echo $pages->bio_color; ?>");
      $('.powered-omnilinks a').css("color","<?php echo $pages->bio_color; ?>");
      $('.description').css("color","<?php echo $pages->bio_color; ?>");
      $('.proof-wrapper-preview').css({"background-color":"<?php echo $pages->bio_color; ?>",color: '{{$proof_text_color}}' });
      $('#sm-preview li a').css("color","<?php echo $pages->bio_color; ?>");
    <?php } else {?>
      $('.powered-omnilinks a').css("color","#fff");
      $('.description').css("color","#fff");
      $('.proof-wrapper-preview').css({"background-color":"#fff",color:'{{$proof_text_color}}'});
      $('#sm-preview li a').css("color","#fff");
    <?php } ?>
    
    loadPixelPage();
    refreshpixel();
    refreshwa();

    $('.infooter').remove();

    $(".sortable-msg").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        
        if (start_pos<index) {
          // tempNameClass1=$("#getview li:eq("+start_pos+")").attr("class");
          // tempNameClass2=$("#getview li:eq("+index+")").attr("class");
          // $("#getview li:eq("+start_pos+")").attr("class",tempNameClass2);
          // $("#getview li:eq("+index+")").attr("class",tempNameClass1);
          $("#getview li:eq("+start_pos+")").insertAfter($("#getview li:eq("+index+")"));
        }
        else {
          // tempNameClass1=$("#getview li:eq("+start_pos+")").attr("class");
          // tempNameClass2=$("#getview li:eq("+index+")").attr("class");
          // $("#getview li:eq("+start_pos+")").attr("class",tempNameClass2);
          // $("#getview li:eq("+index+")").attr("class",tempNameClass1);
          $("#getview li:eq("+start_pos+")").insertBefore($("#getview li:eq("+index+")"));
        }
        renameColMessage();
      }
    });
    $(".sortable-msg").disableSelection();
    //$( ".sortable-msg" ).draggable();

    $(".sortable-link").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      /* for example 
      stop: function(event, ui) {
        var data = $(this).sortable('serialize');
        //save_order(data);
      }*/
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
          changed = 1;
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        changed = 1;

        // console.log(start_pos);
        // console.log(index);
        if (start_pos<index) {
          $("#viewLink li:eq("+start_pos+")").insertAfter($("#viewLink li:eq("+index+")"));
        }
        else {
          $("#viewLink li:eq("+start_pos+")").insertBefore($("#viewLink li:eq("+index+")"));
        }
      }
    });
    $(".sortable-link").disableSelection();
    // $( ".sortable-link" ).draggable();

    $(".sortable-sosmed").sortable({
      handle: '.handle',
      cursor: 'move',
      axis: 'y',
      start: function(e, ui) {
          // creates a temporary attribute on the element with the old index
          $(this).attr('data-previndex', ui.item.index());
      },
      update: function(event, ui) {
        var index =  ui.item.index();
        var start_pos = $(this).attr('data-previndex');
        
        if (start_pos<index) {
          $("#sm-preview li:eq("+start_pos+")").insertAfter($("#sm-preview li:eq("+index+")"));
        }
        else {
          $("#sm-preview li:eq("+start_pos+")").insertBefore($("#sm-preview li:eq("+index+")"));
        }
      }
    });
    $(".sortable-sosmed").disableSelection();

    //picker for background device color purpose
    function onColorChange(color) {
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen");
      $("#phonecolor").css("background-color",color);
      $("#backtheme").val();
      $("#color").val(color);
       changed = 1;
    }
    $('#colorpicker').farbtastic('#color');
    pickerbg = $.farbtastic('#colorpicker');
    // picker.setColor("#b6b6ff");
    $("#color").on('keyup', function() {
      pickerbg.setColor($(this).val());
    });
    pickerbg.linkTo(onColorChange);
    
    //for background color button purpose 
    function onColorButtonChange(color) {
      /*$("#colorButton").val(color);
      $('.btnview').css("background-color",color);*/
       changed = 1;
      $("#colorButton").val(color);
      if ($('input[name="outlined"]').val()=="1") {
        $('.btnview').css("background-color",'transparent');
      } else {
        $('.btnview').css("background-color",color);
      }
    }
    $('#colorpickerButton').farbtastic('#colorButton');
    pickerbtn = $.farbtastic('#colorpickerButton');
    // picker.setColor("#b6b6ff");
    $("#colorButton").on('keyup', function() {
      pickerbtn.setColor($(this).val());
    });
    // pickerbtn.linkTo(onColorButtonChange);
    $("#link-custom-background-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-button').modal('toggle');
    });
    $(document).on('click', '.btn-apply-btn', function() {
      onColorButtonChange($("#colorButton").val());
    });
    
    //modal-color-picker-outline-button colorpickerOutlineButton colorOutlineButton
    //for button purpose colorpickerButton colorButton
    function onOutlineColorButtonChange(color) {
      $("#colorOutlineButton").val(color);
      // $('.btnview').css("border-color",color);
      if ($('input[name="outlined"]').val()=="1") {
        //$(".mobile1").addClass("outlinedview");
        $(".screen").addClass("outlinedview");
        //$('.btnview').css("background-color","transparent");
        //$('.btnview').css("color",color);
        if ($('#is_text_color').prop("checked") == false) {
          $('.btnview').css("border-color",color);
        } else {
          $('.btnview').css("border-color",$('#textColor').val());
        }
        changed = 1;
      } else {
        //$('.btnview').css("background-color",color);
        //$('.btnview').css("color","#fff");
        $('.btnview').css("border-color","transparent");
      }
      $('.btnview').css("color",color);
      $('.description').css("color",color);
      $('.proof-wrapper-preview').css("background-color",color);
      $('#sm-preview li a').css("color",color);
    }
    $('#colorpickerOutlineButton').farbtastic('#colorOutlineButton');
    pickerout = $.farbtastic('#colorpickerOutlineButton');
    // picker.setColor("#b6b6ff");
    $("#colorOutlineButton").on('keyup', function() {
      pickerout.setColor($(this).val());
    });
    //pickerout.linkTo(onOutlineColorButtonChange);
    $("#link-custom-outline-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-outline-button').modal('toggle');
    });
    $(document).on('click', '.btn-apply-out', function() {
      onOutlineColorButtonChange($("#colorOutlineButton").val());
    });
    
    // for all text color purpose
    function onTextColorChange(color) {
      changed = 1;
      $("#textColor").val(color);
      if ($('#is_text_color').val()=="1") {
        $('.btnview').css("color",color);
      } else {
        if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
          $('.btnview').css("color","#fff");
        }
      }
    }
    $('#colorpickerTextColor').farbtastic('#textColor');
    pickerbtn = $.farbtastic('#colorpickerTextColor');
    // picker.setColor("#b6b6ff");
    $("#textColor").on('keyup', function() {
      pickerbtn.setColor($(this).val());
    });
    //pickerbtn.linkTo(onTextColorChange);
    $("#link-text-color").on('click', function(e) {
      e.preventDefault();
      $('#modal-color-picker-text-color').modal('toggle');
    });
    $(document).on('click', '.btn-apply-text', function() {
      template.font_button_color = $("#textColor").val();
      onTextColorChange($("#textColor").val());
    });

    // for all bio color purpose
    function onBioColorChange(color) {
      changed = 1;
      $("#bioColor").val(color);
      if ($('#is_bio_color').val()=="1") {
        $('.powered-omnilinks a').css("color",color);
        $('.description').css("color",color);
        $('.proof-wrapper-preview').css("background-color",color);
        $('.proof-wrapper-preview').css("color",hexToRgb(color));
        $("#proof_preview").attr('proof-text',hexToRgb(color));
        $('#sm-preview li a').css("color",color);
      } else {
        if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
          $('.powered-omnilinks a').css("color","#fff");
          $('.description').css("color","#fff");
          $('.proof-wrapper-preview').css("background-color","#fff");
          $('.proof-wrapper-preview').css("color","#000");
          $("#proof_preview").attr('proof-text','black');
          $('#sm-preview li a').css("color","#fff");
        }
      }
    }

    $('#colorpickerBioColor').farbtastic('#bioColor');
    pickerbtn = $.farbtastic('#colorpickerBioColor');
    // picker.setColor("#b6b6ff");
    $("#bioColor").on('keyup', function() {
      pickerbtn.setColor($(this).val());
    });
    //pickerbtn.linkTo(onTextColorChange);
    $("#link-bio-color").on('click', function(e) {
      e.preventDefault();
      $(".proof-wrapper-preview").eq(0).show();
      $('#modal-color-picker-bio-color').modal('toggle');
    });
    $(document).on('click', '.btn-apply-bio', function() {
      template.bio_font_color = $("#bioColor").val();
      onBioColorChange($("#bioColor").val());
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
          $('#viewpicture').attr('src', e.target.result).fadeIn('slow');

          $('.div-picture').show();
          $('#viewpicture').show();
          $("#wizardPicturePreview-delete").show();
        }
        reader.readAsDataURL(input.files[0]);
        changed = 1;
      }
    }

    $("#wizardPicturePreview").on('click', function() {
      $('#file-wizard-picture').trigger('click');
    });
    $(document).on('change', "#file-wizard-picture", function (e) {
      readURL(this);
    });
    $("#wizardPicturePreview-delete").on('click', function() {
      delete_photo();
    });
    $(document).on('change','.pictureClass',function(){
      let inputthis=$(this).attr('id');
        function readThis(input) {
          if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            // console.log(e.target.result);
            // $("."+inputthis+"-get").attr('src',e.target.result); //old way
            $("."+inputthis+"-get").css('background-image','url('+e.target.result+')');
            
            // $("."+inputthis+"-get").parent().show();
            if ($(".mylides").hide()) {
              $("."+inputthis+"-get").parent().show();
              $("."+inputthis+"-dot").siblings().removeClass("activated");
              $("."+inputthis+"-dot").addClass("activated");
            }
            

            $("."+inputthis+"-get").attr("value","ada");
            $("#"+inputthis+"-dot").show();
            if ($(".dot").length==1) {
              $(".dot").parent().hide();
              $('.prev').hide();
              $('.next').hide();
            }
            else{
              $(".dot").parent().show();
              $('.prev').show();
              $('.next').show();
            }
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      // showSlides(0);
      readThis(this);
    });
     
    /*$(".txthov").hover(
      function() {
        check_outlined();
        check_rounded();
        temp1 = $(this).css("color");
        // temp2 = $(this).css("background-color");
        temp2 = $("#phonecolor").css("background-color");

        $(this).parent().children().css("background-color",temp1);
        $(this).parent().children().css("color",temp2);
      }, function() {
        check_outlined();
        check_rounded();
      }
    );*/
    $(document).on({
      mouseenter: function () {
        check_outlined();
        check_rounded();
        if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
          temp1 = $(this).css("color");
        }
        else if ( ($('#modeBackground').val()=="wallpaper") || ($('#modeBackground').val()=="animation") ) {
          temp1 = template.button_hover_color; //pake warna hover
        }
        // temp2 = $(this).css("background-color");
        //if klo di area gradient atau solid 
        //else klo di area wallpaper or animation 
        temp2 = $("#phonecolor").css("background-color");
        
        if ($('#is_text_color').prop("checked") == false) {
          $(this).parent().children().css("background-color",temp1);
          if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
            $(this).parent().children().css("color",temp2);
          }
        } else {
          $(this).parent().children().css("background-color",$('#textColor').val());
          if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
            $(this).parent().children().css("color",$("#phonecolor").css("background-color"));
          }
          else {
            $(this).parent().children().css("color",temp2);
          }
        }
      },
      mouseleave: function () {
        check_outlined();
        check_rounded();
      }
    }, ".txthov"); //pass the element as an argument to .on    


    // Add the following code if you want the name of the file appear on select
    $(document).on("change", ".custom-file-input",function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("body").on("click", ".savetemp", function() {
      tambahTemp();
      $('.preview-mobile').addClass('preview-none');
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
    });
    
    $("body").on("click", "#addBanner", function() {
      var bannerhtml ="";
      idpic+=1;
      let $el;
     /* elhtml = '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'"><div class="div-cell"><input type="text" name="judulBanner[]" value="" class="form-control banner-title" placeholder="Judul banner"><input type="hidden" name="idBanner[]" value=""><input type="hidden" name="statusBanner[]" class="statusBanner" value=""><input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel[]" class="form-control bannerpixel banner-new"></select><div class="custom-file"><input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01" accept="image/*"><label class="custom-file-label" for="inputGroupFile01">Choose file</label></div></div><div class="div-cell cell-btn btn-deleteBanner"><span><i class="far fa-trash-alt"></i></span></div> <span style="position: absolute;top: 148px;left: 10px;font-size:10px;font-style: italic;">Ukuran Gambar 434x200 Skala 2.2:1 (width:height), Max 500KB, JPG,PNG.</span></div>';*/

      bannerhtml += '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'">';
      bannerhtml += '<div class="div-cell">';
      bannerhtml += '<input type="text" name="judulBanner[]" value="" class="form-control banner-title" placeholder="Judul banner" />';
      bannerhtml += '<input type="hidden" name="idBanner[]" value="">';
      bannerhtml += '<input type="hidden" name="statusBanner[]" class="statusBanner" value="">';
      bannerhtml += '<input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link">';

      bannerhtml += '<select name="bannerpixel[]" class="form-control bannerpixel banner-new"></select>';
      bannerhtml += '<div class="custom-file">';
      bannerhtml += '<input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01" accept="image/*">';
      bannerhtml += '<label class="custom-file-label" for="inputGroupFile01">Choose file</label>';
      bannerhtml += '</div>';
      bannerhtml += '</div>';

      bannerhtml += '<div class="div-cell cell-btn btn-deleteBanner">';
      bannerhtml += '<span><i class="far fa-trash-alt"></i></span>';
      bannerhtml += '</div>';
      bannerhtml += '<span style="position: absolute;top: 148px;left: 10px;font-size:10px;font-style: italic;">Ukuran Gambar 434x200 Skala 2.2:1 (width:height), Max 500KB, JPG,PNG.</span>';
      bannerhtml += '</div>';

      $el = $(".div-banner").append(bannerhtml);
      $(".banner-new").html(dataView);
      $(".banner-new").val(0);
      if (dataFree == "1") {
        $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 7 hari, Silahkan <a href='<?php echo url('pricing'); ?>' target='_blank'>Upgrade</a></label>" );
      }
       // loadPixel(0,'.banner-new');
      if ($('.list-banner').length==5) {
         $(this).attr('disabled', 'disabled'); 
      }
      let countbanner=$('.mySlides').length;
      
      let style=""; 
      if ($(".list-banner").length==1) {
        style="block";
      }
      else{
        style="none"; 
      }
      // $('#viewbanner').append('<div class="mySlides mylides fit" id="picture-id-'+idpic+'-get"  style="display:'+style+'" value="hid"><img id="picture-'+idpic+'" src="<php echo asset('image/739x218.png');?>" value="tidakada" class="imagesize input-picture-'+idpic+'-get"></div>');
      strTempBgImage1="<?php echo asset('image/434x200.jpg'); ?>";
      strTempBgImage2="background-image:url('"+strTempBgImage1+"');";
      $('#viewbanner').append('<div class="mySlides mylides fit" id="picture-id-'+idpic+'-get"  style="display:'+style+'" value="hid"><div id="picture-'+idpic+'" style="'+strTempBgImage2+'" class="banner-image input-picture-'+idpic+'-get"></div></div>');
      
      let slidesi=$('.mySlides');
      let dotselementt=$('#dot-view');
      let slidesiLength=slidesi.length-1;
      dotselementt.append('<span class="dot picture-id-'+idpic+'-dot input-picture-'+idpic+'-dot" id="input-picture-'+idpic+'-dot" onclick="currentSlide('+slidesiLength+')" style="display:none"></span>');
      if ($(".dot").length==1) 
      {
        $(".dot").parent().hide();
        $('.prev').hide();
        $('.next').hide();
      }
    });

    $(document).on("click",".btn-deleteBannerUpdate",function(){
      $(this).parent().hide();
      $(this).parent().removeClass('list-banner');
      let hide=$(this).parent();
      hide.find(".statusBanner").val("delete");
      let idthis=$(this).parent().attr("picture-id");
      $("#"+idthis+"-get").remove();
      $("."+idthis+"-dot").remove();
      // if () {}  
      if($('.list-banner').length<=1){
        elhtml = $('.div-banner').html();
        $('.prev').hide();
        $('.next').hide();
      }  
        plusSlides(-1);
    });


    $(document).on("click", ".btn-deleteBanner", function() {
      if($('.list-banner').length<=1){
        elhtml = $('.div-banner').html();
        $('.prev').hide();
        $('.next').hide();
      }
      if ($('.list-banner').length<=5) {
        $("#addBanner").removeAttr("disabled");
      }

      $(this).parent().remove();
      let idthis=$(this).parent().attr("picture-id");

      $("#"+idthis+"-get").remove();

      $("."+idthis+"-dot").remove();
      plusSlides(-1);
      if ($(".dot").length==1) {
        $(".dot").parent().hide();
        $('.prev').hide();
        $('.next').hide();
      }
    });

    $("body").on("click", ".btn-delete", function() {
      /*if (confirm('anda yakin ingin menghapus pixel ini')) {
        var idpixel = $(this).attr('dataid');
        delete_pixel(idpixel);
      }*/
      $('#id_delete_pixel').val($(this).attr('dataid'));
      $('#type').val('pixel');
      $('.txt-mode').html('Pixel');
      $('#confirm-delete').modal('show');
    });

    $("body").on("click", ".btn-deletewa", function() {
      /*if (confirm('anda yakin ingin menghapus walink ini')) {
        var idwalink = $(this).attr('dataidwa');
        deletewalink(idwalink);
      }*/
      $('#id_delete_link').val($(this).attr('dataidwa'));
      $('#type').val('wa');
      $('.txt-mode').html('WhatsApp');
      $('#confirm-delete').modal('show');
    });

    $("body").on("click", ".btn-delete-ok", function() {
      if($('#type').val()=='pixel'){
        delete_pixel($('#id_delete_pixel').val());
      } else {
        deletewalink($('#id_delete_link').val());
      }
    });

    $(document).on('click', '#generate', function(e) {
      var nomor = '62'+$('#nomorwa').val();
      var message = $('#pesan-wa').val();
      var convert = encodeURI(message);
      var link;
      if($('#radio_button_wa_standard').is(':checked')) {
        link = "https://api.whatsapp.com/send?phone=" + nomor + "&text=" + convert + "";
      }
      if($('#radio_button_wa_deep_link').is(':checked')) {
        link = "whatsapp://send/?phone="+nomor+"&text=" + convert + "";
      }
      $('#demo').html(link);
      tambahwalink();
    });

    $(document).on("click", "#btnpixel", function(e) {
      tambahpixel();
      //$('#pesanAlert').removeClass('alert-danger');
      //$('#pesanAlert').children().remove();
    });

    $(document).on("click", ".btn-save-link", function(e) {
      if (tambahPages()) {
        tambahTemp();
      }

      $('.preview-mobile').addClass('preview-none');
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
      $(window).scrollTop(0);
    });

    $('.btn-reset').click(function() {
      $('#pesanAlert').removeClass('alert-danger');
      $('#pesanAlert').children().remove();
      $("input[name='fb_custom_event']").hide();
    });

    $(document).on('click', '.btn-editwa', function(e) {
      var editnomorwa = $(this).attr("datanomorwa");
      var editpesan = $(this).attr("datapesan");
      var editidwa = $(this).attr("dataeditwa");
      $('#pesanAlert').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
      $('#editidwa').val(editidwa);
      $('#nomorwa').val(editnomorwa);
      $('#pesan-wa').val(editpesan);
    });

    $(document).on('click', '.btn-editpixel', function(e) {
      var script = $(this).attr("datascriptpixel");
      var title = $(this).attr("dataedittitle");
      var editidpixel = $(this).attr("dataeditpixelid");
      var jenis = $(this).attr("datajenis");

      $('#pesanAlert').addClass('alert-danger').html('<div class="resetedit">anda dalam mode edit tekan reset untuk membatalkan</div>');
      $('#script').val(script);
      $('#judul').val(title);
      $('#editidpixel').val(editidpixel);
      $('#jenis_pixel').val(jenis);
      location.href="#script";
    });
    
    
    <?php 
    if (!is_null($pages->sort_msg)) {
      $arr = array_filter(explode(";",$pages->sort_msg));
      
      
      //new dari link
      $div = floor(count($arr)/3);
      $mod = count($arr)%3;

      $colsisa = 0;
      if($mod>0){
        $colsisa = 12/$mod;
      }
    
      $col = 0;
      $count_3 = 0;
      
      $counter = 1;
      if (count($arr)>0) {
      foreach($arr as $data){
        
        
        if($div<=0){
          //0
          $col = $colsisa;
        } else {
          $col = 4;
          //1
        }
    ?>
        $("#msg-li-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        $("#msg-li-"+"<?php echo $data; ?>>div").removeClass("hide");
        // $("#msg-li-"+"<?php echo $data; ?>>div").show();
        $("#msg-li-"+"<?php echo $data; ?>>div").css("display","table");
        $("#msg-li-"+"<?php echo $data; ?>>div").find(".input-hidden").val($("#msg-li-"+"<?php echo $data; ?>>div").find(".input-hidden").attr("data-val"));
        
        $("#"+"<?php echo $data; ?>"+"viewid").attr("data-category","<?php echo $counter; ?>");
        $("#"+"<?php echo $data; ?>"+"viewid").removeClass("hide");
        $("#"+"<?php echo $data; ?>"+"viewid").removeClass("col");
        $("#"+"<?php echo $data; ?>"+"viewid").addClass("col-<?php echo $col; ?>");

        @if($div>0)
          $("#"+"<?php echo $data; ?>"+"viewid").find("label").hide();
        @endif
    <?php 
        $counter += 1;
        
          $count_3 = $count_3 + 1;
          if($count_3>=3){
            $div = $div-1;
            $count_3 = 0;
          } 
        
      }} ?>
      sortMeBy("data-category", "ul.sortable-msg", "li", "asc");
      sortMeBy("data-category", "ul#getview", "li", "asc");
    <?php }
    else {
    ?>
        $("#msg-li-wa>div").removeClass("hide");
        $("#msg-li-wa>div").css("display","table");
        $("#msg-li-wa>div").find(".input-hidden").val($("#msg-li-wa>div").find(".input-hidden").attr("data-val"));
        $("#waviewid").removeClass("hide");

        $("#msg-li-telegram>div").removeClass("hide");
        $("#msg-li-telegram>div").css("display","table");
        $("#msg-li-telegram>div").find(".input-hidden").val($("#msg-li-telegram>div").find(".input-hidden").attr("data-val"));
        $("#telegramviewid").removeClass("hide");
    <?php } ?>

    // buat sort link
    <?php 
    if (!is_null($pages->sort_link)) {
      $arr = explode(";",$pages->sort_link);
      $counter = 1;
      foreach($arr as $data){
    ?>
    // console.log("<?php echo $data; ?>");
        $("#link-url-update-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        
        $("#link-preview-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
    <?php 
        $counter += 1;
      } ?>
      sortMeBy("data-category", "ul.sortable-link", "li", "asc");
      sortMeBy("data-category", "ul#viewLink", "li", "asc");
    <?php }
    else {
    ?>
    <?php } ?>
    
    
    // buat sort sosmed
    <?php 
    if (!is_null($pages->sort_sosmed)) {
      $arr = explode(";",$pages->sort_sosmed);
      $counter = 1;
      if (count($arr)>0) {
      foreach($arr as $data){
    ?>
        $("#sosmed-"+"<?php echo $data; ?>").attr("data-category","<?php echo $counter; ?>");
        $("#sosmed-"+"<?php echo $data; ?>>div").removeClass("hide");
        // $("#sosmed-"+"<?php echo $data; ?>>div").show();
        $("#sosmed-"+"<?php echo $data; ?>>div").css("display","table");
        $("#sosmed-"+"<?php echo $data; ?>>div").find(".input-hidden").val($("#sosmed-"+"<?php echo $data; ?>>div").find(".input-hidden").attr("data-val"));

        $("#"+"<?php echo $data; ?>"+"viewid").attr("data-category","<?php echo $counter; ?>");
        $("#"+"<?php echo $data; ?>"+"viewid").removeClass("hide");
        $("#"+"<?php echo $data; ?>"+"viewid").addClass("shown-sm");

        $("#check_"+'{{ $data }}').prop('checked',true);
        // changeLengthMedia();
    <?php 
        $counter += 1;
      }} ?>
      sortMeBy("data-category", "ul.sortable-sosmed", "li", "asc");
      sortMeBy("data-category", "ul#sm-preview", "li", "asc");
    <?php }
    else {
    ?>
        $("#sosmed-youtube>div").css("display","table");
        $("#sosmed-youtube>div").find(".input-hidden").val($("#sosmed-youtube>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-youtube>div").removeClass("hide");
        $("#youtubeviewid").removeClass("hide");

        $("#sosmed-ig>div").css("display","table");
        $("#sosmed-ig>div").find(".input-hidden").val($("#sosmed-ig>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-ig>div").removeClass("hide");
        $("#igviewid").removeClass("hide");

        $("#sosmed-tiktok>div").css("display","table");
        $("#sosmed-tiktok>div").find(".input-hidden").val($("#sosmed-tiktok>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-tiktok>div").removeClass("hide");
        $("#tiktokviewid").removeClass("hide");

        $("#sosmed-twitter>div").css("display","table");
        $("#sosmed-twitter>div").find(".input-hidden").val($("#sosmed-twitter>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-twitter>div").removeClass("hide");
        $("#twitterviewid").removeClass("hide");

        $("#sosmed-fb>div").css("display","table");
        $("#sosmed-fb>div").find(".input-hidden").val($("#sosmed-fb>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-fb>div").removeClass("hide");
        $("#fbviewid").removeClass("hide");

        $(".check_social").prop('checked',true);
    <?php } ?>

    
    currentSlide(0,"first");
    $(".slideshow-container").attr('fst',"first");
    slideIndex=0;
    check_rounded();
    $("#poweredview").children().show();
    <?php if ($user->membership<>'free') { ?>  
      check_powered();
    <?php } ?>
    check_click_bait();
    check_text_color();
    check_outlined();

    <?php 
      if(is_null($pages->image_pages)){
    ?>
      $("#wizardPicturePreview-delete").hide();
    <?php }
    ?>
    
    $('#select-animation').selectize({
      sortField: 'text',
      onChange: function(value) {
        if (value=="abstract"){
          $(".animation-thumb").hide();
          $(".animation-abstract").show();
        }
        if (value=="bubble"){
          $(".animation-thumb").hide();
          $(".animation-bubble").show();
        }
        if (value=="bubble-up"){
          $(".animation-thumb").hide();
          $(".animation-bubble-up").show();
        }
        if (value=="cloud"){
          $(".animation-thumb").hide();
          $(".animation-cloud").show();
        }
        if (value=="confetti"){
          $(".animation-thumb").hide();
          $(".animation-confetti").show();
        }
        if (value=="disk"){
          $(".animation-thumb").hide();
          $(".animation-disk").show();
        }
        if (value=="gradient"){
          $(".animation-thumb").hide();
          $(".animation-gradient").show();
        }
        if (value=="leaves"){
          $(".animation-thumb").hide();
          $(".animation-leaves").show();
        }
        if (value=="wave"){
          $(".animation-thumb").hide();
          $(".animation-wave").show();
        }
        if (value=="waves"){
          $(".animation-thumb").hide();
          $(".animation-waves").show();
        }
      }
    });    
    $(".animation-thumb").hide();
    $(".animation-abstract").show();
    $(document).on('click', '#tambah', function (e) {
      $('.messengers').each(function () {
        if ($(this).hasClass('hide')) {
          $(this).css("display","table");
          $(this).find(".input-hidden").val($(this).find(".input-hidden").attr("data-val"));
          $(this).removeClass('hide');
          $(this).parent().attr("id", "msg-" + $(this).attr('id'));
          return false;
        }
      });
      $('.link').each(function () {
        if ($(this).hasClass('hide')) {
          $(this).show();
          $(this).removeClass('hide');
          $(this).addClass('shown-mes');
          renameColMessage();
          return false;
        }
      });
      //changeLength();
    });
	
    /* biolink link */
    $(document).on('click', '#addlink', function (e) {
     //  if ($('.sortable-link > li:visible').length>5){
  			// alert("Jumlah link tidak boleh lebih dari 5");
	 		 //  return "";
     //  }
        var $el;
        counterLink += 1;
        $('.sortable-link').append(
          '<li class="link-list" id="link-url-new_' + counterLink + '">'+
            '<div class="div-table mb-4">'+
            '<div class="div-cell"><span class="handle"><i class="fas fa-bars"></i></span></div>'+
            
            '<div class="div-cell">'+
              '<div class="col-md-12 col-12 pr-0 pl-0">'+
                '<div class="input-stack">'+
                  '<select id="new_'+counterLink+'" name="options[]" class="form-control link_option">'+
                      '<option value="1" selected>Link</option>'+
                      '<option value="2">Youtube Link</option>'+
                  '</select>'+

                  '<div class="sel_new_'+counterLink+'">'+
                    '<input type="hidden" name="idlink[]" value="new">'+
                    '<input class="delete-link" type="hidden" name="deletelink[]" value="">'+
                    '<input data-id="'+counterLink+'" type="text" name="title[]" value="" id="title-' + counterLink + '-view" placeholder="Title" class="form-control focuslink">'+
                    '<input type="text" name="url[]" value="" placeholder="http://url..." class="form-control">'+
                    '<input data-file="title-'+ counterLink +'-view-get" type="file" name="iconlink[]" class="form-control img_icon_preview" />'+
                    '<small>Rasio ukuran icon 1:1 contoh : 48px x 48px</small>'+
                  '</div>'+
                '</div>'+
              '</div>'+
              '<div class="col-md-12 col-12 pr-0 pl-0">'+
                '<input type="text" name="embed[]" class="form-control em_new_'+counterLink+' emb" placeholder="masukkan youtube link">'+

                '<select name="linkpixel[]" id="linkpixel-' + counterLink + '" class="form-control linkpixel lnp_new_'+counterLink+'"></select>'+
              '</div>'+
              '</div>'+
              '<div class="div-cell cell-btn deletelink"><span><i class="far fa-trash-alt"></i></span>'+
              '</div>'+
            '</div>'+
          '</li>');

        // $("#viewLink").append(' <button type="button" class="btn btnview title-' + counterLink + '-view-get" id="link-url-' + counterLink + '-preview" style="width: 100%; margin-bottom: 12px;">Masukkan Link</button>');

        //back_target
        $("#viewLink").append('<li class="">'+
          '<span id="link-url-new_' + counterLink + '-preview" class="embed-ln-new_'+counterLink+'">'+
          '<a id="textprev-new-'+counterLink+'" href="" class="btn btn-md btnview title-' + counterLink + '-view-get txthov" style="width: 100%; margin-bottom: 12px;">'+'<img class="rounded-circle image_icon_link" id="preview_title-'+counterLink+'-view-get" />'+'Masukkan Link</a></li></span>');
        check_outlined();
        check_rounded();
        $('#linkpixel-' + counterLink).html(dataView);
        $('#linkpixel-' + counterLink ).val(0);
        //loadPixel(0,'#linkpixel-' + counterLink );
    });
    
	
  }); //end document ready

  function upload_image_icon()
  {
    $("body").on("change",".img_icon_preview",function(){
      var id = $(this).attr('data-file');
      // var len = $('#preview_'+id).length; 
      $("."+id).addClass('image_icon_link_btn');
      readURL(this,id);
    });
  }

  //PREVIEW IMAGE ICON ON BUTTON
  function readURL(input,id) {
    if (input.files && input.files[0]) {

      var reader = new FileReader();
      reader.onload = function(e) {
        $('#preview_'+id).attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
 
    // $(document).on('click','.marker',function(){
    //      $('#backtheme').val('');
    // });
    //  $('#powered').prop('disabled','disabled');
    // $(document).bind('contextmenu',function(e){
    //   e.preventDefault();
    // });
    
</script>
@endsection
