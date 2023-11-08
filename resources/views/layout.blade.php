<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
     <!-- Link jQuery library -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Link jQuery DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
    <title>Sidebar With Bootstrap</title>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="{{route('add_orders')}}">Lytton Pharmacy</a>
                </div>
                <!-- Sidebar Navigation -->
                <ul class="sidebar-nav">
                    <li class="sidebar-header"></li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed @yield('active_add_orders') @yield('active_manage_orders')" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="false" aria-controls="orders">
                            <i class="fa-solid fa-cart-shopping pe-2"></i>
                            Orders
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('manage_orders')}}" class="sidebar-link  @yield('active_manage_orders')">manage orders</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add_orders')}}" class="sidebar-link @yield('active_add_orders')">add orders</a>
                            </li>

                        </ul>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed @yield('active_add_product') @yield('active_manage_products')" data-bs-toggle="collapse" data-bs-target="#products" aria-expanded="false" aria-controls="products">
                            <i class="fa-solid fa-capsules pe-2"></i>
                            Products
                        </a>
                        <ul id="products" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('manage_products')}}" class="sidebar-link @yield('active_manage_products')">manage products</a>
                            </li>
                            <li class="sidebar-item">
                                <a href="{{route('add_product')}}" class="sidebar-link @yield('active_add_product')">add products</a>
                            </li>
                        </ul>
                    </li>
    
                    <li class="sidebar-item">
                        <a href="{{route('prescriptions')}}" class="sidebar-link @yield('active_prescriptions')">
                            <i class="fa-regular fa-file-lines pe-2"></i>
                            prescriptions
                        </a>
                    </li>

                  
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#admin" aria-expanded="false" aria-controls="admin">
                            <i class="fa-regular fa-user pe-2"></i>
                            Admin
                        </a>
                        <ul id="admin" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="{{route('logout')}}" class="sidebar-link">Logout</a>
                            </li>

                        </ul>
                    </li>
                    <!-- <li class="sidebar-header">
                        Multi Level Nav
                    </li> -->
                    <!-- <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#multi"
                            aria-expanded="false" aria-controls="multi">
                            <i class="fa-solid fa-share-nodes pe-2"></i>
                            Multi Level
                        </a>
                        <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item">
                                <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#multi-two" aria-expanded="false" aria-controls="multi-two">
                                    Two Links
                                </a>
                                <ul id="multi-two" class="sidebar-dropdown list-unstyled collapse">
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 1</a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="#" class="sidebar-link">Link 2</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </div>
        </aside>
        <!-- Main Component -->
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <!-- Button for sidebar toggle -->
                <button class="btn" type="button" data-bs-theme="light">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h6 class="m-auto">@yield('sidebar_name')</h6>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    @yield('body')
                </div>
            </main>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/jquery.js')}}"></script>
</body>

</html>