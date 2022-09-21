@extends('backend.master')

@section('breadcrumbs', Breadcrumbs::render('home.events.create'))

@section('main_content')
    <div class="container">
        <div class="row" style="display:flex; justify-content: center;">
            <div class="col-md-8">
                <a href="{{ route('home.events.index') }}" class="btn btn-primary">Back</a>
                <br> <br>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Event</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset($event->image) }}" alt="" width="180" style="width: 180px;">
                            </div>
                            <div class="col-md-8">
                                <label for="title">Title:&nbsp;</label>
                                <span>{{ $event->title }}</span> <br>
                                <label for="description">Description:&nbsp;</label>
                                <span>{{ $event->description }}</span> <br>
                                <label for="place">Place:&nbsp;</label>
                                <span>{{ $event->place }}</span> <br>
                                <label for="">Event Schedule:&nbsp;</label>
                                <span>{{ date('h:i a', strtotime($event->time)) . ' ' . date('d/m/Y', strtotime($event->event_date)) }}</span>
                                <br>
                                <label for="status">Status:&nbsp;</label>
                                <span>{{ Carbon\Carbon::create($event->event_date)->diffForHumans() }}</span> <br>
                            </div>
                        </div>
                        <h5>More Images</h5>
                        <div class="row" style="gap: 0.6rem;">
                            @foreach ($event->imageble as $image)
                                <div class="col-md-4 col-12">
                                    <img src="{{ asset($image->image) }}" class="img-fluid" alt="" height="180">
                                </div>
                            @endforeach
                        </div>
                        @if ($event->video)
                            <div style="margin-top: 1rem;">
                                    <iframe width="560" height="315" src="{{ $event->video }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        @endif
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </div>
@endsection
