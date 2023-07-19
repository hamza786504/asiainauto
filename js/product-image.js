async function load_varients(){
    data-id
    const result = await fetch(`load_varients.php?id=`)
}
load_varients();

const active_varient_image = document.getElementById("active_varient_image");
varient_image = document.getElementsByClassName("varient_img_normal");

varient_image[0].onclick = function(){ 
    active_varient_image.src = varient_image[0].src; 
    this.parentElement.classList.add("active");
    varient_image[1].parentElement.classList.remove("active");
    varient_image[2].parentElement.classList.remove("active");
    varient_image[3].parentElement.classList.remove("active");
}
varient_image[1].onclick = function(){ 
    active_varient_image.src = varient_image[1].src; 
    this.parentElement.classList.add("active");
    varient_image[0].parentElement.classList.remove("active");
    varient_image[2].parentElement.classList.remove("active");
    varient_image[3].parentElement.classList.remove("active");
}
varient_image[2].onclick = function(){ 
    active_varient_image.src = varient_image[2].src; 
    this.parentElement.classList.add("active");
    varient_image[0].parentElement.classList.remove("active");
    varient_image[1].parentElement.classList.remove("active");
    varient_image[3].parentElement.classList.remove("active");
}
varient_image[3].onclick = function(){ 
    active_varient_image.src = varient_image[3].src; 
    this.parentElement.classList.add("active");
    varient_image[0].parentElement.classList.remove("active");
    varient_image[1].parentElement.classList.remove("active");
    varient_image[2].parentElement.classList.remove("active");
}
