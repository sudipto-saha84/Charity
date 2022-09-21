@include('frontend.partial.header')
<div class="container" style="padding-top:6rem;">
    <h2 class="text-center text-secondary">
        Total Donation
    </h2>
    <table class="table table-bordered" style="margin-top:2rem;">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Donate Date</th>
                <th scope="col">Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$payment->user->name}}</td>
                <td>{{$payment->user->email}}</td>
                <td>{{Carbon\Carbon::parse($payment->created_at)->diffForHumans()}}</td>
                <td>{{$payment->paid_amount}}  &#2547;</td>
            </tr>

            @empty
            <tr>
                <td colspan="4"> Not Have Any Donation</td>
            </tr>
            @endforelse
            @if (!empty($payments))
            <tr>
                <td colspan="2">Total:</td>
                <td colspan="3" class="text-right">{{$totalDonate}}  &#2547;</td>
            </tr>
            @endif

        </tbody>
    </table>
</div>
