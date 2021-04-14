<!DOCTYPE html>

<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta property="og:type" content="article">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <script src="{{asset('js/jquery-1.12.4.js')}}"></script>
  <!--<script src="{{asset('js/myScript.js')}}" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>-->
  <script src="{{asset('js/myScript.js')}}" ></script>
  <script src="{{ asset('js/app.js') }}"></script>
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->
  
 <!--  <link rel="stylesheet" type="text/css" href="{{asset('css/all.css')}}"> -->

  <!-- Font Awesome 5 -->
  <link href="{{ asset('assets/fontawesome-5.15.1/css/all.min.css') }}" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/template.css')}}">
  <link rel="stylesheet" href="{{asset('css/dash.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}">
  <link rel="stylesheet" href="{{asset('css/redirect.css')}}">
  <link rel="stylesheet" href="{{asset('css/proof.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate-2.css')}}">
 
  <link rel="stylesheet" href="{{asset('assets/whatsapp-chat-support/whatsapp-chat-support.css')}}">

  <!-- icomoon -->
  <link rel="stylesheet" href="{{asset('assets/icomoon/style.css')}}"/>
  
  <title>Link</title>
</head>

<script type="text/javascript">
  var urlbanner = [], template;
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
  
</script>

@if(!is_null($pages->color_picker))
  <body style=" color:#fff; background-color:{{$pages->color_picker}};" class="a "><!--height : 100vh;-->
@elseif(!is_null($pages->template)  )
  <body class="{{$pages->template}}"> <!--style="height : 100vh;"--> 
@elseif(!is_null($pages->wallpaper)  )
  <body class="{{$pages->wallpaper}}"> <!--style="height : 100vh;"-->
@elseif(!is_null($pages->gif_template) && ( ($membership=='elite') || ($membership=='super') ) )
  <body class="{{$pages->gif_template}}"> <!--style="height : 100vh;"-->
<!--@elseif($membership=='free')-->
@else
  <body style=" color:#fff; background-color:{{$pages->color_picker}};" class="a "><!--height : 100vh;-->
