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
            font-family: arial, sans-serif;
            font-size: 11px;
            border-collapse: collapse;
            width: 100%;
        }
        
        td {
            /* border: 1px solid #dddddd; */
            text-align: left;
            padding: 8px;
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
    
    </style>


    <title>BORANG PEP</title>
</head>

{{-- <footer>
    Copyright &copy;RepoTech <?php echo date("Y");?> 
    <br>Page <span class="pagenum"></span>
</footer> --}}

<body>
    
    <div class="row mt-4">
        <h1 style="text-align: right">KEW.PA-19</h1>
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="7"><b>KERAJAAN MALAYSIA</b></th>
                            </tr>
                            <tr>
                                <th colspan="7"><b>PERAKUAN PELUPUSAN (PEP)</b></th>
                            </tr>
                            <tr>
                                <th colspan="7"><b>KERAJAAN MALAYSIA</b></th>
                            </tr>
                            <tr>
                                <th colspan="7"></th>
                            </tr>
                            <tr>
                                <th colspan="7"></th>
                            </tr>
                            <tr>
                                <th colspan="7"></th>
                            </tr>
                            <tr>
                                <th colspan="7"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td colspan="1"><b>Kementerian atau Jabatan</b></td>
                                <td colspan="1">:</td>
                                <td colspan="5">KSM / JTM / Institut Latihan Perindutrian (ILP) Selandar</td>
                            </tr>

                            <tr>
                                <td colspan="1"><b>Alamat</b></td>
                                <td colspan="1">:</td>
                                <td colspan="5">Lot 1468, Jalan Batang Melaka, 77500 Selandar, Melaka.</td>
                            </tr>


                            <?PHP

                                $masa = $tetapan->tahun_lupus - date("Y", strtotime($hmlupus->hartamodal->tarikh_beli ?? null));
                                $tempoh = $masa * 365 * 24;

                            ?>

                            <tr>
                                <td style="width:21%">No. Siri Pendaftaran Aset</td>
                                <td style="width:1%">:</td>
                                <td>{{ $hmlupus->hartamodal->no_siri_pendaftaran ?? null}}</td>
                                <td style="width:2%"></td>
                                <td style="width:22%">Jumlah jarak perjalanan(km)/ Tempoh penggunaan(jam)</td>
                                <td style="width:1%">:</td>
                                <td>{{ number_format($tempoh) }} jam</td>
                            </tr>

                            <tr>
                                <td>No. Kodifikasi Nasional</td>
                                <td>:</td>
                                <td>{{ $hmlupus->hartamodal->kod_nasional ?? null}}</td>
                                <td></td>
                                <td>Tahap Prestasi Semasa Aset (%)</td>
                                <td>:</td>
                                <td>{{ $hmlupus->prestasi ?? null}} %</td>
                            </tr>

                            <tr>
                                <td>Jenis, Jenama dan Model</td>
                                <td>:</td>
                                <td>{{ $hmlupus->hartamodal->jenis ?? null}} {{ $hmlupus->hartamodal->jenama ?? null}}</td>
                                <td></td>
                                <td>Jumlah Kos Penyelenggaraan Semasa</td>
                                <td>:</td>
                                <td> -</td>
                            </tr>

                            <tr>
                                <td>No. Chassis/Siri Pembuat</td>
                                <td>:</td>
                                <td>{{ $hmlupus->hartamodal->no_casis_siri_pembuat ?? null}}</td>
                                <td></td>
                                <td>Nilai semasa</td>
                                <td>:</td>
                                <td>RM {{ number_format($hmlupus->nilai_semasa ?? null, 2) }}</td>
                            </tr>

                            <tr>
                                <td>No. Enjin</td>
                                <td>:</td>
                                <td>{{-- {{ $hmlupus->hartamodal->jenis_no_enjin ?? null}} --}} -</td>
                                <td></td>
                                <td>Anggaran Kos Penyelenggaraan Semasa</td>
                                <td>:</td>
                                <td> - </td>
                            </tr>

                            <tr>
                                <td>No. Pendaftaran (kenderaan)</td>
                                <td>:</td>
                                <td>{{-- {{ $hmlupus->hartamodal->no_siri_pendaftaran_ken ?? null}} --}} - </td>
                                <td></td>
                                <td>Anggaran Nilai Selepas Diperbaiki</td>
                                <td>:</td>
                                <td> - </td>
                            </tr>

                            <tr>
                                <td>Tarikh Perolehan</td>
                                <td>:</td>
                                <td>{{ date("d-m-Y", strtotime($hmlupus->hartamodal->tarikh_beli ?? null)) }}</td>
                                <td></td>
                                <td>Anggaran Tempoh Usia Guna Selepas Diperbaiki</td>
                                <td>:</td>
                                <td> - </td>
                            </tr>

                            <tr>
                                <td>Nilai Perolehan Asal</td>
                                <td>:</td>
                                <td>RM {{ number_format($hmlupus->hartamodal->kos ?? null,2) }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="7"><b>LAPORAN PEMERIKSAAN</b></td>
                            </tr>
                            <tr>
                                <td colspan="7">Butir-butir penambahbaikan yang perlu:-</td>
                            </tr>
                            <tr>
                                <td colspan="7">1. -</td>
                            </tr>
                            <tr>
                                <td colspan="7">2.</td>
                            </tr>
                            <tr>
                                <td colspan="7">3.</td>
                            </tr>
                            <tr>
                                <td colspan="7">Disahkan bahawa Aset Alik tersebut telah diperiksa dan laporannya seperti berikut:-</td>
                            </tr>
                            <tr>
                                <td colspan="7">1. {{ $hmlupus->jus_1 ?? null }}</td>
                            </tr>
                            <tr>
                                <td colspan="7">2. {{ $hmlupus->jus_2 ?? null }}</td>
                            </tr>
                            <tr>
                                <td colspan="7">3. {{ $hmlupus->jus_3 ?? null }}</td>
                            </tr>

                            <tr>
                                <td style="padding: 30px" colspan="3"></td>
                                <td style="padding: 30px" colspan="4"></td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">..............................................</td>
                                <td style="padding: 3px" colspan="4">..............................................</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">(Tandatangan)</td>
                                <td style="padding: 3px" colspan="4">(Tandatangan)</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">Nama :</td>
                                <td style="padding: 3px" colspan="4">Nama :</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">Jawatan :</td>
                                <td style="padding: 3px" colspan="4">Jawatan :</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">Tarikh :</td>
                                <td style="padding: 3px" colspan="4">Tarikh :</td>
                            </tr>
                            <tr>
                                <td style="padding: 3px" colspan="3">Cap :</td>
                                <td style="padding: 3px" colspan="4">Cap :</td>
                            </tr>



                        </tbody>
                    </table>
                
                </div>
            </div><!--col-->
        </div><!--row-->


</body>
</html>