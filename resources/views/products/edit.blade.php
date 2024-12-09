<style>
    form {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 300px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #f44336;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }
</style>


<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Добавить товар</h1>
    <div>
        <label>Название</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Описание</label>
        <textarea name="description" required></textarea>
    </div>
    <div>
        <label>Цена</label>
        <input type="number" name="price" required>
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
