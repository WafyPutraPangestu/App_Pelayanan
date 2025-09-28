<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Lahir - {{ $surat->nomor_surat }}</title>
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
            <p style="font-size:10pt;margin:5px 0 0">Jl. Kp. Cibadak No.001, RT.005, Sukanagara, Kec. Cikupa, Kabupaten Tangerang, Banten 15710/p>
        </div>

        <div class="judul-surat text-center">
            <h3>SURAT KETERANGAN KELAHIRAN</h3>
            <p>Nomor: {{ $surat->nomor_surat ?? '___________________' }}</p>
        </div>

        <p class="paragraf">Yang bertanda tangan di bawah ini, Kepala Desa Sukanagara, Kecamatan Cikupa, Kabupaten Tangerang, dengan ini menerangkan bahwa telah lahir seorang anak:</p>

        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Lengkap</td><td style="width:5%">:</td><td><strong>{{ $surat->nama_lengkap }}</strong></td></tr>
            <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $surat->jenis_kelamin }}</td></tr>
            <tr><td>Tempat, Tanggal Lahir</td><td>:</td><td>{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
            <tr><td>Waktu Lahir</td><td>:</td><td>{{ \Carbon\Carbon::parse($surat->waktu_lahir)->format('H:i') }} WIB</td></tr>
        </table>
        
        <p class="paragraf">Dari seorang Ibu dan Ayah:</p>
        
        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Ibu</td><td style="width:5%">:</td><td>{{ $surat->nama_ibu }}</td></tr>
            <tr><td>Nama Ayah</td><td>:</td><td>{{ $surat->nama_ayah }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->alamat }}</td></tr>
        </table>
        
        <p class="paragraf">Surat keterangan ini dibuat berdasarkan laporan dari yang bersangkutan dan data yang ada pada kami.</p>
        
        <p class="paragraf">Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        
        <div class="signature">
            <p>Sukanagara, {{ \Carbon\Carbon::parse($surat->tanggal_disetujui)->isoFormat('D MMMM Y') }}</p>
            <p>Kepala Desa Sukanagara</p>
            <div class="signature-name">( ...............................................  )</div>
        </div>
    </div>
</body>
</html>