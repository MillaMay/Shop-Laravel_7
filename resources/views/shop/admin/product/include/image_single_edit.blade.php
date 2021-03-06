<div class="box box-danger box-solid">
    <div class="box-header">
        <h3 class="box-title">Базовое изображение</h3>
    </div>
    <div class="box-body" id="image" style="border: 1px solid whitesmoke; text-align: center; position: relative">
        @if($product->img == null)
            <img src="{{ asset("/images/no_image.png") }}" width="50%" id="preview_image">
        @else
            <img src="{{ asset("/uploads/single/$product->img") }}" width="50%" id="preview_image">
        @endif
        <i id="loading" class="fa fa-spinner fa-spin fa-3x fa-fw" style="position: absolute;
        left: 40%; top: 40%; display: none;"></i>
    </div>
    <p style="text-align: center">
        <a href="javascript:changeProfile()" style="text-decoration: none;" data-name="single">
            <i class="glyphicon glyphicon-edit">Загрузить </i>
        </a>
        @if($product->img == null)
            <a href="javascript:removeFile()" style="color: red; text-decoration: none;">
                <i class="glyphicon glyphicon-trash">Удалить</i>
            </a>
        @else
            <a href="javascript:removeFileImg()" style="color: red; text-decoration: none;" class="myimg"
            data-name="{{ $product->img }}">
                <i class="glyphicon glyphicon-trash">Удалить</i>
            </a>
        @endif
    </p>
    <input type="file" id="file" style="display: none;">
    <input type="hidden" id="file_name">
    <p style="text-align: center">
        <small>Рекомендуемы размеры: 125ширина и 200высота<br>
            Иначе изображение автоматически сожмется</small>
    </p>
</div>