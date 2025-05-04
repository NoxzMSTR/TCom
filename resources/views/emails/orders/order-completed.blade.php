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

            $email = isset(system_config['email']['value']) ? system_config['email']['value'] : '';

            $phone = isset(system_config['phone']['value']) ? system_config['phone']['value'] : '';

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
            <p id="izfri" style="box-sizing: border-box;">Dear {{ $order->userFirstName }}
                {{ $order->userLastName }},
            </p>
            <p id="i2ki9" style="box-sizing: border-box;">
                We’re pleased to let you know that your order #{{ $order->invoiceNo }}, placed on
                <strong>{{ $order->orderDate }}</strong>, has been successfully completed and delivered.
            </p>
            <h3 style="margin-top: 20px; font-family: Arial, sans-serif;">Order Summary:</h3>

            @php
                $total = 0;
            @endphp

            <div style="padding: 0 15px; font-family: Arial, sans-serif;">
                <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-collapse: collapse;">
                    @foreach ($order->items as $key => $item)
                        <tr style="border-bottom: 1px solid #eee;">
                            <td style="padding: 10px 0; width: 60px;">
                                <img src="{{ $item->product->thumbnail }}" alt="HP Laptop Charger"
                                    style="width: 55px; border-radius: 4px; display: block;">
                            </td>
                            <td style="padding: 10px 10px 10px 0; vertical-align: top;">
                                <strong style="font-size: 14px; display: block;">
                                    {{ $item->name ?: $item->product->name }}</strong>
                                <br>
                                <small>
                                    <strong class="product-quantity" style="font-size: 14px; color: #333;"> QTY
                                        {{ $item->qty }}
                                    </strong>
                                </small>
                            </td>
                            <td> {{ currency_format($item->amount, default_currency) }}</td>
                        </tr>
                        @php
                            $total += $item->amount * $item->qty;
                        @endphp
                    @endforeach

                </table>

                <table width="100%" cellpadding="0" cellspacing="0" border="0"
                    style="margin-top: 20px; font-size: 14px; border-collapse: collapse;">
                    <tr>
                        <td style="padding: 5px 0;"><strong>Subtotal:</strong></td>
                        <td style="padding: 5px 0; text-align: right;"> {{ currency_format($total, default_currency) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0;"><strong>Shipping:</strong></td>
                        <td style="padding: 5px 0; text-align: right;">
                            {{ ORDER_PAYMENT_METHOD[$order->paymentMethod] }}</td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 0;"><strong>Total:</strong></td>
                        <td style="padding: 5px 0; text-align: right; font-weight: bold;">
                            {{ currency_format($total, default_currency) }}</td>
                    </tr>
                </table>
            </div>

            <p id="iqc2c" style="box-sizing: border-box;">We appreciate your trust in us and hope the product(s) met
                your expectations. If you have any feedback or need assistance, our support team is always here to help.

                Here is the link to shop for more future product(s):
            </p>
            <a href="{{ route('public.home') }}" id="i1tbj" target="_blank" class="button"
                style="box-sizing: border-box; display: inline-block; padding-top: 10px; padding-right: 20px; padding-bottom: 10px; padding-left: 20px; margin-top: 20px; margin-right: 0px; margin-bottom: 20px; margin-left: 0px; background-color: rgb(0, 123, 255); color: rgb(255, 255, 255); text-decoration-line: none; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">Shop
                Now</a>

        </div>
        <div id="ivrt9" class="footer"
            style="text-align: center; box-sizing: border-box; background-color: rgb(244, 244, 244); padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; font-size: 12px; color: rgb(119, 119, 119);">
            <p>If you have any questions or concerns, feel free to reach out to our support team at <a
                    href="mailto:{{ $email }}k">{{ $email }}</a> or whatsapp us at
                <strong>{{ $phone }}</strong>.
            </p>

            <p>Thank you for shopping with <strong>{{ $name }}</strong>! We appreciate your business.</p>
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
