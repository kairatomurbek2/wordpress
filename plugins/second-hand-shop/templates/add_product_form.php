<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Заявка</h4>
            </div>
            <div class="modal-body">
                <form data-toggle="validator" role="form" enctype="multipart/form-data" method="post"
                      action="<?php echo SECOND_HAND_SHOP__PLUGIN_URL . 'sh_product_form.php'?>" >
                    <div class="form-group">
                        <label for="products">Наименование продукта:</label>
                        <input type="text" class="form-control" id="products" name="product_name" placeholder="Наименование продукта" required />
                    </div>

                    <div class="form-group">
                        <label for="katygory">Категория:</label>

                        <select name="product_category" id="katygory" class="form-control" required >
                            <option value="">Выберите категорию:</option>
                            <?php
                            //if($category != 0)
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
                        <div class="form-group">
                        <img id="captcha" src="<?php echo SECOND_HAND_SHOP__PLUGIN_URL ?>/securimage/securimage_show.php" alt="CAPTCHA Image" />
                        <input type="text" name="captcha_code" size="10" maxlength="6" required />
                            <a href="#" onclick="document.getElementById('captcha').src = '<?php echo SECOND_HAND_SHOP__PLUGIN_URL ?>/securimage/securimage_show.php?sid=' + Math.random(); return false">
                                <img src="<?php echo SECOND_HAND_SHOP__PLUGIN_URL ?>/securimage/images/refresh.png" alt="Reload Image" onclick="this.blur()" align="bottom" border="0" height="32" width="32">
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                        <button  class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>