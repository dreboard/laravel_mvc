@extends('layouts.admin_dash')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.print.css" media="print">
@endpush



@section('content')
    <!-- Breadcrumbs-->
    <div id="invoice">

        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">User:</div>
                            <h2 class="to">{{$user->email}}</h2>
                            <div class="address">Rate: $40.00</div>
                            <div class="email">Projects: {{$projects}}</div>
                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">My Sites</h1>
                            <div class="date">Date of Invoice: 01/10/2018</div>
                            <div class="date">Due Date: 30/10/2018</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>Projects</th>
                            <th class="text-left">Site Name</th>
                            <th class="text-right">Rate</th>
                            <th class="text-right">HOURS</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($userSites as $site)
                        <tr>
                            <td class="w-10 no">{{$site['projects']}}</td>
                            <td class="w-75 text-left"><h3><a href="{{route("site_view", ['id' => $site['id']])}}"> {{ $site['title'] }}</a></h3>{{$site['description']}}</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">30</td>
                            <td class="total">$1,200.00</td>
                        </tr>
                        @endforeach

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$5,200.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$6,500.00</td>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="thanks">Totals</div>
                    <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                    </div>
                </main>
                <footer>
                    Invoice was created on a computer and is valid without the signature and seal.
                </footer>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
@endsection
@push('scripts')


@endpush