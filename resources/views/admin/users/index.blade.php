@extends('layouts.admin.main')
@section('title', 'Users')
@section('content')
    <section class="section">
        <div class="text-end">
            <a class="btn btn-primary btn-lg fw-bold" href="{{ route('users.create') }}">Create New User</a>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="card-title">{{ 'All ' . trim($__env->yieldContent('title')) }}</h5>

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-secondary" scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $user->name }}</td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                <td><a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                <td>{{ $user->created_at->format('F j, Y, g:i a') }}</td>
                                <td>
                                    <a title="edit" class="btn btn-success btn-sm" href="{{ route('users.update', $user->id) }}"><i class="bi bi-pencil-square"></i></a>
                                    <form id="delete_form" action="{{ route('users.delete', $user->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button title="delete" type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
                <div class="d-flex justify-content-end mt-4">
                    {{ $users->links('pagination::custom') }}
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
