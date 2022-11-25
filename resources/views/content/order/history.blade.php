@extends('layouts/contentLayoutMaster')

@section('title', 'Riwayan Pesanan')

@section('content')
<!-- Kick start -->
<div class="card">
  <!-- <div class="card-header">
    <h4 class="card-title">Kick start your next project 🚀</h4>
  </div> -->
  <div class="card-body">
    <div class="card-text">
      <!-- CUSTOM TABLE -->
      <table id="ordersTable" class="datatables table">
        <thead>
          <tr>
            <th>No</th>
            <th style="width: 10%;">Kode Invoice</th>
            <th>Layanan Yang Dipesan</th>
            <th>Jumlah</th>
            <th style="width: 15%;">Harga</th>
            <th>Link</th>

            @if (auth()->user()->role == 'Admin')
            <th>Pelanggan</th>
            @endif

            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
            <td>{{$loop->iteration}}.</td>
            <td>{{$order->order_code}}</td>
            <td>
              @if (isset($order->service->name))
              {{$order->service->name}}
              @else
              -
              @endif
            </td>
            <td>{{$order->quantity}}</td>
            <td>Rp {{ number_format($order->price,2,',','.') }}</td>
            <td><a href="{{$order->link}}" target="_blank">{{$order->link}}</a></td>

            @if (auth()->user()->role == 'Admin')
            <td>{{$order->user->name}}</td>
            @endif

            <td>
              @if ($order->status == 'Success' ||$order->status == 'Completed')
              <span class="badge badge-pill  badge-light-success">{{$order->status}}</span>
              @elseif ($order->status == 'Pending')
              <span class="badge badge-pill  badge-light-warning">{{$order->status}}</span>
              @elseif ($order->status == 'Processing')
              <span class="badge badge-pill  badge-light-info">{{$order->status}}</span>
              @elseif ($order->status == 'In Progress')
              <span class="badge badge-pill  badge-light-info">{{$order->status}}</span>
              @else
              <span class="badge badge-pill  badge-light-danger">{{$order->status}}</span>
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

    $('#ordersTable').DataTable({
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      drawCallback: function(settings) {
        feather.replace();
      },
    });

    //   $('#instructions').on('show.bs.modal', function(event) {
    //     var button = $(event.relatedTarget)
    //     var data = button.data('instructions')
    //     var qrUrl = button.data('qrurl')
    //     var html = '';
    //     if (data.length > 0) {
    //       data.forEach(element => {
    //         html += '<h4>' + element.title + '</h4>';
    //         html += '<ul>';
    //         element.steps.forEach(el => {
    //           html += '<li>' + el + '</li>'
    //         });
    //         html += '</ul>'
    //       });

    //       if (qrUrl != null) {
    //         html += '<br><div style="text-align:center; margin-bottom:20px; border-top:20px;"> <img src="' + qrUrl + '"></div>';
    //       }
    //     } else {
    //       html += 'Tidak ada data';
    //     }
    //     $("#data").html(html);
    //   })

  });
</script>
@endsection