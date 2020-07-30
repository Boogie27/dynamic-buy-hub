$(document).ready(function(){

    
// ================================================
// PRELOADER 
// ================================================
var loaderState = false;
  setTimeout(function preloader(){
      $("#preloader").hide();
      responsiveBars();
      topNavigation();
  }, 2000);



// ================================================
// LIGHT  PRELOADER 
// ================================================
function lightPreloader(){
    // var lightPreloader = $("#lightPreloader");
    var lightPreloader = $(".light-preloader");
    $(lightPreloader).show();
    $("#modalBox").hide();
    $(".dark-skin").fadeIn()
    dropdownInt();
    setTimeout(function(){
        $(lightPreloader).hide();
        $(".dark-skin").fadeOut()
    }, 750);
}
lightPreloader();

  // =============================================================
//     FUNCTION THAT REMOVES ALERT MESSAGE
// ===============================================================
     setTimeout(function(){
        $("#alertMessage").hide();
   }, 5000);




  // ======================================================================================
//  function that removes dark background and removes all asynchronous forms and popups
// ========================================================================================
function hideDarkTheme(){
   // $(".dark-skin").removeClass("dark-skin-active");
   $(".dark-skin").fadeOut()
    $("#modalBox").slideUp(100);
    $("#subCategoryModalBox").slideUp(100);
    $("#subCategoryModalBox").find("input").val("");
    $("#catEditModalBox").slideUp(100);
    $("#catEditModalBox").find("input").val("");

    $("#CategoryForm").find("input").val("");

    $(".dialogbox").removeClass("show"); //removes brand drop down box;
    $(".dialogbox form input").val("");
    $("#alertForm").html("");

    $(".subCategoryName").val("");
    $(".subCategoryBrand").val("");
    $("#subCategoryModalBox #alertForm").html("");

    $("#subCategoryEdit").slideUp(100);
    $("#subCategoryEdit").find("#alertForm").html("")
}

function dropdownInt(){
    $(".dialogbox").removeClass("show"); //removes brand drop down box;
    $(".dialogbox form input").val("");
    $("#alertForm").html("");
}

$(".dark-skin").click(function(){
      hideDarkTheme();
});



// ================================================
// RESPONSIVE BAR CHART
// ================================================
var barCharts = $(".bars");
var bars = $(".bar");
function responsiveBars(){
   if(barCharts.length > 0){  
       $.each(barCharts, function(index, current){
            var bar = $(this).find(bars);
            var dataDirection = $(this).attr("data-direction");
            var barTop = $(this).offset().top;
            var dataTop = parseInt($(this).attr("data-top"));
            var barChartTop = barTop + dataTop;


            // function rises the bars when scrolled into view
                function myBarFunction(bars){
                    $.each(bars, function(barIndex, barCurrent){
                        var barRates = parseInt($(this).attr("data-percentage"));

                        if(dataDirection === "height"){
                            $(this).animate({
                                height: barRates+"%"
                            }, 2000);
                        }
                        
                        if(dataDirection === "width"){
                            $(this).animate({
                                width: barRates+"%"
                            }, 2000);
                        }

                    
                  });
                }
            
            // scroll funciton
            $(window).scroll(function(e){
                var windowHeight = $(this).height();
                var scroll = $(this).scrollTop();
                if((barChartTop - scroll) <= windowHeight){
                       myBarFunction($(bar));
                } 
            }); 


            var inview = $(this).offset().top - $(window).scrollTop() + dataTop;
            if(inview <= $(window).height() ){
                    myBarFunction($(bar));
            }

       });
    }
   }





// ============================================================
// FUNCTION THAT OPENS AND CLOSES THE SIDE NAVIGATION
// ============================================================

 function sideBarNavigation(){
    if($(window).width() < 992){
        var profileNav = $(".profile");
        var sideNavigation = $("#sideNavigation");
        var sideNavOpenButton = $("#sideNavOpenButton");
        var sideNavCloseButton = $("#sideNavCloseButton");
        var darkSkin = $(".dark-skin");
    
        function sideNavAction(left, visibility){
                    $(sideNavigation).css({
                        visibility: visibility,
                        left: left
                    });
                  $(darkSkin).fadeToggle();
        }
    
        
        $.each(profileNav, function(index, current){
            var buttonOpen =  $(this).find("#sideNavOpenButton");
            buttonOpen.click(function(){
                sideNavAction("0px", "visible");
            });
        });
    
        $(sideNavCloseButton).click(function(e){
            sideNavAction("-350px", "hidden",);
        });
    
        $(darkSkin).click(function(){
           if($(sideNavigation).css("left") == "0px"){
                 sideNavAction("-350px", "hidden");
           }
        });
    }
 }
 sideBarNavigation();



// ============================================================
// FUNCTION THAT STICKS SIDE  NAVIGATION ONSCROLL
// ============================================================
 function stickSideNavigation(){
    function stickSidenav(){
        var sideNavigation = $("#stickySideNavigation");
        var startPosition = $("#sideNavStickyPosition");
    
          if(startPosition.length > 0){ 
            var top = $(startPosition).offset().top;
                var element = $(window).scrollTop();
    
                    if(element >= top){
                        $(sideNavigation).addClass("stick");
                    }else{
                        $(sideNavigation).removeClass("stick");
                    }
            }
        }
    
    
        if(($(window).width()) > 991){
            stickSidenav();
            $(window).scroll(function(e){
              stickSidenav();
            });
        } 
 }
 stickSideNavigation();




// ============================================================
// FUNCTION THAT STICKS TOP  NAVIGATION ONSCROLL
// ============================================================
  function topNavigation(){
    var stickyTopNavigation = $("#stickyTopNavigation");
    var stickTopNavPosition = $("#stickyTopNavPosition");

     function stickyTopNav(){
         if(stickTopNavPosition.length > 0){
        var top = $(stickTopNavPosition).offset().top;
        var element = $(window).scrollTop();
        var x = parseInt($(stickTopNavPosition).attr("data-top"));
            if(element >= (top + x) ){
                $(stickyTopNavigation).addClass("topNavSticky");
            }else{
                $(stickyTopNavigation).removeClass("topNavSticky");
            }
       }
    }

   
    if(($(window).width()) < 991){
       stickyTopNav();
       $(window).scroll(function(e){
         stickyTopNav();
         
       });
    }

   
  }
   topNavigation();




  // ======================================================================
// FUNCTION THAT DISPLAYS THE DELETE BARNER ON PRODUCT DELETE PAGE
// =======================================================================
   function deleteBanner(){
    var prodcutItemDelete = $("#productItemDelete");
    var showSpan = $("#productItemDelete span");
  
        var screenWidth = $(window).width();
        if(screenWidth >= 1125){
              if(prodcutItemDelete.length > 0){
                  $(prodcutItemDelete).mouseover(function(){
                      $(showSpan).show();
                  });
                  $(prodcutItemDelete).mouseout(function(){
                  $(showSpan).hide();
                  });
             }
        }
   }
   deleteBanner();   


// ======================================================================
// FUNCTION THAT DISPLAYS THE DROP DOWNS
// =======================================================================       
   
       

       function dropdown(){
            var itemContainer =  {
                parent: $(".parent"),
                productPropDown: $(".childDropDown"),
                actionButton: $(".actionButton")
            }

            $.each(itemContainer.parent, function(index, current){
                var optionButton = $(this).find(itemContainer.actionButton);
                var dropdown = $(this).find(itemContainer.productPropDown);
                function action(button, dropdown){
                    var container = $(button).parent().find(dropdown);
                    if(container){
                        $(container).show();
                    }
            }
                $(optionButton).mouseover(function(e){
                    action($(this),itemContainer.productPropDown );
                });

                $(optionButton).mouseout(function(e){
                    $(itemContainer.productPropDown).hide();
            });

                $(dropdown).mouseover(function(e){
                    $(this).show();
                });

                $(dropdown).mouseout(function(e){
                $(this).hide();
            });
            });
       }
       dropdown();


// ==================================================================
// function thate slides detail image
// ===================================================================
var frameContainer = $(".swipperFrame");
var frame = $(".swipper");
var direction = $(".direction");

// mirror container
var mirrorContainer = $(".mirrorContainer");


function slider(swipperFrame, SwipperWidth, speed, count){ 
    $(swipperFrame).css({
       transition: "all "+speed+"s ease",
       transform: "translate("+(-SwipperWidth * count)+"px)"
    });
}  



function mySlideFunction(Fcontainer, frames, direct){
      var swipperFrames = $(Fcontainer).find(frames);
      var frameItems = $(frame).children();
      var direction = $(Fcontainer).find(direct);
      var frameWidth = $($(swipperFrames).children()[0]).width();
      var marginRight = parseInt($($(swipperFrames).children()[0]).css("margin-right"));
      var width = marginRight + frameWidth;
      var button = $(direction).children();

          button.click(function(e){
              if($(e.target).hasClass("fa-angle-right")){
                    if(counter < frameItems.length - 1){
                        counter++;
                        if(bordered($(mirrorContainer),  counter)){
                            slider(swipperFrames, width, 0.7, counter);
                        }
                       
                    }
              }else if($(e.target).hasClass("fa-angle-left")){
                  if(counter > 0){
                    counter--;
                    if(bordered($(mirrorContainer),  counter)){
                        slider(swipperFrames, width, 0.7, counter);
                    }
                  }
              }
          });
}

// check if frame container exists
if(frameContainer.length > 0){
    var counter = 0;
    mySlideFunction(frameContainer, frame, direction);
    if(($(window).width()) <= 870 ){
         screenOnTouch(frame);     // function that swipes the detail image on touch swipe
    }
}

// function that high lights the mirror
    function bordered(parentDiv, index){
        var frameImages = $(parentDiv).children().find(".mirror");
        for(var i = 0; i < frameImages.length; i++){
            $(frameImages[i]).removeClass("clicked"); 
        }
        if($(frameImages[index]).addClass("clicked")){
            return true;
        }
       return false;
    }

// check if mirror items exists
if(mirrorContainer.length > 0){
    var mirrorChildren = $(mirrorContainer).children().find(".mirror");
    var frameWidth = $($(frame).children()[0]).width();
    var marginRight = parseInt($($(frame).children()[0]).css("margin-right"));
    var width = marginRight + frameWidth;

         $($(mirrorContainer).children().find(".mirror")[0]).addClass("clicked");
        $.each(mirrorChildren, function(index, current){
            // function that slides detail image when mirror image is clicked
            $(this).click(function(e){
               if(bordered($(mirrorContainer), index)){
                   counter = index;
                   slider(frame, width, 0.7, counter);
               }
            });
        });
}


  function screenOnTouch(itemFrame){   
                itemFrame.on("touchstart", touchStart);
                itemFrame.on("touchmove", touchMove);
                itemFrame.on("touchend", touchEnd);
  }
  

  var startPosition = 0;
  var change = 0;
  var currentPosition = 0;

  function touchStart(event){
       isDown = true;
       var  startX = event.touches[0].clientX;
       var framePosition = $(this).css("transform");
       startPosition = startX;
       if(framePosition !== "none"){
         change =  parseInt(framePosition.split(",")[4])
       }
  }

 function touchMove(event){
     if(isDown){
        var startX = event.touches[0].clientX;
        var movingPositon = startX - startPosition;
         currentPosition = movingPositon + change;
        
        $(this).css({
           transition: "none",
           transform: "translate("+(movingPositon + change )+"px)"
        });
     }
  }




function touchEnd(){
    var frameCont = $(this).children();
   var childWidth = $(frameCont[0]).width();
   var marginRight = parseInt($(frameCont[0]).css("margin-right"));
   var width = marginRight + childWidth;
   
   var actualPosition = $(this).width() + currentPosition;

   if(actualPosition < $(frameCont[0]).width()){
            animate($(this), width, frameCont.length - 1);
   }
   
   if(actualPosition > $(this).width()){
        animate($(this), width, 0);
   }
}


function animate(frame, width, count){
        $(frame).css({
            transition: "all 0.7s ease",
            transform: "translate("+(-width * count )+"px)"
        });
}



// ===========================================================
//       FUNCTION THAT OPENS AND CLOSES THE MODAL BOX
// ===========================================================

var openModalBox = $(".openModal-box");
function modalBox(){
    $(openModalBox).click(function(e){
        e.preventDefault();
           $("#modalBox").slideDown(300);
           $(".dark-skin").fadeIn();
    });

    // close the modal box
    $(".modalBoxCancle").click(function(e){
        e.preventDefault();
        hideDarkTheme();
    });
}
modalBox();



// ===========================================================
//       FUNCTION THAT DISPLAYS LOGIN AND SIGNUP FORM
// ===========================================================
function loginSignForm(){
    var formContainer = $("#formContainer form");
    var formbutton = $(".formbutton");
   
    for(var i = 0; i < formContainer.length; i++){
         $(formContainer[i]).hide();
         $(formbutton[i]).removeClass("inview");
    }
    $(formContainer[0]).show();
    $(formbutton[0]).addClass("inview");


    function formInt(type){
        for(var i = 0; i < formContainer.length; i++){
            $(formContainer[i]).hide();
            $(formbutton[i]).removeClass("inview");
       }
       $(formContainer[type]).show();
       $(formbutton[type]).addClass("inview");
    }


    $.each(formbutton,function(index, current){
        $(current).click(function(e){
            formInt(index);
        });
    });

}

loginSignForm();






// =============================================================
//     FUNCTION THAT DISPLAYS SUB CATEGORIES DROPDOWN
// =============================================================
function categoryModal(){
    var subcategoryEditButton = $(".subcategoryEditButton");
    var subCatDropdown = $("#modalBox form");
    
        $.each(subcategoryEditButton, function(index, current){
                $(current).click(function(e){
                    var id = $(e.target).attr("id");
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            dropdownButton:"dropdownButton",
                            itemID: id
                            },
                        success: function(response){
                            
                                console.log($(subCatDropdown).find(".ajax-brand").html(response))
                            $("#modalBox").slideDown(300);
                        }
                    });
                });
        });
    }
    categoryModal();




    
