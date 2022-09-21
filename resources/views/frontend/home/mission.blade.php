@include('frontend.partial.header')

<div class="container">

    <h2 class="title-style-1">Our Mission<span class="title-under"></span></h2>

    <div class="row">

        <div class="col-md-6 col-sm-6">

            <div class="cause">

                <img src="{{ asset('assets') }}/images/causes/cause-hunger.jpg" alt=""
                     class="cause-img">

                <div class="progress cause-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="30" aria-valuemin="0"
                         aria-valuemax="100" style="width: 30%;">
                        10$ / 500$
                    </div>
                </div>

                <h4 class="cause-title"><a href="#">HUNGER AND POVERTY </a></h4>
                <div class="cause-details">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra
                    elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                </div>

                <div class="btn-holder text-center">

                    {{-- <a href="{{route('home.donate')}}" class="btn btn-primary"> DONATE
                        NOW</a> --}}
                    <a href="{{ route('home.donate') }}" class="btn btn-primary"> DONATE
                        NOW</a>

                </div>



            </div> <!-- /.cause -->

        </div>

        <div class="col-md-6 col-sm-6">

            <div class="cause">

                <img src="{{ asset('assets') }}/images/causes/cause-education.jpg" alt=""
                     class="cause-img">

                <div class="progress cause-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                         aria-valuemax="100" style="width: 60%;">
                        400$ / 700$
                    </div>
                </div>

                <h4 class="cause-title"><a href="#">EDUCATION AND TRAINING</a></h4>
                <div class="cause-details">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra
                    elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                </div>

                <div class="btn-holder text-center">

                    <a href="{{ route('home.donate') }}" class="btn btn-primary"> DONATE
                        NOW</a>

                </div>



            </div> <!-- /.cause -->

        </div>


        <div class="col-md-6 col-sm-6">

            <div class="cause">

                <img src="{{ asset('assets') }}/images/causes/cause-rights.jpg" alt=""
                     class="cause-img">

                <div class="progress cause-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="40" aria-valuemin="0"
                         aria-valuemax="100" style="width: 40%;">
                        400$ / 1000$
                    </div>
                </div>

                <h4 class="cause-title"><a href="#">HUMAN RIGHTS</a></h4>
                <div class="cause-details">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra
                    elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                </div>

                <div class="btn-holder text-center">

                    <a href="{{ route('home.donate') }}" class="btn btn-primary"> DONATE
                        NOW</a>

                </div>



            </div> <!-- /.cause -->

        </div>

        <div class="col-md-6 col-sm-6">

            <div class="cause">

                <img src="{{ asset('assets') }}/images/causes/cause-culture.jpg" alt=""
                     class="cause-img">

                <div class="progress cause-progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0"
                         aria-valuemax="100" style="width: 60%;">
                        400$ / 700$
                    </div>
                </div>

                <h4 class="cause-title"><a href="#">ARTS AND CULTURE </a></h4>
                <div class="cause-details">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut at eros rutrum turpis viverra
                    elementum semper quis ex. Donec lorem nulla, aliquam quis neque vel, maximus lacinia urna.
                </div>

                <div class="btn-holder text-center">

                    <a href="{{ route('home.donate') }}" class="btn btn-primary"> DONATE
                        NOW</a>

                </div>



            </div> <!-- /.cause -->

        </div>

    </div>

</div>
