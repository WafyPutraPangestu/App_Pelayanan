<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Keterangan Menikah - {{ $surat->nomor_surat }}</title>
    <style>
        body{font-family:'Times New Roman',Times,serif;font-size:12pt;line-height:1.5}.container{padding:0 40px}.text-center{text-align:center}.kop-surat{border-bottom:3px solid #000;padding-bottom:15px;margin-bottom:30px}.kop-surat h1,.kop-surat h2{margin:0;padding:0}.judul-surat{margin-bottom:30px}.judul-surat h3{text-decoration:underline;margin-bottom:5px}table.data-pemohon{width:100%;margin-left:30px}table.data-pemohon td{padding:2px 0}.paragraf{text-align:justify;margin:20px 0}.signature{margin-top:60px;text-align:right}.signature-name{margin-top:80px;font-weight:700;text-decoration:underline} h4{margin-top:20px;margin-bottom:5px;text-decoration:underline} .page-break{page-break-after:always}
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
            <h3>SURAT KETERANGAN UNTUK MENIKAH</h3>
            <p>Nomor: {{ $surat->nomor_surat ?? '___________________' }}</p>
        </div>

        <p class="paragraf">Yang bertanda tangan di bawah ini, Kepala Desa Sukanagara Jaya, Kecamatan Cikupa, Kabupaten TANGERANG, dengan ini menerangkan bahwa:</p>
        
        {{-- CALON PRIA --}}
        <h4>I. Calon Suami</h4>
        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Lengkap</td><td style="width:5%">:</td><td><strong>{{ $surat->calonPria?->nama }}</strong></td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->calonPria?->nik }}</td></tr>
            <tr><td>Tempat, Tgl Lahir</td><td>:</td><td>{{ $surat->calonPria?->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->calonPria?->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->calonPria?->kewarganegaraan }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->calonPria?->agama }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->calonPria?->pekerjaan }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->calonPria?->alamat }}</td></tr>
            <tr><td>Status Perkawinan</td><td>:</td><td>{{ $surat->status_perkawinan_pria }}</td></tr>
        </table>
        <p style="margin-left:30px;font-size:11pt">Adalah benar anak dari:</p>
        <table class="data-pemohon" style="margin-left: 60px;">
            <tr><td style="width:30%">Nama Ayah</td><td style="width:5%">:</td><td>{{ $surat->calonPria?->ayah?->nama ?? '-' }}</td></tr>
            <tr><td>Nama Ibu</td><td>:</td><td>{{ $surat->calonPria?->ibu?->nama ?? '-' }}</td></tr>
        </table>
        
        {{-- CALON WANITA --}}
        <h4>II. Calon Istri</h4>
        <table class="data-pemohon">
            <tr><td style="width:30%">Nama Lengkap</td><td style="width:5%">:</td><td><strong>{{ $surat->calonWanita?->nama }}</strong></td></tr>
            <tr><td>NIK</td><td>:</td><td>{{ $surat->calonWanita?->nik }}</td></tr>
            <tr><td>Tempat, Tgl Lahir</td><td>:</td><td>{{ $surat->calonWanita?->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->calonWanita?->tanggal_lahir)->isoFormat('D MMMM Y') }}</td></tr>
            <tr><td>Kewarganegaraan</td><td>:</td><td>{{ $surat->calonWanita?->kewarganegaraan }}</td></tr>
            <tr><td>Agama</td><td>:</td><td>{{ $surat->calonWanita?->agama }}</td></tr>
            <tr><td>Pekerjaan</td><td>:</td><td>{{ $surat->calonWanita?->pekerjaan }}</td></tr>
            <tr><td>Alamat</td><td>:</td><td>{{ $surat->calonWanita?->alamat }}</td></tr>
            <tr><td>Status Perkawinan</td><td>:</td><td>{{ $surat->status_perkawinan_wanita }}</td></tr>
        </table>
        <p style="margin-left:30px;font-size:11pt">Adalah benar anak dari:</p>
        <table class="data-pemohon" style="margin-left: 60px;">
            <tr><td style="width:30%">Nama Ayah</td><td style="width:5%">:</td><td>{{ $surat->calonWanita?->ayah?->nama ?? '-' }}</td></tr>
            <tr><td>Nama Ibu</td><td>:</td><td>{{ $surat->calonWanita?->ibu?->nama ?? '-' }}</td></tr>
        </table>

        <p class="paragraf">Demikian Surat Keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        
        <div class="signature">
            <p>Sukanagara, {{ \Carbon\Carbon::parse($surat->tanggal_disetujui)->isoFormat('D MMMM Y') }}</p>
            <p>Kepala Desa Sukanagara</p>
            <div class="signature-name">( ............................................... )</div>
        </div>
    </div>
</body>
</html>