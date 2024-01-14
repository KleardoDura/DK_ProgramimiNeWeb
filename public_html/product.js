
window.addEventListener("load",start,false);
function start(){
    var product=JSON.parse(localStorage.getItem("selectedProduct"));
    if(product==null)
        window.location.href="shop.php";
    var mainRef=document.getElementById("main-wrap");
    mainRef.innerHTML=`
        <div class="product">
            <div class="image-gallery">
                <img src="img/products/`+product.tag +`.jpg"  id="productImg" alt="">
            </div>
            <div class="course-details2">
                <div class="details2"> 
                    <h2>`+product.name +`</h2>
                    <h3>`+product.brand +`</h3>
                    <h4>Price: $`+product.price +`</h4>
                    <p> `+product.description +`
                    </p>   
					<button class="green" onClick="addToCart();" >Add to Cart </button>
                </div>
            </div>
        </div>`

        getComments(product.id);
}


function addToCart(){
    
    var product=JSON.parse(localStorage.getItem("selectedProduct"));
    checkQuantity(product);  //funksioni i deklaruar ne filen main.js
}


//comments:
var ratingValueToBeSend=0;
function myCommentStyle(){
    console.log("dsd")
const allStar = document.querySelectorAll('.rating .star')
const ratingValue = document.querySelector('.rating input')

allStar.forEach((item, idx)=> {
	item.addEventListener('click', function () {
		let click = 0
		ratingValue.value = idx + 1
		allStar.forEach(i=> {
			i.classList.replace('bxs-star', 'bx-star')
			i.classList.remove('active')
		})
		for(let i=0; i<allStar.length; i++) {
			if(i <= idx) {
				allStar[i].classList.replace('bx-star', 'bxs-star')
				allStar[i].classList.add('active')
			} else {
				allStar[i].style.setProperty('--i', click)
				click++
			}
		}
        console.log(idx+1); //rating
        ratingValueToBeSend=idx+1;
	})
})
}


function getComments(prductId){
    var product={productId:prductId,};
    $.ajax({
        type:"POST",
        url:"processing_data/get_all_comments.php",
        data:product,
        success: function(html){
            console.log(JSON.parse(html));//nese ka ndonje error ne php del ketu
            showCmments(JSON.parse(html));
        },
        error(err){
            console.log(err);
        }
            
    });   
}

function showCmments(feedback){
    if(feedback===false){
        showMyComment();
        return;
    }
    var commentsRef=document.getElementById('others-comments');
    commentsRef.innerHTML=``;
    if (typeof feedback === 'object' && feedback.length==0){
        commentsRef.innerHTML="...No comment yet!";
        showMyComment(); 
        return;
    }

    for(var f of feedback){
        var stars=`<div class="rating2">`;
        var i;
        for(i=0;i<f.comment_rating;i++){
            stars+=`<i class='bx bxs-star star active' style="--i: `+i+`;"></i>`
        }
        for(;i<5;i++)
            stars+=`<i class='bx bx-star star' style="--i: `+i+`;"></i>`;
        stars+=`</div>`
        commentsRef.innerHTML+=`
            <hr style="margin-top: 10px;">
            <p>`+f.name+` `+ f.surname+`<b style="margin-left:40px">Date:</b> `+f.publish_date+`</p>
            `+stars+`
        <textarea name="opinion" cols="30" rows="3" readonly>`+f.comment+`</textarea>`;
    }
    showMyComment();
}
function showMyComment(){
    
    var product=JSON.parse(localStorage.getItem("selectedProduct"));
    var myCommentRef=document.getElementById("my-comment");
    $.ajax({
        type:"POST",
        url:"processing_data/user_logedIn.php",
        data:product,
        success: function(data){
            console.log(data);
            data=JSON.parse(data);
            if(data!=false){
                myCommentRef.innerHTML=`
                    <hr style="margin-top: 10px;">
            <p>Dear `+data.name +` we'd love to hear your thoughts</p>
            <div class="rating" id="rating">
                <input type="number" name="rating" hidden>
                <i class='bx bx-star star' style="--i: 0;"></i>
                <i class='bx bx-star star' style="--i: 1;"></i>
                <i class='bx bx-star star' style="--i: 2;"></i>
                <i class='bx bx-star star' style="--i: 3;"></i>
                <i class='bx bx-star star' style="--i: 4;"></i>
            </div>
            <textarea name="opinion" cols="30" rows="3" placeholder="Your opinion..." id="comment"></textarea>
            <div class="btn-group">
                <button onClick="sendData()" class="green">Submit</button>
                <button onClick="clearComment()" class="btn cancel">Cancel</button>
            </div>
            `;
             myCommentStyle();
            }
            else {
                myCommentRef.innerHTML=` `;
                myCommentRef.innerHTML=`<p style="color:red;"}>
                Sorry, but a purchase is required to leave a comment on this product.</p> `
            }
            
        },
        error(err){
            console.log(err);
            myCommentRef.innerHTML=``;
        }

    });

}

function sendData(){
    var selectedProduct=JSON.parse(localStorage.getItem("selectedProduct"));
    var commentRef=document.getElementById("comment");
    var currentDate = new Date();
    var year = currentDate.getFullYear();
    var month = padNumber(currentDate.getMonth() + 1); 
    var day = padNumber(currentDate.getDate());
    var formattedDate = year + '-' + month + '-' + day;

    var feedback={
        rating: ratingValueToBeSend,
        comment: commentRef.value,
        date: formattedDate,
        productId:selectedProduct.id
    }
    $.ajax({
        type:"POST",
        url:"processing_data/send_a_feedback.php",
        data:feedback,
        success: function(html){
            console.log(html);//nese ka ndonje error ne php del ketu
            getComments(selectedProduct.id);
        },
        error(err){
            console.log(err);
        }
            
    });   
}
function padNumber(number) {
    return (number < 10 ? '0' : '') + number;
}

function clearComment(){
    document.getElementById("comment").value="";
}