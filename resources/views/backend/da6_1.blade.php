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
            padding: 1px;"><h1 style="text-align: center">helaian 1</h1></td>
            </tr>
        </table>
        
        
        
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="6" style="font-size:12px; text-align: right;"><b>D.A 6 (JKR.PATA.F6/12 rev 1)</b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px;"><b><u>BORANG PENGUMPULAN DATA DAFTAR ASET KHUSUS (DAK)</u></b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px;"><b><u>Peringkat Komponen</u></b></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:8px;"></th>
                            </tr>
                            <tr>
                                <th colspan="6" style="font-size:12px; text-align: left;"><b>MAKLUMAT LOKASI KOMPONEN</b></th>
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
                                <td colspan="4"><b><u>1114111MYS.040214.BE0001</u></b></td>
                            </tr>
                        </tbody>
                    </table>

                    <table border="0" width="100%">
                        <tr>
                            <td width="5%">
                            <table border="1" width="100%">
                                <tr>
                                    <td style="text-align: center;">/</td>
                                </tr>
                            </table>
                            </td>
                            <td><b>Blok (Tandakan '/' jika berkenaan)</b></td>
                        </tr>
                    </table>

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="2" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Maklumat Lokasi</b></font></td>
                        </tr>
                        <tr>
                            <td width="25%">Kod Blok</td>
                            <td >{{ $lokasi->bangunan->kod_bangunan ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Kod Aras</td>
                            <td >{{ $lokasi->aras ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Kod Ruang</td>
                            <td >{{ $lokasi->kod_lokasi ?? null }}</td>
                        </tr>
                        <tr>
                            <td>Nama Ruang</td>
                            <td >{{ $lokasi->nama_lokasi ?? null }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">Catatan : <br>{{ $lokasi->catatan ?? null }}</td>
                        </tr>
                    </table>
                    
                    {{-- table Maklumat Perolehan --}}
                    <div>&nbsp;</div>

                    <table border="0" width="100%">
                        <tr>
                            <td width="5%">
                            <table border="1" width="100%">
                                <tr>
                                    <td style="text-align: center;">&nbsp;</td>
                                </tr>
                            </table>
                            </td>
                            <td><b>Binaan Luar (Tandakan '/' jika berkenaan)</b></td>
                        </tr>
                    </table>

                    <table border="1">
                        <tr >
                            <td style="font-size:12px; text-align: center;" colspan="2" bgcolor="#000000">
                            <font color="#FFFFFF"><b>Maklumat Lokasi</b></font></td>
                        </tr>
                        <tr>
                            <td width="25%">Nama Binaan Luar</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Kod Binaan Luar</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td rowspan="2">Koordinat GPS</td>
                            <td >X :</td>
                        </tr>
                        <tr>
                            <td>Y :</td>
                        </tr>
                        <tr>
                            <td colspan="2">Diisi Jika Binaan Luar Mempunyai Aras dan Ruang</td>
                        </tr>
                        <tr>
                            <td>Kod Aras</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Kod Ruang</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Nama Ruang</td>
                            <td >&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="2">Catatan :<br><br></td>
                        </tr>
                    </table>

                    {{-- Tandatangan --}}
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>
                    <div>&nbsp;</div>

                    <table border="0" width="100%">
                        <tr>
                            <td colspan="3" style="text-align: center;">PENGUMPUL DATA :</td>
                            <td width="5%">&nbsp;</td>
                            <td colspan="3" style="text-align: center;">PENGESAH DATA :</td>
                        </tr>
                        <tr>
                            <td width="20%" style="text-align: right;">Tandatangan</td>
                            <td width="3">:</td>
                            <td><table border="1" width="100%">
                                <tr>
                                    <td>&nbsp;<br><br><br></td>
                                </tr>
                            </table></td>
                            <td>&nbsp;</td>
                            <td width="20%" style="text-align: right;">Tandatangan</td>
                            <td width="3">:</td>
                            <td><table border="1" width="100%">
                                <tr>
                                    <td>&nbsp;<br><br><br></td>
                                </tr>
                            </table></td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Nama</td>
                            <td >:</td>
                            <td>{{ $lokasi->nama_pengumpul->nama ?? null }}</td>
                            <td>&nbsp;</td>
                            <td style="text-align: right;">Nama</td>
                            <td >:</td>
                            <td>{{ $lokasi->nama_pengesah->nama ?? null }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Jawatan</td>
                            <td >:</td>
                            <td>
                                @if (!empty($lokasi->nama_pengesah->nama))
                                    {{ $lokasi->nama_pengumpul->jawatan ?? null }} ({{ $lokasi->nama_pengumpul->gred ?? null }})
                                @endif
                            </td>
                            <td>&nbsp;</td>
                            <td style="text-align: right;">Jawatan</td>
                            <td >:</td>
                            <td>
                                @if (!empty($lokasi->nama_pengesah->nama))
                                    {{ $lokasi->nama_pengesah->jawatan ?? null }} ({{ $lokasi->nama_pengesah->gred ?? null }})
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: right;">Tarikh</td>
                            <td >:</td>
                            <td >&nbsp;</td>
                            <td >&nbsp;</td>
                            <td style="text-align: right;">Tarikh</td>
                            <td >:</td>
                            <td >&nbsp;</td>
                        </tr>
                    </table>
                    
                
                </div>
            </div><!--col-->
        </div><!--row-->


</body>
</html>