@endif


  <!-- Modal for expired free trial user -->
  <div class="modal fade" id="modal-freetrial-expired" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <img src="{{url('image/free-trial-expired.png')}}">
                  <p style="color: #505050;">Waktu berlanggananmu <br>Telah <strong>habis</strong> !</p>
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="row justify-content-center">
                <a href="https://omnilinkz.com/dashboard/pricing">
                  <button id="not-btn" class="btn btn-primary btn-apply-btn" type="button" style="background-color: #3490dc;">Berlangganan</button>
                </a>
              </div>
            </div>
        </div>
    </div>
  </div>  
  
  <div id="proof-fix" class="col-md-12 col-12" style="min-height: 100%">
    <div class="row justify-content-center service">
      <div class="col-lg-7 col-md-8 col-12 mb-4">

        @if($pages->point > 0)
            <!-- proof -->
            @if($proof->count() > 0)
              <div class="col-lg-12 proof-box">
              @foreach($proof as $row)
              <div class="proof-wrapper">
                  <div class="proof_image"><img src="{!! Storage::disk('s3')->url($row->url_image) !!}"/></div>
               
                  <div class="proof-desc">
                      <div class="proof_profile">
                        <div class="proof_name">{{ $row->name }}</div>
                        <div class="proof_star">
                          @for($x=1;$x<=$row->star;$x++)
                            <i class="fa fa-star" aria-hidden="true"></i>
                          @endfor
                        </div>
                      </div>

                      <div class="proof_comments">"{{ $row->text }}"</div>
                      <small><i class="fas fa-check"></i> Activproof</small>
                  </div>
              </div>
              @endforeach
            </div>
            @endif 
        @endif
        <!-- end proof -->

        <div class="row">
          <div class="offset-md-1 col-md-5 col-5">
              <div class="div-imagetitle">
                <img src="<?php 
                // echo url(Storage::disk('local')->url('app/'.$pages->image_pages));
                $viewpicture = asset('/image/no-photo.jpg');
                if(!is_null($pages->image_pages)){
                  // echo url(Storage::disk('local')->url('app/'.$pages->image_pages)); 
                  $viewpicture = Storage::disk('s3')->url($pages->image_pages);
                }
                // echo Storage::disk('s3')->url($pages->image_pages);
                echo $viewpicture;
                ?>" class="imagetitle">
              </div>
          </div>
        
          <div class="col-md-5 col-7">
            <span class="header-txt title">
              <?php if (is_null($pages->page_title)) { echo "Your Title Here"; } else { echo $pages->page_title; } ?>
            </span>
            <input type="hidden" id="hidden-description" value="{{$pages->description}}">
            <span class="header-txt txt" style="word-break: break-word;" id="description">
  <?php if(!is_null($pages->description)) { 
                              echo $pages->description;
                            }else {
                              echo "This is your new text content. <br>
  You can modify this text <br>
  and add more";
                            }?>
            </span>
          </div>
        </div><!-- end row -->
        <!-- end title -->
      </div>
      
      @if($membership!=='free')
      <div class="col-lg-7 col-md-8 mb-3 row">
        @if($banner->count())
        <div id="map" class="galleryContainer">
          <div class="slideShowContainer">
            <div onclick="plusSlides(-1)" class="nextPrevBtn leftArrow">
              <span class="arrow arrowLeft"></span>
            </div>
            <div onclick="plusSlides(1)" class="nextPrevBtn rightArrow" id="right">
              <span class="arrow arrowRight"></span>
            </div>
            <div class="captionTextHolder">
              <p class="captionText slideTextFromTop"></p>
            </div>
            
            <!-- banner -->

              @if(!is_null($banner[0]->images_banner))
                @foreach($banner as $ban)
                  <div class="imageHolder">
                    <!--<a href="{{url('click/banner/'.$ban->id)}}" target="_blank">-->
                    <!--<a href="<php echo env('APP_URL').'/click/banner/'.$ban->id ?>" target="_blank">-->
                      <script type="text/javascript">
                        urlbanner.push('<?php echo env('APP_URL').'/click/banner/'.$ban->id ?>');
                      </script>
                      <!--<img src="<php 
                      // echo url(Storage::disk('local')->url('app/'.$banner->images_banner));
                        if(!is_null($ban->images_banner)){
                          echo Storage::disk('s3')->url($ban->images_banner);
                        }
                      ?>" class="">
                      -->
                      <?php 
                      $bg_image = "";
                      // if(!is_null($ban->images_banner)){
                          // $bg_image = Storage::disk('s3')->url($ban->images_banner);
                        // }
                      if ($ban->images_banner=="0"){
                       $bg_image = asset('/image/434x200.jpg');
                      }
                      else {
                        $bg_image = Storage::disk('s3')->url($ban->images_banner);
                      }
                      ?>
                      <div style="background-image:url('<?php echo $bg_image; ?>');" class="banner-image"></div>
                      <p class="captionText"></p> 
                    <!--</a>-->
                  </div>
                @endforeach
              @else
                <div></div>
              @endif
            
          </div>
          <div id="dotsContainer"></div>
        </div>
        @endif
      </div>
      @endif

      <!-- social media -->
      <ul class="col-lg-7 col-md-8 mb-0 row" style="padding-left: 24px; padding-right: 24px;">
        <?php 
          $div = floor(count($sort_msg)/3);
          $mod = count($sort_msg)%3;

          $colsisa = 0;
          if($mod>0){
            $colsisa = 12/$mod;
          }
        
          $col = 0;
          $count_3 = 0;
          if (!is_null($pages->sort_msg)) {
          foreach ($sort_msg as $msg) {
            if($div<=0){
              //0
              $col = $colsisa;
            } else {
              $col = 4;
              //1
            }

        ?>  
      
          @if($msg=='wa' )
            <li class="col-{{$col}} pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/wa/'.$pages->id}}" title="wa" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-whatsapp" style="font-size : 20px"></i>
                  @if($div==0)
                    <span class="textbutton"> WhatsApp</span>
                  @endif
                </button>
              </a>
            </li>
          @endif 

          @if($msg=='telegram')
            <li class="col-{{$col}} pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/telegram/'.$pages->id}}" title="Telegram" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-telegram-plane"></i>
                  @if($div==0)
                    <span class="textbutton" > Telegram</span>
                  @endif
                </button>
              </a>
            </li>
          @endif  
          @if($msg=='skype')
            <li class="col-{{$col}} pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/skype/'.$pages->id}}" title="Skype" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-skype icon-msg"></i>
                  @if($div==0)
                    <span class="textbutton"> Skype</span>
                  @endif
                </button>
              </a>
            </li>
          @endif  


          @if($msg=='line')
            <li class="col-{{$col}} pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/line/'.$pages->id}}" title="Line" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-line"></i>
                  @if($div==0)
                    <span class="textbutton" > Line</span>
                  @endif
                </button>
              </a>
            </li>
          @endif

          @if($msg=='messenger')
            <li class="col-{{$col}} pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/messenger/'.$pages->id}}" title="Messenger" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-facebook-messenger"></i>
                  @if($div==0)
                    <span class="textbutton" > Messenger</span>
                  @endif
                </button>
              </a>
            </li>
          @endif
          
        <?php 
          $count_3 = $count_3 + 1;
          if($count_3>=3){
            $div = $div-1;
            $count_3 = 0;
          } 
        }
        }
        else {
          ?>
            <li class="col pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/wa/'.$pages->id}}" title="wa" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-whatsapp" style="font-size : 20px"></i>
                    <span class="textbutton"> WhatsApp</span>
                </button>
              </a>
            </li>
            <li class="col pl-1 pr-1 mb-3">
              <a href="#" data-href="{{env('APP_URL').'/click/telegram/'.$pages->id}}" title="Telegram" target="_blank" class="txthov link-ajax">
                <button class="btn btn-block">
                  <i class="fab fa-telegram-plane"></i>
                    <span class="textbutton" > Telegram</span>
                </button>
              </a>
            </li>
          
        <?php } ?>
      </ul>

      <!-- form connect API activrespon TOP -->
      @if($pages->position_api == 0)
        @include('user.link.form-api')
      @endif

      <!-- links -->
      <ul class="col-lg-7 col-md-8 mb-4">
        <?php
        $ctr = 0;
        ?>
        @if($links->count() > 0)
          @foreach($links as $link)
            @if($link->options == 1)
            <li class="col-md-12 col-12 mb-3"> 
              <a href="#" data-href="{{env('APP_URL').'/click/link/'.$link->id}}" title=""  target="_blank" class="txthov link-ajax">
                <button class="@if($link->icon_link !== null) image_icon_link_btn @endif btn btn-block <?php if ( ($ctr==0) && ($pages->is_click_bait) ) { echo 'animate-buzz'; } $ctr += 1; ?> ">
                  @if($link->icon_link !== null) 
                    <img src="{!! Storage::disk('s3')->url($link->icon_link) !!}" class="rounded-circle image_icon_link" />
                  @endif
                  <span class="textbutton">
                    {{$link->title}}
                  </span>
                </button>
              </a>
            </li>
            @else
            <!-- embed youtube -->
            <li class="col-md-12 col-12 mb-3 pad-fix"> 
              <div class="embed-responsive embed-responsive-16by9 embed-youtube">
                <iframe style="padding : 12px" class="embed-responsive-item" src="https://www.youtube.com/embed/{{ $link->youtube_embed }}?rel=0" allowfullscreen></iframe>
              </div>
            </li>
            @endif
          @endforeach
        @endif
      </ul>

      <!-- form connect API activrespon BOTTOM -->
      @if($pages->position_api == 1)
        @include('user.link.form-api')
      @endif

      <ul class="col-lg-7 col-md-8 mb-5 row" id="icon-sosmed">
        <?php 
        if (!is_null($pages->sort_sosmed)) {
          foreach ($sort_sosmed as $sosmed) { ?>
          <li class="col text-center icon-sosmed">
            @if( $sosmed=='fb')
              <a href="#" data-href="{{env('APP_URL').'/click/fb/'.$pages->id}}" title="fb" target="_blank" class="link-ajax">
                <i class="fab fa-facebook-square"></i>
              </a>
            @endif
          
            @if($sosmed=='ig')
              <a href="#" data-href="{{env('APP_URL').'/click/ig/'.$pages->id}}" title="ig" target="_blank" class="link-ajax">
                <i class="fab fa-instagram"></i>
              </a> 
            @endif

            @if($sosmed=='twitter')
              <a href="#" data-href="{{env('APP_URL').'/click/twitter/'.$pages->id}}" title="Twitter" target="_blank" class="link-ajax">
                <i class="fab fa-twitter-square"></i>
              </a>
            @endif

            @if($sosmed=='youtube')
              <a href="#" data-href="{{env('APP_URL').'/click/youtube/'.$pages->id}}" title="Youtube" target="_blank" class="link-ajax">
                <i class="fab fa-youtube"></i>
              </a>
            @endif  

            @if($sosmed=='tiktok')
              <a href="#" data-href="{{env('APP_URL').'/click/tiktok/'.$pages->id}}" title="Tiktok" target="_blank" class="link-ajax">
                <i style="font-size:30px" class="fab fa-tiktok"></i>
              </a>
            @endif 
          </li>
      <!-- diremark supaya sesuai phone preview, ngga tau dulu kenapa ini dipake
            @if( $sosmed=='fb' and (!is_null($pages->fb_link) || $pages->fb_pixel_id!=0))
              @endif 
            @if($sosmed=='ig' and (!is_null($pages->ig_link) || $pages->ig_pixel_id!=0))
              @endif 
            @if($sosmed=='twitter' and (!is_null($pages->twitter_link) || $pages->twitter_pixel_id!=0))
              @endif 
            @if($sosmed=='youtube' and (!is_null($pages->youtube_link) || $pages->youtube_pixel_id!=0))
              @endif 
      -->
        <?php } }
        else {
        ?>
          <li class="col text-center icon-sosmed">
              <a href="#" data-href="{{env('APP_URL').'/click/fb/'.$pages->id}}" title="fb" target="_blank" class="link-ajax">
                <i class="fab fa-facebook-square"></i>
              </a>
          </li>
          <li class="col text-center icon-sosmed">
              <a href="#" data-href="{{env('APP_URL').'/click/ig/'.$pages->id}}" title="ig" target="_blank" class="link-ajax">
                <i class="fab fa-instagram"></i>
              </a> 
          </li>
          <li class="col text-center icon-sosmed">
              <a href="#" data-href="{{env('APP_URL').'/click/twitter/'.$pages->id}}" title="Twitter" target="_blank" class="link-ajax">
                <i class="fab fa-twitter-square"></i>
              </a>
          </li>
          <li class="col text-center icon-sosmed">
              <a href="#" data-href="{{env('APP_URL').'/click/youtube/'.$pages->id}}" title="Youtube" target="_blank" class="link-ajax">
                <i class="fab fa-youtube"></i>
              </a>
          </li> 
          <li class="col text-center icon-sosmed">
              <a href="#" data-href="{{env('APP_URL').'/click/tiktok/'.$pages->id}}" title="Tiktok" target="_blank" class="link-ajax">
                <span style="font-size:25px" class="icon-tik-tok"></span>
              </a>
          </li>

        <?php }?>
      </ul>
      <div class="col-lg-7 col-md-8 mb-5 text-center powered-omnilinks">
        @if($pages->powered==1 || $membership=='free')
          <a data-href="https://omnilinkz.com" class="link-ajax-no-script"><!--powered by<br>Omnilinkz-->
          <img style="width: 150px; margin-bottom: 50px;" src="{{asset('image/powered-by.png')}}"></a>
        @endif
      </div>

      @if($membership=='free')
        @if(!is_null($ads))
          <!--
          <div class="col-lg-7 col-md-8 text-center redirect-ads big">
            <a data-href="<?php echo env('APP_URL').'/click-ads/'.$ads->id ?>" class="link-ajax-no-script">
              <span href="#" class="headline-1-view-get headads">
                  {{$ads->headline}}  
              </span>
            </a>
            <span class="desc-1-view-get desc-ads">
                {{$ads->description}}
            </span>
          </div>
          -->
        @endif  
      @endif
    </div>
  </div>
  
  
  <!--Ads-->
  @if($membership=='free')
    @if(!is_null($ads))
      <div class="fixed-ads">  
        <div class="relative-ads" style="">

          <div class="col-lg-12 col-md-12 text-center redirect-ads big">
            <a data-href="<?php echo env('APP_URL').'/click-ads/'.$ads->id ?>" class="link-ajax-no-script">
              <span href="#" class="headline-1-view-get headads">
                  {{$ads->headline}}
              </span>
            </a>
            <span class="desc-1-view-get desc-ads">
                {{$ads->description}}
            </span>
          </div>

        </div>
        <button type="button" class="close close-ads" id="close-ads">
          <span >&times;</span>
        </button>
      </div>
    @endif  
  @endif

  <!-- Whatsapp chat popup -->
  @if($pages->enable_chat == 1 && !is_null($wachat) && $valid == true)
  <div class="whatsapp_chat_support wcs_fixed_right @if($pages->buzz_btn == 1) service @endif" id="example">
    <!--<div class="wcs_button_label">
        Questions? Let's Chat
    </div>  
    <div class="wcs_button wcs_button_circle">
        <span class="fa fa-whatsapp"></span>
    </div>  -->
     <div class="wcs_button @if($pages->buzz_btn == 1) animate-buzz @endif">
        <!-- <span class="fa fa-whatsapp"></span> --><i class="fab fa-whatsapp" style="margin-right : 5px; font-size : 15px"></i>{{$pages->wa_btn_text}}
     </div>  
 
    <div class="wcs_popup"> 
        <div class="wcs_popup_header">
           {!! htmlspecialchars_decode($pages->wa_header) !!}
            <!--<strong>Need Help? Chat with us</strong>
            <br>
            <div class="wcs_popup_header_description">Click one of our representatives below</div>
          -->
        </div>  
        <div class="wcs_popup_person_container">
            <a href="#" data-href="{{env('APP_URL').'/click/wachat/'.$pages->id}}" title="wa" target="_blank" class="txthov link-ajax">
              <!--<div 
                class="wcs_popup_person" >
                data-number="{{$wachat->wa_number}}"
                data-text = "{{$wachat->wa_text}}" --> 
            
                <div class="wcs_popup_person_img"><img src="{{ Storage::disk('s3')->url($wachat->photo) }}" alt=""></div>
                <div class="wcs_popup_person_content">
                    <div class="wcs_popup_person_name">{{$wachat->member_name}}</div>
                    <div class="wcs_popup_person_description">{{$wachat->position}}</div>
                    <!--<div class="wcs_popup_person_status">I'm Online</div>-->
                </div>  
              <!--</div>-->
            </a>
 
            <!--<div 
                class="wcs_popup_person" 
                data-number="+528261708604"
                data-availability='{ "monday":"08:30-18:30", "tuesday":"08:30-18:30", "wednesday":"08:30-18:30", "thursday":"08:30-18:30", "friday":"08:30-18:30" }'
            >
                <div class="wcs_popup_person_img"><img src="img/person_7.jpg" alt=""></div>
                <div class="wcs_popup_person_content">
                    <div class="wcs_popup_person_name">Robert Miller</div>
                    <div class="wcs_popup_person_description">Techincal Support</div>
                    <div class="wcs_popup_person_status">I'm Online</div>
                </div>
            </div>
          -->
        </div>
    </div>

