@extends('layouts/contentLayoutMaster')

@section('title', 'Ambil Layanan')

@section('content')

<div class="row match-height">
    <div class="col-12 col-md-6 col-lg-7">
        <!-- Payment -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Grab Service</h4>
            </div>

            <div class="card-body">
                <div class="card-text">

                    <form class="form form-vertical" method="POST" action="/service/grab">
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
                                    <label for="provider">Pilih Provider</label>
                                    <select class="form-control" id="provider" name="provider">
                                        @foreach ($providers as $provider)
                                        <option value="{{$provider->id}}">{{$provider->code}} ({{$provider->currency}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control-success custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="switchMarkup">
                                        <label class="custom-control-label" for="switchMarkup">Markup Harga?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <div class="input-group input-group-merge mb-2">
                                        <input type="number" class="form-control" placeholder="100" aria-label="100" aria-describedby="percent" disabled id="markup" name="markup">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="percent">%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control-success custom-switch custom-control-inline">
                                        <input type="checkbox" class="custom-control-input" id="switchConvert">
                                        <label class="custom-control-label" for="switchConvert">Convert IDR?</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <div class="input-group input-group-merge mb-2">
                                        <input type="number" class="form-control" placeholder="15000" aria-label="15000" aria-describedby="perUsd" disabled id="convert" name="convert">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="perUsd">/USD</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-control-danger custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="deleteAll" name="delete">
                                        <label class="custom-control-label" for="deleteAll">Hapus semua layanan lama dari provider ini.</label>
                                    </div>
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

    <!-- <div class="col-12 col-md-6 col-lg-5">
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
    </div> -->

</div>

@endsection
@section('page-script')
<script src="/vendors/js/forms/cleave/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#switchMarkup').change(function() {
            if ($('#switchMarkup').is(':checked') == true) {
                $('#markup').prop('disabled', false);
                $('#percent').css('background-color', 'white');
            } else {
                $('#markup').val('').prop('disabled', true);
                $('#percent').css('background-color', '#efefef');
            }
        });

        $('#switchConvert').change(function() {
            if ($('#switchConvert').is(':checked') == true) {
                $('#convert').prop('disabled', false);
                $('#perUsd').css('background-color', 'white');
            } else {
                $('#convert').val('').prop('disabled', true);
                $('#perUsd').css('background-color', '#efefef');
            }
        });
    });
</script>
@endsection