/*
let products =[{},{}]....
*/
let carts= document.querySelectorAll('.fa-shopping-cart');
//carts[1] kap  produktin e dyte tek screeni
for(let i=0; i<carts.length;i++){
    carts[i].addEventListener('click',()=>{
        checkQuantity(products[i]);
    })
}

let productRefs=document.querySelectorAll('.pro-image');
for(let i=0;i<productRefs.length;i++){
    productRefs[i].addEventListener('click',()=>{
        localStorage.setItem("selectedProduct",JSON.stringify(products[i]));
        window.location.href = "product.php";
    })
}

//Ky funksion update-on labelin tek cart icon pasi i kemi ber refresh page
function onLoadCartNumbers(){
    let productNumbers = localStorage.getItem('cartNumbers');
    if(productNumbers){
        document.querySelector('.fa-shopping-bag span').textContent =productNumbers;
        document.querySelector('.mobile-shopping-bag span').textContent =productNumbers;

    }
}
 function checkQuantity(product){
    

    let cartItems= localStorage.getItem('productsInCart');
    console.log(cartItems);
    console.log(typeof cartItems);
    console.log( cartItems !=="undefined");
    if ( cartItems !=="undefined")  {
        console.log(cartItems);
        cartItems= JSON.parse(cartItems);
        if(cartItems != null && cartItems[product.tag] != undefined ){
            if((cartItems[product.tag].inCart+1)> cartItems[product.tag].quantity){
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text:'No more stock available at the moment.'
                });
                return;
            }
        }
    }
    
    cartNumbers(product);
    totalCost(product);    
}

function cartNumbers(product){
    //console.log('The product clicked is ',product); 
    let productNumbers = localStorage.getItem('cartNumbers');
    productNumbers=parseInt(productNumbers);
    
    if(productNumbers){
        //Ne kemi zgjedhur produkte me para
        localStorage.setItem('cartNumbers',productNumbers +1);
        document.querySelector('.fa-shopping-bag span').textContent =productNumbers+ 1;
        document.querySelector('.mobile-shopping-bag span').textContent =productNumbers+1;
    } else{
        localStorage.setItem('cartNumbers',1);
        //kapim labelin tek shporta qe duhet ndryshuar
        document.querySelector('.fa-shopping-bag span').textContent =1;
        document.querySelector('.mobile-shopping-bag span').textContent =1;
    }
    setItems(product);
}


function setItems(product){
    //Check first if is any product in local storage:
    let cartItems= localStorage.getItem('productsInCart');
    cartItems=JSON.parse(cartItems); //E kalojme ne JSON

    if(cartItems !=null){
        //Ne local storage ka dicka
        if(cartItems[product.tag] == undefined){//The square bracket notation allows you to use a dynamic expression (in this case, the value of product.tag) as the key.
            //Ky prdukt nuk eshte i pari ne shporte por eshte shtuar ne shport per here te pare
            cartItems={
                ...cartItems,
                [product.tag]:product
            }
        }
        cartItems[product.tag].inCart +=1;
    }else{
        //po shton per here te pare
        product.inCart=1;

        cartItems={
            [product.tag]:product
        }
    }
    localStorage.setItem("productsInCart",JSON.stringify(cartItems));
    //SHTO PRODUKTE NE DB
    $.ajax({
        type: "POST",
        url: "processing_data/delete_cart.php",
        success: function(response) {

        },
        error: function(err) {
            console.log(err);
        }
    });
    


    for (let key in cartItems) {
        if (cartItems.hasOwnProperty(key)) {
            let product = cartItems[key];
            // Now 'product' represents an item in the cart
                console.log(product);
           
            $.ajax({
                type:"POST",
                url:"processing_data/update_cart.php",
                data:product,
                success: function(html){
                    console.log(html);//nese ka ndonje error ne php del ketu
                },
                error(err){
                    console.log(err);
                }
        
            });
            
        }
    }
    

}

function totalCost(product){
    let cartCost= localStorage.getItem('totalCost');
     //First you have to chheck if there is a total cost in the localStorage
    if(cartCost != null){
        cartCost=parseInt(cartCost);
        localStorage.setItem('totalCost',cartCost + parseInt(product.price));
    }else{
        localStorage.setItem('totalCost',parseInt(product.price));
    }
}


function responsiveNavbar(){
	const bar= document.getElementById('bar');
	const close= document.getElementById('close');
	const nav=document.getElementById('navbar');
	const shoppingBag=document.getElementById('shopping-bag');
	if (bar) {	
	    bar.addEventListener('click',() => {
		nav.classList.add('active'); 
		shoppingBag.classList.add('active'); 
	})
	}
	if (close) {	
		close.addEventListener('click',() => {
		nav.classList.remove('active'); 
		shoppingBag.classList.remove('active'); 
		})
	}
}

onLoadCartNumbers();
responsiveNavbar();




