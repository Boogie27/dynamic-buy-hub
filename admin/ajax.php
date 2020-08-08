<?php
require_once "core/init.php";


if(Input::get("dropdownButton")){
    if(Session::exists(Config::get("session/session_name"))){
        $itemID = escape(Input::get("itemID"));
        $brand = new Brand();
        $brand->brand($itemID);
    }
}



// ===================================================================
//     FUNCTION THAT DISPLAYS BRAND ON EDIT INPUT FORM
// ===================================================================
if(Input::get("brandItem")){
    if(Session::exists(Config::get("session/session_name"))){
        $brandID = escape(Input::get("brandID"));
        $brand = new Brand();
        $brand->brand($brandID);
    }
}




// ===================================================================
//     FUNCTION THAT EDITS BRAND 
// ===================================================================
if(Input::get("editBrand")){
    if(Session::exists(Config::get("session/session_name"))){
        $brandID = escape(Input::get("brandID"));
        $input = escape(Input::get("input"));

        $brand = new Brand();
        $editBrand = $brand->editBrand($input, $brandID);
        if(!$editBrand->passed()){
             echo '<div class="text-danger alertError" id="alertMessage">'.$editBrand->getError().'</div>';
        }else{
           $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$input.' edited successfully!</div>';
            Session::flash("alert",  $alert);
            echo "edited";
        }

    }
}





// ===================================================================
//     FUNCTION THAT ADDS NEW BRAND
// ===================================================================
if(Input::get("newBrand")){
    if(Session::exists(Config::get("session/session_name"))){
        $input = escape(Input::get("brandInput"));
        $newBrand = new Brand();
        $newBrandItem = $newBrand->newBrand($input);
        if(!$newBrandItem->passed()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">'.$newBrand->getError().'!</div>';
            echo $alert;
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$input.' has been added successfully!</div>';
            Session::flash("alert",  $alert);
            echo "newBrand";
        }
    }
}

// ===================================================================
//     FUNCTION THAT DELETES BRAND
// ===================================================================
if(Input::get("deleteBrand")){
    if(Session::exists(Config::get("session/session_name"))){
        $brand_id = escape(Input::get("deleteBrand"));
        $deleteBrand = new Brand();
        $deleteAction = $deleteBrand->deleteBrand($brand_id);
        if(!$deleteAction->passed()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">Something went wrong!</div>';
            echo $alert;
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">The Brand '.$deleteAction->data()->brand.' has been deleted!</div>';
            Session::flash("alert",  $alert);
            echo "brandDeleted";
        }
    }
}





// ===================================================================
//     FUNCTION THAT DELETES CHECKED BRAND ITEMS
// ===================================================================
if(Input::get("checkDelete")){
    if(Session::exists(Config::get("session/session_name"))){
         $checkedArray = Input::get("checkedArray");
         $x = 0;
         foreach($checkedArray as $values){
            $values = escape($values);
             $checked = new Brand();
             $checkedDelete = $checked->deleteBrand($values);
             $x++;
         }
         if(!$checkedDelete->passed()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">Something went wrong!</div>';
            echo $alert;   
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$x.' brands has been deleted!</div>';
            Session::flash("alert",  $alert);
            echo "checkedDeleted";
        }
    }
}






// ===================================================================
//     FUNCTION THAT ADDS NEW CATEGORY
// ===================================================================
if(Input::get("CategoryName")){
    if(Session::exists(Config::get("session/session_name"))){
            $input = escape(Input::get("CategoryName"));
            $image = $_FILES["categoryImage"];
      
            $category = new Category();
            $newCategory = $category->add_new_category($input, $image);
            if(!$newCategory->passed()){
                echo '<div class="text-danger alertError">'.$newCategory->error().'</div>';
            }else{
                $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$input.' has been added!</div>';
                Session::flash("alert", $alert);
                echo "addCategory";
            }
    }
}





// ======================================================
//        FUNCTION THAT DELETES CATEGORY
// ======================================================
if(Input::get("catDelete")){
    if(Session::exists(Config::get("session/session_name"))){
         $id = escape(Input::get("catID"));

         $category = new Category();
         $deleteCat =  $category->deleteCategroy($id);
         if(!$deleteCat->passed()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">'.$deleteCat->error().'</div>';
            echo $alert;   
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">deleted successfully!</div>';
            Session::flash("alert",  $alert);
            echo "categoryDeleted";
        }
    }
}



// ======================================================
//        FUNCTION THAT DELETES CATEGORY
// ======================================================
if(Input::get("catEditID")){
    if(Session::exists(Config::get("session/session_name"))){
        $id = escape(Input::get("catEditID"));
        $input = escape(Input::get("CategoryEditName"));
        $image = $_FILES["categoryEditImage"];

         $categoryEdit = new Category();
         $categoryEditAction =  $categoryEdit->categoryEdit($id, $input, $image);
         if(!$categoryEditAction->passed()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">'.$categoryEditAction->error().'</div>';
            echo $alert; 
         }else{
             echo "categoryEdited";
         }
    }
}





