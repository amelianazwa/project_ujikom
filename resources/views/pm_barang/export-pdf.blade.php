
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Peminjaman Headset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        h1, h2, h3 {
            text-align: center;
            margin: 5px 0;
        }

        .header {
            margin: 0%;
             }

        .header p {
            margin: 2px 0;
            font-size: 10px;
        }

        .header strong {
            font-size: 15px;
            display: block;
        }

        hr {
            margin: 10px 0;
            border-top: 2px solid black;
        }

        .content p {
            margin-left: 50px;
            text-align: justify;
            font-size: 12px;
        }

        .table4 {
            font-size: medium;
            margin-left: 100px;
            margin-top: 10px;
            font-size: 12px;
        }


        .tb6 {
            width: 70%;
            margin-top: 20px;
            margin-right: 0px;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
            margin-left: 90px
        }

        .tb6 th, .tb6 td {
            border: 1px solid black;
            padding: 8px;
        }

        .tb6 th {
            background-color: #f2f2f2;
        }

        .signature-section {
            display: flex;
            justify-content: space-between; /* Distributes space evenly between items */
            margin-top: 40px;
            width: 100%; /* Adjust width to ensure it spans the container */
        }

        .signature-box {
            width: 45%;
            text-align: center;
        }


        td {
            vertical-align: top; /* Agar teks sejajar di bagian atas */
            padding: 5px;
            align-items: center;
        }

        .header-text {
            text-align: center; /* Agar teks di tengah */

        }
        .qwe{
            padding-right: 90px;
        }


        .hhh {
            width: 100%;
            border-collapse: collapse;
            padding-left: 30px;
            padding-right: 30px;


        }

        .hhh td {
            width: 50%;
            vertical-align: top; /* Agar konten sejajar di bagian atas */
           }


        .hhh h5 {
            margin-bottom: 60px; /* Ruang untuk tanda tangan */
            margin-top: 20px
        }

       .hhh p {
            margin: 0; /* Menghilangkan margin default */

        }
        .right-signature {
            text-align: right;
        }
        .right-signature p{
            text-align: right;
        }

    </style>
</head>

<body>

    <div class="container">
        <!-- Header Section -->
      <div class="header">
        <table class="qwe">
            <tr>
                <!-- Kolom untuk gambar logo -->
                <td style="width: 50%;">
                    <center>
                          <img src="assets/img/uin.png" alt="UIN Logo" style="height: 110px; "width="100%">
                    </center>

                </td>
                <!-- Kolom untuk teks -->
                <td class="header-text">
                    <strong>KEMENTERIAN AGAMA REPUBLIK INDONESIA</strong>
                    <strong>UNIVERSITAS ISLAM NEGERI SUNAN GUNUNG DJATI BANDUNG</strong>
                    <strong>PUSAT PENGEMBANGAN BAHASA</strong>
                    <p>Jalan A.H. Nasution No. 105 Cibiru Bandung 40614 Telp: 022-7800525 Fax: 022-7803936</p>

                </td>
            </tr>
        </table>
    </div>

        <hr>

        <!-- Title -->
        <h3 style="text-transform: uppercase;">
            BERITA ACARA PEMINJAMAN {{$pm_barang->barang->nama_barang}}
        </h3>

        <!-- Content -->

        <div class="content">
            <p>Pada hari ..... , Tanggal ..... bulan ..... , tahun ..... , kami yang bertanda tangan di bawah
                ini:</p>
                <table class="table4">
                    <tr>
                        <td>1</td>
                        <td></td>
                        <td> Nama</td>
                        <td>: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> Jabatan</td>
                        <td>: </td>
                        <td> </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> NIP</td>
                        <td>: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> alamat</td>
                        <td>: </td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td> </td>
                        <td> </td>
                        <td>Selanjutnya disebut PIHAK PERTAMA (2)</td>
                    </tr>
                </table>

            <table class="table4">
                <tr>
                    <td>2</td>
                    <td></td>
                    <td> Nama</td>
                    <td>: </td>
                    <td>{{$pm_barang->nama_peminjam}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td> instansi</td>
                    <td>: </td>
                    <td>{{$pm_barang->instansi}}</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>Email</td>
                    <td>: </td>
                    <td>{{$pm_barang->email}}</td>
                </tr>

                <tr>
                    <td></td>
                    <td></td>
                    <td> </td>
                    <td> </td>

                </tr>
            </table>


            <p>Pada hari ini telah menyerahkan barang-barang di bawah ini kepada PIHAK KEDUA.</p>

            <center>
                <table class="tb6">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Tanggal peminjaman</th>
                            <th>Tanggal pengembalian</th>
                            <th>keterangan</th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{$pm_barang->barang->nama_barang}}</td>
                            <td>{{$pm_barang->tanggal_peminjaman}}</td>
                            <td>{{$pm_barang->tanggal_pengembalian}}</td>
                            <td>{{$pm_barang->keterangan}}</td>
                        </tr>
                    </tbody>
                </table>
            </center>

            <p>Demikian berita acara ini dibuat sesuai dengan keadaan yang sebenarnya dan untuk digunakan sebagaimana
                mestinya.</p>

            <!-- Signature Section -->
            <div class="signature-section">
                <table class="hhh">
                    <tr>
                        <!-- Pihak Kedua di sebelah kiri -->
                        <td class="left-signature">
                            <h5>PIHAK KEDUA</h5>
                            <p>{{$pm_barang->nama_peminjam}}</p>

                        </td>
                        <!-- Pihak Pertama di sebelah kanan -->
                        <td class="right-signature">
                            <h5>PIHAK PERTAMA</h5>
                            <p>..........................................</p>
                            <p>NIP.....................................</p>


                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
