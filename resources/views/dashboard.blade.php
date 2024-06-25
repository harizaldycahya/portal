
@extends('layout')


@section('content')

  {{-- WELCOME --}}
  <div class="card bg-light-info shadow-none position-relative overflow-hidden">
    <div class="card-body px-4 py-3">
      <div class="row align-items-center">
        <div class="col-9">
          <h4 class="fw-semibold mb-8">Welcome {{ Auth::user()->nama_user}}</h4>
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a class="text-muted " href="./index.html">NIK</a></li>
              <li class="breadcrumb-item" aria-current="page">{{Auth::user()->id_user}}</li>
            </ol>
          </nav>
        </div>
        <div class="col-3">
          <div class="text-center mb-n5">  
            <img src="dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- END WELCOME --}}

  {{-- APP --}}
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold">Applications</h5>
      <p class="card-subtitle mb-0">Accessible Applications for <span style="color:blue;">{{Auth::user()->nama_user}}</span> </p>
      <div class="row mt-4">
        <div class="col-md-3">
          <a href="{{route('hris')}}" class="card overflow-hidden shadow-none border card-hover mb-4 mb-md-0">
            <img src="dist/images/app/hris.jpg" alt="img">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-5 fw-semibold">HRIS</h6>
                  <span>Human Resource Information System</span>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="{{route('ams')}}" class="card overflow-hidden shadow-none border card-hover mb-4 mb-md-0">
            <img src="dist/images/app/ams.jpg" alt="img">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-5 fw-semibold">AMS</h6>
                  <span>Assets Management System</span>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="{{route('ims')}}" class="card overflow-hidden shadow-none border card-hover mb-4 mb-md-0">
            <img src="dist/images/app/ims.jpg" alt="img">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-5 fw-semibold">IMS</h6>
                  <span>Inventory Management System</span>
                </div>
              </div>
            </div>
          </a>
        </div>
        <div class="col-md-3">
          <a href="{{route('aas')}}" class="card overflow-hidden shadow-none border card-hover mb-4 mb-md-0">
            <img src="dist/images/app/aas.jpg" alt="img">
            <div class="card-body p-4">
              <div class="d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-5 fw-semibold">AAS</h6>
                  <span>Advance Administration System</span>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  {{-- END APP --}}
    
@endsection