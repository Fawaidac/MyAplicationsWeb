@extends('layouts.mainlayout')
@section('title', 'Master RT RW')
<!-- partial -->
@section('content')
    <div class="header-atas">
        <h4>Halaman Master RT dan RW</h4>
        <button data-toggle="modal" name='tambah' data-target="#modal-tambah">Tambah data</button>
    </div>
    <div class="table_wrapper" style="overflow-x: scroll;">
        <table id="myTable" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>No Hp </th>
                    <th>RT</th>
                    <th>RW</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <form action="" method="post">
                    @foreach ($data as $no => $value)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $value->nik }}</td>
                            <td>{{ $value->nama_lengkap }}</td>
                            <td>{{ $value->alamat }}</td>
                            <td>{{ $value->no_hp }}</td>
                            <td>{{ $value->rt }}</td>
                            <td>{{ $value->rw }}</td>
                            <td>
                                
                                <a class="btn btn-warning fa fa-pencil" href="" data-toggle="modal"
                                    data-target="#modal-edit{{ $value->nik }}">
                                </a>
                                <a class="btn btn-danger icon-trash" name='Hapus' href="#" data-toggle="modal"
                                    data-target="#modal-hapus" style="margin-left: 10px; " value="{{ $value->no_kk }}"
                                    href="{{ url('masterrtrw') }}"></a>
                            </td>
                        </tr>
                    @endforeach
                </form>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="modal-tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master RT dan RW</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('simpanrtrw') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="nik" class="form-control" value="" maxlength="50"
                                required="" placeholder="NIK" autocomplete="off" name="nik">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama_lengkap" class="form-control" value="" maxlength="50"
                                required="" placeholder="Nama Lengkap" autocomplete="off" name="NamaLengkap">
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamatkk" class="form-control" value="" maxlength="50"
                                required="" placeholder="Alamat" autocomplete="off" name="alamat">
                        </div>
                        <div class="form-group">
                            <input type="text" name="no_hp" class="form-control" value="" maxlength="50"
                                required="" placeholder="No HP" autocomplete="off" name="no_hp">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt" class="form-control" placeholder="RT" autocomplete="off" name="rt">
                                </div>
                                <div class="col">
                                    <input type="text" name="rw" class="form-control" placeholder="RW" autocomplete="off" name="rw">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-Success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal edit --}}
    @foreach ($data as $no => $value)
    <div class="modal fade" id="modal-edit{{ $value->nik }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Master RT dan RW</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url('update-masterrtrw/' . $value->nik) }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="nik" class="form-control" value="{{ $value->nik }}" maxlength="50"
                                required="" placeholder="NIK" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="nama_lengkap" class="form-control" value="{{ $value->nama_lengkap }}" maxlength="50"
                                required="" placeholder="Nama Lengkap" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="alamat" class="form-control" value="{{ $value->alamat }}" maxlength="50"
                                required="" placeholder="Alamat" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <input type="text" name="no_hp" class="form-control" value="{{ $value->no_hp }}" maxlength="50"
                                required="" placeholder="No HP" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" name="rt" class="form-control" value="{{ $value->rt }}" placeholder="RT" autocomplete="off">
                                </div>
                                <div class="col">
                                    <input type="text" name="rw" class="form-control" value="{{ $value->rw }}" placeholder="RW" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-Success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    {{-- batas modal edit --}}

    {{-- Modal Hapus --}}
    @foreach ($data as $no => $value)
        <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" autocomplete="off">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Master RT RW</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Yakin untuk Menghapus Data {{ $value->nama_lengkap }} ?</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <a type="button" onclick="showNotification()"
                            href="{{ url($value->nik . '/hapus-masterrtrw') }}" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- Batas Modal Hapus --}}
@endsection

<style>
    table {
        border-collapse: collapse;
        white-space: nowrap;
        min-width: 100%;
    }

    .header-atas {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header h4 {
        margin: 0;
    }

    .header button {
        margin-left: auto;
    }
</style>


<script>
    $(document).ready(function() {
        $('#myModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('no_kk');
            var modal = $(this);

            $.ajax({
                url: '/data/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    modal.find('.modal-body').html(response.data);
                }
            });
        });
    });
</script>
