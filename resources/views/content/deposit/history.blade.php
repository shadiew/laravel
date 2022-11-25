@extends('layouts/contentLayoutMaster')

@section('title', 'Deposit History')

@section('content')
<!-- Kick start -->
<div class="card">
  <!-- <div class="card-header">
    <h4 class="card-title">Kick start your next project 🚀</h4>
  </div> -->
  <div class="card-body">
    <div class="card-text">
      <!-- CUSTOM TABLE -->
      <table id="table_id" class="datatables table">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Invoice</th>
            <th>Jumlah</th>
            <th>Metode Pembayaran</th>
            <th>Status</th>
            <th>Tanggal</th>

            @if (auth()->user()->role == 'Admin')
            <th>Pelanggan</th>
            @endif

            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($deposits as $deposit)
          <tr>
            <td>{{$loop->iteration}}.</td>
            <td>{{$deposit->invoice_code}}</td>
            <td class="deposit-amount">Rp {{ number_format($deposit->amount,2,',','.') }}</td>
            <td>{{$deposit->payment->name}}</td>
            <td>
              @if ($deposit->status == 'SUCCESS')
              <span class="badge badge-pill  badge-light-success">{{$deposit->status}}</span>
              @elseif ($deposit->status == 'PENDING')
              <span class="badge badge-pill  badge-light-warning">{{$deposit->status}}</span>
              @elseif ($deposit->status == 'EXPIRED')
              <span class="badge badge-pill  badge-light-secondary">{{$deposit->status}}</span>
              @elseif ($deposit->status == 'UNPAID')
              <span class="badge badge-pill  badge-light-info">{{$deposit->status}}</span>
              @else
              <span class="badge badge-pill  badge-light-danger">{{$deposit->status}}</span>
              @endif
            </td>
            <td>
              {{date('d-m-Y', strtotime($deposit->created_at))}}
            </td>

            @if (auth()->user()->role == 'Admin')
            <td>{{$deposit->user->name}}</td>
            @endif

            <td>
              @if ($deposit->status == 'UNPAID' || $deposit->status == 'PENDING')
              <button type="button" class="btn btn-outline-primary waves-effect" data-toggle="modal" id="{{$deposit->invoice_code}}" data-target="#instructions" data-instructions="{{$deposit->instructions}}" data-qrurl="{{$deposit->qr_url}}">
                <i data-feather="eye"></i>
                <span> Cara Pembayaran</span>
              </button>
              @else
              <button type="button" class="btn btn-outline-primary waves-effect" disabled>
                <i data-feather="eye-off"></i>
                <span> Cara Pembayaran</span>
              </button>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- CUSTOM TABLE -->

      <!-- POPUP -->
      <div class="modal fade text-left modal-primary" id="instructions" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="myModalLabel160">Instruksi Pembayaran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="data"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary waves-effect waves-float waves-light" data-dismiss="modal">Ok</button>
            </div>
          </div>
        </div>
      </div>
      <!-- POPUP -->
    </div>
  </div>
</div>
<!--/ Kick start -->
@endsection

@section('vendor-script')
{{-- vendor files --}}
<script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
@endsection
@section('page-script')
{{-- Page js files --}}
<script>
  $(document).ready(function() {

    $('#table_id').DataTable({
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      drawCallback: function(settings) {
        feather.replace();
      },
    });

    $('#instructions').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget)
      var data = button.data('instructions')
      var qrUrl = button.data('qrurl')
      var html = '';
      if (data.length > 0) {
        data.forEach(element => {
          html += '<h4>' + element.title + '</h4>';
          html += '<ul>';
          element.steps.forEach(el => {
            html += '<li>' + el + '</li>'
          });
          html += '</ul>'
        });

        if (qrUrl != null) {
          html += '<br><div style="text-align:center; margin-bottom:20px; border-top:20px;"> <img src="' + qrUrl + '"></div>';
        }
      } else {
        html += 'Tidak ada data';
      }
      $("#data").html(html);
    })

  });
</script>
@endsection