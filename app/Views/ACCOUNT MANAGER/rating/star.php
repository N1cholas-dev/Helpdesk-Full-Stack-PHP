<?= $this->extend('layout/admin'); ?>

<?= $this->section('content'); ?>

<style>
    .content-wrapper {
        background-color: white;
    }
</style>
<script>
    document.title = "RATING";
</script>
<span id="profile-name" style="display: none;">Ini akan disembunyikan</span>
<span id="userDisplay" style="display: none;">Ini akan disembunyikan</span>

<div class="content-wrapper">
    <div class="container-fluid">

        <div id="export-area">

            <!-- Card Tabel Rating -->
            <div class="card mb-4">
                <div class="card-header text-white text-center" style="background-color: #f6c23e;">
                    <h3>Rata-rata Rating per PIC</h3>
                </div>
                <div class="card-body">
                    <table id="ratingTable" class="table table-bordered table-striped text-center" style="width: 100%;">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Nama PIC</th>
                                <th>Rata-rata Rating</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <!-- Card Grafik Pie -->
            <div class="card mb-4">
                <div class="card-header text-white text-center" style="background-color: #f6c23e;">
                    <h3>Grafik Rata-rata Rating per PIC</h3>
                </div>
                <div class="card-body">
                    <div id="pieChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>

            <!-- Card Grafik Line -->
            <div class="card mb-4">
                <div class="card-header text-white text-center" style="background-color: #f6c23e;">
                    <h3>Grafik Rata-rata Waktu Penyelesaian per PIC</h3>
                </div>
                <div class="card-body">
                    <div id="lineChart" style="width: 100%; height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load Library -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<script>
    $(document).ready(function () {
        var dt = $('#ratingTable').DataTable({
            ajax: {
                url: '<?= base_url('star/average-pic') ?>',
                dataSrc: ''
            },
            columns: [
                { data: null }, // Kolom nomor
                { data: 'pic_name' },
                { data: 'avg_rating', className: 'text-center' }
            ],
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                }
            ],
            responsive: false,
            scrollX: true,
            autoWidth: false,
            orderCellsTop: true,
            fixedHeader: true,
            dom:
                "<'text-center mb-2'B>" +
                "<'d-flex justify-content-between align-items-center mt-3'l f>" +
                "rt" +
                "<'d-flex justify-content-between align-items-center mt-3'i p>" +
                "<'clear'>",
            buttons: [
                'copy',
                {
                    extend: 'excelHtml5',
                    title: 'Average Rating PIC',
                    footer: true
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Average Rating PIC',
                    footer: true
                },
                {
                    extend: 'print',
                    messageTop: 'Laporan Average Rating PIC'
                }
            ],
            language: {
                search: 'Cari:',
                lengthMenu: 'Tampilkan _MENU_ data',
                info: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ data',
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                },
                emptyTable: 'Tidak ada data tersedia'
            },
            pagingType: 'full_numbers'
        });
    });
</script>

<script>
    // Fungsi untuk menggambar PieChart (Rata-rata Rating per PIC)
    function drawPieChart(dataArray) {
        const data = google.visualization.arrayToDataTable(dataArray);

        const options = {
            title: 'Rata-rata Rating per PIC',
            is3D: true, // Menambahkan efek 3D
            slices: {} // Setiap slice diberi warna yang berbeda
        };

        const colors = ['#6f42c1', '#28a745', '#dc3545', '#007bff', '#ffc107', '#17a2b8', '#fd7e14'];

        for (let i = 0; i < data.getNumberOfRows(); i++) {
            options.slices[i] = { offset: 0.1, color: colors[i] };
        }

        const chart = new google.visualization.PieChart(document.getElementById('pieChart'));
        chart.draw(data, options);
    }

    // Fungsi untuk menggambar LineChart (Rata-rata Waktu Penyelesaian per PIC)
    function drawLineChart(dataArray) {
        const data = google.visualization.arrayToDataTable(dataArray);

        const options = {
            title: 'Perbandingan Waktu Penyelesaian per PIC',
            hAxis: {
                title: 'PIC',
                textStyle: { fontSize: 12 }
            },
            vAxis: {
                title: 'Waktu Penyelesaian (dalam jam)',
                minValue: 0
            },
            legend: { position: 'bottom' },
            curveType: 'function', // Membuat grafik lebih mulus
            pointSize: 5, // Ukuran titik pada garis
            colors: ['#6f42c1', '#28a745', '#dc3545', '#007bff', '#ffc107', '#17a2b8', '#fd7e14']
        };

        const chart = new google.visualization.LineChart(document.getElementById('lineChart'));
        chart.draw(data, options);
    }

    // Fungsi untuk memuat dan menggambar kedua grafik
    function loadCharts() {
        // Memuat data untuk Rata-rata Rating per PIC (PieChart)
        $.ajax({
            url: "http://localhost:8080/star/average-pic", // Ganti dengan endpoint yang sesuai
            method: "GET",
            dataType: "json",
            success: function (response) {
                let tableContent = "";
                let pieChartData = [['Nama PIC', 'Rata-rata Rating']];

                response.forEach(function (row) {
                    const rating = parseFloat(row.avg_rating).toFixed(2);
                    tableContent += `<tr>
                    <td>${row.pic_name}</td>
                    <td>⭐ ${rating}</td>
                </tr>`;
                    pieChartData.push([row.pic_name, parseFloat(rating)]);
                });

                $("#rating-table").html(tableContent);

                // Menampilkan PieChart
                drawPieChart(pieChartData);
            },
            error: function () {
                $("#rating-table").html('<tr><td colspan="2" class="text-center text-danger">Gagal mengambil data</td></tr>');
                $("#pieChart").html('<div class="text-center text-danger">Gagal memuat grafik.</div>');
            }
        });

        // Memuat data untuk Rata-rata Waktu Penyelesaian per PIC (LineChart)
        $.ajax({
            url: "http://localhost:8080/star/average-time-per-pic", // Ganti dengan endpoint yang sesuai
            method: "GET",
            dataType: "json",
            success: function (response) {
                let tableContent = "";
                let lineChartData = [['PIC', 'Rata-rata Waktu Penyelesaian']];

                response.forEach(function (row) {
                    const avgTime = parseFloat(row.avg_time).toFixed(2); // Waktu dalam jam
                    tableContent += `<tr>
                    <td>${row.pic_name}</td>
                    <td>${avgTime} jam</td>
                </tr>`;
                    lineChartData.push([row.pic_name, parseFloat(avgTime)]);
                });

                $("#time-table").html(tableContent);

                // Menampilkan LineChart
                drawLineChart(lineChartData);
            },
            error: function () {
                $("#time-table").html('<tr><td colspan="2" class="text-center text-danger">Gagal mengambil data</td></tr>');
                $("#lineChart").html('<div class="text-center text-danger">Gagal memuat grafik.</div>');
            }
        });
    }

    // Panggil fungsi untuk memuat kedua grafik saat halaman dimuat
    google.charts.load('current', { packages: ['corechart'] });
    google.charts.setOnLoadCallback(loadCharts);

</script>

<?= $this->endSection(); ?>