@extends('layouts.admin.main')

@section('title', 'Create User')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create User</h5>

            <!-- Floating Labels Form -->
              <form class="row g-3" action="#" method="POST">
                @csrf
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="User Name">
                    <label for="floatingName">User Name</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatingEmail" placeholder="User Email">
                    <label for="floatingEmail">User Email</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingPhone" placeholder="User Phone">
                    <label for="floatingPhone">User Phone</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingConfirmPassword" placeholder="Confirm Password">
                    <label for="floatingConfirmPassword">Confirm Password</label>
                  </div>
                </div>
                
                <div class="col-12 text-end">
                    <div>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create User</button>
                    </div>
                </div>
              </form><!-- End floating Labels Form -->

            </div>

        </div>
    </div>
</section>
@endsection
