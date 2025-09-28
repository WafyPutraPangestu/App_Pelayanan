<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Usaha - {{ $surat->nomor_surat }}</title>
    <style>
        body{font-family:'Times New Roman',Times,serif;font-size:12pt;line-height:1.5}.container{padding:0 40px}.text-center{text-align:center}.kop-surat{border-bottom:3px solid #000;padding-bottom:15px;margin-bottom:30px}.kop-surat h1,.kop-surat h2{margin:0;padding:0}.judul-surat{margin-bottom:30px}.judul-surat h3{text-decoration:underline;margin-bottom:5px}table.data-pemohon{width:100%;margin-left:30px}table.data-pemohon td{padding:2px 0}.paragraf{text-align:justify;margin:20px 0}.signature{margin-top:60px;text-align:right}.signature-name{margin-top:80px;font-weight:700;text-decoration:underline}
    </style>
</head>
<body>
    <div class="container">
        <div class="kop-surat text-center">
            <h1>PEMERINTAH KABUPATEN TANGERANG</h1>
            <h2>KECAMATAN CIKUPA</h2>
            <h2>DESA SUKANAGARA</h2>
            <p style="font-size:10pt;margin:5px 0 0">Jl. Kp. Cibadak No.001, RT.005, Sukanagara, Kec. Cikupa, Kabupaten Tangerang, Banten 15710</p>
        </div>

        <div class="judul-surat text-center">
            <h3>SURAT KETERANGAN USAHA</h3>
            <p>Nomor: {{ $surat->nomor_surat ?? '___________________' }}</p>
        </div>

        <p class="paragraf">Yang bertanda tangan di bawah ini, Kepala Desa Sukanagara, Kecamatan Cikupa, Kabupaten Tangerang, dengan ini menerangkan bahwa:</p>

        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Lengkap</td><td style="width:5%">:</td><td><strong>{{ $surat->name }}</strong></td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->nik }}</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->user->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->user->alamat }}</td></tr>
        </table>
        
        <p class="paragraf">Adalah benar nama tersebut di atas merupakan penduduk Desa Sukanagara dan memiliki usaha sebagai berikut:</p>
        
        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Usaha</td><td style="width:5%">:</td><td><strong>{{ $surat->nama_usaha }}</strong></td></tr>
            <tr><td>Jenis Usaha</td><td>:</td><td>{{ $surat->jenis_usaha }}</td></tr>
            <tr><td>Alamat Usaha</td><td>:</td><td>{{ $surat->alamat_usaha }}</td></tr>
        </table>
        
        <p class="paragraf">Demikian Surat Keterangan Usaha ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        
        <div class="signature">
            <p>Sukanagara, {{ \Carbon\Carbon::parse($surat->tanggal_disetujui)->isoFormat('D MMMM Y') }}</p>
            <p>Kepala Desa Sukanagara</p>
            <div class="signature-name">( ............................................... )</div>
        </div>
    </div>
</body>
</html>