// =================================================================
//       FUNCTION THAT ADDS NEW BRAND 
// ================================================================
var newBrand = $("#newBrand");
$(newBrand).click(function(e){
    e.preventDefault();
     var input = $(this).parent().find(".brandInput").val();
    $.ajax({
       url: "ajax.php",
       method: "post",
       data: {
           newBrand: "newBrand",
           brandInput: input,
        },
       success: function(response){
           if(response == "newBrand"){
               location.reload();
           }else{
              $(".message-alert").html(response);
           }
       }
    });
});





 
// =============================================================
//     FUNCTION THAT DROPS DOWN EDITS BRAND FORM
// =============================================================
var brandEditbutton = $(".brandEditbutton");
var dialogbox = $(".dialogbox");
    $.each(brandEditbutton, function(index, current){
             $(current).click(function(e){
                 id = $(this).parent().find(".brandID").val();
                  $(dialogbox).addClass("show");
                  $(".dark-skin").fadeIn();

                  $.ajax({
                      url: "ajax.php",
                      method: "post",
                      data: {brandItem: "brandItem",
                             brandID: id
                      },
                      success: function(response){
                            $(dialogbox).find("input").val(response);
                            $(dialogbox).find(".brandID").val(id);
                      }
                  });
             });
    });

$(dialogbox).find("#brandCancle").click(function(e){
    hideDarkTheme(); //brand drop down cancle;
});



 
// =============================================================
//     FUNCTION THAT SUBMITS EDITED BRAND
// =============================================================
var dialogbox = $(".dialogbox");
var brandEdit = $("#brandEdit");
     $(brandEdit).click(function(e){
         e.preventDefault();
          var input = $(dialogbox).find("#editBrandValue").val();
          var brandID = $(dialogbox).find("#brandID").val()
   
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {editBrand: "editBrand",
                        brandID : brandID,
                        input: input
                },
                success: function(response){
                    if(response == "edited"){
                        location.reload();
                    }else{
                        $(".dialogbox").find("#alertForm").html(response)
                    }
                }
            });
     });



 
