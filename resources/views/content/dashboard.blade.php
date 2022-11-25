@extends('layouts/contentLayoutMaster')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <!-- <div class="col-lg-3 col-sm-6 col-12">
    <div class="card text-center">
      <div class="card-body">
        <div class="avatar bg-light-info p-50 mb-1">
          <div class="avatar-content">
            <i data-feather="dollar-sign"></i>
          </div>
        </div>
        <h2 class="font-weight-bolder">Rp. {{ number_format($user->balance,2,',','.') }}</h2>
        <p class="card-text">Balance</p>
      </div>
    </div>
  </div> -->
  <div class="col-xl-10 col-md-8 col-12">
    <div class="card card-statistics">
      <div class="card-header">
        <h4 class="card-title">Statistik</h4>
        <div class="d-flex align-items-center">
          <!-- <p class="card-text font-small-2 mr-25 mb-0">Updated 1 month ago</p> -->
        </div>
      </div>
      <div class="card-body statistics-body">
        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12">
            <div class="media">
              <div class="avatar bg-light-success mr-2">
                <div class="avatar-content">
                  <i data-feather="dollar-sign" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">Rp. {{ number_format($user->balance,2,',','.') }}</h4>
                <p class="card-text font-small-3 mb-0">Saldo</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="media">
              <div class="avatar bg-light-primary mr-2">
                <div class="avatar-content">
                  <i data-feather="award" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">{{$totalOrder}}x</h4>
                <p class="card-text font-small-3 mb-0">Total Pesanan</p>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
            <div class="media">
              <div class="avatar bg-light-info mr-2">
                <div class="avatar-content">
                  <i data-feather="briefcase" class="avatar-icon"></i>
                </div>
              </div>
              <div class="media-body my-auto">
                <h4 class="font-weight-bolder mb-0">{{$totalDeposit}}x</h4>
                <p class="card-text font-small-3 mb-0">Total Deposit</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Kick start -->
