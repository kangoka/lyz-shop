@extends('layouts.app')

@section('content')
@include('components.admin_sidebar')
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
                <div class="row">
                    <div class="col widget dashboard-container my-adslist mr-3">
                        <h3 class="widget-header">Produk Terjual</h3>
                        <h1>{{ $product_sold }}</h1>
                        <p><i>Data untuk minggu ini</i></p>
                    </div>
                    <div class="col widget dashboard-container my-adslist">
                        <h3 class="widget-header">Nilai Penjualan</h3>
                        <h1>IDR {{ number_format($sales,0,',',','); }}</h1>
                        <p><i>Data untuk minggu ini</i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col widget dashboard-container my-adslist mr-3">
                        <h3 class="widget-header">Pengguna Baru</h3>
                        <h1>{{ $user_joined }}</h1>
                        <p><i>Data untuk minggu ini</i></p>
                    </div>
                    <div class="col">
                        
                    </div>
                </div>
               <div class="row">
                <div class="col widget dashboard-container my-adslist">
                    <h3 class="widget-header">Grafik Penjualan</h3>
                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                    <p><i>Data 7 hari terakhir</i></p>
                </div>
               </div>
                <div class="row">
                    <div class="col widget dashboard-container my-adslist">
                        <h3 class="widget-header">Produk Terlaris</h3>
                        <table class="table">
                            <thead>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Terjual</th>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach($popular_products as $product)
                                    <tr>
                                        <td>{{ $i+=1 }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->sold }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><i>Data untuk seluruh records</i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col widget dashboard-container my-adslist mr-3">
                        <h3 class="widget-header">Metode Pembayaran</h3>
                        <div>
                            <canvas id="myChartDoughnut"></canvas>
                        </div>
                        <p><i>Data untuk seluruh records</i></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col widget dashboard-container my-adslist">
                        <h3 class="widget-header">Pembeli Terbanyak</h3>
                        <table class="table table-responsive">
                            <thead>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Beli</th>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach($loyal_users as $user)
                                    <tr>
                                        <td>{{ $i+=1 }}</td>
                                        <td>{{ $user->User->name }}</td>
                                        <td>{{ $user->User->email }}</td>
                                        <td>{{ $user->number_of_orders }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <p><i>Data untuk minggu ini</i></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</section>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');
  let cData = JSON.parse(`<?= $chart['chart_data'] ?>`);

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: cData.label,
      datasets: [{
        label: 'Terjual',
        data: cData.data,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
        }
        },
        
      }
    }
  });
</script>

<script>
    const context = document.getElementById('myChartDoughnut');
    const data = {
        labels: [
            'Red',
            'Blue',
            'Yellow'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };
  
    new Chart(context, {
      type: 'doughnut',
      data: data,
    });
  </script>
 
@endsection