</div>  
 @elseif($pages->enable_chat == 1 && is_null($wachat) && $valid == true)
    <!-- for preview if user hasn't registered yet -->
    <div class="whatsapp_chat_support wcs_fixed_right @if($pages->buzz_btn == 1) service @endif" id="example">
          <div class="wcs_button @if($pages->buzz_btn == 1) animate-buzz @endif">
              <i class="fab fa-whatsapp" style="margin-right : 5px; font-size : 15px"></i>{{$pages->wa_btn_text}}
           </div> 

          <!-- popup -->
          <div class="wcs_popup"> 
              <div class="wcs_popup_header">
                  {!! htmlspecialchars_decode($pages->wa_header) !!}
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
@endif

  <!--Loading Bar-->
  <div class="div-loading">
    <div id="loader" style="display: none;"></div>  
  </div> 
  <div id="script-code" style="display: none;">
  </div> 

<script src="{{asset('js/myScript.js')}}"></script>
<script src="{{asset('assets/whatsapp-chat-support/components/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/whatsapp-chat-support/components/moment/moment-timezone-with-data.min.js')}}"></script>
<script src="{{ asset('assets/whatsapp-chat-support/whatsapp-chat-support.js')}}"></script>
<script defer src="{{asset('js/running_banner.js') }}" ></script>

