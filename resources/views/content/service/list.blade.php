@extends('layouts/contentLayoutMaster')

@section('title', 'Daftar Layanan')

@section('content')
<!-- Kick start -->
<div class="card">
  <!-- <div class="card-header">
    <h4 class="card-title">Kick start your next project 🚀</h4>
  </div> -->
  <div class="card-body">
    <div class="card-text">
      <!-- CUSTOM TABLE -->
      <table id="servicesTable" class="datatables table table-hover">
        <thead>
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 30%;">Kategori</th>
            <th style="width: 30%;">Nama</th>
            <th>Harga/per 1000</th>
            <th>Min/Maks</th>
            <th style="width: 10%;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($services as $service)
          <tr>
            <td>{{$loop->iteration}}.</td>
            <td>{{$service->category->name}}</td>
            <td>{{$service->name}}</td>
            <td>Rp. {{ number_format($service->price,2,',','.') }}</td>
            <td>{{$service->min}}/{{$service->max}}</td>
            <td>
              <button type="button" class="btn btn-outline-danger waves-effect waves-float waves-light" onclick="alert('Coming soon! Gunakan dahulu form pesanan baru.')">
                <i data-feather="shopping-cart"></i>
                <span>Beli</span>
              </button>
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

    var services = <?php echo json_encode($services); ?>;;
    // console.log(services);

    $('#servicesTable').DataTable({
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      drawCallback: function(settings) {
        feather.replace();
      },
    });
  });
</script>
@endsection