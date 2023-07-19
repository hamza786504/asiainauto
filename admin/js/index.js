






// document.getElementById("edit_product").addEventListener("click",async function(){
//     document.getElementById("edit_product_modal_back").style.display = "block";


      
//     const id = this.dataset.id;
//     const result = await fetch(`server/fetch_single_product.php?id=${id}`);
//     const res = await result.json();
//     document.getElementById("edit_product_form").innerHTML = res.message;
    
// });




function close_modal(){
    document.getElementById("edit_product_modal_back").style.display = "none";
    document.getElementById("add_product_modal_back").style.display = "none";
    document.getElementById("view_product_table_back").style.display = "none";
    document.getElementById("add_category_modal_back").style.display = "none";
    document.getElementById("edit_category_modal_back").style.display = "none";
}

function close_message_box(){
    document.querySelector(".error").style.top = "-100px";
    document.querySelector(".success").style.top = "-100px";
}
function show_success_message(message){
    document.querySelector(".success").style.top = "30px";
    document.querySelector(".success p").innerHTML = message;
    setTimeout(() => {
        document.querySelector(".success").style.top = "-70px";
        document.querySelector(".success p").innerHTML = "";
    },5000);
}
function show_error_message(message){
    document.querySelector(".error").style.top = "30px";
    document.querySelector(".error p").innerHTML = message;
    setTimeout(() => {
        document.querySelector(".error").style.top = "-100px";
        document.querySelector(".error p").innerHTML = "";
    },4000);
}
function price_type(src){
    if(src.value == 1){
        document.getElementById("discounted_price_box").style.display = "none";
        document.getElementById("edit_discounted_price_box").style.display = "none";
    }else if(src.value == 2){
        document.getElementById("discounted_price_box").style.display = "flex";
        document.getElementById("edit_discounted_price_box").style.display = "flex";
    }
}

// document.getElementById("add_product_save").addEventListener("click" , function(e){
//     e.preventDefault();
//     const name = document.getElementById("product_name").value;
//     const tagline = document.getElementById("product_tagline").value;
//     const category = document.getElementById("category_select").value;
//     const stock = document.getElementById("stock").value;
//     const purchase_price = document.getElementById("purchase_price").value;
//     const sale_price = document.getElementById("sale_price").value;
//     let discount_price;
//     if(document.querySelector('input[name="price_radio"]:checked').value == 1){
//         discount_price = sale_price;
//     }else if(document.querySelector('input[name="price_radio"]:checked').value == 2){
//         discount_price = document.getElementById("discounted_price").value;
//     }
//     const publish_type = document.querySelector('input[name="publish_type"]:checked').value;
//     const description = document.getElementById("description").value;



//     function show_error(id){
//         document.querySelector(`${id} .field_message`).style.display = "block";
//         setTimeout(function(){
//             document.querySelector(`${id} .field_message`).style.display = "none";
//         },5000);
//     }


//     if(name == ""){
//         show_error("#product_name_feild");
//     }else if(tagline == ""){
//         show_error("#product_tagline_feild");
//     }else if(parseInt(stock) <= 0){
//         alert("Please add valid stock");
//     }else if(description == ""){
//         show_error("#product_description_field");
//     }
// })




document.getElementById("add_product").addEventListener("click" , function(){
    document.getElementById("add_product_modal_back").style.display = "block";
});
document.getElementById("add_category").addEventListener("click" , function(){
    document.getElementById("add_category_modal_back").style.display = "block";
});