// =============================================================
//     FUNCTION THAT DELETES BRAND
// =============================================================
     var brandDeleteButton = $(".brandDeleteButton");
          $(brandDeleteButton).click(function(e){
              e.preventDefault();
               var brandID = $(this).parent().find(".brandID").val()
          
                 $.ajax({
                     url: "ajax.php",
                     method: "post",
                     data: {deleteBrand: "deleteBrand",
                             deleteBrand : brandID,
                     },
                     success: function(response){
                         if(response == "brandDeleted"){
                            location.reload();
                         }else{
                            $(".message-alert").html(response);
                         }
                     }
                 });
          });
     
     

// =============================================================
//     FUNCTION THAT CHECKS BRAND ITEMS BUTTON
// =============================================================
var brandTable = $("#brandTable");
var brandCheck = $(".brandCheck");
var brandCheckDelete = $("#productItemDelete");
var checkAll = $("#checkAll");
var checkQty = $("#checkQty");
var checkedArray = [];

var x = 0;



function checked(){
    $(checkQty).html(x); //sets selected items to 0;

    $(checkAll).on("change", function(e){
        if($(this).is(":checked")){
            $(brandCheck).prop("checked", true);
            $(checkQty).html(brandCheck.length);
        }else{
            $(brandCheck).prop("checked", false);
            $(checkQty).html(0)
        }
    });

    $(brandCheck).on("change", function(e){
        if(!$(this).is(":checked")){
            $(checkAll).prop("checked", false);
        }
    });

    $(brandCheckDelete).click(function(e){
        for(i = 0; i < brandCheck.length; i++){
            if($($(brandCheck)[i]).is(":checked")){
                var values = $($(brandCheck)[i]).val();
                checkedArray.push(values)
            }
        }
        $.ajax({
             url: "ajax.php",
             method: "post",
             data: {
                 checkDelete: "checkDelete",
                 checkedArray: checkedArray
             },
             success: function(response){
                if(response == "checkedDeleted"){
                    location.reload();
                }else{
                    $(".message-alert").html(response);
                }
             }
        });
      
    });

    // function that counts the select items;
    $.each(brandCheck, function(index, current){
        $(this).click(function(e){
             y = 0;
             if($(this).is(":checked")){
                 x++;
                $(checkQty).html(x)
             }else{
                 for(var i = 0; i < brandCheck.length; i++){
                     if($($(brandCheck)[i]).is(":checked") === true){
                             y++; 
                     } 
                 }
                 
                $(checkQty).html(y);
             }
        });
    })

// end   
}

checked();




// ======================================================
//        FUNCTION THAT ADDS NEW CATEGORY
// ======================================================\
function addCategory(){
    var CategoryForm = $("#CategoryForm");
    $(CategoryForm).submit(function(e){
          e.preventDefault();
         // var input = $(this).find(categoryInput).val();
              $.ajax({
                  url: "ajax.php",
                  method: "post",
                  data: new FormData(this),
                  contentType: false,
                  processData: false,
                  success: function(response){
                      if(response == "addCategory"){
                        location.reload();
                      }else{
                        $("#modalBox").find("#alertForm").html(response);
                      }
                  }
              });
    });

}
addCategory();



// ======================================================
//        FUNCTION THAT DELETES CATEGORY
// ======================================================
function deleteCategory(){
var category = $(".catDelete");
     $(category).click(function(e){
           e.preventDefault();
           id = parseInt($(this).parent().find(".catID").val());
           $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                catDelete: "catDelete",
                catID : id 
            },
            success: function(response){
               if(response == "categoryDeleted"){
                location.reload();
               }else{
                   $(".message-alert").html(response);
               }
            }
        });
     });
}

deleteCategory();



function categoryEdit(){
    
// ===========================================================
//        FUNCTION THAT DISPLAY CATEGORY EDIT DROP DOWN BOX
// ===========================================================
var catEdit = $(".catEdit");
    $.each(catEdit, function(index, current){
        $(this).click(function(e){
            e.preventDefault();
                var id = $(this).parent().find(".catID").val();
                $("#catEditModalBox").find(".catID").val(id);
                $("#catEditModalBox").slideDown(200);
                $(".dark-skin").fadeIn()
        })
    });







    // ===========================================================
    //        FUNCTION THAT EDITS CATEGORY ITEM
    // ===========================================================
    var catEditModalBox = $("#catEditModalBox form");
    $(catEditModalBox).submit(function(e){
        e.preventDefault();
        id = parseInt($(this).find(".catID").val());
        
        $.ajax({
            url: "ajax.php",
            method: "post",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response){
                if(response == "categoryEdited"){
                       location.reload();
                }else{
                    $(".message-alert").html(response);
                }
            }
        });
    });

}
categoryEdit();




