<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> Quản lý nhân sự</a></li>
                        <li class="breadcrumb-item active">Danh sách nhân sự </li>
                    </ol>
                </div>
                <h4 class="page-title">Danh sách nhân sự </h4>
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
                            <div class="avatar-lg rounded-circle bg-pink">
                                <i class="fe-tag font-22 avatar-title text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-home">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $count }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">Tổng số</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div>
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                <button wire:click='resetAll' data-bs-target="#create-personel" data-bs-toggle="modal" style='margin-bottom:10px;' class="btn btn-success btn-rounded waves-effect waves-light">
                    THÊM NHÂN SỰ
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Danh sách nhân sự</h4>
                    <div class='col-3'>
                        <input class="form-control" id="search" type="text" placeholder="Tìm kiếm trong bảng hiện tại..">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Chức vụ</th>
                                    <th class='text-center'>Hành động</th>
                                </tr>
                            </thead>

                            <tbody id='content'>
                                <?php $temp = 0; ?>
                                @if(!empty($personel))
                                @foreach($personel as $per)
                                <tr>
                                    <th scope="row">{{ ++$loop->index}}</th>
                                    <th scope="row"> <span class="badge bg-warning">{{$per->id}}</span></th>
                                    <th scope="row">{{$per->staff_name}}</th>
                                    <th scope="row">{{$per->address}}</th>
                                    <th scope="row">{{$per->phone}}</th>
                                    <th scope="row"><span class="badge bg-soft-success text-success">{{ $per->position }}</span></th>
                                    <th scope="row">
                                        <button wire:click="editPersonel({{ $per->id }})" class="btn btn-outline-primary btn-rounded waves-effect waves-light">
                                            Sửa
                                        </button>
                                        <button wire:click="deletePersonel({{ $per->id }})" class="btn btn-outline-danger btn-rounded waves-effect waves-light">
                                            Xóa
                                        </button>
                                    </th>

                                </tr>
                                <?php
                                $temp++;
                                ?>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="page-title-box">
                            @if($temp == 0)
                            <h6 class="page-title" style="text-align: center;">Trống!</h6>
                            @endif
                        </div>
                        {{$personel->links()}}
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" wire:ignore.self id="create-personel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="permission" method="GET" wire:submit.prevent='addPersonel'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm nhân sự</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-warning border mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">Tên nhân sự <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.lazy='per_name' id="product-name" class="form-control">
                                    @error('per_name')
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
                                    <input type="number" min='0' wire:model.lazy='phone' class="form-control">
                                    @error('phone')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="product-price">Chức vụ<span class="text-danger">*</span></label>
                                    <input type="text" wire:model.lazy='position' class="form-control">
                                    @error('position')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style='padding-left: 30px;padding-right: 30px;' class="btn btn-success" type="submit"><i class="mdi mdi-check"></i> XONG </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @if($statusEdit)
    <div class="modal fade" wire:ignore.self id="edit-personel" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="permission" method="GET" wire:submit.prevent='storeEditPersonel'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Thêm nhân sự</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-danger border mb-3">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">Tên nhân sự <span class="text-danger">*</span></label>
                                    <input type="text" wire:model.lazy='per_name' id="product-name" class="form-control">
                                    @error('per_name')
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
                                    <input type="number" min='0' wire:model.lazy='phone' class="form-control">
                                    @error('phone')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="product-price">Chức vụ<span class="text-danger">*</span></label>
                                    <input type="text" wire:model.lazy='position' class="form-control">
                                    @error('position')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style='padding-left: 30px;padding-right: 30px;' class="btn btn-success" type="submit"><i class="mdi mdi-check"></i> SỬA </button>
                    </div>
                </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endif
    @section('script')
    <script>
        window.addEventListener('show-edit', even => {
            $('#edit-personel').modal('show');
        })
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