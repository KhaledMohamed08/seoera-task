@extends('layouts.admin.main')

@section('title', 'Create Post')

@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Post</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="#" method="POST">
                @csrf

                <div class="col-12">
                    <label for="post-title" class="form-label">Post Title*</label>
                    <input type="text" class="form-control" name="title" id="post-title" placeholder="Enter post title" value="{{ old('title') }}" required>
                </div>

                <div class="col-12">
                    <label for="post-content" class="form-label">Post Content*</label>
                    <textarea type="text" class="form-control" name="content" id="post-content" placeholder="Enter post content" value="{{ old('content') }}" rows="10" required></textarea>
                </div>                

                <div class="col-12 text-end">
                    <div>
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create Post</button>
                    </div>
                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
</section>
@endsection
