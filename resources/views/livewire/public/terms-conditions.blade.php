<div>
    <style>
        .content-description img {
            width: 100% !important;
            height: auto !important;

        }
    </style>
    <main id="content" role="main" class="px-9 content-description">
        @php
            $termsNCondition =
                defined('system_config') && isset(system_config['termsNCondition'])
                    ? system_config['termsNCondition']['value']
                    : '';
        @endphp

        {!! $termsNCondition !!}
    </main>
</div>
