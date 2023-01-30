<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light-style customizer-hide" dir="ltr"
    data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    @include('components.style')
    @livewireStyles
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('components.aside')

            <div class="layout-page">
                @include('components.navbar')

                <div class="content-wrapper">
                    {{ isset($slot) ? $slot : '' }}
                    @yield('content')

                    @include('components.footer')
                    <div class="content-backdrop fade"></div>
                </div>
            </div>

        </div>



        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>


    @include('components.script')
    @yield('scripts')
    @livewireScripts
    @stack('scripts')
</body>

</html>
