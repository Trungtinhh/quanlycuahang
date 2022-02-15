<div>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Danh sách hóa đơn</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Danh sách hóa đơn</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="font-size:10px;">
                    <div class="card-body">
                        <div class='col-3'>
                            <input class="form-control" id="search" type="text" placeholder="Tìm kiếm trong bảng hiện tại..">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" style="font-size: 12px;" id="tickets-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ĐV mua</th>
                                        <th>Ngày</th>
                                        <th>Nhân viên</th>
                                        <th class="text-center">Sản phẩm</th>
                                        <th>CK</th>
                                        <th>Thuế</th>
                                        <th>Thành tiền</th>
                                        <th>Trạng thái</th>
                                        <th class="text-center">Hành dộng</th>
                                    </tr>
                                </thead>

                                <tbody id="content1">
                                    <?php $temp = 0; ?>
                                    @foreach($Invoice as $Invoi=>$invoi)
                                    @foreach($invoi as $val)
                                    <?php
                                    $id = $val->id;
                                    $buyer = $val->buyer->buyer_name;
                                    $user = $val->invoiceDetail->user_name;
                                    $money = $val->invoiceDetail->total;
                                    $submoney = $val->invoiceDetail->submoney;
                                    $tax = $val->invoiceDetail->tax;
                                    $status = $val->status;
                                    ?>
                                    @endforeach
                                    <tr>
                                        <th scope="row" style="width: 5%;"> <span class="badge bg-warning">{{ $id }}</span></th>
                                        <th scope="row">{{ $buyer }}</th>
                                        <th scope="row">{{ $Invoi }}</th>
                                        <th scope="row">{{ $user}}</th>
                                        <th scope="row">
                                            <table>
                                                @foreach($invoi as $vl)
                                                <tr>
                                                    <td>{{ $vl->product_amount }} x {{ number_format($vl->invoiceDetail->price_cost) }} -</td>
                                                    <td><span class="badge bg-pink">{{ $vl->invoiceDetail->product_name }}</span></td>
                                                </tr>
                                                @if(!empty($vl->invoiceDetail->promotion_id))
                                                <tr>
                                                    <th colspan="2" style="width:80%; font-size:8px;"><span class="text-blue"> <i> - Tặng {{ !empty($vl->invoiceDetail->promotion->product_promotion_id) ?  $vl->invoiceDetail->quantity_promotion.' '. $vl->invoiceDetail->promotion->product->productDetail->unit.' '.$vl->invoiceDetail->promotion->productPromotion->product_name  : '' }} {{ !empty($vl->invoiceDetail->promotion->other_product_promotion) ? ' + '. ($vl->invoiceDetail->promotion->quantity_other_promotion * ($vl->invoiceDetail->quantity_promotion/$vl->invoiceDetail->promotion->quantity_promotion)).' '. $vl->invoiceDetail->promotion->other_product_promotion  : ''}} </i></span></th>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </table>
                                        </th>
                                        <th scope="row">{{ $submoney }} %</th>
                                        <th scope="row">{{ $tax }} %</th>
                                        <th scope="row">{{ number_format($money) }} VND</th>
                                        @if($status == 1)
                                        <th scope="row">
                                            <span class="badge bg-soft-danger text-danger">Chưa thanh toán</span>
                                        </th>
                                        <th scope="row" class="text-center">
                                            <button wire:click='payInvoice({{ $invoi }})' data-bs-dismiss="modal" class="btn-success btn-rounded waves-effect waves-light">
                                                <i class="fa fa-check-circle mr-1" title="Thanh toán"></i>
                                            </button>
                                            <button wire:click='print("{{ $Invoi }}")' data-bs-dismiss="modal" class="btn-secondary btn-rounded waves-effect waves-light">
                                                <i class="fa fa-print mr-1" title="In"></i>
                                            </button>
                                            <button wire:click='removeInvoice("{{ $Invoi }}")' data-bs-dismiss="modal" class="btn-danger btn-rounded waves-effect waves-light">
                                                <i class="fe-delete mr-1" title="Hủy"></i>
                                            </button>
                                        </th>
                                        @elseif($status == 2)
                                        <th scope="row">
                                            <span class="badge bg-soft-success text-success">Đã thanh toán</span>
                                        </th>
                                        <th scope="row" class="text-center">
                                            <button wire:click='print("{{ $Invoi }}")' data-bs-dismiss="modal" class="btn-secondary btn-rounded waves-effect waves-light">
                                                <i class="fa fa-print mr-1" title="In"></i>
                                            </button>
                                            <button wire:click='removeInvoice("{{ $Invoi }}")' data-bs-dismiss="modal" class="btn-danger btn-rounded waves-effect waves-light">
                                                <i class="fe-delete mr-1" title="Hủy"></i>
                                            </button>
                                        </th>
                                        @endif
                                    </tr>
                                    <?php ++$temp; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="page-title-box">
                            @if($temp == 0)
                            <h6 class="page-title" style="text-align: center;">Trống!</h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
    @section('script')
    <script>
        window.addEventListener('show-invoice', event => {
            $('#invoice').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#content1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/js/pages/dashboard-1.init.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            showCloseButton: true,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        window.addEventListener('alert', ({
            detail: {
                type,
                message
            }
        }) => {
            Toast.fire({
                icon: type,
                title: message
            })
        })
    </script>
    @endsection
</div>