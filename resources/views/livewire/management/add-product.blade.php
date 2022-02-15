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
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Quản lý sản phẩm</a></li>
                            <li class="breadcrumb-item active">Thêm sản phẩm</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Thêm sản phẩm mới</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <form class="form" method="post" wire:submit.prevent='addProduct' autocomplete="off">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông tin</h5>

                            <div class="mb-3">
                                <label for="product-name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" wire:model.lazy='product_name' id="product-name" class="form-control">
                                @error('product_name')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product-reference" class="form-label">Giá <span class="text-danger">*</span></label>
                                <input type="number" min='0' wire:model.lazy='product_price' id="product-reference" class="form-control">
                                @error('product_price')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product-summary" class="form-label">Số lô</label>
                                <input type="text" min='0' wire:model.lazy='shipment_number' id="product-reference" class="form-control">
                                @error('shipment_number')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product-summary" class="form-label">Quy cách</label>
                                <input type="text" min='0' wire:model.lazy='specifying' id="product-reference" class="form-control">
                                @error('specifying')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="product-description" class="form-label">Hạn sử dụng <span class="text-danger">*</span></label>
                                <input type="date" wire:model.lazy='date_exp' class="form-control">
                                @error('date_exp')
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-9">
                                    <label for="product-category" class="form-label">Danh mục <span class="text-danger">*</span></label>
                                    <select class="form-control select2" wire:model.lazy='product_category' id="product-category">
                                        <option> Chọn </option>
                                        @if(!empty($Category))
                                        @foreach($Category as $cate)
                                        <option value="{{ $cate->id }}"> {{ $cate->category_name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    @error('product_category')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-3">
                                    <br>
                                    <button wire:click='closeAdd' type="button" data-bs-dismiss="modal" data-bs-target="#create_category" class="btn btn-outline-primary btn-rounded" data-bs-toggle="modal" style="font-size: 10px;">Thêm mới</button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-9">
                                    <label for="product-category" class="form-label">Nhà cung cấp <span class="text-danger">*</span></label>
                                    <select class="form-control select2" wire:model.lazy='provider' id="product-category">
                                        <option> Chọn </option>
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
                                <div class="col-sm-3">
                                    <br>
                                    <button wire:click='closeAdd' type="button" data-bs-target="#create-provider" class="btn btn-outline-primary btn-rounded" data-bs-toggle="modal" style="font-size: 10px;">Thêm mới</button>
                                </div>
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

                    <div class="card">
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

                    <div class="card">
                        <div class="card-body">

                            <div wire:loading class="text-primary">
                                Đang xử lý
                            </div>

                        </div>
                    </div> <!-- end card -->

                </div> <!-- end col-->

            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="text-center mb-3">
                        <button type="submit" class="btn w-sm btn-success waves-effect waves-light">Xong</button>
                        <button type="button" wire:click='resetForm' class="btn btn-outline-warning"> Hoàn tác</button>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </form>

        <!-- file preview template -->
        <div class="d-none" id="uploadPreviewTemplate">
            <div class="card mt-1 mb-0 shadow-none border">
                <div class="p-2">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <img data-dz-thumbnail src="#" class="avatar-sm rounded bg-light" alt="">
                        </div>
                        <div class="col ps-0">
                            <a href="javascript:void(0);" class="text-muted fw-bold" data-dz-name></a>
                            <p class="mb-0" data-dz-size></p>
                        </div>
                        <div class="col-auto">
                            <!-- Button -->
                            <a href="" class="btn btn-link btn-lg text-muted" data-dz-remove>
                                <i class="dripicons-cross"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container -->
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
    <div class="modal fade" wire:ignore.self id="create_category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
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
                                <div class="card border-success border mb-3">
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