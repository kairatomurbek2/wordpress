<form data-toggle="validator" role="form" enctype="multipart/form-data" method="post"
      action="<?php echo SECOND_HAND_SHOP__PLUGIN_URL . 'sh_product_form.php'?>" >
    <div class="form-group">
        <label for="products">Наименование продукта:</label>
        <input type="text" class="form-control" id="products" name="product_name" placeholder="Наименование продукта" required />
    </div>

    <div class="form-group">
        <label for="katygory">Категория:</label>

        <select name="product_category" id="katygory" class="form-control" required >
            <option value=""></option>
            <?php
            foreach ($categories as $category) {
                $html .= '<option value="' . $category->term_id . '">' . $category->name . '</option>';
            }
            echo $html;
            ?>
        </select>
    </div>

<div class="form-group">
    <label for="">Короткое описание:</label>
    <textarea name="short_description" id="" cols="30" rows="3" placeholder="Короткое описание:" class="form-control" required ></textarea>
</div>

<div class="form-group">
    <label for="">Полное описание:</label>
    <textarea name="description" id="" cols="30" rows="9" placeholder="Полное описание:" class="form-control" required></textarea>
</div>

<div class="form-group">
    <label for="price">Цена:</label>
    <input type="number"  min="1" class="form-control" id="price" placeholder="Цена:" name="product_price" required />

</div>
<div class="form-group">
    <label for="contacts">Контактная информация:</label>
    <textarea name="contact_information" id="" cols="30" rows="9" placeholder="Контактная информация:" class="form-control" required></textarea>

</div>
<div class="form-group">
    <label for="tel">Телефон:</label>
    <input type="tel" class="form-control" id="tel" placeholder="Телефон:" name="phone" required/>

</div>
<div class="form-group">
    <label for="example-jpg-file">Select File To Upload:	</label>
    <input type="file" class="form-control"  id="example-jpg-file" name="picture" value="" required/>
</div>
<div>
    <img id="captcha" src="<?php echo SECOND_HAND_SHOP__PLUGIN_URL ?>/securimage/securimage_show.php" alt="CAPTCHA Image" />
    <input type="text" name="captcha_code" size="10" maxlength="6" required />

</div><br><br>
<button class="btn btn-primary" >Отправить заявку</button>
</form>
<!--//<a href="#" onclick="document.getElementById('."'".'captcha'."'".').src = '."'".-->
<!--'/securimage/securimage_show.php?'."".' + Math.random(); return false">[ Different Image ]</a>-->