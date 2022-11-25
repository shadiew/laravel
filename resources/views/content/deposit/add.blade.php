@extends('layouts/contentLayoutMaster')

@section('title', 'Add Deposit')

@section('content')

<div class="row match-height">
    <div class="col-12 col-md-6 col-lg-7">
        <!-- Payment -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Silakan isi form dibawah untuk melakukan deposit</h4>
            </div>
            <div class="card-body">
                <div class="card-text">

                    <form class="form form-vertical" method="POST" action="/deposit/add">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="input-deposit">Jumlah Deposit</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                                        </div>
                                        <input type="text" class="input-deposit form-control" id="amount" name="amount" placeholder="100.000" aria-label="Deposit" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-group">
                                    <label for="input-deposit">
                                        <h5>Metode Pembayaran</h5>
                                    </label>
                                    @foreach ($paymentMethods as $method)
                                    <div class="custom-control custom-radio mb-2">
                                        <input type="radio" id="{{$method->code}}" name="method" class="custom-control-input mb-auto mt-auto" checked="" value="{{$method->code}}">
                                        <label class="custom-control-label" for="{{$method->code}}">{{$method->name}} <img src="/images/payment/{{$method->code}}.webp" style="height: 2rem;"></label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <button type="sumbit" class="btn btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!--/ Payment -->
    </div>

    <div class="col-12 col-md-6 col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Detail Metode Pembayaran</h4>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <div id="information"></div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
@section('page-script')
<script src="/vendors/js/forms/cleave/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        var cleave = new Cleave('.input-deposit', {
            numeral: true,
            numeralDecimalMark: 'thousand',
            delimiter: '.'
        });

        var paymentMethods = <?php echo json_encode($paymentMethods); ?>;
        var selectedPayment;
        $('input:radio[name="method"]')
            .change(function() {
                var str = "";
                str += $(this).val();
                selectedPayment = paymentMethods.filter(function(payment) {
                    return payment.code == str;
                });
                if (selectedPayment.length > 0) {
                    $("#information").html("<span>" + selectedPayment[0]?.note + "</span><br><b>Admin Fee: " + selectedPayment[0]?.rate + "</b><hr><br><h5>Seluruh pembayaran akan otomatis langsung masuk deposit tanpa perlu konfirmasi manual.</h5>");
                } else {
                    $("#information").html("<span>Please Select Payment</span>");
                }
            })
            .change();
    });
</script>
@endsection