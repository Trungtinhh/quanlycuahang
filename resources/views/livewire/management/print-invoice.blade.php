<div>
    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 12px;
        }

        .content {
            background-color: white;
        }

        .list-product td {
            border: 1px solid black;
            padding: 7px;
        }
    </style>
    <div class="content">
        <table style="width: 100%;">
            <tr>
                <th rowspan='5' style="width: 20%; text-align:center;">
                    <img src="{{ public_path('logo_invoice.jpg') }}" style="height: 100px">
                </th>
                <th rowspan='5' style="width: 5%;">
                </th>
                <td>
                    <h3>CÔNG TY TNHH VẬT TƯ THIẾT BỊ Y TẾ VIỆT HẢI</h3>
                </td>
            </tr>
            <tr>
                <td><a>Mã số thuế: {{ $tax_code }}</a></td>
            </tr>
            <tr>
                <td><a>Địa chỉ: {{ $address }} </a></td>
            </tr>
            <tr>
                <td><a>Điện thoại: 0{{ $phone }} </a></td>
            </tr>
        </table>
        <table style="width: 100%;">
            <tr style="text-align:center;">
                <th>
                    <h2 style="text-align: center;">HÓA ĐƠN BÁN HÀNG</h2>
                </th>
            </tr>
            <tr>
                <td style="text-align:right;">
                    <p>Ngày: {{ $date_create }}</p>
                </td>
            </tr>
            <tr>
                <td>
                    <a>Đơn vị mua hàng: {{ $buyer_name }}</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a>Mã số thuế: {{ $tax_code_buyer }}</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a>Số điện thoại: 0{{ $buyer_phone }}</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a>Địa chỉ: {{ $buyer_address }}</a>
                </td>
            </tr>
        </table>
        <br>
        <table class="list-product" style="width: 100%; border-collapse: collapse;">

            <head>
                <tr style="background-color: lightblue;">
                    <td style="text-align: center;">STT</td>
                    <td>Tên sản phẩm</td>
                    <td>Số lô</td>
                    <td style="text-align: center;">Quy cách</td>
                    <td style="text-align: center;">Đơn giá</td>
                    <td style="text-align: center;">SL</td>
                    <td style="text-align: center;">Tổng tiền</td>
                </tr>
            </head>

            <body>
                @foreach($invoice as $in)
                <tr>
                    <td style="text-align: center;">{{ ++$loop->index }}</td>
                    <td style="width:20%">{{ $in->product->product_name }}</td>
                    <td>{{ $in->product->productDetail->shipment_number }}</td>
                    <td style="text-align: center;">{{ $in->product->productDetail->specifying }}</td>
                    <td style="text-align: center;">{{ number_format($in->product->productDetail->price->price_cost) }}</td>
                    <td style="text-align: center;">{{ number_format($in->product_amount) }}</td>
                    <td style="text-align: center;">{{ number_format($in->product_amount * $in->product->productDetail->price->price_cost) }}</td>
                </tr>
                @if(!empty($in->invoiceDetail->promotion_id))
                <tr>
                    <td colspan="7" style="border-collapse: collapse;"><span> <i> - Tặng {{ !empty($in->invoiceDetail->promotion->product_promotion_id) ?  $in->invoiceDetail->quantity_promotion.' '. $in->invoiceDetail->promotion->product->productDetail->unit.' '.$in->invoiceDetail->promotion->productPromotion->product_name  : '' }} {{ !empty($in->invoiceDetail->promotion->other_product_promotion) ? ' + '. ($in->invoiceDetail->promotion->quantity_other_promotion * ($in->invoiceDetail->quantity_promotion/$in->invoiceDetail->promotion->quantity_promotion)).' '. $in->invoiceDetail->promotion->other_product_promotion  : ''}}  </i></span></td>
                </tr>
                @endif
                @endforeach
            </body>
        </table>
        <br>
        <table style="width: 100%;">
            <tr>
                <th style="width: 40%;"></th>
                <th style="width: 30%; text-align:right">Tổng tiền:</th>
                <th>{{ number_format($total) }} VND</th>
            </tr>
            <tr>
                <th></th>
                <th style="width: 30%; text-align:right">Chiết khấu:</th>
                <th>{{ $submoney }} %</th>
            </tr>
            <tr>
                <th></th>
                <th style="width: 30%; text-align:right">Thuế:</th>
                <th>{{ $tax }} %</th>
            </tr>
            <tr>
                <th></th>
                <th style="width: 30%; text-align:right">Tiền hàng:</th>
                <th>{{ number_format($money - ($money*$submoney)/100 + ($money*$tax)/100) }} VND</th>
            </tr>
        </table>
        <br>
        <br>
        <table style="width: 100%;">
            <tr style="text-align: center;">
                <th style="width: 33%;"><a><b>Đơn vị mua</b></a><br>
                </th>
                <th><a><b>Thủ kho</b></a><br>
                </th>
                <th><a><b>Đơn vị bán</b></a><br>
                </th>
            </tr>
            <tr>
                <td style="text-align: center;"><span><i>(Ký rõ họ tên)</i></span></td>
                <td style="text-align: center;"><span><i>(Ký rõ họ tên)</i></span></td>
                <td style="text-align: center;"><span><i>(Ký rõ họ tên)</i></span></td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>