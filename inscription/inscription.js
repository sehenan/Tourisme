const h1 = document.querySelector('h1');
h1.style.color="red";
h1.addEventListener("over",()=>{
    h1.style.color = "blue";
})