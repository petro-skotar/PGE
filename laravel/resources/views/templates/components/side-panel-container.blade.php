  <div class="side-panel-body-overlay"></div>

  <div id="side-panel-container" class="dark" data-tm-bg-img="{{ asset('templates/pgeconstruction/images/side-push-bg.jpg') }}">
    <div class="side-panel-wrap">
      <div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="fa fa-times side-panel-trigger-icon"></i></a></div>
      <img class="logo mb-40" style="max-width:200px;" src="{{ asset('templates/pgeconstruction/images/logo-wide@2x.png') }}" alt="Logo">
      {!! $HOME->details_one->content !!}


      <div class="widget">
        <h5 class="widget-title widget-title-line-bottom line-bottom-theme-colored1">Contact Info</h5>
        <div class="tm-widget-contact-info contact-info-style1 contact-icon-theme-colored1">
          <ul>
            <li class="contact-name">
              <div class="icon"><i class="flaticon-contact-037-address"></i></div>
              <div class="text">Ray Pedersen</div>
            </li>
            <li class="contact-phone">
              <div class="icon"><i class="flaticon-contact-042-phone-1"></i></div>
              <div class="text"><a href="tel:{{Str::of($SETTING['contact_phone']['val'])->replace([' ','(',')','-'], '')}}">{!! $SETTING['contact_phone']['val'] !!}</a></div>
            </li>
            <li class="contact-email">
              <div class="icon"><i class="flaticon-contact-043-email-1"></i></div>
              <div class="text"><a href="mailto:{!! $SETTING['contact_email']['val'] !!}">{!! $SETTING['contact_email']['val'] !!}</a></div>
            </li>
            <li class="contact-address">
              <div class="icon"><i class="flaticon-contact-047-location"></i></div>
              <div class="text">{!! $SETTING['contact_address']['val'] !!}</div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
