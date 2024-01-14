function displayCart(){
    let cartItems=localStorage.getItem("productsInCart");
    cartItems =JSON.parse(cartItems);
   //console.log(cartItems);
   let cartCost= localStorage.getItem('totalCost');
   let productContainer =document.querySelector(".products");
   //kontrollojm nese kemi produkte ne localStorage dhe vendosim nje specifik qe ky if do te
   //aksesohet vetem nese jemi ne cart Page sepse po i referohemi nje elmenti html te kesaj faqeje
    if( cartItems && productContainer){
       //console.log('Jemi ne cartPage dhe ne local Storage ka dicka');
        productContainer.innerHTML='';
        Object.values(cartItems).map(item =>{
            productContainer.innerHTML += `
            <tr>
					<td><a href="#"><i class="far fa-times-circle cart-removes" ></i></a></td>
					<td><img src="img/products/${item.tag}.jpg"></td>
					<td>${item.name}</td>
					<td>$${item.price},00</td>
					<td><input type="number" class="cart-quantity" value="${item.inCart}"></td>
					<td>$${item.inCart * item.price},00</td>
			</tr>
            `;
        });
        //Nese duam t i bejm remove nje produkti
        let removeCartButtons = document.querySelectorAll('.fa-times-circle');
        for (let i = 0; i < removeCartButtons.length; i++){
            //var button = removeCartButtons[i];removeCartItem
            removeCartButtons[i].addEventListener('click',()=>{
                console.log('dua t fshi ',i);
                removeCartItem(i);
            }); 	
        }
        //Nese duam te nryshojme sasine
        let quantityInputs = document.querySelectorAll('.cart-quantity');
       
        for (let i = 0; i < quantityInputs.length; i++){          
	        quantityInputs[i].addEventListener('change',()=>{          
            //console.log('produkti me index: ',i); 
           
              quantityChanged(event,i);
            }); 
          }
    }


    let productTotal1 =document.querySelector(".cart-total1");
    if( cartItems && productTotal1){
        productTotal1.innerHTML='';  
        productTotal1.innerHTML += `
         <tr>
            <td>Cart Subtotal</td>
            <td> $${cartCost},00</td>
        </tr>
        <tr>
            <td>Shipping</td>
            <td>Free</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong> $${cartCost},00</strong></td>
         </tr>
        
         `;

}

}



function removeCartItem(i){

    let cartItems=localStorage.getItem("productsInCart");
    cartItems =JSON.parse(cartItems);
  //E kemi objekt duhet ta kalojme ne array qe te heqim elementin me index i
   console.log(cartItems);
   let entries = Object.entries(cartItems);
   entries.splice(i,1);
   console.log(entries); 
   updateLocalStorage(entries);
  



} 

function quantityChanged(event,i){
       
        var input= event.target;
        if(isNaN(input.value)|| input.value<=0){
           input.value=1;
           }
        //console.log('produkti me index: ',i); 
       //console.log('sasiaa e re :',input.value);
       
       //Ndryshojm sasin
    let cartItems=localStorage.getItem("productsInCart");
    cartItems =JSON.parse(cartItems);
     //E kemi objekt duhet ta kalojme ne array qe te heqim elementin me index i

     let entries = Object.entries(cartItems);
    if(parseInt(input.value) > parseInt(entries[i][1].quantity)){
        input.value=entries[i][1].quantity;
        Swal.fire({
            icon: 'info',
            title: '',
            text:'No more stock available at the moment.'
          });
    }

     entries[i][1].inCart=parseInt(entries[i][1].inCart);
     entries[i][1].inCart=parseInt(input.value);
     
   updateLocalStorage(entries);
  
       
}
function updateLocalStorage(entries){
    localStorage.clear();
    let totalCost=0;
    let TotalCartNumbers=0;
    TotalCartNumbers=parseInt(TotalCartNumbers);
    //for(let i=0;i<)
    console.log(entries);
    for(let i=0;i<entries.length;i++){
        console.log(entries[i][1].price);
        console.log(entries[i][1].inCart);
        totalCost+=(entries[i][1].price * parseInt(entries[i][1].inCart));
        TotalCartNumbers+=parseInt(entries[i][1].inCart);
    }
    

    //Me pas e kalojm prap ne object qe ta hedhim ne localStorage
    const cartItems = entries.reduce((result, [key, value]) => {
        result[key] = value;
        
        return result;
      }, {});

      //totalCost= Math.round(totalCost* 100)/100;
    localStorage.setItem("productsInCart",JSON.stringify(cartItems));
    localStorage.setItem('totalCost',totalCost);
    localStorage.setItem('cartNumbers',TotalCartNumbers);
    document.querySelector('.fa-shopping-bag span').textContent=TotalCartNumbers;
    document.querySelector('.mobile-shopping-bag span').textContent =TotalCartNumbers;

    //SHTO PRODUKTET E SHPORTES NE DB
    //delete_cart.php

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

    displayCart();
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

//Ky funksion update on labelin tek cart icon pasi i kemi ber refresh page
function onLoadCartNumbers(){
    let productNumbers = localStorage.getItem('cartNumbers');
    if(productNumbers){
        document.querySelector('.fa-shopping-bag span').textContent =productNumbers;
        document.querySelector('.mobile-shopping-bag span').textContent =productNumbers;

    }
}

displayCart();
responsiveNavbar();

onLoadCartNumbers();









//Validimet dhe logjika e butonit Buy NOw
let buyNow = document.getElementById("buyNow");
buyNow.addEventListener('click', () => {
    let cartCost = localStorage.getItem('totalCost');
    cartCost = parseInt(cartCost);
    
      if (cartCost == 0 || isNaN(cartCost)) {
        //alert('Ju nuk keni gje ne shport');
        var modal = document.getElementById("myModal2");
        var span1 = document.getElementsByClassName("close1")[0];
        modal.style.display = "block";


        // When the user clicks on <span> (x), close the modal
        span1.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                //console.log("shtype jasht kutis");
                modal.style.display = "none";
            }
        }



    }
    else {
        let details = formValidation();
        if (details) {
            //
            updateStock();
            //Dergojme piket ne DB
             setNewPoints(cartCost);
            //Dergojm datat ne email
            sendData(details);


        }
        
    }



});

