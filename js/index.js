// let quantity = document.getElementById('quantity');
// let data = 0;
// //printing default value of data that is 0 in h2 tag
// quantity.innerText = data;
  
// //creation of increment function
// function increament_quantity(inventory) {
//   if(data < inventory){
//     data = data + 1;
//   }
//   quantity.innerText = data;
// }
// //creation of decrement function
// function decreament_quantity() {
//     if(data !== 0){
//       data = data - 1;
//     }
//     quantity.innerText = data;
// }





document.getElementById("main_varient_link").addEventListener("click",function(){
    document.querySelector("#varients_model").style.display = "block";
});

document.getElementById("close_images_model").addEventListener("click",function(){
    document.querySelector("#varients_model").style.display = "none";
});




var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
}





const active_varient = document.getElementById("active_varient");
varient = document.getElementsByClassName("varient_img");

varient[0].onclick = function(){ 
    active_varient.src = varient[0].src; 
    this.parentElement.classList.add("active");
    document.getElementById("main_varient_link").href = varient[0].src;
    varient[1].parentElement.classList.remove("active");
    varient[2].parentElement.classList.remove("active");
    varient[3].parentElement.classList.remove("active");
}
varient[1].onclick = function(){ 
    active_varient.src = varient[1].src; 
    this.parentElement.classList.add("active");
    document.getElementById("main_varient_link").href = varient[1].src;
    varient[0].parentElement.classList.remove("active");
    varient[2].parentElement.classList.remove("active");
    varient[3].parentElement.classList.remove("active");
}
varient[2].onclick = function(){ 
    active_varient.src = varient[2].src; 
    this.parentElement.classList.add("active");
    document.getElementById("main_varient_link").href = varient[2].src;
    varient[0].parentElement.classList.remove("active");
    varient[1].parentElement.classList.remove("active");
    varient[3].parentElement.classList.remove("active");
}
varient[3].onclick = function(){ 
    active_varient.src = varient[3].src; 
    this.parentElement.classList.add("active");
    document.getElementById("main_varient_link").href = varient[3].src;
    varient[0].parentElement.classList.remove("active");
    varient[1].parentElement.classList.remove("active");
    varient[2].parentElement.classList.remove("active");
}



