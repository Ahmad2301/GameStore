@extends('layouts.admin')

@section('title', 'Merchants')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Merchants</h2>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Balance</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($merchants as $merchant)
                    <tr>
                        <td>{{ $merchant->id }}</td>
                        <td>{{ $merchant->name }}</td>
                        <td>{{ $merchant->email }}</td>
                        <td>{{ $merchant->phone }}</td>
                        <td>
                            @if($merchant->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @elseif($merchant->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($merchant->balance, 0, ',', '.') }}</td>
                        <td>
                            {{ $merchant->verified_at ? $merchant->verified_at->format('d/m/Y') : 'No' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.merchants.show', $merchant) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if(!$merchant->verified_at)
                                <form method="POST" action="{{ route('admin.merchants.verify', $merchant) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Verify?')">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                            @endif
                            @if($merchant->status == 'active')
                                <form method="POST" action="{{ route('admin.merchants.deactivate', $merchant) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Deactivate?')">
                                        <i class="bi bi-pause"></i>
                                    </button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('admin.merchants.activate', $merchant) }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Activate?')">
                                        <i class="bi bi-play"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">No merchants found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $merchants->links() }}
    </div>
</div>
@endsection

