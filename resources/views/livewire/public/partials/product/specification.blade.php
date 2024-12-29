<div class="tab-pane fade" id="product-specs-tab" role="tabpanel" aria-labelledby="product-specs-tab">
    <div class="mx-md-5 pt-1">
        <div class="table-responsive mb-4">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <th class="px-4 px-xl-5 border-top-0">Weight</th>
                        <td class="border-top-0">{{ $product->weight }} kg</td>
                    </tr>
                    <tr>
                        <th class="px-4 px-xl-5">Dimensions</th>
                        <td>{{ $product->length }} x {{ $product->width }} x {{ $product->height }} cm</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @php
            $specification = [];
            foreach ($product->specification as $key => $value) {
                $specification[$value['title']]['title'] = $value['title'];
                $specification[$value['title']]['data'][] = ['name' => $value['key'], 'value' => $value['value']];
            }
        @endphp
        @foreach ($specification as $key => $spec)
            <h3 class="font-size-18 mb-4">{{ $spec['title'] }}</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody>
                        @foreach ($spec['data'] as $key => $value)
                            <tr>
                                <th class="px-4 px-xl-5 border-top-0">{{ $value['name'] }}</th>
                                <td class="border-top-0">{{ $value['value'] }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endforeach

    </div>
</div>