<div class="card">
  <div class="card-header">
    <h4 class="card-title">Selamat datang di Tokofollower, berikut langkah mudah untuk mulai mendapatkan follower! 🚀</h4>
    <h6 class="card-subtitle text-muted">Ada pertanyaan? DM Instagram @tokofollowerdotcom</h6>
  </div>
  <div class="card-body">




    <ul class="timeline mt-3">
      <li class="timeline-item">
        <span class="timeline-point">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
            <line x1="12" y1="1" x2="12" y2="23"></line>
            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
          </svg>
        </span>
        <div class="timeline-event">
          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
            <h6>Buat Deposit</h6>
            <span class="timeline-event-time">Langkah ke-1</span>
          </div>
          <p>- Klik menu Deposit, pilih submenu "Tambah Deposit".</p>
          <p>- Masukan jumlah deposit dan pilih metode pembayaran favorit kamu (Virtual Account Bank (BCA, BRI, Mandiri, BNI, CIMB, dsb) atau QRIS (Gopay, OVO, Dana, dsb)).</p>
          <p>- Setelah pembayaranmu diverifikasi (15 detik - 2 menit) dan masuk ke dalam sistem, kamu sudah bisa mulai belanja.</p>
        </div>
      </li>
      <li class="timeline-item">
        <span class="timeline-point timeline-point-danger">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
          </svg>
        </span>
        <div class="timeline-event">
          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
            <h6>Belanja follower</h6>
            <span class="timeline-event-time">Langkah ke-2</span>
          </div>
          <p>- Klik menu Pesanan, pilih submenu "Pesanan Baru".</p>
          <p>- Pilih kategori layanan kamu, kamu bisa scroll maupun cari dengan mengetik kata kunci misal instagram <b>(selain instagram banyak kategori yang lain seperti youtube, facebook, tiktok, dll)</b>.</p>
          <p>- Setelah itu pilih Layanan yang kamu inginkan, misal instagram follower.</p>
          <p>- Perhatikan keterangan dan syarat layanan seperti minimal pesanan, maksimal pesanan, dan harga pesanan.</p>
          <p>- Masukkan Link Target, misalnya : https://www.instagram.com/tokofollowerdotcom.</p>
          <p>- Masukkan jumlah pesanan, misal 1000 untuk seribu follower, harga akan tertera secara otomatis. Pastikan masih dibawah total saldo ya!</p>
          <p>- Submit!</p>
          <!-- <div class="d-flex justify-content-between flex-wrap flex-sm-row flex-column">
            <div>
              <p class="text-muted mb-50">Developers</p>
              <div class="d-flex align-items-center">
                <div class="avatar bg-light-primary avatar-sm mr-50">
                  <span class="avatar-content">A</span>
                </div>
                <div class="avatar bg-light-success avatar-sm mr-50">
                  <span class="avatar-content">B</span>
                </div>
                <div class="avatar bg-light-danger avatar-sm">
                  <span class="avatar-content">C</span>
                </div>
              </div>
            </div>
            <div class="mt-sm-0 mt-1">
              <p class="text-muted mb-50">Deadline</p>
              <p class="mb-0">20 Dec 2077</p>
            </div>
            <div class="mt-sm-0 mt-1">
              <p class="text-muted mb-50">Budget</p>
              <p class="mb-0">$50000</p>
            </div>
          </div> -->
        </div>
      </li>
      <li class="timeline-item">
        <span class="timeline-point timeline-point-success">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
          </svg>
        </span>
        <div class="timeline-event">
          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
            <h6>Cek Riwayat dan Status Pesanan</h6>
            <span class="timeline-event-time">Langkah ke-3</span>
          </div>
          <p class="mb-50">- Pilih menu Pesanan dan pilih submenu Riwayat Pesanan</p>
          <!-- <button class="btn btn-outline-primary btn-sm waves-effect" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="true" aria-controls="collapseExample2">
            Riwayan Pesanan
          </button>
          <div class="collapse" id="collapseExample2">
            <ul class="list-group list-group-flush mt-1">
              <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span>Last Year's Profit : <span class="font-weight-bold">$20000</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 cursor-pointer font-medium-2">
                  <circle cx="18" cy="5" r="3"></circle>
                  <circle cx="6" cy="12" r="3"></circle>
                  <circle cx="18" cy="19" r="3"></circle>
                  <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                  <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
              </li>
              <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span> This Year's Profit : <span class="font-weight-bold">$25000</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 cursor-pointer font-medium-2">
                  <circle cx="18" cy="5" r="3"></circle>
                  <circle cx="6" cy="12" r="3"></circle>
                  <circle cx="18" cy="19" r="3"></circle>
                  <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                  <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
              </li>
              <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span> Last Year's Commission : <span class="font-weight-bold">$5000</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 cursor-pointer font-medium-2">
                  <circle cx="18" cy="5" r="3"></circle>
                  <circle cx="6" cy="12" r="3"></circle>
                  <circle cx="18" cy="19" r="3"></circle>
                  <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                  <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
              </li>
              <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span> This Year's Commission : <span class="font-weight-bold">$7000</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 cursor-pointer font-medium-2">
                  <circle cx="18" cy="5" r="3"></circle>
                  <circle cx="6" cy="12" r="3"></circle>
                  <circle cx="18" cy="19" r="3"></circle>
                  <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                  <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
              </li>
              <li class="list-group-item d-flex justify-content-between flex-wrap">
                <span> This Year's Total Balance : <span class="font-weight-bold">$70000</span></span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2 cursor-pointer font-medium-2">
                  <circle cx="18" cy="5" r="3"></circle>
                  <circle cx="6" cy="12" r="3"></circle>
                  <circle cx="18" cy="19" r="3"></circle>
                  <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                  <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                </svg>
              </li>
            </ul>
          </div> -->
        </div>
      </li>
      <!-- <li class="timeline-item">
        <span class="timeline-point timeline-point-warning">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
        </span>
        <div class="timeline-event">
          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
            <h6 class="mb-50">Interview Schedule</h6>
            <span class="timeline-event-time">03:00 PM</span>
          </div>
          <p>Have to interview Katy Turner for the developer job.</p>
          <hr>
          <div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
            <div class="media align-items-center">
              <div class="avatar mr-1">
                <img src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/avatars/1-small.png" alt="Avatar" height="32" width="32">
              </div>
              <div class="media-body">
                <p class="mb-0">Katy Turner</p>
                <span class="text-muted">Javascript Developer</span>
              </div>
            </div>
            <div class="d-flex align-items-center cursor-pointer mt-sm-0 mt-50">
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square mr-1">
                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone-call">
                <path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
              </svg>
            </div>
          </div>
        </div>
      </li>
      <li class="timeline-item">
        <span class="timeline-point timeline-point-info">
          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-server">
            <rect x="2" y="2" width="20" height="8" rx="2" ry="2"></rect>
            <rect x="2" y="14" width="20" height="8" rx="2" ry="2"></rect>
            <line x1="6" y1="6" x2="6.01" y2="6"></line>
            <line x1="6" y1="18" x2="6.01" y2="18"></line>
          </svg>
        </span>
        <div class="timeline-event">
          <div class="d-flex justify-content-between align-items-center mb-50">
            <h6>Designing UI</h6>
            <div>
              <span class="badge badge-pill badge-light-primary">Design</span>
            </div>
          </div>
          <p>
            Our main goal is to design a new mobile application for our client. The customer wants a clean &amp; flat
            design.
          </p>
          <div>
            <span class="text-muted">Participants</span>
            <div class="avatar-group mt-50">
              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Vinnie Mostowy" class="avatar pull-up">
                <img class="media-object" src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="30" width="30">
              </div>
              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Elicia Rieske" class="avatar pull-up">
                <img class="media-object" src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/portrait/small/avatar-s-7.jpg" alt="Avatar" height="30" width="30">
              </div>
              <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="bottom" data-original-title="Julee Rossignol" class="avatar pull-up">
                <img class="media-object" src="https://pixinvent.com/demo/vuexy-bootstrap-laravel-admin-template/demo-1/images/portrait/small/avatar-s-10.jpg" alt="Avatar" height="30" width="30">
              </div>
            </div>
          </div>
        </div>
      </li> -->
    </ul>



    <div class="card-text">
    </div>
  </div>
</div>
<!--/ Kick start -->
@endsection