function updateStock(){
    let cartItems=localStorage.getItem("productsInCart");
    cartItems =JSON.parse(cartItems);
    if (cartItems) {
        for (let key in cartItems) {
            if (cartItems.hasOwnProperty(key)) {
                let product = cartItems[key];
                // Now 'product' represents an item in the cart
                newQuantity=parseInt(product.quantity)-parseInt(product.inCart);
                var quantityChanged={
                    productId:product.id,
                    changedQuantity:newQuantity
                };
                $.ajax({
                    type:"POST",
                    url:"processing_data/update_quantity.php",
                    data:quantityChanged,
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
}


function setNewPoints (cartCost){
    console.log("setNewPoints");
    
    var points={newPoints: cartCost,};
    $.ajax({
        type:"POST",
        url:"processing_data/update_points.php", 
        data:points,
        success: function(html){
            console.log(html);
        },
        error: function(err){
            console.log(err);
        }

    });
    let cartItems = JSON.parse(localStorage.getItem("productsInCart"));
    //SAVE PURCHASE:
    if (cartItems) {
        for (let key in cartItems) {
            if (cartItems.hasOwnProperty(key)) {
                let product = cartItems[key];
   
        //save_purchase.php
        console.log(product);
        $.ajax({
            type:"POST",
            url:"processing_data/save_purchase.php", 
            data:product,
            success: function(html){
                console.log(html);
            },
            error: function(err){
                console.log(err);
            }
    
        });
    }
    }}
  
}


function formValidation() {
    var name = document.forms.RegForm.Name.value;
    var email = document.forms.RegForm.EMail.value;
    var phone = document.forms.RegForm.Telephone.value;
    var address = document.forms.RegForm.Address.value;
    var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;  //Javascript reGex for Email Validation.
    var regPhone = /^\d{10}$/;                                        // Javascript reGex for Phone Number validation.
    var regName = /\d+$/g;                                    // Javascript reGex for Name validation

    if (name == "" || regName.test(name)) {
        var error = document.getElementById("nameError");
        error.textContent = "Please enter your name properly.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Name.focus();
        return false;
    } else {
        var error = document.getElementById("nameError");
        error.textContent = "";
    }

    if (email == "" || !regEmail.test(email)) {
        var error = document.getElementById("emailError");
        error.textContent = "Please enter a valid e-mail address.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.EMail.focus();
        return false;
    } else {
        var error = document.getElementById("emailError");
        error.textContent = "";
    }

    if (phone == "" || !regPhone.test(phone)) {
        var error = document.getElementById("phoneError");
        error.textContent = "Please enter valid phone number.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Telephone.focus();
        return false;
    } else {
        var error = document.getElementById("phoneError");
        error.textContent = "";
    }

    if (address == "") {
        var error = document.getElementById("addressError");
        error.textContent = "Please enter your address.";
        error.style.color = "red";
        error.style.fontSize = "12";
        document.forms.RegForm.Address.focus();
        return false;
    } else {
        var error = document.getElementById("addressError");
        error.textContent = "";
    }


    return {
        Name: name,
        Email: email,
        Phone: phone,
        Address: address
    };


}




function sendData(details) {
    let cartItems = localStorage.getItem("productsInCart");
    let cartCost = localStorage.getItem('totalCost');
    cartCost = parseInt(cartCost);
    var tempParams = {
        from_name: details.Name,
        email: details.Email,
        phone: details.Phone,
        total: cartCost,
        productList: cartItems

    };



    emailjs.send('service_r1qaaj8', 'template_eww2bfq', tempParams).then(function (res) {
        console.log("succes ", res.status);
    });

    emailjs.send('service_r1qaaj8', 'template_2y4pins', tempParams).then(function (res) {
        console.log("succes ", res.status);
    });




    // Get the modal
    var modal = document.getElementById("myModal");
    /*
    // Get the button that opens the modal
    var btn = document.getElementById("buyNow");
    */
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    //btn.onclick = function() {}
    modal.style.display = "block";


    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.forms.RegForm.Name.value = "";
    document.forms.RegForm.EMail.value = "";
    document.forms.RegForm.Telephone.value = "";
    document.forms.RegForm.Address.value = "";
    displayCart2();
}


function displayCart2(){
   
localStorage.clear();
   let productContainer =document.querySelector(".products");
  
    if(  productContainer){
       //console.log('Jemi ne cartPage dhe ne local Storage ka dicka');
        productContainer.innerHTML='';
    }

    let productTotal1 =document.querySelector(".cart-total1");
    if(  productTotal1){
        productTotal1.innerHTML='';  
        productTotal1.innerHTML += `
         <tr>
            <td>Cart Subtotal</td>
            <td> $0,00</td>
        </tr>
        <tr>
            <td>Shipping</td>
            <td>Free</td>
        </tr>
        <tr>
            <td><strong>Total:</strong></td>
            <td><strong> $0,00</strong></td>
         </tr>
        
         `;
    }

    document.querySelector('.fa-shopping-bag span').textContent =0;
    document.querySelector('.mobile-shopping-bag span').textContent =0;
} 