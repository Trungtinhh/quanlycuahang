<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Trang chủ</li>
                        <li class="breadcrumb-item active">Quản lý sản phẩm</li>
                        <li class="breadcrumb-item active">Danh sách sản phẩm</li>
                    </ol>
                </div>
                <h4 class="page-title">Danh sách sản phẩm</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-warning">
                                <i class="fe-tag font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-home">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$new}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Tổng số</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-primary">
                                <i class="fe-tag font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-home">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$sale}}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Đang bán</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="widget-rounded-circle card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-lg rounded-circle bg-danger">
                                <i class="fe-tag font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-home">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{$count}}</span></h3>
                                <button wire:click='listStopSale' class="btn btn-light waves-effect waves-light text-muted mb-1 text-truncate">Ngừng bán</button>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Tất cả sản phẩm</h4>
                    <div class='col-3'>
                        <input class="form-control" id="search" type="text" placeholder="Tìm kiếm trong bảng hiện tại..">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên</th>
                                    <th>Nhà cung cấp</th>
                                    <th>Số lô</th>
                                    <th>Số lượng</th>
                                    <th>Đơn vị</th>
                                    <th style="width: 10%;">Quy cách</th>
                                    <th style="width: 15%;">Mô tả</th>
                                    <th>HSD</th>
                                    <th>Giá</th>
                                    @canany(['system.permission.management'])
                                    <th class="text-center">Hành động</th>
                                    @endcanany
                                </tr>
                            </thead>

                            <tbody id='content'>
                                <?php $temp = 0; ?>
                                @if(!empty($Product))
                                @foreach($Product as $value)
                                @if($value->product->delete_status == 0)
                                <tr>
                                    <th scope="row">{{ ++$loop->index }}</th>
                                    <th scope="row">{{ $value->product_name }}</th>
                                    <th scope="row">{{ $value->provider->provider_name }}</th>
                                    <th scope="row" class='text-primary'>{{ $value->shipment_number }}</th>
                                    <th scope="row">{{ $value->amount }}</th>
                                    <th scope="row">{{ $value->unit }}</th>
                                    <th scope="row">{{ $value->specifying }}</th>
                                    <th scope="row">{{ $value->description }}</th>
                                    <th scope="row">{{ $value->date_exp }}</th>
                                    <th scope="row"><span class="badge bg-success">{{ number_format($value->price->price_cost) }}</span></th>
                                    @canany(['system.permission.management'])
                                    <td scope="row" class="text-center">
                                        <button wire:click="editProduct({{ $value->product_id }})" class="btn btn-primary btn-rounded waves-effect waves-light">
                                            <i class="mdi mdi-file-edit" title='Sửa'></i>
                                        </button>
                                        <button wire:click="deleteProduct({{ $value->product_id }})" class="btn btn-danger btn-rounded waves-effect waves-light">
                                            <i class="mdi mdi-delete" title='Xóa'></i>
                                        </button>
                                    </td>
                                    @endcanany
                                </tr>
                                <?php $temp++; ?>
                                @endif
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="page-title-box">
                            @if($temp == 0)
                            <h6 class="page-title" style="text-align: center;">Trống!</i></h6>
                            @endif
                        </div>
                        {{ $Product->links() }}
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- /.modal -->
    @if($statusEdit)
    <div class="modal fade" wire:ignore.self id="edit-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="form" method="post" wire:submit.prevent='storeEditProduct' autocomplete="off">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Sửa thông tin sản phẩm </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-primary border mb-3">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="text-uppercase bg-light p-2 mt-0 mb-3">Thông tin</h5>
                                                <div class="mb-3">
                                                    <label for="product-name" class="form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                                                    <input type="text" wire:model.lazy='product_name' placeholder="{{ $product_edit->product_name }}" id="product-name" class="form-control">
                                                    @error('product_name')
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product-reference" class="form-label">Giá <span class="text-danger">*</span></label>
                                                    <input type="number" min='0' wire:model.lazy='product_price' placeholder="{{ $product_edit->price->price_cost }}" id="product-reference" class="form-control">
                                                    @error('product_price')
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="product-description" class="form-label">Hạn sử dụng <span class="text-danger">*</span></label>
                                                    <input type="date" wire:model.lazy='date_exp' placeholder="{{ $product_edit->date_exp }}" class="form-control">
                                                    @error('date_exp')
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        {{ $message}}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="row">
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
                                                <div class="row">
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
                                                    <textarea class="form-control" wire:model.lazy='description' placeholder="{{ $product_edit->description }}" id="product-summary" rows="3"></textarea>
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
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-7">
                                                                @if (!empty($product_edit->image))
                                                                Ảnh hiện tại:
                                                                <img src="{{ asset('storage/'.$product_edit->image) }}" width="100px">
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-7">
                                                                @if ($product_image)
                                                                Ảnh tải lên: <br>
                                                                <img src="{{ $product_image->temporaryUrl() }}" width="100px">
                                                                @endif
                                                            </div>
                                                        </div>
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
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                        <button style='padding-left: 30px;padding-right: 30px;' class="btn btn-primary" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

    @endif

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
    <div class="modal fade" wire:ignore.self id="list_stop_sale" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-full-width">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Danh sách sản phẩm ngừng kinh doanh</h4>
                    <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class='col-4'>
                                        <input class="form-control" id="search1" type="text" placeholder="Tìm kiếm...">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Tên</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Số lô</th>
                                                    <th>Số lượng</th>
                                                    <th>Mô tả</th>
                                                    <th>HSD</th>
                                                    <th>Giá</th>
                                                    @canany(['system.permission.management'])
                                                    <th class="text-center">Hành động</th>
                                                    @endcanany
                                                </tr>
                                            </thead>

                                            <tbody id='content1'>
                                                <?php $temp = 0; ?>
                                                @if(!empty($Product))
                                                @foreach($Product as $value)
                                                @if($value->product->delete_status == 1)
                                                <tr>
                                                    <th scope="row">{{ ++$loop->index }}</th>
                                                    <th scope="row">{{ $value->product_name }}</th>
                                                    <th scope="row">{{ $value->provider->provider_name }}</th>
                                                    <th scope="row"><span class="badge bg-primary">{{ $value->shipment_number }}</span></th>
                                                    <th scope="row">{{ $value->amount }}</th>
                                                    <th scope="row">{{ $value->description }}</th>
                                                    <th scope="row"><span class="badge bg-warning">{{ $value->date_exp }}</span></th>
                                                    <th scope="row">{{ $value->price->price_cost }}</th>
                                                    @canany(['system.permission.management'])
                                                    <td scope="row" class="text-center">
                                                        <button wire:click="resetSale({{ $value->product_id }})" class="btn btn-success btn-rounded waves-effect waves-light">
                                                            <i class="mdi mdi-lock-open-check-outline" title='Kinh doanh lại'></i>
                                                        </button>
                                                    </td>
                                                    @endcanany
                                                </tr>
                                                <?php $temp++; ?>
                                                @endif
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="page-title-box">
                                            @if($temp == 0)
                                            <h6 class="page-title" style="text-align: center;">Trống!</i></h6>
                                            @endif
                                        </div>
                                        {{ $Product->links() }}
                                    </div>
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
    </div>
    <!-- end row -->
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
    <script>
        window.addEventListener('show-edit-product', event => {
            $('#edit-product').modal('show');
        })
    </script>
    <script>
        $(document).ready(function() {
            $("#search1").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#content1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script>
        window.addEventListener('show-list-stop-sale', event => {
            $('#list_stop_sale').modal('show');
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