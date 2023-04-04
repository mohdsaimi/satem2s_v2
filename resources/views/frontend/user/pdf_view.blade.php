<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
 --}}
<style>
    h1 {
        font-size: 40px;
    }

    h2 {
    font-size: 30px;
    }

    p {
    font-size: 14px;
    }

    table {
      font-family: arial, sans-serif;
      font-size: 10px;
      border-collapse: collapse;
      width: 100%;
    }
    
    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }
    
    tr:nth-child(even) {
      background-color: #dddddd;
    }

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

    <title>Rekod Kehadiran Pelajar</title>
  </head>
  <footer>
    Copyright &copy;SATEM2S <?php echo date("Y");?> 
    <br>Page <span class="pagenum"></span>
</footer>
  <body>
    

   
    <div class="row mt-4">
      <h3 class="card-title" style="text-align: center">Rekod Kehadiran Pelajar</h3>
        <div class="col">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bil.</th>
                            <th>Nama Pelajar</th>
                            <th>Kod Kursus</th>
                            <th>Sesi Kemasukkan</th>
                            <th>Suhu Pagi</th>
                            <th>Masa Pagi</th>
                            <th>Lokasi</th>
                            <th>Suhu Petang</th>
                            <th>Masa Petang</th>
                            <th>Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{ $i=0 }}
                        @foreach($students as $student)

                        <tr>
                            <td>{{ ++$i }}</td>
                            <td style="text-transform:uppercase">{{ $student->nama_pelajar ?? null }}</td>
                            <td>{{ $student->course->kod ?? null }}</td>
                            <td>{{ $student->sesi_masuk ?? null}}</td>
                            <td>{{ number_format($log_pagi[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                            <td>{{ $log_pagi[$student->id_rfid][0]->masa ?? null}}</td>
                            <td>{{ $log_pagi[$student->id_rfid][0]->lokasi ?? null}}</td>
                            <td>{{ number_format($log_petang[$student->id_rfid][0]->suhu ?? null, 2) }}</td>
                            <td>{{ $log_petang[$student->id_rfid][0]->masa ?? null }}</td>
                            <td>{{ $log_petang[$student->id_rfid][0]->lokasi ?? null }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
        <!--col-->
    </div>
    <!--row-->
    




  </body>
</html>