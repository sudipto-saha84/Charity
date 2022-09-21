@include('frontend.partial.header')


    <div class="container">

        <h2 class="title-style-1">Our Events <span class="title-under"></span></h2>

        <div class="row" >
            @foreach ($events as $event)
                <div class="col-md-6 ">

                <div class="cause" >

                    <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="cause-img img-fluid">

                    <div STYLE="height: 28rem;">


                        <h4 class="cause-title"><a href="{{route('eventsDetail',$event->id)}}">{{ $event->title }} </a></h4>
                        <div class="cause-details">
                            {{ Str::limit($event->description,70,'...') }}
                        </div>
                        @if ($event->isComing())
                            <h4 class="cause-title">Upcoming Event</h4>
                        @else
                            <h4 class="cause-title">Completed Event</h4>
                        @endif
                        <h4 class="cause-title">{{ Carbon\Carbon::create($event->event_date)->diffForHumans() }}</h4>
                        <div class="btn-holder text-center">

                            <a href="{{ route('home.donate') }}" class="btn btn-primary"> DONATE
                                NOW</a>

                        </div>

                    </div>

                </div> <!-- /.cause -->

        </div>
        @endforeach


    </div>


