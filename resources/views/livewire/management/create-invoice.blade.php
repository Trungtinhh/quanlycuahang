<div>
    <!-- Start Content-->
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                            <li class="breadcrumb-item active">Tạo hóa đơn</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Tạo hóa đơn</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card border border-primary">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="text-md mt-3 mt-md-0">
                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Người bán <span class="text-danger">*</span></h5>
                                <div class="row">
                                    <div class="col-5">
                                        <select wire:model='user_id' class="form-control">
                                            <option value="">Chọn</option>
                                            @foreach($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->staff_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{ $message}}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col-->
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Đơn vị bán hàng</h5>
                        @if($saler != null)
                        <form class="form" method="post" wire:submit.prevent='editSaler({{ $saler["id"] }})' autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="product-name" class="form-label">Tên đơn vị <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='saler_name' id="product-name" class="form-control">
                                @error('saler_name')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Mã số thuế <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='tax_code' id="product-reference" class="form-control">
                                @error('tax_code')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Địa chỉ<span class="text-danger">*</span></label>
                                <input type="text" min='0' wire:model.lazy='address' id="product-reference" class="form-control">
                                @error('address')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-description" class="form-label">Số điện thoại(+84)<span class="text-danger">*</span></label>
                                <input type="number" wire:model.lazy='phone' class="form-control">
                                @error('phone')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="text-end m-3">
                                <button type="submit" class="btn w-sm btn-primary waves-effect waves-light"><i class="fa fa-edit"></i> Sửa</button>
                            </div>
                        </form>
                        @else
                        <form class="form" method="post" wire:submit.prevent='createSaler' autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="product-name" class="form-label">Tên đơn vị <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='saler_name' id="product-name" class="form-control">
                                @error('saler_name')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Mã số thuế <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='tax_code' id="product-reference" class="form-control">
                                @error('tax_code')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Địa chỉ<span class="text-danger">*</span></label>
                                <input type="text" min='0' wire:model.lazy='address' id="product-reference" class="form-control">
                                @error('address')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-description" class="form-label">Số điện thoại(+84)<span class="text-danger">*</span></label>
                                <input type="number" wire:model.lazy='phone' class="form-control">
                                @error('phone')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="text-end m-3">
                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light"><i class="fa fa-check-circle"></i> Xong</button>
                                <button type="button" wire:click='resetForm' class="btn btn-outline-warning"> Hoàn tác</button>
                            </div>
                        </form>
                        @endif

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card border border-primary">
                    <div class="card-body">
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Đơn vị mua hàng</h5>
                        <div class="col-md-6">
                            <div class="text-md mt-3 mt-md-0">
                                <form wire:submit.prevent='selectBuyer'>
                                    <label for="product-name" class="form-label">Đơn vị có sẵn</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <select wire:model.lazy='buyerCreated' class="form-control">
                                                <option value="">Chọn</option>
                                                @foreach($buyer as $buy)
                                                <option value="{{ $buy->id }}">{{ $buy->buyer_name }}{{ $buy->relationship == 1 ? ' - Thân thiết' : ''}}</option>
                                                @endforeach
                                            </select>
                                            @error('buyerCreated')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-check me-1"></i> Chọn </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end col-->
                        <br>
                        <form class="form" method="post" wire:submit.prevent='createBuyer' autocomplete="off">
                            @csrf
                            <div class="mb-3">
                                <label for="product-name" class="form-label">Tên đơn vị <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='buyer_name' id="product-name" class="form-control">
                                @error('buyer_name')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Mã số thuế <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='tax_code_buyer' id="product-reference" class="form-control">
                                @error('tax_code_buyer')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Địa chỉ<span class="text-danger">*</span></label>
                                <input type="text" min='0' wire:model.lazy='address_buyer' id="product-reference" class="form-control">
                                @error('address_buyer')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-description" class="form-label">Số điện thoại(+84)<span class="text-danger">*</span></label>
                                <input type="number" wire:model.lazy='phone_buyer' class="form-control">
                                @error('phone_buyer')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product-price">Tình trạng quan hệ <span class="text-danger">*</span></label>
                                @error('relationship')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                                <br>
                                <div>
                                    <input wire:model.lazy='relationship' type="radio" value='1' class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                    <span>Thân thiết</span>
                                </div>
                                <div>
                                    <input wire:model.lazy='relationship' type="radio" value='2' class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                                    <span>Bình thường</span>
                                </div>
                            </div>
                            <div class="text-end m-3">
                                <button type="submit" class="btn w-sm btn-success waves-effect waves-light"><i class="fa fa-check-circle"></i> Xong</button>
                                <button type="button" wire:click='resetFormBuyer' class="btn btn-outline-warning"> Hoàn tác</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card border border-success">
                    <div class="card-body">
                        <br>
                        <br>
                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Chọn sản phẩm</h5>
                        <br>
                        <div class="row">
                            <div class="col-9">
                                <div class="table-responsive" style="font-size: 10px;">
                                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên</th>
                                                <th>Giá</th>
                                                <th class="text-center">Số lượng</th>
                                                <th class="text-center">Đơn vị</th>
                                                <th class="text-center">HSD</th>
                                                <th class="text-center">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $temp = 0; ?>
                                            @if(!empty($invoice))
                                            @foreach($invoice as $product)
                                            <tr>
                                                <th scope="row"><span class="badge bg-primary">#{{ $product->product_id }}</span></th>
                                                <th scope="row">{{ $product->product->product_name }}</th>
                                                <th scope="row" style="width:10%;">{{ $product->product->productDetail->price->price_cost }} VND</th>
                                                <th scope="row" class="text-center" style="width:10%;">
                                                    {{ $product->product_amount }}
                                                </th>
                                                <th scope="row" class="text-center" style="width:10%;">
                                                    {{ $product->product->productDetail->unit == null ? "---" : $product->product->productDetail->unit }}
                                                </th>
                                                <th scope="row" class="text-center" style="width:10%;">
                                                    {{ $product->product->productDetail->date_exp  }}
                                                </th>
                                                <td scope="row" class="text-center">
                                                    <button wire:click='deleteProductInvoice({{ $product->product_id }})' class="btn btn-danger btn-rounded waves-effect waves-light">
                                                        <i class="mdi mdi-delete" title='Xóa'></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @if(!empty($product->invoiceDetail->promotion_id))
                                            <tr>
                                                <th colspan="7"><span class="text-blue"> <i> - Tặng {{ !empty($product->invoiceDetail->promotion->product_promotion_id) ?  $product->invoiceDetail->quantity_promotion.' '. $product->invoiceDetail->promotion->product->productDetail->unit.' '.$product->invoiceDetail->promotion->productPromotion->product_name  : '' }} {{ !empty($product->invoiceDetail->promotion->other_product_promotion) ? ' + '. ($product->invoiceDetail->promotion->quantity_other_promotion * ($product->invoiceDetail->quantity_promotion/$product->invoiceDetail->promotion->quantity_promotion)).' '. $product->invoiceDetail->promotion->other_product_promotion  : ''}} </i></span></th>
                                            </tr>
                                            @endif
                                            <?php $temp++;
                                            ?>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="page-title-box">
                                        @if($temp == 0)
                                        <h6 class="page-title" style="text-align: center;"><i data-feather="alert-triangle" class="icon-dual-danger"></i>Trống !</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <table class="m-2">
                                    <tr>
                                        <th>Tổng cộng:</th>
                                        <th>{{ number_format($total) }} VND</th>
                                    </tr>
                                    <tr>
                                        <th>Chiết khấu:</th>
                                        <th><input type="number" min='0' max='100' wire:model='submoney'> (%)</th>
                                    </tr>
                                    <tr>
                                        <th>Thuế:</th>
                                        <th><input type="number" min='0' max='100' wire:model='tax'> (%)</th>
                                    </tr>
                                    <tr>
                                        <th>Tổng đơn:</th>
                                        @if(empty($submoney))
                                        <?php $submoney = 0 ?>
                                        @endif
                                        @if(empty($tax))
                                        <?php $tax = 0 ?>
                                        @endif
                                        <th>{{ number_format($total - ($total*$submoney)/100 + ($total*$tax)/100) }} VND</th>
                                    </tr>
                                    <div class="text-end">
                                        <button wire:click='print' style=' margin-bottom:10px;' class="btn btn-secondary btn-rounded waves-effect waves-light">
                                            <i class="fa fa-print mr-1"></i> In
                                        </button>
                                        <button wire:click='saveInvoice' style=' margin-bottom:10px;' data-bs-dismiss="modal" class="btn btn-primary btn-rounded waves-effect waves-light">
                                            <i class="fe-save"></i> Lưu
                                        </button>
                                        @if($invoice == null)
                                        <?php $invoice = -1 ?>
                                        @endif
                                        <button wire:click='payInvoice({{ $invoice }})' style=' margin-bottom:10px;' data-bs-dismiss="modal" class="btn btn-success btn-rounded waves-effect waves-light">
                                            <i class="fe-check-circle"></i> Thanh toán
                                        </button>
                                    </div>
                                </table>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>

                        <div class="row">
                            <div class="col-9">
                                <form class="search-bar p-1" wire:submit.prevent=''>
                                    <div class="position-relative">
                                        <input type="text" wire:model='searchProduct' class="form-control" placeholder="Tìm sản phẩm...">
                                        <span class="mdi mdi-magnify"></span>
                                        @if(!empty($searchProduct))
                                        @if(!empty($search_product))
                                        <div class="row">
                                            <div>
                                                <ul class="list-group">
                                                    @foreach($search_product as $search)
                                                    @if($search->product->delete_status == 0)
                                                    <li class="list-group-item justify-content-between align-items-center">
                                                        <div class="row">
                                                            <div class="col-2">
                                                                {{ $search->product_name }}
                                                            </div>
                                                            <div class="col-2">
                                                                <div class='badge bg-primary rounded-pill'>{{ $search->price->price_cost }} VND</div>
                                                                <div class='badge bg-success rounded-pill'>Còn lại: {{ $search->amount }} {{$search->unit}}</div>
                                                            </div>
                                                            <div class="col-6 text-center">
                                                                <div class="row">
                                                                    @if($search->amount == 0)
                                                                    <div class="col-4">
                                                                        <div class='badge bg-danger rounded-pill'>
                                                                            <input type="number" placeholder="Hết" readonly class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div style="margin: 7px">
                                                                            {{ !empty($search->unit) ? $search->unit : "---" }}
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="col-4">
                                                                        <div>
                                                                            <input type="number" wire:model.defer='product_amount' min='0' max='{{ $search->amount }}' class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div style="margin: 7px">
                                                                            {{ !empty($search->unit) ? $search->unit : "---" }}
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    <div class="col-4">
                                                                        <div>
                                                                            <div class='badge bg-danger rounded-pill'>{{ $search->provider->provider_name ." - ". $search->date_exp }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-2 text-end">
                                                                <div class='text-end rounded-pill'>
                                                                    <button wire:click='addProductToInvoice({{ $search->product_id }})' class=" btn-success btn-rounded waves-effect waves-light">
                                                                        <i class="mdi mdi-check" title='Chọn'></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <div class="col-3">
                                <button type="button" data-bs-target="#all-product" data-bs-toggle="modal" class="btn btn-outline-secondary btn-rounded waves-effect waves-light"><i class="mdi mdi-text me-1"></i> Tất cả </button>
                                <button type="button" wire:click='cancel' class="btn btn-outline-danger btn-rounded waves-effect waves-light"><i class="mdi mdi-close me-1"></i> Hủy </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
    <div class="modal fade" wire:ignore.self id="all-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullWidthModalLabel">Danh sách sản phẩm </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card border border-success">
                                <div class="card-body">
                                    @if(!empty($product_all))
                                    <div class="row">
                                        <div>
                                            <?php $temp = 0 ?>
                                            <ul class="list-group">
                                                @foreach($product_all as $search)
                                                <li class="list-group-item justify-content-between align-items-center">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            {{ $search->product_name }}
                                                        </div>
                                                        <div class="col-2">
                                                            <div class='badge bg-primary rounded-pill'>{{ $search->productDetail->price->price_cost }} VND</div>
                                                            <div class='badge bg-success rounded-pill'>Còn lại: {{ $search->productDetail->amount }} {{$search->productDetail->unit}}</div>
                                                        </div>
                                                        <div class="col-6 text-center">
                                                            <div class="row">
                                                                @if($search->productDetail->amount == 0)
                                                                <div class="col-4">
                                                                    <div class='badge bg-danger rounded-pill'>
                                                                        <input type="number" placeholder="Hết" readonly class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div style="margin: 7px">
                                                                        {{ !empty($search->unit) ? $search->unit : "---" }}
                                                                    </div>
                                                                </div>
                                                                @else
                                                                <div class="col-4">
                                                                    <div>
                                                                        <input type="number" wire:model.defer='product_amount' min='0' max='{{ $search->productDetail->amount }}' class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div style="margin: 7px">
                                                                        {{ !empty($search->productDetail->unit) ? $search->productDetail->unit : "---" }}
                                                                    </div>
                                                                </div>
                                                                @endif
                                                                <div class="col-4">
                                                                    <div>
                                                                        <div class='badge bg-danger rounded-pill'>{{ $search->productDetail->provider->provider_name ." - ". $search->productDetail->date_exp }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-2 text-end">
                                                            <div class='text-end rounded-pill'>
                                                                <button wire:click='addProductToInvoice({{ $search->id }})' class=" btn-success btn-rounded waves-effect waves-light">
                                                                    <i class="mdi mdi-check" title='Chọn'></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php $temp++ ?>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="page-title-box">
                                        @if($temp == 0)
                                        <h6 class="page-title bg-soft-secondary" style="text-align: center;">Trống!</i></h6>
                                        @endif
                                    </div>
                                    <br>
                                    {{ $product_all->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button wire:click='' data-bs-dismiss="modal" style='padding-left: 30px;padding-right: 30px;' class="btn btn-secondary"><i class='fa fa-times-circle mr-1'></i> Đóng </button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @section('script')
    <script>
        $('button.print').click(function() {
            window.print();
            return false
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#content tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
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