<x-dashboard-template>
   <x-slot:dropdownMaster>
        1
    </x-slot:dropdownMaster>

    <x-slot:title>
        Edit Profile
    </x-slot:title>

    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <form action="{{ route('dashboard.profile.update') }}" method="post" class="card p-5 d-flex flex-column gap-2" style="min-width: 75%">
            <h4 class="text-center mb-5">Edit Profile</h4>
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
            </div>

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

            <div class="form-group">
                <input type="submit" value="Edit" class="btn btn-primary">
            </div>
        </form>
    </div>
</x-dashboard-template>
