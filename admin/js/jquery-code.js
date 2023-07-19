$(document).ready(function () {
  $(".squeez_sidebar").click(function () {
    $("#mySidenav").css("width", "70px");
    $(".logo").css("display", "none");
    $(".icon").css("display", "block");
    $(".icon-a").css("display", "flex");
    $(".icon-a").css("margin-left", "-7px");
    $(".icon-a span").css("display", "none");
    $(".nav").css("display", "none");
    $(".nav2").css("display", "block");
    $(".squeez_sidebar").css("display", "none");
  });
  $("#navbar_expand").click(function () {
    $("#mySidenav").css("width", "300px");
    $(".logo").css("display", "block");
    $(".icon-a span").css("display", "inline-block");
    $(".icon-a").css("justify-content", "flex-start");
    $(".nav").css("display", "block");
    $(".squeez_sidebar").css("display", "block");
  });

  async function fetch_products(){
    const result = await fetch(`server/load_products.php`);
    const res = await result.json();
    $("#load_products").html(res.message);
  }
  fetch_products();
  
  async function fetch_categories(){
    const fetch_result = await fetch(`server/load_categories.php`);
    const fetch_res = await fetch_result.json();
    $("#load_categories").html(fetch_res.message);
  }
  fetch_categories();
  
  function check_varient(varient){
    if(varient.files[0].size > 5242880){
      show_error_message("Please upload image of size less than 5MB");
      $("#varient_one").val("");
    }
    var ext = varient.value.split(".");
    ext = varient.value.split(".").pop().toLowerCase();
    var arrayExtensions = ["jpg" , "jpeg" , "png" , "webp" , "gif"];
    if(arrayExtensions.lastIndexOf(ext) == -1){
      show_error_message("Please upload image of extension type jpg, jpeg, png, webp or gif only");
      $(`#${varient.id}`).val("");
    }
  }


  function edit_check_varient(varient){
    if(varient.files[0].size > 5242880){
      show_error_message("Please upload image of size less than 5MB");
      $("#edit_varient_one").val("");
    }
    var ext = varient.value.split(".");
    ext = varient.value.split(".").pop().toLowerCase();
    var arrayExtensions = ["jpg" , "jpeg" , "png" , "webp" , "gif"];
    if(arrayExtensions.lastIndexOf(ext) == -1){
      show_error_message("Please upload image of extension type jpg, jpeg, png, webp or gif only");
      $(`#${varient.id}`).val("");
    }
  }


  $("#varient_one").change(function(){
    check_varient(this);
  });
  $("#varient_two").change(function(){
    check_varient(this);
  });
  $("#varient_three").change(function(){
    check_varient(this);
  });
  $("#varient_four").change(function(){
    check_varient(this);
  });


  $(document).on("change" , "#edit_varient_one" , function(){
    edit_check_varient(this);
  });
  $(document).on("change" , "#edit_varient_two" , function(){
    edit_check_varient(this);
  });
  $(document).on("change" , "#edit_varient_three" , function(){
    edit_check_varient(this);
  });
  $(document).on("change" , "#edit_varient_four" , function(){
    edit_check_varient(this);
  });
 

  $("#add_product_form").on("submit", function (e) {
    e.preventDefault();
    const name = $("#product_name").val();
    const tagline = $("#product_tagline").val();
    const stock = $("#stock").val();
    const purchase_price = $("#purchase_price").val();
    const sale_price = $("#sale_price").val();
    const discounted_price = $("#discounted_price").val();
    const description = $("#description").val();

    function show_error(id) {
      document.querySelector(`${id} .field_message`).style.display = "block";
      setTimeout(function () {
        document.querySelector(`${id} .field_message`).style.display = "none";
      }, 10000);
    }
    let formData = new FormData(this);

    if (name == "") {
      show_error("#product_name_feild");
    } else if (tagline == "") {
      show_error("#product_tagline_feild");
    } else if (parseInt(stock) <= 0) {
      alert("Please add valid stock");
    } else if (parseInt(purchase_price) < 1) {
      alert("Please add valid purchase price");
    } else if (discounted_price > parseInt(sale_price)) {
      alert("Please add valid discounted price");
    } else if (parseInt(sale_price) < 1) {
      alert("Please add valid sale price");
    } else if (discounted_price < 1) {
      alert("Please add valid discounted price");
    } else if (description === "") {
      show_error("#product_description_field");
    } else {
      $.ajax({
        url: "server/add_product.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          const res = JSON.parse(response);
          if (res.success) {
            $("#load_categories").html("");
            $("#add_product_modal_back").css({ display: "none" });
            $("#add_product_form").trigger("reset");
            fetch_products();
            fetch_categories();
            show_success_message(res.success);
          } else if (res.error) {
            $("#add_product_modal_back").css({ display: "none" });
            show_error_message(res.error);
          }
        }
      });
    }

    
  });








  $("#add_category_form").on("submit", function (e) {
    e.preventDefault();
    const name = $("#category_name").val();

    function show_error(id) {
      document.querySelector(`${id} .field_message`).style.display = "block";
      setTimeout(function () {
        document.querySelector(`${id} .field_message`).style.display = "none";
      }, 10000);
    }
    let formData = new FormData(this);

    if (name == "") {
      show_error("#category_name_feild");
    } else {
      $.ajax({
        url: "server/add_category.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          const res = JSON.parse(response);
          if (res.success) {
            $("#add_category_modal_back").css({ display: "none" });
            fetch_categories();
          } else if (res.error) {
            $("#add_category_modal_back").css({ display: "none" });
            alert("Product Could not add due to some server error!");
          }
          $("#add_category_form").trigger("reset");
        }
      });
    }

    
  });



  $(document).on("click","#delete_product" , async function(){
    const id = this.dataset.id;
    if(confirm("Are you sure you want to delete this product")){
        const result = await fetch(`server/delete_product.php?id=${id}`);
        const res = await result.json();
        if(res.success){
          show_success_message(res.success);
        }else if(res.error){
          show_error_message(res.error);
        }
        fetch_products();
        fetch_categories();
    }
  })


  $(document).on("click","#delete_category" , async function(){
    const id = this.dataset.id;
    if(confirm("Are you sure you want to delete this category")){
        const result = await fetch(`server/delete_category.php?id=${id}`);
        const res = await result.json();
        if(res.success){
          show_success_message(res.success);
          fetch_categories();
        }else if(res.error){
          show_error_message(res.error);
        }
    }
  })



  $(document).on("click","#edit_product",async function(){
    $("#edit_product_modal_back").css({display : "block"});
    const id = this.dataset.id;
    const result = await fetch(`server/fetch_single_product.php?id=${id}`);
    const res = await result.json();
    $("#edit_product_form").html(res.message);
  });


  $(document).on("click","#edit_category",async function(){
    $("#edit_category_modal_back").css({display : "block"});  
    const id = this.dataset.id;
    const result = await fetch(`server/fetch_single_category.php?id=${id}`);
    const res = await result.json();
    $("#edit_category_form").html(res.message);
  });


  $(document).on("change", "input[name=edit_price_radio]:radio", function(){
    $("#edit_discounted_price_box").toggleClass("d-none");
  });

  $(document).on("click" , "#view_product" , async function(){
    const id = $(this).data("view_product_id");
    $(".view_product_table_back").css({display : "block"});
    const result = await fetch(`server/view_product.php?id=${id}`);
    const res = await result.json();
    $("#product_record").html(res.message);
  })


  $(document).on("submit", "#edit_product_form" ,function (e) {
    e.preventDefault();
    const name = $("#edit_product_name").val();
    const tagline = $("#edit_product_tagline").val();
    const purchase_price = $("#edit_purchase_price").val();
    const sale_price = $("#edit_sale_price").val();
    const discount_price = $("#edit_discounted_price").val();
    const description = $("#edit_description").val();

    function show_error(id) {
      document.querySelector(`${id} .field_message`).style.display = "block";
      setTimeout(function () {
        document.querySelector(`${id} .field_message`).style.display = "none";
      }, 10000);
    }
    let formData = new FormData(this);


    if (name == "") {
      show_error("#product_name_feild");
    } else if (tagline == "") {
      show_error("#product_tagline_feild");
    } else if (parseInt(purchase_price) < 1) {
      alert("Please add valid purchase price");
    } else if (discount_price > parseInt(sale_price)) {
      alert("Please add valid discounted price");
    } else if (parseInt(sale_price) < 1) {
      alert("Please add valid sale price");
    } else if (discount_price < 1) {
      alert("Please add valid discounted price");
    } else if (description === "") {
      show_error("#product_description_field");
    } else {
      $.ajax({
        url: "server/edit_product.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          const res = JSON.parse(response);
          console.log(res.message);
          // $("#load_categories").html("");
          // fetch_products();
          // fetch_categories();
          // if(res.success){
          //   $("#edit_product_modal_back").css({"display" : "none"});
          // }else if(res.error){
          //   $("#edit_product_modal_back").css({"display" : "none"});
          //   alert("Product Could not add due to some server error!");
          // }
        }
      });
    }
  });



  $("#edit_category_form").on("submit", function (e) {
    e.preventDefault();
    const category = $("#edit_category_name").val();
    const category_id = $("#edit_category_id").val();

    function show_error(id) {
      document.querySelector(`${id} .field_message`).style.display = "block";
      setTimeout(function () {
        document.querySelector(`${id} .field_message`).style.display = "none";
      }, 10000);
    }
    let formData = new FormData(this);

    if (category == "") {
      show_error("#category_name_feild");
    } else {
      $.ajax({
        url: "server/edit_category.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          const res = JSON.parse(response);
          if(res.success){
            $("#add_product_modal_back").css({"display" : "none"});
            show_success_message(res.success);
            fetch_categories();
            fetch_products();
          }else if(res.error){
            $("#add_product_modal_back").css({"display" : "none"});
            show_error_message(res.error);
          }
        },
      });
    }
  });







  $("#login_form").on("submit",async function(e){
    e.preventDefault();

    const username = $("#login_username").val();
    const password = $("#login_password").val();
    const result = await fetch("server/checklogin.php",{
        method : "POST",
        body : JSON.stringify({username : username , password : password}),
        headers : {
            "Content-Type" : "Appliction/json"
        }
    });
    const res = await result.json();
    if(res.error === "Something wrong"){
        alert(res.error);
    }else if(res.success === "authenticated"){
        window.location.href = 'index.php';
    }
});




});
