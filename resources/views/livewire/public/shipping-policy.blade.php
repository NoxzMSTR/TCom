<div>
    <style>
        .content-description img {
            width: 100% !important;
            height: auto !important;

        }
    </style>
    <main id="content" role="main" class="px-9 content-description">
        @php
            $shipPolicy =
                defined('system_config') && isset(system_config['shipPolicy'])
                    ? system_config['shipPolicy']['value']
                    : '';
        @endphp

        {!! $shipPolicy !!}
    </main>
</div>
