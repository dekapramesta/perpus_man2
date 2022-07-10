<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"> <span class="logo-name ">Super Admin</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown ">
                <a href="<?= base_url('SuperAdmin/Home') ?>" class="nav-link "><i data-feather="home"></i><span>Home</span></a>
                <!-- <a href="<?= base_url('SuperAdmin/Event') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>

            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="monitor"></i><span>Registrasi User</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('SuperAdmin/Registrasi') ?>">Siswa</a></li>
                    <li><a class="nav-link" href="<?= base_url('SuperAdmin/Registrasi/RegisterGuru') ?>">Guru</a></li>
                </ul>
            </li>



            <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="file"></i><span>Data User</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="<?= base_url('SuperAdmin/DataUser') ?>">Siswa</a></li>
                    <li><a class="nav-link" href="<?= base_url('SuperAdmin/DataUser/DataGuru') ?>">Guru</a></li>
                    <li><a class="nav-link" href="<?= base_url('SuperAdmin/DataUser/Admin') ?>">Admin</a></li>

                </ul>
            </li>
            <li class="dropdown ">
                <a href="<?= base_url('SuperAdmin/Event') ?>" class="nav-link "><i data-feather="codepen"></i><span>Event</span></a>
                <!-- <a href="<?= base_url('SuperAdmin/Event') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>

            <li class="dropdown ">
                <a href="<?= base_url('SuperAdmin/ProfilePerpus') ?>" class="nav-link "><i data-feather="info"></i><span>Profile Perpus</span></a>
                <!-- <a href="<?= base_url('Admin/Registrasi') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>
            <li class="dropdown ">
                <a href="#" onclick="LogoutSA()" class="nav-link "><i data-feather="log-out" style="color: red;"></i><span style="color: red;">Log Out</span></a>
                <!-- <a href="<?= base_url('Admin/Registrasi') ?>" class="nav-link "><i data-feather="monitor"></i><span>Registrasi Siswa</span></a> -->
            </li>

        </ul>
    </aside>
</div>
<script>
    function LogoutSA() {
        swal({
                title: 'Log Out',
                text: 'Yakin Ingin Keluar?',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = "<?= base_url('Home/Logout') ?>";
                }
            });
    }
</script>