// ====================================================
//   FUNCTION THAT ADDS SUB CATEGORY
// ====================================================
if(Input::get("subCategory")){
    if(Session::exists(Config::get("session/session_name"))){
        $name = escape(Input::get("subCategoryName"));
        $brandID = escape(Input::get("subCategoryBrand"));
        $categoryID = escape(Input::get("categoryID"));

        $addSubCategory = new Category();
        $addtion = $addSubCategory->add_sub_category($name, $brandID, $categoryID);
        if(!$addtion->passed()){
            echo '<div class="text-danger alertError">'.$addtion->error().'</div>'; 
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$name.' added successfully!</div>';
            Session::flash("alert",  $alert);
            echo "sub_category_added";
        }
    }
}




// ======================================================
// FUNCTION THAT POPULATE SUB EDIT FROM INPUT
// ======================================================
if(Input::get("subEditDropDown")){
    if(Session::exists(Config::get("session/session_name"))){
        $editID = escape(Input::get("editID"));

        $edit = new Category();
        $edit->get("sub_categories", array("id", "=", $editID));
        if($edit->count()){
            echo $edit->first()->name;
        }
    }
}


// ========================================================
// FUNCTION THAT SUBMITS SUB EDIT FORM
// ========================================================
if(Input::get("subEditSubmit")){
    if(Session::exists(Config::get("session/session_name"))){
        $subeditName = escape(Input::get("subeditName"));
        $subEditBrand = escape(Input::get("subEditBrand"));
        $subEditId = escape(Input::get("subCatID"));

        $editSub = new Category();
        $editSubCategroy = $editSub->edit_sub_category($subeditName, $subEditBrand, $subEditId);
        if(!$editSubCategroy->passed()){
            echo '<div class="text-danger alertError">'.$editSubCategroy->error().'</div>'; 
        }else{
            $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$subeditName.' edited successfully!</div>';
            Session::flash("alert",  $alert);
            echo "subCatEdited";
        }
    }
}

// ========================================================
// FUNCTION THAT DELETES SUB CATEGORY ITEM
// ========================================================
if(Input::get("subEditDelete")){
    if(Session::exists(Config::get("session/session_name"))){
        $deletedID = escape(Input::get("subCatDeleteID"));  

        $delete = new Category();
        if(!$delete->delete("sub_categories", array("id", "=", $deletedID))->error()){
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;" id="alertMessage">Item deleted successfully</div>';
            Session::flash("alert",  $alert);
            echo "subCategoryDeleted";
        }else{
            $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">Item could not be deleted!</div>';
            Session::flash("alert",  $alert);
        }
    }
}




// =============================================================
// FUNCTION THAT TURNS SUB CATEGORY FEATURED OR NOT FEATURED
// =============================================================
if(Input::get("subCatFeatued")){
    if(Session::exists(Config::get("session/session_name"))){
        $featuredID = escape(Input::get("subCatFeatuedID"));  

        $featured = new Category();
        $check = $featured->get("sub_categories", array("id", "=", $featuredID));
        if($check->count()){
            $getItem = $featured->get("categories", array("id", "=", $check->first()->categories_id));
            if($getItem->count()){
                if($getItem->first()->featured){
                    if($featured->featured("sub_categories", $featuredID)){
                        echo "fa-check text-success";
                    }else{
                        echo "fa-times text-danger";
                    }
                }else{
                    $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;">Activate '.$getItem->first()->name.' Category to perform this action!</div>';
                    Session::flash("alert",  $alert);
                }
            }
            
        }
    }
}


// =============================================================
// FUNCTION THAT TURNS CATEGORY FEATURED OR NOT FEATURED
// =============================================================
if(Input::get("catFeatued")){
    if(Session::exists(Config::get("session/session_name"))){
        $featuredID = escape(Input::get("catFeatuedID"));  

        $featured = new Category();
        if($featured->featured("categories", $featuredID)){
            $featured->update("sub_categories", array(
                "featured" => 1
            ), array("categories_id", "=", $featuredID));
            echo "fa-check text-success";
        }else{
            $featured->update("sub_categories", array(
                "featured" => 0
            ), array("categories_id", "=", $featuredID));
            echo "fa-times text-danger";
        }
        
    }
}



// =============================================================
// FUNCTION THAT DISPLAYS ONLINE USERS ICONS
// =============================================================
if(Input::get("online")){
    if(Session::exists(Config::get("session/session_name"))){
         $onlineID = escape(Input::get("onlineID"));  
         $user = new User();
         $user->get("users", array("id", "=", $onlineID));
         if($user->count()){
             if(!$user->first()->online){
                 echo "text-danger";
             }else{
                 echo "text-success";
             }
         }
    }
}



// =======================================================
// FUNCTION THAT GETS SETS A CLIENT ACTIVE OR IN_ACTIVE
// =======================================================

if(Input::get("activate")){
    if(Session::exists(Config::get("session/session_name"))){
         $userID = escape(Input::get("userID"));  
         $user = new User();
         if(!$user->activate("users", $userID)){
           echo $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;" id="alertMessage">'.$user->error().'</div>';
            Session::flash("alert",  $alert);
         }else{
                   echo "activate";
         }
    }
}



