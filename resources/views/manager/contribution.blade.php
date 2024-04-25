@extends('layout.main')
@section('2')
<div class="wrapper row2" style="margin-top: 20px;">
    <div class="rounded">
        <nav id="mainav" class="clear">
            <ul class="clear">
                <li><a class="active" href="{{ route('manager.home') }}">Home</a></li>
            </ul>
        </nav>
    </div>
</div>
<a href="{{ route('download.contributions') }}" class="btn btn-primary">Download All Contribution</a>
<div class="card bg-primary text-white">
    <div class="card-header">List Contribution</div>
    <div class="card-body">
        <div class="table-responsive">
            @foreach ($contributions as $contribution)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Image</th>
                        <th>Preview</th>
                    </tr>
                </thead>
                <tbody>
                    <ul>

                        <tr>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->status }}</td>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->title }}</td>
                            <td style="color: black;width: auto; height:fit-content">{{ $contribution->content }}</td>
                            <td style="color: black; width:auto; height:auto">
                                @if ($contribution->image_path)
                                <img src="{{ asset('storage/' . $contribution->image_path) }}" alt="Contribution Image" style="max-width: 100%" class="zoomable-image">
                                @endif
                            </td>
                            <td style="color: black; width: 500px; height: 100px;">
                                @if (isset($htmlContents[$contribution->id]))
                                <div style="width: 1200px; height:300px; overflow: auto;">
                                    {!! $htmlContents[$contribution->id] !!}
                                </div>
                                @endif
                            </td>
                        </tr>

                </tbody>
            </table>
            @endforeach
        </div>
    </div>
</div>
@endsection

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