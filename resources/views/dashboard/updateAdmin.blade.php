<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                <div
                    class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 mt-2 ">
                    <div>
                        <a href={{ url('/en/admin/dashboard/admins') }}
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <img src={{ asset('assets/app_logo.png') }} class="img-fluid" style="width: 5rem">
                        </a>
                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <li class="nav-item">
                                <a href={{ url('/en/admin/dashboard') }}
                                    class="nav-link align-middle px-0 text-white text-decoration-none">
                                    <i class="fs-4 bi-person-workspace"></i> <span
                                        class="ms-1 d-none d-sm-inline">Teachers (en)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href={{ url('/en/admin/dashboard/ar') }}
                                    class="nav-link align-middle px-0 text-white text-decoration-none">
                                    <i class="fs-4 bi-person-workspace"></i> <span
                                        class="ms-1 d-none d-sm-inline">Teachers (ar)</span>
                                </a>
                            </li>
                            <li>
                                <a href={{ url('/en/admin/dashboard/contact') }}
                                    class="nav-link px-0 align-middle text-white text-decoration-none">
                                    <i class="fs-4 bi-chat-square-text-fill"></i> <span
                                        class="ms-1 d-none d-sm-inline">Contact Number</span></a>
                            </li>
                            <li>
                                <a href={{ url('/en/admin/dashboard/trash') }}
                                    class="nav-link px-0 align-middle text-white text-decoration-none">
                                    <i class="fs-4 bi-trash3-fill"></i> <span
                                        class="ms-1 d-none d-sm-inline">Trash</span></a>
                            </li>
                            @if (Auth::user()->permission == "superadmin")
                                <li>
                                    <a href={{ url('/en/admin/dashboard/admins') }}
                                        class="nav-link px-0 align-middle text-white text-decoration-none">
                                        <i class="fs-4 bi-person-fill-gear"></i> <span
                                            class="ms-1 d-none d-sm-inline">Admins</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="mt-3">
                        <a href={{url('/en/admin/logout')}} class="btn btn-danger rounded">
                            <i class="fs-6 bi-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col py-3">
                <div class="container-fluid">
                    <div class="row justify-content-between">
                        <div class="col-12">
                            <h2>Edit Admin</h2>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="alert alert-danger my-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action={{ url('/en/admin/dashboard/admins/admin/'.$admin['id']) }} method="POST">
                                @csrf
                                @method("PUT")
                                <div class="mb-3">
                                    <label for="adminName" class="form-label">Admin Name</label>
                                    <input type="text" class="form-control" id="adminName" name="adminName"
                                        value="{{ $admin['name'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="adminEmail" class="form-label">Admin Email</label>
                                    <input type="email" class="form-control" id="adminEmail" name="adminEmail"
                                        value="{{ $admin['email'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="adminPassword" class="form-label">Admin Password</label>
                                    <input type="password" class="form-control" id="adminPassword" name="adminPassword">
                                </div>
                                <div class="mb-3">
                                    <label for="adminPermission" class="form-label">Admin Permission</label>
                                    <select class="form-select" id="adminPermission" name="adminPermission">
                                        <option value="" selected disabled>Select Permission</option>
                                        <option value="admin" {{ $admin['permission'] == 'admin' ? 'selected' : '' }}>
                                            Admin</option>
                                        <option value="superadmin" {{ $admin['permission'] == 'superadmin' ? 'selected' : '' }}>
                                            Superadmin</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Add" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
