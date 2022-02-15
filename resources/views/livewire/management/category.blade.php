<div>
    <div>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);"> Quản lý sản phẩm</a></li>
                                <li class="breadcrumb-item active">Quản lý danh mục</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Quản lý danh mục</h4>
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
                                    <div class="avatar-lg rounded-circle bg-soft-primary">
                                        <i class="fe-shopping-cart font-22 avatar-title text-success"></i>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-end">
                                        <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count }}</span></h3>
                                        <p class="text-muted mb-1 text-truncate">Tổng số</p>
                                    </div>
                                </div>
                            </div> <!-- end row-->
                        </div>
                    </div> <!-- end widget-rounded-circle-->
                </div> <!-- end col-->
            </div>
            @canany(['system.permission.management'])
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                <button data-bs-target="#create-category" data-bs-toggle="modal" wire:click='closeAdd' style='margin-bottom:10px;' class="btn btn-primary btn-rounded waves-effect waves-light">
                    THÊM DANH MỤC
                </button>
            </div>
            @endcanany
            <div class="row">
                @if(!empty($Category))
                @foreach($Category as $cate)
                <div class="col-xl-4 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    @canany(['system.permission.management'])
                                    <a wire:click='addProduct({{ $cate->id }})' class="dropdown-item">Thêm sản phẩm</a>
                                    @endcanany
                                    <a wire:click='detailCategory({{ $cate->id }})' class="dropdown-item">Chi tiết</a>
                                    @canany(['system.permission.management'])
                                    <a wire:click='deleteCategory({{ $cate->id }})' class="dropdown-item">Xóa danh mục</a>
                                    @endcanany
                                </div>
                            </div>
                            <h4 class="header-title mb-4">{{ $cate->category_name }}</h4>
                            <div class='text-center border'><img src='{{ asset("image/danhmuc.jpg") }}' width="345px;"></div>
                            <div class="row text-center mt-2 border">
                                <?php
                                $total = 0;
                                ?>
                                @if(!empty($Product))
                                @foreach($Product as $value)
                                @if($value->category_id == $cate->id)
                                <?php
                                $total++;
                                ?>
                                @endif
                                @endforeach
                                @endif
                                <div class="col-md-12 text-center">
                                    <h3 class="fw-normal mt-3">
                                        <span>{{ $total}}</span>
                                    </h3>
                                    <p class="text-muted mb-0 mb-2"><i class="mdi mdi-checkbox-blank-circle text-danger"></i> Tổng số sản phẩm</p>
                                </div>
                            </div>

                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card-->
                </div>
                @endforeach
                @endif
                <!-- end col -->
            </div>
            <div class="modal fade" wire:ignore.self id="create-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="GET" wire:submit.prevent='addCategory'>
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Thêm danh mục</h4>
                                <button type="button" wire:click='closeAdd' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card border-primary border mb-3">
                                    <div class="card-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            <h4 class="header-title">Tên danh mục:</h4>
                                                            <br />
                                                            <div class="mb-3 row">
                                                                <div class="col-sm-10">
                                                                    <input wire:model.lazy='category_name' type="text" class="form-control" value="">
                                                                    @error('category_name')
                                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                        {{ $message}}
                                                                    </div>
                                                                    @enderror
                                                                    @if(!empty($noti))
                                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                        {{ $noti }}
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br />
                                                        <br />
                                                        <br />
                                                    </div>
                                                    <div class='row'>
                                                        <div class="col-lg-12">
                                                            <?php $dem = 0; ?>
                                                            <table width='100%'>
                                                                <thead>
                                                                    <tr>
                                                                        <th width='100%'>Chọn sản phẩm:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-check form-check-inline mb-2 form-check-primary" style="margin: 20px;">
                                                                                <input class="form-check-input" wire:model.lazy='product_id' type="checkbox" value="{{ -1 }}">
                                                                                <label class="form-check-label" for="customckeck7">Không chọn sản phẩm</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th width='100%' class="border">
                                                                            @if(!empty($Product))
                                                                            @foreach($Product as $value)
                                                                            @if(empty($value->category_id))
                                                                            <div class="form-check form-check-inline mb-2 form-check-danger" style="margin: 33px;">
                                                                                <input class="form-check-input" wire:model.lazy='product_id' type="checkbox" value="{{ $value->id }}" checked>
                                                                                <label class="form-check-label" for="customckeck7">{{ $value->product_name }}</label>
                                                                            </div>
                                                                            <?php $dem++; ?>
                                                                            @endif
                                                                            @endforeach
                                                                            @if($dem == 0)
                                                                            <div style="margin: 10px;">
                                                                                <h6 class="text-danger"> <i data-feather="alert-triangle" class="icon-dual-danger"></i>Tất cả sản phẩm đã được thêm vào danh mục khác</h6>
                                                                            </div>
                                                                            @endif
                                                                            @endif
                                                                        </th>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            @error('product_id')
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
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button wire:click='closeAdd' type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                                <button wire:click='closeAdd' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" wire:ignore.self id="add-product" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <form method="GET" wire:submit.prevent='storeProduct'>
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Thêm sản phẩm vào danh mục : </h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="card border-primary border mb-3">
                                    <div class="card-body">
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class='row'>
                                                        <div class="col-lg-12">
                                                            <?php $dem = 0; ?>
                                                            <table width='100%'>
                                                                <thead>
                                                                    <tr>
                                                                        <th width='100%'>Chọn sản phẩm:</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th width='100%' class="border">
                                                                            @if(!empty($Product))
                                                                            @foreach($Product as $value)
                                                                            @if(empty($value->category_id))
                                                                            <div class="form-check form-check-inline mb-2 form-check-danger" style="margin: 20px;">
                                                                                <input class="form-check-input" wire:model.lazy='product_id' type="checkbox" value="{{ $value->id }}" checked>
                                                                                <label class="form-check-label" for="customckeck7">{{ $value->product_name }}</label>
                                                                            </div>
                                                                            <?php $dem++; ?>
                                                                            @endif
                                                                            @endforeach
                                                                            @if($dem == 0)
                                                                            <div style="margin: 10px;">
                                                                                <h6 class="text-danger"> <i data-feather="alert-triangle" class="icon-dual-danger"></i>Tất cả sản phẩm đã được thêm vào danh mục khác</h6>
                                                                            </div>
                                                                            @endif
                                                                            @endif
                                                                        </th>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                            @if($dem != 0)
                                                            @if(!empty($noti))
                                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                                {{ $noti }}
                                                            </div>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Close</button>
                                <button style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
            <div class="modal fade" wire:ignore.self id="detail-category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-full-width">
                    <form method="GET" wire:submit.prevent=''>
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="fullWidthModalLabel">Danh sách sản phẩm trong danh mục</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class='col-4'>
                                                    <input class="form-control" id="search" type="text" placeholder="Tìm kiếm...">
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Tên</th>
                                                                <th>Nhà cung cấp</th>
                                                                <th>Số lô</th>
                                                                <th>Số lượng</th>
                                                                <th>Đơn vị</th>
                                                                <th>Quy cách</th>
                                                                <th>Mô tả</th>
                                                                <th>HSD</th>
                                                                <th>Giá</th>
                                                                @canany(['system.permission.management'])
                                                                <th class="text-center">Hành động</th>
                                                                @endcanany
                                                            </tr>
                                                        </thead>

                                                        <tbody id='content'>
                                                            <?php $temp = 0; ?>
                                                            @if(!empty($ProductDetail))
                                                            @foreach($ProductDetail as $value)
                                                            @if($value->product->category_id == $category_id)
                                                            <tr>
                                                                <th scope="row">#{{ $value->id }}</th>
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
                                                                    <button wire:click="deleteProductInCategory({{ $value->product_id }})" class="btn btn-danger btn-rounded waves-effect waves-light">
                                                                        <i class="mdi mdi-delete" title='Xóa sản phẩm khỏi danh mục'></i>
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
                                                    {{ $ProductDetail->links() }}
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
                    </form>
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
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
            window.addEventListener('show-add-product', event => {
                $('#add-product').modal('show');
            })
        </script>
        <script>
            window.addEventListener('show-detail-category', event => {
                $('#detail-category').modal('show');
            })
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
</div>