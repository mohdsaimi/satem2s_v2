<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        h1 {
            font-size: 14px;
        }
    
        h2 {
        font-size: 30px;
        }
    
        p {
        font-size: 14px;
        }
    
        table {
            font-family: arial, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }
        
        td, th {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 3px;
        }
        
        /* tr:nth-child(even) {
            background-color: #dddddd;
        } */
    
        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;

            /** Extra personal styles **/
            text-align: center;
            line-height: 35px;
        }
    
        footer {
            position: fixed; 
            bottom: -60px; 
            left: 0px; 
            right: 0px;
            height: 50px; 

            /** Extra personal styles **/
            font-family: arial, sans-serif;
            font-size: 10px;
            text-align: center;
            line-height: 10px;
        }
        footer .pagenum:before {
            content: counter(page);
            font-family: arial, sans-serif;
            font-size: 10px;
        }
        .page-break {
            page-break-after: always;
        }
    
    </style>


    <title>BORANG ADUAN KEROSAKAN ASET TAK ALIH</title>
</head>

<footer>
    Copyright &copy;RepoTech <?php echo date("Y");?> 
    <br>Page <span class="pagenum"></span>
</footer>

<body>
    
    <div class="row mt-4">
        <h1 class="card-title" style="text-align: right">JKR.PATA.F7/2</h1>
        <h1 class="card-title" style="text-align: center">TATACARA PENGURUSAN ASET TAK ALIH<br>BORANG ADUAN / PERMINTAAN PELANGGAN</h1>
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td style="width:100px">No. Aduan</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">{{ $atarosak->id}}/{{ date('Y', strtotime($atarosak->tarikh_rosak ?? null)) }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px">Nama Pelapor</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">{{ strtoupper($atarosak->kakitangan->nama ?? null) }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px">No. Telefon</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">{{ $atarosak->no_tel ?? null}}</td>
                            </tr>
                            <tr>
                                <td style="width:100px">Bahagian / Unit</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">{{ strtoupper($atarosak->bahagian ?? null) }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px">Premis</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">INSTITUT LATIHAN PERINDUSTRIAN SELANDAR</td>
                            </tr>
                            <tr>
                                <td style="width:100px">No. DPA</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">1114111MYS.040214.BE0001</td>
                            </tr>
                            <tr>
                                <td style="width:100px">Tarikh/Masa</td>
                                <td style="width:5px">:</td>
                                <td style="border-bottom: 1px solid black;">{{ date('d-m-Y', strtotime($atarosak->tarikh_rosak ?? null)) }}</td>
                            </tr>
                            <tr>
                                <td style="width:100px"></td>
                                <td style="width:5px"></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width:100px"></td>
                                <td style="width:5px"></td>
                                <td></td>
                            </tr>

                        </tbody>
                    </table>
                    <table class="table">
                            <tr>
                                <td style="width:120px">Skop Perkhidmatan :</td>
                                <td style="width:150px"></td>
                                <td style="width:70px">Mod Aduan :</td>
                                <td style="width:200px"></td>
                            </tr>
                            <tr>
                                <td style="width:120px">&nbsp;</td>
                                <td style="width:150px">

                                    <table class="table">
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Keselamatan")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Keselamatan</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Housekeeping")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Housekeeping</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Landskap")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Landskap</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Mekanikal")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Mekanikal</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Elektrikal")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Elektrikal</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Sivil dan Struktur")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Sivil dan Struktur</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                    @if ($atarosak->skop == "Parkir")
                                                        X
                                                    @else
                                                    @endif
                                                </td>
                                                <td style="width:5px"></td>
                                                <td>Parkir</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                                <td style="width:5px"></td>
                                                <td>Lain-lain (Sila nyatakan)</td>
                                            </tr>
                                    </table>

                                </td>
                                <td style="width:70px">&nbsp;</td>
                                <td style="width:200px">
                                    
                                    <table class="table">
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>Telefon</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>Faksimili</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>E-Mel</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>Surat</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">X</td>
                                            <td style="width:5px"></td>
                                            <td>Lain-lain (Sila Nyatakan)</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td><u>Dalam Talian (One-line)</u></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td style="width:5px"></td>
                                            <td>&nbsp;</td>
                                        </tr>
                                </table>

                                </td>
                            </tr>
                    </table>

                    <table class="table">
                        <tr>
                            <td style="width:120px">Keutamaan :</td>
                            <td style="width:150px">&nbsp;</td>
                            <td style="width:275px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width:120px">&nbsp;</td>
                            <td style="width:150px">

                                <table class="table">
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                @if ($atarosak->keutamaan == 1)
                                                    X
                                                @else
                                                @endif
                                            </td>
                                            <td style="width:5px"></td>
                                            <td>Umum</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                @if ($atarosak->keutamaan == 2)
                                                    X
                                                @else
                                                @endif
                                            </td>
                                            <td style="width:5px"></td>
                                            <td>Segera (Breakdown)</td>
                                        </tr>
                                        <tr>
                                            <td style="width:5px; border-bottom: 1px solid black; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">
                                                @if ($atarosak->keutamaan == 3)
                                                    X
                                                @else
                                                @endif
                                            </td>
                                            <td style="width:5px"></td>
                                            <td>Kecemasan</td>
                                        </tr>
                                </table>

                            </td>
                            <td style="width:275px"></td>
                        </tr>
                </table>

                <table class="table">
                    <tr>
                        <td style="width:120px">CATATAN ADUAN :</td>
                    </tr>
                </table>


                <table class="table" style="border:1px solid black;">
                    <tr>
                        <td colspan="2">LOKASI : {{ $atarosak->asetalih->asetalih_data->bangunan->kod_bangunan }} - {{ $atarosak->asetalih->asetalih_data->bangunan->nama_bangunan }}</td>
                        <td colspan="2">Lain-lain (Nyatakan) :</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:1px solid">ARAS : {{ $atarosak->asetalih->asetalih_data->aras }}</td>
                        <td colspan="2" style="border-top:1px solid">Nama / No Bilik (Jika ada) : {{ $atarosak->asetalih->asetalih_data->nama_lokasi }} / {{ $atarosak->asetalih->kod_lokasi_ata }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border-top:1px solid">&nbsp;</td>
                        <td colspan="2" style="border-top:1px solid">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top:1px solid">KETERANGAN KEROSAKAN :</td>
                    </tr>
                    <tr>
                        <td colspan="4" style="border-top:1px solid">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="4"><u>{{ $atarosak->asetalih->nama_komponen ?? null}}</u><br>{{ $atarosak->prihal_rosak }}</td>
                    </tr>
                    <tr>
                        <td colspan="4">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="width:100px; border-top:1px solid">Nama Penerima</td>
                        <td colspan="3" style="border-top:1px solid">: {{ $atarosak->nama_syor->name ?? null }}</td>
                    </tr>
                    <tr>
                        <td style="width:100px; border-top:1px solid">Jawatan</td>
                        <td colspan="3" style="border-top:1px solid">: {{ $atarosak->nama_syor->jawatan ?? null }}</td>
                    </tr>
                    <tr>
                        <td style="width:100px; border-top:1px solid">Tarikh / Masa</td>
                        <td colspan="3" style="border-top:1px solid">: {{ date('d-m-Y', strtotime($atarosak->tarikh_terima ?? null)) }}</td>
                    </tr>
                </table>



                </div>
            </div>
    </div>
        
    <div class="page-break"></div>

    <div class="row mt-4">
        <h1 class="card-title" style="text-align: right">JKR.PATA.F7/4</h1>
        <h1 class="card-title" style="text-align: center">BORANG ARAHAN SIASATAN PENYELENGGARAN</h1>
        <div class="table-responsive">

            <table class="table" style="border:1px solid; width:100%">
                <tr>
                    <td rowspan="2" colspan="4" style="border:1px solid">&nbsp;</td>
                    <td style="border-top:1px solid">No. Aduan</td>
                    <td colspan="3" style="border-top:1px solid; border-right:1px solid">: {{ $atarosak->id}}/{{ date('Y', strtotime($atarosak->tarikh_rosak ?? null)) }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td colspan="3" style="border-right:1px solid">: {{ $atarosak->statusrosak->nama_status}}</td>
                </tr>
                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">A. Maklumat Aduan</td>
                </tr>
                <tr>
                    <td>No. Aduan</td>
                    <td colspan="7">: {{ $atarosak->id}}/{{ date('Y', strtotime($atarosak->tarikh_rosak ?? null)) }}</td>
                </tr>
                <tr>
                    <td>Nama Pengadu</td>
                    <td colspan="7">: {{ $atarosak->kakitangan->nama ?? null }}</td>
                </tr>
                <tr>
                    <td>Jenis Kerja</td>
                    <td colspan="7">: {{ $atarosak->jenis_kerja ?? null }}</td>
                </tr>
                <tr>
                    <td>Kategori Kerja</td>
                    <td colspan="7">: @if ($atarosak->keutamaan == 1)
                        Umum
                    @elseif($atarosak->keutamaan == 2)
                        Segera (Breakdown)
                    @else
                        Kecemasan
                    @endif
                    </td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td colspan="7">: {{ $atarosak->asetalih->asetalih_data->bangunan->nama_bangunan }} / {{ $atarosak->asetalih->asetalih_data->nama_lokasi }} / {{ $atarosak->asetalih->kod_lokasi_ata }}</td>
                </tr>
                <tr>
                    <td colspan="8" style="border-top:1px solid">Keterangan Kerosakan</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td colspan="7"><u>{{ $atarosak->asetalih->nama_komponen ?? null}}</u><br>{{ $atarosak->prihal_rosak ?? null }}</td>
                </tr>

                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">B. Arahan Siasat / Tindakan</td>
                </tr>
                <tr>
                    <td>Diterima Oleh</td>
                    <td colspan="2">: {{ $atarosak->nama_syor->name ?? null }}</td>
                    <td colspan="2">Ditugaskan Kepada</td>
                    <td colspan="3">: {{ $atarosak->nama_2->nama ?? null }}</td>
                </tr>
                <tr>
                    <td>Tarikh</td>
                    <td colspan="2">: {{ date('d-m-Y', strtotime($atarosak->tarikh_siasat ?? null)) }}</td>
                    <td colspan="2">Masa</td>
                    <td colspan="3">: </td>
                </tr>
                <tr>
                    <td>Ulasan Kerosakan</td>
                    <td colspan="7">: {{ $atarosak->ulas_siasat ?? null }}</td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;</td>
                </tr>
                <tr>
                    <td>Tandatangan</td>
                    <td colspan="7">: </td>
                </tr>
                <tr>
                    <td>Cop Nama & Jawatan</td>
                    <td colspan="7">: </td>
                </tr>

                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">C. Butiran Alat Ganti</td>
                </tr>
                <tr>
                    <td colspan="3" style="width:66%; text-align:center; border-left:1px solid">Jenis Alat Ganti</td>
                    <td colspan="2" style="width:20%; text-align:center; border-left:1px solid">Keterangan</td>
                    <td style="width:12%; text-align:center; border-left:1px solid">Harga Alat Ganti/Stok</td>
                    <td style="width:12%; text-align:center; border-left:1px solid">Kuantiti</td>
                    <td style="width:12%; text-align:center; border-left:1px solid">Jumlah</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-left:1px solid; border-top:1px solid">{{ $atarosak->jenis_1 ?? null }}</td>
                    <td colspan="2" style="center; border-left:1px solid; border-top:1px solid">&nbsp;</td>
                    <td style="text-align:right; border-left:1px solid; border-top:1px solid">{{ $atarosak->harga_1 ?? null }}</td>
                    <td style="text-align:center; border-left:1px solid; border-top:1px solid">{{ $atarosak->kuantiti_1 ?? null }}</td>
                    <td style="text-align:right; border-left:1px solid; border-top:1px solid">{{ $atarosak->jumlah_1 ?? null }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-left:1px solid">{{ $atarosak->jenis_2 ?? null }}</td>
                    <td colspan="2" style="center; border-left:1px solid">&nbsp;</td>
                    <td style="text-align:right; border-left:1px solid">{{ $atarosak->harga_2 ?? null }}</td>
                    <td style="text-align:center; border-left:1px solid">{{ $atarosak->kuantiti_2 ?? null }}</td>
                    <td style="text-align:right; border-left:1px solid">{{ $atarosak->jumlah_2 ?? null }}</td>
                </tr>
                <tr>
                    <td colspan="3" style="border-left:1px solid">{{ $atarosak->jenis_3 ?? null }}</td>
                    <td colspan="2" style="center; border-left:1px solid">&nbsp;</td>
                    <td style="text-align:right; border-left:1px solid">{{ $atarosak->harga_3 ?? null }}</td>
                    <td style="text-align:center; border-left:1px solid">{{ $atarosak->kuantiti_3 ?? null }}</td>
                    <td style="text-align:right; border-left:1px solid">{{ $atarosak->jumlah_3 ?? null }}</td>
                </tr>

                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">D. Tindakan Pembaikan / Pencegahan</td>
                </tr>
                <tr>
                    <td>Perihal Kerja / Tindakan</td>
                    <td colspan="7">: {{ $atarosak->perihal_kerja ?? null }}</td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;</td>
                </tr>
                <tr>
                    <td>Tarikh & Masa Mula</td>
                    <td colspan="2">: {{ $atarosak->tarikh_mula ?? null }}</td>
                    <td colspan="2">Tarikh & Masa Siap</td>
                    <td colspan="3">: {{ $atarosak->tarikh_siap ?? null }}</td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;</td>
                </tr>
                <tr>
                    <td>Tandatangan</td>
                    <td colspan="7">: </td>
                </tr>
                <tr>
                    <td>Cop Nama & Jawatan</td>
                    <td colspan="7">: </td>
                </tr>

                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">E. Lantik kontraktor / Tempoh Tanggungan Kecacatan (Jika Berkenaan)</td>
                </tr>
                <tr>
                    <td>Nama Kontraktor</td>
                    <td colspan="2">: </td>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="3">&nbsp;</td>
                </tr>
                <tr>
                    <td>Tarikh Mula Kerja</td>
                    <td colspan="2">: </td>
                    <td colspan="2">Kos Akhir (RM)</td>
                    <td colspan="3">:</td>
                </tr>
                <tr>
                    <td>Tarikh Siap Kerja</td>
                    <td colspan="2">: </td>
                    <td colspan="2">Tempoh Tanggungan</td>
                    <td colspan="3">:</td>
                </tr>

                <tr>
                    <td colspan="8" style="border:1px solid; background-color:rgba(0, 0, 0, 0.226)">F. Perakuan Siap Kerja</td>
                </tr>
                <tr>
                    <td colspan="4">Pengesahan oleh Pegawai Penyelia Kontraktor (Jika Berkaitan)</td>
                    <td colspan="4">Pengesahan Oleh Unit Fasiliti & Penyelenggaraan</td>
                </tr>
                <tr>
                    <td colspan="8">&nbsp;</td>
                </tr>
                <tr>
                    <td>Tandatangan</td>
                    <td colspan="3">: </td>
                    <td>Tandatangan</td>
                    <td colspan="3">: </td>
                </tr>
                <tr>
                    <td>Cop Nama & Jawatan</td>
                    <td colspan="3">: </td>
                    <td>Cop Nama & Jawatan</td>
                    <td colspan="3">: </td>
                </tr>
                <tr>
                    <td>Tarikh / Masa</td>
                    <td colspan="3">: </td>
                    <td>Tarikh / Masa</td>
                    <td colspan="3">: </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-break"></div>
        <p></p>
        <p></p>
        <table>
            <thead>
                <tr>
                    <th colspan="4"><b>Gambar Aduan Kerosakan {{ $atarosak->asetalih->nama_komponen ?? null}} ({{ $atarosak->asetalih->asetalih_data->nama_lokasi }} / {{ $atarosak->asetalih->kod_lokasi_ata }})</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ public_path('storage/ATA_ROSAK/'.$atarosak->pic_1) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>

                @if (!empty($atarosak->pic_2))
                <tr>
                    <td><img src="{{ public_path('storage/ATA_ROSAK/'.$atarosak->pic_2) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>
                @endif
                @if (!empty($atarosak->pic_3))
                <tr>
                    <td><img src="{{ public_path('storage/ATA_ROSAK/'.$atarosak->pic_3) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>
                @endif


            </tbody>
        </table>

</body>
</html>