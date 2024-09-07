@extends('layouts.dashboard')
@section('content')
<div class="content">
    <section class="content-header my-2">
        <h1 class="d-inline">{{ isset($configuration) ? 'Cấu hình' : 'Cập nhật' }} website</h1>
    </section>
    <section class="content-body my-2">
        <form action="{{ isset($configuration) ? route('admin.configuration.update', $configuration->id) : route('admin.configuration.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($configuration))
                @method('PUT')
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label><strong>Tên website</strong></label>
                        <input type="text" name="name_website" class="form-control" value="{{ old('name_website', $configuration->name_website ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Địa chỉ</strong></label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $configuration->address ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Đường dẫn bản đồ</strong></label>
                        <input type="text" name="link_map" class="form-control" value="{{ old('link_map', $configuration->link_map ?? '') }}" />
                    </div>
                    
                    <div class="mb-3">
                        <label><strong>Email</strong></label>
                        <input type="text" name="email" class="form-control" value="{{ old('email', $configuration->email ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Điện thoại(*)</strong></label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $configuration->phone ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Mô tả website</strong></label>
                        <textarea name="description" class="form-control">{{ old('description', $configuration->description ?? '') }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label><strong>Liên kết Facebook</strong></label>
                        <input type="text" name="facebook" class="form-control" value="{{ old('facebook', $configuration->facebook ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Liên kết Twitter</strong></label>
                        <input type="text" name="twitter" class="form-control" value="{{ old('twitter', $configuration->twitter ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Liên kết LinkedIn</strong></label>
                        <input type="text" name="linkedin" class="form-control" value="{{ old('linkedin', $configuration->linkedin ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Liên kết Instagram</strong></label>
                        <input type="text" name="instagram" class="form-control" value="{{ old('instagram', $configuration->instagram ?? '') }}" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Hình logo</strong></label>
                        @if(isset($configuration) && $configuration->logo)
                            <img src="{{ asset('images/configuration/' . $configuration->logo) }}" alt="Logo hiện tại" class="img-thumbnail mb-2"width="120px">
                        @endif
                        <input type="file" name="logo" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Hình favicon</strong></label>
                        @if(isset($configuration) && $configuration->favicon)
                            <img src="{{ asset('images/configuration/' . $configuration->favicon) }}" alt="Favicon hiện tại" class="img-thumbnail mb-2" width="120px">
                        @endif
                        <input type="file" name="favicon" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label><strong>Trạng thái</strong></label>
                        <select name="status" class="form-select">
                            <option value="1" {{ (isset($configuration) && $configuration->status == 1) ? 'selected' : '' }}>Xuất bản</option>
                            <option value="2" {{ (isset($configuration) && $configuration->status == 2) ? 'selected' : '' }}>Chưa xuất bản</option>
                        </select>
                    </div>
                    <div class="box-footer text-end px-2 py-3">
                        <button type="submit" class="btn btn-success btn-sm text-end">
                            <i class="fa fa-save" aria-hidden="true"></i> {{ isset($configuration) ? 'Cập nhật' : 'Đăng' }}
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
