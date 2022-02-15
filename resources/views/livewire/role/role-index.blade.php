<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);"> Quản lý tài khoản</a></li>
                        <li class="breadcrumb-item active">Quản lý Role </li>
                    </ol>
                </div>
                <h4 class="page-title">Quản lý Role </h4>
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
    </div>
    <div class="row">
        <div class="col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">

                <button data-bs-target="#create-role" data-bs-toggle="modal" style='margin-bottom:10px;' class="btn btn-primary btn-rounded waves-effect waves-light">
                    THÊM ROLE
                </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mb-4">Danh sách Role</h4>
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
                                    <th>Quyền của Role</th>
                                    <th class='text-center'>Hành động</th>
                                </tr>
                            </thead>

                            <tbody id='content'>
                                <?php $temp = 0; ?>
                                @if(!empty($roles))
                                    @foreach ($roles as $role)
                                        <tr>
                                            <td scope="row">{{++$loop->index}}</td>
                                            <td scope="row"> <span class="badge bg-success">{{$role->id}}</span></td>
                                            <td scope="row">{{$role->name}}</td>
                                            <td scope="row"><span class="badge  text-primary">
                                                    @foreach( $permission as $per=>$val)
                                                        @if($role->hasPermissionTo($val['name']))
                                                            {{ '| '.$val['title'] }}
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </td>                                           
                                            <td scope="row" class='text-center'>
                                                @if($role->name != 'Admin')
                                                    <button wire:click="deleteRole({{ $role->id }})" class="btn btn-soft-danger btn-rounded waves-effect waves-light">
                                                        <i class="mdi mdi-delete" title='Xóa'></i>
                                                    </button>
                                                @endif
                                            </td>                                           
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
                        {{$roles->links()}}
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" wire:ignore.self id="create-role" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form class="permission" method="GET" wire:submit.prevent='addRole'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Tạo nhóm người dùng</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card border-primary border mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        @if ($errors->any())
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h4 class="header-title">Tên nhóm người dùng</h4>
                                                    <br />
                                                    <div class="mb-3 row">
                                                        <div class="col-sm-10">
                                                            <input wire:model.lazy='role' type="text" class="form-control" value="">
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <br />
                                                <br />
                                                <br />
                                            </div>
                                            <div class='row'>
                                                <div class="col-lg-6">
                                                    <h4 class="header-title">Thêm quyền cho nhóm</h4>
                                                    <br />
                                                    @foreach($permission as $results => $per)
                                                        <div class="form-check mb-2 form-check-danger">
                                                            <input class="form-check-input" wire:model.lazy='per' type="checkbox" value="{{ $per['name'] }}" id="customckeck7">
                                                            <label class="form-check-label" for="customckeck7">{{ $per['title'] }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button style='padding-left: 30px;padding-right: 30px;'  class="btn btn-success" type="submit"><i class="mdi mdi-check"></i> XONG </button>
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