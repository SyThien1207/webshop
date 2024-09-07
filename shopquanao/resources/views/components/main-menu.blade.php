
<div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
    <div class="container">
        <nav class="main-nav w-100">
            <ul class="menu">
                <li class="active">
                    <a href="{{route('home.index')}}">Home</a>
                </li>
                @foreach ( $listmenu as $rowmenu )
                <x-main-menu-item :rowmenu="$rowmenu" />
                @endforeach
                <li class="float-right"><a href="{{route('contact.index')}}" rel="noopener" class="pl-5" target="_blank">Liên hệ</a></li>
                <li class="float-right"><a href="#" class="pl-5">Special Offer!</a></li>
            </ul>
        </nav>
    </div>
</div>