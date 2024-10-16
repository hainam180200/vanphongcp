@if (setting('sys_intro_text_desktop') != '')
  <section>
    <div class="container">
        <div class="flash-sales box-home">
          <div class="content ">
            <div class="_text_index hidetext">
              {!! setting('sys_intro_text_desktop') !!}
            </div>
            <span class="viewmore" style="text-align: right">Xem tất cả »</span>       
          </div>
        </div>
    </div>
  </section>
  <style type="text/css">
    @media  only screen and (max-width: 580px) {
        .hidetext {
          max-height: 220px;
          overflow: hidden;
        }
    }
    @media  only screen and (min-width: 580px) {
        .hidetext {
          max-height: 220px;
          overflow: hidden;
        }
    }
    ._text_index{
        padding: 15px 0px !important;
    }
    .showtext {
        max-height:initial;
    }
    .viewless,.viewmore{
        display: block;
        cursor: pointer;
        color: #000;
        padding-top: 10px;
        font-size: 16px;
    }
  </style>
  <script type="text/javascript">
    $('body').delegate('.viewmore','click',function(){
        $(this).addClass('viewless').removeClass('viewmore');
        $(this).text('« Thu gọn');
        $('.hidetext').addClass('showtext').removeClass('hidetext');
    })
    $('body').delegate('.viewless','click',function(){
        $(this).addClass('viewmore').removeClass('viewless');
        $(this).text('Xem tất cả »');
        $('.showtext').addClass('hidetext').removeClass('showtext');
    })
  </script>
@endif