@if($pages->enable_chat == 1)
<script type="text/javascript">
  $('#example').whatsappChatSupport();
</script>
@endif

<script type="text/javascript">
  var run;
  $('body').css("height",$( window ).height()+"px");

  //MAKE WA BUTTON TO ALWAYS ON CENTER
  function setMargins(classes) {
    width = $(window).width(); 
    containerWidth = $(classes).width();  
    leftMargin = (width-containerWidth)/2;    
    $(classes).css("marginLeft", leftMargin);    
  }

  function setRightPost(classes) {
    var outerWidth = $(classes).outerWidth();
    var ltdefault = 40;
    var gtdefault = 60;

    if(outerWidth < 300)
    {
      $(classes).css("left", -ltdefault+'px');    
    } else {
      $(classes).css("left", -gtdefault+'px');    
    }
  }

/* if user switch another tab , the animation stop, but if return otherwise */
var vis = (function(){
    var stateKey, eventKey, keys = {
        hidden: "visibilitychange",
        webkitHidden: "webkitvisibilitychange",
        mozHidden: "mozvisibilitychange",
        msHidden: "msvisibilitychange"
    };
    for (stateKey in keys) {
        if (stateKey in document) {
            eventKey = keys[stateKey];
            break;
        }
    }
    return function(c) {
        if (c) document.addEventListener(eventKey, c);
        return !document[stateKey];
    }
})();

