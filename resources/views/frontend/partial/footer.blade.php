<footer class="main-footer">

    <div class="footer-top">

    </div>


    <div class="footer-main">
        <div class="container">

            <div class="row">
                <div class="col-md-6">

                    <div class="footer-col">

                        <h4 class="footer-title">About us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <p>
                                <strong>DIU</strong>
                            </p>

                            <p>
                                We are a helping hand for the poorest people in this community
                            </p>

                        </div>

                    </div>

                </div>

                {{-- <div class="col-md-4"> --}}

                {{-- <div class="footer-col"> --}}

                {{-- <h4 class="footer-title">LAST TWEETS <span class="title-under"></span></h4> --}}

                {{-- <div class="footer-content"> --}}
                {{-- <ul class="tweets list-unstyled"> --}}
                {{-- <li class="tweet"> --}}

                {{-- 20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 --}}

                {{-- </li> --}}

                {{-- <li class="tweet"> --}}

                {{-- 20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 --}}

                {{-- </li> --}}

                {{-- <li class="tweet"> --}}

                {{-- 20 Surprise Eggs, Kinder Surprise Cars 2 Thomas Spongebob Disney Pixar  http://t.co/fTSazikPd4 --}}

                {{-- </li> --}}

                {{-- </ul> --}}
                {{-- </div> --}}

                {{-- </div> --}}

                {{-- </div> --}}


                <div class="col-md-6">

                    <div class="footer-col">

                        <h4 class="footer-title">Contact us <span class="title-under"></span></h4>

                        <div class="footer-content">

                            <div class="footer-form">

                                <div class="footer-form">

                                    <form class="ajax-form">

                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Name"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control"
                                                placeholder="E-mail" required>
                                        </div>

                                        <div class="form-group">
                                            <textarea name="message" class="form-control" placeholder="Message" required></textarea>
                                        </div>

                                        <div class="form-group alerts">

                                            <div class="alert alert-success" role="alert">

                                            </div>

                                            <div class="alert alert-danger" role="alert">

                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-submit pull-right">Send
                                                message</button>
                                        </div>

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>
                <div class="clearfix"></div>



            </div>


        </div>


    </div>

    <div class="footer-bottom">

        <div class="container text-right">
            DIU @ copyrights - by <a href="" target="_blank">DIU</a>
        </div>
    </div>

</footer> <!-- main-footer -->




<!-- Donate Modal -->
{{--<div class="modal fade" id="donateModal" tabindex="-1" role="dialog" aria-labelledby="donateModalLabel"--}}
{{--    aria-hidden="true">--}}

{{--    <div class="modal-dialog">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
{{--                        aria-hidden="true">&times;</span></button>--}}
{{--                <h4 class="modal-title" id="donateModalLabel">এখন ই আপনার সহযোগীতার হাত বাড়িয়ে ডিন </h4>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}

{{--                <h1></h1>--}}
{{--                <h2>এই মুহূর্তে আমরা শুধুমাত্র বিকাশে সহযোগীতা গ্রহণ করতেছি</h2>--}}
{{--                <h3><span style="color:yellowgreen;"> বিকাশ নম্বর </span> 01758877884 <sup>PERSONAL</sup></h3>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--</div> <!-- /.modal -->--}}





<!--  Scripts
================================================== -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script id="myScript" src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js">
</script>{{-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> --}}
<script>
    window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.min.js"><\/script>')
</script>

<!-- Bootsrap javascript file -->
<script src="{{ asset('assets') }}/js/bootstrap.min.js"></script>

<!-- owl carouseljavascript file -->
<script src="{{ asset('assets') }}/js/owl.carousel.min.js"></script>

<!-- Template main javascript -->
<script src="{{ asset('assets') }}/js/main.js"></script>

<script type="text/javascript">
    //alert("Right after init ");
    var accessToken = '';
    $(document).ready(function() {
        $.ajax({
            url: "token.php",
            type: 'POST',
            contentType: 'application/json',
            success: function(data) {
                console.log('got data from token  ..');
                console.log(JSON.stringify(data));

                accessToken = JSON.stringify(data);
            },
            error: function() {
                console.log('error');

            }
        });
        var paymentConfig = {
            createCheckoutURL: "createpayment.php",
            executeCheckoutURL: "executepayment.php",
        };

        var paymentRequest;
        paymentRequest = {
            amount: '105',
            intent: 'sale'
        };
        console.log(JSON.stringify(paymentRequest));
        bKash.init({
            paymentMode: 'checkout',
            paymentRequest: paymentRequest,
            createRequest: function(request) {
                console.log('=> createRequest (request) :: ');
                console.log(request);

                $.ajax({
                    url: paymentConfig.createCheckoutURL + "?amount=" + paymentRequest
                        .amount,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log('got data from create  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        var obj = JSON.parse(data);

                        if (data && obj.paymentID != null) {
                            paymentID = obj.paymentID;
                            bKash.create().onSuccess(obj);
                        } else {
                            console.log('error');
                            bKash.create().onError();
                        }
                    },
                    error: function() {
                        console.log('error');
                        bKash.create().onError();
                    }
                });
            },

            executeRequestOnAuthorization: function() {
                console.log('=> executeRequestOnAuthorization');
                $.ajax({
                    url: paymentConfig.executeCheckoutURL + "?paymentID=" + paymentID,
                    type: 'GET',
                    contentType: 'application/json',
                    success: function(data) {
                        console.log('got data from execute  ..');
                        console.log('data ::=>');
                        console.log(JSON.stringify(data));

                        data = JSON.parse(data);
                        if (data && data.paymentID != null) {
                            alert('[SUCCESS] data : ' + JSON.stringify(data));
                            window.location.href = "success.html";
                        } else {
                            bKash.execute().onError();
                        }
                    },
                    error: function() {
                        bKash.execute().onError();
                    }
                });
            }
        });




        function callReconfigure(val) {
            bKash.reconfigure(val);
        }

        function clickPayButton() {
            $("#bKash_button").trigger('click');
        }
        clickPayButton()
    });
</script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = '//www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X');
    ga('send', 'pageview');
</script>

</body>

</html>
