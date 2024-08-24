<x-layout-home>
    <x-slot:title>
        Profil
    </x-slot:title>

    @if(session()->get('message'))
        <div class="alert alert-success w-100 mb-4" style="background-color: #fffbf0; border-color: #ffecb3;">
            <i class="bi bi-check-circle me-2"></i>{{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger w-100 mb-4" style="background-color: #f8d7da; border-color: #f5c6cb;">
            @foreach ($errors->all() as $error)
                <p class="m-0 p-0"><i class="bi bi-exclamation-circle me-2"></i>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center w-100 my-4">
        <form action="{{ route('profile.update') }}" method="post" class="card p-4 d-flex flex-column gap-3 shadow-lg rounded" style="width: 80%; max-width: 700px; background-color: #fff3e0; border: 1px solid #ffecb3;">
            <h4 class="text-center mb-3 text-warning"><i class="bi bi-person-circle me-2"></i>Edit Profile</h4>
            @csrf
            @method('put')
            <input type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="form-group">
                <label for="name" class="form-label"><i class="bi bi-person me-2"></i>Nama</label>
                <input type="text" class="form-control form-control-lg border-warning" id="name" name="name" placeholder="Masukkan Nama" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label"><i class="bi bi-envelope me-2"></i>Email</label>
                <input type="email" class="form-control form-control-lg border-warning" id="email" name="email" placeholder="Masukkan Email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label"><i class="bi bi-lock me-2"></i>Password</label>
                <input type="password" class="form-control form-control-lg border-warning" id="password" name="password" placeholder="Masukkan Password">
                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
            </div>

            <hr style="border-color: #ffecb3;">

            <h5 class="text-warning"><i class="bi bi-geo-alt me-2"></i>Alamat</h5>

            <div class="form-group">
                <label for="province_id" class="form-label"><i class="bi bi-geo-alt me-2"></i>Provinsi</label>
                <select name="province_id" id="province_id" class="form-select form-select-lg select2 border-warning" data-placeholder="Pilih Provinsi" required>
                    <option value=""></option>
                    @foreach ($provinces as $opt)
                        <option value="{{ $opt['province_id'] }}" @if ($user->pelanggan->province_id == $opt['province_id']) selected @endif>{{ $opt['province'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id" class="form-label"><i class="bi bi-building me-2"></i>Kota/Kabupaten</label>
                <select name="city_id" id="city_id" class="form-select form-select-lg select2 border-warning" data-placeholder="Pilih" disabled required>
                    <option value="{{ $user->pelanggan->city_id }}" selected></option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label"><i class="bi bi-house me-2"></i>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control form-control-lg border-warning" required>{{ $user->pelanggan->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="no_telp" class="form-label"><i class="bi bi-telephone me-2"></i>No Telepon</label>
                <input type="text" class="form-control form-control-lg border-warning" name="no_telp" id="no_telp" value="{{ $user->pelanggan->no_telp }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
            </div>

            <div class="form-group text-end">
                <button type="submit" class="btn btn-warning btn-lg"><i class="bi bi-save me-2"></i>Submit</button>
            </div>
        </form>
    </div>

    @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function () {
                $('.select2').select2({
                    allowClear: true,
                    width: 'resolve',
                });

                $('#province_id').change(function (e) {
                    e.preventDefault();
                    var value = $(this).val();

                    if (value != '') {
                        $('#city_id').removeAttr('disabled');
                        getCities(value);
                    } else {
                        $('#city_id').attr('disabled', true);
                        $('#city_id').html('');
                    }
                }).change();
            });

            function getCities(id) {
                var city_id = $('#city_id').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('cities') }}",
                    data: {
                        id: id,
                    },
                    cache: false,
                    success: function(response) {
                        var text = '';
                        $.each(response, function (i, v) {
                            var selected = city_id == v.city_id ? 'selected' : '';
                            text += `<option value="${v.city_id}" ${selected}>${v.city_name}</option>`;
                        });

                        $('#city_id').html(text);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        </script>
    @endslot
</x-layout-home>

