@extends('layouts.themes.admin.smallreceipt')
@section('content')

<div style="width:50mm;">
    <div class="card">
        <div class="card-header">
            
            <table width="100%">
                <tr>
                    <td><p><img src="{{ asset('img/accounts/logo-1.jpg' ) }}" style="width:30px;"></p></td>
                    <td><p style="text-align:center;"><strong> MADAYAW PETROLEUM AND GAS CORPORATION</strong></p></td>
                </tr>
                <tr>
                    <td colspan="2"><p style="text-align:center;"> Park Avenue Cor. Lakatan St., Brgy. Wilfredo Aquino, Agdao, Davao City<p></td>
                </tr>
            </table>
        </div>
        <h3>PAYMENT RECEIPT</h3>
        <table width="100%">
            <tr>
                <td width="50%"><p><strong><i>{{ $payments->pmnt_ref_id }}</i></strong></p></td>
                <td width="50%"><small>{{ $payments->pmnt_date }} {{ $payments->pmnt_time }}</small></td>
            </tr>
        </table>
    </div>

    <div class="row">
        <table>
            <tr>
                <td width="50%">Reference No.:</td>
                <td width="50%">{{ $payments->trx_ref_id }}</td>
            </tr>
            <tr>
                <td width="50%">Customer Name:</td>
                <td width="50%">{{ $payments->cus_name }}</td>
            </tr>
            <tr>
                <td width="50%">Address:</td>
                <td width="50%">{{ $payments->cus_address }}</td>
            </tr>
            <tr>
                <td width="50%">Contact:</td>
                <td width="50%">{{ $payments->cus_contact }}</td>
            </tr>
        </table>
        <hr>
        <table>
            <tr>
                <td width="60%"><strong>Payment for</strong></td>
                <td width="40%"><strong>Amount Paid</strong></td>
            </tr>
            <tr>
                <td width="60%"><i>Pending Balance</i></td>
                <td width="40%">{{ number_format(session('pmnt_amount'), 2, '.', ',') }}</td>
            </tr>
        </table>

        <table>
            <tr>
                <td width="20%"></td>
                <td width="20%"></td>
                <td width="20%"></td>
                <td width="20%"></td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td colspan="5"><hr></td>
            </tr>
            <tr>
                <td colspan="1">M.O.P.</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ $payments->payment_name }}</td>
            </tr>
            <tr>
                <td colspan="1">Check #</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ session('pmnt_check_no') }}</td>
            </tr>
            <tr>
                <td colspan="1">Paid</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format(session('pmnt_amount'), 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Received</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($payments->pmnt_received, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Change</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($payments->pmnt_change, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="1">Balance</td>
                <td colspan="3"><hr></td>
                <td colspan="1">{{ number_format($payments->trx_balance, 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td colspan="5"><br></td>
            </tr>
            <tr>
                <td colspan="2">Issued by:</td>
                <td colspan="3">{{session('usr_full_name')}}</td>
            </tr>
            <tr>
                <td colspan="2">Received by:</td>
                <td colspan="3 ">{{ $payments->cus_name }}</td>
            </tr>
        </table>
    </div>
</div>

<script type="text/javascript">
    // Define a function to handle the beforeprint event
    function handleBeforePrint() {
        // Remove the event listener to prevent an infinite loop
        window.removeEventListener("beforeprint", handleBeforePrint);

        // Display a confirmation dialog to allow the user to select print settings
        if (confirm("Do you want a receipt?")) {
            // Open the print dialog
            setTimeout(function() {
                window.print();
            }, 500);
        }
        else{
            window.location.href = "{{ action('SalesController@payments') }}";
        }
    }

    // Add an event listener for the beforeprint event
    window.addEventListener("beforeprint", handleBeforePrint);

    // Call the print method when the page finishes loading
    window.addEventListener("load", function() {
        setTimeout(function() {
            window.print();
            window.location.href = "{{ action('SalesController@payments') }}";
        }, 500);
    });
</script>


@endsection