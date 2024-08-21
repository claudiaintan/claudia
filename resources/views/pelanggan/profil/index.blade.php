<x-layout-home>
    <x-slot:title>
        Profil
    </x-slot:title>
    @if(session()->get('message'))
        <div class="alert alert-success w-100">
            {{ session()->get('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger pt-3">
            @foreach ($errors->all() as $error)
                <p class="m-0 p-0">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <form action="{{ route('profile.update') }}" method="post" class="card p-5 d-flex flex-column gap-2" style="min-width: 75%">
            <h4 class="text-center mb-5">Edit Profile</h4>
            @csrf
            @method('put')
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}" required>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <small class="text-muted">Kosongkan Jika Tidak Diubah</small>
            </div>
            <hr>
            <h5>Alamat</h5>

            <div class="form-group">
                <label for="province_id" class="form-label">Provinsi</label>
                <select name="province_id" id="province_id" class="form-select w-100 select2" data-placeholder="Pilih Provinsi" required>
                    <option value=""></option>
                    @foreach ($provinces as $opt)
                        <option value="{{ $opt['province_id'] }}" @if ($user->pelanggan->province_id == $opt['province_id']) selected @endif>{{ $opt['province'] }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="city_id" class="form-label">Kota/Kabupaten</label>
                <select name="city_id" id="city_id" class="form-control select2" data-placeholder="Pilih" disabled required>
                    <option value="{{ $user->pelanggan->city_id }}" selected></option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ $user->pelanggan->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">No Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{ $user->pelanggan->no_telp }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');" required>
            </div>
            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(function () {
                $('.select2').select2({
                    allowClear: true,
                })
                $('#province_id').change(function (e) {
                    e.preventDefault();
                    var value = $(this).val();

                    if (value != '') {
                        $('#city_id').removeAttr('disabled');
                        getCities(value)

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
                            text += `<option value="${v.city_id}" ${selected}>${v.city_name}</option>`
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
