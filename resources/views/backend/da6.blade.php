<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <style>
        h1 {
            font-size: 12px;
        }
    
        h2 {
        font-size: 30px;
        }
    
        p {
        font-size: 12px;
        }
    
        table {
            font-family: Helvetica;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }
        
        td {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 5px;
        }

        th {
            /* border: 1px solid #dddddd; */
            text-align: center;
            padding: 1px;
            font-size: 12px;
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


    <title>BORANG DA6</title>
</head>

{{-- <footer>
    Copyright &copy;RepoTech <?php echo date("Y");?> 
    <br>Page <span class="pagenum"></span>
</footer> --}}

<body>
    
    <div class="row mt-4">

        <table>
            <tr>
            <td></td>
            <td style ="border: 1px solid; width: 60px;
            text-align: center;
            padding: 1px;"><h1 style="text-align: center">helaian 2</h1></td>
            </tr>
        </table>
        
        
        
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" style="font-size:12px; text-align: right;"><b>D.A 6(JKR.PATA.F6/12 rev 1)</b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px;"><b><u>BORANG PENGUMPULAN DATA DAFTAR ASET KHUSUS</u></b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px;"><b><u>Peringkat Komponen Utama</u></b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:8px;"></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px; text-align: left;"><b><u>MAKLUMAT KOMPONEN UTAMA</u></b></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td><b>Nama Premis</b></td>
                                <td><b>:</b></td>
                                <td colspan="4"><b><u>INSTITUT LATIHAN PERINDUSTRIAN SELANDAR, MELAKA</u></b></td>
                            </tr>
                            <tr>
                                <td><b>No. DPA</b></td>
                                <td><b>:</b></td>
                                <td><b><u>1114111MYS.040214.BE0001</u></b></td>
                                <td><b>Kod Lokasi</b></td>
                                <td><b>:</b></td>
                                <td><b><u>{{ $asetalih->kod_lokasi_ata ?? null }}</u></b></td>
                            </tr>
                        </tbody>
                    </table>

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="4" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Maklumat Utama</b></font></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Komponen Utama</td>
                            <td colspan="3">{{ $asetalih->nama_komponen ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Sistem</td>
                            <td colspan="3">{{ $asetalih->sistem ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Sub Sistem</td>
                            <td colspan="3">{{ $asetalih->sub_sistem ?? null }}</td>
                        </tr>
                        <tr>
                            <td>* Kuantiti (Komponen Yang Sama Jenis)</td>
                            <td>{{ $asetalih->kuantiti ?? null }}</td>
                            <td rowspan="2">Gambar Komponen</td>
                            <td rowspan="2"><img src="{{ public_path('storage/ATA/'.$asetalih->pic) }}" class="rounded mx-auto d-block" height="50px;" alt="pic"></td>
                        </tr>
                        <tr>
                            <td>No. Perolehan (1GFMAS)</td>
                            <td>{{ $asetalih->no_1gfmas ?? null }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Bidang Kejuruteraan Komponen:<br>
                            
                                <table border="0" width="100%">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'A')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>Awam/ Arkitek</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'E')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>Elektrikal</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'T')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>ELV/ICT</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'M')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>Mekanikal</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'B')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>Bio Perubatan</td>
                                        <td><table border="1" width="100%">
                                            <tr>
                                                <td style="text-align: center;">@if ($asetalih->kod_kej == 'L')
                                                    /
                                                    @else
                                                    &nbsp;
                                                @endif</td>
                                            </tr>
                                        </table></td>
                                        <td>Lain-lain:<br>_____________</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                            
                            
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">Catatan: <br>{{ $asetalih->catatan_1 ?? null }}<br></td>
                        </tr>
                    </table>
                    
                    {{-- table Maklumat Perolehan --}}

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="4" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Maklumat Perolehan</b></font></td>
                        </tr>
                        <tr>
                            <td width="25%">Tarikh Perolehan</td>
                            <td >{{ $asetalih->tarikh_perolehan ?? null }}</td>
                            <td >Tarikh Dipasang</td>
                            <td >{{ $asetalih->tarikh_pasang ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Kos Perolehan/ Kontrak</td>
                            <td >{{ $asetalih->kos_perolehan ?? null }}</td>
                            <td >Tarikh Waranti Tamat</td>
                            <td >{{ $asetalih->tarikh_waranti_end ?? null }}</td>
                        </tr>
                        <tr>
                            <td rowspan="2"width="25%">No. Pesanan Rasmi Kerajaan / Kontrak</td>
                            <td rowspan="2">{{ $asetalih->no_lo ?? null }}</td>
                            <td >Tarikh Tamat DLP</td>
                            <td >{{ $asetalih->tarikh_tamat_dlp ?? null }}</td>
                        </tr>
                        <tr>
                            <td ></td>
                            <td ></td>
                        </tr>
                        <tr>
                            <td width="25%">Kod PTJ</td>
                            <td >{{ $asetalih->kod_ptj ?? null }}</td>
                            <td >Jangka Hayat</td>
                            <td >{{ $asetalih->jangka_hayat ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Pengilang</td>
                            <td colspan="3">{{ $asetalih->pengilang ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Pembekal</td>
                            <td >{{ $asetalih->pembekal ?? null }}</td>
                            <td >No. Telefon</td>
                            <td >{{ $asetalih->no_tel ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td colspan="3">{{ $asetalih->alamat ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Kontraktor</td>
                            <td >{{ $asetalih->kontraktor ?? null }}</td>
                            <td >No. Telefon</td>
                            <td >{{ $asetalih->no_tel_kon ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td colspan="3">{{ $asetalih->alamat_kon ?? null }}</td>
                        </tr>
                        <tr>
                            <td colspan="4">Catatan: <br>{{ $asetalih->catatan_2 ?? null }}<br></td>
                        </tr>
                    </table>

                    {{-- table Maklumat Komponen --}}

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="4" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Maklumat Komponen</b></font></td>
                        </tr>
                        <tr>
                            <td width="25%">Diskripsi</td>
                            <td colspan="3">{{ $asetalih->diskripsi ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Status Komponen</td>
                            <td >{{ $asetalih->status_kom ?? null }}</td>
                            <td >*No. Siri</td>
                            <td >{{ $asetalih->no_siri ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Jenama</td>
                            <td >{{ $asetalih->jenama ?? null }}</td>
                            <td >*No. Teg / Label<br>(Jika Berkaitan)</td>
                            <td >{{ $asetalih->label_kom ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="25%">Model</td>
                            <td >{{ $asetalih->model ?? null }}</td>
                            <td >*No. Sijil Pendaftaran<br>(Jika Ada)</td>
                            <td >{{ $asetalih->no_sijil_pendaftaran ?? null }}</td>
                        </tr>
                    </table>
                    <div class="page-break"></div>

                    <table>
                        <tr>
                        <td></td>
                        <td style ="border: 1px solid; width: 60px;
                        text-align: center;
                        padding: 1px;"><h1 style="text-align: center">helaian 3</h1></td>
                        </tr>
                    </table>

                    <p></p>
                    <p></p>

                    {{-- table ** Maklumat Atribut Spesifikasi --}}

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="6" bgcolor="#000000">
                            <font color="#FFFFFF"><b>** Maklumat Atribut Spesifikasi</b></font></td>
                        </tr>
                        <tr>
                            <td width="16%">Jenis</td>
                            <td colspan="2" width="34%">{{ $asetalih->jenis ?? null }}</td>
                            <td width="16%">Bahan</td>
                            <td colspan="2" width="34%">{{ $asetalih->bahan ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%">Bekalan Elektrik</td>
                            <td colspan="2">{{ $asetalih->bekalan_ele ?? null }}</td>
                            <td width="16%">Kaedah Pemasangan</td>
                            <td colspan="2">{{ $asetalih->kaedah_pasang ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%" style="text-align: center;">Saiz Fizikal</td>
                            <td colspan="2" style="text-align: center;">Unit</td>
                            <td width="16%" style="text-align: center;">Kadaran</td>
                            <td colspan="2" style="text-align: center;">Unit</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->saiz_1 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_1 ?? null }}</td>
                            <td rowspan="3" style="text-align: center;">(Panjang/Tinggi/Lebar/ Luas/ Dalam/ Lebar/ Tebal/Diameter/Jejari dll)</td>
                            <td width="16%">{{ $asetalih->kadaran_1 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_kadar_1 ?? null }}</td>
                            <td rowspan="5" style="text-align: center;">(Voltan/Arus/Kuasa/ Rating/Ratio/Keamatan Bunyi/Fluks/Faktor/ Kuasa/ Kecekapan/ Fotometri/ Bandwidth dll)</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->saiz_2 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_2 ?? null }}</td>
                            <td width="16%">{{ $asetalih->kadaran_2 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_kadar_2 ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->saiz_3 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_3 ?? null }}</td>
                            <td width="16%">{{ $asetalih->kadaran_3 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_kadar_3 ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%" style="text-align: center;">Kapasiti</td>
                            <td colspan="2" style="text-align: center;">Unit</td>
                            <td width="16%">{{ $asetalih->kadaran_4 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_kadar_4 ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->kapasiti_1 ?? null }}</td>
                            <td >{{ $asetalih->unit_kap_1 ?? null }}</td>
                            <td rowspan="3" style="text-align: center;">(Isipadu/Head/Berat/Btu/ Velocity/Speed dll)</td>
                            <td width="16%">{{ $asetalih->kadaran_5 ?? null }}</td>
                            <td width="10%">{{ $asetalih->unit_kadar_5 ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->kapasiti_2 ?? null }}</td>
                            <td >{{ $asetalih->unit_kap_2 ?? null }}</td>
                            <td colspan="3" rowspan="2">Catatan : <br> {{ $asetalih->catatan_3 ?? null }}</td>
                        </tr>
                        <tr>
                            <td width="16%">{{ $asetalih->kapasiti_3 ?? null }}</td>
                            <td >{{ $asetalih->unit_kap_3 ?? null }}</td>
                        </tr>
                    </table>

                    {{-- table Dokumen Berkaitan ( Jika Ada ) --}}

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="4" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Dokumen Berkaitan ( Jika Ada )</b></font></td>
                        </tr>
                        <tr>
                            <td width="5%">Bil</td>
                            <td width="45%">Nama Dokumen</td>
                            <td >No. Rujukan Berkaitan</td>
                            <td >Catatan</td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="45%">&nbsp;</td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="45%">&nbsp;</td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="45%">&nbsp;</td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="5%">&nbsp;</td>
                            <td width="45%">&nbsp;</td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                        </tr>
                    </table>

                    <div>
                        Nota :<br>
                        * Sila gunakan lampiran jika Maklumat Komponen diperlukan bagi kuantiti yang melebihi 1.<br>
                        ** Maklumat Spesifikasi diisi merujuk kepada Komponen yang dipilih dan berkaitan sahaja.
                    </div>
                
                </div>
            </div><!--col-->
        </div><!--row-->


</body>
</html>