// ===========================================================
//        FUNCTION THAT DISPLAYS SUB CATEGROY DROP DOWN 
// ===========================================================
function add_sub_category(){
var catAdd = $(".catAdd");
var subCategoryModalBox = $("#subCategoryModalBox");
    $.each(catAdd, function(index, current){
           $(this).click(function(e){
               e.preventDefault();
               var id = $(this).parent().find(".catID").val();
                $("#subCategory").find(".categoryID").val(id);
               $(subCategoryModalBox).slideDown();
               $(".dark-skin").fadeIn()
           });
    });

    $("#modalBoxCancle").click(function(e){
        hideDarkTheme();
    });


// adding item to sub categroy
    var subCategory = $("#subCategory");
    $(subCategory).submit(function(e){
        e.preventDefault();
        var subCategoryName = $(".subCategoryName").val();
        var subCategoryBrand = $(".subCategoryBrand").val();
        var categoryID = $(".categoryID").val();
 
        $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
             subCategory: "subCategory",
             subCategoryName: subCategoryName,
             subCategoryBrand: subCategoryBrand,
             categoryID: categoryID
            },
            success: function(response){
               if(response == "sub_category_added"){
                     location.reload();
               }else{
                $("#subCategoryModalBox").find("#alertForm").html(response);
               }
            }
        })
    });

}

