@foreach ($data as $item)
    <form action="{{ url('simpanrtrw') }}" method="post">
        @csrf
        <div class="modal-body">
            <input type="hidden" name="id_masyarakat" class="form-control" value="{{ $item->id_masyarakat }}" maxlength="50"
                    required="" readonly>
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ $item->nik }}" maxlength="50"
                    required="" placeholder="NIK" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control"
                    value="{{ $item->nama_lengkap }}" maxlength="50" required="" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ $item->alamat }}" maxlength="50"
                    required="" autocomplete="off" disabled>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="">RT</label>
                        <input type="text" name="rt"
                            value="{{ $item->rt }} "class="form-control" placeholder="RT"
                            autocomplete="off" disabled>
                    </div>
                    <div class="col">
                        <label for="">RW</label>
                        <input type="text" name="rw" value="{{ $item->rw }}"
                            class="form-control" placeholder="RW" disabled>
                    </div>
            </div>
            <div class="form-group">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" value="" maxlength="50"
                    required="" autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="" maxlength="50"
                    required="" autocomplete="off" >
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-Success">Simpan</button>
        </div>

    </form>
@endforeach
