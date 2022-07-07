<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="row">
                        <h1 class="my-2 fs-4 fw-bold text-center">IMPOEXPO URL Shortener</h1>
                        <form action="{{ route('url.shorten') }}" method="POST" class="my-2">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="url" class="form-control" placeholder="URL Shortener">
                                <button class="btn btn-success" type="submit">Shorten</button>
                            </div>
                        </form>
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">URL Key</th>
                                    <th scope="col">Original URL</th>
                                    <th scope="col">Short URL</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($urls as $key => $item)
                                <tr>
                                    <th scope="row">{{ ++$key }}</th>
                                    <td>{{ $item->url_key }}</td>
                                    <td>{{ $item->destination_url }}</td>
                                    <td>{{ $item->default_short_url }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal2-{{ $key }}">
                                            View
                                        </button>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $key }}">
                                        Edit
                                        </button>
                                        <a href="{{ route('url.delete',$item->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this URL')" >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal-{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="key" class="form-label">URL Key</label>
                                                        <input type="text" name="url" value="{{ $item->url_key }}" class="form-control" id="key">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="destination" class="form-label">Destination URL</label>
                                                        <input type="text" name="destination" value="{{ $item->destination_url }}" class="form-control" id="destination">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="exampleModal2-{{ $key }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">View</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('update', $item->id) }}" method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="key" class="form-label">URL Key</label>
                                                        <input type="text" name="url" value="{{ $item->url_key }}" class="form-control" id="key" readonly>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="destination" class="form-label">Destination URL</label>
                                                        <input type="text" name="destination" value="{{ $item->destination_url }}" class="form-control" id="destination" readonly>
                                                    </div>
                                                    {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