add_sub_category();




// ===========================================================
//        FUNCTION THAT DISPLAYS SUB CATEGROY EDIT DROP DOWN 
// ===========================================================
function sub_category_edit(){
    var edit = $(".sub_cat_edit");
        $.each(edit, function(index, current){
              $(this).click(function(e){
                  e.preventDefault();
                    var id = $(this).attr("id");
                    $("#subCategoryEditForm").find(".categoryID").val(id);
                    $.ajax({
                       url: "ajax.php",
                       method: "post",
                       data: {
                          subEditDropDown: "subEditDropDown",
                          editID: id
                       },
                       success: function(response){
                          $("#subCategoryEdit").find(".subCategoryEditName").val(response);
                       }
                    });
                    $("#subCategoryEdit").slideDown(200);
                    $(".dark-skin").fadeIn()
              });
        });





    // function that submits sub category edit form;
    var subCategoryEditForm = $("#subCategoryEditForm");
        $(subCategoryEditForm).submit(function(e){
            e.preventDefault();
             var name = $(this).find(".subCategoryEditName").val();
             var brand = $(this).find(".subCategoryBrand").val();
             var id = $(this).find(".categoryID").val();

             $.ajax({
                  url: "ajax.php",
                  method: "post",
                  data: {
                      subEditSubmit: "subEditSubmit",
                      subeditName: name,
                      subEditBrand: brand,
                      subCatID: id
                  },
                  success: function(response){
                      if(response == "subCatEdited"){
                           location.reload();
                      }else{
                        $("#subCategoryEdit").find("#alertForm").html(response);
                      }
                  }
             });
        });


        // function that deletes sub category
        var subCatDelete = $(".sub_cat_delete");
            $.each(subCatDelete, function(index, current){
                  $(this).click(function(e){
                      e.preventDefault();
                      var id =  $(this).parent().parent().find(".catEditID").val();

                      $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            subEditDelete: "subEditDelete",
                            subCatDeleteID: id
                        },
                        success: function(response){
                                location.reload();
                        }
                   });                      
                  });
            });
}
sub_category_edit();

// category featured button
function categoryFeaturedBtn(){
    var categoryFeaturedBtn = $("i.categoryFeaturedBtn");
    var subCategoryFeaturedBtn = $("i.subCategoryFeaturedBtn");

       $.each(subCategoryFeaturedBtn, function(index, current){
              $(this).click(function(e){
                  $(this).removeClass("fa-check text-success");
                  $(this).removeClass("fa-times text-danger");
                    e.preventDefault();
                    var id = $(this).parent().parent().parent().find(".catEditID").val();
                    $.ajax({
                        url: "ajax.php",
                        method: "post",
                        data: {
                            subCatFeatued: "subCatFeatued",
                            subCatFeatuedID: id
                        },
                        success: function(response){
                            if(response == "fa-check text-success" || response == "fa-times text-danger"){
                                  $(current).addClass(response); 
                            }else{
                                location.reload();
                            }
                            
                        }
                   }); 
              });
       });


       $.each(categoryFeaturedBtn, function(index, current){
             $(this).click(function(e){
                 e.preventDefault();
                 var id = $(this).parent().parent().parent().find(".catID").val();
                 $.ajax({
                     url: "ajax.php",
                     method: "post",
                     data: {
                         catFeatued: "catFeatued",
                         catFeatuedID: id
                     },
                     success: function(response){
                          location.reload();
                     }
                }); 
             })
       });
}
categoryFeaturedBtn()


