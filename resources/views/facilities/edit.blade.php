@extends('layouts.app')

@section('title', 'Edit ' . $facility->business_name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-edit me-2"></i>Edit {{ $facility->business_name }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('facilities.update', $facility) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="business_name" class="form-label">Business Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('business_name') is-invalid @enderror" 
                               id="business_name" name="business_name" value="{{ old('business_name', $facility->business_name) }}" required>
                        @error('business_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_update_date" class="form-label">Last Update Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('last_update_date') is-invalid @enderror" 
                               id="last_update_date" name="last_update_date" value="{{ old('last_update_date', $facility->last_update_date->format('Y-m-d')) }}" required>
                        @error('last_update_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="street_address" class="form-label">Street Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('street_address') is-invalid @enderror" 
                               id="street_address" name="street_address" value="{{ old('street_address', $facility->street_address) }}" required>
                        @error('street_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                               id="city" name="city" value="{{ old('city', $facility->city) }}" required>
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Materials Accepted <span class="text-danger">*</span></label>
                        @error('materials')
                            <div class="text-danger small mb-2">{{ $message }}</div>
                        @enderror
                        <div class="row">
                            @foreach($materials as $material)
                                <div class="col-md-6 col-lg-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" 
                                               id="material_{{ $material->id }}" name="materials[]" 
                                               value="{{ $material->id }}"
                                               {{ in_array($material->id, old('materials', $facility->materials->pluck('id')->toArray())) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="material_{{ $material->id }}">
                                            {{ $material->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('facilities.show', $facility) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Back to Facility
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Update Facility
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection