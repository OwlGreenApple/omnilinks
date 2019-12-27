@extends('layouts.app')

@section('content')
<?php use App\Helpers\Helper; ?>
<link rel="stylesheet" href="{{asset('css/dash.css')}}">
<link rel="stylesheet" href="{{asset('css/farbtastic.css')}}">
<link rel="stylesheet" href="{{asset('css/theme.css')}}">
<link rel="stylesheet" href="{{asset('css/animate.css')}}">
<link rel="stylesheet" href="{{asset('css/animate-2.css')}}">

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

  .themes.selected, .wallpapers.selected{
    border: 3px solid #0062CC;
  }
</style>

<script type="text/javascript">
  var template;
  var changelink = 0;
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
  
  function tambahTemp() {
    var form = $('#saveTemplate')[0];
    var formData = new FormData(form);
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
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');

        //var data=jQuery.parseJSON(result);
        $("#pesanAlert").html(data.message);
        $("#pesanAlert").show();
        $(window).scrollTop(0);
        if(data.status == "success") {
          changed = 0;
          changelink = 0;
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

  function tambahPages() {
    $.ajax({
      type: 'POST',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data: $("#savelink").serialize() + '&' + $('.sortable-msg').sortable('serialize') + '&' + $('.sortable-link').sortable('serialize') + '&' + $('.sortable-sosmed').sortable('serialize'),
      url: "<?php echo url('/save-link');?>",
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
      }
    });
  }

  function tambahpixel() 
  {
    //CHECK WHETHER SCRIPT HAS ERROR OR NOT
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

    $("#script-code").html($("#script").val());
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
      url: "<?php echo url ('/save-pixel')?>",
      dataType: 'text',
      data: $("#savepixel").serialize(),
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
        $(window).scrollTop(0);
        refreshpixel();
        loadPixelPage();

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
        
      },
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
      }
    });
  }

  function loadPixel(){
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: "<?php echo url('/load-pixel-page'); ?>",
      data: { id:0 },
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
        // $(selector).html(data.view);
        dataView = data.view;
        dataFree = data.free;
        //if klo free maka replace element dengan label 
        if (dataFree == "1") {
          $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 30 hari, Silahkan <a href='<?php echo url('pricing'); ?>' target='_blank'>Upgrade</a></label>" );
        }
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
        $(this).find("select").html(dataView);
        $(this).find("select").val($(this).find("select").attr('data-pixel-id'));
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
      $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 30 hari, Silahkan <a href='<?php echo url('pricing'); ?>' target='_blank'>Upgrade</a></label>" );
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

  
  function plusSlides(n) {
    showSlides(slideIndex += n );
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
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
    if (slides.length>0) {
      slides[slideIndex-1].style.display = "block";
    }
    if (dots.length>0) {
      dots[slideIndex-1].className +=" activated";
    }
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

  function tambah_premiumid() {
    $.ajax({
      type: 'GET',
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      dataType: 'text',
      data: $('#form-premiumID').serialize(),
      url: "<?php echo url('/premium-id-biolinks/tambah');?>",
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

      <div class=" col-12">
        <button class="btn btn-success mt-3 mb-3 btn-premium">
          <i class="fas fa-star"></i> <?php if (is_null($pages->premium_names)) { echo "Get"; } else { echo "Update"; } ?> Custom Link
        </button>
      </div>
      
      <?php if (is_null($pages->premium_names)) { $custom_link = $pages->names; } else { $custom_link = $pages->premium_names; } ?>
      <div class=" col-12">
        <a href="https://{{env('SHORT_LINK')}}/{{$custom_link}}" target="_blank" id="custom-link-show">https://{{env('SHORT_LINK')}}/{{$custom_link}}</a> <span id="btn-copy-custom-link" class="btn-copy" data-link="https://{{env('SHORT_LINK')}}/{{$custom_link}}"><i class="fas fa-file"></i></span>
      </div>

      <div class="offset-lg-0 col-lg-7 offset-md-1 col-md-10">
        

        <div class="card carddash" style="margin-bottom:20px;">
          <div class="card-body">
            <ul class="mb-4 nav nav-tabs">
              <li class="nav-item">
                <a href="#link" class="active nav-link link" role="tab" data-toggle="tab">
                  Link
                </a>
              </li>

              <li class="nav-item">
                <a href="#style" class="nav-link link" role="tab" data-toggle="tab">
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
              <?php } ?>

              <li class="nav-item">
                <a href="#walink" class="nav-link link" role="tab" data-toggle="tab">
                  WA Link Creator
                </a>
              </li>

            </ul>

            <div class="tab-content">

              <!-- tab 1-->
              <div role="tabpanel" class="tab-pane fade in active show" id="link">
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
                  </ul>

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
              
              <!-- TAB 2 -->
              <div role="tabpanel" class="tab-pane fade in " id="style">
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
                          <textarea id="description" name="description" class="form-control" style="margin-bottom: 5px;resize: none;" rows="3" cols="53" maxlength="80" wrap="hard" placeholder="Max 80 character" no-resize><?php if(!is_null($pages->description)) { 
                            echo $pages->description;
                          }else {
                            echo "This is your new text content. 
You can modify this text 
and add more";
                          }?></textarea>
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
                            <div class="c div-banner">
                              @if($banner->count())
                              <?php $uc=0; ?>
                                @foreach($banner as $ban)
                                <?php $uc+=1; ?>
                                <div class="div-table list-banner mb-4" picture-id="picture-id-<?=$uc?>">
                                  <div class="div-cell">
                                    <input type="text" name="judulBanner[]" value="{{$ban->title}}" class="form-control" placeholder="Judul banner">
                                    <input type="hidden" name="idBanner[]" value="{{$ban->id}}">
                                    <input type="hidden" name="statusBanner[]" class="statusBanner" value="">
                                    <input type="text" name="linkBanner[]" value="{{$ban->link}}" class="form-control" placeholder="masukkan link">

                                    <select name="bannerpixel[]" class="form-control bannerpixel bannerpixel-{{$ban->id}}">
                                    </select>
                                    <div class="custom-file">
                                      <input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-<?=$uc?>" aria-describedby="inputGroupFileAddon01" accept="image/*">

                                      <label class="custom-file-label" for="inputGroupFile01">
                                        <?php 
                                          if ($ban->images_banner=="0"){
                                            echo asset('/image/434x200.jpg');
                                          }
                                          else {
                                            echo basename($ban->images_banner);
                                          }
                                        ?>
                                      </label>
                                    </div>
                                  </div>
                                @if(Auth::user()->membership!='free')
                                  <div class="div-cell cell-btn btn-deleteBannerUpdate">
                                    <span>
                                      <i class="far fa-trash-alt"></i>
                                    </span>
                                  </div>
                                @endif  
                                <span style="position: absolute;top: 148px;left: 10px;font-size:10px;font-style: italic;">Ratio Gambar 2.2:1 (width:height), Max 500KB, JPG,PNG.</span>
                                </div>
                                @endforeach
                              @endif
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
                      <input type="hidden" name="animationclass" id="animationclass" value="animation-bubble-bg-blue animation-core">
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
                            <span class="tooltipstered" title="<div class='panel-heading'>Bio Color</div><div class='panel-content'>Atur warna Bio & Icon Media Sosial sesuai keinginanmu</div>">
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
                          <a class="nav-link" href="<?php if ($user->membership<>'free') { echo "#buzz"; } else { echo "#"; } ?>" id="gradient" role="tab" <?php if ($user->membership<>'free') { echo 'data-toggle="tab"'; } ?>>Gradient <sup>pro</sup></a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="<?php if ($user->membership<>'free') { echo "#wallpaper"; } else { echo "#"; } ?>" id="wallpaper-tab" role="tab" <?php if ($user->membership<>'free') { echo 'data-toggle="tab"'; } ?>>Wallpaper <sup>pro</sup></a>
                        </li>
                        <li class="nav-item sub-nav">
                          <a class="nav-link" href="<?php if ( ($user->membership=='elite') || ($user->membership=='super')) { echo "#animation"; } else { echo "#"; } ?>" id="animation-tab" role="tab" <?php if ( ($user->membership=='elite') || ($user->membership=='super') ) { echo 'data-toggle="tab"'; } ?>>Animation <sup>pro</sup></a>
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
            </div>
          </div>
        </div>
      </div>
      <!--phone-->
      <div class="col-md-5">
        <div class="fixed">
          <div class="center preview-center">
            <div class="mobile d-none d-lg-block">
              <div class="mobile1">
                <div class="screen " id="phonecolor" style="border:none; overflow-y:auto; ">
                  <!--screen-->
                  <header class="col-md-12 mt-4" style="padding-top: 17px; padding-bottom: 12px;">
                    <div class="row">
                      <div class="col-md-2 col-3">
                        <div class="div-picture" style="width: 82px; height: 82px; margin-left: 13px;">
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
                      <div class="col-md-10 col-8 p-2">
                        <ul style="margin-left: 23px; font-size: 11px;">
                          <li style="display: block; margin-bottom: -15px;  ">
                            <p class="font-weight-bold description" style="color: #fff;" id="outputtitle"></p>
                          </li>
                          <li style="display: block; margin-bottom: -15px; ">
                            <p class="font-weight-bold description" style="color: #fff; word-break: break-all;" id="outputdescription"></p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </header>

                  @if(Auth::user()->membership!='free')
                  <div class="col-md-12 fix-image ">
                    <div class="slideshow-container">
                      <div class="ap" id="viewbanner">
                      <?php 
                      if($banner->count()){
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
                    <br>
                    <div style="text-align:center ; margin-top: -25px;" id="dot-view"></div>
                  </div>
                  @endif

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
                  <div class="row" style="font-size: xx-small; margin-left: 3px; margin-right: 2px; font-weight: 700;">
                    <ul class="col-md-12" id="viewLink" >
                      @if($links->count())
                      @foreach($links as $link)
                        <li id="link-preview-{{$link->id}}"><a href="#" class="btn btn-md btnview title-{{$link->id}}-view-update txthov" style="width: 100%;  padding-left: 2px;margin-bottom: 12px;" id="link-url-update-{{$link->id}}-get" >{{$link->title}}</a></li>
                      @endforeach
                      @endif
                    </ul>
                  </div>
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

<!-- count length to determine if script has error -->
<div style="visibility: hidden" id="error-script"></div>

<script src="{{asset('js/farbtastic.js')}}"></script>
<script src="{{asset('js/biolinks.js')}}"></script>
<noscript>Jalankan Javascript di browser anda</noscript>
<script type="text/javascript">
  var elhtml;
  let idpic=6;
  let counterBanner=0;
  var changed = 0;

 
  //SCALE BANNER IMAGE
  $(window).on('load', function(){
     resize();
  });

  function resize()
  {
     var cons = 2.17;
     /* image banner */
     $(".banner-image").each(function(i){
         var hin = 0;
         var width = $(this).width();

         hin = width/cons;
         hin = Number(hin.toFixed(1));
         $(".banner-image").height(hin);
     });
  }

   //ALERT WHEN USER FORGOT TO SAVE
   $( ":input" ).change(function() {
      changed = $(this).closest('#saveTemplate').data('changed', true);
      changelink = $(this).closest('#savelink').data('changed', true);
    });

   $("#addlink, #tambah, #sm, .cell-btn, #addBanner").click(function()
   {
        changed = 1;
   });

   $(".bannerpixel, .banner-title, .banner-link").on("change",function(){
        changed = 1;
   });

  $("body").on("click",".link",function()
  {
     if(changed > 0 ||changed.length > 0 || changelink.length > 0)
     {
        $("#unsave").modal();
        return false;
     }
  });

  //..
  
  $('body').on('click', '.btn-preview', function() {
    $('.preview-mobile').html($('.mobile1').html());
    $('.preview-mobile').toggleClass('preview-none');
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

      $('#description').keydown(function(e){
        newLines = $(this).val().split("\n").length;
        if(e.keyCode == 13 && newLines >= 3) {
          return false;
        }
        else {
          tempStr = $(this).val().replace(/\n/g, "<br>");;
          $('#outputdescription').html(tempStr);
        }
      });
      $('#description').keyup(function(e){
        tempStr = $(this).val().replace(/\n/g, "<br>");;
        $('#outputdescription').html(tempStr);
      });
      tempStr = $('#description').val().replace(/\n/g, "<br>");
      $('#outputdescription').html(tempStr);

      
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
    });

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
      <?php if ($user->membership<>'free') { ?>
      $('#modeBackground').val('gradient');
      // $('#backtheme').val('colorgradient1');
      $("#phonecolor").removeClass();
      $("#phonecolor").addClass("screen "+$('#backtheme').val());
      check_outlined();
      check_rounded();
      <?php } ?>
      <?php if ($user->membership=='free') { ?>
      $("#premium-id-beli-2").modal();
      <?php } ?>
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
      <?php if ($user->membership<>'free') { ?>
        $("#textColor").val("#000");
        $("#bioColor").val("#000");
        $('#modeBackground').val('wallpaper');
        $("#phonecolor").removeClass();
        $("#phonecolor").addClass("screen "+$('#wallpaperclass').val());
        check_outlined();
        check_rounded();
      <?php } ?>
      <?php if ($user->membership=='free') { ?>
      $("#premium-id-beli-2").modal();
      <?php } ?>
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
      $('#sm-preview li a').css("color",outline+" !important");
    <?php } else {?>
      $('.btnview').css("background-color",outline);
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
      $('#sm-preview li a').css("color","#fff !important");
    <?php } ?>
    
    <?php if($pages->is_text_color) {?>
      //$(".mobile1").addClass("outlinedview");
      $("#textColor").val("<?php echo $pages->text_color; ?>");
      $('.btnview').css("color","<?php echo $pages->text_color; ?>");
      $('.description').css("color","<?php echo $pages->text_color; ?>");
      $('#sm-preview li a').css("color","<?php echo $pages->text_color; ?>");
    <?php } else {?>
      $('.btnview').css("color","#fff");
      $('.description').css("color","#fff");
      $('#sm-preview li a').css("color","#fff");
    <?php } ?>
    
    <?php if($pages->is_bio_color) {?>
      //$(".mobile1").addClass("outlinedview");
      $("#bioColor").val("<?php echo $pages->bio_color; ?>");
      $('.powered-omnilinks a').css("color","<?php echo $pages->bio_color; ?>");
      $('.description').css("color","<?php echo $pages->bio_color; ?>");
      $('#sm-preview li a').css("color","<?php echo $pages->bio_color; ?>");
    <?php } else {?>
      $('.powered-omnilinks a').css("color","#fff");
      $('.description').css("color","#fff");
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
        $('#sm-preview li a').css("color",color);
      } else {
        if ( ($('#modeBackground').val()=="gradient") || ($('#modeBackground').val()=="solid") ) {
          $('.powered-omnilinks a').css("color","#fff");
          $('.description').css("color","#fff");
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
      idpic+=1;
      let $el;
      elhtml = '<div class="div-table list-banner mb-4" picture-id="picture-id-'+idpic+'"><div class="div-cell"><input type="text" name="judulBanner[]" value="" class="form-control banner-title" placeholder="Judul banner"><input type="hidden" name="idBanner[]" value=""><input type="hidden" name="statusBanner[]" class="statusBanner" value=""><input type="text" name="linkBanner[]" value="" class="form-control" placeholder="masukkan link"><select name="bannerpixel[]"  class="form-control bannerpixel banner-new"></select><div class="custom-file"><input type="file" name="bannerImage[]" class="custom-file-input pictureClass" id="input-picture-'+idpic+'" aria-describedby="inputGroupFileAddon01" accept="image/*"><label class="custom-file-label" for="inputGroupFile01">Choose file</label></div></div><div class="div-cell cell-btn btn-deleteBanner"><span><i class="far fa-trash-alt"></i></span></div><span style="position: absolute;top: 148px;left: 10px;font-size:10px;font-style: italic;">Ratio Gambar 2.2:1 (width:height), Max 500KB, JPG,PNG.</span></div>';
      $el = $(".div-banner").append(elhtml);
      $(".banner-new").html(dataView);
      $(".banner-new").val(0);
      if (dataFree == "1") {
        $(".linkpixel").replaceWith( "<label class='linkpixel'>FB Pixel, Google, Twitter retargetting Hanya Berlaku 30 hari, Silahkan <a href='<?php echo url('pricing'); ?>' target='_blank'>Upgrade</a></label>" );
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
        
      } ?>
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
        // changeLengthMedia();
    <?php 
        $counter += 1;
      } ?>
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

        $("#sosmed-twitter>div").css("display","table");
        $("#sosmed-twitter>div").find(".input-hidden").val($("#sosmed-twitter>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-twitter>div").removeClass("hide");
        $("#twitterviewid").removeClass("hide");

        $("#sosmed-fb>div").css("display","table");
        $("#sosmed-fb>div").find(".input-hidden").val($("#sosmed-fb>div").find(".input-hidden").attr("data-val"));
        $("#sosmed-fb>div").removeClass("hide");
        $("#fbviewid").removeClass("hide");
    <?php } ?>

    
    currentSlide(0);
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
    $(".animation-bubble").show();
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
  });


 
    // $(document).on('click','.marker',function(){
    //      $('#backtheme').val('');
    // });
    //  $('#powered').prop('disabled','disabled');
    // $(document).bind('contextmenu',function(e){
    //   e.preventDefault();
    // });
    
</script>
@endsection
