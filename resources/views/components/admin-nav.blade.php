@php
    $is = fn($path) => request()->is($path) ? 'active' : '';
@endphp

<div class="admin-topbar">
    <div class="admin-nav">
        <a href="/admin" class="{{ $is('admin') }}">🏠 Dashboard</a>
        <a href="/admin/analytics" class="{{ $is('admin/analytics*') }}">📊 Analytics</a>
        <a href="/admin/orders" class="{{ $is('admin/orders*') }}">🛒 Orders</a>
        <a href="/admin/products" class="{{ $is('admin/products*') }}">📦 Products</a>
        <a href="/admin/contents" class="{{ $is('admin/contents*') }}">📄 Content</a>
        <a href="/admin/reviews" class="{{ $is('admin/reviews*') }}">⭐ Reviews</a>
        <a href="/admin/posts" class="{{ $is('admin/posts*') }}">📝 Posts</a>
    </div>
</div>