<div>
    <form method="GET" wire:submit.prevent='importGoods'>
        @csrf
        <br>
        <h4 class="modal-title" id="myLargeModalLabel">Nhập kho</h4>
        <br>
        <div class="card border-primary border mb-3">
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Nhà cung cấp</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control" wire:model.lazy='provider'>
                                <option value="">Chọn nhà cung cấp</option>
                                @if(!empty($Pro))
                                @foreach($Pro as $pro)
                                <option value="{{ $pro->id }}"> {{ $pro->provider_name }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('provider')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <button wire:click='closeAdd' type="button" data-bs-target="#create-provider" class="btn btn-outline-warning btn-rounded waves-effect waves-light" data-bs-toggle="modal">Thêm mới</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Sản phẩm</label>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control" wire:model.lazy='product'>
                                <option value="">Chọn sản phẩm</option>
                                @if(!empty($Product))
                                @foreach($Product as $value=>$val)
                                <option value="{{ $value }}"> {{ $value }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('product')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                        @if(!empty($provider))
                        <div class="col-sm-2">
                            <button wire:click='closeAdd' type="button" data-bs-target="#create-product" class="btn btn-outline-warning btn-rounded waves-effect waves-light " data-bs-toggle="modal">Thêm mới</button>
                        </div>
                        @else
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-outline-warning btn-rounded waves-effect waves-light "><i class="mdi mdi-alert text-danger"></i></button>
                        </div>
                        @endif
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Số lượng</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="number" min='0' class="form-control" wire:model.lazy='amount_add'>
                            @error('amount_add')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Đơn vị</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" min='0' class="form-control" wire:model.lazy='unit'>
                            @error('unit')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Số lô</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" min='0' class="form-control" wire:model.lazy='shipment_number'>
                            @error('shipment_number')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Ngày nhập</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" wire:model.lazy='date_add'>
                            @error('date_add')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="form-label" autocomplete="off">Hạn dùng</label>
                        </div>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" wire:model.lazy='date_exp'>
                            @error('date_exp')
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ $message}}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end" style='padding-right: 30px;'>
                <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger " type="submit"><i class="mdi mdi-check"></i> XONG </button>
            </div>
            <br>
        </div>
    </form>
    <div class="modal fade" wire:ignore.self id="create-provider" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" wire:submit.prevent='addProvider'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm nhà cung cấp</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card border-success border mb-3">
                                    <div class="card-body">
                                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông tin cơ bản</h5>

                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Tên nhà cung cấp <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='provider_name' class="form-control">
                                            @error('provider_name')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='phone' class="form-control">
                                            @error('phone')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email<span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='email' class="form-control">
                                            @error('email')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-summary" class="form-label">Địa chỉ<span class="text-danger">*</span></label>
                                            <textarea class="form-control" wire:model.lazy='address' rows="3"></textarea>
                                            @error('address')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div>
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
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->

                            <div class="col-lg-6">
                                <div class="card border-success border mb-3">
                                    <div class="card-body">
                                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Hình ảnh</h5>
                                        <div class="row">
                                            <div class="col-12">

                                                <input type="file" wire:model="image">
                                                @error('image')
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-7">
                                                @if ($image)
                                                Ảnh tải lên:
                                                <img src="{{ $image->temporaryUrl() }}" width="100px">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                                <br>
                                <div wire:loading class="text-center">Đang xử lý</div>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="modal-footer">
                        <button wire:click='' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" wire:ignore.self id="create-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" wire:submit.prevent='addProduct'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm sản phẩm</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card border-warning border mb-3">
                                    <div class="card-body">
                                        <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông tin cơ bản</h5>

                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='product_name' class="form-control">
                                            @error('product_name')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <label for="product-name" class="form-label">Danh mục sản phẩm <span class="text-danger">*</span></label>
                                                <select wire:model.lazy='category_id' class="form-control">
                                                    <option value="">Chọn danh mục</option>
                                                    @if(!empty($Category))
                                                    @foreach($Category as $value)
                                                    <option value="{{ $value->id }}">{{ $value->category_name }}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <button wire:click='closeAdd' type="button" data-bs-target="#create-menu_category" class="btn btn-success btn-rounded waves-effect waves-light" data-bs-toggle="modal" style="font-size: 10px;">Thêm mới</button>
                                            </div>
                                            <div class="col-sm-12">
                                                @error('category_id')
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Giá <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='product_price' class="form-control">
                                            @error('product_price')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Số lô <span class="text-danger">*</span></label>
                                            <input type="text" wire:model.lazy='product_shipment_number' class="form-control">
                                            @error('product_shipment_number')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Hạn sử dụng<span class="text-danger">*</span></label>
                                            <input type="date" wire:model.lazy='product_date_exp' class="form-control">
                                            @error('product_date_exp')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-summary" class="form-label">Mô tả công dụng</label>
                                            <textarea class="form-control" wire:model.lazy='description' id="product-summary" rows="3"></textarea>
                                            @error('description')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
                            <div class="col-lg-6">
                                <div class="card border-warning border mb-3">
                                    <div class="card-body">
                                        <h5 class="text-uppercase mt-0 mb-3 bg-light p-2">Hình ảnh</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="file" wire:model="product_image">
                                                @error('product_image')
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    {{ $message}}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-7">
                                                @if ($product_image)
                                                Ảnh tải lên:
                                                <img src="{{ $product_image->temporaryUrl() }}" width="100px">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end col-->
                                <br>
                                @if(!empty($noti))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $noti }}
                                </div>
                                @endif
                                <div wire:loading class="text-center">Đang xử lý</div>
                            </div> <!-- end col-->
                        </div>
                        <!-- end row -->
                    </div>
                    <div class="modal-footer">
                        <button wire:click='' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" wire:ignore.self id="create-menu_category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm border-success border mb-3">
            <form method="GET" wire:submit.prevent='addCategory'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm danh mục</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Tên danh mục</label>
                                            <input type="text" wire:model.lazy='category_name' class="form-control">
                                            @error('category_name')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click='' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button wire:click='' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Toastr js-->
    @section('script')
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