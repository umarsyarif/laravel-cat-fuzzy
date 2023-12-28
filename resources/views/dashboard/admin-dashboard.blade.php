<div class="mt-3">
    <p>Selamat datang <b>{{ Auth::user()->name }}</b>, anda adalah {{ Auth::user()->role }}.&ensp;Silahkan pilih menu yang tersedia untuk mengelola aplikasi ini</p>
</div>
<div class="row m-t-25">
    <div class="col-md-6 col-lg-4">
        <div class="statistic__item">
            <h2 class="number">{{ $studentsCount }}</h2>
            <span class="desc">Siswa</span>
            <div class="icon">
                <i class="zmdi zmdi-account-o"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="statistic__item">
            <h2 class="number">{{ $questionsCount }}</h2>
            <span class="desc">Soal</span>
            <div class="icon">
                <i class="zmdi zmdi-chart"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="statistic__item">
            <h2 class="number">{{ $activeExamsCount }}</h2>
            <span class="desc">Ujian Aktif</span>
            <div class="icon">
                <i class="zmdi zmdi-border-color"></i>
            </div>
        </div>
    </div>
</div>
