<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">Quán cafe</li>
                        <li class="breadcrumb-item active">Quản lý nhân sự</li>
                        <li class="breadcrumb-item active">Lương</li>
                    </ol>
                </div>
                <h4 class="page-title">Lương </h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="text-md-end mt-3 mt-md-0">
                <button type="button" wire:click='closeModal' class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#calculator-wage"><i class="mdi mdi-calculator mr-1"></i> Tính lương </button>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class='col-3'>
                        <input class="form-control" id="search" type="text" placeholder="Tìm kiếm trong bảng hiện tại..">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover m-0 table-centered dt-responsive nowrap w-100" id="tickets-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ngày tính</th>
                                    <th>Tên nhân viên</th>
                                    <th>Lương cơ bản</th>
                                    <th>Doanh số</th>
                                    <th>Thưởng</th>
                                    <th>Khấu trừ</th>
                                    <th>Lương</th>
                                    <th>Ghi chú</th>
                                </tr>
                            </thead>

                            <tbody id='content'>
                                <?php $temp = 0; ?>
                                @if(!empty($wage))
                                <?php $dem = 1; ?>
                                @foreach ($wage as $vl)
                                <tr>
                                    <th scope="row"> <span class="badge bg-success">#{{$vl->id}}</span></th>
                                    <th scope="row">{{$vl->salary_date}}</th>
                                    <th scope="row">{{$vl->user_name}}</th>
                                    <td scope="row"><span class="badge bg-warning text-light">{{ number_format($vl->wage_basic) }} </td>
                                    <td scope="row">{{ number_format($vl->sales_money) }}</span></td>
                                    <td scope="row"><span class="badge bg-success text-light">{{number_format($vl->bonus)}}</span></td>
                                    <td scope="row">{{number_format($vl->deduct)}}</td>
                                    <td scope="row"><span class="badge bg-danger text-light">{{number_format($vl->wage)}}</span></td>
                                    <td scope="row">{{$vl->note}}</td>
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
                            <h6 class="page-title" style="text-align: center;">Chưa tính lương!</h6>
                            @endif
                        </div>
                        {{$wage->links()}}
                    </div>
                </div>
            </div>
        </div><!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" wire:ignore.self id="calculator-wage" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form method="GET" wire:submit.prevent='calculatorWage'>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myLargeModalLabel">Tính lương</h4>
                        <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card border border-primary">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="product-name" class="form-label">Nhân viên<span class="text-danger">*</span></label>
                                            <select wire:model.lazy='staff' class="form-control">
                                                <option value="">Chọn</option>
                                                @foreach($Staff as $value)
                                                <option value="{{ $value->staff_name }}">{{ $value->staff_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('staff')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-reference" class="form-label">Lương cơ bản<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='wage_basic' id="product-reference" class="form-control">
                                            @error('wage_basic')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Doanh số<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='sales_money' class="form-control">
                                            @error('sales_money')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Thưởng<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='bonus' class="form-control">
                                            @error('bonus')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Khấu trừ<span class="text-danger">*</span></label>
                                            <input type="number" min='0' wire:model.lazy='deduct' class="form-control">
                                            @error('deduct')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="text-uppercase bg-light p-2 mt-0 mb-3">
                                            <div class="row">
                                                <div class="col-2">
                                                    <button type="button" wire:click='calculatorTemp' class="btn btn-warning waves-effect waves-light"><i class="mdi mdi-calculator mr-1"></i> Tính </button>
                                                </div>
                                                <div class="col-3">
                                                    <input type="text" min='0' readonly wire:model.lazy='wage_temp' class="form-control">
                                                </div>
                                                <div class="col-1" style="margin:7px;">
                                                    VND
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="product-description" class="form-label">Ghi chú<span class="text-danger">*</span></label>
                                            <input type="text" min='0' wire:model.lazy='note' class="form-control">
                                            @error('note')
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end card -->
                            </div> <!-- end col -->
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