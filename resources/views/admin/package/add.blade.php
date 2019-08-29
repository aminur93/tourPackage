@extends('admin.layouts.master')

@section('page')
    Add Package
@stop

@push('css')
@endpush

@section('content')
    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
        @if (Session::has('error'))
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif

        @if (Session::has('msg'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('msg') !!}</strong>
            </div>
        @endif
        <div class="box-header with-border">
            <h3 class="box-title">Create Package</h3>
        </div>
        <!-- /.box-header -->
        <form action="{{ route('package.store') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Package Name</label>
                            <input type="text" name="package_name" class="form-control">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Package Type</label>
                            <select name="packagetype_id" id="" class="form-control">
                                <option value="">Select</option>
                                @foreach($type as $ty)
                                    <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="">Banner</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Destination Name </label>
                            <input type="text" name="destination_name" class="form-control">
                        </div>
                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="date" name="duration" class="form-control">
                        </div>
                        <!-- /.form-group -->

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="images[]" class="form-control" multiple>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                Please Create Package here
                <button type="submit" class="btn btn-sm btn-success pull pull-right">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.box -->
@stop

@push('js')
@endpush