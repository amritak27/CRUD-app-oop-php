<?php
$page_title = "Create Product";
include_once "layout_header.php";
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$product = new Product($db);
$category = new Catgory($db);

// contents will be here
echo "<div class='right-button-margin'>
        <a href='index.php' class='btn btn-default pull-right'>Read Products</a>
    </div>";
  
    if($_POST){
  
        // set product property values
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->category_id = $_POST['category_id'];
      
        // create the product
        if($product->create()){
            echo "<div class='alert alert-success'>Product was created.</div>";
        }
      
        // if unable to create the product, tell the user
        else{
            echo "<div class='alert alert-danger'>Unable to create product.</div>";
        }
    }
?>
<!-- PHP post code will be here -->  

<!-- HTML form for creating a product -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
    <table class='table table-hover table-responsive table-bordered'>  
        <tr>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' /></td>
        </tr>  
        <tr>
            <td>Price</td>
            <td><input type='text' name='price' class='form-control' /></td>
        </tr>  
        <tr>
            <td>Description</td>
            <td><textarea name='description' class='form-control'></textarea></td>
        </tr>  
        <tr>
            <td>Category</td>
            <td>
            <?php 
                $stmt = $category->read();                
            ?>
            <select class="form-control" name="category_id">
                <option>Select category...</option>
                <?php
                     while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_category);
                        echo "<option value='{$id}'>{$name}</option>";
                    }
                ?>
            </select>
            </td>
        </tr>  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
  
    </table>
</form>

<?php
// footer
include_once "layout_footer.php";

?>