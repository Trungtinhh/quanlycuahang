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
                                                    <th>Nhà cung cấp</th>
                                                    <th>Số lượng nhập</th>
                                                    <th>Ngày nhập</th>
                                                    <th class="text-center">Hành động</th>
                                                </tr>
                                            </thead>

                                            <tbody id='content1'>
                                                <?php $temp = 0; ?>
                                            </tbody>
                                        </table>
                                        <div class="page-title-box">
                                            @if($temp == 0)
                                            <h6 class="page-title" style="text-align: center;">Trống!</i></h6>
                                            @endif
                                        </div>
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