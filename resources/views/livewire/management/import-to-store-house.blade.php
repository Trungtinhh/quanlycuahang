<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Trang chủ</li>
                        <li class="breadcrumb-item active">Quản lý kho</li>
                        <li class="breadcrumb-item active">Nhập hàng</li>
                    </ol>
                </div>
                <h4 class="page-title">Nhập hàng </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('management.import') }}">
                                    <button style='margin-bottom:10px;' class="btn btn-danger btn-rounded waves-effect waves-light">
                                        NHẬP KHO
                                    </button>
                                </a>
                            </div>
                            <div class="card">
                                <h5>Lịch sử nhập kho</h5>
                                <div class="card-body">
                                    <div class='col-3'>
                                        <input class="form-control" id="search1" type="text" placeholder="Tìm kiếm trong bảng hiện tại..">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                                            <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>ID</th>
                                                    <th>Tên</th>
                                                    <th>HSD</th>
                                                    <th>Số lô</th>
                                                    <th>Nhà cung cấp</th>
                                                    <th>Số lượng nhập</th>
                                                    <th>Đơn vị</th>
                                                    <th>Ngày nhập</th>
                                                    <th class="text-center">Hành động</th>
                                                </tr>
                                            </thead>

                                            <tbody id='content1'>
                                                <?php $temp = 0; ?>
                                                @if(!empty($Import))
                                                @foreach($Import as $value)                                             
                                                <tr>
                                                    <th scope="row">{{ ++$loop->index }}</th>
                                                    <th scope="row">#{{ $value->id }}</th>
                                                    <th scope="row">{{ $value->product->product_name }}</th>
                                                    <th scope="row" class='text-primary'>{{ $value->product->productDetail->date_exp }}</th>
                                                    <th scope="row">{{ $value->product->productDetail->shipment_number }}</th>
                                                    <th scope="row">{{ $value->product->productDetail->provider->provider_name }}</th>
                                                    <th scope="row">{{ $value->amount_add }}</th>
                                                    <th scope="row">{{ $value->product->productDetail->unit }}</th>
                                                    <th scope="row"><span class="badge bg-success">{{ $value->date_add }}</span></th>
                                                    @canany(['system.permission.management'])
                                                    <td scope="row" class="text-center">
                                                        <button wire:click="undoImport({{ $value->id }})" class="btn btn-danger btn-rounded waves-effect waves-light">
                                                            <i class="mdi mdi-undo" title='Hoàn tác'></i>
                                                        </button>
                                                    </td>
                                                    @endcanany
                                                </tr>
                                                <?php $temp++; ?>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="page-title-box">
                                            @if($temp == 0)
                                            <h6 class="page-title" style="text-align: center;">Trống!</i></h6>
                                            @endif
                                        </div>
                                        {{ $Import->links() }}
                                    </div>
                                </div>
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>

                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    @section('script')
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
        $(document).ready(function() {
            $("#search2").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#content2 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
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