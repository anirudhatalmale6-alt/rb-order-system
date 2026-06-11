<?php

if(isset($_REQUEST['get_sub_categories']))
{
    $category_id=$_POST['cat_id'];
    include '../class/class.report.php';
    $sub_cat_result=Report::getSubCategories($category_id);
    ?>
<select class="form-control" onchange="loadfile2(this.value);" name="sub_cat" required="required">
            <?php
                while($sub_cat_row=  mysqli_fetch_assoc($sub_cat_result))
                {
            ?>        
                    <option value="<?php echo $sub_cat_row['rox_sub_cate'];  ?>"><?php echo $sub_cat_row['rox_sub_cate'];  ?></option>
            <?php        
                }
            ?>
            
        </select>
    <?php
    
    
}
if(isset($_REQUEST['get_items']))
{
    include '../class/class.report.php';
    $sub_cat_id=$_POST['sub_cat_id'];
    $itemResult=  Report::getItems($sub_cat_id);
    ?>
    <select class="form-control"  name="item" required="required" >
    <?php
        while($item_row=  mysqli_fetch_assoc($itemResult))
        {
    ?>        
        <option value="<?php echo $item_row['rox_line_id'];  ?>"><?php echo $item_row['rox_prd_name'];  ?></option>
    <?php        
        }
        
    
    ?>
    </select>

    <?php
}

