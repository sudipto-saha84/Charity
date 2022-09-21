@include('frontend.partial.header')
<img src="{{ asset($event->image) }}" style="width:100%;height:60vh;" alt="">

<div class="container" style="padding-top:6rem;">
    <h1 class="text-center">{{$event->title}}</h1>
    <p class="text-center">{{$event->description}}</p>
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
                                    <iframe width="100%" height="315" src="{{ $event->video }}"
                                        title="YouTube video player" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        @endif
</div>
@include('frontend.partial.footer')