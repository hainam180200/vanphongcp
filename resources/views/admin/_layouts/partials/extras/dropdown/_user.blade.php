@if (config('layout', 'extras/user/dropdown/style') == 'light')
    {{-- Header --}}
    <div class="d-flex align-items-center p-8 rounded-top">
        {{-- Symbol --}}
        <div class="symbol symbol-md bg-light-primary mr-3 flex-shrink-0">
            <img src="{{ asset('assets/backend/themes/media/users/300_21.jpg') }}" alt=""/>
        </div>

        {{-- Text --}}
        <div class="text-dark m-0 flex-grow-1 mr-3 font-size-h5">Sean Stone</div>
        <span class="label label-light-success label-lg font-weight-bold label-inline">3 messages</span>
    </div>
    <div class="separator separator-solid"></div>
@else
    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between flex-wrap p-8 bgi-size-cover bgi-no-repeat rounded-top" style="background-image: url('{{ asset('assets/backend/themes/media/misc/bg-1.jpg') }}')">
        <div class="d-flex align-items-center mr-2">
            {{-- Symbol --}}
            <div class="symbol bg-white-o-15 mr-3">
                <span class="symbol-label text-success font-weight-bold font-size-h4">{{strtoupper(substr(auth()->user()->username, 0, 1))}}</span>
            </div>

            {{-- Text --}}
            <div class="text-white m-0 flex-grow-1 mr-3 font-size-h5">
                <p class="m-1">{{auth()->user()->username}}</p>
                <p class="m-1" style="color:#bebfcc;">{{auth()->user()->email}}</p>
                <p class="m-1">{{number_format(auth()->user()->balance , 0, ',', '.')}} VNĐ</p>
            </div>
        </div>
        {{--<span class="label label-success label-lg font-weight-bold label-inline">3 messages</span>--}}
    </div>
@endif

{{-- Nav --}}
<div class="navi navi-spacer-x-0 pt-5">
    {{-- Item --}}
    <a href="{{route('admin.profile')}}" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-calendar-3 text-success"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    {{__('Hồ sơ của tôi')}}
                </div>
                <div class="text-muted">
                    {{__('Thiết lập thông tin cá nhân')}}
                    {{--<span class="label label-light-danger label-inline font-weight-bold">update</span>--}}
                </div>
            </div>
        </div>
    </a>

    {{-- Item --}}
    {{--<a href="#"  class="navi-item px-8">--}}
    {{--    <div class="navi-link">--}}
    {{--        <div class="navi-icon mr-2">--}}
    {{--            <i class="flaticon2-mail text-warning"></i>--}}
    {{--        </div>--}}
    {{--        <div class="navi-text">--}}
    {{--            <div class="font-weight-bold">--}}
    {{--                My Messages--}}
    {{--            </div>--}}
    {{--            <div class="text-muted">--}}
    {{--                Inbox and tasks--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</a>--}}

    {{-- Item --}}
    <a href="#"  class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon2-rocket-1 text-danger"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">

                    {{__('Lịch sử hoạt động')}}
                </div>
                <div class="text-muted">
                    {{__('Lưu trữ truy cập của tài khoản')}}

                </div>
            </div>
        </div>
    </a>

    {{-- Item --}}
    <a href="#" class="navi-item px-8">
        <div class="navi-link">
            <div class="navi-icon mr-2">
                <i class="flaticon-interface-1 text-primary"></i>
            </div>
            <div class="navi-text">
                <div class="font-weight-bold">
                    {{__('Đổi mật khẩu')}}
                </div>
                <div class="text-muted">
                    {{__(' Bảo mật đăng nhập tài khoản')}}
                </div>
            </div>
        </div>
    </a>

    {{-- Footer --}}
    <div class="navi-separator mt-3"></div>
    <div class="navi-footer  px-8 py-5">
        <a href="#" target="_blank" class="btn btn-light-primary font-weight-bold"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{__('Đăng xuất')}}</a>

        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        {{--<a href="#" target="_blank" class="btn btn-clean font-weight-bold">Upgrade Plan</a>--}}
    </div>
</div>
