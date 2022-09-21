@extends('backend.master')

@section('breadcrumbs', Breadcrumbs::render('home.events'))

@section('main_content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Slider Data Table</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="datatable" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Small Title</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach (\App\Models\Slider::all() as $slider)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>

                                        <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}"
                                             style="width: 50px;">
                                    </td>
                                    <td>{{ $slider->big_title }}</td>
                                    <td>{{ $slider->small_title }}</td>
                                    <td style="display: flex; justify-content:space-around; align-items: center;">
                                        @role('Admin')
                                        <form action="{{ route('home.users.delete-slider', $slider->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete </button>
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
@endsection

@push('script')
    <script type="text/javascript">
        $(function() {
            $("#datatable").dataTable();
        });

    </script>
@endpush