// =======================================================
// FUNCTION THAT GETS IF CLIENT IS ONLINE
// =======================================================
function online(){
    var online = $("i.online");
    $.each(online, function(index, current){
        var id = $(this).attr("id");
    
        $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                online: "online",
                onlineID: id
            },
            success: function(response){
                $(current).removeClass(response);
                $(current).addClass(response);
                console.log("yes")
            }
          });
    });
}
online();
setTimeout(online, 10000);



// =======================================================
// FUNCTION THAT GETS SETS A CLIENT ACTIVE OR IN_ACTIVE
// =======================================================
function user_active(){
    var productTableForm = $(".user-activate");
        $.each(productTableForm, function(index, current){
             $(this).click(function(e){
                e.preventDefault();
                 var id = $(this).parent().attr("id");
                
                $.ajax({
                    url: "ajax.php",
                    method: "post",
                    data: {
                        activate: "activate",
                        userID: id
                    },
                    success: function(response){
                       if(response == "activate"){
                           location.reload();
                       }
                    }
                  });
             });
        });


        // function deactivates a users
var deactivateUser = $(".deactivate-user");
    $.each(deactivateUser, function(index, current){
        $(this).click(function(e){
            e.preventDefault();
            var id = $(this).parent().attr("id");
            
            $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    deactivate: "deactivate",
                    deactivateID: id
                },
                success: function(response){
                   if(response == "deactivate"){
                       location.reload();
                   }
                }
              });
        })
    });



    // funciton that activates an admin
var adminActivateBtn = $(".adminActivateBtn");
    $.each(adminActivateBtn, function(index, current){
          $(this).click(function(e){
               var id = $(this).parent().attr("id");

               $.ajax({
                url: "ajax.php",
                method: "post",
                data: {
                    adminActivate: "adminActivate",
                    adminID: id
                },
                success: function(response){
                  if(response == 1){
                     location.reload();
                  }
                }
              });
          });
    });



//  function deactivates an admin
var adminDeactivateBtn = $(".adminDeactivateBtn");
    $.each(adminDeactivateBtn, function(index, current){
        $(this).click(function(e){
            e.preventDefault();
            var id = $(this).parent().parent().attr("id");

            $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                adminDeactivate: "adminDeactivate",
                adminID: id
            },
            success: function(response){
                location.reload();
            }
            });
        });
    });
}
user_active();






// ======================================================
//   FUNCTION THAT ADDS NEW AMIN MEMEBER
// ======================================================
function admin(){
  var adminAddNewForm = $(".adminAddNewForm form");
      $(adminAddNewForm).submit(function(e){
           e.preventDefault();

           $.ajax({
            url: "ajax.php",
            method: "post",
            data: new FormData(this),
            contentType: false,
            processData: false,
            success: function(response){
                if(response == "admin-added"){
                    location.reload();
                }else{
                    $(".adminAddNewForm").find("#alertForm").html(response);
                }
            }
            });
      });
}
// i like to look for trouble hahahaha 7 mercy okewo street ikotun lagos


// ======================================================
//   FUNCTION THAT DELETES AMIN MEMEBER
// ======================================================
 var adminDeleteBtn = $(".adminDeleteBtn");
   $.each(adminDeleteBtn, function(index, current){
           $(this).click(function(e){
            e.preventDefault();
            var id = $(this).parent().parent().attr("id")
            $.ajax({
             url: "ajax.php",
             method: "post",
             data: {
                adminDelete: "adminDelete",
                adminID: id 
             },
             success: function(response){
               if(response == "adminDeleted"){
                   location.reload();
               }
             }
             });
           });
   });
admin();



// ==================================================================
//   FUNCTION THAT SELECT SUB CATEGORY ITEMS ASYNCHRONOUESLY
// ==================================================================

function selected_category(){
    var productCategories = $("#productCategories");

    $(productCategories).change(function(){
        var id = $(this).children("option:selected").val();

        $.ajax({
            url: "ajax.php",
            method: "post",
            data: {
                selectedCategory: "selectedCategory",
                selectedID: id 
            },
            success: function(response){
               $("#productSubCategroies").html(response);
            }
            });
    });
 
}
selected_category();

// end;
});

