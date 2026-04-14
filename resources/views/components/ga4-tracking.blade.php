@if(config('services.ga_measurement_id'))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('services.ga_measurement_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ config('services.ga_measurement_id') }}', { send_page_view: false });
    </script>
@endif

