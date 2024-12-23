@include('partials.navbar')
        <main class="py-4">
            <div class="extra-side-bar col-md-9">
                @include('partials.messages')
            </div>
            @yield('content')
        </main>
    </div>

    <script data-host="https://analytics.cloudservice.co.tz/public" data-dnt="false" src="https://analytics.cloudservice.co.tz/js/script.js" id="ZwSg9rf6GA" async defer></script>
    @livewireScripts
</body>
</html>
