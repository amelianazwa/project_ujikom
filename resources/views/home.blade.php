@extends('layouts.admin')
@section('content')

<div class="row www">
  <div class="col-md-5 grid-margin stretch-card">
    <!-- Bootstrap carousel -->
    <div class="col-md">
      <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" style="height: 89%" src="../assets/img/elements/m.jpeg" alt="First slide" />
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" style="height: 89%" src="../assets/img/elements/i.jpeg" alt="Second slide" />
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" style="height: 89%" src="../assets/img/elements/y.jpeg" alt="Third slide" />
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" style="height: 89%" src="../assets/img/elements/a.jpeg" alt="Fourth slide" />
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
          <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
          <span class="visually-hidden">Next</span>
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-tale" style="background-color: rgb(124, 207, 255); color: white">
          <div class="card-body">
            <p class="mb-4"><b>Jumlah Data di Tabel Barang</b></p>
            <h4>{{$barang}}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-dark-blue" style="background-color: rgb(146, 255, 118); color: white">
          <div class="card-body">
            <p class="mb-4"><b>Jumlah Data di Tabel Ruangan</b></p>
            <h4>{{$ruangan}}</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-light-blue" style="background-color: rgb(255, 125, 125); color: white">
          <div class="card-body">
            <p class="mb-4"><b>Jumlah Data di Tabel Anggota</b></p>
            <h4>{{$anggota}}</h4>
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-light-danger" style="background-color: rgb(209, 124, 255); color: white">
          <div class="card-body">
            <p class="mb-4"><b>Jumlah Data di Tabel Kategori</b></p>
            <h4>{{$kategori}}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Spacer for separation -->
<div style="margin-top: 40px;"></div>

<!-- Chart Section -->
<div class="row" style="margin-left: 20px; margin-right: 20px;">
  <div class="col-md-12">
    <canvas id="dataChart"></canvas>
  </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  var ctx = document.getElementById('dataChart').getContext('2d');
  var dataChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Barang', 'Ruangan', 'Anggota', 'Kategori'],
      datasets: [{
        label: 'Jumlah Data',
        data: [{{$barang}}, {{$ruangan}}, {{$anggota}}, {{$kategori}}],
        backgroundColor: [
          'rgba(124, 207, 255, 0.7)',
          'rgba(146, 255, 118, 0.7)',
          'rgba(255, 125, 125, 0.7)',
          'rgba(209, 124, 255, 0.7)'
        ],
        borderColor: [
          'rgba(124, 207, 255, 1)',
          'rgba(146, 255, 118, 1)',
          'rgba(255, 125, 125, 1)',
          'rgba(209, 124, 255, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

@endsection
