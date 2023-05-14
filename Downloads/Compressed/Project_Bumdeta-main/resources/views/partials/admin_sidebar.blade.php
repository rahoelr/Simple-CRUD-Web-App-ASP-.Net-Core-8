<!-- Sidebar -->
<div class="border-right" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
        <img src="{{asset('img/dashboard-store-logo.svg')}}" alt="" class="my-4" />
    </div>
    <div class="list-group list-group-flush">
        <a href="/db_admin"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Dashboard") ? 'active' : ''}}">Dashboard</a>
        <a href="/db_admin-landing/1"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Landing Page") ? 'active' : ''}}">Landing
            Page</a>
        <a href="/admin-desas"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Desa") ? 'active' : ''}}">Desa</a>
        <a href="/db_admin-product"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Product") ? 'active' : ''}}">Produk</a>
        <a href="/db_admin-category"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Category") ? 'active' : ''}}">Category</a>
        <a href="/db_admin-mitra"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Mitra") ? 'active' : ''}}">Mitra</a>
        <a href="/db_admin-jenis_usaha"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Jenis Usaha") ? 'active' : ''}}">Jenis
            Usaha</a>
        <a href="/db_admin-article"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Article") ? 'active' : ''}}">Artikel</a>
        <a href="/db_admin-aboutus/1"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| About Us") ? 'active' : ''}}">Tentang
            Kami</a>
        <a href="/db_admin-team"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Team") ? 'active' : ''}}">Anggota</a>
        <a href="/db_admin-message"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| Message") ? 'active' : ''}}">Pesan</a>
        <a href="/db_admin-user"
            class="list-group-item list-group-item-action dashboard-admin {{($title === "| User") ? 'active' : ''}}">User</a>
        <a href="{{route("logout")}}" class="list-group-item list-group-item-action dashboard-admin">Sign Out</a>
    </div>
</div>
<!-- /#sidebar-wrapper -->
