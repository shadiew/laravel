<link rel="stylesheet" type="text/css" href="/vendors/css/forms/select/select2.min.css">
@extends('layouts/contentLayoutMaster')

@section('title', 'Buat Pesanan Baru')

@section('content')

<div class="row match-height">
    <div class="col-12 col-md-6 col-lg-7">
        <!-- Payment -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Form Pemesanan</h4>
            </div>

            <div class="card-body">
                <div class="card-text">

                    <form class="form form-vertical" method="POST" action="/order/new">
                        @csrf
                        @if ($errors->any())
                        <div class="alert alert-danger p-2">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="category">Pilih Kategori</label>
                                    <select class="form-control basic-select2" id="category" name="category">
                                        <option></option>
                                        @foreach ($serviceCategories as $serviceCategory)
                                        <option value="{{$serviceCategory->id}}">{{$serviceCategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="service">Pilih Layanan</label>
                                    <select class="form-control" id="service" name="service">
                                    </select>
                                </div>
                            </div>
                            <div class="col-12" id="detail-section" style="display: none;">
                                <div class="bg-light-success rounded">
                                    <div class="p-2 mb-2">
                                        <span id="service-detail"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="target">Target</label>
                                    <input type="text" id="target" name="target" class="form-control" placeholder="https://www.instagram.com/tokofollowerdotcom/">
                                    <p><small class="text-muted">Masukkan link.</small></p>
                                </div>
                            </div>
                            <div class="col-12" id="commentRow" style="display: none;">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Komentar (1 komentar per line)</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Komentar"></textarea>
                                </div>
                            </div>
                            <div class="col-12" id="quantityRow">
                                <div class="form-group">
                                    <label for="quantity">Jumlah Pesanan</label>
                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="1000">
                                </div>
                            </div>
                            <div class="col-12" id="usernameRow" style="display: none;">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" placeholder="tokofollower">
                                    <p><small class="text-muted">Masukkan Username.</small></p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="showPrice">Harga Total</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">Rp. </span>
                                        </div>
                                        <input type="text" class="form-control" id="showPrice" name="showPrice" placeholder="" aria-label="Deposit" aria-describedby="basic-addon1" readonly>
                                        <input type="hidden" class="form-control" id="price" name="price" placeholder="" aria-label="Deposit" aria-describedby="basic-addon1" readonly>
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
<script src="/vendors/js/forms/select/select2.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        const baseUrl = '{{$baseUrl}}';
        let servicesPerCategory = [];
        let selectedService;
        let originalPrice = 0;
        let serviceType;
        let price = 0;
        $(".basic-select2").select2({
            placeholder: "Pilih kategori.",
        });
        $('#category').on('change', function() {
            selectService(this.value);
        });

        $('#service').select2({
            placeholder: "Silakan pilih kategori dahulu.",
        });

        function selectService(id) {
            $('#service').select2({
                placeholder: "Pilih layanan sekarang.",
                ajax: {
                    url: baseUrl + '/service/category/' + id,
                    processResults: function(data) {
                        servicesPerCategory = data.services;
                        return {
                            results: data.selectData
                        };
                    }
                }
            });
        }

        $('#service').on('change', function() {
            $('#quantityRow').show();
            $("#showPrice").val(0);
            $("#price").val(0);
            const selected = $('#service').select2('data');
            selectedService = servicesPerCategory.filter((e) => {
                return e.id == selected[0].id;
            });

            serviceType = selectedService[0].type
            originalPrice = selectedService[0].price

            $('#detail-section').show();
            let serviceDetailHtml = '<b>Minimal Pesan: </b>' + selectedService[0].min.toLocaleString('id') + '<br>';
            serviceDetailHtml += '<b>Maksimal Pesan: </b>' + selectedService[0].max.toLocaleString('id') + '<br>';
            serviceDetailHtml += '<b>Harga/per 1000: </b>Rp ' + originalPrice.toLocaleString('id') + '<br>';
            $('#service-detail').html(serviceDetailHtml);

            console.log(selectedService);
            if (serviceType == 'Package') {
                // PACKAGE PRICE COUNT
                $('#quantityRow').hide();
                $("#showPrice").val(originalPrice.toLocaleString('id'));
                $("#price").val(originalPrice);
                $("#quantity").val(1);
            } else if (serviceType == 'Custom Comments') {
                $('#commentRow').show();
                $('#quantity').prop('disabled', true);
            } else if (serviceType == 'Mentions') {
                $('#usernameRow').show();
                $('#quantity').prop('disabled', true);
            } else if (serviceType == 'Mentions Custom List') {
                $('#usernameRow').show();
                $('#quantityRow').hide();
                $("#showPrice").val(originalPrice.toLocaleString('id'));
                $("#price").val(originalPrice);
            }
            // else if (serviceType == 'Mentions') {
            //     $('#usernameRow').show();
            //     $('#quantity').prop('disabled', true);
            // } else if (serviceType == 'Mentions') {
            //     $('#usernameRow').show();
            //     $('#quantity').prop('disabled', true);
            // } else if (serviceType == 'Mentions') {
            //     $('#usernameRow').show();
            //     $('#quantity').prop('disabled', true);
            // }

        });
        // COMMENT PRICE COUNT
        $('#comment').bind('input propertychange', function() {
            var text = $("#comment").val();
            String.prototype.lines = function() {
                return this.split(/\r*\n/);
            }
            String.prototype.lineCount = function() {
                return this.lines().length;
            }
            price = originalPrice * text.lineCount();

            $("#price").val(price);
            $("#showPrice").val(price.toLocaleString('id'));
            $("#quantity").val(text.lineCount());
        });
        // QUANTITY PRICE COUNT
        $('#quantity').on('input', function() {
            price = this.value * (originalPrice / 1000);
            $("#showPrice").val(price.toLocaleString('id'));
            $("#price").val(price);
        });


    });
</script>
@endsection