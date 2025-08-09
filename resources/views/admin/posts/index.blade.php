@extends('layouts.admin.main')
@section('title', 'Posts')
@section('content')
    <section class="section">
        <div class="text-end">
            <a class="btn btn-primary btn-lg fw-bold" href="{{ route('posts.create') }}">Create New Post</a>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">{{ 'All ' . trim($__env->yieldContent('title')) }}</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Contact Info</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td class="text-secondary" scope="row">{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td title="{{ $post->description }}">{{ strlen($post->description) <= 50 ? $post->description : substr($post->description, 0, 50) . '...' }}</td>
                                <td><a href="tel:{{ $post->contact_phone_number }}">{{ $post->contact_phone_number }}</a></td>
                                <td>{{ $post->created_at->format('F j, Y, g:i a') }}</td>
                                <td class="d-flex gap-1">
                                    {{-- <button title="show" class="btn btn-primary btn-sm"><i class="bi bi-eye-fill"></i></button> --}}
                                    <a title="edit" class="btn btn-success btn-sm"
                                        href="{{ route('posts.update', $post->id) }}"><i
                                            class="bi bi-pencil-square"></i></a>
                                    <form id="delete_form" action="{{ route('posts.delete', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button title="delete" type="submit" class="btn btn-danger btn-sm"><i
                                                class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- SINGLE Modal (outside loop) -->
                <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="postModalLabel">Post Title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Description:</strong></p>
                                <p id="postDescription"></p>
                                <hr>
                                <p><strong>Author:</strong> <span id="postUser"></span></p>
                                <p><strong>Created at:</strong> <span id="postCreated"></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Table with stripped rows -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $posts->links('pagination::custom') }}
                </div>

            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const form = document.querySelector('#delete_form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
@endpush
