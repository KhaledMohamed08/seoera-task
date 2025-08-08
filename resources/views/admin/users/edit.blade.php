@extends('layouts.admin.main')

@section('title', 'Update User')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update User</h5>

            <!-- Floating Labels Form -->
              <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="name" id="floatingName" placeholder="User Name" value="{{ old('name', $user->name) }}">
                    <label for="floatingName">User Name</label>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="User Email" value="{{ old('email', $user->email) }}">
                    <label for="floatingEmail">User Email</label>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="phone" id="floatingPhone" placeholder="User Phone" value="{{ old('phone', $user->phone) }}">
                    <label for="floatingPhone">User Phone</label>
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                {{-- <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" name="password_confirmation" id="floatingConfirmPassword" placeholder="Confirm Password">
                    <label for="floatingConfirmPassword">Confirm Password</label>
                  </div>
                </div> --}}
                
                <div class="col-12 text-end">
                    <div>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </div>
              </form><!-- End floating Labels Form -->

            </div>

        </div>
    </div>
</section>
@endsection