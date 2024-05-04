@extends('layout.main')
@section('2')
    <div class="card bg-primary text-white">
        <div class="card bg-primary text-white">
            <div class="card-header" style="text-align:center;">List Contribution </div>
            <div class="card-body" style="margin-left:auto;margin-right:auto">
                <div class="table-responsive" style="text-align:center">
                    @foreach ($contributions as $contribution)
                        <table style="width: 40%;margin-left:auto;margin-right:auto">
                            <br>
                            <tr>
                                <th>Status</th>
                                <td style="color: black">{{ $contribution->status }}</td>
                            </tr>
                            <tr>
                                <th>Title</th>
                                <td style="color: black">{{ $contribution->title }}</td>
                            </tr>
                            <tr>
                                <th>Content</th>
                                <td style="color: black">{{ $contribution->content }}</td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <td style="color: black; width: 200px; height: 100px;">
                                    @if ($contribution->image_path)
                                        <img src="{{ asset('storage/' . $contribution->image_path) }}"
                                            alt="Contribution Image" style="max-width: 100px;" class="zoomable-image">
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Preview</th>
                                <td style="color: black; width: 500px; height: 100px;">
                                    @if (isset($htmlContents[$contribution->id]))
                                        <div style="width: 900px; height: 300px; overflow: auto;">{!! $htmlContents[$contribution->id] !!}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var zoomableImages = document.querySelectorAll('.zoomable-image');
            zoomableImages.forEach(function(image) {
                image.addEventListener('click', function() {
                    // Tạo một phần tử div để chứa hình ảnh phóng to
                    var overlay = document.createElement('div');
                    overlay.style.position = 'fixed';
                    overlay.style.top = '0';
                    overlay.style.left = '0';
                    overlay.style.width = '100%';
                    overlay.style.height = '100%';
                    overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
                    overlay.style.zIndex = '9999';
                    overlay.style.display = 'flex';
                    overlay.style.justifyContent = 'center';
                    overlay.style.alignItems = 'center';

                    var enlargedImage = document.createElement('img');
                    enlargedImage.src = image.src;
                    enlargedImage.style.maxHeight = '90%';
                    enlargedImage.style.maxWidth = '90%';

                    overlay.appendChild(enlargedImage);

                    document.body.appendChild(overlay);

                    overlay.addEventListener('click', function() {
                        document.body.removeChild(overlay);
                    });
                });
            });
        });
    </script>
@endsection
