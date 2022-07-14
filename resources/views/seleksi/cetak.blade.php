<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <style>
    main{
      margin:20px;
    }
    table, td, th {
      border: 1px solid;
      padding: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 1rem;
    }
    thead{
      background-color: black;
      color: white;
    }
    </style>
</head>
<body>
  <main>
      <h1 style="text-align: center;font-weight:bold">Hasil Seleksi Calon Pegawai</h1>
       <table>
         <thead class="table-dark">
           <tr>
             <th width="1%">No</th>
             <th>Nama Karyawan</th>
             <th>TGL Lahir</th>
             <th>Alamat</th>
             <th>Niali</th>
           </tr>
         </thead>
         <tbody>
          @foreach ($rangking as $item)    
            @foreach ($dataKaryawan as $karyawan)
            @if ($item->name == $karyawan->name)
              <tr>
                <td>{{ ++$no }}</td>
                <td>{{ $karyawan->name }}</td>
                <td>{{ $karyawan->tgl_lahir }}</td>
                <td>{{ $karyawan->alamat }}</td>
                <td style="text-align: center">{{ $item->nilai }}</td>
              </tr>
            @endif
            @endforeach
          @endforeach
         </tbody>
       </table> 
    </div>
  </main>
</body>
</html>