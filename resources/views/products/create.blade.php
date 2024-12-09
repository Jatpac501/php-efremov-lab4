<h1>Добавить товар</h1>
<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label>Название</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Описание</label>
        <textarea name="description" required></textarea>
    </div>
    <div>
        <label>Основное изображение</label>
        <input type="file" name="main_image" required>
    </div>
    <div>
        <label>Галерея изображений</label>
        <input type="file" name="gallery_images[]" multiple>
    </div>
    <div>
        <label>Категория</label>
        <select name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Добавить</button>
</form>
