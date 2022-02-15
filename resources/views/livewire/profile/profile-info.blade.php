<div>
    <div class="container bootstrap snippet">
        <div class="row">
            <div class="col-sm-12">
                <h1 class='title'>Thông tin tài khoản</h1>
            </div>
        </div>
        <br /><br /><br />
        <div class='card'>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="">Thông tin chung</h3>
                    </div>
                    <div class="col-sm-8">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <form class="form" method="post" wire:submit.prevent='editProfile'>
                                    @csrf
                                    @if(empty(Auth::user()->profile_photo_path))
                                    <div class="border border-primary m-1 p-1" style="width:fit-content;">
                                        <img src="{{ asset('image/unnamed.png') }}" alt="">
                                    </div>

                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="first_name">
                                                <h4>Hình đại diện</h4>
                                            </label>
                                            <input type="file" wire:model.lazy='image' class="form-control" name="first_name" id="first_name" placeholder="Chọn hình">
                                            @error('image')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @else
                                    <div class="border border-primary m-1 p-1" style="width:fit-content;">
                                        <img src="{{ asset('storage/'.Auth::user()->profile_photo_path) }}" height='200' alt="">
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="first_name">
                                                <h4>Hình đại diện</h4>
                                            </label>
                                            <input type="file" wire:model.lazy='image' value="" class="form-control" name="first_name" id="first_name" placeholder="" title="Tên">
                                            @error('image')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="first_name">
                                                <h4>Tên</h4>
                                            </label>
                                            <input type="text" wire:model.lazy='name' value="" class="form-control" name="first_name" id="first_name" placeholder="{{ Auth::user()->name }}" title="Tên">
                                            @error('name')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @foreach( $info as $value)
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="phone">
                                                <h4>Số điện thoại</h4>
                                            </label>
                                            <input type="text" wire:model.lazy='phone' value="" class="form-control" name="phone" id="phone" placeholder="{{ $value->phone }}" title="Số điện thoại">
                                            @error('phone')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="birthday">
                                                <h4>Ngày sinh</h4>
                                            </label>
                                            <input type="text" wire:model.lazy='birthday' value="" id="basic-datepicker" class="form-control" placeholder="{{ $value->birthday }}" title="Ngày sinh">
                                            @error('birthday')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="mobile">
                                                <h4>Địa chỉ</h4>
                                            </label>
                                            <input type="text" wire:model.lazy='address' value="" class="form-control" name="mobile" id="mobile" placeholder="{{ $value->address }}" title="Địa chỉ">
                                            @error('address')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <div class="col-xs-6">
                                            <label class="form-check-label" for="email">
                                                <h4>Email</h4>
                                            </label>
                                            <input type="email" wire:model.lazy='email' value="" class="form-control" name="email" id="email" placeholder="{{ $value->email }}" title="Email">
                                            @error('email')
                                            <div class="text-danger" role="alert">
                                                {{ $message}}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="form-group">
                                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                            <div class="col-xs-12">
                                                <br>
                                                <button class="btn btn-outline-warning" type="reset"><i class="glyphicon glyphicon-repeat"></i> Hoàn tác</button>
                                                <button class="btn btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Lưu</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--/tab-pane-->
                        </div>

                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
        <!--/card-->
        <div class='card'>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h3 class="">Cập nhật mật khẩu</h3>
                    </div>
                    <div class="col-sm-6">
                        <div class="tab-content">
                            <div class="tab-pane active" id="home">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @if(!empty($message))
                                        <div class="alert alert-success" role="alert">
                                            {{ $message}}
                                        </div>
                                        @endif
                                    </div>
                                </div>

                                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.update-password-form')
                                </div>

                                <x-jet-section-border />
                                @endif
                                <br />
                            </div>
                            <!--/tab-pane-->
                        </div>

                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
        @if(Auth::user()->email != 'admin@gmail.com')
        <div class='card'>
            <div class='card-body'>
                <div class="row">
                    <div class="col-sm-5">
                        <h3 class="">Xóa tài khoản</h3>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <div class="tab-pane active" id="home">
                                <span class='label'>Ấn XÓA để xóa tài khoản vĩnh viễn</span>
                                <button data-bs-target="#delete-account" data-bs-toggle="modal" style='margin-left:50px;' class="btn btn-lg btn-danger" type="reset"><i class="glyphicon glyphicon-repeat"></i>Xóa</button>
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" wire:ignore.self id="delete-account" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    Bạn chắc chắn muốn xóa tài khoản của mình chứ ?
                </div>
                <div class="modal-footer">
                    <button wire:click='deleteAccount' style='padding-left: 30px;padding-right: 30px;' class="btn btn-danger" type="button"> XÓA </button>
                </div>
            </div><!-- /.modal-content -->
            </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    @section('css')
    <link href="../assets/libs/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    @endsection
    @section('script')
    <script src="../assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="../assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
    <script src="../assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!-- Init js-->
    <script src="../assets/js/pages/form-pickers.init.js"></script>
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