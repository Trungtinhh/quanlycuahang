<div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Quán coffee</a></li>
                        <li class="breadcrumb-item active">Nhà cung cấp</li>
                    </ol>
                </div>
                <h4 class="page-title">Nhà cung cấp</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-xl-12 order-xl-1 order-2">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="text-md mt-3 mt-md-0">
                                <form wire:submit.prevent='filter'>
                                    <label for="product-name" class="form-label">Lọc theo mối quan hệ</label>
                                    <div class="row">
                                        <div class="col-5">
                                            <select wire:model.lazy='filter' class="form-control">
                                                <option value="">Chọn</option>
                                                <option value="{{1}}">Thân thiết</option>
                                                <option value="{{2}}">Bình thường</option>
                                            </select>
                                        </div>
                                        <div class="col-7">
                                            <button type="submit" class="btn btn-secondary waves-effect waves-light"><i class="mdi mdi-filter me-1"></i> Lọc </button>
                                            @if($statusFilter)
                                                <button type="button" wire:click='closeFilter' class="btn btn-primary waves-effect waves-light"><i class="mdi mdi-close me-1"></i> Bỏ lọc </button>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- end col-->
                        <div class="col-md-5">
                            <div class="text-md-end mt-3 mt-md-0">
                                <button type="button" wire:click='resetAll' class="btn btn-danger waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#add-provider"><i class="mdi mdi-plus-circle me-1"></i> Thêm </button>
                            </div>
                        </div><!-- end col-->
                    </div> <!-- end row -->
                </div> <!-- end card-body-->
            </div> <!-- end card-->
            @if(!$statusFilter)
                @foreach($provider as $pro)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex align-self-center me-3 rounded-circle" src="{{asset('storage/'.$pro->image)}}" alt="Generic placeholder image" width="100px;" height="100px;">
                                        <div class="w-100">
                                            <h4 class="mt-0 mb-2 font-16">{{ $pro->provider_name }}</h4>
                                            <p class="mb-1"><b>Địa chỉ:</b> {{ $pro->address }}</p>
                                            <p class="mb-0"><b>Quan hệ:</b> @if($pro->relationship == 1) {{ 'Thân thiết' }} @else {{ 'Bình thường' }} @endif</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email me-1"></i> {{ $pro->email }}</p>
                                    <p class="mb-0"><i class="mdi mdi-phone-classic me-1"></i> 0{{ $pro->phone }}</p>
                                </div>
                                <div class="col-sm-2">
                                    <div class="text-center mt-3 mt-sm-0">
                                        @if($pro->relationship == 1) <div class="badge font-14 bg-soft-success rounded-circle p-1"><i class="fa fa-star" style="font-size:20px;color:yellow"></i></div>@endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="text-sm">
                                        <a wire:click='editProvider({{ $pro }})' class="action-icon bg-primary text-light"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-->
                @endforeach
            @else
                @foreach($providerFilter as $pro)
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex align-self-center me-3 rounded-circle" src="{{ asset('storage/'.$pro->image) }}" alt="Generic placeholder image" width="100px;" height="100px;">
                                        <div class="w-100">
                                            <h4 class="mt-0 mb-2 font-16">{{ $pro->provider_name }}</h4>
                                            <p class="mb-1"><b>Địa chỉ:</b> {{ $pro->address }}</p>
                                            <p class="mb-0"><b>Quan hệ:</b> @if($pro->relationship == 1) {{ 'Thân thiết' }} @else {{ 'Bình thường' }} @endif</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <p class="mb-1 mt-3 mt-sm-0"><i class="mdi mdi-email me-1"></i> {{ $pro->email }}</p>
                                    <p class="mb-0"><i class="mdi mdi-phone-classic me-1"></i> 0{{ $pro->phone }}</p>
                                </div>
                                <div class="col-sm-2">
                                    <div class="text-center mt-3 mt-sm-0">
                                        @if($pro->relationship == 1) <div class="badge font-14 bg-soft-success rounded-circle p-1"><i class="fa fa-star" style="font-size:20px;color:yellow"></i></i></div>@endif
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="text-sm">
                                        <a wire:click='editProvider({{ $pro }})' class="action-icon bg-primary text-light"> <i class="mdi mdi-square-edit-outline"></i></a>
                                        <a wire:click='deleteProvider({{ $pro->id }})' class="action-icon bg-danger text-light"> <i class="mdi mdi-delete"></i></a>
                                    </div>
                                </div> <!-- end col-->
                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-->
                @endforeach
            @endif
            <!-- <div class="text-center my-4">
                <a href="javascript:void(0);" class="text-danger"><i class="mdi mdi-spin mdi-loading me-1"></i> Đang tải </a>
            </div> -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
    <div class="modal fade" wire:ignore.self id="add-provider" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                <div class="card">
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

                                <div class="card">
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
    @if($statusEditProvider)
        <div class="modal fade" wire:ignore.self id="edit-provider" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="GET" wire:submit.prevent='storeEdit'>
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Sửa nhà cung cấp</h4>
                            <button type="button" wire:click='' class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card">
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

                                    <div class="card">
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
                                                    @if (!empty($provider_edit['image']))
                                                        Ảnh hiện tại:
                                                        <img src="{{ asset('storage/'.$provider_edit['image']) }}" width="100px">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-7">
                                                    @if ($image)
                                                        Ảnh tải lên: <br>
                                                        <img src="{{ $image->temporaryUrl() }}" width="100px">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end col-->
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
    @endif
    @section('script')
        <script>
            window.addEventListener('show-edit', event => {
                $('#edit-provider').modal('show');
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