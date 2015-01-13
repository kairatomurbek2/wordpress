<table>
    <tr>
        <td style="width: 100%">Short Description</td>
        <td><textarea size="80"
                      name="second_hand_product_short_description"><?php echo $short_description; ?></textarea></td>
    </tr>
    <tr>
        <td style="width: 150px">Prodict Price</td>
        <td>
            <input type="text" size="30" name="second_hand_product_price" value="<?php echo $price; ?>"/>

        </td>
    </tr>
    <tr>
        <td style="width: 150px">Contact information</td>
        <td><textarea size="80"
                      name="second_hand_product_contact_information"><?php echo $contact_information; ?></textarea>
        </td>
    </tr>
    <tr>
        <td style="width: 100%">Seller phone</td>
        <td><input type="text" size="30" name="second_hand_product_seller_phone"
                   value="<?php echo $seller_phone; ?>"/></td>
    </tr>

</table>