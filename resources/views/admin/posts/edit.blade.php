@extends('layouts.admin.main')

@section('title', 'Update Post')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update Post</h5>

            <!-- Floating Labels Form -->
              <form class="row g-3" action="{{ route('posts.update', $post->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="title" id="floatingTitle" placeholder="Post Title" value="{{ old('title', $post->title) }}">
                    <label for="floatingTitle">Post Title</label>
                    @error('title')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating">
                    <input type="text" class="form-control" name="contact_phone_number" id="floatingPhone" placeholder="Contact Phone Number" value="{{ old('contact_phone_number', $post->contact_phone_number) }}">
                    <label for="floatingPhone">Contact Phone Number</label>
                    @error('contact_phone_number')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating mb-3">
                      <textarea class="form-control" name="description" placeholder="Post Description" id="floatingDescription" rows="10">{{ old('description', $post->description) }}</textarea>
                      <label for="floatingDescription">Post Description</label>
                    </div>
                </div>
                <div class="col-12 text-end">
                    <div>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
              </form><!-- End floating Labels Form -->

            </div>

        </div>
    </div>
</section>
@endsection