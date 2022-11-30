<div class="card">
    <div class="card-header">
        <h4>Grafik Pendapatan {{ now()->subDays(30)->format(' j F Y') . ' - ' . now()->format(' j F Y') }}</h4>
    </div>
    <div class="card-body">
        <canvas id="myChart" height="120"></canvas>
    </div>
</div>
