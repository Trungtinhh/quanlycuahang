<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Chương trình khuyến mãi</li>
                    </ol>
                </div>
                <h4 class="page-title">Quản lý chương trình khuyến mãi</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12 order-xl-1 order-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-12">
                            <div class="text-md-end mt-3 mt-md-0">
                                <button type="button" wire:click='resetAll' class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-promotion"><i class="mdi mdi-plus-circle me-1"></i> Thêm chương trình khuyến mãi </button>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="row">
        @if(!empty($Promotion))
        @foreach($Promotion as $promo)
        <div class="col-lg-4">
            <div class="card ribbon-box">
                <div class="card-body">
                    <div class="ribbon-two ribbon-two-danger"><span> Khuyến mãi</span></div>
                    <h5 class="text-info float-end mt-0">MÃ KHUYẾN MÃI: #{{ $promo->id }}</h5>
                    <div class="ribbon-content">
                        <p class="mb-0">Mua {{ $promo->quantity }} {{ $promo->product->product_name }} <span class="text-primary"> <i> tặng {{ !empty($promo->product_promotion_id) ?  $promo->quantity_promotion.' '. $promo->productPromotion->product_name  : '' }} {{ !empty($promo->other_product_promotion) ? ' + '. $promo->quantity_other_promotion.' '. $promo->other_product_promotion  : ''}} </i></span> </p>
                    </div>
                    <br>
                    <div>
                        <button wire:click='edit({{ $promo->id }})' class="btn btn-primary waves-effect waves-light text-light float-end">Sửa</button>
                        @if($promo->status == 1)
                        <button wire:click='deactivate({{ $promo->id }})' class="btn btn-warning waves-effect waves-light text-light float-end">Hủy kích hoạt</button>
                        @else
                        <button wire:click='activate({{ $promo->id }})' class="btn btn-success waves-effect waves-light float-end">Kích hoạt</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
    <!-- end row -->
    <div class="modal fade" wire:ignore.self id="add-promotion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" wire:submit.prevent='addPromotion'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-uppercase bg-light" id="myLargeModalLabel">Thêm chương trình khuyến mãi</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-danger">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm nhận khuyến mãi <span class="text-danger">*</span></label></b>
                                            <select wire:model.lazy='product' class="form-control">
                                                <option value="">Chọn</option>
                                                @if(!empty($Product))
                                                @foreach($Product as $pro)
                                                <option value="{{ $pro->id }}">{{ $pro->product_name }} - HSD: {{ $pro->productDetail->date_exp }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('product')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <span for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></span>
                                            <input type="number" min='0' wire:model.lazy='quantity' id="product-reference" class="form-control">
                                            @error('quantity')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm khuyến mãi <span class="text-danger">*</span></label></b>
                                            <select wire:model.lazy='product_promotion' class="form-control">
                                                <option value="">Chọn</option>
                                                @if(!empty($Product_promotion))
                                                @foreach($Product_promotion as $pro_promotion)
                                                <option value="{{ $pro_promotion->id }}">{{ $pro_promotion->product_name }} - HSD: {{ $pro_promotion->productDetail->date_exp }}</span></option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('product_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='quantity_promotion' id="product-reference" class="form-control">
                                            @error('quantity_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm khuyến mãi khác<span class="text-danger">*</span></label></b>
                                            <input type="text" wire:model.lazy='other_product_promotion' class="form-control">
                                            @error('other_product_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='quantity_other_promotion' id="product-reference" class="form-control">
                                            @error('quantity_other_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                        </div> <!-- end card -->

                    </div>
                    <div class="modal-footer">
                        <button wire:click='' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @if($statusEdit)
    <div class="modal fade" wire:ignore.self id="edit-promotion" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" wire:submit.prevent='storeEdit'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Sửa chương trình khuyến mãi</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border border-danger">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm nhận khuyến mãi <span class="text-danger">*</span></label></b>
                                            <select wire:model.lazy='product' class="form-control">
                                                <option value="">Chọn</option>
                                                @if(!empty($Product))
                                                @foreach($Product as $pro)
                                                <option value="{{ $pro->id }}">{{ $pro->product_name }} - HSD: {{ $pro->productDetail->date_exp }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('product')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <span for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></span>
                                            <input type="number" min='0' wire:model.lazy='quantity' id="product-reference" class="form-control">
                                            @error('quantity')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm khuyến mãi <span class="text-danger">*</span></label></b>
                                            <select wire:model.lazy='product_promotion' class="form-control">
                                                <option value="">Chọn</option>
                                                @if(!empty($Product_promotion))
                                                @foreach($Product_promotion as $pro_promotion)
                                                <option value="{{ $pro_promotion->id }}">{{ $pro_promotion->product_name }} - HSD: {{ $pro_promotion->productDetail->date_exp }}</span></option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('product_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='quantity_promotion' id="product-reference" class="form-control">
                                            @error('quantity_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <b><label for="product-name" class="form-label">Sản phẩm khuyến mãi khác<span class="text-danger">*</span></label></b>
                                            <input type="text" wire:model.lazy='other_product_promotion' class="form-control">
                                            @error('other_product_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số lượng<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='quantity_other_promotion' id="product-reference" class="form-control">
                                            @error('quantity_other_promotion')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div> <!-- end col -->
                                </div>
                                <!-- end row -->
                            </div>
                        </div> <!-- end card -->
                    </div>
                    <div class="modal-footer">
                        <button wire:click='' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endif
    @section('script')
    <script>
        window.addEventListener('show-edit', event => {
            $('#edit-promotion').modal('show');
        })
    </script>

    <!-- Toastr js-->
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