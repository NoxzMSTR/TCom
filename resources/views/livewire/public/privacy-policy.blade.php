<div>
    <style>
        .content-description img {
            width: 100% !important;
            height: auto !important;

        }
    </style>
    <main id="content" role="main" class="px-9 content-description">
        @php
            $privacyPolicy =
                defined('system_config') && isset(system_config['privacyPolicy'])
                    ? system_config['privacyPolicy']['value']
                    : '';
        @endphp

        {!! $privacyPolicy !!}
    </main>
</div>