// =======================================================
// FUNCTION THAT SETS A CLIENT ACTIVE OR IN_ACTIVE
// =======================================================

if(Input::get("deactivate")){
    if(Session::exists(Config::get("session/session_name"))){
         $userID = escape(Input::get("deactivateID"));  
         $user = new User();
         if(!$user->deactivate("users", $userID)){
           echo $alert = '<div class="alert alert-danger text-danger" style="margin-top: 10px;" id="alertMessage">'.$user->error().'</div>';
            Session::flash("alert",  $alert);
         }else{
                   echo "deactivate";
         }
    }
}



// =======================================================
// FUNCTION THAT SETS AN ADMIN ACTIVE OR IN_ACTIVE
// =======================================================

if(Input::get("adminActivate")){
    if(Session::exists(Config::get("session/session_name"))){
         $userID = escape(Input::get("adminID"));  
         $user = new User();
         echo$user->admin_activate("admin", $userID);
    }
}


// =======================================================
// FUNCTION THAT  DEACTIVATES AN ADMIN MEMBER
// =======================================================
if(Input::get("adminDeactivate")){
    if(Session::exists(Config::get("session/session_name"))){
        $userID = escape(Input::get("adminID"));  
        $user = new User();
        $user->admin_deactivate("admin", $userID);
   }
}



// =======================================================
// FUNCTION THAT ADDS A NEW ADMIN MEMBER
// =======================================================
if(Input::get("adminName")){
    if(Session::exists(Config::get("session/session_name"))){
        $name = escape(Input::get("adminName"));  
        $email = escape(Input::get("adminEmail"));  
        $password = escape(Input::get("adminPassword"));  
        $position = escape(Input::get("adminPosition"));

        $user = new User();
        if($user->get("admin", array("email", "=", $email))->count()){
            echo '<div class="text-danger alertError">The email '.$email.' already exits!</div>'; 
        }else{
            $userCheck = $user->check_admin($name, $email, $password, $position);
            if(!$userCheck->passed()){
                echo '<div class="text-danger alertError">'.$userCheck->error().'</div>'; 
            }else{
                $user->insert("admin", array(
                     "name" => $name,
                     "email" => $email,
                     "password" => $password,
                     "position" => $position
                ));
                $alert = '<div class="alert alert-success text-success" style="margin-top: 10px;" id="alertMessage">'.$name.' added successfully!</div>';
                Session::flash("alert",  $alert);
                echo "admin-added";
            }
        }
       
   }
}


// ======================================================
//   FUNCTION THAT DELETES AMIN MEMEBER
// ======================================================

if(Input::get("adminDelete")){
    if(Session::exists(Config::get("session/session_name"))){
        $adminID = escape(Input::get("adminID"));

        $admin = new User();
       if( $admin->admin_delete("admin", $adminID)){
           echo "adminDeleted";
       }
    }
}




// ==================================================================
//   FUNCTION THAT SELECT SUB CATEGORY ITEMS ASYNCHRONOUESLY
// ==================================================================
if(Input::get("selectedCategory")){
    if(Session::exists(Config::get("session/session_name"))){
        $selectedID = escape(Input::get("selectedID"));

        $category = new Category();
        $categories = $category->get("sub_categories", array("categories_id", "=", $selectedID));
        if($categories->count()){
            foreach($categories->result() as $values){
                echo ' <option value="'.$values->id.'">'.$values->name.'</option>';
            }
        }
       
    }
}






// ==================================================================
//   FUNCTION THAT DISPLAYS EDIT PRODUCT IMAGE 
// ==================================================================

if(Input::get("productImage")){
    if(Session::exists(Config::get("session/session_name"))){
        $imageID = escape(Input::get("productImageID"));
       
       $product = new Product();
       $product->get("products", array("id", "=", $imageID));
        if($product->count()){
            $item = $product->first();
            $saved_image = explode(",", $item->image);
            foreach($saved_image as $values){
             echo ' <div class="frame-item productImageDelete">
                        <img src="images/'.$values.'" alt="'.$item->name.'">
                        <button type="button" class="edit-delete-button" id="'.$item->id.'"><i class="fa fa-times"></i></button>
                    </div>';
          }
        }
       
    }
}



// ==================================================================
//   FUNCTION THAT DELETES PRODUCT IMAGE 
// ==================================================================
if(Input::get("productImageDelete")){
    if(Session::exists(Config::get("session/session_name"))){
        $imageID = escape(Input::get("imageID"));
        $imageIndex = escape(Input::get("imageIndex"));

       $product = new Product($imageID);
       $products = $product->delete_image($imageID, $imageIndex);
       if($products){
           echo "image_deleted";
       }
       
    }
}



// ==================================================================
//   FUNCTION THAT DELETES PRODUCT 
// ==================================================================
if(Input::get("productItemDelete")){
    if(Session::exists(Config::get("session/session_name"))){
        $productDeleteID = escape(Input::get("productDeleteID"));
       
        $product = new Product($productDeleteID);
        $products = $product->delete_product();
         if($products){
           $product->delete("products", array("id", "=", $productDeleteID));
           echo "deleted";
         }

    }
}




