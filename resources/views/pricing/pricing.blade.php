@extends('layouts.app')
@section('content')
<link href="{{ asset('css/style-pricing.css') }}" rel="stylesheet">
<script src="{{ asset('js/custom.js') }}"></script>
<section class="page-title">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Omnilinkz</h1>
        <hr class="orn">
        <p class="pg-title">Pilih paket Omnilinkz </p>
        <div class="row" align="center">
          <div class="col-12">
            <div class="onoffswitch">
              <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked="checked">
              <label class="onoffswitch-label" for="myonoffswitch">
                <span class="onoffswitch-inner" data-id="1"></span>
                <span class="onoffswitch-switch"></span>
              </label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="comparison">
  <table>
    <thead>
      <tr>
        <th class="tl ">
        </th>
        <th class="qbse compare-heading ">
          FREE TRIAL
        </th>
        <th class="qbse compare-heading ">
          PRO
        </th>
        <th class="qbse compare-heading ">
          PREMIUM
        </th>
      </tr>
      <tr class="">
        <th class="price-info ">
          <div class="price-now features">
            <span>Features</span>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span>0,-</span></div>
          <div>
            <a href="{{url('register')}}">
              <button type="submit" class="btn btn-default btn-primary-free">
                SELECT
              </button>
            </a>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span class="nprice price_pro">197,000,-</span></div>

          <div class="monthly-button">
            <a href="{{url('checkout/1')}}">
              <button class="btn select-price btn-default btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/2')}}">
              <button class="btn select-price btn-default btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </th>
        <th class="price-info ">
          <div class="price-now"><span class="nprice price_premium">297,000,-</span></div>

          <div class="monthly-button">
            <a href="{{url('checkout/3')}}">
              <button class="btn btn-default select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/4')}}">
              <button class="btn btn-default select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Omnilinkz
          <span class="tooltipstered" title="Omnlinkz">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Omnilinkz
          <span class="tooltipstered" title="Omnilinkz">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">1</span></td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td></td>
        <td colspan="3">
          Single Link
          <span class="tooltipstered" title="Single Link">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Single Link
          <span class="tooltipstered" title="Single Link">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">2</span></td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Clicks /Hari
          <span class="tooltipstered" title="Clicks /Hari">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Clicks /Hari
          <span class="tooltipstered" title="Clicks /Hari">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">10</span></td>
        <td><span class="tickblue">Unlimited</span></td>
        <td><span class="tickblue">Unlimited</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Profile Image
          <span class="tooltipstered" title="Profile Image">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Profile Image
          <span class="tooltipstered" title="Profile Image">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Store Brand
          <span class="tooltipstered" title="Store Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Store Brand
          <span class="tooltipstered" title="Store Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Banner Promo
          <span class="tooltipstered" title="Banner Promo">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Banner Promo
          <span class="tooltipstered" title="Banner Promo">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">1</span></td>
        <td><span class="tickblue">5</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Click to WA Creator
          <span class="tooltipstered" title="Click to WA Creator">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Click to WA Creator
          <span class="tooltipstered" title="Click to WA Creator">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Whatsapp
          <span class="tooltipstered" title="Whatsapp">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          Whatsapp
          <span class="tooltipstered" title="Whatsapp">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          FB Messenger
          <span class="tooltipstered" title="FB Messenger">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr class="compare-row">
        <td>
          FB Messenger
          <span class="tooltipstered" title="FB Messenger">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Line
          <span class="tooltipstered" title="Line">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Line
          <span class="tooltipstered" title="Line">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Skype
          <span class="tooltipstered" title="Skype">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Skype
          <span class="tooltipstered" title="Skype">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          WeChat
          <span class="tooltipstered" title="WeChat">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          WeChat
          <span class="tooltipstered" title="WeChat">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Telegram
          <span class="tooltipstered" title="Telegram">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Telegram
          <span class="tooltipstered" title="Telegram">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          FB Pixel
          <span class="tooltipstered" title="FB Pixel">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          FB Pixel
          <span class="tooltipstered" title="FB Pixel">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Google Retargetting
          <span class="tooltipstered" title="Google Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Google Retargetting
          <span class="tooltipstered" title="Google Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Twitter Retargetting
          <span class="tooltipstered" title="Twitter Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Twitter Retargetting
          <span class="tooltipstered" title="Twitter Retargetting">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Google Analytics
          <span class="tooltipstered" title="Google Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Google Analytics
          <span class="tooltipstered" title="Google Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Priority Support
          <span class="tooltipstered" title="Priority Support">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Priority Support
          <span class="tooltipstered" title="Priority Support">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Themes
          <span class="tooltipstered" title="Themes">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Themes
          <span class="tooltipstered" title="Themes">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="tickblue">5</span></td>
        <td><span class="tickblue">50</span></td>
        <td><span class="tickblue">50</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Hide Omnilinkz Brand
          <span class="tooltipstered" title="Hide Omnilinkz Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Hide Omnilinkz Brand
          <span class="tooltipstered" title="Hide Omnilinkz Brand">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">
          Report Analytics
          <span class="tooltipstered" title="Report Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
      </tr>
      <tr>
        <td>
          Report Analytics
          <span class="tooltipstered" title="Report Analytics">
            <i class="fas fa-question-circle fonticon"></i>
          </span>
        </td>
        <td><span class="cross">&#10060;</span></td>
        <td><span class="tickblue">&check;</span></td>
        <td><span class="tickblue">&check;</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="3">Buy Now</td>
      </tr>
      <tr>
        <td></td>
        <td>
          <div>
            <a href="{{url('register')}}">
              <button class="btn btn-default select-price btn-primary-free" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
        <td>
          <div class="monthly-button">
            <a href="{{url('checkout/1')}}">
              <button class="btn select-price btn-success btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/2')}}">
              <button class="btn select-price btn-success btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
        <td>
          <div class="monthly-button">
            <a href="{{url('checkout/3')}}">
              <button class="btn btn-success select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
          <div class="yearly-button">
            <a href="{{url('checkout/4')}}">
              <button class="btn btn-success select-price btn-primary-prc" data-package="1">
                SELECT
              </button>
            </a>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection