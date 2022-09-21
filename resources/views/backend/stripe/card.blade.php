@extends('backend.index')
@section('app')
    <div class="alert alert-danger alert-block hidden" id="alert">

        <button type="button" class="close" data-dismiss="alert">×</button>

        <strong id="message"></strong>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body" style="background:#E2146F;">
                    <div style="background: white;width:fit-content;margin: 0rem auto;">
                        <img src="https://www.bkash.com/sites/all/themes/bkash/logo.png?87980" alt="" class="img-fluid">
                    </div>
                    <div class="form-group">
                        <label class="" for="">Bkash No</label>
                        <input id="transaction_id" type="text" class="form-control" placeholder="Your Bkash No Please"/>
                    </div>

                    <div class="form-group">
                        <label for="">Referce No</label>
                        <input type="text" min="0" step="1" class="form-control" placeholder="Your Reference Id"/>
                    </div>

                    <div class="form-group text-center">
                        <button onclick="PayWithBkash" id="bkash-button-proceed" class="btn btn-lg"
                                style="background:#DD1C5E;">Proceed
                        </button>
                        <button data-dismiss="modal" id="bkash-button-container" class="btn btn-lg"
                                style="background:#DD1C5E;">Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-box" id="login-box">
        <div class="header">Card Info</div>
        <div class="body bg-gray">
            <div class="form-group">
                <label for="">Card Holder Name</label>
                <input type="text" id="card-holder-name" class="form-control" placeholder="John Doe"
                       value="{{ auth()->user()->name }}"/>
            </div>

            <div class="form-group">
                <label for="">Donation Amount(USD):</label>
                <input type="number" min="0" step="1" id="amount" class="form-control" value="10"/>
            </div>

        </div>
        <div class="footer">
            <div class="form-group">
                <div id="paypal-button-container"></div>
            </div>
            <div class="form-group">
                <button data-toggle="modal" data-target="#exampleModal" id="bkash-button-container" class="btn"
                        style="background:#DD1C5E;color:white;text-align:center;border-radius:50px;padding:1rem 2rem;font-size:1.5rem;height:40px;width:100%;">
                    Pay
                    With Bkash
                </button>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AXiUEy0yma879hVVJmmWUI_jA4Mh9Cr1CsnFqAuIjAx4ctnU2gMX1OED1NNacRrbOoP-YCtjpkAVXiSn&currency=USD&intent=capture"
        data_source="integrationbuilder"></script>

    <script>
        document.getElementById('bkash-button-proceed').addEventListener('click', PayWithBkash)

        function PayWithBkash() {
            if (!$('#transaction_id').val()) {
                alert('Please Give Every Field')
                return false;
            }
            fetch('{{ route("home.stripe.post") }}', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    amount: $('#amount').val(),
                    paid_for: "DONATION",
                    paid_by: "bkash",
                    transaction_id: $('#transaction_id').val()
                })
            })
                .then((val) => {
                    alert('Payment Successful')
                   // window.location.href = '/';
                }).catch((err) => console.log(err))
            // const payerName = details.payer.name.given_name
            console.log('Transaction completed!')
        }

        const fundingSources = [
            paypal.FUNDING.PAYPAL
        ]

        for (const fundingSource of fundingSources) {
            const paypalButtonsComponent = paypal.Buttons({
                fundingSource: fundingSource,

                // optional styling for buttons
                // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
                style: {
                    shape: 'pill',
                    height: 40,
                },

                // set up the transaction
                createOrder: (data, actions) => {
                    // pass in any options from the v2 orders create call:
                    // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                    const createOrderPayload = {
                        purchase_units: [{
                            amount: {
                                value: $('#amount').val(),
                            },
                        },],
                    }

                    return actions.order.create(createOrderPayload)
                },

                // finalize the transaction
                onApprove: (data, actions) => {
console.log(data)
                    const captureOrderHandler = (details) => {
                        fetch('{{ route("home.stripe.post") }}', {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            body: JSON.stringify({
                                amount: $('#amount').val(),
                                paid_for: "DONATION",
                                paid_by: "stripe",
                                transaction_id: details.token?? Date.now()
                            })
                        })
                            .then((val) => {
                                console.log(val)
                                alert('Payment Successful')
                            }).catch((err) => console.log(err))
                        // const payerName = details.payer.name.given_name
                        console.log('Transaction completed!')
                    }
                    return actions.order.capture().then(captureOrderHandler)
                },

                // handle unrecoverable errors
                onError: (err) => {
                    console.log(err)
                    console.error(
                        'An error prevented the buyer from checking out with PayPal',
                    )
                    // window.location.reload()
                },
            })

            if (paypalButtonsComponent.isEligible()) {
                paypalButtonsComponent
                    .render('#paypal-button-container')
                    .catch((err) => {
                        console.error('PayPal Buttons failed to render')
                    })
            } else {
                console.log('The funding source is ineligible')
            }
        }
    </script>
@endpush
