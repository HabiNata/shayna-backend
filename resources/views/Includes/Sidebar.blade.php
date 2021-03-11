<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('Dash') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="menu-title">BARANG</li><!-- /.menu-title -->
                <li class="">
                    <a href="{{ route('products.index') }}"> <i class="menu-icon fa fa-truck"></i>List Barang</a>
                </li>
                <li class="">
                    <a href="{{ route('products.create') }}"> <i class="menu-icon fa fa-plus-square-o"></i>Tambah
                        Barang</a>
                </li>

                <li class="menu-title">Foto Barang</li><!-- /.menu-title -->

                <li class="">
                    <a href="{{ route('productsgallery.index') }}"> <i class="menu-icon fa fa-picture-o"></i>List Foto Barang</a>
                </li>
                <li class="">
                    <a href="{{ route('productsgallery.create') }}"> <i class="menu-icon fa fa-plus-square-o"></i>Tambah Foto Barang</a>
                </li>

                <li class="menu-title">Extras</li><!-- /.menu-title -->

                <li class="">
                    <a href="{{ route('transactions.index') }}"> <i class="menu-icon fa fa-money"></i>Transaksi</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
