<body
    style="box-sizing: border-box; margin: 0; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px;">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}
    </title>
    <div id="itlo" class="container"
        style="box-sizing: border-box; width: 100%; max-width: 600px; margin-top: 20px; margin-right: auto; margin-bottom: 20px; margin-left: auto; background-color: rgb(255, 255, 255); border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(221, 221, 221); border-right-color: rgb(221, 221, 221); border-bottom-color: rgb(221, 221, 221); border-left-color: rgb(221, 221, 221); border-image-source: initial; border-image-slice: initial; border-image-width: initial; border-image-outset: initial; border-image-repeat: initial; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; overflow-x: hidden; overflow-y: hidden; display: block;">
        @php
            $logo = isset(system_config['logoLight']['value'])
                ? system_config['logoLight']['value']
                : asset('mAssets/media/logos/logo.jpg');
            $name = isset(system_config['name']['value']) ? system_config['name']['value'] : '';
            $headingColor = null;
            $textColor = null;
            $sTextColor = null;
            $borderColor = null;
            $backgroundColor = null;
            $contentColor = null;
            $cardColor = null;

            if (defined('system_config')) {
                $headingColor = isset(system_config['color.heading']) ? system_config['color.heading']->value : null;
                $textColor = isset(system_config['color.text']) ? system_config['color.text']->value : null;
                $sTextColor = isset(system_config['color.secondaryText'])
                    ? system_config['color.secondaryText']->value
                    : null;
                $borderColor = isset(system_config['color.border']) ? system_config['color.border']->value : null;
                $backgroundColor = isset(system_config['color.background'])
                    ? system_config['color.background']->value
                    : null;
                $contentColor = isset(system_config['color.content']) ? system_config['color.content']->value : null;
                $cardColor = isset(system_config['color.card']) ? system_config['color.card']->value : null;
            }

        @endphp
        <div id="izda" class="header"
            style="box-sizing: border-box; background-color: rgba(255, 87, 51, 0); color: rgb(0, 0, 0); padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; text-align: center; text-decoration-line: none; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;">
            <img id="i2q16" src="{{ $logo }}" width="160"
                style="box-sizing: border-box; width: 160px; text-align: center;">
        </div>
        <div id="isph" class="content"
            style="text-align: center; box-sizing: border-box; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; line-height: 1.6;">
            <p id="izfri" style="box-sizing: border-box;">Dear {{ $user->name }},
            </p>
            <p id="i2ki9" style="box-sizing: border-box;">We noticed you’re trying to sign in to your account. To
                ensure the security of your information,
            </p>
            <p id="iqc2c" style="box-sizing: border-box;">please confirm your sign-in request by clicking the button
                below:
            </p>
            <a href="{{ $forwardurl }}" id="i1tbj" target="_blank" class="button"
                style="box-sizing: border-box; display: inline-block; padding-top: 10px; padding-right: 20px; padding-bottom: 10px; padding-left: 20px; margin-top: 20px; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; background-color: {{ $contentColor }}; color: rgb(255, 255, 255); text-decoration-line: none; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">Sign
                In Now</a>
            <p id="ipoex" style="box-sizing: border-box;">If you didn’t request this sign-in, please ignore this
                email. Your account remains secure.
            </p>
            <p id="iwtts" style="box-sizing: border-box;">Thank you for your understanding.
            </p>
        </div>
        <div id="ivrt9" class="footer"
            style="text-align: center; box-sizing: border-box; background-color: rgb(244, 244, 244); padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; font-size: 12px; color: rgb(119, 119, 119);">
            <p id="ippec" style="box-sizing: border-box;">Best regards,<br>The {{ $name }} Team
            </p>
        </div>
    </div>
</body>
<style>
    @media only screen and (max-width: 600px) {
        .container {
            width: 100%;
        }
    }
</style>
