@extends('layouts.app')

@section('title', 'Recycling Facilities')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1><i class="fas fa-building me-2"></i>Recycling Facilities</h1>
            <a href="{{ route('facilities.create') }}" class="btn btn-success">
                <i class="fas fa-plus me-2"></i>Add New Facility
            </a>
        </div>

        <!-- Search and Filter Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('facilities.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label for="search" class="form-label">Search</label>
                        <input type="text" class="form-control" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Search by name, city, or material">
                    </div>
                    <div class="col-md-4">
                        <label for="material_filter" class="form-label">Filter by Material</label>
                        <select class="form-select" id="material_filter" name="material_filter">
                            <option value="">All Materials</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" 
                                        {{ request('material_filter') == $material->id ? 'selected' : '' }}>
                                    {{ $material->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i>Search
                        </button>
                        <a href="{{ route('facilities.index') }}" class="btn btn-secondary me-2">
                            <i class="fas fa-times me-1"></i>Clear
                        </a>
                        <button type="submit" name="export" value="csv" class="btn btn-success">
                            <i class="fas fa-download me-1"></i>Export CSV
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Facilities Table -->
        <div class="card">
            <div class="card-body">
                @if($facilities->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Business Name</th>
                                    <th>Last Updated</th>
                                    <th>Address</th>
                                    <th>Materials Accepted</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilities as $facility)
                                    <tr>
                                        <td>
                                            <strong>{{ $facility->business_name }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">
                                                {{ $facility->last_update_date->format('M d, Y') }}
                                            </span>
                                        </td>
                                        <td>
                                            {{ $facility->street_address }}<br>
                                            <small class="text-muted">{{ $facility->city }}</small>
                                        </td>
                                        <td>
                                            @foreach($facility->materials as $material)
                                                <span class="badge bg-secondary me-1">{{ $material->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('facilities.show', $facility) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('facilities.edit', $facility) }}" 
                                                   class="btn btn-sm btn-outline-warning">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('facilities.destroy', $facility) }}" 
                                                      class="d-inline" onsubmit="return confirm('Are you sure you want to delete this facility?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $facilities->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h4>No facilities found</h4>
                        <p class="text-muted">Try adjusting your search criteria or add a new facility.</p>
                        <a href="{{ route('facilities.create') }}" class="btn btn-success">
                            <i class="fas fa-plus me-2"></i>Add First Facility
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection