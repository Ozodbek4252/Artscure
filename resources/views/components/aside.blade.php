<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ Route('dashboard') }}" class="app-brand-link">
            {{--  <img src="../../assets/img/avatars/1.png" alt
                                                    class="w-px-40 h-auto rounded-circle" />  --}}
            {{--  <img src="../../assets/img/logo/ArtsCure.png" alt="Frest" class="app-brand-logo demo">  --}}
            <img src="{{ asset('assets/img/logo/ArtsCure.png') }}" alt="Frest" class="app-brand-logo demo">

        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'currencies') active @endif
        ">
            <a href="{{ Route('currencies.index') }}" class="menu-link">
                <i class="menu-icon fa-regular fa-dollar-sign"></i>
                <div>{{ __('dash-sidebar.Currency') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'paymentTypes') active @endif
        ">
            <a href="{{ Route('paymentTypes.index') }}" class="menu-link">
                <i class="menu-icon fa-regular fa-dollar-sign"></i>
                <div>{{ __('dash-sidebar.Payment Types') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'categories') active @endif
        ">
            <a href="{{ Route('categories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Categories') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'types') active @endif
        ">
            <a href="{{ Route('types.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Types') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'tools') active @endif
        ">
            <a href="{{ Route('tools.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Tools') }}</div>
            </a>
        </li>



        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'artists') active @endif
        ">
            <a href="{{ Route('artists.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-group'></i>
                <div>{{ __('dash-sidebar.Artists') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'products') active @endif
        ">
            <a href="{{ Route('products.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-layer'></i>
                <div>{{ __('dash-sidebar.Products') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'orders') active @endif
        ">
            <a href="{{ Route('orders.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bx-spreadsheet'></i>
                <div>{{ __('dash-sidebar.Orders') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'helps') active @endif
        ">
            <a href="{{ Route('helps.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Call backs') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'requests') active @endif
        ">
            <a href="{{ Route('requests.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Sellers') }}</div>
            </a>
        </li>

        <li class="menu-item
        @if (explode('.', \Request::route()->getName())[0] == 'contacts') active @endif
        ">
            <a href="{{ Route('contacts.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div>{{ __('dash-sidebar.Services') }}</div>
            </a>
        </li>

        <li class="menu-item
            @if (explode('.', \Request::route()->getName())[0] == 'news' ||
                    explode('.', \Request::route()->getName())[0] == 'newsCategory') active @endif
            ">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-food-menu"></i>
                <div>{{ __('dash-sidebar.News') }}</div>
            </a>
            <ul class="menu-sub">
                <li
                    class="menu-item
                    @if (explode('.', \Request::route()->getName())[0] == 'newsCategory') active @endif
                ">
                    <a href="{{ Route('newsCategory.index') }}" class="menu-link">
                        <div>{{ __('dash-sidebar.Categories') }}</div>
                    </a>
                </li>
                <li
                    class="menu-item
                    @if (explode('.', \Request::route()->getName())[0] == 'news') active @endif
                ">
                    <a href="{{ Route('news.index') }}" class="menu-link">
                        <div>{{ __('dash-sidebar.News') }}</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-item
            @if (explode('.', \Request::route()->getName())[0] == 'banners') active @endif
            ">
            <a href="{{ Route('banners.index') }}" class="menu-link">
                <i class="menu-icon fa-regular fa-image"></i>
                <div>{{ __('dash-sidebar.Banners') }}</div>
            </a>
        </li>

    </ul>
</aside>