$(document).ready(function() {
    $(".alert").delay(5000).fadeOut(3000);
    setRightPost(".wcs_popup");
    setMargins(".wcs_fixed_right");

    $(window).resize(function() {
        setMargins(".wcs_fixed_right"); 
        setRightPost(".wcs_popup");   
    });

      //PROOF BACKGROUND --- if is_bio_color = null
    $(".proof-wrapper").css({'background-color':'@if($pages->is_bio_color !== null){{ $pages->bio_color}}@else #fff @endif','color':'@if($pages->is_bio_color !== null){{ $pages->proof_text_color }}@else #000 @endif'})
    // $('.proof-box > .proof-wrapper:gt(1)').css({position:'absolute','top':0,'left':0})
    // $('.proof-box > .proof-wrapper:gt(0)').hide();

    getClientIP();
    runningProof();
    // prevent animation run when user focused on another tab
    vis(function(){
       // document.title = vis() ? 'Visible' : 'Not visible';
       if(vis())
       {
          <?php 
            if($pages->proof_settings !== 0):
          ?>
            runningProof();
          <?php 
            else:
          ?>
            $('.proof-box').removeAttr('style'); 
          <?php
            endif;
          ?>
       }
       else
       {
          clearInterval(run);  
       }
    });
    sendAPIdata();
    sendAPImailchimp();
});

