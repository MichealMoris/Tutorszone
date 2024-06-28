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
                        <a href="/"
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
                            <h2>Edit Teacher (en)</h2>
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
                            <form action={{ url('/en/admin/dashboard/updateteacher/'.$teacher['id'].'/'.$teacher['lang']) }} method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="mb-3">
                                    <label for="teacherImage" class="form-label">Teacher Image</label>
                                    <div class="mb-3">
                                        <img id="preview" class="preview-img" alt="Teacher Image Preview" src={{asset('storage/' . $teacher['teacher_image'])}}
                                            style={{'padding:5px;width:10rem;height:10rem;object-fit:cover;border-radius:50%;border:2px;border-style:solid;border-color:'.$teacher['teacher_color']}}>
                                    </div>
                                    <input class="form-control" type="file" id="teacherImage" name="teacherImage"
                                        onchange="previewImage()">
                                </div>
                                <div class="mb-3">
                                    <label for="teacherName" class="form-label">Teacher Name</label>
                                    <input type="text" class="form-control" id="teacherName" name="teacherName"
                                        value="{{ $teacher['teacher_name'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="teacherSubject" class="form-label">Teacher Subject</label>
                                    <input type="text" class="form-control" id="teacherSubject" name="teacherSubject"
                                        value="{{ $teacher['teacher_subject'] }}">
                                </div>
                                <div class="mb-3">
                                    <label for="teacherCountry" class="form-label">Teacher Country</label>
                                    <select class="form-select" id="teacherCountry" name="teacherCountry">
                                        <option value="">Select Country</option>
                                        <option value="uae" {{ $teacher['teacher_country'] == 'uae' ? 'selected' : '' }}>
                                            United Arab
                                            Emirates</option>
                                        <option value="sa" {{ $teacher['teacher_country'] == 'sa' ? 'selected' : '' }}>
                                            Saudi Arabia</option>
                                        <option value="both" {{ $teacher['teacher_country'] == 'both' ? 'selected' : '' }}>
                                            Both</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="teacherDescription" class="form-label">Teacher Description</label>
                                    <textarea class="form-control" id="teacherDescription" name="teacherDescription" rows="3">{{ $teacher['teacher_description'] }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="teacherColor" class="form-label">Teacher Color</label>
                                    <select class="form-select" id="teacherColor" onchange="previewColor()"
                                        name="teacherColor" style={{'color:'.$teacher['teacher_color']}}>
                                        <option selected disabled>Select Color</option>
                                        <option value="#fd5658" style="background-color: #fd5658; color: white;"
                                            {{ $teacher['teacher_color'] == '#fd5658' ? 'selected' : '' }}>Red</option>
                                        <option value="#fd8a56" style="background-color: #fd8a56; color: white;"
                                            {{ $teacher['teacher_color'] == '#fd8a56' ? 'selected' : '' }}>Orange</option>
                                        <option value="#2077e7" style="background-color: #2077e7; color: white;"
                                            {{ $teacher['teacher_color'] == '#2077e7' ? 'selected' : '' }}>Blue</option>
                                        <option value="#ffc050" style="background-color: #ffc050; color: black;"
                                            {{ $teacher['teacher_color'] == '#ffc050' ? 'selected' : '' }}>Yellow</option>
                                    </select>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Edit" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function previewImage() {
            // Get the selected image file
            const imageFile = document.getElementById('teacherImage').files[0];

            // Check if a file is selected
            if (imageFile) {
                // Create a new FileReader object
                const reader = new FileReader();

                // Define function to handle successful image loading
                reader.onload = function(e) {
                    // Set the preview image source to the loaded image data
                    document.getElementById('preview').src = e.target.result;
                    // Show the preview image
                    document.getElementById('preview').classList.remove('d-none');
                }

                // Read the selected image as a DataURL
                reader.readAsDataURL(imageFile);
            } else {
                // Hide the preview image if no file is selected
                document.getElementById('preview').src = "";
                document.getElementById('preview').classList.add('d-none');
            }
        }

        function previewColor() {
            const selectedColor = document.getElementById('teacherColor').value;
            const previewElement = document.getElementById('colorPreview');
            document.getElementById('teacherColor').style.color = selectedColor;
            document.getElementById('preview').style.borderColor = selectedColor;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
