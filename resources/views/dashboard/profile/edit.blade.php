<x-dashboard-template>
    <x-slot:dropdownMaster>
    </x-slot:dropdownMaster>

    <x-slot:title>
        Edit Profile
    </x-slot:title>

    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        @php
            if (auth()->user()->hasRole('ADMIN')) {
                $url = route('dashboard.profile.update');
            } else {
                $url = route('profile.update');
            }
        @endphp
        <form action="{{ $url }}" method="post" class="card p-5 d-flex flex-column gap-2" style="min-width: 75%">
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
            </div>
            <hr>
            @if (auth()->user()->hasRole('PELANGGAN'))
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
                <select name="city_id" id="city_id" class="form-select select2" data-placeholder="Pilih Kota/Kabupaten" required>
                    <option value="{{ $user->pelanggan->city_id }}" selected>{{ $user->pelanggan->city->city_name ?? 'Pilih Kota/Kabupaten' }}</option>
                </select>
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required>{{ $user->pelanggan->alamat }}</textarea>
            </div>

            <div class="form-group">
                <label for="no_telp" class="form-label">No Telepon</label>
                <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{ $user->pelanggan->no_telp }}" required>
            </div>

            @endif

            @if ($errors->any())
                <div class="alert alert-danger pt-3">
                    @foreach ($errors->all() as $error)
                        <p class="m-0 p-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session()->get('message'))
                <div class="alert alert-success w-100">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="form-group text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>

    @slot('scripts')
        @if (auth()->user()->hasRole('PELANGGAN'))
            <script>
                $(document).ready(function() {
                    // Inisialisasi kota jika sudah ada provinsi yang dipilih
                    let province_id = $('#province_id').val();
                    if (province_id) {
                        getCities(province_id);
                    }

                    // Trigger ketika provinsi berubah
                    $('#province_id').change(function () {
                        let value = $(this).val();

                        if (value) {
                            $('#city_id').removeAttr('disabled');
                            getCities(value);
                        } else {
                            $('#city_id').attr('disabled', true).html('<option value="">Pilih Kota/Kabupaten</option>');
                        }
                    });

                    function getCities(provinceId) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('cities') }}",
                            data: { id: provinceId },
                            cache: false,
                            success: function(response) {
                                let options = '<option value="">Pilih Kota/Kabupaten</option>';
                                $.each(response, function (index, city) {
                                    let selected = city.city_id == '{{ $user->pelanggan->city_id }}' ? 'selected' : '';
                                    options += `<option value="${city.city_id}" ${selected}>${city.city_name}</option>`;
                                });

                                $('#city_id').html(options);
                            },
                            error: function(xhr, status, error) {
                                console.error('Error:', error);
                            }
                        });
                    }
                });
            </script>
        @endif
    @endslot
</x-dashboard-template>
