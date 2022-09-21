@extends('backend.master')

@section('main_content')
    <div class="container">
        <div class="row" style="display:flex; justify-content: center;">
            <div class="col-md-8">
                <a href="{{ route('home.dashboard') }}" class="btn btn-primary">Back</a>
                <br> <br>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Create Slider</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('home.users.store-slider')}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="title">Slider Title: </label>
                                <input type="text" name="big_title" class="form-control" placeholder="Title"
                                       required />
                            </div>
                            <div class="form-group">
                                <label for="title">Slider Small Title: </label>
                                <input type="text" name="small_title" class="form-control" placeholder="Title"
                                       required />
                            </div>
                            <div class="form-group">
                                <label for="image">SLider Picture</label>
                                <input type="file" class="form-control" name="image" accept="image/*">
                                @error('image')
                                <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
