@extends('layouts/contentLayoutMaster')

@section('title', 'Daftar Pengguna')

@section('content')
<!-- Kick start -->
<div class="card">
  <!-- <div class="card-header">
    <h4 class="card-title">Kick start your next project 🚀</h4>
  </div> -->
  <div class="card-body">
    <div class="card-text">
      <!-- CUSTOM TABLE -->
      <table id="usersTable" class="datatables table table-hover">
        <thead>
          <tr>
            <th style="width: 5%;">No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Telepon</th>
            <th style="width: 20%;">Saldo</th>
            <th>Role</th>
            <th>Total Pesanan</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td>{{$loop->iteration}}.</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>
            <td>Rp. {{ number_format($user->balance,2,',','.') }}</td>
            <td>{{$user->role}}</td>
            <td>{{$user->orders_count}}</td>
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
    $('#usersTable').DataTable({
      dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 text-right"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      drawCallback: function(settings) {
        feather.replace();
      },
    });
  });
</script>
@endsection