<?php

/**
 * Created by PhpStorm.
 * User: mani mohamadi
 * Date: 11/09/2018
 * Time: 12:24 AM
 */
class model_admin_ecomm_products extends model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_product_category($parent = "")
    {
        $parent = $this->filter($parent);
        if (!empty($parent) and $parent == "parent") {
            $result = $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE' and `parent`=0 ");
        } else if ($parent != "parent") {
            $result = $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE' ");
        }
        return $result;
    }

    function get_product_category_child()
    {
        $result = $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE' and `parent`!=0 ");
        return $result;
    }

    function get_category_child_ajax($cat_group = "")
    {
        $result = $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE' and cat_group=? and parent>0", [$cat_group]);
        echo json_encode($result);
    }

    function get_category_child()
    {
        return $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE'  and parent>0 ", []);
    }

    function select_child($parents1 = "", $children = "", $children_counter = "")
    {
        $parents = [];
        if ($children_counter > 0) {
            for ($i = 0; $i < $children_counter; $i++) {
                $parents = $parents1["child"];
            }
        }
        $children_counter++;
        $all_cat = [];
        foreach ($parents as $key => $parent) {
            $a = 0;
            foreach ($children as $key2 => $child) {
                if ($child["parent"] == $parent["id"]) {
                    $parent["child"][$a++] = $child;
                    unset($children[$key2]);
                    continue;
                }
            }
            $all_cat[] = $parent;
        }
        if (empty($children)) {
//            return [$all_cat, $children];
        } else {
//            $this->select_child($all_cat, $children, $children_counter);
        }
    }

    function add_new_product($data = '', $file = "")
    {
        $product_name = $this->filter($data["title"]);
        $category = $this->filter($data["category"]);
        $introduction = $data["introduction"];
        $summary = $this->filter($data["summary"]);
        $price = $this->filter((int)$data["price"]);
        $seo = $this->filter($data["seo"]);
        $status = $this->filter($data["status"]);
        if ($status == "active") {
            $status = "ACTIVE";
        } elseif ($status == "inactive") {
            $status = "INACTIVE";
        }

        $_SESSION["product_info"] = $data;
        if (!is_numeric($price)) {
            $_SESSION["add_product"] = "price";
            header("location:" . SITE_URL . "admin_ecomm_products/add_product");
        } else {
            $param = [$product_name, $category, $introduction, $summary, $price, $seo, $status];
            if (!empty($product_name) and !empty($category) and !empty($introduction) and !empty($summary) and !empty($price) and !empty($status)) {
                $result = $this->Do_Query("insert into ecomm_products(`name`,`category`,`introduction`,`summary`,`price`,`seo`,`status`)VALUES (?,?,?,?,?,?,?)", $param);
                if ($result == true) {
                    unset($_SESSION["product_info"]);
                    $_SESSION["add_product"] = "success";
                    if (!empty($file['product_img'])) {
                        $file = $file['product_img'];
                        $product_id = $this->conn->lastInsertId();
                        $img_name = $this->filter($file["name"]);
                        $img_type = $this->filter($file["type"]);
                        $img_tmp_name = $file["tmp_name"];
                        $img_size = $this->filter($file["size"]);
                        $uploadok = 0;
                        $target = 'public/product/' . $product_id . '/';
                        $newname = time();
                        mkdir($target . "gallery/l", 0777, true);
                        mkdir($target . "gallery/s", 0777, true);
//                        mkdir($target . "main/l", 0777, true);
//                        mkdir($target . "main/s", 0777, true);

                        if ($img_type == 'image/jpg' or $img_type == 'image/jpeg' or $img_type == 'image/png') {
                            $uploadok = 1;
                        }

                        if ($img_size >= 8000000) {
                            $uploadok = 0;
                        }

                        if ($uploadok == 1) {
                            $exe = pathinfo($img_name, PATHINFO_EXTENSION);
                            $target_new = $target . $newname . '.' . $exe;
                            move_uploaded_file($img_tmp_name, $target_new);

//                            $targets = $target . "main/s/" . $newname . '.' . $exe;
//                            $this->creat_thumbnail($target_new, $targets, 100, 100);
//                            $targetl = $target . "main/l/" . $newname . '.' . $exe;
//                            $this->creat_thumbnail($target_new, $targetl, 400, 400);
                            $targets = $target . "gallery/s/" . $newname . '.' . $exe;
                            $this->creat_thumbnail($target_new, $targets, 100, 100);
                            $targetl = $target . "gallery/l/" . $newname . '.' . $exe;
                            $this->creat_thumbnail($target_new, $targetl, 700, 400);
                            $sql = "update `ecomm_products` set `image`=? WHERE `id`=?";
                            $stmt = $this->conn->prepare($sql);
                            $newname = $newname . '.' . $exe;
                            $stmt->bindValue(1, $newname);
                            $stmt->bindValue(2, $product_id);
                            $stmt->execute();
                            $this->Do_Query("insert  into  ecomm_product_gallery (`img_name`,`product_id`,`main`) VALUES (?,?,'ACTIVE')", [$newname, $product_id]);
                        }
                    }
                    header("location:" . SITE_URL . "admin_ecomm_products");
                } else {
                    $_SESSION["add_product"] = "danger";
                    header("location:" . SITE_URL . "admin_ecomm_products/add_product");
                }
            } else {
                $_SESSION["add_product"] = "empty";
                header("location:" . SITE_URL . "admin_ecomm_products/add_product");
            }
        }
    }

    function get_products($producy_id = "")
    {
        if (empty($producy_id)) {
//            $result = $this->Do_Select("select ecomm_products.*,ecomm_product_gallery.img_name from ecomm_products LEFT JOIN ecomm_product_gallery on ecomm_products.`id`=ecomm_product_gallery.`product_id` WHERE ecomm_product_gallery.main='ACTIVE'");
//            $result_main = $this->Do_Select("select * from ecomm_product_gallery where main='ACTIVE' and product_id=?", [$producy_id]);
            $result = $this->Do_Select("select * from ecomm_products ORDER by `id` DESC");
            $new_product = [];
            foreach ($result as $item) {
                $item["date"] = $this->convert_date($item["date"]);
                $new_product[] = $item;
            }
            return $new_product;
        } else if (!empty($producy_id)) {
            $result = $this->Do_Select("select  ecomm_product_category.cat_group as cat_gro , ecomm_products.* from ecomm_products LEFT JOIN ecomm_product_category on ecomm_products.category=ecomm_product_category.id  WHERE ecomm_products.`id`=?  ", [$producy_id], 1);
            return $result;
        }
    }

    function product_status_change($data = "")
    {
        $product_id = $this->filter($data["id"]);
        $status = $this->filter($data["status"]);
        if (!empty($product_id) and !empty($status)) {
            $result = $this->Do_Query("update   ecomm_products set `status`=? where `id`=? ", [$status, $product_id]);
            echo $result;
        }

    }

    function update_product($data = '', $product_id = "")
    {
        $product_name = $this->filter($data["title"]);
        $category = $this->filter($data["category"]);
        $introduction = $data["introduction"];
        $summary = $this->filter($data["summary"]);
        $price = $this->filter((int)$data["price"]);
        $seo = $this->filter($data["seo"]);
        $status = $this->filter($data["status"]);
        if ($status == "active") {
            $status = "ACTIVE";
        } elseif ($status == "inactive") {
            $status = "INACTIVE";
        }

        $_SESSION["product_info"] = $data;
        if (!is_numeric($price)) {
            $_SESSION["add_product"] = "price";
            header("location:" . SITE_URL . "admin_ecomm_products/edit_product/" . $product_id);
        } else {

            $param = [$product_name, $category, $introduction, $summary, $price, $seo, $status, $product_id];
            if (!empty($product_name) and !empty($category) and !empty($introduction) and !empty($summary) and !empty($price) and !empty($status)) {
                $result = $this->Do_Query("update   ecomm_products set `name`=?,`category`=?,`introduction`=?,`summary`=?,`price`=?,`seo`=?,`status`=? where `id`=?", $param);
                if ($result == true) {
                    unset($_SESSION["product_info"]);
                    $_SESSION["add_product"] = "success";
                    header("location:" . SITE_URL . "admin_ecomm_products");
                } else {
                    $_SESSION["add_product"] = "danger";
                    header("location:" . SITE_URL . "admin_ecomm_products/edit_product/" . $product_id);
                }
            } else {
                $_SESSION["add_product"] = "empty";
                header("location:" . SITE_URL . "admin_ecomm_products/edit_product/" . $product_id);
            }
        }
    }

    function get_product_gallery($product_id = "")
    {
        if (!empty($product_id)) {
            $product_img = $this->Do_Select("select * from ecomm_product_gallery where `product_id`=?", [$product_id]);
            return $product_img;
        } elseif (empty($product_id)) {
            $products_img = $this->Do_Select("select * from ecomm_product_gallery ");
            return $products_img;
        }
    }

    function save_change($name = '', $id = '', $status = '')
    {
        $name = $this->filter($name);
        $id = $this->filter($id);
        $status = $this->filter($status);

        if (!empty($name) and !empty($status) and !empty($id) and $name == "status" and $status == "YES") {
            $sql = "update ecomm_product_gallery set status='ACTIVE' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "main" and $status == "YES") {
            $sql = "select * from  ecomm_product_gallery   where `id`=? ";
            $img_info = $this->Do_Select($sql, [$id], 1);

            $sql = "update ecomm_product_gallery set main='INACTIVE' where  `product_id`=? ";
            $this->Do_Query($sql, [$img_info["product_id"]]);

            $sql = "update ecomm_product_gallery set main='ACTIVE' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));

            $sql = "update ecomm_products set image=? where `id`=? ";
            $this->Do_Query($sql, [$img_info["img_name"], $img_info["product_id"]]);
        }
        if (!empty($name) and !empty($status) and !empty($id) and $name == "status" and $status == "NO") {
            $sql = "update ecomm_product_gallery set status='INACTIVE' where `id`=? ";
            print_r($this->Do_Query($sql, [$id]));
        }
    }

    function set_alt($value = '', $id = '')
    {
        $value = $this->filter($value);
        $id = $this->filter($id);
        if (!empty($id)) {
            $sql = "update ecomm_product_gallery set `seo`=? where `id`=? ";
            print_r($this->Do_Query($sql, [$value, $id]));
        }
    }

    function upload_gallery($file = "", $product_id = "")
    {
        if (!empty($file['product_img'])) {
            $file = $file['product_img'];
            $img_name = $this->filter($file["name"]);
            $img_type = $this->filter($file["type"]);
            $img_tmp_name = $file["tmp_name"];
            $img_size = $this->filter($file["size"]);
            $uploadok = 0;
            $target = 'public/product/' . $product_id . '/';
            $newname = time();

            if ($img_type == 'image/jpg' or $img_type == 'image/jpeg' or $img_type == 'image/png') {
                $uploadok = 1;
            }
            if ($img_size >= 8000000) {
                $uploadok = 0;
            }
            if ($uploadok == 1) {
                $exe = pathinfo($img_name, PATHINFO_EXTENSION);
                $target_new = $target . $newname . '.' . $exe;
                move_uploaded_file($img_tmp_name, $target_new);
                $targets = $target . "gallery/s/" . $newname . '.' . $exe;
                $this->creat_thumbnail($target_new, $targets, 100, 100);
                $targetl = $target . "gallery/l/" . $newname . '.' . $exe;
//                $this->creat_thumbnail($target_new, $targetl, 1000, 1000);
                $this->creat_thumbnail($target_new, $targetl, 700, 400);
                $newname = $newname . '.' . $exe;
//                $sql = "update `ecomm_products` set `image`=? WHERE `id`=?";
//                $stmt = $this->conn->prepare($sql);
//                $stmt->bindValue(1, $newname);
//                $stmt->bindValue(2, $product_id);
//                $stmt->execute();
                $this->Do_Query("insert  into  ecomm_product_gallery (`img_name`,`product_id`) VALUES (?,?)", [$newname, $product_id]);
            }
        }
        header("location:" . SITE_URL . "admin_ecomm_products/product_gallery/" . $product_id);
    }

    function delete_img($id = "")
    {
        $id = $this->filter($id);
        if (!empty($id)) {
            $img_name = $this->Do_Select("select * from ecomm_product_gallery where `id`=?", [$id], 1);
            if ($img_name["main"] == "ACTIVE") {
                echo "main";
            } else {
                $l_img = "public/product/" . $img_name["product_id"] . "/gallery/l/" . $img_name["img_name"];
                $s_img = "public/product/" . $img_name["product_id"] . "/gallery/s/" . $img_name["img_name"];
                if (file_exists($l_img)) {
                    unlink($l_img);
                }
                if (file_exists($s_img)) {
                    unlink($s_img);
                }
                $sql = "delete from ecomm_product_gallery   where `id`=? ";
                $result = $this->Do_Query($sql, [$id]);
                if ($result == true) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    function get_product_attrs($product_id = "")
    {
        $cayegory = $this->Do_Select("select id ,`category` , `name` from  ecomm_products where `id`=? ", [$product_id], 1);
//        $product_attrs = $this->Do_Select("select * from ecomm_category_attr where `category_id`=? and `status`='ACTIVE' ", [$cayegory["category"]]);
        $product_attrs = $this->Do_Select("select ecomm_category_attr.*, ecomm_category_attr.id as attr_ids ,ecomm_product_attr.`value` from ecomm_category_attr LEFT join ecomm_product_attr on ecomm_category_attr.`id`=ecomm_product_attr.attr_id and  ecomm_product_attr.product_id=? where ecomm_category_attr.`category_id`=?    and ecomm_category_attr.`status`='ACTIVE'   ORDER by ecomm_category_attr.`id` ASC ", [$cayegory["id"], $cayegory["category"]]);
        return [$product_attrs, $cayegory];
    }

    function add_attr_value($data = "")
    {
        $value = $this->filter($data["value"]);
        $product_id = $this->filter($data["product_id"]);
        $attr_id = $this->filter($data["attr_id"]);
        if (!empty($attr_id) and !empty($product_id) and !empty($value)) {
            $is_attr_val = $this->Do_Select("select * from ecomm_product_attr where `product_id`=? and `attr_id`=? ", [$product_id, $attr_id], 1);
            if (empty($is_attr_val)) {
                $result = $this->Do_Query(" insert into  ecomm_product_attr ( `value` ,`attr_id`,`product_id`) VALUES (?,?,?)", [$value, $attr_id, $product_id], [$attr_id, $product_id]);
                if ($result == true) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                $result = $this->Do_Query(" update ecomm_product_attr set `value`=? where attr_id=? and product_id=? ", [$value, $attr_id, $product_id]);
                if ($result == true) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    function get_ajax_product_child($data = [])
    {
        $category_id = $this->filter($data["category_id"]);
        if (empty($category_id) or $category_id == "0") {
            echo json_encode($this->get_products(""));
        } else {
            $products = $this->Do_Select("select * from ecomm_products where `category`=?", [$category_id]);
            $new_product = [];
            foreach ($products as $item) {
                $item["date"] = $this->convert_date($item["date"]);
                $new_product[] = $item;
            }
            echo json_encode($new_product);
        }
    }

    function get_ajax_product_cat($data = [])
    {
        $category_id = $this->filter($data["category_id"]);
        if (empty($category_id) or $category_id == "0") {
            echo json_encode($this->get_products(""));
        } else {
            $ids = $this->Do_Select("select `id` from ecomm_product_category where `cat_group`=?", [$category_id]);
            $all_ids = [];
            foreach ($ids as $item) {
                $all_ids[] = $item['id'];
            }
            $all_ids = implode(',', $all_ids);
            $products = $this->Do_Select("select * from ecomm_products where `category` IN ($all_ids)");
            $new_product = [];
            foreach ($products as $item) {
                $item["date"] = $this->convert_date($item["date"]);
                $new_product[] = $item;
            }
            echo json_encode($new_product);
        }
    }

    function get_product_messages()
    {
        $results = $this->Do_Select("select * from ecomm_product_message ORDER by `status` DESC ", []);
        foreach ($results as $result) {
            $result["date"] = $this->convert_date($result["date"]);
            $new_results[] = $result;
        }
        return $new_results;
    }

    function set_seen_message($data = [])
    {
        $message_id = $this->filter($data["message_id"]);
        $result = $this->Do_Query("update ecomm_product_message set status='ACTIVE' where id=? ", [$message_id]);
        if ($result) {
            echo true;
        } else {
            echo false;
        }
    }

    //    for add new product
    function get_category_parents($cat_group = "")
    {
        $result = $this->Do_Select("select  *   from ecomm_product_category WHERE status='ACTIVE' and  parent=0", [$cat_group]);
        return $result;
    }

}
