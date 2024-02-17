@extends('admin.template')

@section('title')
    Berita
@endsection

@section('content')
    <div class="row mt--2">
        <div class="col-md-12">
            <div class="card" style="padding-bottom: 15px;">
                <div class="card-header">
                    <h3 class="card-title">Ubah Berita</h3>
                </div>
                <form method="POST" action="{{ url('app-admin/data/berita/proses-ubah') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="new_id" value="{{ $new->id }}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name"> Nama </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                id="name" placeholder="Masukan Nama . . . " value="{{ old('name') ?? $new->name }}"
                                required autocomplete="off"></input>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name_en"> Nama (Dalam Bahasa Inggris) </label>
                            <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en"
                                id="name_en" placeholder="Masukan Nama (Dalam Bahasa Inggris) . . . "
                                value="{{ old('name_en') ?? $new->name_en }}" required autocomplete="off"></input>
                            @error('name_en')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                value="{{ old('slug') ?? $new->slug }}"type="text" required
                                placeholder="Masukkan Slug . . .">
                            @error('slug')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select class="form-control" id="category_id" required name="category_id">
                                <option value="">--- Pilih Kategori ---</option>
                                @foreach ($categories as $category)
                                    <?php
                                    if ($new->category_id == $category->id) {
                                        $selected = 'selected';
                                    } else {
                                        $selected = '';
                                    }
                                    ?>
                                    <option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="content">Konten</label>
                            <textarea id="content" name="content" placeholder="Masukkan Kontent . . ." rows="10" required>{{ old('content') ?? $new->content }}</textarea>
                            <div class="my-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="content_en">Konten (Dalam Bahasa Inggris)</label>
                            <textarea id="content_en" name="content_en" placeholder="Masukkan Kontent . . ." rows="10" required>{{ old('content_en') ?? $new->content_en }}</textarea>
                            <div class="my-3"></div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Gambar</label>
                            <br>
                            <img id="addImage" src='{{ url("/assets/berita/$new->cover_picture") }}'
                                class="img-preview mb-3 img-fluid" style="max-height: 300px; width: auto;">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                                id="image" onchange="previewImage()">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?= url('app-admin/data/berita') ?>">
                            <button type="button" class="btn btn-danger float-left">Kembali</button>
                        </a>
                        <button type="submit" class="btn btn-success float-right">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ url('ckeditor/ckeditor.js') }}"></script>
    <script>
        const slug = document.querySelector('#slug');
        const name = document.querySelector('#name');
        name.addEventListener('change', function() {
            fetch('/app-admin/buatSlug?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        })

        function previewImage() {
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('#addImage');

            imgPreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
        CKEDITOR.replace('content', {
            enterMode: CKEDITOR.ENTER_BR,
        });
        CKEDITOR.replace('content_en', {
            enterMode: CKEDITOR.ENTER_BR,
        });
    </script>
@endsection