function sendAPImailchimp()
{
  $("#connect_mailchimp").submit(function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    data.push(
      {'name': 'pagename','value':'{{$pages->names}}'}
    );
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'GET',
      data: data,
      url: "{{ url('save-mailchimp') }}",
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

        if(result.success == 0)
        {     
          $(".err_connect_mc").html('<div class="alert alert-danger mb-3">'+result.title+'</div>')
        }
        else if(result.success == 2)
        {
          $(".error").show();
          (result.api_mc_fname !== undefined)? $(".api_mc_fname").html(result.api_mc_fname):$(".api_mc_fname").html('');
          (result.api_mc_lname !== undefined)? $(".api_mc_lname").html(result.api_mc_lname):$(".api_mc_lname").html('');
          (result.api_mc_email !== undefined)? $(".api_mc_email").html(result.api_mc_email):$(".api_mc_email").html('');
          (result.pagename !== undefined)? $(".err_connect_mc").html('<div class="alert alert-danger mb-3">'+result.pagename+'</div>'):$(".err_connect_mc").html('');
        }
        else
        {
           $(".err_connect_mc").html('<div class="alert alert-success mb-3">Thank you for join us.</div>')
           $(".error").hide();
           empty_form();
          
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


function sendAPIdata()
{
  $("#connect_preview").submit(function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    data.push(
      {'name': 'pagename','value':'{{$pages->names}}'}
    );
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      type: 'POST',
      data: data,
      url: "{{ url('save-api') }}",
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
          $(".error").show();
          $(".api_name").html(result.name);
          $(".api_email").html(result.email);
          $(".api_phone").html(result.phone);
          (result.db !== undefined)?  $(".err_connect").html('<div class="alert alert-danger mb-3">'+result.db+'</div>'): $(".err_connect").html('');
        }
        else
        {
           $(".err_connect").html('<div class="alert alert-success mb-3">'+result.response+'</div>')
           $(".error").hide();
           empty_form();
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

function empty_form()
{
  $("#connect_preview input,#connect_mailchimp input").val('');
}

function runningProof()
{
  var complete = null;
  var total = $(".proof-wrapper").length;
  // console.log(total);
  var counting = 0;
  var timing = 9000;

  run = setInterval(
     function(){
      $("#proof-fix").css('margin-top','1rem');
      $('.proof-box').css({'max-width':'420px','height':'138px'}); //make animation stable
      animateProof(counting);
      counting++;
      
      //put php logic according on setting
      <?php 
        if($pages->proof_settings == 0):
      ?>
          if(counting == total)
          {
            setTimeout(function(){
              clearInterval(run);
              $('.proof-wrapper').hide();
              $('.proof-box').removeAttr('style');   
              $("#proof-fix").css('margin-top','3rem'); 
            },8000);  
          }
      <?php
        endif;
      ?>

      if(counting == total)
      {
         counting = 0;    
      }

    }, 
  timing);
}

function animateProof(interval)
{
  var speed = 350;
  var delay = 6650

  $('.proof-wrapper').eq(interval).css({ 'display' : 'inline-flex'}).animate({
      top : 0,
   }, {
    duration : speed,
    complete : function(){
      $(this).delay(delay).fadeOut(function(){
        $(this).css({'top' : '120px'});
      });
    }
  });
}


function getClientIP()
{
  /*$.getJSON("http://api.ipify.org/?format=json", function(e) {
    pointCount(e.ip);
  });*/
  $.ajax({
    type: 'GET',
    url: 'https://api.ipify.org/?format=json',
    dataType:'json',
    success : function(e)
    {
      pointCount(e.ip);
    },
    error:function(xhr,throwable,err)
    {
      pointCount("down");
    }
  })
}

function pointCount(ip)
{
  $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      // Accept : "application/json",
      type: 'POST',
      url: '{{ url("page_point") }}',
      data: {page : '{{$page_name}}',user_id:'{{$user_id}}', ip : ip},
      dataType:'json',
     /* success: function(result) 
      {
        alert(result.msg);
      },*/
      error:function(xhr,throwable,err)
      {
        // console.log(xhr.responseText);
      }
    });
}

</script>

<script type="text/javascript">
  //SCALE BANNER IMAGE
  var w, win;
  var h, hin = 0;

  $(function()
    {
        resize();
    }
  );

  $(window).resize(function()
    {
       resize();
    }
  );

  function resize()
  {
     var cons = 2.17;
     //image banner
     win = $(".banner-image").width();
     hin = win/cons;
     hin = Number(hin.toFixed(1));
     $(".banner-image").height(hin);

     //outside banner
     w = $(".galleryContainer").width();
     w = w + 18
     h = (w/cons) - 18;
     h = h + 0.05;
     h = Number(h.toFixed(1));
     $(".galleryContainer").height(h);
  }

  function call_mylink(linkAjax)
  {
    $.ajax({
      headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      type: 'GET',
      url: linkAjax,
      // data: { id: <?php echo $pages->id; ?>},
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
        // eval(data.script);
        $("#script-code").html(data.script);
        window.location.href=data.link;
        // if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
          // window.location.href=data.link;
        // }
        // else {
          // window.open(data.link);
        // }
      },
      error:function(xhr,throwable,err)
      {
        $('#loader').hide();
        $('.div-loading').removeClass('background-load');
        console.log(xhr.responseText);
        alert('Ada yang salah dengan penggunaan link atau username,\nmohon diperiksa lagi.');
      }
    });
  }
  
  function check_outlined(){
      <?php 
      if($pages->is_outlined) { ?>  
        $(".mobile1").addClass("outlinedview");
        $('.outlined').val(1);

        $('.txthov').find("button").css("background-color","transparent");
        <?php if(!$pages->is_text_color) { ?>  
          $('.txthov').find("button").css("border-color","<?php echo $pages->outline ?>");
          $('.txthov').find("button").css("color","<?php echo $pages->outline ?>");
        <?php } else { ?>  
          // $('.txthov').find("button").css("border-color","<?php echo $pages->text_color ?>");
          $('.txthov').find("button").css("border-color","<?php echo $pages->outline ?>");
          $('.txthov').find("button").css("color","<?php echo $pages->text_color ?>");
        <?php } ?>  
      <?php } 
      else { ?>  
        $(".mobile1").removeClass("outlinedview");
        $('.outlined').val(0);

        $('.txthov').find("button").css("background-color","<?php echo $pages->rounded ?>");
        $('.txthov').find("button").css("border-color","transparent");
        <?php if(!$pages->is_text_color) { ?>  
          $('.txthov').find("button").css("color","<?php echo $pages->outline ?>");
        <?php } else { ?>  
          $('.txthov').find("button").css("color","<?php echo $pages->text_color ?>");
        <?php } ?>  
      <?php 
      } ?>  

      <?php 
      if($pages->is_bio_color) { ?>  
        $('.header-txt').css("color","<?php echo $pages->bio_color; ?>");
        $('#icon-sosmed li a').css("color","<?php echo $pages->bio_color; ?>");
        $('.powered-omnilinks a').css("color","<?php echo $pages->bio_color; ?>");
        
      <?php 
      } ?>  

    @if((!is_null($pages->wallpaper))||(!is_null($pages->gif_template)))
      <?php 
      if(!$pages->is_outlined) { ?>  
        $('.txthov').find("button").css("border-color",template.button_color);
        $('.txthov').find("button").css("background-color",template.button_color);
        $('.txthov').find("button").css("color",template.font_button_color);
      <?php 
      } ?>  
      <?php 
      if(!$pages->is_text_color) { ?>  
        $('.txthov').find("button").css("color",template.font_button_color);
      <?php 
      } else {?>  
      $('.txthov').find("button").css("color","<?php echo $pages->text_color ?>");
      <?php 
      } ?>  
      <?php 
      if(!$pages->is_bio_color) { ?>  
        $('.header-txt').css("color",template.bio_font_color);
        $('#icon-sosmed li a').css("color",template.bio_font_color);
        $('.powered-omnilinks a').css("color",template.bio_font_color);
      <?php 
      } ?>  
      
    @endif
  }

  $(document).ready(function() {
    <?php 
    $dt1 = Carbon::createFromFormat('Y-m-d H:i:s', $valid_until);
    $dt2 = Carbon::now();
    if ( ($membership=='free') && ($dt2->gt($dt1)) ) {
    ?>
      $('#modal-freetrial-expired').modal({
        backdrop: 'static',
        keyboard: false
      });
    <?php } ?>
    
    initGallery();
    @if((!is_null($pages->wallpaper))||(!is_null($pages->gif_template)))
      res = $("body").attr("class");
      res = res.replace("animation-", "");
      //default value 
      template = {
        "id": 1,
        "theme": "wallpaper1",
        "bio_font_color": "#122B74",
        "button_color": "#122B74",
        "font_button_color": "#FFFFFF",
        "button_hover_color": "#081F66"
      };
      //cek ada ngga di json
      $.each( templates, function( key, value ) {
        if (res == value.theme) {
          template = value;
          $('.txthov').find("button").css("border-color",value.button_color);
          $('.txthov').find("button").css("background-color",value.button_color);
          $('.txthov').find("button").css("color",value.font_button_color);
          $('.header-txt').css("color",value.bio_font_color);
          $('#icon-sosmed li a').css("color",value.bio_font_color);
          $('.powered-omnilinks a').css("color",value.bio_font_color);
          // check_outlined();
        }
      });
    @endif
    
    <?php if($pages->is_rounded) {?>
      $(".btn").not("#not-btn").addClass("btn-rounded");
    <?php } ?>

    <?php if($pages->is_outlined) {?>
      $(".btn").not("#not-btn").addClass("btn-outlined");
      $('#icon-sosmed li a').css("color","<?php echo $pages->outline; ?>");
    <?php } else { ?>
      $('#icon-sosmed li a').css("color","#fff");
    <?php }  ?>

    <?php if (!is_null($pages->rounded)) { ?>
      $('.btn').not("#not-btn").css("background-color","<?php echo $pages->rounded; ?>");
    <?php } ?>

    <?php if (!is_null($pages->outline)) { ?>
      $('.btn').not("#not-btn").css("border-color","<?php echo $pages->outline; ?>");
    <?php } ?>
    
    check_outlined();
    $(".txthov").hover(
      function() {
        check_outlined();
        @if((!is_null($pages->color_picker)) || (!is_null($pages->template)))
          temp1 = $(this).find("button").css("color");
        @elseif((!is_null($pages->wallpaper))||(!is_null($pages->gif_template)))
          temp1 = template.button_hover_color; //pake warna hover
        @endif
        temp2 = $("body").css("background-color");
        
        <?php if (!$pages->is_text_color) { ?>
        
          $(this).find("button").css("background-color",temp1);
          @if((!is_null($pages->color_picker)) || (!is_null($pages->template)))
            $(this).find("button").css("color",temp2);
          @endif
        <?php }else { ?>
          $(this).find("button").css("background-color","<?php echo $pages->text_color; ?>");
          @if((!is_null($pages->color_picker)) || (!is_null($pages->template)))
            $(this).find("button").css("color",temp2);
          @else
            $(this).find("button").css("color",temp2);
          @endif
        <?php } ?>
      }, function() {
        check_outlined();
      }
    ); 
    $("body").on("click",".txthov",function(){
        $(this).unbind('mouseenter mouseleave');
    });
    
    moveSlide(0);
    @if(!is_null($pages->description))
    tempStr = $("#hidden-description").val().replace(/\n/g, "<br>");
    $("#description").html(tempStr);
    @endif
    
    // $('#close-ads').click(function(e){
    $(".fixed-ads").on('click', '#close-ads', function () {      
      console.log("asd");
      $(".fixed-ads").hide();
    });
    
    $("body").on("click",".link-ajax",function(e){
      e.preventDefault();
      linkAjax = $(this).attr('data-href');
      call_mylink(linkAjax);
    });
    
    $('body').on('click','.imageHolder', function(e) {
      var url = urlbanner[slideIndex];
      call_mylink(url);
    });
    
    $("body").on("click",".link-ajax-no-script",function(e){
      e.preventDefault();
      $('#loader').show();
      $('.div-loading').addClass('background-load');
      window.location.href=$(this).attr('data-href');
    });

  });
  if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
    // some code..
    $("a").removeAttr("target");
  }
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-81228145-7"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-81228145-7');
</script>

</body>
</html>