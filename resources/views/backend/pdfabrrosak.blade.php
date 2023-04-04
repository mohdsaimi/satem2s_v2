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
            padding: 10px;
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


    <title>BORANG ADUAN KEROSAKAN ASET ALIH</title>
</head>

<footer>
    Copyright &copy;RepoTech <?php echo date("Y");?> 
    <br>Page <span class="pagenum"></span>
</footer>

<body>
    
    <div class="row mt-4">
        <h1 class="card-title" style="text-align: right">KEW.PA-10</h1>
        <h1 class="card-title" style="text-align: center">BORANG ADUAN KEROSAKAN ASET ALIH</h1>
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4"><b>Bahagian I (Untuk diisi oleh Pengadu)</b></th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- <tr>
                                <td colspan="3">Kategori : {{ $hmrosak->hartamodal->kategori ?? null}}</td>
                                <td>Sub Kategori : {{ $hmrosak->hartamodal->sub_kategori ?? null}}</td>
                            </tr> --}}

                            <tr>
                                <td style="width:10px">1.</td>
                                <td style="width:180px">Jenis Aset</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->abr->jenis ?? null}} / {{ $abrrosak->abr->butiran ?? null}}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">2.</td>
                                <td style="width:180px">Nombor Siri Pendaftaran Aset/ Komponen</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->abr->no_siri_daftar ?? null}}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">3.</td>
                                <td style="width:180px">Pengguna Terakhir</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->penguna_akhir ?? null}}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">4.</td>
                                <td style="width:180px">Tarikh Kerosakan</td>
                                <td style="width:5px">:</td>
                                <td>{{ date('d-m-Y', strtotime($abrrosak->tarikh_rosak ?? null)) }}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">5.</td>
                                <td style="width:180px">Perihal Kerosakan</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->prihal_rosak ?? null}}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">6.</td>
                                <td style="width:180px">Nama Dan Jawatan</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->kakitangan->nama ?? null}} ( {{ $abrrosak->kakitangan->jawatan ?? null}} - {{ $abrrosak->kakitangan->gred ?? null}} )</td>
                            </tr>
                            <tr>
                                <td style="width:10px">7.</td>
                                <td style="width:180px">Tarikh</td>
                                <td style="width:5px">:</td>
                                <td>{{ date('d-m-Y', strtotime($abrrosak->tarikh_aduan ?? null)) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4"><b>Bahagian II (Untuk diisi oleh Pegawai Aset/ Pegawai Teknikal)</b></td>
                            </tr>
                            <tr>
                                <td style="width:10px">8.</td>
                                <td style="width:180px">Jumlah kos Penyelenggaraan Terdahulu</td>
                                <td style="width:5px">:</td>
                                @if (empty ($abrrosak->kos_dulu))
                                    <td>RM {{ number_format($hmrosak->kos_dulu ?? null, 2) }}</td>
                                @else
                                    <td>RM {{ number_format($abrrosak->kos_dulu ?? null, 2) }}</td>
                                @endif

                            </tr>
                            <tr>
                                <td style="width:10px">9.</td>
                                <td style="width:180px">Anggaran Kos Penyelenggaraan</td>
                                <td style="width:5px">: </td>

                                @if (empty ($abrrosak->kos_anggar))
                                    <td></td>
                                @else
                                    <td>RM {{ number_format($abrrosak->kos_anggar ?? null, 2) }}</td>
                                @endif
                                
                            </tr>
                            <tr>
                                <td style="width:10px">10.</td>
                                <td style="width:180px">Syor Dan Ulasan</td>
                                <td style="width:5px">:</td>
                                <td>{{ $abrrosak->syor ?? null }}</td>
                            </tr>
                            <tr>
                                <td style="width:10px">11.</td>
                                <td style="width:180px">Nama Dan Jawatan</td>
                                <td style="width:5px">:</td>
                                @if (empty($abrrosak->user_syor))
                                    <td></td>
                                @else
                                    <td>{{ $abrrosak->nama_syor->name ?? null }} ({{ $abrrosak->nama_syor->jawatan ?? null }})</td>
                                @endif
                                
                            </tr>
                            <tr>
                                <td style="width:10px">12.</td>
                                <td style="width:180px">Tarikh</td>
                                <td style="width:5px">:</td>
                                @if (empty($abrrosak->tarikh_syor))
                                    <td></td>
                                @else
                                    <td>{{ date('d-m-Y', strtotime($abrrosak->tarikh_syor ?? null)) }}</td>
                                @endif
                                
                            </tr>
                            <tr>
                                <td colspan="4"><b>Bahagian III (Keputusan Ketua Jabatan/ Bahagian/ Seksyen/ Unit)</b></td>
                            </tr>
                            <tr>
                                <td colspan="4">Diluluskan/ Tidak Diluluskan*</td>
                            </tr>
                            <tr>
                                <td colspan="4">Ulasan :</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4">............................................</td>
                            </tr>
                            <tr>
                                <td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tandatangan</td>
                            </tr>
                            <tr>
                                <td colspan="4">Nama : ..............................................</td>
                            </tr>
                            <tr>
                                <td colspan="4">Jawatan : ...........................................</td>
                            </tr>
                            <tr>
                                <td colspan="4">Tarikh : ............................................</td>
                            </tr>
                            <tr>
                                <td colspan="4">Nota : * Potong mana yang tidak berkenaan.</td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4"></td>
                            </tr>
                            <tr>
                                <td colspan="4">PIC : {{ $abrrosak->nama_1->nama ?? null}}</td>
                            </tr>



                        </tbody>
                    </table>
                
                </div>
            </div><!--col-->
        </div><!--row-->


        <div class="page-break"></div>
        <p></p>
        <p></p>
        <table>
            <thead>
                <tr>
                    <th colspan="4"><b>Gambar Aduan Kerosakan {{ $abrrosak->abr->no_siri_daftar ?? null}}</b></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><img src="{{ public_path('storage/ABR/'.$abrrosak->pic_1) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>

                @if (!empty($abrrosak->pic_2))
                <tr>
                    <td><img src="{{ public_path('storage/ABR/'.$abrrosak->pic_2) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>
                @endif
                @if (!empty($abrrosak->pic_3))
                <tr>
                    <td><img src="{{ public_path('storage/ABR/'.$abrrosak->pic_3) }}" class="rounded mx-auto d-block" height="250px;" alt="pic"></td>
                </tr>
                @endif


            </tbody>
        </table>


</body>
</html>