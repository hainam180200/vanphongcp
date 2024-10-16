<div class="sidebar">
    <nav class="global">
        <div class="user-info">
            <div class="user-avatar">
                @if(isset(Auth::guard('frontend')->user()->image))
                    <div class="no-avt">
                        <img src="{{ isset(Auth::guard('frontend')->user()->image)?\App\Library\Files::media(Auth::guard('frontend')->user()->image): null }}" />
                    </div>
                @else
                    <div class="no-avt">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>



            @if(!auth()->guard('frontend')->check())
                <div class="user-name">
                    <p><a href="/login"><strong>Đăng nhập</strong></a></p>
                    <p><i>Đăng nhập để nhận nhiều ưu đãi</i></p>
                </div>
            @else
                <div class="user-name">
                    <p><a href="/logout"><strong>Đăng xuất</strong></a></p>
                </div>
            @endif

        </div>


        {!! widget('frontend.widget.mobile._menu') !!}


    </nav>

    <div class="close">
        <a href="javascript:;" id="closeMenu">
            <span></span>
            <span></span>
        </a>
    </div>
</div>
